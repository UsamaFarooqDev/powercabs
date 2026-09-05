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

// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly
// so every form on the site shares one input/label/button language.
$inputClass = $pcInput;
$labelClass = $pcLabel;
$submitClass = $pcBtnPrimary;
?>
<section class="tw-relative tw-overflow-hidden tw-bg-[linear-gradient(180deg,#f9f4ed_0%,#f4efe8_100%)] <?= $pcSection ?> tw-pb-[clamp(5rem,9vw,7rem)]" id="pcAmbRegister">
  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ Join the Programme</p>
        <h2 class="tw-mb-3 tw-text-[clamp(1.9rem,3.4vw,2.5rem)] tw-font-bold tw-tracking-tight tw-text-ink">Ready to Represent PowerCabs?</h2>
        <p class="tw-mb-8 tw-max-w-[42ch] tw-text-[1.1rem] tw-text-ink/60">
          Registration takes a couple of minutes. Our Ambassador team reviews
          every application personally and will be in touch to confirm your spot.
        </p>

        <div class="tw-mb-10 tw-flex tw-flex-wrap tw-gap-2">
          <?php foreach ($ambRecap as $item): ?>
            <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink">
              <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
              <?= htmlspecialchars($item) ?>
            </span>
          <?php endforeach; ?>
        </div>

        <div class="tw-flex tw-flex-col tw-gap-4">
          <div class="tw-flex tw-gap-3">
            <span class="tw-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-power tw-text-sm tw-font-bold tw-text-power">01</span>
            <div>
              <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink">Your Details</h3>
              <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Name, email and phone number.</p>
            </div>
          </div>
          <div class="tw-flex tw-gap-3">
            <span class="tw-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-power tw-text-sm tw-font-bold tw-text-power">02</span>
            <div>
              <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink">Ride &amp; License Info</h3>
              <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Current affiliation, PowerCabs status and license number.</p>
            </div>
          </div>
          <div class="tw-flex tw-gap-3">
            <span class="tw-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-power tw-text-sm tw-font-bold tw-text-power">03</span>
            <div>
              <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink">Submit Application</h3>
              <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Our team reviews and follows up directly.</p>
            </div>
          </div>
        </div>
      </div>

      <div>
        <div class="tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-7 tw-shadow-[0_24px_60px_rgba(28,20,16,0.1)] md:tw-p-11">
          <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
            <div>
              <label class="<?= $labelClass ?> pc-required" for="apName">Name</label>
              <input type="text" class="<?= $inputClass ?>" id="apName" name="name" value="<?= htmlspecialchars(
                $old['name'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="apEmail">Email</label>
              <input type="email" class="<?= $inputClass ?>" id="apEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="apPhone">Phone</label>
              <input type="tel" class="<?= $inputClass ?>" id="apPhone" name="phone" value="<?= htmlspecialchars(
                $old['phone'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="apAffiliated">Currently Affiliated With <span class="tw-font-normal tw-text-ink/50">(optional)</span></label>
              <input type="text" class="<?= $inputClass ?>" id="apAffiliated" name="affiliated_with" value="<?= htmlspecialchars(
                $old['affiliated_with'],
              ) ?>" placeholder="e.g. independent, another fleet">
            </div>

            <div>
              <label class="<?= $labelClass ?> pc-required" for="apLicense">License Number</label>
              <input type="text" class="<?= $inputClass ?>" id="apLicense" name="license_number" value="<?= htmlspecialchars(
                $old['license_number'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="apRegistered">Registered with PowerCabs?</label>
              <select class="<?= $inputClass ?> pc-custom-select-enhance" id="apRegistered" name="registered_with_powercabs" required>
                <option value="" disabled <?= $old['registered_with_powercabs'] === ''
                  ? 'selected'
                  : '' ?>>Select an option</option>
                <option value="Yes" <?= $old['registered_with_powercabs'] === 'Yes' ? 'selected' : '' ?>>Yes</option>
                <option value="No" <?= $old['registered_with_powercabs'] === 'No' ? 'selected' : '' ?>>No</option>
              </select>
            </div>

            <div class="tw-pt-2 md:tw-col-span-2">
              <button type="submit" class="<?= $submitClass ?>">
                <span>Submit Application</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="md:tw-col-span-2"><div class="alert-success tw-mb-0 tw-mt-1 tw-rounded-md tw-border tw-border-solid tw-border-green-200 tw-bg-green-50 tw-px-4 tw-py-3 tw-text-sm tw-text-green-800" role="alert">Thanks -- your registration has been sent. Our team will be in touch shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="md:tw-col-span-2"><div class="alert-danger tw-mb-0 tw-mt-1 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-text-red-800" role="alert"><?= htmlspecialchars(
                $formError,
              ) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
