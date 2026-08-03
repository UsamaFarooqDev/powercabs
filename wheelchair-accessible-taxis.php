<?php
$pageTitle       = 'Wheelchair Accessible Taxis | PowerCabs';
$pageDescription = 'Safe, comfortable, fully accessible taxi services from PowerCabs -- trained drivers, secure wheelchair vehicles, and 24/7 availability across Ireland.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Accessibility';
$heroTitleLight  = 'Wheelchair';
$heroTitleBold   = 'Accessible Taxis.';
$heroDescription = 'PowerCabs provides safe, comfortable, and fully accessible taxi services for passengers with mobility needs. The service focuses on reliability, trained drivers, and vehicles equipped to safely transport wheelchair users.';
$heroBgImage     = 'https://images.pexels.com/photos/35831412/pexels-photo-35831412.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/inner-hero.php';

$keyFeatures = [
  ['icon' => 'bi-universal-access-circle', 'label' => 'Fully Accessible Vehicles'],
  ['icon' => 'bi-person-badge-fill',        'label' => 'Trained Drivers'],
  ['icon' => 'bi-shield-check',             'label' => 'Secure Wheelchair Fastening'],
  ['icon' => 'bi-arrows-angle-expand',      'label' => 'Spacious Interiors'],
  ['icon' => 'bi-emoji-smile',              'label' => 'Comfortable Travel'],
  ['icon' => 'bi-calendar-check',           'label' => 'Advance &amp; On-Demand Booking'],
  ['icon' => 'bi-airplane-fill',            'label' => 'Airport Transfers'],
  ['icon' => 'bi-heart-pulse-fill',         'label' => 'Hospital &amp; Medical Visits'],
  ['icon' => 'bi-signpost-split-fill',      'label' => 'Local &amp; Long-Distance'],
  ['icon' => 'bi-clock-fill',               'label' => '24/7 Availability'],
];

$whyChoose = [
  ['icon' => 'bi-shield-fill-check', 'title' => 'Safety First',    'desc' => 'Every accessible vehicle and driver meets strict safety standards.'],
  ['icon' => 'bi-clock-history',     'title' => 'Reliable Service', 'desc' => 'Punctual pickups you can plan appointments and travel around.'],
  ['icon' => 'bi-phone-fill',        'title' => 'Easy Booking',     'desc' => 'Book in seconds through the app, website, or a quick phone call.'],
  ['icon' => 'bi-hand-thumbs-up-fill','title' => 'Friendly Assistance', 'desc' => 'Drivers trained to help confidently and respectfully, every trip.'],
  ['icon' => 'bi-people-fill',       'title' => 'Accessible for Everyone', 'desc' => 'Inclusive transportation, wherever and whenever you need it.'],
];
?>

<!-- ============ Overview ============ -->
<section class="section-pc text-center">
  <div class="container" style="max-width: 780px;">
    <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Overview</p>
    <h2 class="mb-3">Reliable, Dignified Travel for Every Passenger</h2>
    <p class="text-muted-pc mb-0">
      PowerCabs provides safe, comfortable, and fully accessible taxi services for passengers
      with mobility needs. The service focuses on reliability, trained drivers, and vehicles
      equipped to safely transport wheelchair users, on every kind of journey.
    </p>
  </div>
</section>

<!-- ============ Key Features ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Key Features</p>
      <h2 class="mb-0">Built for Comfort and Confidence</h2>
    </div>
    <div class="row row-cols-2 row-cols-md-5 g-3">
      <?php foreach ($keyFeatures as $item): ?>
        <div class="col">
          <div class="pc-story-card rounded-4 p-3 bg-white h-100 text-center" style="box-shadow: var(--pc-shadow-sm);">
            <i class="bi <?= $item['icon'] ?> fs-3 mb-2 d-block" style="color: var(--pc-orange);"></i>
            <span class="d-block small fw-semibold"><?= $item['label'] ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Why Choose PowerCabs ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why Choose PowerCabs</p>
      <h2 class="mb-0">Accessible Travel, Done Right</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-lg-5 g-0 border-top border-start">
        <?php foreach ($whyChoose as $item): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-2 pc-why-item-title"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="small text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="section-pc text-center">
  <div class="container">
    <h2 class="mb-4">Book a Wheelchair Accessible Ride</h2>
    <a class="btn btn-pc-primary btn-md px-5" href="<?= $assetPath ?>/book-ride-online.php">Book Online</a>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
