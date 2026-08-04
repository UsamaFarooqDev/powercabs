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
        <h2 class="mb-3">Elevate Your Business Travel Experience</h2>
        <p class="text-muted-pc mb-4">
          We understand the importance of reliable and luxurious
          transportation for your business needs. Our Business Rides and Limousine
          Services are designed to provide the highest level of comfort, efficiency and professional travel experiences.
        </p>

        <p class="fw-semibold mb-2">With PowerCabs, you can expect:</p>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-4">
          <?php
          $businessExpectations = [
            'Professional drivers',
            'Discreet and punctual chauffeurs',
            'Luxury at every step',
            'Smooth rides for working while travelling',
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
          <p class="mb-0">
            If your company has more than 7 employees, please visit our
            <a class="pc-form-link fw-semibold" href="<?= $assetPath ?>/corporate-services.php">Corporate page</a>
            to explore our corporate travel solutions.
          </p>
        </div>

        <!-- <div class="d-flex flex-wrap gap-3">
          <a class="btn btn-pc-dark px-4" href="<?= $assetPath ?>/corporate-services.php">Visit Corporate Page</a>
          <a class="btn btn-pc-primary px-4" href="<?= $assetPath ?>/book-ride-online.php">Book Online</a>
        </div> -->
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
    <div class="pc-panel rounded-4 p-4 p-md-5">
      <div class="row align-items-center gy-4">
        <div class="col-auto">
          <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 64px; height: 64px; background: var(--pc-orange);">
            <i class="bi bi-airplane-fill fs-3 text-white"></i>
          </span>
        </div>
        <div class="col">
          <span class="badge rounded-pill fw-medium mb-2" style="background: rgba(232, 89, 12, .12); color: var(--pc-orange); font-size: .72rem;">Meet &amp; Greet Available</span>
          <h3 class="fs-4 fw-bold mb-2">Airport Assistance</h3>
          <p class="mb-0 text-muted-pc">
            PowerCabs also provides Airport Assistance Services. For more information or to
            avail the service, contact the team or email
            <a class="pc-form-link fw-semibold" href="mailto:info@powercabs.ie">info@powercabs.ie</a>.
          </p>
        </div>
        <div class="col-12 col-md-auto">
          <a class="btn btn-pc-dark px-4 w-100" href="<?= $assetPath ?>/airport-transfers.php">Learn about Meet &amp; Greet</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ How to Book Our Business Rides ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <?php
          $mockupImage = 'business-account.jpeg';
          $mockupAlt   = 'PowerCabs app screen for booking a business ride';
          $mockupNotch = true;
          require __DIR__ . '/components/phone-mockup.php';
        ?>
      </div>

      <div class="col-lg-6">
        <!-- <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Business Accounts</p> -->
        <h2 class="mb-3">How to Book Our Business Rides</h2>
        <p class="text-muted-pc mb-4">
          Open a PowerCabs Business Account in minutes and give your team a faster,
          simpler way to travel -- booked through the same app, billed to one account.
        </p>

        <div class="row row-cols-1 row-cols-sm-2 g-0 pc-feature-grid">
          <?php
          $businessAccountBenefits = [
            ['icon' => 'bi-lightning-charge-fill', 'title' => 'Priority Booking'],
            ['icon' => 'bi-receipt', 'title' => 'Monthly Billing'],
            ['icon' => 'bi-people-fill', 'title' => 'Multiple Users'],
            ['icon' => 'bi-clock-history', 'title' => 'Ride History'],
            ['icon' => 'bi-headset', 'title' => 'Corporate Support'],
          ];
          $totalBenefits = count($businessAccountBenefits);
          ?>
          <?php foreach ($businessAccountBenefits as $i => $benefit): ?>
            <?php
              $isRightCol      = $i % 2 === 1;
              $hasRightSibling = ($i + 1) < $totalBenefits;
              $isLastRow       = $i >= $totalBenefits - ($totalBenefits % 2 === 0 ? 2 : 1);
              $cellClasses     = ($isRightCol ? 'ps-4' : 'pe-4') . (!$isRightCol && $hasRightSibling ? ' border-end' : '') . ($isLastRow ? '' : ' border-bottom');
            ?>
            <div class="col d-flex align-items-center gap-2 py-3 <?= $cellClasses ?>">
              <i class="bi <?= $benefit['icon'] ?>" style="color: var(--pc-orange);"></i>
              <span class="fw-semibold small"><?= htmlspecialchars($benefit['title']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>

        <a class="btn btn-pc-primary px-4 mt-4" href="<?= $assetPath ?>/corporate-services.php#corporate-account-form">Open a Business Account</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ Why Choose PowerCabs for Business Travel ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <h2 class="text-center mb-5">Why Choose PowerCabs for Business Travel?</h2>
    <div class="px-2 px-md-5">
<div class="row row-cols-1 row-cols-md-4 g-0 border-top border-start">
  <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
    <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Professional Chauffeurs</h3>
    <p class="text-muted-pc mb-0">Experienced, courteous chauffeurs delivering safe and comfortable journeys.</p>
  </div>

  <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
    <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Luxurious Fleet</h3>
    <p class="text-muted-pc mb-0">Travel in premium sedans, SUVs, and limousines for every business occasion.</p>
  </div>

  <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
    <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Punctuality</h3>
    <p class="text-muted-pc mb-0">Reliable, on-time pickups and drop-offs to keep your schedule on track.</p>
  </div>

  <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
    <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Confidentiality</h3>
    <p class="text-muted-pc mb-0">Discreet, secure transportation with complete respect for your privacy.</p>
  </div>
</div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
