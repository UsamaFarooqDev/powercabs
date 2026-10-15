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

define('PC_SUPABASE_URL', pc_env('SUPABASE_URL', ''));
define('PC_SUPABASE_SERVICE_KEY', pc_env('SUPABASE_SERVICE_KEY', ''));
define('PC_SUPABASE_ANON_KEY', pc_env('SUPABASE_ANON_KEY', ''));

function pc_env_https_url(string $key): string {
    $value = trim((string) pc_env($key, ''));
    return preg_match('#^https://[^\s"\'<>]+$#i', $value) ? $value : '';
}
define('PC_STRIPE_MEET_GREET_LINK', pc_env_https_url('STRIPE_MEET_GREET_LINK'));
define('PC_STRIPE_LOST_ITEM_LINK', pc_env_https_url('STRIPE_LOST_ITEM_LINK'));
