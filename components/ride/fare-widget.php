<?php
/**
 * The fare estimate card -- markup only, no section around it.
 *
 * It used to be the right-hand column of hero-fare-section.php, one screen
 * below the hero. It is the first thing a rider wants on /ride, so it is in
 * the hero now (components/ride/hero.php), in the same position the driver
 * application occupies on /drive. Same markup, same ids, same behaviour --
 * ride-fare-estimate.js drives every one of these by id and none of them
 * changed.
 *
 * The scripts that drive it still load at the END of hero-fare-section.php,
 * which ride.php requires after the hero, so this markup is always in the DOM
 * before they run.
 */
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

require_once __DIR__ . '/icons.php';

// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
?>
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
        <input type="text" id="rfPickup" aria-label="Pickup location" class="tw-min-w-0 tw-flex-1 tw-border-0 tw-bg-transparent tw-text-base tw-font-semibold tw-text-ink tw-outline-none placeholder:tw-font-medium placeholder:tw-text-ink/40" placeholder="Pickup location" autocomplete="off">
        <button type="button" id="rfLocateBtn" class="tw-flex tw-shrink-0 tw-appearance-none tw-items-center tw-border-0 tw-bg-transparent tw-p-1 tw-text-power disabled:tw-opacity-50" aria-label="Use current location">
          <?php pc_ride_hero_icon('crosshair', 'tw-h-[1.1rem] tw-w-[1.1rem]'); ?>
        </button>
      </div>
      <div class="tw-flex tw-items-center tw-gap-2 tw-py-3.5">
        <input type="text" id="rfDropoff" aria-label="Drop-off location" class="tw-min-w-0 tw-flex-1 tw-border-0 tw-bg-transparent tw-text-base tw-font-semibold tw-text-ink tw-outline-none placeholder:tw-font-medium placeholder:tw-text-ink/40" placeholder="Drop-off location" autocomplete="off">
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
    <input type="text" id="rfPromoCode" aria-label="Promo code (optional)" name="promo_code" maxlength="32" autocomplete="off"
           spellcheck="false" aria-describedby="rfPromoStatus"
           class="<?= $inputClass ?> tw-tracking-[0.04em] placeholder:tw-normal-case placeholder:tw-tracking-normal"
           placeholder="Promo code (optional)">
    <p id="rfPromoStatus" class="tw-hidden tw-mb-0 tw-mt-1.5 tw-text-[0.85rem] tw-leading-snug" aria-live="polite"></p>
  </div>

  <div class="tw-mt-3">
    <select id="rfRideType" aria-label="Ride type" class="<?= $inputClass ?> pc-custom-select-enhance">
      <option value="" selected>Select ride type</option>
      <?php foreach ($rideTypeOptions as $type): ?>
        <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Bare functional hooks -- ride-fare-estimate.js drives all
       state here (disabled toggling, textContent, tw-hidden, spinner
       swap via .spinner-border) directly by id/class, unchanged.
       The pill repeats $pcBtnPrimary inline because it is full-width
       and has a disabled state; it must stay in step with the recipe:
       hover deepens the glow and changes nothing else, and a disabled
       button drops the shadow entirely. -->
  <button type="button" id="rfSubmit" class="tw-mt-4 tw-inline-flex tw-w-full tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-powerlight tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-shadow-none tw-transition tw-duration-300 hover:tw-shadow-[0_12px_28px_rgba(255,122,0,0.38)] disabled:tw-pointer-events-none disabled:tw-opacity-40" disabled>
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
