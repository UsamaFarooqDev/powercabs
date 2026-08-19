<?php

$old ??= [
  'name' => '',
  'business_name' => '',
  'email' => '',
  'phone' => '',
  'fleet_size' => '',
  'city' => '',
  'message' => '',
];
$formStatus ??= null;
$formError ??= '';
?>
<section class="pc-ptn-band-b section-pc" id="pcPtnEnquiry">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Enquire</p>
        <h2 class="mb-3" style="font-size: clamp(1.9rem, 3.4vw, 2.5rem);">Ready to Partner With PowerCabs?</h2>
        <p class="text-muted-pc mb-5" style="font-size: 1.1rem; max-width: 42ch;">
          Tell us a little about your business and our Partner team will be in
          touch to talk through the next steps.
        </p>

        <div class="d-flex flex-column gap-4">
          <div class="d-flex gap-3">
            <span class="pc-amb-step-index">01</span>
            <div>
              <h3 class="fs-6 fw-bold mb-1">Business Details</h3>
              <p class="small text-muted-pc mb-0">Your name, business name and contact details.</p>
            </div>
          </div>
          <div class="d-flex gap-3">
            <span class="pc-amb-step-index">02</span>
            <div>
              <h3 class="fs-6 fw-bold mb-1">Fleet &amp; Location</h3>
              <p class="small text-muted-pc mb-0">Fleet size and the city you operate in.</p>
            </div>
          </div>
          <div class="d-flex gap-3">
            <span class="pc-amb-step-index">03</span>
            <div>
              <h3 class="fs-6 fw-bold mb-1">Submit Enquiry</h3>
              <p class="small text-muted-pc mb-0">Our Partner team reviews and follows up directly.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="pc-amb-form-panel">
          <form method="post" action="" class="row g-3">
            <div class="col-md-6">
              <label class="form-label pc-required" for="ptName">Name</label>
              <input type="text" class="form-control" id="ptName" name="name" value="<?= htmlspecialchars(
                $old['name'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="ptBusinessName">Business Name</label>
              <input type="text" class="form-control" id="ptBusinessName" name="business_name" value="<?= htmlspecialchars(
                $old['business_name'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="ptEmail">Email</label>
              <input type="email" class="form-control" id="ptEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="ptPhone">Phone</label>
              <input type="tel" class="form-control" id="ptPhone" name="phone" value="<?= htmlspecialchars(
                $old['phone'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ptFleetSize">Fleet Size <span class="text-muted-pc fw-normal">(optional)</span></label>
              <input type="number" min="1" class="form-control" id="ptFleetSize" name="fleet_size" value="<?= htmlspecialchars(
                $old['fleet_size'],
              ) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="ptCity">City</label>
              <input type="text" class="form-control" id="ptCity" name="city" value="<?= htmlspecialchars(
                $old['city'],
              ) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label" for="ptMessage">Message <span class="text-muted-pc fw-normal">(optional)</span></label>
              <textarea class="form-control" id="ptMessage" name="message" rows="4"><?= htmlspecialchars(
                $old['message'],
              ) ?></textarea>
            </div>
            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary px-4 py-2 rounded-pill d-inline-flex align-items-center">
                <span>Submit Enquiry</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your enquiry has been sent. Our team will be in touch shortly.</div></div>
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
