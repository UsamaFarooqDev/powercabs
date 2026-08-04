<?php
$pageTitle       = 'Contact Us | PowerCabs';
$pageDescription = 'Get in touch with the PowerCabs team -- general enquiries, support and business questions, answered fast.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null; // 'success' | 'error' | null
$formError  = '';
$old = ['first_name' => '', 'last_name' => '', 'email' => '', 'phone' => '', 'subject' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['first_name'] === '' || $old['last_name'] === '' || $old['email'] === '' || $old['subject'] === '' || $old['message'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $body = "New contact form submission from the PowerCabs website.\n\n"
              . "Name: {$old['first_name']} {$old['last_name']}\n"
              . "Email: {$old['email']}\n"
              . "Phone: " . ($old['phone'] !== '' ? $old['phone'] : '-') . "\n"
              . "Subject: {$old['subject']}\n\n"
              . "Message:\n{$old['message']}\n";

        $result = pc_send_mail(
            'Contact form: ' . $old['subject'],
            $body,
            ['name' => $old['first_name'] . ' ' . $old['last_name'], 'email' => $old['email']]
        );

        if ($result['success']) {
            $formStatus = 'success';
            foreach ($old as $key => $default) {
                $old[$key] = '';
            }
        } else {
            $formStatus = 'error';
            $formError  = 'Sorry, something went wrong sending your message. Please try again or call us directly.';
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Get In Touch';
$heroTitleLight  = "We're Here";
$heroTitleBold   = 'To Help, Anytime.';
$heroDescription = "Have a question about booking, billing, or partnering with PowerCabs? Send us a message and our team will get back to you shortly.";
$heroBgImage     = 'https://images.pexels.com/photos/8867176/pexels-photo-8867176.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<?php require __DIR__ . '/components/contact/contact-form.php'; ?>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
