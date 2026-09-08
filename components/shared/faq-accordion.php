<!-- Shared FAQ accordion -- used by drive.php, ride.php and faqs.php.
     Open/close is driven by the small collapse helper in
     assets/js/components/ui.js (data-pc-collapse / -target / -parent),
     which replaced Bootstrap's Collapse. It keeps aria-expanded in sync on
     the button, and the chevron rotates off that attribute via the
     group-aria-expanded: variant. data-pc-collapse-parent makes the group
     exclusive: opening one item closes its siblings. -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[860px]">
    <div class="tw-mb-10 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power"><?= htmlspecialchars(
        $faqEyebrow,
      ) ?></p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl"><?= htmlspecialchars($faqHeading) ?></h2>
    </div>

    <div class="tw-flex tw-flex-col tw-gap-3" id="<?= htmlspecialchars($faqAccordionId) ?>">
      <?php foreach ($faqItems as $i => $item): ?>
        <div class="tw-overflow-hidden tw-rounded-xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white">
          <h3 class="tw-m-0">
            <button class="tw-group tw-flex tw-w-full tw-appearance-none tw-items-center tw-justify-between tw-gap-4 tw-border-0 tw-bg-transparent tw-px-5 tw-py-4 tw-text-left tw-text-[0.98rem] tw-font-medium tw-text-ink tw-transition-colors tw-duration-200 aria-expanded:tw-text-power" type="button" data-pc-collapse
              data-pc-target="#<?= htmlspecialchars($faqAccordionId) ?>Item<?= $i ?>" aria-expanded="<?= $i === 0
  ? 'true'
  : 'false' ?>" aria-controls="<?= htmlspecialchars($faqAccordionId) ?>Item<?= $i ?>">
              <span><?= htmlspecialchars($item['q']) ?></span>
              <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-power tw-transition-transform tw-duration-200 group-aria-expanded:tw-rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
            </button>
          </h3>
          <div id="<?= htmlspecialchars($faqAccordionId) ?>Item<?= $i ?>" class="tw-max-h-0 [&.is-open]:tw-max-h-[80rem] tw-overflow-hidden tw-transition-[max-height] tw-duration-300 tw-ease-[cubic-bezier(0.4,0,0.2,1)] motion-reduce:tw-transition-none<?= $i === 0
  ? ' is-open'
  : '' ?>" data-pc-collapse-panel data-pc-collapse-parent="#<?= htmlspecialchars($faqAccordionId) ?>">
            <div class="tw-px-5 tw-pb-4 tw-leading-[1.6] tw-text-ink/60"><?= htmlspecialchars($item['a']) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
