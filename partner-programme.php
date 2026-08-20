<?php
$pageTitle = 'Partner Programme | PowerCabs';
$pageDescription =
  'Join the PowerCabs Partner Programme -- taxi operators, fleet owners and transport companies can grow their business on the PowerCabs network.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError = '';
$old = [
  'name' => '',
  'business_name' => '',
  'email' => '',
  'phone' => '',
  'fleet_size' => '',
  'city' => '',
  'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($old as $key => $default) {
    $old[$key] = trim($_POST[$key] ?? '');
  }

  if (
    $old['name'] === '' ||
    $old['business_name'] === '' ||
    $old['email'] === '' ||
    $old['phone'] === '' ||
    $old['city'] === ''
  ) {
    $formStatus = 'error';
    $formError = 'Please fill in all required fields.';
  } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $formStatus = 'error';
    $formError = 'Please enter a valid email address.';
  } else {
    $body =
      "New Partner Programme enquiry.\n\n" .
      "Name: {$old['name']}\n" .
      "Business Name: {$old['business_name']}\n" .
      "Email: {$old['email']}\n" .
      "Phone: {$old['phone']}\n" .
      'Fleet Size: ' .
      ($old['fleet_size'] !== '' ? $old['fleet_size'] : '-') .
      "\n" .
      "City: {$old['city']}\n\n" .
      "Message:\n" .
      ($old['message'] !== '' ? $old['message'] : '-') .
      "\n";

    $result = pc_send_mail('Partner Programme enquiry: ' . $old['business_name'], $body, [
      'name' => $old['name'],
      'email' => $old['email'],
    ]);

    if ($result['success']) {
      $formStatus = 'success';
      foreach ($old as $key => $default) {
        $old[$key] = '';
      }
    } else {
      $formStatus = 'error';
      $formError = 'Sorry, something went wrong sending your enquiry. Please try again or call us directly.';
    }
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Business';
$heroTitleLight  = 'Partner';
$heroTitleBold   = 'Programme.';
$heroDescription = 'PowerCabs welcomes taxi operators, fleet owners, and business partners to join the growing transportation network and expand their business opportunities.';
$heroBgImage     = 'https://images.pexels.com/photos/36712857/pexels-photo-36712857.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

require __DIR__ . '/components/partner/hero.php';

require __DIR__ . '/components/partner/campaign.php';
require __DIR__ . '/components/partner/growth.php';
require __DIR__ . '/components/partner/process.php';
require __DIR__ . '/components/partner/enquiry.php';
?>

<script src="<?= $assetPath ?>assets/js/components/partner-page.js"></script>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
