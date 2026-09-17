<?php

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

$rideSlidePad = 'tw-p-3 sm:tw-p-4 md:tw-p-5 lg:tw-p-6 xl:tw-p-8';
?>
<section class="<?= $pcSurfaceWhite ?> <?= $pcSection ?> tw-relative tw-overflow-hidden">
  <div class="tw-pointer-events-none tw-absolute tw-inset-0 tw-overflow-hidden" aria-hidden="true">
    <div class="tw-absolute tw-left-[-12rem] tw-top-[8rem] tw-h-[26rem] tw-w-[26rem] tw-rounded-full tw-bg-peach/30 tw-blur-3xl"></div>
    <div class="tw-absolute tw-right-[-12rem] tw-bottom-[4rem] tw-h-[30rem] tw-w-[30rem] tw-rounded-full tw-bg-power/[0.06] tw-blur-3xl"></div>
  </div>

  <div class="<?= $pcContainer ?> tw-relative">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-3xl tw-text-center sm:tw-mb-12 lg:tw-mb-14">
      <h2 class="<?= $pcH2 ?> tw-mx-auto tw-max-w-2xl tw-text-balance tw-font-extrabold tw-leading-[1.05] tw-tracking-[-0.035em]">
        A ride for every
        <span class="tw-text-power">journey.</span>
      </h2>

      <p class="<?= $pcLead ?> tw-mx-auto tw-mt-5 tw-max-w-2xl tw-leading-[1.75] tw-text-ink/[0.58]">
        From everyday trips to executive travel, choose the vehicle that
        fits your journey. One simple fare engine, with the price you
        are quoted being the price you pay.
      </p>
    </div>

    <div
      data-ride-slider
      aria-roledescription="carousel"
      aria-label="PowerCabs ride types"
      class="tw-relative tw-overflow-hidden tw-rounded-[2rem] tw-border tw-border-solid tw-border-black/[0.07] tw-bg-[#f8f7f5] tw-shadow-[0_24px_80px_-32px_rgba(28,20,16,0.25)] sm:tw-rounded-[2.5rem]"
    >
      <div class="tw-relative tw-z-20 tw-flex tw-items-center tw-justify-between tw-gap-4 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06] tw-bg-white/[0.82] tw-px-5 tw-py-4 tw-backdrop-blur-xl sm:tw-px-7 sm:tw-py-5 lg:tw-px-9">
        <div class="tw-flex tw-items-baseline tw-gap-2">
          <span
            data-ride-current
            class="tw-text-[1.15rem] tw-font-extrabold tw-leading-none tw-tabular-nums tw-tracking-[-0.03em] tw-text-ink sm:tw-text-[1.35rem]"
          >
            01
          </span>

          <span class="tw-text-[0.72rem] tw-font-semibold tw-tracking-[0.08em] tw-text-ink/30">
            /
          </span>

          <span class="tw-text-[0.72rem] tw-font-bold tw-tabular-nums tw-tracking-[0.08em] tw-text-ink/35">
            <?= str_pad(count($rideTypes), 2, '0', STR_PAD_LEFT) ?>
          </span>

          <span class="tw-ml-1 tw-hidden tw-text-[0.7rem] tw-font-semibold tw-uppercase tw-tracking-[0.12em] tw-text-ink/35 sm:tw-inline">
            Ride options
          </span>
        </div>

        <p class="tw-sr-only" aria-live="polite" data-ride-status></p>
        <div class="tw-flex tw-items-center tw-gap-2">
          <?php
          $rideNavBtn =
            'tw-group tw-inline-flex tw-h-10 tw-w-10 tw-appearance-none tw-items-center tw-justify-center tw-rounded-full ' .
            'tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-text-ink ' .
            'tw-shadow-[0_4px_14px_rgba(28,20,16,0.05)] tw-transition-all tw-duration-300 ' .
            // No hover lift, same rule as $pcBtnPrimary: a 2px rise under a 40px
            // circle mostly reads as the chevron twitching. Filling the circle
            // orange is the feedback. The chevron's own sideways nudge stays --
            // it points at what the button will do, and with no label beside it
            // there is nothing for it to drift away from.
            'hover:tw-border-power/30 hover:tw-bg-power hover:tw-text-white hover:tw-shadow-[0_8px_22px_rgba(28,20,16,0.12)] ' .
            'focus-visible:tw-outline focus-visible:tw-outline-2 focus-visible:tw-outline-offset-2 focus-visible:tw-outline-power ' .
            'disabled:tw-cursor-not-allowed disabled:tw-opacity-35 disabled:hover:tw-border-black/[0.08] disabled:hover:tw-bg-white disabled:hover:tw-text-ink ' .
            'motion-reduce:tw-transition-none';
          ?>

          <?php /* Pause / play for the autoplay. Hidden until the script marks it
                   .is-ready, so with JS off -- or with reduced motion, where
                   nothing auto-plays -- there is no button that does nothing.
                   It comes first, before prev/next, which is where the WAI
                   carousel pattern puts the rotation control. The script
                   toggles .is-paused, which swaps the two icons. */ ?>
          <button
            type="button"
            class="<?= str_replace('tw-inline-flex', 'tw-hidden [&.is-ready]:tw-inline-flex', $rideNavBtn) ?>"
            data-ride-toggle
            aria-label="Pause the ride types slideshow"
          >
            <svg
              class="tw-h-4 tw-w-4 group-[.is-paused]:tw-hidden"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2.25"
              stroke-linecap="round"
              aria-hidden="true"
            >
              <path d="M9 6.5v11M15 6.5v11"/>
            </svg>
            <svg
              class="tw-hidden tw-h-4 tw-w-4 group-[.is-paused]:tw-block"
              viewBox="0 0 24 24"
              fill="currentColor"
              aria-hidden="true"
            >
              <path d="M8.5 6.2v11.6a.8.8 0 001.22.68l9.2-5.8a.8.8 0 000-1.36l-9.2-5.8a.8.8 0 00-1.22.68z"/>
            </svg>
          </button>

          <button
            type="button"
            class="<?= $rideNavBtn ?>"
            data-ride-prev
            aria-label="Previous ride type"
          >
            <svg
              class="tw-h-4 tw-w-4 tw-transition-transform tw-duration-300 group-hover:tw--translate-x-0.5 motion-reduce:tw-transition-none"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              aria-hidden="true"
            >
              <path d="M15 6l-6 6 6 6"/>
            </svg>
          </button>

          <button
            type="button"
            class="<?= $rideNavBtn ?>"
            data-ride-next
            aria-label="Next ride type"
          >
            <svg
              class="tw-h-4 tw-w-4 tw-transition-transform tw-duration-300 group-hover:tw-translate-x-0.5 motion-reduce:tw-transition-none"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
              aria-hidden="true"
            >
              <path d="M9 6l6 6-6 6"/>
            </svg>
          </button>

        </div>
      </div>

      <div
        data-ride-viewport
        class="tw-overflow-hidden"
      >
        <div
          data-ride-track
          class="[&.is-ready]:tw-flex [&.is-ready]:tw-w-full [&.is-ready]:tw-transition-transform [&.is-ready]:tw-duration-700 [&.is-ready]:tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:[&.is-ready]:tw-transition-none"
        >
          <?php foreach ($rideTypes as $i => $ride): ?>

            <div
              class="tw-w-full tw-shrink-0"
              role="group"
              aria-roledescription="slide"
              aria-label="<?= $i + 1 ?> of <?= count($rideTypes) ?>: <?= htmlspecialchars($ride['title']) ?>"
            >
              <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2">
                <div class="tw-relative tw-min-h-[6rem] tw-overflow-hidden sm:tw-min-h-[7rem] lg:tw-min-h-[9rem]">
                  <img
                    src="<?= $assetPath ?>assets/img/rides-types/<?= $ride['img'] ?>"
                    alt=""
                    aria-hidden="true"
                    loading="lazy"
                    class="tw-absolute tw-inset-[-12%] tw-h-[124%] tw-w-[124%] tw-scale-110 tw-object-cover tw-blur-lg tw-saturate-150 tw-opacity-30"
                  >
                  <div class="tw-absolute tw-inset-0 tw-bg-gradient-to-br tw-from-white/80 via-white/45 to-peach/55"></div>
                  <div class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-h-40 tw-bg-gradient-to-t tw-from-black/[0.14] to-transparent"></div>
                  <div class="tw-absolute tw-left-5 tw-top-5 tw-z-10 sm:tw-left-7 sm:tw-top-7 lg:tw-left-9 lg:tw-top-9">

                    <span class="tw-block tw-text-[4.5rem] tw-font-black tw-leading-none tw-tracking-[-0.08em] tw-text-ink/[0.08] sm:tw-text-[6rem]">
                      <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                    </span>

                  </div>

                  <div class="tw-relative tw-flex tw-h-full tw-items-center tw-justify-center <?= $rideSlidePad ?>">
                    <div class="tw-relative tw-w-full tw-max-w-[23rem] tw-transition-transform tw-duration-700">
                      <div class="tw-absolute tw-bottom-[-1rem] tw-left-[12%] tw-h-10 tw-w-[76%] tw-rounded-[50%] tw-bg-ink/15 tw-blur-2xl"></div>
                      <div class="tw-relative tw-aspect-square tw-overflow-hidden tw-rounded-[1.75rem] tw-border tw-bg-white/30 tw-shadow-[0_30px_70px_-18px_rgba(28,20,16,0.30)] tw-backdrop-blur-sm sm:tw-rounded-[2rem]">

                        <img
                          src="<?= $assetPath ?>assets/img/rides-types/<?= $ride['img'] ?>"
                          alt="PowerCabs <?= htmlspecialchars($ride['title']) ?>"
                          loading="<?= $i === 0 ? 'eager' : 'lazy' ?>"
                          class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover"
                        >

                        <div class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-gradient-to-br tw-from-white/25 via-transparent to-black/[0.08]"></div>
                      </div>
                    </div>
                  </div>

                  <div class="tw-absolute tw-bottom-5 tw-left-5 tw-z-10 sm:tw-bottom-7 sm:tw-left-7 lg:tw-bottom-9 lg:tw-left-9">
                    <div class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-white/50 tw-bg-white/65 tw-px-3 tw-py-1.5 tw-shadow-sm tw-backdrop-blur-xl">
                      <span class="tw-h-1.5 tw-w-1.5 tw-rounded-full tw-bg-power"></span>
                      <span class="tw-text-[0.65rem] tw-font-bold tw-uppercase tw-tracking-[0.15em] tw-text-ink/70">
                        PowerCabs
                      </span>
                    </div>
                  </div>
                </div>

                <div class="tw-relative tw-flex tw-flex-col tw-justify-center tw-overflow-hidden tw-bg-white <?= $rideSlidePad ?>">
                  <div class="tw-absolute tw-right-[-4rem] tw-top-[-4rem] tw-h-32 tw-w-32 tw-rounded-full tw-border-[18px] tw-border-solid tw-border-power/[0.035]"></div>
                  <div class="tw-relative tw-z-10">
                    <div class="tw-mb-5 tw-flex tw-items-center tw-gap-3">
                      <span class="tw-h-px tw-w-8 tw-bg-power"></span>
                      <span class="tw-text-[0.68rem] tw-font-bold tw-uppercase tw-tracking-[0.18em] tw-text-power">
                        Ride Type <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                      </span>
                    </div>

                    <h3 class="tw-mb-4 tw-max-w-xl tw-text-[clamp(2rem,4vw,3.25rem)] tw-font-extrabold tw-leading-[0.98] tw-tracking-[-0.045em] tw-text-ink">
                      <?= htmlspecialchars($ride['title']) ?>
                    </h3>

                    <p class="tw-mb-7 tw-max-w-[46ch] tw-text-[0.98rem] tw-leading-[1.75] tw-text-ink/[0.57] sm:tw-text-[1.04rem]">
                      <?= htmlspecialchars($ride['desc']) ?>
                    </p>

                    <div class="tw-mb-9 tw-flex tw-flex-wrap tw-gap-2.5">
                      <?php foreach ($ride['specs'] as $spec): ?>
                        <span class="tw-group tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-[#faf9f7] tw-py-2 tw-pl-2 tw-pr-3.5 tw-text-[0.78rem] tw-font-bold tw-text-ink/[0.68] tw-shadow-[0_3px_12px_rgba(28,20,16,0.035)] tw-transition-all tw-duration-300 hover:tw-border-power/15 hover:tw-bg-peach/35 motion-reduce:tw-transition-none">
                          <span class="tw-inline-flex tw-h-8 tw-w-8 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-lg tw-bg-white tw-text-power tw-shadow-[0_2px_8px_rgba(28,20,16,0.06)]">
                            <?php pc_ride_spec_icon($spec['icon']); ?>
                          </span>
                          <?= htmlspecialchars($spec['label']) ?>
                        </span>
                      <?php endforeach; ?>
                    </div>

                    <div class="tw-flex tw-flex-col tw-items-start tw-gap-5 sm:tw-flex-row sm:tw-items-center sm:tw-justify-between">
                      <a
                        href="<?= $assetPath ?>/book-ride-online"
                        class="<?= $pcBtnPrimary ?>"
                      >
                        Book this ride
                        <?php /* No hover nudge on the arrow. $pcBtnPrimary's hover
                                 is its fill and glow, on the pill only -- an icon
                                 that slides as well makes the label and the
                                 chevron drift apart inside it. */ ?>
                        <svg
                          class="tw-h-4 tw-w-4 tw-shrink-0"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          aria-hidden="true"
                        >
                          <path d="M5 12h14"/>
                          <path d="m13 6 6 6-6 6"/>
                        </svg>
                      </a>

                      <div class="tw-hidden tw-items-center tw-gap-2.5 sm:tw-flex">
                        <span class="tw-text-[0.65rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] tw-text-ink/30">
                          Explore
                        </span>
                        <span class="tw-h-px tw-w-8 tw-bg-black/10"></span>
                        <span class="tw-text-[0.72rem] tw-font-bold tw-tabular-nums tw-text-ink/45">
                          <?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?>
                        </span>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

          <?php endforeach; ?>
        </div>
      </div>

      <div
        data-ride-dots
        class="tw-hidden [&.is-ready]:tw-flex tw-items-center tw-justify-center tw-gap-1.5 tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.06] tw-bg-white tw-px-5 tw-py-4 sm:tw-py-5"
      >
        <?php foreach ($rideTypes as $i => $ride): ?>
          <button
            type="button"
            data-ride-dot="<?= $i ?>"
            aria-label="Show <?= htmlspecialchars($ride['title']) ?>"
            class="tw-h-1.5 tw-w-1.5 tw-appearance-none tw-rounded-full tw-border-0 tw-bg-ink/15 tw-p-0 tw-transition-all tw-duration-500 hover:tw-bg-ink/35 focus-visible:tw-outline focus-visible:tw-outline-2 focus-visible:tw-outline-offset-4 focus-visible:tw-outline-power motion-reduce:tw-transition-none [&[aria-current=true]]:tw-w-10 [&[aria-current=true]]:tw-bg-power"
          ></button>

        <?php endforeach; ?>

      </div>
    </div>
  </div>

</section>

<?php /* Slider behaviour: looping prev/next, dots, swipe, arrow keys, and
         autoplay with pause. See the notes at the top of the script. */ ?>
<script src="<?= $assetPath ?>assets/js/components/ride-types-slider.js?v=<?= @filemtime(
  __DIR__ . '/../../assets/js/components/ride-types-slider.js',
) ?>"></script>