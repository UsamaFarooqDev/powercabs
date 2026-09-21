<?php
$heroServices = [
  ['icon' => 'clock', 'label' => 'Pay Per Hour', 'href' => '/ride'],
  ['icon' => 'briefcase', 'label' => 'Corporate', 'href' => '/corporate-services'],
  ['icon' => 'airplane', 'label' => 'Meet and Greet', 'href' => '/meet-greet'],
  ['icon' => 'card', 'label' => 'Business Solutions', 'href' => '/business-solutions'],
  ['icon' => 'compass', 'label' => 'City Tour', 'href' => '/city-tours'],
];

/* The three frames the hero drifts between. They are one set, not three
   unrelated pictures: all Irish, all shot at dusk or after dark, all with warm
   light in them, so the scrim and the orange wash below land the same way on
   each and the change of frame reads as the hero breathing rather than as a
   slideshow.
      1. the Dublin street at dusk this hero already ran on
      2. the lit corporate blocks on the Liffey
      3. an aerial interchange, headlight trails
   `pos` / `posLg` are the object-position each frame needs to keep its subject
   in shot at the two crops -- a phone sees about a third of the frame's width,
   a desktop nearly all of it. `dim` is its brightness: the quays frame is lit
   windows and gold water where the other two are mostly dark, and at the same
   0.85 as the rest it took the lede's contrast down to 4.14:1 on desktop,
   under the 4.5 that 1.3rem text needs. Dimming that one frame fixes it
   without flattening the two that were already fine.
   All three ride in on custom properties rather than in the class attribute,
   because a Tailwind class built from a PHP variable is invisible to the
   build's scanner and would silently never be generated. */
$heroShots = [
  [
    'src' => 'https://images.pexels.com/photos/18662427/pexels-photo-18662427.jpeg?auto=compress&cs=tinysrgb&w=1920',
    'pos' => '46% center',
    'posLg' => '62% center',
    'dim' => '0.85',
  ],
  [
    // Anchored left and slightly high: at 56% a phone cut the mast clean off
    // the top-left and left only the white sweep of the cables, which reads as
    // an abstract curve rather than as the Samuel Beckett Bridge.
    'src' => 'https://images.pexels.com/photos/13158127/pexels-photo-13158127.jpeg?auto=compress&cs=tinysrgb&w=1920',
    'pos' => '38% 44%',
    'posLg' => '42% 46%',
    'dim' => '0.68',
  ],
  [
    // The cars are the subject and they sit in the bottom third of the frame,
    // which is exactly where the hero's fade-to-dark and the services bar are.
    // Nudging object-position could not fix it -- at this aspect the crop has
    // only ~34px of vertical slack -- so the CDN delivers the frame already
    // cropped to 16:10 anchored to the bottom (fit=crop&crop=bottom). That
    // trims sky off the top and lifts the whole rank of cars up into the
    // readable band.
    'src' =>
      'https://images.pexels.com/photos/6019124/pexels-photo-6019124.jpeg?auto=compress&cs=tinysrgb&w=1920&h=1200&fit=crop&crop=bottom',
    'pos' => '45% center',
    'posLg' => '50% center',
    'dim' => '0.85',
  ],
]; ?>
<section class="pc-hero tw-relative tw-flex tw-items-center tw-overflow-hidden tw-text-white tw-bg-[linear-gradient(165deg,#0a0807_0%,#14100c_60%,#0a0807_100%)] tw-min-h-[clamp(560px,100svh,900px)] tw-py-[clamp(7.5rem,13vw,9rem)] lg:tw-min-h-[clamp(640px,100vh,980px)]">
  <div class="pc-hero-canvas tw-absolute tw-inset-0 tw-overflow-hidden tw-pointer-events-none" aria-hidden="true">
    <?php /* Stacked in one box, so the crossfade has nothing to reflow and the
             frame in front is the only one anybody sees. Only the first is
             worth network priority -- it is the one that paints. The other two
             are fetched at low priority so they cannot compete with it, and
             they have five and ten seconds before they are needed. */ ?>
    <?php foreach ($heroShots as $i => $shot): ?>
      <img src="<?= htmlspecialchars($shot['src']) ?>" alt="" aria-hidden="true" decoding="async"
        <?= $i === 0 ? 'fetchpriority="high"' : 'fetchpriority="low"' ?>
        style="--pc-shot-pos: <?= htmlspecialchars($shot['pos']) ?>; --pc-shot-pos-lg: <?= htmlspecialchars(
  $shot['posLg'],
) ?>; --pc-shot-dim: <?= htmlspecialchars($shot['dim']) ?>"
        class="pc-hero-shot tw-absolute tw-left-0 -tw-top-12 tw-h-[calc(100%+6rem)] tw-w-full tw-object-cover tw-object-[var(--pc-shot-pos)] tw-brightness-[var(--pc-shot-dim)] tw-saturate-[0.95] tw-opacity-0 [&.is-active]:tw-opacity-100 motion-safe:[transition:opacity_1900ms_cubic-bezier(0.4,0,0.2,1),transform_5600ms_cubic-bezier(0.22,1,0.36,1)] motion-safe:[&.is-active]:tw-scale-[1.03] lg:tw-object-[var(--pc-shot-pos-lg)]<?= $i === 0
  ? ' is-active'
  : '' ?>"
        data-pc-hero-shot>
    <?php endforeach; ?>
    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(96deg,rgba(10,7,5,0.9)_0%,rgba(10,7,5,0.88)_60%,rgba(12,8,5,0.84)_100%)] lg:tw-bg-[linear-gradient(96deg,rgba(10,7,5,0.88)_0%,rgba(10,7,5,0.82)_30%,rgba(12,8,5,0.62)_62%,rgba(12,8,5,0.48)_100%)]"></span>
    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(105deg,transparent_40%,rgba(255,122,0,0.16)_75%,rgba(232,89,12,0.24)_100%)]"></span>
    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(to_bottom,rgba(10,8,7,0.8)_0%,transparent_22%,transparent_60%,#0a0807_100%)]"></span>
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

    <div class="tw-mt-14 sm:tw-mt-16 md:tw-mt-20 lg:tw-mt-24 tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-white/10 tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-white/10 tw-bg-white/[0.03] tw-backdrop-blur-sm md:tw-grid-cols-5 md:tw-divide-y-0">
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

<script src="<?= $assetPath ?>assets/js/components/hero-gallery.js?v=<?= @filemtime(
  __DIR__ . '/../../assets/js/components/hero-gallery.js',
) ?>"></script>
