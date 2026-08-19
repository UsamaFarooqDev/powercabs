<?php

$partnerBenefits = [
  'Grow your business',
  'Increased bookings',
  'Dedicated support',
  'Driver management',
  'Fleet management',
  'Marketing support',
  'Technology platform',
  'Weekly payments',
  'Business growth',
]; ?>
<section class="pc-ptn-band-a section-pc">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <div class="pc-ptn-media-frame">
          <img src="https://images.pexels.com/photos/29566896/pexels-photo-29566896.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1200" alt="An aerial view of a large, organised fleet of vehicles" loading="lazy">
        </div>
      </div>

      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Benefits</p>
        <h2 class="mb-3">What You Gain as a Partner</h2>
        <p class="text-muted-pc mb-4" style="font-size: 1.05rem; max-width: 46ch;">
          PowerCabs welcomes taxi operators, fleet owners, and business partners to
          join the growing transportation network and expand their business opportunities.
        </p>

        <div class="d-flex flex-wrap gap-2">
          <?php foreach ($partnerBenefits as $item): ?>
            <span class="pc-amb-recap-chip d-inline-flex align-items-center gap-2">
              <i class="bi bi-check2-circle" aria-hidden="true"></i>
              <?= htmlspecialchars($item) ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
