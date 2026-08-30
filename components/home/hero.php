<section class="pc-hero position-relative overflow-hidden d-flex align-items-center text-white">
  <div class="pc-hero-canvas position-absolute overflow-hidden z-0" aria-hidden="true">
    <svg class="pc-hero-road position-absolute w-100 h-100" viewBox="0 0 1200 700" preserveAspectRatio="xMidYMid slice">
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

      <!-- The route metaphor made literal: a lit pin at pickup, a dashed line
           the "ride" travels along, a pin at destination -- the same
           SVG-native animateMotion trick already used for the small route
           chip in the app-download section, just as the hero's centrepiece
           this time. Purely decorative (aria-hidden on the parent), so it
           carries no semantic weight -- it's here to be looked at while the
           real "Where to?" heading next to it does the talking. -->
      <g class="pc-hero-route-hero" transform="translate(80,150)">
        <path id="pcHeroRoutePath" d="M0,340 C160,340 190,60 430,40 C560,28 620,120 760,90" fill="none" stroke="#ffb15c" stroke-width="2.5" stroke-dasharray="2 10" stroke-linecap="round" opacity="0.85"/>
        <circle cx="0" cy="340" r="7" fill="#fff"/>
        <circle cx="0" cy="340" r="12" fill="none" stroke="#fff" stroke-opacity="0.4" stroke-width="1.5"/>
        <circle cx="760" cy="90" r="7" fill="var(--pc-orange)"/>
        <circle cx="760" cy="90" r="14" fill="none" stroke="var(--pc-orange)" stroke-opacity="0.5" stroke-width="1.5"/>
        <circle r="5" fill="#fff">
          <animateMotion dur="4.5s" repeatCount="indefinite">
            <mpath href="#pcHeroRoutePath"></mpath>
          </animateMotion>
        </circle>
      </g>
    </svg>
    <span class="pc-hero-glow position-absolute rounded-circle"></span>
  </div>

  <div class="container position-relative tw-py-8 lg:tw-py-0">
    <div class="tw-flex tw-flex-col lg:tw-flex-row lg:tw-items-end tw-gap-12 lg:tw-gap-8">

      <!-- Headline -->
      <div class="tw-flex-1 tw-min-w-0">
        <p class="tw-inline-flex tw-items-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-text-powerlight tw-mb-5">
          <span class="tw-inline-block tw-w-6 tw-h-px tw-bg-powerlight"></span>
          Dublin &middot; Live &amp; Ready
        </p>
        <h1 class="tw-font-extrabold tw-text-white tw-leading-[0.92] tw-tracking-tight tw-text-[clamp(3.4rem,9vw,7.5rem)] tw-mb-6">
          Where to?
        </h1>
        <p class="tw-text-white/60 tw-text-[1.05rem] sm:tw-text-[1.15rem] tw-max-w-[38ch] tw-mb-0">
          Type a destination and PowerCabs finds the road there &mdash; licensed
          Garda-vetted drivers, moving across Dublin right now.
        </p>
      </div>

      <!-- Booking widget: a real form, not a mock -- submits straight into
           the actual fare-estimate flow on /ride. -->
      <div class="tw-w-full lg:tw-w-[420px] tw-flex-shrink-0">
        <form action="<?= $assetPath ?>/ride" method="get" class="tw-bg-white/[0.06] tw-backdrop-blur-xl tw-border tw-border-white/10 tw-rounded-[28px] tw-p-5 sm:tw-p-6 tw-shadow-[0_30px_70px_rgba(0,0,0,0.35)]">
          <div class="tw-flex tw-flex-col tw-gap-3">
            <label class="tw-flex tw-items-center tw-gap-3 tw-bg-black/30 tw-rounded-2xl tw-px-4 tw-py-3.5 tw-cursor-text focus-within:tw-ring-1 focus-within:tw-ring-power">
              <span class="tw-w-2 tw-h-2 tw-rounded-full tw-bg-white tw-flex-shrink-0"></span>
              <span class="tw-sr-only">Pickup location</span>
              <input type="text" name="pickup" placeholder="Pickup location" autocomplete="off"
                class="tw-bg-transparent tw-border-0 tw-outline-none tw-text-white tw-placeholder-white/40 tw-text-[.95rem] tw-w-full">
            </label>
            <label class="tw-flex tw-items-center tw-gap-3 tw-bg-black/30 tw-rounded-2xl tw-px-4 tw-py-3.5 tw-cursor-text focus-within:tw-ring-1 focus-within:tw-ring-power">
              <span class="tw-w-2 tw-h-2 tw-rounded-sm tw-bg-power tw-flex-shrink-0"></span>
              <span class="tw-sr-only">Destination</span>
              <input type="text" name="dropoff" placeholder="Where are you going?" autocomplete="off"
                class="tw-bg-transparent tw-border-0 tw-outline-none tw-text-white tw-placeholder-white/40 tw-text-[.95rem] tw-w-full">
            </label>
          </div>

          <button type="submit" class="tw-mt-4 tw-w-full tw-bg-power hover:tw-bg-powerlight tw-text-white tw-font-semibold tw-text-[.95rem] tw-rounded-2xl tw-py-3.5 tw-flex tw-items-center tw-justify-center tw-gap-2 tw-transition-colors">
            Find My Ride
            <i class="bi bi-arrow-right" aria-hidden="true"></i>
          </button>

          <a href="<?= $assetPath ?>/drive" class="tw-mt-3 tw-flex tw-items-center tw-justify-center tw-gap-2 tw-text-white/70 hover:tw-text-white tw-text-[.85rem] tw-py-2 tw-no-underline tw-transition-colors">
            <i class="bi bi-steering-wheel" aria-hidden="true"></i>
            Become a Driver
          </a>
        </form>
      </div>
    </div>

    <!-- Real quick links, preserved from the previous hero -- restyled, not invented. -->
    <?php
    $heroServices = [
      ['icon' => 'bi-clock-history', 'label' => 'Pay Per Hour', 'href' => '/ride'],
      ['icon' => 'bi-briefcase-fill', 'label' => 'Corporate', 'href' => '/corporate-services'],
      ['icon' => 'bi-airplane-fill', 'label' => 'Meet and Greet', 'href' => '/meet-greet'],
      ['icon' => 'bi-credit-card-fill', 'label' => 'Business Solutions', 'href' => '/business-solutions'],
      ['icon' => 'bi-compass-fill', 'label' => 'City Tour', 'href' => '/city-tours'],
    ];
    ?>
    <div class="tw-flex tw-flex-wrap tw-gap-2 tw-mt-10 lg:tw-mt-14">
      <?php foreach ($heroServices as $service): ?>
        <a href="<?= $assetPath . htmlspecialchars($service['href']) ?>"
          class="tw-inline-flex tw-items-center tw-gap-2 tw-text-white/70 hover:tw-text-white hover:tw-border-white/30 tw-text-[.82rem] tw-border tw-border-white/10 tw-rounded-full tw-pl-3 tw-pr-4 tw-py-2 tw-no-underline tw-transition-colors">
          <i class="bi <?= $service['icon'] ?>" aria-hidden="true"></i>
          <?= htmlspecialchars($service['label']) ?>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
