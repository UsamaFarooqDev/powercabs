<section class="section-pc bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="mb-2">You're In Control</h2>
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 56ch;">Turn preferences on or off in the Driver App and only receive the bookings that suit you.</p>
    </div>

    <?php
    // Live (hosted) photography reused from elsewhere in the project --
    // not local assets/img files.
    $driverPreferences = [
      [
        'title' => 'Fuel Savings',
        'desc' => 'Reduce one of your biggest recurring costs.',
        'img' => 'https://images.pexels.com/photos/20500733/pexels-photo-20500733.jpeg?auto=compress&cs=tinysrgb&w=900',
      ],
      [
        'title' => 'Car Wash & Valet',
        'desc' => 'Keep your workplace professional while spending less.',
        'img' => 'https://images.pexels.com/photos/8425382/pexels-photo-8425382.jpeg?auto=format&fit=crop&w=1200&q=60',
      ],
      [
        'title' => 'Lower Card Costs',
        'desc' => '0.8% partner rate* versus advertised 1.69% standard rate.',
        'img' => 'https://images.pexels.com/photos/9122014/pexels-photo-9122014.jpeg?auto=format&fit=crop&w=1200&q=60',
      ],
      [
        'title' => 'Driver Loyalty',
        'desc' => 'Build recognition and unlock benefits.',
        'img' => 'https://images.pexels.com/photos/38472818/pexels-photo-38472818.jpeg?auto=compress&cs=tinysrgb&w=900',
      ],
      [
        'title' => 'Refer & Earn €50',
        'desc' => 'Grow the family and get rewarded.',
        'img' => 'https://images.pexels.com/photos/36712857/pexels-photo-36712857.jpeg?auto=format&fit=crop&w=1200&q=60',
      ],
      [
        'title' => 'Vehicle Income',
        'desc' => 'Potential €100+ / month on eligible campaigns.',
        'img' => 'https://images.pexels.com/photos/29566899/pexels-photo-29566899.jpeg?auto=compress&cs=tinysrgb&w=1200',
      ],
    ];
    ?>

    <!-- Same flex-wrap + justify-content: center technique as the Ride
         Types grid in opportunities.php -- 6 cards need 4 in row one and
         the remaining 2 centered in row two, same size as the rest. -->
    <style>
      .pc-drive-pref-grid {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 1rem;
      }
      .pc-drive-pref-item {
        flex: 0 0 calc(50% - .5rem);
        max-width: calc(50% - .5rem);
      }
      @media (min-width: 768px) {
        .pc-drive-pref-item {
          flex: 0 0 calc(33.333% - .667rem);
          max-width: calc(33.333% - .667rem);
        }
      }
      @media (min-width: 992px) {
        .pc-drive-pref-item {
          flex: 0 0 calc(25% - .75rem);
          max-width: calc(25% - .75rem);
        }
      }
    </style>

    <div class="pc-drive-pref-grid">
      <?php foreach ($driverPreferences as $pref): ?>
        <div class="pc-drive-pref-item">
          <div class="pc-service-card d-block position-relative overflow-hidden" style="aspect-ratio: 6 / 5; border-radius: var(--pc-radius-lg);">
            <img src="<?= htmlspecialchars($pref['img']) ?>" alt="<?= htmlspecialchars(
              $pref['title'],
            ) ?>" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
            <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
            <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-3">
              <span class="pc-service-card-title text-white d-block fs-6 fw-bold mb-1"><?= htmlspecialchars($pref['title']) ?></span>
              <span class="d-block small text-white-50 mb-0"><?= htmlspecialchars($pref['desc']) ?></span>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <p class="small text-muted-pc text-center mt-4 mb-0">
      *Rates, discounts, rewards, campaigns and eligibility are subject to current partner/programme terms.
    </p>
  </div>
</section>
