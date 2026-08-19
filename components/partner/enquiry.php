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

// "For businesses" -- the reference page's audience there is brands buying
// ad campaigns, which doesn't exist as a PowerCabs product; on this page
// the equivalent B2B audience is the fleet/taxi operator business itself,
// so this section keeps the reference's dark CTA + benefits-grid + form
// layout but carries the existing partner enquiry form (same field
// ids/names as before, backend untouched).
$partnerBizBenefits = [
  ['title' => 'Fleet Management', 'desc' => 'Manage multiple vehicles and drivers under one PowerCabs account.'],
  ['title' => 'Business Growth', 'desc' => 'Plug into a growing network instead of relying on word of mouth alone.'],
  ['title' => 'Marketing Support', 'desc' => 'Get visibility across the PowerCabs platform and booking channels.'],
  ['title' => 'Driver Management', 'desc' => 'Onboard and manage your drivers through one simple system.'],
];
?>
<section class="pc-ptn-business position-relative overflow-hidden" id="pcPtnEnquiry" style="scroll-margin-top: 6rem;">
  <img src="https://images.pexels.com/photos/29566896/pexels-photo-29566896.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1600" alt="" aria-hidden="true" class="pc-ptn-business-bg position-absolute top-0 start-0 w-100 h-100" loading="lazy">
  <span class="pc-ptn-business-scrim position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>

  <div class="container position-relative">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange-light);">/ For Businesses</p>
        <h2 class="pc-ptn-business-title mb-3">Put Your Fleet to Work on the PowerCabs Network.</h2>
        <p class="pc-ptn-business-sub mb-4">
          Reach more passengers across a growing booking network without
          building your own platform. Tell us about your business and our
          Partner team will explore the right setup with you.
        </p>

        <div class="row row-cols-1 row-cols-sm-2 g-3">
          <?php foreach ($partnerBizBenefits as $b): ?>
            <div class="col">
              <div class="pc-ptn-biz-benefit">
                <strong><?= htmlspecialchars($b['title']) ?></strong>
                <span><?= htmlspecialchars($b['desc']) ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="pc-ptn-form-card">
          <h3 class="mb-2">Ready to Partner With PowerCabs?</h3>
          <p class="text-muted-pc mb-4">Tell us a little about your business and our Partner team will be in touch to talk through the next steps.</p>

          <form method="post" action="" class="row g-3">
            <div class="col-md-6">
              <label class="form-label pc-required" for="ptName">Name</label>
              <input type="text" class="form-control" id="ptName" name="name" value="<?= htmlspecialchars(
                $old['name'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="ptPhone">Phone</label>
              <input type="tel" class="form-control" id="ptPhone" name="phone" value="<?= htmlspecialchars(
                $old['phone'],
              ) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label pc-required" for="ptEmail">Email Address</label>
              <input type="email" class="form-control" id="ptEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label pc-required" for="ptBusinessName">Business Name</label>
              <input type="text" class="form-control" id="ptBusinessName" name="business_name" value="<?= htmlspecialchars(
                $old['business_name'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ptFleetSize">Fleet Size <span class="text-muted-pc fw-normal">(optional)</span></label>
              <input type="number" min="1" class="form-control" id="ptFleetSize" name="fleet_size" value="<?= htmlspecialchars(
                $old['fleet_size'],
              ) ?>" placeholder="e.g. 4">
            </div>
            <div class="col-md-6">
              <label class="form-label pc-required" for="ptCity">City</label>
              <input type="text" class="form-control" id="ptCity" name="city" value="<?= htmlspecialchars(
                $old['city'],
              ) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label" for="ptMessage">Tell Us About Your Fleet <span class="text-muted-pc fw-normal">(optional)</span></label>
              <textarea class="form-control" id="ptMessage" name="message" rows="3" placeholder="Vehicles, drivers, area of operation..."><?= htmlspecialchars(
                $old['message'],
              ) ?></textarea>
            </div>

            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary w-100 py-2 rounded-pill d-inline-flex align-items-center justify-content-center gap-2">
                <span>Request a Partner Call Back</span>
                <i class="bi bi-arrow-right" aria-hidden="true"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-2" role="alert">Thanks -- your enquiry has been sent. Our team will be in touch shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="col-12"><div class="alert alert-danger mb-0 mt-2" role="alert"><?= htmlspecialchars(
                $formError,
              ) ?></div></div>
            <?php endif; ?>

            <p class="pc-ptn-form-note small text-muted-pc mb-0 mt-2">
              By submitting, you're asking PowerCabs to contact you about the
              Partner Programme. Onboarding is subject to verification.
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
