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
require __DIR__ . '/components/shared/inner-hero.php';
?>

<style>
  .pc-rating-star {
    width: 36px;
    height: 36px;
    border: 1px solid #ffc107;
    background: var(--pc-white);
    color: #ffc107;
    font-size: 1.05rem;
    line-height: 1;
    cursor: pointer;
    transition: background-color .2s ease, color .2s ease, transform .2s ease, box-shadow .2s ease;
  }

  .pc-rating-star i {
    display: block;
    line-height: 1;
  }

  .pc-rating-star:hover,
  .pc-rating-star:hover ~ .pc-rating-star,
  .btn-check:checked + .pc-rating-star,
  .btn-check:checked + .pc-rating-star ~ .pc-rating-star {
    background: #ffc107;
    color: var(--pc-white);
  }

  @media (prefers-reduced-motion: reduce) {
    .pc-rating-star {
      transition: none;
    }

    .pc-rating-star:hover,
    .pc-rating-star:hover ~ .pc-rating-star,
    .btn-check:checked + .pc-rating-star,
    .btn-check:checked + .pc-rating-star ~ .pc-rating-star {
      transform: none;
    }
  }
</style>

<section class="section-pc">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <!-- <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why It Matters</p> -->
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

      <div class="col-lg-6">
        <div class="bg-white rounded-5 p-3 p-md-5" style="box-shadow: var(--pc-shadow-md);">
          <form method="post" action="" class="row g-3">
            <div class="col-12">
              <span class="form-label d-block mb-2">I am a...</span>
              <div class="d-flex gap-2">
                <input type="radio" class="btn-check" id="pfRoleDriver" name="role" value="driver" autocomplete="off" <?= $old['role'] === 'driver' ? 'checked' : '' ?>>
                <label class="btn btn-outline-primary rounded-pill fw-semibold px-4" for="pfRoleDriver">Driver</label>

                <input type="radio" class="btn-check" id="pfRolePassenger" name="role" value="passenger" autocomplete="off" <?= $old['role'] === 'passenger' ? 'checked' : '' ?>>
                <label class="btn btn-outline-primary rounded-pill fw-semibold px-4" for="pfRolePassenger">Passenger</label>
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
            <div class="col-12">
              <label class="form-label mb-3">Rate Your Experience</label>
              <div class="d-flex flex-row-reverse justify-content-end align-items-center gap-2">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                  <input
                    type="radio"
                    class="btn-check"
                    name="rating"
                    id="rating<?= $i ?>"
                    value="<?= $i ?>"
                    <?= $old['rating'] === (string) $i ? 'checked' : '' ?>
                  >
                  <label
                    for="rating<?= $i ?>"
                    class="pc-rating-star d-inline-flex align-items-center justify-content-center rounded-circle"
                    title="<?= $i ?> Star<?= $i > 1 ? 's' : '' ?>"
                  >
                    <i class="bi bi-star-fill"></i>
                  </label>
                <?php endfor; ?>
              </div>
              <small class="text-muted-pc mt-2 d-block">Tap a star to rate your journey.</small>
            </div>

            <div class="col-12">
              <label class="form-label" for="pfMessage">Your Message</label>
              <textarea class="form-control" id="pfMessage" name="message" rows="5" required><?= htmlspecialchars($old['message']) ?></textarea>
            </div>
            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
                <span>Send Feedback</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks for the kind words -- we'll make sure this gets seen.</div></div>
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
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
