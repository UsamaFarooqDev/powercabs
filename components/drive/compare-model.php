<?php
/**
 * "Compare the Model" -- PowerCabs vs other driving platforms' commission
 * models, built the same way as ride.php's Why PowerCabs comparison
 * (components/ride/why-powercabs.php): Bootstrap row/col grid rather than
 * a <table>, PowerCabs column tinted throughout, position: relative on the
 * wrapper so the one visually-hidden a11y label doesn't escape the
 * horizontal-scroll container on narrow viewports.
 */
$compareRows = [
    ['label' => 'Joining fee', 'powercabs' => '€0', 'other' => 'Varies'],
    ['label' => 'Monthly subscription', 'powercabs' => '€0', 'other' => 'Varies'],
    ['label' => 'Commission on completed jobs', 'powercabs' => '10%', 'other' => 'Varies'],
    ['label' => 'Commission if no PowerCabs job is completed', 'powercabs' => '€0', 'other' => 'Depends on model'],
    ['label' => 'Saver fare model', 'powercabs' => 'No*', 'other' => 'Varies'],
    ['label' => 'Driver benefits', 'powercabs' => 'check', 'other' => 'Varies'],
];
?>
<!-- ============ Compare the Model ============ -->
<section class="section-pc" style="background: var(--pc-cream-soft);">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width: 680px;">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Compare the Model</p>
      <h2 class="mb-3">Look beyond the headline commission.</h2>
      <p class="text-muted-pc mb-0">
        Different platforms use different pricing models. Compare the real cost
        of access, not just the commission headline.
      </p>
    </div>

    <div class="mx-auto" style="max-width: 860px;">
      <div class="rounded-4 shadow-sm bg-white overflow-hidden" style="border: 1px solid rgba(28, 20, 16, .08); position: relative;">
        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
          <div style="min-width: 520px;">

            <!-- Header row -->
            <div class="row g-0 align-items-stretch" style="background: var(--pc-dark);">
              <div class="col-6 d-flex align-items-center py-3 px-4">
                <span class="small fw-semibold text-white-50 text-uppercase" style="letter-spacing: .04em; font-size: .72rem;">Driver question</span>
              </div>
              <div class="col-3 d-flex align-items-center justify-content-center text-center py-3 px-2" style="background: rgba(255, 122, 0, .16);">
                <span class="fw-bold text-uppercase" style="color: var(--pc-orange-light); font-size: .78rem; letter-spacing: .03em;">PowerCabs</span>
              </div>
              <div class="col-3 d-flex align-items-center justify-content-center text-center py-3 px-2">
                <span class="fw-semibold text-white-50 text-uppercase" style="font-size: .72rem; letter-spacing: .03em;">Other Models*</span>
              </div>
            </div>

            <!-- Rows -->
            <?php foreach ($compareRows as $i => $row): ?>
              <div class="row g-0 align-items-stretch" style="<?= $i < count(
                $compareRows,
              ) - 1
                ? 'border-bottom: 1px solid rgba(28, 20, 16, .06);'
                : '' ?>">
                <div class="col-6 d-flex align-items-center py-3 px-4">
                  <span class="small fw-semibold" style="color: var(--pc-dark);"><?= htmlspecialchars($row['label']) ?></span>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center text-center py-3 px-2" style="background: var(--pc-cream-soft);">
                  <?php if ($row['powercabs'] === 'check'): ?>
                    <i class="bi bi-check-circle-fill" style="color: #198754; font-size: 1.1rem;" aria-hidden="true"></i>
                    <span class="visually-hidden">Yes</span>
                  <?php else: ?>
                    <span class="fw-bold" style="color: var(--pc-dark);"><?= htmlspecialchars($row['powercabs']) ?></span>
                  <?php endif; ?>
                </div>
                <div class="col-3 d-flex align-items-center justify-content-center text-center py-3 px-2">
                  <span class="small text-muted-pc"><?= htmlspecialchars($row['other']) ?></span>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>

      <p class="small text-muted-pc text-center mt-3 mb-0" style="font-size: .8rem;">
        *Generic comparison only, not a statement about any named competitor. Verify
        live market terms before publishing comparative advertising.
      </p>
    </div>
  </div>
</section>
