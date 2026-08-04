<?php
$pageTitle       = 'PowerCabs Business Solutions | PowerCabs';
$pageDescription = 'Business transportation solutions for companies seeking reliable, professional, and efficient travel services for employees and clients.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError  = '';
$old = ['name' => '', 'company_name' => '', 'business_email' => '', 'mobile' => '', 'company_address' => '', 'employee_count' => '', 'requirements' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['name'] === '' || $old['company_name'] === '' || $old['business_email'] === '' || $old['mobile'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['business_email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid business email address.';
    } else {
        $body = "New PowerCabs Business Solutions enquiry.\n\n"
              . "Name: {$old['name']}\n"
              . "Company Name: {$old['company_name']}\n"
              . "Business Email: {$old['business_email']}\n"
              . "Mobile Number: {$old['mobile']}\n"
              . "Company Address: " . ($old['company_address'] !== '' ? $old['company_address'] : '-') . "\n"
              . "Number of Employees: " . ($old['employee_count'] !== '' ? $old['employee_count'] : '-') . "\n\n"
              . "Business Requirements:\n" . ($old['requirements'] !== '' ? $old['requirements'] : '-') . "\n";

        $result = pc_send_mail(
            'Business Solutions enquiry: ' . $old['company_name'],
            $body,
            ['name' => $old['name'], 'email' => $old['business_email']]
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

$heroEyebrow     = '/ Business Solutions';
$heroTitleLight  = 'PowerCabs';
$heroTitleBold   = 'Business Solutions.';
$heroDescription = 'Business transportation solutions for companies seeking reliable, professional, and efficient travel services for employees and clients.';
$heroBgImage     = 'https://images.pexels.com/photos/7108210/pexels-photo-7108210.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$bizServices = ['Corporate Travel', 'Executive Transportation', 'Airport Transfers', 'Client Meetings', 'Event Transportation', 'Chauffeur Services', 'Luxury Vehicles'];
$bizWhy = [
  ['icon' => 'bi-person-badge-fill', 'title' => 'Professional Chauffeurs'],
  ['icon' => 'bi-car-front-fill',    'title' => 'Premium Fleet'],
  ['icon' => 'bi-clock-fill',        'title' => 'Punctual Pickups'],
  ['icon' => 'bi-shield-lock-fill',  'title' => 'Confidential Service'],
  ['icon' => 'bi-calendar-check',    'title' => 'Flexible Booking'],
  ['icon' => 'bi-headset',           'title' => 'Dedicated Account Support'],
];
$bizProcess = [
  ['n' => 1, 'title' => 'Contact Business Team'],
  ['n' => 2, 'title' => 'Discuss Requirements'],
  ['n' => 3, 'title' => 'Customized Transportation Plan'],
  ['n' => 4, 'title' => 'Schedule Rides'],
  ['n' => 5, 'title' => 'Enjoy Professional Service'],
];
?>

<!-- ============ Services ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Services</p>
      <h2 class="mb-0">Everything Your Business Needs on the Road</h2>
    </div>
    <div class="row row-cols-2 row-cols-md-4 g-3">
      <?php foreach ($bizServices as $service): ?>
        <div class="col">
          <div class="rounded-4 p-4 bg-white h-100 text-center" style="box-shadow: var(--pc-shadow-sm);">
            <i class="bi bi-check2-circle fs-3 mb-2 d-block" style="color: var(--pc-orange);"></i>
            <span class="d-block small fw-semibold"><?= htmlspecialchars($service) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Why Choose Us ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why Choose Us</p>
      <h2 class="mb-0">Trusted by Teams Across Dublin</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-3 g-0 border-top border-start">
        <?php foreach ($bizWhy as $item): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-0 pc-why-item-title"><?= htmlspecialchars($item['title']) ?></h3>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ Process ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Process</p>
      <h2 class="mb-0">From First Call to First Ride</h2>
    </div>
    <div class="row g-3">
      <?php foreach ($bizProcess as $step): ?>
        <div class="col-6 col-lg">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100 text-center">
            <span class="pc-story-star-icon mx-auto mb-3"><?= $step['n'] ?></span>
            <h3 class="fs-6 fw-bold mb-0"><?= htmlspecialchars($step['title']) ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Corporate Account Form ============ -->
<section class="section-pc">
  <div class="container" style="max-width: 760px;">
    <div class="text-center mb-4">
      <h2 class="mb-0">Register a Corporate Account</h2>
    </div>

    <form method="post" action="" class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="bsName">Name</label>
        <input type="text" class="form-control" id="bsName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="bsCompanyName">Company Name</label>
        <input type="text" class="form-control" id="bsCompanyName" name="company_name" value="<?= htmlspecialchars($old['company_name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="bsBusinessEmail">Business Email</label>
        <input type="email" class="form-control" id="bsBusinessEmail" name="business_email" value="<?= htmlspecialchars($old['business_email']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="bsMobile">Mobile Number</label>
        <input type="tel" class="form-control" id="bsMobile" name="mobile" value="<?= htmlspecialchars($old['mobile']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="bsAddress">Company Address <span class="text-muted-pc fw-normal">(optional)</span></label>
        <input type="text" class="form-control" id="bsAddress" name="company_address" value="<?= htmlspecialchars($old['company_address']) ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="bsEmployeeCount">Number of Employees <span class="text-muted-pc fw-normal">(optional)</span></label>
        <input type="number" min="1" class="form-control" id="bsEmployeeCount" name="employee_count" value="<?= htmlspecialchars($old['employee_count']) ?>">
      </div>
      <div class="col-12">
        <label class="form-label" for="bsRequirements">Business Requirements <span class="text-muted-pc fw-normal">(optional)</span></label>
        <textarea class="form-control" id="bsRequirements" name="requirements" rows="4"><?= htmlspecialchars($old['requirements']) ?></textarea>
      </div>
      <div class="col-12 pt-2">
        <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
          <span>Submit</span>
          <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
        </button>
      </div>

      <?php if ($formStatus === 'success'): ?>
        <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your enquiry has been sent. Our Business Team will be in touch shortly.</div></div>
      <?php elseif ($formStatus === 'error'): ?>
        <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
      <?php endif; ?>
    </form>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
