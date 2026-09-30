<?php
$bizPlans = [
  [
    'name' => 'Small Business',
    'range' => '1&ndash;10 employees',
    'features' => ['Business account', 'Multiple users', 'Easy booking'],
    'cta' => 'Get Started',
    'href' => '#business-booking-form',
    'featured' => false,
  ],
  [
    'name' => 'Business Plus',
    'range' => '10&ndash;50 employees',
    'features' => ['Monthly billing', 'Journey reports', 'Priority service'],
    'cta' => 'Get Started',
    'href' => '#business-booking-form',
    'featured' => true,
  ],
  [
    'name' => 'Corporate',
    'range' => '50+ employees',
    'features' => ['Dedicated account support', 'Custom travel solutions', 'Corporate support'],
    'cta' => 'Contact Us',
    'href' => $assetPath . '/corporate-services',
    'featured' => false,
  ],
];
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-12 tw-max-w-[680px] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Business Plans</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Built for Businesses of All Sizes</h2>
      <p class="<?= $pcBody ?> tw-mx-auto tw-mb-0 tw-max-w-[56ch]">
        From a handful of employees to a whole organisation, PowerCabs Business
        scales with your team &mdash; these are service tiers, not price bands.
      </p>
    </div>

    <div class="tw-mx-auto tw-grid tw-max-w-[1100px] tw-grid-cols-1 tw-gap-5 md:tw-grid-cols-3 lg:tw-gap-6">
      <?php foreach ($bizPlans as $plan): ?>
        <?php $featured = $plan['featured']; ?>
        <div class="tw-flex tw-h-full tw-flex-col tw-rounded-2xl tw-p-7 tw-transition-shadow tw-duration-300 motion-reduce:tw-transition-none sm:tw-p-8 <?= $featured
          ? 'tw-bg-ink tw-text-white tw-shadow-[0_24px_55px_-22px_rgba(28,20,16,0.5)]'
          : 'tw-border tw-border-solid tw-border-hairline hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.08)]' ?>">

          <div class="tw-mb-4 tw-flex tw-h-6 tw-items-center tw-justify-between tw-gap-3">
            <span class="tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] <?= $featured
              ? 'tw-text-white/45'
              : 'tw-text-muted' ?>"><?= $plan['range'] ?></span>
            <?php if ($featured): ?>
              <span class="tw-whitespace-nowrap tw-rounded-full tw-bg-power/[0.18] tw-px-2.5 tw-py-1 tw-text-[0.65rem] tw-font-bold tw-uppercase tw-tracking-[0.1em] tw-text-powerlight">Most Popular</span>
            <?php endif; ?>
          </div>

          <h3 class="tw-mb-6 tw-text-[1.625rem] tw-font-bold tw-tracking-[-0.02em] <?= $featured
            ? 'tw-text-white'
            : 'tw-text-ink' ?> sm:tw-text-[1.75rem]"><?= htmlspecialchars($plan['name']) ?></h3>

          <ul class="tw-m-0 tw-mb-8 tw-list-none tw-p-0">
            <?php foreach ($plan['features'] as $i => $feature): ?>
              <li class="tw-flex tw-items-start tw-gap-3 tw-py-3 <?= $i > 0
                ? ($featured
                  ? 'tw-border-0 tw-border-t tw-border-solid tw-border-white/10'
                  : 'tw-border-0 tw-border-t tw-border-solid tw-border-hairline')
                : '' ?>">
                <svg class="tw-mt-[0.2rem] tw-h-4 tw-w-4 tw-shrink-0 <?= $featured
                  ? 'tw-text-powerlight'
                  : 'tw-text-power' ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
                <span class="tw-text-[0.9375rem] tw-leading-snug <?= $featured
                  ? 'tw-text-white/[0.78]'
                  : 'tw-text-ink' ?>"><?= htmlspecialchars($feature) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <a class="tw-mt-auto tw-inline-flex tw-w-full tw-items-center tw-justify-center tw-gap-2 tw-rounded-full tw-px-6 tw-py-3 tw-text-sm tw-font-semibold tw-no-underline tw-transition tw-duration-300 motion-reduce:tw-transition-none <?= $featured
            ? 'tw-bg-power tw-text-white hover:tw-shadow-[0_12px_28px_rgba(255,122,0,0.38)]'
            : 'tw-border tw-border-solid tw-border-ink/20 tw-text-ink hover:tw-border-ink hover:tw-bg-ink hover:tw-text-white' ?>" href="<?= htmlspecialchars(
  $plan['href'],
) ?>">
            <?= htmlspecialchars($plan['cta']) ?>
            <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
