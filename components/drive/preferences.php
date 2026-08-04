<?php
/**
 * Drive page: "You're In Control" -- driver preference toggle grid.
 */
?>
<section class="section-pc bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="mb-2">You're In Control</h2>
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 56ch;">Turn preferences on or off in the Driver App and only receive the bookings that suit you.</p>
    </div>

    <?php
    $driverPreferences = [
      ['title' => 'Accept Card Payments', 'desc' => 'Receive card-paid bookings.', 'img' => 'https://images.pexels.com/photos/9122014/pexels-photo-9122014.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Cash Rides', 'desc' => 'Receive cash bookings.', 'img' => 'https://images.pexels.com/photos/4968385/pexels-photo-4968385.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Delivery Jobs', 'desc' => 'Receive parcel delivery requests.', 'img' => 'https://images.pexels.com/photos/6869065/pexels-photo-6869065.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Pet Friendly', 'desc' => 'Accept passengers travelling with pets.', 'img' => 'https://images.pexels.com/photos/18868680/pexels-photo-18868680.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Wheelchair Passenger', 'desc' => 'Receive accessible ride requests.', 'img' => 'https://images.pexels.com/photos/8127701/pexels-photo-8127701.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Night Rides', 'desc' => 'Enable late evening bookings.', 'img' => 'https://images.pexels.com/photos/6046594/pexels-photo-6046594.jpeg?auto=format&fit=crop&w=1200&q=60'],
    ];
    ?>
    <div class="row row-cols-2 row-cols-lg-3 g-3 g-md-4">
      <?php foreach ($driverPreferences as $pref): ?>
        <div class="col">
          <div class="pc-service-card d-block position-relative overflow-hidden" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
            <img src="<?= $pref['img'] ?>" alt="<?= htmlspecialchars($pref['title']) ?>" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
            <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
            <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-3 p-md-4">
              <span class="pc-service-card-title d-block fs-6 fs-md-5 fw-bold mb-1"><?= htmlspecialchars($pref['title']) ?></span>
              <span class="d-block small text-white-50 mb-0"><?= htmlspecialchars($pref['desc']) ?></span>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
