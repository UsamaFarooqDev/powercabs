<?php
/**
 * The terms of the fee, in plain words, at the point they matter.
 *
 * This is the client's own wording from the brief, kept close to verbatim on
 * purpose: it is the page's consumer-facing promise about what EUR15 does and
 * does not buy. Do not soften "cannot be guaranteed" -- that sentence is the
 * one protecting both the customer and PowerCabs.
 *
 * Reads $lostItemFee from lost-item-report.php.
 */
?>
<!-- ============ Lost item: fee terms ============ -->
<?php /* The cream fades out to white over the lower half. The app-download
         banner that follows has a torn top edge, and the page background
         shows through those tears -- white. Without the fade, a flat cream
         block butted straight into that white, which is the seam this
         removes. Content sits on tw-relative above the overlay. */ ?>
<section class="tw-relative tw-overflow-hidden <?= $pcSurfacePaper ?> tw-py-10 md:tw-py-12">
  <span class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-bottom-0 tw-h-1/2 tw-bg-[linear-gradient(to_bottom,rgba(255,255,255,0)_0%,rgba(255,255,255,0.55)_45%,rgba(255,255,255,0.88)_78%,#ffffff_100%)]" aria-hidden="true"></span>

  <div class="tw-relative <?= $pcContainerNarrow ?>">
    <div class="tw-flex tw-flex-col tw-gap-4 sm:tw-flex-row">
      <span class="<?= $pcIconChip ?> tw-shrink-0">
        <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
      </span>
      <div>
        <p class="tw-mb-2 tw-text-[0.72rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-ink/65">Good to know</p>
        <p class="tw-mb-0 tw-text-[0.9rem] tw-leading-[1.75] tw-text-ink/60">
          The &euro;<?= $lostItemFee ?> fee covers the investigation and assistance involved in trying to
          identify the relevant taxi or driver and locate your item. Recovery cannot
          be guaranteed. If your item is located and you request retrieval or
          delivery, an additional fee may apply based on the distance and
          circumstances &mdash; you will be told that cost and asked to approve it before
          we proceed.
        </p>
      </div>
    </div>
  </div>
</section>
