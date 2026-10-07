<?php
$pageTitle = 'Become a Taxi Driver in Dublin | PowerCabs';
$pageDescription =
  'Drive with PowerCabs -- flexible hours, competitive earnings and 24/7 driver support. Apply through the Driver App and start earning on your own schedule.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/header.php';

$heroEyebrow = 'Drive';
$heroTitleLight = 'Drive your way.';
$heroTitleBold = 'Build your day.';
$heroLead = 'You work hard to keep your car on the road. You should have a platform that respects that.';
$heroDescription =
  "With PowerCabs you pay 10% commission only on the PowerCabs trips you complete \u{2014} no joining fee, no monthly subscription, and nothing at all when you don't get a job.";
require __DIR__ . '/components/drive/hero.php';
require __DIR__ . '/components/drive/be-your-own-boss.php';
require __DIR__ . '/components/drive/join-family-stats.php';
require __DIR__ . '/components/drive/preferences.php';
require __DIR__ . '/components/drive/behind-wheel.php';
?>

<?php
require __DIR__ . '/components/drive/compare-model.php';
require __DIR__ . '/components/drive/car-earn-more.php';

/* Straight after the earnings argument: the page has just said what a driver
   keeps, and the obvious next question is where the work comes from in the
   first place. paper-soft here sits between car-earn-more's plain surface and
   the dark support band below, so no two adjacent sections share a fill. */
require __DIR__ . '/components/shared/booking-sources.php';

$supportEyebrow = 'Driver Support';
$supportHeading = 'Still have a question? Talk to us.';
$supportText =
  'Our driver support team handles registration, documents, payments and anything else that comes up on the road. Real people, based here.';
$supportNumber = '+353 89 965 4467';
$supportTel = '+353899654467';
$supportHours = 'Driver support is available 24/7, every day of the year.';
$supportWhatsapp = 'https://wa.me/353899654467';
/* a driver at the wheel -- this band is the DRIVER line. The band stays dark; this only replaces the flat fill behind
   the scrim. See components/shared/support-band.php. */
$supportImage = 'https://images.pexels.com/photos/33493503/pexels-photo-33493503.jpeg?auto=compress&cs=tinysrgb&w=1600';
require __DIR__ . '/components/shared/support-band.php';
require __DIR__ . '/components/drive/drive-faq.php';
?>

<section class="tw-pb-16 md:tw-pb-24">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-w-full tw-max-w-[860px]">
      <div class="tw-rounded-2xl tw-bg-paper tw-p-6 tw-text-center tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] sm:tw-p-8 md:tw-p-11">
        <svg class="tw-mx-auto tw-mb-3 tw-h-9 tw-w-9 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l3-3m0 0l-3-3m3 3h-7.5M6 20.25h12A2.25 2.25 0 0020.25 18V9.75L14.25 3.75H6a2.25 2.25 0 00-2.25 2.25v12A2.25 2.25 0 006 20.25z"/></svg>
        <h3 class="tw-mb-2 tw-text-lg tw-font-bold tw-text-ink">Want the Full Driver FAQ?</h3>
        <p class="tw-mb-6 tw-text-ink/60">Get every answer in one place &mdash; registration, documents, payments and more &mdash; in our complete Driver FAQ guide.</p>
        <div class="tw-flex tw-flex-nowrap tw-justify-center tw-gap-2 sm:tw-gap-3">
          <a href="<?= $assetPath ?>doc/PowerCabs_Driver_FAQ.pdf" target="_blank" rel="noopener" class="<?= $pcBtnPrimary ?> tw-whitespace-nowrap max-sm:tw-px-3.5">
            <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            View PDF
          </a>
          <a href="<?= $assetPath ?>doc/PowerCabs_Driver_FAQ.pdf" download="PowerCabs-Driver-FAQ.pdf" class="tw-inline-flex tw-items-center tw-gap-2 tw-whitespace-nowrap tw-rounded-full tw-border tw-border-solid tw-border-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-ink tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink hover:tw-text-white max-sm:tw-px-3.5">
            <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Download PDF
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php

$ctaTitle = 'Start earning on better terms.';
$ctaText = 'No joining fee, no monthly subscription, and 10% only on completed PowerCabs jobs.';
// Anchors the existing form panel in join-family-form.php -- id="driveJoinForm".
$ctaPrimary = ['href' => '/drive#driveJoinForm', 'label' => 'Apply to Drive'];
$ctaSecondary = ['href' => '/contact-us', 'label' => 'Ask a Question'];
$bannerCompact = true; // §30: this page already closes with its own CTA.
require __DIR__ . '/components/shared/app-download-banner.php';

require __DIR__ . '/includes/footer.php';

?>
