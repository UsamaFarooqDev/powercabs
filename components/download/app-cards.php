<?php
/**
 * Download page: Passenger/Driver app download cards with QR codes.
 * Requires $assetPath from the including page.
 */

$playStoreTarget = 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger';
$appStoreTarget = 'https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981';

function pc_qr_src(string $target): string
{
  return 'https://api.qrserver.com/v1/create-qr-code/?size=220x220&margin=10&ecc=H&data=' . rawurlencode($target);
}

$appCards = [
  [
    'id' => 'passenger',
    'icon' => 'person',
    'title' => 'Passenger App',
    'desc' => 'Book rides, track your driver live, and pay cashlessly -- all in a few taps.',
    'playStore' => 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger',
    'appStore' => 'https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981',
  ],
  [
    'id' => 'driver',
    'icon' => 'car',
    'title' => 'Driver App',
    'desc' => 'Apply to drive, accept trips, and manage your earnings, all from one app.',
    'playStore' => 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.driver&pcampaignid=web_share',
    'appStore' => 'https://apps.apple.com/us/app/powercabs-driver/id6648774168',
  ],
];
?>

<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-justify-center tw-gap-6 md:tw-grid-cols-2 md:tw-max-w-[880px] md:tw-mx-auto">
      <?php foreach ($appCards as $card): ?>
        <div class="tw-flex tw-h-full tw-flex-col tw-items-center tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.06] tw-bg-white tw-p-6 tw-text-center tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)] sm:tw-p-8">
          <span class="tw-mb-4 tw-inline-flex tw-h-14 tw-w-14 tw-items-center tw-justify-center tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-text-power">
            <?php if ($card['icon'] === 'person'): ?>
              <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.964 0a9 9 0 10-11.964 0m11.964 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            <?php else: ?>
              <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
            <?php endif; ?>
          </span>
          <h2 class="tw-mb-3 tw-text-[1.375rem] tw-font-bold tw-leading-snug tw-tracking-[-0.01em] tw-text-ink"><?= htmlspecialchars($card['title']) ?></h2>
          <p class="tw-mb-6 tw-max-w-[32ch] tw-text-[1.0625rem] tw-leading-[1.7] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($card['desc']) ?></p>

          <div class="tw-relative tw-mb-5 tw-inline-block">
            <img
              src="<?= pc_qr_src($card['playStore']) ?>"
              width="180"
              height="180"
              class="tw-rounded-2xl"
              alt="QR code to download the PowerCabs <?= htmlspecialchars($card['title']) ?>"
            >
            <span class="tw-absolute tw-left-1/2 tw-top-1/2 tw-flex tw-h-[46px] tw-w-[46px] -tw-translate-x-1/2 -tw-translate-y-1/2 tw-items-center tw-justify-center tw-rounded-xl tw-bg-black tw-p-[7px] tw-shadow-[0_2px_10px_rgba(28,20,16,0.25)]">
              <img src="<?= $assetPath ?>assets/img/powercabs-horse-icon.png" alt="" class="tw-h-full tw-w-full tw-object-contain">
            </span>
          </div>

          <a class="tw-group/dl tw-mb-6 tw-inline-flex tw-items-center tw-gap-1 tw-text-[0.95rem] tw-font-semibold tw-text-power tw-no-underline tw-transition-colors tw-duration-200 hover:tw-text-powerdark" href="<?= htmlspecialchars($card['playStore']) ?>" target="_blank" rel="noopener">
            <span class="tw-underline-offset-4 group-hover/dl:tw-underline">Click here to Download</span>
            <svg class="tw-h-4 tw-w-4 tw-transition-transform tw-duration-200 group-hover/dl:tw-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
          </a>

          <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-center tw-gap-2.5">
            <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-lg tw-bg-ink tw-py-2 tw-pl-2 tw-pr-4 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="<?= htmlspecialchars($card['playStore']) ?>" target="_blank" rel="noopener">
              <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="18" height="18" aria-hidden="true">
              <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
                <span class="tw-text-[0.6rem] tw-uppercase tw-tracking-wide tw-text-white/75">Get it on</span>
                <span class="tw-text-sm tw-font-bold tw-text-white">Google Play</span>
              </span>
            </a>
            <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-lg tw-bg-ink tw-py-2 tw-pl-2.5 tw-pr-4 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="<?= htmlspecialchars($card['appStore']) ?>" target="_blank" rel="noopener">
              <svg class="tw-h-[18px] tw-w-[18px] tw-text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.365 1.43c0 1.14-.493 2.27-1.177 3.08-.744.88-1.99 1.56-2.987 1.56-.12 0-.24-.02-.312-.03-.014-.11-.03-.24-.03-.38 0-1.1.556-2.22 1.183-2.98.674-.82 1.888-1.44 2.882-1.48.019.083.03.163.03.24zM20.13 17.14c-.51 1.14-.75 1.65-1.42 2.65-.93 1.42-2.24 3.19-3.87 3.2-1.45.02-1.82-.94-3.79-.93-1.97.01-2.38.95-3.83.93-1.63-.02-2.87-1.61-3.8-3.03-2.6-3.96-2.87-8.6-1.27-11.08.85-1.32 2.29-2.15 3.86-2.16 1.41-.02 2.74.95 3.6.95.86 0 2.47-1.17 4.17-1 .71.03 2.7.29 3.98 2.17-.1.06-2.38 1.39-2.35 4.14.03 3.28 2.88 4.37 2.92 4.39-.03.09-.45 1.55-1.19 3.03z"/></svg>
              <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
                <span class="tw-text-[0.6rem] tw-uppercase tw-tracking-wide tw-text-white/75">Download on the</span>
                <span class="tw-text-sm tw-font-bold tw-text-white">App Store</span>
              </span>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
