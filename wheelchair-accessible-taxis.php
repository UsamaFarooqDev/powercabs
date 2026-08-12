<?php
$pageTitle = 'Wheelchair Accessible Taxis in Dublin | PowerCabs';
$pageDescription =
  'Wheelchair accessible taxis in Dublin from PowerCabs -- safe, comfortable rides with trained drivers, secure wheelchair vehicles, and 24/7 availability across Ireland.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Accessibility';
$heroTitleLight = 'Wheelchair';
$heroTitleBold = 'Accessible Taxis.';
$heroDescription =
  'PowerCabs provides safe, comfortable, and fully accessible taxi services for passengers with mobility needs. The service focuses on reliability, trained drivers, and vehicles equipped to safely transport wheelchair users.';
$heroBgImage = 'https://images.pexels.com/photos/35831412/pexels-photo-35831412.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$whyChoose = [
  [
    'icon' => 'bi-shield-fill-check',
    'title' => 'Safety First',
    'desc' => 'Every accessible vehicle and driver meets strict safety standards.',
  ],
  [
    'icon' => 'bi-clock-history',
    'title' => 'Reliable Service',
    'desc' => 'Punctual pickups you can plan appointments and travel around.',
  ],
  [
    'icon' => 'bi-phone-fill',
    'title' => 'Easy Booking',
    'desc' => 'Book in seconds through the app, website, or a quick phone call.',
  ],
  [
    'icon' => 'bi-hand-thumbs-up-fill',
    'title' => 'Friendly Assistance',
    'desc' => 'Drivers trained to help confidently and respectfully, every trip.',
  ],
  [
    'icon' => 'bi-people-fill',
    'title' => 'Accessible for Everyone',
    'desc' => 'Inclusive transportation, wherever and whenever you need it.',
  ],
];
?>

<!-- ============ Overview ============ -->
<section class="section-pc text-center">
  <div class="container" style="max-width: 780px;">
    <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Overview
    </p>
    <h2 class="mb-3">Reliable, Dignified Travel for Every Passenger</h2>
    <p class="text-muted-pc mb-0" style="font-size: 1.2rem; line-height: 1.7;">
      PowerCabs provides safe, comfortable, and fully accessible taxi services for passengers
      with mobility needs. The service focuses on reliability, trained drivers, and vehicles
      equipped to safely transport wheelchair users, on every kind of journey.
    </p>
  </div>
</section>

<section class="section-pc position-relative overflow-hidden"
  style="background: linear-gradient(180deg, #ffffff 0%, var(--pc-cream) 15%, var(--pc-cream) 85%, #ffffff 100%);">
  <div class="position-absolute rounded-circle" aria-hidden="true" style="
      width: 24rem;
      height: 24rem;
      top: -8rem;
      right: -7rem;
      background: radial-gradient(
        circle,
        rgba(232, 89, 12, .16),
        transparent 68%
      );
    "></div>

  <div class="container position-relative">

    <div class="row align-items-center g-4 g-lg-5">
      <div class="col-lg-6 p-2 p-lg-5">

        <div class="position-relative mx-auto">

          <!-- Decorative orange shape -->
          <div class="position-absolute rounded-5" aria-hidden="true" style="
              width: 150px;
              height: 150px;
              right: -20px;
              bottom: -20px;
              background: var(--pc-orange);
              opacity: .12;
              filter: blur(2px);
            "></div>

          <!-- Image -->
          <div class="position-relative overflow-hidden rounded-5" style="
              min-height: 420px;
              box-shadow: var(--pc-shadow-lg);
            ">

            <img src="<?= $assetPath ?>assets/img/wheelchair-accessible.png"
              alt="PowerCabs wheelchair accessible taxi in Dublin" class="w-100 h-100" loading="lazy" style="
                            position: absolute;
                            inset: 0;
                            object-fit: cover;
                            object-position: center;
                          ">

          </div>

        </div>
      </div>
      <!-- ================= CONTENT ================= -->
      <div class="col-lg-6 p-2 p-lg-5">
        <div class="ps-lg-3">
          <h2 class="fw-bold mb-3" style="
              font-size: clamp(32px, 4vw, 48px);
              line-height: 1.08;
              letter-spacing: -.9px;
            ">
            Mobility for
            <span style="color: var(--pc-orange);">
              everyone.
            </span>
          </h2>

          <p class="text-muted-pc mb-4" style="
              font-size: 16px;
              line-height: 1.75;
              max-width: 500px;
            ">
            At PowerCabs, we're committed to making every journey
            comfortable, safe and accessible. Our wheelchair-accessible
            taxis are designed to provide dependable transportation
            for passengers with mobility needs.
          </p>


          <!-- Feature highlights -->
          <div class="d-flex flex-column gap-3 mb-4">

            <div class="d-flex align-items-start gap-3">

              <span class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-circle" style="
                  width: 40px;
                  height: 40px;
                  background: rgba(232,89,12,.10);
                  color: var(--pc-orange);
                ">
                <i class="bi bi-universal-access"></i>
              </span>

              <div>
                <h3 class="h6 fw-bold mb-1">
                  Wheelchair Accessible
                </h3>

                <p class="text-muted-pc small mb-0">
                  Vehicles equipped to accommodate wheelchair users
                  comfortably.
                </p>
              </div>
            </div>

            <div class="d-flex align-items-start gap-3">

              <span class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-circle" style="
                  width: 40px;
                  height: 40px;
                  background: rgba(232,89,12,.10);
                  color: var(--pc-orange);
                ">
                <i class="bi bi-shield-check"></i>
              </span>

              <div>
                <h3 class="h6 fw-bold mb-1">
                  Safe & Comfortable
                </h3>

                <p class="text-muted-pc small mb-0">
                  Supportive journeys with accessibility and passenger
                  comfort in mind.
                </p>
              </div>
            </div>
          </div>

          <div class="d-flex flex-wrap align-items-center gap-3">
            <a class="btn btn-pc-primary btn-md px-3" href="<?= $assetPath ?>/book-ride-online.php">Book an Accessible
              Ride</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Why Choose PowerCabs ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why
        Choose PowerCabs</p>
      <h2 class="mb-0">Accessible Travel, Done Right</h2>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-4">
      <?php foreach (array_slice($whyChoose, 0, 3) as $item): ?>
        <div class="col">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100 text-center">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-2"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="small text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 g-4 justify-content-center" style="max-width: 700px; margin-inline: auto;">
      <?php foreach (array_slice($whyChoose, 3, 2) as $item): ?>
        <div class="col">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100 text-center">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-2"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="small text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
