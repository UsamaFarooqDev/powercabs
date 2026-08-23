<?php
$pageTitle = 'GDPR | PowerCabs';
$pageDescription =
  'How PowerCabs Ireland Limited processes personal data in compliance with the General Data Protection Regulation (GDPR).';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Data Protection';
$heroTitleLight = 'General Data';
$heroTitleBold = 'Protection Regulation.';
$heroDescription =
  'PowerCabs is committed to protecting customer privacy and processing personal data in compliance with GDPR.';
$heroBgImage = 'https://images.pexels.com/photos/2882659/pexels-photo-2882659.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'GDPR';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<section class="section-pc">
  <div class="container" style="max-width: 800px;">

    <h2 id="controller" class="fs-4 fw-bold mb-3">1. Data Controller</h2>
    <ul class="text-muted-pc">
      <li>PowerCabs Ireland Limited</li>
      <li>Contact: <a class="pc-form-link" href="mailto:info@powercabs.ie">info@powercabs.ie</a></li>
    </ul>

    <h2 id="data" class="fs-4 fw-bold mt-5 mb-3">2. Data Collected</h2>
    <p class="fw-semibold mb-2">Personal Data</p>
    <ul class="text-muted-pc mb-4">
      <li>Name</li><li>Email</li><li>Phone</li><li>Address</li>
    </ul>
    <p class="fw-semibold mb-2">Booking Data</p>
    <ul class="text-muted-pc mb-4">
      <li>Pickup</li><li>Destination</li><li>Ride date</li><li>Payment details</li>
    </ul>
    <p class="fw-semibold mb-2">Usage Data</p>
    <ul class="text-muted-pc mb-4">
      <li>IP address</li><li>Browser</li><li>Device information</li>
    </ul>
    <p class="fw-semibold mb-2">Feedback</p>
    <ul class="text-muted-pc mb-0">
      <li>Reviews</li><li>Customer comments</li>
    </ul>

    <h2 id="purpose" class="fs-4 fw-bold mt-5 mb-3">3. Purpose of Data</h2>
    <ul class="text-muted-pc mb-0">
      <li>Process bookings</li>
      <li>Customer support</li>
      <li>Marketing (with consent)</li>
      <li>Improve services</li>
      <li>Legal compliance</li>
    </ul>

    <h2 id="legal-basis" class="fs-4 fw-bold mt-5 mb-3">4. Legal Basis</h2>
    <ul class="text-muted-pc mb-0">
      <li>Contract</li>
      <li>Consent</li>
      <li>Legitimate Interest</li>
      <li>Legal Obligation</li>
    </ul>

    <h2 id="sharing" class="fs-4 fw-bold mt-5 mb-3">5. Data Sharing</h2>
    <ul class="text-muted-pc mb-0">
      <li>Payment providers</li>
      <li>IT providers</li>
      <li>Legal authorities</li>
      <li>Business transfers</li>
    </ul>

    <h2 id="retention" class="fs-4 fw-bold mt-5 mb-3">6. Data Retention</h2>
    <p class="text-muted-pc mb-0">Personal information is retained only as long as necessary to meet legal and operational requirements.</p>

    <h2 id="rights" class="fs-4 fw-bold mt-5 mb-3">7. User Rights</h2>
    <ul class="text-muted-pc mb-0">
      <li>Access</li>
      <li>Rectification</li>
      <li>Erasure</li>
      <li>Restriction</li>
      <li>Portability</li>
      <li>Object to processing</li>
    </ul>

    <h2 id="security" class="fs-4 fw-bold mt-5 mb-3">8. Data Security</h2>
    <ul class="text-muted-pc mb-0">
      <li>Encryption</li>
      <li>Secure servers</li>
      <li>Regular security reviews</li>
    </ul>

    <h2 id="updates" class="fs-4 fw-bold mt-5 mb-3">9. Policy Updates</h2>
    <p class="text-muted-pc mb-0">The GDPR policy may be updated periodically.</p>

    <h2 id="contact" class="fs-4 fw-bold mt-5 mb-3">10. Contact</h2>
    <p class="text-muted-pc mb-0">Email: <a class="pc-form-link" href="mailto:info@powercabs.ie">info@powercabs.ie</a></p>

  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
