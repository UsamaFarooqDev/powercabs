<?php
$old ??= ['contact_name' => '', 'business_name' => '', 'business_email' => '', 'phone' => '', 'vat_number' => '', 'employee_count' => '', 'message' => ''];
$formStatus ??= null;
$formError ??= '';

// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = $pcLabel;
$submitClass = $pcBtnPrimary;
?>
<div class="tw-h-full tw-rounded-[2rem] tw-bg-white tw-p-6 tw-shadow-[0_10px_30px_rgba(28,20,16,0.1)] md:tw-p-11">
  <h3 class="tw-mb-2 tw-text-xl tw-font-bold tw-text-ink">Request a Business Account</h3>
  <p class="tw-mb-6 tw-text-ink/60">Tell us a little about your business and our team will be in touch.</p>

  <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
    <div>
      <label class="<?= $labelClass ?> pc-required" for="baContactName">Contact Name</label>
      <input type="text" class="<?= $inputClass ?>" id="baContactName" name="contact_name" value="<?= htmlspecialchars($old['contact_name']) ?>" required>
    </div>
    <div>
      <label class="<?= $labelClass ?> pc-required" for="baBusinessName">Business Name</label>
      <input type="text" class="<?= $inputClass ?>" id="baBusinessName" name="business_name" value="<?= htmlspecialchars($old['business_name']) ?>" required>
    </div>
    <div>
      <label class="<?= $labelClass ?> pc-required" for="baBusinessEmail">Business Email</label>
      <input type="email" class="<?= $inputClass ?>" id="baBusinessEmail" name="business_email" value="<?= htmlspecialchars($old['business_email']) ?>" required>
    </div>
    <div>
      <label class="<?= $labelClass ?> pc-required" for="baPhone">Phone Number</label>
      <input type="tel" class="<?= $inputClass ?>" id="baPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>" required>
    </div>
    <div>
      <label class="<?= $labelClass ?>" for="baVatNumber">VAT / Tax Number</label>
      <input type="text" class="<?= $inputClass ?>" id="baVatNumber" name="vat_number" value="<?= htmlspecialchars($old['vat_number']) ?>">
    </div>
    <div>
      <label class="<?= $labelClass ?>" for="baEmployeeCount">Number of Employees</label>
      <input type="number" min="1" class="<?= $inputClass ?>" id="baEmployeeCount" name="employee_count" value="<?= htmlspecialchars($old['employee_count']) ?>">
    </div>
    <div class="md:tw-col-span-2">
      <label class="<?= $labelClass ?>" for="baMessage">Additional Details <span class="tw-font-normal tw-text-ink/50">(optional)</span></label>
      <textarea class="<?= $inputClass ?> tw-resize-y" id="baMessage" name="message" rows="3"><?= htmlspecialchars($old['message']) ?></textarea>
    </div>

    <div class="tw-pt-2 md:tw-col-span-2">
      <button type="submit" class="<?= $submitClass ?>">
        <span>Submit Request</span>
        <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
      </button>
    </div>

    <?php if ($formStatus === 'success'): ?>
      <div class="md:tw-col-span-2"><div class="alert-success tw-mt-1 tw-rounded-md tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your request has been sent. Our Business Team will be in touch shortly.</div></div>
    <?php elseif ($formStatus === 'error'): ?>
      <div class="md:tw-col-span-2"><div class="alert-danger tw-mt-1 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars($formError) ?></div></div>
    <?php endif; ?>
  </form>
</div>
