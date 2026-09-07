<?php
/* Shared closing CTA -- the last thing on a page before the app banner and
   footer.

   It exists as one component rather than a hand-rolled block per page
   because the site had ~6 different closing CTAs that all said the same
   thing in different type sizes. Every page that needs one requires this and
   sets only the copy:

     $ctaTitle    = 'Ready when you are.';
     $ctaText     = '...';                       // optional
     $ctaPrimary  = ['href' => '/ride', 'label' => 'Book a Ride'];
     $ctaSecondary= ['href' => '/drive', 'label' => 'Drive with Us'];  // optional
     require __DIR__ . '/components/shared/final-cta.php';

   Defaults below are the homepage's, so a bare require still renders
   something sensible. Every variable is unset at the end: these are page
   globals, and leaving them set would leak into a second require further
   down the same page. */

$ctaTitle ??= 'Your next journey starts here.';
$ctaText ??= 'Book in seconds, ride with licensed Irish drivers, and pay the fare you were quoted.';
$ctaPrimary ??= ['href' => '/book-ride-online', 'label' => 'Book a Ride'];
$ctaSecondary ??= ['href' => '/contact-us', 'label' => 'Talk to Us'];
?>
<!-- ============ Final CTA ============ -->
<!-- Dark, because this is the page's punctuation mark and the surface change
     is what makes it read as an ending rather than one more section. The
     footer below is also dark, so the two meet without a seam -- deliberate:
     the CTA reads as the top of the closing block. -->
<!-- tw-bg-ink here, and the footer below sits on the darker tw-bg-ink-soft.
     Both were tw-bg-ink, which merged the closing CTA and the whole footer
     into one undifferentiated black slab at the foot of every page. One step
     of tone is enough to read them as two blocks without adding a rule. -->
<section class="<?= $pcSurfaceDark ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-flex tw-flex-col tw-items-start tw-gap-8 lg:tw-flex-row lg:tw-items-center lg:tw-justify-between">

      <div class="tw-max-w-[46ch]">
        <h2 class="<?= $pcH2OnDark ?>"><?= htmlspecialchars($ctaTitle) ?></h2>
        <?php if ($ctaText !== ''): ?>
          <p class="tw-mb-0 <?= $pcBodyOnDark ?>"><?= htmlspecialchars($ctaText) ?></p>
        <?php endif; ?>
      </div>

      <div class="tw-flex tw-flex-wrap tw-gap-3">
        <a class="<?= $pcBtnPrimaryOnDark ?>" href="<?= $assetPath . htmlspecialchars($ctaPrimary['href']) ?>">
          <?= htmlspecialchars($ctaPrimary['label']) ?>
        </a>
        <?php if (!empty($ctaSecondary)): ?>
          <a class="<?= $pcBtnOutlineLight ?>" href="<?= $assetPath . htmlspecialchars($ctaSecondary['href']) ?>">
            <?= htmlspecialchars($ctaSecondary['label']) ?>
          </a>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
<?php
// See the header note -- these are page globals, so a second require later
// on the same page must not inherit this one's copy.
unset($ctaTitle, $ctaText, $ctaPrimary, $ctaSecondary);
