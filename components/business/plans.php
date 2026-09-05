<?php
$bizPlans = [
  [
    'icon' => 'briefcase',
    'name' => 'Small Business',
    'range' => '1&ndash;10 employees',
    'features' => ['Business account', 'Multiple users', 'Easy booking'],
    'cta' => 'Get Started',
    'href' => '#business-booking-form',
    'featured' => false,
  ],
  [
    'icon' => 'briefcase-fill',
    'name' => 'Business Plus',
    'range' => '10&ndash;50 employees',
    'features' => ['Monthly billing', 'Journey reports', 'Priority service'],
    'cta' => 'Get Started',
    'href' => '#business-booking-form',
    'featured' => true,
  ],
  [
    'icon' => 'building',
    'name' => 'Corporate',
    'range' => '50+ employees',
    'features' => ['Dedicated account support', 'Custom travel solutions', 'Corporate support'],
    'cta' => 'Contact Us',
    'href' => $assetPath . '/corporate-services',
    'featured' => false,
  ],
];

function pc_biz_plan_icon(string $icon): void
{
  switch ($icon):
    case 'briefcase': ?>
      <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 14.15v4.25a2 2 0 01-2 2H5.75a2 2 0 01-2-2v-4.25m16.5 0a2 2 0 00-2-2H5.75a2 2 0 00-2 2m16.5 0v-1.75a2 2 0 00-2-2H5.75a2 2 0 00-2 2v1.75M9 12.75V9.5A2.25 2.25 0 0111.25 7.25h1.5A2.25 2.25 0 0115 9.5v3.25"/></svg>
    <?php break;
    case 'briefcase-fill': ?>
      <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.25 5.25v.443c-.741.014-1.481.048-2.221.096-1.024.067-1.848.914-1.848 1.921v.591M11.25 5.25V4.5a2.25 2.25 0 012.25-2.25h1.5a2.25 2.25 0 012.25 2.25v.75m-6-.007c1.163-.043 2.335-.05 3.508-.007m0 0c.741.014 1.481.048 2.221.096 1.024.067 1.848.914 1.848 1.921v.591m-9.75.35c1.163-.043 2.335-.05 3.508-.007M4.5 15.75h15M2.25 8.301c1.61-.334 3.263-.578 4.951-.723m0 0V6.25c0-1.007.823-1.854 1.848-1.921A50.293 50.293 0 0111.25 4.5m0 .75c1.163 0 2.335.05 3.508.093m-3.508-.093v.75"/></svg>
    <?php break;
    case 'building': ?>
      <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.75 21h16.5M4.5 3h15v18h-15V3zM9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
    <?php break;
  endswitch;
}
?>
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ Business Plans</p>
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Built for Businesses of All Sizes</h2>
      <p class="tw-mx-auto tw-mb-0 tw-max-w-[56ch] tw-text-[1.05rem] tw-text-ink/60">
        From a handful of employees to a whole organisation, PowerCabs Business
        scales with your team -- these are service tiers, not price bands.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-justify-center tw-gap-6 md:tw-grid-cols-3">
      <?php foreach ($bizPlans as $plan): ?>
        <div class="tw-relative tw-flex tw-h-full tw-flex-col tw-rounded-2xl tw-border tw-border-solid tw-bg-white tw-p-[clamp(1.75rem,3vw,2.25rem)] tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-shadow tw-duration-300 hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.1)] <?= $plan[
          'featured'
        ]
          ? 'tw-border-powerlight tw-shadow-[0_10px_25px_rgba(28,20,16,0.1)]'
          : 'tw-border-black/[0.08]' ?>">
          <?php if ($plan['featured']): ?>
            <span class="tw-absolute tw-left-1/2 tw-top-[-0.75rem] tw-inline-block -tw-translate-x-1/2 tw-whitespace-nowrap tw-rounded-full tw-bg-powerlight tw-px-3.5 tw-py-1.5 tw-text-[0.72rem] tw-font-bold tw-uppercase tw-tracking-[0.04em] tw-text-white">Most Popular</span>
          <?php endif; ?>

          <span class="tw-mb-3 tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-full tw-bg-paper tw-text-power">
            <?php pc_biz_plan_icon($plan['icon']); ?>
          </span>

          <h3 class="tw-mb-1 tw-text-2xl tw-font-bold tw-text-ink"><?= htmlspecialchars($plan['name']) ?></h3>
          <p class="tw-mb-6 tw-text-ink/60"><?= $plan['range'] ?></p>

          <ul class="tw-m-0 tw-mb-6 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0">
            <?php foreach ($plan['features'] as $feature): ?>
              <li class="tw-flex tw-items-center tw-gap-2">
                <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                <span><?= htmlspecialchars($feature) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>

          <a class="tw-mt-auto tw-inline-flex tw-w-full tw-items-center tw-justify-center tw-rounded-full tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition tw-duration-200 <?= $plan[
            'featured'
          ]
            ? 'tw-bg-powerlight tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]'
            : 'tw-bg-ink hover:tw-bg-ink-soft' ?>" href="<?= htmlspecialchars($plan['href']) ?>">
            <?= htmlspecialchars($plan['cta']) ?>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
