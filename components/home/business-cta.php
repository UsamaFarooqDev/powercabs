<?php
$bizChecks = ['One account', 'Monthly billing', 'Airport transfers', 'Multiple users', 'Journey history', 'Business support'];
?>
<!-- ============ Section 08 -- Business / Corporate ============ -->
<section class="tw-relative tw-bg-ink tw-py-20 sm:tw-py-28 tw-overflow-hidden">
  <div class="container tw-relative">
    <div class="tw-grid lg:tw-grid-cols-2 tw-gap-14 tw-items-center">
      <div class="pc-reveal">
        <p class="tw-inline-flex tw-items-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-text-powerlight tw-mb-4">
          <span class="tw-inline-block tw-w-6 tw-h-px tw-bg-powerlight"></span>
          PowerCabs Business
        </p>
        <h2 class="tw-font-extrabold tw-text-white tw-leading-[0.95] tw-tracking-tight tw-text-[clamp(2.3rem,5.6vw,4rem)] tw-mb-5">
          Move your business.
        </h2>
        <p class="tw-text-white/55 tw-text-[1.05rem] tw-mb-8 tw-max-w-[42ch]">
          Reliable taxi travel for your employees, clients and guests &mdash;
          with one business account, simple billing and complete journey
          visibility.
        </p>

        <ul class="tw-list-none tw-grid tw-grid-cols-2 tw-gap-x-6 tw-gap-y-3 tw-m-0 tw-p-0 tw-mb-9">
          <?php foreach ($bizChecks as $check): ?>
            <li class="tw-flex tw-items-center tw-gap-2 tw-text-white/75 tw-text-[.92rem]">
              <i class="bi bi-check-circle-fill tw-text-power tw-flex-shrink-0" aria-hidden="true"></i>
              <?= htmlspecialchars($check) ?>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-4">
          <a class="btn btn-pc-primary tw-rounded-full tw-px-5 tw-py-3 tw-no-underline" href="<?= $assetPath ?>/business">
            Open a Free Business Account
          </a>
          <a class="tw-text-white/70 hover:tw-text-white tw-text-[.92rem] tw-no-underline tw-inline-flex tw-items-center tw-gap-2 tw-transition-colors" href="tel:+35312030727">
            <i class="bi bi-telephone-fill" aria-hidden="true"></i> +353 12 03 0727
          </a>
        </div>
      </div>

      <div class="pc-reveal tw-relative tw-aspect-[4/3] tw-rounded-2xl tw-overflow-hidden">
        <img src="<?= $assetPath ?>assets/img/services_rides.png" alt="A PowerCabs business team reviewing routes together" class="tw-w-full tw-h-full tw-object-cover" loading="lazy">
      </div>
    </div>
  </div>
</section>
