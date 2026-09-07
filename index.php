<?php
$pageTitle = 'PowerCabs | Reliable Cab Booking Service in Ireland';
$pageDescription = 'Book a reliable, affordable cab in Ireland with PowerCabs. Airport transfers, city rides, business travel and driver opportunities, available 24/7.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

require __DIR__ . '/components/home/hero.php';
require __DIR__ . '/components/home/trusted-by.php';
// Why PowerCabs now renders inside welcome.php, on that section's
// photographic background -- requiring it here as well would duplicate
// the #why-choose id and the pc-why-item reveal hooks.
require __DIR__ . '/components/home/our-services.php';
require __DIR__ . '/components/home/welcome.php';
require __DIR__ . '/components/home/download-app.php';

// Closes the page on an action rather than trailing off after the app
// section. Dark, so it meets the footer as one closing block.
$ctaTitle = 'Your next journey starts here.';
$ctaText = 'Book in seconds, ride with licensed Irish drivers, and pay the fare you were quoted.';
$ctaPrimary = ['href' => '/book-ride-online', 'label' => 'Book a Ride'];
$ctaSecondary = ['href' => '/drive', 'label' => 'Drive with PowerCabs'];
require __DIR__ . '/components/shared/final-cta.php';

require __DIR__ . '/includes/footer.php';
