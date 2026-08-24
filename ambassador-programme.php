<?php
$pageTitle       = 'Ambassador Programme | PowerCabs';
$pageDescription = 'Join the PowerCabs Ambassador Programme -- free card terminals, exclusive vehicle branding, fuel discounts, extra loyalty points and dedicated support.';
$assetPath       = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError  = '';
$old = ['name' => '', 'email' => '', 'phone' => '', 'affiliated_with' => '', 'registered_with_powercabs' => '', 'license_number' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['name'] === '' || $old['email'] === '' || $old['phone'] === '' || $old['registered_with_powercabs'] === '' || $old['license_number'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $body = "New Ambassador Programme registration.\n\n"
              . "Name: {$old['name']}\n"
              . "Email: {$old['email']}\n"
              . "Phone: {$old['phone']}\n"
              . "Currently Affiliated With: " . ($old['affiliated_with'] !== '' ? $old['affiliated_with'] : '-') . "\n"
              . "Registered with PowerCabs: {$old['registered_with_powercabs']}\n"
              . "License Number: {$old['license_number']}\n";

        $result = pc_send_mail(
            'Ambassador Programme registration: ' . $old['name'],
            $body,
            ['name' => $old['name'], 'email' => $old['email']]
        );

        if ($result['success']) {
            $formStatus = 'success';
            foreach ($old as $key => $default) {
                $old[$key] = '';
            }
        } else {
            $formStatus = 'error';
            $formError  = 'Sorry, something went wrong sending your registration. Please try again or call us directly.';
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Drivers';
$heroTitleLight  = 'Become a PowerCabs';
$heroTitleBold   = 'Ambassador.';
$heroDescription = "Earn More. Spend Less. Be Valued. Join Ireland's most driver-focused ride platform.";
$heroBgImage     = 'https://images.pexels.com/photos/16702626/pexels-photo-16702626.jpeg?auto=compress&cs=tinysrgb&w=1600';
require __DIR__ . '/components/shared/inner-hero.php';

require __DIR__ . '/components/ambassador/benefits.php';
require __DIR__ . '/components/ambassador/journey.php';
require __DIR__ . '/components/ambassador/registration.php';
?>

<script src="<?= $assetPath ?>assets/js/components/ambassador-page.js"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-select.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-select.js',
) ?>"></script>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
