<?php
$driveStats = [
  ['value' => '€0', 'label' => 'Joining fee'],
  ['value' => '€0', 'label' => 'Monthly subscription'],
  ['value' => '10%', 'label' => 'Completed PowerCabs jobs'],
  ['value' => '€0', 'label' => 'Commission if no job is completed'],
  ['value' => '150', 'label' => 'Drivers Joined'],
  ['value' => '230', 'label' => 'Customers'],
  ['value' => '33', 'label' => 'Businesses Joined'],
]; ?>
<!-- ============ Stats badge ============ -->
<section class="position-relative" style="margin-top: -2.25rem; z-index: 2;">
  <div class="container">
    <div class="pc-ride-trust-bar mx-auto mb-4 py-2 px-2" style="max-width: 1200px;">
      <div class="d-flex flex-wrap justify-content-center">
        <?php foreach ($driveStats as $stat): ?>
          <div class="text-center px-3 py-3" style="flex: 1 1 150px; max-width: 190px;">
            <p class="fw-bold mb-1" style="font-size: 1.5rem; color: var(--pc-dark); letter-spacing: -.02em;"><?= htmlspecialchars(
              $stat['value'],
            ) ?></p>
            <p class="small text-muted-pc mb-0" style="font-size: .74rem;"><?= htmlspecialchars($stat['label']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
