<?php
/**
 * Home page: "Simple Steps to Book Your Ride" + route phone mockup.
 */
?>
<!-- ============ Simple Steps to Book Your Ride ============ -->
<section class="section-pc">
  <div class="container">
    <div class="pc-panel rounded-5 p-4 p-md-5">
      <div class="text-center mb-5">
        <h2 class="mb-3">Simple Steps to Book Your Ride</h2>
        <p class="text-muted-pc mx-auto" style="max-width: 60ch;">
          Book your ride easily through our app or website and enjoy a seamless journey
          every time. We monitor every trip you make, ensuring that you are never charged extra.
        </p>
      </div>
      <div class="row align-items-center gy-5">
        <div class="col-lg-6">
          <?php
            $rideSteps = [
              ['n' => 1, 'title' => 'Enter Your Details', 'desc' => 'Provide your pickup and drop-off locations.'],
              ['n' => 2, 'title' => 'Choose Your Ride', 'desc' => 'Select from a range of vehicles to suit your needs.'],
              ['n' => 3, 'title' => 'Confirm Booking', 'desc' => 'Review your details and confirm your ride.'],
              ['n' => 4, 'title' => 'Track Your Ride', 'desc' => 'Use our app to track your driver in real time.'],
            ];
          ?>
          <?php foreach ($rideSteps as $i => $step): ?>
            <div class="py-3<?= $i < count($rideSteps) - 1 ? ' border-bottom' : '' ?>" style="border-color: rgba(28,20,16,.12) !important;">
              <h5 class="fw-bold mb-1" style="color: var(--pc-orange);"><?= $step['n'] ?>. <?= htmlspecialchars($step['title']) ?></h5>
              <p class="small text-muted-pc mb-0"><?= htmlspecialchars($step['desc']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="col-lg-6 d-flex justify-content-center">
          <div class="pc-phone-frame mx-auto">
            <div class="pc-phone-screen">
              <span class="pc-phone-notch"></span>
              <div class="position-absolute top-0 start-0 w-100 h-100" style="background: var(--pc-cream-soft);"></div>

              <svg class="position-absolute top-0 start-0 w-100 h-100" viewBox="0 0 240 420" preserveAspectRatio="none" aria-hidden="true">
                <g fill="none" stroke="rgba(28,20,16,.1)" stroke-width="5">
                  <path d="M0,90 L240,70"></path>
                  <path d="M0,210 L240,230"></path>
                  <path d="M60,0 L75,420"></path>
                  <path d="M170,0 L155,420"></path>
                </g>
                <path d="M50,330 L54,270 L120,264 L126,180 L184,172 L180,110" fill="none" stroke="#ff6a00" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"></path>
                <circle cx="50" cy="330" r="7" fill="#fff" stroke="#ff6a00" stroke-width="3.5"></circle>
                <circle cx="180" cy="110" r="7" fill="#fff" stroke="#1c1410" stroke-width="3.5"></circle>
              </svg>

              <div class="position-absolute bg-white rounded-3 shadow-sm p-2 d-flex align-items-center gap-2" style="top: 46px; left: 12px; right: 40px;">
                <span class="badge rounded-2 text-white" style="background: var(--pc-orange); font-size: .6rem;">6 min</span>
                <span class="small">
                  <span class="d-block fw-bold" style="font-size: .7rem;">Pick up</span>
                  <span class="d-block text-muted-pc" style="font-size: .65rem;">Kylmore Road, Inchicore</span>
                </span>
              </div>

              <div class="position-absolute bg-white rounded-3 shadow-sm p-2 d-flex align-items-center gap-2" style="top: 148px; left: 40px; right: 12px;">
                <span class="badge rounded-2 text-white" style="background: var(--pc-dark); font-size: .6rem;">24 min</span>
                <span class="small">
                  <span class="d-block fw-bold" style="font-size: .7rem;">Drop off</span>
                  <span class="d-block text-muted-pc" style="font-size: .65rem;">Dublin Airport, T2</span>
                </span>
              </div>

              <div class="position-absolute bottom-0 start-0 end-0 bg-white rounded-top-4 shadow-sm p-3">
                <div class="d-flex justify-content-between mb-2">
                  <span class="small">
                    <span class="d-block text-muted-pc" style="font-size:.6rem;">TIME</span>
                    <span class="fw-bold">24 min</span>
                  </span>
                  <span class="small text-end">
                    <span class="d-block text-muted-pc" style="font-size:.6rem;">DISTANCE</span>
                    <span class="fw-bold">12.4 km</span>
                  </span>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                  <span class="fw-bold fs-5" style="color: var(--pc-orange);">&euro;24.50</span>
                  <span class="d-inline-flex align-items-center justify-content-center rounded-3 text-white" style="width: 34px; height: 30px; background: var(--pc-orange-light);">
                    <i class="bi bi-chevron-double-right"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
