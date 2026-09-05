<?php
// "More miles. More visibility." -- combines what used to be two separate
// sections (Benefits + Who Can Join) into the reference design's single
// campaign-card + info-sidebar layout.
$partnerBenefits = ['Grow your business', 'Increased bookings', 'Dedicated support', 'Weekly payments'];
$partnerWhyChoose = ['Marketing support', 'Technology platform', 'Driver &amp; fleet management'];

$whoCanJoin = [
  ['icon' => 'taxi', 'label' => 'Taxi Operators'],
  ['icon' => 'truck', 'label' => 'Fleet Owners'],
  ['icon' => 'person', 'label' => 'Independent Drivers'],
  ['icon' => 'building', 'label' => 'Transport Companies'],
];

function pc_ptn_join_icon(string $icon): void
{
  switch ($icon):
    case 'taxi': ?>
      <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
    <?php break;
    case 'truck': ?>
      <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V15m1.5 3.75h9v-9H5.625a1.125 1.125 0 00-1.125 1.125V15m15.75 3.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V15m0 0h-3.375M19.5 15V9.75a1.5 1.5 0 00-1.5-1.5h-2.25v6.75M19.5 15h-4.5"/></svg>
    <?php break;
    case 'person': ?>
      <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.964 0a9 9 0 10-11.964 0m11.964 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    <?php break;
    case 'building': ?>
      <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.75 21h16.5M4.5 3h15v18h-15V3zM9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
    <?php break;
  endswitch;
}
?>
<section class="tw-scroll-mt-24 <?= $pcSection ?>" id="pcPtnCampaign">
  <div class="<?= $pcContainer ?>">
    <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ Partner Programme</p>
    <h2 class="tw-mb-3 tw-text-[clamp(2rem,3.6vw,3.1rem)] tw-font-extrabold tw-leading-[1.06] tw-tracking-[-0.045em] tw-text-ink">More miles. More visibility.</h2>
    <p class="tw-mb-10 tw-max-w-[62ch] tw-text-[1.08rem] tw-text-ink/60">
      Join the network, follow a simple set of steps to get onboarded, and start
      receiving more consistent bookings across the PowerCabs platform.
    </p>

    <div class="tw-grid tw-grid-cols-1 tw-gap-6 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-7">
        <article class="tw-relative tw-h-full tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-[#f9f4ed] tw-p-[clamp(1.75rem,3vw,2.5rem)]">
          <span class="tw-absolute tw-inset-x-0 tw-top-0 tw-h-[5px] tw-bg-power" aria-hidden="true"></span>
          <span class="tw-inline-flex tw-rounded-full tw-bg-[#fbe6d4] tw-px-3 tw-py-1 tw-text-xs tw-font-extrabold tw-uppercase tw-tracking-[0.05em] tw-text-power">Partner Benefits</span>
          <h3 class="tw-mb-2 tw-mt-3 tw-text-[clamp(1.4rem,2vw,1.75rem)] tw-font-extrabold tw-tracking-[-0.03em] tw-text-ink">What You Gain as a Partner</h3>
          <p class="tw-mb-6 tw-text-ink/60">
            PowerCabs welcomes taxi operators, fleet owners, and business
            partners to join the growing transportation network and expand
            their business opportunities.
          </p>

          <div class="tw-mb-6 tw-grid tw-grid-cols-1 tw-gap-3.5 sm:tw-grid-cols-2">
            <?php foreach ($partnerBenefits as $item): ?>
              <div class="tw-flex tw-items-center tw-gap-2.5 tw-text-[0.92rem] tw-font-semibold tw-text-ink">
                <span class="tw-flex tw-h-6 tw-w-6 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-power tw-text-white">
                  <svg class="tw-h-3 tw-w-3" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 011.04-.207z" clip-rule="evenodd"/></svg>
                </span>
                <span><?= htmlspecialchars($item) ?></span>
              </div>
            <?php endforeach; ?>
          </div>

          <a class="tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]" href="#pcPtnEnquiry">
            Become a Partner
            <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 011.06 0l6.5 6.5a.75.75 0 010 1.06l-6.5 6.5a.75.75 0 11-1.06-1.06L14.19 12 8.22 6.03a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
          </a>
        </article>
      </div>

      <div class="lg:tw-col-span-5">
        <aside class="tw-h-full tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-[clamp(1.75rem,3vw,2.5rem)]">
          <h3 class="tw-mb-3 tw-text-lg tw-font-extrabold tw-text-ink">Who Can Join?</h3>
          <div class="tw-mb-7 tw-flex tw-flex-wrap tw-gap-2.5">
            <?php foreach ($whoCanJoin as $item): ?>
              <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-black/[0.08] tw-bg-[#f9f4ed] tw-px-3.5 tw-py-2 tw-text-sm tw-font-bold tw-text-ink">
                <span class="tw-text-power"><?php pc_ptn_join_icon($item['icon']); ?></span>
                <?= htmlspecialchars($item['label']) ?>
              </span>
            <?php endforeach; ?>
          </div>

          <hr class="tw-my-7 tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.08]">

          <h3 class="tw-mb-3 tw-text-lg tw-font-extrabold tw-text-ink">Why Operators Choose Us</h3>
          <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0">
            <?php foreach ($partnerWhyChoose as $item): ?>
              <li class="tw-flex tw-items-center tw-gap-2 tw-text-ink">
                <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span><?= $item ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </aside>
      </div>
    </div>
  </div>
</section>
