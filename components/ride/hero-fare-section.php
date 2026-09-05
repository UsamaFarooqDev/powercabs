<?php
$rideTypeOptions ??= [
  'Economy',
  'Economy XL',
  'Limousine',
  'Wheelchair Taxi',
  'Pets Taxi',
  'Courier / Parcel',
  'Business',
  'Business XL',
];

$rideTrustItems = [
  ['icon' => 'badge', 'title' => 'NTA Licensed', 'sub' => 'DH12616'],
  ['icon' => 'ie-badge', 'title' => 'Irish Company', 'sub' => 'PowerCabs Ireland Limited'],
  ['icon' => 'pin', 'title' => 'Dublin Based', 'sub' => 'Local Irish service'],
  ['icon' => 'phone', 'title' => 'Real Support', 'sub' => '+353 89 972 8089'],
];

// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = 'pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink';
$submitClass = $pcBtnPrimary . ' tw-w-full';
$addonCardClass = 'tw-flex tw-w-full tw-cursor-pointer tw-items-center tw-gap-2.5 tw-rounded-lg tw-border tw-border-solid tw-border-ink/15 tw-px-3.5 tw-py-2.5 tw-text-left tw-text-sm tw-text-ink tw-transition-colors tw-duration-200 has-[:checked]:tw-border-ink has-[:checked]:tw-bg-ink has-[:checked]:tw-text-white';

function pc_ride_hero_icon(string $icon, string $cls = 'tw-h-5 tw-w-5'): void
{
  switch ($icon):
    case 'check': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 011.04-.207z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'clock': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <?php break;
    case 'crosshair': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.364-6.364l-1.591 1.591M7.227 16.773l-1.591 1.591m0-12.728l1.591 1.591m9.546 9.546l1.591 1.591M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
    <?php break;
    case 'badge': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'pin': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
    <?php break;
    case 'phone': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a1.5 1.5 0 001.5-1.5v-2.4a1.5 1.5 0 00-1.157-1.46l-3.727-.932a1.5 1.5 0 00-1.516.397l-1.03 1.03a11.25 11.25 0 01-6.464-6.464l1.03-1.03a1.5 1.5 0 00.397-1.516L6.859 3.657a1.5 1.5 0 00-1.46-1.157H3a1.5 1.5 0 00-1.5 1.5v.75z"/></svg>
    <?php break;
    case 'bag': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25l2 2 4-4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
    <?php break;
    case 'person-check': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M18 8.25l1.25 1.25L21.75 7"/></svg>
    <?php break;
    case 'suitcase': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 9V5.25A2.25 2.25 0 0110.5 3h3a2.25 2.25 0 012.25 2.25V9m-9 10.5h9a2.25 2.25 0 002.25-2.25V11.25A2.25 2.25 0 0015.75 9H8.25A2.25 2.25 0 006 11.25v6a2.25 2.25 0 002.25 2.25z"/></svg>
    <?php break;
    case 'send': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
    <?php break;
  endswitch;
}
?>
<!-- ============ Fare Estimate + "Your Taxi. Your Choice." panel ============ -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-20 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-stretch tw-gap-12 lg:tw-grid-cols-2">

      <!-- Left: "Your Taxi. Your Choice. Irish-owned." -->
      <div class="tw-order-2 tw-flex tw-flex-col tw-justify-center lg:tw-order-1">
        <h2 class="tw-mb-3 tw-text-[clamp(2rem,3.4vw,2.75rem)] tw-font-bold tw-leading-[1.15] tw-tracking-[-0.03em] tw-text-ink">
          Your Taxi. Your Choice. <span class="tw-text-power">Irish-owned.</span>
        </h2>

        <p class="tw-mb-6 tw-max-w-[42ch] tw-text-[1.05rem] tw-leading-[1.7] tw-text-ink/60">
          PowerCabs is an Irish taxi company based in Dublin, connecting you
          with licensed, Garda-vetted drivers for everyday journeys, airport
          transfers, business travel and more.
        </p>

        <div class="tw-flex tw-flex-wrap tw-gap-2">
          <?php foreach ([
            'Licensed &amp; Garda-vetted drivers',
            'Available 24/7',
            'Real-time tracking',
            'Irish local support',
          ] as $badge): ?>
            <span class="tw-inline-flex tw-items-center tw-gap-1.5 tw-rounded-full tw-border tw-border-solid tw-border-black/[0.1] tw-px-3.5 tw-py-2 tw-text-[0.8rem] tw-font-semibold tw-text-ink">
              <span class="tw-text-power"><?php pc_ride_hero_icon('check', 'tw-h-4 tw-w-4'); ?></span> <?= $badge ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Right: Uber-style fare estimate widget -->
      <div class="tw-order-1 lg:tw-order-2">
        <div class="tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-[clamp(1.5rem,3vw,2.5rem)] tw-shadow-[0_24px_60px_rgba(28,20,16,0.1)]">
          <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-paper tw-px-3.5 tw-py-1.5 tw-text-[0.8rem] tw-font-semibold tw-text-ink">
            <span class="tw-text-power"><?php pc_ride_hero_icon('clock', 'tw-h-3.5 tw-w-3.5'); ?></span> Pickup Now
          </span>

          <h2 class="tw-mb-1 tw-mt-3 tw-text-2xl tw-font-bold tw-text-ink">Know Your Fare, <span class="tw-text-power">Instantly.</span></h2>
          <p class="tw-mb-4 tw-text-ink/60">Enter your pickup and drop-off to see the standard fare before you book.</p>

          <div class="tw-flex tw-rounded-xl tw-bg-paper-soft tw-px-4 tw-py-1">
            <div class="tw-flex tw-w-6 tw-shrink-0 tw-flex-col tw-items-center tw-py-[1.15rem]">
              <span class="tw-h-[10px] tw-w-[10px] tw-shrink-0 tw-rounded-full tw-border-2 tw-border-solid tw-border-ink" aria-hidden="true"></span>
              <span class="tw-my-1.5 tw-w-px tw-flex-1 tw-bg-black/[0.18]" aria-hidden="true"></span>
              <span class="tw-h-[10px] tw-w-[10px] tw-shrink-0 tw-rounded-sm tw-bg-ink" aria-hidden="true"></span>
            </div>
            <div class="tw-min-w-0 tw-flex-1">
              <div class="tw-flex tw-items-center tw-gap-2 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.08] tw-py-3.5">
                <input type="text" id="rfPickup" class="tw-min-w-0 tw-flex-1 tw-border-0 tw-bg-transparent tw-text-base tw-font-semibold tw-text-ink tw-outline-none placeholder:tw-font-medium placeholder:tw-text-ink/40" placeholder="Pickup location" autocomplete="off">
                <button type="button" id="rfLocateBtn" class="tw-flex tw-shrink-0 tw-appearance-none tw-items-center tw-border-0 tw-bg-transparent tw-p-1 tw-text-power disabled:tw-opacity-50" aria-label="Use current location">
                  <?php pc_ride_hero_icon('crosshair', 'tw-h-[1.1rem] tw-w-[1.1rem]'); ?>
                </button>
              </div>
              <div class="tw-flex tw-items-center tw-gap-2 tw-py-3.5">
                <input type="text" id="rfDropoff" class="tw-min-w-0 tw-flex-1 tw-border-0 tw-bg-transparent tw-text-base tw-font-semibold tw-text-ink tw-outline-none placeholder:tw-font-medium placeholder:tw-text-ink/40" placeholder="Drop-off location" autocomplete="off">
              </div>
            </div>
          </div>

          <!-- Promo code. Optional, and deliberately above the ride-type
               select: the Power10 section further down this same page has a
               copy-to-clipboard POWER10 chip, so a visitor arrives back here
               with a code on the clipboard and this is the first field they
               look for. Nothing about it gates the estimate -- the button
               enables on pickup/drop-off/ride type alone.
               The code is only ever CHECKED server-side (the discount comes
               back from api/estimate_fare.php); this field is just input. -->
          <div class="tw-mt-3">
            <input type="text" id="rfPromoCode" name="promo_code" maxlength="32" autocomplete="off"
                   spellcheck="false" aria-describedby="rfPromoStatus"
                   class="<?= $inputClass ?> tw-tracking-[0.04em] placeholder:tw-normal-case placeholder:tw-tracking-normal"
                   placeholder="Promo code (optional)">
            <p id="rfPromoStatus" class="tw-hidden tw-mb-0 tw-mt-1.5 tw-text-[0.85rem] tw-leading-snug" aria-live="polite"></p>
          </div>

          <div class="tw-mt-3">
            <select id="rfRideType" class="<?= $inputClass ?> pc-custom-select-enhance">
              <option value="" selected>Select ride type</option>
              <?php foreach ($rideTypeOptions as $type): ?>
                <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Bare functional hooks -- ride-fare-estimate.js drives all
               state here (disabled toggling, textContent, tw-hidden, spinner
               swap via .spinner-border) directly by id/class, unchanged. -->
          <button type="button" id="rfSubmit" class="tw-mt-4 tw-inline-flex tw-w-full tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-powerlight tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)] disabled:tw-pointer-events-none disabled:tw-translate-y-0 disabled:tw-opacity-40 disabled:tw-shadow-none" disabled>
            Get Fare Estimate
          </button>

          <p id="rfFareError" class="tw-hidden tw-mb-0 tw-mt-3 tw-text-[1.0625rem] tw-leading-relaxed tw-text-red-600" role="alert"></p>

          <div id="rfFareResult" class="tw-hidden tw-mt-4 tw-rounded-xl tw-bg-paper tw-p-5">
            <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-between tw-gap-3">
              <div>
                <span class="tw-block tw-text-sm tw-text-ink/60" id="rfFareTypeLabel">Standard Fare</span>
                <span class="tw-block tw-text-[1.85rem] tw-font-bold tw-text-ink" id="rfFareValue">&ndash;</span>
              </div>
              <span class="tw-block tw-text-right tw-text-sm tw-text-ink/60">
                <span id="rfFareDistance">&ndash;</span> km &middot; <span id="rfFareDuration">&ndash;</span> min
              </span>
            </div>

            <!-- Shown only when a code actually came back applied. The
                 wrapper carries tw-hidden and the row inside carries
                 tw-flex, rather than both on one element -- two display
                 utilities on the same element only resolve correctly by
                 source order, which is not a thing to rely on. -->
            <div id="rfFarePromoRow" class="tw-hidden tw-mt-3 tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.08] tw-pt-3">
              <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-between tw-gap-2">
                <span class="tw-inline-flex tw-items-center tw-gap-1.5 tw-text-[0.85rem] tw-font-bold tw-uppercase tw-tracking-[0.06em] tw-text-[#146c43]">
                  <svg class="tw-h-3.5 tw-w-3.5 tw-shrink-0" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M16 8A8 8 0 110 8a8 8 0 0116 0zm-3.97-3.03a.75.75 0 00-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 10-1.06 1.06L6.97 11.03a.75.75 0 001.079-.02l3.992-4.99a.75.75 0 00-.01-1.05z"/></svg>
                  <span id="rfFarePromoCode">&ndash;</span>
                </span>
                <span class="tw-text-[0.9rem] tw-text-ink/60">
                  <s id="rfFarePromoBefore">&ndash;</s>
                  <span class="tw-ml-1.5 tw-font-bold tw-text-[#146c43]" id="rfFarePromoDiscount">&ndash;</span>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ============ Trust badge bar ============ -->
<section class="tw-px-4 tw-pb-16 md:tw-pb-24 sm:tw-px-6 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-divide-y tw-divide-solid tw-divide-black/[0.08] tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-shadow-[0_20px_45px_rgba(28,20,16,0.1)] sm:tw-grid-cols-2 md:tw-grid-cols-4 md:tw-divide-x md:tw-divide-y-0">
      <?php foreach ($rideTrustItems as $item): ?>
        <div class="tw-flex tw-items-center tw-gap-3 tw-p-5">
          <span class="tw-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-paper tw-text-power">
            <?php if ($item['icon'] === 'ie-badge'): ?>
              <span class="tw-text-[0.7rem] tw-font-bold tw-tracking-[0.02em]">IE</span>
            <?php else: ?>
              <?php pc_ride_hero_icon($item['icon'], 'tw-h-[1.05rem] tw-w-[1.05rem]'); ?>
            <?php endif; ?>
          </span>
          <span>
            <span class="tw-block tw-text-[0.92rem] tw-font-bold tw-text-ink"><?= htmlspecialchars(
              $item['title'],
            ) ?></span>
            <span class="tw-block tw-text-sm tw-text-ink/60"><?= htmlspecialchars($item['sub']) ?></span>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Quick Book Modal (opens after "Continue") ============ -->
<!-- Driven by the modal helper in assets/js/components/ui.js;
     ride-fare-estimate.js opens it via pcModal.getOrCreateInstance() and
     relocates this element to a direct child of <body> to escape <main>'s
     stacking context. -->
<div class="tw-hidden tw-fixed tw-inset-0 tw-z-[1055] tw-overflow-y-auto tw-overscroll-contain tw-px-4 tw-py-8" id="rfBookModal" data-pc-modal tabindex="-1" role="dialog" aria-labelledby="rfBookModalLabel" aria-hidden="true">
  <div class="tw-mx-auto tw-flex tw-min-h-full tw-items-center tw-opacity-0 tw-translate-y-3 tw-transition-[opacity,transform] tw-duration-200 [.is-open_&]:tw-opacity-100 [.is-open_&]:tw-translate-y-0 motion-reduce:tw-transition-none tw-max-w-[500px]">
    <div class="tw-w-full tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.25)]">
      <form method="post" action="" class="tw-p-6 md:tw-p-9">
        <div class="tw-mb-6 tw-flex tw-items-start tw-justify-between">
          <div>
            <p class="tw-mb-1 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Quick Book</p>
            <h3 class="tw-mb-0 tw-text-xl tw-font-bold tw-text-ink" id="rfBookModalLabel">Confirm Your Ride</h3>
          </div>
          <button type="button" class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-black/[0.05] tw-text-ink/70 tw-transition-colors hover:tw-bg-black/10 hover:tw-text-ink" data-pc-modal-close aria-label="Close"><svg class="tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 3l10 10M13 3L3 13"/></svg></button>
        </div>

        <div class="tw-mb-6 tw-rounded-xl tw-bg-paper-soft tw-p-4">
          <div class="tw-mb-2 tw-flex tw-items-start tw-gap-2">
            <span class="tw-mt-1.5 tw-h-2 tw-w-2 tw-shrink-0 tw-rounded-full tw-bg-power" aria-hidden="true"></span>
            <span class="tw-text-sm tw-text-ink" id="rfModalPickupText">&ndash;</span>
          </div>
          <div class="tw-mb-2 tw-flex tw-items-start tw-gap-2">
            <span class="tw-mt-1.5 tw-h-2 tw-w-2 tw-shrink-0 tw-rounded-sm tw-bg-ink" aria-hidden="true"></span>
            <span class="tw-text-sm tw-text-ink" id="rfModalDropoffText">&ndash;</span>
          </div>
          <div class="tw-mt-2 tw-flex tw-items-center tw-justify-between tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.08] tw-pt-2">
            <span class="tw-text-sm tw-font-semibold tw-text-ink" id="rfModalRideTypeText">&ndash;</span>
            <span class="tw-font-bold tw-text-ink" id="rfModalFareText">&ndash;</span>
          </div>
          <div id="rfModalPromoRow" class="tw-hidden tw-mt-1.5">
            <div class="tw-flex tw-items-center tw-justify-between tw-gap-2">
              <span class="tw-text-[0.8rem] tw-font-bold tw-uppercase tw-tracking-[0.06em] tw-text-[#146c43]" id="rfModalPromoCodeText">&ndash;</span>
              <span class="tw-text-[0.8rem] tw-font-bold tw-text-[#146c43]" id="rfModalPromoDiscountText">&ndash;</span>
            </div>
          </div>
        </div>

        <input type="hidden" name="pickup_location" id="rfModalPickup">
        <input type="hidden" name="dropoff_location" id="rfModalDropoff">
        <input type="hidden" name="ride_type" id="rfModalRideType">
        <input type="hidden" name="distance_km" id="rfModalDistance">
        <input type="hidden" name="duration_min" id="rfModalDuration">
        <input type="hidden" name="fare_eur" id="rfModalFare">
        <!-- Carried through so ride.php can re-validate it on submit. The
             fare above is display only -- the POST handler recomputes both
             the fare and the promo rather than trusting either field. -->
        <input type="hidden" name="promo_code" id="rfModalPromoCode">

        <div class="tw-mb-4">
          <label class="<?= $labelClass ?>" for="rfModalName">Full Name</label>
          <input type="text" class="<?= $inputClass ?>" id="rfModalName" name="name" required>
        </div>
        <div class="tw-mb-4">
          <label class="<?= $labelClass ?>" for="rfModalEmail">Email Address</label>
          <input type="email" class="<?= $inputClass ?>" id="rfModalEmail" name="email" required>
        </div>
        <div class="tw-mb-6">
          <label class="<?= $labelClass ?>" for="rfModalPhone">Phone Number</label>
          <input type="tel" class="<?= $inputClass ?>" id="rfModalPhone" name="phone" required>
        </div>

        <div class="tw-mb-6">
          <span class="tw-mb-2 tw-block tw-text-sm tw-font-medium tw-text-ink">Trip Add-ons <span class="tw-font-normal tw-text-ink/50">(optional)</span></span>
          <div class="tw-flex tw-flex-col tw-gap-2">
            <label class="<?= $addonCardClass ?>" for="rfOptLuggageAssist">
              <input type="checkbox" class="tw-sr-only" id="rfOptLuggageAssist" name="opt_luggage_assistance" value="1" autocomplete="off">
              <?php pc_ride_hero_icon('bag', 'tw-h-4 tw-w-4 tw-shrink-0'); ?>
              <span>Luggage Assistance <span class="tw-opacity-75">(airport bookings only)</span></span>
            </label>
            <label class="<?= $addonCardClass ?>" for="rfOptMeetGreet">
              <input type="checkbox" class="tw-sr-only" id="rfOptMeetGreet" name="opt_meet_greet" value="1" autocomplete="off">
              <?php pc_ride_hero_icon('person-check', 'tw-h-4 tw-w-4 tw-shrink-0'); ?>
              <span>Meet &amp; Greet <span class="tw-opacity-75">(hotel, doorstep or business venue)</span></span>
            </label>
            <label class="<?= $addonCardClass ?>" for="rfOptLuggageOnly">
              <input type="checkbox" class="tw-sr-only" id="rfOptLuggageOnly" name="opt_luggage_only" value="1" autocomplete="off">
              <?php pc_ride_hero_icon('suitcase', 'tw-h-4 tw-w-4 tw-shrink-0'); ?>
              <span>Only Luggage <span class="tw-opacity-75">(no passengers or pets)</span></span>
            </label>
          </div>
        </div>

        <button type="submit" class="<?= $submitClass ?>">
          <span>Confirm Booking</span>
          <?php pc_ride_hero_icon('send', 'tw-h-3.5 tw-w-3.5'); ?>
        </button>

        <?php if ($quickBookFormStatus === 'success'): ?>
          <div class="alert-success tw-mb-0 tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your booking request has been sent. We'll confirm shortly.</div>
        <?php elseif ($quickBookFormStatus === 'error'): ?>
          <div class="alert-danger tw-mb-0 tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars($quickBookFormError) ?></div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>

<script
  src="https://maps.googleapis.com/maps/api/js?key=<?= PC_GOOGLE_MAPS_API_KEY ?>&libraries=places&callback=initRideFareMap"
  async defer></script>
<script src="<?= $assetPath ?>assets/js/components/ride-fare-estimate.js"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-select.js?v=<?= @filemtime(
  __DIR__ . '/../../assets/js/components/custom-select.js',
) ?>"></script>
