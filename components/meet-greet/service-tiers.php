<?php
/**
 * The three Meet & Greet service levels, as pricing cards.
 *
 * Reads $mgServiceLevels from meet-greet.php -- the same array the "Service
 * Level" field in the booking form is built from, so a tier cannot appear here
 * and be missing from the form, or be priced differently in the two places.
 *
 * Every price, feature, exclusion and note is exactly as supplied. Nothing is
 * inferred or rounded: this is a price list, and an invented line on it is an
 * invented commitment.
 *
 * The featured card is ink with an orange badge, matching
 * components/business/plans.php -- the site already has a three-tier pricing
 * section and a second visual language for the same job would read as a
 * different product.
 *
 * The buttons set the form's Service Level and scroll to it rather than
 * linking out, so "Select First Class" does what it says. The handler lives in
 * the page's existing inline script, next to the rest of the form wiring.
 */
$mgTierCheck =
  '<svg class="tw-mt-[3px] tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12.5l5 5L20 6.5"/></svg>';
$mgTierCross =
  '<svg class="tw-mt-[3px] tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 6l12 12M18 6L6 18"/></svg>';
?>
<!-- ============ Meet & Greet service levels ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">

    <div class="tw-mx-auto tw-mb-10 tw-max-w-[640px] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?> tw-inline-flex tw-items-center tw-gap-1.5">
        <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
        Dublin Airport
      </p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Airport Meet &amp; Greet</h2>
      <p class="<?= $pcBody ?> tw-mb-0">Choose the level of service that suits you or your passenger.</p>
    </div>

    <?php /* items-stretch, and each card is a flex column with the button
             pushed down by mt-auto: the three tiers carry different numbers of
             features, and without that the buttons land at three different
             heights, which reads as three unrelated boxes. */ ?>
    <div class="tw-mx-auto tw-grid tw-max-w-[1100px] tw-grid-cols-1 tw-items-stretch tw-gap-5 md:tw-grid-cols-3 lg:tw-gap-6">
      <?php foreach ($mgServiceLevels as $mgKey => $mgTier): ?>
        <?php $mgFeatured = !empty($mgTier['featured']); ?>
        <div class="tw-relative tw-flex tw-h-full tw-flex-col tw-rounded-2xl tw-p-6 sm:tw-p-7 <?= $mgFeatured
          ? 'tw-bg-ink tw-text-white tw-shadow-[0_24px_55px_-22px_rgba(28,20,16,0.5)]'
          : 'tw-border tw-border-solid tw-border-hairline tw-bg-white tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]' ?>">

          <?php if ($mgFeatured): ?>
            <span class="tw-absolute -tw-top-3 tw-left-1/2 -tw-translate-x-1/2 tw-whitespace-nowrap tw-rounded-full tw-bg-power tw-px-3 tw-py-1 tw-text-[0.62rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-white">Recommended</span>
          <?php endif; ?>

          <p class="tw-mb-2 tw-flex tw-items-center tw-gap-1.5 tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] <?= $mgFeatured
            ? 'tw-text-powerlight'
            : 'tw-text-muted' ?>">
            <?php if ($mgFeatured): ?>
              <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2l2.9 6.26L21.5 9.2l-4.9 4.6 1.2 6.7L12 17.3l-5.8 3.2 1.2-6.7-4.9-4.6 6.6-.94L12 2z"/></svg>
            <?php endif; ?>
            <?= $mgTier['eyebrow'] ?>
          </p>

          <p class="tw-mb-2 tw-flex tw-items-baseline tw-gap-1.5">
            <span class="tw-text-[2.25rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.03em] <?= $mgFeatured
              ? 'tw-text-white'
              : 'tw-text-ink' ?>">&euro;<?= (int) $mgTier['price'] ?></span>
            <span class="tw-text-[0.8rem] <?= $mgFeatured ? 'tw-text-white/50' : 'tw-text-muted' ?>">/ booking</span>
          </p>

          <h3 class="tw-mb-2 tw-text-[1.0625rem] tw-font-bold tw-leading-snug <?= $mgFeatured
            ? 'tw-text-white'
            : 'tw-text-ink' ?>"><?= $mgTier['title'] ?></h3>

          <p class="tw-mb-5 tw-text-[0.9rem] tw-leading-[1.55] <?= $mgFeatured
            ? 'tw-text-white/[0.68]'
            : 'tw-text-muted' ?>"><?= $mgTier['desc'] ?></p>

          <span class="tw-mb-5 tw-block tw-h-px tw-w-full <?= $mgFeatured
            ? 'tw-bg-white/15'
            : 'tw-bg-hairline' ?>" aria-hidden="true"></span>

          <ul class="tw-m-0 tw-mb-5 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
            <?php foreach ($mgTier['includes'] as $mgInc): ?>
              <li class="tw-flex tw-items-start tw-gap-2.5 tw-text-[0.9rem] tw-leading-[1.5] <?= $mgFeatured
                ? 'tw-text-white/[0.82]'
                : 'tw-text-ink' ?>">
                <span class="<?= $mgFeatured ? 'tw-text-powerlight' : 'tw-text-power' ?>"><?= $mgTierCheck ?></span>
                <?= $mgInc ?>
              </li>
            <?php endforeach; ?>
          </ul>

          <?php if (!empty($mgTier['note'])): ?>
            <div class="tw-mb-4 tw-rounded-xl tw-px-4 tw-py-3.5 <?= $mgFeatured
              ? 'tw-bg-white/[0.06]'
              : 'tw-bg-paper-soft' ?>">
              <p class="tw-mb-1 tw-text-[0.82rem] tw-font-bold <?= $mgFeatured
                ? 'tw-text-white'
                : 'tw-text-ink' ?>"><?= $mgTier['note']['title'] ?></p>
              <p class="tw-mb-0 tw-text-[0.8rem] tw-leading-[1.55] <?= $mgFeatured
                ? 'tw-text-white/60'
                : 'tw-text-muted' ?>"><?= $mgTier['note']['text'] ?></p>
            </div>
          <?php endif; ?>

          <?php if (!empty($mgTier['excludes'])): ?>
            <?php /* Stated, not hidden: a tier list that only ever says yes
                     makes the reader hunt for the catch. */ ?>
            <div class="tw-mb-4 tw-rounded-xl tw-px-4 tw-py-3.5 <?= $mgFeatured
              ? 'tw-bg-white/[0.06]'
              : 'tw-bg-paper-soft' ?>">
              <p class="tw-mb-1.5 tw-text-[0.82rem] tw-font-bold <?= $mgFeatured
                ? 'tw-text-white'
                : 'tw-text-ink' ?>">Not included</p>
              <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-1.5 tw-p-0">
                <?php foreach ($mgTier['excludes'] as $mgExc): ?>
                  <li class="tw-flex tw-items-start tw-gap-2 tw-text-[0.8rem] tw-leading-[1.5] <?= $mgFeatured
                    ? 'tw-text-white/45'
                    : 'tw-text-muted' ?>">
                    <?= $mgTierCross ?>
                    <?= $mgExc ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endif; ?>

          <?php if (!empty($mgTier['idealFor'])): ?>
            <div class="tw-mb-4 tw-rounded-xl tw-px-4 tw-py-3.5 <?= $mgFeatured
              ? 'tw-bg-white/[0.06]'
              : 'tw-bg-paper-soft' ?>">
              <p class="tw-mb-1 tw-text-[0.82rem] tw-font-bold <?= $mgFeatured
                ? 'tw-text-white'
                : 'tw-text-ink' ?>">Ideal for</p>
              <p class="tw-mb-0 tw-text-[0.8rem] tw-leading-[1.55] <?= $mgFeatured
                ? 'tw-text-white/60'
                : 'tw-text-muted' ?>"><?= implode(' &middot; ', $mgTier['idealFor']) ?></p>
            </div>
          <?php endif; ?>

          <?php /* A <button>, not an <a>: it drives the form on this page, it
                   does not navigate. type="button" so it can never submit
                   anything, and appearance-none/border-0 because preflight is
                   off and a bare <button> keeps its native chrome otherwise. */ ?>
          <?php /* NO tw-border-0 in the base string. It was there, alongside
                   tw-border in the outline branch, and border-0 won -- which
                   utility wins is decided by the order Tailwind emits them,
                   not by the order they appear in this attribute, so the two
                   unfeatured buttons rendered with no outline at all. Each
                   branch now sets its own border-width and nothing competes. */ ?>
          <button type="button" data-mg-tier="<?= htmlspecialchars($mgKey) ?>"
            class="tw-mt-auto tw-inline-flex tw-w-full tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-gap-2 tw-rounded-full tw-px-6 tw-py-3 tw-font-[inherit] tw-text-[0.78rem] tw-font-bold tw-uppercase tw-tracking-[0.08em] tw-transition tw-duration-300 motion-reduce:tw-transition-none <?= $mgFeatured
              ? 'tw-border-0 tw-bg-power tw-text-white hover:tw-shadow-[0_12px_28px_rgba(255,122,0,0.38)]'
              : 'tw-border tw-border-solid tw-border-ink/20 tw-bg-transparent tw-text-ink hover:tw-border-ink hover:tw-bg-ink hover:tw-text-white' ?>">
            Select <?= $mgTier['eyebrow'] ?>
          </button>

        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
