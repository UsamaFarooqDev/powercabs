<?php
$pageTitle       = 'Meet & Greet | Airport Transfers | PowerCabs';
$pageDescription = "PowerCabs's Meet & Greet airport service -- flight tracking, a personal greeting at arrivals, luggage assistance and a smooth transfer to your destination.";
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Airport Service';
$heroTitleLight  = 'Meet &';
$heroTitleBold   = 'Greet.';
$heroDescription = "Start or end your journey stress-free with PowerCabs' professional airport Meet & Greet service. Whether you're arriving for business or leisure, our experienced drivers monitor your flight, greet you at arrivals, assist with your luggage, and ensure a smooth, comfortable transfer to your destination. We also accommodate last-minute airport bookings whenever possible.";
$heroBgImage     = 'https://images.pexels.com/photos/36498953/pexels-photo-36498953.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Meet & Greet';
require __DIR__ . '/components/inner-hero.php';

$meetGreetServices = [
  ['icon' => 'bi-airplane-engines-fill', 'title' => 'Flight Tracking',            'desc' => 'Your driver monitors your flight in real time to adjust for delays or early arrivals.'],
  ['icon' => 'bi-person-badge-fill',     'title' => 'Personal Meet & Greet',      'desc' => 'Your driver waits inside the arrivals terminal with a personalized name board.'],
  ['icon' => 'bi-bag-check-fill',        'title' => 'Luggage Assistance',         'desc' => 'Professional assistance with luggage from the terminal to the vehicle.'],
  ['icon' => 'bi-award-fill',            'title' => 'Executive Airport Transfers','desc' => 'Premium, comfortable vehicles for business and leisure travelers.'],
  ['icon' => 'bi-people-fill',           'title' => 'Family Airport Transfers',   'desc' => 'Spacious vehicles for families with children and extra luggage.'],
  ['icon' => 'bi-briefcase-fill',        'title' => 'Business Travel',            'desc' => 'Reliable airport transportation for corporate clients.'],
  ['icon' => 'bi-clock-history',         'title' => 'Last-Minute Bookings',       'desc' => "We've got you covered even for last-minute airport bookings."],
];

$whyChoose = ['Professional licensed drivers', 'Flight monitoring', 'Fixed transparent pricing', 'No hidden charges', '24/7 availability', 'Comfortable vehicles', 'Online booking', 'Safe & reliable transportation'];

$bookingSteps = [
  ['n' => 1, 'title' => 'Enter Flight Details'],
  ['n' => 2, 'title' => 'Choose Vehicle'],
  ['n' => 3, 'title' => 'Confirm Booking'],
  ['n' => 4, 'title' => 'Driver Meets You at Arrivals'],
];
?>

<!-- ============ Our Meet & Greet Services ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="mb-0">Our Meet &amp; Greet Services</h2>
    </div>
    <div class="row g-4">
      <?php foreach ($meetGreetServices as $s): ?>
        <div class="col-md-6 col-lg-4">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100" style="box-shadow: var(--pc-shadow-sm);">
            <i class="bi <?= $s['icon'] ?> fs-3 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-5 fw-bold mb-2"><?= htmlspecialchars($s['title']) ?></h3>
            <p class="small text-muted-pc mb-0"><?= htmlspecialchars($s['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Photo Banner ============ -->
<section class="position-relative overflow-hidden text-center text-white" style="min-height: 280px;">
  <img src="https://images.pexels.com/photos/36377043/pexels-photo-36377043.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: 0;" loading="lazy">
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true" style="background: rgba(10, 7, 5, 0.65); z-index: 0;"></span>
  <div class="container position-relative d-flex align-items-center justify-content-center" style="min-height: 280px;">
    <p class="fs-4 fw-bold text-white mb-0" style="max-width: 46ch;">From the terminal to the car, we've got your bags covered.</p>
  </div>
</section>

<!-- ============ Why Choose PowerCabs ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <!-- <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why Choose PowerCabs</p> -->
      <h2 class="mb-0">A Warmer Way to Land</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-4 g-0 border-top border-start">
        <?php foreach ($whyChoose as $item): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <i class="bi bi-check-circle-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-0 pc-why-item-title"><?= htmlspecialchars($item) ?></h3>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ Booking Steps ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ How It Works</p>
      <h2 class="mb-0">Booked in Four Simple Steps</h2>
    </div>
    <div class="row g-3">
      <?php foreach ($bookingSteps as $step): ?>
        <div class="col-md-6 col-lg-3">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100 text-center" style="box-shadow: var(--pc-shadow-sm);">
            <span class="pc-story-star-icon mx-auto mb-3"><?= $step['n'] ?></span>
            <h3 class="fs-6 fw-bold mb-0"><?= htmlspecialchars($step['title']) ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Online Booking CTA ============ -->
<section class="section-pc text-center">
  <div class="container">
    <h2 class="mb-3">Ready to Book Your Airport Transfer?</h2>
    <p class="text-muted-pc mx-auto mb-4" style="max-width: 52ch;">Book online in a couple of minutes, or get in touch if you have a question first.</p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a class="btn btn-pc-primary btn-md px-5" href="<?= $assetPath ?>/book-ride-online.php">Book Online</a>
      <a class="btn btn-outline-dark btn-md px-5 rounded-pill" href="<?= $assetPath ?>/faqs.php">Have a Question? See FAQs</a>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
