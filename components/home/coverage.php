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

/* Four Dublin views rather than one landscape photograph: this section is
   about covering a city, so four places carry the claim better than one.
 *
 * Every one is verifiably DUBLIN, which matters more here than on a
 * decorative section -- the photographs ARE the argument that PowerCabs covers
 * the city, so a shot of somewhere else is a false claim about coverage. An
 * earlier draft used the Giant's Causeway (County Antrim, 180km away, a
 * different jurisdiction) captioned "Dublin rooftops"; the other candidates in
 * the repo's Pexels set turned out to be the Cliffs of Moher, Blarney Castle
 * and Titanic Belfast -- all Ireland, none Dublin. Check before swapping one.
 *
 * All four are PHOTOGRAPHS. Two of the tiles were briefly the brand's own
 * rendered marketing images, which is fine on a service page but wrong here:
 * a coverage section is evidence, and a render is not evidence of a city.
 *
 * Four different registers of Dublin so the grid does not read as one view
 * repeated: a modern bridge by day, the city centre with a Dublin bus in it,
 * the Four Courts at sunset, and a Georgian street at eye level. */
$coverageShots = [
  ['id' => '13158127', 'alt' => 'The Samuel Beckett Bridge over the River Liffey, Dublin.'],
  ['id' => '35809675', 'alt' => "O'Connell Bridge over the Liffey, with a Dublin bus crossing."],
  ['id' => '38635694', 'alt' => 'The Four Courts on the Dublin quays at sunset.'],
  ['id' => '5995605', 'alt' => "St George's Church and a Georgian street in Dublin."],
];
?>
<section class="tw-bg-white <?= $pcSection ?>">
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

        <?php /* $pcBtnLink on the anchor, $pcBtnLinkIcon on the svg. They were
                 the wrong way round: the anchor carried the ICON recipe, so
                 this link lost its orange and its weight, and the arrow's
                 group-hover: never fired because $pcBtnLink -- which supplies
                 the tw-group/link it hangs off -- was not on it. Same swap as
                 the one in faq-accordion.php. */ ?>
        <a class="<?= $pcBtnLink ?>" href="<?= $assetPath ?>/ride">
          Check your route
          <svg class="<?= $pcBtnLinkIcon ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>

      <?php /* mx-auto, not ml-auto: the block is centred in its half of the
               grid rather than pushed against the right edge.

               aspect-[4/3], not square: these are landscape photographs, and
               object-cover on a square tile threw away a third of each one --
               the bridge lost its span. A 4:3 frame crops far less, so each
               shot reads as itself.

               The max-width keeps the block at roughly the height of the copy
               beside it rather than towering over it. */ ?>
      <div class="tw-grid tw-grid-cols-2 tw-gap-1.5 lg:tw-mx-auto lg:tw-max-w-[440px]">
        <?php foreach ($coverageShots as $shot): ?>
          <div class="tw-group tw-relative tw-aspect-[4/3] tw-overflow-hidden tw-rounded-lg tw-bg-ink/[0.04]">
            <img src="https://images.pexels.com/photos/<?= $shot['id'] ?>/pexels-photo-<?= $shot['id'] ?>.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=700"
              alt="<?= htmlspecialchars($shot['alt']) ?>"
              width="700" height="525" loading="lazy" decoding="async"
              class="<?= $pcImgCover ?> <?= $pcImgZoom ?>">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
