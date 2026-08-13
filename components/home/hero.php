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

        <div class="d-flex flex-wrap align-items-center gap-3 pc-hero-download">
          <span class="pc-hero-download-label">Download on</span>
          <a href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
            <i class="bi bi-apple"></i> App Store
          </a>
          <a href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
            <i class="bi bi-google-play"></i> Google Play
          </a>
        </div>
      </div>
      <div class="col-lg-5" aria-hidden="true"></div>
    </div>
  </div>
</section>
