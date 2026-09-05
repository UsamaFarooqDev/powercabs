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

// The shared Tailwind class recipes ($pcContainer, $pcSection, $pcCard,
// $pcInput ...). Required here so every page and component below can use
// them without importing anything.
require __DIR__ . '/design-system.php';

// ---- Mega-menu class recipes -------------------------------------------
// Below 992px the panel renders inline inside the mobile nav (static, just a
// hairline top rule). At >=992px it becomes a floating card: kept in the
// layout but invisible so it can fade, then revealed by `is-open`, which
// initMegaMenus() in main.js toggles (it replaced Bootstrap's Dropdown).
$megaPanelBase =
  'tw-hidden tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.08] [&.is-open]:tw-block ' .
  // Desktop: a quiet sheet, not a card -- square-ish corners, a hairline
  // rule, and a shadow soft enough that the panel reads as an extension of
  // the bar rather than something floating over it.
  'lg:tw-block lg:tw-border lg:tw-border-solid lg:tw-border-black/[0.07] lg:tw-rounded-xl ' .
  'lg:tw-bg-white lg:tw-shadow-[0_24px_60px_-12px_rgba(28,20,16,0.16)] ' .
  'lg:tw-invisible lg:tw-opacity-0 lg:tw-transition-[opacity,transform,visibility] lg:tw-duration-200 ' .
  'lg:tw-ease-out lg:[&.is-open]:tw-visible lg:[&.is-open]:tw-opacity-100 ' .
  'motion-reduce:lg:tw-transition-none';
// Both panels are absolute against the <nav> -- the pill -- rather than
// against their own <li>, so `top: calc(100% + 0.5rem)` means the same
// distance below the bar for both and they line up with each other.
// Wide (About) centres on the pill; narrow (Contact) sits flush to its
// right edge. Neither is given a min-height: each hugs its own content.
//
// Both panels are positioned to sit tight against the bar (the wide one even
// overlaps it by 4px) so there is no dead zone between the link and the
// panel for the pointer to cross. That, plus the fact that each panel is a
// DOM child of its .pc-mega-parent -- so mouseleave does not fire when
// moving into it -- plus initMegaMenus()'s 250ms close delay, is what keeps
// the hover from flickering.
$megaPanelWide =
  $megaPanelBase .
  ' lg:tw-absolute lg:tw-left-1/2 lg:tw-top-[calc(100%+0.5rem)] lg:tw-w-[min(1040px,calc(100vw-4rem))] lg:-tw-translate-x-1/2 lg:tw-translate-y-1 lg:[&.is-open]:tw-translate-y-0';
$megaPanelNarrow =
  $megaPanelBase .
  ' lg:tw-absolute lg:tw-left-1/2 lg:tw-top-[calc(100%+1.375rem)] lg:tw-w-[320px] lg:-tw-translate-x-1/2 lg:tw-translate-y-1 lg:[&.is-open]:tw-translate-y-0';

$megaInner = 'tw-px-1 tw-py-4 lg:tw-px-9 lg:tw-py-8';
// Column headings: small, tracked, muted -- a label, not a title.
$megaColTitle =
  'tw-mb-4 tw-mt-7 tw-border-0 tw-pb-0 tw-text-[0.74rem] tw-font-semibold tw-uppercase tw-tracking-[0.14em] tw-text-ink/45 lg:tw-mt-0 [.pc-mega-col:first-child_&]:tw-mt-2 lg:[.pc-mega-col:first-child_&]:tw-mt-0';
// Rows: no hover background box -- just the title shifting to brand colour
// and a small nudge. Editorial, not e-commerce.
$megaItem =
  'tw-group tw-block tw-w-full tw-cursor-pointer tw-appearance-none tw-border-0 tw-bg-transparent tw-py-2 tw-text-left tw-font-[inherit] tw-text-inherit tw-no-underline tw-outline-none';
$megaItemTitle =
  'tw-block tw-text-[0.95rem] tw-font-medium tw-leading-snug tw-text-ink tw-transition-colors tw-duration-200 group-hover:tw-text-power group-focus-visible:tw-text-power';
$megaItemDesc =
  'tw-mt-1 tw-block tw-text-[0.82rem] tw-leading-relaxed tw-text-ink/[0.5] tw-transition-colors tw-duration-200 group-hover:tw-text-ink/[0.6]';
$megaChevron =
  'tw-h-3 tw-w-3 tw-shrink-0 tw-text-ink/30 tw-transition-transform tw-duration-300 tw-ease-out [.pc-mega-nested:hover_&]:tw-rotate-90 [.pc-mega-nested:focus-within_&]:tw-rotate-90 [.pc-mega-nested-open_&]:tw-rotate-90';
// grid-template-rows 0fr -> 1fr is the height-agnostic open/close trick.
$megaSubmenu =
  'tw-ml-0 tw-grid [grid-template-rows:0fr] tw-border-0 tw-border-l tw-border-solid tw-border-black/[0.08] tw-pl-4 tw-opacity-0 tw-transition-[grid-template-rows,opacity] tw-duration-300 tw-ease-out [.pc-mega-nested:hover_&]:[grid-template-rows:1fr] [.pc-mega-nested:hover_&]:tw-opacity-100 [.pc-mega-nested:focus-within_&]:[grid-template-rows:1fr] [.pc-mega-nested:focus-within_&]:tw-opacity-100 [.pc-mega-nested-open_&]:[grid-template-rows:1fr] [.pc-mega-nested-open_&]:tw-opacity-100 motion-reduce:tw-transition-none';
$megaSubitem =
  'tw-block tw-py-1.5 tw-text-[0.875rem] tw-font-medium tw-text-ink/[0.58] tw-no-underline tw-outline-none tw-transition-colors tw-duration-200 hover:tw-text-power focus-visible:tw-text-power';

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

  <!-- Order matters: reboot (element normalisation) -> variables (brand
       tokens, which override reboot's --bs-* defaults) -> base (PowerCabs
       layer, incl. Google Places) -> tailwind (utilities). -->
  <link rel="stylesheet"
    href="<?= $assetPath ?>assets/css/reboot.css?v=<?= @filemtime(__DIR__ . '/../assets/css/reboot.css') ?>">
  <link rel="stylesheet"
    href="<?= $assetPath ?>assets/css/variables.css?v=<?= @filemtime(__DIR__ . '/../assets/css/variables.css') ?>">
  <link rel="stylesheet"
    href="<?= $assetPath ?>assets/css/base.css?v=<?= @filemtime(__DIR__ . '/../assets/css/base.css') ?>">

  <?php require __DIR__ . '/tailwind.php'; ?>

  <!--
    The navbar -- the fixed glass pill, its links, the CTA, the mobile
    toggle and panel, and BOTH mega-menu dropdown panels -- is fully
    Tailwind on the markup below. Nothing here depends on Bootstrap any
    more: the mobile panel and the dropdowns are driven by initNavToggle()
    and initMegaMenus() in assets/js/main.js, which replaced Bootstrap's
    Collapse and Dropdown. The class recipes for the panels are the
    $mega* variables built at the top of this file.
  -->
</head>

<body data-page="<?= htmlspecialchars($currentPage) ?>">

  <?php require __DIR__ . '/../components/shared/page-loader.php'; ?>

  <header class="tw-fixed tw-top-0 tw-inset-x-0 tw-w-full" style="z-index: 1030;">
    <!-- A floating translucent pill inset from the viewport edges. The OUTER
         div owns the inset so the bar itself stays a self-contained shape;
         the <nav> owns the shape and the blur. No border at all -- the pill is
         defined by its translucent fill and the soft all-round shadow; a white
         stroke on top of those read as a hard outline against pale sections. -->
    <div class="tw-w-full tw-px-3 tw-pt-2 sm:tw-px-5 sm:tw-pt-3 lg:tw-px-6 lg:tw-pt-4">
      <nav class="tw-relative tw-mx-auto tw-flex tw-w-full tw-max-w-[1320px] tw-items-center tw-justify-between tw-gap-3 tw-rounded-[30px] tw-bg-white/70 tw-px-4 tw-py-1.5 tw-shadow-[0_0_24px_rgba(28,20,16,0.07),0_0_8px_rgba(28,20,16,0.04)] tw-backdrop-blur-[24px] sm:tw-px-5 lg:tw-px-6 lg:tw-py-2.5">
        <a class="tw-flex tw-items-center tw-shrink-0" href="<?= $assetPath ?>/">
          <img src="<?= $assetPath ?>assets/img/powercabs-logo-dark.svg" alt="PowerCabs" height="47" class="tw-block tw-h-9 lg:tw-h-11 tw-w-auto">
        </a>

        <!-- Below lg the panel is tw-absolute (out of flow), drops below the
             pill and is toggled by `is-open`; at lg it becomes a flex row
             that grows to fill the space between the logo and the action
             group, so tw-mx-auto on the <ul> centres the links in the bar. -->
        <!-- tw-max-h-[...]/tw-overflow-y-auto (mobile only) restore scrolling
             for a tall expanded panel -- e.g. tapping "About" inlines the
             whole mega-menu content beneath the links, which alone can
             exceed the viewport on a short phone. Without this the panel
             just clips silently at the bottom with no way to reach the rest.
             Keyed off --pc-navbar-h, the same live-measured custom property
             main.js already keeps in sync (syncNavbarHeightVar()), so this
             tracks the bar's real height instead of a guessed constant. -->
        <div class="tw-hidden [&.is-open]:tw-flex lg:tw-flex lg:tw-grow tw-w-full lg:tw-w-auto tw-absolute lg:tw-static tw-inset-x-0 tw-top-[calc(100%+0.6rem)] lg:tw-top-auto tw-max-h-[calc(100vh-var(--pc-navbar-h,76px)-2.5rem)] tw-overflow-y-auto lg:tw-max-h-none lg:tw-overflow-visible tw-flex-col lg:tw-flex-row lg:tw-items-center tw-rounded-[24px] lg:tw-rounded-none tw-border tw-border-solid lg:tw-border-0 tw-border-black/[0.06] tw-bg-white lg:tw-bg-transparent tw-p-2 lg:tw-p-0 tw-shadow-[0_16px_44px_-12px_rgba(28,20,16,0.22)] lg:tw-shadow-none" id="mainNav">
          <ul class="navbar-nav tw-flex tw-w-full lg:tw-w-auto lg:tw-self-stretch tw-flex-col lg:tw-flex-row lg:tw-items-center tw-gap-0 lg:tw-gap-8 tw-list-none tw-m-0 tw-p-0 lg:tw-mx-auto tw-divide-y tw-divide-x-0 tw-divide-solid tw-divide-black/[0.07] lg:tw-divide-y-0">
              <li>
                <a class="nav-link tw-relative tw-block tw-px-3 tw-py-3.5 lg:tw-px-0 lg:tw-py-1.5 tw-text-base lg:tw-text-[0.95rem] tw-font-medium tw-tracking-[-0.01em] tw-text-ink/[0.62] hover:tw-text-ink [&.active]:tw-text-ink tw-transition-colors tw-duration-200 tw-no-underline tw-outline-none focus-visible:tw-text-ink <?= $navActive(
                  'index.php',
                ) ?>" data-page="index.php"
                  href="<?= $assetPath ?>/">Home</a>
              </li>

              <!-- ============ About: hover mega menu ============ -->
              <li class="pc-mega-parent lg:tw-flex lg:tw-items-center lg:tw-self-stretch">
                <a class="tw-group nav-link tw-relative tw-flex tw-w-full lg:tw-w-auto tw-cursor-pointer tw-items-center tw-justify-between lg:tw-justify-start tw-gap-1.5 tw-px-3 tw-py-3.5 lg:tw-px-0 lg:tw-py-1.5 tw-text-base lg:tw-text-[0.95rem] tw-font-medium tw-tracking-[-0.01em] tw-text-ink/[0.62] hover:tw-text-ink aria-expanded:tw-text-ink tw-transition-colors tw-duration-200 tw-no-underline tw-outline-none focus-visible:tw-text-ink" href="#"
                  id="aboutMegaToggle" role="button" data-pc-dropdown aria-expanded="false">
                  About
                  <svg class="tw-w-3 tw-h-3 tw-transition-transform tw-duration-200 group-aria-expanded:tw-rotate-180" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                    <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </a>

                <div class="<?= $megaPanelWide ?>" data-pc-dropdown-panel aria-labelledby="aboutMegaToggle">
                  <div class="<?= $megaInner ?>">
                    <div class="tw-grid tw-grid-cols-1 tw-gap-x-10 tw-gap-y-2 sm:tw-grid-cols-2 lg:tw-grid-cols-4">

                      <!-- Col 1: Get Started -->
                      <div class="pc-mega-col">
                        <p class="<?= $megaColTitle ?>">Get Started</p>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/book-ride-online">
                          <span class="<?= $megaItemTitle ?>">Book Ride Online</span>
                          <span class="<?= $megaItemDesc ?>">Instant online cab booking</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/download-our-app">
                          <span class="<?= $megaItemTitle ?>">Download App</span>
                          <span class="<?= $megaItemDesc ?>">Get the PowerCabs app</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/about-us">
                          <span class="<?= $megaItemTitle ?>">About Us</span>
                          <span class="<?= $megaItemDesc ?>">Our story and mission</span>
                        </a>
                      </div>

                      <!-- Col 2: Business -->
                      <div class="pc-mega-col">
                        <p class="<?= $megaColTitle ?>">Business</p>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/corporate-services">
                          <span class="<?= $megaItemTitle ?>">Corporate Services</span>
                          <span class="<?= $megaItemDesc ?>">Business travel accounts Ireland</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/business-solutions">
                          <span class="<?= $megaItemTitle ?>">PowerCabs Business Solutions</span>
                          <span class="<?= $megaItemDesc ?>">Card terminals and payments</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/wheelchair-accessible-taxis">
                          <span class="<?= $megaItemTitle ?>">Wheelchair Accessible Taxis</span>
                          <span class="<?= $megaItemDesc ?>">Inclusive rides for everyone</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/meet-greet">
                          <span class="<?= $megaItemTitle ?>">Meet &amp; Greet</span>
                          <span class="<?= $megaItemDesc ?>">Airport pickups, done right</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/city-tours">
                          <span class="<?= $megaItemTitle ?>">City Tours</span>
                          <span class="<?= $megaItemDesc ?>">See Ireland with a local driver</span>
                        </a>
                      </div>

                      <!-- Col 3: Drivers -->
                      <div class="pc-mega-col">
                        <p class="<?= $megaColTitle ?>">Drivers</p>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/ambassador-programme">
                          <span class="<?= $megaItemTitle ?>">Ambassador Programme</span>
                          <span class="<?= $megaItemDesc ?>">Exclusive perks for drivers</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/partner-programme">
                          <span class="<?= $megaItemTitle ?>">Partner Programme</span>
                          <span class="<?= $megaItemDesc ?>">Earn as a partner</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/loyalty-program">
                          <span class="<?= $megaItemTitle ?>">Loyalty Program</span>
                          <span class="<?= $megaItemDesc ?>">Earn rewards every trip</span>
                        </a>

                        <div class="pc-mega-nested">
                          <button type="button" class="pc-mega-item-parent <?= $megaItem ?>">
                            <span class="<?= $megaItemTitle ?> tw-flex tw-items-center tw-justify-between">
                              Training
                              <svg class="<?= $megaChevron ?>" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3l5 5-5 5"/></svg>
                            </span>
                            <span class="<?= $megaItemDesc ?>">Licensing and onboarding resources</span>
                          </button>
                          <div class="<?= $megaSubmenu ?>">
                            <a class="<?= $megaSubitem ?>" href="<?= $assetPath ?>/">Driver Training</a>
                            <a class="<?= $megaSubitem ?>" href="<?= $assetPath ?>/">SPSV Manual</a>
                          </div>
                        </div>
                      </div>

                      <!-- Col 4: Policies & Safety -->
                      <div class="pc-mega-col">
                        <p class="<?= $megaColTitle ?>">Policies &amp; Safety</p>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/terms-conditions">
                          <span class="<?= $megaItemTitle ?>">Terms &amp; Conditions</span>
                          <span class="<?= $megaItemDesc ?>">Rider and driver agreements</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/privacy-policy">
                          <span class="<?= $megaItemTitle ?>">Cookies &amp; Privacy Policy</span>
                          <span class="<?= $megaItemDesc ?>">How we handle data</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/sustainability">
                          <span class="<?= $megaItemTitle ?>">Sustainability &amp; Environment</span>
                          <span class="<?= $megaItemDesc ?>">Our environmental commitment</span>
                        </a>

                        <div class="pc-mega-nested">
                          <button type="button" class="pc-mega-item-parent <?= $megaItem ?>">
                            <span class="<?= $megaItemTitle ?> tw-flex tw-items-center tw-justify-between">
                              Safety
                              <svg class="<?= $megaChevron ?>" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3l5 5-5 5"/></svg>
                            </span>
                            <span class="<?= $megaItemDesc ?>">Tips for staying safe</span>
                          </button>
                          <div class="<?= $megaSubmenu ?>">
                            <a class="<?= $megaSubitem ?>" href="<?= $assetPath ?>/safety-tips-drivers">Driver
                              Safety</a>
                            <a class="<?= $megaSubitem ?>" href="<?= $assetPath ?>/safety-tips-riders">Rider Safety</a>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              </li>

              <li>
                <a class="nav-link tw-relative tw-block tw-px-3 tw-py-3.5 lg:tw-px-0 lg:tw-py-1.5 tw-text-base lg:tw-text-[0.95rem] tw-font-medium tw-tracking-[-0.01em] tw-text-ink/[0.62] hover:tw-text-ink [&.active]:tw-text-ink tw-transition-colors tw-duration-200 tw-no-underline tw-outline-none focus-visible:tw-text-ink <?= $navActive(
                  'drive.php',
                ) ?>" data-page="drive.php"
                  href="<?= $assetPath ?>/drive">Drive</a>
              </li>
              <li>
                <a class="nav-link tw-relative tw-block tw-px-3 tw-py-3.5 lg:tw-px-0 lg:tw-py-1.5 tw-text-base lg:tw-text-[0.95rem] tw-font-medium tw-tracking-[-0.01em] tw-text-ink/[0.62] hover:tw-text-ink [&.active]:tw-text-ink tw-transition-colors tw-duration-200 tw-no-underline tw-outline-none focus-visible:tw-text-ink <?= $navActive(
                  'ride.php',
                ) ?>" data-page="ride.php"
                  href="<?= $assetPath ?>/ride">Ride</a>
              </li>
              <li>
                <a class="nav-link tw-relative tw-block tw-px-3 tw-py-3.5 lg:tw-px-0 lg:tw-py-1.5 tw-text-base lg:tw-text-[0.95rem] tw-font-medium tw-tracking-[-0.01em] tw-text-ink/[0.62] hover:tw-text-ink [&.active]:tw-text-ink tw-transition-colors tw-duration-200 tw-no-underline tw-outline-none focus-visible:tw-text-ink <?= $navActive(
                  'business.php',
                ) ?>" data-page="business.php"
                  href="<?= $assetPath ?>/business">Business</a>
              </li>

              <!-- ============ Contact: hover mega menu (single column) ============ -->
              <li class="pc-mega-parent lg:tw-flex lg:tw-items-center lg:tw-self-stretch lg:tw-relative">
                <a class="tw-group nav-link tw-relative tw-flex tw-w-full lg:tw-w-auto tw-cursor-pointer tw-items-center tw-justify-between lg:tw-justify-start tw-gap-1.5 tw-px-3 tw-py-3.5 lg:tw-px-0 lg:tw-py-1.5 tw-text-base lg:tw-text-[0.95rem] tw-font-medium tw-tracking-[-0.01em] tw-text-ink/[0.62] hover:tw-text-ink aria-expanded:tw-text-ink tw-transition-colors tw-duration-200 tw-no-underline tw-outline-none focus-visible:tw-text-ink" href="#"
                  id="contactMegaToggle" role="button" data-pc-dropdown aria-expanded="false">
                  Contact
                  <svg class="tw-w-3 tw-h-3 tw-transition-transform tw-duration-200 group-aria-expanded:tw-rotate-180" viewBox="0 0 12 12" fill="none" aria-hidden="true">
                    <path d="M2.5 4.5L6 8L9.5 4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                </a>

                <div class="<?= $megaPanelNarrow ?>" data-pc-dropdown-panel aria-labelledby="contactMegaToggle">
                  <div class="<?= $megaInner ?>">
                    <div class="tw-grid tw-grid-cols-1 tw-gap-1">
                      <div class="pc-mega-col">
                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/contact-us">
                          <span class="<?= $megaItemTitle ?>">Contact Us</span>
                          <span class="<?= $megaItemDesc ?>">Reach our support team</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/complaint-form">
                          <span class="<?= $megaItemTitle ?>">Complaint Form</span>
                          <span class="<?= $megaItemDesc ?>">Report an issue</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/positive-feedback-form">
                          <span class="<?= $megaItemTitle ?>">Positive Feedback Form</span>
                          <span class="<?= $megaItemDesc ?>">Share a great experience</span>
                        </a>

                        <a class="<?= $megaItem ?>" href="<?= $assetPath ?>/lost-item-report">
                          <span class="<?= $megaItemTitle ?>">Lost an Item Report</span>
                          <span class="<?= $megaItemDesc ?>">Left something in your ride?</span>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
          </ul>

          <!-- Mobile-only twin of the bar CTA: below lg the bar hides its
               copy and the action lands here, at the end of the menu. -->
          <a class="tw-mt-2 tw-inline-flex tw-w-full tw-items-center tw-justify-center tw-gap-2 tw-rounded-full tw-bg-ink tw-border-0 tw-px-5 tw-py-3 tw-text-[0.95rem] tw-font-semibold tw-text-white tw-no-underline tw-outline-none tw-transition-colors tw-duration-200 hover:tw-bg-black focus-visible:tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-ink/30 lg:tw-hidden"
            href="<?= $assetPath ?>/book-ride-online">
            <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" aria-hidden="true">
              <path d="M5 11l1.5-4.5A2 2 0 0 1 8.4 5h7.2a2 2 0 0 1 1.9 1.5L19 11m-14 0h14m-14 0a2 2 0 0 0-2 2v4h2m14-6a2 2 0 0 1 2 2v4h-2m-14 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1m10 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1m-14 0h14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Book Online
          </a>

        </div>
        <!-- Action group: the CTA at lg and up, the toggle below it); only the toggle is mobile-only. -->
        <div class="tw-flex tw-shrink-0 tw-items-center tw-gap-2">
          <a class="tw-group tw-hidden lg:tw-inline-flex tw-items-center tw-justify-center tw-gap-2 tw-rounded-full tw-bg-ink tw-border-0 tw-text-white tw-text-[0.86rem] tw-font-semibold tw-tracking-[-0.01em] tw-px-5 tw-py-2.5 tw-no-underline tw-outline-none tw-transition-colors tw-duration-200 hover:tw-bg-black focus-visible:tw-outline-none focus-visible:tw-ring-2 focus-visible:tw-ring-ink/30"
              href="<?= $assetPath ?>/book-ride-online">
              <svg class="tw-w-4 tw-h-4 tw-shrink-0 tw-hidden sm:tw-block" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <path d="M5 11l1.5-4.5A2 2 0 0 1 8.4 5h7.2a2 2 0 0 1 1.9 1.5L19 11m-14 0h14m-14 0a2 2 0 0 0-2 2v4h2m14-6a2 2 0 0 1 2 2v4h-2m-14 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1m10 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1m-14 0h14" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="tw-inline-block tw-transition-transform tw-duration-200 group-hover:-tw-translate-x-0.5">Book Online</span>
            </a>
          <button type="button" id="pcNavToggle" class="tw-group tw-relative tw-flex tw-h-9 tw-w-9 tw-shrink-0 tw-cursor-pointer tw-appearance-none tw-flex-col tw-items-center tw-justify-center tw-gap-[5px] tw-rounded-xl tw-border-0 tw-bg-black/[0.05] tw-shadow-none tw-outline-none tw-transition-colors tw-duration-200 hover:tw-bg-black/[0.09] focus-visible:tw-bg-black/[0.09] focus-visible:tw-outline-none lg:tw-hidden"
          aria-controls="mainNav" aria-expanded="false"
          aria-label="Toggle navigation">
          <span class="tw-h-[1.5px] tw-w-[18px] tw-rounded-full tw-bg-ink tw-transition-transform tw-duration-300 group-aria-expanded:tw-translate-y-[7px] group-aria-expanded:tw-rotate-45"></span>
          <span class="tw-h-[1.5px] tw-w-[18px] tw-rounded-full tw-bg-ink tw-transition-opacity tw-duration-200 group-aria-expanded:tw-opacity-0"></span>
          <span class="tw-h-[1.5px] tw-w-[18px] tw-rounded-full tw-bg-ink tw-transition-transform tw-duration-300 group-aria-expanded:-tw-translate-y-[7px] group-aria-expanded:-tw-rotate-45"></span>
          </button>
        </div>
      </nav>
    </div>
  </header>
  <main>