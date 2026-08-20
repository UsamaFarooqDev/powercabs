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

// airport-transfers.php was renamed to meet-greet.php -- mirrors the
// same 301 in .htaccess so the redirect also works under this local dev
// server, not just on production Apache.
if ($uri === '/airport-transfers' || $uri === '/airport-transfers.php' || $uri === '/airport-transfers/') {
    header('Location: /meet-greet', true, 301);
    return true;
}

// A real file that exists as requested (css/js/img/.php with its extension
// typed out/etc.) -- let the built-in server handle it normally.
if (file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

// Clean URL -> matching .php file.
$clean = ltrim($uri, '/');
$phpFile = __DIR__ . '/' . $clean . '.php';
if (is_file($phpFile)) {
    require $phpFile;
    return true;
}

// Nothing matched.
http_response_code(404);
require __DIR__ . '/404.php';
