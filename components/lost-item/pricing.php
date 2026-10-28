<?php
/* Two prices, side by side, with the free one first. The point of the section is that nobody is
   asked for money before a search has been attempted, so the €0 card leads and the €15 card is
   explicitly conditional. */
?>
<section class="<?= $pcSection ?>" id="pricing">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-5 lg:tw-grid-cols-3">

      <div class="<?= $pcCardPricing ?> tw-justify-center tw-gap-1 tw-border-success/30 tw-bg-success/[0.06]">
        <div class="tw-mb-3 tw-flex tw-items-center tw-gap-3">
          <span class="tw-inline-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-success tw-text-white" aria-hidden="true">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          </span>
          <p class="tw-mb-0 tw-text-[0.95rem] tw-font-bold tw-text-ink">Free first search</p>
        </div>
        <p class="tw-mb-0 tw-text-[clamp(2rem,4vw,2.75rem)] tw-font-extrabold tw-leading-none tw-tracking-[-0.03em] tw-text-success">&euro;0</p>
        <p class="<?= $pcBodySm ?> tw-mb-0 tw-mt-2">Against approximately <?= number_format($lostItemFreeDrivers) ?> drivers. No card details, no obligation.</p>
      </div>

      <div class="<?= $pcCardPricing ?> tw-justify-center tw-gap-1">
        <div class="tw-mb-3 tw-flex tw-items-center tw-gap-3">
          <span class="<?= $pcIconChip ?> tw-h-11 tw-w-11" aria-hidden="true">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5.25" rx="8.25" ry="3"/><path d="M3.75 5.25v6c0 1.657 3.694 3 8.25 3s8.25-1.343 8.25-3v-6M3.75 11.25v6c0 1.657 3.694 3 8.25 3s8.25-1.343 8.25-3v-6"/></svg>
          </span>
          <p class="tw-mb-0 tw-text-[0.95rem] tw-font-bold tw-text-ink">Extended investigation</p>
        </div>
        <p class="tw-mb-0 tw-flex tw-flex-wrap tw-items-baseline tw-gap-x-2">
          <span class="tw-text-[clamp(2rem,4vw,2.75rem)] tw-font-extrabold tw-leading-none tw-tracking-[-0.03em] tw-text-power">&euro;<?= $lostItemFee ?></span>
          <span class="tw-text-[0.9rem] tw-font-semibold tw-text-ink/55">if you choose to proceed</span>
        </p>
        <p class="<?= $pcBodySm ?> tw-mb-0 tw-mt-2">Only offered if the free search finds no likely match. You decide.</p>
      </div>

      <div class="tw-flex tw-flex-col tw-justify-center tw-rounded-3xl tw-border tw-border-solid tw-border-hairline tw-bg-paper-soft tw-p-7">
        <p class="<?= $pcBodySm ?> tw-mb-0">
          Our database includes approximately
          <strong class="tw-font-bold tw-text-ink"><?= number_format($lostItemAllDrivers) ?> drivers</strong>,
          with an initial search of <strong class="tw-font-bold tw-text-ink"><?= number_format($lostItemFreeDrivers) ?> drivers</strong>
          offered free of charge.
        </p>
        <p class="<?= $pcBodySm ?> tw-mb-0 tw-mt-3 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-pt-3">
          Any retrieval or delivery cost is separate again, and quoted to you before anything happens.
        </p>
      </div>

    </div>
  </div>
</section>
