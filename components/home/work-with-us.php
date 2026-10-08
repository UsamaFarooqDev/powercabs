<?php
$businessPoints = [
  'Every journey your team takes, on a single account.',
  'One invoice instead of a month of receipts.',
  'Ride history and reporting whenever you need it.',
];
$driverPoints = [
  'No joining fee and no monthly subscription.',
  'Commission only on the jobs you complete.',
  'Driver support from a team based here, 24/7.',
];
?>

<section class="tw-relative tw-overflow-hidden tw-bg-ink tw-text-white <?= $pcSection ?>">
  <img src="<?= $assetPath ?>assets/img/welcome-section-bg.webp" alt="" aria-hidden="true"
    class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-origin-[24.5%_117%] tw-scale-150 tw-object-cover tw-object-center" loading="lazy" decoding="async">
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-[radial-gradient(17%_24%_at_80%_18%,rgba(10,7,5,0.28)_0%,rgba(10,7,5,0.74)_58%,rgba(10,7,5,0.92)_100%)]" aria-hidden="true"></span>

  <div class="tw-relative <?= $pcContainer ?>">

    <div class="tw-mb-12 tw-max-w-[46ch]">
      <p class="<?= $pcEyebrowOnDark ?>">Work with us</p>
      <!-- <h2 class="<?= pc_mb($pcH2OnDark, 'tw-mb-0') ?>">Two ways to work with PowerCabs.</h2> -->
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-10 lg:tw-grid-cols-2 lg:tw-gap-16">

      <div class="tw-border-0 tw-border-t tw-border-solid tw-border-white/15 tw-pt-8 lg:tw-border-t-0 lg:tw-border-r lg:tw-pr-16 lg:tw-pt-0">
        <span class="tw-mb-5 tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-2xl tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-text-powerlight tw-backdrop-blur-md" aria-hidden="true">
          <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.25 14.15v4.25a2 2 0 01-2 2H5.75a2 2 0 01-2-2v-4.25m16.5 0a2 2 0 00-2-2H5.75a2 2 0 00-2 2m16.5 0v-1.75a2 2 0 00-2-2H5.75a2 2 0 00-2 2v1.75M9 12.75V9.5A2.25 2.25 0 0111.25 7.25h1.5A2.25 2.25 0 0115 9.5v3.25"/></svg>
        </span>
        <p class="<?= pc_mb($pcEyebrowOnDark, 'tw-mb-2') ?>">Business</p>
        <h3 class="<?= pc_mb($pcH2OnDark, 'tw-mb-3') ?> tw-text-[clamp(1.5rem,2.2vw,1.875rem)]">Move your business forward.</h3>
        <p class="<?= $pcBodyOnDark ?> tw-mb-6 tw-max-w-[42ch]">
          Corporate travel that is easier to book, manage and account for &mdash;
          without the expense-claim paperwork at the end of it.
        </p>
        <ul class="tw-mb-8 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
          <?php foreach ($businessPoints as $point): ?>
            <li class="tw-flex tw-items-start tw-gap-3 tw-text-[0.9375rem] tw-leading-[1.6] tw-text-white/[0.72]">
              <svg class="tw-mt-[3px] tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12.5l5 5L20 6.5"/></svg>
              <?= htmlspecialchars($point) ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-3">
          <a class="<?= $pcBtnPrimaryOnDark ?>" href="<?= $assetPath ?>/business">Explore business</a>
          <a class="<?= $pcBtnOutlineLight ?>" href="<?= $assetPath ?>/corporate-services">Corporate services</a>
        </div>
      </div>

      <div class="tw-border-0 tw-border-t tw-border-solid tw-border-white/15 tw-pt-8 lg:tw-border-t-0 lg:tw-pt-0">
        <span class="tw-mb-5 tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-2xl tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-text-powerlight tw-backdrop-blur-md" aria-hidden="true">
          <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="2.6"/><path d="M12 14.6V21M9.75 10.7L4.2 7.5M14.25 10.7L19.8 7.5"/></svg>
        </span>
        <p class="<?= pc_mb($pcEyebrowOnDark, 'tw-mb-2') ?>">Drive with PowerCabs</p>
        <h3 class="<?= pc_mb($pcH2OnDark, 'tw-mb-3') ?> tw-text-[clamp(1.5rem,2.2vw,1.875rem)]">Make the city your workplace.</h3>
        <p class="<?= $pcBodyOnDark ?> tw-mb-6 tw-max-w-[42ch]">
          Work the hours that suit you, keep more of what you earn, and get
          support from a team in the same city.
        </p>
        <ul class="tw-mb-8 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
          <?php foreach ($driverPoints as $point): ?>
            <li class="tw-flex tw-items-start tw-gap-3 tw-text-[0.9375rem] tw-leading-[1.6] tw-text-white/[0.72]">
              <svg class="tw-mt-[3px] tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12.5l5 5L20 6.5"/></svg>
              <?= htmlspecialchars($point) ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <a class="<?= $pcBtnPrimaryOnDark ?>" href="<?= $assetPath ?>/drive">Become a driver</a>
      </div>

    </div>
  </div>
</section>
