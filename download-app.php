<?php
$pageTitle       = 'Download the PowerCabs App | Passenger & Driver';
$pageDescription = 'Download the PowerCabs app for Passengers or Drivers -- scan the QR code or get it directly from Google Play and the App Store.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Get Started';
$heroTitleLight  = 'Download the';
$heroTitleBold   = 'PowerCabs App.';
$heroDescription = 'Everything you need is in the app -- book a ride in seconds as a passenger, or apply and start earning as a driver. Scan a QR code below or grab it from your app store.';
$heroBgImage     = $assetPath . 'assets/img/download-app-bg.svg';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<!-- Floating "hours" badge, overlapping the hero's bottom edge -->
<div class="container position-relative d-flex justify-content-end" style="margin-top: -1.75rem; z-index: 2;">
  <span class="d-inline-flex align-items-center gap-2 bg-dark text-white rounded-3 shadow px-3 py-2">
    <i class="bi bi-clock-fill"></i>
    <span class="fw-semibold small">Available 24/7</span>
  </span>
</div>

<?php require __DIR__ . '/components/download/app-cards.php'; ?>

<?php
require __DIR__ . '/includes/footer.php';
?>
