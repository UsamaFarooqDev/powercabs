<?php
// "More miles. More visibility." -- combines what used to be two separate
// sections (Benefits + Who Can Join) into the reference design's single
// campaign-card + info-sidebar layout.
$partnerBenefits = ['Grow your business', 'Increased bookings', 'Dedicated support', 'Weekly payments'];
$partnerWhyChoose = ['Marketing support', 'Technology platform', 'Driver &amp; fleet management'];

$whoCanJoin = [
  ['icon' => 'bi-taxi-front-fill', 'label' => 'Taxi Operators'],
  ['icon' => 'bi-truck', 'label' => 'Fleet Owners'],
  ['icon' => 'bi-person-fill', 'label' => 'Independent Drivers'],
  ['icon' => 'bi-building-fill', 'label' => 'Transport Companies'],
];
?>
<section class="pc-ptn-campaign section-pc" id="pcPtnCampaign" style="scroll-margin-top: 6rem;">
  <div class="container">
    <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Partner Programme</p>
    <h2 class="pc-ptn-campaign-title mb-3">More miles. More visibility.</h2>
    <p class="text-muted-pc mb-5" style="max-width: 62ch; font-size: 1.08rem;">
      Join the network, follow a simple set of steps to get onboarded, and start
      receiving more consistent bookings across the PowerCabs platform.
    </p>

    <div class="row g-4">
      <div class="col-lg-7">
        <article class="pc-ptn-campaign-card overflow-hidden h-100">
          <span class="pc-ptn-campaign-badge d-inline-flex rounded-pill text-primary text-uppercase">Partner Benefits</span>
          <h3 class="mt-3 mb-2">What You Gain as a Partner</h3>
          <p class="text-muted-pc mb-4">
            PowerCabs welcomes taxi operators, fleet owners, and business
            partners to join the growing transportation network and expand
            their business opportunities.
          </p>

          <div class="pc-ptn-campaign-list mb-4">
            <?php foreach ($partnerBenefits as $item): ?>
              <div>
                <span class="pc-ptn-check flex-shrink-0 rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"><i class="bi bi-check-lg" aria-hidden="true"></i></span>
                <span><?= htmlspecialchars($item) ?></span>
              </div>
            <?php endforeach; ?>
          </div>

          <a class="btn btn-pc-primary rounded-pill px-4" href="#pcPtnEnquiry">
            Become a Partner
            <i class="bi bi-chevron-right fs-8 ms-1" aria-hidden="true"></i>
          </a>
        </article>
      </div>

      <div class="col-lg-5">
        <aside class="pc-ptn-info-card h-100">
          <h3 class="mb-3">Who Can Join?</h3>
          <div class="pc-ptn-pills d-flex flex-wrap mb-4">
            <?php foreach ($whoCanJoin as $item): ?>
              <span class="pc-ptn-pill d-inline-flex align-items-center rounded-pill fw-bold">
                <i class="bi <?= $item['icon'] ?>" aria-hidden="true"></i>
                <?= htmlspecialchars($item['label']) ?>
              </span>
            <?php endforeach; ?>
          </div>

          <hr class="pc-ptn-info-divider border-0">

          <h3 class="mb-3">Why Operators Choose Us</h3>
          <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
            <?php foreach ($partnerWhyChoose as $item): ?>
              <li class="d-flex align-items-center gap-2">
                <i class="bi bi-check2-circle" aria-hidden="true" style="color: var(--pc-orange);"></i>
                <span><?= $item ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </aside>
      </div>
    </div>
  </div>
</section>
