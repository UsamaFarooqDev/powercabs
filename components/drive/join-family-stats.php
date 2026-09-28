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
<?php /* The padding moves to $pcContainer so this badge lines up with the
         sections above and below it. It was px-4/sm:px-6/lg:px-8, the old
         scale, which puts its edge at x=60 while the rest of /drive sits at
         64. The inner max-w-[1200px] stays: this row is deliberately narrower
         than the container, and that is a composition choice rather than a
         second container. */ ?>
<section class="tw-relative tw-z-[2] -tw-mt-9">
  <div class="<?= $pcContainer ?>">
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
  </div>
</section>
