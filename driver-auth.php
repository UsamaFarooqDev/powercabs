<?php
declare(strict_types=1);

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/supabase.php';
require __DIR__ . '/includes/driver-session.php';

pc_driver_session_start();

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');

const PC_DRIVER_MAX_TRIES = 6;
const PC_DRIVER_LOCKOUT = 900; 

function pc_auth_out(array $payload, int $status = 200): never
{
  http_response_code($status);
  echo json_encode($payload);
  exit();
}

function pc_auth_fail(string $message, int $status = 401): never
{
  pc_auth_out(['ok' => false, 'error' => $message], $status);
}

function pc_auth_field(string $key, int $max = 255): string
{
  $value = trim((string) ($_POST[$key] ?? ''));
  $value = preg_replace('/[\x00-\x1F\x7F]/u', '', $value) ?? '';
  return mb_substr($value, 0, $max);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  pc_auth_fail('POST only.', 405);
}

$action = pc_auth_field('action', 20);

if ($action === 'logout') {
  pc_driver_sign_out();
  pc_auth_out(['ok' => true]);
}

if ($action !== 'login') {
  pc_auth_fail('Unknown action.', 400);
}

if (!pc_sb_ready() || PC_SUPABASE_ANON_KEY === '') {
  error_log('[driver-auth] Supabase is not configured; sign-in unavailable.');
  pc_auth_fail('Driver sign-in is temporarily unavailable. Please contact the office.', 503);
}

$tries = (int) ($_SESSION['pc_driver_tries'] ?? 0);
$since = (int) ($_SESSION['pc_driver_tries_at'] ?? 0);

if ($since && time() - $since > PC_DRIVER_LOCKOUT) {
  $tries = 0;
}
if ($tries >= PC_DRIVER_MAX_TRIES) {
  $wait = max(1, (int) ceil((PC_DRIVER_LOCKOUT - (time() - $since)) / 60));
  pc_auth_fail("Too many sign-in attempts. Please try again in {$wait} minute" . ($wait === 1 ? '' : 's') . '.', 429);
}

$email = mb_strtolower(pc_auth_field('email', 160));
$password = (string) ($_POST['password'] ?? ''); 

if ($email === '' || $password === '') {
  pc_auth_fail('Enter your email and password.', 422);
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  pc_auth_fail('Enter a valid email address.', 422);
}

$_SESSION['pc_driver_tries'] = $tries + 1;
$_SESSION['pc_driver_tries_at'] = $since ?: time();

const PC_AUTH_GENERIC = 'Those details do not match a PowerCabs driver account.';

$tokenUrl = rtrim(PC_SUPABASE_URL, '/') . '/auth/v1/token?grant_type=password';
$ch = curl_init($tokenUrl);
curl_setopt_array($ch, [
  CURLOPT_POST => true,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    'apikey: ' . PC_SUPABASE_ANON_KEY,
    'Content-Type: application/json',
  ],
  CURLOPT_POSTFIELDS => json_encode(['email' => $email, 'password' => $password]),
  CURLOPT_TIMEOUT => 15,
  CURLOPT_CONNECTTIMEOUT => 8,
]);
$raw = curl_exec($ch);
$status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlErr = $raw === false ? curl_error($ch) : null;
curl_close($ch);

if ($raw === false) {
  error_log('[driver-auth] token request failed: ' . (string) $curlErr);
  pc_auth_fail('We could not reach the sign-in service. Please try again.', 502);
}

$auth = json_decode((string) $raw, true);

if ($status < 200 || $status >= 300 || empty($auth['user']['id'])) {
error_log('[driver-auth] rejected sign-in for ' . $email . ': HTTP ' . $status);
  pc_auth_fail(PC_AUTH_GENERIC);
}

$authId = (string) $auth['user']['id'];

$lookup = pc_sb_select(
  'drivers',
  'select=id,full_name,email,status&limit=1&id=eq.' . rawurlencode($authId)
);

if (!$lookup['ok']) {
  error_log('[driver-auth] drivers lookup failed: ' . (string) $lookup['error']);
  pc_auth_fail('We could not load your driver record. Please try again.', 502);
}

$driver = is_array($lookup['json']) ? ($lookup['json'][0] ?? null) : null;
if (!is_array($driver) || empty($driver['id'])) {
  error_log('[driver-auth] auth user ' . $authId . ' has no drivers row.');
  pc_auth_fail(PC_AUTH_GENERIC);
}

unset($_SESSION['pc_driver_tries'], $_SESSION['pc_driver_tries_at']);
pc_driver_sign_in($driver);

pc_auth_out([
  'ok' => true,
  'name' => (string) ($driver['full_name'] ?? ''),
  'redirect' => '/driver-training',
]);
