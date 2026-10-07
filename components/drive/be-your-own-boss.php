<?php
/* Four chips, not eight. The four that were removed each said something the
   page already says better somewhere else, so nothing was actually lost:

     "Only 10% Commission" / "No Membership Fee"
        -> the stat band directly under the hero states both as headline
           numbers, and compare-model puts them in context against other
           platforms. Saying them a third time as chips made them look like
           small print rather than the offer.

     "Advertise and Earn" / "Branding Opportunity"
        -> car-earn-more.php is an entire section about exactly this, with
           the detail these two chips could not carry.

   What is left is the set of claims this section is the only place to make. */
// $driverPerks = [
//   ['icon' => 'clock', 'label' => 'Pay Per Hour'],
//   ['icon' => 'route', 'label' => 'Long Trips'],
//   ['icon' => 'headset', 'label' => 'Irish Support'],
//   ['icon' => 'bolt', 'label' => 'Fast Onboarding'],
// ];

function pc_drive_icon(string $icon, string $cls = 'tw-h-4 tw-w-4'): void
{
  switch ($icon):
    case 'clock': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <?php break;
    case 'megaphone': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 110-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c2.32.194 4.598.68 6.75 1.44l1.024.36a1.125 1.125 0 001.499-1.06V6.66a1.125 1.125 0 00-1.5-1.06l-1.023.36c-2.152.76-4.43 1.246-6.75 1.44m0 9.18v3.615a.75.75 0 01-.75.75h-1.5a.75.75 0 01-.75-.75v-3.435"/></svg>
    <?php break;
    case 'route': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6.75V15m6-6v8.25m.503-14.457L15.75 4.5l-3.253-1.207a1.5 1.5 0 00-1.02 0L8.223 4.5 4.75 3.25a.75.75 0 00-1 .707v13.5a.75.75 0 001 .707l3.473-1.25 3.253 1.207a1.5 1.5 0 001.02 0l3.254-1.207 3.473 1.25a.75.75 0 001-.707V4.207a.75.75 0 00-1-.707l-3.473 1.25z"/></svg>
    <?php break;
    case 'headset': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 13.5v-1.75a7.5 7.5 0 0115 0v1.75M4.5 13.5a1.75 1.75 0 00-1.75 1.75v1a1.75 1.75 0 001.75 1.75h.75a1 1 0 001-1v-3.5a1 1 0 00-1-1h-.75zm15 0a1.75 1.75 0 011.75 1.75v1a1.75 1.75 0 01-1.75 1.75h-.75a1 1 0 01-1-1v-3.5a1 1 0 011-1h.75zM18 18v.75a2.25 2.25 0 01-2.25 2.25h-2.25"/></svg>
    <?php break;
    case 'bolt': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'paint': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42"/></svg>
    <?php break;
    case 'percent': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 18L18 6M9 6.75a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm9 10.5a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
    <?php break;
    case 'wallet': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12a2.25 2.25 0 00-2.25-2.25H15a3 3 0 11-6 0H5.25A2.25 2.25 0 003 12m18 0v6a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 18v-6m18 0V9a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 9v3"/></svg>
    <?php break;
    case 'chevron': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 011.06 0l6.5 6.5a.75.75 0 010 1.06l-6.5 6.5a.75.75 0 11-1.06-1.06L14.19 12 8.22 6.03a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
    <?php break;
  endswitch;
}
?>
<!-- ============ Be Your Real Boss ============ -->
<?php /* Horizontal padding removed: it was the old px-4/sm:px-6/lg:px-8
         scale, which puts this section's content at x=60 while the rest of
         /drive sits at 64. The container inside now owns the gutters. */ ?>
<section class="tw-relative tw-overflow-hidden tw-py-16 md:tw-py-20">

  <div class="tw-relative <?= $pcContainer ?>">
    <?php /* Two columns now. The copy used to run to max-w-46rem with the whole
             right-hand side of the section empty, which is where the commission
             explainer below now sits -- it answers the argument on the left with
             the actual arithmetic, so the two belong beside each other rather
             than stacked a screen apart. */ ?>
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-14">

      <div class="lg:tw-col-span-7">
        <h2 class="<?= $pcH2Display ?>">
          Be Your Real Boss &mdash; Not Just on Paper.
        </h2>

        <?php /* NOTE ON THE COMPARISON. The supplied copy named a competitor's
                 product by name alongside "over 25%". The percentage stays --
                 components/drive/compare-model.php on this same page already
                 publishes "15-25%" and "Up to 25% cut" for other models, so it
                 is not a new claim -- but the brand name is gone. Naming a
                 named competitor's pricing in a comparative claim is a
                 different kind of exposure from describing a pricing MODEL,
                 and the sentence loses nothing without it. */ ?>
        <p class="tw-mb-4 tw-max-w-[52ch] tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/60">
          You became a taxi driver for <strong class="tw-font-semibold tw-text-ink">freedom and flexibility</strong>
          &mdash; not to work harder while handing over as much as a quarter of your
          earnings to fixed-fare models, and paying a monthly membership fee on top.
        </p>
        <!-- <p class="tw-mb-8 tw-max-w-[52ch] tw-text-[1.0625rem] tw-font-semibold tw-leading-[1.7] tw-text-ink">
          With PowerCabs, you keep more of what you earn. The choice is yours.
        </p> -->

        <!-- <div class="tw-mb-10 tw-flex tw-flex-wrap tw-gap-2.5">
          <?php foreach ($driverPerks as $perk): ?>
            <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-colors tw-duration-200 hover:tw-border-power/25">
              <span class="tw-text-power"><?php pc_drive_icon($perk['icon']); ?></span>
              <?= htmlspecialchars($perk['label']) ?>
            </span>
          <?php endforeach; ?>
        </div> -->

        <a class="<?= $pcBtnPrimary ?> tw-whitespace-nowrap" href="<?= $assetPath ?>/ambassador-programme">
          <span>Explore Ambassador Programme</span>
          <?php pc_drive_icon('chevron', 'tw-hidden tw-h-3.5 tw-w-3.5 sm:tw-inline-block'); ?>
        </a>
      </div>

      <?php /* The commission explainer. Ink panel for the rule, white card for
               the worked example overlapping it -- the example is the proof of
               the rule, so it reads as attached to it rather than as a seventh
               unrelated box on the page.

               The example uses the SAME 10% the hero, the stat band and
               compare-model state, so 50 - 5 = 45 is arithmetic off a published
               number, not a new price. If the commission ever changes, these
               three figures change with it. */ ?>
      <div class="lg:tw-col-span-5">
        <div class="tw-relative tw-mx-auto tw-w-full tw-max-w-[30rem] lg:tw-max-w-none">

          <div class="tw-rounded-3xl tw-bg-ink tw-p-6 tw-text-white tw-shadow-[0_28px_60px_-28px_rgba(28,20,16,0.55)] sm:tw-p-7">
            <h3 class="tw-mb-3 tw-text-[1.375rem] tw-font-bold tw-leading-[1.25] tw-tracking-[-0.02em] tw-text-white sm:tw-text-[1.5rem]">
              Know what you pay.<br>Know what you keep.
            </h3>
            <p class="tw-mb-5 tw-text-[0.9375rem] tw-leading-[1.65] tw-text-white/[0.68]">
              PowerCabs is built to add another booking source to your working
              day, without a monthly platform subscription.
            </p>
            <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
              <li class="tw-flex tw-items-start tw-gap-2.5 tw-text-[0.9375rem] tw-leading-[1.5] tw-text-white/[0.82]">
                <svg class="tw-mt-[3px] tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12.5l5 5L20 6.5"/></svg>
                <span><strong class="tw-font-semibold tw-text-white">Completed a PowerCabs job?</strong> Commission applies.</span>
              </li>
              <li class="tw-flex tw-items-start tw-gap-2.5 tw-text-[0.9375rem] tw-leading-[1.5] tw-text-white/[0.82]">
                <svg class="tw-mt-[3px] tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 12.5l5 5L20 6.5"/></svg>
                <span><strong class="tw-font-semibold tw-text-white">No PowerCabs job?</strong> No completed-job commission.</span>
              </li>
            </ul>
          </div>

          <?php /* -mt-5 and a ring: the card lifts off the panel above it
                   instead of butting against it. The ring, not a border, so the
                   white edge sits outside the radius cleanly on the ink. */ ?>
          <div class="tw--mt-5 tw-ml-auto tw-w-[92%] tw-rounded-2xl tw-bg-white tw-p-5 tw-shadow-[0_18px_40px_-18px_rgba(28,20,16,0.35)] tw-ring-1 tw-ring-black/[0.06] sm:tw-p-6">
            <p class="tw-mb-3 tw-text-[0.95rem] tw-font-bold tw-text-ink">Example trip</p>
            <dl class="tw-m-0">
              <div class="tw-flex tw-items-center tw-justify-between tw-gap-3 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.07] tw-py-2.5">
                <dt class="tw-text-[0.9rem] tw-text-ink/60">Trip value</dt>
                <dd class="tw-m-0 tw-text-[0.9rem] tw-font-semibold tw-text-ink">&euro;50.00</dd>
              </div>
              <div class="tw-flex tw-items-center tw-justify-between tw-gap-3 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.07] tw-py-2.5">
                <dt class="tw-text-[0.9rem] tw-text-ink/60">10% PowerCabs commission</dt>
                <dd class="tw-m-0 tw-text-[0.9rem] tw-font-semibold tw-text-power">&minus;&euro;5.00</dd>
              </div>
              <div class="tw-flex tw-items-center tw-justify-between tw-gap-3 tw-pt-3">
                <dt class="tw-text-[1rem] tw-font-bold tw-text-ink">You keep</dt>
                <dd class="tw-m-0 tw-text-[1.25rem] tw-font-extrabold tw-tracking-[-0.02em] tw-text-ink">&euro;45.00</dd>
              </div>
            </dl>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
