<?php
/**
 * Landing page for the Supabase "Reset Password" email template.
 *
 * Point the template's link at this page and let Supabase fill in the token:
 *   <a href="{{ .SiteURL }}/reset-password?token_hash={{ .TokenHash }}&type=recovery">Reset password</a>
 *
 * Everything happens client-side against Supabase Auth (see
 * assets/js/components/reset-password.js) -- the token never reaches this
 * PHP file, and there is no session or database on the website side.
 */
$pageTitle       = 'Reset Your Password | PowerCabs';
$pageDescription = 'Choose a new password for your PowerCabs account.';
$assetPath       = '';
$pageNoIndex     = true; // recovery links are single-use -- keep them out of search results

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/header.php';
?>

<section class="pc-reset-section d-flex align-items-center justify-content-center px-3">
  <div class="pc-reset-card w-100" id="pcResetPassword"
    data-supabase-url="<?= htmlspecialchars(PC_SUPABASE_URL) ?>"
    data-supabase-key="<?= htmlspecialchars(PC_SUPABASE_ANON_KEY) ?>">

    <!-- ============ Verifying / booting ============ -->
    <div class="text-center py-4" id="pcResetLoading">
      <span class="pc-reset-spinner" aria-hidden="true"></span>
      <p class="text-muted-pc mb-0 mt-3">Checking your reset link&hellip;</p>
    </div>

    <!-- ============ Set a new password ============ -->
    <div class="d-none" id="pcResetFormWrap">
      <div class="text-center mb-4">
        <span class="pc-reset-icon" aria-hidden="true"><i class="bi bi-shield-lock-fill"></i></span>
        <h1 class="pc-reset-title mt-3 mb-2">Set a New Password</h1>
        <p class="text-muted-pc mb-0">
          Choose a new password for <span class="fw-semibold" id="pcResetEmail">your PowerCabs account</span>.
        </p>
      </div>

      <!-- data-no-ajax: ajax-forms.js scrapes a PHP-rendered .alert-* out of a
           POST response, but nothing here posts to PHP -- it all goes to Supabase. -->
      <form id="pcResetForm" method="post" action="" data-no-ajax novalidate>
        <div class="mb-3">
          <label class="form-label mb-1 pc-required" for="pcResetNew">New Password</label>
          <div class="pc-reset-field">
            <input type="password" class="form-control" id="pcResetNew" name="password" autocomplete="new-password"
              minlength="8" required>
            <button type="button" class="pc-reset-toggle" data-target="pcResetNew" aria-label="Show password">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label mb-1 pc-required" for="pcResetConfirm">Confirm New Password</label>
          <div class="pc-reset-field">
            <input type="password" class="form-control" id="pcResetConfirm" name="password_confirm"
              autocomplete="new-password" minlength="8" required>
            <button type="button" class="pc-reset-toggle" data-target="pcResetConfirm" aria-label="Show password">
              <i class="bi bi-eye"></i>
            </button>
          </div>
        </div>

        <ul class="pc-reset-rules list-unstyled small mb-4" id="pcResetRules">
          <li data-rule="length"><i class="bi bi-circle"></i><span>At least 8 characters</span></li>
          <li data-rule="match"><i class="bi bi-circle"></i><span>Both passwords match</span></li>
        </ul>

        <div class="alert alert-danger d-none mb-3" role="alert" id="pcResetError"></div>

        <button type="submit" class="btn btn-pc-primary w-100 px-4 d-inline-flex align-items-center justify-content-center">
          <span>Update Password</span>
          <i class="bi bi-arrow-right ms-2" style="font-size: .85rem;"></i>
        </button>
      </form>
    </div>

    <!-- ============ Done ============ -->
    <div class="d-none text-center" id="pcResetDone">
      <span class="pc-reset-icon pc-reset-icon-success" aria-hidden="true"><i class="bi bi-check-lg"></i></span>
      <h1 class="pc-reset-title mt-3 mb-2">Password Updated</h1>
      <p class="text-muted-pc mb-4">
        Your password has been changed. Head back to the PowerCabs app and sign in with your new password.
      </p>
      <a href="<?= $assetPath ?>/" class="btn btn-pc-dark px-4 d-inline-flex align-items-center gap-2">
        <i class="bi bi-house-door-fill"></i>
        <span>Back to Home</span>
      </a>
    </div>

    <!-- ============ Bad / expired / already-used link ============ -->
    <div class="d-none text-center" id="pcResetInvalid">
      <span class="pc-reset-icon pc-reset-icon-danger" aria-hidden="true"><i class="bi bi-exclamation-triangle-fill"></i></span>
      <h1 class="pc-reset-title mt-3 mb-2">This Link Isn&rsquo;t Valid</h1>
      <p class="text-muted-pc mb-4" id="pcResetInvalidText">
        Password reset links can only be used once and expire after a short while.
        Open the PowerCabs app and tap &ldquo;Forgot Password?&rdquo; to get a fresh one.
      </p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="<?= $assetPath ?>/download-our-app" class="btn btn-pc-primary px-4 d-inline-flex align-items-center gap-2">
          <i class="bi bi-phone"></i>
          <span>Get the App</span>
        </a>
        <a href="<?= $assetPath ?>/contact-us" class="btn btn-pc-dark px-4 d-inline-flex align-items-center gap-2">
          <i class="bi bi-life-preserver"></i>
          <span>Contact Support</span>
        </a>
      </div>
    </div>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/reset-password.js"></script>

<?php require __DIR__ . '/includes/footer.php'; ?>
