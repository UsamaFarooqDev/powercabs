<?php
$pageTitle       = 'Ride with PowerCabs | Seamless, Comfortable Taxis in Ireland';
$pageDescription = 'Book a seamless, comfortable ride with PowerCabs -- convenient booking, Garda-vetted drivers, affordable rates and 24/7 availability across Ireland.';
$assetPath       = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';
require __DIR__ . '/lib/fare_calculator.php';

$rideTypeOptions = ['Economy', 'Economy XL', 'Limousine', 'Wheelchair Taxi', 'Pets Taxi', 'Courier / Parcel', 'Business', 'Business XL'];

$quickBookFormStatus = null;
$quickBookFormError  = '';
$quickBookOld = [
  'name'                   => '',
  'email'                  => '',
  'phone'                  => '',
  'ride_type'              => '',
  'pickup_location'        => '',
  'dropoff_location'       => '',
  'distance_km'            => '',
  'duration_min'           => '',
  'fare_eur'               => '',
  'promo_code'             => '',
  'opt_luggage_assistance' => '',
  'opt_meet_greet'         => '',
  'opt_luggage_only'       => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($quickBookOld as $key => $default) {
    $quickBookOld[$key] = trim($_POST[$key] ?? '');
  }

  if (
    $quickBookOld['name'] === '' || $quickBookOld['email'] === '' || $quickBookOld['phone'] === ''
    || $quickBookOld['ride_type'] === '' || $quickBookOld['pickup_location'] === '' || $quickBookOld['dropoff_location'] === ''
  ) {
    $quickBookFormStatus = 'error';
    $quickBookFormError  = 'Please fill in all required fields.';
  } elseif (!filter_var($quickBookOld['email'], FILTER_VALIDATE_EMAIL)) {
    $quickBookFormStatus = 'error';
    $quickBookFormError  = 'Please enter a valid email address.';
  } else {
    // The client only ever supplies the trip-dependent inputs (distance/
    // duration, from Google Directions) -- the fare itself is always
    // recomputed here, never trusted from the submitted form. Whatever
    // fare the browser displayed was itself sourced from
    // api/estimate_fare.php, so this recompute should normally just
    // confirm it -- but the server is what actually goes in the email.
    //
    // The promo code is re-validated by the same recompute, which is the
    // point: the discount the browser showed came from an endpoint anyone
    // can call, so a hand-edited promo_code (or one that expired between
    // the estimate and the submit) is caught here rather than emailed to
    // dispatch as a real price.
    $quickBookPromoDiscount = 0.0;
    $quickBookPromoApplied  = '';
    $quickBookFareBeforePromo = '';

    if (
      $quickBookOld['distance_km'] !== '' && is_numeric($quickBookOld['distance_km'])
      && $quickBookOld['duration_min'] !== '' && is_numeric($quickBookOld['duration_min'])
    ) {
      $recomputed = pc_calculate_fare(
        (float) $quickBookOld['distance_km'],
        (float) $quickBookOld['duration_min'],
        $quickBookOld['ride_type'],
        $quickBookOld['promo_code']
      );
      $quickBookOld['fare_eur'] = number_format($recomputed['fare_eur'], 2, '.', '');
      $quickBookPromoDiscount   = $recomputed['promo_discount'];
      $quickBookPromoApplied    = (string) ($recomputed['promo_code'] ?? '');
      $quickBookFareBeforePromo = number_format($recomputed['fare_before_promo'], 2, '.', '');
    } else {
      $quickBookOld['fare_eur'] = '';
    }

    $selectedAddons = [];
    if ($quickBookOld['opt_luggage_assistance'] !== '') {
      $selectedAddons[] = 'Luggage Assistance (airport bookings only)';
    }
    if ($quickBookOld['opt_meet_greet'] !== '') {
      $selectedAddons[] = 'Meet and Greet (hotel / doorstep / business venue)';
    }
    if ($quickBookOld['opt_luggage_only'] !== '') {
      $selectedAddons[] = 'Only Luggage (no passengers or pets)';
    }

    $body = "New quick booking request from the PowerCabs Ride page.\n\n"
      . "Name: {$quickBookOld['name']}\n"
      . "Email: {$quickBookOld['email']}\n"
      . "Phone: {$quickBookOld['phone']}\n"
      . "Ride Type: {$quickBookOld['ride_type']}\n\n"
      . "Pickup Location: {$quickBookOld['pickup_location']}\n"
      . "Drop-off Location: {$quickBookOld['dropoff_location']}\n\n"
      . "Add-ons: " . ($selectedAddons !== [] ? implode(', ', $selectedAddons) : 'None') . "\n";

    if ($quickBookOld['distance_km'] !== '' && $quickBookOld['duration_min'] !== '' && $quickBookOld['fare_eur'] !== '') {
      $body .= "\nEstimated Distance: {$quickBookOld['distance_km']} km\n"
        . "Estimated Duration: {$quickBookOld['duration_min']} min\n";

      // Only itemise the promo when one actually survived re-validation --
      // dispatch needs to see which code was honoured and for how much, not
      // merely what the passenger typed.
      if ($quickBookPromoApplied !== '' && $quickBookPromoDiscount > 0) {
        $body .= "Fare Before Promo: \u{20AC}{$quickBookFareBeforePromo}\n"
          . "Promo Code: {$quickBookPromoApplied} (-\u{20AC}"
          . number_format($quickBookPromoDiscount, 2, '.', '') . ")\n";
      } elseif ($quickBookOld['promo_code'] !== '') {
        // Echoed so dispatch can see what the passenger actually typed (a
        // near-miss is worth knowing about), but this is the one unvalidated
        // string that reaches the email -- flattened to a single line and
        // capped so a pasted essay can't reshape the message.
        $rejectedCode = substr(preg_replace('/\s+/', ' ', $quickBookOld['promo_code']), 0, 32);
        $body .= "Promo Code: {$rejectedCode} (NOT APPLIED -- invalid, expired or not eligible)\n";
      }

      $body .= "Estimated Fare: \u{20AC}{$quickBookOld['fare_eur']}\n";
    }

    $result = pc_send_mail(
      'Quick ride booking: ' . $quickBookOld['name'],
      $body,
      ['name' => $quickBookOld['name'], 'email' => $quickBookOld['email']]
    );

    if ($result['success']) {
      $quickBookFormStatus = 'success';
      foreach ($quickBookOld as $key => $default) {
        $quickBookOld[$key] = '';
      }
    } else {
      $quickBookFormStatus = 'error';
      $quickBookFormError  = 'Sorry, something went wrong sending your booking. Please try again or call us directly.';
    }
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Ride';
$heroTitleLight  = 'Seamless and';
$heroTitleBold   = 'Comfortable Rides.';
$heroDescription = "PowerCabs is committed to providing a smooth, reliable, and comfortable ride experience. Whether you're commuting to work, heading to the airport, or exploring the city, PowerCabs offers convenient booking, safe transportation, affordable pricing, and 24/7 availability.";
$heroBgImage     = 'https://images.pexels.com/photos/1399282/pexels-photo-1399282.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

require __DIR__ . '/components/ride/hero-fare-section.php';
require __DIR__ . '/components/ride/power10-promo.php';
require __DIR__ . '/components/ride/built-around.php';
require __DIR__ . '/components/ride/ride-types.php';
require __DIR__ . '/components/ride/booking-steps.php';
require __DIR__ . '/components/ride/why-powercabs.php';
require __DIR__ . '/components/ride/ride-faq.php';

require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
