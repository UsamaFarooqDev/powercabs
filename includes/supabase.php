<?php
/**
 * Server-side Supabase client.
 *
 * Everything here runs with PC_SUPABASE_SERVICE_KEY, which bypasses row level
 * security completely. That key must never reach the browser -- no echoing it
 * into markup, no passing it to JS. reset-password.php shows the other half of
 * the rule: the anon key is the only one that may be handed to the client.
 *
 * Hand-rolled over curl for the same reason includes/mailer.php is a hand-rolled
 * SMTP client: there is no Composer in this project and no build step on the
 * server, so a dependency is not an option.
 *
 * NOT THE ONLY SUPABASE CLIENT HERE. lib/fare_calculator.php has
 * pc_supabase_get(), and it stays separate on purpose: it is SELECT-only, it
 * throws PcSupabaseError rather than returning a result, and its 3s/4s
 * timeouts are tuned so a slow database can never stall a fare quote. This
 * file needs inserts, binary storage uploads and the auth admin API, and a
 * form endpoint wants an error it can show rather than an exception. If that
 * ever stops being true, merge them -- but do not widen the fare calculator's
 * timeouts to do it.
 *
 * Every call returns ['ok' => bool, 'status' => int, 'json' => mixed,
 * 'error' => string|null] and never throws, so callers can branch on 'ok'
 * without wrapping anything in try/catch.
 */

require_once __DIR__ . '/env.php';

/** Both halves have to be present or every call below would 401. */
function pc_sb_ready(): bool
{
  return PC_SUPABASE_URL !== '' && PC_SUPABASE_SERVICE_KEY !== '';
}

/**
 * One request against any Supabase sub-API. $base picks which: 'rest/v1/' for
 * PostgREST, 'auth/v1/' for GoTrue, 'storage/v1/' for storage.
 *
 * @param string|null $rawBody Pre-encoded body. When null, $json is encoded.
 */
function pc_sb_request(
    string $method,
    string $path,
    array $headers = [],
    $json = null,
    string $base = 'rest/v1/',
    ?string $rawBody = null
): array {
  if (!pc_sb_ready()) {
    return ['ok' => false, 'status' => 0, 'json' => null, 'error' => 'Supabase is not configured.'];
  }

  $url = rtrim(PC_SUPABASE_URL, '/') . '/' . $base . ltrim($path, '/');
  $head = array_merge([
    'apikey: ' . PC_SUPABASE_SERVICE_KEY,
    'Authorization: Bearer ' . PC_SUPABASE_SERVICE_KEY,
  ], $headers);

  $body = $rawBody;
  if ($body === null && $json !== null) {
    $body = json_encode($json);
    $head[] = 'Content-Type: application/json';
  }

  $ch = curl_init($url);
  curl_setopt_array($ch, [
    CURLOPT_CUSTOMREQUEST => $method,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER => $head,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 10,
  ]);
  if ($body !== null) {
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
  }

  $res = curl_exec($ch);
  $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $err = $res === false ? curl_error($ch) : null;
  curl_close($ch);

  if ($res === false) {
    return ['ok' => false, 'status' => 0, 'json' => null, 'error' => $err ?: 'Request failed.'];
  }

  $decoded = $res === '' ? null : json_decode($res, true);
  $ok = $status >= 200 && $status < 300;

  // Supabase reports failures as {message|error_description|msg|error}; surface
  // whichever it used so callers can log something meaningful.
  $error = null;
  if (!$ok) {
    foreach (['message', 'error_description', 'msg', 'error'] as $key) {
      if (is_array($decoded) && isset($decoded[$key]) && is_string($decoded[$key])) {
        $error = $decoded[$key];
        break;
      }
    }
    $error ??= 'HTTP ' . $status;
  }

  return ['ok' => $ok, 'status' => $status, 'json' => $decoded, 'error' => $error];
}

/** SELECT via PostgREST. $query is already-encoded querystring, eg "email=eq.x". */
function pc_sb_select(string $table, string $query): array
{
  return pc_sb_request('GET', $table . '?' . $query);
}

/** INSERT one row; returns the stored row in ['json'][0] thanks to Prefer: return=representation. */
function pc_sb_insert(string $table, array $row): array
{
  return pc_sb_request('POST', $table, ['Prefer: return=representation'], [$row]);
}

/** True when any driver already holds this email. */
function pc_sb_driver_email_taken(string $email): bool
{
  $res = pc_sb_select('drivers', 'select=id&limit=1&email=eq.' . rawurlencode($email));
  return $res['ok'] && is_array($res['json']) && count($res['json']) > 0;
}

/**
 * Uploads raw bytes and returns the PUBLIC url, matching how the driver app
 * already stores things -- see the existing rows: profile pictures live in
 * driver_photos, every document in driver_documents, both public buckets.
 *
 * @return array ok/url/error
 */
function pc_sb_storage_upload(string $bucket, string $path, string $bytes, string $contentType): array
{
  $res = pc_sb_request(
    'POST',
    $bucket . '/' . ltrim($path, '/'),
    ['Content-Type: ' . $contentType, 'x-upsert: true', 'Cache-Control: max-age=31536000'],
    null,
    'storage/v1/object/',
    $bytes
  );

  if (!$res['ok']) {
    return ['ok' => false, 'url' => null, 'error' => $res['error']];
  }

  return [
    'ok' => true,
    'url' => rtrim(PC_SUPABASE_URL, '/') . '/storage/v1/object/public/' . $bucket . '/' . ltrim($path, '/'),
    'error' => null,
  ];
}

/**
 * Creates the GoTrue account the driver will sign into the app with.
 *
 * This is not optional plumbing: drivers.id is the auth user's id (verified
 * against the live table -- every existing drivers.id resolves to an auth
 * user), so the row cannot be written until the account exists.
 *
 * email_confirm is true because the address has already been proved by the
 * 6-digit code in step 3; leaving it false would send a second, contradictory
 * confirmation mail from Supabase.
 */
function pc_sb_auth_create_user(string $email, string $password, array $meta = []): array
{
  $res = pc_sb_request('POST', 'admin/users', [], [
    'email' => $email,
    'password' => $password,
    'email_confirm' => true,
    'user_metadata' => $meta,
  ], 'auth/v1/');

  if (!$res['ok'] || empty($res['json']['id'])) {
    return ['ok' => false, 'id' => null, 'error' => $res['error'] ?? 'No user id returned.'];
  }

  return ['ok' => true, 'id' => $res['json']['id'], 'error' => null];
}

/**
 * Used only to roll back: if the account is created but the drivers insert
 * then fails, leaving the account behind would block the driver from ever
 * re-applying with that address.
 */
function pc_sb_auth_delete_user(string $id): bool
{
  return pc_sb_request('DELETE', 'admin/users/' . rawurlencode($id), [], null, 'auth/v1/')['ok'];
}
