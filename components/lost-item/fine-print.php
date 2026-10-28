<?php
?>
<?php /* The limits, stated plainly and in one place, so no section above has to hedge mid-sentence. */ ?>
<section class="tw-relative tw-overflow-hidden tw-py-10 md:tw-py-12">
  <span class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-bottom-0 tw-h-1/2 tw-bg-[linear-gradient(to_bottom,rgba(255,255,255,0)_0%,rgba(255,255,255,0.55)_45%,rgba(255,255,255,0.88)_78%,#ffffff_100%)]" aria-hidden="true"></span>

  <div class="tw-relative <?= $pcContainerNarrow ?>">
    <div class="tw-flex tw-flex-col tw-gap-4 sm:tw-flex-row">
      <span class="<?= $pcIconChip ?> tw-shrink-0">
        <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
      </span>
      <div>
        <p class="tw-mb-2 tw-text-[0.72rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-ink/65">Good to know</p>
        <p class="tw-mb-0 tw-text-[0.9rem] tw-leading-[1.75] tw-text-ink/60">
          The first search is free and carries no obligation. If it does not produce a likely match,
          the extended investigation across our wider driver data costs &euro;<?= $lostItemFee ?> and only goes
          ahead if you ask for it. Neither search can guarantee that your item will be found or
          returned &mdash; we investigate the information available to us and tell you honestly what we
          find. If your item is located and you want it retrieved or delivered, a separate cost may
          apply depending on distance and circumstances; you will be told that cost and asked to
          approve it before anything further happens.
        </p>
      </div>
    </div>
  </div>
</section>
