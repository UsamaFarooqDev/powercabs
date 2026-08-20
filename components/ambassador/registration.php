<?php

$old ??= [
  'name' => '',
  'email' => '',
  'phone' => '',
  'affiliated_with' => '',
  'registered_with_powercabs' => '',
  'license_number' => '',
];
$formStatus ??= null;
$formError ??= '';

$ambRecap = ['Free card terminals', 'Exclusive vehicle branding', 'Fuel discounts', 'Extra loyalty points'];
?>
<section class="pc-amb-register position-relative overflow-hidden section-pc" id="pcAmbRegister" style="background: linear-gradient(180deg, var(--pc-cream-soft) 0%, var(--pc-white) 100%);">
  <div class="container position-relative">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Join the Programme</p>
        <h2 class="mb-3" style="font-size: clamp(1.9rem, 3.4vw, 2.5rem);">Ready to Represent PowerCabs?</h2>
        <p class="text-muted-pc mb-4" style="font-size: 1.1rem; max-width: 42ch;">
          Registration takes a couple of minutes. Our Ambassador team reviews
          every application personally and will be in touch to confirm your spot.
        </p>

        <div class="d-flex flex-wrap gap-2 mb-5">
          <?php foreach ($ambRecap as $item): ?>
            <span class="pc-amb-recap-chip d-inline-flex align-items-center gap-2">
              <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
              <?= htmlspecialchars($item) ?>
            </span>
          <?php endforeach; ?>
        </div>

        <div class="d-flex flex-column gap-4">
          <div class="d-flex gap-3">
            <span class="pc-amb-step-index">01</span>
            <div>
              <h3 class="fs-6 fw-bold mb-1">Your Details</h3>
              <p class="small text-muted-pc mb-0">Name, email and phone number.</p>
            </div>
          </div>
          <div class="d-flex gap-3">
            <span class="pc-amb-step-index">02</span>
            <div>
              <h3 class="fs-6 fw-bold mb-1">Ride &amp; License Info</h3>
              <p class="small text-muted-pc mb-0">Current affiliation, PowerCabs status and license number.</p>
            </div>
          </div>
          <div class="d-flex gap-3">
            <span class="pc-amb-step-index">03</span>
            <div>
              <h3 class="fs-6 fw-bold mb-1">Submit Application</h3>
              <p class="small text-muted-pc mb-0">Our team reviews and follows up directly.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="pc-amb-form-panel">
          <form method="post" action="" class="row g-3">
            <div class="col-md-6">
              <label class="form-label pc-required" for="apName">Name</label>
              <input type="text" class="form-control" id="apName" name="name" value="<?= htmlspecialchars(
                $old['name'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="apEmail">Email</label>
              <input type="email" class="form-control" id="apEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="apPhone">Phone</label>
              <input type="tel" class="form-control" id="apPhone" name="phone" value="<?= htmlspecialchars(
                $old['phone'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="apAffiliated">Currently Affiliated With <span class="text-muted-pc fw-normal">(optional)</span></label>
              <input type="text" class="form-control" id="apAffiliated" name="affiliated_with" value="<?= htmlspecialchars(
                $old['affiliated_with'],
              ) ?>" placeholder="e.g. independent, another fleet">
            </div>

            <div class="col-md-6">
              <label class="form-label pc-required" for="apLicense">License Number</label>
              <input type="text" class="form-control" id="apLicense" name="license_number" value="<?= htmlspecialchars(
                $old['license_number'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="apRegistered">Registered with PowerCabs?</label>
              <select class="form-select" id="apRegistered" name="registered_with_powercabs" required>
                <option value="" disabled <?= $old['registered_with_powercabs'] === ''
                  ? 'selected'
                  : '' ?>>Select an option</option>
                <option value="Yes" <?= $old['registered_with_powercabs'] === 'Yes' ? 'selected' : '' ?>>Yes</option>
                <option value="No" <?= $old['registered_with_powercabs'] === 'No' ? 'selected' : '' ?>>No</option>
              </select>
            </div>

            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary px-4 rounded-pill d-inline-flex align-items-center">
                <span>Submit Application</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your registration has been sent. Our team will be in touch shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars(
                $formError,
              ) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
