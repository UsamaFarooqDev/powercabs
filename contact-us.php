<?php
$pageTitle       = 'Contact Us | PowerCabs';
// 141 chars. The previous one ran to 105, which left Google padding the
// snippet from the page body; naming Dublin and the actual reasons someone
// contacts a taxi company gives the result something to match on.
$pageDescription = 'Contact the PowerCabs team in Dublin by phone, email or message -- ride support, lost property, complaints and business account enquiries.';
$assetPath       = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null; // 'success' | 'error' | null
$formError  = '';
$old = ['first_name' => '', 'last_name' => '', 'email' => '', 'phone' => '', 'subject' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['email'] === '' || $old['message'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $fullName = trim($old['first_name'] . ' ' . $old['last_name']);

        $body = "New contact form submission from the PowerCabs website.\n\n"
              . "Name: " . ($fullName !== '' ? $fullName : '-') . "\n"
              . "Email: {$old['email']}\n"
              . "Phone: " . ($old['phone'] !== '' ? $old['phone'] : '-') . "\n"
              . "Subject: " . ($old['subject'] !== '' ? $old['subject'] : '-') . "\n\n"
              . "Message:\n{$old['message']}\n";

        $result = pc_send_mail(
            'Contact form: ' . ($old['subject'] !== '' ? $old['subject'] : 'General enquiry'),
            $body,
            ['name' => $fullName !== '' ? $fullName : $old['email'], 'email' => $old['email']]
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

<?php /* Three specific forms exist for three specific jobs, and until now
         nothing on this page pointed at any of them -- they were reachable
         only from the footer. That was a real dead end, not just a missing
         link: the FAQ page tells passengers to "submit a Lost Item request
         through the Contact page", and the Contact page had no such route.

         It also fixes the only three pages on the site with no contextual
         inbound link at all. The anchor text describes the destination
         rather than repeating a keyword. */ ?>
<section class="<?= $pcSectionTight ?> tw-bg-paper">
  <div class="<?= $pcContainerNarrow ?>">
    <div class="tw-mb-6 tw-text-center">
      <h2 class="<?= $pcH2 ?>">Something more specific?</h2>
      <p class="tw-mx-auto tw-mb-0 tw-max-w-[52ch] tw-text-ink/60">
        These go straight to the right team, so they are handled faster than a
        general message.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-3">
      <?php foreach (
        [
          [
            'href' => '/lost-item-report',
            'title' => 'Report a lost item',
            'desc' => 'Left something in a PowerCabs vehicle? Send us the journey details.',
          ],
          [
            'href' => '/complaint-form',
            'title' => 'Make a complaint',
            'desc' => 'Tell us what went wrong with a ride and we will investigate it.',
          ],
          [
            'href' => '/positive-feedback-form',
            'title' => 'Leave feedback',
            'desc' => 'Had a great trip? Let us know so we can pass it on to your driver.',
          ],
        ]
        as $route
      ): ?>
        <a class="<?= $pcCard ?> <?= $pcCardHover ?> tw-group tw-flex tw-flex-col tw-no-underline"
          href="<?= $assetPath . $route['href'] ?>">
          <span class="tw-mb-1.5 tw-flex tw-items-center tw-gap-1.5 tw-text-base tw-font-bold tw-text-ink tw-transition-colors tw-duration-200 group-hover:tw-text-power">
            <?= htmlspecialchars($route['title']) ?>
            <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-transition-transform tw-duration-200 group-hover:tw-translate-x-0.5 motion-reduce:tw-transition-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </span>
          <span class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars(
            $route['desc'],
          ) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
