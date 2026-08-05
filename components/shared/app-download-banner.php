<?php
$playStoreTarget = 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger';
$playStoreQrSrc   = 'https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=6&data=' . rawurlencode($playStoreTarget);

$appStoreTarget = 'https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981';
$appStoreQrSrc  = 'https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=6&data=' . rawurlencode($appStoreTarget);
?>
<style>
  @keyframes pcLiveTrackPulse {
    0%   { transform: scale(1);   opacity: .55; }
    70%  { transform: scale(1.9); opacity: 0;   }
    100% { transform: scale(1.9); opacity: 0;   }
  }
</style>

<section class="pc-app-promo pc-app-promo-standalone">
  <div class="pc-app-promo-container position-relative">
    <div class="row align-items-center gy-5">
      <div class="col-lg-9 order-lg-2">
        <h1 class="mb-3" style="color: var(--pc-dark);" style="font-size: 2.6rem;">
          Download the PowerCabs App for Instant Access
        </h1>
        <p class="mb-4" style="max-width: 46ch; color: rgba(28, 20, 16, 0.72); font-size: 1.1rem;">
          Booking a cab with PowerCabs is now easier than ever. Download our app today
          from the App Store or Google Play and enjoy the convenience of booking a cab
          with just a few taps.</p>
        <div class="d-flex flex-wrap gap-2 mb-4">
          <a class="pc-store-badge pc-store-badge-lg" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" aria-hidden="true">
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow">Get it on</span>
              <span class="pc-store-badge-title">Google Play</span>
            </span></a>
          <a class="pc-store-badge pc-store-badge-lg" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
            <i class="bi bi-apple text-white fs-5" aria-hidden="true"></i>
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow">Download on the</span>
              <span class="pc-store-badge-title">App Store</span>
            </span></a>
        </div>
        <p class="fw-bold mb-0" style="color: var(--pc-dark);">Buckle up Ireland!</p>
      </div>
    </div>
  </div>
</section>

