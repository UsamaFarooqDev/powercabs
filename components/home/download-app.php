<style>
  @keyframes pcLiveTrackPulse {
    0%   { transform: scale(1);   opacity: .55; }
    70%  { transform: scale(1.9); opacity: 0;   }
    100% { transform: scale(1.9); opacity: 0;   }
  }
</style>
<!-- ============ Download the PowerCabs App ============ -->
<section class="pc-app-promo position-relative z-2">
  <div class="pc-app-promo-container position-relative">
    <div class="row align-items-center gy-5">

      <div class="col-lg-6 order-lg-2">
        <h2 class="mb-3" style="color: var(--pc-dark);">Download the PowerCabs App for Instant Access</h2>
        <p class="mb-4" style="max-width: 46ch; color: rgba(28, 20, 16, 0.72); font-size: 1.1rem;">
          Booking a cab with PowerCabs is now easier than ever. Download our app today
          from the App Store or Google Play and enjoy the convenience of booking a cab
          with just a few taps.
        </p>

        <div class="d-flex flex-wrap gap-2 mb-4">
          <a class="pc-store-badge pc-store-badge-lg d-inline-flex align-items-center text-decoration-none" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" aria-hidden="true">
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow d-block text-uppercase">Get it on</span>
              <span class="pc-store-badge-title d-block fw-bold text-white">Google Play</span>
            </span>
          </a>
          <a class="pc-store-badge pc-store-badge-lg d-inline-flex align-items-center text-decoration-none" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
            <i class="bi bi-apple text-white fs-5" aria-hidden="true"></i>
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow d-block text-uppercase">Download on the</span>
              <span class="pc-store-badge-title d-block fw-bold text-white">App Store</span>
            </span>
          </a>
        </div>
        
        <p class="fw-bold mb-0" style="color: var(--pc-dark);">Buckle up Ireland!</p>
      </div>

<div class="col-lg-6 order-lg-1 d-none d-lg-block">
  <?php
    $mockupImage     = 'download-app.jpeg';
    $mockupAlt       = 'PowerCabs app screen showing a route from Dublin Airport to Temple Bar';
    $mockupFloat     = true;
    $mockupMaxWidth  = '300px';
    $mockupFloatCards = function () {
      ?>
      <!-- Live Tracking card -->
      <div class="pc-app-float-card pc-app-float-card-a position-absolute z-2 d-flex align-items-center gap-2 bg-white rounded-4 shadow p-2">
        <div class="position-relative d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;">
          <span class="position-absolute top-0 start-0 w-100 h-100 rounded-circle" style="background: var(--pc-orange); animation: pcLiveTrackPulse 1.8s ease-out infinite;"></span>
          <span class="position-relative d-flex align-items-center justify-content-center rounded-circle text-white" style="width: 30px; height: 30px; background: var(--pc-orange);">
            <i class="bi bi-geo-alt-fill" style="font-size: .85rem;"></i>
          </span>
        </div>
       <span class="d-flex flex-column lh-sm">
          <strong class="small">Live Tracking</strong>
          <small class="text-muted" style="font-size: .7rem;">Know exactly where your ride is</small>
        </span>

        <!-- Mini animated route -- a dot travels the dashed path on loop, native SVG animation, no JS -->
        <svg width="44" height="26" viewBox="0 0 44 26" class="ms-auto flex-shrink-0" aria-hidden="true">
          <path id="pcMiniRoute" d="M2,22 C14,22 16,6 42,4" fill="none" stroke="#ffdcb8" stroke-width="2" stroke-dasharray="1 5" stroke-linecap="round"></path>
          <circle cx="2" cy="22" r="2.5" fill="#ffdcb8"></circle>
          <circle cx="42" cy="4" r="2.5" fill="var(--pc-orange)"></circle>
          <circle r="3" fill="var(--pc-orange)">
            <animateMotion dur="2.2s" repeatCount="indefinite">
              <mpath href="#pcMiniRoute"></mpath>
            </animateMotion>
          </circle>
        </svg>
      </div>

      <!-- Secure Payments card -->
      <div class="pc-app-float-card pc-app-float-card-b position-absolute z-2 d-flex align-items-center gap-2 bg-white rounded-4 shadow p-3">
        <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 38px; height: 38px; background: rgba(25, 135, 84, .12);">
          <i class="bi bi-shield-check text-success" style="font-size: 1.05rem;"></i>
        </div>

        <span class="d-flex flex-column lh-sm">
          <strong class="small">Secure Payments</strong>
          <small class="text-muted" style="font-size: .7rem;">Cashless &amp; protected</small>
          <span class="d-inline-flex align-items-center gap-1 mt-1">
            <i class="bi bi-lock-fill text-muted" style="font-size: .6rem;"></i>
            <small class="text-muted" style="font-size: .65rem;">
              Secured by <span class="fw-semibold" style="color: #635bff;">Stripe</span>
            </small>
          </span>
        </span>
      </div>
      <?php
    };
    require __DIR__ . '/../shared/app-mockup.php';
  ?>
</div>
    </div>
  </div>
</section>
