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

<section class="pc-app-promo position-relative z-2 pc-app-promo-standalone">
  <div class="pc-app-promo-container position-relative">
    <div class="row align-items-center gy-5">
      <div class="col-lg-9 order-lg-2">
        <h2 class="mb-3" style="color: var(--pc-dark); font-size: clamp(1.85rem, 4.5vw, 2.6rem);">
          Download the PowerCabs App for Instant Access
        </h2>
        <p class="mb-4" style="max-width: 46ch; color: rgba(28, 20, 16, 0.72); font-size: 1.1rem;">
          Booking a cab with PowerCabs is now easier than ever. Download our app today
          from the App Store or Google Play and enjoy the convenience of booking a cab
          with just a few taps.</p>
        <div class="d-flex flex-wrap gap-2 mb-4">
          <a class="pc-store-badge pc-store-badge-lg d-inline-flex align-items-center text-decoration-none" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" aria-hidden="true">
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow d-block text-uppercase">Get it on</span>
              <span class="pc-store-badge-title d-block fw-bold text-white">Google Play</span>
            </span></a>
          <a class="pc-store-badge pc-store-badge-lg d-inline-flex align-items-center text-decoration-none" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
            <i class="bi bi-apple text-white fs-5" aria-hidden="true"></i>
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow d-block text-uppercase">Download on the</span>
              <span class="pc-store-badge-title d-block fw-bold text-white">App Store</span>
            </span></a>
        </div>
        <p class="fw-bold mb-0" style="color: var(--pc-dark);">Buckle up Ireland!</p>
      </div>
    </div>
  </div>
</section>

