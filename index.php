<?php
$pageTitle = 'PowerCabs | Reliable Cab Booking Service in Ireland';
$pageDescription = 'Book a reliable, affordable cab in Ireland with PowerCabs. Airport transfers, city rides, business travel and driver opportunities, available 24/7.';
$assetPath = '';

// Scoped to this page only -- see includes/header.php. Every other page on
// the site keeps rendering with Bootstrap exactly as before.
$pageTailwind = true;

require __DIR__ . '/includes/header.php';

require __DIR__ . '/components/home/hero.php';
require __DIR__ . '/components/home/city-in-motion.php';
require __DIR__ . '/components/home/ride-experience.php';
require __DIR__ . '/components/home/our-services.php';
require __DIR__ . '/components/home/why-choose-us.php';
require __DIR__ . '/components/home/trusted-by.php';
require __DIR__ . '/components/home/app-showcase.php';
require __DIR__ . '/components/home/driver-cta.php';
require __DIR__ . '/components/home/business-cta.php';
require __DIR__ . '/components/home/final-cta.php';

require __DIR__ . '/includes/footer.php';
