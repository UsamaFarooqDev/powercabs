<section class="pc-hero">
  <div class="pc-hero-canvas" aria-hidden="true">
    <svg class="pc-hero-road" viewBox="0 0 1200 700" preserveAspectRatio="xMidYMid slice">
      <defs>
        <filter id="pcRoadGlow" x="-60%" y="-60%" width="220%" height="220%">
          <feGaussianBlur stdDeviation="2.5" result="blur"/>
          <feMerge>
            <feMergeNode in="blur"/>
            <feMergeNode in="SourceGraphic"/>
          </feMerge>
        </filter>
        <linearGradient id="pcRoadFadeW" x1="0" y1="0" x2="1" y2="0">
          <stop offset="0" stop-color="#ffffff" stop-opacity="0.14"/>
          <stop offset="0.45" stop-color="#ffffff" stop-opacity="0.2"/>
          <stop offset="0.75" stop-color="#ffffff" stop-opacity="0.35"/>
          <stop offset="1" stop-color="#ffffff" stop-opacity="0.65"/>
        </linearGradient>
        <linearGradient id="pcRoadFadeO" x1="0" y1="0" x2="1" y2="0">
          <stop offset="0" stop-color="#ff7a00" stop-opacity="0.12"/>
          <stop offset="0.45" stop-color="#ff7a00" stop-opacity="0.18"/>
          <stop offset="0.75" stop-color="#ff7a00" stop-opacity="0.32"/>
          <stop offset="1" stop-color="#ff7a00" stop-opacity="0.8"/>
        </linearGradient>
        <radialGradient id="pcTextMaskGrad" cx="0.32" cy="0.48" r="0.46">
          <stop offset="0" stop-color="#000000"/>
          <stop offset="0.65" stop-color="#000000"/>
          <stop offset="1" stop-color="#ffffff"/>
        </radialGradient>
        <mask id="pcHeroTextMask" maskUnits="userSpaceOnUse" x="0" y="0" width="1200" height="700">
          <rect x="0" y="0" width="1200" height="700" fill="url(#pcTextMaskGrad)"/>
        </mask>
      </defs>
      <g fill="none" stroke-linecap="round" filter="url(#pcRoadGlow)" mask="url(#pcHeroTextMask)">
        <path class="pc-hero-road-line" d="M0,640 Q650,540 1200,415" stroke="url(#pcRoadFadeO)" stroke-width="2"/>
        <path class="pc-hero-road-line" d="M0,555 Q650,480 1200,410" stroke="url(#pcRoadFadeW)" stroke-width="1.2"/>
        <path class="pc-hero-road-line" d="M0,470 Q650,425 1200,405" stroke="url(#pcRoadFadeW)" stroke-width="1"/>
        <path class="pc-hero-road-line" d="M0,350 Q650,370 1200,400" stroke="url(#pcRoadFadeW)" stroke-width="1"/>
        <path class="pc-hero-road-line" d="M0,265 Q650,320 1200,395" stroke="url(#pcRoadFadeW)" stroke-width="1.2"/>
        <path class="pc-hero-road-line" d="M0,180 Q650,270 1200,390" stroke="url(#pcRoadFadeO)" stroke-width="1.6"/>
        <path d="M660,700 Q900,470 1200,415" stroke="url(#pcRoadFadeW)" stroke-width="1" opacity="0.7"/>
        <path d="M520,0 Q900,360 1200,395" stroke="url(#pcRoadFadeW)" stroke-width="1" opacity="0.7"/>
      </g>
    </svg>
    <span class="pc-hero-glow"></span>
  </div>

  <div class="container position-relative">
    <div class="row align-items-center gy-5">
      <div class="col-lg-9 pc-hero-text">
        <h1 class="pc-hero-title">Your Journey.<br>Smarter. Faster. Premium.</h1>
        <p class="pc-hero-lead">
          Book reliable rides, drive with confidence, or manage corporate travel &mdash;
          all from one intelligent mobility platform.
        </p>

        <div class="d-flex flex-wrap align-items-center gap-3 pc-hero-ctas">
          <a class="btn btn-pc-primary btn-md px-4" href="<?= $assetPath ?>/ride">Book a Ride</a>
          <a class="pc-hero-btn-secondary btn-md" href="<?= $assetPath ?>/drive">Become a Driver</a>
          <a class="pc-hero-btn-tertiary btn-md" href="<?= $assetPath ?>/business">
            Business Solutions <i class="bi bi-arrow-right-short fs-4"></i>
          </a>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2 pc-hero-download">
          <a class="pc-store-badge" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="20" height="20" aria-hidden="true">
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow">Get it on</span>
              <span class="pc-store-badge-title">Google Play</span>
            </span>
          </a>
          <a class="pc-store-badge" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
            <i class="bi bi-apple text-white fs-5" aria-hidden="true"></i>
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow">Download on the</span>
              <span class="pc-store-badge-title">App Store</span>
            </span>
          </a>
        </div>
      </div>
      <div class="col-lg-5" aria-hidden="true"></div>
    </div>

    <?php
    $heroServices = [
      ['icon' => 'bi-clock-history', 'label' => 'Pay Per Hour', 'href' => '/ride'],
      ['icon' => 'bi-briefcase-fill', 'label' => 'Corporate', 'href' => '/corporate-services'],
      ['icon' => 'bi-airplane-fill', 'label' => 'Meet and Greet', 'href' => '/meet-greet'],
      ['icon' => 'bi-credit-card-fill', 'label' => 'Business Solutions', 'href' => '/business-solutions'],
      ['icon' => 'bi-compass-fill', 'label' => 'City Tour', 'href' => '/city-tours'],
    ];
    ?>
    <div class="row row-cols-2 row-cols-md-5 g-0 pc-hero-services-row">
      <?php foreach ($heroServices as $service): ?>
        <div class="col">
          <a href="<?= $assetPath . htmlspecialchars($service['href']) ?>" class="pc-hero-service-tile d-flex flex-column align-items-center text-decoration-none text-center w-100 h-100">
            <i class="bi <?= $service['icon'] ?> pc-hero-service-icon" aria-hidden="true"></i>
            <span class="pc-hero-service-label"><?= htmlspecialchars($service['label']) ?></span>
          </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
