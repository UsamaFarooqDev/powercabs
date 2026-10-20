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

      if ($quickBookPromoApplied !== '' && $quickBookPromoDiscount > 0) {
        $body .= "Fare Before Promo: \u{20AC}{$quickBookFareBeforePromo}\n"
          . "Promo Code: {$quickBookPromoApplied} (-\u{20AC}"
          . number_format($quickBookPromoDiscount, 2, '.', '') . ")\n";
      } elseif ($quickBookOld['promo_code'] !== '') {
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

$pageService = [
  'name' => 'Taxi and Private Hire Rides',
  'serviceType' => 'Taxi service',
  'description' =>
    'Licensed, Garda-vetted drivers and eight vehicle types, from everyday economy cars to wheelchair-accessible vehicles, limousines and courier runs.',
];

require __DIR__ . '/includes/header.php';

$heroEyebrow     = 'Ride';
$heroTitleLight  = 'Your ride.';
$heroTitleBold   = 'Your way.';
$heroDescription = 'Licensed, Garda-vetted drivers across Dublin. See your fare before you book, and pay exactly what you were quoted.';

require __DIR__ . '/components/ride/hero.php';

require __DIR__ . '/components/ride/hero-fare-section.php';

require __DIR__ . '/components/ride/power10-promo.php';
require __DIR__ . '/components/ride/ride-types.php';
require __DIR__ . '/components/ride/booking-steps.php';

require __DIR__ . '/components/ride/why-powercabs.php';

$supportEyebrow = 'Customer Support';
$supportHeading = 'Need a hand with a booking?';
$supportText =

  'Fares, bookings, a driver you cannot find, or something left in the car — call and speak to the PowerCabs team directly.';
$supportNumber = '+353 89 972 8089';
$supportTel = '+353899728089';
$supportHours = 'Customer support is available 24/7, every day of the year.';
$supportWhatsapp = 'https://wa.me/+353899728089';

$supportImage = 'https://images.pexels.com/photos/4606338/pexels-photo-4606338.jpeg?auto=compress&cs=tinysrgb&w=1600';
require __DIR__ . '/components/shared/support-band.php';
require __DIR__ . '/components/ride/ride-faq.php';
$bannerCompact = true; 
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
