<?php
$pageTitle = 'Card Payment Terminals for Taxi Drivers | PowerCabs';
$pageDescription =
  'Business transportation solutions for companies seeking reliable, professional, and efficient travel services for employees and clients.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError = '';
$old = [
  'beneficial_owner' => '',
  'taxi_driver' => '',
  'title' => '',
  'first_name' => '',
  'last_name' => '',
  'email' => '',
  'dob' => '',
  'nationality' => '',
  'iban' => '',
  'account_name' => '',
  'bank' => '',
  'address_same_as_statement' => '',
  'device_type' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($old as $key => $default) {
    $old[$key] = trim($_POST[$key] ?? '');
  }

  $requiredMissing =
    $old['beneficial_owner'] === '' ||
    $old['taxi_driver'] === '' ||
    $old['first_name'] === '' ||
    $old['last_name'] === '' ||
    $old['email'] === '' ||
    $old['dob'] === '' ||
    $old['nationality'] === '' ||
    $old['iban'] === '' ||
    $old['account_name'] === '' ||
    $old['bank'] === '' ||
    $old['address_same_as_statement'] === '' ||
    $old['device_type'] === '';

  $dobObj = $old['dob'] !== '' ? DateTime::createFromFormat('Y-m-d', $old['dob']) : false;
  $ibanOk = (bool) preg_match('/^[A-Z]{2}[0-9]{2}[A-Z0-9]{10,30}$/', strtoupper(str_replace(' ', '', $old['iban'])));

  if ($requiredMissing) {
    $formStatus = 'error';
    $formError = 'Please fill in all required fields.';
  } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $formStatus = 'error';
    $formError = 'Please enter a valid email address.';
  } elseif (!$dobObj) {
    $formStatus = 'error';
    $formError = 'Please enter a valid date of birth.';
  } elseif ((new DateTime())->diff($dobObj)->y < 18) {
    $formStatus = 'error';
    $formError = 'You must be at least 18 years old to apply.';
  } elseif (!$ibanOk) {
    $formStatus = 'error';
    $formError = 'Please enter a valid IBAN.';
  } elseif (empty($_FILES['bank_statement']['tmp_name']) || $_FILES['bank_statement']['error'] !== UPLOAD_ERR_OK) {
    $formStatus = 'error';
    $formError = 'Please upload a bank statement.';
  } else {
    $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
    $mime = mime_content_type($_FILES['bank_statement']['tmp_name']);

    if (!in_array($mime, $allowedMime, true) || $_FILES['bank_statement']['size'] > 5 * 1024 * 1024) {
      $formStatus = 'error';
      $formError = 'Bank statement upload must be a JPG, PNG, WEBP or PDF under 5MB.';
    } else {
      $fullName = trim($old['title'] . ' ' . $old['first_name'] . ' ' . $old['last_name']);
      $body =
        "New PowerCabs Payment Solutions application.\n\n" .
        'Beneficial Owner: ' .
        ucfirst($old['beneficial_owner']) .
        "\n" .
        'Taxi Driver: ' .
        ucfirst($old['taxi_driver']) .
        "\n" .
        "Name: {$fullName}\n" .
        "Email: {$old['email']}\n" .
        "Date of Birth: {$old['dob']}\n" .
        "Nationality: {$old['nationality']}\n\n" .
        'IBAN: ' .
        strtoupper(str_replace(' ', '', $old['iban'])) .
        "\n" .
        "Account Name: {$old['account_name']}\n" .
        "Bank: {$old['bank']}\n" .
        'Permanent address same as bank statement: ' .
        ucfirst($old['address_same_as_statement']) .
        "\n\n" .
        "Device Type: {$old['device_type']}\n";

      $result = pc_send_mail(
        'Payment Solutions application: ' . $fullName,
        $body,
        ['name' => $fullName, 'email' => $old['email']],
        [
          [
            'tmp_path' => $_FILES['bank_statement']['tmp_name'],
            'filename' => basename($_FILES['bank_statement']['name']),
            'mime' => $mime,
          ],
        ],
      );

      if ($result['success']) {
        $formStatus = 'success';
        foreach ($old as $key => $default) {
          $old[$key] = '';
        }
      } else {
        $formStatus = 'error';
        $formError = 'Sorry, something went wrong sending your application. Please try again or call us directly.';
      }
    }
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Business Solutions';
$heroTitleLight = 'PowerCabs';
$heroTitleBold = 'Business Solutions.';
$heroDescription =
  'Business transportation solutions for companies seeking reliable, professional, and efficient travel services for employees and clients.';
$heroBgImage = 'https://images.pexels.com/photos/7108210/pexels-photo-7108210.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<?php
// ============ Payment Solutions (NPI card terminal partnership) ============
require __DIR__ . '/components/business/payment-solutions/intro.php';
require __DIR__ . '/components/business/payment-solutions/how-to-apply.php';
require __DIR__ . '/components/business/payment-solutions/solutions.php';
require __DIR__ . '/components/business/payment-solutions/pricing.php';
require __DIR__ . '/components/business/payment-solutions/apply-form.php';
require __DIR__ . '/components/business/payment-solutions/testimonials.php';
?>

<script src="<?= $assetPath ?>assets/js/components/custom-select.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-select.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-datetime.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-datetime.js',
) ?>"></script>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
