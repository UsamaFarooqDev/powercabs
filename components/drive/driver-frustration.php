<?php
$frustrationPoints = [
    ['icon' => 'fuel', 'title' => 'Fuel', 'desc' => 'Still costs you the same.'],
    ['icon' => 'wrench', 'title' => 'Maintenance', 'desc' => 'Every kilometre has a cost.'],
    ['icon' => 'shield', 'title' => 'Insurance', 'desc' => "Your overhead doesn't disappear."],
    ['icon' => 'clock', 'title' => 'Your time', 'desc' => 'Your working hour has value.'],
];

function pc_frustration_icon(string $icon): void
{
  switch ($icon):
    case 'fuel': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 3.75h9v16.5h-9V3.75zM4.5 9.75h9M8.25 3.75V2.25m6 5.086l2.36 2.36a1.5 1.5 0 01.44 1.061v6.128a1.5 1.5 0 003 0V9.31a3 3 0 00-.879-2.121l-2.371-2.372"/></svg>
    <?php break;
    case 'wrench': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'clock': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <?php break;
  endswitch;
}
?>
<!-- ============ The Driver Frustration ============ -->
<section class="tw-bg-white tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ The Driver Frustration</p>
        <h2 class="tw-mb-3 tw-text-[clamp(1.9rem,3.4vw,2.6rem)] tw-font-bold tw-leading-tight tw-text-ink">Tired of Saver fares?</h2>
        <p class="tw-mb-6 tw-text-[1.05rem] tw-leading-[1.7] tw-text-ink/60">
          You're still paying the same fuel, insurance, maintenance and time --
          even when a technology platform makes the passenger's fare cheaper.
        </p>
        <blockquote class="tw-m-0 tw-border-0 tw-border-l-[3px] tw-border-solid tw-border-power tw-py-1 tw-pl-4 tw-text-xl tw-font-bold tw-leading-snug tw-text-ink">
          &ldquo;Why should my taxi become cheaper just because the platform wants
          to discount the passenger?&rdquo;
        </blockquote>
      </div>

      <div class="tw-grid tw-grid-cols-2 tw-gap-3">
        <?php foreach ($frustrationPoints as $point): ?>
          <div class="tw-h-full tw-rounded-2xl tw-bg-paper-soft tw-p-4 md:tw-p-5">
            <span class="tw-mb-2 tw-block tw-text-power"><?php pc_frustration_icon($point['icon']); ?></span>
            <span class="tw-block tw-font-bold tw-text-ink"><?= htmlspecialchars($point['title']) ?></span>
            <span class="tw-block tw-text-sm tw-text-ink/60"><?= htmlspecialchars($point['desc']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="tw-rounded-2xl tw-bg-ink tw-p-8 tw-text-center md:tw-p-12">
      <h3 class="tw-mb-2 tw-text-[clamp(2rem,5vw,3.2rem)] tw-font-bold tw-uppercase tw-tracking-[-0.01em] tw-text-powerlight">
        No Saver.
      </h3>
      <p class="tw-mb-3 tw-text-xl tw-font-bold tw-text-white">No race to the bottom.</p>
      <p class="tw-mx-auto tw-mb-3 tw-max-w-[56ch] tw-text-white/75">
        PowerCabs is designed around applicable regulated taxi fares rather than
        asking drivers to absorb platform-created Saver discounts.
      </p>
      <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-white/50">*Subject to Irish taxi/SPSV regulations and current terms.</p>
    </div>
  </div>
</section>
