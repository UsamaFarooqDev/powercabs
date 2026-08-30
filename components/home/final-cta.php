<!-- ============ Section 11 -- Final Destination, closing the route ============ -->
<section class="tw-relative tw-bg-ink tw-py-24 sm:tw-py-32 tw-overflow-hidden tw-text-center">
  <svg class="tw-absolute tw-inset-0 tw-w-full tw-h-full tw-pointer-events-none" viewBox="0 0 1200 400" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
    <path id="pcFinalRoutePath" d="M0,320 C300,320 340,110 600,90 C860,70 900,260 1200,230" fill="none" stroke="#ffb15c" stroke-width="2" stroke-dasharray="2 10" stroke-linecap="round" opacity="0.35"/>
    <circle cx="0" cy="320" r="6" fill="#fff" opacity="0.6"/>
    <circle cx="1200" cy="230" r="6" fill="var(--pc-orange)" opacity="0.8"/>
    <circle r="4.5" fill="var(--pc-orange)">
      <animateMotion dur="6s" repeatCount="indefinite">
        <mpath href="#pcFinalRoutePath"></mpath>
      </animateMotion>
    </circle>
  </svg>

  <div class="container tw-relative">
    <p class="pc-reveal tw-inline-flex tw-items-center tw-justify-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-text-powerlight tw-mb-6">
      PowerCabs
    </p>
    <h2 class="pc-reveal tw-font-extrabold tw-text-white tw-leading-[0.95] tw-tracking-tight tw-text-[clamp(3rem,9vw,7rem)] tw-mb-8">
      Where next?
    </h2>
    <a href="<?= $assetPath ?>/ride" class="pc-reveal tw-inline-flex tw-items-center tw-gap-3 tw-bg-power hover:tw-bg-powerlight tw-text-white tw-font-semibold tw-text-[1.05rem] tw-rounded-full tw-px-7 tw-py-4 tw-no-underline tw-transition-colors">
      Book a Ride <i class="bi bi-arrow-right" aria-hidden="true"></i>
    </a>
  </div>
</section>
