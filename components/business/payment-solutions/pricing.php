<section class="section-pc" style="background: linear-gradient(180deg, var(--pc-cream) 0%, var(--pc-cream) 85%, #ffffff 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="mb-3">Ready to Take Your Card Machine Journey to the Next Level?</h2>
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 64ch;">
        Our card reader payment solutions enable taxi drivers and hospitality businesses
        with secure, efficient and tailored card payment machine services.
      </p>
    </div>

    <div class="row g-4 justify-content-center">
      <?php
      $pricingPlans = [
        [
          'n' => 1, 'name' => 'PAX A50', 'price' => '9.99', 'for' => 'Taxi industry & small retail shops',
          'features' => ['Unbeatable transaction rates from 0.8%', "Low card reader rental fee from \u{20ac}9.99", 'NFC contactless', 'Deliver receipts by SMS or email'],
          'featured' => false,
        ],
        [
          'n' => 2, 'name' => 'PAX A920', 'price' => '14.99', 'for' => 'Hospitality businesses',
          'features' => ['Unbeatable transaction rates from 0.8%', "Low card reader rental fee from \u{20ac}14.99", 'NFC contactless', 'Deliver receipts by SMS, email or paper roll'],
          'featured' => true,
        ],
        [
          'n' => 3, 'name' => 'EPOS', 'price' => '29.99', 'for' => 'Shops & retail industry',
          'features' => ['Unbeatable transaction rates from 0.8%', "Low card reader rental fee from \u{20ac}29.99 (ex VAT)", 'NFC contactless', 'Deliver receipts by SMS, email or paper roll'],
          'featured' => false,
        ],
      ];
      ?>
      <?php foreach ($pricingPlans as $plan): ?>
        <div class="col-md-6 col-lg-4">
          <div class="pc-pricing-card position-relative bg-white h-100 p-4 pt-5<?= $plan['featured'] ? ' pc-pricing-card-featured' : '' ?>">
            <?php if ($plan['featured']): ?>
              <span class="pc-pricing-badge badge rounded-pill" style="background: var(--pc-orange); color: #fff; padding: .4rem .9rem;">Most Popular</span>
            <?php endif; ?>
            <div class="text-center mb-4">
              <span class="pc-story-star-icon mb-3"><?= $plan['n'] ?></span>
              <h3 class="fs-4 fw-bold mb-1"><?= htmlspecialchars($plan['name']) ?></h3>
              <p class="text-muted-pc small mb-2"><?= htmlspecialchars($plan['for']) ?></p>
              <p class="mb-0"><span class="fs-2 fw-bold" style="color: var(--pc-orange);">&euro;<?= htmlspecialchars($plan['price']) ?></span><span class="text-muted-pc"> / starting from</span></p>
            </div>
            <ul class="list-unstyled d-flex flex-column gap-2 mb-4">
              <?php foreach ($plan['features'] as $feature): ?>
                <li class="d-flex gap-2 small">
                  <i class="bi bi-check-circle-fill mt-1" style="color: var(--pc-orange);"></i>
                  <span class="text-muted-pc"><?= htmlspecialchars($feature) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
            <a href="#payment-apply-form" class="btn <?= $plan['featured'] ? 'btn-pc-primary' : 'btn-pc-dark' ?> w-100">Choose Plan</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4 mt-4 text-center">
      <?php
      $trustBadges = [
        ['icon' => 'bi-people-fill', 'label' => '100+ Drivers Onboarded'],
        ['icon' => 'bi-building', 'label' => 'Trusted by Local Businesses'],
        ['icon' => 'bi-credit-card-fill', 'label' => 'Thousands of Payments Processed'],
      ];
      ?>
      <?php foreach ($trustBadges as $badge): ?>
        <div class="col d-flex align-items-center justify-content-center gap-2">
          <span class="pc-ride-type-icon rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 2.5rem; height: 2.5rem; font-size: 1.1rem;">
            <i class="bi <?= $badge['icon'] ?>"></i>
          </span>
          <span class="fw-semibold"><?= htmlspecialchars($badge['label']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
