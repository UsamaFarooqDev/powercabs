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
<?php /* A photograph behind the ink rather than flat ink.
 *
 * welcome-section-bg.webp is the view over a driver's shoulder with a
 * PowerCabs badge on the dashboard, and that badge is the only part of it that
 * has to survive: everything else is texture behind two columns of white type.
 *
 * ONE gradient layer, not two. A flat scrim plus a lighter "spotlight" on top
 * does not work -- two semi-transparent dark layers composite, so the second
 * one only ever makes the first darker. The single radial below opens to 0.46
 * over the badge (white artwork at 0.46 composites to about 130, clearly
 * legible) and closes to 0.92 everywhere else, which is darker than the flat
 * ink it replaced.
 *
 * THE BADGE HAD TO MOVE, and object-position could not do it. At its natural
 * crop the badge sits at about 61.5% across and 51% down -- directly under the
 * driver column's paragraph, so lifting the scrim enough to read it put a
 * bright patch behind white body text. The image and the section are almost
 * the same aspect (1.86 vs 1.90), so object-cover crops only ~16px vertically
 * and object-position has no slack to work with.
 *
 * scale + transform-origin does have slack. At scale 1.5 with the origin at
 * 24.5% 117%, a point p maps to o + (p - o) * 1.5, which puts the badge at
 * roughly 80% 18% -- the clear area to the right of the section heading, where
 * nothing else is. The radial's centre follows it there. Both numbers are
 * solved from those two equations, so if the image, the crop or the section's
 * proportions change, re-solve rather than nudge.
 *
 * bg-ink stays on the section as the base, so if the image 404s the block is
 * still dark and the white type still reads. */ ?>
<section class="tw-relative tw-overflow-hidden tw-bg-ink tw-text-white <?= $pcSection ?>">
  <img src="<?= $assetPath ?>assets/img/welcome-section-bg.webp" alt="" aria-hidden="true"
    class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-origin-[24.5%_117%] tw-scale-150 tw-object-cover tw-object-center" loading="lazy" decoding="async">
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-[radial-gradient(17%_24%_at_80%_18%,rgba(10,7,5,0.28)_0%,rgba(10,7,5,0.74)_58%,rgba(10,7,5,0.92)_100%)]" aria-hidden="true"></span>

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
        <?php /* A mark for each column, so the two halves are told apart at a
                 glance rather than only by reading their eyebrows. Glass over
                 the photograph -- the same white/[0.06] + hairline treatment
                 as the phone panel in components/shared/support-band.php, so
                 it sits on the image instead of punching a solid hole in it.
                 aria-hidden: the heading underneath already names the
                 audience, so announcing "briefcase" adds nothing. */ ?>
        <span class="tw-mb-5 tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-2xl tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-text-powerlight tw-backdrop-blur-md" aria-hidden="true">
          <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.25 14.15v4.25a2 2 0 01-2 2H5.75a2 2 0 01-2-2v-4.25m16.5 0a2 2 0 00-2-2H5.75a2 2 0 00-2 2m16.5 0v-1.75a2 2 0 00-2-2H5.75a2 2 0 00-2 2v1.75M9 12.75V9.5A2.25 2.25 0 0111.25 7.25h1.5A2.25 2.25 0 0115 9.5v3.25"/></svg>
        </span>
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
        <span class="tw-mb-5 tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-2xl tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-text-powerlight tw-backdrop-blur-md" aria-hidden="true">
          <?php /* A steering wheel, not a car: the column is addressed to the
                   person doing the driving, and a car is already the site's
                   mark for a ride. Hub r=2.6 inside a r=9 rim, with the three
                   spokes solved on that geometry (down, and out at 150/30
                   degrees) so they meet both circles instead of floating. */ ?>
          <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="2.6"/><path d="M12 14.6V21M9.75 10.7L4.2 7.5M14.25 10.7L19.8 7.5"/></svg>
        </span>
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
