<?php
$pageTitle       = 'Ambassador Programme | PowerCabs';
$pageDescription = 'Join the PowerCabs Ambassador Programme -- free card terminals, exclusive vehicle branding, fuel discounts, extra loyalty points and dedicated support.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
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
$heroBgImage     = $assetPath . 'assets/img/ambassador-program.png';
require __DIR__ . '/components/inner-hero.php';

$benefits = [
  ['icon' => 'bi-credit-card-2-front-fill', 'title' => 'Free Card Terminals',       'items' => ['Save &euro;120/year', '0.8% transaction fee', 'Accept more card payments', 'Increase earnings']],
  ['icon' => 'bi-car-front-fill',           'title' => 'Exclusive Vehicle Branding', 'items' => ['Roof branding', 'Door branding', 'Rear branding', 'More passenger visibility']],
  ['icon' => 'bi-fuel-pump-fill',           'title' => 'Fuel Discounts',            'items' => ['Save &euro;200&ndash;500 annually', 'Nationwide fuel partners', 'Discount on every refill']],
  ['icon' => 'bi-star-fill',                'title' => 'Extra Loyalty Points',      'items' => ['+2 points on every completed trip']],
  ['icon' => 'bi-bag-heart-fill',           'title' => 'Swag Pack',                 'items' => ['Jacket or Gilet', 'PowerCabs merchandise']],
  ['icon' => 'bi-headset',                  'title' => 'Dedicated Support',         'items' => ['Priority assistance', 'Dedicated Ambassador team']],
];
?>

<!-- ============ Benefits ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Benefits</p>
      <h2 class="mb-0">Everything You Get as an Ambassador</h2>
    </div>
    <div class="row g-4">
      <?php foreach ($benefits as $b): ?>
        <div class="col-md-6 col-lg-4">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100" style="box-shadow: var(--pc-shadow-sm);">
            <i class="bi <?= $b['icon'] ?> fs-3 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-5 fw-bold mb-3"><?= htmlspecialchars($b['title']) ?></h3>
            <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
              <?php foreach ($b['items'] as $item): ?>
                <li class="d-flex gap-2 small text-muted-pc">
                  <i class="bi bi-check-circle-fill mt-1" style="color: var(--pc-orange);"></i>
                  <span><?= $item ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Registration Form ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container" style="max-width: 720px;">
    <div class="text-center mb-4">
      <h2 class="mb-0">Register as an Ambassador</h2>
    </div>

    <?php if ($formStatus === 'success'): ?>
      <div class="alert alert-success" role="alert">Thanks -- your registration has been sent. Our team will be in touch shortly.</div>
    <?php elseif ($formStatus === 'error'): ?>
      <div class="alert alert-danger" role="alert"><?= htmlspecialchars($formError) ?></div>
    <?php endif; ?>

    <form method="post" action="" class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="apName">Name</label>
        <input type="text" class="form-control" id="apName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="apEmail">Email</label>
        <input type="email" class="form-control" id="apEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="apPhone">Phone</label>
        <input type="tel" class="form-control" id="apPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="apAffiliated">Currently Affiliated With <span class="text-muted-pc fw-normal">(optional)</span></label>
        <input type="text" class="form-control" id="apAffiliated" name="affiliated_with" value="<?= htmlspecialchars($old['affiliated_with']) ?>" placeholder="e.g. independent, another fleet">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="apRegistered">Registered with PowerCabs?</label>
        <select class="form-select" id="apRegistered" name="registered_with_powercabs" required>
          <option value="" disabled <?= $old['registered_with_powercabs'] === '' ? 'selected' : '' ?>>Select an option</option>
          <option value="Yes" <?= $old['registered_with_powercabs'] === 'Yes' ? 'selected' : '' ?>>Yes</option>
          <option value="No" <?= $old['registered_with_powercabs'] === 'No' ? 'selected' : '' ?>>No</option>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="apLicense">License Number</label>
        <input type="text" class="form-control" id="apLicense" name="license_number" value="<?= htmlspecialchars($old['license_number']) ?>" required>
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
