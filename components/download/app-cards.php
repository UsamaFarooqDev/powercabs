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
    'icon' => 'bi-person-fill',
    'title' => 'Passenger App',
    'desc' => 'Book rides, track your driver live, and pay cashlessly -- all in a few taps.',
    'playStore' => 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger',
    'appStore' => 'https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981',
  ],
  [
    'id' => 'driver',
    'icon' => 'bi-car-front-fill',
    'title' => 'Driver App',
    'desc' => 'Apply to drive, accept trips, and manage your earnings, all from one app.',
    'playStore' => 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.driver&pcampaignid=web_share',
    'appStore' => 'https://apps.apple.com/us/app/powercabs-driver/id6648774168',
  ],
];
?>

<section class="section-pc">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <?php foreach ($appCards as $card): ?>
        <div class="col-md-6 col-lg-5">
          <div class="rounded-4 bg-white h-100 text-center p-4 p-md-5" style="box-shadow: var(--pc-shadow-sm);">
            <span class="pc-ride-type-icon rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 3.5rem; height: 3.5rem; font-size: 1.5rem;">
              <i class="bi <?= $card['icon'] ?>"></i>
            </span>
            <h2 class="fs-4 fw-bold mb-2"><?= htmlspecialchars($card['title']) ?></h2>
            <p class="small text-muted-pc mb-4"><?= htmlspecialchars($card['desc']) ?></p>

            <div class="position-relative d-inline-block mb-3">
              <img src="<?= pc_qr_src(
                $card['playStore'],
              ) ?>" width="180" height="180" class="rounded-5" alt="QR code to download the PowerCabs <?= htmlspecialchars(
  $card['title'],
) ?>">
              <span class="position-absolute top-50 start-50 translate-middle rounded-3 bg-black d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; padding: 7px; box-shadow: 0 2px 10px rgba(28, 20, 16, 0.25);">
                <img src="<?= $assetPath ?>assets/img/powercabs-horse-icon.png" alt="" class="w-100 h-100" style="object-fit: contain;">
              </span>
            </div>

            <p class="small fw-semibold mb-4">
              <a class="pc-form-link d-inline-flex align-items-center" href="<?= htmlspecialchars(
                $card['playStore'],
              ) ?>" target="_blank" rel="noopener">
                <span style="font-size: 1rem;">Click here to Download</span>
                <i class="bi bi-arrow-right-short fs-4 ms-1"></i></a>
            </p>

            <div class="d-flex flex-row flex-wrap justify-content-center gap-2">
              <a class="pc-store-badge justify-content-center" href="<?= htmlspecialchars(
                $card['playStore'],
              ) ?>" target="_blank" rel="noopener">
                <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="18" height="18" aria-hidden="true">
                <span class="d-flex flex-column text-start">
                  <span class="pc-store-badge-eyebrow">Get it on</span>
                  <span class="pc-store-badge-title">Google Play</span>
                </span>
              </a>
              <a class="pc-store-badge justify-content-center" href="<?= htmlspecialchars(
                $card['appStore'],
              ) ?>" target="_blank" rel="noopener">
                <i class="bi bi-apple text-white fs-6" aria-hidden="true"></i>
                <span class="d-flex flex-column text-start">
                  <span class="pc-store-badge-eyebrow">Download on the</span>
                  <span class="pc-store-badge-title">App Store</span>
                </span>
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
