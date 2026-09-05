<?php
$pageTitle = 'Business Travel & Chauffeur Cars in Dublin | PowerCabs';
$pageDescription =
  'Reliable, discreet, and professional Business Rides and Limousine Services from PowerCabs -- built for executives, teams, and corporate travel across Dublin.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError = '';
$old = [
  'contact_name' => '',
  'business_name' => '',
  'business_email' => '',
  'phone' => '',
  'vat_number' => '',
  'employee_count' => '',
  'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($old as $key => $default) {
    $old[$key] = trim($_POST[$key] ?? '');
  }

  if (
    $old['contact_name'] === '' ||
    $old['business_name'] === '' ||
    $old['business_email'] === '' ||
    $old['phone'] === ''
  ) {
    $formStatus = 'error';
    $formError = 'Please fill in all required fields.';
  } elseif (!filter_var($old['business_email'], FILTER_VALIDATE_EMAIL)) {
    $formStatus = 'error';
    $formError = 'Please enter a valid email address.';
  } else {
    $body =
      "New business ride enquiry from the PowerCabs website.\n\n" .
      "Contact Name: {$old['contact_name']}\n" .
      "Business Name: {$old['business_name']}\n" .
      "Business Email: {$old['business_email']}\n" .
      "Phone Number: {$old['phone']}\n" .
      'VAT / Tax Number: ' .
      ($old['vat_number'] !== '' ? $old['vat_number'] : '-') .
      "\n" .
      'Number of Employees: ' .
      ($old['employee_count'] !== '' ? $old['employee_count'] : '-') .
      "\n\n" .
      "Additional Details:\n" .
      ($old['message'] !== '' ? $old['message'] : '-') .
      "\n";

    $result = pc_send_mail('Business account request: ' . $old['business_name'], $body, [
      'name' => $old['contact_name'],
      'email' => $old['business_email'],
    ]);

    if ($result['success']) {
      $formStatus = 'success';
      foreach ($old as $key => $default) {
        $old[$key] = '';
      }
    } else {
      $formStatus = 'error';
      $formError = 'Sorry, something went wrong sending your request. Please try again or call us directly.';
    }
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Business';
$heroTitleLight = 'Elevate Your';
$heroTitleBold = 'Business Travel.';
$heroDescription =
  'Reliable and luxurious transportation for your business needs, with the comfort and professionalism your clients expect.';
$heroBgImage = $assetPath . 'assets/img/services-corporate.jpg';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<!-- ============ Business Rides & Limousine Services (existing) ============ -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <div class="tw-aspect-[4/3] tw-overflow-hidden tw-rounded-2xl">
          <img src="<?= $assetPath ?>assets/img/Business_gif.gif" alt="PowerCabs business travel showcase"
            class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
        </div>
      </div>

      <div>
        <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Elevate Your Business Travel Experience</h2>
        <p class="tw-mb-4 tw-text-ink/60">
          We understand the importance of reliable and luxurious
          transportation for your business needs. Our Business Rides and Limousine
          Services are designed to provide the highest level of comfort, efficiency and professional travel experiences.
        </p>

        <p class="tw-mb-2 tw-font-semibold tw-text-ink">With PowerCabs, you can expect:</p>
        <ul class="tw-m-0 tw-mb-4 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0">
          <?php $businessExpectations = [
            'Professional drivers',
            'Discreet and punctual chauffeurs',
            'Luxury at every step',
            'Smooth rides for working while travelling',
          ]; ?>
          <?php foreach ($businessExpectations as $item): ?>
            <li class="tw-flex tw-gap-2">
              <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
              <span class="tw-text-ink/60"><?= htmlspecialchars($item) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="tw-bg-peach tw-shadow-[0_8px_20px_rgba(28,20,16,0.12)] tw-rounded-2xl tw-p-4">
          <p class="tw-mb-0">
            If your company has more than 7 employees, please visit our
            <a class="tw-text-power tw-transition-colors tw-duration-200 hover:tw-text-powerdark focus-visible:tw-text-powerdark tw-font-semibold" href="<?= $assetPath ?>/corporate-services">Corporate page</a>
            to explore our corporate travel solutions.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/business/trust-strip.php';
require __DIR__ . '/components/business/account-benefits.php';
require __DIR__ . '/components/business/services-grid.php';
require __DIR__ . '/components/business/airport-assistance.php';
require __DIR__ . '/components/business/ireland-parallax.php';
require __DIR__ . '/components/business/how-it-works.php';
require __DIR__ . '/components/business/booking-process.php';
?>

<?php
require __DIR__ . '/components/business/plans.php';
require __DIR__ . '/components/business/final-cta.php';
require __DIR__ . '/components/business/trust-proof.php';
require __DIR__ . '/components/shared/app-download-banner.php';
?>

<script src="<?= $assetPath ?>assets/js/components/business-page.js"></script>

<?php require __DIR__ . '/includes/footer.php'; ?>
