<section class="section-pc text-white position-relative overflow-hidden" style="background: linear-gradient(165deg, #0a0807 0%, #14100c 60%, #0a0807 100%);">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="mx-auto mb-0" style="max-width: 56ch; color: rgba(255, 255, 255, .72);">
        Built for Drivers Who Want More
      </p>
    </div>

    <div class="row row-cols-2 row-cols-md-3 g-4 g-md-0 text-center border-top border-bottom py-4 mb-5" style="border-color: rgba(255, 255, 255, .12) !important;">
      <div class="col py-3 border-end" style="border-color: rgba(255, 255, 255, .12) !important;">
        <p class="display-5 fw-bold text-white mb-1">48hrs</p>
        <p class="small mb-0" style="color: rgba(255, 255, 255, .65);">Fast weekly payouts</p>
      </div>
      <div class="col py-3 border-end" style="border-color: rgba(255, 255, 255, .12) !important;">
        <p class="display-5 fw-bold text-white mb-1">0%</p>
        <p class="small mb-0" style="color: rgba(255, 255, 255, .65);">Surprise fare deductions</p>
      </div>
      <div class="col py-3">
        <p class="display-5 fw-bold text-white mb-1">24/7</p>
        <p class="small mb-0" style="color: rgba(255, 255, 255, .65);">Real driver support line</p>
      </div>
    </div>

    <div class="text-center mb-4">
      <h3 class="text-white fs-4 fw-bold mb-1">Drive Every Ride Type</h3>
      <p class="mb-0" style="color: rgba(255, 255, 255, .6);">One vehicle, eight ways to earn.</p>
    </div>

    <?php
    $driveRideCategories = [
      ['img' => 'Economy.png', 'label' => 'Economy'],
      ['img' => 'Economy-xl.png', 'label' => 'Economy XL'],
      ['img' => 'Limousine.png', 'label' => 'Limousine'],
      ['img' => 'wheelchair-taxi.png', 'label' => 'Wheelchair Taxi'],
      ['img' => 'pet-taxi.png', 'label' => 'Pet Friendly'],
      ['img' => 'courier.png', 'label' => 'Courier / Parcel'],
      ['img' => 'business.png', 'label' => 'Business'],
      ['img' => 'business-xl.png', 'label' => 'Business XL'],
    ];
    ?>
    <div class="row row-cols-2 row-cols-md-4 g-3">
      <?php foreach ($driveRideCategories as $category): ?>
        <div class="col p-1 p-md-4">
          <div class="pc-service-card d-block position-relative overflow-hidden" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
            <img src="<?= $assetPath ?>assets/img/rides-types/<?= $category['img'] ?>" alt="<?= htmlspecialchars($category['label']) ?>" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
            <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
            <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-3" style="padding-top: 2.5rem;">
              <span class="pc-service-card-title d-block fs-6 fs-md-5 fw-extrabold mb-0"><?= htmlspecialchars($category['label']) ?></span>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
