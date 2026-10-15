<?php
$rideTrustItems = [
  ['icon' => 'badge', 'title' => 'NTA Licensed', 'sub' => 'DH12616'],
  ['icon' => 'ie-badge', 'title' => 'Irish Company', 'sub' => 'PowerCabs Ireland Limited'],
  ['icon' => 'pin', 'title' => 'Dublin Based', 'sub' => 'Local Irish service'],
  ['icon' => 'phone', 'title' => 'Real Support', 'sub' => '+353 89 972 8089'],
];

require_once __DIR__ . '/icons.php';

$inputClass = $pcInput;
$labelClass = 'pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink';
$submitClass = $pcBtnPrimary . ' tw-w-full';
$addonCardClass =
  'tw-flex tw-w-full tw-cursor-pointer tw-items-center tw-gap-2.5 tw-rounded-lg tw-border tw-border-solid tw-border-ink/15 tw-px-3.5 tw-py-2.5 tw-text-left tw-text-sm tw-text-ink tw-transition-colors tw-duration-200 has-[:checked]:tw-border-ink has-[:checked]:tw-bg-ink has-[:checked]:tw-text-white';
?>
<?php
$rideChoicePoints = [
  ['icon' => 'badge', 'label' => 'Licensed drivers'],
  ['icon' => 'sparkle', 'label' => 'Clean vehicles'],
  ['icon' => 'crosshair', 'label' => 'Real-time tracking'],
  ['icon' => 'clock', 'label' => 'Available 24/7'],
  ['icon' => 'paw', 'label' => 'Pet-friendly rides'],
  ['icon' => 'hourglass', 'label' => 'Book per hour'],
  ['icon' => 'compass', 'label' => 'City tours'],
  ['icon' => 'search', 'label' => 'Lost &amp; found assistance'],
];
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <?php  ?>
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-16">

      <div class="lg:tw-col-span-7">
        <h2 class="<?= $pcH2Display ?> tw-max-w-[22ch]">
          Your Taxi. Your Choice. <span class="tw-text-power">Irish-owned.</span>
        </h2>

        <?php  ?>
        <p class="tw-mb-3 tw-max-w-[60ch] tw-text-[1.1875rem] tw-font-semibold tw-leading-[1.5] tw-tracking-[-0.005em] tw-text-ink">
          PowerCabs &mdash; the Irish way to travel.
        </p>

        <p class="tw-mb-4 tw-max-w-[62ch] tw-text-[1.05rem] tw-leading-[1.7] tw-text-ink/60">
          With an effortless booking process, professional Garda-vetted drivers
          and a responsive support team ready to assist you by email, WhatsApp
          or through the PowerCabs app, every journey is designed around your
          convenience and peace of mind.
        </p>

        <p class="tw-mb-0 tw-max-w-[62ch] tw-text-[1.05rem] tw-leading-[1.7] tw-text-ink/60">
          Whether it&rsquo;s your daily commute, an airport transfer or an
          important business trip, PowerCabs makes getting there easier than
          ever.
        </p>
      </div>

      <div class="lg:tw-col-span-5">
        <?php  ?>
        <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-x-5 tw-gap-y-3 tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-6 tw-shadow-[0_1px_3px_rgba(28,20,16,0.05)] sm:tw-grid-cols-2 lg:tw-grid-cols-1 xl:tw-grid-cols-2">
          <?php foreach ($rideChoicePoints as $point): ?>
            <li class="tw-group/pt tw-flex tw-items-center tw-gap-3 tw-text-[0.9rem] tw-font-semibold tw-leading-snug tw-text-ink">
              <?php  ?>
              <span class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-peach tw-text-power tw-transition-colors tw-duration-200 group-hover/pt:tw-bg-power group-hover/pt:tw-text-white motion-reduce:tw-transition-none">
                <?php pc_ride_hero_icon($point['icon'], 'tw-h-[1.05rem] tw-w-[1.05rem]'); ?>
              </span>
              <?= $point['label'] ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>
  </div>
</section>

<section class="tw-pb-16 md:tw-pb-24">
  <div class="<?= $pcContainer ?>">
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

<div class="tw-hidden tw-fixed tw-inset-0 tw-z-[1055] tw-overflow-y-auto tw-overscroll-contain tw-px-4 tw-py-8" id="rfBookModal" data-pc-modal tabindex="-1" role="dialog" aria-labelledby="rfBookModalLabel" aria-hidden="true">
  <div class="tw-mx-auto tw-flex tw-min-h-full tw-items-center tw-opacity-0 tw-translate-y-3 tw-transition-[opacity,transform] tw-duration-200 [.is-open_&]:tw-opacity-100 [.is-open_&]:tw-translate-y-0 motion-reduce:tw-transition-none tw-max-w-[500px]">
    <div class="tw-w-full tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.25)]">
      <form method="post" action="" class="tw-p-6 md:tw-p-9">
        <div class="tw-mb-6 tw-flex tw-items-start tw-justify-between">
          <div>
            <p class="tw-mb-1 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">Quick Book</p>
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
          <p class="tw-mb-0 tw-mt-2.5 tw-text-[0.8125rem] tw-leading-relaxed tw-text-ink/55">
            Estimated fare is for one person with standard luggage, any extra passenger will incure &euro;1 extra to the booking.
          </p>
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

<?php  ?>
<script src="<?= $assetPath ?>assets/js/components/ride-fare-estimate.js?v=<?= @filemtime(__DIR__ . '/../../assets/js/components/ride-fare-estimate.js') ?>"></script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=<?= PC_GOOGLE_MAPS_API_KEY ?>&libraries=places&callback=initRideFareMap"
  async defer></script>
<script src="<?= $assetPath ?>assets/js/components/custom-select.js?v=<?= @filemtime(
  __DIR__ . '/../../assets/js/components/custom-select.js',
) ?>"></script>
