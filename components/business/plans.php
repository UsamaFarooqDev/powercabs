<?php
$bizPlans = [
  [
    'icon' => 'bi-briefcase',
    'name' => 'Small Business',
    'range' => '1&ndash;10 employees',
    'features' => ['Business account', 'Multiple users', 'Easy booking'],
    'cta' => 'Get Started',
    'href' => '#business-booking-form',
    'featured' => false,
  ],
  [
    'icon' => 'bi-briefcase-fill',
    'name' => 'Business Plus',
    'range' => '10&ndash;50 employees',
    'features' => ['Monthly billing', 'Journey reports', 'Priority service'],
    'cta' => 'Get Started',
    'href' => '#business-booking-form',
    'featured' => true,
  ],
  [
    'icon' => 'bi-building',
    'name' => 'Corporate',
    'range' => '50+ employees',
    'features' => ['Dedicated account support', 'Custom travel solutions', 'Corporate support'],
    'cta' => 'Contact Us',
    'href' => $assetPath . '/corporate-services',
    'featured' => false,
  ],
]; ?>
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Business Plans</p>
      <h2 class="mb-3">Built for Businesses of All Sizes</h2>
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 56ch; font-size: 1.05rem;">
        From a handful of employees to a whole organisation, PowerCabs Business
        scales with your team -- these are service tiers, not price bands.
      </p>
    </div>

    <div class="row g-4 justify-content-center">
      <?php foreach ($bizPlans as $plan): ?>
        <div class="col-md-6 col-lg-4">
          <div class="pc-biz-plan position-relative d-flex flex-column h-100<?= $plan['featured'] ? ' pc-biz-plan-featured' : '' ?>">
            <?php if ($plan['featured']): ?>
              <span class="pc-biz-plan-badge position-absolute rounded-pill text-white fw-bold text-uppercase">Most Popular</span>
            <?php endif; ?>

            <span class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 3rem; height: 3rem; background: var(--pc-peach); color: var(--pc-orange); font-size: 1.25rem;">
              <i class="bi <?= $plan['icon'] ?>"></i>
            </span>

            <h3 class="fs-4 fw-bold mb-1"><?= htmlspecialchars($plan['name']) ?></h3>
            <p class="text-muted-pc mb-4"><?= $plan['range'] ?></p>

            <ul class="list-unstyled d-flex flex-column gap-2 mb-4">
              <?php foreach ($plan['features'] as $feature): ?>
                <li class="d-flex align-items-center gap-2">
                  <i class="bi bi-check-circle-fill flex-shrink-0" style="color: var(--pc-orange);"></i>
                  <span><?= htmlspecialchars($feature) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>

            <a class="btn <?= $plan['featured']
              ? 'btn-pc-primary'
              : 'btn-pc-dark' ?> rounded-pill w-100 mt-auto" href="<?= htmlspecialchars($plan['href']) ?>">
              <?= htmlspecialchars($plan['cta']) ?>
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
