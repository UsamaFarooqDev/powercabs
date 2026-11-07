<?php
declare(strict_types=1);

/**
 * Cloudflare Turnstile verification.
 *
 * The site key is public and goes in the markup; the secret never leaves the server, so both live
 * in .env like every other credential here -- see includes/env.php. Pages that render the widget
 * must require this file (or env.php) before header.php.
 *
 * Two deliberate choices:
 *
 * - With no keys configured the check PASSES. A missing .env already degrades mail and Maps
 *   quietly; it must not also make every form on the site unsubmittable.
 * - If Cloudflare itself cannot be reached, the check PASSES and the failure is logged. An outage
 *   at their end would otherwise take every booking form down with it. A token that is present
 *   and explicitly rejected, or missing while the widget was rendered, always FAILS.
 */

require_once __DIR__ . '/env.php';

const PC_TURNSTILE_VERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
const PC_TURNSTILE_FIELD = 'cf-turnstile-response';

/** True when both keys are configured, i.e. the widget renders and the token is checked. */
function pc_turnstile_enabled(): bool
{
  return PC_TURNSTILE_SITE_KEY !== '' && PC_TURNSTILE_SECRET !== '';
}

/**
 * Verifies the posted token.
 *
 * @return array{ok: bool, error: ?string} error is a message fit to show a visitor.
 */
function pc_turnstile_verify(?string $token = null): array
{
  if (!pc_turnstile_enabled()) {
    return ['ok' => true, 'error' => null];
  }

  $token ??= (string) ($_POST[PC_TURNSTILE_FIELD] ?? '');
  $token = trim($token);

  if ($token === '') {
    return ['ok' => false, 'error' => 'Please complete the security check and try again.'];
  }

  if (!function_exists('curl_init')) {
    error_log('[turnstile] curl is unavailable; skipping verification');
    return ['ok' => true, 'error' => null];
  }

  $post = [
    'secret' => PC_TURNSTILE_SECRET,
    'response' => $token,
  ];
  // Helps Cloudflare score the request; harmless when the header is absent.
  $ip = (string) ($_SERVER['HTTP_CF_CONNECTING_IP'] ?? $_SERVER['REMOTE_ADDR'] ?? '');
  if ($ip !== '' && filter_var($ip, FILTER_VALIDATE_IP)) {
    $post['remoteip'] = $ip;
  }

  $ch = curl_init(PC_TURNSTILE_VERIFY_URL);
  curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => http_build_query($post),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 8,
    CURLOPT_CONNECTTIMEOUT => 4,
  ]);
  $raw = curl_exec($ch);
  $err = curl_error($ch);
  $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
  curl_close($ch);

  if ($raw === false || $status !== 200) {
    error_log('[turnstile] verify unreachable (' . $status . ' ' . $err . '); allowing the submission');
    return ['ok' => true, 'error' => null];
  }

  $body = json_decode((string) $raw, true);
  if (!is_array($body)) {
    error_log('[turnstile] unreadable response; allowing the submission');
    return ['ok' => true, 'error' => null];
  }

  if (!empty($body['success'])) {
    return ['ok' => true, 'error' => null];
  }

  $codes = is_array($body['error-codes'] ?? null) ? implode(',', $body['error-codes']) : '';
  error_log('[turnstile] rejected: ' . $codes);

  // A stale or already-used token just needs another go; anything else is a real failure.
  if (str_contains($codes, 'timeout-or-duplicate')) {
    return ['ok' => false, 'error' => 'That security check has expired. Please try again.'];
  }

  return ['ok' => false, 'error' => 'The security check could not be verified. Please try again.'];
}

/** Null when the check passes, otherwise the message to show the visitor. */
function pc_turnstile_error(): ?string
{
  $result = pc_turnstile_verify();
  return $result['ok'] ? null : $result['error'];
}
