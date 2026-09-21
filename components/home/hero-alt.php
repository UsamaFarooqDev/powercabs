<?php
/* Homepage hero, car-led variant.
 *
 * An alternative to components/home/hero.php, not a replacement: index.php
 * requires one or the other, so only ever one of them is on the page. Swap the
 * require to change which.
 *
 * The difference is what carries the section. hero.php rotates three city
 * frames behind a heavy scrim and lets the headline do the work; this one is
 * built around a single photograph of the car, so the scrim is weighted hard
 * to the left and thins out to the right -- the copy sits on near-black, the
 * Camry and the Liffey behind it stay lit. No rotation, no crossfade, one
 * still frame.
 *
 * `pc-hero` is kept as a selector hook, but there is deliberately no
 * `.pc-hero-canvas` here, so initHeroParallax() in main.js returns without
 * doing anything -- see the note on the backdrop div for why the drift had to
 * go.
 */
$heroServices = [
  ['icon' => 'clock', 'label' => 'Pay Per Hour', 'href' => '/ride'],
  ['icon' => 'briefcase', 'label' => 'Corporate', 'href' => '/corporate-services'],
  ['icon' => 'airplane', 'label' => 'Meet and Greet', 'href' => '/meet-greet'],
  ['icon' => 'card', 'label' => 'Business Solutions', 'href' => '/business-solutions'],
  ['icon' => 'compass', 'label' => 'City Tour', 'href' => '/city-tours'],
];

/* PC-Hero-03 of the three: the only one carrying Dublin's actual landmarks --
   the Custom House dome, the Ha'penny Bridge, the Spire, the Dublin banner on
   the lamp post -- with the branded Camry facing the camera on the right. The
   other two put the car against generic glass frontage.
   Served as WebP at ~190KB. The 2.1MB PNG it was exported from is not
   something to put in front of the largest contentful paint, and is no longer
   in the repo -- re-encode to WebP if this shot is ever replaced. */
$heroCarShot = 'assets/img/PC-Hero.webp'; ?>
<?php /* The desktop height is what decides how large the car reads, which is
         not obvious. object-cover scales the photograph to cover the box, so
         whichever of width or height is the tighter constraint sets the zoom.
         A 980px-tall hero made height the constraint and forced a 1.06x
         UPSCALE, showing only ~80% of the frame -- which is why the car filled
         two thirds of the screen. A 684px one fixed the zoom but cut the
         bottom of the photograph off.

         So the height is now tied to the photograph's own 16:9 instead of to
         the viewport: 56.25vw is exactly 1/1.777, which makes the box the same
         shape as the frame. Nothing crops, nothing is left over, and the car
         holds a steady ~51% of the width at every desktop size. The clamp only
         guards the extremes -- a short laptop and an ultra-wide. */ ?>
<section class="pc-hero tw-relative tw-flex tw-items-center tw-overflow-hidden tw-text-white tw-bg-[linear-gradient(165deg,#0a0807_0%,#14100c_60%,#0a0807_100%)] tw-min-h-[clamp(560px,100svh,900px)] tw-py-[clamp(7.5rem,13vw,9rem)] lg:tw-min-h-[clamp(620px,56.25vw,880px)] lg:tw-items-stretch lg:tw-pb-16">
  <?php /* Deliberately NOT .pc-hero-canvas. That classname is what
           initHeroParallax() in main.js looks for, and it drifts the layer up
           to 40px on scroll -- which only works if the photograph is bled past
           the section edges to cover the shift. Bleeding it is exactly what
           forces the upscale this variant is built to avoid, so the parallax
           is given up instead. initHeroParallax() finds no canvas here and
           returns without doing anything. */ ?>
  <div class="tw-absolute tw-inset-0 tw-overflow-hidden tw-pointer-events-none" aria-hidden="true">
    <?php /* The two crops are completely different, so object-position is too.
             From lg the box matches the frame's aspect, so the whole
             photograph is in shot and the value is a no-op at 50%. A phone
             sees barely a quarter of the width, so 67% is picked to land on
             the grille and headlights rather than an anonymous slab of black
             bodywork. */ ?>
    <img src="<?= $assetPath . htmlspecialchars($heroCarShot) ?>" alt="" aria-hidden="true"
      width="1672" height="941" fetchpriority="high" decoding="async"
      class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-[67%_58%] tw-brightness-[0.9] lg:tw-object-center">

    <?php /* The blackish layer, in three passes, same recipe as hero.php but
             re-weighted: it has to fall away far more on the right than the
             rotating version does, or it buries the subject. Warm black rather
             than neutral, so the sunset behind the car does not go grey. */ ?>
    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(96deg,rgba(10,7,5,0.9)_0%,rgba(10,7,5,0.85)_45%,rgba(12,8,5,0.74)_100%)] lg:tw-bg-[linear-gradient(96deg,rgba(10,7,5,0.95)_0%,rgba(10,7,5,0.91)_30%,rgba(12,8,5,0.62)_58%,rgba(12,8,5,0.24)_100%)]"></span>
    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(105deg,transparent_45%,rgba(255,122,0,0.12)_78%,rgba(232,89,12,0.18)_100%)]"></span>
    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(to_bottom,rgba(10,8,7,0.78)_0%,transparent_24%,transparent_62%,#0a0807_100%)]"></span>
  </div>

  <?php /* The copy and the services bar want different vertical homes, so the
           container stretches to the full height from lg and becomes a column:
           the copy takes tw-my-auto and centres itself in whatever is left,
           the bar stays at the bottom. Centring the section as a whole would
           drag the bar up with it; anchoring it to the bottom would leave the
           copy stranded low, which is the gap at the top that prompted this. */ ?>
  <div class="tw-relative tw-z-10 <?= $pcContainer ?> lg:tw-flex lg:tw-flex-col">
    <?php /* Just over half the width from lg up: enough for the headline to
             break where it should, while the right-hand half stays clear so
             nothing sits on top of the car. */ ?>
    <div class="tw-pt-5 lg:tw-my-auto lg:tw-w-[56%] lg:tw-pt-0 xl:tw-w-[58%]">
      <?php /* Same treatment as hero.php -- black weight, tight tracking, the
               same leading -- stepped down a size because it is running in a
               half-width column now rather than across three quarters. */ ?>
      <?php /* The cap is 3.5rem rather than anything larger because the second
               line is the long one: measured, "Smarter. Faster. Premium." runs
               about 12.5em, and the column is 728px at xl -- past 3.5rem it
               wraps and orphans "Premium." on a line of its own. */ ?>
      <h1 class="tw-mb-5 tw-text-[clamp(2.6rem,4.05vw,3.5rem)] tw-font-black tw-leading-[1.05] tw-tracking-[-0.02em] tw-text-white tw-animate-pc-fade-up [animation-delay:0.08s]">
        Your Journey.<br>Smarter. Faster. Premium.
      </h1>
      <p class="tw-mb-8 tw-max-w-[44ch] tw-text-[1.2rem] tw-leading-[1.6] tw-text-white/[0.7] tw-animate-pc-fade-up [animation-delay:0.16s]">
        Book reliable rides, drive with confidence, or manage corporate travel &mdash;
        all from one intelligent mobility platform.
      </p>

      <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-3 tw-animate-pc-fade-up [animation-delay:0.24s]">
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

    <?php /* The services as the full-width bar across the bottom, same as
             hero.php: one panel, five equal cells, two columns on a phone.
             It sits over the lower part of the photograph, which is road and
             kerb rather than car, so the subject stays clear of it. */ ?>
    <?php /* From lg the auto margin above already opens the gap, so the margin
             here is only a floor -- it stops the copy and the bar colliding on
             a short laptop where there is no free space to distribute. */ ?>
    <div class="tw-mt-10 tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-white/10 tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-white/10 tw-bg-white/[0.06] tw-backdrop-blur-md tw-animate-pc-fade-up [animation-delay:0.32s] sm:tw-mt-12 md:tw-grid-cols-5 md:tw-divide-y-0 lg:tw-mt-10">
      <?php foreach ($heroServices as $service): ?>
        <a href="<?= $assetPath . htmlspecialchars($service['href']) ?>"
          class="tw-group tw-flex tw-flex-col tw-items-center tw-gap-2 tw-px-3 tw-py-5 tw-text-center tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-white/10">
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
