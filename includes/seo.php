<?php
/**
 * The site's SEO head: canonical, robots, Open Graph, Twitter, and the
 * organisation-level JSON-LD graph. Required from inside <head> in
 * header.php, once per page.
 *
 * This was inline in header.php. It is its own file now because it grew a
 * schema graph and a robots policy, and because pages need to influence it
 * without editing the header. Everything is driven by plain variables the
 * page sets BEFORE requiring header.php -- the same convention the rest of
 * the site uses for components:
 *
 *   $pageTitle        <title>, og:title, twitter:title      (required)
 *   $pageDescription  meta description + og/twitter         (required)
 *   $ogImage          absolute URL; defaults below
 *   $pageNoIndex      true -> noindex,nofollow + strict referrer
 *   $pageRobots       full override of the robots directive
 *   $pageSchema       array of extra JSON-LD nodes (FAQPage, Service, ...)
 *   $canonicalPath    override the derived path, WITHOUT a leading slash
 *
 * It also defines $siteUrl and $canonicalUrl for later includes --
 * components/shared/inner-hero.php reads both to build its BreadcrumbList.
 */

// One preferred origin for the whole site: https, www, no trailing slash.
// Every absolute URL the site emits is built from this, so the canonical
// tag, og:url, the sitemap and the schema graph can never disagree about
// scheme or host. .htaccess redirects the other three host/scheme
// combinations here, so this is also the URL that actually answers 200.
$pcOrigin = 'https://www.powercabs.ie';

// Kept with a trailing slash: inner-hero.php and the old inline markup both
// expect that shape.
$siteUrl = $pcOrigin . '/';

/* The canonical path. Derived from the running script, so it cannot drift
   from the URL that served the request, and deliberately NOT from
   REQUEST_URI -- that carries query strings and would let ?utm_source=...
   canonicalise to itself, which is the parameter-duplication problem this
   is meant to prevent. A page can still override it. */
$currentPage = $currentPage ?? basename($_SERVER['PHP_SELF']);
$canonicalPath = $canonicalPath ?? ($currentPage === 'index.php' ? '' : preg_replace('/\.php$/', '', $currentPage));
$canonicalUrl = $siteUrl . ltrim($canonicalPath, '/');

/* ── Open Graph image, per page ──────────────────────────────────────────
   Every one of the 26 pages was sharing a single image -- meet-and-greet.png
   -- so a link to /drive, /city-tours or /business shared on WhatsApp,
   Facebook or LinkedIn showed an airport arrivals photo. It was also
   1234x1024, a 1.21:1 ratio against Open Graph's 1.91:1, so the little of it
   that survived was centre-cropped top and bottom.

   Each entry below is the page's OWN hero photograph, re-parameterised to
   exactly 1200x630 -- Pexels honours w/h/fit=crop and returns those exact
   pixels, verified rather than assumed. The homepage uses the local
   welcome-section-bg.png instead: it is 1536x825 (1.862:1, within 3% of the
   target) and it is the one image on the site with the PowerCabs roof sign
   clearly in frame, which is what a share of the bare domain should show.

   NOTE ON COUPLING: these repeat each page's $heroBgImage. They cannot be
   read from it -- $heroBgImage is assigned AFTER header.php has already
   emitted <head>, so it does not exist yet at this point. If you change a
   page's hero photograph, change its line here too. The default below is a
   safe fallback for anything not listed. */
$pcOgBase = 'https://images.pexels.com/photos/';
$pcOgCrop = '?auto=compress&cs=tinysrgb&w=1200&h=630&fit=crop';
$pcOgImages = [
  '' => $siteUrl . 'assets/img/welcome-section-bg.png',
  'ride' => $pcOgBase . '1399282/pexels-photo-1399282.jpeg' . $pcOgCrop,
  'book-ride-online' => $pcOgBase . '6945640/pexels-photo-6945640.jpeg' . $pcOgCrop,
  // Not "pexels-photo-69121.jpeg": this one predates that naming and keeps
  // its original slug. Assuming the usual pattern here returned a 404.
  'meet-greet' => $pcOgBase . '69121/passenger-traffic-airline-aviation-air-transportation-69121.jpeg' . $pcOgCrop,
  'city-tours' => $pcOgBase . '15592112/pexels-photo-15592112.jpeg' . $pcOgCrop,
  'wheelchair-accessible-taxis' => $pcOgBase . '35831412/pexels-photo-35831412.jpeg' . $pcOgCrop,
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
$ogImage = $ogImage ?? ($pcOgImages[$canonicalPath] ?? $siteUrl . 'assets/img/meet-and-greet.png');

/* Robots. Google treats a missing robots meta as "index, follow", so the
   value here is not about switching indexing on -- it is about
   max-image-preview:large, which is what lets a result show a full-width
   image rather than a thumbnail, and max-snippet:-1, which lifts the
   snippet length cap. Both are opt-in and neither can be expressed any
   other way. */
$pageRobots = $pageRobots ?? (!empty($pageNoIndex) ? 'noindex, nofollow' : 'index, follow, max-image-preview:large, max-snippet:-1');

/* ── Organisation-level JSON-LD ──────────────────────────────────────────
   One @graph rather than three loose blocks, with @id references between
   the nodes, so Google reads this as ONE business described from three
   angles instead of three unrelated entities repeated on 26 pages.

   Everything below is taken from what the site already publishes -- the
   footer's registered address, licence and tax numbers, the phone and email
   in the contact column, and the social profiles it links to. Nothing is
   invented: no ratings, no review counts, no founding date, no employee
   numbers, no price claims beyond the existing €€ band.

   telephone is the switchboard, +353 1 203 0727, NOT the WhatsApp number.
   The previous inline schema published +353 89 972 8089 -- the WhatsApp
   line -- as the business phone, which disagreed with every tel: link on
   the site and with the number in the footer. For a local business that
   mismatch is exactly the kind of NAP inconsistency that weakens the link
   between the site and its Google Business Profile. WhatsApp is a contact
   channel below, not the main line. */
/* The logo is its own top-level node rather than an ImageObject nested
   inside Organization.logo. Both are legal JSON-LD -- a nested node with an
   @id is still resolvable -- but three places reference #logo, and a flat
   graph means every consumer resolves it identically without having to walk
   into another node to find the definition. It is also what Google's own
   examples do. */
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

/* LocalBusiness carries the things that belong to the physical operation --
   the address it trades from, the hours it answers, the areas it covers --
   and points back at the Organization node rather than repeating it.

   areaServed is Dublin AND Ireland because the site genuinely sells both:
   the taxi service is Dublin-centred, while City Tours, Courier/Parcel and
   the business accounts are described as covering Ireland. Neither is a
   claim being introduced here.

   The NTA licence number is published in the footer, so it is safe to state
   as the operating licence. */
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

/* ── Page-specific nodes ─────────────────────────────────────────────────
   Pages declare these as plain arrays before requiring header.php, the same
   way they already declare $heroTitle and friends. The schema itself is
   assembled here so no page has to hand-write JSON-LD, and so the @id
   wiring back to the Organization node cannot be forgotten.

   $pageService   one Service node for a service page
   $pageFaq       [['q'=>..,'a'=>..], ...] -> FAQPage
   $pageBreadcrumb ['Label' => '/path', ...] -> BreadcrumbList, for pages
                  that do not use components/shared/inner-hero.php (which
                  emits its own)
   $pageSchema    escape hatch: raw nodes, appended as-is */

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

/* FAQPage is the one schema type here that Google will refuse -- or worse,
   penalise -- if it does not match what the visitor sees. So it is built
   from the SAME array the page renders its accordion from, never from a
   second copy written for the crawler. If a question is removed from the
   page it disappears from the schema in the same edit. */
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

// Appended rather than replacing, so a page can add without losing the
// organisation graph.
if (!empty($pageSchema) && is_array($pageSchema)) {
  foreach ($pageSchema as $node) {
    if (is_array($node)) {
      $pcGraph[] = $node;
    }
  }
}

/** JSON-LD encoding: escape the characters that could break out of the
 *  <script> element, and leave slashes and unicode readable. */
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
  <!-- Private, single-use pages (the Supabase password-recovery link target)
       must never be indexed, and their token must never leak in a Referer. -->
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
