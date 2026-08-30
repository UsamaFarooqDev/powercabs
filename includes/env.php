<?php

function pc_load_env(string $path): void {
    static $loaded = false;
    if ($loaded) {
        return;
    }
    $loaded = true;

    if (!is_readable($path)) {
        return;
    }

    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key   = trim($key);
        $value = trim($value);

        // Allow "quoted" or 'quoted' values so a secret can safely contain
        // spaces or a literal # without being read as a comment.
        if (strlen($value) >= 2 && in_array($value[0], ['"', "'"], true) && str_ends_with($value, $value[0])) {
            $value = substr($value, 1, -1);
        }

        if ($key === '') {
            continue;
        }

        putenv("{$key}={$value}");
        $_ENV[$key]    = $value;
        $_SERVER[$key] = $value;
    }
}

/** getenv() with a default fallback. */
function pc_env(string $key, $default = null) {
    $value = getenv($key);
    return $value === false ? $default : $value;
}

pc_load_env(__DIR__ . '/../.env');

define('PC_SMTP_HOST', pc_env('SMTP_HOST', ''));
define('PC_SMTP_PORT', (int) pc_env('SMTP_PORT', 465));
define('PC_SMTP_USER', pc_env('SMTP_USER', ''));
define('PC_SMTP_PASS', pc_env('SMTP_PASS', ''));
define('PC_SMTP_FROM_NAME', pc_env('SMTP_FROM_NAME', 'PowerCabs Website'));
define('PC_MAIL_TO', pc_env('MAIL_TO', ''));
define('PC_GOOGLE_MAPS_API_KEY', pc_env('GOOGLE_MAPS_API_KEY', ''));

// Shared Supabase backend (pricing_config / ride_types / rides) -- same
// project the PowerCabs Dispatcher and passenger app read from. Two
// consumers, two keys: lib/fare_calculator.php resolves the live pricing
// config with the service key (server-side only), and reset-password.php
// redeems password-recovery links with the anon key (exposed in markup).
//
// The URL and the anon key are public by design -- the anon key already
// ships inside the mobile apps and is only useful together with row-level
// security -- so they default to the live project and password recovery
// keeps working without a .env. The service key is a real secret and stays
// empty until .env supplies it; pc_supabase_get() treats an empty service
// key as "Supabase not configured" and falls back, so defaulting the URL
// does not turn any pricing lookup on by itself.
define('PC_SUPABASE_URL', pc_env('SUPABASE_URL', 'https://ijrnahatonxpuzwjtykd.supabase.co'));
define('PC_SUPABASE_SERVICE_KEY', pc_env('SUPABASE_SERVICE_KEY', ''));
define(
    'PC_SUPABASE_ANON_KEY',
    pc_env(
        'SUPABASE_ANON_KEY',
        'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Imlqcm5haGF0b254cHV6d2p0eWtkIiwicm9sZSI6ImFub24iLCJpYXQiOjE3NTU2NzMwMDYsImV4cCI6MjA3MTI0OTAwNn0.cTqgwDjRywsc-Gq8_bolSGT-rzQRr4GONrs6W8VXc8E'
    )
);
