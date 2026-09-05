<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-20 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div class="tw-order-2 lg:tw-order-1">
        <?php
        $mockupImage = 'driver-ride.jpeg';
        $mockupAlt = 'PowerCabs Driver App screen';
        require __DIR__ . '/../shared/app-mockup.php';
        ?>
      </div>

      <div class="tw-order-1 lg:tw-order-2">
        <h2 class="tw-mb-6 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Behind the Wheel</h2>

        <?php
        $driveSteps = [
          ['n' => 1, 'title' => 'Download the Driver App', 'desc' => 'Download the Driver App from the App Store or Google Play.'],
          ['n' => 2, 'title' => 'Create Your Account', 'desc' => 'Create your account and upload the required documents.'],
          ['n' => 3, 'title' => 'Get Your Sticker', 'desc' => "Once approved, you'll receive your official PowerCabs rooftop branding sticker."],
          ['n' => 4, 'title' => 'Verify Installation', 'desc' => 'Upload a photo of the installed sticker through the app to complete verification.'],
          ['n' => 5, 'title' => 'Start Earning', 'desc' => "After confirmation, you're ready to accept your first ride and start earning."],
        ];
        $totalDriveSteps = count($driveSteps);
        ?>
        <div class="tw-flex tw-flex-col">
          <?php foreach ($driveSteps as $i => $step): ?>
            <?php $isLast = $i === $totalDriveSteps - 1; ?>
            <div class="tw-relative tw-flex tw-gap-4 <?= $isLast ? '' : 'tw-pb-6' ?>">
              <?php if (!$isLast): ?>
                <span class="tw-absolute tw-left-[1.1rem] tw-top-9 tw-bottom-0 tw-w-px tw-bg-black/10" aria-hidden="true"></span>
              <?php endif; ?>
              <span class="tw-relative tw-z-[1] tw-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-paper tw-text-sm tw-font-bold tw-text-power"><?= (int) $step['n'] ?></span>
              <div class="tw-pt-1">
                <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($step['title']) ?></h3>
                <p class="tw-mb-0 tw-text-ink/60"><?= htmlspecialchars($step['desc']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <?php
        // Same store-badge recipe as components/shared/app-download-banner.php.
        $driveBadge =
          'tw-inline-flex tw-w-fit tw-items-center tw-gap-[0.65rem] tw-rounded-lg tw-bg-ink tw-py-[0.4rem] tw-pl-[0.4rem] tw-pr-[1.1rem] tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black focus-visible:tw-bg-black';
        $driveBadgeEyebrow =
          'tw-block tw-text-[0.6rem] tw-uppercase tw-leading-none tw-tracking-[0.02em] tw-text-white/75';
        $driveBadgeTitle = 'tw-block tw-text-[0.95rem] tw-font-bold tw-leading-[1.25] tw-text-white';
        ?>
        <div class="tw-mt-6 tw-flex tw-flex-wrap tw-gap-2">
          <a class="<?= $driveBadge ?>"
            href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.driver&pcampaignid=web_share"
            target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" class="tw-h-[22px] tw-w-[22px] tw-shrink-0" aria-hidden="true">
            <span class="tw-flex tw-flex-col tw-text-left">
              <span class="<?= $driveBadgeEyebrow ?>">Get it on</span>
              <span class="<?= $driveBadgeTitle ?>">Google Play</span>
            </span>
          </a>
          <a class="<?= $driveBadge ?>" href="https://apps.apple.com/us/app/powercabs-driver/id6648774168"
            target="_blank" rel="noopener">
            <svg class="tw-h-[22px] tw-w-[22px] tw-shrink-0 tw-text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.8 1.18-.24 2.31-.93 3.57-.84 1.51.12 2.65.72 3.4 1.8-3.12 1.87-2.38 5.98.48 7.13-.57 1.5-1.31 2.99-2.53 4.08l.01-.01zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/></svg>
            <span class="tw-flex tw-flex-col tw-text-left">
              <span class="<?= $driveBadgeEyebrow ?>">Download on the</span>
              <span class="<?= $driveBadgeTitle ?>">App Store</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
