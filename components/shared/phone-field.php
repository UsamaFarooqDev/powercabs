<?php
/**
 * Phone input with a country-code selector.
 *
 * Renders as ONE control the same height, width, radius and border as every other field in the
 * form. Rather than hard-coding those, the shell is DERIVED from the recipe the form passes in
 * ($phoneClass, normally $pcInput): padding is moved onto the two halves, and `focus:` becomes
 * `focus-within:` because the wrapper is never the focused element. Change $pcInput and this
 * field follows it automatically.
 *
 * The native <select> stays in the DOM as the value carrier -- phone-field.js hides it and draws
 * a searchable panel over it, but with no JS the field still works and still submits.
 *
 * Variables (all optional):
 *   $phoneId          input id                     (default 'pcPhone')
 *   $phoneName        number field name            (default 'phone')
 *   $phoneCcName      dial-code field name         (default 'phone_cc')
 *   $phoneValue       posted-back number
 *   $phoneCcValue     posted-back dial code
 *   $phoneClass       the form's input recipe      (default $pcInput)
 *   $phonePlaceholder
 *   $phoneRequired    bool
 *   $phoneAutocomplete
 */
require_once __DIR__ . '/../../includes/phone-countries.php';

$phoneId ??= 'pcPhone';
$phoneName ??= 'phone';
$phoneCcName ??= 'phone_cc';
$phoneValue ??= '';
$phoneCcValue ??= '';
$phoneClass ??= $pcInput;
$phonePlaceholder ??= '87 123 4567';
$phoneRequired ??= false;
$phoneAutocomplete ??= 'tel';

$pcPhoneList = pc_phone_countries();

$pcPhoneSelected = null;
foreach ($pcPhoneList as $c) {
  if ($phoneCcValue !== '' && $c['code'] === $phoneCcValue) {
    $pcPhoneSelected = $c;
    break;
  }
}
if (!$pcPhoneSelected) {
  foreach ($pcPhoneList as $c) {
    if ($c['iso'] === PC_PHONE_DEFAULT_ISO) {
      $pcPhoneSelected = $c;
      break;
    }
  }
}
$pcPhoneSelected ??= $pcPhoneList[0];

$pcPhoneSquash = static fn(string $s): string => trim((string) preg_replace('/\s+/', ' ', $s));

// Pull the padding off the recipe and hand it to the input, so the control keeps the exact
// height of its neighbours instead of guessing at py- values.
preg_match_all('/\btw-p[xytrbl]?-[\w.\[\]\/]+/', (string) $phoneClass, $pcPhonePadM);
$pcPhonePad = $pcPhonePadM[0] ? implode(' ', $pcPhonePadM[0]) : 'tw-px-3 tw-py-1.5';

// Everything that belongs to the placeholder follows the input too.
preg_match_all('/\bplaceholder:[\w.\[\]\/-]+/', (string) $phoneClass, $pcPhonePhM);
$pcPhonePh = implode(' ', $pcPhonePhM[0]);

$pcPhoneShell = (string) $phoneClass;
$pcPhoneShell = preg_replace('/\btw-p[xytrbl]?-[\w.\[\]\/]+/', '', $pcPhoneShell);
$pcPhoneShell = preg_replace('/\bplaceholder:[\w.\[\]\/-]+/', '', $pcPhoneShell);
$pcPhoneShell = str_replace('focus:', 'focus-within:', (string) $pcPhoneShell);
$pcPhoneShell = $pcPhoneSquash($pcPhoneShell);
?>
<div class="pc-phone tw-relative tw-flex tw-items-stretch <?= $pcPhoneShell ?>" data-pc-phone>

  <?php /* The country half. Padding is a touch wider than the number side so the flag is not
           jammed against the border; the flag/code/chevron sit tight to each other inside it. */ ?>
  <div class="tw-relative tw-flex tw-shrink-0 tw-items-center">
    <button type="button" data-pc-phone-trigger
      class="tw-flex tw-h-full tw-cursor-pointer tw-appearance-none tw-items-center tw-gap-1 tw-rounded-l-[inherit] tw-border-0 tw-bg-transparent tw-pl-3 tw-pr-2.5 tw-font-[inherit] tw-text-inherit tw-outline-none focus-visible:tw-bg-black/[0.04]"
      aria-haspopup="listbox" aria-expanded="false" aria-label="Country dialling code">
      <span data-pc-phone-flag class="tw-inline-flex tw-h-[0.8rem] tw-w-[1.15rem] tw-shrink-0 tw-overflow-hidden tw-rounded-[2px] tw-shadow-[0_0_0_1px_rgba(0,0,0,0.08)]" aria-hidden="true">
        <svg viewBox="0 0 20 14" class="tw-h-full tw-w-full" focusable="false"><?= $pcPhoneSelected['svg'] ?></svg>
      </span>
      <span data-pc-phone-code class="tw-text-[0.95em] tw-font-semibold tw-leading-none tw-text-ink"><?= htmlspecialchars($pcPhoneSelected['code']) ?></span>
      <svg class="tw-h-3 tw-w-3 tw-shrink-0 tw-text-ink/40 tw-transition-transform tw-duration-200 [[aria-expanded=true]_&]:tw-rotate-180" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 4.5L6 8l3.5-3.5"/></svg>
    </button>

    <?php /* Kept, not removed: the real value, and the whole control if the script never runs. */ ?>
    <select name="<?= htmlspecialchars($phoneCcName) ?>" data-pc-phone-select
      aria-label="Country dialling code"
      class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-cursor-pointer tw-appearance-none tw-border-0 tw-bg-transparent tw-p-0 tw-text-[0.9rem] tw-opacity-0">
      <?php foreach ($pcPhoneList as $c): ?>
        <option value="<?= htmlspecialchars($c['code']) ?>" data-iso="<?= htmlspecialchars($c['iso']) ?>" data-country="<?= htmlspecialchars($c['name']) ?>"
          <?= $c['iso'] === $pcPhoneSelected['iso'] && $c['code'] === $pcPhoneSelected['code'] ? 'selected' : '' ?>><?= htmlspecialchars($c['name']) ?> (<?= htmlspecialchars($c['code']) ?>)</option>
      <?php endforeach; ?>
    </select>
  </div>

  <span class="tw-my-1.5 tw-w-px tw-shrink-0 tw-bg-current tw-opacity-[0.14]" aria-hidden="true"></span>

  <input type="tel" id="<?= htmlspecialchars($phoneId) ?>" name="<?= htmlspecialchars($phoneName) ?>"
    value="<?= htmlspecialchars($phoneValue) ?>"
    placeholder="<?= htmlspecialchars($phonePlaceholder) ?>"
    autocomplete="<?= htmlspecialchars($phoneAutocomplete) ?>"
    inputmode="tel"
    <?= $phoneRequired ? 'required' : '' ?>
    class="<?= $pcPhonePad ?> <?= $pcPhonePh ?> tw-m-0 tw-min-w-0 tw-flex-1 tw-appearance-none tw-rounded-r-[inherit] tw-border-0 tw-bg-transparent tw-font-[inherit] tw-text-inherit tw-outline-none">

  <?php /* The flags the panel draws, keyed by ISO code. Inline, so no extra request. */ ?>
  <script type="application/json" data-pc-phone-flags><?= json_encode(array_column($pcPhoneList, 'svg', 'iso'), JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
</div>
<?php
unset(
  $phoneId, $phoneName, $phoneCcName, $phoneValue, $phoneCcValue, $phoneClass,
  $phonePlaceholder, $phoneRequired, $phoneAutocomplete,
  $pcPhoneList, $pcPhoneSelected, $pcPhoneShell, $pcPhonePad, $pcPhonePh, $pcPhonePadM, $pcPhonePhM, $pcPhoneSquash
);
