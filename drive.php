<?php
$pageTitle = 'Become a Taxi Driver in Dublin | PowerCabs';
$pageDescription =
  'Drive with PowerCabs -- flexible hours, competitive earnings and 24/7 driver support. Apply through the Driver App and start earning on your own schedule.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$driveFormStatus = null;
$driveFormError = '';
$driveOld = ['name' => '', 'mobile' => '', 'email' => '', 'licence' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($driveOld as $key => $default) {
    $driveOld[$key] = trim($_POST[$key] ?? '');
  }

  if (
    $driveOld['name'] === '' ||
    $driveOld['mobile'] === '' ||
    $driveOld['email'] === '' ||
    $driveOld['licence'] === ''
  ) {
    $driveFormStatus = 'error';
    $driveFormError = 'Please fill in all required fields.';
  } elseif (!filter_var($driveOld['email'], FILTER_VALIDATE_EMAIL)) {
    $driveFormStatus = 'error';
    $driveFormError = 'Please enter a valid email address.';
  } else {
    $body =
      "New PowerCabs driver application from the Drive page.\n\n" .
      "Name: {$driveOld['name']}\n" .
      "Mobile: {$driveOld['mobile']}\n" .
      "Email: {$driveOld['email']}\n" .
      "SPSV / Driver Licence: {$driveOld['licence']}\n";

    $result = pc_send_mail('Driver application: ' . $driveOld['name'], $body, [
      'name' => $driveOld['name'],
      'email' => $driveOld['email'],
    ]);

    if ($result['success']) {
      $driveFormStatus = 'success';
      foreach ($driveOld as $key => $default) {
        $driveOld[$key] = '';
      }
    } else {
      $driveFormStatus = 'error';
      $driveFormError = 'Sorry, something went wrong sending your application. Please try again or call us directly.';
    }
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Drive';
$heroTitleLight = 'Join the';
$heroTitleBold = 'PowerCabs Family.';
$heroDescription =
  'Looking for a flexible and rewarding driving opportunity? Join PowerCabs and become part of a community that values safety, reliability, and excellent customer service. Drivers enjoy flexible working hours, competitive earnings, and 24/7 support to help them succeed.';
$heroBgImage = 'https://images.pexels.com/photos/37310371/pexels-photo-37310371.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
require __DIR__ . '/components/drive/be-your-own-boss.php';
require __DIR__ . '/components/drive/join-family-form.php';
require __DIR__ . '/components/drive/join-family-stats.php';
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
        <a class="pc-underline-cta d-inline-block text-decoration-none" href="<?= $assetPath ?>/download-our-app">Already Registered? Get Started</a>
      </div>
    </div>
  </div>
</section>

<?php require __DIR__ . '/components/drive/driver-frustration.php'; ?>

<div style="background: linear-gradient(180deg, #ffffff 0%, var(--pc-cream-soft) 15%, var(--pc-peach) 45%, var(--pc-cream-soft) 80%, var(--pc-cream-soft) 100%);">
  <?php
  require __DIR__ . '/components/drive/behind-wheel.php';
  require __DIR__ . '/components/drive/opportunities.php';
  ?>
</div>

<?php
require __DIR__ . '/components/drive/compare-model.php';
require __DIR__ . '/components/drive/preferences.php';
require __DIR__ . '/components/drive/car-earn-more.php';
require __DIR__ . '/components/drive/keep-options-open.php';
require __DIR__ . '/components/drive/drive-faq.php';
?>

<!-- ============ Driver FAQ Download ============ -->
<section class="section-pc pt-0">
  <div class="container" style="max-width: 860px;">
    <div class="rounded-4 p-4 p-md-5 text-center" style="background: var(--pc-cream); box-shadow: var(--pc-shadow-sm);">
      <i class="bi bi-file-earmark-pdf-fill fs-1 mb-3 d-block" style="color: var(--pc-orange);" aria-hidden="true"></i>
      <h3 class="fs-5 fw-bold mb-2">Want the Full Driver FAQ?</h3>
      <p class="text-muted-pc mb-4">Get every answer in one place &mdash; registration, documents, payments and more &mdash; in our complete Driver FAQ guide.</p>
      <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="<?= $assetPath ?>assets/img/PowerCabs_Driver_FAQ.pdf" target="_blank" rel="noopener" class="btn btn-pc-primary px-4 d-inline-flex align-items-center gap-2">
          <i class="bi bi-eye-fill" aria-hidden="true"></i> View PDF
        </a>
        <a href="<?= $assetPath ?>assets/img/PowerCabs_Driver_FAQ.pdf" download="PowerCabs-Driver-FAQ.pdf" class="btn btn-outline-dark px-4 d-inline-flex align-items-center gap-2">
          <i class="bi bi-download" aria-hidden="true"></i> Download PDF
        </a>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
