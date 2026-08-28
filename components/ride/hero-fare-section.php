<?php
$rideTypeOptions ??= [
  'Economy',
  'Economy XL',
  'Limousine',
  'Wheelchair Taxi',
  'Pets Taxi',
  'Courier / Parcel',
  'Business',
  'Business XL',
];

$rideTrustItems = [
  ['icon' => 'bi-patch-check-fill', 'title' => 'NTA Licensed', 'sub' => 'DH12616'],
  ['icon' => 'ie-badge', 'title' => 'Irish Company', 'sub' => 'PowerCabs Ireland Limited'],
  ['icon' => 'bi-geo-alt-fill', 'title' => 'Dublin Based', 'sub' => 'Local Irish service'],
  ['icon' => 'bi-telephone-fill', 'title' => 'Real Support', 'sub' => '+353 89 972 8089'],
];
?>
<!-- ============ Fare Estimate + "Your Taxi. Your Choice." panel ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-stretch gy-5">

      <!-- Left: "Your Taxi. Your Choice. Irish-owned." -->
      <div class="col-lg-6 order-2 order-lg-1">
        <div class="h-100 d-flex flex-column justify-content-center p-4 p-lg-5">
          <h2 class="fw-bold mb-3" style="font-size: clamp(2rem, 3.4vw, 2.75rem); line-height: 1.15; letter-spacing: -.03em;">
            Your Taxi. Your Choice. <span style="color: var(--pc-orange);">Irish-owned.</span>
          </h2>

          <p class="text-muted-pc mb-4" style="max-width: 42ch; font-size: 1.05rem; line-height: 1.7;">
            PowerCabs is an Irish taxi company based in Dublin, connecting you
            with licensed, Garda-vetted drivers for everyday journeys, airport
            transfers, business travel and more.
          </p>

          <div class="d-flex flex-wrap gap-2">
            <span class="badge rounded-pill border fw-semibold py-2 px-3" style="color: var(--pc-dark); font-size: .8rem;">
              <i class="bi bi-check-lg" style="color: var(--pc-orange);" aria-hidden="true"></i> Licensed &amp; Garda-vetted drivers
            </span>
            <span class="badge rounded-pill border fw-semibold py-2 px-3" style="color: var(--pc-dark); font-size: .8rem;">
              <i class="bi bi-check-lg" style="color: var(--pc-orange);" aria-hidden="true"></i> Available 24/7
            </span>
            <span class="badge rounded-pill border fw-semibold py-2 px-3" style="color: var(--pc-dark); font-size: .8rem;">
              <i class="bi bi-check-lg" style="color: var(--pc-orange);" aria-hidden="true"></i> Real-time tracking
            </span>
            <span class="badge rounded-pill border fw-semibold py-2 px-3" style="color: var(--pc-dark); font-size: .8rem;">
              <i class="bi bi-check-lg" style="color: var(--pc-orange);" aria-hidden="true"></i> Irish local support
            </span>
          </div>
        </div>
      </div>

      <!-- Right: Uber-style fare estimate widget -->
      <div class="col-lg-6 order-1 order-lg-2">
        <div class="pc-fare-card">
          <span class="pc-fare-pickup-badge d-inline-flex align-items-center gap-2">
            <i class="bi bi-clock-fill" aria-hidden="true"></i> Pickup Now
          </span>

          <h2 class="mt-3 mb-1">Know Your Fare, <span style="color: var(--pc-orange);">Instantly.</span></h2>
          <p class="text-muted-pc mb-4">Enter your pickup and drop-off to see the standard fare before you book.</p>

          <div class="pc-fare-inputs d-flex">
            <div class="pc-fare-markers d-flex flex-column align-items-center">
              <span class="pc-fare-dot" aria-hidden="true"></span>
              <span class="pc-fare-line-connector" aria-hidden="true"></span>
              <span class="pc-fare-square" aria-hidden="true"></span>
            </div>
            <div class="flex-grow-1" style="min-width: 0;">
              <div class="pc-fare-input-row">
                <input type="text" id="rfPickup" class="pc-fare-input" placeholder="Pickup location" autocomplete="off">
                <button type="button" id="rfLocateBtn" class="pc-fare-locate-btn" aria-label="Use current location">
                  <i class="bi bi-crosshair" aria-hidden="true"></i>
                </button>
              </div>
              <div class="pc-fare-input-row">
                <input type="text" id="rfDropoff" class="pc-fare-input" placeholder="Drop-off location" autocomplete="off">
              </div>
            </div>
          </div>

          <div class="mt-3">
            <select id="rfRideType" class="form-select pc-fare-select pc-custom-select-enhance">
              <option value="" selected>Select ride type</option>
              <?php foreach ($rideTypeOptions as $type): ?>
                <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <button type="button" id="rfSubmit" class="btn btn-pc-primary rounded-pill px-4 mt-4 fw-semibold" disabled>
            Get Fare Estimate
          </button>

          <p id="rfFareError" class="text-danger small mt-3 mb-0 d-none" role="alert"></p>

          <div id="rfFareResult" class="pc-fare-result d-none mt-4">
            <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
              <div>
                <span class="d-block small text-muted-pc" id="rfFareTypeLabel">Standard Fare</span>
                <span class="d-block fw-bold" style="font-size: 1.85rem; color: var(--pc-dark);" id="rfFareValue">&ndash;</span>
              </div>
              <span class="d-block small text-muted-pc text-end">
                <span id="rfFareDistance">&ndash;</span> km &middot; <span id="rfFareDuration">&ndash;</span> min
              </span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ============ Trust badge bar ============ -->
<section style="padding-bottom: clamp(3.5rem, 6vw, 6rem);">
  <div class="container">
    <div class="pc-ride-trust-bar row row-cols-1 row-cols-sm-2 row-cols-md-4 g-0">
      <?php foreach ($rideTrustItems as $item): ?>
        <div class="col pc-ride-trust-item d-flex align-items-center gap-3">
          <span class="pc-ride-trust-icon d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0">
            <?php if ($item['icon'] === 'ie-badge'): ?>
              <span class="fw-bold" style="font-size: .7rem; letter-spacing: .02em;">IE</span>
            <?php else: ?>
              <i class="bi <?= $item['icon'] ?>" aria-hidden="true"></i>
            <?php endif; ?>
          </span>
          <span>
            <span class="d-block fw-bold" style="color: var(--pc-dark); font-size: .92rem;"><?= htmlspecialchars(
              $item['title'],
            ) ?></span>
            <span class="d-block small text-muted-pc"><?= htmlspecialchars($item['sub']) ?></span>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Quick Book Modal (opens after "Continue") ============ -->
<div class="modal fade" id="rfBookModal" tabindex="-1" aria-labelledby="rfBookModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content rounded-4 border-0">
      <form method="post" action="" class="modal-body p-4 p-md-5">
        <div class="d-flex align-items-start justify-content-between mb-4">
          <div>
            <p class="small fw-semibold text-uppercase mb-1" style="letter-spacing: .06em; color: var(--pc-orange);">/ Quick Book</p>
            <h3 class="mb-0" id="rfBookModalLabel">Confirm Your Ride</h3>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="pc-fare-summary mb-4">
          <div class="d-flex align-items-start gap-2 mb-2">
            <i class="bi bi-circle-fill flex-shrink-0 mt-1" style="font-size: .5rem; color: var(--pc-orange);"></i>
            <span class="small" id="rfModalPickupText">&ndash;</span>
          </div>
          <div class="d-flex align-items-start gap-2 mb-2">
            <i class="bi bi-square-fill flex-shrink-0 mt-1" style="font-size: .5rem; color: var(--pc-dark);"></i>
            <span class="small" id="rfModalDropoffText">&ndash;</span>
          </div>
          <div class="d-flex align-items-center justify-content-between pt-2 mt-2" style="border-top: 1px solid rgba(28,20,16,.08);">
            <span class="small fw-semibold" id="rfModalRideTypeText">&ndash;</span>
            <span class="fw-bold" id="rfModalFareText">&ndash;</span>
          </div>
        </div>

        <input type="hidden" name="pickup_location" id="rfModalPickup">
        <input type="hidden" name="dropoff_location" id="rfModalDropoff">
        <input type="hidden" name="ride_type" id="rfModalRideType">
        <input type="hidden" name="distance_km" id="rfModalDistance">
        <input type="hidden" name="duration_min" id="rfModalDuration">
        <input type="hidden" name="fare_eur" id="rfModalFare">

        <div class="mb-3">
          <label class="form-label pc-required" for="rfModalName">Full Name</label>
          <input type="text" class="form-control" id="rfModalName" name="name" required>
        </div>
        <div class="mb-3">
          <label class="form-label pc-required" for="rfModalEmail">Email Address</label>
          <input type="email" class="form-control" id="rfModalEmail" name="email" required>
        </div>
        <div class="mb-4">
          <label class="form-label pc-required" for="rfModalPhone">Phone Number</label>
          <input type="tel" class="form-control" id="rfModalPhone" name="phone" required>
        </div>

        <button type="submit" class="btn btn-pc-primary w-100 rounded-pill py-2 d-inline-flex align-items-center justify-content-center gap-2">
          <span>Confirm Booking</span>
          <i class="bi bi-send" style="font-size: .85rem;" aria-hidden="true"></i>
        </button>

        <?php if ($quickBookFormStatus === 'success'): ?>
          <div class="alert alert-success mt-3 mb-0" role="alert">Thanks -- your booking request has been sent. We'll confirm shortly.</div>
        <?php elseif ($quickBookFormStatus === 'error'): ?>
          <div class="alert alert-danger mt-3 mb-0" role="alert"><?= htmlspecialchars($quickBookFormError) ?></div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</div>

<script
  src="https://maps.googleapis.com/maps/api/js?key=<?= PC_GOOGLE_MAPS_API_KEY ?>&libraries=places&callback=initRideFareMap"
  async defer></script>
<script src="<?= $assetPath ?>assets/js/components/ride-fare-estimate.js"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-select.js?v=<?= @filemtime(
  __DIR__ . '/../../assets/js/components/custom-select.js',
) ?>"></script>
