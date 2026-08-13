<?php
$pageTitle       = 'Loyalty Program | PowerCabs';
$pageDescription = "PowerCabs's driver Loyalty Program -- earn points for completed trips and unlock Bronze, Silver and Gold rewards as you progress.";
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Drivers';
$heroTitleLight  = 'Loyalty';
$heroTitleBold   = 'Program.';
$heroDescription = 'Rewarding your commitment and hard work -- PowerCabs rewards drivers for their dedication through a points-based loyalty program.';
$heroBgImage     = 'https://images.pexels.com/photos/35119581/pexels-photo-35119581.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$howItWorks = [
  ['n' => 1, 'title' => 'Sign Up'],
  ['n' => 2, 'title' => 'Complete Rides'],
  ['n' => 3, 'title' => 'Earn Points'],
  ['n' => 4, 'title' => 'Redeem Rewards'],
];

$tiers = [
  [
    'name' => 'Bronze', 'featured' => false,
    'items' => ['4 points per trip', '20 trips = 80 points', '10% priority', 'Pre-book advantages'],
  ],
  [
    'name' => 'Silver', 'featured' => true,
    'items' => ['6 points per trip', '40 trips = 240 points', '9.5% priority', 'Pre-book priority', 'Customer support', '45% higher chance of priority trips'],
  ],
  [
    'name' => 'Gold', 'featured' => false,
    'items' => ['8 points per trip', '70 trips = 560 points', '9% priority', 'High pre-book priority', 'Priority support', 'Social media recognition', 'Higher-value trip opportunities'],
  ],
];

$requirements = ['Enroll in the program', 'Complete rides', 'Redeem incentives', 'Maintain 80% ride acceptance rate'];
?>

<!-- ============ Introduction ============ -->
<section class="section-pc text-center">
  <div class="container" style="max-width: 720px;">
    <p class="text-muted-pc mb-0">
      PowerCabs rewards drivers for their dedication through a points-based loyalty program.
      Drivers earn points for completed trips and unlock better rewards as they progress.
    </p>
  </div>
</section>

<!-- ============ How It Works ============ -->
<section class="pb-5">
  <div class="container">
    <div class="row g-3">
      <?php foreach ($howItWorks as $step): ?>
        <div class="col-6 col-lg-3">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100 text-center">
            <span class="pc-story-star-icon mx-auto mb-3"><?= $step['n'] ?></span>
            <h3 class="fs-6 fw-bold mb-0"><?= htmlspecialchars($step['title']) ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Membership Levels ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Membership Levels</p>
      <h2 class="mb-0">Drive More, Earn More</h2>
    </div>
    <div class="row g-4 align-items-start">
      <?php foreach ($tiers as $tier): ?>
        <div class="col-md-4">
          <div class="rounded-4 p-4 h-100 <?= $tier['featured'] ? 'bg-white' : 'bg-white' ?>" style="box-shadow: <?= $tier['featured'] ? 'var(--pc-shadow-md)' : 'var(--pc-shadow-sm)' ?>; <?= $tier['featured'] ? 'border: 2px solid var(--pc-orange);' : '' ?> transform: <?= $tier['featured'] ? 'translateY(-8px)' : 'none' ?>;">
            <?php if ($tier['featured']): ?>
              <span class="badge rounded-pill mb-3" style="background: var(--pc-orange); color: #fff;">Most Popular</span>
            <?php endif; ?>
            <h3 class="fs-4 fw-bold mb-3"><?= htmlspecialchars($tier['name']) ?></h3>
            <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
              <?php foreach ($tier['items'] as $item): ?>
                <li class="d-flex gap-2 small">
                  <i class="bi bi-check-circle-fill mt-1" style="color: var(--pc-orange);"></i>
                  <span class="text-muted-pc"><?= htmlspecialchars($item) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Requirements ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Requirements</p>
      <h2 class="mb-0">Stay Eligible, Keep Earning</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-4 g-0 border-top border-start">
        <?php foreach ($requirements as $i => $req): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <span class="pc-story-star-icon mb-3"><?= $i + 1 ?></span>
            <p class="small fw-semibold mb-0"><?= htmlspecialchars($req) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="section-pc text-center">
  <div class="container">
    <h2 class="mb-4">Start Earning Loyalty Points Today</h2>
    <a class="btn btn-pc-primary btn-md px-5" href="<?= $assetPath ?>/download-our-app">Download the Driver App</a>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
