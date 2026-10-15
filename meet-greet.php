<?php
$pageTitle = 'Dublin Airport Transfers & Meet and Greet | PowerCabs';
$pageDescription =
  
  'Dublin Airport taxi transfers with PowerCabs -- flight tracking, a personal meet and greet at arrivals, luggage help and a direct transfer, 24/7.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$mgFormStatus = null;
$mgFormError = '';
$mgOld = [
  'name' => '',
  'email' => '',
  'phone' => '',
  'flight_number' => '',
  'service_type' => '', 
  'pickup_terminal' => '', 
  'destination_address' => '', 
  'pickup_address' => '', 
  'dropoff_terminal' => '', 
  'passengers' => '',
  'pickup_date' => '', 
  'pickup_time' => '',
  'special_requirements' => '',
  'service_level' => '', 
];

$mgMinDate = date('Y-m-d');

$mgTerminalOptions = ['Terminal 1', 'Terminal 2', 'Platinum Service'];

$mgPickupLocationOptions = array_merge($mgTerminalOptions, ['Heuston Station']);
$mgServiceTypeLabels = [
  'pickup' => 'Pickup (collected from the airport)',
  'dropoff' => 'Dropping Off (taken to the airport)',
];
$mgServiceLevels = [
  'standard' => [
    'eyebrow' => 'Standard',
    'price' => 10,
    'title' => 'Simple Meet &amp; Greet',
    'desc' => 'A simple and convenient airport welcome.',
    'featured' => false,
    'includes' => [
      'Driver meets you inside the terminal',
      'Driver accompanies you to the vehicle',
      '10 minutes waiting time',
      'Professional airport meet &amp; greet',
    ],
    'excludes' => ['Flight monitoring', 'Personalised name board', 'Luggage assistance'],
  ],
  'assist' => [
    'eyebrow' => 'Assist',
    'price' => 15,
    'title' => 'Meet, Greet &amp; Assist',
    'desc' => 'A more personal welcome with help from terminal to vehicle.',
    'featured' => false,
    'includes' => [
      'Driver meets you inside the terminal',
      'Personalised name board',
      'Luggage assistance',
      'Driver accompanies you to the vehicle',
      '10 minutes waiting time',
    ],
    'note' => [
      'title' => 'Need additional assistance?',
      'text' =>
        'Elderly passengers, passengers with disabilities, reduced mobility, or anyone requiring additional assistance can request priority support.',
    ],
    'excludes' => ['Flight monitoring'],
  ],
  'first_class' => [
    'eyebrow' => 'First Class',
    'price' => 30,
    'title' => 'Your Arrival, Completely Taken Care Of',
    'desc' => 'Our complete airport arrival service, managed by PowerCabs.',
    'featured' => true,
    'includes' => [
      'PowerCabs monitors your flight',
      'Driver coordinated according to flight status',
      'Driver meets you inside the terminal',
      'Personalised name board',
      'Luggage assistance',
      'Live chat with PowerCabs',
      'Priority dispatch support',
      '15 minutes waiting time',
    ],
    'idealFor' => ['Business guests', 'Corporate travellers', 'Families', 'VIP guests'],
  ],
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'meet_greet') {
  foreach ($mgOld as $key => $default) {
    $mgOld[$key] = trim($_POST[$key] ?? '');
  }

  if (!isset($mgServiceTypeLabels[$mgOld['service_type']])) {
    $mgOld['service_type'] = '';
  }
  if ($mgOld['pickup_terminal'] !== '' && !in_array($mgOld['pickup_terminal'], $mgPickupLocationOptions, true)) {
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

  $mgDateOk = (bool) preg_match('/^\d{4}-\d{2}-\d{2}$/', $mgOld['pickup_date']);
  if ($mgDateOk) {
    [$y, $m, $d] = array_map('intval', explode('-', $mgOld['pickup_date']));
    $mgDateOk = checkdate($m, $d, $y) && $mgOld['pickup_date'] >= $mgMinDate;
  }
  $mgTimeOk = (bool) preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $mgOld['pickup_time']);

  if ($mgOld['service_level'] !== '' && !isset($mgServiceLevels[$mgOld['service_level']])) {
    $mgOld['service_level'] = '';
  }

  $mgMissing =
    $mgOld['name'] === '' ||
    $mgOld['email'] === '' ||
    $mgOld['phone'] === '' ||
    $mgOld['flight_number'] === '' ||
    $mgOld['service_type'] === '' ||
    $mgOld['service_level'] === '' ||
    $mgOld['pickup_date'] === '' ||
    $mgOld['pickup_time'] === '' ||
    !$mgPassengersOk;

  if ($mgOld['service_type'] === 'pickup') {
    $mgMissing = $mgMissing || $mgOld['pickup_terminal'] === '' || $mgOld['destination_address'] === '';
  } elseif ($mgOld['service_type'] === 'dropoff') {
    $mgMissing = $mgMissing || $mgOld['pickup_address'] === '' || $mgOld['dropoff_terminal'] === '';
  }

  if ($mgMissing) {
    $mgFormStatus = 'error';
    $mgFormError = 'Please fill in all required fields.';
  } elseif (!$mgDateOk || !$mgTimeOk) {
$mgFormStatus = 'error';
    $mgFormError = 'Please enter a valid pickup date and time. The date cannot be in the past.';
  } elseif (!filter_var($mgOld['email'], FILTER_VALIDATE_EMAIL)) {
    $mgFormStatus = 'error';
    $mgFormError = 'Please enter a valid email address.';
  } else {
    $body =
      "New Meet & Greet enquiry from the PowerCabs website.\n\n" .
      "Name: {$mgOld['name']}\n" .
      "Email: {$mgOld['email']}\n" .
      "Phone: {$mgOld['phone']}\n" .
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

    $mgLevel =
      html_entity_decode($mgServiceLevels[$mgOld['service_level']]['eyebrow'], ENT_QUOTES, 'UTF-8') .
      " (listed at \u{20AC}" .
      $mgServiceLevels[$mgOld['service_level']]['price'] .
      ')';

    $body .=
      "Number of Passengers: {$mgOld['passengers']}\n" .
      "Pickup Date: {$mgOld['pickup_date']}\n" .
      "Pickup Time: {$mgOld['pickup_time']}\n" .
      "Plan: {$mgLevel}\n\n" .
      "Special Requirements:\n" .
      ($mgOld['special_requirements'] !== '' ? $mgOld['special_requirements'] : '-') .
      "\n";

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

$pageService = [
  'name' => 'Dublin Airport Transfers and Meet and Greet',
  'serviceType' => 'Airport transfer',
  'description' =>
    'Dublin Airport pickups and drop-offs with flight tracking, a driver waiting at arrivals with a name board, and help with luggage.',
];

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'Airport Service';
$heroTitleLight = 'Meet &';
$heroTitleBold = 'Greet.';
$heroDescription =
  "Start or end your journey stress-free with PowerCabs' professional airport Meet & Greet service. Whether you're arriving for business or leisure, our experienced drivers monitor your flight, greet you at arrivals, assist with your luggage, and ensure a smooth, comfortable transfer to your destination. We also accommodate last-minute airport bookings whenever possible.";
$heroBgImage =
  'https://images.pexels.com/photos/69121/passenger-traffic-airline-aviation-air-transportation-69121.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Meet & Greet';
$heroVariant = 'image';
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

$mgInputClass = $pcInput;

$mgLabelClass = str_replace('tw-block', 'tw-flex tw-items-center tw-gap-1', $pcLabel);
?>

<?php  ?>

<?php  ?>
<section class="tw-relative tw-overflow-hidden tw-scroll-mt-[calc(var(--pc-navbar-h,110px)+1rem)] <?= $pcSection ?>" id="pcMeetGreetBook">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-overflow-hidden tw-rounded-[1.75rem] tw-border tw-border-solid tw-border-black/[0.07] tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] lg:tw-grid-cols-12">

      <div class="tw-relative tw-flex tw-flex-col tw-overflow-hidden tw-bg-[linear-gradient(155deg,#1c1410_0%,#2a1a10_55%,#160f0a_100%)] tw-p-6 tw-text-white sm:tw-p-10 lg:tw-col-span-5">
        <?php  ?>
        <div class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-overflow-hidden" aria-hidden="true">
          <svg class="tw-absolute -tw-right-6 -tw-top-6 tw-h-44 tw-w-44 tw-rotate-[35deg] tw-text-white/[0.05]" viewBox="0 0 24 24" fill="currentColor"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
          <svg class="tw-absolute -tw-left-7 tw-top-[42%] tw-h-32 tw-w-32 -tw-rotate-[14deg] tw-text-white/[0.045]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M8.25 9V5.25A2.25 2.25 0 0110.5 3h3a2.25 2.25 0 012.25 2.25V9m-9 10.5h9a2.25 2.25 0 002.25-2.25V11.25A2.25 2.25 0 0015.75 9H8.25A2.25 2.25 0 006 11.25v6a2.25 2.25 0 002.25 2.25z"/></svg>
          <svg class="tw-absolute -tw-right-4 tw-top-[38%] tw-h-24 tw-w-24 tw-rotate-[12deg] tw-text-white/[0.04]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <svg class="tw-absolute tw-left-[42%] tw-top-[56%] tw-h-20 tw-w-20 -tw-rotate-[8deg] tw-text-white/[0.04]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M9 12h6m-6 3h4m3-9.75h1.5A2.25 2.25 0 0119.75 7.5v12a2.25 2.25 0 01-2.25 2.25h-11A2.25 2.25 0 014.25 19.5v-12A2.25 2.25 0 016.5 5.25H8m4-2.25a1.5 1.5 0 011.5 1.5v.75A.75.75 0 0112.75 6h-1.5a.75.75 0 01-.75-.75V4.5A1.5 1.5 0 0112 3z"/></svg>
          <svg class="tw-absolute tw-bottom-[16%] tw-left-[24%] tw-h-24 tw-w-24 tw-rotate-[6deg] tw-text-white/[0.04]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m3 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.9 17.9 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M4.5 18.75H3.375c-.621 0-1.125-.504-1.125-1.125V14.25m2.25 4.5H2.35m0-4.5l1.72-5.354A2.25 2.25 0 016.16 7.5h8.09v6.75H2.35z"/></svg>
        </div>

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
          name board, and helps with your bags. Choose a plan above and we
          confirm the rest by email.
        </p>

        <ul class="tw-relative tw-z-[1] tw-m-0 tw-mb-6 tw-flex tw-flex-col tw-gap-3.5 tw-p-0">
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

        <?php  ?>
        <div class="tw-relative tw-z-[1] tw-mt-auto tw-rounded-2xl tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-p-4 tw-pt-4 tw-backdrop-blur-md sm:tw-p-5">
          <p class="tw-mb-1.5 tw-flex tw-items-center tw-gap-2 tw-text-[0.72rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-powerlight">
            <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Free cancellation
          </p>
          <p class="tw-mb-0 tw-text-[0.82rem] tw-leading-[1.65] tw-text-white/[0.68]">
            All bookings are eligible for free cancellation up to 4 hours before
            the booking time for Meet &amp; Greet services and up to 2 hours before
            the booking time for standard airport bookings. Transaction reversal
            charges may apply to cover administrative costs.
          </p>
        </div>

        <?php  ?>
      </div>

      <div class="tw-bg-white tw-p-6 sm:tw-p-10 lg:tw-col-span-7">

        <?php  ?>
        <?php
        $mgFieldThird = 'md:tw-col-span-2';
        $mgFieldHalf = 'md:tw-col-span-3';
        $mgFieldFull = 'md:tw-col-span-6';
        ?>
        <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-x-5 tw-gap-y-5 md:tw-grid-cols-6" id="pcMeetGreetForm">
          <input type="hidden" name="form_type" value="meet_greet">

          <div class="<?= $mgFieldThird ?>">
            <label class="pc-required <?= $mgLabelClass ?>" for="mgName">Full Name</label>
            <input type="text" class="<?= $mgInputClass ?>" id="mgName" name="name" value="<?= htmlspecialchars(
  $mgOld['name'],
) ?>" required>
          </div>

          <div class="<?= $mgFieldThird ?>">
            <label class="pc-required <?= $mgLabelClass ?>" for="mgEmail">Email Address</label>
            <input type="email" class="<?= $mgInputClass ?>" id="mgEmail" name="email" value="<?= htmlspecialchars(
  $mgOld['email'],
) ?>" required>
          </div>

          <?php  ?>
          <div class="<?= $mgFieldThird ?>">
            <label class="pc-required <?= $mgLabelClass ?>" for="mgPhone">Phone Number</label>
            <input type="tel" class="<?= $mgInputClass ?>" id="mgPhone" name="phone" autocomplete="tel"
              placeholder="e.g. +353 89 123 4567" value="<?= htmlspecialchars($mgOld['phone']) ?>" required>
          </div>

          <?php  ?>
          <div class="<?= $mgFieldThird ?>">
            <label class="pc-required <?= $mgLabelClass ?>" for="mgFlightNumber">Flight Number</label>
            <input type="text" class="<?= $mgInputClass ?>" id="mgFlightNumber" name="flight_number"
              placeholder="e.g. EI164" value="<?= htmlspecialchars($mgOld['flight_number']) ?>" required>
          </div>

          <div class="<?= $mgFieldThird ?>">
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

          <?php  ?>
          <div class="<?= $mgFieldThird ?>">
            <label class="pc-required <?= $mgLabelClass ?>" for="mgServiceLevel">Plan</label>
            <select class="<?= $mgInputClass ?> pc-custom-select-enhance" id="mgServiceLevel" name="service_level" required>
              <option value="" disabled <?= $mgOld['service_level'] === ''
                ? 'selected'
                : '' ?>>Select your plan</option>
              <?php foreach ($mgServiceLevels as $mgLevelKey => $mgLevelData): ?>
                <option value="<?= htmlspecialchars($mgLevelKey) ?>" <?= $mgOld['service_level'] === $mgLevelKey
                  ? 'selected'
                  : '' ?>><?= $mgLevelData['eyebrow'] ?> &mdash; &euro;<?= (int) $mgLevelData['price'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="pc-mg-field-group <?= $mgFieldHalf ?>" data-mg-group="pickup">
            <label class="<?= $mgLabelClass ?>" for="mgPickupTerminal">Pickup / Airport Terminal</label>
            <select class="<?= $mgInputClass ?> pc-custom-select-enhance" id="mgPickupTerminal" name="pickup_terminal">
              <option value="" disabled <?= $mgOld['pickup_terminal'] === ''
                ? 'selected'
                : '' ?>>Select terminal or station</option>
              <?php foreach ($mgPickupLocationOptions as $terminal): ?>
                <option value="<?= htmlspecialchars($terminal) ?>" <?= $mgOld['pickup_terminal'] === $terminal
  ? 'selected'
  : '' ?>><?= htmlspecialchars($terminal) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="pc-mg-field-group <?= $mgFieldHalf ?>" data-mg-group="pickup">
            <label class="<?= $mgLabelClass ?>" for="mgDestinationAddress">Destination Address</label>
            <input type="text" class="<?= $mgInputClass ?>" id="mgDestinationAddress" name="destination_address"
              placeholder="Where should we drop you off?" autocomplete="off"
              value="<?= htmlspecialchars($mgOld['destination_address']) ?>">
            <div class="tw-hidden tw-mt-1.5 tw-text-sm tw-text-red-600" id="mgDestinationAddressWarning">Please choose a destination address within Dublin.</div>
          </div>

          <div class="pc-mg-field-group <?= $mgFieldHalf ?>" data-mg-group="dropoff">
            <label class="<?= $mgLabelClass ?>" for="mgPickupAddress">Pickup Address</label>
            <input type="text" class="<?= $mgInputClass ?>" id="mgPickupAddress" name="pickup_address"
              placeholder="Where should we collect you from?" autocomplete="off"
              value="<?= htmlspecialchars($mgOld['pickup_address']) ?>">
            <div class="tw-hidden tw-mt-1.5 tw-text-sm tw-text-red-600" id="mgPickupAddressWarning">Please choose a pickup address within Dublin.</div>
          </div>
          <div class="pc-mg-field-group <?= $mgFieldHalf ?>" data-mg-group="dropoff">
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

          <?php  ?>
          <div class="<?= $mgFieldThird ?>">
            <label class="pc-required <?= $mgLabelClass ?>" for="mgPassengers">Number of Passengers</label>
            <input type="number" min="1" max="20" class="<?= $mgInputClass ?>" id="mgPassengers" name="passengers"
              value="<?= htmlspecialchars($mgOld['passengers']) ?>" required>
          </div>

          <div class="<?= $mgFieldThird ?>">
            <label class="pc-required <?= $mgLabelClass ?>" for="mgPickupDate">Date</label>
            <input type="date" class="<?= $mgInputClass ?> pc-custom-datetime-enhance" id="mgPickupDate"
              name="pickup_date" min="<?= htmlspecialchars($mgMinDate) ?>"
              value="<?= htmlspecialchars($mgOld['pickup_date']) ?>" required>
          </div>

          <div class="<?= $mgFieldThird ?>">
            <label class="pc-required <?= $mgLabelClass ?>" for="mgPickupTime">Time</label>
            <input type="time" class="<?= $mgInputClass ?> pc-custom-datetime-enhance" id="mgPickupTime"
              name="pickup_time" value="<?= htmlspecialchars($mgOld['pickup_time']) ?>" required>
          </div>

          <div class="<?= $mgFieldFull ?>">
            <label class="<?= $mgLabelClass ?>" for="mgSpecialRequirements">Special Requirements</label>
            <textarea class="<?= $mgInputClass ?> tw-py-2" id="mgSpecialRequirements" name="special_requirements"
              rows="3"><?= htmlspecialchars($mgOld['special_requirements']) ?></textarea>
          </div>

          <?php  ?>
          <div class="<?= $mgFieldFull ?> tw-pt-1">
            <div class="tw-flex tw-flex-col tw-gap-4 tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-paper-soft tw-p-5 sm:tw-flex-row sm:tw-items-center sm:tw-justify-between">
              <div class="tw-flex tw-items-start tw-gap-3">
                <span class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-peach tw-text-power">
                  <svg class="tw-h-[1.05rem] tw-w-[1.05rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 6.75l9.07 5.66a1.5 1.5 0 001.36 0l9.07-5.66M3.75 19.5h16.5a1.5 1.5 0 001.5-1.5V6A1.5 1.5 0 0020.25 4.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                </span>
                <span>
                  <span class="tw-block tw-text-[0.95rem] tw-font-bold tw-leading-snug tw-text-ink">No payment needed now</span>
                  <span class="<?= $pcBodySm ?> tw-mt-0.5 tw-block">Send your details and we&rsquo;ll confirm your Meet &amp; Greet by email.</span>
                </span>
              </div>
              <button type="submit" class="tw-inline-flex tw-shrink-0 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-gap-2 tw-rounded-full tw-border-0 tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black">
                <span>Send Enquiry</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12L3.269 3.126A59.77 59.77 0 0121.485 12 59.77 59.77 0 013.27 20.876L6 12zm0 0h7.5"/></svg>
              </button>
            </div>
          </div>

          <?php if ($mgFormStatus === 'success'): ?>
            <div class="<?= $mgFieldFull ?>">
              <div class="alert-success tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your Meet &amp; Greet enquiry has been sent. We'll confirm shortly.</div>
            </div>
          <?php elseif ($mgFormStatus === 'error'): ?>
            <div class="<?= $mgFieldFull ?>">
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

    serviceTypeSelect.addEventListener('change', applyServiceType);

    /* "Select Standard / Assist / First Class" in the tier section above.
       Each button carries the tier key, so this sets the form's Service Level
       to it and brings the form into view -- the button does what its label
       says rather than just scrolling.

       The change event is dispatched by hand because custom-select.js renders
       the visible control from the native <select> and only redraws on that
       event; a programmatic assignment never fires one by itself, so without
       it the enhanced field would keep showing "Select your plan".

       BOUND AFTER THE DOM IS PARSED, NOT INLINE. This script sits at the
       bottom of the booking section, and the tier cards are rendered BELOW it
       -- so at the moment this file runs, querySelectorAll('[data-mg-tier]')
       matches nothing and every button silently did nothing. Waiting for
       DOMContentLoaded makes the binding independent of where the tier section
       is required, which has already moved once.

       The listener on `document` is removed by once:true the first time it
       fires, so it cannot accumulate across PJAX navigations the way a
       permanent document listener would. On a PJAX visit readyState is already
       'complete', so the else branch runs and no document listener is added at
       all. The click listeners themselves go on the buttons, which are inside
       <main> and die with it. */
    function bindTierButtons() {
      var tierButtons = document.querySelectorAll('[data-mg-tier]');
      var serviceLevelSelect = document.getElementById('mgServiceLevel');
      var bookingSection = document.getElementById('pcMeetGreetBook');

      Array.prototype.forEach.call(tierButtons, function (btn) {
        btn.addEventListener('click', function () {
          var tier = btn.getAttribute('data-mg-tier');
          if (serviceLevelSelect) {
            serviceLevelSelect.value = tier;
            serviceLevelSelect.dispatchEvent(new Event('change', { bubbles: true }));
          }
          if (bookingSection) {
            bookingSection.scrollIntoView({
              behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'auto' : 'smooth',
              block: 'start'
            });
          }
        });
      });
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', bindTierButtons, { once: true });
    } else {
      bindTierButtons();
    }

    applyServiceType();
  })();
</script>

<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">What's Included</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-0') ?>">Our Meet &amp; Greet Services</h2>
    </div>
    <?php  ?>
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 lg:tw-grid-cols-3 lg:tw-gap-5">
      <?php foreach ($meetGreetServices as $s): ?>
        <div class="tw-group <?= $pcFeature ?> tw-h-full tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-6 tw-shadow-[0_1px_2px_rgba(28,20,16,0.04)] tw-transition tw-duration-300 hover:tw--translate-y-0.5 hover:tw-border-power/25 hover:tw-shadow-[0_14px_30px_-14px_rgba(28,20,16,0.22)] motion-reduce:tw-transform-none motion-reduce:tw-transition-none">
          <span class="<?= $pcFeatureIcon ?> tw-transition-colors tw-duration-300 group-hover:tw-bg-power group-hover:tw-text-white motion-reduce:tw-transition-none">
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
          <div>
            <h3 class="<?= $pcH4 ?>"><?= htmlspecialchars($s['title']) ?></h3>
            <p class="<?= $pcBody ?> tw-mb-0"><?= htmlspecialchars($s['desc']) ?></p>
          </div>
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
<?php  ?>
<script src="<?= $assetPath ?>assets/js/components/custom-datetime.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-datetime.js',
) ?>"></script>

<?php  ?>
<script src="<?= $assetPath ?>assets/js/components/dublin-places-autocomplete.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/dublin-places-autocomplete.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/meet-greet-map.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/meet-greet-map.js',
) ?>"></script>
<script
  src="https://maps.googleapis.com/maps/api/js?key=<?= PC_GOOGLE_MAPS_API_KEY ?>&libraries=places&callback=initMeetGreetAutocomplete"
  async defer></script>

<?php
require __DIR__ . '/components/meet-greet/service-tiers.php';

$sceneId = 'pcFlightBanner';
$sceneGradient = 'linear-gradient(180deg,#0c1b2e 0%,#17395c 28%,#3f7cb0 55%,#bfe2f9 78%,#ffffff 100%)';
$sceneSubjectSize = 'tw-w-[clamp(280px,44vw,620px)]';
$sceneSubject =
  '<img src="' . $assetPath . 'assets/img/plane.avif" alt="" aria-hidden="true"' .
  ' class="tw-h-auto tw-w-full tw-drop-shadow-[0_14px_24px_rgba(0,0,0,0.35)]" loading="lazy">';
$sceneOverlay =
  '<img src="' . $assetPath . 'assets/img/clouds.avif" alt="" aria-hidden="true"' .
  ' class="tw-h-full tw-w-full tw-object-cover [-webkit-mask-image:linear-gradient(180deg,#000_0%,#000_65%,transparent_92%)] [mask-image:linear-gradient(180deg,#000_0%,#000_65%,transparent_92%)]" loading="lazy">';
$sceneTitle = 'Meet & Greet, Made Easy';
$sceneText = 'From arrival to destination, PowerCabs makes every journey simple.';
require __DIR__ . '/components/shared/scroll-scene.php';
?>
<script src="<?= $assetPath ?>assets/js/components/scroll-scene.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/scroll-scene.js',
) ?>"></script>

<?php  ?>

<?php  ?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[720px] tw-text-center md:tw-mb-12">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Why Choose Us</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">
        Why travellers <span class="tw-text-power">choose PowerCabs.</span>
      </h2>
      <p class="<?= $pcBody ?> tw-mb-0">
        What comes with every Meet &amp; Greet booking.
      </p>
    </div>

    <?php  ?>
    <ul class="tw-m-0 tw-grid tw-grid-cols-1 tw-list-none tw-gap-x-10 tw-gap-y-7 tw-p-0 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
      <?php foreach ($whyChoose as $item): ?>
        <li class="tw-group tw-relative tw-flex tw-items-start tw-gap-3 tw-pt-5 before:tw-absolute before:tw-left-0 before:tw-top-0 before:tw-h-0.5 before:tw-w-full before:tw-bg-gradient-to-r before:tw-from-hairline before:tw-to-hairline/0 before:tw-content-[''] after:tw-absolute after:tw-left-0 after:tw-top-0 after:tw-h-0.5 after:tw-w-full after:tw-bg-gradient-to-r after:tw-from-power after:tw-to-power/0 after:tw-opacity-0 after:tw-transition-opacity after:tw-duration-300 after:tw-content-[''] hover:after:tw-opacity-100 motion-reduce:after:tw-transition-none">
          <span class="tw-mt-0.5 tw-inline-flex tw-h-5 tw-w-5 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-md tw-bg-peach tw-text-power tw-transition-colors tw-duration-300 group-hover:tw-bg-power group-hover:tw-text-white motion-reduce:tw-transition-none" aria-hidden="true">
            <svg class="tw-h-3 tw-w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
          </span>
          <span class="tw-text-[0.9375rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= htmlspecialchars($item) ?></span>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<?php
$ctaTitle = 'Ready to book your airport transfer?';
$ctaText = 'Flight tracked, driver waiting inside arrivals, fare fixed before you travel.';

$ctaPrimary = ['href' => '/meet-greet#pcMeetGreetBook', 'label' => 'Book Meet & Greet'];
$ctaSecondary = ['href' => '/faqs', 'label' => 'See FAQs'];

$faqItems = [
  ['q' => 'Where will my driver meet me?', 'a' => 'Your driver waits inside the arrivals terminal with a personalised name board.'],
  ['q' => 'Will I get help with my luggage?', 'a' => 'Yes — professional assistance with luggage from the terminal to the vehicle.'],
  ['q' => 'Do you track my flight?', 'a' => 'Enter your flight details when booking and your pickup is matched to the flight, so a delay does not cost you your driver.'],
  ['q' => 'Can you take a family with extra luggage?', 'a' => 'Yes — spacious vehicles are available for families with children and extra luggage.'],
];
$faqEyebrow = 'Airport transfers';
$faqHeading = 'Meet & greet questions.';
$faqLayout = 'split';
$faqMoreHref = '/faqs';

require __DIR__ . '/components/shared/faq-accordion.php';
require __DIR__ . '/components/shared/final-cta.php';
$bannerCompact = true; 
require __DIR__ . '/components/shared/app-download-banner.php';

require __DIR__ . '/includes/footer.php';
?>
