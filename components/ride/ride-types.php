<?php
/**
 * Ride page: "A Ride for Every Need" -- pinned scroll-through showcase
 * of every ride type. Requires $assetPath from the including page.
 */

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

<section class="pc-rides-parallax" id="pcRidesParallax">
  <div class="pc-rides-sticky d-flex align-items-center" id="pcRidesSticky">
    <div class="container">
      <div class="text-center mb-4">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Ride Types</p>
        <h2 class="mb-3">A Ride for Every Need</h2>
        <div class="d-flex justify-content-center gap-2 mt-2" id="pcRideDots">
          <?php foreach ($rideTypes as $i => $ride): ?>
            <span class="pc-ride-dot <?= $i === 0 ? 'is-active' : '' ?>" data-index="<?= $i ?>" aria-hidden="true"></span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="pc-ride-card-stack position-relative overflow-hidden" id="pcRideCardStack">
        <?php foreach ($rideTypes as $i => $ride): ?>
          <div class="pc-ride-stack-card overflow-hidden <?= $i === 0 ? 'is-active' : '' ?>" data-index="<?= $i ?>" style="z-index: <?= $i + 1 ?>;">
            <div class="pc-ride-stack-card-text d-flex flex-column justify-content-center">
              <h3 class="pc-ride-panel-title position-relative fw-bold"><?= htmlspecialchars($ride['title']) ?></h3>
              <p class="pc-ride-panel-desc position-relative mb-3"><?= htmlspecialchars($ride['desc']) ?></p>
              <div class="d-flex flex-wrap gap-2">
                <?php foreach ($ride['specs'] as $spec): ?>
                  <span class="pc-ride-spec position-relative d-inline-flex align-items-center">
                    <span class="pc-ride-spec-icon d-inline-flex align-items-center justify-content-center rounded-circle text-primary flex-shrink-0"><i class="bi <?= $spec['icon'] ?>"></i></span>
                    <?= htmlspecialchars($spec['label']) ?>
                  </span>
                <?php endforeach; ?>
              </div>
            </div>
            <div class="pc-ride-stack-card-image align-items-center justify-content-center">
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
