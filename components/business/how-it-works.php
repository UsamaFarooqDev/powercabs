<?php
$bizHowSteps = [
  ['n' => '01', 'title' => 'Create Your Account', 'desc' => 'Sign up in minutes -- no paperwork, no waiting.'],
  ['n' => '02', 'title' => 'Add Your Team', 'desc' => 'Add the employees who need taxi travel to your account.'],
  ['n' => '03', 'title' => 'Start Travelling', 'desc' => 'Book taxis through PowerCabs, billed straight to your business.'],
];
$totalBizHowSteps = count($bizHowSteps);
?>
<!-- #pcBizHowItWorks / bare .pc-biz-step are JS hooks -- business-page.js's
     IntersectionObserver toggles .is-visible as each step scrolls into
     view, handled below via the `[&.is-visible]:` arbitrary variant. -->
<section class="tw-bg-gradient-to-b tw-from-white tw-to-paper-soft tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8" id="pcBizHowItWorks">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ How It Works</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Business Travel Without the Admin Headache.</h2>
    </div>

    <div class="tw-relative tw-grid tw-grid-cols-1 tw-gap-8 lg:tw-grid-cols-3 lg:tw-gap-4">
      <span class="tw-pointer-events-none tw-absolute tw-left-[16.667%] tw-right-[16.667%] tw-top-[1.625rem] tw-z-0 tw-hidden tw-h-px tw-bg-black/10 lg:tw-block" aria-hidden="true"></span>
      <?php foreach ($bizHowSteps as $i => $step): ?>
        <?php $isLast = $i === $totalBizHowSteps - 1; ?>
        <div class="pc-biz-step tw-relative tw-flex tw-gap-4 tw-opacity-0 tw-translate-y-5 tw-transition-all tw-duration-500 tw-ease-out [&.is-visible]:tw-opacity-100 [&.is-visible]:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-transition-none lg:tw-flex-col lg:tw-items-center">
          <div class="tw-flex tw-shrink-0 tw-flex-col tw-items-center">
            <span class="tw-relative tw-z-[1] tw-flex tw-h-[3.25rem] tw-w-[3.25rem] tw-items-center tw-justify-center tw-rounded-full tw-bg-ink tw-text-[1.05rem] tw-font-bold tw-text-white">
              <?= htmlspecialchars($step['n']) ?>
            </span>
            <?php if (!$isLast): ?>
              <span class="tw-my-2 tw-min-h-[2.5rem] tw-w-0.5 tw-flex-1 tw-bg-black/[0.14] lg:tw-hidden" aria-hidden="true"></span>
            <?php endif; ?>
          </div>
          <div class="tw-pl-3 tw-pt-1 lg:tw-pl-0 lg:tw-pt-4 lg:tw-text-center">
            <h3 class="tw-mb-1 tw-text-lg tw-font-bold tw-text-ink"><?= htmlspecialchars($step['title']) ?></h3>
            <p class="tw-mb-0 tw-text-ink/60"><?= htmlspecialchars($step['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
