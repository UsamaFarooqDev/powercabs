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
 *
 * The sections below mirror .htaccess section for section, in the same
 * order. That order is load-bearing in both files: the WordPress rules have
 * to answer before the trailing-slash canonicalisation, or /wp-admin/
 * becomes a 301 to a 410 instead of a 410.
 *
 * Keeping the two in step is the point. Before, this file had neither the
 * .php-to-clean redirect nor the /index.php normalisation that .htaccess
 * has always had, so /business.php and /index.php answered 200 locally and
 * 301 in production -- which meant redirect behaviour could not be tested
 * anywhere except live. Host and scheme canonicalisation is deliberately
 * NOT mirrored: there is no https on the dev server and forcing the
 * production host would send local testing to the live site.
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

/** Serve an error document with the right status, the way ErrorDocument does. */
$serveError = static function (int $status) {
    http_response_code($status);
    require __DIR__ . '/' . $status . '.php';
    return true;
};

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

// ---------------------------------------------------------------------------
// 1) Old WordPress URLs -- mirrors .htaccess section 1.
// ---------------------------------------------------------------------------
// 1a/1b) Permanently gone. 410, not 404, so Google retires them quickly
//        instead of re-crawling them for months.
$wpGone = [
    '#^/(wp-admin|wp-includes|wp-content|wp-json|wp-content-uploads)(/|$)#i',
    '#^/(wp-login|wp-cron|wp-signup|wp-trackback|wp-links-opml|wp-mail|wp-comments-post|wp-activate|wp-config|xmlrpc)\.php$#i',
    '#^/(feed|rss|rss2|atom)/?$#i',
    '#^/comments/feed/?$#i',
    '#^/(category|tag|author)(/|$)#i',
    '#^/page/[0-9]+/?$#i',
    '#^/[0-9]{4}/[0-9]{2}/#',
];
foreach ($wpGone as $pattern) {
    if (preg_match($pattern, $uri)) {
        return $serveError(410);
    }
}

// 1c) Old slug -> new page. Both evidenced by this repository's git history:
//     airport-transfers.php was deleted, download-app.php was renamed.
$oldSlugs = [
    '#^/airport-transfers(\.php)?/?$#i' => '/meet-greet',
    '#^/download-app(\.php)?/?$#i' => '/download-our-app',
];
foreach ($oldSlugs as $pattern => $target) {
    if (preg_match($pattern, $uri)) {
        header('Location: ' . $withQuery($target), true, 301);
        return true;
    }
}

// ---------------------------------------------------------------------------
// 2) Code paths are not web pages -- mirrors .htaccess section 2.
// ---------------------------------------------------------------------------
// These are require'd server-side and were answering 200 with an empty body,
// which reads as a soft 404 to a crawler. /api/ is excluded: the booking
// form fetches /api/estimate_fare for live quotes.
// A bare 403 with no styled body, deliberately: .htaccess configures an
// ErrorDocument for 404 and 410 but not for 403, so this is exactly what
// production returns. Borrowing 404.php here would have made local testing
// look friendlier than the real thing.
if (preg_match('#^/(includes|lib|bin)(/|$)#i', $uri)) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "403 Forbidden\n";
    return true;
}

// ---------------------------------------------------------------------------
// 3) URL shape -- mirrors .htaccess section 3.
// ---------------------------------------------------------------------------
// 3a) /index or /index.php -> /
if (preg_match('#^/index(\.php)?/?$#i', $uri)) {
    header('Location: ' . $withQuery('/'), true, 301);
    return true;
}

// 3b) The sitemap is generated, not stored. Same internal rewrite Apache does.
if ($uri === '/sitemap.xml') {
    require __DIR__ . '/sitemap.php';
    return true;
}

// 3c) Any ".php" URL -> its clean form. Assets and the fare endpoint keep
//     their extension: /api/estimate_fare.php is fetched by name from JS, and
//     rewriting anything under /assets/ would break stylesheets and scripts.
if (
    preg_match('#\.php$#i', $uri) &&
    !preg_match('#^/(assets|api)/#i', $uri)
) {
    header('Location: ' . $withQuery(preg_replace('#\.php$#i', '', $uri)), true, 301);
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
// production (rule 3d), so a trailing-slash URL behaves the same under this
// local dev server as it does on Apache, instead of always 404ing here
// regardless of what .htaccess says.
$clean = trim($uri, '/');
$phpFile = __DIR__ . '/' . $clean . '.php';

// 3d) Trailing slash -> canonical no-slash form, decided before any lookup
//     and without caring whether a matching .php exists, exactly like
//     .htaccess: a bad URL is simply canonicalized first and 404s one hop
//     later.
if ($clean !== '' && substr($uri, -1) === '/' && !is_dir(__DIR__ . '/' . $clean)) {
    header('Location: ' . $withQuery('/' . $clean), true, 301);
    return true;
}

// 3e) Clean URL -> matching .php file, served in place.
if ($clean !== '' && is_file($phpFile)) {
    require $phpFile;
    return true;
}

// Nothing matched.
return $serveError(404);
