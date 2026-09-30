<?php
$paymentSolutions = [
  [
    'img' => 'Affordable-Payment-Solutions.webp',
    'title' => 'Affordable Payment Solutions for Every Business',
    'desc' => 'Whether you run a restaurant, cafe, or any growing business, PowerCabs & NPI give you straightforward payment processing at the lowest rates in Ireland.',
  ],
  [
    'img' => 'Accept-Card-Payments.webp',
    'title' => 'Accept Card Payments in Your Taxi - Fast & Easy',
    'desc' => "PowerCabs' card terminal is perfect for taxi drivers. Accept contactless payments from passengers instantly and get your funds next day.",
  ],
  [
    'img' => 'Shop-Revenue.webp',
    'title' => 'Grow Your Shop Revenue with Smarter Payments',
    'desc' => 'Our EPOS & card terminal solution helps retail shop owners manage sales, inventory, and payments all in one place.',
  ],
];
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Let's Save Together and Grow the Business</h2>
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
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
