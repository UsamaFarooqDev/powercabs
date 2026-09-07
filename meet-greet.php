<?php
$pageTitle = 'Dublin Airport Transfers & Meet and Greet | PowerCabs';
$pageDescription =
  /* 150 chars, and no ampersand. It was 172 raw and rendered at 176: "&"
     becomes "&amp;" in the meta tag, so every one silently costs four
     characters against the ~160 Google shows. "meet and greet" spelled out
     is also the way people type the search. */
  'Dublin Airport taxi transfers with PowerCabs -- flight tracking, a personal meet and greet at arrivals, luggage help and a direct transfer, 24/7.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

// ============ Meet & Greet booking/enquiry form ============
$mgFormStatus = null;
$mgFormError = '';
$mgOld = [
  'name' => '',
  'email' => '',
  'flight_number' => '',
  'service_type' => '', // 'pickup' | 'dropoff'
  'pickup_terminal' => '', // Pickup flow: which terminal you're arriving at
  'destination_address' => '', // Pickup flow: where to drop you off
  'pickup_address' => '', // Dropping Off flow: where to collect you from
  'dropoff_terminal' => '', // Dropping Off flow: which terminal to drop you at
  'passengers' => '',
  'special_requirements' => '',
  'journey_type' => '', // 'one_way' | 'return'
];

$mgTerminalOptions = ['Terminal 1', 'Terminal 2', 'Platinum Service'];
$mgServiceTypeLabels = [
  'pickup' => 'Pickup (collected from the airport)',
  'dropoff' => 'Dropping Off (taken to the airport)',
];
$mgJourneyTypeLabels = ['one_way' => 'One Way', 'return' => 'Return / Both Ways'];
$mgFares = ['one_way' => 10, 'return' => 15];

$mgStripeLink = 'https://buy.stripe.com/5kQ6oH1NL1Zpd81arZfQI02';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'meet_greet') {
  foreach ($mgOld as $key => $default) {
    $mgOld[$key] = trim($_POST[$key] ?? '');
  }

  if (!isset($mgServiceTypeLabels[$mgOld['service_type']])) {
    $mgOld['service_type'] = '';
  }
  if (!isset($mgJourneyTypeLabels[$mgOld['journey_type']])) {
    $mgOld['journey_type'] = '';
  }
  if ($mgOld['pickup_terminal'] !== '' && !in_array($mgOld['pickup_terminal'], $mgTerminalOptions, true)) {
    $mgOld['pickup_terminal'] = '';
  }
  if ($mgOld['dropoff_terminal'] !== '' && !in_array($mgOld['dropoff_terminal'], $mgTerminalOptions, true)) {
    $mgOld['dropoff_terminal'] = '';
  }

  if ($mgOld['service_type'] === 'pickup') {
    $mgOld['pickup_address'] = '';
    $mgOld['dropoff_terminal'] = '';
  } elseif ($mgOld['service_type'] === 'dropoff') {
    $mgOld['pickup_terminal'] = '';
    $mgOld['destination_address'] = '';
  } else {
    $mgOld['pickup_terminal'] = '';
    $mgOld['destination_address'] = '';
    $mgOld['pickup_address'] = '';
    $mgOld['dropoff_terminal'] = '';
  }

  $mgPassengersOk =
    ctype_digit($mgOld['passengers']) && (int) $mgOld['passengers'] >= 1 && (int) $mgOld['passengers'] <= 20;

  $mgMissing =
    $mgOld['name'] === '' ||
    $mgOld['email'] === '' ||
    $mgOld['flight_number'] === '' ||
    $mgOld['service_type'] === '' ||
    $mgOld['journey_type'] === '' ||
    !$mgPassengersOk;

  if ($mgOld['service_type'] === 'pickup') {
    $mgMissing = $mgMissing || $mgOld['pickup_terminal'] === '' || $mgOld['destination_address'] === '';
  } elseif ($mgOld['service_type'] === 'dropoff') {
    $mgMissing = $mgMissing || $mgOld['pickup_address'] === '' || $mgOld['dropoff_terminal'] === '';
  }

  if ($mgMissing) {
    $mgFormStatus = 'error';
    $mgFormError = 'Please fill in all required fields.';
  } elseif (!filter_var($mgOld['email'], FILTER_VALIDATE_EMAIL)) {
    $mgFormStatus = 'error';
    $mgFormError = 'Please enter a valid email address.';
  } else {
    $mgFare = $mgFares[$mgOld['journey_type']];

    $body =
      "New Meet & Greet enquiry from the PowerCabs website.\n\n" .
      "Name: {$mgOld['name']}\n" .
      "Email: {$mgOld['email']}\n" .
      "Flight Number: {$mgOld['flight_number']}\n" .
      "Service Type: {$mgServiceTypeLabels[$mgOld['service_type']]}\n";

    if ($mgOld['service_type'] === 'pickup') {
      $body .=
        "Pickup / Airport Terminal: {$mgOld['pickup_terminal']}\n" .
        "Destination Address: {$mgOld['destination_address']}\n";
    } else {
      $body .=
        "Pickup Address: {$mgOld['pickup_address']}\n" . "Drop-off / Airport Terminal: {$mgOld['dropoff_terminal']}\n";
    }

    $body .=
      "Number of Passengers: {$mgOld['passengers']}\n" .
      "Journey Type: {$mgJourneyTypeLabels[$mgOld['journey_type']]}\n" .
      "Fare: \u{20AC}{$mgFare}\n\n" .
      "Special Requirements:\n" .
      ($mgOld['special_requirements'] !== '' ? $mgOld['special_requirements'] : '-') .
      "\n\n" .
      "Payment Link: {$mgStripeLink}\n";

    $result = pc_send_mail('Meet & Greet enquiry: ' . $mgOld['name'], $body, [
      'name' => $mgOld['name'],
      'email' => $mgOld['email'],
    ]);

    if ($result['success']) {
      $mgFormStatus = 'success';
      foreach ($mgOld as $key => $default) {
        $mgOld[$key] = '';
      }
    } else {
      $mgFormStatus = 'error';
      $mgFormError = 'Sorry, something went wrong sending your enquiry. Please try again or call us directly.';
    }
  }
}

/* Service structured data. Assembled in includes/seo.php, which wires
   it to the Organization node and supplies the default service area,
   so the page only states what the service is. */
$pageService = [
  'name' => 'Dublin Airport Transfers and Meet and Greet',
  'serviceType' => 'Airport transfer',
  'description' =>
    'Dublin Airport pickups and drop-offs with flight tracking, a driver waiting at arrivals with a name board, and help with luggage.',
];

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Airport Service';
$heroTitleLight = 'Meet &';
$heroTitleBold = 'Greet.';
$heroDescription =
  "Start or end your journey stress-free with PowerCabs' professional airport Meet & Greet service. Whether you're arriving for business or leisure, our experienced drivers monitor your flight, greet you at arrivals, assist with your luggage, and ensure a smooth, comfortable transfer to your destination. We also accommodate last-minute airport bookings whenever possible.";
$heroBgImage =
  'https://images.pexels.com/photos/69121/passenger-traffic-airline-aviation-air-transportation-69121.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Meet & Greet';
require __DIR__ . '/components/shared/inner-hero.php';

$meetGreetServices = [
  [
    'icon' => 'badge',
    'title' => 'Personal Meet & Greet',
    'desc' => 'Your driver waits inside the arrivals terminal with a personalized name board.',
  ],
  [
    'icon' => 'bag',
    'title' => 'Luggage Assistance',
    'desc' => 'Professional assistance with luggage from the terminal to the vehicle.',
  ],
  [
    'icon' => 'award',
    'title' => 'Executive Airport Transfers',
    'desc' => 'Premium, comfortable vehicles for business and leisure travelers.',
  ],
  [
    'icon' => 'people',
    'title' => 'Family Airport Transfers',
    'desc' => 'Spacious vehicles for families with children and extra luggage.',
  ],
  [
    'icon' => 'briefcase',
    'title' => 'Business Travel',
    'desc' => 'Reliable airport transportation for corporate clients.',
  ],
  [
    'icon' => 'clock',
    'title' => 'Last-Minute Bookings',
    'desc' => "We've got you covered even for last-minute airport bookings.",
  ],
];

$whyChoose = [
  'Professional licensed drivers',
  'Flight monitoring',
  'Fixed transparent pricing',
  'No hidden charges',
  '24/7 availability',
  'Comfortable vehicles',
  'Online booking',
  'Safe & reliable transportation',
];

$bookingSteps = [
  ['n' => 1, 'title' => 'Enter Flight Details'],
  ['n' => 2, 'title' => 'Choose Vehicle'],
  ['n' => 3, 'title' => 'Confirm Booking'],
  ['n' => 4, 'title' => 'Driver Meets You at Arrivals'],
];

// Canonical PowerCabs form field recipe (see book-ride-online.php).
// Was a byte-for-byte copy of $pcInput. Pointed at the recipe instead:
// $pcInput is already mirrored in custom-select.js and custom-datetime.js so
// an enhanced control sits flush with a plain one, and every literal copy is
// one more place that silently stops matching when it changes.
$mgInputClass = $pcInput;
// A real deviation, not a copy: these labels carry an inline icon, so the
// label is a flex row rather than a block. Derived from $pcLabel so the size,
// weight, colour and spacing stay in step with every other label on the site.
$mgLabelClass = str_replace('tw-block', 'tw-flex tw-items-center tw-gap-1', $pcLabel);
?>

<?php /* An intro section headed "Welcome from the moment you arrive." used to
         sit here, between the hero and the booking panel. It was removed for
         two reasons.

         First, it was the second of FIVE sections on this page that all made
         the same claim -- that your arrival is smooth and someone handles
         your bags. Its paragraph ("your driver is there to welcome you,
         assist with your luggage and get you comfortably on your way") is
         the booking section's own intro line directly below, reworded.

         Second, and more important: this page's job is to take a booking,
         and that block pushed the booking panel a full screen further down.
         The panel now follows the hero directly. */ ?>

<!-- ============ Meet & Greet Booking ============ -->
<!-- scroll-mt clears the fixed navbar when the closing CTA jumps here. -->
<section class="tw-relative tw-overflow-hidden tw-scroll-mt-[calc(var(--pc-navbar-h,110px)+1rem)] <?= $pcSection ?>" id="pcMeetGreetBook">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-overflow-hidden tw-rounded-[1.75rem] tw-border tw-border-solid tw-border-black/[0.07] tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] lg:tw-grid-cols-12">

      <!-- LEFT: branding / visual side -->
      <div class="tw-relative tw-flex tw-flex-col tw-overflow-hidden tw-bg-[linear-gradient(155deg,#1c1410_0%,#2a1a10_55%,#160f0a_100%)] tw-p-6 tw-text-white sm:tw-p-10 lg:tw-col-span-5">
        <span class="tw-pointer-events-none tw-absolute tw-right-[-9rem] tw-top-16 tw-z-0 tw-h-72 tw-w-72 tw-rounded-full tw-bg-[radial-gradient(circle,rgba(251,157,69,0.3),transparent_70%)] tw-blur-[55px]" aria-hidden="true"></span>
        <svg class="tw-pointer-events-none tw-absolute -tw-right-6 -tw-top-6 tw-z-0 tw-h-44 tw-w-44 tw-rotate-[35deg] tw-text-white/[0.05]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>

        <span class="tw-relative tw-z-[1] tw-mb-4 tw-inline-flex tw-w-fit tw-items-center tw-gap-2 tw-self-start tw-rounded-full tw-border tw-border-solid tw-border-white/[0.16] tw-bg-white/10 tw-px-4 tw-py-2 tw-text-xs tw-font-bold tw-uppercase tw-tracking-[0.04em]">
          <svg class="tw-h-3.5 tw-w-3.5 tw-text-powerlight" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
          Meet &amp; Greet Service
        </span>

        <h2 class="tw-relative tw-z-[1] tw-mb-3 tw-text-2xl tw-font-extrabold tw-leading-[1.15] tw-tracking-tight sm:tw-text-3xl">
          Smooth arrival.<br>
          <span class="tw-text-powerlight">Personal service.</span>
        </h2>

        <p class="tw-relative tw-z-[1] tw-mb-6 tw-max-w-[40ch] tw-text-[0.98rem] tw-leading-[1.7] tw-text-white/75">
          Your driver tracks your flight, waits for you inside arrivals with a
          name board, and helps with your bags. Simple, fixed pricing --
          no surprises.
        </p>

        <ul class="tw-relative tw-z-[1] tw-m-0 tw-mb-6 tw-flex tw-flex-col tw-gap-2 tw-p-0">
          <?php foreach (
            ['Flight tracked, every time', 'Greeted inside arrivals', 'Help with luggage', 'Fixed, transparent fares']
            as $feature
          ): ?>
            <li class="tw-flex tw-items-center tw-gap-2.5 tw-text-sm tw-font-semibold tw-text-white/[0.92]">
              <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
              <?= $feature ?>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="tw-relative tw-z-[1] tw-mt-auto tw-grid tw-grid-cols-2 tw-gap-3">
          <div class="tw-flex tw-flex-col tw-gap-1 tw-rounded-2xl tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-p-4">
            <span class="tw-text-xs tw-font-semibold tw-text-white/70">One Way</span>
            <span class="tw-text-2xl tw-font-extrabold tw-tracking-tight">&euro;10</span>
          </div>
          <div class="tw-relative tw-flex tw-flex-col tw-gap-1 tw-rounded-2xl tw-border tw-border-solid tw-border-[rgba(255,122,0,0.4)] tw-bg-[rgba(232,89,12,0.18)] tw-p-4">
            <span class="tw-absolute tw-right-3.5 -tw-top-2.5 tw-rounded-full tw-bg-power tw-px-2 tw-py-1 tw-text-[0.6rem] tw-font-bold tw-uppercase tw-tracking-[0.05em] tw-text-white">Best Value</span>
            <span class="tw-text-xs tw-font-semibold tw-text-white/70">Return / Both Ways</span>
            <span class="tw-text-2xl tw-font-extrabold tw-tracking-tight">&euro;15</span>
          </div>
        </div>
      </div>

      <!-- RIGHT: booking form -->
      <div class="tw-bg-white tw-p-6 sm:tw-p-10 lg:tw-col-span-7">
        <span class="tw-mb-3 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-[#fbe6d4] tw-px-3.5 tw-py-2 tw-text-xs tw-font-bold tw-uppercase tw-tracking-[0.04em] tw-text-power">
          <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6.75 3v2.25M17.25 3v2.25M3.75 18.75V7.5a2.25 2.25 0 012.25-2.25h12a2.25 2.25 0 012.25 2.25v11.25m-16.5 0A2.25 2.25 0 006 21h12a2.25 2.25 0 002.25-2.25m-16.5 0V11.25a2.25 2.25 0 012.25-2.25h12a2.25 2.25 0 012.25 2.25v7.5M9 16.5l1.5 1.5 3.5-3.5"/></svg>
          Booking Enquiry
        </span>
        <h3 class="tw-mb-2 tw-text-2xl tw-font-bold tw-text-ink">Book Your Meet &amp; Greet</h3>
        <p class="tw-mb-6 tw-text-ink/60">Tell us about your flight and where you're headed -- we'll take care of the rest.</p>

        <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2" id="pcMeetGreetForm">
          <input type="hidden" name="form_type" value="meet_greet">

          <div>
            <label class="pc-required <?= $mgLabelClass ?>" for="mgName">Full Name</label>
            <input type="text" class="<?= $mgInputClass ?>" id="mgName" name="name" value="<?= htmlspecialchars(
  $mgOld['name'],
) ?>" required>
          </div>

          <div>
            <label class="pc-required <?= $mgLabelClass ?>" for="mgEmail">Email Address</label>
            <input type="email" class="<?= $mgInputClass ?>" id="mgEmail" name="email" value="<?= htmlspecialchars(
  $mgOld['email'],
) ?>" required>
          </div>

          <div>
            <label class="pc-required <?= $mgLabelClass ?>" for="mgFlightNumber">Flight Number</label>
            <input type="text" class="<?= $mgInputClass ?>" id="mgFlightNumber" name="flight_number"
              placeholder="e.g. EI164" value="<?= htmlspecialchars($mgOld['flight_number']) ?>" required>
          </div>

          <div>
            <!-- pc-custom-select-enhance stays as a bare functional hook, shared with book-ride-online.php via custom-select.js. -->
            <label class="pc-required <?= $mgLabelClass ?>" for="mgServiceType">Service Type</label>
            <select class="<?= $mgInputClass ?> pc-custom-select-enhance" id="mgServiceType" name="service_type" required>
              <option value="" disabled <?= $mgOld['service_type'] === ''
                ? 'selected'
                : '' ?>>Select service type</option>
              <option value="pickup" <?= $mgOld['service_type'] === 'pickup'
                ? 'selected'
                : '' ?>>Pickup (from the airport)</option>
              <option value="dropoff" <?= $mgOld['service_type'] === 'dropoff'
                ? 'selected'
                : '' ?>>Dropping Off (to the airport)</option>
            </select>
          </div>

          <!-- Pickup flow fields -->
          <div class="pc-mg-field-group" data-mg-group="pickup">
            <label class="<?= $mgLabelClass ?>" for="mgPickupTerminal">Pickup / Airport Terminal</label>
            <select class="<?= $mgInputClass ?> pc-custom-select-enhance" id="mgPickupTerminal" name="pickup_terminal">
              <option value="" disabled <?= $mgOld['pickup_terminal'] === ''
                ? 'selected'
                : '' ?>>Select terminal</option>
              <?php foreach ($mgTerminalOptions as $terminal): ?>
                <option value="<?= htmlspecialchars($terminal) ?>" <?= $mgOld['pickup_terminal'] === $terminal
  ? 'selected'
  : '' ?>><?= htmlspecialchars($terminal) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="pc-mg-field-group" data-mg-group="pickup">
            <label class="<?= $mgLabelClass ?>" for="mgDestinationAddress">Destination Address</label>
            <input type="text" class="<?= $mgInputClass ?>" id="mgDestinationAddress" name="destination_address"
              placeholder="Where should we drop you off?" autocomplete="off"
              value="<?= htmlspecialchars($mgOld['destination_address']) ?>">
            <!-- `tw-hidden` here is an unavoidable, narrow exception: it's the
                 exact class string dublin-places-autocomplete.js (shared
                 with book-ride-online.php) hardcodes for showing/hiding this
                 warning. -->
            <div class="tw-hidden tw-mt-1.5 tw-text-sm tw-text-red-600" id="mgDestinationAddressWarning">Please choose a destination address within Dublin.</div>
          </div>

          <!-- Dropping Off flow fields -->
          <div class="pc-mg-field-group" data-mg-group="dropoff">
            <label class="<?= $mgLabelClass ?>" for="mgPickupAddress">Pickup Address</label>
            <input type="text" class="<?= $mgInputClass ?>" id="mgPickupAddress" name="pickup_address"
              placeholder="Where should we collect you from?" autocomplete="off"
              value="<?= htmlspecialchars($mgOld['pickup_address']) ?>">
            <div class="tw-hidden tw-mt-1.5 tw-text-sm tw-text-red-600" id="mgPickupAddressWarning">Please choose a pickup address within Dublin.</div>
          </div>
          <div class="pc-mg-field-group" data-mg-group="dropoff">
            <label class="<?= $mgLabelClass ?>" for="mgDropoffTerminal">Drop-off / Airport Terminal</label>
            <select class="<?= $mgInputClass ?> pc-custom-select-enhance" id="mgDropoffTerminal" name="dropoff_terminal">
              <option value="" disabled <?= $mgOld['dropoff_terminal'] === ''
                ? 'selected'
                : '' ?>>Select terminal</option>
              <?php foreach ($mgTerminalOptions as $terminal): ?>
                <option value="<?= htmlspecialchars($terminal) ?>" <?= $mgOld['dropoff_terminal'] === $terminal
  ? 'selected'
  : '' ?>><?= htmlspecialchars($terminal) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div>
            <label class="pc-required <?= $mgLabelClass ?>" for="mgPassengers">Number of Passengers</label>
            <input type="number" min="1" max="20" class="<?= $mgInputClass ?>" id="mgPassengers" name="passengers"
              value="<?= htmlspecialchars($mgOld['passengers']) ?>" required>
          </div>

          <div>
            <label class="pc-required <?= $mgLabelClass ?>" for="mgJourneyType">Journey Type</label>
            <select class="<?= $mgInputClass ?> pc-custom-select-enhance" id="mgJourneyType" name="journey_type" required>
              <option value="" disabled <?= $mgOld['journey_type'] === ''
                ? 'selected'
                : '' ?>>Select journey type</option>
              <option value="one_way" data-fare="10" <?= $mgOld['journey_type'] === 'one_way'
                ? 'selected'
                : '' ?>>One Way &ndash; &euro;10</option>
              <option value="return" data-fare="15" <?= $mgOld['journey_type'] === 'return'
                ? 'selected'
                : '' ?>>Return / Both Ways &ndash; &euro;15</option>
            </select>
          </div>

          <div class="md:tw-col-span-2">
            <label class="<?= $mgLabelClass ?>" for="mgSpecialRequirements">Special Requirements</label>
            <textarea class="<?= $mgInputClass ?> tw-py-2" id="mgSpecialRequirements" name="special_requirements"
              rows="3"><?= htmlspecialchars($mgOld['special_requirements']) ?></textarea>
          </div>

          <div class="md:tw-col-span-2">
            <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-between tw-gap-3 tw-rounded-2xl tw-bg-[#fbe6d4] tw-px-5 tw-py-4">
              <div>
                <span class="tw-block tw-text-[0.68rem] tw-font-bold tw-uppercase tw-tracking-[0.07em] tw-text-powerdark">Your Fare</span>
                <span class="tw-text-[0.82rem] tw-font-semibold tw-text-ink" id="mgFareHint">Select a journey type above</span>
              </div>
              <span class="tw-text-3xl tw-font-extrabold tw-tracking-tight tw-text-power" id="mgFareValue">&euro;&ndash;</span>
            </div>
          </div>

          <div class="md:tw-col-span-2">
            <div class="tw-rounded-2xl tw-border tw-border-dashed tw-border-[rgba(232,89,12,0.35)] tw-bg-paper-soft tw-px-5 tw-py-[1.1rem]">
              <div class="tw-mb-2 tw-flex tw-items-center tw-gap-2">
                <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
                <span class="tw-font-bold tw-text-ink">Secure Payment</span>
              </div>
              <a href="<?= htmlspecialchars($mgStripeLink) ?>" target="_blank" rel="noopener noreferrer"
                class="<?= $pcBtnPrimary ?> tw-flex tw-w-full"
                id="mgPayBtn">
                <svg class="tw-hidden tw-h-3.5 tw-w-3.5 sm:tw-inline-block" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12 1.5a4.5 4.5 0 00-4.5 4.5v3H6a1.5 1.5 0 00-1.5 1.5v9A1.5 1.5 0 006 21h12a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0018 9h-1.5V6a4.5 4.5 0 00-4.5-4.5zm3 7.5V6a3 3 0 10-6 0v3h6z" clip-rule="evenodd"/></svg>
                <?php /* Two labels, one shown at a time -- the button is full
                         width inside a card that is only ~280px across on a
                         phone, and both of the full strings wrap to two lines
                         there ("Select a journey type to see your fare", and
                         "Pay EUR15 - Return / Both Ways" once a type is
                         picked). The short label drops the words the phone
                         does not need: the qualifier on the prompt, and the
                         "Return / " half of the journey name, which is
                         redundant beside "Both Ways".

                         Both are kept in sync by applyJourneyType() below. The
                         hidden one is display:none, so a screen reader
                         announces exactly one. */ ?>
                <span id="mgPayBtnLabel" class="tw-hidden sm:tw-inline">Select journey type to see fare</span>
                <span id="mgPayBtnLabelShort" class="sm:tw-hidden">Select your journey</span>
              </a>
              <p class="tw-mb-0 tw-mt-2 tw-text-[1.0625rem] tw-leading-relaxed tw-leading-[1.55] tw-text-ink/60">
                You'll be taken to our secure Stripe payment page to complete payment for the
                fare shown above. Submitting the enquiry below does not require payment first --
                your booking is never lost if you pay afterwards.
              </p>
            </div>
          </div>

          <div class="md:tw-col-span-2 tw-pt-2">
            <!-- tw-appearance-none tw-border-0 strip the native <button> chrome -- see book-ride-online.php. -->
            <button type="submit" class="tw-inline-flex tw-appearance-none tw-items-center tw-gap-2 tw-rounded-full tw-border-0 tw-bg-ink tw-px-6 tw-py-2 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black">
              <span>Send Enquiry</span>
              <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12L3.269 3.126A59.77 59.77 0 0121.485 12 59.77 59.77 0 013.27 20.876L6 12zm0 0h7.5"/></svg>
            </button>
          </div>

          <!-- .alert-success / .alert-danger stay as bare classnames -- the contract ajax-forms.js parses out of the returned HTML. -->
          <?php if ($mgFormStatus === 'success'): ?>
            <div class="md:tw-col-span-2">
              <div class="alert-success tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your Meet &amp; Greet enquiry has been sent. We'll confirm shortly.</div>
            </div>
          <?php elseif ($mgFormStatus === 'error'): ?>
            <div class="md:tw-col-span-2">
              <div class="alert-danger tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars(
                $mgFormError,
              ) ?></div>
            </div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</section>

<script>
  (function () {
    var form = document.getElementById('pcMeetGreetForm');
    if (!form) return;

    var serviceTypeSelect = document.getElementById('mgServiceType');
    var journeyTypeSelect = document.getElementById('mgJourneyType');
    var fareHint = document.getElementById('mgFareHint');
    var fareValue = document.getElementById('mgFareValue');
    var payBtnLabel = document.getElementById('mgPayBtnLabel');
    var payBtnLabelShort = document.getElementById('mgPayBtnLabelShort');

    var groups = {
      pickup: form.querySelectorAll('[data-mg-group="pickup"]'),
      dropoff: form.querySelectorAll('[data-mg-group="dropoff"]')
    };

    // Tailwind's own `tw-hidden` utility class stands in for Bootstrap's
    // `tw-hidden` here (this toggle is page-exclusive, so nothing else depends
    // on the old class name) -- same display:none effect, zero Bootstrap.
    function setGroupState(groupName, isActive) {
      groups[groupName].forEach(function (col) {
        col.classList.toggle('tw-hidden', !isActive);
        col.querySelectorAll('input, select, textarea').forEach(function (field) {
          field.disabled = !isActive;
          field.required = isActive;
          if (!isActive) {
            field.value = '';
            field.dispatchEvent(new Event('change', { bubbles: true }));
          }
        });
      });
    }

    function applyServiceType() {
      var value = serviceTypeSelect.value;
      setGroupState('pickup', value === 'pickup');
      setGroupState('dropoff', value === 'dropoff');
    }

    function applyJourneyType() {
      var option = journeyTypeSelect.options[journeyTypeSelect.selectedIndex];
      var fare = option ? option.getAttribute('data-fare') : null;

      if (!fare) {
        fareValue.textContent = '€–';
        fareHint.textContent = 'Select a journey type above';
        payBtnLabel.textContent = 'Select a journey type to see your fare';
        payBtnLabelShort.textContent = 'Select your journey';
        return;
      }

      var label = option.value === 'return' ? 'Return / Both Ways' : 'One Way';
      // The phone label drops "Return / " -- "Both Ways" already says it, and
      // the full string wraps to two lines inside the button at 360px.
      var shortLabel = option.value === 'return' ? 'Both Ways' : 'One Way';
      fareValue.textContent = '€' + fare;
      fareHint.textContent = label + ' fare';
      payBtnLabel.textContent = 'Pay €' + fare + ' — ' + label;
      payBtnLabelShort.textContent = 'Pay €' + fare + ' — ' + shortLabel;
    }

    serviceTypeSelect.addEventListener('change', applyServiceType);
    journeyTypeSelect.addEventListener('change', applyJourneyType);

    applyServiceType();
    applyJourneyType();
  })();
</script>

<!-- ============ Our Meet & Greet Services ============ -->
<section class="tw-bg-white <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ What's Included</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Our Meet &amp; Greet Services</h2>
    </div>
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 lg:tw-grid-cols-3">
      <?php foreach ($meetGreetServices as $s): ?>
        <div class="tw-rounded-2xl tw-bg-white tw-p-6 tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)]">
          <span class="tw-mb-3 tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-xl tw-bg-[#fbe6d4] tw-text-power">
            <?php switch ($s['icon']): case 'badge': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
              <?php break;case 'bag': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25l2 2 4-4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
              <?php break;case 'award': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-6.75c-.621 0-1.125.504-1.125 1.125V18.75m9 0h-9M12 3v8.25m0 0a3.375 3.375 0 100 6.75 3.375 3.375 0 000-6.75z"/></svg>
              <?php break;case 'people': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
              <?php break;case 'briefcase': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 14.15v4.25c0 1.09-.787 2.04-1.872 2.18-2.087.28-4.216.42-6.378.42s-4.291-.14-6.378-.42c-1.085-.14-1.872-1.09-1.872-2.18v-4.25M3.75 8.706c0-1.08.768-2.01 1.837-2.175a48.11 48.11 0 013.413-.387m7.5 0v-.894A2.25 2.25 0 0014.25 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M21 12.49c0 .65-.29 1.27-.75 1.66-.194.16-.42.29-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.43-7.577-1.22A2.016 2.016 0 013 12.49"/></svg>
              <?php break;case 'clock': ?>
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
              <?php break;endswitch; ?>
          </span>
          <h3 class="tw-mb-2 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($s['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($s['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php if ($mgFormStatus): ?>
  <script>window.pcMeetGreetFormSubmitted = true;</script>
<?php endif; ?>

<script src="<?= $assetPath ?>assets/js/components/custom-select.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-select.js',
) ?>"></script>

<script
  src="https://maps.googleapis.com/maps/api/js?key=<?= PC_GOOGLE_MAPS_API_KEY ?>&libraries=places&callback=initMeetGreetAutocomplete"
  async defer></script>
<script src="<?= $assetPath ?>assets/js/components/dublin-places-autocomplete.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/dublin-places-autocomplete.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/meet-greet-map.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/meet-greet-map.js',
) ?>"></script>

<!-- ============ Flight Path Scroll Animation ============ -->
<section class="tw-relative tw-min-h-[560px] tw-overflow-hidden tw-h-[90vh] tw-bg-[linear-gradient(180deg,#0c1b2e_0%,#17395c_28%,#3f7cb0_55%,#bfe2f9_78%,#ffffff_100%)]" id="pcFlightBanner">
  <img src="<?= $assetPath ?>assets/img/plane.avif" alt="" aria-hidden="true"
    class="tw-pointer-events-none tw-absolute tw-left-0 tw-top-1/2 tw-z-0 tw-w-[clamp(320px,48vw,680px)] tw-origin-center [transform:translate3d(-15%,-50%,0)] tw-will-change-transform tw-drop-shadow-[0_14px_24px_rgba(0,0,0,0.35)]"
    id="pcFlightPlane">
  <img src="<?= $assetPath ?>assets/img/clouds.avif" alt="" aria-hidden="true"
    class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-[1] tw-h-full tw-w-full tw-object-cover tw-will-change-transform [-webkit-mask-image:linear-gradient(180deg,#000_0%,#000_65%,transparent_92%)] [mask-image:linear-gradient(180deg,#000_0%,#000_65%,transparent_92%)]"
    id="pcFlightCloudsFront" loading="lazy">

  <div class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-bottom-0 tw-z-[2] tw-py-6 tw-text-center">
    <div class="<?= $pcContainer ?>">
      <h2 class="<?= $pcH2Small ?>">Meet &amp; Greet, Made Easy</h2>
      <p class="tw-mb-0 tw-text-[1.0625rem] tw-text-ink/60">From arrival to destination, PowerCabs makes every journey simple.</p>
    </div>
  </div>
</section>

<script>
  (function () {
    var section = document.getElementById('pcFlightBanner');
    var plane = document.getElementById('pcFlightPlane');
    var cloudsFront = document.getElementById('pcFlightCloudsFront');
    if (!section || !plane) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var keyframes = [
      [0, -15],
      [0.25, 10],
      [0.5, 40],
      [0.75, 70],
      [1, 115]
    ];

    function progressToPercent(progress) {
      for (var i = 0; i < keyframes.length - 1; i++) {
        var a = keyframes[i], b = keyframes[i + 1];
        if (progress >= a[0] && progress <= b[0]) {
          var t = (progress - a[0]) / (b[0] - a[0]);
          return a[1] + (b[1] - a[1]) * t;
        }
      }
      return keyframes[keyframes.length - 1][1];
    }

    var isVisible = false;
    var rafId = null;
    var targetPlaneX = 0;
    var currentPlaneX = 0;
    var currentCloudX = 0;
    var initialised = false;
    var EASE = 0.09;
    var CLOUD_PARALLAX_RATIO = -0.12;

    function computeTarget() {
      var rect = section.getBoundingClientRect();
      var viewportH = window.innerHeight || document.documentElement.clientHeight;
      var progress = (viewportH - rect.top) / (rect.height + viewportH);
      progress = Math.max(0, Math.min(1, progress));

      var percent = progressToPercent(progress);
      targetPlaneX = rect.width * (percent / 100);

      if (!initialised) {
        currentPlaneX = targetPlaneX;
        currentCloudX = targetPlaneX * CLOUD_PARALLAX_RATIO;
        initialised = true;
      }
    }

    function tick() {
      rafId = null;
      if (!isVisible) return;

      currentPlaneX += (targetPlaneX - currentPlaneX) * EASE;
      var targetCloudX = targetPlaneX * CLOUD_PARALLAX_RATIO;
      currentCloudX += (targetCloudX - currentCloudX) * EASE;

      plane.style.transform = 'translate3d(' + currentPlaneX + 'px, -50%, 0)';
      if (cloudsFront) {
        cloudsFront.style.transform = 'translate3d(' + currentCloudX + 'px, 0, 0)';
      }

      rafId = requestAnimationFrame(tick);
    }

    function onScroll() {
      computeTarget();
      if (isVisible && rafId === null) {
        rafId = requestAnimationFrame(tick);
      }
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        isVisible = entry.isIntersecting;
        if (isVisible) {
          computeTarget();
          if (rafId === null) rafId = requestAnimationFrame(tick);
        } else if (rafId !== null) {
          cancelAnimationFrame(rafId);
          rafId = null;
        }
      });
    }, { threshold: 0 });

    observer.observe(section);
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
  })();
</script>

<?php /* A 520px-tall full-bleed photo banner sat here carrying exactly one
         sentence -- "From the terminal to the car, we've got your bags
         covered." That is the "Luggage Assistance" service card above,
         restated at billboard size, and it also loaded a second remote
         hero-sized photo. Half a screen of scrolling for a duplicate claim. */ ?>

<!-- ============ Why Choose Us + How It Works ============ -->
<section class="tw-relative tw-overflow-hidden <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[720px] tw-text-center">
      <?php /* Was "Your journey starts the moment you land." over a paragraph
               about every step feeling effortless -- the last of this page's
               repeated "your arrival is smooth" statements. This section holds
               the reasons to choose PowerCabs and the four booking steps, so
               the heading names that rather than restating the pitch again. */ ?>
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-leading-[1.08] tw-tracking-tight tw-text-ink md:tw-text-4xl">
        Why travellers <span class="tw-text-power">choose PowerCabs.</span>
      </h2>
      <p class="tw-mb-0 tw-text-ink/60">
        What is included in every Meet &amp; Greet, and the four steps to book one.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-overflow-hidden tw-rounded-[2rem] tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.08),0_5px_20px_rgba(28,20,16,0.035)] lg:tw-grid-cols-2">

      <!-- LEFT — Why Choose PowerCabs -->
      <div class="tw-flex tw-flex-col tw-p-6 sm:tw-p-10">
        <div class="tw-mb-4 tw-flex tw-items-start tw-gap-3">
          <div class="tw-flex tw-h-[46px] tw-w-[46px] tw-shrink-0 tw-items-center tw-justify-center tw-rounded-2xl tw-bg-[#fbe6d4] tw-text-power tw-shadow-[inset_0_0_0_1px_rgba(232,89,12,0.08)]">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
          </div>
          <div>
            <div class="tw-mb-1 tw-text-[0.65rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] tw-text-power">Why Choose Us</div>
            <h3 class="tw-mb-0 tw-text-[clamp(1.45rem,2vw,1.9rem)] tw-font-bold tw-leading-[1.15] tw-tracking-tight tw-text-ink">More than just an airport transfer.</h3>
          </div>
        </div>

        <p class="tw-mb-4 tw-max-w-[470px] tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/60">
          We take care of the details, so you can simply step out of
          the airport and enjoy a smooth, comfortable journey.
        </p>

        <div class="tw-grid tw-grid-cols-1 tw-gap-2 sm:tw-grid-cols-2">
          <?php foreach ($whyChoose as $index => $item): ?>
            <div class="tw-relative tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.065] tw-bg-white tw-p-3">
              <span class="tw-absolute tw-right-3 tw-top-2 tw-text-[0.6rem] tw-font-bold tw-tracking-[0.08em] tw-text-ink/[0.18]">
                <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
              </span>
              <div class="tw-flex tw-h-full tw-items-center tw-gap-2">
                <span class="tw-flex tw-h-[30px] tw-w-[30px] tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[#fbe6d4] tw-text-power">
                  <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span class="tw-pr-2 tw-text-[0.82rem] tw-font-bold tw-leading-[1.4] tw-text-ink"><?= htmlspecialchars(
                  $item,
                ) ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="tw-mt-auto tw-flex tw-items-center tw-gap-3 tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.07] tw-pt-4">
          <div class="tw-flex tw-h-10 tw-w-10 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-paper-soft tw-text-power">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
          </div>
          <div>
            <div class="tw-text-[0.78rem] tw-font-bold tw-text-ink">Travel with confidence</div>
            <div class="tw-text-[0.68rem] tw-text-ink/60">Professional service from pickup to drop-off.</div>
          </div>
        </div>
      </div>

      <!-- RIGHT — How It Works -->
      <div class="tw-flex tw-flex-col tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.06] tw-bg-[linear-gradient(145deg,#fff8f3_0%,#f9f4ed_100%)] tw-p-6 sm:tw-p-10 lg:tw-border-t-0 lg:tw-border-l">
        <div class="tw-mb-4 tw-flex tw-items-start tw-gap-3">
          <div class="tw-flex tw-h-[46px] tw-w-[46px] tw-shrink-0 tw-items-center tw-justify-center tw-rounded-2xl tw-bg-power tw-text-white tw-shadow-[0_8px_20px_rgba(232,89,12,0.2)]">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3v18M6 3l6 3-6 3m0 6l6 3-6 3M18 3v18M18 9l-6 3 6 3"/></svg>
          </div>
          <div>
            <div class="tw-mb-1 tw-text-[0.65rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] tw-text-power">How It Works</div>
            <h3 class="tw-mb-0 tw-text-[clamp(1.45rem,2vw,1.9rem)] tw-font-bold tw-leading-[1.15] tw-tracking-tight tw-text-ink">Booked in four simple steps.</h3>
          </div>
        </div>
        <p class="tw-mb-4 tw-max-w-[470px] tw-text-[1.02rem] tw-leading-[1.7] tw-text-ink/60">
          Getting your airport transfer sorted is quick and easy.
          Book ahead and we'll take care of the rest.
        </p>

        <!-- Timeline -->
        <div>
          <?php foreach ($bookingSteps as $index => $step): ?>
            <div class="tw-relative tw-flex tw-gap-3 <?= $index < count($bookingSteps) - 1 ? 'tw-pb-4' : '' ?>">
              <?php if ($index < count($bookingSteps) - 1): ?>
                <div class="tw-absolute tw-bottom-0 tw-left-[19px] tw-top-[43px] tw-w-px tw-bg-[linear-gradient(to_bottom,rgba(232,89,12,0.3),rgba(232,89,12,0.08))]"></div>
              <?php endif; ?>

              <div class="tw-relative tw-z-[2] tw-flex tw-h-10 tw-w-10 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-2xl tw-border tw-border-solid tw-border-[rgba(232,89,12,0.18)] tw-text-[0.78rem] tw-font-bold tw-shadow-[0_5px_15px_rgba(28,20,16,0.055)] <?= $index ===
              0
                ? 'tw-bg-power tw-text-white'
                : 'tw-bg-white tw-text-power' ?>">
                <?= $step['n'] ?>
              </div>

              <div class="tw-flex-grow tw-pt-1">
                <div class="tw-mb-1 tw-flex tw-items-center tw-justify-between">
                  <span class="tw-text-[0.58rem] tw-font-bold tw-tracking-[0.13em] tw-text-[#a19791]">STEP <?= str_pad(
                    $index + 1,
                    2,
                    '0',
                    STR_PAD_LEFT,
                  ) ?></span>
                  <svg class="tw-h-3 tw-w-3 tw-text-black/[0.28]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7M8 7h9v9"/></svg>
                </div>
                <h4 class="tw-mb-0 tw-text-[0.93rem] tw-font-bold tw-leading-[1.4] tw-text-ink"><?= htmlspecialchars(
                  $step['title'],
                ) ?></h4>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <!-- Bottom reassurance -->
        <div class="tw-mt-3 tw-flex tw-items-center tw-gap-2 tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.065] tw-bg-white/[0.72] tw-p-3">
          <div class="tw-flex tw-h-[30px] tw-w-[30px] tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[#fbe6d4] tw-text-power">
            <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>
          </div>
          <div>
            <div class="tw-text-[0.84rem] tw-font-bold tw-text-ink">That's it. You're all set.</div>
            <div class="tw-text-[0.74rem] tw-text-ink/60">Simple booking. Reliable service. No unnecessary hassle.</div>
          </div>
          <div class="tw-ml-auto tw-flex tw-h-[31px] tw-w-[31px] tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-[rgba(232,89,12,0.12)] tw-bg-white tw-text-power">
            <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';

/* Replaces a hand-rolled closing CTA that duplicated the shared block's
   markup with its own button spellings. Primary points at this page's own
   booking panel rather than /book-ride-online -- a visitor who has read this
   far wants the Meet & Greet form, not the general booking page. */
$ctaTitle = 'Ready to book your airport transfer?';
$ctaText = 'Flight tracked, driver waiting inside arrivals, fare fixed before you travel.';
// Raw "&", not "&amp;" -- final-cta.php escapes the label on output, so a
// pre-escaped entity here would render as "&amp;".
$ctaPrimary = ['href' => '/meet-greet#pcMeetGreetBook', 'label' => 'Book Meet & Greet'];
$ctaSecondary = ['href' => '/faqs', 'label' => 'See FAQs'];
require __DIR__ . '/components/shared/final-cta.php';

require __DIR__ . '/includes/footer.php';
?>
