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

<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-gap-12 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-3">
        <div class="tw-sticky tw-top-[100px]">
          <p class="tw-mb-3 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">On This Page</p>
          <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0">
            <?php foreach ($ppNav as $item): ?>
              <li><a class="tw-block tw-border-0 tw-border-l-2 tw-border-solid tw-border-transparent tw-py-[0.15rem] tw-pl-3 tw-text-sm tw-text-ink/[0.65] tw-transition-[color,border-color] tw-duration-200 hover:tw-border-l-power hover:tw-text-power focus-visible:tw-border-l-power focus-visible:tw-text-power" href="#<?= $item['id'] ?>"><?= $item['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="tw-max-w-[72ch] tw-leading-[1.75] [&_h2]:tw-scroll-mt-[100px] [&_h2]:tw-text-ink [&_p]:tw-text-ink/[0.65] [&_ul]:tw-text-ink/[0.65] lg:tw-col-span-9">
        <p class="tw-mb-4 tw-text-sm tw-text-ink/50">Last Updated: 31 May 2024</p>

        <p>PowerCabs Ireland Limited is committed to protecting and respecting your privacy. This Privacy Policy explains how personal information is collected, used, disclosed, and safeguarded when you visit the PowerCabs website, along with your rights regarding that information.</p>

        <h2 id="pp-info" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Information We Collect</h2>
        <p class="tw-mb-2 tw-font-semibold">Personal Data</p>
        <p class="tw-mb-3">PowerCabs may collect:</p>
        <ul class="tw-mb-4">
          <li>Name</li>
          <li>Email address</li>
          <li>Phone number</li>
          <li>Address</li>
          <li>IP address</li>
          <li>Payment information (where applicable)</li>
        </ul>
        <p class="tw-mb-2 tw-font-semibold">Non-Personal Data</p>
        <p class="tw-mb-3">PowerCabs may also collect:</p>
        <ul class="tw-mb-0">
          <li>Browser type and version</li>
          <li>Operating system</li>
          <li>Referring website</li>
          <li>Pages visited</li>
          <li>Date and time of visit</li>
        </ul>

        <h2 id="pp-use" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">How We Use Your Information</h2>
        <p class="tw-mb-3">Collected information is used to:</p>
        <ul class="tw-mb-0">
          <li>Provide and manage services</li>
          <li>Process transactions and related communications</li>
          <li>Personalize the website experience</li>
          <li>Respond to enquiries and support requests</li>
          <li>Send technical notices, updates, and security alerts</li>
          <li>Monitor website usage and improve services</li>
          <li>Comply with Irish legal obligations</li>
        </ul>

        <h2 id="pp-cookies" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Cookies</h2>
        <p>Cookies are small data files stored on a user's device by a web browser while browsing the website. PowerCabs uses cookies for session management, personalization, website analytics, and advertising and marketing purposes.</p>

        <p class="tw-mb-2 tw-font-semibold">Session Cookies</p>
        <p class="tw-mb-3">Temporary cookies deleted when the browser is closed, used to manage website sessions.</p>
        <p class="tw-mb-2 tw-font-semibold">Persistent Cookies</p>
        <p class="tw-mb-3">Stored for a defined period to remember user preferences and login details.</p>
        <p class="tw-mb-2 tw-font-semibold">Analytics Cookies</p>
        <p class="tw-mb-4">Measure website usage to help improve user experience and website performance.</p>

        <div class="tw-bg-peach tw-shadow-[0_8px_20px_rgba(28,20,16,0.12)] tw-mb-0 tw-rounded-2xl tw-p-6">
          <p class="tw-mb-2 tw-font-semibold">Cookie Consent</p>
          <p class="tw-mb-0 tw-text-sm">PowerCabs follows GDPR requirements by providing explicit consent before non-essential cookies are placed, separate consent options for different cookie categories, and the ability to withdraw consent at any time using Reject All.</p>
        </div>

        <h2 id="pp-social" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Social Media</h2>
        <p>When interacting with PowerCabs on social media platforms such as Facebook, Instagram, LinkedIn, X (Twitter), and YouTube, users are responsible for their own interactions, including comments, likes, messages, and shares. Personal data is processed only when users interact with PowerCabs through these platforms, based on user consent and legitimate interests for communication and public relations.</p>

        <h2 id="pp-storage" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Data Storage &amp; Disclosure</h2>
        <ul class="tw-mb-0">
          <li>Personal data is stored using cloud service providers within Ireland.</li>
          <li>Data may also be stored on internal company IT systems.</li>
          <li>Personal information is not sold to third parties.</li>
          <li>Information may be disclosed only when legally required by authorities or law enforcement.</li>
        </ul>

        <h2 id="pp-security" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Data Security</h2>
        <p>PowerCabs applies technical and organizational security measures to protect personal data against unauthorized access, modification, loss, and destruction. Security practices are reviewed regularly to remain compliant with GDPR requirements. Personal data is retained only for as long as necessary to fulfill its intended purpose or meet legal obligations.</p>

        <h2 id="pp-rights" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Your Rights</h2>
        <p class="tw-mb-3">Users have the right to:</p>
        <ul class="tw-mb-0">
          <li>Request confirmation that their personal data is being processed.</li>
          <li>Access their personal information.</li>
          <li>Exercise their rights in accordance with the GDPR -- see the full <a class="tw-text-power tw-transition-colors tw-duration-200 hover:tw-text-powerdark focus-visible:tw-text-powerdark" href="<?= $assetPath ?>/gdpr">GDPR</a> page for details.</li>
        </ul>

        <h2 id="pp-managing" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Managing Cookies</h2>
        <p class="tw-mb-3">Users can manage cookies through their browser by:</p>
        <ul class="tw-mb-0">
          <li>Viewing stored cookies</li>
          <li>Deleting cookies</li>
          <li>Blocking cookies</li>
          <li>Customizing cookie preferences according to their needs</li>
        </ul>

        <h2 id="pp-updates" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Policy Updates</h2>
        <p class="tw-mb-0">PowerCabs reserves the right to modify its Privacy Policy and Cookie Policy at any time to reflect changes in applicable laws or company regulations.</p>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
