<?php
$pageTitle       = 'Privacy Policy | PowerCabs';
$pageDescription = "How PowerCabs Ireland Limited collects, uses, discloses and safeguards personal information, and your rights regarding that information.";
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Policies & Safety';
$heroTitleLight  = 'Privacy';
$heroTitleBold   = 'Policy.';
$heroDescription = 'How we collect, use, disclose and safeguard your personal information when you visit the PowerCabs website, and your rights regarding that information.';
$heroBgImage     = 'https://images.pexels.com/photos/4973899/pexels-photo-4973899.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$ppNav = [
  ['id' => 'pp-info',      'label' => 'Information We Collect'],
  ['id' => 'pp-use',       'label' => 'How We Use Your Information'],
  ['id' => 'pp-cookies',   'label' => 'Cookies'],
  ['id' => 'pp-social',    'label' => 'Social Media'],
  ['id' => 'pp-storage',   'label' => 'Data Storage &amp; Disclosure'],
  ['id' => 'pp-security',  'label' => 'Data Security'],
  ['id' => 'pp-rights',    'label' => 'Your Rights'],
  ['id' => 'pp-managing',  'label' => 'Managing Cookies'],
  ['id' => 'pp-updates',   'label' => 'Policy Updates'],
];
?>

<section class="section-pc pt-5">
  <div class="container">
    <div class="row gy-5">
      <div class="col-lg-3">
        <div class="pc-tc-nav">
          <p class="small fw-semibold text-uppercase mb-3" style="letter-spacing: .06em; color: var(--pc-orange);">On This Page</p>
          <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
            <?php foreach ($ppNav as $item): ?>
              <li><a class="pc-tc-nav-link small" href="#<?= $item['id'] ?>"><?= $item['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="col-lg-9 pc-tc-body">
        <p class="small text-muted-pc mb-4">Last Updated: 31 May 2024</p>

        <p>PowerCabs Ireland Limited is committed to protecting and respecting your privacy. This Privacy Policy explains how personal information is collected, used, disclosed, and safeguarded when you visit the PowerCabs website, along with your rights regarding that information.</p>

        <h2 id="pp-info" class="fs-4 fw-bold mt-5 mb-3">Information We Collect</h2>
        <p class="fw-semibold mb-2">Personal Data</p>
        <p class="mb-3">PowerCabs may collect:</p>
        <ul class="mb-4">
          <li>Name</li>
          <li>Email address</li>
          <li>Phone number</li>
          <li>Address</li>
          <li>IP address</li>
          <li>Payment information (where applicable)</li>
        </ul>
        <p class="fw-semibold mb-2">Non-Personal Data</p>
        <p class="mb-3">PowerCabs may also collect:</p>
        <ul class="mb-0">
          <li>Browser type and version</li>
          <li>Operating system</li>
          <li>Referring website</li>
          <li>Pages visited</li>
          <li>Date and time of visit</li>
        </ul>

        <h2 id="pp-use" class="fs-4 fw-bold mt-5 mb-3">How We Use Your Information</h2>
        <p class="mb-3">Collected information is used to:</p>
        <ul class="mb-0">
          <li>Provide and manage services</li>
          <li>Process transactions and related communications</li>
          <li>Personalize the website experience</li>
          <li>Respond to enquiries and support requests</li>
          <li>Send technical notices, updates, and security alerts</li>
          <li>Monitor website usage and improve services</li>
          <li>Comply with Irish legal obligations</li>
        </ul>

        <h2 id="pp-cookies" class="fs-4 fw-bold mt-5 mb-3">Cookies</h2>
        <p>Cookies are small data files stored on a user's device by a web browser while browsing the website. PowerCabs uses cookies for session management, personalization, website analytics, and advertising and marketing purposes.</p>

        <p class="fw-semibold mb-2">Session Cookies</p>
        <p class="mb-3">Temporary cookies deleted when the browser is closed, used to manage website sessions.</p>
        <p class="fw-semibold mb-2">Persistent Cookies</p>
        <p class="mb-3">Stored for a defined period to remember user preferences and login details.</p>
        <p class="fw-semibold mb-2">Analytics Cookies</p>
        <p class="mb-4">Measure website usage to help improve user experience and website performance.</p>

        <div class="pc-panel rounded-4 p-4 mb-0">
          <p class="fw-semibold mb-2">Cookie Consent</p>
          <p class="small mb-0">PowerCabs follows GDPR requirements by providing explicit consent before non-essential cookies are placed, separate consent options for different cookie categories, and the ability to withdraw consent at any time using Reject All.</p>
        </div>

        <h2 id="pp-social" class="fs-4 fw-bold mt-5 mb-3">Social Media</h2>
        <p>When interacting with PowerCabs on social media platforms such as Facebook, Instagram, LinkedIn, X (Twitter), and YouTube, users are responsible for their own interactions, including comments, likes, messages, and shares. Personal data is processed only when users interact with PowerCabs through these platforms, based on user consent and legitimate interests for communication and public relations.</p>

        <h2 id="pp-storage" class="fs-4 fw-bold mt-5 mb-3">Data Storage &amp; Disclosure</h2>
        <ul class="mb-0">
          <li>Personal data is stored using cloud service providers within Ireland.</li>
          <li>Data may also be stored on internal company IT systems.</li>
          <li>Personal information is not sold to third parties.</li>
          <li>Information may be disclosed only when legally required by authorities or law enforcement.</li>
        </ul>

        <h2 id="pp-security" class="fs-4 fw-bold mt-5 mb-3">Data Security</h2>
        <p>PowerCabs applies technical and organizational security measures to protect personal data against unauthorized access, modification, loss, and destruction. Security practices are reviewed regularly to remain compliant with GDPR requirements. Personal data is retained only for as long as necessary to fulfill its intended purpose or meet legal obligations.</p>

        <h2 id="pp-rights" class="fs-4 fw-bold mt-5 mb-3">Your Rights</h2>
        <p class="mb-3">Users have the right to:</p>
        <ul class="mb-0">
          <li>Request confirmation that their personal data is being processed.</li>
          <li>Access their personal information.</li>
          <li>Exercise their rights in accordance with the GDPR -- see the full <a class="pc-form-link" href="<?= $assetPath ?>/gdpr.php">GDPR</a> page for details.</li>
        </ul>

        <h2 id="pp-managing" class="fs-4 fw-bold mt-5 mb-3">Managing Cookies</h2>
        <p class="mb-3">Users can manage cookies through their browser by:</p>
        <ul class="mb-0">
          <li>Viewing stored cookies</li>
          <li>Deleting cookies</li>
          <li>Blocking cookies</li>
          <li>Customizing cookie preferences according to their needs</li>
        </ul>

        <h2 id="pp-updates" class="fs-4 fw-bold mt-5 mb-3">Policy Updates</h2>
        <p class="mb-0">PowerCabs reserves the right to modify its Privacy Policy and Cookie Policy at any time to reflect changes in applicable laws or company regulations.</p>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
