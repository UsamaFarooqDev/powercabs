<?php
require_once __DIR__ . '/env.php';

function pc_sb_ready(): bool
{
  return PC_SUPABASE_URL !== '' && PC_SUPABASE_SERVICE_KEY !== '';
}

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

function pc_sb_select(string $table, string $query): array
{
  return pc_sb_request('GET', $table . '?' . $query);
}

function pc_sb_insert(string $table, array $row): array
{
  return pc_sb_request('POST', $table, ['Prefer: return=representation'], [$row]);
}

function pc_sb_driver_email_taken(string $email): bool
{
  $res = pc_sb_select('drivers', 'select=id&limit=1&email=eq.' . rawurlencode($email));
  return $res['ok'] && is_array($res['json']) && count($res['json']) > 0;
}

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

function pc_sb_auth_delete_user(string $id): bool
{
  return pc_sb_request('DELETE', 'admin/users/' . rawurlencode($id), [], null, 'auth/v1/')['ok'];
}
