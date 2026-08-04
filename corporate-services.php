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

$heroEyebrow     = '/ Corporate Services';
$heroTitleLight  = 'Corporate Services with';
$heroTitleBold   = 'PowerCabs.';
$heroDescription = "Reliable, flexible, and safe business transportation, available 24/7 -- built around your company's schedule, not the other way around.";
$heroBgImage     = 'https://images.pexels.com/photos/8425382/pexels-photo-8425382.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/inner-hero.php';
?>

<!-- ============ Why Businesses Choose PowerCabs ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6 p-2 p-md-5">
        <h2 class="mb-3">Why Businesses Choose PowerCabs</h2>
        <p class="text-muted-pc mb-4" style="max-width: 46ch; font-size: 1.1rem;">
          A corporate account built around how your business actually runs --
          one point of contact, one invoice, and drivers you can rely on every time.
        </p>
        <a class="btn btn-pc-dark px-4" href="#corporate-account-form">Open Your Corporate Account</a>
      </div>

      <div class="col-lg-6">
        <?php
        $whyBusinesses = [
          ['icon' => 'bi-person-workspace', 'title' => 'Account Management', 'desc' => 'A dedicated account manager who understands your business and travel patterns.'],
          ['icon' => 'bi-headset', 'title' => 'Dedicated Support', 'desc' => '24/7 support for your team, not just a general helpline.'],
          ['icon' => 'bi-receipt', 'title' => 'Transparent Billing', 'desc' => 'One consolidated monthly invoice, with no hidden charges.'],
          ['icon' => 'bi-shield-check', 'title' => 'Reliable Drivers', 'desc' => 'Garda-vetted, professional drivers for every corporate journey.'],
          ['icon' => 'bi-calendar-check', 'title' => 'Scheduled Rides', 'desc' => 'Book recurring or advance journeys so your team is never caught out.'],
        ];
        $totalWhyBusinesses = count($whyBusinesses);
        ?>
        <?php foreach ($whyBusinesses as $i => $item): ?>
          <?php $isLast = $i === $totalWhyBusinesses - 1; ?>
          <div class="d-flex">
            <div class="d-flex flex-column align-items-center me-3" style="width: 44px;">
              <span class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; border: 1px solid var(--pc-orange); color: var(--pc-orange);">
                <i class="bi <?= $item['icon'] ?>"></i>
              </span>
              <?php if (!$isLast): ?>
                <div class="flex-grow-1 border-start border-2 my-1" style="border-color: var(--pc-orange) !important; opacity: .35;"></div>
              <?php endif; ?>
            </div>
            <div class="<?= $isLast ? 'pb-0' : 'pb-4' ?> pt-1">
              <h3 class="fs-6 fw-bold mb-1"><?= htmlspecialchars($item['title']) ?></h3>
              <p class="small text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

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

<!-- ============ Corporate Benefits ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <h2 class="mb-0">Everything Your Business Needs</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-4 g-0 border-top justify-content-center">
        <?php
        $corporateBenefits = [
          ['icon' => 'bi-receipt-cutoff', 'label' => 'Monthly Invoicing'],
          ['icon' => 'bi-briefcase-fill', 'label' => 'Executive Rides'],
          ['icon' => 'bi-airplane-fill', 'label' => 'Airport Transfers'],
          ['icon' => 'bi-person-badge-fill', 'label' => 'Meet & Greet'],
          ['icon' => 'bi-building-fill', 'label' => 'Business Account'],
          ['icon' => 'bi-bar-chart-fill', 'label' => 'Reporting'],
        ];
        ?>
        <?php foreach ($corporateBenefits as $item): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-0 pc-why-item-title"><?= htmlspecialchars($item['label']) ?></h3>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

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

<!-- ============ What We Do + Corporate Account Form ============ -->
<section class="section-pc" id="corporate-account-form" style="scroll-margin-top: 6rem;">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ What We Do</p>
        <h2 class="mb-3">Occasions We Cover</h2>
        <p class="text-muted-pc mb-4" style="max-width: 46ch;" style="font-size: 1.1rem;">
          From seminars to state visits, PowerCabs handles the transportation
          so your team can stay focused on the event itself.
        </p>
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
        <div class="d-flex flex-wrap gap-2">
          <?php foreach ($whatWeDo as $item): ?>
            <span class="d-inline-flex align-items-center gap-2 bg-white rounded-pill px-3 py-2" style="box-shadow: var(--pc-shadow-sm);">
              <i class="bi <?= $item['icon'] ?>" style="color: var(--pc-orange);"></i>
              <span class="small fw-medium"><?= htmlspecialchars($item['label']) ?></span>
            </span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="bg-white rounded-5 p-4 p-md-5" style="box-shadow: var(--pc-shadow-md);">
          <h2 class="mb-2" style="font-size:1.7rem">Register for a Corporate Account</h2>
          <p class="text-muted-pc mb-4" style="font-size: 1.1rem;">Tell us a little about your business and our team will be in touch.</p>

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
              <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
                <span>Submit</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your registration has been sent. Our Business Team will be in touch shortly.</div></div>
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
