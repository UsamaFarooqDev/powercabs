<?php
$pageTitle       = 'Become a Taxi Driver in Dublin | PowerCabs';
$pageDescription = 'Drive with PowerCabs -- flexible hours, competitive earnings and 24/7 driver support. Apply through the Driver App and start earning on your own schedule.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Drive';
$heroTitleLight  = 'Join the';
$heroTitleBold   = 'PowerCabs Family.';
$heroDescription = 'Looking for a flexible and rewarding driving opportunity? Join PowerCabs and become part of a community that values safety, reliability, and excellent customer service. Drivers enjoy flexible working hours, competitive earnings, and 24/7 support to help them succeed.';
$heroBgImage     = 'https://images.pexels.com/photos/5835012/pexels-photo-5835012.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
require __DIR__ . '/components/drive/be-your-own-boss.php';
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
        <a class="pc-underline-cta" href="<?= $assetPath ?>/download-our-app">Already Registered? Get Started</a>
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

<?php
require __DIR__ . '/components/drive/behind-wheel.php';
require __DIR__ . '/components/drive/opportunities.php';
require __DIR__ . '/components/drive/preferences.php';
?>

<!-- ============ FAQ CTA ============ -->
<section class="section-pc text-center">
  <div class="container">
    <h2 class="mb-3">Still Have Questions?</h2>
    <p class="text-muted-pc mx-auto mb-4" style="max-width: 56ch;">Find quick answers to the most common driver questions -- documents, payouts, ratings and more.</p>
    <a class="btn btn-pc-dark px-4" href="<?= $assetPath ?>/faqs">Visit FAQ's</a>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
