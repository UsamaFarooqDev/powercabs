<?php
$pageTitle       = 'Corporate Services | PowerCabs';
$pageDescription = 'Reliable, flexible, safe corporate transportation from PowerCabs -- business travel, event transportation and ongoing corporate accounts, available 24/7.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError  = '';
$old = ['name' => '', 'email' => '', 'business_name' => '', 'employee_count' => '', 'mobile' => '', 'address' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['name'] === '' || $old['email'] === '' || $old['business_name'] === '' || $old['mobile'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $body = "New corporate account registration from the PowerCabs website.\n\n"
              . "Name: {$old['name']}\n"
              . "Email: {$old['email']}\n"
              . "Business Name: {$old['business_name']}\n"
              . "Number of Employees: " . ($old['employee_count'] !== '' ? $old['employee_count'] : '-') . "\n"
              . "Mobile: {$old['mobile']}\n"
              . "Address: " . ($old['address'] !== '' ? $old['address'] : '-') . "\n";

        $result = pc_send_mail(
            'Corporate account: ' . $old['business_name'],
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
?>

<!-- ============ Hero ============ -->
<section class="pc-corp-hero position-relative overflow-hidden text-white">
  <img src="<?= $assetPath ?>assets/img/services-corporate.jpg" alt="" aria-hidden="true" class="pc-corp-hero-bg position-absolute top-0 start-0 w-100 h-100">
  <span class="pc-corp-hero-scrim position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
  <div class="container position-relative">
    <p class="small fw-semibold text-uppercase mb-3" style="letter-spacing: .08em; color: var(--pc-orange-light);">/ Corporate Services</p>
    <h1 class="pc-corp-hero-title mb-3">Corporate Services with PowerCabs</h1>
    <p class="mb-4" style="max-width: 56ch; color: rgba(255,255,255,.85); font-size: 1.15rem;">
      Reliable, flexible, and safe business transportation, available 24/7 -- built around
      your company's schedule, not the other way around.
    </p>
    <a class="btn btn-pc-primary btn-lg px-4" href="#corporate-account-form">Open Your Corporate Account</a>
  </div>
</section>

<!-- ============ Services Overview ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ What We Offer</p>
      <h2 class="mb-0">Services Overview</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <a href="#corporate-account-form" class="pc-service-card d-block position-relative overflow-hidden text-decoration-none" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
          <img src="<?= $assetPath ?>assets/img/services-corporate.jpg" alt="Executives entering a premium PowerCabs vehicle" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
          <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-4">
            <span class="pc-service-card-title d-block fs-4 fw-bold mb-1">Business Travel</span>
            <span class="d-block small text-white-50">Executive rides for meetings, client visits, and the daily commute.</span>
          </span>
        </a>
      </div>
      <div class="col-md-4">
        <a href="#corporate-account-form" class="pc-service-card d-block position-relative overflow-hidden text-decoration-none" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
          <img src="<?= $assetPath ?>assets/img/service-city-tour.jpg" alt="Guests arriving at a conference venue" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
          <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-4">
            <span class="pc-service-card-title d-block fs-4 fw-bold mb-1">Event Transportation</span>
            <span class="d-block small text-white-50">Coordinated arrivals and departures for conferences and corporate events.</span>
          </span>
        </a>
      </div>
      <div class="col-md-4">
        <a href="#corporate-account-form" class="pc-service-card d-block position-relative overflow-hidden text-decoration-none" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
          <img src="<?= $assetPath ?>assets/img/service-airport.png" alt="A chauffeur waiting beside a luxury vehicle" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
          <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-4">
            <span class="pc-service-card-title d-block fs-4 fw-bold mb-1">Ongoing Corporate Transport</span>
            <span class="d-block small text-white-50">Flexible multi-day and ongoing accounts, tailored to your business.</span>
          </span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ============ Premium Service Cards ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Premium Services</p>
      <h2 class="mb-0">Tailored for Every Occasion</h2>
    </div>
    <div class="row g-4">
      <div class="col-md-4">
        <a href="#corporate-account-form" class="pc-service-card d-block position-relative overflow-hidden text-decoration-none" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
          <img src="<?= $assetPath ?>assets/img/service-city-tour.jpg" alt="Executives at a fine dining venue" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
          <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-4">
            <span class="pc-service-card-title d-block fs-4 fw-bold mb-1">Client Entertainment</span>
            <span class="d-block small text-white-50 mb-0">Impress clients with polished, punctual transportation to dinners and events.</span>
            <span class="pc-service-card-btn-wrap d-block">
              <span class="btn btn-pc-primary btn-sm d-inline-flex align-items-center gap-2">
                Enquire Now <i class="bi bi-arrow-right-short fs-5 fw-bold"></i>
              </span>
            </span>
          </span>
        </a>
      </div>
      <div class="col-md-4">
        <a href="#corporate-account-form" class="pc-service-card d-block position-relative overflow-hidden text-decoration-none" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg); background: var(--pc-dark);">
          <img src="<?= $assetPath ?>assets/img/services_rides.svg" alt="Corporate conference arrival" class="pc-service-card-img d-block w-100 h-100 object-fit-cover p-4" loading="lazy" style="object-fit: contain;">
          <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-4">
            <span class="pc-service-card-title d-block fs-4 fw-bold mb-1">Business Events</span>
            <span class="d-block small text-white-50 mb-0">From seminars to product launches, arrive together and on time.</span>
            <span class="pc-service-card-btn-wrap d-block">
              <span class="btn btn-pc-primary btn-sm d-inline-flex align-items-center gap-2">
                Enquire Now <i class="bi bi-arrow-right-short fs-5 fw-bold"></i>
              </span>
            </span>
          </span>
        </a>
      </div>
      <div class="col-md-4">
        <a href="#corporate-account-form" class="pc-service-card d-block position-relative overflow-hidden text-decoration-none" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
          <img src="<?= $assetPath ?>assets/img/service-airport.png" alt="A chauffeur holding a passenger name board at the airport" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
          <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-4">
            <span class="pc-service-card-title d-block fs-4 fw-bold mb-1">Airport Pickup</span>
            <span class="d-block small text-white-50 mb-0">A familiar face and a name board waiting the moment you land.</span>
            <span class="pc-service-card-btn-wrap d-block">
              <span class="btn btn-pc-primary btn-sm d-inline-flex align-items-center gap-2">
                Enquire Now <i class="bi bi-arrow-right-short fs-5 fw-bold"></i>
              </span>
            </span>
          </span>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ============ Mission ============ -->
<section class="pc-corp-mission position-relative overflow-hidden text-white text-center">
  <img src="<?= $assetPath ?>assets/img/trusted-bg.svg" alt="" aria-hidden="true" class="pc-corp-mission-bg position-absolute top-0 start-0 w-100 h-100">
  <span class="pc-corp-mission-scrim position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
  <div class="container position-relative">
    <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange-light);">/ Our Mission</p>
    <h2 class="mb-3 text-white">Our Mission</h2>
    <p class="mx-auto mb-0" style="max-width: 60ch; color: rgba(255,255,255,.85); font-size: 1.1rem;">
      To deliver consistent, memorable corporate travel experiences -- so every client,
      colleague, and guest arrives exactly as your business intends them to: on time,
      comfortable, and impressed.
    </p>
  </div>
</section>

<!-- ============ What We Do ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ What We Do</p>
      <h2 class="mb-0">Occasions We Cover</h2>
    </div>
    <?php
    $whatWeDo = [
      ['icon' => 'bi-easel-fill', 'label' => 'Seminars'],
      ['icon' => 'bi-mic-fill', 'label' => 'Conferences'],
      ['icon' => 'bi-image-fill', 'label' => 'Exhibitions'],
      ['icon' => 'bi-rocket-takeoff-fill', 'label' => 'Product Launches'],
      ['icon' => 'bi-megaphone-fill', 'label' => 'PR Events'],
      ['icon' => 'bi-cup-hot-fill', 'label' => 'Corporate Hospitality'],
      ['icon' => 'bi-trophy-fill', 'label' => 'Sporting Events'],
      ['icon' => 'bi-bank2', 'label' => 'State Visits'],
      ['icon' => 'bi-shield-fill-check', 'label' => 'Professional Sports Organizations'],
    ];
    ?>
    <div class="row row-cols-2 row-cols-md-3 g-3">
      <?php foreach ($whatWeDo as $item): ?>
        <div class="col">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100 text-center" style="box-shadow: var(--pc-shadow-sm);">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-2 d-block" style="color: var(--pc-orange);"></i>
            <span class="d-block small fw-semibold"><?= htmlspecialchars($item['label']) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Corporate Account Form ============ -->
<section class="section-pc" id="corporate-account-form" style="background: var(--pc-cream); scroll-margin-top: 6rem;">
  <div class="container" style="max-width: 720px;">
    <div class="text-center mb-4">
      <h2 class="mb-0">Register for Corporate Account</h2>
    </div>

    <?php if ($formStatus === 'success'): ?>
      <div class="alert alert-success" role="alert">Thanks -- your registration has been sent. Our Business Team will be in touch shortly.</div>
    <?php elseif ($formStatus === 'error'): ?>
      <div class="alert alert-danger" role="alert"><?= htmlspecialchars($formError) ?></div>
    <?php endif; ?>

    <form method="post" action="" class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="csName">Name</label>
        <input type="text" class="form-control" id="csName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="csEmail">Email</label>
        <input type="email" class="form-control" id="csEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="csBusinessName">Business Name</label>
        <input type="text" class="form-control" id="csBusinessName" name="business_name" value="<?= htmlspecialchars($old['business_name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="csEmployeeCount">Number of Employees</label>
        <input type="number" min="1" class="form-control" id="csEmployeeCount" name="employee_count" value="<?= htmlspecialchars($old['employee_count']) ?>">
      </div>
      <div class="col-md-6">
        <label class="form-label" for="csMobile">Mobile</label>
        <input type="tel" class="form-control" id="csMobile" name="mobile" value="<?= htmlspecialchars($old['mobile']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="csAddress">Address</label>
        <input type="text" class="form-control" id="csAddress" name="address" value="<?= htmlspecialchars($old['address']) ?>">
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
