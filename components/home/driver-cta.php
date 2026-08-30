<?php
$driverPerks = [
  'Pay Per Hour', 'Long Trips', 'Fast Onboarding', 'Only 10% Commission', 'No Membership Fee', 'Irish Support',
];
?>
<!-- ============ Section 09 -- Driver ============ -->
<section class="tw-bg-paper tw-py-20 sm:tw-py-28 tw-overflow-hidden">
  <div class="container">
    <div class="tw-grid lg:tw-grid-cols-2 tw-gap-12 lg:tw-gap-14 tw-items-center">
      <div class="pc-reveal tw-relative tw-aspect-[4/3] tw-rounded-2xl tw-overflow-hidden">
        <img src="<?= $assetPath ?>assets/img/ahmed-pbs.jpg" alt="A PowerCabs driver at the wheel" class="tw-w-full tw-h-full tw-object-cover" loading="lazy">
      </div>

      <div class="pc-reveal">
        <p class="tw-inline-flex tw-items-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-mb-4" style="color: var(--pc-orange);">
          <span class="tw-inline-block tw-w-6 tw-h-px" style="background: var(--pc-orange);"></span>
          Drive with PowerCabs
        </p>
        <h2 class="tw-font-extrabold tw-leading-[0.98] tw-tracking-tight tw-text-[clamp(2.1rem,4.8vw,3.4rem)] tw-mb-4" style="color: var(--pc-dark);">
          Your car.<br>Your city.<br>Your shift.
        </h2>
        <p class="tw-text-[1.05rem] tw-mb-6" style="color: var(--pc-text-muted); max-width: 42ch;">
          Be your real boss &mdash; not just on paper. Flexible earning, with
          zero app charges for usage.
        </p>

        <div class="tw-flex tw-flex-wrap tw-gap-2 tw-mb-8">
          <?php foreach ($driverPerks as $perk): ?>
            <span class="tw-inline-flex tw-items-center tw-text-[.82rem] tw-font-medium tw-rounded-full tw-border tw-px-3 tw-py-1.5"
              style="color: var(--pc-dark); border-color: rgba(28,20,16,.14);">
              <?= htmlspecialchars($perk) ?>
            </span>
          <?php endforeach; ?>
        </div>

        <a class="btn btn-pc-primary tw-rounded-full tw-px-5 tw-py-3 tw-no-underline tw-inline-flex tw-items-center tw-gap-2" href="<?= $assetPath ?>/drive">
          Become a Driver <i class="bi bi-arrow-right" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
</section>
