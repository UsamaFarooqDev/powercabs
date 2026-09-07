<?php
/**
 * XML sitemap, generated from the pages that actually exist.
 *
 * Served at /sitemap.xml via an internal rewrite in .htaccess, which is the
 * URL robots.txt points at and the one already registered in Search Console.
 *
 * It replaced a hand-maintained sitemap.xml. The problem with that file was
 * not that it was wrong on the day it was written -- it listed the right 26
 * URLs -- but that nothing connected it to the site. Adding or removing a
 * page left it silently stale, and every <lastmod> was the same hard-coded
 * date, which tells a crawler nothing. Here the URL list and the timestamps
 * are both derived from the filesystem, so neither can drift.
 *
 * WHAT IS DEPRECATELY EXCLUDED, and why it matters: a sitemap is a
 * statement that every URL in it is canonical and indexable. Putting a
 * redirect, a 404, a noindex page or a duplicate in it contradicts the rest
 * of the site's signals, and Search Console reports that back as an error.
 * So the list here is built by exclusion from a single source -- the root
 * *.php files -- rather than by hand:
 *
 *   404.php / 410.php   error documents, never a destination
 *   reset-password.php  noindex (single-use Supabase token target)
 *   router.php          dev-server front controller, not a page
 *   sitemap.php         this file
 *
 * Anything else added to the repository root becomes a page and appears
 * here automatically.
 */

// Same origin as includes/seo.php builds its canonical tags from, so a URL
// here and the canonical on the page it points to can never disagree.
$pcOrigin = 'https://www.powercabs.ie';

/** Root .php files that are not indexable pages. */
$excluded = ['404', '410', 'reset-password', 'router', 'sitemap'];

/* Crawl priority and change frequency. Both are hints Google has said it
   largely ignores, kept only because they cost nothing and other crawlers
   (Bing among them) still read them. The real signal here is <lastmod>.
   Anything not listed falls back to the default below. */
$profiles = [
  '' => ['1.0', 'daily'],
  'book-ride-online' => ['0.9', 'weekly'],
  'ride' => ['0.9', 'weekly'],
  'drive' => ['0.9', 'weekly'],
  'meet-greet' => ['0.9', 'weekly'],
  'business' => ['0.8', 'weekly'],
  'corporate-services' => ['0.8', 'weekly'],
  'business-solutions' => ['0.8', 'weekly'],
  'wheelchair-accessible-taxis' => ['0.8', 'monthly'],
  'city-tours' => ['0.8', 'monthly'],
  'download-our-app' => ['0.8', 'monthly'],
  'contact-us' => ['0.7', 'monthly'],
  'about-us' => ['0.7', 'monthly'],
  'faqs' => ['0.7', 'monthly'],
  'partner-programme' => ['0.6', 'monthly'],
  'ambassador-programme' => ['0.6', 'monthly'],
  'loyalty-program' => ['0.6', 'monthly'],
  'sustainability' => ['0.5', 'yearly'],
  'safety-tips-riders' => ['0.5', 'yearly'],
  'safety-tips-drivers' => ['0.5', 'yearly'],
  'complaint-form' => ['0.4', 'yearly'],
  'positive-feedback-form' => ['0.4', 'yearly'],
  'lost-item-report' => ['0.4', 'yearly'],
  'privacy-policy' => ['0.3', 'yearly'],
  'terms-conditions' => ['0.3', 'yearly'],
  'gdpr' => ['0.3', 'yearly'],
];
$default = ['0.5', 'monthly'];

$entries = [];
foreach (glob(__DIR__ . '/*.php') as $file) {
  $slug = basename($file, '.php');
  if (in_array($slug, $excluded, true)) {
    continue;
  }

  /* A page carrying $pageNoIndex must never appear in the sitemap. Read from
     the source rather than maintained as a second list here, so marking a
     page noindex is enough on its own to drop it -- there is no way to set
     one and forget the other. */
  $source = @file_get_contents($file);
  if ($source !== false && preg_match('/^\s*\$pageNoIndex\s*=\s*true/mi', $source)) {
    continue;
  }

  $path = $slug === 'index' ? '' : $slug;
  [$priority, $changefreq] = $profiles[$path] ?? $default;

  /* lastmod from the page file, but a page is mostly its components, and
     editing components/ride/ride-types.php changes /ride without touching
     ride.php. So take the newest mtime across the page and the components it
     requires, one level deep -- which is how these pages are built.

     includes/ and components/shared/ are deliberately NOT counted, even
     though they do change the rendered page. They are required by all 26
     pages, so a one-line edit to header.php or the footer would stamp every
     single URL with today's date at once. A sitemap where every lastmod
     moves together carries no information -- it is indistinguishable from a
     site that hard-codes the date, which is what this replaced. Counting
     only page-specific files keeps the date meaning "this page's content
     changed". */
  $times = [filemtime($file)];
  if ($source !== false && preg_match_all('/require(?:_once)?\s+__DIR__\s*\.\s*[\'"]([^\'"]+)[\'"]/', $source, $m)) {
    foreach ($m[1] as $rel) {
      if (str_starts_with($rel, '/includes/') || str_starts_with($rel, '/components/shared/')) {
        continue;
      }
      $dep = __DIR__ . $rel;
      if (is_file($dep)) {
        $times[] = filemtime($dep);
      }
    }
  }

  $entries[$path] = [
    'loc' => $pcOrigin . '/' . $path,
    'lastmod' => gmdate('Y-m-d', max($times)),
    'priority' => $priority,
    'changefreq' => $changefreq,
  ];
}

// Highest priority first, then alphabetically -- purely so the file is
// readable when someone opens it.
uasort($entries, static function (array $a, array $b): int {
  return [$b['priority'], $a['loc']] <=> [$a['priority'], $b['loc']];
});

header('Content-Type: application/xml; charset=UTF-8');
header('X-Robots-Tag: noindex');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<?php foreach ($entries as $e): ?>
  <url>
    <loc><?= htmlspecialchars($e['loc'], ENT_XML1) ?></loc>
    <lastmod><?= $e['lastmod'] ?></lastmod>
    <changefreq><?= $e['changefreq'] ?></changefreq>
    <priority><?= $e['priority'] ?></priority>
  </url>
<?php endforeach; ?>
</urlset>
