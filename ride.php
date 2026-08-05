<?php
$pageTitle       = 'Ride with PowerCabs | Seamless, Comfortable Taxis in Ireland';
$pageDescription = 'Book a seamless, comfortable ride with PowerCabs -- convenient booking, Garda-vetted drivers, affordable rates and 24/7 availability across Ireland.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Ride';
$heroTitleLight  = 'Seamless and';
$heroTitleBold   = 'Comfortable Rides.';
$heroDescription = "PowerCabs is committed to providing a smooth, reliable, and comfortable ride experience. Whether you're commuting to work, heading to the airport, or exploring the city, PowerCabs offers convenient booking, safe transportation, affordable pricing, and 24/7 availability.";
$heroBgImage     = 'https://images.pexels.com/photos/1399282/pexels-photo-1399282.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

require __DIR__ . '/components/ride/built-around.php';
require __DIR__ . '/components/ride/ride-types.php';
require __DIR__ . '/components/ride/booking-steps.php';

require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
