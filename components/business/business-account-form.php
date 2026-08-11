<?php
$old ??= ['contact_name' => '', 'business_name' => '', 'business_email' => '', 'phone' => '', 'vat_number' => '', 'employee_count' => '', 'message' => ''];
$formStatus ??= null;
$formError ??= '';
?>
<div class="bg-white rounded-5 p-4 p-md-5 h-100" style="box-shadow: var(--pc-shadow-md);">
  <h3 class="mb-2" style="font-size: 1.4rem;">Request a Business Account</h3>
  <p class="text-muted-pc mb-4">Tell us a little about your business and our team will be in touch.</p>

  <form method="post" action="" class="row g-3">
    <div class="col-md-6">
      <label class="form-label pc-required" for="baContactName">Contact Name</label>
      <input type="text" class="form-control" id="baContactName" name="contact_name" value="<?= htmlspecialchars($old['contact_name']) ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label pc-required" for="baBusinessName">Business Name</label>
      <input type="text" class="form-control" id="baBusinessName" name="business_name" value="<?= htmlspecialchars($old['business_name']) ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label pc-required" for="baBusinessEmail">Business Email</label>
      <input type="email" class="form-control" id="baBusinessEmail" name="business_email" value="<?= htmlspecialchars($old['business_email']) ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label pc-required" for="baPhone">Phone Number</label>
      <input type="tel" class="form-control" id="baPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
    </div>
    <div class="col-md-6">
      <label class="form-label" for="baVatNumber">VAT / Tax Number</label>
      <input type="text" class="form-control" id="baVatNumber" name="vat_number" value="<?= htmlspecialchars($old['vat_number']) ?>">
    </div>
    <div class="col-md-6">
      <label class="form-label" for="baEmployeeCount">Number of Employees</label>
      <input type="number" min="1" class="form-control" id="baEmployeeCount" name="employee_count" value="<?= htmlspecialchars($old['employee_count']) ?>">
    </div>
    <div class="col-12">
      <label class="form-label" for="baMessage">Additional Details <span class="text-muted-pc fw-normal">(optional)</span></label>
      <textarea class="form-control" id="baMessage" name="message" rows="3"><?= htmlspecialchars($old['message']) ?></textarea>
    </div>

    <div class="col-12 pt-2">
      <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
        <span>Submit Request</span>
        <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
      </button>
    </div>

    <?php if ($formStatus === 'success'): ?>
      <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your request has been sent. Our Business Team will be in touch shortly.</div></div>
    <?php elseif ($formStatus === 'error'): ?>
      <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
    <?php endif; ?>
  </form>
</div>
