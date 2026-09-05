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
require __DIR__ . '/includes/footer.php';
