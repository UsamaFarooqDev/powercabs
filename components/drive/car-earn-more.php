<?php

$carEarnCards = [
  [
    'step' => '01',
    'title' => 'Drive',
    'desc' => 'Every trip keeps your car on the road and earning.',
    'img' => 'https://images.pexels.com/photos/37310371/pexels-photo-37310371.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'step' => '02',
    'title' => 'Advertise',
    'desc' => 'Turn your vehicle into a moving billboard seen across Dublin.',
    'img' => 'https://images.pexels.com/photos/32234671/pexels-photo-32234671.jpeg?auto=compress&cs=tinysrgb&w=1200',
  ],
  [
    'step' => '03',
    'title' => 'Earn',
    'desc' => 'Get paid extra for eligible campaigns, on top of your fares.',
    'img' => 'https://images.pexels.com/photos/35119581/pexels-photo-35119581.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
]; ?>
<!-- ============ Your Car Can Earn More ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width: 640px;">
      <p class="small fw-bold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Your Car Can Earn More</p>
      <h2 class="fw-bold mb-0" style="font-size: clamp(2rem, 3.6vw, 2.8rem);">Drive. Advertise. <span style="color: var(--pc-orange);">Earn.</span></h2>
    </div>

    <div class="row g-3 g-lg-4">
      <?php foreach ($carEarnCards as $card): ?>
        <div class="col-md-4">
          <div class="pc-service-card d-block position-relative overflow-hidden" style="aspect-ratio: 3 / 2; border-radius: var(--pc-radius-lg);">
            <img src="<?= htmlspecialchars($card['img']) ?>" alt="<?= htmlspecialchars(
  $card['title'],
) ?>" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
            <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>

            <span class="badge rounded-pill position-absolute top-0 start-0 m-3 fw-semibold" style="background: var(--pc-orange); color: #fff; font-size: .68rem; letter-spacing: .04em;">
              Step <?= htmlspecialchars($card['step']) ?>
            </span>

            <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-3 p-md-4">
              <span class="d-block fw-bold mb-1" style="font-size: 1.65rem; color: var(--pc-white); letter-spacing: -.01em;"><?= htmlspecialchars(
                $card['title'],
              ) ?></span>
              <span class="d-block small text-white-50"><?= htmlspecialchars($card['desc']) ?></span>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mx-auto mt-5" style="max-width: 640px;">
      <p class="text-muted-pc mb-4">
        Eligible drivers can participate in approved vehicle marketing campaigns
        and potentially earn <strong style="color: var(--pc-dark);">&euro;100+ per month</strong>,
        depending on campaign and eligibility.
      </p>
      <a href="<?= $assetPath ?>/ambassador-programme" class="btn btn-pc-primary rounded-pill px-4 d-inline-flex align-items-center gap-2">
        Ask About Vehicle Campaigns <i class="bi bi-arrow-right-short" aria-hidden="true"></i>
      </a>
    </div>
  </div>
</section>
