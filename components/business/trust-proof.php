<?php
$bizTrustMarkers = [
  ['icon' => 'badge', 'label' => 'NTA License DH12616'],
  ['icon' => 'shield', 'label' => 'Garda-Vetted Drivers'],
  ['icon' => 'headset', 'label' => '24/7 Business Support'],
];

function pc_biz_trust_icon(string $icon): void
{
  switch ($icon):
    case 'badge': ?>
      <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'headset': ?>
      <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 13.5v-1.75a7.5 7.5 0 0115 0v1.75M4.5 13.5a1.75 1.75 0 00-1.75 1.75v1a1.75 1.75 0 001.75 1.75h.75a1 1 0 001-1v-3.5a1 1 0 00-1-1h-.75zm15 0a1.75 1.75 0 011.75 1.75v1a1.75 1.75 0 01-1.75 1.75h-.75a1 1 0 01-1-1v-3.5a1 1 0 011-1h.75zM18 18v.75a2.25 2.25 0 01-2.25 2.25h-2.25"/></svg>
    <?php break;
  endswitch;
}
?>
<section class="tw-bg-[linear-gradient(180deg,#f9f4ed_0%,#ffffff_100%)] tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mx-auto tw-max-w-[46rem] tw-text-center">
      <svg class="tw-mx-auto tw-mb-3 tw-h-9 tw-w-9 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
      <p class="tw-mb-4 tw-text-[clamp(1.3rem,2.6vw,1.7rem)] tw-font-semibold tw-leading-[1.45] tw-text-ink">
        Every PowerCabs Business account runs on the same standard we hold
        every ride to &mdash; licensed, vetted drivers, one simple account,
        and a team that actually answers the phone.
      </p>
      <p class="tw-mb-10 tw-font-bold tw-text-ink">&mdash; The PowerCabs Business Team</p>

      <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-center tw-gap-3">
        <?php foreach ($bizTrustMarkers as $marker): ?>
          <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-px-4 tw-py-2">
            <span class="tw-text-power"><?php pc_biz_trust_icon($marker['icon']); ?></span>
            <span class="tw-text-sm tw-font-semibold tw-text-ink"><?= htmlspecialchars(
              $marker['label'],
            ) ?></span>
          </span>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
