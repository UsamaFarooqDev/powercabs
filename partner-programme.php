<?php
$pageTitle       = 'Partner Programme | PowerCabs';
$pageDescription = 'Join the PowerCabs Partner Programme -- taxi operators, fleet owners and transport companies can grow their business on the PowerCabs network.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError  = '';
$old = ['name' => '', 'business_name' => '', 'email' => '', 'phone' => '', 'fleet_size' => '', 'city' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['name'] === '' || $old['business_name'] === '' || $old['email'] === '' || $old['phone'] === '' || $old['city'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $body = "New Partner Programme enquiry.\n\n"
              . "Name: {$old['name']}\n"
              . "Business Name: {$old['business_name']}\n"
              . "Email: {$old['email']}\n"
              . "Phone: {$old['phone']}\n"
              . "Fleet Size: " . ($old['fleet_size'] !== '' ? $old['fleet_size'] : '-') . "\n"
              . "City: {$old['city']}\n\n"
              . "Message:\n" . ($old['message'] !== '' ? $old['message'] : '-') . "\n";

        $result = pc_send_mail(
            'Partner Programme enquiry: ' . $old['business_name'],
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
            $formError  = 'Sorry, something went wrong sending your enquiry. Please try again or call us directly.';
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Business';
$heroTitleLight  = 'Partner';
$heroTitleBold   = 'Programme.';
$heroDescription = 'PowerCabs welcomes taxi operators, fleet owners, and business partners to join the growing transportation network and expand their business opportunities.';
$heroBgImage     = 'https://images.pexels.com/photos/36712857/pexels-photo-36712857.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/inner-hero.php';

$partnerBenefits = ['Grow your business', 'Increased bookings', 'Dedicated support', 'Driver management', 'Fleet management', 'Marketing support', 'Technology platform', 'Weekly payments', 'Business growth'];
$whoCanJoin = [
  ['icon' => 'bi-taxi-front-fill', 'label' => 'Taxi Operators'],
  ['icon' => 'bi-truck',           'label' => 'Fleet Owners'],
  ['icon' => 'bi-person-fill',     'label' => 'Independent Drivers'],
  ['icon' => 'bi-building-fill',   'label' => 'Transport Companies'],
];
$joinProcess = [
  ['n' => 1, 'title' => 'Register'],
  ['n' => 2, 'title' => 'Verification'],
  ['n' => 3, 'title' => 'Approval'],
  ['n' => 4, 'title' => 'Start Receiving Trips'],
];
?>

<!-- ============ Overview ============ -->
<section class="section-pc text-center">
  <div class="container" style="max-width: 760px;">
    <p class="text-muted-pc mb-0">
      PowerCabs welcomes taxi operators, fleet owners, and business partners to join the
      growing transportation network and expand their business opportunities.
    </p>
  </div>
</section>

<!-- ============ Benefits ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Benefits</p>
      <h2 class="mb-0">What You Gain as a Partner</h2>
    </div>
    <div class="row row-cols-2 row-cols-md-3 g-3">
      <?php foreach ($partnerBenefits as $item): ?>
        <div class="col">
          <div class="rounded-4 p-4 bg-white h-100 text-center" style="box-shadow: var(--pc-shadow-sm);">
            <i class="bi bi-check2-circle fs-3 mb-2 d-block" style="color: var(--pc-orange);"></i>
            <span class="d-block small fw-semibold"><?= htmlspecialchars($item) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Who Can Join ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Who Can Join</p>
      <h2 class="mb-0">Built for Every Kind of Operator</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-4 g-0 border-top border-start">
        <?php foreach ($whoCanJoin as $item): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-0 pc-why-item-title"><?= htmlspecialchars($item['label']) ?></h3>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ Join Process ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Join Process</p>
      <h2 class="mb-0">Four Steps to Get Started</h2>
    </div>
    <div class="row g-3">
      <?php foreach ($joinProcess as $step): ?>
        <div class="col-6 col-lg-3">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100 text-center" style="box-shadow: var(--pc-shadow-sm);">
            <span class="pc-story-star-icon mx-auto mb-3"><?= $step['n'] ?></span>
            <h3 class="fs-6 fw-bold mb-0"><?= htmlspecialchars($step['title']) ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Partner Form ============ -->
<section class="section-pc">
  <div class="container" style="max-width: 720px;">
    <div class="text-center mb-4">
      <h2 class="mb-0">Enquire About Partnering</h2>
    </div>

    <?php if ($formStatus === 'success'): ?>
      <div class="alert alert-success" role="alert">Thanks -- your enquiry has been sent. Our team will be in touch shortly.</div>
    <?php elseif ($formStatus === 'error'): ?>
      <div class="alert alert-danger" role="alert"><?= htmlspecialchars($formError) ?></div>
    <?php endif; ?>

    <form method="post" action="" class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="ptName">Name</label>
        <input type="text" class="form-control" id="ptName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="ptBusinessName">Business Name</label>
        <input type="text" class="form-control" id="ptBusinessName" name="business_name" value="<?= htmlspecialchars($old['business_name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="ptEmail">Email</label>
        <input type="email" class="form-control" id="ptEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="ptPhone">Phone</label>
        <input type="tel" class="form-control" id="ptPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="ptFleetSize">Fleet Size <span class="text-muted-pc fw-normal">(optional)</span></label>
        <input type="number" min="1" class="form-control" id="ptFleetSize" name="fleet_size" value="<?= htmlspecialchars($old['fleet_size']) ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="ptCity">City</label>
        <input type="text" class="form-control" id="ptCity" name="city" value="<?= htmlspecialchars($old['city']) ?>" required>
      </div>
      <div class="col-12">
        <label class="form-label" for="ptMessage">Message <span class="text-muted-pc fw-normal">(optional)</span></label>
        <textarea class="form-control" id="ptMessage" name="message" rows="4"><?= htmlspecialchars($old['message']) ?></textarea>
      </div>
      <div class="col-12 pt-2">
        <button type="submit" class="btn btn-pc-primary px-4">Submit</button>
      </div>
    </form>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
