<?php
$paymentChecklist = [
  'PCI compliant processing',
  'Secure encrypted transactions',
  'Next day settlements',
  'Fast payouts',
  'Simple setup',
  'Ongoing local support',
  'Accept cards, Apple Pay & Google Pay',
];
?>
<section class="<?= $pcSection ?>" id="payment-solutions">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2">
      <div class="tw-order-2 tw-flex tw-justify-center lg:tw-order-1">
        <div class="tw-w-[340px] tw-max-w-full tw-overflow-hidden tw-rounded-[1.5rem]">
          <img
            src="<?= $assetPath ?>assets/img/Accept-Card-Payments.jpg"
            alt="PowerCabs Payment Solutions"
            class="tw-block tw-h-[420px] tw-w-full tw-object-cover"
            loading="lazy"
          >
        </div>
      </div>

      <div class="tw-order-1 lg:tw-order-2">
        <h2 class="tw-mb-4 tw-text-3xl tw-font-extrabold tw-leading-[1.15] tw-tracking-tight tw-text-ink md:tw-text-4xl">
          Accept Payments
          <span class="tw-text-power">With Confidence</span>
        </h2>

        <p class="tw-mb-4 tw-max-w-[520px] tw-text-base tw-leading-[1.75] tw-text-ink/60">
          Make it easier for your customers to pay while keeping your
          transactions secure, fast and reliable with PowerCabs payment
          solutions.
        </p>

        <div class="tw-mb-6 tw-rounded-[20px] tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-6 tw-shadow-[0_10px_30px_rgba(0,0,0,0.06)]">
          <ul class="tw-m-0 tw-grid tw-grid-cols-1 tw-gap-x-5 tw-gap-y-3.5 tw-p-0 sm:tw-grid-cols-2">
            <?php foreach ($paymentChecklist as $item): ?>
              <li class="tw-flex tw-items-start tw-gap-2 tw-text-sm tw-leading-[1.4]">
                <span class="tw-mt-px tw-inline-flex tw-h-[21px] tw-w-[21px] tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[rgba(245,132,31,0.12)] tw-text-power">
                  <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12l5 5L20 7"/></svg>
                </span>
                <span class="tw-text-ink/60"><?= htmlspecialchars($item) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-4">
          <a class="tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]" href="#payment-apply-form">
            Apply Now
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
          </a>
          <div class="tw-flex tw-items-center tw-gap-2 tw-text-sm tw-text-ink/60">
            <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>It only takes 2 minutes to apply.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
