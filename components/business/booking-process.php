<?php
$businessAccountBenefits = [
  ['icon' => 'bolt', 'title' => 'Priority Booking'],
  ['icon' => 'receipt', 'title' => 'Monthly Billing'],
  ['icon' => 'people', 'title' => 'Multiple Users'],
  ['icon' => 'history', 'title' => 'Ride History'],
  ['icon' => 'headset', 'title' => 'Corporate Support'],
];

function pc_biz_process_icon(string $icon): void
{
  switch ($icon):
    case 'bolt': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'receipt': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM14.25 9h.008v.008h-.008V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
    <?php break;
    case 'people': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
    <?php break;
    case 'history': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <?php break;
    case 'headset': ?>
      <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 13.5v-1.75a7.5 7.5 0 0115 0v1.75M4.5 13.5a1.75 1.75 0 00-1.75 1.75v1a1.75 1.75 0 001.75 1.75h.75a1 1 0 001-1v-3.5a1 1 0 00-1-1h-.75zm15 0a1.75 1.75 0 011.75 1.75v1a1.75 1.75 0 01-1.75 1.75h-.75a1 1 0 01-1-1v-3.5a1 1 0 011-1h.75zM18 18v.75a2.25 2.25 0 01-2.25 2.25h-2.25"/></svg>
    <?php break;
  endswitch;
}
?>
<section class="tw-scroll-mt-24 tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8" id="business-booking-form">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mx-auto tw-mb-12 tw-max-w-[52rem] tw-text-center">
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">How to Book Our Business Rides</h2>
      <p class="tw-mb-8 tw-text-ink/60">
        Open a PowerCabs Business Account in minutes and give your team a faster,
        simpler way to travel -- booked through the same app, billed to one account.
      </p>

      <div class="tw-grid tw-grid-cols-2 tw-gap-6 md:tw-grid-cols-5">
        <?php foreach ($businessAccountBenefits as $benefit): ?>
          <div class="tw-flex tw-flex-col tw-items-center tw-gap-2">
            <span class="tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-full tw-bg-paper tw-text-power">
              <?php pc_biz_process_icon($benefit['icon']); ?>
            </span>
            <span class="tw-text-sm tw-font-semibold tw-text-ink"><?= htmlspecialchars($benefit['title']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <?php
          $mockupImage = 'business-account.jpeg';
          $mockupAlt   = 'PowerCabs app screen for booking a business ride';
          $mockupNotch = true;
          require __DIR__ . '/../shared/app-mockup.php';
        ?>
      </div>

      <div>
        <?php require __DIR__ . '/business-account-form.php'; ?>
      </div>
    </div>
  </div>
</section>
