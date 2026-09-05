<?php
$driverPerks = [
  ['icon' => 'clock', 'label' => 'Pay Per Hour'],
  ['icon' => 'megaphone', 'label' => 'Advertise and Earn'],
  ['icon' => 'route', 'label' => 'Long Trips'],
  ['icon' => 'headset', 'label' => 'Irish Support'],
  ['icon' => 'bolt', 'label' => 'Fast Onboarding'],
  ['icon' => 'paint', 'label' => 'Branding Opportunity'],
  ['icon' => 'percent', 'label' => 'Only 10% Commission'],
  ['icon' => 'wallet', 'label' => 'No Membership Fee'],
];

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
<section class="tw-relative tw-overflow-hidden tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-20 lg:tw-px-8">
  <span class="tw-pointer-events-none tw-absolute tw-right-[-9rem] tw-top-16 tw-h-72 tw-w-72 tw-rounded-full tw-bg-[radial-gradient(circle,rgba(251,157,69,0.3),transparent_70%)] tw-blur-[55px]" aria-hidden="true"></span>
  <span class="tw-pointer-events-none tw-absolute tw-bottom-20 tw-left-[-9rem] tw-h-80 tw-w-80 tw-rounded-full tw-bg-[radial-gradient(circle,rgba(68,91,138,0.32),transparent_70%)] tw-blur-[55px]" aria-hidden="true"></span>

  <div class="tw-relative tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-max-w-[46rem]">
      <h2 class="tw-mb-3 tw-text-[clamp(2rem,4vw,3rem)] tw-font-bold tw-leading-[1.12] tw-tracking-[-0.01em] tw-text-ink">
        Be Your Real Boss &mdash; Not Just on Paper.
      </h2>
      <p class="tw-mb-8 tw-max-w-[46ch] tw-text-xl tw-text-ink/60">
        Flexible earning. Zero app charges for usage.
      </p>
      <div class="tw-mb-10 tw-flex tw-flex-wrap tw-gap-2.5">
        <?php foreach ($driverPerks as $perk): ?>
          <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-colors tw-duration-200 hover:tw-border-power/25">
            <span class="tw-text-power"><?php pc_drive_icon($perk['icon']); ?></span>
            <?= htmlspecialchars($perk['label']) ?>
          </span>
        <?php endforeach; ?>
      </div>
      <a class="tw-inline-flex tw-items-center tw-gap-2 tw-whitespace-nowrap tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]" href="<?= $assetPath ?>/ambassador-programme">
        <span>Explore Ambassador Programme</span>
        <?php pc_drive_icon('chevron', 'tw-hidden tw-h-3.5 tw-w-3.5 sm:tw-inline-block'); ?>
      </a>
    </div>
  </div>
</section>
