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
<?php /* LIGHT, not dark. This was tw-bg-ink on every page that uses it, which
         put a black slab directly above a black footer -- and on the ten pages
         that also ran the orange app banner, the page ended orange, then
         black, then black. §26 asks for dark to be a punctuation mark rather
         than the default ending.

         The old comment here argued the dark CTA and dark footer "meet without
         a seam", which was true while the footer was pinned behind <main> and
         the CTA scrolled up off it. That effect is gone (base.css), so there
         is no seam to hide -- and a light closing block is now what separates
         the page's last action from the footer.

         The surface is the warm off-white rather than pure white so it still
         reads as a distinct closing block on a page whose last section was
         white, without introducing another colour. */ ?>
<section class="<?= $pcSurfaceSoft ?> tw-border-0 tw-border-t tw-border-solid tw-border-hairline <?= $pcSection ?>">
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
// See the header note -- these are page globals, so a second require later
// on the same page must not inherit this one's copy.
unset($ctaTitle, $ctaText, $ctaPrimary, $ctaSecondary);
