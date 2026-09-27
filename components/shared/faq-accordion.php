<?php
/**
 * The site's FAQ section: heading, optional through-link, and the question
 * list. The list markup itself lives in faq-list.php, shared with faqs.php.
 *
 * Open/close is driven by the collapse helper in assets/js/components/ui.js
 * (data-pc-collapse / -target / -parent), which replaced Bootstrap's Collapse.
 * data-pc-collapse-parent is what makes the group exclusive -- opening one
 * item closes its siblings (brief §20).
 *
 *   $faqItems       required. [['q' => ..., 'a' => ...], ...]
 *   $faqEyebrow     optional, defaults to "Questions"
 *   $faqHeading     optional, defaults to "Good to know."
 *   $faqLead        optional. One line under the heading.
 *   $faqLayout      optional. 'center' (default) or 'split' -- split puts the
 *                   heading in a column beside the questions, which reads
 *                   better on a page that already has a centred section above.
 *   $faqMoreHref    optional. Renders a link through to the full FAQ page.
 *   $faqMoreLabel   optional, defaults to "All FAQs"
 *   $faqSurface     optional. 'white' (default) or 'soft'.
 *   $faqAccordionId optional. Auto-generated when omitted; only set it if two
 *                   accordions share a page and need distinct ids.
 *
 * ANSWERS MUST COME FROM THE PAGE. Every entry added during the redesign is a
 * restructuring of copy that page already published -- a service description
 * turned back into the question a reader asked to get it. Do not write a new
 * answer here: an invented FAQ answer is an invented business claim, and it
 * will be read as a promise.
 */
$faqItems = $faqItems ?? [];
if ($faqItems) {
  $faqEyebrow = $faqEyebrow ?? 'Questions';
  $faqHeading = $faqHeading ?? 'Good to know.';
  $faqLayout = $faqLayout ?? 'center';
  $faqMoreLabel = $faqMoreLabel ?? 'All FAQs';
  $faqSurface = $faqSurface ?? 'white';

  // Unique per render, so a page can include this twice without the two
  // accordions targeting each other's panels.
  static $pcFaqSeq = 0;
  $pcFaqSeq++;
  $faqAccordionId = $faqAccordionId ?? 'pcFaq' . $pcFaqSeq;

  $faqSplit = $faqLayout === 'split';
  ?>
  <section class="<?= $faqSurface === 'soft' ? $pcSurfaceSoft : 'tw-bg-white' ?> <?= $pcSection ?>">
    <div class="<?= $faqSplit ? $pcContainer : $pcContainerNarrow ?>">
      <div class="<?= $faqSplit ? 'tw-grid tw-grid-cols-1 tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-20' : '' ?>">

        <div class="<?= $faqSplit ? 'lg:tw-col-span-5' : 'tw-mb-8' ?>">
          <p class="<?= $pcEyebrow ?>"><?= htmlspecialchars($faqEyebrow) ?></p>
          <h2 class="<?= $pcH2 ?> <?= $faqSplit ? 'tw-max-w-[15ch]' : 'tw-mb-0' ?>"><?= htmlspecialchars($faqHeading) ?></h2>
          <?php if (!empty($faqLead)): ?>
            <p class="<?= $pcBody ?> tw-mb-0 tw-mt-3 tw-max-w-[42ch]"><?= htmlspecialchars($faqLead) ?></p>
          <?php endif; ?>
          <?php if (!empty($faqMoreHref)): ?>
            <?php /* $pcBtnLink on the anchor, $pcBtnLinkIcon on the svg. These
                     were the wrong way round here: the anchor carried the icon
                     recipe, so the link lost its colour and weight and the
                     arrow's group-hover: never fired -- there was no
                     tw-group/link ancestor for it to hang off. */ ?>
            <a class="<?= $pcBtnLink ?> tw-mt-6" href="<?= $assetPath . htmlspecialchars($faqMoreHref) ?>">
              <?= htmlspecialchars($faqMoreLabel) ?>
              <svg class="<?= $pcBtnLinkIcon ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          <?php endif; ?>
        </div>

        <div class="<?= $faqSplit ? 'lg:tw-col-span-7' : '' ?>" id="<?= htmlspecialchars($faqAccordionId) ?>">
          <?php
          $faqListItems = $faqItems;
          $faqListId = $faqAccordionId;
          require __DIR__ . '/faq-list.php';
          ?>
        </div>
      </div>
    </div>
  </section>
  <?php
}

/* Cleared so a page that requires this twice, or a later component using the
   same variable names, cannot inherit the previous set. */
$faqItems = [];
unset($faqEyebrow, $faqHeading, $faqLead, $faqLayout, $faqMoreHref, $faqMoreLabel, $faqSurface, $faqAccordionId, $faqListId);
