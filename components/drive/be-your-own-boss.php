<?php
$driverPerks = [
  ['icon' => 'bi-clock-fill', 'label' => 'Pay Per Hour'],
  ['icon' => 'bi-megaphone-fill', 'label' => 'Advertise and Earn'],
  ['icon' => 'bi-signpost-split-fill', 'label' => 'Long Trips'],
  ['icon' => 'bi-headset', 'label' => 'Irish Support'],
  ['icon' => 'bi-lightning-charge-fill', 'label' => 'Fast Onboarding'],
  ['icon' => 'bi-brush-fill', 'label' => 'Branding Opportunity'],
  ['icon' => 'bi-percent', 'label' => 'Only 10% Commission'],
  ['icon' => 'bi-wallet2', 'label' => 'No Membership Fee'],
]; ?>
<!-- ============ Be Your Real Boss ============ -->
<section class="section-pc position-relative overflow-hidden">
   <div class="container py-5">
  <span class="pc-drive-blob pc-drive-blob-orange" aria-hidden="true"></span>
  <span class="pc-drive-blob pc-drive-blob-dark" aria-hidden="true"></span>

  <div class="container position-relative">
    <div class="row">
      <div class="col-lg-9 col-xl-8">
        <h2 class="fw-bold mb-3" style="font-size: clamp(2rem, 4vw, 3rem); line-height: 1.12; letter-spacing: -.01em;">
          Be Your Real Boss &mdash; Not Just on Paper.
        </h2>
        <p class="mb-4" style="font-size: 1.2rem; color: var(--pc-text-muted); max-width: 46ch;">
          Flexible earning. Zero app charges for usage.
        </p>
        <div class="d-flex flex-wrap gap-2 gap-md-3 mb-5">
          <?php foreach ($driverPerks as $perk): ?>
            <span class="pc-perk-chip d-inline-flex align-items-center gap-2">
              <i class="bi <?= $perk['icon'] ?>" aria-hidden="true"></i>
              <?= htmlspecialchars($perk['label']) ?>
            </span>
          <?php endforeach; ?>
        </div>
        <a class="btn btn-pc-primary rounded-pill px-4 d-inline-flex align-items-center gap-2" href="<?= $assetPath ?>/ambassador-programme">
          <span>Explore Ambassador Programme</span>
          <i class="bi bi-arrow-right-short fs-6" aria-hidden="true"></i>
        </a>
      </div>
    </div>
  </div>
  </div>
</section>