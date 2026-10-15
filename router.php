<?php
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$serveError = static function (int $status) {
    http_response_code($status);
    require __DIR__ . '/' . $status . '.php';
    return true;
};

if ($uri === '/' || $uri === '') {
    require __DIR__ . '/index.php';
    return true;
}

$queryString = $_SERVER['QUERY_STRING'] ?? '';
$withQuery = static fn(string $path): string => $path . ($queryString !== '' ? '?' . $queryString : '');

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

if (
    preg_match('#^/(includes|lib|bin)(/|$)#i', $uri) ||
    preg_match('#(^|/)\.(?!well-known(/|$))#', $uri) ||
    preg_match('#^/(CLAUDE\.md|tailwind\.config\.js|router\.php)$#i', $uri)
) {
    http_response_code(403);
    header('Content-Type: text/plain; charset=UTF-8');
    echo "403 Forbidden\n";
    return true;
}

if (preg_match('#^/index(\.php)?/?$#i', $uri)) {
    header('Location: ' . $withQuery('/'), true, 301);
    return true;
}

if ($uri === '/sitemap.xml') {
    require __DIR__ . '/sitemap.php';
    return true;
}

if (
    preg_match('#\.php$#i', $uri) &&
    !preg_match('#^/(assets|api)/#i', $uri)
) {
    header('Location: ' . $withQuery(preg_replace('#\.php$#i', '', $uri)), true, 301);
    return true;
}

if (file_exists(__DIR__ . $uri) && !is_dir(__DIR__ . $uri)) {
    return false;
}

$clean = trim($uri, '/');
$phpFile = __DIR__ . '/' . $clean . '.php';

if ($clean !== '' && substr($uri, -1) === '/' && !is_dir(__DIR__ . '/' . $clean)) {
    header('Location: ' . $withQuery('/' . $clean), true, 301);
    return true;
}

if ($clean !== '' && is_file($phpFile)) {
    require $phpFile;
    return true;
}

return $serveError(404);
