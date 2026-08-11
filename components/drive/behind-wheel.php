<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <?php
        $mockupImage = 'driver-ride.jpeg';
        $mockupAlt = 'PowerCabs Driver App screen';
        require __DIR__ . '/../shared/app-mockup.php';
        ?>
      </div>

      <div class="col-lg-6">
        <h2 class="mb-4">Behind the Wheel</h2>

        <?php
        $driveSteps = [
          ['n' => 1, 'title' => 'Download the Driver App', 'desc' => 'Download the Driver App from the App Store or Google Play.'],
          ['n' => 2, 'title' => 'Create Your Account', 'desc' => 'Create your account and upload the required documents.'],
          ['n' => 3, 'title' => 'Get Your Sticker', 'desc' => "Once approved, you'll receive your official PowerCabs rooftop branding sticker."],
          ['n' => 4, 'title' => 'Verify Installation', 'desc' => 'Upload a photo of the installed sticker through the app to complete verification.'],
          ['n' => 5, 'title' => 'Start Earning', "desc" => "After confirmation, you're ready to accept your first ride and start earning."],
        ];
        $totalDriveSteps = count($driveSteps);
        ?>
        <?php foreach ($driveSteps as $i => $step): ?>
          <?php $isLast = $i === $totalDriveSteps - 1; ?>
          <div class="d-flex">
            <div class="<?= $isLast ? 'pb-0' : 'pb-4' ?> pt-1">
              <h3 class="fs-6 fw-bold mb-1"><?= htmlspecialchars($step['title']) ?></h3>
              <p class="text-muted-pc mb-0"><?= htmlspecialchars($step['desc']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>


        <div class="d-flex flex-wrap gap-2 mt-4 mb-4">
          <a class="pc-store-badge pc-store-badge-lg"
            href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.driver&pcampaignid=web_share"
            target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" aria-hidden="true">
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow">Get it on</span>
              <span class="pc-store-badge-title">Google Play</span>
            </span>
          </a>
          <a class="pc-store-badge pc-store-badge-lg" href="https://apps.apple.com/us/app/powercabs-driver/id6648774168"
            target="_blank" rel="noopener">
            <i class="bi bi-apple text-white fs-5" aria-hidden="true"></i>
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow">Download on the</span>
              <span class="pc-store-badge-title">App Store</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>