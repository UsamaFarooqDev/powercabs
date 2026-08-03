<?php
$pageTitle       = 'Book Ride Online | PowerCabs';
$pageDescription = 'Book your next PowerCabs ride online in a few simple steps -- no extra charge for pre-booking, no cancellation fee.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';

$rideTypeOptions = ['Standard', 'Executive', 'XL / Group', 'Wheelchair Accessible', 'Airport', 'Corporate', 'Minibus', 'Night & Safety'];

$formStatus = null;
$formError  = '';
$old = [
    'name' => '', 'email' => '', 'phone' => '', 'ride_type' => '',
    'pickup_location' => '', 'dropoff_location' => '', 'ride_date' => '', 'ride_time' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['name'] === '' || $old['email'] === '' || $old['phone'] === '' || $old['pickup_location'] === '' || $old['dropoff_location'] === '' || $old['ride_date'] === '' || $old['ride_time'] === '') {
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
              . "Ride Type: " . ($old['ride_type'] !== '' ? $old['ride_type'] : 'No preference') . "\n\n"
              . "Pickup Location: {$old['pickup_location']}\n"
              . "Drop-off Location: {$old['dropoff_location']}\n"
              . "Date: {$old['ride_date']}\n"
              . "Time: {$old['ride_time']}\n";

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
require __DIR__ . '/components/inner-hero.php';
?>

<!-- ============ Booking Steps ============ -->
<section class="section-pc position-relative overflow-hidden">

  <!-- soft gradient blob, bleeding off the top-right corner -->
  <div
    class="position-absolute top-50 end-0 rounded-circle"
    style="width: 420px; height: 420px; margin-top: -180px; margin-right: -160px; background: radial-gradient(circle at 35% 35%, var(--pc-orange), transparent 70%); opacity: .12; filter: blur(60px); pointer-events: none;"
  ></div>

  <div class="container position-relative" style="z-index: 1;">
    <div class="text-center mb-5">
      <h2 class="mb-0">Booking in Four Simple Steps</h2>
    </div>

    <div class="row g-3">
      <?php
      $bookingSteps = [
        ['n' => 1, 'title' => 'Enter Your Pickup and Drop-off Location'],
        ['n' => 2, 'title' => 'Select Your Ride'],
        ['n' => 3, 'title' => 'Choose Your Time'],
        ['n' => 4, 'title' => 'Confirm Your Booking'],
      ];
      $totalSteps = count($bookingSteps);
      ?>
      <?php foreach ($bookingSteps as $i => $step): ?>
        <?php $isLast = $i === $totalSteps - 1; ?>
        <div class="col-md-6 col-lg-3 position-relative">

          <div class="pc-story-card rounded-4 p-5 bg-white h-100 text-start position-relative overflow-hidden border-0" style="box-shadow: var(--pc-shadow-sm);">

            <!-- ghost number watermark -->
            <span
              class="position-absolute fw-bold"
              style="top: -14px; right: 8px; font-size: 4.5rem; line-height: 1; color: var(--pc-orange); opacity: .1; user-select: none;"
            >
              <?= str_pad($step['n'], 2, '0', STR_PAD_LEFT) ?>
            </span>

            <h3 class="fs-5 fw-bold mb-0 position-relative pe-4"><?= htmlspecialchars($step['title']) ?></h3>
          </div>

          <!-- connector arrow, desktop only -->
          <?php if (!$isLast): ?>
            <span
              class="d-none d-lg-flex align-items-center justify-content-center position-absolute top-50 start-100 translate-middle rounded-circle bg-white"
              style="width: 28px; height: 28px; z-index: 2; box-shadow: var(--pc-shadow-sm);"
            >
              <i class="bi bi-arrow-right-short fs-3" style="color: var(--pc-orange);"></i>
            </span>
          <?php endif; ?>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Booking Form ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center g-5">
<div class="col-lg-6 d-none d-lg-block">
    <div class="position-relative text-center">
        <img
            src="<?= $assetPath ?>assets/img/booking-ride.svg"
            class="img-fluid position-relative"
            style="max-width:560px; z-index:2;"
            alt="Book your ride">
    </div>
</div>

<div class="col-lg-6 px-2 px-md-5">
    <div class="text-left mb-4">
      <h3 class="mb-0">Please Fill Out the Form</h3>
    </div>

    <?php if ($formStatus === 'success'): ?>
      <div class="alert alert-success" role="alert">Thanks -- your booking request has been sent. We'll confirm shortly.</div>
    <?php elseif ($formStatus === 'error'): ?>
      <div class="alert alert-danger" role="alert"><?= htmlspecialchars($formError) ?></div>
    <?php endif; ?>

    <form method="post" action="" class="row g-3">
      <div class="col-md-6">
        <label class="form-label" for="brName">Full Name</label>
        <input type="text" class="form-control" id="brName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="brEmail">Email Address</label>
        <input type="email" class="form-control" id="brEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="brPhone">Phone Number</label>
        <input type="tel" class="form-control" id="brPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="brRideType">Ride Type <span class="text-muted-pc fw-normal">(optional)</span></label>
        <select class="form-select" id="brRideType" name="ride_type">
          <option value="">No preference</option>
          <?php foreach ($rideTypeOptions as $type): ?>
            <option value="<?= htmlspecialchars($type) ?>" <?= $old['ride_type'] === $type ? 'selected' : '' ?>><?= htmlspecialchars($type) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="brPickup">Pickup Location</label>
        <input type="text" class="form-control" id="brPickup" name="pickup_location" value="<?= htmlspecialchars($old['pickup_location']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="brDropoff">Drop-off Location</label>
        <input type="text" class="form-control" id="brDropoff" name="dropoff_location" value="<?= htmlspecialchars($old['dropoff_location']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="brDate">Date</label>
        <input type="date" class="form-control" id="brDate" name="ride_date" value="<?= htmlspecialchars($old['ride_date']) ?>" required>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="brTime">Time</label>
        <input type="time" class="form-control" id="brTime" name="ride_time" value="<?= htmlspecialchars($old['ride_time']) ?>" required>
      </div>
      <div class="col-12 pt-2">
        <button type="submit" class="btn btn-pc-primary px-4">Confirm Booking</button>
      </div>
    </form>
    </div>
  </div>
</section>

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
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
