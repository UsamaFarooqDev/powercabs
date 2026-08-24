<?php
$pageTitle       = 'Complaint Form | PowerCabs';
$pageDescription = 'Let us know if something went wrong on a recent PowerCabs journey -- we take every complaint seriously and follow up quickly.';
$assetPath       = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$criminalCategories = [
    'Lost property in a small public service vehicle',
    'Road traffic offence involving a taxi',
    'Allegation of a criminal nature',
];

$fullFormCategories = [
    'The conduct, behaviour and identification of a driver',
    'Overcharging and other matters related to the fare',
    'Identification and general appearance',
];

$minimalCategories = [
    'Condition, roadworthiness and cleanliness of the vehicle',
    'Matters related to the hiring of a driver',
];

$formStatus = null;
$formError  = '';
$old = [
    'service_type' => 'Taxi / Wheelchair Accessible Taxi', 'complaint_category' => '',
    'first_name' => '', 'last_name' => '', 'email' => '', 'phone' => '', 'postal_address' => '',
    'pickup_location' => '', 'destination_location' => '', 'journey_date' => '', 'journey_time' => '', 'passengers' => '',
    'vehicle_licence_number' => '', 'driver_name' => '', 'driver_licence_number' => '', 'vehicle_registration_number' => '', 'vehicle_make_model' => '',
    'dispatch_name' => '', 'method_of_booking' => '', 'contact_information' => '', 'date_of_booking' => '', 'time_of_booking' => '',
    'experience_description' => '', 'experience_name' => '', 'experience_date' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }
    $termsAgreed = isset($_POST['terms_agree']);

    $isMinimalForm = in_array($old['complaint_category'], $minimalCategories, true);
    $isFullForm    = in_array($old['complaint_category'], $fullFormCategories, true);

    if (in_array($old['complaint_category'], $criminalCategories, true)) {
        $formStatus = 'error';
        $formError  = 'This category relates to a matter for An Garda Siochana, not something submitted through this form. In an emergency ring 999 or 112.';
    } elseif ($old['service_type'] === '' || $old['complaint_category'] === '') {
        $formStatus = 'error';
        $formError  = 'Please select a service type and a complaint category.';
    } elseif (!$isMinimalForm && !$isFullForm) {
        // Defensive: every real category is one of the three lists above,
        // so this only fires if complaint_category was tampered with.
        $formStatus = 'error';
        $formError  = 'Please select a valid complaint category.';
    } elseif ($isFullForm && ($old['email'] === '' || $old['phone'] === '' || $old['pickup_location'] === '' || $old['destination_location'] === '' || $old['journey_date'] === '' || $old['journey_time'] === '' || $old['experience_description'] === '' || $old['experience_name'] === '' || $old['experience_date'] === '')) {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif ($isFullForm && !filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } elseif ($isFullForm && !$termsAgreed) {
        $formStatus = 'error';
        $formError  = 'Please confirm you agree to the Terms and Conditions and Privacy Policy.';
    } elseif ($isMinimalForm) {
        $body = "New complaint submitted via the PowerCabs website.\n\n"
              . "Service Type: {$old['service_type']}\n"
              . "Complaint Category: {$old['complaint_category']}\n\n"
              . "No further details were collected for this category.\n";

        $result = pc_send_mail('Complaint: ' . $old['complaint_category'], $body);

        if ($result['success']) {
            $formStatus = 'success';
            foreach ($old as $key => $default) {
                $old[$key] = '';
            }
        } else {
            $formStatus = 'error';
            $formError  = 'Sorry, something went wrong sending your complaint. Please try again or call us directly.';
        }
    } else {
        $attachments = [];
        if (empty($_FILES['receipt']['tmp_name']) || $_FILES['receipt']['error'] !== UPLOAD_ERR_OK) {
            $formStatus = 'error';
            $formError  = 'Please upload a receipt or booking confirmation.';
        } else {
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
        }

        if ($formStatus !== 'error') {
            $body = "New complaint submitted via the PowerCabs website.\n\n"
                  . "Service Type: {$old['service_type']}\n"
                  . "Complaint Category: {$old['complaint_category']}\n\n"
                  . "-- Contact Details --\n"
                  . "Name: {$old['first_name']} {$old['last_name']}\n"
                  . "Email: {$old['email']}\n"
                  . "Phone: {$old['phone']}\n"
                  . "Postal Address: " . ($old['postal_address'] !== '' ? $old['postal_address'] : '-') . "\n\n"
                  . "-- Journey Details --\n"
                  . "Pickup Location: {$old['pickup_location']}\n"
                  . "Destination Location: {$old['destination_location']}\n"
                  . "Date: {$old['journey_date']}\n"
                  . "Time: {$old['journey_time']}\n"
                  . "Number of Passengers: " . ($old['passengers'] !== '' ? $old['passengers'] : '-') . "\n\n";

            $body .= "-- SPSV Details --\n"
                   . "Vehicle Licence Number: " . ($old['vehicle_licence_number'] !== '' ? $old['vehicle_licence_number'] : '-') . "\n"
                   . "Driver Name: " . ($old['driver_name'] !== '' ? $old['driver_name'] : '-') . "\n"
                   . "Driver Licence Number: " . ($old['driver_licence_number'] !== '' ? $old['driver_licence_number'] : '-') . "\n"
                   . "Vehicle Registration Number: " . ($old['vehicle_registration_number'] !== '' ? $old['vehicle_registration_number'] : '-') . "\n"
                   . "Vehicle Make/Model: " . ($old['vehicle_make_model'] !== '' ? $old['vehicle_make_model'] : '-') . "\n\n";

            $body .= "-- Dispatch Operator Details --\n"
                   . "Name: " . ($old['dispatch_name'] !== '' ? $old['dispatch_name'] : '-') . "\n"
                   . "Method of Booking: " . ($old['method_of_booking'] !== '' ? $old['method_of_booking'] : '-') . "\n"
                   . "Contact Information: " . ($old['contact_information'] !== '' ? $old['contact_information'] : '-') . "\n"
                   . "Date of Booking: " . ($old['date_of_booking'] !== '' ? $old['date_of_booking'] : '-') . "\n"
                   . "Time of Booking: " . ($old['time_of_booking'] !== '' ? $old['time_of_booking'] : '-') . "\n\n";

            $body .= "-- Experience Details --\n"
                   . "Description: " . ($old['experience_description'] !== '' ? $old['experience_description'] : '-') . "\n"
                   . "Name: " . ($old['experience_name'] !== '' ? $old['experience_name'] : '-') . "\n"
                   . "Date: " . ($old['experience_date'] !== '' ? $old['experience_date'] : '-') . "\n";

            $result = pc_send_mail(
                'Complaint: ' . $old['complaint_category'],
                $body,
                ['name' => trim($old['first_name'] . ' ' . $old['last_name']), 'email' => $old['email']],
                $attachments
            );

            if ($result['success']) {
                $formStatus = 'success';
                foreach ($old as $key => $default) {
                    $old[$key] = '';
                }
            } else {
                $formStatus = 'error';
                $formError  = 'Sorry, something went wrong sending your complaint. Please try again or call us directly.';
            }
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ We Want To Know';
$heroTitleLight  = 'Tell Us';
$heroTitleBold   = 'What Went Wrong.';
$heroDescription = "We're sorry your experience didn't meet our standards. Share the details below and our support team will review it and follow up.";
$heroBgImage     = 'https://images.pexels.com/photos/6830863/pexels-photo-6830863.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$categoryLabels = [
    'catRoadworthy'     => 'Condition, roadworthiness and cleanliness of the vehicle',
    'catConduct'        => 'The conduct, behaviour and identification of a driver',
    'catOvercharge'     => 'Overcharging and other matters related to the fare',
    'catHiring'         => 'Matters related to the hiring of a driver',
    'catIdentification' => 'Identification and general appearance',
    'catLostProperty'   => 'Lost property in a small public service vehicle',
    'catTrafficOffence' => 'Road traffic offence involving a taxi',
    'catCriminal'       => 'Allegation of a criminal nature',
];

$categoryModes = [
    'catRoadworthy'     => 'minimal',
    'catConduct'        => 'full',
    'catOvercharge'     => 'full',
    'catHiring'         => 'minimal',
    'catIdentification' => 'full',
    'catLostProperty'   => 'toast',
    'catTrafficOffence' => 'toast',
    'catCriminal'       => 'toast',
];
?>

<section class="section-pc">
  <div class="container" style="max-width: 820px;">
    <form id="complaintForm" method="post" action="" enctype="multipart/form-data" novalidate>

      <!-- ============ Step 1: Service type ============ -->
      <div class="mb-4">
        <p class="fw-semibold mb-3">You have chosen to make a complaint regarding the services offered by one of the following:</p>
        <div class="d-flex flex-wrap gap-2">
          <input type="radio" class="btn-check" name="service_type" id="svcTaxi" value="Taxi / Wheelchair Accessible Taxi" autocomplete="off" <?= $old['service_type'] === 'Taxi / Wheelchair Accessible Taxi' ? 'checked' : '' ?>>
          <label class="btn btn-outline-primary rounded-pill px-4" for="svcTaxi">Taxi / Wheelchair Accessible Taxi</label>

          <input type="radio" class="btn-check" name="service_type" id="svcHackney" value="Hackney / Wheelchair Accessible Hackney" autocomplete="off" <?= $old['service_type'] === 'Hackney / Wheelchair Accessible Hackney' ? 'checked' : '' ?>>
          <label class="btn btn-outline-primary rounded-pill px-4" for="svcHackney">Hackney / Wheelchair Accessible Hackney</label>

          <input type="radio" class="btn-check" name="service_type" id="svcLimo" value="Limousine" autocomplete="off" <?= $old['service_type'] === 'Limousine' ? 'checked' : '' ?>>
          <label class="btn btn-outline-primary rounded-pill px-4" for="svcLimo">Limousine</label>

          <input type="radio" class="btn-check" name="service_type" id="svcDispatch" value="Dispatch Operator Company" autocomplete="off" <?= $old['service_type'] === 'Dispatch Operator Company' ? 'checked' : '' ?>>
          <label class="btn btn-outline-primary rounded-pill px-4" for="svcDispatch">Dispatch Operator Company</label>
        </div>
      </div>

      <!-- ============ Step 2: Complaint category ============ -->
      <div class="mb-4">
        <p class="fw-semibold mb-3">Please select the category of complaint that best suits the nature of the incident:</p>
        <div class="d-flex flex-column gap-2">
          <?php foreach ($categoryLabels as $catId => $catLabel): ?>
            <input type="radio" class="btn-check" name="complaint_category" id="<?= $catId ?>" value="<?= htmlspecialchars($catLabel) ?>" data-mode="<?= $categoryModes[$catId] ?>" autocomplete="off" <?= $old['complaint_category'] === $catLabel ? 'checked' : '' ?>>
            <label class="btn btn-outline-dark text-start rounded-3 py-2 px-3" for="<?= $catId ?>"><?= htmlspecialchars($catLabel) ?></label>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Shown instead of the form for the 3 police-matter categories -->
      <div id="criminalNotice" class="alert alert-danger d-none" role="alert">
        If the matter to which your complaint relates is of a criminal nature, you should contact An Garda S&iacute;och&aacute;na. In an emergency ring 999 or 112.
      </div>

      <div id="complaintFields" class="d-none">
        <hr class="my-4">

        <h2 class="fs-4 fw-bold mb-3">Please Provide Your Journey Details</h2>
        <p class="small fw-semibold text-uppercase text-muted-pc mb-2" style="letter-spacing: .05em;">Please provide your contact details</p>
        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label" for="cfFirstName">First Name</label>
            <input type="text" class="form-control" id="cfFirstName" name="first_name" value="<?= htmlspecialchars($old['first_name']) ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label" for="cfLastName">Last Name</label>
            <input type="text" class="form-control" id="cfLastName" name="last_name" value="<?= htmlspecialchars($old['last_name']) ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label pc-required" for="cfEmail">Email</label>
            <input type="email" class="form-control" id="cfEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label pc-required" for="cfPhone">Phone / Mobile</label>
            <input type="tel" class="form-control" id="cfPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
          </div>
          <div class="col-12">
            <label class="form-label" for="cfPostalAddress">Postal Address</label>
            <input type="text" class="form-control" id="cfPostalAddress" name="postal_address" value="<?= htmlspecialchars($old['postal_address']) ?>">
          </div>
        </div>

        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <label class="form-label pc-required" for="cfPickup">Pickup Location</label>
            <input type="text" class="form-control" id="cfPickup" name="pickup_location" value="<?= htmlspecialchars($old['pickup_location']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label pc-required" for="cfDestination">Destination Location</label>
            <input type="text" class="form-control" id="cfDestination" name="destination_location" value="<?= htmlspecialchars($old['destination_location']) ?>" required>
          </div>
          <div class="col-md-4">
            <label class="form-label pc-required" for="cfDate">Date</label>
            <input type="date" class="form-control pc-custom-datetime-enhance" id="cfDate" name="journey_date" value="<?= htmlspecialchars($old['journey_date']) ?>" required>
          </div>
          <div class="col-md-4">
            <label class="form-label pc-required" for="cfTime">Time</label>
            <input type="time" class="form-control pc-custom-datetime-enhance" id="cfTime" name="journey_time" value="<?= htmlspecialchars($old['journey_time']) ?>" required>
          </div>
          <div class="col-md-4">
            <label class="form-label" for="cfPassengers">Number of Passengers</label>
            <input type="number" min="1" class="form-control" id="cfPassengers" name="passengers" value="<?= htmlspecialchars($old['passengers']) ?>">
          </div>
          <div class="col-12">
            <label class="form-label pc-required" for="cfReceipt">Upload Receipt</label>
            <input type="file" class="form-control" id="cfReceipt" name="receipt" accept=".jpg,.jpeg,.png,.webp,.pdf" required>
            <div class="form-text">JPG, PNG, WEBP or PDF, max 5MB.</div>
          </div>
        </div>

        <div id="spsvSection" class="mb-4">
          <p class="small fw-semibold text-uppercase text-muted-pc mb-2" style="letter-spacing: .05em;">Please provide known SPSV details</p>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="cfVehicleLicence">Vehicle Licence Number</label>
              <input type="text" class="form-control" id="cfVehicleLicence" name="vehicle_licence_number" value="<?= htmlspecialchars($old['vehicle_licence_number']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cfDriverName">Driver Name</label>
              <input type="text" class="form-control" id="cfDriverName" name="driver_name" value="<?= htmlspecialchars($old['driver_name']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cfDriverLicence">Driver Licence Number</label>
              <input type="text" class="form-control" id="cfDriverLicence" name="driver_licence_number" value="<?= htmlspecialchars($old['driver_licence_number']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cfVehicleReg">Vehicle Registration Number</label>
              <input type="text" class="form-control" id="cfVehicleReg" name="vehicle_registration_number" value="<?= htmlspecialchars($old['vehicle_registration_number']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cfVehicleMakeModel">Vehicle Make / Model</label>
              <input type="text" class="form-control" id="cfVehicleMakeModel" name="vehicle_make_model" value="<?= htmlspecialchars($old['vehicle_make_model']) ?>">
            </div>
          </div>
        </div>

        <div id="dispatchSection" class="mb-4">
          <p class="small fw-semibold text-uppercase text-muted-pc mb-2" style="letter-spacing: .05em;">Please provide known Dispatch Operator details</p>
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="cfDispatchName">Name</label>
              <input type="text" class="form-control" id="cfDispatchName" name="dispatch_name" value="<?= htmlspecialchars($old['dispatch_name']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cfMethodBooking">Method of Booking</label>
              <input type="text" class="form-control" id="cfMethodBooking" name="method_of_booking" value="<?= htmlspecialchars($old['method_of_booking']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="cfContactInfo">Contact Information</label>
              <input type="text" class="form-control" id="cfContactInfo" name="contact_information" value="<?= htmlspecialchars($old['contact_information']) ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label" for="cfDateBooking">Date of Booking</label>
              <input type="date" class="form-control pc-custom-datetime-enhance" id="cfDateBooking" name="date_of_booking" value="<?= htmlspecialchars($old['date_of_booking']) ?>">
            </div>
            <div class="col-md-3">
              <label class="form-label" for="cfTimeBooking">Time of Booking</label>
              <input type="time" class="form-control pc-custom-datetime-enhance" id="cfTimeBooking" name="time_of_booking" value="<?= htmlspecialchars($old['time_of_booking']) ?>">
            </div>
          </div>
        </div>

        <div id="experienceSection" class="d-none mb-4">
          <p class="small fw-semibold text-uppercase text-muted-pc mb-1" style="letter-spacing: .05em;">Please give some details of your experience</p>
          <p class="text-muted-pc small mb-3">e.g. comments made by driver, description of vehicle condition, total fare charged</p>
          <div class="row g-3">
            <div class="col-12">
              <label class="form-label pc-required" for="cfExperienceDescription">Describe Your Experience</label>
              <textarea class="form-control" id="cfExperienceDescription" name="experience_description" rows="4" required><?= htmlspecialchars($old['experience_description']) ?></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="cfExperienceName">Your Name</label>
              <input type="text" class="form-control" id="cfExperienceName" name="experience_name" value="<?= htmlspecialchars($old['experience_name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="cfExperienceDate">Date</label>
              <input type="date" class="form-control pc-custom-datetime-enhance" id="cfExperienceDate" name="experience_date" value="<?= htmlspecialchars($old['experience_date']) ?>" required>
            </div>
          </div>
        </div>

        <div class="form-check mb-4">
          <input class="form-check-input" type="checkbox" id="cfTerms" name="terms_agree">
          <label class="form-check-label" for="cfTerms">
            I have read and agree to the <a class="pc-form-link" href="<?= $assetPath ?>/terms-conditions" target="_blank" rel="noopener">Terms and Conditions</a> and <a class="pc-form-link" href="<?= $assetPath ?>/privacy-policy" target="_blank" rel="noopener">Privacy Policy</a>
          </label>
        </div>
      </div>

      <div id="complaintSubmitWrapper" class="d-none">
        <button type="submit" id="complaintSubmitBtn" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
          <span id="complaintSubmitLabel">Submit Complaint</span>
          <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
        </button>
      </div>

      <?php if ($formStatus === 'success'): ?>
        <div class="alert alert-success mt-3" role="alert">Thanks -- your complaint has been sent. Our support team will review it and follow up.</div>
      <?php elseif ($formStatus === 'error'): ?>
        <div class="alert alert-danger mt-3" role="alert"><?= htmlspecialchars($formError) ?></div>
      <?php endif; ?>
    </form>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/complaint-form.js"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-datetime.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-datetime.js',
) ?>"></script>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
