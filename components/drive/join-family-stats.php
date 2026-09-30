<?php
$driveStats = [
  ['value' => '€0', 'label' => 'Joining fee'],
  ['value' => '€0', 'label' => 'Monthly subscription'],
  ['value' => '10%', 'label' => 'Completed PowerCabs jobs'],
  ['value' => '€0', 'label' => 'Commission if no job is completed'],
];
?>
<section class="tw-relative tw-z-[2] -tw-mt-9">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-w-full tw-max-w-[920px]">
      <div class="tw-grid tw-grid-cols-2 tw-gap-y-5 tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-px-2 tw-py-3 tw-shadow-[0_20px_45px_rgba(28,20,16,0.12)] sm:tw-grid-cols-4 sm:tw-gap-y-0">
        <?php foreach ($driveStats as $i => $stat): ?>
          <div class="tw-px-3 tw-text-center<?= $i % 2 !== 0
            ? ' tw-border-0 tw-border-l tw-border-solid tw-border-hairline'
            : '' ?><?= $i % 2 === 0
  ? ' sm:tw-border-0' . ($i > 0 ? ' sm:tw-border-l sm:tw-border-solid sm:tw-border-hairline' : '')
  : '' ?>">
            <p class="tw-mb-1 tw-text-[1.6rem] tw-font-bold tw-tracking-[-0.02em] tw-text-ink sm:tw-text-[1.875rem]"><?= htmlspecialchars(
              $stat['value'],
            ) ?></p>
            <p class="tw-mb-0 tw-text-[0.75rem] tw-leading-snug tw-text-muted sm:tw-text-[0.8rem]"><?= htmlspecialchars(
              $stat['label'],
            ) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
