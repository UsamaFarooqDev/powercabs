<?php
/**
 * Router for PHP's built-in dev server ONLY -- lets clean, extension-less
 * URLs (e.g. /ride, /about-us) work locally the same way the production
 * .htaccess makes them work on Apache. Not used in production; Apache never
 * looks at this file.
 *
 * Run the site locally with:
 *   php -S localhost:8000 router.php
 *
 * (Not "php -S localhost:8000" alone, and not "php -S localhost:8000
 * index.php" -- either of those makes every non-matching request just
 * re-run index.php, which is why every link was showing the homepage.)
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Homepage.
if ($uri === '/' || $uri === '') {
    require __DIR__ . '/index.php';
    return true;
}

// Every 301 below has to re-attach the original query string by hand:
// Apache adds it to a mod_rewrite redirect for free (any RewriteRule whose
// target carries no "?" of its own), so dropping it here would make a local
// redirect quietly lose data that production keeps -- most visibly
// /reset-password/?token_hash=.. arriving with no token to redeem.
$queryString = $_SERVER['QUERY_STRING'] ?? '';
$withQuery = static fn(string $path): string => $path . ($queryString !== '' ? '?' . $queryString : '');

// airport-transfers.php was renamed to meet-greet.php -- mirrors the
// same 301 in .htaccess so the redirect also works under this local dev
// server, not just on production Apache.
if ($uri === '/airport-transfers' || $uri === '/airport-transfers.php' || $uri === '/airport-transfers/') {
    header('Location: ' . $withQuery('/meet-greet'), true, 301);
    return true;
}

// A real file that exists as requested (css/js/img/.php with its extension
// typed out/etc.) -- let the built-in server handle it normally.
if (file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

// Clean URL -> matching .php file. A trailing slash (e.g. /business/) is
// stripped before the lookup and 301-redirected to the canonical no-slash
// form first -- mirrors the same canonicalization .htaccess does on
// production (rule 3), so a trailing-slash URL behaves the same under this
// local dev server as it does on Apache, instead of always 404ing here
// regardless of what .htaccess says.
$clean = trim($uri, '/');
$phpFile = __DIR__ . '/' . $clean . '.php';

// Trailing slash -> canonical no-slash form, decided before any lookup and
// without caring whether a matching .php exists, exactly like .htaccess
// rule 3: a bad URL is simply canonicalized first and 404s one hop later.
if ($clean !== '' && substr($uri, -1) === '/' && !is_dir(__DIR__ . '/' . $clean)) {
    header('Location: ' . $withQuery('/' . $clean), true, 301);
    return true;
}

if ($clean !== '' && is_file($phpFile)) {
    require $phpFile;
    return true;
}

// Nothing matched.
http_response_code(404);
require __DIR__ . '/404.php';
