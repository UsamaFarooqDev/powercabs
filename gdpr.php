<?php
$pageTitle = 'GDPR | PowerCabs';
$pageDescription =
  'How PowerCabs Ireland Limited processes personal data in compliance with the General Data Protection Regulation (GDPR).';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'Data Protection';
$heroTitleLight = 'General Data';
$heroTitleBold = 'Protection Regulation.';
$heroDescription =
  'PowerCabs is committed to protecting customer privacy and processing personal data in compliance with GDPR.';
$heroBgImage = 'https://images.pexels.com/photos/2882659/pexels-photo-2882659.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'GDPR';
$heroVariant = 'legal'; // §12: compact hero, straight into the useful content.
require __DIR__ . '/components/shared/inner-hero.php';

/* The ten section anchors already existed on this page's headings -- only the
   table of contents that uses them was missing, which is why this was the one
   legal page without the sticky ToC and update date its two siblings have
   (§20, Template D). Same markup and same labels-from-an-array pattern as
   privacy-policy.php and terms-conditions.php, so the three stay in step. */
$gdprNav = [
  ['id' => 'controller', 'label' => 'Data Controller'],
  ['id' => 'data', 'label' => 'Data Collected'],
  ['id' => 'purpose', 'label' => 'Purpose of Data'],
  ['id' => 'legal-basis', 'label' => 'Legal Basis'],
  ['id' => 'sharing', 'label' => 'Data Sharing'],
  ['id' => 'retention', 'label' => 'Data Retention'],
  ['id' => 'rights', 'label' => 'Your Rights'],
  ['id' => 'security', 'label' => 'Data Security'],
  ['id' => 'updates', 'label' => 'Policy Updates'],
  ['id' => 'contact', 'label' => 'Contact'],
];
?>

<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-12 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-3">
        <div class="tw-sticky tw-top-[100px]">
          <p class="<?= $pcEyebrow ?>">On This Page</p>
          <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0">
            <?php foreach ($gdprNav as $item): ?>
              <li><a class="tw-block tw-border-0 tw-border-l-2 tw-border-solid tw-border-transparent tw-py-1.5 tw-pl-3 tw-text-sm tw-text-ink/[0.65] tw-transition-[color,border-color] tw-duration-200 hover:tw-border-l-power hover:tw-text-power focus-visible:tw-border-l-power focus-visible:tw-text-power" href="#<?= $item['id'] ?>"><?= $item['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="tw-max-w-[72ch] tw-leading-[1.75] [&_h2]:tw-scroll-mt-[100px] [&_h2]:tw-text-ink [&_p]:tw-text-ink/[0.65] [&_ul]:tw-text-ink/[0.65] lg:tw-col-span-9">
        <p class="tw-mb-4 tw-text-sm tw-text-ink/50">Last Updated: 31 May 2024</p>

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

        <?php /* The other two legal pages close by pointing at their siblings
                 -- §20 asks for related policy links, and someone reading one
                 policy is the likeliest person to want the next. */ ?>
        <p class="tw-mb-0 tw-mt-10 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-pt-6 tw-text-sm tw-text-muted">
          See also:
          <a class="tw-font-semibold tw-text-power tw-no-underline hover:tw-underline" href="<?= $assetPath ?>/privacy-policy">Privacy Policy</a>
          and
          <a class="tw-font-semibold tw-text-power tw-no-underline hover:tw-underline" href="<?= $assetPath ?>/terms-conditions">Terms &amp; Conditions</a>.
        </p>
      </div>
    </div>
  </div>
</section>

<?php
$bannerCompact = true; // restrained: a legal page should not end on an orange panel
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
