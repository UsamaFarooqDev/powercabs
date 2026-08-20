<?php
$bizTrustMarkers = [
  ['icon' => 'bi-patch-check-fill', 'label' => 'NTA License DH12616'],
  ['icon' => 'bi-shield-check', 'label' => 'Garda-Vetted Drivers'],
  ['icon' => 'bi-headset', 'label' => '24/7 Business Support'],
]; ?>
<section class="section-pc" style="background: linear-gradient(180deg, var(--pc-cream-soft) 0%, var(--pc-white) 100%);">
  <div class="container">
    <div class="pc-biz-quote mx-auto text-center" style="max-width: 46rem;">
      <i class="bi bi-quote pc-biz-quote-mark" aria-hidden="true"></i>
      <p class="pc-biz-quote-text mb-4">
        Every PowerCabs Business account runs on the same standard we hold
        every ride to &mdash; licensed, vetted drivers, one simple account,
        and a team that actually answers the phone.
      </p>
      <p class="fw-bold mb-5" style="color: var(--pc-dark);">&mdash; The PowerCabs Business Team</p>

      <div class="d-flex flex-wrap align-items-center justify-content-center gap-3">
        <?php foreach ($bizTrustMarkers as $marker): ?>
          <span class="d-inline-flex align-items-center gap-2 rounded-pill px-3 py-2" style="background: var(--pc-white); border: 1px solid rgba(28,20,16,.08);">
            <i class="bi <?= $marker['icon'] ?>" style="color: var(--pc-orange);"></i>
            <span class="small fw-semibold" style="color: var(--pc-dark);"><?= htmlspecialchars(
              $marker['label'],
            ) ?></span>
          </span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
