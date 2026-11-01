<?php
/**
 * "I accept the Terms and Conditions" checkbox.
 *
 * One spelling of a control that would otherwise have been pasted into six forms. `required`
 * stops the browser submitting without it, but the page's POST handler still has to check the
 * field -- a required attribute is a convenience for the user, not a guarantee to the server.
 *
 * The box is drawn rather than native: preflight is off and `accent-color` renders differently on
 * every OS, so an appearance-none square with its own tick is the only way this reads the same
 * everywhere. The tick is a sibling of the input and shown with `peer-checked:`, which keeps the
 * whole control CSS-only.
 *
 * The link stays in the same tab on purpose -- see the note on it below.
 *
 * Variables (all optional):
 *   $consentId       input id, must be unique on the page  (default 'pcTerms')
 *   $consentName     field name                            (default 'terms_accepted')
 *   $consentChecked  re-tick after a failed post
 *   $consentRequired false where the field sits in a block the page hides -- Chrome refuses to
 *                    submit a form holding a required control it cannot focus, and the server
 *                    check is the one that counts anyway       (default true)
 *   $consentPrivacy  also link the privacy policy              (default false)
 *   $consentOnDark   light text, for a dark panel
 *   $consentClass    extra classes on the wrapper
 */
$consentId ??= 'pcTerms';
$consentName ??= 'terms_accepted';
$consentChecked ??= false;
$consentRequired ??= true;
$consentPrivacy ??= false;
$consentOnDark ??= false;
$consentClass ??= '';

$pcConsentShell = $consentOnDark
  ? 'tw-border-white/15 tw-bg-white/[0.05] hover:tw-border-white/25'
  : 'tw-border-hairline tw-bg-paper-soft hover:tw-border-ink/15';

$pcConsentBox = $consentOnDark
  ? 'tw-border-white/30 tw-bg-white/10 hover:tw-border-white/50'
  : 'tw-border-ink/20 tw-bg-white hover:tw-border-ink/35';

$pcConsentText = $consentOnDark ? 'tw-text-white/70' : 'tw-text-ink/65';

$pcConsentLink = $consentOnDark
  ? 'tw-text-white hover:tw-text-powerlight tw-decoration-white/40 hover:tw-decoration-powerlight'
  : 'tw-text-power hover:tw-text-powerdark tw-decoration-power/30 hover:tw-decoration-powerdark';
?>
<div class="tw-flex tw-items-start tw-gap-3 tw-rounded-xl tw-border tw-border-solid tw-px-3.5 tw-py-3 tw-transition-colors tw-duration-200 <?= $pcConsentShell ?> <?= $consentClass ?>">

  <?php /* The input is the box; the tick floats over it and is revealed by peer-checked. */ ?>
  <span class="tw-relative tw-mt-[0.1rem] tw-flex tw-h-[1.15rem] tw-w-[1.15rem] tw-shrink-0 tw-items-center tw-justify-center">
    <input type="checkbox" value="1" <?= $consentRequired ? 'required' : '' ?>
      id="<?= htmlspecialchars($consentId) ?>" name="<?= htmlspecialchars($consentName) ?>"
      <?= $consentChecked ? 'checked' : '' ?>
      class="tw-peer tw-absolute tw-inset-0 tw-m-0 tw-h-full tw-w-full tw-cursor-pointer tw-appearance-none tw-rounded-[0.375rem] tw-border tw-border-solid tw-transition-colors tw-duration-200 checked:tw-border-power checked:tw-bg-power checked:hover:tw-border-power focus-visible:tw-outline focus-visible:tw-outline-2 focus-visible:tw-outline-offset-2 focus-visible:tw-outline-power/70 motion-reduce:tw-transition-none <?= $pcConsentBox ?>">
    <svg class="tw-pointer-events-none tw-relative tw-h-[0.7rem] tw-w-[0.7rem] tw-scale-50 tw-text-white tw-opacity-0 tw-transition tw-duration-200 peer-checked:tw-scale-100 peer-checked:tw-opacity-100 motion-reduce:tw-transition-none"
      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
      <path d="M4.5 12.75l6 6 9-13.5"/>
    </svg>
  </span>

  <label class="tw-cursor-pointer tw-text-[0.875rem] tw-leading-snug <?= $pcConsentText ?>" for="<?= htmlspecialchars($consentId) ?>">
    I have read and accept the
    <?php /* Same tab by design: a booking form is not worth losing to a popup blocker or a
             stranded second window. PJAX swaps <main>, so Back returns to the form. */ ?><a
      class="tw-font-semibold tw-decoration-[1.5px] tw-transition-colors tw-duration-200 motion-reduce:tw-transition-none <?= $pcConsentLink ?>"
      href="<?= $assetPath ?>/terms-conditions">Terms&nbsp;and&nbsp;Conditions</a><?php if (
      $consentPrivacy
    ): ?> and the <a
      class="tw-font-semibold tw-decoration-[1.5px] tw-transition-colors tw-duration-200 motion-reduce:tw-transition-none <?= $pcConsentLink ?>"
      href="<?= $assetPath ?>/privacy-policy">Privacy&nbsp;Policy</a><?php endif; ?> of PowerCabs Ireland Limited.
  </label>
</div>
<?php
unset(
  $consentId,
  $consentName,
  $consentChecked,
  $consentRequired,
  $consentPrivacy,
  $consentOnDark,
  $consentClass,
  $pcConsentShell,
  $pcConsentBox,
  $pcConsentText,
  $pcConsentLink
);
