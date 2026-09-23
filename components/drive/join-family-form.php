<?php
/**
 * "Start Your Application" -- the driver sign-up, in eight steps.
 *
 * The real onboarding runs to fourteen steps; this groups them into eight so
 * the web form asks for exactly the same information without reading like a
 * form. Nothing here posts to this page: every step talks to /driver-apply,
 * which is where the Supabase writes and the verification email live.
 *
 * Progressive enhancement is deliberate. All eight panels are in the markup;
 * assets/js/components/driver-application.js adds `is-ready`, which is what
 * hides all but the current one. With JS off the applicant sees one long, valid
 * form and the "call us" number rather than a dead stack of buttons.
 */

$labelClass = 'tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink';
$labelReq = 'pc-required ' . $labelClass;

/* The six documents, in the order the licensing pack lists them. `slot` is the
   key /driver-apply maps to a bucket and a drivers column. */
$driverDocs = [
  ['slot' => 'license', 'label' => 'Driving licence'],
  ['slot' => 'nta_license', 'label' => 'NTA licence'],
  ['slot' => 'insurance', 'label' => 'Insurance certificate'],
  ['slot' => 'nct', 'label' => 'NCT certificate'],
  ['slot' => 'road_tax', 'label' => 'Road tax certificate'],
  ['slot' => 'suitability', 'label' => 'Suitability certificate'],
];

$driverPrefs = [
  ['name' => 'night_rides', 'label' => 'Available for night rides'],
  ['name' => 'pets_allowed', 'label' => 'Pets allowed'],
  ['name' => 'wheelchair', 'label' => 'Wheelchair / disability friendly'],
];
?>
<section class="tw-relative tw-overflow-hidden tw-bg-ink tw-py-16 md:tw-py-24">
  <img src="https://images.pexels.com/photos/31335088/pexels-photo-31335088.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1600"
    alt="" aria-hidden="true"
    class="tw-absolute tw-inset-0 tw-z-0 tw-h-full tw-w-full tw-object-cover tw-object-center" loading="lazy">
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-bg-[linear-gradient(155deg,rgba(28,20,16,0.93)_0%,rgba(42,26,16,0.86)_55%,rgba(22,15,10,0.94)_100%)]" aria-hidden="true"></span>

  <div class="tw-relative tw-z-[1] <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">

      <div>
        <span class="tw-mb-4 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-px-3.5 tw-py-1.5 tw-text-xs tw-font-semibold tw-text-white">
          <span class="tw-font-bold">IE</span>
          Irish Taxi Platform &bull; Driver First
        </span>

        <h2 class="<?= $pcH2Display ?> tw-text-white">
          You're not just a driver,<br>
          <span class="tw-text-powerlight">You're family.</span>
        </h2>
        <p class="tw-mb-0 tw-max-w-[46ch] tw-text-[1.08rem] tw-leading-[1.7] tw-text-white/75">
          Your taxi. Your meter. Your choice. Earn properly, avoid platform-created
          Saver pricing, save on the costs of driving and get real local support.
        </p>
      </div>

      <div>
        <div class="tw-mx-auto tw-w-full tw-max-w-[520px] tw-rounded-2xl tw-bg-white tw-p-6 tw-shadow-[0_24px_60px_rgba(0,0,0,0.35)] md:tw-p-9" id="driveJoinForm">
          <form novalidate data-driver-app class="tw-m-0" action="<?= $assetPath ?>/driver-apply" method="post">
            <div class="tw-mb-5">
              <div class="tw-mb-2 tw-flex tw-items-baseline tw-justify-between tw-gap-3">
                <h3 class="tw-mb-0 tw-text-lg tw-font-bold tw-text-ink">Start Your Application</h3>
                <span class="tw-text-xs tw-font-semibold tw-text-ink/50" data-app-count>Step 1 of 8</span>
              </div>
              <?php /* A real progress element would announce a percentage on
                       every keystroke; this is decorative and the step count
                       beside it is what carries the information. */ ?>
              <div class="tw-h-1 tw-w-full tw-overflow-hidden tw-rounded-full tw-bg-ink/10" aria-hidden="true">
                <span class="tw-block tw-h-full tw-w-0 tw-rounded-full tw-bg-powerlight tw-transition-[width] tw-duration-300" data-app-bar></span>
              </div>
              <p class="tw-mb-0 tw-mt-2 tw-text-[0.95rem] tw-leading-snug tw-text-ink/60" data-app-hint>
                Add PowerCabs to your driving &mdash; you don't necessarily have to leave other platforms.
              </p>
            </div>

            <!-- 1. Details ------------------------------------------------ -->
            <fieldset class="tw-m-0 tw-min-w-0 tw-border-0 tw-p-0" data-app-step="1">
              <legend class="tw-sr-only">Your details</legend>
              <div class="tw-grid tw-grid-cols-1 tw-gap-4">
                <div>
                  <label class="<?= $labelReq ?>" for="daName">Full Name</label>
                  <input class="<?= $pcInput ?>" id="daName" name="full_name" type="text" autocomplete="name" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daEmail">Email Address</label>
                  <input class="<?= $pcInput ?>" id="daEmail" name="email" type="email" autocomplete="email" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daPhone">Phone Number</label>
                  <input class="<?= $pcInput ?>" id="daPhone" name="phone" type="tel" autocomplete="tel" required>
                </div>
                <div>
                  <label class="<?= $labelClass ?>" for="daReferral">Referral Code <span class="tw-font-normal tw-text-ink/45">(optional)</span></label>
                  <input class="<?= $pcInput ?>" id="daReferral" name="referral" type="text">
                </div>
              </div>
            </fieldset>

            <?php /* Order matters here and is not arbitrary: the code goes out
                     at the end of step 1, so it is already in the inbox by the
                     time this panel appears. Verifying before the password and
                     the photo also means an abandoned application never gets
                     as far as creating anything. */ ?>
            <!-- 2. Verify email ------------------------------------------- -->
            <fieldset class="tw-m-0 tw-min-w-0 tw-border-0 tw-p-0" data-app-step="2" hidden>
              <legend class="tw-sr-only">Verify your email</legend>
              <p class="tw-mb-4 tw-text-[0.95rem] tw-leading-relaxed tw-text-ink/65">
                We've emailed a 6-digit code to <strong class="tw-text-ink" data-app-email>your address</strong>.
                Enter it below to confirm it's yours.
              </p>
              <label class="<?= $labelReq ?>" for="daCode">Verification code</label>
              <input class="<?= $pcInput ?> tw-text-center tw-text-2xl tw-font-bold tw-tracking-[0.5em]"
                id="daCode" name="code" type="text" inputmode="numeric" autocomplete="one-time-code"
                maxlength="6" pattern="[0-9]{6}" required>
              <?php /* A plain underlined link, not a button: preflight is off,
                       so appearance-none + border-0 is what sheds the native
                       button chrome. */ ?>
              <button class="tw-mt-3 tw-inline-block tw-cursor-pointer tw-appearance-none tw-border-0 tw-bg-transparent tw-p-0 tw-text-sm tw-font-semibold tw-text-power tw-underline tw-transition-colors tw-duration-200 hover:tw-text-powerdark"
                type="button" data-app-resend>Resend OTP</button>
            </fieldset>

            <!-- 3. Password ----------------------------------------------- -->
            <fieldset class="tw-m-0 tw-min-w-0 tw-border-0 tw-p-0" data-app-step="3" hidden>
              <legend class="tw-sr-only">Choose a password</legend>
              <p class="tw-mb-4 tw-text-[0.95rem] tw-leading-relaxed tw-text-ink/65">
                This is what you'll use to sign into the PowerCabs Driver app.
              </p>
              <?php
              /* The reveal toggle sits INSIDE the field, so the input carries
                 extra right padding to keep a long password from running under
                 it. $pcInput is the shared recipe and stays untouched -- the
                 padding is appended here rather than changed there, because
                 custom-select.js and custom-datetime.js reproduce $pcInput
                 verbatim and would have to change with it.

                 Both icons are in the markup and one is hidden, rather than
                 swapping innerHTML on click: no re-parse, and the button keeps
                 its focus ring while you toggle it. */
              $pwWrap = 'tw-relative';
              $pwInput = $pcInput . ' tw-pr-11';
              $pwToggle =
                'tw-absolute tw-right-1 tw-top-1/2 -tw-translate-y-1/2 tw-flex tw-h-8 tw-w-9 tw-cursor-pointer ' .
                'tw-appearance-none tw-items-center tw-justify-center tw-rounded tw-border-0 tw-bg-transparent ' .
                'tw-p-0 tw-text-ink/45 tw-transition-colors tw-duration-200 hover:tw-text-ink/70 ' .
                'focus-visible:tw-text-power focus-visible:tw-outline-none';
              $pwFields = [
                ['id' => 'daPassword', 'name' => 'password', 'label' => 'Password'],
                ['id' => 'daPassword2', 'name' => 'password_confirm', 'label' => 'Confirm Password'],
              ];
              ?>
              <div class="tw-grid tw-grid-cols-1 tw-gap-4">
                <?php foreach ($pwFields as $field): ?>
                  <div>
                    <label class="<?= $labelReq ?>" for="<?= $field['id'] ?>"><?= $field['label'] ?></label>
                    <div class="<?= $pwWrap ?>">
                      <input class="<?= $pwInput ?>" id="<?= $field['id'] ?>" name="<?= $field['name'] ?>"
                        type="password" autocomplete="new-password" minlength="8" required>
                      <button class="<?= $pwToggle ?>" type="button" data-app-reveal="<?= $field['id'] ?>"
                        aria-controls="<?= $field['id'] ?>" aria-pressed="false" aria-label="Show password">
                        <svg class="tw-h-[1.15rem] tw-w-[1.15rem]" data-reveal-show viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.4 12S6 5.5 12 5.5 21.6 12 21.6 12 18 18.5 12 18.5 2.4 12 2.4 12z"/><circle cx="12" cy="12" r="3"/></svg>
                        <svg class="tw-hidden tw-h-[1.15rem] tw-w-[1.15rem]" data-reveal-hide viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9.9 5.7A9.5 9.5 0 0112 5.5c6 0 9.6 6.5 9.6 6.5a17 17 0 01-3.2 3.9M6.5 7.9A17 17 0 002.4 12S6 18.5 12 18.5c1 0 1.9-.2 2.7-.5M3 3l18 18M10.6 10.6a2 2 0 002.8 2.8"/></svg>
                      </button>
                    </div>
                    <?php if ($field['id'] === 'daPassword'): ?>
                      <p class="tw-mb-0 tw-mt-1.5 tw-text-[0.8rem] tw-text-ink/50">At least 8 characters.</p>
                    <?php endif; ?>
                  </div>
                <?php endforeach; ?>
              </div>
            </fieldset>

            <!-- 4. Profile photo ------------------------------------------ -->
            <fieldset class="tw-m-0 tw-min-w-0 tw-border-0 tw-p-0" data-app-step="4" hidden>
              <legend class="tw-sr-only">Profile photo</legend>
              <div class="tw-flex tw-flex-col tw-items-center tw-gap-4 tw-rounded-xl tw-border tw-border-dashed tw-border-ink/15 tw-bg-paper-soft tw-px-5 tw-py-7 tw-text-center">
                <span class="tw-flex tw-h-24 tw-w-24 tw-items-center tw-justify-center tw-overflow-hidden tw-rounded-full tw-bg-ink/[0.06] tw-text-ink/30" data-app-avatar>
                  <svg class="tw-h-10 tw-w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.1a7.5 7.5 0 0115 0"/></svg>
                </span>
                <div>
                  <label class="<?= $pcBtnDark ?> tw-cursor-pointer" for="daProfile">Choose photo</label>
                  <input class="tw-sr-only" id="daProfile" type="file" accept="image/*" data-app-upload="profile">
                  <p class="tw-mb-0 tw-mt-2.5 tw-text-[0.85rem] tw-text-ink/55">A clear head-and-shoulders photo. JPG, PNG or WEBP, up to 5MB.</p>
                </div>
              </div>
            </fieldset>

            <!-- 5. Vehicle ------------------------------------------------ -->
            <fieldset class="tw-m-0 tw-min-w-0 tw-border-0 tw-p-0" data-app-step="5" hidden>
              <legend class="tw-sr-only">Vehicle information</legend>
              <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2">
                <div>
                  <label class="<?= $labelReq ?>" for="daPlate">Roof Plate No.</label>
                  <input class="<?= $pcInput ?>" id="daPlate" name="plate_no" type="text" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daVehNo">Vehicle Number</label>
                  <input class="<?= $pcInput ?>" id="daVehNo" name="vehicle_number" type="text" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daMake">Vehicle Make</label>
                  <input class="<?= $pcInput ?>" id="daMake" name="vehicle_make" type="text" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daModel">Vehicle Model</label>
                  <input class="<?= $pcInput ?>" id="daModel" name="vehicle_model" type="text" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daSeats">Number of Seats</label>
                  <input class="<?= $pcInput ?>" id="daSeats" name="no_seats" type="number" min="1" max="16" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daIban">IBAN</label>
                  <input class="<?= $pcInput ?>" id="daIban" name="iban" type="text" autocomplete="off" required>
                </div>
              </div>
            </fieldset>

            <!-- 6. Licence ------------------------------------------------ -->
            <fieldset class="tw-m-0 tw-min-w-0 tw-border-0 tw-p-0" data-app-step="6" hidden>
              <legend class="tw-sr-only">Licence details</legend>
              <div class="tw-grid tw-grid-cols-1 tw-gap-4">
                <div>
                  <label class="<?= $labelReq ?>" for="daLicNo">Driving Licence Number</label>
                  <input class="<?= $pcInput ?>" id="daLicNo" name="license_number" type="text" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daNta">NTA Licence Number</label>
                  <input class="<?= $pcInput ?>" id="daNta" name="nta_license_number" type="text" required>
                </div>
                <div>
                  <label class="<?= $labelReq ?>" for="daExpiry">Expiry Date</label>
                  <input class="<?= $pcInput ?>" id="daExpiry" name="license_expiry" type="date" required>
                </div>
              </div>
            </fieldset>

            <!-- 7. Documents ---------------------------------------------- -->
            <fieldset class="tw-m-0 tw-min-w-0 tw-border-0 tw-p-0" data-app-step="7" hidden>
              <legend class="tw-sr-only">Upload your licences and certificates</legend>
              <p class="tw-mb-4 tw-text-[0.95rem] tw-leading-relaxed tw-text-ink/65">
                Each one uploads on its own as you choose it. JPG, PNG, WEBP or PDF, up to 5MB each.
              </p>
              <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
                <?php foreach ($driverDocs as $doc): ?>
                  <li class="tw-flex tw-items-center tw-justify-between tw-gap-3 tw-rounded-xl tw-border tw-border-solid tw-border-ink/[0.12] tw-bg-paper-soft tw-px-4 tw-py-3"
                    data-app-doc="<?= htmlspecialchars($doc['slot']) ?>">
                    <span class="tw-flex tw-min-w-0 tw-flex-col">
                      <span class="tw-text-[0.9rem] tw-font-semibold tw-text-ink"><?= htmlspecialchars($doc['label']) ?></span>
                      <span class="tw-truncate tw-text-[0.8rem] tw-text-ink/50" data-app-doc-state>Not uploaded</span>
                    </span>
                    <label class="<?= $pcBtnSm ?> tw-shrink-0 tw-cursor-pointer tw-border tw-border-solid tw-border-ink/15 tw-bg-white tw-text-ink hover:tw-bg-paper"
                      for="daDoc-<?= htmlspecialchars($doc['slot']) ?>">Upload</label>
                    <input class="tw-sr-only" id="daDoc-<?= htmlspecialchars($doc['slot']) ?>" type="file"
                      accept="image/*,application/pdf" data-app-upload="<?= htmlspecialchars($doc['slot']) ?>">
                  </li>
                <?php endforeach; ?>
              </ul>
            </fieldset>

            <!-- 8. Preferences -------------------------------------------- -->
            <fieldset class="tw-m-0 tw-min-w-0 tw-border-0 tw-p-0" data-app-step="8" hidden>
              <legend class="tw-sr-only">Preferences</legend>
              <div class="tw-flex tw-flex-col tw-gap-3">
                <?php foreach ($driverPrefs as $pref): ?>
                  <label class="tw-flex tw-cursor-pointer tw-items-center tw-gap-3 tw-rounded-xl tw-border tw-border-solid tw-border-ink/[0.12] tw-bg-paper-soft tw-px-4 tw-py-3 tw-text-[0.95rem] tw-font-medium tw-text-ink">
                    <input class="tw-h-4 tw-w-4 tw-shrink-0 tw-accent-powerlight" type="checkbox"
                      name="<?= htmlspecialchars($pref['name']) ?>" value="yes">
                    <?= htmlspecialchars($pref['label']) ?>
                  </label>
                <?php endforeach; ?>
                <label class="tw-mt-1 tw-flex tw-cursor-pointer tw-items-start tw-gap-3 tw-text-[0.9rem] tw-leading-snug tw-text-ink/70">
                  <input class="tw-mt-0.5 tw-h-4 tw-w-4 tw-shrink-0 tw-accent-powerlight" type="checkbox"
                    name="terms" value="yes" id="daTerms" required>
                  <span>I agree to the PowerCabs
                    <a class="tw-font-semibold tw-text-power tw-underline" href="<?= $assetPath ?>/terms-and-conditions" target="_blank" rel="noopener">terms and conditions</a>.</span>
                </label>
              </div>
            </fieldset>

            <?php /* One live region for the whole form. Errors from
                     /driver-apply are written here rather than beside a field,
                     because most of them are about the step as a whole. The
                     .alert-danger / .alert-success classnames are the contract
                     ajax-forms.js reads -- kept so the toast still fires. */ ?>
            <?php /* Red by default; `.is-ok` recolours it for confirmations
                     such as "a new code is on its way". Doing that with
                     variants rather than by rewriting className in JS means
                     the two states cannot drift apart. */ ?>
            <p class="tw-mb-0 tw-mt-4 tw-hidden tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700 [&.is-shown]:tw-block [&.is-ok]:tw-border-[rgba(25,135,84,0.25)] [&.is-ok]:tw-bg-[rgba(25,135,84,0.1)] [&.is-ok]:tw-text-[#146c43]"
              data-app-error role="alert" aria-live="polite"></p>

            <div class="tw-mt-5 tw-flex tw-items-center tw-gap-3">
              <button class="<?= $pcBtnGhost ?> tw-hidden [&.is-shown]:tw-inline-flex" type="button" data-app-back>Back</button>
              <button class="<?= $pcBtnPrimary ?> tw-flex-1" type="submit" data-app-next>
                <span data-app-next-label>Continue</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </button>
            </div>

            <?php /* Shown in place of the form once Supabase has the row. */ ?>
            <div class="tw-hidden tw-text-center [&.is-shown]:tw-block" data-app-done>
              <span class="tw-mx-auto tw-mb-4 tw-flex tw-h-14 tw-w-14 tw-items-center tw-justify-center tw-rounded-full tw-bg-[rgba(25,135,84,0.12)] tw-text-[#146c43]">
                <svg class="tw-h-7 tw-w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 12.75l5.25 5.25 9.75-10.5"/></svg>
              </span>
              <h3 class="tw-mb-2 tw-text-lg tw-font-bold tw-text-ink">Application submitted</h3>
              <p class="alert-success tw-mb-0 tw-text-[0.95rem] tw-leading-relaxed tw-text-ink/65">
                Thanks &mdash; our team reviews your documents and comes back to you within 48 hours.
                You can sign into the PowerCabs Driver app with the email and password you just set.
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/driver-application.js?v=<?= @filemtime(
  __DIR__ . '/../../assets/js/components/driver-application.js',
) ?>"></script>
