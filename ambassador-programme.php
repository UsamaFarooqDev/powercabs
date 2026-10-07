<?php
$pageTitle       = 'Ambassador Programme | PowerCabs';
$pageDescription = 'Join the PowerCabs Ambassador Programme - free card terminals, exclusive vehicle branding, fuel discounts, extra loyalty points and dedicated support.';
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

$heroEyebrow     = 'Drivers';
$heroTitleLight  = 'Become a PowerCabs';
$heroTitleBold   = 'Ambassador.';
$heroDescription = "Earn More. Spend Less. Be Valued. Join Ireland's most driver-focused ride platform.";
/* The previous frame was a portrait head-and-shoulders of a man at the wheel,
   and its alt text described something else entirely ("talking with a
   colleague beside their car") -- the two had drifted apart, so a screen
   reader was being told about a scene that is not in the picture.

   This one is landscape, which is what the 'split' hero frame actually wants,
   and it shows the thing the page is about: a driver standing at the open door
   of a black saloon. The alt text below describes THIS image. Keep the two in
   step if it is swapped again. */
$heroBgImage     = 'https://images.pexels.com/photos/15774577/pexels-photo-15774577.jpeg?auto=compress&cs=tinysrgb&w=1600';
$heroVariant = 'split';
$heroImageAlt = 'A PowerCabs driver holding the door open for a passenger stepping out of a black car';
require __DIR__ . '/components/shared/inner-hero.php';

?>
<div>
  <?php
  require __DIR__ . '/components/ambassador/benefits.php';
  /* Between the benefits and the application form: an ambassador is a driver
     first, so "where do the jobs come from" belongs with what they get, and
     directly before the form that asks them to sign up. */
  require __DIR__ . '/components/shared/booking-sources.php';
  require __DIR__ . '/components/ambassador/registration.php';
  ?>
</div>
<?php
?>

<script src="<?= $assetPath ?>assets/js/components/ambassador-page.js?v=<?= @filemtime(__DIR__ . '/assets/js/components/ambassador-page.js') ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-select.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-select.js',
) ?>"></script>

<?php

$ctaTitle = 'Represent PowerCabs on the road.';
/* Condensed from the supplied copy rather than carried over whole: the source
   ran to three paragraphs, and $ctaText is one line under a heading. The three
   points it actually made -- visibility, a growing network, and what that is
   for -- survive; the restatement of the perks did not, because the benefits
   section higher up this page already lists every one of them. */
$ctaText =
  'More visibility, more customers, more opportunities. As the network grows so does the work coming your way, so you spend less time chasing jobs and more time with the people you are doing it for.';
$ctaPrimary = ['href' => '/ambassador-programme#pcAmbRegister', 'label' => 'Apply Now'];
$ctaSecondary = ['href' => '/drive', 'label' => 'Drive with PowerCabs'];
require __DIR__ . '/components/shared/final-cta.php';
$bannerCompact = true; // §30: this page already closes with its own CTA.
/* Driver-facing copy for a driver-facing page -- the shared default talks to
   the passenger ("track your driver door to door"), which is the wrong reader
   here. "part of the family" rather than the supplied "you are a family",
   which reads as addressing a group when it is addressing one driver. */
$bannerTitle = 'Get the PowerCabs Driver app';
// Literal em dash, not &mdash;: both of these are printed through
// htmlspecialchars(), which would escape the entity and show it as text.
$bannerText = "With PowerCabs you are not just a driver \u{2014} you are part of the family.";
require __DIR__ . '/components/shared/app-download-banner.php';

require __DIR__ . '/includes/footer.php';
?>
