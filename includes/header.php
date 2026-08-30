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

  <?php if (!empty($pageTailwind)): ?>
  <!--
    Tailwind (Play CDN) -- scoped to whichever page opts in via $pageTailwind
    (currently just the homepage's redesigned experience). Every other page
    keeps using Bootstrap exactly as before:
      - `prefix: 'tw-'` keeps every Tailwind utility namespaced (tw-flex,
        tw-bg-ink, ...) so it can never collide with a same-named Bootstrap
        class (.flex, .container, etc.) on this same page.
      - `preflight: false` disables Tailwind's base-style reset, since
        Bootstrap + base.css/variables.css already own global element styles
        (body, headings, links) -- Preflight would otherwise fight them.
    This is the official Tailwind Play CDN, meant for exactly this kind of
    build-step-free setup (the whole site already loads Bootstrap the same
    way, via jsdelivr, with no npm/webpack pipeline) -- Tailwind's own docs
    flag it as not ideal for production (larger runtime cost than a compiled
    stylesheet, one console warning), which is the one honest tradeoff of
    adding Tailwind without introducing a whole new build toolchain.
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
            ink: '#080808',
            ink2: '#111111',
            paper: '#F5F3EE',
            power: '#FF7900',
            powerlight: '#FFB15C',
          },
          keyframes: {
            marquee: { to: { transform: 'translateX(-50%)' } },
            float: { '0%,100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-14px)' } },
          },
          animation: {
            marquee: 'marquee 32s linear infinite',
            float: 'float 5s ease-in-out infinite',
          },
        },
      },
    };
  </script>
  <?php endif; ?>

  <style>
    /* ---------- Fixed glass navbar ------------------------------------------
       One material, always -- no light/dark variant, no per-section
       detection. A dark-enough glass tint plus its own blur stays legible
       over both photo heroes and plain light sections on its own; the
       .pc-nav-scrim band right below (rendered in the body, not here) adds
       a little extra contrast under the pill specifically for light
       sections, without the navbar itself needing to know which kind of
       section it's currently over. */
    .pc-navbar {
      position: relative;
      background: rgba(15, 16, 18, .55);
      backdrop-filter: blur(24px) saturate(160%);
      -webkit-backdrop-filter: blur(24px) saturate(160%);
      border: 1px solid rgba(255, 255, 255, .08);
      border-radius: 100px;
      /* box-shadow: 0 8px 30px rgba(0, 0, 0, .25); */
      --bs-navbar-color: rgba(255, 255, 255, .85);
      --bs-navbar-hover-color: rgba(255, 255, 255, .85);
      --bs-navbar-active-color: var(--pc-orange-light);
    }

    .pc-navbar-links-pill {
      background: transparent;
      box-shadow: none;
    }

    .pc-navbar .nav-link {
      position: relative;
      border-radius: var(--pc-radius-pill);
      transition: color .2s ease;
    }

    .pc-navbar .nav-link:hover {
      color: var(--pc-orange-light);
    }

    .pc-navbar .nav-link:focus,
    .pc-navbar .nav-link:focus-visible {
      outline: none;
      box-shadow: none;
    }

    /* Active state: underline dot in the accent color. */
    .pc-navbar .nav-link::after {
      content: "";
      position: absolute;
      left: 50%;
      bottom: 1px;
      width: 5px;
      height: 5px;
      border-radius: 50%;
      background: var(--pc-orange-light);
      opacity: 0;
      transform: translateX(-50%) scale(0);
      transition: transform .25s cubic-bezier(.34, 1.56, .64, 1), opacity .2s ease;
    }

    .pc-navbar .nav-link.active::after {
      opacity: 1;
      transform: translateX(-50%) scale(1);
    }

    .pc-nav-cta {
      background: rgba(255, 255, 255, .14) !important;
      border: 1px solid rgba(255, 255, 255, .2) !important;
      color: #fff !important;
    }

    .pc-nav-scrim {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 120px;
      z-index: 1029;
      /* background: linear-gradient(to bottom, rgba(0, 0, 0, .25), transparent); */
      pointer-events: none;
    }

    @media (min-width: 992px) {
      .pc-navbar-links-pill {
        padding-top: .22rem !important;
        padding-bottom: .22rem !important;
      }

      .pc-navbar-links-pill .nav-link {
        font-size: .9rem;
      }
    }

    @media (max-width: 991.98px) {
      .navbar-brand img {
        height: 35px;
      }

      .pc-navbar-links-pill {
        background: transparent !important;
        box-shadow: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
      }

      .pc-navbar .nav-link::after {
        display: none;
      }
    }
  </style>
</head>

<body data-page="<?= htmlspecialchars($currentPage) ?>">

  <?php require __DIR__ . '/../components/shared/page-loader.php'; ?>

  <span class="pc-nav-scrim" aria-hidden="true"></span>

  <header class="pc-header position-fixed top-0 start-0 w-100" style="z-index: 1030;">
    <div class="container px-2 px-lg-3 pt-2 pt-lg-2">
      <nav class="navbar navbar-expand-lg pc-navbar rounded-pill px-4 px-lg-5">
        <div class="container-fluid px-0">
          <a class="navbar-brand d-flex align-items-center py-0" href="<?= $assetPath ?>/">
            <img src="<?= $assetPath ?>assets/img/powercabs-logo-white.svg" alt="PowerCabs" height="47" class="d-block">
          </a>

          <button class="navbar-toggler pc-navbar-toggler position-relative border-0 p-0 shadow-none" type="button"
            data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="pc-toggler-bar position-absolute w-100"></span>
            <span class="pc-toggler-bar position-absolute w-100"></span>
            <span class="pc-toggler-bar position-absolute w-100"></span>
          </button>

          <div class="collapse navbar-collapse" id="mainNav">
            <ul
              class="navbar-nav pc-navbar-links-pill mx-auto gap-lg-4 align-items-lg-center py-2 py-lg-1 px-lg-3 rounded-pill">
              <li class="nav-item">
                <a class="nav-link fw-normal <?= $navActive('index.php') ?>" data-page="index.php"
                  href="<?= $assetPath ?>/">Home</a>
              </li>

              <!-- ============ About: hover mega menu ============ -->
              <li class="nav-item dropdown pc-mega-parent">
                <a class="nav-link fw-normal dropdown-toggle d-flex align-items-center gap-1" href="#"
                  id="aboutMegaToggle" role="button" data-bs-toggle="dropdown" data-bs-display="static"
                  data-bs-auto-close="outside" aria-expanded="false">
                  About
                  <i class="bi bi-chevron-down pc-mega-caret"></i>
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
                            <div class="pc-mega-submenu-inner overflow-hidden">
                              <a class="pc-mega-subitem d-block text-decoration-none" href="<?= $assetPath ?>/">Driver Training</a>
                              <a class="pc-mega-subitem d-block text-decoration-none" href="<?= $assetPath ?>/">SPSV Manual</a>
                            </div>
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

              <li class="nav-item">
                <a class="nav-link fw-normal <?= $navActive('drive.php') ?>" data-page="drive.php"
                  href="<?= $assetPath ?>/drive">Drive</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-normal <?= $navActive('ride.php') ?>" data-page="ride.php"
                  href="<?= $assetPath ?>/ride">Ride</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-normal <?= $navActive('business.php') ?>" data-page="business.php"
                  href="<?= $assetPath ?>/business">Business</a>
              </li>

              <!-- ============ Contact: hover mega menu (single column) ============ -->
              <li class="nav-item dropdown pc-mega-parent">
                <a class="nav-link fw-normal dropdown-toggle d-flex align-items-center gap-1" href="#"
                  id="contactMegaToggle" role="button" data-bs-toggle="dropdown" data-bs-display="static"
                  data-bs-auto-close="outside" aria-expanded="false">
                  Contact
                  <i class="bi bi-chevron-down pc-mega-caret"></i>
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

            <div class="mt-2 mt-lg-0 d-flex align-items-center pc-nav-actions">
              <a class="btn btn-pc-dark pc-nav-cta rounded-pill d-inline-flex align-items-center gap-2 fw-medium"
                href="<?= $assetPath ?>/book-ride-online">
                <i class="bi bi-car-front-fill"></i>
                <span class="pc-nav-cta-word d-inline-block">Book Online</span>
              </a>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </header>
  <main>