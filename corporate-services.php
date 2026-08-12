<?php
$pageTitle       = 'Corporate Taxi Accounts in Dublin | PowerCabs';
$pageDescription = 'Reliable, flexible, safe corporate transportation in Dublin from PowerCabs -- business travel, event transportation and ongoing corporate accounts, available 24/7.';
$assetPath       = '';

require __DIR__ . '/includes/env.php';
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

$heroEyebrow     = '/ Corporate Services';
$heroTitleLight  = 'Corporate Services with';
$heroTitleBold   = 'PowerCabs.';
$heroDescription = "Reliable, flexible, and safe business transportation, available 24/7 -- built around your company's schedule, not the other way around.";
$heroBgImage     = 'https://images.pexels.com/photos/8425382/pexels-photo-8425382.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

require __DIR__ . '/components/corporate/why-businesses.php';
?>

<!-- ============ Services Overview ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
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

<?php require __DIR__ . '/components/corporate/account-form.php'; ?>

<!-- ============ Mission ============ -->
<section class="pc-corp-mission position-relative overflow-hidden text-white text-center">
  <img src="<?= $assetPath ?>assets/img/trusted-bg.svg" alt="" aria-hidden="true" class="pc-corp-mission-bg position-absolute top-0 start-0 w-100 h-100">
  <span class="pc-corp-mission-scrim position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
  <div class="container position-relative">
    <p class="small fw-semibold text-uppercase mb-3" style="letter-spacing: .06em; color: var(--pc-orange-light);">/ Our Mission</p>
    <p class="mx-auto mb-0" style="max-width: 60ch; color: rgba(255,255,255,.85); font-size: 1.4rem;">
      To deliver consistent, memorable corporate travel experiences -- so every client,
      colleague, and guest arrives exactly as your business intends them to: on time,
      comfortable, and impressed.
    </p>
  </div>
</section>

<?php require __DIR__ . '/components/corporate/benefits.php'; ?>

<?php
// require __DIR__ . '/components/corporate/account-form.php';
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
