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

<?php
// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = $pcLabel;
$submitClass = $pcBtnPrimary;
// Segmented pill toggle (service type) -- has-[:checked] reproduces
// Bootstrap's .btn-check + .btn sibling-selector trick without it.
$pillToggleClass = 'tw-inline-flex tw-cursor-pointer tw-items-center tw-rounded-full tw-border tw-border-solid tw-border-ink/20 tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink tw-transition-colors tw-duration-200 has-[:checked]:tw-border-power has-[:checked]:tw-bg-power has-[:checked]:tw-text-white';
// Left-aligned selectable card (complaint category) -- same has-checked
// mechanism, styled as a full-width list item instead of a pill.
$cardToggleClass = 'tw-block tw-w-full tw-cursor-pointer tw-rounded-lg tw-border tw-border-solid tw-border-ink/15 tw-px-4 tw-py-2.5 tw-text-left tw-text-sm tw-font-medium tw-text-ink tw-transition-colors tw-duration-200 has-[:checked]:tw-border-ink has-[:checked]:tw-bg-ink has-[:checked]:tw-text-white';
?>
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-max-w-[820px]">
    <form id="complaintForm" method="post" action="" enctype="multipart/form-data" novalidate>

      <!-- ============ Step 1: Service type ============ -->
      <div class="tw-mb-6">
        <p class="tw-mb-3 tw-font-semibold tw-text-ink">You have chosen to make a complaint regarding the services offered by one of the following:</p>
        <div class="tw-flex tw-flex-wrap tw-gap-2">
          <label class="<?= $pillToggleClass ?>" for="svcTaxi">
            <input type="radio" class="tw-sr-only" name="service_type" id="svcTaxi" value="Taxi / Wheelchair Accessible Taxi" autocomplete="off" <?= $old['service_type'] === 'Taxi / Wheelchair Accessible Taxi' ? 'checked' : '' ?>>
            Taxi / Wheelchair Accessible Taxi
          </label>
          <label class="<?= $pillToggleClass ?>" for="svcHackney">
            <input type="radio" class="tw-sr-only" name="service_type" id="svcHackney" value="Hackney / Wheelchair Accessible Hackney" autocomplete="off" <?= $old['service_type'] === 'Hackney / Wheelchair Accessible Hackney' ? 'checked' : '' ?>>
            Hackney / Wheelchair Accessible Hackney
          </label>
          <label class="<?= $pillToggleClass ?>" for="svcLimo">
            <input type="radio" class="tw-sr-only" name="service_type" id="svcLimo" value="Limousine" autocomplete="off" <?= $old['service_type'] === 'Limousine' ? 'checked' : '' ?>>
            Limousine
          </label>
          <label class="<?= $pillToggleClass ?>" for="svcDispatch">
            <input type="radio" class="tw-sr-only" name="service_type" id="svcDispatch" value="Dispatch Operator Company" autocomplete="off" <?= $old['service_type'] === 'Dispatch Operator Company' ? 'checked' : '' ?>>
            Dispatch Operator Company
          </label>
        </div>
      </div>

      <!-- ============ Step 2: Complaint category ============ -->
      <!-- Bare radio + has-checked label: complaint-form.js's
           updateCategoryState() keeps driving this via
           form.querySelector('input[name="complaint_category"]:checked')
           and each input's data-mode -- unchanged, only the visual toggle
           styling moved to Tailwind. -->
      <div class="tw-mb-6">
        <p class="tw-mb-3 tw-font-semibold tw-text-ink">Please select the category of complaint that best suits the nature of the incident:</p>
        <div class="tw-flex tw-flex-col tw-gap-2">
          <?php foreach ($categoryLabels as $catId => $catLabel): ?>
            <label class="<?= $cardToggleClass ?>" for="<?= $catId ?>">
              <input type="radio" class="tw-sr-only" name="complaint_category" id="<?= $catId ?>" value="<?= htmlspecialchars($catLabel) ?>" data-mode="<?= $categoryModes[$catId] ?>" autocomplete="off" <?= $old['complaint_category'] === $catLabel ? 'checked' : '' ?>>
              <?= htmlspecialchars($catLabel) ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Shown instead of the form for the 3 police-matter categories.
           tw-hidden stays bare -- complaint-form.js toggles it via classList. -->
      <div id="criminalNotice" class="alert-danger tw-hidden tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert">
        If the matter to which your complaint relates is of a criminal nature, you should contact An Garda S&iacute;och&aacute;na. In an emergency ring 999 or 112.
      </div>

      <!-- tw-hidden stays bare on #complaintFields / #experienceSection --
           complaint-form.js toggles both directly via classList. -->
      <div id="complaintFields" class="tw-hidden">
        <hr class="tw-my-6 tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.08]">

        <h2 class="tw-mb-3 tw-text-2xl tw-font-bold tw-text-ink">Please Provide Your Journey Details</h2>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.05em] tw-text-ink/60">Please provide your contact details</p>
        <div class="tw-mb-4 tw-grid tw-grid-cols-1 tw-gap-3 md:tw-grid-cols-2">
          <div>
            <label class="<?= $labelClass ?>" for="cfFirstName">First Name</label>
            <input type="text" class="<?= $inputClass ?>" id="cfFirstName" name="first_name" value="<?= htmlspecialchars($old['first_name']) ?>">
          </div>
          <div>
            <label class="<?= $labelClass ?>" for="cfLastName">Last Name</label>
            <input type="text" class="<?= $inputClass ?>" id="cfLastName" name="last_name" value="<?= htmlspecialchars($old['last_name']) ?>">
          </div>
          <div>
            <label class="<?= $labelClass ?> pc-required" for="cfEmail">Email</label>
            <input type="email" class="<?= $inputClass ?>" id="cfEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
          </div>
          <div>
            <label class="<?= $labelClass ?> pc-required" for="cfPhone">Phone / Mobile</label>
            <input type="tel" class="<?= $inputClass ?>" id="cfPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
          </div>
          <div class="md:tw-col-span-2">
            <label class="<?= $labelClass ?>" for="cfPostalAddress">Postal Address</label>
            <input type="text" class="<?= $inputClass ?>" id="cfPostalAddress" name="postal_address" value="<?= htmlspecialchars($old['postal_address']) ?>">
          </div>
        </div>

        <div class="tw-mb-6 tw-grid tw-grid-cols-1 tw-gap-3 md:tw-grid-cols-2 lg:tw-grid-cols-3">
          <div>
            <label class="<?= $labelClass ?> pc-required" for="cfPickup">Pickup Location</label>
            <input type="text" class="<?= $inputClass ?>" id="cfPickup" name="pickup_location" value="<?= htmlspecialchars($old['pickup_location']) ?>" required>
          </div>
          <div>
            <label class="<?= $labelClass ?> pc-required" for="cfDestination">Destination Location</label>
            <input type="text" class="<?= $inputClass ?>" id="cfDestination" name="destination_location" value="<?= htmlspecialchars($old['destination_location']) ?>" required>
          </div>
          <div>
            <label class="<?= $labelClass ?> pc-required" for="cfDate">Date</label>
            <input type="date" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="cfDate" name="journey_date" value="<?= htmlspecialchars($old['journey_date']) ?>" required>
          </div>
          <div>
            <label class="<?= $labelClass ?> pc-required" for="cfTime">Time</label>
            <input type="time" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="cfTime" name="journey_time" value="<?= htmlspecialchars($old['journey_time']) ?>" required>
          </div>
          <div>
            <label class="<?= $labelClass ?>" for="cfPassengers">Number of Passengers</label>
            <input type="number" min="1" class="<?= $inputClass ?>" id="cfPassengers" name="passengers" value="<?= htmlspecialchars($old['passengers']) ?>">
          </div>
          <div class="md:tw-col-span-2 lg:tw-col-span-1">
            <label class="<?= $labelClass ?> pc-required" for="cfReceipt">Upload Receipt</label>
            <input type="file" class="<?= $inputClass ?> tw-cursor-pointer tw-py-[0.3rem] file:tw-mr-3 file:tw-cursor-pointer file:tw-rounded-full file:tw-border-0 file:tw-bg-paper file:tw-px-3 file:tw-py-1.5 file:tw-text-sm file:tw-font-semibold file:tw-text-ink" id="cfReceipt" name="receipt" accept=".jpg,.jpeg,.png,.webp,.pdf" required>
            <div class="tw-mt-1.5 tw-text-sm tw-text-ink/50">JPG, PNG, WEBP or PDF, max 5MB.</div>
          </div>
        </div>

        <div id="spsvSection" class="tw-mb-6">
          <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.05em] tw-text-ink/60">Please provide known SPSV details</p>
          <div class="tw-grid tw-grid-cols-1 tw-gap-3 md:tw-grid-cols-2">
            <div>
              <label class="<?= $labelClass ?>" for="cfVehicleLicence">Vehicle Licence Number</label>
              <input type="text" class="<?= $inputClass ?>" id="cfVehicleLicence" name="vehicle_licence_number" value="<?= htmlspecialchars($old['vehicle_licence_number']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cfDriverName">Driver Name</label>
              <input type="text" class="<?= $inputClass ?>" id="cfDriverName" name="driver_name" value="<?= htmlspecialchars($old['driver_name']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cfDriverLicence">Driver Licence Number</label>
              <input type="text" class="<?= $inputClass ?>" id="cfDriverLicence" name="driver_licence_number" value="<?= htmlspecialchars($old['driver_licence_number']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cfVehicleReg">Vehicle Registration Number</label>
              <input type="text" class="<?= $inputClass ?>" id="cfVehicleReg" name="vehicle_registration_number" value="<?= htmlspecialchars($old['vehicle_registration_number']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cfVehicleMakeModel">Vehicle Make / Model</label>
              <input type="text" class="<?= $inputClass ?>" id="cfVehicleMakeModel" name="vehicle_make_model" value="<?= htmlspecialchars($old['vehicle_make_model']) ?>">
            </div>
          </div>
        </div>

        <div id="dispatchSection" class="tw-mb-6">
          <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.05em] tw-text-ink/60">Please provide known Dispatch Operator details</p>
          <div class="tw-grid tw-grid-cols-1 tw-gap-3 md:tw-grid-cols-2 lg:tw-grid-cols-3">
            <div>
              <label class="<?= $labelClass ?>" for="cfDispatchName">Name</label>
              <input type="text" class="<?= $inputClass ?>" id="cfDispatchName" name="dispatch_name" value="<?= htmlspecialchars($old['dispatch_name']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cfMethodBooking">Method of Booking</label>
              <input type="text" class="<?= $inputClass ?>" id="cfMethodBooking" name="method_of_booking" value="<?= htmlspecialchars($old['method_of_booking']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cfContactInfo">Contact Information</label>
              <input type="text" class="<?= $inputClass ?>" id="cfContactInfo" name="contact_information" value="<?= htmlspecialchars($old['contact_information']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cfDateBooking">Date of Booking</label>
              <input type="date" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="cfDateBooking" name="date_of_booking" value="<?= htmlspecialchars($old['date_of_booking']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cfTimeBooking">Time of Booking</label>
              <input type="time" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="cfTimeBooking" name="time_of_booking" value="<?= htmlspecialchars($old['time_of_booking']) ?>">
            </div>
          </div>
        </div>

        <div id="experienceSection" class="tw-hidden tw-mb-6">
          <p class="tw-mb-1 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.05em] tw-text-ink/60">Please give some details of your experience</p>
          <p class="tw-mb-3 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">e.g. comments made by driver, description of vehicle condition, total fare charged</p>
          <div class="tw-grid tw-grid-cols-1 tw-gap-3 md:tw-grid-cols-2">
            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?> pc-required" for="cfExperienceDescription">Describe Your Experience</label>
              <textarea class="<?= $inputClass ?> tw-resize-y" id="cfExperienceDescription" name="experience_description" rows="4" required><?= htmlspecialchars($old['experience_description']) ?></textarea>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="cfExperienceName">Your Name</label>
              <input type="text" class="<?= $inputClass ?>" id="cfExperienceName" name="experience_name" value="<?= htmlspecialchars($old['experience_name']) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="cfExperienceDate">Date</label>
              <input type="date" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="cfExperienceDate" name="experience_date" value="<?= htmlspecialchars($old['experience_date']) ?>" required>
            </div>
          </div>
        </div>

        <div class="tw-mb-6 tw-flex tw-items-start tw-gap-2.5">
          <input class="tw-mt-0.5 tw-h-4 tw-w-4 tw-shrink-0 tw-cursor-pointer tw-rounded tw-border tw-border-solid tw-border-[#dee2e6] tw-accent-power" type="checkbox" id="cfTerms" name="terms_agree">
          <label class="tw-text-sm tw-text-ink" for="cfTerms">
            I have read and agree to the <a class="tw-text-power tw-transition-colors tw-duration-200 hover:tw-text-powerdark focus-visible:tw-text-powerdark" href="<?= $assetPath ?>/terms-conditions" target="_blank" rel="noopener">Terms and Conditions</a> and <a class="tw-text-power tw-transition-colors tw-duration-200 hover:tw-text-powerdark focus-visible:tw-text-powerdark" href="<?= $assetPath ?>/privacy-policy" target="_blank" rel="noopener">Privacy Policy</a>
          </label>
        </div>
      </div>

      <!-- tw-hidden stays bare -- complaint-form.js reveals it once a category is chosen. -->
      <div id="complaintSubmitWrapper" class="tw-hidden">
        <button type="submit" id="complaintSubmitBtn" class="<?= $submitClass ?>">
          <span id="complaintSubmitLabel">Submit Complaint</span>
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
        </button>
      </div>

      <?php if ($formStatus === 'success'): ?>
        <div class="alert-success tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your complaint has been sent. Our support team will review it and follow up.</div>
      <?php elseif ($formStatus === 'error'): ?>
        <div class="alert-danger tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars($formError) ?></div>
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
