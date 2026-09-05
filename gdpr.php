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

<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-max-w-[800px] tw-leading-[1.75]">

    <h2 id="controller" class="tw-mb-3 tw-text-2xl tw-font-bold">1. Data Controller</h2>
    <ul class="tw-text-ink/60">
      <li>PowerCabs Ireland Limited</li>
      <li>Contact: <a class="tw-text-power tw-transition-colors tw-duration-200 hover:tw-text-powerdark focus-visible:tw-text-powerdark" href="mailto:info@powercabs.ie">info@powercabs.ie</a></li>
    </ul>

    <h2 id="data" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">2. Data Collected</h2>
    <p class="tw-mb-2 tw-font-semibold">Personal Data</p>
    <ul class="tw-mb-4 tw-text-ink/60">
      <li>Name</li><li>Email</li><li>Phone</li><li>Address</li>
    </ul>
    <p class="tw-mb-2 tw-font-semibold">Booking Data</p>
    <ul class="tw-mb-4 tw-text-ink/60">
      <li>Pickup</li><li>Destination</li><li>Ride date</li><li>Payment details</li>
    </ul>
    <p class="tw-mb-2 tw-font-semibold">Usage Data</p>
    <ul class="tw-mb-4 tw-text-ink/60">
      <li>IP address</li><li>Browser</li><li>Device information</li>
    </ul>
    <p class="tw-mb-2 tw-font-semibold">Feedback</p>
    <ul class="tw-mb-0 tw-text-ink/60">
      <li>Reviews</li><li>Customer comments</li>
    </ul>

    <h2 id="purpose" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">3. Purpose of Data</h2>
    <ul class="tw-mb-0 tw-text-ink/60">
      <li>Process bookings</li>
      <li>Customer support</li>
      <li>Marketing (with consent)</li>
      <li>Improve services</li>
      <li>Legal compliance</li>
    </ul>

    <h2 id="legal-basis" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">4. Legal Basis</h2>
    <ul class="tw-mb-0 tw-text-ink/60">
      <li>Contract</li>
      <li>Consent</li>
      <li>Legitimate Interest</li>
      <li>Legal Obligation</li>
    </ul>

    <h2 id="sharing" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">5. Data Sharing</h2>
    <ul class="tw-mb-0 tw-text-ink/60">
      <li>Payment providers</li>
      <li>IT providers</li>
      <li>Legal authorities</li>
      <li>Business transfers</li>
    </ul>

    <h2 id="retention" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">6. Data Retention</h2>
    <p class="tw-mb-0 tw-text-ink/60">Personal information is retained only as long as necessary to meet legal and operational requirements.</p>

    <h2 id="rights" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">7. User Rights</h2>
    <ul class="tw-mb-0 tw-text-ink/60">
      <li>Access</li>
      <li>Rectification</li>
      <li>Erasure</li>
      <li>Restriction</li>
      <li>Portability</li>
      <li>Object to processing</li>
    </ul>

    <h2 id="security" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">8. Data Security</h2>
    <ul class="tw-mb-0 tw-text-ink/60">
      <li>Encryption</li>
      <li>Secure servers</li>
      <li>Regular security reviews</li>
    </ul>

    <h2 id="updates" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">9. Policy Updates</h2>
    <p class="tw-mb-0 tw-text-ink/60">The GDPR policy may be updated periodically.</p>

    <h2 id="contact" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">10. Contact</h2>
    <p class="tw-mb-0 tw-text-ink/60">Email: <a class="tw-text-power tw-transition-colors tw-duration-200 hover:tw-text-powerdark focus-visible:tw-text-powerdark" href="mailto:info@powercabs.ie">info@powercabs.ie</a></p>

  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
