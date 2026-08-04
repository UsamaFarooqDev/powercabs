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
require __DIR__ . '/components/inner-hero.php';
?>

<section class="section-pc">
  <div class="container">
    <div class="row gy-5">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Talk To Us</p>
        <h2 class="mb-3" style="font-size: clamp(1.5rem, 2.5vw, 2rem);">We'd Love to Hear From You</h2>
        <p class="text-muted-pc mb-4">
          Whether it's a question about a booking, a business enquiry, or feedback on
          the app, our team reads every message and typically replies within one
          working day.
        </p>
        <div class="d-flex flex-column gap-3">
          <div class="d-flex gap-3">
            <i class="bi bi-geo-alt-fill fs-5" style="color: var(--pc-orange);"></i>
            <span>
              <span class="d-block fw-semibold">Office Address</span>
              <span class="d-block text-muted-pc">Kylmore Road, Inchicore, Dublin D10 K729</span>
            </span>
          </div>
          <div class="d-flex gap-3">
            <i class="bi bi-receipt fs-5" style="color: var(--pc-orange);"></i>
            <span>
              <span class="d-block fw-semibold">Tax Number</span>
              <span class="d-block text-muted-pc">04301619NH</span>
            </span>
          </div>
          <div class="d-flex gap-3">
            <i class="bi bi-patch-check-fill fs-5" style="color: var(--pc-orange);"></i>
            <span>
              <span class="d-block fw-semibold">NTA License</span>
              <span class="d-block text-muted-pc">DH12616</span>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="bg-white rounded-5 p-3 p-md-5" style="box-shadow: var(--pc-shadow-md);">
          <form method="post" action="" class="row g-2">
            <div class="col-md-6">
              <label class="form-label mb-1" for="cuFirstName">First Name</label>
              <input type="text" class="form-control" id="cuFirstName" name="first_name" value="<?= htmlspecialchars($old['first_name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label mb-1" for="cuLastName">Last Name</label>
              <input type="text" class="form-control" id="cuLastName" name="last_name" value="<?= htmlspecialchars($old['last_name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label mb-1" for="cuEmail">Email Address</label>
              <input type="email" class="form-control" id="cuEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label mb-1" for="cuPhone">Phone Number</label>
              <input type="tel" class="form-control" id="cuPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>">
            </div>
            <div class="col-12">
              <label class="form-label mb-1" for="cuSubject">Subject</label>
              <input type="text" class="form-control" id="cuSubject" name="subject" value="<?= htmlspecialchars($old['subject']) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label mb-1" for="cuMessage">Message</label>
              <textarea class="form-control" id="cuMessage" name="message" rows="3" required><?= htmlspecialchars($old['message']) ?></textarea>
            </div>
            <div class="col-12 pt-1">
              <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
                <span>Send Message</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your message has been sent. We'll get back to you shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
