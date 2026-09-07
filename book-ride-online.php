<?php
$pageTitle = 'Book a Taxi Online in Dublin | PowerCabs';
$pageDescription =
  'Book a taxi online in Dublin with PowerCabs in a few simple steps -- no extra charge for pre-booking, no cancellation fee.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';
require __DIR__ . '/lib/fare_calculator.php';

$rideTypeOptions = [
  'Economy',
  'Economy XL',
  'Limousine',
  'Wheelchair Taxi',
  'Pets Taxi',
  'Courier / Parcel',
  'Business',
  'Business XL',
];

$formStatus = null;
$formError = '';
$old = [
  'name' => '',
  'email' => '',
  'phone' => '',
  'ride_type' => '',
  'pickup_location' => '',
  'dropoff_location' => '',
  'ride_date' => '',
  'ride_time' => '',
  'pickup_lat' => '',
  'pickup_lng' => '',
  'dropoff_lat' => '',
  'dropoff_lng' => '',
  'distance_km' => '',
  'duration_min' => '',
  'fare_eur' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($old as $key => $default) {
    $old[$key] = trim($_POST[$key] ?? '');
  }

  if (
    $old['name'] === '' ||
    $old['email'] === '' ||
    $old['phone'] === '' ||
    $old['ride_type'] === '' ||
    $old['pickup_location'] === '' ||
    $old['dropoff_location'] === '' ||
    $old['ride_date'] === '' ||
    $old['ride_time'] === ''
  ) {
    $formStatus = 'error';
    $formError = 'Please fill in all required fields.';
  } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $formStatus = 'error';
    $formError = 'Please enter a valid email address.';
  } else {
    // The client only ever supplies the trip-dependent inputs (distance/
    // duration, from Google Directions) -- the fare itself is always
    // recomputed here, never trusted from the submitted form. Whatever
    // fare the browser displayed was itself sourced from
    // api/estimate_fare.php, so this recompute should normally just
    // confirm it -- but the server is what actually goes in the email.
    if (
      $old['distance_km'] !== '' &&
      is_numeric($old['distance_km']) &&
      $old['duration_min'] !== '' &&
      is_numeric($old['duration_min'])
    ) {
      $recomputed = pc_calculate_fare((float) $old['distance_km'], (float) $old['duration_min'], $old['ride_type']);
      $old['fare_eur'] = number_format($recomputed['fare_eur'], 2, '.', '');
    } else {
      $old['fare_eur'] = '';
    }

    $body =
      "New online booking request from the PowerCabs website.\n\n" .
      "Name: {$old['name']}\n" .
      "Email: {$old['email']}\n" .
      "Phone: {$old['phone']}\n" .
      "Ride Type: {$old['ride_type']}\n\n" .
      "Pickup Location: {$old['pickup_location']}\n" .
      "Drop-off Location: {$old['dropoff_location']}\n" .
      "Date: {$old['ride_date']}\n" .
      "Time: {$old['ride_time']}\n";

    if ($old['distance_km'] !== '' && $old['duration_min'] !== '' && $old['fare_eur'] !== '') {
      $body .=
        "\nEstimated Distance: {$old['distance_km']} km\n" .
        "Estimated Duration: {$old['duration_min']} min\n" .
        "Estimated Fare: \u{20AC}{$old['fare_eur']}\n";
    }

    $result = pc_send_mail('Online booking: ' . $old['name'], $body, [
      'name' => $old['name'],
      'email' => $old['email'],
    ]);

    if ($result['success']) {
      $formStatus = 'success';
      foreach ($old as $key => $default) {
        $old[$key] = '';
      }
    } else {
      $formStatus = 'error';
      $formError = 'Sorry, something went wrong sending your booking. Please try again or call us directly.';
    }
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Book Online';
$heroTitleLight = 'Book Ride';
$heroTitleBold = 'Online.';
$heroDescription =
  'Booking a ride with PowerCabs is now easier than ever. Use our simple and efficient online booking system to schedule your next trip in just a few steps.';
$heroBgImage = 'https://images.pexels.com/photos/6945640/pexels-photo-6945640.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<!-- ============ Booking Steps ============ -->
<section class="tw-relative tw-overflow-hidden <?= $pcSection ?>">
  <div class="tw-relative tw-z-[1] <?= $pcContainer ?>">
    <div class="tw-mb-10 tw-text-center">
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Booking in Four Simple Steps</h2>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2">
      <div class="tw-grid tw-grid-cols-2 tw-gap-3">
        <?php
        /* Each step carries an icon that depicts the action, not a repeat of
           the step number -- the numeral is already the watermark behind the
           card, so a numbered chip on top of it said the same thing twice.
           Icons match the ones the rest of the site uses for these concepts
           (pin for a location, car for a vehicle, clock for a time, tick for
           a confirmation). */
        $bookingSteps = [
          ['n' => 1, 'icon' => 'pin', 'title' => 'Enter Your Pickup and Drop-off Location'],
          ['n' => 2, 'icon' => 'car', 'title' => 'Select Your Ride'],
          ['n' => 3, 'icon' => 'clock', 'title' => 'Choose Your Time'],
          ['n' => 4, 'icon' => 'check', 'title' => 'Confirm Your Booking'],
        ];

        function pc_bro_step_icon(string $icon): void
        {
          $cls = 'tw-h-[1.15rem] tw-w-[1.15rem]';
          switch ($icon):
            case 'pin': ?>
              <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
            <?php break;
            case 'car': ?>
              <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
            <?php break;
            case 'clock': ?>
              <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?php break;
            case 'check': ?>
              <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?php break;
          endswitch;
        }
        ?>
        <?php /* Each card was a flat white box carrying a heavy drop shadow and
                 a ghost numeral, with the title floated against nothing:

                 - the chip at the top holds an icon for the action, while the
                   watermark behind carries the step number -- two different
                   pieces of information rather than the number twice;
                 - the shadow drops to the site's hairline + 1px recipe and the
                   lift moves to hover, so four cards side by side stop
                   competing for depth;
                 - the title is pinned to the bottom with mt-auto, so all four
                   baselines line up however long each label runs. */ ?>
        <?php foreach ($bookingSteps as $step): ?>
          <div class="tw-group tw-relative tw-flex tw-h-full tw-flex-col tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-4 tw-text-left tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] sm:tw-p-5 tw-transition-[transform,box-shadow,border-color] tw-duration-300 tw-ease-out hover:-tw-translate-y-1 hover:tw-border-power/25 hover:tw-shadow-[0_18px_40px_-12px_rgba(28,20,16,0.18)] motion-reduce:tw-transition-none motion-reduce:hover:tw-translate-y-0">
            <!-- Ghost numeral, bottom-right, inset equally from both edges
                 (right-4 / bottom-4) rather than bled off the corner, and light
                 enough to read as a watermark. Hidden from AT: it carries
                 nothing the title does not.

                 The title below carries sm:pr-[4.5rem] BECAUSE of this
                 position. The numeral occupies roughly 70px at the
                 bottom-right, which is exactly where the longest label's last
                 line lands ("...and Drop-off Location") -- without that padding
                 the two overlap and the text becomes unreadable. Move or resize
                 this numeral and that padding has to move with it.

                 Below sm the numeral moves to the TOP-right and shrinks, and
                 the title's right padding goes away with it. These cards sit
                 two-across even on a 360px phone, so each one is ~160px wide;
                 4.5rem of that reserved for a watermark left about 50px for the
                 label, which broke "Enter Your Pickup and Drop-off Location"
                 into a column of single words. Top-right is free space on a
                 phone -- the icon chip is top-LEFT and the title is pinned to
                 the bottom with mt-auto -- so nothing has to give. -->
            <span class="tw-pointer-events-none tw-absolute tw-right-3 tw-top-3 tw-select-none tw-text-[2.25rem] tw-font-black tw-leading-none tw-text-power/[0.06] tw-transition-colors tw-duration-300 group-hover:tw-text-power/[0.09] motion-reduce:tw-transition-none sm:tw-bottom-4 sm:tw-right-4 sm:tw-top-auto sm:tw-text-[3.5rem] sm:tw-text-power/[0.05]" aria-hidden="true">
              <?= str_pad($step['n'], 2, '0', STR_PAD_LEFT) ?>
            </span>

            <span class="tw-relative tw-mb-4 tw-inline-flex tw-h-10 tw-w-10 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-peach tw-text-power tw-transition-colors tw-duration-300 group-hover:tw-bg-power group-hover:tw-text-white motion-reduce:tw-transition-none">
              <?php pc_bro_step_icon($step['icon']); ?>
            </span>

            <h3 class="tw-relative tw-mb-0 tw-mt-auto tw-text-[0.95rem] tw-font-bold tw-leading-snug tw-text-ink sm:tw-pr-[4.5rem] sm:tw-text-[1.05rem]"><?= htmlspecialchars(
              $step['title'],
            ) ?></h3>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="tw-hidden tw-items-center tw-justify-center tw-p-5 lg:tw-flex">
        <!-- rounded-[2rem] matches the radius the rest of the site uses on
             image panels; the soft shadow stops the artwork sitting flat on
             the section background now that the step cards beside it are on a
             hairline rather than a heavy drop shadow. -->
        <img src="<?= $assetPath ?>assets/img/booking-ride.png" class="tw-h-auto tw-w-full tw-max-w-[420px] tw-rounded-[2rem] tw-shadow-[0_18px_45px_-12px_rgba(28,20,16,0.22)]" alt="Book your ride">
      </div>
    </div>
  </div>
</section>

<!-- ============ Booking Form (floating over a full-bleed map) ============ -->
<!-- The map fills the section on its own (`lg:inset-0`), so it can never
     render wider/taller than the section -- no overflow clipping needed
     here. That matters because clipping would also cut off the bottom of
     the Ride Type / Date / Time dropdown panels opened from the form's last
     rows; leaving overflow unset lets those render past the section's own
     bottom edge, same as anywhere else on the site. -->
<section class="tw-relative tw-min-h-[280px]">
  <!-- tw-overflow-hidden is load-bearing, not decoration. The Maps SDK sizes
       its own child div in pixels from whatever this container measured when
       the map initialised. If that happens a frame before the page grows tall
       enough for a vertical scrollbar, the child keeps the pre-scrollbar width
       and pushes the document ~10px wider than the viewport -- an intermittent
       horizontal scroll on mobile (reproduced roughly 1 load in 6 at 390px).
       Clipping here bounds the child to the container whatever it caches. -->
  <div id="pcRideMap" class="tw-relative tw-h-[280px] tw-w-full tw-overflow-hidden lg:tw-absolute lg:tw-inset-0 lg:tw-h-auto lg:tw-w-auto"></div>

  <div class="tw-relative tw-z-[1] tw-flex tw-justify-end">
    <div class="tw-w-full tw-px-4 tw-py-6 sm:tw-px-6 lg:tw-w-1/2 lg:tw-px-0 lg:tw-py-10 lg:tw-pr-10 xl:tw-w-[42%]" id="pcRideFormCol">

      <div class="tw-rounded-[2rem] tw-bg-white tw-p-4 tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] sm:tw-p-6 md:tw-p-8">
        <div class="tw-mb-5 tw-text-left">
          <h3 class="tw-mb-0 tw-text-2xl tw-font-bold tw-tracking-tight tw-text-ink">Please Fill Out the Form</h3>
        </div>

        <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
          <?php // This is the canonical PowerCabs field recipe -- the one every

// other form on the site copies, and the one the shared JS
          // (custom-select.js / custom-datetime.js) reproduces verbatim in
          // its CLS.trigger string, so the enhanced Ride Type / Date / Time
          // triggers next to these fields line up with them pixel for
          // pixel. border-radius 6px, border #dee2e6, font-size 16px, and
          // on focus just a border-color swap to --pc-orange-light with no
          // ring/box-shadow, so nothing focuses with a heavier glow than
          // anything else. text-base (1rem) + leading-normal (1.5) +
          // py-1.5 (0.375rem) + px-3 (0.75rem) + border is what makes the
          // 38px height. Change it here and it has to change in
          // custom-datetime.js's CLS.trigger and custom-select.js's trigger
          // className too.
          $inputClass = $pcInput; ?>
          <div>
            <label class="pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="brName">Full Name</label>
            <input type="text" class="<?= $inputClass ?>" id="brName" name="name"
              value="<?= htmlspecialchars($old['name']) ?>" required>
          </div>
          <div>
            <label class="pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="brEmail">Email Address</label>
            <input type="email" class="<?= $inputClass ?>" id="brEmail" name="email"
              value="<?= htmlspecialchars($old['email']) ?>" required>
          </div>
          <div>
            <label class="pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="brPhone">Phone Number</label>
            <input type="tel" class="<?= $inputClass ?>" id="brPhone" name="phone"
              value="<?= htmlspecialchars($old['phone']) ?>" required>
          </div>
          <div>
            <!-- pc-custom-select-enhance stays as a bare functional hook --
                 custom-select.js (shared with meet-greet.php) progressively
                 enhances any <select> carrying this class into a styled
                 dropdown, which it now styles with Tailwind utilities of
                 its own; there is no .pc-custom-select* stylesheet. -->
            <label class="pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="brRideType">Ride Type</label>
            <select class="<?= $inputClass ?> pc-custom-select-enhance" id="brRideType" name="ride_type" required>
              <option value="" disabled <?= $old['ride_type'] === '' ? 'selected' : '' ?>>Select ride type</option>
              <?php foreach ($rideTypeOptions as $type): ?>
                <option value="<?= htmlspecialchars($type) ?>" <?= $old['ride_type'] === $type
  ? 'selected'
  : '' ?>><?= htmlspecialchars($type) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div>
            <label class="pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="brPickup">Pickup Location</label>
            <input type="text" class="<?= $inputClass ?>" id="brPickup" name="pickup_location"
              value="<?= htmlspecialchars($old['pickup_location']) ?>" autocomplete="off" required>
            <!-- tw-hidden is the exact class string
                 dublin-places-autocomplete.js (shared with meet-greet.php)
                 hardcodes to show/hide this warning -- renaming it means
                 editing that shared file too. -->
            <div class="tw-hidden tw-mt-1.5 tw-text-sm tw-text-red-600" id="brPickupWarning">Please choose a pickup address within Dublin.</div>
          </div>
          <div>
            <label class="pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="brDropoff">Drop-off Location</label>
            <input type="text" class="<?= $inputClass ?>" id="brDropoff" name="dropoff_location"
              value="<?= htmlspecialchars($old['dropoff_location']) ?>" autocomplete="off" required>
            <div class="tw-hidden tw-mt-1.5 tw-text-sm tw-text-red-600" id="brDropoffWarning">Please choose a drop-off address within Dublin.</div>
          </div>
          <div>
            <!-- pc-custom-datetime-enhance: same story as pc-custom-select-enhance above, driven by custom-datetime.js. -->
            <label class="pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="brDate">Date</label>
            <input type="date" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="brDate" name="ride_date"
              value="<?= htmlspecialchars($old['ride_date']) ?>" required>
          </div>
          <div>
            <label class="pc-required tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="brTime">Time</label>
            <input type="time" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="brTime" name="ride_time"
              value="<?= htmlspecialchars($old['ride_time']) ?>" required>
          </div>

          <!-- book-ride-map.js toggles this box via the native `hidden`
               property (el.hidden = true/false), not a CSS class, so no
               display utility is needed for the on/off switch itself -- [&:not([hidden])]:flex only supplies the
               *layout* for while it's shown. -->
          <div class="tw-col-span-full tw-hidden tw-flex-wrap tw-items-center tw-gap-3 tw-rounded-2xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 [&:not([hidden])]:tw-flex" id="pcFareEstimate" hidden>
            <span class="tw-flex tw-h-10 tw-w-10 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[#198754] tw-text-white">
              <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.25" y="6" width="19.5" height="12" rx="2"/><circle cx="12" cy="12" r="3"/><path d="M5.25 9v.008M18.75 15v.008"/></svg>
            </span>
            <span class="tw-font-bold tw-text-[#146c43]">Est. fare: <span id="pcFareValue">&ndash;</span></span>
            <span class="tw-text-base tw-text-[#198754]">&middot; <span id="pcFareDistance">&ndash;</span> km</span>
            <span class="tw-text-base tw-text-[#198754]">&middot; <span id="pcFareDuration">&ndash;</span> min</span>
          </div>

          <input type="hidden" name="pickup_lat" id="pcPickupLat" value="<?= htmlspecialchars($old['pickup_lat']) ?>">
          <input type="hidden" name="pickup_lng" id="pcPickupLng" value="<?= htmlspecialchars($old['pickup_lng']) ?>">
          <input type="hidden" name="dropoff_lat" id="pcDropoffLat"
            value="<?= htmlspecialchars($old['dropoff_lat']) ?>">
          <input type="hidden" name="dropoff_lng" id="pcDropoffLng"
            value="<?= htmlspecialchars($old['dropoff_lng']) ?>">
          <input type="hidden" name="distance_km" id="pcDistanceKm"
            value="<?= htmlspecialchars($old['distance_km']) ?>">
          <input type="hidden" name="duration_min" id="pcDurationMin"
            value="<?= htmlspecialchars($old['duration_min']) ?>">
          <input type="hidden" name="fare_eur" id="pcFareEur" value="<?= htmlspecialchars($old['fare_eur']) ?>">

          <div class="tw-col-span-full tw-pt-2">
            <!-- tw-appearance-none tw-border-0 strip the native <button> chrome
                 (Chrome's UA stylesheet gives buttons a default 2px outset
                 border + native rendering that Preflight would normally
                 reset -- disabled site-wide here) -- without it the button
                 rendered ~10px taller than an identically-classed <a>. -->
            <button type="submit" class="<?= $pcBtnPrimary ?>">
              <span>Confirm Booking</span>
              <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12L3.269 3.126A59.77 59.77 0 0121.485 12 59.77 59.77 0 013.27 20.876L6 12zm0 0h7.5"/></svg>
            </button>
          </div>

          <!-- .alert-success / .alert-danger stay as bare classnames -- they
               are the exact contract ajax-forms.js parses out of the
               returned HTML (doc.querySelector('.alert-success' / '.alert-danger'))
               to decide the toast it shows; everything visual here is
               Tailwind. -->
          <?php if ($formStatus === 'success'): ?>
            <div class="tw-col-span-full">
              <div class="alert-success tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your booking request has been sent.
                We'll confirm shortly.</div>
            </div>
          <?php elseif ($formStatus === 'error'): ?>
            <div class="tw-col-span-full">
              <div class="alert-danger tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars(
                $formError,
              ) ?></div>
            </div>
          <?php endif; ?>
        </form>
      </div>

    </div>
  </div>
</section>

<script
  src="https://maps.googleapis.com/maps/api/js?key=<?= PC_GOOGLE_MAPS_API_KEY ?>&libraries=places&callback=initGoogleMaps"
  async defer></script>
<script src="<?= $assetPath ?>assets/js/components/dublin-places-autocomplete.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/dublin-places-autocomplete.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/book-ride-map.js"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-select.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-select.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-datetime.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-datetime.js',
) ?>"></script>

<!-- ============ Benefits ============ -->
<?php $bookingBenefits = [
  ['icon' => 'cash', 'title' => 'No Extra Charge', 'desc' => 'No extra charge for pre-booking your ride.'],
  ['icon' => 'x-circle', 'title' => 'No Cancellation Fee', 'desc' => 'Plans change -- cancel with no extra cost.'],
  ['icon' => 'calendar', 'title' => 'Book In Advance', 'desc' => 'Schedule your ride well ahead of time.'],
  ['icon' => 'smile', 'title' => 'Hassle-Free', 'desc' => 'A smooth, stress-free journey, start to finish.'],
]; ?>
<section class="tw-relative tw-overflow-hidden tw-bg-white <?= $pcSection ?>">
  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-black/[0.06] tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.06] md:tw-grid-cols-4 md:tw-divide-y-0">
      <?php foreach ($bookingBenefits as $benefit): ?>
        <div class="tw-flex tw-flex-col tw-items-center tw-px-3 tw-py-8 tw-text-center md:tw-py-10">
          <?php switch ($benefit['icon']): case 'cash': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.25" y="6" width="19.5" height="12" rx="2"/><circle cx="12" cy="12" r="3"/><path d="M5.25 9v.008M18.75 15v.008"/></svg>
            <?php break;case 'x-circle': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5"/></svg>
            <?php break;case 'calendar': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6.75 3v2.25M17.25 3v2.25M3.75 18.75V7.5a2.25 2.25 0 012.25-2.25h12a2.25 2.25 0 012.25 2.25v11.25m-16.5 0A2.25 2.25 0 006 21h12a2.25 2.25 0 002.25-2.25m-16.5 0V11.25a2.25 2.25 0 012.25-2.25h12a2.25 2.25 0 012.25 2.25v7.5M9 16.5l1.5 1.5 3.5-3.5"/></svg>
            <?php break;case 'smile': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M8.25 14.25s1 1.5 3.75 1.5 3.75-1.5 3.75-1.5M9 9.75h.008M15 9.75h.008"/></svg>
            <?php break;endswitch; ?>
          <h3 class="tw-mb-2 tw-text-[1.05rem] tw-font-bold tw-leading-snug tw-text-ink"><?= htmlspecialchars($benefit['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/[0.62]"><?= htmlspecialchars($benefit['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
