<?php
$journeyServices = [
  [
    'n' => '01', 'eyebrow' => 'Airport',
    'tagline' => 'Your driver is ready before you are.',
    'desc' => 'Flight-tracked pickups and drop-offs, any time of day.',
    'img' => 'service-airport.png', 'alt' => 'Airport pickup and drop-off',
    'href' => '/meet-greet', 'label' => 'Meet &amp; Greet',
  ],
  [
    'n' => '02', 'eyebrow' => 'Business',
    'tagline' => 'Move your team without slowing them down.',
    'desc' => 'Dependable travel accounts for teams and executives.',
    'img' => 'services-corporate.jpg', 'alt' => 'Corporate travel services',
    'href' => '/corporate-services', 'label' => 'Corporate Services',
  ],
  [
    'n' => '03', 'eyebrow' => 'Sightseeing',
    'tagline' => 'Experience Dublin from the back seat.',
    'desc' => "See Dublin's best sights with a trusted local driver.",
    'img' => 'service-city-tour.jpg', 'alt' => 'City tour packages',
    'href' => '/city-tours', 'label' => 'City Tours',
  ],
];
?>
<!-- ============ Section 05 -- Services, as journeys ============ -->
<section class="tw-bg-paper tw-py-20 sm:tw-py-28">
  <div class="container">
    <div class="tw-flex tw-flex-col sm:tw-flex-row sm:tw-items-end sm:tw-justify-between tw-gap-6 tw-mb-16 sm:tw-mb-20">
      <div class="pc-reveal tw-max-w-[42ch]">
        <p class="tw-inline-flex tw-items-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-mb-4" style="color: var(--pc-orange);">
          <span class="tw-inline-block tw-w-6 tw-h-px" style="background: var(--pc-orange);"></span>
          Different Journeys
        </p>
        <h2 class="tw-font-extrabold tw-leading-[1] tw-tracking-tight tw-text-[clamp(2.2rem,5vw,3.5rem)] tw-mb-0" style="color: var(--pc-dark);">
          Wherever you're heading.
        </h2>
      </div>
      <a href="<?= $assetPath ?>/book-ride-online" class="pc-reveal btn btn-pc-dark tw-rounded-full tw-px-5 tw-py-3 tw-flex-shrink-0 tw-no-underline tw-self-start sm:tw-self-auto">
        Book Online
      </a>
    </div>

    <div class="tw-flex tw-flex-col tw-gap-16 sm:tw-gap-20">
      <?php foreach ($journeyServices as $i => $svc): $flip = $i % 2 === 1; ?>
        <a href="<?= $assetPath . $svc['href'] ?>" class="pc-reveal tw-group tw-grid lg:tw-grid-cols-2 tw-gap-8 lg:tw-gap-14 tw-items-center tw-no-underline">
          <div class="<?= $flip ? 'lg:tw-order-2' : '' ?> tw-relative tw-aspect-[4/3] tw-rounded-2xl tw-overflow-hidden">
            <img src="<?= $assetPath ?>assets/img/<?= $svc['img'] ?>" alt="<?= htmlspecialchars($svc['alt']) ?>"
              class="tw-w-full tw-h-full tw-object-cover tw-transition-transform tw-duration-700 group-hover:tw-scale-105" loading="lazy">
            <span class="tw-absolute tw-top-5 tw-left-5 tw-text-white tw-text-[5rem] tw-font-extrabold tw-leading-none tw-opacity-90" style="text-shadow: 0 4px 24px rgba(0,0,0,.35);">
              <?= $svc['n'] ?>
            </span>
          </div>

          <div class="<?= $flip ? 'lg:tw-order-1' : '' ?>">
            <p class="tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-mb-3" style="color: var(--pc-orange);">
              <?= htmlspecialchars($svc['eyebrow']) ?>
            </p>
            <h3 class="tw-font-extrabold tw-leading-[1.05] tw-tracking-tight tw-text-[clamp(1.6rem,3.4vw,2.4rem)] tw-mb-3" style="color: var(--pc-dark);">
              <?= htmlspecialchars($svc['tagline']) ?>
            </h3>
            <p class="tw-text-[1.02rem] tw-mb-5" style="color: var(--pc-text-muted); max-width: 40ch;">
              <?= htmlspecialchars($svc['desc']) ?>
            </p>
            <span class="tw-inline-flex tw-items-center tw-gap-2 tw-font-semibold tw-text-[.95rem] tw-transition-transform tw-duration-300 group-hover:tw-translate-x-1" style="color: var(--pc-dark);">
              <?= $svc['label'] ?> <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </span>
          </div>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
