<?php
$pageTitle       = 'About Us | PowerCabs';
$pageDescription = 'Your trusted partner for seamless and reliable travel across Ireland -- professional drivers, modern vehicles, and 24/7 availability.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ About PowerCabs Ireland';
$heroTitleLight  = 'Your Journey,';
$heroTitleBold   = 'Our Priority.';
$heroDescription = 'Welcome to PowerCabs, your trusted partner for seamless and reliable travel across Ireland.';
$heroBgImage     = $assetPath . 'assets/img/service-airport.png';
require __DIR__ . '/components/inner-hero.php';
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

<!-- ============ Our Dublin Story ============ -->
<section class="section-pc">
  <div class="container">
    <div class="mb-4">
      <h2 class="pc-dublin-story-heading mb-0">Our Dublin Story</h2>
    </div>

    <div class="pc-story-masonry">
      <div class="pc-story-item-1 pc-story-card p-4" style="background: var(--pc-cream);">
        <i class="bi bi-building fs-3 mb-3 d-block" style="color: var(--pc-orange);"></i>
        <h3 class="fs-6 fw-bold mb-2">Dublin Roots</h3>
        <p class="small text-muted-pc mb-0">PowerCabs is proudly based in Inchicore, growing our fleet to serve the Greater Dublin Area with dependable, licensed drivers.</p>
      </div>

      <div class="pc-story-item-2 pc-story-card p-4 bg-white" style="box-shadow: var(--pc-shadow-sm);">
        <span class="pc-story-star-icon mb-3"><i class="bi bi-star-fill"></i></span>
        <h3 class="fs-6 fw-bold mb-2">Excellence as Standard</h3>
        <p class="small text-muted-pc mb-0">Trusted by riders and businesses across Dublin for safe, professional service, day and night.</p>
      </div>

      <div class="pc-story-item-3 position-relative overflow-hidden">
        <img src="<?= $assetPath ?>assets/img/service-city-tour.jpg" alt="Dublin city street" class="w-100 h-100 object-fit-cover" loading="lazy">
        <span class="position-absolute bottom-0 start-0 end-0 p-3 text-white fw-semibold" style="background: linear-gradient(to top, rgba(10,7,5,.7), transparent);">Growing with the City</span>
      </div>

      <!-- <div class="pc-story-item-4 overflow-hidden">
        <img src="<?= $assetPath ?>assets/img/services-corporate.jpg" alt="Inside a PowerCabs vehicle" class="w-100 h-100 object-fit-cover" loading="lazy">
      </div> -->

      <div class="pc-story-item-5 pc-story-card-orange p-4 text-center text-white">
        <span class="d-block pc-story-orange-figure">24/7</span>
        <span class="d-block small text-uppercase" style="letter-spacing: .05em;">Available, Every Day</span>
      </div>

      <div class="pc-story-item-6 pc-story-card p-4 bg-white" style="box-shadow: var(--pc-shadow-sm);">
        <h3 class="fs-6 fw-bold mb-2">Tech-First Approach</h3>
        <p class="small text-muted-pc mb-3">Our booking and dispatch technology connects you with a nearby licensed driver quickly, wherever you are in Dublin.</p>
        <div class="pc-story-progress"></div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Dublin Map ============ -->
<section class="section-pc pt-0">
  <div class="container">
    <div class="pc-dublin-map position-relative rounded-4 overflow-hidden">
      <iframe
        src="https://www.google.com/maps?q=53.3498,-6.2603(PowerCabs+Dublin)&z=11&output=embed"
        class="pc-dublin-map-iframe"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="PowerCabs coverage across Dublin"
      ></iframe>
      <div class="pc-dublin-map-card position-absolute bg-white rounded-4">
        <h3 class="fs-5 fw-bold mb-2">Serving Every Corner</h3>
        <p class="small text-muted-pc mb-3">
          From Dublin Airport to D&uacute;n Laoghaire, and the IFSC to Dundrum. Wherever you
          need to be in the Greater Dublin Area, we are there.
        </p>
        <a href="<?= $assetPath ?>/ride.php" class="btn btn-pc-primary btn-sm px-3">Check Coverage</a>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
