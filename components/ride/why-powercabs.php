<?php
/**
 * Ride page: "Why PowerCabs?" comparison -- PowerCabs vs large taxi apps vs
 * traditional phone booking, scanned side by side across a shared feature
 * list (a comparison grid, not three separate "pick one" plan cards).
 * Built from Bootstrap's row/col grid rather than a <table> or custom CSS
 * classes -- only the brand-color ties (var(--pc-orange) etc, same
 * convention as the rest of this page) and the couple of things Bootstrap
 * has no utility for (the horizontal-scroll wrapper on narrow viewports)
 * need inline style. Requires $assetPath from the including page (not
 * currently used here, kept for consistency with the other
 * components/ride/*.php files).
 */

function pc_why_icon(string $type, string $label): string
{
  $markup = match ($type) {
    'check' => '<i class="bi bi-check-circle-fill" style="color: #198754; font-size: 1.1rem;" aria-hidden="true"></i>',
    'varies-strong'
      => '<i class="bi bi-check-circle" style="color: #198754; opacity: .65; font-size: 1.1rem;" aria-hidden="true"></i>',
    'varies'
      => '<i class="bi bi-dash-circle" style="color: var(--pc-text-muted); font-size: 1.1rem;" aria-hidden="true"></i>',
    default => '',
  };
  return $markup . '<span class="visually-hidden">' . htmlspecialchars($label) . '</span>';
}

$whyComparisonRows = [
  ['label' => 'Book online', 'powercabs' => 'check', 'apps' => 'check', 'traditional' => 'check'],
  ['label' => 'Real-time tracking', 'powercabs' => 'check', 'apps' => 'check', 'traditional' => 'varies'],
  ['label' => 'Licensed drivers', 'powercabs' => 'check', 'apps' => 'check', 'traditional' => 'check'],
  ['label' => 'Irish / Dublin-based company', 'powercabs' => 'check', 'apps' => 'varies', 'traditional' => 'check'],
  [
    'label' => 'Accessible / pet / XL options',
    'powercabs' => 'check',
    'apps' => 'varies-strong',
    'traditional' => 'varies-strong',
  ],
  [
    'label' => 'Business & specialist journeys',
    'powercabs' => 'check',
    'apps' => 'varies-strong',
    'traditional' => 'varies-strong',
  ],
];

$whyLabels = ['check' => 'Included', 'varies-strong' => 'Sometimes', 'varies' => 'Varies'];
?>
<!-- ============ Why PowerCabs? ============ -->
<section class="section-pc" style="background: var(--pc-cream-soft);">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width: 680px;">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why PowerCabs?</p>
      <h2 class="mb-3">Big-app convenience. <span style="color: var(--pc-orange);">Local Irish service.</span></h2>
      <p class="text-muted-pc mb-0">
        Don't compete on claims customers can't verify. Win on trust, choice and
        the journeys where local service matters.
      </p>
    </div>

    <div class="mx-auto" style="max-width: 960px;">
      <div class="rounded-4 shadow-sm bg-white overflow-hidden" style="border: 1px solid rgba(28, 20, 16, .08); position: relative;">
        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
          <div style="min-width: 640px;">

            <!-- Header row -->
            <div class="row g-0 align-items-stretch" style="background: var(--pc-dark);">
              <div class="col-4 d-flex align-items-center py-3 px-4">
                <span class="small fw-semibold text-white-50 text-uppercase" style="letter-spacing: .04em; font-size: .72rem;">What you need</span>
              </div>
              <div class="col d-flex align-items-center justify-content-center text-center py-3 px-2" style="background: rgba(255, 122, 0, .16);">
                <span class="fw-bold text-uppercase" style="color: var(--pc-orange-light); font-size: .78rem; letter-spacing: .03em;">PowerCabs</span>
              </div>
              <div class="col d-flex align-items-center justify-content-center text-center py-3 px-2">
                <span class="fw-semibold text-white-50 text-uppercase" style="font-size: .72rem; letter-spacing: .03em;">Large Taxi Apps</span>
              </div>
              <div class="col d-flex align-items-center justify-content-center text-center py-3 px-2">
                <span class="fw-semibold text-white-50 text-uppercase" style="font-size: .72rem; letter-spacing: .03em;">Traditional Booking</span>
              </div>
            </div>

            <!-- Feature rows -->
            <?php foreach ($whyComparisonRows as $i => $row): ?>
              <div class="row g-0 align-items-stretch" style="<?= $i < count($whyComparisonRows) - 1
                ? 'border-bottom: 1px solid rgba(28, 20, 16, .06);'
                : '' ?>">
                <div class="col-4 d-flex align-items-center py-3 px-4">
                  <span class="small fw-semibold" style="color: var(--pc-dark);"><?= htmlspecialchars(
                    $row['label'],
                  ) ?></span>
                </div>
                <div class="col d-flex align-items-center justify-content-center text-center py-3 px-2" style="background: var(--pc-cream-soft);">
                  <?= pc_why_icon($row['powercabs'], $whyLabels[$row['powercabs']]) ?>
                </div>
                <div class="col d-flex align-items-center justify-content-center text-center py-3 px-2">
                  <?= pc_why_icon($row['apps'], $whyLabels[$row['apps']]) ?>
                </div>
                <div class="col d-flex align-items-center justify-content-center text-center py-3 px-2">
                  <?= pc_why_icon($row['traditional'], $whyLabels[$row['traditional']]) ?>
                </div>
              </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>

      <p class="small text-muted-pc text-center mt-3 mb-0">
        <i class="bi bi-check-circle-fill" style="color: #198754;" aria-hidden="true"></i> Included
        &nbsp;&middot;&nbsp;
        <i class="bi bi-check-circle" style="color: #198754; opacity: .65;" aria-hidden="true"></i> Sometimes
        &nbsp;&middot;&nbsp;
        <i class="bi bi-dash-circle" style="color: var(--pc-text-muted);" aria-hidden="true"></i> Varies
      </p>
    </div>
  </div>
</section>
