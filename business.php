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
require __DIR__ . '/components/shared/inner-hero.php';
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
      </div>

      <div class="col-lg-6">
        <div class="rounded-4 overflow-hidden">
          <img src="<?= $assetPath ?>assets/img/Business_gif.gif" alt="PowerCabs business travel showcase" class="w-100 h-100 object-fit-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/business/airport-assistance.php';
require __DIR__ . '/components/business/booking-process.php';
?>

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
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
