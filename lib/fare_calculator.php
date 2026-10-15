<?php
require_once __DIR__ . '/../includes/env.php';

class PcSupabaseError extends \RuntimeException {}

function pc_supabase_get(string $table, array $query): array
{
    $url = rtrim(PC_SUPABASE_URL, '/');
    $key = PC_SUPABASE_SERVICE_KEY;
    if ($url === '' || $key === '') {
        return [];
    }

    $qs = http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    $endpoint = "{$url}/rest/v1/{$table}?{$qs}";

    $ch = curl_init($endpoint);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'apikey: ' . $key,
            'Authorization: Bearer ' . $key,
            'Accept: application/json',
        ],

        CURLOPT_CONNECTTIMEOUT => 3,
        CURLOPT_TIMEOUT => 4,
    ]);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlErrno = curl_errno($ch);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($response === false) {
        throw new PcSupabaseError("Supabase request to {$table} failed ({$curlErrno}): {$curlError}");
    }
    if ($httpCode < 200 || $httpCode >= 300) {
        throw new PcSupabaseError("Supabase returned HTTP {$httpCode} for {$table}: {$response}");
    }

    $decoded = json_decode($response, true);
    if (!is_array($decoded)) {
        throw new PcSupabaseError("Supabase returned malformed JSON for {$table}.");
    }

    return $decoded;
}

function pc_fare_period(?DateTimeInterface $at = null): string
{
    $now = $at ?? new DateTime('now', new DateTimeZone('Europe/Dublin'));
    $hour = (int) $now->format('G');
    return ($hour >= 8 && $hour < 20) ? 'day' : 'night';
}

function pc_fare_hardcoded_rates(string $period): array
{
    return $period === 'day'
        ? ['base_fare' => 3.00, 'booking_fee' => 4.40, 'per_km_rate' => 1.32, 'per_min_rate' => 0.20]
        : ['base_fare' => 3.00, 'booking_fee' => 5.40, 'per_km_rate' => 1.81, 'per_min_rate' => 0.30];
}

function pc_fare_hardcoded_multiplier(string $rideType): float
{
    $table = [
        'Economy' => 1.00,
        'Economy XL' => 1.20,
        'Limousine' => 2.00,
        'Wheelchair Taxi' => 1.10,
        'Pets Taxi' => 1.15,
        'Courier / Parcel' => 0.90,
    ];
    return $table[$rideType] ?? 1.00;
}

function pc_fetch_ride_type_fallback_multiplier(string $rideType): float
{
    try {
        $rows = pc_supabase_get('ride_types', [
            'name' => 'eq.' . $rideType,
            'select' => 'multiplier',
            'limit' => '1',
        ]);
        if (isset($rows[0]['multiplier']) && is_numeric($rows[0]['multiplier'])) {
            return (float) $rows[0]['multiplier'];
        }
    } catch (PcSupabaseError $e) {
}
    return pc_fare_hardcoded_multiplier($rideType);
}

function pc_fare_discount_window_active(?string $validFrom, ?string $validUntil): bool
{
    $now = new DateTime('now', new DateTimeZone('Europe/Dublin'));

    if ($validFrom !== null && $validFrom !== '') {
        try {
            if ($now < new DateTime($validFrom)) {
                return false;
            }
        } catch (\Exception $e) {
        }
    }

    if ($validUntil !== null && $validUntil !== '') {
        try {
            if ($now > new DateTime($validUntil)) {
                return false;
            }
        } catch (\Exception $e) {
        }
    }

    return true;
}

function pc_resolve_pricing_config(string $rideType, string $period): array
{
    try {
$rows = pc_supabase_get('pricing_config', [
            'ride_type' => 'in.(' . $rideType . ',all)',
            'is_active' => 'eq.true',
            'select' => '*',
        ]);
    } catch (PcSupabaseError $e) {
        $rows = [];
    }

    $find = static function (string $type, string $per) use ($rows): ?array {
        foreach ($rows as $row) {
            if (($row['ride_type'] ?? null) === $type && ($row['time_period'] ?? null) === $per) {
                return $row;
            }
        }
        return null;
    };

    $row = $find($rideType, $period)
        ?? $find($rideType, 'both')
        ?? $find('all', $period)
        ?? $find('all', 'both');

    if ($row !== null) {
        return [
            'base_fare' => (float) ($row['base_fare'] ?? 0),
            'booking_fee' => (float) ($row['booking_fee'] ?? 0),
            'per_km_rate' => (float) ($row['per_km_rate'] ?? 0),
            'per_min_rate' => (float) ($row['per_min_rate'] ?? 0),
            'type_multiplier' => (float) ($row['type_multiplier'] ?? 1),
            'surge_enabled' => (bool) ($row['surge_enabled'] ?? false),
            'surge_multiplier' => (float) ($row['surge_multiplier'] ?? 1),
            'discount_enabled' => (bool) ($row['discount_enabled'] ?? false),
            'discount_type' => $row['discount_type'] ?? null,
            'discount_value' => (float) ($row['discount_value'] ?? 0),
            'discount_min_fare' => (float) ($row['discount_min_fare'] ?? 0),

            'valid_from' => $row['discount_valid_from'] ?? null,
            'valid_until' => $row['discount_valid_until'] ?? null,
            'uses_count' => (int) ($row['discount_uses_count'] ?? 0),
            'max_uses' => isset($row['discount_max_uses']) ? (int) $row['discount_max_uses'] : null,
            'minimum_fare' => (float) ($row['minimum_fare'] ?? 0),
            'is_fallback' => false,
        ];
    }

    $rates = pc_fare_hardcoded_rates($period);
    return [
        'base_fare' => $rates['base_fare'],
        'booking_fee' => $rates['booking_fee'],
        'per_km_rate' => $rates['per_km_rate'],
        'per_min_rate' => $rates['per_min_rate'],
        'type_multiplier' => pc_fetch_ride_type_fallback_multiplier($rideType),
        'surge_enabled' => false,
        'surge_multiplier' => 1.0,
        'discount_enabled' => false,
        'discount_type' => null,
        'discount_value' => 0.0,
        'discount_min_fare' => 0.0,
        'valid_from' => null,
        'valid_until' => null,
        'uses_count' => 0,
        'max_uses' => null,
        'minimum_fare' => 0.0,
        'is_fallback' => true,
    ];
}

function pc_promo_code_is_wellformed(string $code): bool
{
    return preg_match('/^[A-Za-z0-9_-]{2,32}$/', $code) === 1;
}

function pc_fetch_promo_code(string $code): ?array
{
    if (!pc_promo_code_is_wellformed($code)) {
        return null;
    }

    $pattern = str_replace('_', '\_', $code);

    $rows = pc_supabase_get('promo_codes', [
        'code' => 'ilike.' . $pattern,
        'select' => '*',
        'limit' => '1',
    ]);

    return $rows[0] ?? null;
}

function pc_apply_promo_code(float $fare, string $rideType, string $code): array
{
    $none = ['code' => null, 'discount' => 0.0, 'fare' => round($fare, 2), 'error' => null];

    $code = trim($code);
    if ($code === '') {
        return $none;
    }

    if (!pc_promo_code_is_wellformed($code)) {
        return ['code' => null, 'discount' => 0.0, 'fare' => round($fare, 2), 'error' => 'invalid'];
    }

    try {
        $row = pc_fetch_promo_code($code);
    } catch (PcSupabaseError $e) {
return ['code' => null, 'discount' => 0.0, 'fare' => round($fare, 2), 'error' => 'unavailable'];
    }

    if ($row === null) {
        $configured = PC_SUPABASE_URL !== '' && PC_SUPABASE_SERVICE_KEY !== '';
        return [
            'code' => null,
            'discount' => 0.0,
            'fare' => round($fare, 2),
            'error' => $configured ? 'invalid' : 'unavailable',
        ];
    }

    $canonical = (string) ($row['code'] ?? $code);
    $reject = static fn(string $why): array => [
        'code' => null,
        'discount' => 0.0,
        'fare' => round($fare, 2),
        'error' => $why,
    ];

    if (!($row['is_active'] ?? true)) {
        return $reject('expired');
    }
    if (!pc_fare_discount_window_active($row['valid_from'] ?? null, $row['valid_until'] ?? null)) {
        return $reject('expired');
    }

    $maxUses = isset($row['max_uses']) && $row['max_uses'] !== null ? (int) $row['max_uses'] : null;
    if ($maxUses !== null && (int) ($row['uses_count'] ?? 0) >= $maxUses) {
        return $reject('expired');
    }

    $rowRideType = $row['ride_type'] ?? null;
    if ($rowRideType !== null && $rowRideType !== '' && $rowRideType !== $rideType) {
        return $reject('ride_type');
    }

    $minFare = (float) ($row['min_fare'] ?? 0);
    if ($fare < $minFare) {
        return [
            'code' => null,
            'discount' => 0.0,
            'fare' => round($fare, 2),
            'error' => 'min_fare',
            'min_fare' => $minFare,
        ];
    }

    $value = (float) ($row['discount_value'] ?? 0);
    $discount = ($row['discount_type'] ?? '') === 'percent' ? $fare * $value / 100 : $value;

    foreach (['max_discount_per_use', 'max_discount'] as $capColumn) {
        if (isset($row[$capColumn]) && $row[$capColumn] !== null) {
            $discount = min($discount, (float) $row[$capColumn]);
        }
    }

    $discount = round(max(0.0, min($discount, $fare)), 2);

    if ($discount <= 0) {
        return $reject('invalid');
    }

    return [
        'code' => $canonical,
        'discount' => $discount,
        'fare' => round($fare - $discount, 2),
        'error' => null,
    ];
}

function pc_promo_error_message(string $error, float $minFare = 0.0): string
{
    switch ($error) {
        case 'expired':
            return 'That promo code has expired or is no longer available.';
        case 'min_fare':
            return sprintf('That code needs a fare of at least %s%.2f.', "\u{20AC}", $minFare);
        case 'ride_type':
            return "That code doesn't apply to this ride type.";
        case 'unavailable':
            return "We couldn't check that code right now -- you can still book at the fare shown.";
        default:
            return "That promo code isn't valid.";
    }
}

function pc_calculate_fare(
    float $distanceKm,
    float $durationMin,
    string $rideType,
    string $promoCode = ''
): array {
    $distanceKm = max(0.0, $distanceKm);
    $durationMin = max(0.0, $durationMin);

    $period = pc_fare_period();
    $config = pc_resolve_pricing_config($rideType, $period);

    $meter = $config['base_fare']
        + $config['booking_fee']
        + $distanceKm * $config['per_km_rate']
        + $durationMin * $config['per_min_rate'];

    $withPromo = static function (float $fare, bool $isFallback) use ($period, $meter, $config, $rideType, $promoCode): array {
        $promo = pc_apply_promo_code($fare, $rideType, $promoCode);
        return [
            'fare_eur' => $promo['fare'],
            'period' => $period,
            'meter' => $meter,
            'multiplier' => $config['type_multiplier'],
            'is_fallback' => $isFallback,
            'fare_before_promo' => round($fare, 2),
            'promo_code' => $promo['code'],
            'promo_discount' => $promo['discount'],
            'promo_error' => $promo['error'],
            'promo_min_fare' => $promo['min_fare'] ?? 0.0,
        ];
    };

    if ($config['is_fallback']) {
return $withPromo(round($meter * $config['type_multiplier'], 2), true);
    }

    $surge = $config['surge_enabled'] ? $config['surge_multiplier'] : 1.0;
    $raw = $meter * $config['type_multiplier'] * $surge;

    $discountApplies = $config['discount_enabled']
        && pc_fare_discount_window_active($config['valid_from'], $config['valid_until'])
        && ($config['max_uses'] === null || $config['uses_count'] < $config['max_uses'])
        && $raw >= $config['discount_min_fare'];

    if ($discountApplies) {
        if ($config['discount_type'] === 'percentage') {
            $raw -= $raw * $config['discount_value'] / 100;
        } elseif ($config['discount_type'] === 'fixed') {
            $raw -= $config['discount_value'];
        }
    }

    return $withPromo(round(max($raw, $config['minimum_fare']), 2), false);
}
