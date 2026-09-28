<?php
/**
 * Homepage -- the one block addressed to people who want to WORK with
 * PowerCabs rather than ride with it. Businesses on the left, drivers on the
 * right.
 *
 * This replaces two separate full-width dark bands, business-band.php and
 * driver-band.php, which ran 759px and 520px with a single 445px white
 * section between them. Two near-identical ink slabs 445px apart is what §26
 * means by repeated dark panels: dark stops reading as emphasis the moment it
 * is the second one on the same screen. Bolt does the same consolidation --
 * its four earning options (driver, courier, merchant, fleet) share one
 * section rather than taking a band each.
 *
 * Both audiences keep their own eyebrow, headline, copy and call to action, so
 * nothing is being merged into a compromise message -- they are simply
 * sharing one surface and one heading instead of interrupting the rider
 * narrative twice.
 *
 * The two photographs the old bands carried are gone. They were decorative
 * here (a stock meeting shot and a driver at the wheel), and both destinations
 * lead with their own photography. Measured, the merge takes 1279px to ~600px.
 *
 * Dropping this back to two sections means restoring the deleted components
 * from git -- do not rebuild them by hand.
 */
/* Both lists restate copy the destination pages already publish, so the
   homepage cannot promise something /business or /drive does not:
     business -- components/business/account-benefits.php and booking-process.php
     driver   -- drive.php's own hero ("no joining fee, no monthly subscription,
                 commission only on the jobs you actually complete") and its
                 support band ("24/7", "real people, based here"). */
$businessPoints = [
  'Every journey your team takes, on a single account.',
  'One invoice instead of a month of receipts.',
  'Ride history and reporting whenever you need it.',
];
$driverPoints = [
  'No joining fee and no monthly subscription.',
  'Commission only on the jobs you complete.',
  'Driver support from a team based here, 24/7.',
];
?>
<!-- ============ Work with PowerCabs ============ -->
<section class="tw-relative tw-overflow-hidden tw-bg-ink tw-text-white <?= $pcSection ?>">
  <div class="tw-relative <?= $pcContainer ?>">

    <div class="tw-mb-12 tw-max-w-[46ch]">
      <p class="<?= $pcEyebrowOnDark ?>">Work with us</p>
      <h2 class="<?= pc_mb($pcH2OnDark, 'tw-mb-0') ?>">Two ways to work with PowerCabs.</h2>
    </div>

    <?php /* A hairline between the columns rather than a box around each: the
             two halves are distinct audiences, not two products to compare, so
             they need separating and not bounding. It becomes a top border
             when the columns stack on a phone. */ ?>
    <div class="tw-grid tw-grid-cols-1 tw-gap-10 lg:tw-grid-cols-2 lg:tw-gap-16">

      <div class="tw-border-0 tw-border-t tw-border-solid tw-border-white/15 tw-pt-8 lg:tw-border-t-0 lg:tw-border-r lg:tw-pr-16 lg:tw-pt-0">
        <p class="<?= pc_mb($pcEyebrowOnDark, 'tw-mb-2') ?>">Business</p>
        <h3 class="<?= pc_mb($pcH2OnDark, 'tw-mb-3') ?> tw-text-[clamp(1.5rem,2.2vw,1.875rem)]">Move your business forward.</h3>
        <p class="<?= $pcBodyOnDark ?> tw-mb-6 tw-max-w-[42ch]">
          Corporate travel that is easier to book, manage and account for &mdash;
          without the expense-claim paperwork at the end of it.
        </p>
        <ul class="tw-mb-8 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
          <?php foreach ($businessPoints as $point): ?>
            <li class="tw-flex tw-items-start tw-gap-3 tw-text-[0.9375rem] tw-leading-[1.6] tw-text-white/[0.72]">
              <svg class="tw-mt-[3px] tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12.5l5 5L20 6.5"/></svg>
              <?= htmlspecialchars($point) ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-3">
          <a class="<?= $pcBtnPrimaryOnDark ?>" href="<?= $assetPath ?>/business">Explore business</a>
          <a class="<?= $pcBtnOutlineLight ?>" href="<?= $assetPath ?>/corporate-services">Corporate services</a>
        </div>
      </div>

      <div class="tw-border-0 tw-border-t tw-border-solid tw-border-white/15 tw-pt-8 lg:tw-border-t-0 lg:tw-pt-0">
        <p class="<?= pc_mb($pcEyebrowOnDark, 'tw-mb-2') ?>">Drive with PowerCabs</p>
        <h3 class="<?= pc_mb($pcH2OnDark, 'tw-mb-3') ?> tw-text-[clamp(1.5rem,2.2vw,1.875rem)]">Make the city your workplace.</h3>
        <p class="<?= $pcBodyOnDark ?> tw-mb-6 tw-max-w-[42ch]">
          Work the hours that suit you, keep more of what you earn, and get
          support from a team in the same city.
        </p>
        <ul class="tw-mb-8 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
          <?php foreach ($driverPoints as $point): ?>
            <li class="tw-flex tw-items-start tw-gap-3 tw-text-[0.9375rem] tw-leading-[1.6] tw-text-white/[0.72]">
              <svg class="tw-mt-[3px] tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12.5l5 5L20 6.5"/></svg>
              <?= htmlspecialchars($point) ?>
            </li>
          <?php endforeach; ?>
        </ul>
        <a class="<?= $pcBtnPrimaryOnDark ?>" href="<?= $assetPath ?>/drive">Become a driver</a>
      </div>

    </div>
  </div>
</section>
