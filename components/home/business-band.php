<?php
/**
 * Homepage §08 -- business, on the page's dark section.
 *
 * One of only two dark bands on the homepage (this and the final CTA), which
 * is what keeps §19's rhythm working: dark is for emphasis, and it stops
 * being emphasis the moment it is the fourth dark section in a row.
 *
 * The three points are lifted from components/business/account-benefits.php
 * and booking-process.php rather than written fresh, so the homepage and the
 * business page make the same promises in the same words.
 */
$businessPoints = [
  ['title' => 'One account', 'body' => 'Every journey your team takes, on a single account.'],
  ['title' => 'Monthly billing', 'body' => 'One invoice instead of a month of receipts.'],
  ['title' => 'Full visibility', 'body' => 'Ride history and reporting whenever you need it.'],
];
?>
<section class="tw-relative tw-overflow-hidden tw-bg-ink tw-text-white <?= $pcSection ?>">
  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-12 lg:tw-grid-cols-12 lg:tw-gap-16">

      <div class="lg:tw-col-span-5">
        <p class="<?= $pcEyebrowOnDark ?>">Business</p>
        <h2 class="<?= $pcH2OnDark ?> tw-max-w-[14ch]">Move your business forward.</h2>
        <p class="<?= $pcBodyOnDark ?> tw-mb-8 tw-max-w-[42ch]">
          Corporate travel that is easier to book, manage and account for &mdash;
          without the expense-claim paperwork at the end of it.
        </p>
        <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-4">
          <a class="<?= $pcBtnPrimaryOnDark ?>" href="<?= $assetPath ?>/business">Explore business</a>
          <a class="<?= $pcBtnOutlineLight ?>" href="<?= $assetPath ?>/corporate-services">Corporate services</a>
        </div>
      </div>

      <div class="lg:tw-col-span-7">
        <div class="tw-grid tw-grid-cols-1 tw-gap-px tw-overflow-hidden tw-rounded-card tw-bg-white/10 sm:tw-grid-cols-3">
          <?php foreach ($businessPoints as $point): ?>
            <?php /* gap-px over a translucent background draws the dividers,
                     so there is no border utility fighting the rounded corner
                     at each end. */ ?>
            <div class="tw-bg-ink tw-p-6">
              <h3 class="tw-mb-2 tw-text-[1.0625rem] tw-font-bold tw-leading-snug tw-text-white"><?= htmlspecialchars($point['title']) ?></h3>
              <p class="tw-mb-0 tw-text-[0.9375rem] tw-leading-[1.6] tw-text-white/[0.68]"><?= htmlspecialchars($point['body']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="tw-group tw-mt-6 tw-aspect-[16/9] tw-overflow-hidden tw-rounded-card tw-bg-white/[0.04]">
          <img src="<?= $assetPath ?>assets/img/services_rides.webp"
            alt="A PowerCabs account team reviewing journey routes with a business client."
            width="2004" height="1536" loading="lazy" decoding="async"
            class="<?= $pcImgCover ?> <?= $pcImgZoom ?>">
        </div>
      </div>
    </div>
  </div>
</section>
