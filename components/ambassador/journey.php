<?php
$ambJourneySteps = [
  ['icon' => 'bi-car-front-fill', 'label' => 'Drive'],
  ['icon' => 'bi-patch-check-fill', 'label' => 'Represent PowerCabs'],
  ['icon' => 'bi-cash-coin', 'label' => 'Earn'],
  ['icon' => 'bi-gift-fill', 'label' => 'Get Rewarded'],
];
?>
<section class="pc-amb-journey position-relative overflow-hidden text-white" id="pcAmbJourney">
  <div class="pc-amb-journey-media position-absolute top-0 start-0 w-100 h-100" aria-hidden="true">
    <img src="https://images.pexels.com/photos/32234671/pexels-photo-32234671.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1600" alt="" class="w-100 h-100 object-fit-cover" loading="lazy" id="pcAmbJourneyImg">
  </div>
  <span class="pc-amb-journey-scrim position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>

  <div class="container position-relative text-center">
    <p class="small fw-semibold text-uppercase mb-3" style="letter-spacing: .08em; color: var(--pc-orange-light);">/ The Ambassador Journey</p>
    <h2 class="mx-auto mb-5" style="max-width: 34ch; font-size: clamp(2rem, 4.5vw, 3.25rem);">
      Every Road You Drive Builds Something Bigger.
    </h2>

    <div class="pc-amb-journey-steps d-flex flex-wrap justify-content-center">
      <?php foreach ($ambJourneySteps as $i => $step): ?>
        <div class="pc-amb-journey-step">
          <?php if ($i > 0): ?><i class="bi bi-arrow-right pc-amb-journey-arrow d-none d-md-inline" aria-hidden="true"></i><?php endif; ?>
          <span class="pc-amb-journey-icon d-inline-flex align-items-center justify-content-center rounded-circle">
            <i class="bi <?= $step['icon'] ?>" aria-hidden="true"></i>
          </span>
          <span class="d-block fw-semibold mt-2"><?= htmlspecialchars($step['label']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
