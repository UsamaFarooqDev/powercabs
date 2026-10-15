<?php
header('Content-Type: application/json; charset=utf-8');

require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../lib/fare_calculator.php';

function pc_estimate_fare_fail(int $status, string $message): void
{
    http_response_code($status);
    echo json_encode(['error' => $message]);
    exit;
}

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

$distanceKm = min((float) $distanceKmRaw, 500.0);
$durationMin = min((float) $durationMinRaw, 600.0);

$result = pc_calculate_fare($distanceKm, $durationMin, $rideType, $promoCode);

echo json_encode([

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
