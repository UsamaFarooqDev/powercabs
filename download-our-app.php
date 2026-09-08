<?php
$pageTitle = 'Download the PowerCabs App | Passenger & Driver';
$pageDescription =
  'Download the PowerCabs app for Passengers or Drivers -- scan the QR code or get it directly from Google Play and the App Store.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Get Started';
$heroTitleLight = 'Download the';
$heroTitleBold = 'PowerCabs App.';
$heroDescription =
  'Everything you need is in the app -- book a ride in seconds as a passenger, or apply and start earning as a driver. Scan a QR code below or grab it from your app store.';
$heroBgImage = 'https://images.pexels.com/photos/5678243/pexels-photo-5678243.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<!-- Floating "hours" badge, overlapping the hero's bottom edge -->
<div class="tw-relative tw-z-[2] tw-mx-auto tw-w-full tw-max-w-[1320px] -tw-mt-7 tw-flex tw-justify-end tw-px-4 sm:tw-px-6 lg:tw-px-8">
  <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-xl tw-bg-ink tw-px-4 tw-py-2 tw-text-white tw-shadow-[0_8px_20px_rgba(28,20,16,0.25)]">
    <svg class="tw-h-4 tw-w-4 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <span class="tw-text-sm tw-font-semibold">Available 24/7</span>
  </span>
</div>

<?php require __DIR__ . '/components/download/app-cards.php'; ?>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
