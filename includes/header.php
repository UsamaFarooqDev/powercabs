<?php
$pageTitle = $pageTitle ?? 'PowerCabs | Reliable Cab Booking Service in Ireland';
$pageDescription =
  $pageDescription ??
  'Book a reliable, affordable cab in Ireland with PowerCabs. Airport transfers, city rides, business travel and driver opportunities, available 24/7.';
$assetPath = $assetPath ?? '';
$currentPage = basename($_SERVER['PHP_SELF']);

$siteUrl = 'https://www.powercabs.ie/';
$canonicalUrl = $siteUrl . ($currentPage === 'index.php' ? '' : preg_replace('/\.php$/', '', $currentPage));
$ogImage = $ogImage ?? $siteUrl . 'assets/img/meet-and-greet.png';

$navActive = static fn(string $page): string => $currentPage === $page ? 'active' : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
<?php if (!empty($pageNoIndex)): ?>
  <!-- Private, single-use pages (the Supabase password-recovery link target)
       must never be indexed, and their token must never leak in a Referer. -->
  <meta name="robots" content="noindex, nofollow">
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
  <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($ogImage) ?>">

  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "additionalType": "https://schema.org/TaxiService",
    "name": "PowerCabs",
    "image": "<?= $ogImage ?>",
    "url": "<?= $siteUrl ?>",
    "telephone": "+353899728089",
    "priceRange": "€€",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "Kylmore Road, Inchicore",
      "addressLocality": "Dublin",
      "postalCode": "D10 K729",
      "addressCountry": "IE"
    },
    "areaServed": {
      "@type": "City",
      "name": "Dublin"
    },
    "sameAs": [
      "https://www.facebook.com/powercabs.ie/",
      "https://www.instagram.com/powercabs.ie/",
      "https://x.com/powercabsie",
      "https://youtube.com/@powercabs",
      "https://vm.tiktok.com/ZSYUyT1fd/"
    ],
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
      "opens": "00:00",
      "closes": "23:59"
    }
  }
  </script>

  <!-- Bootstrap 5 (CDN for now; swap to self-hosted /vendor build before production) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet"
    href="<?= $assetPath ?>assets/css/variables.css?v=<?= @filemtime(__DIR__ . '/../assets/css/variables.css') ?>">
  <link rel="stylesheet"
    href="<?= $assetPath ?>assets/css/base.css?v=<?= @filemtime(__DIR__ . '/../assets/css/base.css') ?>">
  <link rel="stylesheet"
    href="<?= $assetPath ?>assets/css/components.css?v=<?= @filemtime(__DIR__ . '/../assets/css/components.css') ?>">

  <!--
    Tailwind (Play CDN), loaded site-wide alongside Bootstrap during the
    incremental migration -- see CLAUDE.md. Every page keeps rendering with
    Bootstrap exactly as before except in sections deliberately migrated:
      - `prefix: 'tw-'` keeps every Tailwind utility namespaced (tw-flex,
        tw-bg-ink, ...) so it can never collide with a same-named Bootstrap
        class (.container, .rounded, .text-white, etc. exist in both
        frameworks with different rules).
      - `preflight: false` disables Tailwind's base-style reset, since
        Bootstrap + base.css/variables.css already own global element styles
        (body, headings, links) -- Preflight would otherwise fight them.
    Colors below are the same hex values as the --pc-* tokens in
    variables.css, so a migrated section stays visually identical to an
    unmigrated one -- one brand, two utility systems.
    This is the official Tailwind Play CDN, meant for exactly this kind of
    build-step-free setup (Bootstrap itself is also loaded via a bare CDN
    link here, no npm/webpack pipeline) -- Tailwind's own docs flag the Play
    CDN as not ideal for production (larger runtime cost than a compiled
    stylesheet, one console warning), the one honest tradeoff of adding
    Tailwind without introducing a whole new build toolchain. Drop the
    `tw-` prefix in one pass once Bootstrap is fully retired.
  -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      prefix: 'tw-',
      corePlugins: { preflight: false },
      theme: {
        extend: {
          fontFamily: {
            sans: ['Plus Jakarta Sans', 'Segoe UI', 'system-ui', '-apple-system', 'sans-serif'],
          },
          colors: {
            ink: '#1c1410',          // --pc-dark
            'ink-soft': '#160f0a',   // --pc-dark-soft
            paper: '#f4efe8',        // --pc-cream
            'paper-soft': '#f9f4ed', // --pc-cream-soft
            power: '#e8590c',        // --pc-orange
            powerlight: '#ff7a00',   // --pc-orange-light
            powerdark: '#a34406',    // --pc-orange-dark
          },
        },
      },
    };
  </script>

  <!--
    Navbar bar styling (the fixed glass pill, its links, active-dot,
    CTA button, mobile toggle and mobile panel) has been migrated to
    Tailwind utility classes directly on the markup below -- see the
    <header> block. The old .pc-navbar/.pc-navbar-links-pill/.pc-nav-cta/
    .pc-nav-scrim rules that used to live in a <style> block here are gone.

    Not yet migrated (deliberately, as its own follow-up step): the "About"
    and "Contact" mega-menu DROPDOWN PANELS -- .pc-mega-menu and friends in
    components.css. That positioning (fixed, centered, width: min(940px, ...),
    plus the CSS Grid open/close animation for the nested Training/Safety
    flyouts) is intricate and still Bootstrap-Dropdown-driven; migrating it
    got scoped out of this pass rather than risk it site-wide alongside the
    rest of the navbar. The two toggle links ("About ▾" / "Contact ▾")
    themselves are Tailwind now -- only the panels they open are still on
    the old styling.
  -->
</head>

<body data-page="<?= htmlspecialchars($currentPage) ?>">

  <?php require __DIR__ . '/../components/shared/page-loader.php'; ?>

  <header class="tw-fixed tw-top-0 tw-inset-x-0 tw-w-full" style="z-index: 1030;">
    <div class="tw-w-full tw-max-w-[1320px] tw-mx-auto tw-px-3 sm:tw-px-5 lg:tw-px-8 tw-pt-2 lg:tw-pt-3">
      <!-- navbar-expand-lg carries no visual weight of its own now (the bar
           itself is fully Tailwind below) but its presence as an ANCESTOR is
           still load-bearing: the still-deferred mega-menu panel CSS in
           components.css is scoped as `.navbar-expand-lg .navbar-nav
           .pc-mega-menu {...}` -- drop this class and that whole descendant
           selector stops matching, silently falling back to a plain white
           Bootstrap dropdown box. Remove it only once the mega-menu panels
           get their own Tailwind pass. -->
      <!-- tw-border-solid is not decorative -- Preflight is disabled
           site-wide (see the Tailwind config comment above), and Preflight
           is what normally resets every element's border-style to solid so
           a plain border-width/border-color utility is enough on its own.
           Without it the browser default border-style (none) wins and the
           border never renders no matter what width/color is set -- this
           bit us on exactly that up above. Same note applies to #mainNav
           below. -->
      <nav class="navbar-expand-lg tw-relative tw-flex tw-flex-wrap tw-items-center tw-justify-between tw-gap-3 tw-rounded-2xl tw-border-solid tw-border-2 tw-border-black/[0.06] lg:tw-border-white tw-bg-white/90 tw-backdrop-blur-[100px] tw-shadow-[0_8px_30px_rgba(28,20,16,0.10)] tw-px-4 lg:tw-px-6 tw-py-2.5">
        <a class="tw-flex tw-items-center tw-shrink-0" href="<?= $assetPath ?>/">
          <img src="<?= $assetPath ?>assets/img/powercabs-logo-dark.svg" alt="PowerCabs" height="47" class="tw-block tw-h-9 lg:tw-h-11 tw-w-auto">
        </a>

        <button type="button" id="pcNavToggle" class="tw-group tw-relative tw-flex tw-h-8 tw-w-8 tw-shrink-0 tw-flex-col tw-items-center tw-justify-center tw-gap-[5px] tw-bg-transparent tw-border-0 tw-shadow-none tw-outline-none lg:tw-hidden"
          data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="tw-h-[2px] tw-w-6 tw-rounded-full tw-bg-ink tw-transition-transform tw-duration-300 group-aria-expanded:tw-translate-y-[7px] group-aria-expanded:tw-rotate-45"></span>
          <span class="tw-h-[2px] tw-w-6 tw-rounded-full tw-bg-ink tw-transition-opacity tw-duration-200 group-aria-expanded:tw-opacity-0"></span>
          <span class="tw-h-[2px] tw-w-6 tw-rounded-full tw-bg-ink tw-transition-transform tw-duration-300 group-aria-expanded:-tw-translate-y-[7px] group-aria-expanded:-tw-rotate-45"></span>
        </button>

        <!-- flex-grow story, in two parts:
             - Mobile: tw-grow-0, irrelevant anyway since the panel is
               tw-absolute (out of flow) below 992px.
             - Desktop: lg:tw-grow re-enables filling the remaining width
               between the logo and the nav's right edge -- deliberately,
               this time, so the <ul> below has room to center itself via
               margin-inline:auto with the CTA sitting flush at the end.
               (Bootstrap's OWN base .navbar-collapse rule already sets
               flex-grow:1 unconditionally; .navbar-expand-lg only resets
               flex-basis back to auto at desktop and never flex-grow. The
               grow behavior was fighting us before because nothing inside
               this div was set up to make use of the extra space -- now
               tw-mx-auto on the <ul> does.) -->
        <!-- tw-max-h-[...]/tw-overflow-y-auto (mobile only) restore scrolling
             for a tall expanded panel -- e.g. tapping "About" inlines the
             whole mega-menu content beneath the links, which alone can
             exceed the viewport on a short phone. Without this the panel
             just clips silently at the bottom with no way to reach the rest.
             Keyed off --pc-navbar-h, the same live-measured custom property
             main.js already keeps in sync (syncNavbarHeightVar()), so this
             tracks the bar's real height instead of a guessed constant. -->
        <div class="collapse navbar-collapse tw-grow-0 lg:tw-grow tw-w-full lg:tw-w-auto tw-absolute lg:tw-static tw-inset-x-1 tw-top-[calc(100%+0.3rem)] lg:tw-top-auto tw-max-h-[calc(100vh-var(--pc-navbar-h,76px)-2rem)] tw-overflow-y-auto lg:tw-max-h-none lg:tw-overflow-visible tw-flex-col lg:tw-flex-row tw-items-stretch lg:tw-items-center tw-gap-3 lg:tw-gap-6 tw-rounded-3xl lg:tw-rounded-none tw-border-solid tw-border-2 lg:tw-border-0 tw-border-white tw-bg-white/[0.96] lg:tw-bg-transparent tw-backdrop-blur-[100px] lg:tw-backdrop-blur-none tw-p-4 lg:tw-p-0 tw-shadow-xl lg:tw-shadow-none" id="mainNav">
          <ul class="navbar-nav tw-flex tw-flex-col lg:tw-flex-row lg:tw-items-center tw-gap-1 lg:tw-gap-6 tw-list-none tw-m-0 tw-p-0 lg:tw-mx-auto">
              <li>
                <a class="nav-link tw-block tw-rounded-full tw-px-4 tw-py-2 tw-text-[.92rem] tw-text-ink/65 hover:tw-text-ink [&.active]:tw-text-ink tw-transition-colors tw-no-underline tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-ink/20 <?= $navActive(
                  'index.php',
                ) ?>" data-page="index.php"
                  href="<?= $assetPath ?>/">Home</a>
              </li>

              <!-- ============ About: hover mega menu ============ -->
              <li class="dropdown pc-mega-parent">
                <a class="tw-group nav-link dropdown-toggle tw-flex tw-items-center tw-gap-1 tw-rounded-full tw-px-4 tw-py-2 tw-text-[.92rem] tw-text-ink/65 hover:tw-text-ink tw-transition-colors tw-no-underline tw-outline-none tw-shadow-none focus:tw-shadow-none" href="#"
                  id="aboutMegaToggle" role="button" data-bs-toggle="dropdown" data-bs-display="static"
                  data-bs-auto-close="outside" aria-expanded="false">
                  About
                  <svg class="tw-w-3 tw-h-3 tw-transition-transform tw-duration-200 group-aria-expanded:tw-rotate-180" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                    <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </a>

                <div class="dropdown-menu pc-mega-menu p-0 border-0 shadow-lg" aria-labelledby="aboutMegaToggle">
                  <div class="pc-mega-inner">
                    <div class="row g-4">

                      <!-- Col 1: Get Started -->
                      <div class="col-12 col-sm-6 col-lg-3 pc-mega-col">
                        <p class="pc-mega-col-title text-uppercase">Get Started</p>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/book-ride-online">
                          <span class="pc-mega-item-title d-block">Book Ride Online</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Instant online cab booking</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/download-our-app">
                          <span class="pc-mega-item-title d-block">Download App</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Get the PowerCabs app</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/about-us">
                          <span class="pc-mega-item-title d-block">About Us</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Our story and mission</span>
                        </a>
                      </div>

                      <!-- Col 2: Business -->
                      <div class="col-12 col-sm-6 col-lg-3 pc-mega-col">
                        <p class="pc-mega-col-title text-uppercase">Business</p>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/corporate-services">
                          <span class="pc-mega-item-title d-block">Corporate Services</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Business travel accounts Ireland</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/business-solutions">
                          <span class="pc-mega-item-title d-block">PowerCabs Business Solutions</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Card terminals and payments</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/wheelchair-accessible-taxis">
                          <span class="pc-mega-item-title d-block">Wheelchair Accessible Taxis</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Inclusive rides for everyone</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/meet-greet">
                          <span class="pc-mega-item-title d-block">Meet &amp; Greet</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Airport pickups, done right</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/city-tours">
                          <span class="pc-mega-item-title d-block">City Tours</span>
                          <span class="pc-mega-item-desc d-block fw-normal">See Ireland with a local driver</span>
                        </a>
                      </div>

                      <!-- Col 3: Drivers -->
                      <div class="col-12 col-sm-6 col-lg-3 pc-mega-col">
                        <p class="pc-mega-col-title text-uppercase">Drivers</p>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/ambassador-programme">
                          <span class="pc-mega-item-title d-block">Ambassador Programme</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Exclusive perks for drivers</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/partner-programme">
                          <span class="pc-mega-item-title d-block">Partner Programme</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Earn as a partner</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/loyalty-program">
                          <span class="pc-mega-item-title d-block">Loyalty Program</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Earn rewards every trip</span>
                        </a>

                        <div class="pc-mega-nested">
                          <button type="button" class="pc-mega-item pc-mega-item-parent d-block w-100 border-0 text-start text-decoration-none">
                            <span class="pc-mega-item-title d-flex align-items-center justify-content-between">
                              Training
                              <i class="bi bi-chevron-right pc-mega-chevron"></i>
                            </span>
                            <span class="pc-mega-item-desc d-block fw-normal">Licensing and onboarding resources</span>
                          </button>
                          <div class="pc-mega-submenu d-grid">
                            <a class="pc-mega-subitem d-block text-decoration-none" href="<?= $assetPath ?>/">Driver Training</a>
                            <a class="pc-mega-subitem d-block text-decoration-none" href="<?= $assetPath ?>/">SPSV Manual</a>
                          </div>
                        </div>
                      </div>

                      <!-- Col 4: Policies & Safety -->
                      <div class="col-12 col-sm-6 col-lg-3 pc-mega-col">
                        <p class="pc-mega-col-title text-uppercase">Policies &amp; Safety</p>

                        <div class="pc-mega-nested">
                          <button type="button" class="pc-mega-item pc-mega-item-parent d-block w-100 border-0 text-start text-decoration-none">
                            <span class="pc-mega-item-title d-flex align-items-center justify-content-between">
                              Safety
                              <i class="bi bi-chevron-right pc-mega-chevron"></i>
                            </span>
                            <span class="pc-mega-item-desc d-block fw-normal">Tips for staying safe</span>
                          </button>
                          <div class="pc-mega-submenu d-grid">
                            <a class="pc-mega-subitem d-block text-decoration-none" href="<?= $assetPath ?>/safety-tips-drivers">Driver
                              Safety</a>
                            <a class="pc-mega-subitem d-block text-decoration-none" href="<?= $assetPath ?>/safety-tips-riders">Rider Safety</a>
                          </div>
                        </div>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/terms-conditions">
                          <span class="pc-mega-item-title d-block">Terms &amp; Conditions</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Rider and driver agreements</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/privacy-policy">
                          <span class="pc-mega-item-title d-block">Cookies &amp; Privacy Policy</span>
                          <span class="pc-mega-item-desc d-block fw-normal">How we handle data</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/sustainability">
                          <span class="pc-mega-item-title d-block">Sustainability &amp; Environment</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Our environmental commitment explained</span>
                        </a>
                      </div>

                    </div>
                  </div>
                </div>
              </li>

              <li>
                <a class="nav-link tw-block tw-rounded-full tw-px-4 tw-py-2 tw-text-[.92rem] tw-text-ink/65 hover:tw-text-ink [&.active]:tw-text-ink tw-transition-colors tw-no-underline tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-ink/20 <?= $navActive(
                  'drive.php',
                ) ?>" data-page="drive.php"
                  href="<?= $assetPath ?>/drive">Drive</a>
              </li>
              <li>
                <a class="nav-link tw-block tw-rounded-full tw-px-4 tw-py-2 tw-text-[.92rem] tw-text-ink/65 hover:tw-text-ink [&.active]:tw-text-ink tw-transition-colors tw-no-underline tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-ink/20 <?= $navActive(
                  'ride.php',
                ) ?>" data-page="ride.php"
                  href="<?= $assetPath ?>/ride">Ride</a>
              </li>
              <li>
                <a class="nav-link tw-block tw-rounded-full tw-px-4 tw-py-2 tw-text-[.92rem] tw-text-ink/65 hover:tw-text-ink [&.active]:tw-text-ink tw-transition-colors tw-no-underline tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-ink/20 <?= $navActive(
                  'business.php',
                ) ?>" data-page="business.php"
                  href="<?= $assetPath ?>/business">Business</a>
              </li>

              <!-- ============ Contact: hover mega menu (single column) ============ -->
              <li class="dropdown pc-mega-parent">
                <a class="tw-group nav-link dropdown-toggle tw-flex tw-items-center tw-gap-1 tw-rounded-full tw-px-4 tw-py-2 tw-text-[.92rem] tw-text-ink/65 hover:tw-text-ink tw-transition-colors tw-no-underline tw-outline-none tw-shadow-none focus:tw-shadow-none" href="#"
                  id="contactMegaToggle" role="button" data-bs-toggle="dropdown" data-bs-display="static"
                  data-bs-auto-close="outside" aria-expanded="false">
                  Contact
                  <svg class="tw-w-3 tw-h-3 tw-transition-transform tw-duration-200 group-aria-expanded:tw-rotate-180" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                    <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </a>

                <div class="dropdown-menu pc-mega-menu pc-mega-menu-narrow p-0 border-0 shadow-lg"
                  aria-labelledby="contactMegaToggle">
                  <div class="pc-mega-inner">
                    <div class="row g-4">
                      <div class="col-12 pc-mega-col">
                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/contact-us">
                          <span class="pc-mega-item-title d-block">Contact Us</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Reach our support team</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/complaint-form">
                          <span class="pc-mega-item-title d-block">Complaint Form</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Report an issue</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/positive-feedback-form">
                          <span class="pc-mega-item-title d-block">Positive Feedback Form</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Share a great experience</span>
                        </a>

                        <a class="pc-mega-item d-block w-100 border-0 text-start text-decoration-none" href="<?= $assetPath ?>/lost-item-report">
                          <span class="pc-mega-item-title d-block">Lost an Item Report</span>
                          <span class="pc-mega-item-desc d-block fw-normal">Left something in your ride?</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
          </ul>

          <div class="tw-flex tw-items-center tw-border-solid tw-border-t lg:tw-border-t-0 tw-border-black/[0.06] tw-pt-3 lg:tw-pt-0 tw-mt-1 lg:tw-mt-0">
            <a class="tw-group tw-inline-flex tw-w-full lg:tw-w-auto tw-items-center tw-justify-center tw-gap-2 tw-rounded-full tw-bg-ink tw-border tw-border-transparent tw-text-white tw-text-[.88rem] tw-font-medium tw-px-5 tw-py-2.5 tw-no-underline tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-ink/30"
              href="<?= $assetPath ?>/book-ride-online">
              <svg class="tw-w-4 tw-h-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 11l1.5-4.5A2 2 0 0 1 8.4 5h7.2a2 2 0 0 1 1.9 1.5L19 11m-14 0h14m-14 0a2 2 0 0 0-2 2v4h2m14-6a2 2 0 0 1 2 2v4h-2m-14 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1m10 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1m-14 0h14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="tw-inline-block tw-transition-transform tw-duration-200 group-hover:-tw-translate-x-0.5">Book Online</span>
            </a>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <main>