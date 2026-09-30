<?php
/**
 * The hero breadcrumb. Its own file only because inner-hero.php renders it in
 * one of two places -- above the title on the light variants, below it on the
 * photographic one, where the copy is bottom-aligned and a crumb floating
 * above the headline has nothing to sit against.
 *
 * Reads $heroCrumbLink / $heroCrumbSep / $heroCrumbCurrent / $heroCrumbFirst
 * and $heroBreadcrumbLabel from inner-hero.php. Not for use on its own.
 *
 * The matching BreadcrumbList JSON-LD stays in inner-hero.php so the
 * structured data is emitted exactly once per page regardless of placement.
 */
?>
<nav aria-label="breadcrumb" class="<?= $heroCrumbFirst ? 'tw-mb-4' : '' ?>">
  <ol class="tw-m-0 tw-flex tw-list-none tw-items-center tw-gap-2 tw-p-0 tw-text-[0.8125rem] tw-tracking-[0.02em]">
    <li>
      <?php /* py-1 with -my-1: the padding lifts the tap target from 17px to
               25px (WCAG 2.5.8 wants 24), and the negative margin gives the
               space straight back to the layout, so the crumb row and the H1
               below it do not move by even a pixel. */ ?>
      <a class="<?= $heroCrumbLink ?> tw-inline-block tw-py-1 -tw-my-1 tw-no-underline tw-transition-colors tw-duration-200" href="<?= $assetPath ?>/">Home</a>
    </li>
    <li aria-hidden="true" class="<?= $heroCrumbSep ?>">/</li>
    <li class="tw-font-semibold <?= $heroCrumbCurrent ?>" aria-current="page"><?= htmlspecialchars($heroBreadcrumbLabel) ?></li>
  </ol>
</nav>
