<?php
$bizHowSteps = [
  ['n' => '01', 'title' => 'Create Your Account', 'desc' => 'Sign up in minutes -- no paperwork, no waiting.'],
  ['n' => '02', 'title' => 'Add Your Team', 'desc' => 'Add the employees who need taxi travel to your account.'],
  ['n' => '03', 'title' => 'Start Travelling', 'desc' => 'Book taxis through PowerCabs, billed straight to your business.'],
];
$totalBizHowSteps = count($bizHowSteps);
?>
<section class="pc-biz-band-a section-pc" id="pcBizHowItWorks">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ How It Works</p>
      <h2 class="mb-0">Business Travel Without the Admin Headache.</h2>
    </div>

    <div class="pc-biz-steps row row-cols-1 row-cols-lg-3 gy-5 g-lg-4">
      <?php foreach ($bizHowSteps as $i => $step): ?>
        <?php $isLast = $i === $totalBizHowSteps - 1; ?>
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
              <p class="text-muted-pc mb-0"><?= htmlspecialchars($step['desc']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
