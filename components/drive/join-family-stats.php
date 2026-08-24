<?php
/**
 * Stats badge, floating over the bottom edge of the dark join-family-form
 * section above it. Reuses .pc-ride-trust-bar/.pc-ride-trust-item (built
 * for ride.php's trust bar) for the divided-white-bar shell and responsive
 * borders -- same generic "divided stat bar" component, different inner
 * content (centered number + label here, instead of icon + text).
 */
$driveStats = [
    ['value' => '€0', 'label' => 'Joining fee'],
    ['value' => '€0', 'label' => 'Monthly subscription'],
    ['value' => '10%', 'label' => 'Completed PowerCabs jobs'],
    ['value' => '€0', 'label' => 'Commission if no job is completed'],
];
?>
<!-- ============ Stats badge ============ -->
<section class="position-relative" style="margin-top: -2.25rem; z-index: 2;">
  <div class="container">
    <div class="pc-ride-trust-bar row row-cols-2 row-cols-md-4 g-0 mx-auto" style="max-width: 1040px;">
      <?php foreach ($driveStats as $stat): ?>
        <div class="col pc-ride-trust-item text-center py-4">
          <p class="fw-bold mb-1" style="font-size: 1.85rem; color: var(--pc-dark); letter-spacing: -.02em;"><?= htmlspecialchars(
            $stat['value'],
          ) ?></p>
          <p class="small text-muted-pc mb-0"><?= htmlspecialchars($stat['label']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
