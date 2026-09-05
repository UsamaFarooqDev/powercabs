<?php
/* Hero -- migrated to Tailwind. `pc-hero` / `pc-hero-canvas` stay as bare
   classnames purely as JS selector hooks for initHeroParallax() in main.js
   (which reads hero.querySelector('.pc-hero-canvas') and animates it on
   scroll) -- they carry no CSS of their own any more, all visuals below are
   Tailwind utilities. The two @keyframes this section still animates with
   (pc-hero-fade-up, pc-hero-glow-pulse) remain in components.css since a
   Tailwind arbitrary `animate-[name_...]` utility only references a
   keyframes name, it can't define one inline. */
$heroServices = [
  ['icon' => 'clock', 'label' => 'Pay Per Hour', 'href' => '/ride'],
  ['icon' => 'briefcase', 'label' => 'Corporate', 'href' => '/corporate-services'],
  ['icon' => 'airplane', 'label' => 'Meet and Greet', 'href' => '/meet-greet'],
  ['icon' => 'card', 'label' => 'Business Solutions', 'href' => '/business-solutions'],
  ['icon' => 'compass', 'label' => 'City Tour', 'href' => '/city-tours'],
]; ?>
<section class="pc-hero tw-relative tw-flex tw-items-center tw-overflow-hidden tw-text-white tw-bg-[linear-gradient(165deg,#0a0807_0%,#14100c_60%,#0a0807_100%)] tw-min-h-[clamp(560px,100svh,900px)] tw-py-[clamp(7.5rem,13vw,9rem)] lg:tw-min-h-[clamp(640px,100vh,980px)]">
  <div class="pc-hero-canvas tw-absolute tw-inset-0 tw-overflow-hidden tw-pointer-events-none" aria-hidden="true">
    <svg class="tw-absolute tw-inset-0 tw-h-full tw-w-full" viewBox="0 0 1200 700" preserveAspectRatio="xMidYMid slice">
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
        <path d="M0,640 Q650,540 1200,415" stroke="url(#pcRoadFadeO)" stroke-width="2"/>
        <path d="M0,555 Q650,480 1200,410" stroke="url(#pcRoadFadeW)" stroke-width="1.2"/>
        <path d="M0,470 Q650,425 1200,405" stroke="url(#pcRoadFadeW)" stroke-width="1"/>
        <path d="M0,350 Q650,370 1200,400" stroke="url(#pcRoadFadeW)" stroke-width="1"/>
        <path d="M0,265 Q650,320 1200,395" stroke="url(#pcRoadFadeW)" stroke-width="1.2"/>
        <path d="M0,180 Q650,270 1200,390" stroke="url(#pcRoadFadeO)" stroke-width="1.6"/>
        <path d="M660,700 Q900,470 1200,415" stroke="url(#pcRoadFadeW)" stroke-width="1" opacity="0.7"/>
        <path d="M520,0 Q900,360 1200,395" stroke="url(#pcRoadFadeW)" stroke-width="1" opacity="0.7"/>
      </g>
    </svg>
    <span class="tw-absolute tw-right-[-6rem] tw-top-[18%] tw-h-[34rem] tw-w-[34rem] tw-rounded-full tw-blur-[70px] tw-bg-[radial-gradient(circle,rgba(255,122,0,0.22),transparent_70%)] tw-animate-pc-glow-pulse motion-reduce:tw-animate-none"></span>
  </div>

  <div class="tw-relative tw-z-10 <?= $pcContainer ?>">
    <!-- 75% + the 2.5rem top pad reproduce the original col-lg-9 .pc-hero-text. -->
    <div class="tw-pt-5 lg:tw-w-3/4 lg:tw-pt-10">
      <h1 class="tw-mb-6 tw-text-[clamp(4rem,5vw,5.75rem)] tw-font-black tw-leading-[1.05] tw-tracking-[-0.02em] tw-text-white tw-animate-pc-fade-up [animation-delay:0.08s]">
        Your Journey.<br>Smarter. Faster. Premium.
      </h1>
      <p class="tw-mb-10 tw-max-w-[52ch] tw-text-[1.3rem] tw-leading-[1.6] tw-text-white/[0.68] tw-animate-pc-fade-up [animation-delay:0.16s]">
        Book reliable rides, drive with confidence, or manage corporate travel &mdash;
        all from one intelligent mobility platform.
      </p>

      <div class="tw-mb-10 tw-flex tw-flex-wrap tw-items-center tw-gap-4 tw-animate-pc-fade-up [animation-delay:0.24s]">
        <a class="tw-inline-flex tw-items-center tw-justify-center tw-rounded-full tw-border-[1.5px] tw-border-solid tw-border-transparent tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-leading-5 tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]" href="<?= $assetPath ?>/ride">Book a Ride</a>
        <a class="tw-inline-flex tw-items-center tw-justify-center tw-rounded-full tw-border-[1.5px] tw-border-solid tw-border-white/[0.32] tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-leading-5 tw-text-white tw-no-underline tw-transition tw-duration-200 hover:tw-border-white/60 hover:tw-bg-white/10" href="<?= $assetPath ?>/drive">Become a Driver</a>
        <a class="tw-group tw-inline-flex tw-items-center tw-gap-1.5 tw-text-sm tw-font-semibold tw-text-white/80 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-text-white" href="<?= $assetPath ?>/business">
          Business Solutions
          <svg class="tw-h-4 tw-w-4 tw-transition-transform tw-duration-200 group-hover:tw-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>

      <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-3 tw-animate-pc-fade-up [animation-delay:0.32s]">
        <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-lg tw-bg-ink tw-py-2 tw-pl-2 tw-pr-4 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
          <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="20" height="20" aria-hidden="true">
          <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
            <span class="tw-text-[0.6rem] tw-uppercase tw-tracking-wide tw-text-white/75">Get it on</span>
            <span class="tw-text-sm tw-font-bold tw-text-white">Google Play</span>
          </span>
        </a>
        <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-lg tw-bg-ink tw-py-2 tw-pl-2.5 tw-pr-4 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
          <svg class="tw-h-5 tw-w-5 tw-text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.365 1.43c0 1.14-.493 2.27-1.177 3.08-.744.88-1.99 1.56-2.987 1.56-.12 0-.24-.02-.312-.03-.014-.11-.03-.24-.03-.38 0-1.1.556-2.22 1.183-2.98.674-.82 1.888-1.44 2.882-1.48.019.083.03.163.03.24zM20.13 17.14c-.51 1.14-.75 1.65-1.42 2.65-.93 1.42-2.24 3.19-3.87 3.2-1.45.02-1.82-.94-3.79-.93-1.97.01-2.38.95-3.83.93-1.63-.02-2.87-1.61-3.8-3.03-2.6-3.96-2.87-8.6-1.27-11.08.85-1.32 2.29-2.15 3.86-2.16 1.41-.02 2.74.95 3.6.95.86 0 2.47-1.17 4.17-1 .71.03 2.7.29 3.98 2.17-.1.06-2.38 1.39-2.35 4.14.03 3.28 2.88 4.37 2.92 4.39-.03.09-.45 1.55-1.19 3.03z"/></svg>
          <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
            <span class="tw-text-[0.6rem] tw-uppercase tw-tracking-wide tw-text-white/75">Download on the</span>
            <span class="tw-text-sm tw-font-bold tw-text-white">App Store</span>
          </span>
        </a>
      </div>
    </div>

    <div class="tw-mt-14 tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-white/10 tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-white/10 tw-bg-white/[0.03] tw-backdrop-blur-sm md:tw-grid-cols-5 md:tw-divide-y-0">
      <?php foreach ($heroServices as $service): ?>
        <a href="<?= $assetPath .
          htmlspecialchars(
            $service['href'],
          ) ?>" class="tw-group tw-flex tw-flex-col tw-items-center tw-gap-2 tw-px-3 tw-py-6 tw-text-center tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-white/5">
          <?php switch ($service['icon']): case 'clock': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?php break;case 'briefcase': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 14.15v4.25c0 1.09-.787 2.04-1.872 2.18-2.087.28-4.216.42-6.378.42s-4.291-.14-6.378-.42c-1.085-.14-1.872-1.09-1.872-2.18v-4.25M3.75 8.706c0-1.08.768-2.01 1.837-2.175a48.11 48.11 0 013.413-.387m7.5 0v-.894A2.25 2.25 0 0014.25 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M21 12.49c0 .65-.29 1.27-.75 1.66-.194.16-.42.29-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.43-7.577-1.22A2.016 2.016 0 013 12.49"/></svg>
            <?php break;case 'airplane': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
            <?php break;case 'card': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
            <?php break;case 'compass': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5l-1.5 4.5-4.5 1.5 1.5-4.5z"/></svg>
            <?php break;endswitch; ?>
          <span class="tw-text-sm tw-font-semibold tw-leading-tight"><?= htmlspecialchars($service['label']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
