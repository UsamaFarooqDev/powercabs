<?php
$paymentSolutions = [
  [
    'img' => 'Affordable-Payment-Solutions.webp',
    'title' => 'Affordable Payment Solutions for Every Business',
    'desc' => 'Whether you run a restaurant, cafe, or any growing business, PowerCabs & NPI give you straightforward payment processing at the lowest rates in Ireland.',
    'features' => ['Integrated delivery apps support', 'Real-time reporting & analytics', 'End-of-day transaction reports'],
  ],
  [
    'img' => 'Accept-Card-Payments.webp',
    'title' => 'Accept Card Payments in Your Taxi -- Fast & Easy',
    'desc' => "PowerCabs' card terminal is perfect for taxi drivers. Accept contactless payments from passengers instantly and get your funds next day.",
    'features' => ['Next day fund settlement', 'Accept Visa, Mastercard, Apple Pay & Google Pay', 'Low 0.8% transaction rate'],
  ],
  [
    'img' => 'Shop-Revenue.webp',
    'title' => 'Grow Your Shop Revenue with Smarter Payments',
    'desc' => 'Our EPOS & card terminal solution helps retail shop owners manage sales, inventory, and payments all in one place.',
    'features' => ['Integrated EPOS system', 'Contactless, Chip & PIN, Apple Pay & Google Pay', 'Dedicated local support team'],
  ],
];
?>
<section class="tw-bg-paper <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Let's Save Together and Grow the Business</h2>
      <p class="tw-mb-0 tw-text-ink/60">
        PowerCabs Ireland has joined New Payment Innovation, giving drivers and merchants
        access to the best, most affordable rates -- straightforward payment solutions
        tailored to your daily needs.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-3">
      <?php foreach ($paymentSolutions as $item): ?>
        <div class="tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)]">
          <div class="tw-aspect-[3/2] tw-overflow-hidden">
            <img src="<?= $assetPath ?>assets/img/<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
          </div>
          <div class="tw-p-6">
            <h3 class="tw-mb-2 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="tw-mb-3 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($item['desc']) ?></p>
            <p class="tw-mb-2 tw-text-[1.0625rem] tw-leading-relaxed tw-font-semibold tw-text-ink">Features:</p>
            <ul class="tw-m-0 tw-flex tw-flex-col tw-gap-1 tw-p-0">
              <?php foreach ($item['features'] as $feature): ?>
                <li class="tw-flex tw-gap-2 tw-text-sm">
                  <svg class="tw-mt-0.5 tw-h-4 tw-w-4 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>
                  <span class="tw-text-ink/60"><?= htmlspecialchars($feature) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
