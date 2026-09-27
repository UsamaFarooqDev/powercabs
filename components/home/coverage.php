<?php
/**
 * Homepage §07 -- Dublin coverage.
 *
 * Deliberately a real photograph of the city rather than a stylised map
 * graphic: the site has no coverage-polygon data to draw from, and inventing
 * a map with boundaries on it would be claiming a service area nobody has
 * verified. The airport-to-city line and "Greater Dublin Area" are both
 * already stated on /meet-greet and /ride.
 */
$coverageStops = ['Dublin Airport', 'City centre', 'Docklands', 'Dún Laoghaire', 'Swords', 'Tallaght'];
?>
<section class="tw-bg-surface-warm <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2 lg:tw-gap-16">

      <div>
        <p class="<?= $pcEyebrow ?>">Coverage</p>
        <h2 class="<?= $pcH2 ?> tw-max-w-[16ch]">
          From Dublin Airport to the city centre &mdash; and beyond.
        </h2>
        <p class="<?= $pcBody ?> tw-mb-7 tw-max-w-[46ch]">
          We serve the Greater Dublin Area, day and night. Book on demand when
          you need to move now, or in advance when the time matters.
        </p>

        <ul class="tw-m-0 tw-mb-8 tw-flex tw-list-none tw-flex-wrap tw-gap-2 tw-p-0">
          <?php foreach ($coverageStops as $stop): ?>
            <li class="tw-rounded-pill tw-border tw-border-solid tw-border-hairline tw-bg-white tw-px-3.5 tw-py-1.5 tw-text-[0.875rem] tw-font-medium tw-text-ink">
              <?= htmlspecialchars($stop) ?>
            </li>
          <?php endforeach; ?>
        </ul>

        <a class="<?= $pcBtnLinkIcon ?>" href="<?= $assetPath ?>/ride">
          Check your route
          <svg class="tw-h-4 tw-w-4 tw-transition-transform tw-duration-200 group-hover:tw-translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>

      <div class="tw-group tw-relative tw-aspect-[4/3] tw-overflow-hidden tw-rounded-panel tw-bg-ink/[0.04]">
        <img src="https://images.pexels.com/photos/13158127/pexels-photo-13158127.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1400"
          alt="The Samuel Beckett Bridge over the River Liffey in Dublin."
          width="1400" height="1050" loading="lazy" decoding="async"
          class="<?= $pcImgCover ?> <?= $pcImgZoom ?>">
      </div>
    </div>
  </div>
</section>
