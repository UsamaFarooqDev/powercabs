<?php
$bizAccountBenefits = [
  ['icon' => 'bi-person-workspace', 'title' => 'One Account', 'desc' => "Manage your team's travel from one place -- book for anyone, anytime."],
  ['icon' => 'bi-receipt', 'title' => 'Simple Billing', 'desc' => 'Keep every business journey on one consolidated invoice, with no hidden charges.'],
  ['icon' => 'bi-graph-up', 'title' => 'Full Visibility', 'desc' => 'See journeys, spend and activity across your whole organisation as it happens.'],
];
?>
<section class="pc-biz-band-a section-pc">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Your Business Account</p>
        <h2 class="mb-4" style="font-size: clamp(1.8rem, 3vw, 2.4rem);">Your business. Your account.<br>Your taxi service.</h2>

        <div class="row row-cols-1 row-cols-md-3 g-3">
          <?php foreach ($bizAccountBenefits as $benefit): ?>
            <div class="col">
              <div class="pc-biz-benefit-card h-100 text-center rounded-4 border bg-white p-3 p-lg-4" style="border-color: rgba(28, 20, 16, .08) !important;">
                <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-2" style="width: 3rem; height: 3rem; background: var(--pc-peach); color: var(--pc-orange); font-size: 1.25rem;">
                  <i class="bi <?= $benefit['icon'] ?>"></i>
                </span>
                <h3 class="fs-6 fw-bold mb-1"><?= htmlspecialchars($benefit['title']) ?></h3>
                <p class="small text-muted-pc mb-0"><?= htmlspecialchars($benefit['desc']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-lg-6">
        <!-- Lightweight illustration of the PowerCabs Business account -- a
             visual mockup in the site's own UI language, not a screenshot. -->
        <div class="pc-biz-dash-card mx-auto" style="max-width: 420px;">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <span class="d-flex align-items-center gap-2 fw-bold">
              <img src="<?= $assetPath ?>assets/img/powercabs-horse-icon.png" alt="" width="22" height="22" aria-hidden="true">
              PowerCabs Business
            </span>
            <span class="badge rounded-pill fw-medium" style="background: rgba(25,135,84,.12); color: #198754; font-size: .68rem;">Account Active</span>
          </div>

          <div class="row row-cols-1 row-cols-sm-2 g-3 mb-4">
            <div class="col">
              <div class="pc-biz-dash-stat rounded-4">
                <span class="pc-biz-dash-stat-value d-block">128</span>
                <span class="pc-biz-dash-stat-label d-block">Bookings this month</span>
              </div>
            </div>
            <div class="col">
              <div class="pc-biz-dash-stat rounded-4">
                <span class="pc-biz-dash-stat-value d-block">6</span>
                <span class="pc-biz-dash-stat-label d-block">Active journeys</span>
              </div>
            </div>
            <div class="col">
              <div class="pc-biz-dash-stat rounded-4">
                <span class="pc-biz-dash-stat-value d-block">&euro;2,340</span>
                <span class="pc-biz-dash-stat-label d-block">Monthly spend</span>
              </div>
            </div>
            <div class="col">
              <div class="pc-biz-dash-stat rounded-4">
                <span class="pc-biz-dash-stat-value d-block">14</span>
                <span class="pc-biz-dash-stat-label d-block">Team members</span>
              </div>
            </div>
          </div>

          <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-text-muted);">Recent Journeys</p>
          <div class="d-flex flex-column">
            <div class="pc-biz-dash-row d-flex align-items-center gap-3">
              <i class="bi bi-airplane-fill flex-shrink-0" style="color: var(--pc-orange);"></i>
              <span class="flex-grow-1 small fw-medium">Dublin Office &rarr; Dublin Airport</span>
              <span class="small text-muted-pc">08:45</span>
            </div>
            <div class="pc-biz-dash-row d-flex align-items-center gap-3">
              <i class="bi bi-building flex-shrink-0" style="color: var(--pc-orange);"></i>
              <span class="flex-grow-1 small fw-medium">Client Site &rarr; City Centre</span>
              <span class="small text-muted-pc">Yesterday</span>
            </div>
            <div class="pc-biz-dash-row d-flex align-items-center gap-3">
              <i class="bi bi-cup-hot-fill flex-shrink-0" style="color: var(--pc-orange);"></i>
              <span class="flex-grow-1 small fw-medium">Hotel &rarr; Conference Centre</span>
              <span class="small text-muted-pc">Mon</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
