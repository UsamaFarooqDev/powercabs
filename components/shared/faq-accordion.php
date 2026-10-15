<?php
$faqItems = $faqItems ?? [];
if ($faqItems) {
  $faqEyebrow = $faqEyebrow ?? 'Questions';
  $faqHeading = $faqHeading ?? 'Good to know.';
  $faqLayout = $faqLayout ?? 'center';
  $faqMoreLabel = $faqMoreLabel ?? 'All FAQs';
  $faqSurface = $faqSurface ?? 'white';

  static $pcFaqSeq = 0;
  $pcFaqSeq++;
  $faqAccordionId = $faqAccordionId ?? 'pcFaq' . $pcFaqSeq;

  $faqSplit = $faqLayout === 'split';
  ?>
  <?php  ?>
  <section class="<?= $faqSurface === 'soft' ? $pcSurfaceSoft : $pcSurfaceWhite ?> <?= $pcSection ?>">
    <div class="<?= $faqSplit ? $pcContainer : $pcContainerNarrow ?>">
      <div class="<?= $faqSplit ? 'tw-grid tw-grid-cols-1 tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-20' : '' ?>">

        <div class="<?= $faqSplit ? 'lg:tw-col-span-5' : 'tw-mb-8' ?>">
          <p class="<?= $pcEyebrow ?>"><?= htmlspecialchars($faqEyebrow) ?></p>
          <h2 class="<?= $pcH2 ?> <?= $faqSplit ? 'tw-max-w-[15ch]' : 'tw-mb-0' ?>"><?= htmlspecialchars($faqHeading) ?></h2>
          <?php if (!empty($faqLead)): ?>
            <p class="<?= $pcBody ?> tw-mb-0 tw-mt-3 tw-max-w-[42ch]"><?= htmlspecialchars($faqLead) ?></p>
          <?php endif; ?>
          <?php if (!empty($faqMoreHref)): ?>
            <?php  ?>
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

$faqItems = [];
unset($faqEyebrow, $faqHeading, $faqLead, $faqLayout, $faqMoreHref, $faqMoreLabel, $faqSurface, $faqAccordionId, $faqListId);
