<?php
$pageTitle = 'PowerCabs | Reliable Cab Booking Service in Ireland';
$pageDescription = 'Book a reliable, affordable cab in Ireland with PowerCabs. Airport transfers, city rides, business travel and driver opportunities, available 24/7.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

/* Homepage section order, per the redesign blueprint (§18) and its rhythm
   rule (§19): never the same background twice in succession, so contrast
   comes from composition rather than from constantly changing colour.
   ONE dark band on the whole page and ONE orange moment. That restraint is
   the point: orange stops being a signal when it is the environment.
   Measured, the page runs 6.8% orange, which is where a comparable mobility
   site (Bolt) keeps its brand colour.

       hero ............. photographic, dark
       trusted-by ....... white          a quiet logo strip, nothing more
       statement ........ surface
       our-services ..... image cards    the four ride scenarios
       why-powercabs .... white
       coverage ......... surface-warm
       safety ........... white
       work-with-us ..... dark           business + drivers, one section
       download-app ..... white          the single orange moment, contained
       faq .............. white
       final-cta ........ surface

   Two structural cuts brought this from 7844px over 12 sections to 6583px
   over 11:

   - trusted-by carried a dark "Let Dublin Discover Your Business" panel whose
     CTA pointed at /business, the same destination as the business band five
     sections later. The same audience was asked the same thing twice, the
     first time at position two, before a rider had been told what PowerCabs
     is. The panel is gone; /partner-programme is still in the header and
     footer.
   - business-band.php and driver-band.php were two near-identical full-width
     ink slabs 445px apart, which is what §26 means by repeated dark panels.
     They are one section now, work-with-us.php, with a column each. Restore
     them from git rather than rebuilding by hand if this is ever reversed.

   welcome.php is no longer required here. It still holds the #why-choose id
   and the .pc-why-item reveal hooks that main.js looks for, so it has not
   been deleted -- initWhyChooseReveal() simply finds nothing and returns. */
require __DIR__ . '/components/home/hero.php';
require __DIR__ . '/components/home/trusted-by.php';
require __DIR__ . '/components/home/statement.php';
require __DIR__ . '/components/home/our-services.php';
require __DIR__ . '/components/home/why-powercabs.php';
require __DIR__ . '/components/home/coverage.php';
require __DIR__ . '/components/home/work-with-us.php';
require __DIR__ . '/components/home/safety.php';
require __DIR__ . '/components/home/download-app.php';
// require __DIR__ . '/components/home/faq.php';

$ctaTitle = 'Where are you going?';
$ctaText = 'Book in seconds, ride with licensed Irish drivers, and pay the fare you were quoted.';
$ctaPrimary = ['href' => '/book-ride-online', 'label' => 'Book a Ride'];
$ctaSecondary = ['href' => '/drive', 'label' => 'Drive with PowerCabs'];
require __DIR__ . '/components/shared/final-cta.php';

require __DIR__ . '/includes/footer.php';
