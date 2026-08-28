<?php
$welcomeBgImage = $assetPath . 'assets/img/welcome-section-bg.png'; ?>

<section class="pc-welcome-section position-relative overflow-hidden d-flex align-items-center text-white" style="background-image: url('<?= htmlspecialchars(
  $welcomeBgImage,
) ?>');">
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"
        style="background: linear-gradient(120deg, rgba(18, 18, 18, .6) 0%, rgba(232, 89, 12, .55) 55%, rgba(255, 122, 0, .4) 100%);"></span>
  <div class="container position-relative">
    <div class="row">
      <div class="col-lg-8 col-xl-7 pc-welcome-text">
        <h2 class="fw-bold text-white mb-4 pc-welcome-heading">
          Power Your Every Journey.
        </h2>
        <p class="mb-0 pc-welcome-lead fw-normal">
          Fast, reliable and professional rides across Ireland. Book licensed drivers
          anytime for airport transfers, business travel, family trips, parcels and much more.
        </p>
      </div>
    </div>
  </div>
</section>
