<?php
$cityFacts = [
  ['icon' => 'bi-patch-check-fill', 'label' => 'Licensed &amp; Garda-vetted drivers'],
  ['icon' => 'bi-clock-fill', 'label' => 'Available 24/7, every day of the year'],
  ['icon' => 'bi-geo-alt-fill', 'label' => 'Dublin-based, Irish-owned'],
];
?>
<!-- ============ Section 02 -- The City in Motion ============ -->
<section class="tw-relative tw-bg-ink tw-overflow-hidden">
  <div class="tw-relative tw-h-[62vh] sm:tw-h-[78vh] tw-min-h-[420px] tw-w-full">
    <img src="<?= $assetPath ?>assets/img/welcome-section-bg.png" alt="A PowerCabs vehicle moving through Dublin at night"
      class="tw-absolute tw-inset-0 tw-w-full tw-h-full tw-object-cover tw-object-center" loading="lazy">
    <div class="tw-absolute tw-inset-0" style="background: linear-gradient(180deg, rgba(8,8,8,.15) 0%, rgba(8,8,8,.55) 65%, #080808 100%);"></div>

    <div class="tw-absolute tw-inset-0 tw-flex tw-items-end">
      <div class="container tw-pb-10 sm:tw-pb-16">
        <p class="pc-reveal tw-inline-flex tw-items-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-text-powerlight tw-mb-4">
          <span class="tw-inline-block tw-w-6 tw-h-px tw-bg-powerlight"></span>
          The City in Motion
        </p>
        <h2 class="pc-reveal tw-font-extrabold tw-text-white tw-leading-[0.95] tw-tracking-tight tw-text-[clamp(2.6rem,7.5vw,5.75rem)] tw-max-w-[18ch] tw-mb-0">
          The city is yours.
        </h2>
      </div>
    </div>
  </div>

  <div class="container tw-py-12 sm:tw-py-16">
    <div class="tw-grid lg:tw-grid-cols-3 tw-gap-10 lg:tw-gap-8 tw-items-start">
      <p class="pc-reveal lg:tw-col-span-2 tw-text-white/65 tw-text-[1.15rem] sm:tw-text-[1.3rem] tw-leading-relaxed tw-max-w-[52ch] tw-mb-0">
        Fast, reliable and professional rides across Ireland. Book licensed
        drivers anytime for airport transfers, business travel, family
        trips, parcels and much more &mdash; PowerCabs moves with the city,
        not against it.
      </p>

      <ul class="pc-reveal tw-list-none tw-flex tw-flex-col tw-gap-4 tw-m-0 tw-p-0">
        <?php foreach ($cityFacts as $fact): ?>
          <li class="tw-flex tw-items-center tw-gap-3 tw-text-white/80 tw-text-[.95rem]">
            <span class="tw-inline-flex tw-items-center tw-justify-center tw-w-9 tw-h-9 tw-rounded-full tw-bg-white/[0.06] tw-border tw-border-white/10 tw-flex-shrink-0">
              <i class="bi <?= $fact['icon'] ?> tw-text-power" aria-hidden="true"></i>
            </span>
            <?= $fact['label'] ?>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
