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
require __DIR__ . '/components/drive/driver-frustration.php';
require __DIR__ . '/components/drive/be-your-own-boss.php';
require __DIR__ . '/components/drive/join-family-form.php';
require __DIR__ . '/components/drive/join-family-stats.php';
?>

<!-- ============ Join the Family ============ -->
<section class="tw-px-4 tw-pb-16 sm:tw-px-6 md:tw-pb-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <div class="tw-aspect-[4/3] tw-overflow-hidden tw-rounded-2xl">
          <img src="<?= $assetPath ?>assets/img/driver-onboarding.gif" alt="A PowerCabs driver completing onboarding" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
        </div>
      </div>
      <div>
        <h2 class="tw-mb-2 tw-text-2xl tw-font-bold tw-text-ink md:tw-text-3xl">Join the PowerCabs Family</h2>
        <p class="tw-mb-4 tw-text-[1.12rem] tw-text-ink/60">
          Flexible hours, competitive earnings, and 24/7 support &mdash; join a community that
          values safety, reliability, and your success.
        </p>
        <a class="tw-group tw-relative tw-inline-block tw-border-0 tw-border-b-2 tw-border-solid tw-border-black/20 tw-py-1.5 tw-font-medium tw-text-ink tw-no-underline" href="<?= $assetPath ?>/download-our-app">
          Already Registered? Get Started
          <span class="tw-absolute tw-inset-x-0 tw-bottom-[-2px] tw-h-px tw-origin-left tw-scale-x-0 tw-bg-ink tw-transition-transform tw-duration-300 group-hover:tw-scale-x-100 motion-reduce:tw-transition-none" aria-hidden="true"></span>
        </a>
      </div>
    </div>
  </div>
</section>

<div class="tw-bg-[linear-gradient(180deg,#ffffff_0%,#f9f4ed_15%,#fbe6d4_45%,#f9f4ed_80%,#f9f4ed_100%)]">
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
<section class="tw-px-4 tw-pb-16 sm:tw-px-6 md:tw-pb-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[860px]">
    <div class="tw-rounded-2xl tw-bg-paper tw-p-8 tw-text-center tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] md:tw-p-11">
      <svg class="tw-mx-auto tw-mb-3 tw-h-9 tw-w-9 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l3-3m0 0l-3-3m3 3h-7.5M6 20.25h12A2.25 2.25 0 0020.25 18V9.75L14.25 3.75H6a2.25 2.25 0 00-2.25 2.25v12A2.25 2.25 0 006 20.25z"/></svg>
      <h3 class="tw-mb-2 tw-text-lg tw-font-bold tw-text-ink">Want the Full Driver FAQ?</h3>
      <p class="tw-mb-6 tw-text-ink/60">Get every answer in one place &mdash; registration, documents, payments and more &mdash; in our complete Driver FAQ guide.</p>
      <div class="tw-flex tw-flex-wrap tw-justify-center tw-gap-3">
        <a href="<?= $assetPath ?>assets/img/PowerCabs_Driver_FAQ.pdf" target="_blank" rel="noopener" class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]">
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          View PDF
        </a>
        <a href="<?= $assetPath ?>assets/img/PowerCabs_Driver_FAQ.pdf" download="PowerCabs-Driver-FAQ.pdf" class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-ink tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink hover:tw-text-white">
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
          Download PDF
        </a>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
