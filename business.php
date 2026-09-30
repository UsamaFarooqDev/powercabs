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

$pageService = [
  'name' => 'Business Travel and Chauffeur Cars',
  'serviceType' => 'Corporate transport',
  'description' =>
    'Executive travel for meetings, client visits and airport runs, with professional drivers and vehicles suited to business journeys.',
];

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'Business';
$heroTitleLight = 'Move your people.';
$heroTitleBold = 'Not your paperwork.';
$heroDescription =
  'One account for your whole team, one monthly invoice, and full visibility of every journey booked.';
require __DIR__ . '/components/business/hero.php';
?>

<?php
require __DIR__ . '/components/business/trust-strip.php';
require __DIR__ . '/components/business/account-benefits.php';
require __DIR__ . '/components/business/services-grid.php';
require __DIR__ . '/components/business/plans.php';

$supportEyebrow = 'Business Support';
$supportHeading = 'Prefer to talk it through?';
$supportText =
  'Call the PowerCabs business team about opening an account, monthly invoicing or booking travel for your team.';
$supportNumber = '+353 89 958 6092';
$supportTel = '+353899586092';
$supportHours = 'Business support is available 24/7, every day of the year.';
$supportWhatsapp = 'https://wa.me/353899586092';
/* colleagues in a meeting -- this band is the BUSINESS line. The band stays dark; this only replaces the flat fill behind
   the scrim. See components/shared/support-band.php. */
$supportImage = 'https://images.pexels.com/photos/7433846/pexels-photo-7433846.jpeg?auto=compress&cs=tinysrgb&w=1600';
require __DIR__ . '/components/shared/support-band.php';

require __DIR__ . '/components/business/trust-proof.php';

// Replaces components/business/final-cta.php, which was a page-local copy of
// the same closing block every other page now shares.
/* Not "Open a business account" any more: the form section further up now
   carries that as its heading, and the two ran as an echo a screen apart.
   This closes on the outcome instead, which is what the page has been arguing
   for throughout -- and it is the hero's promise said once more at the end. */
$ctaTitle = 'Move your people, not your paperwork.';
$ctaText = 'One account, one invoice, and a team in Dublin that answers the phone.';
$ctaPrimary = ['href' => '/business#bizAccountForm', 'label' => 'Request an Account'];
$ctaSecondary = ['href' => '/contact-us', 'label' => 'Talk to Sales'];

/* Restructured from copy already on this page -- see
   components/shared/faq-accordion.php on why answers may not be invented. */
$faqItems = [
  ['q' => 'How does billing work?', 'a' => 'Keep every business journey on one consolidated invoice, with no hidden charges.'],
  ['q' => 'Can I see what the team is spending?', 'a' => 'See journeys, spend and activity across your whole organisation as it happens.'],
  ['q' => 'Can more than one person book?', 'a' => 'Yes — multiple users can book against the same business account.'],
  ['q' => 'Is there support for business accounts?', 'a' => 'Corporate support is part of the account, alongside priority booking and ride history.'],
];
$faqEyebrow = 'Business travel';
$faqHeading = 'Business questions.';
$faqLayout = 'split';
$faqMoreHref = '/faqs';
$faqSurface = 'soft'; // alternates against the white section above it
require __DIR__ . '/components/shared/faq-accordion.php';
require __DIR__ . '/components/shared/final-cta.php';
$bannerCompact = true; // §30: this page already closes with its own CTA.
require __DIR__ . '/components/shared/app-download-banner.php';
?>

<script src="<?= $assetPath ?>assets/js/components/business-page.js?v=<?= @filemtime(__DIR__ . '/assets/js/components/business-page.js') ?>"></script>

<?php require __DIR__ . '/includes/footer.php'; ?>
