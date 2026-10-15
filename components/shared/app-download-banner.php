<?php
$playStoreTarget = 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger';
$appStoreTarget = 'https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981';

$bannerCompact = null;

$bannerTitle ??= 'Get the PowerCabs app';
$bannerText ??= 'Book in seconds, track your driver door to door, and pay the fare you were quoted.';

$storeBadgeClass =
  'tw-inline-flex tw-w-fit tw-items-center tw-gap-[0.65rem] tw-rounded-lg tw-bg-ink tw-py-[0.65rem] tw-pl-[0.65rem] tw-pr-6 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black focus-visible:tw-bg-black';

$storeBadgeEyebrow =
  'tw-block tw-text-[0.6rem] tw-uppercase tw-leading-none tw-tracking-[0.02em] tw-text-white/75 max-[399px]:tw-text-[0.625rem]';
$storeBadgeTitle =
  'tw-block tw-text-[0.95rem] tw-font-bold tw-leading-[1.25] tw-text-white max-[399px]:tw-text-[0.72rem]';
$storeBadgeGlyph = 'tw-h-[22px] tw-w-[22px] tw-shrink-0 max-[399px]:tw-h-3.5 max-[399px]:tw-w-3.5';
?>
<section class="tw-bg-white <?= $pcSectionTight ?>">
  <div class="<?= $pcContainer ?>">
    <div class="<?= $pcDivider ?> tw-flex tw-flex-col tw-gap-6 tw-pt-10 sm:tw-flex-row sm:tw-items-center sm:tw-justify-between">
      <div>
        <p class="tw-mb-1 tw-text-[1.0625rem] tw-font-bold tw-text-ink"><?= htmlspecialchars($bannerTitle) ?></p>
        <p class="<?= $pcBodySm ?> tw-mb-0 tw-max-w-[46ch]"><?= htmlspecialchars($bannerText) ?></p>
      </div>
      <?php  ?>
      <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-4">
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
  </div>
</section>
<?php
unset($bannerCompact, $bannerTitle, $bannerText);
