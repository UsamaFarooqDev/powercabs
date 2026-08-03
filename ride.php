<?php
$pageTitle       = 'Ride with PowerCabs | Seamless, Comfortable Taxis in Ireland';
$pageDescription = 'Book a seamless, comfortable ride with PowerCabs -- convenient booking, Garda-vetted drivers, affordable rates and 24/7 availability across Ireland.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Ride';
$heroTitleLight  = 'Seamless and';
$heroTitleBold   = 'Comfortable Rides.';
$heroDescription = "PowerCabs is committed to providing a smooth, reliable, and comfortable ride experience. Whether you're commuting to work, heading to the airport, or exploring the city, PowerCabs offers convenient booking, safe transportation, affordable pricing, and 24/7 availability.";
$heroBgImage     = 'https://images.pexels.com/photos/1399282/pexels-photo-1399282.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/inner-hero.php';

$rideTypes = [
  [
    'img'   => 'Economy.png',
    'title' => 'Economy',
    'desc'  => 'Affordable, everyday rides for getting around town. A reliable, no-fuss car for quick trips whenever you need one.',
    'specs' => [
      ['icon' => 'bi-people-fill', 'label' => '4 Seats'],
      ['icon' => 'bi-cash-coin', 'label' => 'Affordable'],
    ],
  ],
  [
    'img'   => 'Economy-xl.png',
    'title' => 'Economy XL',
    'desc'  => 'Extra seats and boot space for bigger groups and extra luggage, without stepping up to a premium fare.',
    'specs' => [
      ['icon' => 'bi-people-fill', 'label' => '6 Seats'],
      ['icon' => 'bi-bag-fill', 'label' => 'Extra Space'],
    ],
  ],
  [
    'img'   => 'Limousine.png',
    'title' => 'Limousine',
    'desc'  => 'Arrive in style with a premium, chauffeur-driven experience -- perfect for special occasions and VIP travel.',
    'specs' => [
      ['icon' => 'bi-gem', 'label' => 'Luxury Experience'],
    ],
  ],
  [
    'img'   => 'wheelchair-taxi.png',
    'title' => 'Wheelchair Taxi',
    'desc'  => 'Fully accessible vehicles fitted for wheelchair users, with trained and courteous drivers on every trip.',
    'specs' => [
      ['icon' => 'bi-person-wheelchair', 'label' => 'Accessible Vehicle'],
    ],
  ],
  [
    'img'   => 'pet-taxi.png',
    'title' => 'Pets Taxi',
    'desc'  => 'Travel comfortably with your furry friend in a pet-friendly interior, built for secure and relaxed rides.',
    'specs' => [
      ['icon' => 'bi-heart-fill', 'label' => 'Pet Friendly Ride'],
    ],
  ],
  [
    'img'   => 'courier.png',
    'title' => 'Courier / Parcel',
    'desc'  => 'Fast, secure point-to-point parcel and document delivery across Ireland, whenever you need it.',
    'specs' => [
      ['icon' => 'bi-box-seam-fill', 'label' => 'Package Delivery'],
    ],
  ],
  [
    'img'   => 'business.png',
    'title' => 'Business',
    'desc'  => 'A polished ride for work trips and client meetings, with a professional driver and a spotless vehicle.',
    'specs' => [
      ['icon' => 'bi-briefcase-fill', 'label' => 'Premium Travel'],
    ],
  ],
  [
    'img'   => 'business-xl.png',
    'title' => 'Business XL',
    'desc'  => 'The business experience with extra room -- ideal for executive teams and groups travelling together.',
    'specs' => [
      ['icon' => 'bi-people-fill', 'label' => '7 Seats'],
      ['icon' => 'bi-briefcase-fill', 'label' => 'Premium XL'],
    ],
  ],
];
?>

<!-- ============ Why Choose PowerCabs ============ -->
<section class="section-pc bg-white">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6 ps-lg-5">
        <h2 class="mb-3">Built Around Every Journey.</h2>
        <p class="text-muted-pc mb-4">
          From instant bookings to trusted drivers, every detail is designed
          to make travelling across Ireland effortless, reliable and affordable.
        </p>

        <div class="row row-cols-2 g-0 pc-feature-grid">
          <div class="col pe-4 pb-4 border-end border-bottom">
            <span class="d-block fw-bold mb-1" style="font-size: 1.4rem; color: #fee8da;">01</span>
            <h5 class="fw-bold mb-2">Instant Booking</h5>
            <p class="text-secondary mb-0 small">Book a ride in seconds through the app or website.</p>
          </div>
          <div class="col ps-4 pb-4 border-bottom">
            <span class="d-block fw-bold mb-1" style="font-size: 1.4rem; color: #fee8da;">02</span>
            <h5 class="fw-bold mb-2">Trusted Drivers</h5>
            <p class="text-secondary mb-0 small">Fully licensed, Garda-vetted professionals.</p>
          </div>
          <div class="col pe-4 pt-4 border-end">
            <span class="d-block fw-bold mb-1" style="font-size: 1.4rem;color: #fee8da;">03</span>
            <h5 class="fw-bold mb-2">Fair Pricing</h5>
            <p class="text-secondary mb-0 small">Transparent fares with no hidden charges.</p>
          </div>
          <div class="col ps-4 pt-4">
            <span class="d-block fw-bold mb-1" style="font-size: 1.4rem; color: #fee8da;">04</span>
            <h5 class="fw-bold mb-2">Available 24/7</h5>
            <p class="text-secondary mb-0 small">Your ride is ready whenever you need it.</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="rounded-4 overflow-hidden">
          <img src="<?= $assetPath ?>assets/img/book-your-cab.gif" alt="Booking a PowerCabs ride from the app" class="w-100 h-100 object-fit-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<section class="pc-rides-parallax" id="pcRidesParallax">
  <div class="pc-rides-sticky" id="pcRidesSticky">
    <div class="container">
      <div class="text-center mb-4">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Ride Types</p>
        <h2 class="mb-3">A Ride for Every Need</h2>
        <div class="pc-ride-dots" id="pcRideDots">
          <?php foreach ($rideTypes as $i => $ride): ?>
            <span class="pc-ride-dot <?= $i === 0 ? 'is-active' : '' ?>" data-index="<?= $i ?>" aria-hidden="true"></span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="pc-ride-card-stack" id="pcRideCardStack">
        <?php foreach ($rideTypes as $i => $ride): ?>
          <div class="pc-ride-stack-card <?= $i === 0 ? 'is-active' : '' ?>" data-index="<?= $i ?>" style="z-index: <?= $i + 1 ?>;">
            <div class="pc-ride-stack-card-text">
              <h3 class="pc-ride-panel-title"><?= htmlspecialchars($ride['title']) ?></h3>
              <p class="pc-ride-panel-desc"><?= htmlspecialchars($ride['desc']) ?></p>
              <div class="d-flex flex-wrap gap-2">
                <?php foreach ($ride['specs'] as $spec): ?>
                  <span class="pc-ride-spec">
                    <span class="pc-ride-spec-icon"><i class="bi <?= $spec['icon'] ?>"></i></span>
                    <?= htmlspecialchars($spec['label']) ?>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="pc-ride-stack-card-image">
              <img src="<?= $assetPath ?>assets/img/rides-types/<?= $ride['img'] ?>" alt="PowerCabs <?= htmlspecialchars($ride['title']) ?>" loading="<?= $i === 0 ? 'eager' : 'lazy' ?>">
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </div>

  <div class="pc-ride-triggers" id="pcRideTriggers" aria-hidden="true">
    <?php foreach ($rideTypes as $ride): ?><div class="pc-ride-trigger"></div><?php endforeach; ?>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/rides-parallax.js"></script>

<?php require __DIR__ . '/components/simple-steps.php'; ?>

<!-- ============ Final CTA ============ -->
<section class="position-relative overflow-hidden text-center text-white" style="padding-block: clamp(3.5rem, 7vw, 5.5rem);">
  <img src="https://images.pexels.com/photos/15067166/pexels-photo-15067166.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: 0;" loading="lazy">
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true" style="background: rgba(10, 7, 5, 0.78); z-index: 0;"></span>
  <div class="container position-relative">
    <h2 class="text-white mb-4">Get Ready to Ride Ireland!</h2>
    <a class="btn btn-pc-primary btn-md px-5" href="<?= $assetPath ?>/download-app.php">Download the App</a>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
