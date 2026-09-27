<?php
$pageTitle = 'Become a Taxi Driver in Dublin | PowerCabs';
$pageDescription =
  'Drive with PowerCabs -- flexible hours, competitive earnings and 24/7 driver support. Apply through the Driver App and start earning on your own schedule.';
$assetPath = '';

/* The application form no longer posts here. It is eight steps talking to
   /driver-apply, which verifies the email, uploads the documents to Supabase
   Storage, creates the auth account and writes the drivers row -- so the
   four-field POST handler that used to live here is gone with it. env.php
   stays: components on this page still read PC_* config. */
require __DIR__ . '/includes/env.php';

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'Drive';
$heroTitleLight = 'Drive your way.';
$heroTitleBold = 'Build your day.';
// Was three sentences that between them named flexibility, community, safety,
// reliability, customer service, hours, earnings and support -- every one of
// which has its own section below, and most of which the old "Join the
// PowerCabs Family" block then repeated almost word for word. The offer is
// the commission model, so the hero leads with that and lets the stat band
// underneath do the proving.
$heroDescription =
  'Keep more of every fare. No joining fee, no monthly subscription, and 10% commission only on the PowerCabs jobs you actually complete.';
$heroBgImage = 'https://images.pexels.com/photos/37310371/pexels-photo-37310371.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroVariant = 'split';
$heroImageAlt = 'A PowerCabs driver at the wheel of their car';
require __DIR__ . '/components/shared/inner-hero.php';

// The numbers come FIRST, immediately under the hero -- they are the whole
// pitch, and they used to sit three sections down, below the application
// form, where a driver had to commit before seeing the terms.
require __DIR__ . '/components/drive/join-family-stats.php';

require __DIR__ . '/components/drive/driver-frustration.php';
require __DIR__ . '/components/drive/be-your-own-boss.php';
require __DIR__ . '/components/drive/join-family-form.php';
?>

<!-- ============ Onboarding ============ -->
<!-- This block used to be headed "Join the PowerCabs Family" and its copy
     repeated the hero almost word for word (flexible hours / competitive
     earnings / 24/7 support / community that values safety and reliability).
     The onboarding GIF is genuinely useful, so the section stays -- but it
     now does the job the brief gives it, which is to answer "what actually
     happens after I apply", rather than restate the pitch a second time. -->
<section class="tw-pb-16 md:tw-pb-24">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <?php /* Was driver-onboarding.gif, 1.1MB. The same animation as a
                 muted, looping, inline MP4 is 167KB and plays exactly like the
                 GIF did. It is started by initLoopVideos() in main.js only once
                 it nears the viewport -- hence data-src and no autoplay
                 attribute, see that function. The poster is the finished last
                 frame, so wherever it does not play (reduced motion, iOS Low
                 Power Mode, no JS) the complete illustration still shows. The
                 GIF stays in assets/img untouched. role="img" + aria-label keep
                 the description a screen reader got from the GIF's alt. */ ?>
        <div class="<?= $pcImgLandscape ?> tw-rounded-2xl" role="img" aria-label="A PowerCabs driver completing onboarding in the Driver App">
          <video class="<?= $pcImgCover ?>" data-pc-loop-video muted loop playsinline preload="none" aria-hidden="true"
            poster="<?= $assetPath ?>assets/img/vid-covers/driver-onboarding.webp">
            <source data-src="<?= $assetPath ?>assets/vid/driver-onboarding.mp4" type="video/mp4">
          </video>
        </div>
      </div>
      <div>
        <p class="<?= $pcEyebrow ?>">Onboarding</p>
        <h2 class="<?= $pcH2 ?>">Approved and driving in days</h2>
        <p class="tw-mb-6 <?= $pcBody ?> <?= $pcMeasureTight ?>">
          Upload your PSV licence, vehicle documents and insurance in the Driver
          App. Once they are verified you are live &mdash; no branch visit, no
          paperwork queue.
        </p>
        <a class="<?= $pcBtnLink ?>" href="<?= $assetPath ?>/download-our-app">
          Already registered? Get the Driver App
          <svg class="<?= $pcBtnLinkIcon ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
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
/* ============ Scroll Scene ============
 *
 * The Meet & Greet flight-banner pattern, which is the one the client picked
 * out: a full-bleed scene, one subject crossing it as you scroll, and exactly
 * ONE sentence. Placed here because it is the middle of the page -- the break
 * between "what the deal is" above and "how the model compares" below.
 *
 * The subject is inline SVG rather than a photograph: the effect needs a
 * subject with a transparent background that can travel across the backdrop,
 * and every car image in assets/img is a full scene with its own sky in it.
 * An SVG also costs no request and stays sharp at any width.
 *
 * The copy restates the page's published commercial promise (the hero's "no
 * joining fee, no monthly subscription, 10% commission only on jobs you
 * complete") rather than introducing a new one -- a scene at this size would
 * read as a guarantee. */
ob_start(); ?>
<svg viewBox="0 0 640 250" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-h-auto tw-w-full tw-drop-shadow-[0_18px_28px_rgba(0,0,0,0.35)]" aria-hidden="true">
  <!-- greenhouse -->
  <path d="M188 128 L214 74 Q220 60 238 59 L406 59 Q424 60 434 73 L474 128 Z" fill="#1d1d1f"/>
  <path d="M226 121 L246 80 Q249 73 258 73 L314 73 L314 121 Z" fill="#7fb3d9" opacity=".92"/>
  <path d="M330 73 L392 73 Q401 73 406 80 L436 121 L330 121 Z" fill="#7fb3d9" opacity=".92"/>
  <!-- roof sign -->
  <rect x="288" y="42" width="72" height="19" rx="5" fill="#f9b016"/>
  <text x="324" y="56" font-family="Inter,Arial,sans-serif" font-size="12" font-weight="700" fill="#1d1d1f" text-anchor="middle">TAXI</text>
  <!-- body -->
  <path d="M36 186 L36 152 Q36 133 62 128 L188 122 L474 122 L556 137 Q604 146 604 168 L604 186 Q604 194 596 194 L44 194 Q36 194 36 186 Z" fill="#141416"/>
  <path d="M36 168 L604 168 L604 176 L36 176 Z" fill="#000" opacity=".25"/>
  <!-- brand stripe -->
  <rect x="120" y="146" width="150" height="9" rx="4.5" fill="#f97316"/>
  <!-- lamps -->
  <rect x="580" y="144" width="26" height="13" rx="6" fill="#ffe9b0"/>
  <rect x="34" y="146" width="20" height="11" rx="5" fill="#e0453a"/>
  <!-- wheels -->
  <circle cx="163" cy="190" r="46" fill="#17171a"/><circle cx="163" cy="190" r="22" fill="#b9bcc2"/><circle cx="163" cy="190" r="9" fill="#6d7077"/>
  <circle cx="487" cy="190" r="46" fill="#17171a"/><circle cx="487" cy="190" r="22" fill="#b9bcc2"/><circle cx="487" cy="190" r="9" fill="#6d7077"/>
</svg>
<?php $sceneSubject = ob_get_clean();

/* The road is a fixed-height strip at the BOTTOM of the scene, and both the
   car and the copy are positioned against it: the car stands on it, the copy
   sits above it on the light end of the gradient. The first draft centred the
   car and pinned the copy to the very bottom, so the car drove through the
   headline and the headline's ink text landed on the dark tarmac. */
ob_start(); ?>
<div class="tw-relative tw-h-[86px] tw-w-full tw-bg-[#26262b]">
  <div class="tw-absolute tw-inset-x-0 tw-top-[40px] tw-h-[4px] tw-bg-[repeating-linear-gradient(90deg,rgba(255,255,255,0.5)_0_48px,transparent_48px_112px)]"></div>
</div>
<?php $sceneGround = ob_get_clean();

$sceneId = 'pcDriveScene';
$sceneGradient = 'linear-gradient(180deg,#10131c 0%,#2b2338 22%,#7a4a3a 44%,#e08a42 62%,#f7cf98 78%,#fbf8f4 92%,#fbf8f4 100%)';
$sceneSubjectSize = 'tw-w-[clamp(200px,32vw,430px)]';
$sceneSubjectPos = 'tw-bottom-[64px]'; // wheels just onto the tarmac
$sceneAnchor = '0';
$sceneCopyPos = 'top'; // the car owns the bottom band; the copy owns the sky
$sceneTone = 'dark'; // white type on the night end of the gradient
$sceneHeight = 'tw-h-[clamp(420px,46vw,560px)]';
$sceneTitle = 'Drive with PowerCabs.';
$sceneText = 'No joining fee, no monthly subscription — and commission only on the jobs you actually complete.';
require __DIR__ . '/components/shared/scroll-scene.php';
?>
<script src="<?= $assetPath ?>assets/js/components/scroll-scene.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/scroll-scene.js',
) ?>"></script>
<?php

require __DIR__ . '/components/drive/compare-model.php';
require __DIR__ . '/components/drive/preferences.php';
require __DIR__ . '/components/drive/car-earn-more.php';
require __DIR__ . '/components/drive/keep-options-open.php';

/* Right before the FAQ -- a driver scanning for answers meets a person first.
   +353 89 965 4467 is the DRIVER line; the customer line is a different
   number and only appears on /ride. 24/7 is what this page already promises
   ("24/7 driver support", "Real driver support line" in the stats band).
   The WhatsApp action goes to that same driver number, not to the customer
   WhatsApp in the footer, so a driver never lands in the passenger queue. */
$supportEyebrow = 'Driver Support';
$supportHeading = 'Still have a question? Talk to us.';
$supportText =
  'Our driver support team handles registration, documents, payments and anything else that comes up on the road. Real people, based here.';
$supportNumber = '+353 89 965 4467';
$supportTel = '+353899654467';
$supportHours = 'Driver support is available 24/7, every day of the year.';
$supportWhatsapp = 'https://wa.me/353899654467';
require __DIR__ . '/components/shared/support-band.php';
require __DIR__ . '/components/drive/drive-faq.php';
?>

<!-- ============ Driver FAQ Download ============ -->
<section class="tw-px-4 tw-pb-16 sm:tw-px-6 md:tw-pb-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[860px]">
    <div class="tw-rounded-2xl tw-bg-paper tw-p-6 tw-text-center tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] sm:tw-p-8 md:tw-p-11">
      <svg class="tw-mx-auto tw-mb-3 tw-h-9 tw-w-9 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l3-3m0 0l-3-3m3 3h-7.5M6 20.25h12A2.25 2.25 0 0020.25 18V9.75L14.25 3.75H6a2.25 2.25 0 00-2.25 2.25v12A2.25 2.25 0 006 20.25z"/></svg>
      <h3 class="tw-mb-2 tw-text-lg tw-font-bold tw-text-ink">Want the Full Driver FAQ?</h3>
      <p class="tw-mb-6 tw-text-ink/60">Get every answer in one place &mdash; registration, documents, payments and more &mdash; in our complete Driver FAQ guide.</p>
      <?php /* Side by side on a phone too. Wrapped, "Download PDF" dropped to
               its own line under a centred "View PDF" and the pair read as a
               primary action with an afterthought below it -- they are two
               equal ways to get the same file. max-sm trims the pill padding
               from px-6 to px-3.5 and the gap from 3 to 2, which is what makes
               the two fit inside 264px of card at 360px. */ ?>
      <div class="tw-flex tw-flex-nowrap tw-justify-center tw-gap-2 sm:tw-gap-3">
        <a href="<?= $assetPath ?>assets/img/PowerCabs_Driver_FAQ.pdf" target="_blank" rel="noopener" class="<?= $pcBtnPrimary ?> tw-whitespace-nowrap max-sm:tw-px-3.5">
          <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
          View PDF
        </a>
        <a href="<?= $assetPath ?>assets/img/PowerCabs_Driver_FAQ.pdf" download="PowerCabs-Driver-FAQ.pdf" class="tw-inline-flex tw-items-center tw-gap-2 tw-whitespace-nowrap tw-rounded-full tw-border tw-border-solid tw-border-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-ink tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink hover:tw-text-white max-sm:tw-px-3.5">
          <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
          Download PDF
        </a>
      </div>
    </div>
  </div>
</section>

<?php
$bannerCompact = true; // §30: this page already closes with its own CTA.
require __DIR__ . '/components/shared/app-download-banner.php';

$ctaTitle = 'Start earning on better terms.';
$ctaText = 'No joining fee, no monthly subscription, and 10% only on completed PowerCabs jobs.';
// Anchors the existing form panel in join-family-form.php -- id="driveJoinForm".
$ctaPrimary = ['href' => '/drive#driveJoinForm', 'label' => 'Apply to Drive'];
$ctaSecondary = ['href' => '/contact-us', 'label' => 'Ask a Question'];
require __DIR__ . '/components/shared/final-cta.php';

require __DIR__ . '/includes/footer.php';

?>
