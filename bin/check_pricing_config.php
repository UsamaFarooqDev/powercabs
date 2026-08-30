<?php
/**
 * One-time data check (per the fare-mismatch ticket): confirms every
 * ride_types.name has an exact-cased, active pricing_config.ride_type row
 * to match against. A missing or mis-cased row (e.g. "economy" vs
 * "Economy") doesn't error anywhere -- it just silently falls through to
 * the generic 'all' rows or the hard-coded fallback and produces a fare
 * that looks "wrong" even once the code itself is correct.
 *
 * CLI only -- run it once after adding SUPABASE_URL/SUPABASE_SERVICE_KEY to
 * .env, and again any time a ride type is added or renamed:
 *
 *   php bin/check_pricing_config.php
 *
 * Fixes go in the data (add the missing exact-cased pricing_config rows),
 * never in the lookup code -- making the lookup case-insensitive would just
 * mask real app/site behaviour instead of matching it.
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    exit("This is a CLI-only diagnostic script.\n");
}

require __DIR__ . '/../includes/env.php';
require __DIR__ . '/../lib/fare_calculator.php';

if (PC_SUPABASE_URL === '' || PC_SUPABASE_SERVICE_KEY === '') {
    fwrite(STDERR, "SUPABASE_URL / SUPABASE_SERVICE_KEY are not set in .env -- nothing to check.\n");
    exit(1);
}

try {
    $rideTypes = pc_supabase_get('ride_types', ['select' => 'name,multiplier']);
    $pricingRows = pc_supabase_get('pricing_config', ['select' => 'ride_type,time_period,is_active', 'is_active' => 'eq.true']);
} catch (PcSupabaseError $e) {
    fwrite(STDERR, "Could not reach Supabase: {$e->getMessage()}\n");
    exit(1);
}

if (empty($rideTypes)) {
    fwrite(STDERR, "ride_types returned no rows -- check the table name/credentials.\n");
    exit(1);
}

// periods actually configured, per exact ride_type string.
$periodsByType = [];
foreach ($pricingRows as $row) {
    $type = $row['ride_type'] ?? null;
    $period = $row['time_period'] ?? null;
    if ($type === null || $period === null) {
        continue;
    }
    $periodsByType[$type][$period] = true;
}

$hasAll = isset($periodsByType['all']) && (isset($periodsByType['all']['both'])
    || (isset($periodsByType['all']['day']) && isset($periodsByType['all']['night'])));

$problems = 0;

echo "Checking " . count($rideTypes) . " ride_types row(s) against pricing_config...\n\n";

foreach ($rideTypes as $rideType) {
    $name = $rideType['name'] ?? '(unnamed)';
    $exact = $periodsByType[$name] ?? [];
    $covered = isset($exact['both']) || (isset($exact['day']) && isset($exact['night']));

    if ($covered) {
        echo "  OK    {$name} -- has its own active pricing_config row(s)\n";
        continue;
    }

    $problems++;

    // Look for a near-miss: some other ride_type string that matches this
    // one case-insensitively -- the exact mistake this check exists to
    // catch (e.g. "economy" vs "Economy").
    $nearMiss = null;
    foreach (array_keys($periodsByType) as $otherType) {
        if ($otherType !== $name && strcasecmp($otherType, $name) === 0) {
            $nearMiss = $otherType;
            break;
        }
    }

    if ($nearMiss !== null) {
        echo "  MISS  {$name} -- no exact-cased row, but found \"{$nearMiss}\" (casing mismatch)\n";
    } elseif ($hasAll) {
        echo "  WARN  {$name} -- no dedicated row; silently priced from the generic 'all' rows\n";
    } else {
        echo "  FAIL  {$name} -- no dedicated row AND no 'all' rows either; falls all the way to the hard-coded fallback\n";
    }
}

echo "\n" . ($problems === 0
    ? "All ride types have their own pricing_config coverage.\n"
    : "{$problems} ride type(s) need attention -- add the missing exact-cased pricing_config row(s), don't change the lookup to be case-insensitive.\n");

exit($problems === 0 ? 0 : 1);
