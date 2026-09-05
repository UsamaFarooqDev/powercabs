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

// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = 'pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink';
$submitClass = $pcBtnPrimary . ' tw-w-full disabled:tw-pointer-events-none disabled:hover:tw-translate-y-0';
?>

<section class="tw-flex tw-min-h-screen tw-items-center tw-justify-center tw-px-3 tw-pb-[clamp(3rem,6vw,5rem)] tw-pt-[calc(var(--pc-navbar-h,110px)+clamp(2rem,5vw,3.5rem))] tw-bg-paper-soft">
  <div class="tw-w-full tw-max-w-[480px] tw-rounded-2xl tw-bg-white tw-p-[clamp(1.5rem,4vw,2.75rem)] tw-shadow-[0_10px_30px_rgba(28,20,16,0.1)]" id="pcResetPassword"
    data-supabase-url="<?= htmlspecialchars(PC_SUPABASE_URL) ?>"
    data-supabase-key="<?= htmlspecialchars(PC_SUPABASE_ANON_KEY) ?>">

    <!-- ============ Verifying / booting ============ -->
    <div class="tw-py-4 tw-text-center" id="pcResetLoading">
      <span class="tw-inline-block tw-h-8 tw-w-8 tw-animate-spin tw-rounded-full tw-border-[3px] tw-border-solid tw-border-[#fbe6d4] tw-border-t-power motion-reduce:[animation-duration:1.4s]" aria-hidden="true"></span>
      <p class="tw-mb-0 tw-mt-3 tw-text-ink/60">Checking your reset link&hellip;</p>
    </div>

    <!-- ============ Set a new password ============ -->
    <!-- tw-hidden on this and the other panels below is toggled directly by
         showPanel() in reset-password.js, swapping the four states. -->
    <div class="tw-hidden" id="pcResetFormWrap">
      <div class="tw-mb-6 tw-text-center">
        <span class="tw-inline-flex tw-h-14 tw-w-14 tw-items-center tw-justify-center tw-rounded-full tw-bg-[#fbe6d4] tw-text-power" aria-hidden="true">
          <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
        </span>
        <h1 class="tw-mb-2 tw-mt-3 tw-text-[clamp(1.35rem,2.4vw,1.75rem)] tw-font-bold tw-text-ink">Set a New Password</h1>
        <p class="tw-mb-0 tw-text-ink/60">
          Choose a new password for <span class="tw-font-semibold" id="pcResetEmail">your PowerCabs account</span>.
        </p>
      </div>

      <!-- data-no-ajax: ajax-forms.js scrapes a PHP-rendered .alert-* out of a
           POST response, but nothing here posts to PHP -- it all goes to Supabase. -->
      <form id="pcResetForm" method="post" action="" data-no-ajax novalidate>
        <div class="tw-mb-4">
          <label class="<?= $labelClass ?>" for="pcResetNew">New Password</label>
          <div class="tw-relative">
            <input type="password" class="<?= $inputClass ?>" id="pcResetNew" name="password" autocomplete="new-password"
              minlength="8" required>
            <!-- .pc-reset-toggle + data-target stay bare -- reset-password.js
                 queries this exact classname to wire up the show/hide button,
                 and swaps the .pc-icon <svg>'s path on click. -->
            <button type="button" class="pc-reset-toggle tw-absolute tw-right-1 tw-top-1/2 tw-flex tw-h-8 tw-w-8 -tw-translate-y-1/2 tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-transparent tw-text-ink/50 tw-transition-colors tw-duration-200 hover:tw-bg-paper hover:tw-text-power" data-target="pcResetNew" aria-label="Show password">
              <svg class="pc-icon tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.13 13.13 0 011.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0114.828 8a13.13 13.13 0 01-1.66 2.043C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 011.172 8z"/><path d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"/></svg>
            </button>
          </div>
        </div>

        <div class="tw-mb-4">
          <label class="<?= $labelClass ?>" for="pcResetConfirm">Confirm New Password</label>
          <div class="tw-relative">
            <input type="password" class="<?= $inputClass ?>" id="pcResetConfirm" name="password_confirm"
              autocomplete="new-password" minlength="8" required>
            <button type="button" class="pc-reset-toggle tw-absolute tw-right-1 tw-top-1/2 tw-flex tw-h-8 tw-w-8 -tw-translate-y-1/2 tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-transparent tw-text-ink/50 tw-transition-colors tw-duration-200 hover:tw-bg-paper hover:tw-text-power" data-target="pcResetConfirm" aria-label="Show password">
              <svg class="pc-icon tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.13 13.13 0 011.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0114.828 8a13.13 13.13 0 01-1.66 2.043C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 011.172 8z"/><path d="M8 5.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"/></svg>
            </button>
          </div>
        </div>

        <!-- reset-password.js's updateRules() swaps each .pc-icon <svg>'s
             path (empty circle <-> filled check) and toggles .is-met on the
             <li>; the [&.is-met_svg]: variants below key off that. -->
        <ul class="tw-mb-6 tw-flex tw-list-none tw-flex-col tw-gap-1 tw-p-0 tw-text-sm" id="pcResetRules">
          <li class="tw-flex tw-items-center tw-gap-2 tw-text-ink/60 [&.is-met]:tw-text-[#198754] [&_svg]:tw-h-4 [&_svg]:tw-w-4 [&_svg]:tw-shrink-0 [&_svg]:tw-opacity-55 [&.is-met_svg]:tw-opacity-100" data-rule="length"><svg class="pc-icon" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8 15A7 7 0 118 1a7 7 0 010 14zm0 1A8 8 0 108 0a8 8 0 000 16z"/></svg><span>At least 8 characters</span></li>
          <li class="tw-flex tw-items-center tw-gap-2 tw-text-ink/60 [&.is-met]:tw-text-[#198754] [&_svg]:tw-h-4 [&_svg]:tw-w-4 [&_svg]:tw-shrink-0 [&_svg]:tw-opacity-55 [&.is-met_svg]:tw-opacity-100" data-rule="match"><svg class="pc-icon" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8 15A7 7 0 118 1a7 7 0 010 14zm0 1A8 8 0 108 0a8 8 0 000 16z"/></svg><span>Both passwords match</span></li>
        </ul>

        <div class="alert-danger tw-hidden tw-mb-4 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert" id="pcResetError"></div>

        <button type="submit" class="<?= $submitClass ?>">
          <span>Update Password</span>
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12L3.269 3.126A59.77 59.77 0 0121.485 12 59.77 59.77 0 013.27 20.876L6 12zm0 0h7.5"/></svg>
        </button>
      </form>
    </div>

    <!-- ============ Done ============ -->
    <div class="tw-hidden tw-text-center" id="pcResetDone">
      <span class="tw-inline-flex tw-h-14 tw-w-14 tw-items-center tw-justify-center tw-rounded-full tw-bg-[rgba(25,135,84,0.12)] tw-text-[#198754]" aria-hidden="true">
        <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
      </span>
      <h1 class="tw-mb-2 tw-mt-3 tw-text-[clamp(1.35rem,2.4vw,1.75rem)] tw-font-bold tw-text-ink">Password Updated</h1>
      <p class="tw-mb-6 tw-text-ink/60">
        Your password has been changed. Head back to the PowerCabs app and sign in with your new password.
      </p>
      <a href="<?= $assetPath ?>/" class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink-soft">
        <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75"/></svg>
        <span>Back to Home</span>
      </a>
    </div>

    <!-- ============ Bad / expired / already-used link ============ -->
    <div class="tw-hidden tw-text-center" id="pcResetInvalid">
      <span class="tw-inline-flex tw-h-14 tw-w-14 tw-items-center tw-justify-center tw-rounded-full tw-bg-red-50 tw-text-red-600" aria-hidden="true">
        <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
      </span>
      <h1 class="tw-mb-2 tw-mt-3 tw-text-[clamp(1.35rem,2.4vw,1.75rem)] tw-font-bold tw-text-ink">This Link Isn&rsquo;t Valid</h1>
      <p class="tw-mb-6 tw-text-ink/60" id="pcResetInvalidText">
        Password reset links can only be used once and expire after a short while.
        Open the PowerCabs app and tap &ldquo;Forgot Password?&rdquo; to get a fresh one.
      </p>
      <div class="tw-flex tw-flex-wrap tw-justify-center tw-gap-3">
        <a href="<?= $assetPath ?>/download-our-app" class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]">
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3"/></svg>
          <span>Get the App</span>
        </a>
        <a href="<?= $assetPath ?>/contact-us" class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink-soft">
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m-15.432 0A8.959 8.959 0 013 12c0-.778.099-1.533.284-2.253"/></svg>
          <span>Contact Support</span>
        </a>
      </div>
    </div>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/reset-password.js"></script>

<?php require __DIR__ . '/includes/footer.php'; ?>
