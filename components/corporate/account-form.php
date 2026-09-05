<?php
$old ??= ['name' => '', 'email' => '', 'business_name' => '', 'employee_count' => '', 'mobile' => '', 'address' => ''];
$formStatus ??= null;
$formError ??= '';

$whatWeDo = [
  ['icon' => 'easel', 'label' => 'Seminars'],
  ['icon' => 'mic', 'label' => 'Conferences'],
  ['icon' => 'image', 'label' => 'Exhibitions'],
  ['icon' => 'rocket', 'label' => 'Product Launches'],
  ['icon' => 'megaphone', 'label' => 'PR Events'],
  ['icon' => 'cup', 'label' => 'Corporate Hospitality'],
  ['icon' => 'trophy', 'label' => 'Sporting Events'],
  ['icon' => 'bank', 'label' => 'State Visits'],
  ['icon' => 'shield', 'label' => 'Professional Sports Organizations'],
];

// Every plain field shares this exact recipe -- the canonical PowerCabs
// form system, defined in book-ride-online.php and reproduced by the
// triggers custom-select.js / custom-datetime.js build (CLS.trigger there),
// so any field elsewhere on the site lines up with these: border-radius
// 6px, border #dee2e6, focus border-color swap to --pc-orange-light with no
// ring/glow.
$inputClass = $pcInput;
?>
<section class="tw-scroll-mt-24 <?= $pcSection ?>" id="corporate-account-form">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2">
      <div>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ What We Do</p>
        <h2 class="tw-mb-4 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Occasions we Cover</h2>
        <p class="tw-mb-6 tw-max-w-[46ch] tw-text-lg tw-text-ink/60">
          From seminars to state visits, PowerCabs handles the transportation
          so your team can stay focused on the event itself.
        </p>
        <div class="tw-flex tw-flex-wrap tw-gap-2">
          <?php foreach ($whatWeDo as $item): ?>
            <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-white tw-px-3 tw-py-2 tw-text-sm tw-font-medium tw-text-ink tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)]">
              <?php switch ($item['icon']): case 'easel': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="12" rx="1.5"/><path d="M8 20h8M12 16v4"/></svg>
                <?php break;case 'mic': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="9" y="2" width="6" height="11" rx="3"/><path d="M5 10a7 7 0 0014 0M12 17v4M9 21h6"/></svg>
                <?php break;case 'image': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="18" height="16" rx="2"/><circle cx="8.5" cy="9.5" r="1.5"/><path d="M21 15.5l-5-5-9.5 9"/></svg>
                <?php break;case 'rocket': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 2.25c2.25 2.1 3.375 5.06 3.375 8.1 0 2.1-1.06 4.2-3.375 6.3-2.315-2.1-3.375-4.2-3.375-6.3 0-3.04 1.125-6 3.375-8.1z"/><path d="M8.7 14.25l-2.7 2.7.9 2.7 2.7-2.7M15.3 14.25l2.7 2.7-.9 2.7-2.7-2.7"/></svg>
                <?php break;case 'megaphone': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13.5l4.286 2.143M18 8.5l4.286-2.143M4.99 9.75h.512c1.14 0 2.243-.288 3.187-.858l1.812-1.088a5.25 5.25 0 012.575-.804h1.174c.53 0 .96.43.96.96v6.16c0 .53-.43.96-.96.96h-1.174a5.25 5.25 0 01-2.575-.804l-1.812-1.088a6.4 6.4 0 00-3.187-.858h-.512a1.5 1.5 0 01-1.5-1.5v-.42a1.5 1.5 0 011.5-1.5z"/></svg>
                <?php break;case 'cup': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 8h13v6a4 4 0 01-4 4H8a4 4 0 01-4-4V8z"/><path d="M17 9h1.5a2.5 2.5 0 010 5H17M8 3c0 1-1 1-1 2M12 3c0 1-1 1-1 2"/></svg>
                <?php break;case 'trophy': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8 4h8v4a4 4 0 01-8 0V4z"/><path d="M8 4H5.5a2 2 0 000 4H8M16 4h2.5a2 2 0 010 4H16M9 20h6M10 17.9V20m4-2.1V20M9 13.5C6.5 13 6 11 6 8"/></svg>
                <?php break;case 'bank': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 21h18M4 21v-9m16 9v-9M4 12L12 6l8 6M6 21v-6m4 6v-6m4 6v-6m4 6v-6"/></svg>
                <?php break;case 'shield': ?>
                  <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                <?php break;endswitch; ?>
              <?= htmlspecialchars($item['label']) ?>
            </span>
          <?php endforeach; ?>
        </div>
      </div>

      <div>
        <div class="tw-rounded-[2rem] tw-bg-white tw-p-6 tw-shadow-[0_24px_48px_rgba(28,20,16,0.14)] sm:tw-p-8">
          <h2 class="tw-mb-2 tw-text-2xl tw-font-bold tw-text-ink">Register for a Corporate Account</h2>
          <p class="tw-mb-6 tw-text-ink/60">Tell us a little about your business and our team will be in touch.</p>

          <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
            <div>
              <label class="tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="csName">Name</label>
              <input type="text" class="<?= $inputClass ?>" id="csName" name="name" value="<?= htmlspecialchars(
  $old['name'],
) ?>" required>
            </div>
            <div>
              <label class="tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="csEmail">Email</label>
              <input type="email" class="<?= $inputClass ?>" id="csEmail" name="email" value="<?= htmlspecialchars(
  $old['email'],
) ?>" required>
            </div>
            <div>
              <label class="tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="csBusinessName">Business Name</label>
              <input type="text" class="<?= $inputClass ?>" id="csBusinessName" name="business_name" value="<?= htmlspecialchars(
  $old['business_name'],
) ?>" required>
            </div>
            <div>
              <label class="tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="csEmployeeCount">Number of Employees</label>
              <input type="number" min="1" class="<?= $inputClass ?>" id="csEmployeeCount" name="employee_count" value="<?= htmlspecialchars(
  $old['employee_count'],
) ?>">
            </div>
            <div>
              <label class="tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="csMobile">Mobile</label>
              <input type="tel" class="<?= $inputClass ?>" id="csMobile" name="mobile" value="<?= htmlspecialchars(
  $old['mobile'],
) ?>" required>
            </div>
            <div>
              <label class="tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink" for="csAddress">Address</label>
              <input type="text" class="<?= $inputClass ?>" id="csAddress" name="address" value="<?= htmlspecialchars(
  $old['address'],
) ?>">
            </div>

            <div class="tw-col-span-full tw-pt-2">
              <!-- tw-appearance-none tw-border-0: strip the native <button>
                   chrome (default 2px outset border + native rendering)
                   Preflight would otherwise reset -- see book-ride-online.php
                   for the full story. -->
              <button type="submit" class="tw-inline-flex tw-appearance-none tw-items-center tw-gap-2 tw-rounded-full tw-border-0 tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]">
                <span>Submit</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12L3.269 3.126A59.77 59.77 0 0121.485 12 59.77 59.77 0 013.27 20.876L6 12zm0 0h7.5"/></svg>
              </button>
            </div>

            <!-- .alert-success / .alert-danger stay as bare classnames --
                 the contract ajax-forms.js parses out of the returned HTML. -->
            <?php if ($formStatus === 'success'): ?>
              <div class="tw-col-span-full">
                <div class="alert-success tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your registration has been sent. Our Business Team will be in touch shortly.</div>
              </div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="tw-col-span-full">
                <div class="alert-danger tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars(
                  $formError,
                ) ?></div>
              </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
