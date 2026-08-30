<?php
$pageTitle = 'About Us | PowerCabs';
$pageDescription =
  'Your trusted partner for seamless and reliable travel across Ireland -- professional drivers, modern vehicles, and 24/7 availability.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ About PowerCabs Ireland';
$heroTitleLight = 'Your Journey,';
$heroTitleBold = 'Our Priority.';
$heroDescription = 'Welcome to PowerCabs, your trusted partner for seamless and reliable travel across Ireland.';
$heroBgImage = 'https://images.pexels.com/photos/36713443/pexels-photo-36713443.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<!-- ============ Who We Are ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
    
      <div class="col-lg-6">
        <!-- <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Who We Are</p> -->
        <h2 class="mb-3">Welcome to PowerCabs</h2>
        <p class="text-muted-pc mb-3" style="font-size: 1.125rem; line-height: 1.8;">
          Established with the mission to provide safe, comfortable, and efficient travel
          experiences, we pride ourselves on our professional and courteous drivers,
          state-of-the-art vehicles, and commitment to customer satisfaction.
        </p>
        <p class="fs-5 fw-bold mb-0" style="color: var(--pc-dark);">
          At PowerCabs, your journey is our priority.
        </p>
      </div>

        <div class="col-lg-6 p-3 p-md-5">
        <div class="overflow-hidden">
          <img src="<?= $assetPath ?>assets/img/services_rides.png" alt="A PowerCabs driver on the road" class="w-100 h-100 object-fit-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Highlights ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-4 g-0 border-top border-start">
        <div class="col pc-why-item position-relative border-end text-center px-1 px-md-3 py-4 py-md-5">
          <i class="bi bi-person-badge-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Professional Drivers</h3>
          <p class="text-muted-pc mb-0">Courteous, experienced, and licensed for every journey.</p>
        </div>
        <div class="col pc-why-item position-relative border-end text-center px-1 px-md-3 py-4 py-md-5">
          <i class="bi bi-car-front-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Modern Vehicles</h3>
          <p class="text-muted-pc mb-0">State-of-the-art, regularly inspected fleet.</p>
        </div>
        <div class="col pc-why-item position-relative border-end text-center px-1 px-md-3 py-4 py-md-5">
          <i class="bi bi-clock-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">24/7 Availability</h3>
          <p class="text-muted-pc mb-0">Day or night, we're ready when you need us.</p>
        </div>
        <div class="col pc-why-item position-relative border-end text-center px-1 px-md-3 py-4 py-md-5">
          <i class="bi bi-tag-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-5 fw-bold mb-2 pc-why-item-title">Competitive Rates</h3>
          <p class="text-muted-pc mb-0">Easy booking, transparent and fair pricing.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/components/about/dublin-story.php'; ?>

<!-- ============ Dublin Map ============ -->
<section class="section-pc pt-0">
  <div class="container">
    <div class="pc-dublin-map position-relative rounded-4 overflow-hidden">
      <iframe
        src="https://www.google.com/maps?q=53.3498,-6.2603(PowerCabs+Dublin)&z=11&output=embed"
        class="w-100 h-100 border-0"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="PowerCabs coverage across Dublin"
      ></iframe>
      <div class="pc-dublin-map-card z-2 position-absolute bg-white rounded-4">
        <h3 class="fs-5 fw-bold mb-2">Serving Every Corner</h3>
        <p class="small text-muted-pc mb-3">
          From Dublin Airport to D&uacute;n Laoghaire, and the IFSC to Dundrum. Wherever you
          need to be in the Greater Dublin Area, we are there.
        </p>
        <a href="<?= $assetPath ?>/ride" class="btn btn-pc-primary btn-sm px-3">Check Coverage</a>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
