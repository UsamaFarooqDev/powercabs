<?php
$driveStats = [
  ['value' => '€0', 'label' => 'Joining fee'],
  ['value' => '€0', 'label' => 'Monthly subscription'],
  ['value' => '10%', 'label' => 'Completed PowerCabs jobs'],
  ['value' => '€0', 'label' => 'Commission if no job is completed'],
  ['value' => '150', 'label' => 'Drivers Joined'],
  ['value' => '230', 'label' => 'Customers'],
  ['value' => '33', 'label' => 'Businesses Joined'],
]; ?>
<!-- ============ Stats badge ============ -->
<section class="tw-relative tw-z-[2] -tw-mt-9 tw-px-4 sm:tw-px-6 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1200px]">
    <div class="tw-flex tw-flex-wrap tw-justify-center tw-gap-y-2 tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-px-2 tw-py-2 tw-shadow-[0_20px_45px_rgba(28,20,16,0.12)]">
      <?php foreach ($driveStats as $stat): ?>
        <div class="tw-min-w-[150px] tw-max-w-[190px] tw-flex-1 tw-px-3 tw-py-3 tw-text-center">
          <p class="tw-mb-1 tw-text-2xl tw-font-bold tw-tracking-[-0.02em] tw-text-ink"><?= htmlspecialchars(
            $stat['value'],
          ) ?></p>
          <p class="tw-mb-0 tw-text-[0.74rem] tw-text-ink/60"><?= htmlspecialchars($stat['label']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
