<?php
$pageTitle       = 'Lost an Item Report | PowerCabs';
$pageDescription = 'Left something behind in a PowerCabs vehicle? Report it here with your journey details and we\'ll help track it down.';
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError  = '';
$old = [
    'name' => '', 'email' => '', 'phone' => '', 'taxi_number' => '',
    'pickup_location' => '', 'destination_location' => '', 'journey_datetime' => '',
    'item_description' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['name'] === '' || $old['email'] === '' || $old['phone'] === '' || $old['taxi_number'] === '' || $old['pickup_location'] === '' || $old['destination_location'] === '' || $old['journey_datetime'] === '' || $old['item_description'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } elseif (empty($_FILES['receipt']['tmp_name']) || $_FILES['receipt']['error'] !== UPLOAD_ERR_OK) {
        $formStatus = 'error';
        $formError  = 'Please upload a receipt or booking confirmation.';
    } else {
        $attachments = [];
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
        $mime = mime_content_type($_FILES['receipt']['tmp_name']);
        if (!in_array($mime, $allowedMime, true) || $_FILES['receipt']['size'] > 5 * 1024 * 1024) {
            $formStatus = 'error';
            $formError  = 'Receipt upload must be a JPG, PNG, WEBP or PDF under 5MB.';
        } else {
            $attachments[] = [
                'tmp_path' => $_FILES['receipt']['tmp_name'],
                'filename' => basename($_FILES['receipt']['name']),
                'mime'     => $mime,
            ];
        }

        if ($formStatus !== 'error') {
            $body = "New lost item report from the PowerCabs website.\n\n"
                  . "Name: {$old['name']}\n"
                  . "Email: {$old['email']}\n"
                  . "Phone: {$old['phone']}\n"
                  . "Taxi Number: " . ($old['taxi_number'] !== '' ? $old['taxi_number'] : '-') . "\n"
                  . "Pickup Location: " . ($old['pickup_location'] !== '' ? $old['pickup_location'] : '-') . "\n"
                  . "Destination Location: " . ($old['destination_location'] !== '' ? $old['destination_location'] : '-') . "\n"
                  . "Date/Time of Journey: " . ($old['journey_datetime'] !== '' ? $old['journey_datetime'] : '-') . "\n\n"
                  . "Item Lost Details:\n{$old['item_description']}\n";

            $result = pc_send_mail(
                'Lost item report: ' . $old['name'],
                $body,
                ['name' => $old['name'], 'email' => $old['email']],
                $attachments
            );

            if ($result['success']) {
                $formStatus = 'success';
                foreach ($old as $key => $default) {
                    $old[$key] = '';
                }
            } else {
                $formStatus = 'error';
                $formError  = 'Sorry, something went wrong sending your report. Please try again or call us directly.';
            }
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Left Something Behind?';
$heroTitleLight  = "Let's Find";
$heroTitleBold   = 'Your Item.';
$heroDescription = 'Give us as much detail as you can about your journey and the item, and we\'ll reach out to your driver to help locate it.';
$heroBgImage     = 'https://images.pexels.com/photos/12092769/pexels-photo-12092769.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<section class="section-pc">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-5">
        <h2 class="mb-3" style="font-size: clamp(1.5rem, 2.5vw, 2rem);">What to Include</h2>
        <p class="text-muted-pc mb-4">
          The more detail you give us, the faster we can match your report to the right
          driver and vehicle. If you have a receipt or booking confirmation with a photo
          of the item, attach it below.
        </p>
        <ul class="list-unstyled d-flex flex-column gap-3 mb-4">
          <li class="d-flex gap-3">
            <i class="bi bi-car-front-fill fs-5" style="color: var(--pc-orange);"></i>
            <span class="text-muted-pc">Your taxi number and journey route, if you remember them.</span>
          </li>
          <li class="d-flex gap-3">
            <i class="bi bi-clock-fill fs-5" style="color: var(--pc-orange);"></i>
            <span class="text-muted-pc">The approximate date and time of your journey.</span>
          </li>
          <li class="d-flex gap-3">
            <i class="bi bi-bag-check-fill fs-5" style="color: var(--pc-orange);"></i>
            <span class="text-muted-pc">A clear description of the item -- colour, brand, and any identifying details.</span>
          </li>
        </ul>
        <p class="text-muted-pc mb-0 small">
          Once submitted, our team will reach out to your driver directly and follow up
          with you by email.
        </p>
      </div>

      <div class="col-lg-7">
        <div class="bg-white rounded-5 p-3 p-md-5" style="box-shadow: var(--pc-shadow-md);">
          <form method="post" action="" enctype="multipart/form-data" class="row g-3">
            <div class="col-md-6">
              <label class="form-label pc-required" for="liName">Full Name</label>
              <input type="text" class="form-control" id="liName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="liEmail">Email Address</label>
              <input type="email" class="form-control" id="liEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="liPhone">Phone Number</label>
              <input type="tel" class="form-control" id="liPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="liTaxiNumber">Taxi Number</label>
              <input type="text" class="form-control" id="liTaxiNumber" name="taxi_number" value="<?= htmlspecialchars($old['taxi_number']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="liPickup">Pickup Location</label>
              <input type="text" class="form-control" id="liPickup" name="pickup_location" value="<?= htmlspecialchars($old['pickup_location']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="liDropoff">Destination Location</label>
              <input type="text" class="form-control" id="liDropoff" name="destination_location" value="<?= htmlspecialchars($old['destination_location']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="liDate">Date / Time</label>
              <input type="datetime-local" class="form-control" id="liDate" name="journey_datetime" value="<?= htmlspecialchars($old['journey_datetime']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="liReceipt">Upload Receipt <span class="text-muted-pc fw-normal">(JPG/PNG/PDF)</span></label>
              <input type="file" class="form-control" id="liReceipt" name="receipt" accept=".jpg,.jpeg,.png,.webp,.pdf" required>
            </div>
            <div class="col-12">
              <label class="form-label pc-required" for="liItem">Item Lost Details</label>
              <textarea class="form-control" id="liItem" name="item_description" rows="4" required><?= htmlspecialchars($old['item_description']) ?></textarea>
            </div>
            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
                <span>Submit Report</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your report has been sent. We'll be in touch as soon as we hear back from your driver.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
