<?php
/**
  * Ride page: "A Ride for Every Need" -- pinned scroll-through showcase
  * of every ride type. Requires $assetPath from the including page.
  *
  * The pc-ride-* / pc-rides-* classnames below are bare JS hooks with no CSS
  * behind them -- rides-parallax.js queries this exact markup and measures
  * real offsetHeight/position off it. Styling is all Tailwind.
  *
  * The enhanced layout (sticky pin, absolutely-stacked cards, visible scroll
  * spacers) only applies once that script adds `pc-rides-enhanced` to the
  * section, so those utilities hang off a group-[.pc-rides-enhanced]:
  * variant. Reduced motion has to beat them, hence the ! important markers:
  * without JS or with motion reduced, the section is a plain vertical list.
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

<section class="tw-group tw-relative tw-bg-white tw-py-[clamp(2rem,4vw,3.5rem)]" id="pcRidesParallax">
  <div class="tw-flex tw-min-h-[80vh] tw-items-center group-[.pc-rides-enhanced]:tw-sticky group-[.pc-rides-enhanced]:tw-top-[calc(var(--pc-navbar-h,250px)+4.5rem)] group-[.pc-rides-enhanced]:tw-min-h-0 motion-reduce:!tw-static motion-reduce:!tw-min-h-0" id="pcRidesSticky">
    <div class="<?= $pcContainer ?>">
      <div class="tw-mb-4 tw-text-center">
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Ride Types</p>
        <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">A Ride for Every Need</h2>
        <div class="tw-mt-2 tw-flex tw-justify-center tw-gap-2" id="pcRideDots">
          <?php foreach ($rideTypes as $i => $ride): ?>
            <span class="pc-ride-dot tw-h-2 tw-w-2 tw-rounded-full tw-bg-black/[0.15] tw-transition-[background-color,width,border-radius] tw-duration-[250ms] [&.is-active]:tw-w-[22px] [&.is-active]:tw-rounded [&.is-active]:tw-bg-power <?= $i === 0 ? 'is-active' : '' ?>" data-index="<?= $i ?>" aria-hidden="true"></span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="pc-ride-card-stack tw-relative tw-overflow-hidden group-[.pc-rides-enhanced]:tw-h-[530px] md:group-[.pc-rides-enhanced]:tw-h-[400px] motion-reduce:!tw-h-auto" id="pcRideCardStack">
        <?php foreach ($rideTypes as $i => $ride): ?>
          <div class="pc-ride-stack-card tw-hidden tw-relative tw-flex-col tw-overflow-hidden tw-rounded-[28px] tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white before:tw-absolute before:tw-inset-x-0 before:tw-top-0 before:tw-bg-[linear-gradient(90deg,#e8590c_0%,#ff7a00_100%)] before:tw-content-[''] [&.is-active]:tw-flex md:tw-flex-row group-[.pc-rides-enhanced]:tw-flex group-[.pc-rides-enhanced]:tw-absolute group-[.pc-rides-enhanced]:tw-inset-[0_auto_auto_0] group-[.pc-rides-enhanced]:tw-h-full group-[.pc-rides-enhanced]:tw-w-full group-[.pc-rides-enhanced]:tw-will-change-transform motion-reduce:!tw-static motion-reduce:!tw-mb-8 motion-reduce:!tw-flex motion-reduce:!tw-h-auto motion-reduce:!tw-w-full motion-reduce:!tw-transform-none <?= $i === 0 ? 'is-active' : '' ?>" data-index="<?= $i ?>" style="z-index: <?= $i + 1 ?>;">
            <div class="tw-flex tw-flex-[0_0_auto] tw-flex-col tw-justify-center tw-py-[clamp(1.75rem,3vw,3rem)] tw-pl-[clamp(1.75rem,3vw,3rem)] tw-pr-3 md:tw-flex-[0_0_50%]">
              <h3 class="tw-relative tw-mb-3 tw-text-[clamp(1.85rem,3.2vw,2.65rem)] tw-font-bold"><?= htmlspecialchars($ride['title']) ?></h3>
              <p class="tw-relative tw-mb-3 tw-max-w-[34rem] tw-text-xl tw-text-ink/[0.65]"><?= htmlspecialchars($ride['desc']) ?></p>
              <div class="tw-flex tw-flex-wrap tw-gap-2">
                <?php foreach ($ride['specs'] as $spec): ?>
                  <span class="tw-relative tw-inline-flex tw-items-center tw-gap-[0.4rem] tw-text-[0.85rem] tw-font-semibold tw-text-ink/[0.65]">
                    <span class="tw-inline-flex tw-h-7 tw-w-7 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-peach tw-text-[0.85rem] tw-text-power"><?php pc_ride_spec_icon(
                      $spec['icon'],
                    ); ?></span>
                    <?= htmlspecialchars($spec['label']) ?>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="tw-relative tw-flex tw-flex-[1_1_auto] tw-items-center tw-justify-center tw-py-3 tw-pl-3 tw-pr-6 md:tw-flex-[0_0_50%]">
              <img src="<?= $assetPath ?>assets/img/rides-types/<?= $ride['img'] ?>" alt="PowerCabs <?= htmlspecialchars($ride['title']) ?>" class="tw-relative tw-block tw-h-[94%] tw-w-[92%] tw-max-w-[420px] tw-rounded-[20px] tw-object-cover" loading="<?= $i === 0 ? 'eager' : 'lazy' ?>">
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>

  <div class="tw-hidden group-[.pc-rides-enhanced]:tw-block motion-reduce:!tw-hidden" id="pcRideTriggers" aria-hidden="true">
    <?php foreach ($rideTypes as $ride): ?><div class="tw-h-[70vh]"></div><?php endforeach; ?>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/rides-parallax.js"></script>
