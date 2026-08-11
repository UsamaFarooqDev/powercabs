<?php
/**
 * Payment Solutions application form. Requires $formStatus, $formError,
 * $old from the including page (business-solutions.php) -- defaults below
 * only apply if that contract isn't met, so the IDE stops flagging $old
 * as possibly undefined without changing normal behavior.
 */
$old ??= [
    'beneficial_owner' => '', 'taxi_driver' => '', 'title' => '', 'first_name' => '', 'last_name' => '',
    'email' => '', 'dob' => '', 'nationality' => '', 'iban' => '', 'account_name' => '', 'bank' => '',
    'address_same_as_statement' => '', 'device_type' => '',
];
$formStatus ??= null;
$formError ??= '';

$countries = [
    'Ireland', 'United Kingdom', 'United States', 'Australia', 'Austria', 'Belgium', 'Brazil', 'Bulgaria',
    'Canada', 'China', 'Croatia', 'Cyprus', 'Czech Republic', 'Denmark', 'Estonia', 'Finland', 'France',
    'Germany', 'Greece', 'Hungary', 'Iceland', 'India', 'Italy', 'Latvia', 'Lithuania', 'Luxembourg', 'Malta',
    'Netherlands', 'New Zealand', 'Nigeria', 'Norway', 'Pakistan', 'Philippines', 'Poland', 'Portugal',
    'Romania', 'Slovakia', 'Slovenia', 'South Africa', 'Spain', 'Sweden', 'Switzerland', 'Ukraine',
];
?>
<section class="section-pc position-relative overflow-hidden" id="payment-apply-form" style="scroll-margin-top: 6rem;">
  <!-- Decorative background blobs, purely visual -->
  <div class="pc-drive-blob pc-drive-blob-orange" aria-hidden="true"></div>
  <div class="pc-drive-blob pc-drive-blob-dark" aria-hidden="true"></div>
  <div class="pc-drive-blob" aria-hidden="true" style="top: 55%; right: -6rem; width: 16rem; height: 16rem; background: radial-gradient(circle, rgba(232, 89, 12, .16), transparent 70%);"></div>

  <div class="container position-relative" style="max-width: 900px;">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Apply Now</p>
      <h2 class="mb-2">Apply for Your Card Terminal</h2>
      <p class="text-muted-pc mb-0">Submit your details and our team will get back to you shortly.</p>
    </div>

    <div class="bg-white rounded-5 p-4 p-md-5" style="box-shadow: var(--pc-shadow-md);">
      <form method="post" action="#payment-apply-form" class="row g-3" enctype="multipart/form-data">
        <div class="col-md-6">
          <span class="form-label d-block mb-2 pc-required">Beneficial Owner</span>
          <div class="d-flex gap-2">
            <input type="radio" class="btn-check" id="paBeneficialYes" name="beneficial_owner" value="yes" autocomplete="off" required <?= $old['beneficial_owner'] === 'yes' ? 'checked' : '' ?>>
            <label class="btn btn-outline-primary rounded-pill fw-semibold px-4" for="paBeneficialYes">Yes</label>
            <input type="radio" class="btn-check" id="paBeneficialNo" name="beneficial_owner" value="no" autocomplete="off" <?= $old['beneficial_owner'] === 'no' ? 'checked' : '' ?>>
            <label class="btn btn-outline-primary rounded-pill fw-semibold px-4" for="paBeneficialNo">No</label>
          </div>
        </div>
        <div class="col-md-6">
          <span class="form-label d-block mb-2 pc-required">Taxi Driver</span>
          <div class="d-flex gap-2">
            <input type="radio" class="btn-check" id="paTaxiYes" name="taxi_driver" value="yes" autocomplete="off" required <?= $old['taxi_driver'] === 'yes' ? 'checked' : '' ?>>
            <label class="btn btn-outline-primary rounded-pill fw-semibold px-4" for="paTaxiYes">Yes</label>
            <input type="radio" class="btn-check" id="paTaxiNo" name="taxi_driver" value="no" autocomplete="off" <?= $old['taxi_driver'] === 'no' ? 'checked' : '' ?>>
            <label class="btn btn-outline-primary rounded-pill fw-semibold px-4" for="paTaxiNo">No</label>
          </div>
        </div>

        <div class="col-md-4">
          <label class="form-label" for="paTitle">Title</label>
          <select class="form-select" id="paTitle" name="title">
            <option value="" <?= $old['title'] === '' ? 'selected' : '' ?>>- Select -</option>
            <?php foreach (['Mr', 'Mrs', 'Ms', 'Miss', 'Dr', 'Other'] as $titleOption): ?>
              <option value="<?= htmlspecialchars($titleOption) ?>" <?= $old['title'] === $titleOption ? 'selected' : '' ?>><?= htmlspecialchars($titleOption) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-4">
          <label class="form-label pc-required" for="paFirstName">First Name</label>
          <input type="text" class="form-control" id="paFirstName" name="first_name" placeholder="Enter your first name" value="<?= htmlspecialchars($old['first_name']) ?>" required>
        </div>
        <div class="col-md-4">
          <label class="form-label pc-required" for="paLastName">Last Name</label>
          <input type="text" class="form-control" id="paLastName" name="last_name" placeholder="Enter your last name" value="<?= htmlspecialchars($old['last_name']) ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label pc-required" for="paEmail">Email</label>
          <input type="email" class="form-control" id="paEmail" name="email" placeholder="Email address" value="<?= htmlspecialchars($old['email']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label pc-required" for="paDob">Date of Birth</label>
          <input type="date" class="form-control" id="paDob" name="dob" value="<?= htmlspecialchars($old['dob']) ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label pc-required" for="paNationality">Nationality</label>
          <select class="form-select" id="paNationality" name="nationality" required>
            <option value="" disabled <?= $old['nationality'] === '' ? 'selected' : '' ?>>Select country</option>
            <?php foreach ($countries as $country): ?>
              <option value="<?= htmlspecialchars($country) ?>" <?= $old['nationality'] === $country ? 'selected' : '' ?>><?= htmlspecialchars($country) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="col-md-6">
          <label class="form-label pc-required" for="paIban">IBAN</label>
          <input type="text" class="form-control text-uppercase" id="paIban" name="iban" placeholder="e.g. IE29AIBK93115212345678" value="<?= htmlspecialchars($old['iban']) ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label pc-required" for="paAccountName">Account Name</label>
          <input type="text" class="form-control" id="paAccountName" name="account_name" value="<?= htmlspecialchars($old['account_name']) ?>" required>
        </div>
        <div class="col-md-6">
          <label class="form-label pc-required" for="paBank">Bank</label>
          <input type="text" class="form-control" id="paBank" name="bank" value="<?= htmlspecialchars($old['bank']) ?>" required>
        </div>

        <div class="col-md-6">
          <label class="form-label pc-required" for="paBankStatement">Bank Statement</label>
          <input type="file" class="form-control" id="paBankStatement" name="bank_statement" accept=".jpg,.jpeg,.png,.webp,.pdf" required>
          <div class="form-text">JPG, PNG, WEBP or PDF, max 5MB.</div>
        </div>
        <div class="col-md-6">
          <span class="form-label d-block mb-2 pc-required">Is permanent address same as bank statement?</span>
          <div class="d-flex gap-2">
            <input type="radio" class="btn-check" id="paAddressYes" name="address_same_as_statement" value="yes" autocomplete="off" required <?= $old['address_same_as_statement'] === 'yes' ? 'checked' : '' ?>>
            <label class="btn btn-outline-primary rounded-pill fw-semibold px-4" for="paAddressYes">Yes</label>
            <input type="radio" class="btn-check" id="paAddressNo" name="address_same_as_statement" value="no" autocomplete="off" <?= $old['address_same_as_statement'] === 'no' ? 'checked' : '' ?>>
            <label class="btn btn-outline-primary rounded-pill fw-semibold px-4" for="paAddressNo">No</label>
          </div>
        </div>

        <div class="col-12">
          <label class="form-label pc-required" for="paDeviceType">Device Type</label>
          <select class="form-select" id="paDeviceType" name="device_type" required>
            <option value="" disabled <?= $old['device_type'] === '' ? 'selected' : '' ?>>- Select -</option>
            <?php foreach (['PAX A50', 'PAX A920', 'EPOS'] as $device): ?>
              <option value="<?= htmlspecialchars($device) ?>" <?= $old['device_type'] === $device ? 'selected' : '' ?>><?= htmlspecialchars($device) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="col-12 pt-2">
          <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
            <span>Submit Form</span>
            <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
          </button>
        </div>

        <?php if ($formStatus === 'success'): ?>
          <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your application has been sent. Our team will be in touch shortly.</div></div>
        <?php elseif ($formStatus === 'error'): ?>
          <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</section>
