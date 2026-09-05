<?php
$pageTitle = 'FAQs | PowerCabs';
$pageDescription =
  'Answers to common questions for PowerCabs passengers and drivers -- booking, payments, tracking, documents, earnings and more.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$passengerFaqs = [
  [
    'q' => 'How do I book a ride with PowerCabs?',
    'a' =>
      'Open the PowerCabs app, enter your destination, select your preferred ride type, confirm your pickup location, and tap Confirm Now.',
  ],
  [
    'q' => 'How can I track my driver?',
    'a' =>
      'You can track your driver in real time from the app, including their live location, vehicle details, and estimated arrival time.',
  ],
  [
    'q' => "What should I do if I can't find my driver?",
    'a' => 'Verify your pickup location and contact the driver using the in-app call or messaging feature.',
  ],
  [
    'q' => 'How do I pay for my ride?',
    'a' =>
      'Your saved payment method is charged automatically after the trip. Payment methods can be managed from the app.',
  ],
  [
    'q' => 'Can I rate or tip my driver?',
    'a' => 'Yes. After every completed ride, you can rate your driver and leave a tip.',
  ],
  [
    'q' => 'What should I do if I experience an issue during my ride?',
    'a' =>
      'Report the issue through Profile &rarr; Settings &rarr; Get in Touch, and our support team will assist you.',
  ],
  [
    'q' => 'I lost an item during my trip. What should I do?',
    'a' => 'Contact your driver first. If unsuccessful, submit a Lost Item request through the Contact page.',
  ],
  [
    'q' => 'What if my driver took a poor route?',
    'a' => 'Contact PowerCabs support. Routes may vary because of traffic, road closures, or other conditions.',
  ],
  [
    'q' => 'How is my fare calculated?',
    'a' =>
      'Fares follow NTA regulations and are calculated based on time, distance, traffic, and ride type. A detailed receipt is emailed after your trip.',
  ],
];

$driverFaqs = [
  [
    'q' => 'How do I become a PowerCabs driver?',
    'a' => 'Download the Driver App, complete registration, upload your documents, and wait for approval.',
  ],
  [
    'q' => 'What documents are required?',
    'a' => 'SPSV Licence, Suitability Certificate, Commercial Insurance, and valid Road Tax.',
  ],
  [
    'q' => 'How do I get paid?',
    'a' =>
      'Provide your IBAN during registration. Earnings are transferred weekly and can be viewed in Recent Transactions.',
  ],
  ['q' => 'Can I choose my own working hours?', 'a' => 'Yes. Drive whenever you want with complete flexibility.'],
  [
    'q' => 'What happens if a passenger cancels?',
    'a' =>
      "If you've already started driving to the pickup location, you may receive a cancellation fee depending on eligibility.",
  ],
  ['q' => 'How do I handle lost property?', 'a' => 'Contact the passenger or notify PowerCabs Support immediately.'],
  [
    'q' => 'What if I encounter an issue during a ride?',
    'a' => 'PowerCabs offers 24/7 Driver Support for ride-related assistance.',
  ],
  [
    'q' => 'How can I improve my rating?',
    'a' => 'Deliver excellent customer service, avoid unnecessary cancellations, and complete more trips.',
  ],
  [
    'q' => 'Are bonuses available?',
    'a' => 'Yes. Bonuses and promotions are available based on completed trips and peak-hour driving.',
  ],
  [
    'q' => 'How do I delete my account?',
    'a' => 'Navigate to Settings &rarr; Account Settings &rarr; Delete Account, or contact support.',
  ],
  [
    'q' => 'How do I request deletion of my personal data?',
    'a' => 'Submit your request through the Driver App or contact support.',
  ],
  [
    'q' => 'How can I request a copy of my data?',
    'a' => 'Request your personal data through the Driver App or Support.',
  ],
  [
    'q' => 'How do I upload my Driving Licence and ID?',
    'a' => 'Go to Profile Settings &rarr; Upload Documents and upload clear images.',
  ],
  [
    'q' => 'How do I update my phone number?',
    'a' => 'Open Profile Settings &rarr; Edit Phone Number, then verify your new number.',
  ],
  [
    'q' => 'Why are my documents rejected?',
    'a' => 'Documents may be blurry, expired, incomplete, or missing required information.',
  ],
];

$riderTutorials = [
  ['file' => 'order-booking.mp4', 'label' => 'Order Booking'],
  ['file' => 'ride-tracking.mp4', 'label' => 'Order Tracking'],
  ['file' => 'payment-method.mp4', 'label' => 'Payment'],
  ['file' => 'complete-video.mp4', 'label' => 'Complete Guide'],
];

$driverTutorials = [
  ['file' => 'sign-up-driver.mp4', 'label' => 'Sign Up as a Driver'],
  ['file' => 'accept-trips.mp4', 'label' => 'Accept Trips'],
  ['file' => 'pickup-ride.mp4', 'label' => 'Pickup &amp; Ride'],
  ['file' => 'final-completion.mp4', 'label' => 'Trip Completion'],
];

$heroEyebrow = '/ Got Questions?';
$heroTitleLight = 'Everything You';
$heroTitleBold = 'Need to Know.';
$heroDescription =
  "Whether you're booking a ride or driving with us, find quick answers to the most common questions from passengers and drivers alike.";
$heroBgImage = 'https://images.pexels.com/photos/36507933/pexels-photo-36507933.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'FAQs';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<?php
// Canonical PowerCabs pill-toggle -- reproduces Bootstrap's .btn-check +
// .btn sibling-selector trick with the has-[:checked] variant instead.
$audienceToggleClass = 'tw-inline-flex tw-cursor-pointer tw-items-center tw-rounded-full tw-border tw-border-solid tw-border-ink/20 tw-px-5 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink tw-transition-colors tw-duration-200 has-[:checked]:tw-border-power has-[:checked]:tw-bg-power has-[:checked]:tw-text-white';
?>

<!-- ============ Demo Video ============ -->
<section class="tw-px-4 tw-py-16 tw-text-center sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ See It In Action</p>
    <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Watch How PowerCabs Works</h2>
    <p class="tw-mx-auto tw-mb-8 tw-max-w-[56ch] tw-text-ink/60">
      From booking to drop-off, see just how simple getting around with PowerCabs really is.
    </p>

    <div class="tw-relative tw-mx-auto tw-aspect-[16/8] tw-w-full tw-max-w-[900px] tw-overflow-hidden tw-rounded-2xl tw-shadow-[0_24px_60px_rgba(28,20,16,0.15)]">
      <img src="<?= $assetPath ?>assets/img/service-city-tour.jpg" alt="" aria-hidden="true" class="tw-h-full tw-w-full tw-object-cover">
      <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-ink-soft/[0.45]" aria-hidden="true"></span>
      <button type="button" class="tw-absolute tw-left-1/2 tw-top-1/2 tw-flex tw-h-20 tw-w-20 -tw-translate-x-1/2 -tw-translate-y-1/2 tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-powerlight tw-text-white tw-shadow-[0_12px_28px_rgba(255,122,0,0.4)] tw-transition tw-duration-200 hover:tw-scale-105 hover:tw-bg-powerdark motion-reduce:tw-transition-none" aria-label="Play demo video">
        <svg class="tw-h-8 tw-w-8" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
      </button>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[860px]">
    <div class="tw-mb-10 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Frequently Asked Questions</p>
      <h2 class="tw-mb-6 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Passenger &amp; Driver FAQs</h2>

      <!-- Bare radio + has-checked label: pcInitFaqs() in faqs.js keeps
           driving this via getElementById/.checked, unchanged -- only the
           visual toggle styling moved to Tailwind. -->
      <div class="tw-inline-flex tw-flex-wrap tw-justify-center tw-gap-2">
        <label class="<?= $audienceToggleClass ?>" for="faqAudiencePassenger">
          <input type="radio" class="tw-sr-only" name="faqAudience" id="faqAudiencePassenger" autocomplete="off" checked>
          Passenger
        </label>
        <label class="<?= $audienceToggleClass ?>" for="faqAudienceDriver">
          <input type="radio" class="tw-sr-only" name="faqAudience" id="faqAudienceDriver" autocomplete="off">
          Driver
        </label>
      </div>
    </div>

    <!-- pcInitFaqs() swaps the two panels by toggling tw-hidden plus the
         shared fade-in animation. Each accordion item is driven by the
         collapse helper in assets/js/components/ui.js -- same
         data-pc-collapse contract as components/shared/faq-accordion.php. -->
    <div class="tw-flex tw-flex-col tw-gap-3" id="passengerFaqAccordion">
      <?php foreach ($passengerFaqs as $i => $item): ?>
        <div class="tw-overflow-hidden tw-rounded-xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white">
          <h3 class="tw-m-0">
            <button class="tw-group tw-flex tw-w-full tw-appearance-none tw-items-center tw-justify-between tw-gap-4 tw-border-0 tw-bg-transparent tw-px-5 tw-py-4 tw-text-left tw-text-[0.98rem] tw-font-medium tw-text-ink tw-transition-colors tw-duration-200 aria-expanded:tw-text-power" type="button" data-pc-collapse data-pc-target="#passengerFaq<?= $i ?>" aria-expanded="<?= $i ===
              0
                ? 'true'
                : 'false' ?>" aria-controls="passengerFaq<?= $i ?>">
              <span><?= htmlspecialchars($item['q']) ?></span>
              <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-power tw-transition-transform tw-duration-200 group-aria-expanded:tw-rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
            </button>
          </h3>
          <div id="passengerFaq<?= $i ?>" class="tw-max-h-0 [&.is-open]:tw-max-h-[80rem] tw-overflow-hidden tw-transition-[max-height] tw-duration-300 tw-ease-[cubic-bezier(0.4,0,0.2,1)] motion-reduce:tw-transition-none <?= $i === 0
  ? 'is-open'
  : '' ?>" data-pc-collapse-panel data-pc-collapse-parent="#passengerFaqAccordion">
            <div class="tw-px-5 tw-pb-4 tw-leading-[1.6] tw-text-ink/60"><?= $item['a'] ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="tw-hidden tw-mt-3 tw-flex tw-flex-col tw-gap-3" id="driverFaqAccordion">
      <?php foreach ($driverFaqs as $i => $item): ?>
        <div class="tw-overflow-hidden tw-rounded-xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white">
          <h3 class="tw-m-0">
            <button class="tw-group tw-flex tw-w-full tw-appearance-none tw-items-center tw-justify-between tw-gap-4 tw-border-0 tw-bg-transparent tw-px-5 tw-py-4 tw-text-left tw-text-[0.98rem] tw-font-medium tw-text-ink tw-transition-colors tw-duration-200 aria-expanded:tw-text-power" type="button" data-pc-collapse data-pc-target="#driverFaq<?= $i ?>" aria-expanded="<?= $i ===
              0
                ? 'true'
                : 'false' ?>" aria-controls="driverFaq<?= $i ?>">
              <span><?= htmlspecialchars($item['q']) ?></span>
              <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-power tw-transition-transform tw-duration-200 group-aria-expanded:tw-rotate-180" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 8.25l-7.5 7.5-7.5-7.5"/></svg>
            </button>
          </h3>
          <div id="driverFaq<?= $i ?>" class="tw-max-h-0 [&.is-open]:tw-max-h-[80rem] tw-overflow-hidden tw-transition-[max-height] tw-duration-300 tw-ease-[cubic-bezier(0.4,0,0.2,1)] motion-reduce:tw-transition-none <?= $i === 0
  ? 'is-open'
  : '' ?>" data-pc-collapse-panel data-pc-collapse-parent="#driverFaqAccordion">
            <div class="tw-px-5 tw-pb-4 tw-leading-[1.6] tw-text-ink/60"><?= $item['a'] ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Video Tutorials ============ -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-10 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Step By Step</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Video Guides</h2>
    </div>

    <!-- tw-hidden / pc-tutorial-card / pc-tutorial-play-btn / pc-tutorial-card-label
         stay bare -- video-tutorials.js and pcInitFaqs() (faqs.js) query and
         toggle these directly. -->
    <div class="tw-grid tw-grid-cols-2 tw-gap-3 lg:tw-grid-cols-4" id="riderTutorialGrid">
      <?php foreach ($riderTutorials as $video): ?>
        <div class="pc-tutorial-card tw-relative tw-overflow-hidden tw-rounded-2xl">
          <video class="tw-h-full tw-w-full tw-object-cover" preload="metadata" muted playsinline poster="<?= $assetPath ?>assets/img/vid-covers/<?= str_replace(
  '.mp4',
  '.jpg',
  $video['file'],
) ?>">
            <source src="<?= $assetPath ?>assets/vid/<?= $video['file'] ?>" type="video/mp4">
          </video>
          <button type="button" class="pc-tutorial-play-btn tw-absolute tw-left-1/2 tw-top-1/2 tw-flex tw-h-[3.25rem] tw-w-[3.25rem] -tw-translate-x-1/2 -tw-translate-y-1/2 tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-powerlight tw-text-white tw-shadow-[0_8px_20px_rgba(255,122,0,0.4)] tw-transition tw-duration-200 hover:tw-scale-105 hover:tw-bg-powerdark motion-reduce:tw-transition-none" aria-label="Play <?= htmlspecialchars(
            strip_tags($video['label']),
          ) ?> video">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
          </button>
          <span class="pc-tutorial-card-label tw-absolute tw-inset-x-0 tw-bottom-0 tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.85),transparent)] tw-p-3 tw-text-sm tw-font-semibold tw-text-white"><?= $video[
            'label'
          ] ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="tw-hidden tw-grid tw-grid-cols-2 tw-gap-3 lg:tw-grid-cols-4" id="driverTutorialGrid">
      <?php foreach ($driverTutorials as $video): ?>
        <div class="pc-tutorial-card tw-relative tw-overflow-hidden tw-rounded-2xl">
          <video class="tw-h-full tw-w-full tw-object-cover" preload="metadata" muted playsinline poster="<?= $assetPath ?>assets/img/vid-covers/<?= str_replace(
  '.mp4',
  '.jpg',
  $video['file'],
) ?>">
            <source src="<?= $assetPath ?>assets/vid/<?= $video['file'] ?>" type="video/mp4">
          </video>
          <button type="button" class="pc-tutorial-play-btn tw-absolute tw-left-1/2 tw-top-1/2 tw-flex tw-h-[3.25rem] tw-w-[3.25rem] -tw-translate-x-1/2 -tw-translate-y-1/2 tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-powerlight tw-text-white tw-shadow-[0_8px_20px_rgba(255,122,0,0.4)] tw-transition tw-duration-200 hover:tw-scale-105 hover:tw-bg-powerdark motion-reduce:tw-transition-none" aria-label="Play <?= htmlspecialchars(
            strip_tags($video['label']),
          ) ?> video">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M8 5v14l11-7z"/></svg>
          </button>
          <span class="pc-tutorial-card-label tw-absolute tw-inset-x-0 tw-bottom-0 tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.85),transparent)] tw-p-3 tw-text-sm tw-font-semibold tw-text-white"><?= $video[
            'label'
          ] ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/faqs.js"></script>
<script src="<?= $assetPath ?>assets/js/components/video-tutorials.js"></script>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
