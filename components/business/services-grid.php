<?php
$bizServiceModules = [
  [
    'icon' => 'bi-people-fill',
    'title' => 'Employee Travel',
    'desc' => 'Everyday commutes and inter-office journeys for your whole team.',
  ],
  [
    'icon' => 'bi-person-lines-fill',
    'title' => 'Client Travel',
    'desc' => 'Impress clients and guests from the moment they arrive.',
  ],
  [
    'icon' => 'bi-mic-fill',
    'title' => 'Events &amp; Conferences',
    'desc' => 'Coordinated arrivals and departures for conferences and corporate events.',
  ],
  [
    'icon' => 'bi-building',
    'title' => 'Hotel Guest Travel',
    'desc' => 'Reliable transfers for hotel guests, booked straight to your account.',
  ],
  [
    'icon' => 'bi-briefcase-fill',
    'title' => 'Executive Travel',
    'desc' => 'Discreet, punctual rides for executives and leadership teams.',
  ],
]; ?>
<section class="section-pc" style="background: linear-gradient(180deg, var(--pc-cream-soft) 0%, var(--pc-white) 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ What We Cover</p>
      <h2 class="mb-0">Everything Your Business Needs</h2>
    </div>

    <div class="row g-4 align-items-center">
      <div class="col-lg-6">
        <a href="#business-booking-form" class="pc-service-card pc-biz-service-card-featured d-block position-relative overflow-hidden text-decoration-none" style="border-radius: var(--pc-radius-lg);">
          <img src="<?= $assetPath ?>assets/img/meet-and-greet.png" alt="A PowerCabs Meet and Greet host welcoming a business traveller at Dublin Airport" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
          <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-4">
            <span class="pc-service-card-eyebrow d-block text-uppercase fw-semibold mb-1">Featured</span>
            <span class="pc-service-card-title d-block fs-3 fw-bold mb-1">Airport Transfers</span>
            <span class="d-block text-white-50">Meet &amp; Greet arrivals for executives, clients and guests -- every time.</span>
          </span>
        </a>
      </div>

      <div class="col-lg-6">
        <div class="d-flex flex-column">
          <?php foreach ($bizServiceModules as $service): ?>
            <div class="pc-ride-service-item d-flex align-items-center gap-3">
              <span class="pc-ride-service-icon d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0">
                <i class="bi <?= $service['icon'] ?>" aria-hidden="true"></i>
              </span>
              <span class="flex-grow-1">
                <span class="d-block fw-bold" style="color: var(--pc-dark);"><?= $service['title'] ?></span>
                <span class="d-block small text-muted-pc"><?= $service['desc'] ?></span>
              </span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
