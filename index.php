<?php
$pageTitle = 'PowerCabs | Reliable Cab Booking Service in Ireland';
$pageDescription = 'Book a reliable, affordable cab in Ireland with PowerCabs. Airport transfers, city rides, business travel and driver opportunities, available 24/7.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

/* Homepage section order, per the redesign blueprint (§18) and its rhythm
   rule (§19): never the same background twice in succession, so contrast
   comes from composition rather than from constantly changing colour.
   Only two dark bands on the whole page -- business and the final CTA --
   and exactly one orange moment, the app download. That restraint is the
   point: orange stops being a signal when it is the environment.

       hero ............. photographic, dark
       trusted-by ....... white
       statement ........ surface        §03  new
       our-services ..... dark/image     §04  the four ride scenarios
       why-powercabs .... white          §06  replaces welcome.php's cards
       coverage ......... surface-warm   §07  new
       business-band .... dark           §08  new
       safety ........... white          §09  new
       driver-band ...... image          §10  new
       download-app ..... orange         §11  the single orange moment
       faq .............. white          §12  new
       final-cta ........ dark           §13

   welcome.php is no longer required here. It still holds the #why-choose id
   and the .pc-why-item reveal hooks that main.js looks for, so it has not
   been deleted -- initWhyChooseReveal() simply finds nothing and returns. */
require __DIR__ . '/components/home/hero.php';
require __DIR__ . '/components/home/trusted-by.php';
require __DIR__ . '/components/home/statement.php';
require __DIR__ . '/components/home/our-services.php';
require __DIR__ . '/components/home/why-powercabs.php';
require __DIR__ . '/components/home/coverage.php';
require __DIR__ . '/components/home/business-band.php';
require __DIR__ . '/components/home/safety.php';
require __DIR__ . '/components/home/driver-band.php';
require __DIR__ . '/components/home/download-app.php';
require __DIR__ . '/components/home/faq.php';

$ctaTitle = 'Where are you going?';
$ctaText = 'Book in seconds, ride with licensed Irish drivers, and pay the fare you were quoted.';
$ctaPrimary = ['href' => '/book-ride-online', 'label' => 'Book a Ride'];
$ctaSecondary = ['href' => '/drive', 'label' => 'Drive with PowerCabs'];
require __DIR__ . '/components/shared/final-cta.php';

require __DIR__ . '/includes/footer.php';
