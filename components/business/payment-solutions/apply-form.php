<?php
$old ??= [
  'beneficial_owner' => 'yes',
  'taxi_driver' => 'yes',
  'title' => '',
  'first_name' => '',
  'last_name' => '',
  'email' => '',
  'dob' => '',
  'nationality' => '',
  'iban' => '',
  'account_name' => '',
  'bank' => '',
  'address_same_as_statement' => 'yes',
  'device_type' => '',
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

// Canonical PowerCabs form field recipe, matched from book-ride-online.php
// (which itself matches the enhanced Ride Type / Date custom-select /
// custom-datetime triggers pixel for pixel) -- reused here so every form on
// the site looks and behaves the same.
$inputClass = $pcInput;
$labelClass = $pcLabel;

/** Yes/No toggle: two pill buttons driven by real radio inputs, so the pair
 * is mutually exclusive natively and stays keyboard/AT accessible with no JS.
 *
 * Each input+label pair MUST be wrapped in its own element. Tailwind compiles
 * `peer-checked:x` to `.peer:checked ~ .peer-checked\:x`, and `~` matches ANY
 * later sibling -- so with all four elements flat in one row, checking "Yes"
 * highlighted the "No" label too, because that label is also a following
 * sibling of the Yes input. The wrapper stops `~` reaching across pairs.
 */
function pc_yes_no_toggle(string $name, string $idPrefix, string $current, bool $required = true): void
{
  foreach (['yes' => 'Yes', 'no' => 'No'] as $value => $label) {
    $id = $idPrefix . ucfirst($value);
    $checked = $current === $value;
    ?>
    <span class="tw-relative tw-inline-flex">
      <input type="radio" class="tw-peer tw-sr-only" id="<?= $id ?>" name="<?= $name ?>" value="<?= $value ?>"
        autocomplete="off" <?= $required && $value === 'yes' ? 'required' : '' ?> <?= $checked ? 'checked' : '' ?>>
      <label for="<?= $id ?>" class="tw-inline-flex tw-min-w-[4.5rem] tw-cursor-pointer tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-[#dee2e6] tw-bg-white tw-px-5 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink/70 tw-transition-colors tw-duration-200 hover:tw-border-ink/25 hover:tw-text-ink peer-checked:tw-border-powerlight peer-checked:tw-bg-powerlight peer-checked:tw-text-white peer-focus-visible:tw-ring-2 peer-focus-visible:tw-ring-powerlight/40"><?= $label ?></label>
    </span>
    <?php
  }
}
?>
<section class="tw-scroll-mt-24 tw-relative tw-overflow-hidden <?= $pcSection ?>" id="payment-apply-form">
  <!-- Decorative background blobs, purely visual -->
  <span class="tw-pointer-events-none tw-absolute tw-right-[-9rem] tw-top-16 tw-z-0 tw-h-72 tw-w-72 tw-rounded-full tw-bg-[radial-gradient(circle,rgba(251,157,69,0.3),transparent_70%)] tw-blur-[55px]" aria-hidden="true"></span>
  <span class="tw-pointer-events-none tw-absolute tw-bottom-20 tw-left-[-9rem] tw-z-0 tw-h-80 tw-w-80 tw-rounded-full tw-bg-[radial-gradient(circle,rgba(68,91,138,0.32),transparent_70%)] tw-blur-[55px]" aria-hidden="true"></span>
  <span class="tw-pointer-events-none tw-absolute tw-right-[-6rem] tw-top-[55%] tw-z-0 tw-h-64 tw-w-64 tw-rounded-full tw-bg-[radial-gradient(circle,rgba(232,89,12,0.16),transparent_70%)] tw-blur-[55px]" aria-hidden="true"></span>

  <div class="tw-relative <?= $pcContainerNarrow ?>">
    <div class="tw-mb-10 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Apply Now</p>
      <h2 class="tw-mb-2 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Apply for Your Card Terminal</h2>
      <p class="tw-mb-0 tw-text-ink/60">Submit your details and our team will get back to you shortly.</p>
    </div>

    <div class="tw-rounded-[2rem] tw-bg-white tw-p-4 tw-shadow-[0_24px_48px_rgba(28,20,16,0.14)] sm:tw-p-6 md:tw-p-8">
      <form method="post" action="#payment-apply-form" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2" enctype="multipart/form-data">
        <div>
          <span class="pc-required tw-mb-2 tw-block tw-text-sm tw-font-medium tw-text-ink">Beneficial Owner</span>
          <div class="tw-flex tw-gap-2">
            <?php pc_yes_no_toggle('beneficial_owner', 'paBeneficial', $old['beneficial_owner']); ?>
          </div>
        </div>
        <div>
          <span class="pc-required tw-mb-2 tw-block tw-text-sm tw-font-medium tw-text-ink">Taxi Driver</span>
          <div class="tw-flex tw-gap-2">
            <?php pc_yes_no_toggle('taxi_driver', 'paTaxi', $old['taxi_driver']); ?>
          </div>
        </div>

        <div class="md:tw-col-span-2 md:tw-grid md:tw-grid-cols-3 md:tw-gap-4">
          <div>
            <!-- pc-custom-select-enhance stays as a bare functional hook --
                 custom-select.js progressively enhances any <select>
                 carrying this class, styling what it builds with Tailwind
                 utilities that reproduce $inputClass below exactly. -->
            <label class="<?= $labelClass ?>" for="paTitle">Title</label>
            <select class="<?= $inputClass ?> pc-custom-select-enhance" id="paTitle" name="title">
              <option value="" <?= $old['title'] === '' ? 'selected' : '' ?>>- Select -</option>
              <?php foreach (['Mr', 'Mrs', 'Ms', 'Miss', 'Dr', 'Other'] as $titleOption): ?>
                <option value="<?= htmlspecialchars($titleOption) ?>" <?= $old['title'] === $titleOption ? 'selected' : '' ?>><?= htmlspecialchars($titleOption) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="tw-mt-4 md:tw-mt-0">
            <label class="pc-required <?= $labelClass ?>" for="paFirstName">First Name</label>
            <input type="text" class="<?= $inputClass ?>" id="paFirstName" name="first_name" placeholder="Enter your first name" value="<?= htmlspecialchars($old['first_name']) ?>" required>
          </div>
          <div class="tw-mt-4 md:tw-mt-0">
            <label class="pc-required <?= $labelClass ?>" for="paLastName">Last Name</label>
            <input type="text" class="<?= $inputClass ?>" id="paLastName" name="last_name" placeholder="Enter your last name" value="<?= htmlspecialchars($old['last_name']) ?>" required>
          </div>
        </div>

        <div>
          <label class="pc-required <?= $labelClass ?>" for="paEmail">Email</label>
          <input type="email" class="<?= $inputClass ?>" id="paEmail" name="email" placeholder="Email address" value="<?= htmlspecialchars($old['email']) ?>" required>
        </div>
        <div>
          <!-- pc-custom-datetime-enhance: same story as pc-custom-select-enhance above, driven by custom-datetime.js. -->
          <label class="pc-required <?= $labelClass ?>" for="paDob">Date of Birth</label>
          <input type="date" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="paDob" name="dob" value="<?= htmlspecialchars($old['dob']) ?>" max="<?= date('Y-m-d') ?>" data-dt-quick-year="1" required>
        </div>

        <div>
          <label class="pc-required <?= $labelClass ?>" for="paNationality">Nationality</label>
          <select class="<?= $inputClass ?> pc-custom-select-enhance" id="paNationality" name="nationality" required>
            <option value="" disabled <?= $old['nationality'] === '' ? 'selected' : '' ?>>Select country</option>
            <?php foreach ($countries as $country): ?>
              <option value="<?= htmlspecialchars($country) ?>" <?= $old['nationality'] === $country ? 'selected' : '' ?>><?= htmlspecialchars($country) ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div>
          <label class="pc-required <?= $labelClass ?>" for="paIban">IBAN</label>
          <input type="text" class="<?= $inputClass ?> tw-uppercase" id="paIban" name="iban" placeholder="e.g. IE29AIBK93115212345678" value="<?= htmlspecialchars($old['iban']) ?>" required>
        </div>

        <div>
          <label class="pc-required <?= $labelClass ?>" for="paAccountName">Account Name</label>
          <input type="text" class="<?= $inputClass ?>" id="paAccountName" name="account_name" value="<?= htmlspecialchars($old['account_name']) ?>" required>
        </div>
        <div>
          <label class="pc-required <?= $labelClass ?>" for="paBank">Bank</label>
          <input type="text" class="<?= $inputClass ?>" id="paBank" name="bank" value="<?= htmlspecialchars($old['bank']) ?>" required>
        </div>

        <div>
          <label class="pc-required <?= $labelClass ?>" for="paBankStatement">Bank Statement</label>
          <input type="file" class="<?= $inputClass ?> tw-py-[0.3rem] file:tw-mr-3 file:tw-rounded-full file:tw-border-0 file:tw-bg-ink file:tw-px-3 file:tw-py-1.5 file:tw-text-sm file:tw-font-semibold file:tw-text-white" id="paBankStatement" name="bank_statement" accept=".jpg,.jpeg,.png,.webp,.pdf" required>
          <div class="tw-mt-1.5 tw-text-sm tw-text-ink/50">JPG, PNG, WEBP or PDF, max 5MB.</div>
        </div>
        <div>
          <span class="pc-required tw-mb-2 tw-block tw-text-sm tw-font-medium tw-text-ink">Is permanent address same as bank statement?</span>
          <div class="tw-flex tw-gap-2">
            <?php pc_yes_no_toggle('address_same_as_statement', 'paAddress', $old['address_same_as_statement']); ?>
          </div>
        </div>

        <div class="md:tw-col-span-2">
          <label class="pc-required <?= $labelClass ?>" for="paDeviceType">Device Type</label>
          <select class="<?= $inputClass ?> pc-custom-select-enhance" id="paDeviceType" name="device_type" required>
            <option value="" disabled <?= $old['device_type'] === '' ? 'selected' : '' ?>>- Select -</option>
            <?php foreach (['PAX A50', 'PAX A920', 'EPOS'] as $device): ?>
              <option value="<?= htmlspecialchars($device) ?>" <?= $old['device_type'] === $device ? 'selected' : '' ?>><?= htmlspecialchars($device) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="md:tw-col-span-2 tw-pt-2">
          <!-- tw-appearance-none tw-border-0 strip the native <button> chrome -- see book-ride-online.php. -->
          <button type="submit" class="tw-inline-flex tw-appearance-none tw-items-center tw-gap-2 tw-rounded-full tw-border-0 tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]">
            <span>Submit Form</span>
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12L3.269 3.126A59.77 59.77 0 0121.485 12 59.77 59.77 0 013.27 20.876L6 12zm0 0h7.5"/></svg>
          </button>
        </div>

        <!-- .alert-success / .alert-danger stay as bare classnames -- the
             contract ajax-forms.js parses out of the returned HTML. -->
        <?php if ($formStatus === 'success'): ?>
          <div class="md:tw-col-span-2">
            <div class="alert-success tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your application has been sent. Our team will be in touch shortly.</div>
          </div>
        <?php elseif ($formStatus === 'error'): ?>
          <div class="md:tw-col-span-2">
            <div class="alert-danger tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars($formError) ?></div>
          </div>
        <?php endif; ?>
      </form>
    </div>
  </div>
</section>
