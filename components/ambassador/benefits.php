<?php
// Same six benefits as before, unchanged -- only the presentation changes.
// Order kept as-is; the first card becomes the visually dominant "feature"
// tile and the rest fill out an asymmetric bento grid around it. Every
// card except the feature tile now carries a real photo instead of a flat
// white background.
$benefits = [
  [
    'icon' => 'bi-credit-card-2-front-fill',
    'title' => 'Free Card Terminals',
    'items' => ['Save &euro;120/year', '0.8% transaction fee', 'Accept more card payments', 'Increase earnings'],
    'image' => null,
  ],
  [
    'icon' => 'bi-car-front-fill',
    'title' => 'Exclusive Vehicle Branding',
    'items' => ['Roof branding', 'Door branding', 'Rear branding', 'More passenger visibility'],
    'image' => 'ambassador-program.png',
  ],
  [
    'icon' => 'bi-fuel-pump-fill',
    'title' => 'Fuel Discounts',
    'items' => ['Save &euro;200&ndash;500 annually', 'Nationwide fuel partners', 'Discount on every refill'],
    'image' => 'https://images.pexels.com/photos/20500733/pexels-photo-20500733.jpeg?auto=compress&cs=tinysrgb&w=900',
  ],
  [
    'icon' => 'bi-star-fill',
    'title' => 'Extra Loyalty Points',
    'items' => ['+2 points on every completed trip'],
    'image' => 'https://images.pexels.com/photos/38472818/pexels-photo-38472818.jpeg?auto=compress&cs=tinysrgb&w=900',
  ],
  [
    'icon' => 'bi-bag-heart-fill',
    'title' => 'Swag Pack',
    'items' => ['Jacket or Gilet', 'PowerCabs merchandise'],
    'image' => 'https://images.pexels.com/photos/6044143/pexels-photo-6044143.jpeg?auto=compress&cs=tinysrgb&w=900',
  ],
  [
    'icon' => 'bi-headset',
    'title' => 'Dedicated Support',
    'items' => ['Priority assistance', 'Dedicated Ambassador team'],
    'image' => 'https://images.pexels.com/photos/8867630/pexels-photo-8867630.jpeg?auto=compress&cs=tinysrgb&w=900',
  ],
];
// Bento sizing per card index -- one dominant feature, two "wide" cards,
// two standard cards. Keeps the grid asymmetric instead of six equal boxes.
$bizAmbSpans = [
  'pc-amb-card-feature',
  'pc-amb-card-wide',
  'pc-amb-card-normal',
  'pc-amb-card-normal',
  'pc-amb-card-wide',
  'pc-amb-card-wide',
];
?>
<section class="pc-amb-benefits position-relative overflow-hidden" id="pcAmbBenefits">
  <span class="pc-amb-grain" aria-hidden="true"></span>
  <span class="pc-drive-blob pc-drive-blob-orange" aria-hidden="true"></span>
  <span class="pc-amb-blob-soft" aria-hidden="true"></span>
  <svg class="pc-amb-lines" width="100%" height="100%" preserveAspectRatio="none" aria-hidden="true">
    <line x1="0" y1="18%" x2="100%" y2="18%"></line>
    <line x1="0" y1="82%" x2="100%" y2="82%"></line>
  </svg>

  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Benefits</p>
      <h2 class="mb-0">Everything You Get as an Ambassador</h2>
    </div>

    <div class="pc-amb-benefits-grid">
      <?php foreach ($benefits as $i => $b): ?>
        <?php $isFeature = $i === 0; ?>
        <div class="pc-amb-card <?=
        ($bizAmbSpans[$i] ?? 'pc-amb-card-normal') . ($isFeature ? '' : ' pc-amb-card-photo')
        ?>">
          <?php if (!$isFeature): ?>
            <img src="<?= htmlspecialchars(
              str_starts_with($b['image'], 'http') ? $b['image'] : $assetPath . 'assets/img/' . $b['image'],
            ) ?>" alt="" aria-hidden="true" class="pc-amb-card-bg" loading="lazy">
            <span class="pc-amb-card-tint" aria-hidden="true"></span>
          <?php endif; ?>
          <div class="pc-amb-card-content">
            <span class="pc-amb-card-icon d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0">
              <i class="bi <?= $b['icon'] ?>"></i>
            </span>
            <h3 class="fs-5 fw-bold mb-3"><?= htmlspecialchars($b['title']) ?></h3>
            <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
              <?php foreach ($b['items'] as $item): ?>
                <li class="d-flex align-items-center gap-2 small">
                  <i class="bi bi-check-circle-fill flex-shrink-0" style="color: var(--pc-orange);"></i>
                  <span><?= $item ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
