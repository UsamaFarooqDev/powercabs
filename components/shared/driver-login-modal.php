<?php
?>
<div class="tw-hidden tw-fixed tw-inset-0 tw-z-[1055] tw-overflow-y-auto tw-overscroll-contain tw-px-4 tw-py-8"
  id="pcDriverLogin" data-pc-modal tabindex="-1" role="dialog" aria-labelledby="pcDriverLoginLabel" aria-hidden="true">
  <div class="tw-mx-auto tw-flex tw-min-h-full tw-max-w-[430px] tw-items-center tw-opacity-0 tw-translate-y-3 tw-transition-[opacity,transform] tw-duration-200 [.is-open_&]:tw-opacity-100 [.is-open_&]:tw-translate-y-0 motion-reduce:tw-transition-none">
    <div class="tw-w-full tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.25)]">

      <div class="tw-p-6 sm:tw-p-8">
        <div class="tw-mb-5 tw-flex tw-items-start tw-justify-between tw-gap-4">
          <div>
            <p class="tw-mb-1 tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] tw-text-power">Driver training</p>
            <h2 class="tw-mb-0 tw-text-xl tw-font-bold tw-leading-snug tw-text-ink" id="pcDriverLoginLabel">Sign in to continue</h2>
          </div>
          <button type="button" data-pc-modal-close aria-label="Close"
            class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-black/[0.05] tw-text-ink/70 tw-transition-colors hover:tw-bg-black/10 hover:tw-text-ink">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 3l10 10M13 3L3 13"/></svg>
          </button>
        </div>

        <p class="<?= $pcBodySm ?> tw-mb-6">
          Use the same email and password as the PowerCabs driver app.
        </p>

        <?php  ?>
        <form data-pc-driver-login-form data-no-ajax method="post" action="<?= $assetPath ?>/driver-auth" novalidate class="tw-m-0">
          <input type="hidden" name="action" value="login">

          <div data-pc-login-error hidden role="alert"
            class="tw-mb-4 tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700"></div>

          <div class="tw-mb-4">
            <label class="<?= $pcLabel ?>" for="pcDlEmail">Email</label>
            <input class="<?= $pcInput ?>" type="email" id="pcDlEmail" name="email" autocomplete="username"
              inputmode="email" required placeholder="you@example.com">
          </div>

          <div class="tw-mb-6">
            <label class="<?= $pcLabel ?>" for="pcDlPassword">Password</label>
            <div class="tw-relative">
              <input class="<?= $pcInput ?> tw-pr-11" type="password" id="pcDlPassword" name="password"
                autocomplete="current-password" required>
              <button type="button" data-pc-password-toggle data-target="pcDlPassword"
                class="tw-absolute tw-right-1 tw-top-1/2 tw--translate-y-1/2 tw-inline-flex tw-h-8 tw-w-9 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-md tw-border-0 tw-bg-transparent tw-text-ink/45 tw-transition-colors hover:tw-text-ink"
                aria-label="Show password" aria-pressed="false">
                <svg data-eye-on class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12z"/><circle cx="12" cy="12" r="3"/></svg>
                <svg data-eye-off hidden class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18M10.6 10.7a2 2 0 002.8 2.8"/><path d="M6.9 6.9C4.2 8.6 2.5 12 2.5 12S6 18.5 12 18.5c1.6 0 3-.4 4.2-1M17.8 16A12.5 12.5 0 0021.5 12S18 5.5 12 5.5c-.6 0-1.2.1-1.7.2"/></svg>
              </button>
            </div>
          </div>

          <button type="submit" data-pc-login-submit class="<?= $pcBtnPrimary ?> tw-w-full tw-cursor-pointer">
            <span data-label>Sign in</span>
          </button>
        </form>

        <p class="tw-mb-0 tw-mt-5 tw-text-center tw-text-[0.82rem] tw-text-muted">
          Not driving with us yet?
          <a class="tw-font-semibold tw-text-power tw-no-underline hover:tw-underline" href="<?= $assetPath ?>/drive">Apply to drive</a>
        </p>
      </div>

    </div>
  </div>
</div>
