<?php
/**
 * "Why EUR15?" -- what the fee buys, stated as five concrete actions, plus
 * the two sentences that stop it being mistaken for a ransom on the item:
 * the fee is for the work, and recovery cannot be guaranteed.
 *
 * This is where the pay button now lives (it used to sit beside the form),
 * because a visitor should meet the price with the explanation, not next to
 * a submit button.
 *
 * Reads $lostItemFee and $lostItemFeeLink from lost-item-report.php.
 */
$lostItemFeeCovers = [
  'Review the information you provide',
  'Investigate the journey information available to us',
  'Try to identify the relevant taxi or driver',
  'Contact the driver where appropriate',
  'Help you through the recovery process',
];
?>
<!-- ============ Lost item: the investigation fee ============ -->
<section class="<?= $pcSurfaceSoft ?> <?= $pcSection ?>" id="investigation">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">

      <div>
        <p class="<?= $pcEyebrow ?>">/ Simple and transparent</p>
        <h2 class="<?= $pcH2 ?>">Why <span class="tw-text-power">&euro;<?= $lostItemFee ?></span>?</h2>
        <p class="tw-mb-4 <?= $pcLead ?> <?= $pcMeasureTight ?>">
          Because a real investigation takes real people.
        </p>
        <p class="tw-mb-4 <?= $pcBody ?> <?= $pcMeasureTight ?>">
          The &euro;<?= $lostItemFee ?> is not a charge for your belongings. It covers the work
          involved in trying to locate them &mdash; and it is the only fee you pay
          unless you later ask us to arrange a retrieval.
        </p>
        <p class="tw-mb-0 <?= $pcBodySm ?> <?= $pcMeasureTight ?>">
          Recovery cannot be guaranteed. If your item is found and you want it
          returned, we tell you what that costs and you decide.
        </p>
      </div>

      <div class="<?= $pcCardPanel ?>">
        <div class="tw-flex tw-items-end tw-justify-between tw-gap-4 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.07] tw-pb-5">
          <div>
            <span class="tw-block tw-text-[0.68rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-powerdark">Lost item investigation</span>
            <span class="tw-mt-1 tw-block tw-text-[0.9rem] tw-text-ink/65">One-off fee, paid up front</span>
          </div>
          <span class="tw-shrink-0 tw-text-[2.75rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.04em] tw-text-power">&euro;<?= $lostItemFee ?></span>
        </div>

        <p class="tw-mb-3 tw-mt-5 tw-text-[0.72rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-ink/65">What it covers</p>
        <ul class="tw-m-0 tw-mb-6 tw-flex tw-list-none tw-flex-col tw-gap-3 tw-p-0">
          <?php foreach ($lostItemFeeCovers as $covers): ?>
            <li class="tw-flex tw-gap-2.5">
              <svg class="tw-mt-0.5 tw-h-[1.05rem] tw-w-[1.05rem] tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
              <span class="tw-text-[0.95rem] tw-leading-relaxed tw-text-ink/70"><?= htmlspecialchars($covers) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <?php if ($lostItemFeeLink === ''): ?>
          <?php /* STRIPE_LOST_ITEM_LINK missing from .env -- say so rather than
                   render a pay button that goes nowhere. */ ?>
          <p class="tw-mb-0 tw-rounded-xl tw-bg-paper tw-px-4 tw-py-3 tw-text-center tw-text-[0.9rem] tw-font-semibold tw-text-ink/70">
            Online payment is unavailable right now. Send your report below and we&rsquo;ll confirm how to pay.
          </p>
        <?php else: ?>
          <a href="<?= htmlspecialchars($lostItemFeeLink) ?>" target="_blank" rel="noopener noreferrer"
            class="<?= $pcBtnPrimary ?> tw-flex tw-w-full">
            <svg class="tw-h-3.5 tw-w-3.5 tw-shrink-0" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12 1.5a4.5 4.5 0 00-4.5 4.5v3H6a1.5 1.5 0 00-1.5 1.5v9A1.5 1.5 0 006 21h12a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0018 9h-1.5V6a4.5 4.5 0 00-4.5-4.5zm3 7.5V6a3 3 0 10-6 0v3h6z" clip-rule="evenodd"/></svg>
            Pay &euro;<?= $lostItemFee ?> and start my investigation
          </a>
          <p class="tw-mb-0 tw-mt-3 tw-flex tw-items-center tw-justify-center tw-gap-1.5 tw-text-[0.78rem] tw-text-ink/50">
            <svg class="tw-h-3.5 tw-w-3.5 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            Secure checkout by Stripe
          </p>
        <?php endif; ?>
      </div>

    </div>
  </div>
</section>
