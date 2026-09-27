<?php
$playStoreTarget = 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger';
$appStoreTarget = 'https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981';

/* The app promo band, required by 26 of the site's pages.
   Partner Programme used to tuck it up under the preceding section with a
   negative margin, to hide the band's torn top edge. That edge is gone (see
   below), so there is nothing left to tuck and every page now spaces it the
   same way -- a band sliding up under its neighbour would only overlap two
   backgrounds. The $bannerPage/$bannerPullsUp pair that drove it is gone
   with it. */

// Same badge recipe as components/drive/behind-wheel.php, in its large size.
$storeBadgeClass =
  'tw-inline-flex tw-w-fit tw-items-center tw-gap-[0.65rem] tw-rounded-lg tw-bg-ink tw-py-[0.65rem] tw-pl-[0.65rem] tw-pr-6 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black focus-visible:tw-bg-black';
$storeBadgeEyebrow =
  'tw-block tw-text-[0.6rem] tw-uppercase tw-leading-none tw-tracking-[0.02em] tw-text-white/75 max-[399px]:tw-text-[0.5rem]';
$storeBadgeTitle =
  'tw-block tw-text-[0.95rem] tw-font-bold tw-leading-[1.25] tw-text-white max-[399px]:tw-text-[0.72rem]';
$storeBadgeGlyph = 'tw-h-[22px] tw-w-[22px] tw-shrink-0 max-[399px]:tw-h-3.5 max-[399px]:tw-w-3.5';

/* COMPACT VARIANT. Set $bannerCompact = true before requiring this file.
 *
 * Ten pages closed with this orange panel and then, immediately below it, the
 * dark final CTA -- two full-width coloured slabs in a row, which is §30's
 * "too many CTAs" and §26's "don't make every section orange or black" in the
 * same 400px. The utility pages had the same panel as their entire ending,
 * which §11 says should be a SMALL closing CTA.
 *
 * The compact variant is one quiet row above the footer: same heading intent,
 * same two store links, no orange field and no second slab. Nothing is
 * removed -- a reader who wants the app still has both badges -- so this is a
 * composition change rather than a content cut. */
$bannerCompact = $bannerCompact ?? false;

if ($bannerCompact): ?>
<section class="tw-bg-white <?= $pcSectionTight ?>">
  <div class="<?= $pcContainer ?>">
    <div class="<?= $pcDivider ?> tw-flex tw-flex-col tw-gap-6 tw-pt-10 sm:tw-flex-row sm:tw-items-center sm:tw-justify-between">
      <div>
        <p class="tw-mb-1 tw-text-[1.0625rem] tw-font-bold tw-text-ink">Get the PowerCabs app</p>
        <p class="<?= $pcBodySm ?> tw-mb-0 tw-max-w-[46ch]">Book in seconds, track your driver door to door, and pay the fare you were quoted.</p>
      </div>
      <div class="tw-flex tw-flex-wrap tw-gap-2">
        <a class="<?= $storeBadgeClass ?>" href="<?= htmlspecialchars($playStoreTarget) ?>" target="_blank" rel="noopener">
          <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" class="<?= $storeBadgeGlyph ?>" aria-hidden="true">
          <span class="tw-flex tw-flex-col tw-text-left">
            <span class="<?= $storeBadgeEyebrow ?>">Get it on</span>
            <span class="<?= $storeBadgeTitle ?>">Google Play</span>
          </span>
        </a>
        <a class="<?= $storeBadgeClass ?>" href="<?= htmlspecialchars($appStoreTarget) ?>" target="_blank" rel="noopener">
          <svg class="<?= $storeBadgeGlyph ?> tw-text-white" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282z"/></svg>
          <span class="tw-flex tw-flex-col tw-text-left">
            <span class="<?= $storeBadgeEyebrow ?>">Download on the</span>
            <span class="<?= $storeBadgeTitle ?>">App Store</span>
          </span>
        </a>
      </div>
    </div>
  </div>
</section>
<?php unset($bannerCompact); return; endif; ?>
<?php /* This band appears on 26 of the site's pages, which made it the single
         biggest reason the site read as "orange everywhere". It used to be a
         full-bleed orange slab, 140px of vertical padding with a torn
         clip-path edge -- measured at 23% of the wheelchair-accessible page,
         16% of corporate-services and city-tours, against §33's 3-8% target
         for orange. One shared component, four pages over budget.

         Now: a light band with the orange CONTAINED in a panel. Same copy,
         same two store links, same eyebrow/title badge recipe -- only the
         area of orange changes, which is what the brief actually objects to.
         The torn clip-path went with it: §56 lists that kind of decorative
         edge among the trends that age badly, and it only existed to blend
         one slab into the next. */ ?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-8 tw-overflow-hidden tw-rounded-panel tw-bg-[linear-gradient(105deg,#fdb071_0%,#fb9748_35%,#f97316_100%)] tw-px-6 tw-py-10 md:tw-px-12 md:tw-py-12 lg:tw-grid-cols-12 lg:tw-gap-12">
    <div class="lg:tw-col-span-7">
      <h2 class="<?= $pcH2Small ?>">
        Download the PowerCabs App for Instant Access
      </h2>
      <p class="tw-mb-5 tw-max-w-[46ch] tw-text-[1.0625rem] tw-leading-[1.6] tw-text-ink/[0.72]">
        Booking a cab with PowerCabs is now easier than ever. Download our app today
        from the App Store or Google Play and enjoy the convenience of booking a cab
        with just a few taps.
      </p>
      <div class="tw-mb-4 tw-flex tw-flex-wrap tw-gap-2">
        <a class="<?= $storeBadgeClass ?>" href="<?= htmlspecialchars($playStoreTarget) ?>" target="_blank" rel="noopener">
          <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" class="<?= $storeBadgeGlyph ?>" aria-hidden="true">
          <span class="tw-flex tw-flex-col tw-text-left">
            <span class="<?= $storeBadgeEyebrow ?>">Get it on</span>
            <span class="<?= $storeBadgeTitle ?>">Google Play</span>
          </span>
        </a>
        <a class="<?= $storeBadgeClass ?>" href="<?= htmlspecialchars($appStoreTarget) ?>" target="_blank" rel="noopener">
          <svg class="<?= $storeBadgeGlyph ?> tw-text-white" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M11.182.008C11.148-.03 9.923.023 8.857 1.18c-1.066 1.156-.902 2.482-.878 2.516.024.034 1.52.087 2.475-1.258.955-1.345.762-2.391.728-2.43zm3.314 11.733c-.048-.096-2.325-1.234-2.113-3.422.212-2.189 1.675-2.789 1.698-2.854.023-.065-.597-.79-1.254-1.157a3.692 3.692 0 0 0-1.563-.434c-.108-.003-.483-.095-1.254.116-.508.139-1.653.589-1.968.607-.316.018-1.256-.522-2.267-.665-.647-.125-1.333.131-1.824.328-.49.196-1.422.754-2.074 2.237-.652 1.482-.311 3.83-.067 4.56.244.729.625 1.924 1.273 2.796.576.984 1.34 1.667 1.659 1.899.319.232 1.219.386 1.843.067.502-.308 1.408-.485 1.766-.472.357.013 1.061.154 1.782.539.571.197 1.111.115 1.652-.105.541-.221 1.324-1.059 2.238-2.758.347-.79.505-1.217.473-1.282z"/></svg>
          <span class="tw-flex tw-flex-col tw-text-left">
            <span class="<?= $storeBadgeEyebrow ?>">Download on the</span>
            <span class="<?= $storeBadgeTitle ?>">App Store</span>
          </span>
        </a>
      </div>
      <p class="tw-mb-0 tw-font-bold tw-text-ink">Buckle up Ireland!</p>
    </div>

      <?php /* The panel's right-hand half on desktop: three plain facts, as
               one piece of frosted glass sitting on the orange.

               It used to be three opaque #fca85f tiles separated by 1px gaps
               that let the darker parent show through as fake dividers -- a
               second solid block inside the first, in a slightly different
               orange, which read as a rendering mistake more than a panel.

               The glass is built from four things, and it needs all four or it
               just looks like a flat wash:
                 - a translucent white fill, so the gradient shows THROUGH it
                   and the tint shifts across its width
                 - backdrop-blur, which softens the gradient behind it
                 - a brighter white hairline, standing in for a lit edge
                 - an inset top highlight plus an outer drop shadow, which is
                   what gives it thickness and lifts it off the surface
               Dividers are real borders now rather than gaps, so nothing
               depends on the parent's colour showing through. */ ?>
      <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-white/40 tw-bg-white/20 tw-p-0 tw-backdrop-blur-md tw-shadow-[inset_0_1px_0_rgba(255,255,255,0.45),0_10px_30px_-12px_rgba(96,45,5,0.45)] sm:tw-grid-cols-3 lg:tw-col-span-5 lg:tw-grid-cols-1">
        <?php foreach ([
          ['Book', 'in seconds, on demand or in advance'],
          ['Track', 'your driver from door to door'],
          ['Pay', 'the fare you were quoted'],
        ] as $i => $step): ?>
          <?php /* The divider runs between the cells on whichever axis the
                   grid is on: a right border when the three sit in a row from
                   sm, a bottom border when they stack again at lg. */ ?>
          <li class="tw-border-0 tw-border-solid tw-border-white/25 tw-px-5 tw-py-4 <?= $i < 2
            ? 'tw-border-b sm:tw-border-b-0 sm:tw-border-r lg:tw-border-r-0 lg:tw-border-b'
            : '' ?>">
            <span class="tw-block tw-text-[1.0625rem] tw-font-bold tw-leading-none tw-text-ink"><?= $step[0] ?></span>
            <span class="tw-mt-1.5 tw-block tw-text-[0.875rem] tw-leading-snug tw-text-ink/[0.72]"><?= $step[1] ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>

<?php
/* Page globals: a later require on the same page must not inherit this. */
unset($bannerCompact);
