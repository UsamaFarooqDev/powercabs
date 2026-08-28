<?php
/**
 * Shared booking-time fare calculator -- the single source of truth for
 * fare_eur on this site. Mirrors the passenger app's pricing pipeline
 * exactly (see "PowerCabs Fare Engine.pdf" at the repo root): period ->
 * config -> meter -> multiply -> discount/clamp. Every place on this site
 * that needs a fare -- the live estimate endpoint (api/estimate_fare.php)
 * and the booking-form POST handlers in ride.php / book-ride-online.php --
 * calls pc_calculate_fare() from here. Do not re-implement this math a
 * second time anywhere: two independently-maintained copies of this exact
 * calculation (one in the passenger app, one on this site) is what caused
 * the fare-mismatch bug this file fixes.
 *
 * Two specific mistakes to never reintroduce, both of which caused real
 * drift between the app's fare and this site's:
 *   1. Reading the day/night period from the browser's clock. A visitor's
 *      device clock/timezone is never trusted -- pc_fare_period() always
 *      evaluates server-side against Europe/Dublin.
 *   2. Taking the ride-type multiplier from ride_types.multiplier. That
 *      column is only ever the hard-coded-fallback's last resort; the live
 *      source is always pricing_config.type_multiplier.
 */

require_once __DIR__ . '/../includes/env.php';

/** Thrown internally when a Supabase request fails -- callers fall back gracefully rather than let this reach the caller as a fatal error. */
class PcSupabaseError extends \RuntimeException {}

/**
 * GET against the Supabase PostgREST API.
 *
 * @param string $table Table name, e.g. 'pricing_config'.
 * @param array<string,string> $query Query-string params in PostgREST
 *   filter syntax (e.g. ['ride_type' => 'in.(Economy,all)', 'is_active' =>
 *   'eq.true', 'select' => '*']).
 * @return array<int,array<string,mixed>> Decoded JSON rows, or [] if
 *   Supabase isn't configured (SUPABASE_URL/SUPABASE_SERVICE_KEY empty) --
 *   callers treat that exactly like "no rows matched" and continue down
 *   their own fallback chain.
 * @throws PcSupabaseError on a network/HTTP/decode failure.
 */
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
        // Booking must never hang waiting on a slow/unreachable database --
        // a short timeout here just means the fallback chain kicks in a
        // little sooner.
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

/**
 * Current booking period, evaluated server-side against Europe/Dublin --
 * NEVER from a client-supplied clock or timezone. This is bug #1 from the
 * fare-mismatch ticket: a visitor's mis-set device clock could otherwise
 * silently buy day rates at night or vice versa.
 *
 * $at exists only so tests can check the 08:00/20:00 boundary deterministically
 * -- no caller in this codebase (or any HTTP endpoint) ever passes it, so the
 * real request path always evaluates against the actual current time.
 */
function pc_fare_period(?DateTimeInterface $at = null): string
{
    $now = $at ?? new DateTime('now', new DateTimeZone('Europe/Dublin'));
    $hour = (int) $now->format('G');
    return ($hour >= 8 && $hour < 20) ? 'day' : 'night';
}

/**
 * The app's own fallback rate cards (see the fare-engine spec's "Day and
 * night are two rate cards" table). Reached only when pricing_config has no
 * matching row at all for this ride type -- not even the generic 'all'
 * pair. These are last-resort constants, never the live price list.
 *
 * @return array{base_fare:float, booking_fee:float, per_km_rate:float, per_min_rate:float}
 */
function pc_fare_hardcoded_rates(string $period): array
{
    return $period === 'day'
        ? ['base_fare' => 3.00, 'booking_fee' => 4.40, 'per_km_rate' => 1.32, 'per_min_rate' => 0.20]
        : ['base_fare' => 3.00, 'booking_fee' => 5.40, 'per_km_rate' => 1.81, 'per_min_rate' => 0.30];
}

/**
 * Last-resort ride-type multiplier, only reached if the ride_types table
 * itself is unreachable (total DB outage) -- see
 * pc_fetch_ride_type_fallback_multiplier(). Business / Business XL have no
 * hard-coded copy anywhere, same as the passenger app; 1.00 here is a
 * genuine last resort, not a real rate.
 */
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

/**
 * Reads ride_types.multiplier for one ride type. Only ever called from the
 * hard-coded-fallback branch of pc_resolve_pricing_config() -- this column
 * is NOT the live source of the ride-type multiplier
 * (pricing_config.type_multiplier is). Using it anywhere else is exactly
 * bug #2 from the fare-mismatch ticket.
 */
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
        // Fall through to the hard-coded table below -- total outage.
    }
    return pc_fare_hardcoded_multiplier($rideType);
}

/**
 * True if now (Europe/Dublin) falls inside [$validFrom, $validUntil].
 * Either bound is treated as open-ended when null/empty/unparsable.
 */
function pc_fare_discount_window_active(?string $validFrom, ?string $validUntil): bool
{
    $now = new DateTime('now', new DateTimeZone('Europe/Dublin'));

    if ($validFrom !== null && $validFrom !== '') {
        try {
            if ($now < new DateTime($validFrom)) {
                return false;
            }
        } catch (\Exception $e) {
            // Unparsable bound -- ignore it rather than block the discount
            // on a data-entry mistake.
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

/**
 * Resolves one pricing_config row for ($rideType, $period) via the exact
 * fallback chain from the fare-engine spec:
 *   [ride_type + period] -> [ride_type + 'both'] -> ['all' + period]
 *   -> ['all' + 'both'] -> hard-coded fallback.
 *
 * $rideType must match ride_types.name as an exact string -- case matters.
 * A mismatch (e.g. "economy" vs "Economy") silently drops to the 'all'
 * rows or the hard-coded fallback; see the ticket's "DATA CHECK" note for
 * how to catch that in the data itself.
 *
 * @return array{
 *   base_fare:float, booking_fee:float, per_km_rate:float, per_min_rate:float,
 *   type_multiplier:float, surge_enabled:bool, surge_multiplier:float,
 *   discount_enabled:bool, discount_type:?string, discount_value:float,
 *   discount_min_fare:float, valid_from:?string, valid_until:?string,
 *   uses_count:int, max_uses:?int, minimum_fare:float, is_fallback:bool
 * }
 */
function pc_resolve_pricing_config(string $rideType, string $period): array
{
    try {
        // One round trip: every row that could possibly matter for this
        // ride type (its own rows plus the generic 'all' rows), then pick
        // the right one in the exact priority order below.
        $rows = pc_supabase_get('pricing_config', [
            'ride_type' => 'in.(' . $rideType . ',all)',
            'is_active' => 'eq.true',
            'select' => '*',
        ]);
    } catch (PcSupabaseError $e) {
        $rows = [];
    }

    // NOTE: the live table's day/night column is actually named
    // `time_period`, not `period` -- confirmed against the real schema
    // after a 12-15 fare gap traced straight back here. Reading the wrong
    // key here doesn't error (PHP just sees `null`), it silently loses the
    // if-match and drops straight to the hard-coded fallback below for
    // EVERY lookup, which is exactly what was happening.
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
            // Also mis-named below (discount_valid_from/until,
            // discount_max_uses, discount_uses_count are the real columns) --
            // same silent-null failure mode as `period` above.
            'valid_from' => $row['discount_valid_from'] ?? null,
            'valid_until' => $row['discount_valid_until'] ?? null,
            'uses_count' => (int) ($row['discount_uses_count'] ?? 0),
            'max_uses' => isset($row['discount_max_uses']) ? (int) $row['discount_max_uses'] : null,
            'minimum_fare' => (float) ($row['minimum_fare'] ?? 0),
            'is_fallback' => false,
        ];
    }

    // Nothing in pricing_config for this ride type OR 'all' (or Supabase
    // isn't reachable/configured at all) -- the hard-coded last resort.
    // Per the fare-engine spec this path ignores minimum_fare, surge and
    // discounts entirely, and the multiplier comes from ride_types.multiplier
    // (the one place that column is the correct source).
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

/**
 * The full booking-time pricing pipeline for one trip. Order is
 * load-bearing (meter -> ride-type/surge multiply -> config discount ->
 * minimum-fare clamp) -- do not reshuffle these steps, see the fare-engine
 * spec's "porting notes".
 *
 * distance_km/duration_min are the only trip-dependent inputs (from Google
 * Directions); everything else here is configuration. This function is the
 * ONLY place fare_eur is computed on this site -- the live estimate
 * endpoint and every booking-form handler call this, never their own copy
 * of the math.
 *
 * @return array{fare_eur:float, period:string, meter:float, multiplier:float, is_fallback:bool}
 */
function pc_calculate_fare(float $distanceKm, float $durationMin, string $rideType): array
{
    $distanceKm = max(0.0, $distanceKm);
    $durationMin = max(0.0, $durationMin);

    $period = pc_fare_period();
    $config = pc_resolve_pricing_config($rideType, $period);

    $meter = $config['base_fare']
        + $config['booking_fee']
        + $distanceKm * $config['per_km_rate']
        + $durationMin * $config['per_min_rate'];

    if ($config['is_fallback']) {
        // Last-resort path: multiplier only, nothing else (surge/discount/
        // minimum_fare do not apply here -- see the spec's porting notes).
        $fare = round($meter * $config['type_multiplier'], 2);
        return [
            'fare_eur' => $fare,
            'period' => $period,
            'meter' => $meter,
            'multiplier' => $config['type_multiplier'],
            'is_fallback' => true,
        ];
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

    $fare = round(max($raw, $config['minimum_fare']), 2);

    return [
        'fare_eur' => $fare,
        'period' => $period,
        'meter' => $meter,
        'multiplier' => $config['type_multiplier'],
        'is_fallback' => false,
    ];
}
