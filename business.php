<?php
$pageTitle       = 'Business Travel | PowerCabs';
$pageDescription = 'Reliable, discreet, and professional Business Rides and Limousine Services from PowerCabs -- built for executives, teams, and corporate travel across Dublin.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Business';
$heroTitleLight  = 'Elevate Your';
$heroTitleBold   = 'Business Travel.';
$heroDescription = 'Reliable and luxurious transportation for your business needs, with the comfort and professionalism your clients expect.';
$heroBgImage     = $assetPath . 'assets/img/services-corporate.jpg';
require __DIR__ . '/components/inner-hero.php';
?>

<!-- ============ Business Rides & Limousine Services ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Business Rides &amp; Limousine Services</p>
        <h2 class="mb-3">Elevate Your Business Travel Experience</h2>
        <p class="text-muted-pc mb-4">
          At PowerCabs, we understand the importance of reliable and luxurious
          transportation for your business needs. Our Business Rides and Limousine
          Services are designed to provide the highest level of comfort and efficiency,
          ensuring a seamless and professional travel experience for you and your clients.
        </p>

        <p class="fw-semibold mb-2">With PowerCabs, you can expect:</p>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-4">
          <?php
          $businessExpectations = [
            'Professional drivers',
            'Discreet and punctual chauffeurs',
            'Luxury at every step',
            'Smooth rides for working while travelling',
            "A premium experience that reflects your company's professionalism",
          ];
          ?>
          <?php foreach ($businessExpectations as $item): ?>
            <li class="d-flex gap-2">
              <i class="bi bi-check-circle-fill" style="color: var(--pc-orange);"></i>
              <span class="text-muted-pc"><?= htmlspecialchars($item) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="pc-panel rounded-4 p-3 mb-4">
          <p class="small mb-0">
            If your company has more than 7 employees, please visit our
            <a class="pc-form-link fw-semibold" href="<?= $assetPath ?>/corporate-services.php">Corporate page</a>
            to explore our corporate travel solutions.
          </p>
        </div>

        <div class="d-flex flex-wrap gap-3">
          <a class="btn btn-pc-dark px-4" href="<?= $assetPath ?>/corporate-services.php">Visit Corporate Page</a>
          <a class="btn btn-pc-primary px-4" href="<?= $assetPath ?>/book-ride-online.php">Book Online</a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="rounded-4 overflow-hidden">
          <img src="<?= $assetPath ?>assets/img/Business_gif.gif" alt="PowerCabs business travel showcase" class="w-100 h-100 object-fit-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Airport Assistance ============ -->
<section class="section-pc pt-0">
  <div class="container">
    <div class="pc-panel rounded-4 p-4 p-md-5 d-flex flex-column flex-md-row align-items-md-center gap-4">
      <i class="bi bi-airplane-fill fs-1 flex-shrink-0" style="color: var(--pc-orange);"></i>
      <div class="flex-grow-1">
        <h3 class="fs-5 fw-bold mb-2">Airport Assistance</h3>
        <p class="mb-0 text-muted-pc">
          PowerCabs also provides Airport Assistance Services. For more information or to
          avail the service, contact the team or email
          <a class="pc-form-link fw-semibold" href="mailto:info@powercabs.ie">info@powercabs.ie</a>.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ============ How to Book Our Business Rides ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
      
    <div class="col-lg-6">
  <h2 class="mb-4">How to Book Our Business Rides</h2>

  <?php
  $bookingSteps = [
    ['n' => 1, 'icon' => 'bi-telephone', 'title' => 'Contact Us', 'desc' => 'Reach out to the PowerCabs Business Team and discuss your transportation requirements.'],
    ['n' => 2, 'icon' => 'bi-clipboard-check', 'title' => 'Customized Plan', 'desc' => "Receive a transportation solution tailored to your business, whether it's for:", 'list' => ['One-time events', 'Ongoing business travel', 'Executive transportation']],
    ['n' => 3, 'icon' => 'bi-calendar-check', 'title' => 'Book Your Ride', 'desc' => 'Schedule rides conveniently using:', 'list' => ['Online Booking', 'PowerCabs Mobile App']],
    ['n' => 4, 'icon' => 'bi-check2-circle', 'title' => 'Enjoy the Ride', 'desc' => 'Experience premium comfort, professionalism, and reliable transportation throughout your journey.'],
  ];
  $totalSteps = count($bookingSteps);
  ?>

  <?php foreach ($bookingSteps as $i => $step): ?>
    <?php $isLast = $i === $totalSteps - 1; ?>
    <div class="d-flex">

      <!-- marker + connecting line -->
      <div class="d-flex flex-column align-items-center me-3" style="width: 44px;">
        <span
          class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 fw-bold"
          style="width: 44px; height: 44px; border: 2px solid var(--pc-orange); <?= $isLast ? 'background-color: var(--pc-orange); color: #fff;' : 'color: var(--pc-orange);' ?>"
        >
          <i class="bi <?= $step['icon'] ?>"></i>
        </span>
        <?php if (!$isLast): ?>
          <div class="flex-grow-1 border-start border-2 my-1" style="border-color: var(--pc-orange) !important; opacity: .35;"></div>
        <?php endif; ?>
      </div>

      <!-- content -->
      <div class="<?= $isLast ? 'pb-0' : 'pb-4' ?> pt-1">
        <p class="small fw-semibold text-uppercase mb-1" style="letter-spacing: .05em; color: var(--pc-orange); opacity: .8; font-size: .7rem;">
          Step <?= $step['n'] ?> of <?= $totalSteps ?>
        </p>
        <h3 class="fs-6 fw-bold mb-1">
          <?= htmlspecialchars($step['title']) ?>
        </h3>
        <p class="small text-muted-pc mb-0">
          <?= htmlspecialchars($step['desc']) ?>
        </p>

        <?php if (!empty($step['list'])): ?>
          <div class="d-flex flex-wrap gap-2 mt-2">
            <?php foreach ($step['list'] as $item): ?>
              <span
                class="badge rounded-pill fw-medium bg-white"
                style="border: 1px solid var(--pc-orange); color: var(--pc-orange); font-weight: 500; font-size: .78rem; padding: .45em .85em;"
              >
                <?= htmlspecialchars($item) ?>
              </span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>

    </div>
  <?php endforeach; ?>
</div>

      <div class="col-lg-6 p-5">
        <img src="<?= $assetPath ?>assets/img/business_ride.svg" alt="Booking a PowerCabs business ride" class="w-100" loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- ============ Why Choose PowerCabs for Business Travel ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <h2 class="text-center mb-5">Why Choose PowerCabs for Business Travel?</h2>
    <div class="px-2 px-md-5">
      <div class="row row-cols-1 row-cols-md-2 g-0 border-top border-start">
        <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
          <i class="bi bi-person-badge-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Professional Chauffeurs</h3>
          <p class="small text-muted-pc mb-0">Our experienced and courteous chauffeurs ensure a smooth, comfortable, and stress-free ride, allowing you to focus on work or simply relax.</p>
        </div>
        <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
          <i class="bi bi-car-front-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Luxurious Fleet</h3>
          <p class="small text-muted-pc mb-0">Choose from a premium fleet including Luxury Sedans, SUVs, and Limousines &mdash; designed to leave a lasting impression.</p>
        </div>
        <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
          <i class="bi bi-clock-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Punctuality</h3>
          <p class="small text-muted-pc mb-0">We value your time by ensuring timely pickups and drop-offs for every business appointment.</p>
        </div>
        <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
          <i class="bi bi-shield-lock-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Confidentiality</h3>
          <p class="small text-muted-pc mb-0">Your privacy is our priority. Our professional chauffeurs provide discreet, confidential, and secure transportation.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
