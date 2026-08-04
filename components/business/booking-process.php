<?php
/**
 * Business page: "How to Book Our Business Rides" -- app mockup +
 * business account benefits grid.
 * Requires $assetPath from the including page.
 */
?>
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <?php
          $mockupImage = 'business-account.jpeg';
          $mockupAlt   = 'PowerCabs app screen for booking a business ride';
          $mockupNotch = true;
          require __DIR__ . '/../shared/app-mockup.php';
        ?>
      </div>

      <div class="col-lg-6">
        <h2 class="mb-3">How to Book Our Business Rides</h2>
        <p class="text-muted-pc mb-4">
          Open a PowerCabs Business Account in minutes and give your team a faster,
          simpler way to travel -- booked through the same app, billed to one account.
        </p>

        <div class="row row-cols-1 row-cols-sm-2 g-0 pc-feature-grid">
          <?php
          $businessAccountBenefits = [
            ['icon' => 'bi-lightning-charge-fill', 'title' => 'Priority Booking'],
            ['icon' => 'bi-receipt', 'title' => 'Monthly Billing'],
            ['icon' => 'bi-people-fill', 'title' => 'Multiple Users'],
            ['icon' => 'bi-clock-history', 'title' => 'Ride History'],
            ['icon' => 'bi-headset', 'title' => 'Corporate Support'],
          ];
          $totalBenefits = count($businessAccountBenefits);
          ?>
          <?php foreach ($businessAccountBenefits as $i => $benefit): ?>
            <?php
              $isRightCol      = $i % 2 === 1;
              $hasRightSibling = ($i + 1) < $totalBenefits;
              $isLastRow       = $i >= $totalBenefits - ($totalBenefits % 2 === 0 ? 2 : 1);
              $cellClasses     = ($isRightCol ? 'ps-4' : 'pe-4') . (!$isRightCol && $hasRightSibling ? ' border-end' : '') . ($isLastRow ? '' : ' border-bottom');
            ?>
            <div class="col d-flex align-items-center gap-2 py-3 <?= $cellClasses ?>">
              <i class="bi <?= $benefit['icon'] ?>" style="color: var(--pc-orange);"></i>
              <span class="fw-semibold small"><?= htmlspecialchars($benefit['title']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>

        <a class="btn btn-pc-primary px-4 mt-4" href="<?= $assetPath ?>/corporate-services.php#corporate-account-form">Open a Business Account</a>
      </div>
    </div>
  </div>
</section>
