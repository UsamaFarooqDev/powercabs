<section class="section-pc position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 56ch;">
        Built for Drivers Who Want More
      </p>
    </div>

    <div class="row row-cols-2 row-cols-md-3 g-4 g-md-0 text-center border-top border-bottom py-4 mb-5" style="border-color: rgba(28, 20, 16, .1) !important;">
      <div class="col py-3 border-end" style="border-color: rgba(28, 20, 16, .1) !important;">
        <p class="display-5 fw-bold mb-1" style="color: var(--pc-dark);">Every Week</p>
        <p class="small text-muted-pc mb-0">Weekly payment</p>
      </div>
      <div class="col py-3 border-end" style="border-color: rgba(28, 20, 16, .1) !important;">
        <p class="display-5 fw-bold mb-1" style="color: var(--pc-dark);">0%</p>
        <p class="small text-muted-pc mb-0">Surprise fare deductions</p>
      </div>
      <div class="col py-3">
        <p class="display-5 fw-bold mb-1" style="color: var(--pc-dark);">24/7</p>
        <p class="small text-muted-pc mb-0">Real driver support line</p>
      </div>
    </div>

    <div class="text-center mb-4">
      <h3 class="fs-4 fw-bold mb-1" style="color: var(--pc-dark);">Ride Types we cover</h3>
      <p class="text-muted-pc mb-0">One vehicle, eight ways to earn.</p>
    </div>

    <?php $driveRideCategories = [
      ['img' => 'Economy.png', 'label' => 'Economy'],
      ['img' => 'Economy-xl.png', 'label' => 'Economy XL'],
      ['img' => 'Limousine.png', 'label' => 'Limousine'],
      ['img' => 'wheelchair-taxi.png', 'label' => 'Wheelchair Taxi'],
      ['img' => 'pet-taxi.png', 'label' => 'Pet Friendly'],
      ['img' => 'courier.png', 'label' => 'Courier / Parcel'],
      ['img' => 'business.png', 'label' => 'Business'],
      ['img' => 'business-xl.png', 'label' => 'Business XL'],
    ]; ?>

    <style>
      .pc-drive-ride-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
      }
      .pc-drive-ride-item {
        flex: 0 0 calc(50% - .5rem);
        max-width: calc(50% - .5rem);
      }
      @media (min-width: 768px) {
        .pc-drive-ride-item {
          flex: 0 0 calc(33.333% - .667rem);
          max-width: calc(33.333% - .667rem);
        }
      }
      @media (min-width: 992px) {
        .pc-drive-ride-item {
          flex: 0 0 calc(20% - .8rem);
          max-width: calc(20% - .8rem);
        }
      }
    </style>

    <div class="pc-drive-ride-grid">
      <?php foreach ($driveRideCategories as $category): ?>
        <div class="pc-drive-ride-item">
          <div class="pc-service-card d-block position-relative overflow-hidden" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
            <img src="<?= $assetPath ?>assets/img/rides-types/<?= $category['img'] ?>" alt="<?= htmlspecialchars(
  $category['label'],
) ?>" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
            <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
            <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-3" style="padding-top: 2.5rem;">
              <span class="pc-service-card-title text-white d-block fs-6 fs-md-5 fw-extrabold mb-0"><?= htmlspecialchars(
                $category['label'],
              ) ?></span>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
