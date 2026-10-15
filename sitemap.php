<?php
$pcOrigin = 'https://www.powercabs.ie';

// POST-only JSON endpoints belong here: a sitemap entry that 404s or 405s is a crawl error.
$excluded = [
  '404', '410', 'reset-password', 'router', 'sitemap',
  
  'driver-apply', 'driver-auth', 'driver-training-api', 'driver-certificate',
];

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
  'pets-taxi' => ['0.8', 'monthly'],
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

  $source = @file_get_contents($file);
  if ($source !== false && preg_match('/^\s*\$pageNoIndex\s*=\s*true/mi', $source)) {
    continue;
  }

  $path = $slug === 'index' ? '' : $slug;
  [$priority, $changefreq] = $profiles[$path] ?? $default;

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
