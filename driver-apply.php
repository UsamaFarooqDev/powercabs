<?php
/**
 * Driver application endpoint -- JSON only, not a page.
 *
 * The form in components/drive/join-family-form.php walks through eight steps
 * in the browser; this is what each of them talks to. Four actions:
 *
 *   start   -- validate the applicant's details, mail them a 6-digit code
 *   verify  -- check that code
 *   upload  -- put one file in Supabase Storage, return its url
 *   submit  -- create the auth account, write the drivers row, notify the office
 *
 * WHY A SESSION. The site is otherwise stateless -- no other page calls
 * session_start(). One is unavoidable here: the verification code must not be
 * round-tripped through the browser (the applicant could simply read it), and
 * the uploaded file urls have to survive between steps. Only this endpoint
 * starts a session, so nothing else on the site pays for it.
 *
 * WHY THE ORDER MATTERS. The auth account is created in `submit`, never
 * earlier, so an abandoned application leaves nothing behind. And `submit`
 * refuses to run unless the session says the address was verified, which is
 * what stops the whole endpoint being an open account-creation API.
 */

declare(strict_types=1);

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';
require __DIR__ . '/includes/supabase.php';

session_start();

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');

const PC_APP_OTP_TTL = 600; // 10 minutes
const PC_APP_OTP_RESEND = 45; // seconds between sends
const PC_APP_OTP_MAX_TRIES = 6;
const PC_APP_MAX_UPLOAD = 5242880; // 5MB per file

/** Which upload slot lands in which bucket and which drivers column. */
const PC_APP_UPLOADS = [
  'profile' => ['bucket' => 'driver_photos', 'column' => 'profile_pic_url', 'label' => 'Profile photo'],
  'license' => ['bucket' => 'driver_documents', 'column' => 'license_url', 'label' => 'Driving licence'],
  // other_docs_url is the only document column the app leaves unused (0 of 60
  // rows), so the NTA licence claims it rather than overwriting something.
  'nta_license' => ['bucket' => 'driver_documents', 'column' => 'other_docs_url', 'label' => 'NTA licence'],
  'insurance' => ['bucket' => 'driver_documents', 'column' => 'insurance_url', 'label' => 'Insurance certificate'],
  'nct' => ['bucket' => 'driver_documents', 'column' => 'nct_cert', 'label' => 'NCT certificate'],
  'road_tax' => ['bucket' => 'driver_documents', 'column' => 'rt_cert', 'label' => 'Road tax certificate'],
  'suitability' => ['bucket' => 'driver_documents', 'column' => 'suitability_cert', 'label' => 'Suitability certificate'],
];

const PC_APP_ALLOWED_TYPES = [
  'image/jpeg' => 'jpg',
  'image/png' => 'png',
  'image/webp' => 'webp',
  'image/heic' => 'heic',
  'application/pdf' => 'pdf',
];

function pc_app_out(array $payload, int $status = 200): never
{
  http_response_code($status);
  echo json_encode($payload);
  exit();
}

function pc_app_fail(string $message, int $status = 422): never
{
  pc_app_out(['ok' => false, 'error' => $message], $status);
}

function pc_app_field(string $key, int $max = 255): string
{
  $value = trim((string) ($_POST[$key] ?? ''));
  // Strip control characters so nothing can smuggle a newline into the email.
  $value = preg_replace('/[\x00-\x1F\x7F]/u', '', $value) ?? '';
  return mb_substr($value, 0, $max);
}

function pc_app_state(): array
{
  return $_SESSION['pc_driver_app'] ?? [];
}

function pc_app_set(array $patch): void
{
  $_SESSION['pc_driver_app'] = array_merge(pc_app_state(), $patch);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  pc_app_fail('POST only.', 405);
}

if (!pc_sb_ready()) {
  pc_app_fail('Applications are temporarily unavailable. Please call us instead.', 503);
}

$action = pc_app_field('action', 20);

/* ------------------------------------------------------------------ start */
if ($action === 'start') {
  $name = pc_app_field('full_name', 120);
  $email = mb_strtolower(pc_app_field('email', 160));
  $phone = pc_app_field('phone', 40);
  $referral = pc_app_field('referral', 40);

  if ($name === '' || $email === '' || $phone === '') {
    pc_app_fail('Please fill in your name, email and phone number.');
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    pc_app_fail('Please enter a valid email address.');
  }
  if (strlen(preg_replace('/\D/', '', $phone) ?? '') < 7) {
    pc_app_fail('Please enter a valid phone number.');
  }

  if (pc_sb_driver_email_taken($email)) {
    pc_app_fail('An application already exists for that email address.');
  }

  $state = pc_app_state();
  $since = time() - (int) ($state['otp_sent_at'] ?? 0);
  if (($state['email'] ?? null) === $email && $since < PC_APP_OTP_RESEND) {
    pc_app_fail('Please wait ' . (PC_APP_OTP_RESEND - $since) . 's before requesting another code.', 429);
  }

  $code = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);
  $sent = pc_send_mail(
    'Your PowerCabs verification code',
    "Hello {$name},\n\nYour PowerCabs driver application code is:\n\n    {$code}\n\n" .
      "It expires in 10 minutes. If you did not start an application, you can ignore this email.\n\n" .
      "Team PowerCabs",
    [],
    [],
    $email
  );

  if (!$sent['success']) {
    error_log('[driver-apply] OTP send failed: ' . (string) $sent['error']);
    pc_app_fail('We could not send your code. Please check the address and try again.', 502);
  }

  // Only the hash is kept: a session store is safer than the wire, but there
  // is no reason for the plain code to sit anywhere once it has been mailed.
  pc_app_set([
    'full_name' => $name,
    'email' => $email,
    'phone' => $phone,
    'referral' => $referral,
    'otp_hash' => hash('sha256', $code),
    'otp_sent_at' => time(),
    'otp_tries' => 0,
    'verified' => false,
  ]);

  pc_app_out(['ok' => true, 'email' => $email]);
}

/* ----------------------------------------------------------------- verify */
if ($action === 'verify') {
  $state = pc_app_state();
  if (empty($state['otp_hash'])) {
    pc_app_fail('Start the application again -- we have no code on file.');
  }
  if (time() - (int) $state['otp_sent_at'] > PC_APP_OTP_TTL) {
    pc_app_fail('That code has expired. Request a new one.');
  }
  if ((int) ($state['otp_tries'] ?? 0) >= PC_APP_OTP_MAX_TRIES) {
    pc_app_fail('Too many attempts. Request a new code.', 429);
  }

  $code = preg_replace('/\D/', '', pc_app_field('code', 10)) ?? '';
  pc_app_set(['otp_tries' => (int) ($state['otp_tries'] ?? 0) + 1]);

  if (!hash_equals((string) $state['otp_hash'], hash('sha256', $code))) {
    pc_app_fail('That code is not right. Please check and try again.');
  }

  pc_app_set(['verified' => true, 'otp_hash' => null]);
  pc_app_out(['ok' => true]);
}

/* ----------------------------------------------------------------- upload */
if ($action === 'upload') {
  $state = pc_app_state();
  if (empty($state['email'])) {
    pc_app_fail('Start the application first.');
  }

  $slot = pc_app_field('slot', 30);
  if (!isset(PC_APP_UPLOADS[$slot])) {
    pc_app_fail('Unknown upload.');
  }
  if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    $code = $_FILES['file']['error'] ?? UPLOAD_ERR_NO_FILE;
    pc_app_fail($code === UPLOAD_ERR_INI_SIZE || $code === UPLOAD_ERR_FORM_SIZE
      ? 'That file is too large. Please keep it under 5MB.'
      : 'Please choose a file to upload.');
  }
  if ($_FILES['file']['size'] > PC_APP_MAX_UPLOAD) {
    pc_app_fail('That file is too large. Please keep it under 5MB.');
  }

  // Trust the sniffed type, never the browser-supplied one.
  $mime = (new finfo(FILEINFO_MIME_TYPE))->file($_FILES['file']['tmp_name']) ?: '';
  if (!isset(PC_APP_ALLOWED_TYPES[$mime])) {
    pc_app_fail('Please upload a JPG, PNG, WEBP or PDF.');
  }

  $bytes = file_get_contents($_FILES['file']['tmp_name']);
  if ($bytes === false) {
    pc_app_fail('We could not read that file. Please try again.', 500);
  }

  // Keyed by a per-application token, not by email: the path should not leak
  // an address to anyone who guesses at a public bucket.
  $token = $state['token'] ?? bin2hex(random_bytes(8));
  $path = 'web-applications/' . $token . '/' . $slot . '.' . PC_APP_ALLOWED_TYPES[$mime];

  $put = pc_sb_storage_upload(PC_APP_UPLOADS[$slot]['bucket'], $path, $bytes, $mime);
  if (!$put['ok']) {
    error_log('[driver-apply] upload failed: ' . (string) $put['error']);
    pc_app_fail('We could not store that file. Please try again.', 502);
  }

  $uploads = $state['uploads'] ?? [];
  $uploads[$slot] = $put['url'];
  pc_app_set(['token' => $token, 'uploads' => $uploads]);

  pc_app_out(['ok' => true, 'slot' => $slot, 'url' => $put['url']]);
}

/* ----------------------------------------------------------------- submit */
if ($action === 'submit') {
  $state = pc_app_state();
  if (empty($state['verified'])) {
    pc_app_fail('Please verify your email address first.');
  }

  $password = (string) ($_POST['password'] ?? '');
  if (strlen($password) < 8) {
    pc_app_fail('Your password needs to be at least 8 characters.');
  }
  if ($password !== (string) ($_POST['password_confirm'] ?? '')) {
    pc_app_fail('Those passwords do not match.');
  }
  if (pc_app_field('terms', 10) !== 'yes') {
    pc_app_fail('Please accept the terms and conditions to continue.');
  }

  $expiry = pc_app_field('license_expiry', 10);
  if ($expiry !== '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $expiry)) {
    pc_app_fail('Please give the licence expiry as a date.');
  }

  $uploads = $state['uploads'] ?? [];
  $missing = [];
  foreach (PC_APP_UPLOADS as $slot => $meta) {
    if (empty($uploads[$slot])) {
      $missing[] = $meta['label'];
    }
  }
  if ($missing) {
    pc_app_fail('Still to upload: ' . implode(', ', $missing) . '.');
  }

  // Re-check at the last moment: the address was free when the code went out,
  // but that could have been ten minutes ago.
  if (pc_sb_driver_email_taken((string) $state['email'])) {
    pc_app_fail('An application already exists for that email address.');
  }

  $account = pc_sb_auth_create_user((string) $state['email'], $password, [
    'full_name' => $state['full_name'],
    'role' => 'driver',
  ]);
  if (!$account['ok']) {
    error_log('[driver-apply] auth create failed: ' . (string) $account['error']);
    pc_app_fail('We could not create your account. Please try again or contact us.', 502);
  }

  $row = [
    'id' => $account['id'],
    'full_name' => $state['full_name'],
    'email' => $state['email'],
    'phone' => $state['phone'],
    'status' => 'pending',
    'plate_no' => pc_app_field('plate_no', 40),
    'vehicle_number' => pc_app_field('vehicle_number', 40),
    'vehicle_make' => pc_app_field('vehicle_make', 60),
    'vehicle_model' => pc_app_field('vehicle_model', 60),
    'no_seats' => pc_app_field('no_seats', 4),
    'iban' => strtoupper(str_replace(' ', '', pc_app_field('iban', 40))),
    'license_number' => pc_app_field('license_number', 60),
    'nta_license_number' => pc_app_field('nta_license_number', 60),
    // The app's own rows use jsonb meta for anything without a column; the
    // three ride preferences and the terms acceptance go there.
    'meta' => [
      'source' => 'website',
      'night_rides' => pc_app_field('night_rides', 10) === 'yes',
      'pets_allowed' => pc_app_field('pets_allowed', 10) === 'yes',
      'wheelchair_accessible' => pc_app_field('wheelchair', 10) === 'yes',
      'terms_accepted_at' => gmdate('c'),
    ],
  ];
  if ($expiry !== '') {
    $row['license_expiry'] = $expiry;
  }
  if (!empty($state['referral'])) {
    $row['referred_by_code'] = $state['referral'];
  }
  foreach (PC_APP_UPLOADS as $slot => $meta) {
    $row[$meta['column']] = $uploads[$slot];
  }

  $insert = pc_sb_insert('drivers', $row);
  if (!$insert['ok']) {
    // Roll the account back, or the address is locked out of re-applying.
    pc_sb_auth_delete_user((string) $account['id']);
    error_log('[driver-apply] drivers insert failed: ' . (string) $insert['error']);
    pc_app_fail('We could not save your application. Please try again or contact us.', 502);
  }

  $prefs = [];
  foreach (['night_rides' => 'Night rides', 'pets_allowed' => 'Pets allowed',
    'wheelchair_accessible' => 'Wheelchair accessible'] as $key => $label) {
    if ($row['meta'][$key]) {
      $prefs[] = $label;
    }
  }

  // The office notification is best-effort on purpose: the application is
  // already safely in Supabase, so a mail failure must not tell the driver
  // their submission was lost.
  pc_send_mail(
    'New PowerCabs driver: ' . $row['full_name'],
    "A new driver {$row['full_name']} has joined PowerCabs through the website.\n\n" .
      "Name: {$row['full_name']}\n" .
      "Email: {$row['email']}\n" .
      "Phone: {$row['phone']}\n" .
      "Roof plate: {$row['plate_no']}\n" .
      "Vehicle: {$row['vehicle_make']} {$row['vehicle_model']} ({$row['vehicle_number']}), {$row['no_seats']} seats\n" .
      "Driving licence: {$row['license_number']}\n" .
      "NTA licence: {$row['nta_license_number']}\n" .
      ($expiry !== '' ? "Licence expiry: {$expiry}\n" : '') .
      (!empty($row['referred_by_code']) ? "Referred by: {$row['referred_by_code']}\n" : '') .
      'Preferences: ' . ($prefs ? implode(', ', $prefs) : 'none selected') . "\n\n" .
      "Status: pending -- all six documents were uploaded and are on the driver record in Supabase.\n",
    ['name' => $row['full_name'], 'email' => $row['email']]
  );

  // Nothing left worth keeping, and it stops a refresh re-submitting.
  unset($_SESSION['pc_driver_app']);

  pc_app_out(['ok' => true, 'name' => $row['full_name']]);
}

pc_app_fail('Unknown action.', 400);
