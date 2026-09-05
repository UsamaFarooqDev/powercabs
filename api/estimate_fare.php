<?php
/**
 * Read-only booking-time fare estimate. Runs the exact same pipeline
 * (lib/fare_calculator.php) that the booking-form POST handlers use when a
 * ride is actually submitted, so the number shown on screen before submit
 * always matches what gets billed. Called by
 * assets/js/components/ride-fare-estimate.js and
 * assets/js/components/book-ride-map.js -- neither computes a fare itself.
 */

header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../lib/fare_calculator.php';

/** @return never */
function pc_estimate_fare_fail(int $status, string $message): void
{
    http_response_code($status);
    echo json_encode(['error' => $message]);
    exit;
}

// The exact, canonical ride-type strings used across the site's forms --
// must match ride_types.name exactly (case included). Kept in sync with
// $rideTypeOptions in ride.php / book-ride-online.php.
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

$distanceKmRaw = $_GET['distance_km'] ?? $_POST['distance_km'] ?? null;
$durationMinRaw = $_GET['duration_min'] ?? $_POST['duration_min'] ?? null;
$rideType = trim($_GET['ride_type'] ?? $_POST['ride_type'] ?? '');
// Optional. A bad code is never a 400 -- it comes back as a normal 200 with
// the undiscounted fare plus promo_error, so the widget can still show a
// usable price alongside the message instead of failing the whole estimate.
$promoCode = trim($_GET['promo_code'] ?? $_POST['promo_code'] ?? '');

if ($distanceKmRaw === null || !is_numeric($distanceKmRaw) || (float) $distanceKmRaw < 0) {
    pc_estimate_fare_fail(400, 'A valid distance_km is required.');
}
if ($durationMinRaw === null || !is_numeric($durationMinRaw) || (float) $durationMinRaw < 0) {
    pc_estimate_fare_fail(400, 'A valid duration_min is required.');
}
if (!in_array($rideType, $rideTypeOptions, true)) {
    pc_estimate_fare_fail(400, 'Unknown ride_type.');
}

// A sanity cap, not a business rule -- nothing on the Dublin road network is
// a 500km/10-hour taxi trip; this just stops a malformed value doing
// something odd downstream.
$distanceKm = min((float) $distanceKmRaw, 500.0);
$durationMin = min((float) $durationMinRaw, 600.0);

$result = pc_calculate_fare($distanceKm, $durationMin, $rideType, $promoCode);

echo json_encode([
    // Always the payable amount, promo included -- book-ride-map.js reads
    // only this key and never sends a promo_code, so it is unaffected.
    'fare_eur' => $result['fare_eur'],
    'distance_km' => round($distanceKm, 2),
    'duration_min' => round($durationMin, 1),
    'period' => $result['period'],
    'fare_before_promo' => $result['fare_before_promo'],
    'promo_code' => $result['promo_code'],
    'promo_discount' => $result['promo_discount'],
    'promo_error' => $result['promo_error'] === null
        ? null
        : pc_promo_error_message($result['promo_error'], $result['promo_min_fare']),
]);
