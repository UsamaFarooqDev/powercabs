<?php
$pageTitle       = 'Book Ride Online | PowerCabs';
$pageDescription = 'Book your next PowerCabs ride online in a few simple steps -- no extra charge for pre-booking, no cancellation fee.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';
require __DIR__ . '/includes/maps-config.php';

$rideTypeOptions = ['Economy', 'Economy XL', 'Limousine', 'Wheelchair Taxi', 'Pets Taxi', 'Courier / Parcel', 'Business', 'Business XL'];

$formStatus = null;
$formError  = '';
$old = [
    'name' => '', 'email' => '', 'phone' => '', 'ride_type' => '',
    'pickup_location' => '', 'dropoff_location' => '', 'ride_date' => '', 'ride_time' => '',
    'pickup_lat' => '', 'pickup_lng' => '', 'dropoff_lat' => '', 'dropoff_lng' => '',
    'distance_km' => '', 'duration_min' => '', 'fare_eur' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['name'] === '' || $old['email'] === '' || $old['phone'] === '' || $old['ride_type'] === '' || $old['pickup_location'] === '' || $old['dropoff_location'] === '' || $old['ride_date'] === '' || $old['ride_time'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $body = "New online booking request from the PowerCabs website.\n\n"
              . "Name: {$old['name']}\n"
              . "Email: {$old['email']}\n"
              . "Phone: {$old['phone']}\n"
              . "Ride Type: {$old['ride_type']}\n\n"
              . "Pickup Location: {$old['pickup_location']}\n"
              . "Drop-off Location: {$old['dropoff_location']}\n"
              . "Date: {$old['ride_date']}\n"
              . "Time: {$old['ride_time']}\n";

        if ($old['distance_km'] !== '' && $old['duration_min'] !== '' && $old['fare_eur'] !== '') {
            $body .= "\nEstimated Distance: {$old['distance_km']} km\n"
                   . "Estimated Duration: {$old['duration_min']} min\n"
                   . "Estimated Fare: \u{20AC}{$old['fare_eur']}\n";
        }

        $result = pc_send_mail(
            'Online booking: ' . $old['name'],
            $body,
            ['name' => $old['name'], 'email' => $old['email']]
        );

        if ($result['success']) {
            $formStatus = 'success';
            foreach ($old as $key => $default) {
                $old[$key] = '';
            }
        } else {
            $formStatus = 'error';
            $formError  = 'Sorry, something went wrong sending your booking. Please try again or call us directly.';
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Book Online';
$heroTitleLight  = 'Book Ride';
$heroTitleBold   = 'Online.';
$heroDescription = 'Booking a ride with PowerCabs is now easier than ever. Use our simple and efficient online booking system to schedule your next trip in just a few steps.';
$heroBgImage     = $assetPath . 'assets/img/services-corporate.jpg';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<!-- ============ Booking Steps ============ -->
<section class="section-pc position-relative overflow-hidden">
  <div class="container position-relative" style="z-index: 1;">
    <div class="text-center mb-5">
      <h2 class="mb-0">Booking in Four Simple Steps</h2>
    </div>

    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <div class="row row-cols-2 g-3">
          <?php
          $bookingSteps = [
            ['n' => 1, 'title' => 'Enter Your Pickup and Drop-off Location'],
            ['n' => 2, 'title' => 'Select Your Ride'],
            ['n' => 3, 'title' => 'Choose Your Time'],
            ['n' => 4, 'title' => 'Confirm Your Booking'],
          ];
          ?>
          <?php foreach ($bookingSteps as $step): ?>
            <div class="col">
              <div class="pc-story-card rounded-4 py-5 px-4 bg-white h-100 text-start position-relative overflow-hidden border-0">

                <!-- ghost number watermark -->
                <span
                  class="position-absolute fw-bold"
                  style="top: -10px; right: 6px; font-size: 3.25rem; line-height: 1; color: var(--pc-orange); opacity: .1; user-select: none;"
                >
                  <?= str_pad($step['n'], 2, '0', STR_PAD_LEFT) ?>
                </span>

                <h3 class="fs-6 fw-bold mb-0 position-relative pe-4"><?= htmlspecialchars($step['title']) ?></h3>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-lg-6 d-none d-lg-block">
        <img
            src="<?= $assetPath ?>assets/img/booking-ride.svg"
            class="img-fluid"
            style="max-width: 520px;"
            alt="Book your ride">
      </div>
    </div>
  </div>
</section>

<!-- ============ Booking Form (floating over a full-bleed map) ============ -->
<style>
  .pc-ride-map-bleed {
    width: 100%;
    height: 280px;
  }

  @media (min-width: 992px) {
    .pc-ride-map-bleed {
      position: absolute;
      inset: 0;
      width: auto;
      height: auto;
    }
  }
</style>

<section class="position-relative overflow-hidden" style="min-height: 280px;">
  <div id="pcRideMap" class="pc-ride-map-bleed"></div>

  <div class="container-fluid position-relative px-0" style="z-index: 1;">
    <div class="row g-0 justify-content-end">
      <div class="col-12 col-lg-6 col-xl-5 px-3 px-lg-0 pe-lg-5 py-4 py-lg-5" id="pcRideFormCol">

<div class="bg-white rounded-5 p-2 p-md-5" style="box-shadow: var(--pc-shadow-lg);">
    <div class="text-left mb-4">
      <h3 class="mb-0">Please Fill Out the Form</h3>
    </div>

    <form method="post" action="" class="row g-3">
      <div class="col-md-6">
        <label class="form-label pc-required" for="brName">Full Name</label>
        <input type="text" class="form-control" id="brName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label pc-required" for="brEmail">Email Address</label>
        <input type="email" class="form-control" id="brEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label pc-required" for="brPhone">Phone Number</label>
        <input type="tel" class="form-control" id="brPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label pc-required" for="brRideType">Ride Type</label>
        <select class="form-select" id="brRideType" name="ride_type" required>
          <option value="" disabled <?= $old['ride_type'] === '' ? 'selected' : '' ?>>Select ride type</option>
          <?php foreach ($rideTypeOptions as $type): ?>
            <option value="<?= htmlspecialchars($type) ?>" <?= $old['ride_type'] === $type ? 'selected' : '' ?>><?= htmlspecialchars($type) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label pc-required" for="brPickup">Pickup Location</label>
        <input type="text" class="form-control" id="brPickup" name="pickup_location" value="<?= htmlspecialchars($old['pickup_location']) ?>" autocomplete="off" required>
        <div class="form-text text-danger d-none" id="brPickupWarning">Please choose a pickup address within Dublin.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label pc-required" for="brDropoff">Drop-off Location</label>
        <input type="text" class="form-control" id="brDropoff" name="dropoff_location" value="<?= htmlspecialchars($old['dropoff_location']) ?>" autocomplete="off" required>
        <div class="form-text text-danger d-none" id="brDropoffWarning">Please choose a drop-off address within Dublin.</div>
      </div>
      <div class="col-md-6">
        <label class="form-label pc-required" for="brDate">Date</label>
        <input type="date" class="form-control" id="brDate" name="ride_date" value="<?= htmlspecialchars($old['ride_date']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label pc-required" for="brTime">Time</label>
        <input type="time" class="form-control" id="brTime" name="ride_time" value="<?= htmlspecialchars($old['ride_time']) ?>" required>
      </div>

      <div class="col-12 d-none" id="pcFareEstimate">
        <div class="d-flex align-items-center flex-wrap gap-3 rounded-4 px-3 py-3" style="background: rgba(25, 135, 84, .1); border: 1px solid rgba(25, 135, 84, .25);">
          <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 40px; height: 40px; background: #198754;">
            <i class="bi bi-cash-coin text-white fs-5"></i>
          </span>
          <span class="fw-bold" style="color: #146c43;">Est. fare: <span id="pcFareValue">&ndash;</span></span>
          <span class="small" style="color: #198754;">&middot; <span id="pcFareDistance">&ndash;</span> km</span>
          <span class="small" style="color: #198754;">&middot; <span id="pcFareDuration">&ndash;</span> min</span>
        </div>
      </div>

      <input type="hidden" name="pickup_lat" id="pcPickupLat" value="<?= htmlspecialchars($old['pickup_lat']) ?>">
      <input type="hidden" name="pickup_lng" id="pcPickupLng" value="<?= htmlspecialchars($old['pickup_lng']) ?>">
      <input type="hidden" name="dropoff_lat" id="pcDropoffLat" value="<?= htmlspecialchars($old['dropoff_lat']) ?>">
      <input type="hidden" name="dropoff_lng" id="pcDropoffLng" value="<?= htmlspecialchars($old['dropoff_lng']) ?>">
      <input type="hidden" name="distance_km" id="pcDistanceKm" value="<?= htmlspecialchars($old['distance_km']) ?>">
      <input type="hidden" name="duration_min" id="pcDurationMin" value="<?= htmlspecialchars($old['duration_min']) ?>">
      <input type="hidden" name="fare_eur" id="pcFareEur" value="<?= htmlspecialchars($old['fare_eur']) ?>">

      <div class="col-12 pt-2">
        <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
          <span>Confirm Booking</span>
          <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
        </button>
      </div>

      <?php if ($formStatus === 'success'): ?>
        <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your booking request has been sent. We'll confirm shortly.</div></div>
      <?php elseif ($formStatus === 'error'): ?>
        <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
      <?php endif; ?>
    </form>
</div>

      </div>
    </div>
  </div>
</section>

<script src="https://maps.googleapis.com/maps/api/js?key=<?= PC_GOOGLE_MAPS_API_KEY ?>&libraries=places&callback=initGoogleMaps" async defer></script>
<script src="<?= $assetPath ?>assets/js/components/book-ride-map.js"></script>

<!-- ============ Benefits ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-4 g-0 border-top border-start">
        <div class="col pc-why-item position-relative border-end text-center px-3 py-4 py-md-5">
          <i class="bi bi-cash-coin fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-6 fw-bold mb-2 pc-why-item-title">No Extra Charge</h3>
          <p class="small text-muted-pc mb-0">No extra charge for pre-booking your ride.</p>
        </div>
        <div class="col pc-why-item position-relative border-end text-center px-3 py-4 py-md-5">
          <i class="bi bi-x-circle fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-6 fw-bold mb-2 pc-why-item-title">No Cancellation Fee</h3>
          <p class="small text-muted-pc mb-0">Plans change -- cancel with no extra cost.</p>
        </div>
        <div class="col pc-why-item position-relative border-end text-center px-3 py-4 py-md-5">
          <i class="bi bi-calendar-check fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-6 fw-bold mb-2 pc-why-item-title">Book In Advance</h3>
          <p class="small text-muted-pc mb-0">Schedule your ride well ahead of time.</p>
        </div>
        <div class="col pc-why-item position-relative border-end text-center px-3 py-4 py-md-5">
          <i class="bi bi-emoji-smile fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
          <h3 class="fs-6 fw-bold mb-2 pc-why-item-title">Hassle-Free</h3>
          <p class="small text-muted-pc mb-0">A smooth, stress-free journey, start to finish.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
