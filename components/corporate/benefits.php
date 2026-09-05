<?php
$corporateBenefits = [
  ['icon' => 'invoice', 'label' => 'Monthly Invoicing'],
  ['icon' => 'briefcase', 'label' => 'Executive Rides'],
  ['icon' => 'airplane', 'label' => 'Airport Transfers'],
  ['icon' => 'badge', 'label' => 'Meet & Greet'],
  ['icon' => 'building', 'label' => 'Business Account'],
  ['icon' => 'chart', 'label' => 'Reporting'],
];
?>
<section class="tw-relative tw-overflow-hidden tw-bg-white <?= $pcSection ?>">
  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-mb-10 tw-text-center">
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Everything Your Business Needs</h2>
    </div>
    <div class="tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-black/[0.06] tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.06] md:tw-grid-cols-3">
      <?php foreach ($corporateBenefits as $item): ?>
        <div class="tw-flex tw-flex-col tw-items-center tw-px-3 tw-py-8 tw-text-center md:tw-py-10">
          <?php switch ($item['icon']):
            case 'invoice': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
            <?php break;
            case 'briefcase': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 14.15v4.25c0 1.09-.787 2.04-1.872 2.18-2.087.28-4.216.42-6.378.42s-4.291-.14-6.378-.42c-1.085-.14-1.872-1.09-1.872-2.18v-4.25M3.75 8.706c0-1.08.768-2.01 1.837-2.175a48.11 48.11 0 013.413-.387m7.5 0v-.894A2.25 2.25 0 0014.25 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M21 12.49c0 .65-.29 1.27-.75 1.66-.194.16-.42.29-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.43-7.577-1.22A2.016 2.016 0 013 12.49"/></svg>
            <?php break;
            case 'airplane': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
            <?php break;
            case 'badge': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            <?php break;
            case 'building': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
            <?php break;
            case 'chart': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3v16.5A1.5 1.5 0 004.5 21H21M7 16.5l3.5-5 3 3L18.5 7"/></svg>
            <?php break;
          endswitch; ?>
          <h3 class="tw-mb-0 tw-text-[1.05rem] tw-leading-snug tw-font-bold tw-text-ink"><?= htmlspecialchars($item['label']) ?></h3>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
