<?php
/**
 * One audience panel on /terms-conditions -- sticky section nav on the left,
 * the terms themselves on the right.
 *
 * Shared by customer.php, driver.php and business.php, which each set
 * $termsPanelId / $termsIntro / $termsMeta / $termsNav / $termsBody and then
 * require this. Three copies of this wrapper is how the two-audience version
 * of the page worked, and it is why the driver column quietly drifted out of
 * step with the passenger one; one renderer cannot.
 *
 * $termsBody is TRUSTED HTML, generated from the Word source by the converter
 * and escaped at that point -- never user input, so it is echoed raw.
 *
 * Only the first panel rendered is visible; the rest carry tw-hidden and are
 * swapped by assets/js/components/terms-conditions.js. They stay in the DOM so
 * the content is in the page for search engines and for Ctrl+F.
 */
$termsHidden ??= true;
?>
<section class="tw-pb-16 tw-pt-3 md:tw-pb-24<?= $termsHidden ? ' tw-hidden' : '' ?>" id="<?= htmlspecialchars($termsPanelId) ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-12 lg:tw-grid-cols-12">

      <div class="lg:tw-col-span-3">
        <?php /* These documents run to 57-64 clauses, where the two-audience
                 version had twelve. A sticky column that long runs past the
                 bottom of the viewport and the last clauses become unreachable,
                 so the list scrolls inside its own sticky box. max-h is figured
                 from the navbar height plus the eyebrow above it. */ ?>
        <div class="tw-sticky tw-top-[100px]">
          <p class="<?= $pcEyebrow ?>">On This Page</p>
          <ul class="tw-m-0 tw-flex tw-max-h-[calc(100vh-11rem)] tw-list-none tw-flex-col tw-gap-1 tw-overflow-y-auto tw-p-0 tw-pr-2 [scrollbar-width:thin]">
            <?php foreach ($termsNav as $item): ?>
              <li><a class="tw-block tw-border-0 tw-border-l-2 tw-border-solid tw-border-transparent tw-py-1.5 tw-pl-3 tw-text-sm tw-text-ink/[0.65] tw-transition-[color,border-color] tw-duration-200 hover:tw-border-l-power hover:tw-text-power focus-visible:tw-border-l-power focus-visible:tw-text-power" href="#<?= $item['id'] ?>"><?= $item['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="tw-max-w-[72ch] tw-leading-[1.75] [&_h2]:tw-scroll-mt-[100px] [&_h2]:tw-text-ink [&_h3]:tw-scroll-mt-[100px] [&_p]:tw-text-ink/[0.65] [&_ul]:tw-text-ink/[0.65] lg:tw-col-span-9">
        <p class="tw-mb-1 tw-text-sm tw-text-ink/50"><?= $termsIntro ?></p>
        <?php if ($termsMeta !== ''): ?>
          <p class="tw-mb-4 tw-text-sm tw-text-ink/50"><?= $termsMeta ?></p>
        <?php endif; ?>
<?= $termsBody ?>
      </div>

    </div>
  </div>
</section>
<?php
/* Page globals: the next panel on this page must not inherit any of these. */
unset($termsPanelId, $termsIntro, $termsMeta, $termsNav, $termsBody, $termsHidden);
