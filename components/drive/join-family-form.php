<?php

$driveOld ??= ['name' => '', 'mobile' => '', 'email' => '', 'licence' => ''];
$driveFormStatus ??= null;
$driveFormError ??= '';

// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = 'pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink';
$submitClass = $pcBtnPrimary . ' tw-w-full';
?>
<!-- ============ "You're not just a driver. You're family." ============ -->
<section class="tw-relative tw-overflow-hidden tw-bg-[linear-gradient(155deg,#1c1410_0%,#2a1a10_55%,#160f0a_100%)] tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">

      <!-- Left: copy -->
      <div>
        <span class="tw-mb-4 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-px-3.5 tw-py-1.5 tw-text-xs tw-font-semibold tw-text-white">
          <span class="tw-font-bold">IE</span>
          Irish Taxi Platform &bull; Driver First
        </span>

        <h2 class="tw-mb-3 tw-text-[clamp(2.1rem,4vw,3.1rem)] tw-font-bold tw-leading-[1.14] tw-tracking-[-0.02em] tw-text-white">
          You're not just a driver,<br>
          <span class="tw-text-powerlight">You're family.</span>
        </h2>
        <p class="tw-mb-0 tw-max-w-[46ch] tw-text-[1.08rem] tw-leading-[1.7] tw-text-white/75">
          Your taxi. Your meter. Your choice. Earn properly, avoid platform-created
          Saver pricing, save on the costs of driving and get real local support.
        </p>
      </div>

      <!-- Right: application form -->
      <div>
        <div class="tw-mx-auto tw-w-full tw-max-w-[480px] tw-rounded-2xl tw-bg-white tw-p-6 tw-shadow-[0_24px_60px_rgba(0,0,0,0.35)] md:tw-p-9" id="driveJoinForm">
          <h3 class="tw-mb-1 tw-text-lg tw-font-bold tw-text-ink">Start Your Application</h3>
          <p class="tw-mb-6 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">
            Add PowerCabs to your driving &mdash; you don't necessarily have to leave other platforms.
          </p>

          <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4">
            <input type="hidden" name="form_type" value="driver_join">

            <div>
              <label class="<?= $labelClass ?>" for="djName">First Name</label>
              <input type="text" class="<?= $inputClass ?>" id="djName" name="name"
                value="<?= htmlspecialchars($driveOld['name']) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="djMobile">Mobile Number</label>
              <input type="tel" class="<?= $inputClass ?>" id="djMobile" name="mobile"
                value="<?= htmlspecialchars($driveOld['mobile']) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="djEmail">Email Address</label>
              <input type="email" class="<?= $inputClass ?>" id="djEmail" name="email"
                value="<?= htmlspecialchars($driveOld['email']) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="djLicence">SPSV / Driver Licence</label>
              <input type="text" class="<?= $inputClass ?>" id="djLicence" name="licence"
                value="<?= htmlspecialchars($driveOld['licence']) ?>" required>
            </div>

            <div class="tw-pt-2">
              <button type="submit" class="<?= $submitClass ?>">
                <span>Start my Application</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
              </button>
            </div>

            <?php if ($driveFormStatus === 'success'): ?>
              <div class="alert-success tw-rounded-md tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your application has been sent. Our team will be in touch shortly.</div>
            <?php elseif ($driveFormStatus === 'error'): ?>
              <div class="alert-danger tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars($driveFormError) ?></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
