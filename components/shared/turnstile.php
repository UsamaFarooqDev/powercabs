<?php
/**
 * The Cloudflare Turnstile widget for a form.
 *
 * Drop it in just above the submit button:
 *
 *   <?php require __DIR__ . '/components/shared/turnstile.php'; ?>
 *
 * Renders nothing when the keys are not configured, so a missing .env leaves the form working
 * rather than showing an empty box -- includes/turnstile.php makes the matching server-side check
 * pass in that case too.
 *
 * The API script is NOT loaded here: it lives in footer.php, outside <main>, because PJAX swaps
 * <main> on every navigation and the script must load exactly once. assets/js/components/
 * turnstile.js renders any widget that appears after a swap and resets one after a submit, since
 * a token is single-use.
 *
 * Variables (all optional):
 *   $turnstileClass  extra classes on the wrapper
 */
require_once __DIR__ . '/../../includes/turnstile.php';

if (pc_turnstile_enabled()):
  $turnstileClass ??= '';
  ?>
  <div class="<?= $turnstileClass ?>">
    <div class="cf-turnstile tw-min-h-[65px]"
      data-sitekey="<?= htmlspecialchars(PC_TURNSTILE_SITE_KEY) ?>"
      data-theme="light"
      data-size="flexible"
      data-retry="auto"
      data-appearance="always"></div>
  </div>
  <?php
endif;
unset($turnstileClass);
