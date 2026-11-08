<?php
$pageTitle       = 'Privacy Policy | PowerCabs';
$pageDescription = "How PowerCabs Ireland Limited collects, uses, discloses and safeguards personal information - including location data used by the PowerCabs and PowerCabs Driver apps - and your rights regarding that information.";
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = 'Policies & Safety';
$heroTitleLight  = 'Privacy';
$heroTitleBold   = 'Policy.';
$heroDescription = 'How we collect, use, disclose and safeguard your personal information when you use the PowerCabs website and apps, including location data, and your rights regarding that information.';
$heroBgImage     = 'https://images.pexels.com/photos/4973899/pexels-photo-4973899.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroVariant = 'legal';
require __DIR__ . '/components/shared/inner-hero.php';

$ppNav = [
  ['id' => 'pp-info',      'label' => 'Information We Collect'],
  ['id' => 'pp-location',  'label' => 'Location Data'],
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

<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-12 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-3">
        <div class="tw-sticky tw-top-[100px]">
          <p class="<?= $pcEyebrow ?>">On This Page</p>
          <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0">
            <?php foreach ($ppNav as $item): ?>
              <li><a class="tw-block tw-border-0 tw-border-l-2 tw-border-solid tw-border-transparent tw-py-1.5 tw-pl-3 tw-text-sm tw-text-ink/[0.65] tw-transition-[color,border-color] tw-duration-200 hover:tw-border-l-power hover:tw-text-power focus-visible:tw-border-l-power focus-visible:tw-text-power" href="#<?= $item['id'] ?>"><?= $item['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="tw-max-w-[72ch] tw-leading-[1.75] [&_h2]:tw-scroll-mt-[100px] [&_h2]:tw-text-ink [&_p]:tw-text-ink/[0.65] [&_ul]:tw-text-ink/[0.65] lg:tw-col-span-9">
        <p class="tw-mb-4 tw-text-sm tw-text-ink/50">Last Updated: 4 November 2026</p>

        <p>PowerCabs Ireland Limited is committed to protecting and respecting your privacy. This Privacy Policy explains how personal information is collected, used, disclosed, and safeguarded, along with your rights regarding that information.</p>
        <p>It applies to the PowerCabs website at powercabs.ie and to both of our mobile applications: <strong>PowerCabs</strong>, the passenger app (<span class="tw-whitespace-nowrap">powercabs.dublin.taxi.passenger</span> on Google Play), and <strong>PowerCabs Driver</strong>, the driver app (<span class="tw-whitespace-nowrap">powercabs.dublin.taxi.driver</span> on Google Play), together with their equivalents on the App Store.</p>

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
          <li>Location data &mdash; see <a class="tw-font-semibold tw-text-power tw-no-underline tw-transition-colors tw-duration-200 hover:tw-text-powerdark" href="#pp-location">Location Data</a> below</li>
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

        <h2 id="pp-location" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">Location Data</h2>
        <p>PowerCabs is a taxi booking and dispatch service, so location is central to what we do: we cannot send a car to you, show you where it is, or price a journey without knowing where people and vehicles are. This section sets out exactly what location data we access, when, and why.</p>

        <p class="tw-mb-2 tw-font-semibold">What we collect</p>
        <p class="tw-mb-3">Depending on the permission you grant your device, we may access:</p>
        <ul class="tw-mb-4">
          <li><strong>Precise location</strong> &mdash; GPS or equivalent satellite positioning from your device, accurate to a few metres.</li>
          <li><strong>Approximate location</strong> &mdash; derived from your mobile network, Wi-Fi or IP address, accurate to roughly a town or district.</li>
        </ul>

        <p class="tw-mb-2 tw-font-semibold">Passengers &mdash; the PowerCabs app and website</p>
        <ul class="tw-mb-4">
          <li>When you choose to share your location, we read your current position to fill in your pickup point and to show nearby available vehicles.</li>
          <li>While a booking is active, we use your location to match you with the nearest suitable driver, to give the driver an accurate pickup point and to show you an arrival time.</li>
          <li>On the website, your position is read only at the moment you ask us to use it &mdash; for example when you tap to use your current location on a fare estimate. The website does not track you in the background.</li>
        </ul>

        <p class="tw-mb-2 tw-font-semibold">Drivers &mdash; the PowerCabs Driver app</p>
        <ul class="tw-mb-4">
          <li>While you are signed in and available for work, we collect your vehicle&rsquo;s position so that we can offer you nearby jobs, show the passenger where their car is, calculate distance, duration and fare, and support you if something goes wrong on a journey.</li>
          <li>Location is collected while the app is in use and, so that dispatch and live tracking keep working when your screen is off or you are using navigation, <strong>while the app is in the background during a shift</strong>. Collection stops when you go off duty or sign out.</li>
          <li>We do not collect your location when you are signed out of the driver app.</li>
        </ul>

        <p class="tw-mb-2 tw-font-semibold">Why we use it</p>
        <ul class="tw-mb-4">
          <li>Matching a booking to the nearest suitable driver and dispatching the vehicle.</li>
          <li>Showing live vehicle position and estimated arrival to the passenger during an active booking.</li>
          <li>Navigation, route guidance and recording the route actually travelled.</li>
          <li>Calculating distance, duration, fares, tolls and any applicable charges.</li>
          <li>Safety, incident investigation, lost property enquiries and resolving disputes about a journey.</li>
          <li>Meeting our obligations as a licensed dispatch operator and keeping the records those obligations require.</li>
        </ul>
        <p class="tw-mb-4">Our legal bases are performance of the contract for your journey and your consent to the device permission you grant, together with our legitimate interest in operating a safe and accountable service. Location data is never used for advertising or profiling, and it is never sold.</p>

        <p class="tw-mb-2 tw-font-semibold">Who it is shared with</p>
        <ul class="tw-mb-4">
          <li>The driver assigned to your booking sees your pickup and destination; you see that driver&rsquo;s vehicle position while the booking is active.</li>
          <li>Google Maps Platform processes map, address and routing requests on our behalf so that maps, address lookup and route calculation work.</li>
          <li>Authorities or law enforcement, only where we are legally required to disclose.</li>
        </ul>

        <p class="tw-mb-2 tw-font-semibold">How long we keep it</p>
        <p class="tw-mb-4">Live position is used to run the journey in progress and is not retained once that journey ends. The journey record itself &mdash; pickup, destination, route and times &mdash; is kept for as long as we need it to handle billing, receipts, support requests, complaints, lost property and disputes, and to meet legal, tax and licensing obligations, after which it is deleted or anonymised.</p>

        <p class="tw-mb-2 tw-font-semibold">Your control</p>
        <ul class="tw-mb-4">
          <li>You can grant, restrict or withdraw location permission at any time in your device settings &mdash; Settings &rsaquo; Apps &rsaquo; PowerCabs &rsaquo; Permissions on Android, or Settings &rsaquo; Privacy &amp; Security &rsaquo; Location Services on iOS &mdash; and in your browser&rsquo;s site settings for the website.</li>
          <li>Withdrawing permission does not affect processing already carried out, and you keep all the rights set out under <a class="tw-font-semibold tw-text-power tw-no-underline tw-transition-colors tw-duration-200 hover:tw-text-powerdark" href="#pp-rights">Your Rights</a> below.</li>
          <li>If you turn location off, parts of the service stop working: we cannot fill in your pickup point automatically, you will need to type an address instead, and a driver who turns location off cannot be offered or accept jobs.</li>
        </ul>

        <div class="tw-bg-peach tw-shadow-[0_8px_20px_rgba(28,20,16,0.12)] tw-mb-0 tw-rounded-2xl tw-p-6">
          <p class="tw-mb-2 tw-font-semibold">In short</p>
          <p class="tw-mb-0 tw-text-sm">PowerCabs accesses the location of passengers and of drivers in order to book, dispatch, navigate, track and price taxi journeys. Nothing about your location is sold, and nothing is used for advertising.</p>
        </div>

        <h2 id="pp-use" class="tw-mb-3 tw-mt-10 tw-text-2xl tw-font-bold">How We Use Your Information</h2>
        <p class="tw-mb-3">Collected information is used to:</p>
        <ul class="tw-mb-0">
          <li>Provide and manage services</li>
          <li>Book, dispatch, navigate, track and price taxi journeys using location data</li>
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
          <li>Exercise their rights in accordance with the GDPR - see the full <a class="tw-text-power tw-transition-colors tw-duration-200 hover:tw-text-powerdark focus-visible:tw-text-powerdark" href="<?= $assetPath ?>/gdpr">GDPR</a> page for details.</li>
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
$bannerCompact = true;
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
