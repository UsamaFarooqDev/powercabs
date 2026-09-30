<?php
$bizAccountBenefits = [
  ['icon' => 'receipt', 'title' => 'Simple Billing', 'desc' => 'Keep every business journey on a consolidated invoice, no hidden charges.'],
  ['icon' => 'chart', 'title' => 'Full Visibility', 'desc' => 'See journeys, spend and activity across whole organisation as it happens.'],
  /* The two account features that were NOT already said here, moved up from
     booking-process.php's icon row. That row restated One Account, Simple
     Billing and Full Visibility under a heading promising booking steps; these
     two were the only part of it saying anything new, so they join the list
     that was already making the argument. */
  ['icon' => 'workspace', 'title' => 'Priority Booking', 'desc' => 'Business journeys are prioritised when you need a car quickly.'],
  ['icon' => 'receipt', 'title' => 'Corporate Support', 'desc' => 'A dedicated contact for your account, not the general queue.'],
];

function pc_biz_icon(string $icon, string $cls = 'tw-h-5 tw-w-5'): void
{
  switch ($icon):
    case 'workspace': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25"/></svg>
    <?php break;
    case 'receipt': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM14.25 9h.008v.008h-.008V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
    <?php break;
    case 'chart': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 18L9 11.25l4.306 4.306a11.95 11.95 0 015.814-5.518l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941"/></svg>
    <?php break;
    case 'plane': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12.5a1.5 1.5 0 01.485-1.104l3.516-3.516a.75.75 0 011.06 0l1.42 1.42a.75.75 0 001.06 0l4.5-4.5a.75.75 0 011.06 0l1.5 1.5a.75.75 0 010 1.06l-4.5 4.5a.75.75 0 000 1.06l1.42 1.42a.75.75 0 010 1.06l-3.516 3.516A1.5 1.5 0 0110 20.5a1.5 1.5 0 01-1.06-.44L2.69 13.81a1.5 1.5 0 01-.44-1.06z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'building': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.75 21h16.5M4.5 3h15v18h-15V3zM9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
    <?php break;
    case 'coffee': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.25h13.5M3 8.25a1.5 1.5 0 011.5-1.5h10.5a1.5 1.5 0 011.5 1.5m-13.5 0v7.5A3.75 3.75 0 007.5 19.5h3a3.75 3.75 0 003.75-3.75v-7.5m0 0h1.5a2.25 2.25 0 012.25 2.25v.75a2.25 2.25 0 01-2.25 2.25h-1.5M6 4.5v2.25m3-2.25v2.25"/></svg>
    <?php break;
  endswitch;
}
?>

<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-12 tw-max-w-[680px] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Your Business Account</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Your business. Your account. Your taxi service.</h2>
      <p class="<?= $pcBody ?> tw-mb-0">
        Everything your team books in one place, billed once and visible the
        whole way through.
      </p>
    </div>

    <ul class="tw-m-0 tw-mb-14 tw-grid tw-list-none tw-grid-cols-1 tw-gap-5 tw-p-0 sm:tw-grid-cols-2 tw-lg:gap-6 lg:tw-grid-cols-4">
      <?php foreach ($bizAccountBenefits as $benefit): ?>
        <li class="tw-h-full tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-p-6 tw-transition-shadow tw-duration-300 hover:tw-shadow-[0_14px_34px_-14px_rgba(28,20,16,0.2)] motion-reduce:tw-transition-none">
          <span class="<?= $pcFeatureIcon ?> tw-mb-4">
            <?php pc_biz_icon($benefit['icon']); ?>
          </span>
          <span class="tw-mb-1.5 tw-block tw-text-[1.0625rem] tw-font-bold tw-leading-snug tw-text-ink"><?= htmlspecialchars(
            $benefit['title'],
          ) ?></span>
          <span class="<?= $pcBodySm ?> tw-block"><?= htmlspecialchars($benefit['desc']) ?></span>
        </li>
      <?php endforeach; ?>
    </ul>

    <div class="tw-grid tw-grid-cols-1">
      <div>
        <div class="tw-mx-auto tw-w-full tw-max-w-[560px] tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-[clamp(1.5rem,3vw,2rem)] tw-shadow-[0_24px_60px_-20px_rgba(28,20,16,0.28)]">
          <div class="tw-mb-6 tw-flex tw-items-center tw-justify-between tw-gap-3">
            <span class="tw-flex tw-items-center tw-gap-2 tw-font-bold tw-text-ink">
              <img src="<?= $assetPath ?>assets/img/powercabs-horse-icon.png" alt="" width="22" height="22" aria-hidden="true">
              PowerCabs Business
            </span>
            <span class="tw-rounded-full tw-border tw-border-solid tw-border-hairline tw-bg-surface tw-px-2.5 tw-py-1 tw-text-[0.68rem] tw-font-medium tw-text-muted">Example account</span>
          </div>

          <div class="tw-mb-6 tw-grid tw-grid-cols-2 tw-gap-3">
            <div class="tw-rounded-xl tw-bg-paper-soft tw-px-4 tw-py-3.5">
              <span class="tw-block tw-text-[1.35rem] tw-font-extrabold tw-leading-tight tw-text-ink">128</span>
              <span class="tw-block tw-text-[0.72rem] tw-text-ink/60">Bookings this month</span>
            </div>
            <div class="tw-rounded-xl tw-bg-paper-soft tw-px-4 tw-py-3.5">
              <span class="tw-block tw-text-[1.35rem] tw-font-extrabold tw-leading-tight tw-text-ink">6</span>
              <span class="tw-block tw-text-[0.72rem] tw-text-ink/60">Active journeys</span>
            </div>
            <div class="tw-rounded-xl tw-bg-paper-soft tw-px-4 tw-py-3.5">
              <span class="tw-block tw-text-[1.35rem] tw-font-extrabold tw-leading-tight tw-text-ink">&euro;2,340</span>
              <span class="tw-block tw-text-[0.72rem] tw-text-ink/60">Monthly spend</span>
            </div>
            <div class="tw-rounded-xl tw-bg-paper-soft tw-px-4 tw-py-3.5">
              <span class="tw-block tw-text-[1.35rem] tw-font-extrabold tw-leading-tight tw-text-ink">14</span>
              <span class="tw-block tw-text-[0.72rem] tw-text-ink/60">Team members</span>
            </div>
          </div>

          <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-ink/60">Recent Journeys</p>
          <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-items-center tw-gap-3 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06] tw-py-2.5">
              <span class="tw-shrink-0 tw-text-power"><?php pc_biz_icon('plane', 'tw-h-4 tw-w-4'); ?></span>
              <span class="tw-flex-1 tw-text-sm tw-font-medium tw-text-ink">Dublin Office &rarr; Dublin Airport</span>
              <span class="tw-text-sm tw-text-ink/60">08:45</span>
            </div>
            <div class="tw-flex tw-items-center tw-gap-3 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06] tw-py-2.5">
              <span class="tw-shrink-0 tw-text-power"><?php pc_biz_icon('building', 'tw-h-4 tw-w-4'); ?></span>
              <span class="tw-flex-1 tw-text-sm tw-font-medium tw-text-ink">Client Site &rarr; City Centre</span>
              <span class="tw-text-sm tw-text-ink/60">Yesterday</span>
            </div>
            <div class="tw-flex tw-items-center tw-gap-3 tw-py-2.5">
              <span class="tw-shrink-0 tw-text-power"><?php pc_biz_icon('coffee', 'tw-h-4 tw-w-4'); ?></span>
              <span class="tw-flex-1 tw-text-sm tw-font-medium tw-text-ink">Hotel &rarr; Conference Centre</span>
              <span class="tw-text-sm tw-text-ink/60">Mon</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
