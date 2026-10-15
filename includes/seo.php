<?php
$pcOrigin = 'https://www.powercabs.ie';

$siteUrl = $pcOrigin . '/';

$currentPage = $currentPage ?? basename($_SERVER['PHP_SELF']);
$canonicalPath = $canonicalPath ?? ($currentPage === 'index.php' ? '' : preg_replace('/\.php$/', '', $currentPage));
$canonicalUrl = $siteUrl . ltrim($canonicalPath, '/');

$pcOgBase = 'https://images.pexels.com/photos/';
$pcOgCrop = '?auto=compress&cs=tinysrgb&w=1200&h=630&fit=crop';
$pcOgImages = [
  '' => $siteUrl . 'assets/img/welcome-section-bg.webp',
  'ride' => $pcOgBase . '1399282/pexels-photo-1399282.jpeg' . $pcOgCrop,
  'book-ride-online' => $pcOgBase . '6945640/pexels-photo-6945640.jpeg' . $pcOgCrop,

  'meet-greet' => $pcOgBase . '69121/passenger-traffic-airline-aviation-air-transportation-69121.jpeg' . $pcOgCrop,
  'city-tours' => $pcOgBase . '15592112/pexels-photo-15592112.jpeg' . $pcOgCrop,
  'wheelchair-accessible-taxis' => $pcOgBase . '35831412/pexels-photo-35831412.jpeg' . $pcOgCrop,

  'pets-taxi' => $siteUrl . 'assets/img/pets-taxi-og.jpg',
  'drive' => $pcOgBase . '37310371/pexels-photo-37310371.jpeg' . $pcOgCrop,
  'business' => $siteUrl . 'assets/img/services-corporate.jpg',
  'corporate-services' => $pcOgBase . '8425382/pexels-photo-8425382.jpeg' . $pcOgCrop,
  'business-solutions' => $pcOgBase . '7108210/pexels-photo-7108210.jpeg' . $pcOgCrop,
  'partner-programme' => $pcOgBase . '7643784/pexels-photo-7643784.jpeg' . $pcOgCrop,
  'ambassador-programme' => $pcOgBase . '16702626/pexels-photo-16702626.jpeg' . $pcOgCrop,
  'loyalty-program' => $pcOgBase . '35119581/pexels-photo-35119581.jpeg' . $pcOgCrop,
  'download-our-app' => $pcOgBase . '5678243/pexels-photo-5678243.jpeg' . $pcOgCrop,
  'about-us' => $pcOgBase . '36713443/pexels-photo-36713443.jpeg' . $pcOgCrop,
  'contact-us' => $pcOgBase . '8867176/pexels-photo-8867176.jpeg' . $pcOgCrop,
  'faqs' => $pcOgBase . '36507933/pexels-photo-36507933.jpeg' . $pcOgCrop,
  'sustainability' => $pcOgBase . '35736786/pexels-photo-35736786.jpeg' . $pcOgCrop,
  'safety-tips-riders' => $pcOgBase . '13343433/pexels-photo-13343433.jpeg' . $pcOgCrop,
  'safety-tips-drivers' => $pcOgBase . '5834950/pexels-photo-5834950.jpeg' . $pcOgCrop,
  'complaint-form' => $pcOgBase . '6830863/pexels-photo-6830863.jpeg' . $pcOgCrop,
  'positive-feedback-form' => $pcOgBase . '5955023/pexels-photo-5955023.jpeg' . $pcOgCrop,
  'lost-item-report' => $pcOgBase . '12092769/pexels-photo-12092769.jpeg' . $pcOgCrop,
];
$ogImage = $ogImage ?? ($pcOgImages[$canonicalPath] ?? $siteUrl . 'assets/img/meet-and-greet.webp');

$pageRobots = $pageRobots ?? (!empty($pageNoIndex) ? 'noindex, nofollow' : 'index, follow, max-image-preview:large, max-snippet:-1');

$pcLogo = [
  '@type' => 'ImageObject',
  '@id' => $pcOrigin . '/#logo',
  'url' => $siteUrl . 'assets/img/powercabs-logo-dark.svg',
  'contentUrl' => $siteUrl . 'assets/img/powercabs-logo-dark.svg',
];

$pcOrganization = [
  '@type' => 'Organization',
  '@id' => $pcOrigin . '/#organization',
  'name' => 'PowerCabs',
  'legalName' => 'Powercabs Ireland Limited',
  'url' => $siteUrl,
  'logo' => ['@id' => $pcOrigin . '/#logo'],
  'image' => ['@id' => $pcOrigin . '/#logo'],
  'email' => 'info@powercabs.ie',
  'telephone' => '+353 1 203 0727',
  'address' => [
    '@type' => 'PostalAddress',
    'streetAddress' => 'Kylmore Road, Inchicore',
    'addressLocality' => 'Dublin',
    'postalCode' => 'D10 K729',
    'addressCountry' => 'IE',
  ],
  'sameAs' => [
    'https://www.facebook.com/powercabs.ie/',
    'https://www.instagram.com/powercabs.ie/',
    'https://x.com/powercabsie',
    'https://youtube.com/@powercabs',
    'https://vm.tiktok.com/ZSYUyT1fd/',
  ],
];

$pcWebSite = [
  '@type' => 'WebSite',
  '@id' => $pcOrigin . '/#website',
  'url' => $siteUrl,
  'name' => 'PowerCabs',
  'publisher' => ['@id' => $pcOrigin . '/#organization'],
  'inLanguage' => 'en-IE',
];

$pcLocalBusiness = [
  '@type' => ['LocalBusiness', 'TaxiService'],
  '@id' => $pcOrigin . '/#localbusiness',
  'name' => 'PowerCabs',
  'parentOrganization' => ['@id' => $pcOrigin . '/#organization'],
  'url' => $siteUrl,
  'image' => $ogImage,
  'logo' => ['@id' => $pcOrigin . '/#logo'],
  'telephone' => '+353 1 203 0727',
  'email' => 'info@powercabs.ie',
  'priceRange' => '€€',
  'currenciesAccepted' => 'EUR',
  'address' => [
    '@type' => 'PostalAddress',
    'streetAddress' => 'Kylmore Road, Inchicore',
    'addressLocality' => 'Dublin',
    'postalCode' => 'D10 K729',
    'addressCountry' => 'IE',
  ],
  'areaServed' => [
    ['@type' => 'City', 'name' => 'Dublin'],
    ['@type' => 'Country', 'name' => 'Ireland'],
  ],
  'openingHoursSpecification' => [
    [
      '@type' => 'OpeningHoursSpecification',
      'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
      'opens' => '00:00',
      'closes' => '23:59',
    ],
  ],
  'sameAs' => $pcOrganization['sameAs'],
];

$pcGraph = [$pcLogo, $pcOrganization, $pcWebSite, $pcLocalBusiness];

if (!empty($pageService) && is_array($pageService)) {
  $svc = [
    '@type' => 'Service',
    '@id' => $canonicalUrl . '#service',
    'name' => $pageService['name'],
    'description' => $pageService['description'],
    'provider' => ['@id' => $pcOrigin . '/#organization'],
    'areaServed' => $pageService['areaServed'] ?? [
      ['@type' => 'City', 'name' => 'Dublin'],
      ['@type' => 'Country', 'name' => 'Ireland'],
    ],
    'url' => $canonicalUrl,
  ];
  if (!empty($pageService['serviceType'])) {
    $svc['serviceType'] = $pageService['serviceType'];
  }
  $pcGraph[] = $svc;
}

if (!empty($pageFaq) && is_array($pageFaq)) {
  $questions = [];
  foreach ($pageFaq as $item) {
    if (empty($item['q']) || empty($item['a'])) {
      continue;
    }
    $questions[] = [
      '@type' => 'Question',
      'name' => html_entity_decode(strip_tags($item['q']), ENT_QUOTES, 'UTF-8'),
      'acceptedAnswer' => [
        '@type' => 'Answer',
        'text' => html_entity_decode(strip_tags($item['a']), ENT_QUOTES, 'UTF-8'),
      ],
    ];
  }
  if ($questions) {
    $pcGraph[] = [
      '@type' => 'FAQPage',
      '@id' => $canonicalUrl . '#faq',
      'mainEntity' => $questions,
    ];
  }
}

if (!empty($pageBreadcrumb) && is_array($pageBreadcrumb)) {
  $items = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $siteUrl]];
  $position = 1;
  foreach ($pageBreadcrumb as $label => $path) {
    $items[] = [
      '@type' => 'ListItem',
      'position' => ++$position,
      'name' => $label,
      'item' => $siteUrl . ltrim($path, '/'),
    ];
  }
  $pcGraph[] = [
    '@type' => 'BreadcrumbList',
    '@id' => $canonicalUrl . '#breadcrumb',
    'itemListElement' => $items,
  ];
}

if (!empty($pageSchema) && is_array($pageSchema)) {
  foreach ($pageSchema as $node) {
    if (is_array($node)) {
      $pcGraph[] = $node;
    }
  }
}

function pc_jsonld(array $data): string
{
  return json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP);
}
?>
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta name="robots" content="<?= htmlspecialchars($pageRobots) ?>">
<?php if (!empty($pageNoIndex)): ?>
  <meta name="referrer" content="strict-origin">
<?php endif; ?>

  <meta property="og:type" content="website">
  <meta property="og:site_name" content="PowerCabs">
  <meta property="og:locale" content="en_IE">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta property="og:image" content="<?= htmlspecialchars($ogImage) ?>">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@powercabsie">
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">

  <script type="application/ld+json"><?= pc_jsonld([
    '@context' => 'https://schema.org',
    '@graph' => $pcGraph,
  ]) ?></script>
