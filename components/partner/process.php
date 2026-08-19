<?php
$joinProcess = [
  ['n' => '01', 'title' => 'Register', 'desc' => 'Tell us about your business and vehicles.'],
  ['n' => '02', 'title' => 'Verification', 'desc' => 'Our team checks your details and documents.'],
  ['n' => '03', 'title' => 'Approval', 'desc' => "You're confirmed and onboarded to the network."],
  ['n' => '04', 'title' => 'Start Receiving Trips', 'desc' => 'Bookings start flowing straight to your fleet.'],
];
$totalJoinProcess = count($joinProcess);
?>
<section class="pc-ptn-band-a section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Join Process</p>
      <h2 class="mb-0">Four Steps to Get Started</h2>
    </div>

    <div class="pc-ptn-steps row row-cols-1 row-cols-lg-4 gy-5 g-lg-4">
      <?php foreach ($joinProcess as $i => $step): ?>
        <?php $isLast = $i === $totalJoinProcess - 1; ?>
        <div class="col">
          <div class="pc-biz-step d-flex<?= $isLast ? ' pc-biz-step-last' : '' ?>">
            <div class="pc-biz-step-num-wrap d-flex flex-column align-items-center flex-shrink-0">
              <span class="pc-biz-step-num d-flex align-items-center justify-content-center rounded-circle fw-bold">
                <?= htmlspecialchars($step['n']) ?>
              </span>
              <span class="pc-biz-step-rail-mobile d-lg-none" aria-hidden="true"></span>
            </div>
            <div class="pc-biz-step-body ps-3 ps-lg-0 pt-lg-4">
              <h3 class="fs-5 fw-bold mb-1"><?= htmlspecialchars($step['title']) ?></h3>
              <p class="small text-muted-pc mb-0"><?= htmlspecialchars($step['desc']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
