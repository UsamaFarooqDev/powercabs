<?php
$pageTitle = 'PowerCabs | Reliable Cab Booking Service in Ireland';
$pageDescription = 'Book a reliable, affordable cab in Ireland with PowerCabs. Airport transfers, city rides, business travel and driver opportunities, available 24/7.';
$assetPath = '';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/components/home/hero.php';
require __DIR__ . '/components/home/trusted-by.php';
require __DIR__ . '/components/home/our-services.php';
require __DIR__ . '/components/home/welcome.php';
require __DIR__ . '/components/home/download-app.php';

$ctaTitle = 'Your next journey starts here.';
$ctaText = 'Book in seconds, ride with licensed Irish drivers, and pay the fare you were quoted.';
$ctaPrimary = ['href' => '/book-ride-online', 'label' => 'Book a Ride'];
$ctaSecondary = ['href' => '/drive', 'label' => 'Drive with PowerCabs'];
require __DIR__ . '/components/shared/final-cta.php';

require __DIR__ . '/includes/footer.php';
