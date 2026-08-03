<?php
$pageTitle       = 'Drive with PowerCabs | Join the PowerCabs Family';
$pageDescription = 'Drive with PowerCabs -- flexible hours, competitive earnings and 24/7 driver support. Apply through the Driver App and start earning on your own schedule.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Drive';
$heroTitleLight  = 'Join the';
$heroTitleBold   = 'PowerCabs Family.';
$heroDescription = 'Looking for a flexible and rewarding driving opportunity? Join PowerCabs and become part of a community that values safety, reliability, and excellent customer service. Drivers enjoy flexible working hours, competitive earnings, and 24/7 support to help them succeed.';
$heroBgImage     = 'https://images.pexels.com/photos/5835012/pexels-photo-5835012.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/inner-hero.php';
?>

<!-- ============ Join the Family ============ -->
<section class="section-pc pt-0">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <div class="rounded-4 overflow-hidden">
          <img src="<?= $assetPath ?>assets/img/driver-onboarding.gif" alt="A PowerCabs driver completing onboarding" class="w-100 h-100 object-fit-cover" loading="lazy">
        </div>
      </div>
      <div class="col-lg-6">
        <h2 class="mb-2">Join the PowerCabs Family</h2>
        <p class="text-muted-pc mb-4" style="font-size: 1.12rem;">
          Flexible hours, competitive earnings, and 24/7 support &mdash; join a community that
          values safety, reliability, and your success.
        </p>
        <a class="pc-underline-cta" href="<?= $assetPath ?>/download-app.php">Already Registered? Get Started</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ Why Drive With Us ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <span class="pc-drive-blob pc-drive-blob-orange" aria-hidden="true"></span>
  <span class="pc-drive-blob pc-drive-blob-dark" aria-hidden="true"></span>
  <div class="container position-relative">
    <div class="text-center mb-5">
      <h2 class="mb-0">Everything You Need to Succeed</h2>
    </div>
    <?php
    $driveWhyItems = [
      ['icon' => 'bi-clock-history', 'title' => 'Flexible Hours', 'desc' => 'Choose your own schedule and drive whenever it suits you.'],
      ['icon' => 'bi-cash-stack', 'title' => 'Competitive Earnings', 'desc' => "Earn more with PowerCabs' competitive fare structure."],
      ['icon' => 'bi-people-fill', 'title' => 'Supportive Community', 'desc' => 'Access 24/7 support and resources whenever you need assistance.'],
      ['icon' => 'bi-shield-check', 'title' => 'Safety First', 'desc' => 'Driver safety is a priority through background vetting and regular vehicle inspections.'],
    ];
    ?>
    <div class="row row-cols-2 row-cols-md-4 g-3 g-md-4">
      <?php foreach ($driveWhyItems as $item): ?>
            <div class="col pc-why-item position-relative border-end border-bottom text-center px-4 py-4 py-md-5">
            <h3 class="fs-6 fw-bold mb-2"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ How to Get Started ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <div class="pc-app-showcase position-relative mx-auto" style="max-width: 280px;">
          <div class="pc-phone-frame mx-auto position-relative">
            <div class="pc-phone-screen">
              <img src="<?= $assetPath ?>assets/img/DRIVER-RIDES.jpeg" alt="PowerCabs Driver App screen" class="w-100 h-100" style="object-fit: cover;" loading="lazy">
            </div>
          </div>
        </div>
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
          <a class="pc-store-badge pc-store-badge-lg" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.driver&pcampaignid=web_share" target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" aria-hidden="true">
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow">Get it on</span>
              <span class="pc-store-badge-title">Google Play</span>
            </span>
          </a>
          <a class="pc-store-badge pc-store-badge-lg" href="https://apps.apple.com/us/app/powercabs-driver/id6648774168" target="_blank" rel="noopener">
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

<section class="section-pc text-white position-relative overflow-hidden" style="background: linear-gradient(165deg, #0a0807 0%, #14100c 60%, #0a0807 100%);">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="mx-auto mb-0" style="max-width: 56ch; color: rgba(255, 255, 255, .72);">
        Built for Drivers Who Want More
      </p>
    </div>

    <div class="row row-cols-2 row-cols-md-3 g-4 g-md-0 text-center border-top border-bottom py-4 mb-5" style="border-color: rgba(255, 255, 255, .12) !important;">
      <div class="col py-3 border-end" style="border-color: rgba(255, 255, 255, .12) !important;">
        <p class="display-5 fw-bold text-white mb-1">48hrs</p>
        <p class="small mb-0" style="color: rgba(255, 255, 255, .65);">Fast weekly payouts</p>
      </div>
      <div class="col py-3 border-end" style="border-color: rgba(255, 255, 255, .12) !important;">
        <p class="display-5 fw-bold text-white mb-1">0%</p>
        <p class="small mb-0" style="color: rgba(255, 255, 255, .65);">Surprise fare deductions</p>
      </div>
      <div class="col py-3">
        <p class="display-5 fw-bold text-white mb-1">24/7</p>
        <p class="small mb-0" style="color: rgba(255, 255, 255, .65);">Real driver support line</p>
      </div>
    </div>

    <div class="text-center mb-4">
      <h3 class="text-white fs-4 fw-bold mb-1">Drive Every Ride Type</h3>
      <p class="mb-0" style="color: rgba(255, 255, 255, .6);">One vehicle, eight ways to earn.</p>
    </div>

    <?php
    $driveRideCategories = [
      ['img' => 'Economy.png', 'label' => 'Economy'],
      ['img' => 'Economy-xl.png', 'label' => 'Economy XL'],
      ['img' => 'Limousine.png', 'label' => 'Limousine'],
      ['img' => 'wheelchair-taxi.png', 'label' => 'Wheelchair Taxi'],
      ['img' => 'pet-taxi.png', 'label' => 'Pet Friendly'],
      ['img' => 'courier.png', 'label' => 'Courier / Parcel'],
      ['img' => 'business.png', 'label' => 'Business'],
      ['img' => 'business-xl.png', 'label' => 'Business XL'],
    ];
    ?>
    <div class="row row-cols-2 row-cols-md-4 g-3">
      <?php foreach ($driveRideCategories as $category): ?>
        <div class="col p-1 p-md-4">
          <div class="pc-service-card d-block position-relative overflow-hidden" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
            <img src="<?= $assetPath ?>assets/img/rides-types/<?= $category['img'] ?>" alt="<?= htmlspecialchars($category['label']) ?>" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
            <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
            <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-3" style="padding-top: 2.5rem;">
              <span class="pc-service-card-title d-block fs-5 fw-extrabold mb-0"><?= htmlspecialchars($category['label']) ?></span>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>

<!-- ============ You're In Control ============ -->
<section class="section-pc bg-white">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="mb-2">You're In Control</h2>
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 56ch;">Turn preferences on or off in the Driver App and only receive the bookings that suit you.</p>
    </div>

    <?php
    $driverPreferences = [
      ['title' => 'Accept Card Payments', 'desc' => 'Receive card-paid bookings.', 'img' => 'https://images.pexels.com/photos/9122014/pexels-photo-9122014.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Cash Rides', 'desc' => 'Receive cash bookings.', 'img' => 'https://images.pexels.com/photos/4968385/pexels-photo-4968385.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Delivery Jobs', 'desc' => 'Receive parcel delivery requests.', 'img' => 'https://images.pexels.com/photos/6869065/pexels-photo-6869065.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Pet Friendly', 'desc' => 'Accept passengers travelling with pets.', 'img' => 'https://images.pexels.com/photos/18868680/pexels-photo-18868680.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Wheelchair Passenger', 'desc' => 'Receive accessible ride requests.', 'img' => 'https://images.pexels.com/photos/8127701/pexels-photo-8127701.jpeg?auto=format&fit=crop&w=1200&q=60'],
      ['title' => 'Night Rides', 'desc' => 'Enable late evening bookings.', 'img' => 'https://images.pexels.com/photos/6046594/pexels-photo-6046594.jpeg?auto=format&fit=crop&w=1200&q=60'],
    ];
    ?>
    <div class="row row-cols-2 row-cols-lg-3 g-3 g-md-4">
      <?php foreach ($driverPreferences as $pref): ?>
        <div class="col">
          <div class="pc-service-card d-block position-relative overflow-hidden" style="aspect-ratio: 1; border-radius: var(--pc-radius-lg);">
            <img src="<?= $pref['img'] ?>" alt="<?= htmlspecialchars($pref['title']) ?>" class="pc-service-card-img d-block w-100 h-100 object-fit-cover" loading="lazy">
            <span class="pc-service-card-tint position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
            <span class="pc-service-card-glass position-absolute bottom-0 start-0 end-0 p-3 p-md-4">
              <span class="pc-service-card-title d-block fs-6 fs-md-5 fw-bold mb-1"><?= htmlspecialchars($pref['title']) ?></span>
              <span class="d-block small text-white-50 mb-0"><?= htmlspecialchars($pref['desc']) ?></span>
            </span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ FAQ CTA ============ -->
<section class="section-pc text-center">
  <div class="container">
    <h2 class="mb-3">Still Have Questions?</h2>
    <p class="text-muted-pc mx-auto mb-4" style="max-width: 56ch;">Find quick answers to the most common driver questions -- documents, payouts, ratings and more.</p>
    <a class="btn btn-pc-dark px-4" href="<?= $assetPath ?>/faqs.php">Visit FAQ's</a>
  </div>
</section>

<!-- ============ Download Section ============ -->
<section class="position-relative overflow-hidden text-center text-white" style="padding-block: clamp(3.5rem, 7vw, 5.5rem);">
  <img src="https://images.pexels.com/photos/7144232/pexels-photo-7144232.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: 0;" loading="lazy">
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true" style="background: rgba(10, 7, 5, 0.78); z-index: 0;"></span>
  <div class="container position-relative">
    <h2 class="text-white mb-2">Download the App</h2>
    <p class="mb-4" style="color: rgba(255,255,255,.8);">Download the Driver App from Google Play or the App Store.</p>
    <h3 class="text-white mb-4">Get Ready to Ride Ireland!</h3>
    <a class="btn btn-pc-primary btn-md px-5" href="<?= $assetPath ?>/download-app.php">Download</a>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
