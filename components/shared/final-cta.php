<?php
$ctaTitle ??= 'Your next journey starts here.';
$ctaText ??= 'Book in seconds, ride with licensed Irish drivers, and pay the fare you were quoted.';
$ctaPrimary ??= ['href' => '/book-ride-online', 'label' => 'Book a Ride'];
$ctaSecondary ??= ['href' => '/contact-us', 'label' => 'Talk to Us'];
?>
<?php  ?>
<?php  ?>
<section class="tw-bg-white tw-border-0 tw-border-t tw-border-solid tw-border-hairline <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-flex tw-flex-col tw-items-start tw-gap-8 lg:tw-flex-row lg:tw-items-center lg:tw-justify-between">

      <div class="tw-max-w-[46ch]">
        <h2 class="<?= $pcH2 ?>"><?= htmlspecialchars($ctaTitle) ?></h2>
        <?php if ($ctaText !== ''): ?>
          <p class="tw-mb-0 <?= $pcBody ?>"><?= htmlspecialchars($ctaText) ?></p>
        <?php endif; ?>
      </div>

      <div class="tw-flex tw-flex-wrap tw-gap-3">
        <a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath . htmlspecialchars($ctaPrimary['href']) ?>">
          <?= htmlspecialchars($ctaPrimary['label']) ?>
        </a>
        <?php if (!empty($ctaSecondary)): ?>
          <a class="<?= $pcBtnGhost ?>" href="<?= $assetPath . htmlspecialchars($ctaSecondary['href']) ?>">
            <?= htmlspecialchars($ctaSecondary['label']) ?>
          </a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
<?php
unset($ctaTitle, $ctaText, $ctaPrimary, $ctaSecondary);
