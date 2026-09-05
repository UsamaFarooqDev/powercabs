<?php
$services = [
  [
    'href' => '/meet-greet',
    'img' => 'assets/img/service-airport.png',
    'alt' => 'Airport pickup and drop-off',
    'eyebrow' => 'Airport',
    'title' => 'Meet &amp; Greet',
    'desc' => 'Flight-tracked pickups and drop-offs, any time of day.',
  ],
  [
    'href' => '/corporate-services',
    'img' => 'assets/img/services-corporate.jpg',
    'alt' => 'Corporate travel services',
    'eyebrow' => 'Business',
    'title' => 'Corporate Services',
    'desc' => 'Dependable travel accounts for teams and executives.',
  ],
  [
    'href' => '/city-tours',
    'img' => 'assets/img/service-city-tour.jpg',
    'alt' => 'City tour packages',
    'eyebrow' => 'Sightseeing',
    'title' => 'City Tours',
    'desc' => "See Dublin's best sights with a trusted local driver.",
  ],
]; ?>
<section class="tw-bg-paper <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mb-14 tw-grid tw-grid-cols-1 tw-items-end tw-gap-8 lg:tw-mb-20 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-7">
        <p class="tw-mb-5 tw-text-[0.7rem] tw-font-semibold tw-uppercase tw-tracking-[0.18em] tw-text-power">/ Services We Offer</p>
        <h2 class="tw-mb-0 tw-text-[clamp(2rem,4.4vw,3.25rem)] tw-font-bold tw-leading-[1.12] tw-tracking-[-0.02em] tw-text-ink">Wherever you're heading</h2>
      </div>
      <div class="lg:tw-col-span-5 lg:tw-pt-10">
        <p class="tw-mb-6 tw-max-w-[46ch] tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/[0.62]">
          From airport runs to boardroom travel and city sightseeing, we've got your
          journey covered. Book with confidence, every time.
        </p>
        <div class="tw-flex tw-flex-wrap tw-gap-3">
          <a class="tw-inline-flex tw-items-center tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]" href="<?= $assetPath ?>/book-ride-online">Book Online</a>
          <a class="tw-inline-flex tw-items-center tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="tel:+35312030727">Call Us</a>
        </div>
      </div>
    </div>

    <!-- Desktop stagger: card 1 sits highest, 2 and 3 step down. Done with
         lg:tw-mt-* (real layout, not transforms) so the section still measures
         its own height correctly and nothing overlaps. Every offset is lg:-only,
         so tablet and mobile get a plain, evenly-aligned grid. -->
    <div class="tw-grid tw-grid-cols-1 tw-gap-5 sm:tw-grid-cols-2 lg:tw-grid-cols-3 lg:tw-items-start lg:tw-gap-6">
      <?php foreach ($services as $i => $service): ?>
        <?php // [top offset, height]. Widths are identical; only the height
        // varies, and each card's top offset absorbs exactly what its height
        // gives up -- offset + height = 30rem for all three -- so the steps
        // read from the TOP while the bottoms stay level. The decrements are
        // deliberately uneven (2.5rem then 2rem) so the rhythm looks composed
        // rather than mechanically halved.
        $stagger = [
          'lg:tw-h-[31rem]',
          'lg:tw-mt-16 lg:tw-h-[27rem]',
          'lg:tw-mt-28 lg:tw-h-[24rem]',
        ][$i] ?? ''; ?>
        <a href="<?= $assetPath .
          $service[
            'href'
          ] ?>" class="tw-group tw-relative tw-block tw-aspect-[4/5] lg:tw-aspect-auto tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.06] tw-no-underline tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-[transform,box-shadow] tw-duration-300 tw-ease-out hover:-tw-translate-y-1 hover:tw-shadow-[0_24px_50px_-12px_rgba(28,20,16,0.22)] motion-reduce:tw-transition-none motion-reduce:hover:tw-transform-none <?= $stagger ?>">
          <img src="<?= $assetPath . $service['img'] ?>" alt="<?= htmlspecialchars(
  $service['alt'],
) ?>" class="tw-block tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 tw-ease-out group-hover:tw-scale-105 motion-reduce:tw-transition-none" loading="lazy">
          <span class="tw-absolute tw-inset-0 tw-bg-black/[0.15] tw-transition-opacity tw-duration-500 group-hover:tw-opacity-30 motion-reduce:tw-transition-none" aria-hidden="true"></span>
          <span class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.8)_0%,rgba(10,7,5,0.35)_65%,rgba(10,7,5,0)_100%)] tw-p-4 tw-pt-[4.5rem] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)]">
            <span class="tw-mb-1.5 tw-block tw-text-[0.8rem] tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-white/75"><?= htmlspecialchars(
              $service['eyebrow'],
            ) ?></span>
            <span class="tw-mb-1.5 tw-block tw-text-[1.625rem] tw-font-bold tw-leading-tight tw-text-white tw-transition-colors tw-duration-500"><?= $service[
              'title'
            ] ?></span>
            <span class="tw-mb-0 tw-block tw-text-[0.975rem] tw-leading-relaxed tw-text-white/70"><?= htmlspecialchars($service['desc']) ?></span>
            <span class="tw-mt-0 tw-block tw-max-h-0 tw-overflow-hidden tw-opacity-0 tw-transition-all tw-duration-700 tw-ease-out group-hover:tw-mt-[0.85rem] group-hover:tw-max-h-[3.25rem] group-hover:tw-opacity-100 group-focus-visible:tw-mt-[0.85rem] group-focus-visible:tw-max-h-[3.25rem] group-focus-visible:tw-opacity-100 motion-reduce:tw-transition-none">
              <span class="tw-group/rm tw-inline-flex tw-items-center tw-gap-1 tw-py-1.5 tw-text-[1.0225rem] tw-font-medium tw-leading-none tw-text-powerlight tw-underline-offset-4 tw-transition-colors tw-duration-200">
                Read More
                <svg class="tw-h-4 tw-w-4 tw-transition-transform tw-duration-200 group-hover/rm:tw-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
              </span>
            </span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
