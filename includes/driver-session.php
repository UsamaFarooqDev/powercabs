<?php
declare(strict_types=1);

const PC_DRIVER_SESSION = 'PCDRV';

const PC_DRIVER_HINT = 'pc_driver_hint';

const PC_DRIVER_TTL = 28800;

function pc_driver_https(): bool
{
  return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
}

function pc_driver_session_start(): void
{
  if (session_status() === PHP_SESSION_ACTIVE) {
    return;
  }

  session_name(PC_DRIVER_SESSION);
  session_set_cookie_params([
    'lifetime' => 0, 
    'path' => '/',
    'secure' => pc_driver_https(),
    'httponly' => true, 
    'samesite' => 'Lax',
  ]);
  session_start();
}

function pc_driver_current(): ?array
{
  pc_driver_session_start();

  $d = $_SESSION['pc_driver'] ?? null;
  if (!is_array($d) || empty($d['id']) || empty($d['at'])) {
    return null;
  }

  if (time() - (int) $d['at'] > PC_DRIVER_TTL) {
    pc_driver_sign_out();
    return null;
  }

  $_SESSION['pc_driver']['at'] = time();
  return $_SESSION['pc_driver'];
}

function pc_driver_sign_in(array $driver): void
{
  pc_driver_session_start();
  session_regenerate_id(true);

  $_SESSION['pc_driver'] = [
    'id' => (string) $driver['id'],
    'name' => (string) ($driver['full_name'] ?? ''),
    'email' => (string) ($driver['email'] ?? ''),
    'status' => (string) ($driver['status'] ?? ''),
    'at' => time(),
  ];

  setcookie(PC_DRIVER_HINT, '1', [
    'expires' => 0,
    'path' => '/',
    'secure' => pc_driver_https(),
    'httponly' => false, 
    'samesite' => 'Lax',
  ]);
}

function pc_driver_sign_out(): void
{
  pc_driver_session_start();
  $_SESSION = [];

  foreach ([session_name(), PC_DRIVER_HINT] as $cookie) {
    setcookie($cookie, '', [
      'expires' => time() - 42000,
      'path' => '/',
      'secure' => pc_driver_https(),
      'httponly' => $cookie !== PC_DRIVER_HINT,
      'samesite' => 'Lax',
    ]);
  }

  session_destroy();
}
