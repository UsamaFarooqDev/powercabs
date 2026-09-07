<?php
/**
 * Ride page: "A Ride for Every Need" -- the eight ride types as a compact,
 * skimmable grid. Requires $assetPath from the including page.
 *
 * This replaced a pinned scroll-through showcase (rides-parallax.js, since
 * removed) that stacked the eight cards and advanced them on scroll. It
 * looked good, but it cost 8 x 70vh = ~560vh of scrolling to see eight
 * cards, it could not be skimmed, and it made comparing two ride types --
 * the actual job of this section -- impossible, because only one was ever
 * on screen. A grid shows all eight at once in roughly one screen.
 *
 * Every ride type, description, spec and image is unchanged; this is a
 * presentation change, not a content cut.
 */

$rideTypes = [
  [
    'img'   => 'Economy.png',
    'title' => 'Economy',
    'desc'  => 'Affordable, everyday rides for getting around town. A reliable, no-fuss car for quick trips whenever you need one.',
    'specs' => [
      ['icon' => 'people', 'label' => '4 Seats'],
      ['icon' => 'cash', 'label' => 'Affordable'],
    ],
  ],
  [
    'img'   => 'Economy-xl.png',
    'title' => 'Economy XL',
    'desc'  => 'Extra seats and boot space for bigger groups and extra luggage, without stepping up to a premium fare.',
    'specs' => [
      ['icon' => 'people', 'label' => '6 Seats'],
      ['icon' => 'bag', 'label' => 'Extra Space'],
    ],
  ],
  [
    'img'   => 'Limousine.png',
    'title' => 'Limousine',
    'desc'  => 'Arrive in style with a premium, chauffeur-driven experience -- perfect for special occasions and VIP travel.',
    'specs' => [
      ['icon' => 'gem', 'label' => 'Luxury Experience'],
    ],
  ],
  [
    'img'   => 'wheelchair-taxi.png',
    'title' => 'Wheelchair Taxi',
    'desc'  => 'Fully accessible vehicles fitted for wheelchair users, with trained and courteous drivers on every trip.',
    'specs' => [
      ['icon' => 'accessible', 'label' => 'Accessible Vehicle'],
    ],
  ],
  [
    'img'   => 'pet-taxi.png',
    'title' => 'Pets Taxi',
    'desc'  => 'Travel comfortably with your furry friend in a pet-friendly interior, built for secure and relaxed rides.',
    'specs' => [
      ['icon' => 'heart', 'label' => 'Pet Friendly Ride'],
    ],
  ],
  [
    'img'   => 'courier.png',
    'title' => 'Courier / Parcel',
    'desc'  => 'Fast, secure point-to-point parcel and document delivery across Ireland, whenever you need it.',
    'specs' => [
      ['icon' => 'box', 'label' => 'Package Delivery'],
    ],
  ],
  [
    'img'   => 'business.png',
    'title' => 'Business',
    'desc'  => 'A polished ride for work trips and client meetings, with a professional driver and a spotless vehicle.',
    'specs' => [
      ['icon' => 'briefcase', 'label' => 'Premium Travel'],
    ],
  ],
  [
    'img'   => 'business-xl.png',
    'title' => 'Business XL',
    'desc'  => 'The business experience with extra room -- ideal for executive teams and groups travelling together.',
    'specs' => [
      ['icon' => 'people', 'label' => '7 Seats'],
      ['icon' => 'briefcase', 'label' => 'Premium XL'],
    ],
  ],
];

function pc_ride_spec_icon(string $icon): void
{
  switch ($icon):
    case 'people': ?>
      <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
    <?php break;
    case 'cash': ?>
      <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v12m-3.75-9.75h5.25a2.25 2.25 0 010 4.5h-3a2.25 2.25 0 000 4.5h5.25M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0z"/></svg>
    <?php break;
    case 'bag': ?>
      <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25l2 2 4-4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
    <?php break;
    case 'gem': ?>
      <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5.25 8.25l3-4.5h7.5l3 4.5m-13.5 0l6.75 11.25L18.75 8.25m-13.5 0h13.5"/></svg>
    <?php break;
    case 'accessible': ?>
      <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 4.5a1.5 1.5 0 100-3 1.5 1.5 0 000 3zm-1.5 4.5h6l3 9m-9-9l-3 9m3-9v6m0-6H7.5M15 12l3 1.5"/><circle cx="18" cy="19.5" r="2.25"/></svg>
    <?php break;
    case 'heart': ?>
      <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/></svg>
    <?php break;
    case 'box': ?>
      <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 7.5l-8.25-4.5-8.25 4.5m16.5 0l-8.25 4.5m8.25-4.5v9l-8.25 4.5m0-9L3.75 7.5m8.25 4.5v9M3.75 7.5v9l8.25 4.5"/></svg>
    <?php break;
    case 'briefcase': ?>
      <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 14.15v4.25a2 2 0 01-2 2H5.75a2 2 0 01-2-2v-4.25m16.5 0a2 2 0 00-2-2H5.75a2 2 0 00-2 2m16.5 0v-1.75a2 2 0 00-2-2H5.75a2 2 0 00-2 2v1.75M9 12.75V9.5A2.25 2.25 0 0111.25 7.25h1.5A2.25 2.25 0 0115 9.5v3.25"/></svg>
    <?php break;
  endswitch;
}
?>

<section class="<?= $pcSurfaceWhite ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">

    <div class="<?= $pcSectionHeadCenter ?>">
      <p class="<?= $pcEyebrow ?>">/ Ride Types</p>
      <h2 class="<?= $pcH2 ?>">A Ride for Every Need</h2>
      <p class="<?= $pcLead ?> tw-mx-auto <?= $pcMeasure ?>">
        Eight vehicle types, one fare engine. Pick the one that fits the
        journey &mdash; the price you are quoted is the price you pay.
      </p>
    </div>

    <?php /* Deliberately NOT $pcCardEditorial. These eight run as one
             continuous mosaic -- square corners, no gutters, no card border --
             so the shared editorial recipe (rounded-3xl, hairline border,
             hover lift) is wrong here on every count: a hover translate with
             zero gutter would slide a card over its neighbours.

             gap-px over a tinted container, rather than gap-0 plus borders, is
             what makes the seams work. Borders on abutting cards double up
             into a 2px line and leave a stray edge on the outside of the
             block; a 1px gap showing the container through gives exactly one
             hairline between neighbours and none at the perimeter. black/[0.05]
             keeps it just barely there, which is the "soft edge" asked for.

             Hover is a background tint now instead of a lift -- the only
             feedback that does not disturb a seamless grid.

             Four across at xl, two at sm, one on mobile. The image wrapper
             owns the 4:3 ratio ($pcImgLandscape) rather than the image, so all
             eight cards line up regardless of each source file's own
             dimensions. */ ?>
    <div class="tw-grid tw-grid-cols-1 tw-gap-px tw-overflow-hidden tw-bg-black/[0.05] sm:tw-grid-cols-2 xl:tw-grid-cols-4">
      <?php foreach ($rideTypes as $i => $ride): ?>
        <article class="tw-group tw-relative tw-flex tw-h-full tw-flex-col tw-overflow-hidden tw-rounded-none tw-bg-white tw-transition-colors tw-duration-300 tw-ease-out motion-reduce:tw-transition-none">
          <div class="<?= $pcImgLandscape ?>">
            <img src="<?= $assetPath ?>assets/img/rides-types/<?= $ride['img'] ?>"
                 alt="PowerCabs <?= htmlspecialchars($ride['title']) ?>"
                 class="<?= $pcImgCover ?> <?= $pcImgZoom ?>"
                 loading="<?= $i < 4 ? 'eager' : 'lazy' ?>">
          </div>

          <div class="<?= $pcCardEditorialBody ?>">
            <h3 class="<?= $pcH3 ?>"><?= htmlspecialchars($ride['title']) ?></h3>
            <p class="<?= $pcBodySm ?> tw-mb-4"><?= htmlspecialchars($ride['desc']) ?></p>

            <!-- mt-auto pins the spec chips to the bottom, so they align
                 across a row whatever length each description runs to. -->
            <div class="tw-mt-auto tw-flex tw-flex-wrap tw-gap-x-4 tw-gap-y-2">
              <?php foreach ($ride['specs'] as $spec): ?>
                <span class="tw-inline-flex tw-items-center tw-gap-1.5 tw-text-[0.8rem] tw-font-semibold tw-text-ink/[0.6]">
                  <span class="tw-inline-flex tw-h-6 tw-w-6 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-peach tw-text-power"><?php pc_ride_spec_icon(
                    $spec['icon'],
                  ); ?></span>
                  <?= htmlspecialchars($spec['label']) ?>
                </span>
              <?php endforeach; ?>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <?php /* Wheelchair Taxi is one of the eight cards above and has a whole
             page of its own -- accessibility requirements, what the vehicles
             are fitted with, how drivers are trained -- which nothing on this
             page linked to. Someone scanning the ride types for an accessible
             vehicle is exactly the reader that page is written for, so the
             link belongs here rather than only in the footer. */ ?>
    <div class="tw-mt-10 tw-flex tw-flex-col tw-items-center tw-gap-4">
      <a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath ?>/book-ride-online">Book Your Ride</a>
      <p class="tw-mb-0 tw-text-center tw-text-[0.95rem] tw-text-ink/[0.6]">
        Travelling with a wheelchair?
        <a class="tw-font-semibold tw-text-power tw-underline tw-decoration-power/30 tw-underline-offset-4 tw-transition-colors tw-duration-200 hover:tw-text-powerdark hover:tw-decoration-power" href="<?= $assetPath ?>/wheelchair-accessible-taxis">See our wheelchair accessible taxis</a>.
      </p>
    </div>

  </div>
</section>
