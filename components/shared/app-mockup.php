<?php
$mockupNotch     = $mockupNotch ?? false;
$mockupFloat     = $mockupFloat ?? false;
$mockupMaxWidth  = $mockupMaxWidth ?? '280px';
$mockupWrapClass = $mockupWrapClass ?? '';
$mockupImgId     = $mockupImgId ?? '';
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
  <div class="tw-relative tw-mx-auto tw-w-[260px] tw-max-w-full tw-rounded-[2.25rem] tw-bg-ink tw-p-2.5 tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)]<?= $mockupFloat
    ? ' tw-animate-pc-float motion-reduce:tw-animate-none'
    : '' ?>">
    <div class="pc-phone-screen tw-relative tw-min-h-[360px] tw-overflow-hidden tw-rounded-[1.65rem] tw-bg-white">
      <?php if ($mockupNotch): ?><span class="tw-absolute tw-left-1/2 tw-top-2 tw-z-[2] tw-h-4 tw-w-20 -tw-translate-x-1/2 tw-rounded-full tw-bg-ink"></span><?php endif; ?>
      <img<?= $mockupImgId ? ' id="' . htmlspecialchars($mockupImgId) . '"' : '' ?> src="<?= $assetPath ?>assets/img/<?= htmlspecialchars($mockupImage) ?>" alt="<?= htmlspecialchars($mockupAlt) ?>" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
    </div>
  </div>
  <?php if (!empty($mockupFloatCards) && is_callable($mockupFloatCards)): $mockupFloatCards(); endif; ?>
</div>
<?php unset($mockupImage, $mockupAlt, $mockupNotch, $mockupFloat, $mockupMaxWidth, $mockupWrapClass, $mockupFloatCards, $mockupImgId); ?>
