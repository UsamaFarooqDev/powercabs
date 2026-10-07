<?php
$driveSteps = [
  ['title' => 'Download the Driver App', 'desc' => 'From the App Store or Google Play.'],
  ['title' => 'Create your account', 'desc' => 'Upload the required documents.'],
  ['title' => 'Get your sticker', 'desc' => 'Your official PowerCabs rooftop branding, once approved.'],
  ['title' => 'Verify installation', 'desc' => 'Send a photo of the fitted sticker through the app.'],
  ['title' => 'Start earning', 'desc' => 'Accept your first ride.'],
];
?>
<section class="tw-py-16 md:tw-py-24">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2 lg:tw-gap-16">

      <div class="tw-order-2 [&_.pc-phone-screen]:tw-min-h-[520px] lg:tw-order-1">
        <?php
        $mockupImage = 'driver-go-online.png';
        $mockupAlt = 'The PowerCabs app open on a phone, showing a route across Dublin';
        $mockupNotch = true;
        require __DIR__ . '/../shared/app-mockup.php';
        ?>
      </div>

      <div class="tw-order-1 lg:tw-order-2">
        <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Approved and driving in days</h2>
        <p class="<?= $pcBody ?> tw-mb-8 tw-max-w-[48ch]">
          Upload your PSV licence, vehicle documents and insurance in the Driver
          App. Once they are verified you are live &mdash; no branch visit, no
          paperwork queue.
        </p>

        <ul class="tw-m-0 tw-mb-8 tw-list-none tw-border-0 tw-border-b tw-border-solid tw-border-hairline tw-p-0">
          <?php foreach ($driveSteps as $step): ?>
            <li class="tw-flex tw-items-start tw-gap-4 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-py-4">
              <span class="tw-mt-0.5 tw-inline-flex tw-h-6 tw-w-6 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-lg tw-bg-power tw-text-white" aria-hidden="true">
                <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
              </span>
              <span class="tw-min-w-0">
                <span class="tw-block tw-text-[1.0625rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= htmlspecialchars(
                  $step['title'],
                ) ?>:</span>
                <span class="tw-mt-0.5 tw-block tw-text-[0.9375rem] tw-font-medium tw-leading-snug tw-text-muted"><?= htmlspecialchars(
                  $step['desc'],
                ) ?></span>
              </span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>
  </div>
</section>
