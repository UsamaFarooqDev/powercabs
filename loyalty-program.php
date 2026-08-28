<?php
$pageTitle = 'Loyalty Program | PowerCabs';
$pageDescription =
  "PowerCabs's driver Loyalty Program -- earn points for completed trips and unlock Bronze, Silver and Gold rewards as you progress.";
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Drivers';
$heroTitleLight = 'Loyalty';
$heroTitleBold = 'Program.';
$heroDescription =
  'Rewarding your commitment and hard work -- PowerCabs rewards drivers for their dedication through a points-based loyalty program.';
$heroBgImage = 'https://images.pexels.com/photos/35119581/pexels-photo-35119581.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$howItWorks = [
  ['n' => 1, 'title' => 'Sign Up', 'icon' => 'bi-person-plus-fill'],
  ['n' => 2, 'title' => 'Complete Rides', 'icon' => 'bi-car-front-fill'],
  ['n' => 3, 'title' => 'Earn Points', 'icon' => 'bi-star-fill'],
  ['n' => 4, 'title' => 'Redeem Rewards', 'icon' => 'bi-gift-fill'],
];

$tiers = [
  [
    'name' => 'Bronze',
    'featured' => false,
    'color' => '#cd7f32',
    'items' => ['4 points per trip', '20 trips = 80 points', '10% priority', 'Pre-book advantages'],
  ],
  [
    'name' => 'Silver',
    'featured' => true,
    'color' => '#8a8f98',
    'items' => [
      '6 points per trip',
      '40 trips = 240 points',
      '9.5% priority',
      'Pre-book priority',
      'Customer support',
      '45% higher chance of priority trips',
    ],
  ],
  [
    'name' => 'Gold',
    'featured' => false,
    'color' => '#c99a2e',
    'items' => [
      '8 points per trip',
      '70 trips = 560 points',
      '9% priority',
      'High pre-book priority',
      'Priority support',
      'Social media recognition',
      'Higher-value trip opportunities',
    ],
  ],
];

$requirements = [
  ['n' => 1, 'title' => 'Enroll in the program', 'icon' => 'bi-clipboard-check-fill'],
  ['n' => 2, 'title' => 'Complete rides', 'icon' => 'bi-car-front-fill'],
  ['n' => 3, 'title' => 'Redeem incentives', 'icon' => 'bi-gift-fill'],
  ['n' => 4, 'title' => 'Maintain 80% ride acceptance rate', 'icon' => 'bi-shield-check'],
];

/**
 * Splits a leading numeric/percentage token off a tier stat string for the
 * headline number (e.g. "4 points per trip" -> ["4", "points per trip"]) --
 * a display-layer split only; the underlying $tiers wording is untouched.
 */
function pc_loyalty_split_stat(string $item): array
{
  if (preg_match('/^([\d.]+%?)\s+(.*)$/', $item, $m)) {
    return [$m[1], $m[2]];
  }
  return [null, $item];
}

/**
 * Shared connected-timeline renderer -- used by both "How It Works" and
 * "Requirements" below (same markup/CSS, different icons/content) instead
 * of duplicating the layout per section.
 *
 * @param array<int,array{n:int,title:string,icon:string}> $items
 */
function pc_render_loyalty_timeline(array $items): void
{
  ?>
  <div class="pc-loyalty-timeline">
    <span class="pc-loyalty-timeline-line" aria-hidden="true"></span>
    <?php foreach ($items as $item): ?>
      <div class="pc-loyalty-timeline-item pc-reveal">
        <span class="pc-loyalty-timeline-icon">
          <i class="bi <?= htmlspecialchars($item['icon']) ?>" aria-hidden="true"></i>
          <span class="pc-loyalty-timeline-num"><?= (int) $item['n'] ?></span>
        </span>
        <div class="pc-loyalty-timeline-card">
          <h3 class="pc-loyalty-timeline-title"><?= htmlspecialchars($item['title']) ?></h3>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php
}
?>

<div class="pc-loyalty-glow-top">
  <!-- ============ Introduction ============ -->
  <section class="section-pc pb-4 text-center">
    <div class="container" style="max-width: 720px;">
      <p class="pc-loyalty-intro text-muted-pc mb-0">
        PowerCabs rewards drivers for their dedication through a points-based loyalty program.
        Drivers earn points for completed trips and unlock better rewards as they progress.
      </p>
    </div>
  </section>

  <!-- ============ How It Works ============ -->
  <section class="section-pc pt-3">
    <div class="container" style="max-width: 1040px;">
      <?php pc_render_loyalty_timeline($howItWorks); ?>
    </div>
  </section>
</div>

<!-- ============ Membership Levels ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Membership Levels</p>
      <h2 class="mb-0">Drive More, Earn More</h2>
    </div>
    <div class="row g-4 align-items-start">
      <?php foreach ($tiers as $tier):

        [$pointsValue, $pointsLabel] = pc_loyalty_split_stat($tier['items'][0] ?? '');
        $milestoneText = $tier['items'][1] ?? null;
        $priorityText = $tier['items'][2] ?? null;
        $remainingPerks = array_slice($tier['items'], 3);
        ?>
        <div class="col-md-4">
          <div class="pc-loyalty-tier pc-reveal<?= $tier['featured']
            ? ' pc-loyalty-tier-featured'
            : '' ?>" style="--tier-color: <?= htmlspecialchars($tier['color']) ?>;">
            <?php if ($tier['featured']): ?>
              <span class="pc-loyalty-tier-popular"><i class="bi bi-star-fill" aria-hidden="true"></i> Most Popular</span>
            <?php endif; ?>

            <span class="pc-loyalty-tier-medal"><i class="bi bi-award-fill" aria-hidden="true"></i></span>
            <h3 class="pc-loyalty-tier-name"><?= htmlspecialchars($tier['name']) ?></h3>

            <?php if ($pointsValue !== null): ?>
              <div class="pc-loyalty-tier-stat">
                <span class="pc-loyalty-tier-stat-value"><?= htmlspecialchars($pointsValue) ?></span>
                <span class="pc-loyalty-tier-stat-label"><?= htmlspecialchars($pointsLabel) ?></span>
              </div>
            <?php endif; ?>

            <div class="pc-loyalty-tier-row">
              <?php if ($milestoneText): ?>
                <span class="pc-loyalty-tier-chip"><i class="bi bi-flag-fill" aria-hidden="true"></i> <?= htmlspecialchars(
                  $milestoneText,
                ) ?></span>
              <?php endif; ?>
              <?php if ($priorityText): ?>
                <span class="pc-loyalty-tier-chip"><i class="bi bi-lightning-charge-fill" aria-hidden="true"></i> <?= htmlspecialchars(
                  $priorityText,
                ) ?></span>
              <?php endif; ?>
            </div>

            <hr class="pc-loyalty-tier-divider">

            <ul class="list-unstyled d-flex flex-column gap-2 mb-0 text-start">
              <?php foreach ($remainingPerks as $item): ?>
                <li class="d-flex gap-2 small">
                  <i class="bi bi-check-circle-fill mt-1" style="color: var(--tier-color);" aria-hidden="true"></i>
                  <span class="text-muted-pc"><?= htmlspecialchars($item) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php
      endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Why It Works (bento) ============ -->
<section class="section-pc bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why It Works</p>
      <h2 class="mb-0">Loyalty That Actually Pays Off</h2>
    </div>

    <div class="pc-loyalty-bento">
      <div class="pc-loyalty-bento-cell pc-loyalty-bento-img pc-reveal">
        <div class="pc-service-card d-block position-relative overflow-hidden h-100" style="border-radius: var(--pc-radius-lg);">
          <img src="https://images.pexels.com/photos/31335088/pexels-photo-31335088.jpeg?auto=format&fit=crop&w=1200&q=60" alt="A happy PowerCabs driver at the wheel of her taxi at night" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
          <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-4">
            <span class="pc-service-card-title d-block fs-5 fw-bold">Every completed ride moves you closer to your next reward.</span>
          </span>
        </div>
      </div>

      <div class="pc-loyalty-bento-cell pc-loyalty-bento-stat pc-reveal">
        <span class="pc-loyalty-bento-stat-value">3</span>
        <span class="pc-loyalty-bento-stat-label">Membership tiers to climb</span>
      </div>

      <div class="pc-loyalty-bento-cell pc-loyalty-bento-stat pc-reveal">
        <span class="pc-loyalty-bento-stat-value">45%</span>
        <span class="pc-loyalty-bento-stat-label">Higher chance of priority trips at Silver+</span>
      </div>

      <div class="pc-loyalty-bento-cell pc-loyalty-bento-secondary-img pc-reveal">
        <div class="pc-service-card d-block position-relative overflow-hidden h-100" style="border-radius: var(--pc-radius-lg);">
          <img src="https://images.pexels.com/photos/36712857/pexels-photo-36712857.jpeg?auto=format&fit=crop&w=1200&q=60" alt="Two people shaking hands" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
          <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-3">
            <span class="pc-service-card-title d-block fs-6 fw-bold">Priority support, every step of the way.</span>
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Requirements ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <span class="pc-loyalty-requirements-glow" aria-hidden="true"></span>
  <div class="container position-relative" style="max-width: 1040px; z-index: 1;">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Requirements</p>
      <h2 class="mb-0">Stay Eligible, Keep Earning</h2>
    </div>
    <?php pc_render_loyalty_timeline($requirements); ?>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
