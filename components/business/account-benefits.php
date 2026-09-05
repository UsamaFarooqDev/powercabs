<?php
$bizAccountBenefits = [
  ['icon' => 'workspace', 'title' => 'One Account', 'desc' => "Manage your team's travel from one place -- book for anyone, anytime."],
  ['icon' => 'receipt', 'title' => 'Simple Billing', 'desc' => 'Keep every business journey on one consolidated invoice, with no hidden charges.'],
  ['icon' => 'chart', 'title' => 'Full Visibility', 'desc' => 'See journeys, spend and activity across your whole organisation as it happens.'],
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
<section class="tw-bg-gradient-to-b tw-from-white tw-to-paper-soft tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ Your Business Account</p>
        <h2 class="tw-mb-6 tw-text-[clamp(1.8rem,3vw,2.4rem)] tw-font-bold tw-leading-tight tw-text-ink">Your business. Your account.<br>Your taxi service.</h2>

        <div class="tw-grid tw-grid-cols-1 tw-gap-3 md:tw-grid-cols-3">
          <?php foreach ($bizAccountBenefits as $benefit): ?>
            <div class="tw-h-full tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-4 tw-text-center tw-transition-all tw-duration-300 hover:-tw-translate-y-1 hover:tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] motion-reduce:tw-transition-none lg:tw-p-5">
              <span class="tw-mb-2 tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-full tw-bg-paper tw-text-power">
                <?php pc_biz_icon($benefit['icon']); ?>
              </span>
              <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($benefit['title']) ?></h3>
              <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($benefit['desc']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div>
        <!-- Lightweight illustration of the PowerCabs Business account -- a
             visual mockup in the site's own UI language, not a screenshot. -->
        <div class="tw-mx-auto tw-w-full tw-max-w-[420px] tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-[clamp(1.5rem,3vw,2rem)] tw-shadow-[0_24px_60px_rgba(28,20,16,0.1)]">
          <div class="tw-mb-6 tw-flex tw-items-center tw-justify-between">
            <span class="tw-flex tw-items-center tw-gap-2 tw-font-bold tw-text-ink">
              <img src="<?= $assetPath ?>assets/img/powercabs-horse-icon.png" alt="" width="22" height="22" aria-hidden="true">
              PowerCabs Business
            </span>
            <span class="tw-rounded-full tw-bg-[rgba(25,135,84,0.12)] tw-px-2.5 tw-py-1 tw-text-[0.68rem] tw-font-medium tw-text-[#198754]">Account Active</span>
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
