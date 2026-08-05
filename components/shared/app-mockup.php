<?php
$mockupNotch     = $mockupNotch ?? false;
$mockupFloat     = $mockupFloat ?? false;
$mockupMaxWidth  = $mockupMaxWidth ?? '280px';
$mockupWrapClass = $mockupWrapClass ?? '';
$mockupImgId     = $mockupImgId ?? '';
?>
<div class="pc-app-showcase position-relative mx-auto<?= $mockupWrapClass ? ' ' . htmlspecialchars($mockupWrapClass) : '' ?>" style="max-width: <?= htmlspecialchars($mockupMaxWidth) ?>;">
  <div class="pc-phone-frame mx-auto position-relative<?= $mockupFloat ? ' pc-app-float-phone' : '' ?>">
    <div class="pc-phone-screen">
      <?php if ($mockupNotch): ?><span class="pc-phone-notch"></span><?php endif; ?>
      <img<?= $mockupImgId ? ' id="' . htmlspecialchars($mockupImgId) . '"' : '' ?> src="<?= $assetPath ?>assets/img/<?= htmlspecialchars($mockupImage) ?>" alt="<?= htmlspecialchars($mockupAlt) ?>" class="w-100 h-100" style="object-fit: cover;" loading="lazy">
    </div>
  </div>
  <?php if (!empty($mockupFloatCards) && is_callable($mockupFloatCards)): $mockupFloatCards(); endif; ?>
</div>
<?php unset($mockupImage, $mockupAlt, $mockupNotch, $mockupFloat, $mockupMaxWidth, $mockupWrapClass, $mockupFloatCards, $mockupImgId); ?>
