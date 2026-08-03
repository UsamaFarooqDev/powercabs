<?php
$pageTitle       = 'Positive Feedback Form | PowerCabs';
$pageDescription = 'Had a great ride with PowerCabs? Tell us about it -- your feedback helps us recognise excellent drivers and service.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError  = '';
$old = ['role' => 'driver', 'name' => '', 'email' => '', 'rating' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $old['role']    = in_array($_POST['role'] ?? '', ['driver', 'passenger'], true) ? $_POST['role'] : 'driver';
    $old['name']    = trim($_POST['name'] ?? '');
    $old['email']   = trim($_POST['email'] ?? '');
    $old['rating']  = trim($_POST['rating'] ?? '');
    $old['message'] = trim($_POST['message'] ?? '');

    if ($old['name'] === '' || $old['email'] === '' || $old['message'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $body = "New positive feedback submission from the PowerCabs website.\n\n"
              . "Name: {$old['name']}\n"
              . "Email: {$old['email']}\n"
              . "Submitted as: " . ucfirst($old['role']) . "\n"
              . "Rating: " . ($old['rating'] !== '' ? $old['rating'] . ' / 5' : '-') . "\n\n"
              . "Feedback:\n{$old['message']}\n";

        $result = pc_send_mail(
            'Positive feedback: ' . $old['name'],
            $body,
            ['name' => $old['name'], 'email' => $old['email']]
        );

        if ($result['success']) {
            $formStatus = 'success';
            $old = ['role' => 'driver', 'name' => '', 'email' => '', 'rating' => '', 'message' => ''];
        } else {
            $formStatus = 'error';
            $formError  = 'Sorry, something went wrong sending your feedback. Please try again or call us directly.';
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Made Your Day?';
$heroTitleLight  = 'Share A';
$heroTitleBold   = 'Great Experience.';
$heroDescription = "Great service deserves a shout-out. Tell us what stood out and we'll make sure the right people hear about it.";
$heroBgImage     = 'https://images.pexels.com/photos/36763587/pexels-photo-36763587.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/inner-hero.php';
?>

<section class="section-pc">
  <div class="container">
    <div class="row gy-5">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why It Matters</p>
        <h2 class="mb-3" style="font-size: clamp(1.5rem, 2.5vw, 2rem);">Great Service Deserves Recognition</h2>
        <p class="text-muted-pc mb-4">
          Whether it was a driver who went the extra mile or a smooth, stress-free
          booking, we want to hear about it. Positive feedback goes straight to our
          team and is shared with the driver involved.
        </p>
        <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
          <li class="d-flex gap-3">
            <i class="bi bi-star-fill fs-5" style="color: var(--pc-orange);"></i>
            <span class="text-muted-pc">Rate your experience and tell us what stood out.</span>
          </li>
          <li class="d-flex gap-3">
            <i class="bi bi-people-fill fs-5" style="color: var(--pc-orange);"></i>
            <span class="text-muted-pc">Let us know if you're a rider or a driver -- helps us route it correctly.</span>
          </li>
          <li class="d-flex gap-3">
            <i class="bi bi-heart-fill fs-5" style="color: var(--pc-orange);"></i>
            <span class="text-muted-pc">Great feedback is shared with the driver and counts toward recognition.</span>
          </li>
        </ul>
      </div>

      <div class="col-lg-6 px-3 px-md-5">
        <?php if ($formStatus === 'success'): ?>
          <div class="alert alert-success" role="alert">Thanks for the kind words -- we'll make sure this gets seen.</div>
        <?php elseif ($formStatus === 'error'): ?>
          <div class="alert alert-danger" role="alert"><?= htmlspecialchars($formError) ?></div>
        <?php endif; ?>

        <form method="post" action="" class="row g-3">
          <div class="col-12">
            <span class="form-label d-block mb-2">I am a...</span>
            <div class="d-flex gap-2">
              <input type="radio" class="btn-check" id="pfRoleDriver" name="role" value="driver" autocomplete="off" <?= $old['role'] === 'driver' ? 'checked' : '' ?>>
              <label class="btn btn-outline-primary rounded-pill px-4" for="pfRoleDriver">Driver</label>

              <input type="radio" class="btn-check" id="pfRolePassenger" name="role" value="passenger" autocomplete="off" <?= $old['role'] === 'passenger' ? 'checked' : '' ?>>
              <label class="btn btn-outline-primary rounded-pill px-4" for="pfRolePassenger">Passenger</label>
            </div>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="pfName">Full Name</label>
            <input type="text" class="form-control" id="pfName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="pfEmail">Email Address</label>
            <input type="email" class="form-control" id="pfEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="pfRating">Rating</label>
            <select class="form-select" id="pfRating" name="rating">
              <option value="">Select a rating</option>
              <option value="5" <?= $old['rating'] === '5' ? 'selected' : '' ?>>&#9733;&#9733;&#9733;&#9733;&#9733; (5)</option>
              <option value="4" <?= $old['rating'] === '4' ? 'selected' : '' ?>>&#9733;&#9733;&#9733;&#9733; (4)</option>
              <option value="3" <?= $old['rating'] === '3' ? 'selected' : '' ?>>&#9733;&#9733;&#9733; (3)</option>
              <option value="2" <?= $old['rating'] === '2' ? 'selected' : '' ?>>&#9733;&#9733; (2)</option>
              <option value="1" <?= $old['rating'] === '1' ? 'selected' : '' ?>>&#9733; (1)</option>
            </select>
          </div>
          <div class="col-12">
            <label class="form-label" for="pfMessage">Your Message</label>
            <textarea class="form-control" id="pfMessage" name="message" rows="5" required><?= htmlspecialchars($old['message']) ?></textarea>
          </div>
          <div class="col-12 pt-2">
            <button type="submit" class="btn btn-pc-primary px-4">Send Feedback</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
