<section class="section-pc" id="business-booking-form" style="scroll-margin-top: 6rem;">
  <div class="container">
    <div class="row justify-content-center text-center mb-5">
      <div class="col-lg-8">
        <h2 class="mb-3">How to Book Our Business Rides</h2>
        <p class="text-muted-pc mb-4">
          Open a PowerCabs Business Account in minutes and give your team a faster,
          simpler way to travel -- booked through the same app, billed to one account.
        </p>
      </div>

      <div class="col-12">
        <div class="row row-cols-2 row-cols-md-5 g-4 justify-content-center">
          <?php
          $businessAccountBenefits = [
            ['icon' => 'bi-lightning-charge-fill', 'title' => 'Priority Booking'],
            ['icon' => 'bi-receipt', 'title' => 'Monthly Billing'],
            ['icon' => 'bi-people-fill', 'title' => 'Multiple Users'],
            ['icon' => 'bi-clock-history', 'title' => 'Ride History'],
            ['icon' => 'bi-headset', 'title' => 'Corporate Support'],
          ];
          ?>
          <?php foreach ($businessAccountBenefits as $benefit): ?>
            <div class="col d-flex flex-column align-items-center gap-2">
              <span class="pc-ride-type-icon rounded-circle d-inline-flex align-items-center justify-content-center">
                <i class="bi <?= $benefit['icon'] ?>"></i>
              </span>
              <span class="fw-semibold small"><?= htmlspecialchars($benefit['title']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <?php
          $mockupImage = 'business-account.jpeg';
          $mockupAlt   = 'PowerCabs app screen for booking a business ride';
          $mockupNotch = true;
          require __DIR__ . '/../shared/app-mockup.php';
        ?>
      </div>

      <div class="col-lg-6">
        <?php require __DIR__ . '/business-account-form.php'; ?>
      </div>
    </div>
  </div>
</section>
