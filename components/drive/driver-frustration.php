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
      <svg class="tw-h-[1.375rem] tw-w-[1.375rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 3.75h9v16.5h-9V3.75zM4.5 9.75h9M8.25 3.75V2.25m6 5.086l2.36 2.36a1.5 1.5 0 01.44 1.061v6.128a1.5 1.5 0 003 0V9.31a3 3 0 00-.879-2.121l-2.371-2.372"/></svg>
    <?php break;
    case 'wrench': ?>
      <svg class="tw-h-[1.375rem] tw-w-[1.375rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="tw-h-[1.375rem] tw-w-[1.375rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'clock': ?>
      <svg class="tw-h-[1.375rem] tw-w-[1.375rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <?php break;
  endswitch;
}
?>
<!-- ============ The Driver Frustration ============ -->
<section class="<?= $pcSurfaceWhite ?> tw-py-16 md:tw-py-24">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-start tw-gap-x-12 tw-gap-y-8 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-5">
        <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">The Driver Frustration</p>
        <h2 class="<?= pc_mb($pcH2, 'tw-mb-4') ?>">Tired of Saver fares?</h2>
        <p class="<?= $pcBody ?> tw-mb-0 tw-max-w-[46ch]">
          You're still paying the same fuel, insurance, maintenance and time &mdash;
          even when a technology platform makes the passenger's fare cheaper.
        </p>
      </div>

      <figure class="tw-m-0 lg:tw-col-span-7 lg:tw-pt-1">
        <?php /* aria-hidden: the mark is punctuation the <blockquote> already
                 carries semantically, and read aloud it is just noise. */ ?>
        <span class="tw-mb-[-0.3em] tw-block tw-text-[clamp(3rem,5.5vw,4.25rem)] tw-font-bold tw-leading-none tw-text-power/35" aria-hidden="true">&ldquo;</span>
        <blockquote class="tw-m-0 tw-p-0">
          <p class="tw-mb-0 tw-text-[clamp(1.375rem,2.5vw,1.9375rem)] tw-font-semibold tw-leading-[1.35] tw-tracking-[-0.015em] tw-text-ink">
            Why should my taxi become cheaper just because the platform wants
            to discount the passenger?
          </p>
        </blockquote>
      </figure>
    </div>

    <div class="tw-mt-12 tw-grid tw-grid-cols-2 tw-gap-x-6 tw-gap-y-9 sm:tw-grid-cols-4 sm:tw-gap-x-0 md:tw-mt-16">
      <?php foreach ($frustrationPoints as $i => $point): ?>
        <div class="sm:tw-px-7 sm:first:tw-pl-0 sm:last:tw-pr-0<?= $i > 0
          ? ' sm:tw-border-0 sm:tw-border-l sm:tw-border-solid sm:tw-border-hairline'
          : '' ?>">
          <span class="tw-mb-3 tw-block tw-text-power"><?php pc_frustration_icon($point['icon']); ?></span>
          <h3 class="tw-mb-1 tw-text-[1.0625rem] tw-font-bold tw-leading-snug tw-text-ink"><?= htmlspecialchars(
            $point['title'],
          ) ?></h3>
          <p class="<?= $pcBodySm ?> tw-mb-0"><?= htmlspecialchars($point['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
