<?php
$mockupNotch     = $mockupNotch ?? false;
$mockupFloat     = $mockupFloat ?? false;
$mockupMaxWidth  = $mockupMaxWidth ?? '280px';
$mockupWrapClass = $mockupWrapClass ?? '';
$mockupImgId     = $mockupImgId ?? '';
/* The device's own width. 260px is what every caller got until /drive's
   onboarding section needed a phone that holds its own beside a full-height
   column of text. Like $mockupMaxWidth above, this is composed into a class
   name, so the scanner can never see the finished string -- ANY new value has
   to be added to the safelist in tailwind.config.js or the utility will not
   exist and the phone silently collapses to its content width. */
$mockupWidth     = $mockupWidth ?? '260px';
?>
<?php
// pc-phone-screen stays as a bare classname with no CSS behind it:
// components/ride/booking-steps.php reaches into it with [&_.pc-phone-screen]:
// variants to give that page's mockup a taller screen than the default.
// tw-animate-pc-float is the shared keyframe declared in the Tailwind config
// (includes/header.php), not a stylesheet rule.
?>
<div class="tw-relative tw-mx-auto tw-max-w-[<?= htmlspecialchars($mockupMaxWidth) ?>]<?= $mockupWrapClass
  ? ' ' . htmlspecialchars($mockupWrapClass)
  : '' ?>">
  <div class="tw-relative tw-mx-auto tw-w-[<?= htmlspecialchars($mockupWidth) ?>] tw-max-w-full tw-rounded-[2.25rem] tw-bg-ink tw-p-2.5 <?= $mockupFloat
    ? ' tw-animate-pc-float motion-reduce:tw-animate-none'
    : '' ?>">
    <div class="pc-phone-screen tw-relative tw-min-h-[360px] tw-overflow-hidden tw-rounded-[1.65rem] tw-bg-white">
      <?php if ($mockupNotch): ?><span class="tw-absolute tw-left-1/2 tw-top-2 tw-z-[2] tw-h-4 tw-w-20 -tw-translate-x-1/2 tw-rounded-full tw-bg-ink"></span><?php endif; ?>
      <img<?= $mockupImgId ? ' id="' . htmlspecialchars($mockupImgId) . '"' : '' ?> src="<?= $assetPath ?>assets/img/<?= htmlspecialchars($mockupImage) ?>" alt="<?= htmlspecialchars($mockupAlt) ?>" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
    </div>
  </div>
  <?php if (!empty($mockupFloatCards) && is_callable($mockupFloatCards)): $mockupFloatCards(); endif; ?>
</div>
<?php unset($mockupImage, $mockupAlt, $mockupNotch, $mockupFloat, $mockupMaxWidth, $mockupWidth, $mockupWrapClass, $mockupFloatCards, $mockupImgId); ?>
