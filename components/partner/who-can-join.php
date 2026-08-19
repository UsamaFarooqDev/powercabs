<?php
$whoCanJoin = [
  ['icon' => 'bi-taxi-front-fill', 'label' => 'Taxi Operators', 'desc' => 'Running your own taxi and looking for more consistent bookings.'],
  ['icon' => 'bi-truck', 'label' => 'Fleet Owners', 'desc' => 'Managing multiple vehicles and drivers under one operation.'],
  ['icon' => 'bi-person-fill', 'label' => 'Independent Drivers', 'desc' => 'Driving solo and ready to plug into a bigger network.'],
  ['icon' => 'bi-building-fill', 'label' => 'Transport Companies', 'desc' => 'Established operators looking to expand their reach.'],
];
?>
<section class="pc-ptn-band-b section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Who Can Join</p>
      <h2 class="mb-0">Built for Every Kind of Operator</h2>
    </div>

    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <div class="pc-ptn-media-frame pc-ptn-media-frame-tall">
          <img src="<?= $assetPath ?>assets/img/ambassador-program.png" alt="A PowerCabs branded partner vehicle" loading="lazy" style="object-fit: contain; background: var(--pc-cream-soft);">
        </div>
      </div>

      <div class="col-lg-6">
        <div class="d-flex flex-column">
          <?php foreach ($whoCanJoin as $item): ?>
            <div class="pc-ride-service-item d-flex align-items-center gap-3">
              <span class="pc-ride-service-icon d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0">
                <i class="bi <?= $item['icon'] ?>" aria-hidden="true"></i>
              </span>
              <span class="flex-grow-1">
                <span class="d-block fw-bold" style="color: var(--pc-dark);"><?= htmlspecialchars($item['label']) ?></span>
                <span class="d-block small text-muted-pc"><?= htmlspecialchars($item['desc']) ?></span>
              </span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
