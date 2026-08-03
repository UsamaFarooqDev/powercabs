<?php
$playStoreTarget = 'https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger';
$playStoreQrSrc   = 'https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=6&data=' . rawurlencode($playStoreTarget);

$appStoreTarget = 'https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981';
$appStoreQrSrc  = 'https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=6&data=' . rawurlencode($appStoreTarget);
?>
<!-- ============ App Download Banner (reusable, inner pages) ============ -->
<section class="py-5" style="background: var(--pc-cream-soft);">
  <div class="container">
    <h2 class="mb-4 fs-3 fw-bold">It's Easier in the App</h2>
    <div class="row g-3">
      <div class="col-md-6">
        <a href="<?= htmlspecialchars($playStoreTarget) ?>" target="_blank" rel="noopener" class="pc-app-strip-card d-flex align-items-center gap-3 bg-white rounded-3 px-3 px-md-5 py-2 py-md-3 text-decoration-none">
          <img src="<?= htmlspecialchars($playStoreQrSrc) ?>" alt="QR code to download the PowerCabs app on Google Play" width="110" height="110" class="rounded-2 flex-shrink-0">
          <span class="flex-grow-1">
            <span class="d-block fw-bold" style="color: var(--pc-dark);">Get It On Google Play</span>
            <span class="d-block small text-muted-pc">Scan to download</span>
          </span>
          <i class="bi bi-arrow-right-short fs-3" style="color: var(--pc-dark);" aria-hidden="true"></i>
        </a>
      </div>
      <div class="col-md-6">
        <a href="<?= htmlspecialchars($appStoreTarget) ?>" target="_blank" rel="noopener" class="pc-app-strip-card d-flex align-items-center gap-3 bg-white rounded-3 px-3 px-md-5 py-2 py-md-3 text-decoration-none">
          <img src="<?= htmlspecialchars($appStoreQrSrc) ?>" alt="QR code to download the PowerCabs app on the App Store" width="110" height="110" class="rounded-2 flex-shrink-0">
          <span class="flex-grow-1">
            <span class="d-block fw-bold" style="color: var(--pc-dark);">Download On The App Store</span>
            <span class="d-block small text-muted-pc">Scan to download</span>
          </span>
          <i class="bi bi-arrow-right-short fs-3" style="color: var(--pc-dark);" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
</section>
