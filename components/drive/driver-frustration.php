<?php
$frustrationPoints = [
    ['icon' => 'bi-fuel-pump-fill', 'title' => 'Fuel', 'desc' => 'Still costs you the same.'],
    ['icon' => 'bi-tools', 'title' => 'Maintenance', 'desc' => 'Every kilometre has a cost.'],
    ['icon' => 'bi-shield-fill', 'title' => 'Insurance', 'desc' => "Your overhead doesn't disappear."],
    ['icon' => 'bi-clock-fill', 'title' => 'Your time', 'desc' => 'Your working hour has value.'],
];
?>
<!-- ============ The Driver Frustration ============ -->
<section class="section-pc bg-white">
  <div class="container">
    <div class="row align-items-center gy-5 mb-5">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ The Driver Frustration</p>
        <h2 class="fw-bold mb-3" style="font-size: clamp(1.9rem, 3.4vw, 2.6rem);">Tired of Saver fares?</h2>
        <p class="text-muted-pc mb-4" style="font-size: 1.05rem; line-height: 1.7;">
          You're still paying the same fuel, insurance, maintenance and time --
          even when a technology platform makes the passenger's fare cheaper.
        </p>
        <blockquote class="mb-0 ps-3" style="border-left: 3px solid var(--pc-orange); font-size: 1.2rem; font-weight: 700; color: var(--pc-dark); line-height: 1.5;">
          &ldquo;Why should my taxi become cheaper just because the platform wants
          to discount the passenger?&rdquo;
        </blockquote>
      </div>

      <div class="col-lg-6">
        <div class="row row-cols-2 g-3">
          <?php foreach ($frustrationPoints as $point): ?>
            <div class="col">
              <div class="rounded-4 p-3 p-md-4 h-100" style="background: var(--pc-cream-soft);">
                <i class="bi <?= $point['icon'] ?> fs-5 mb-2 d-block" style="color: var(--pc-orange);" aria-hidden="true"></i>
                <span class="d-block fw-bold mb-1" style="color: var(--pc-dark);"><?= htmlspecialchars($point['title']) ?></span>
                <span class="d-block small text-muted-pc"><?= htmlspecialchars($point['desc']) ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="rounded-4 text-center p-4 p-md-5" style="background: var(--pc-dark);">
      <h3 class="fw-bold mb-2 text-uppercase" style="font-size: clamp(2rem, 5vw, 3.2rem); color: var(--pc-orange-light); letter-spacing: -.01em;">
        No Saver.
      </h3>
      <p class="text-white fw-bold mb-3" style="font-size: 1.2rem;">No race to the bottom.</p>
      <p class="mx-auto mb-3" style="max-width: 56ch; color: rgba(255, 255, 255, .75);">
        PowerCabs is designed around applicable regulated taxi fares rather than
        asking drivers to absorb platform-created Saver discounts.
      </p>
      <p class="small mb-0" style="color: rgba(255, 255, 255, .5);">*Subject to Irish taxi/SPSV regulations and current terms.</p>
    </div>
  </div>
</section>
