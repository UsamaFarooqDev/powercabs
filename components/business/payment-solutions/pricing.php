<?php
$pricingPlans = [
  [
    'n' => 1, 'name' => 'PAX A50', 'price' => '9.99', 'for' => 'Taxi industry & small retail shops',
    'features' => ['Unbeatable transaction rates from 0.8%', "Low card reader rental fee from \u{20ac}9.99", 'NFC contactless', 'Deliver receipts by SMS or email'],
    'featured' => false,
  ],
  [
    'n' => 2, 'name' => 'PAX A920', 'price' => '14.99', 'for' => 'Hospitality businesses',
    'features' => ['Unbeatable transaction rates from 0.8%', "Low card reader rental fee from \u{20ac}14.99", 'NFC contactless', 'Deliver receipts by SMS, email or paper roll'],
    'featured' => true,
  ],
  [
    'n' => 3, 'name' => 'EPOS', 'price' => '29.99', 'for' => 'Shops & retail industry',
    'features' => ['Unbeatable transaction rates from 0.8%', "Low card reader rental fee from \u{20ac}29.99 (ex VAT)", 'NFC contactless', 'Deliver receipts by SMS, email or paper roll'],
    'featured' => false,
  ],
];
$trustBadges = [
  ['icon' => 'people', 'label' => '100+ Drivers Onboarded'],
  ['icon' => 'building', 'label' => 'Trusted by Local Businesses'],
  ['icon' => 'card', 'label' => 'Thousands of Payments Processed'],
];
?>
<section class="tw-bg-paper <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[64ch] tw-text-center">
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Ready to Take Your Card Machine Journey to the Next Level?</h2>
      <p class="tw-mb-0 tw-text-ink/60">
        Our card reader payment solutions enable taxi drivers and hospitality businesses
        with secure, efficient and tailored card payment machine services.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-6 md:tw-grid-cols-3">
      <?php foreach ($pricingPlans as $plan): ?>
        <div class="tw-relative tw-rounded-2xl tw-bg-white tw-p-6 tw-pt-8 tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)] <?= $plan['featured'] ? 'tw-ring-2 tw-ring-power' : '' ?>">
          <?php if ($plan['featured']): ?>
            <span class="tw-absolute tw-right-4 tw-top-4 tw-whitespace-nowrap tw-rounded-full tw-bg-power tw-px-3.5 tw-py-1.5 tw-text-xs tw-font-semibold tw-text-white">Most Popular</span>
          <?php endif; ?>
          <div class="tw-mb-6 tw-text-center">
            <span class="tw-mb-3 tw-inline-flex tw-h-10 tw-w-10 tw-items-center tw-justify-center tw-rounded-full tw-bg-[rgba(245,132,31,0.1)] tw-text-sm tw-font-bold tw-text-power"><?= $plan['n'] ?></span>
            <h3 class="tw-mb-1 tw-text-xl tw-font-bold tw-text-ink"><?= htmlspecialchars($plan['name']) ?></h3>
            <p class="tw-mb-2 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($plan['for']) ?></p>
            <p class="tw-mb-0"><span class="tw-text-3xl tw-font-bold tw-text-power">&euro;<?= htmlspecialchars($plan['price']) ?></span><span class="tw-text-ink/60"> / starting from</span></p>
          </div>
          <ul class="tw-m-0 tw-mb-6 tw-flex tw-flex-col tw-gap-2 tw-p-0">
            <?php foreach ($plan['features'] as $feature): ?>
              <li class="tw-flex tw-gap-2 tw-text-sm">
                <svg class="tw-mt-0.5 tw-h-4 tw-w-4 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                <span class="tw-text-ink/60"><?= htmlspecialchars($feature) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
          <a href="#payment-apply-form" class="tw-block tw-w-full tw-rounded-full tw-px-6 tw-py-2.5 tw-text-center tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition-colors tw-duration-200 <?= $plan['featured'] ? 'tw-bg-powerlight hover:tw-bg-power' : 'tw-bg-ink hover:tw-bg-black' ?>">Choose Plan</a>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="tw-mt-10 tw-grid tw-grid-cols-1 tw-gap-4 tw-text-center md:tw-grid-cols-3">
      <?php foreach ($trustBadges as $badge): ?>
        <div class="tw-flex tw-items-center tw-justify-center tw-gap-2">
          <span class="tw-flex tw-h-10 tw-w-10 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[rgba(245,132,31,0.1)] tw-text-power">
            <?php switch ($badge['icon']):
              case 'people': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
              <?php break;
              case 'building': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
              <?php break;
              case 'card': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
              <?php break;
            endswitch; ?>
          </span>
          <span class="tw-text-sm tw-font-semibold tw-text-ink"><?= htmlspecialchars($badge['label']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
