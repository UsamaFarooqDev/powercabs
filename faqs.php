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

<!-- ============ Demo Video ============ -->
<section class="section-pc text-center">
  <div class="container">
    <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ See It In Action</p>
    <h2 class="mb-3">Watch How PowerCabs Works</h2>
    <p class="text-muted-pc mx-auto mb-4" style="max-width: 56ch;">
      From booking to drop-off, see just how simple getting around with PowerCabs really is.
    </p>

    <div class="pc-video-placeholder w-100 position-relative mx-auto overflow-hidden">
      <img src="<?= $assetPath ?>assets/img/service-city-tour.jpg" alt="" aria-hidden="true" class="w-100 h-100 object-fit-cover">
      <span class="pc-video-placeholder-scrim position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
      <button type="button" class="pc-video-play-btn text-white border-0 rounded-circle d-inline-flex align-items-center justify-content-center position-absolute top-50 start-50 translate-middle" aria-label="Play demo video">
        <i class="bi bi-play-fill"></i>
      </button>
    </div>
  </div>
</section>

<!-- ============ FAQ ============ -->
<section class="section-pc">
  <div class="container" style="max-width: 860px;">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Frequently Asked Questions</p>
      <h2 class="mb-4">Passenger &amp; Driver FAQs</h2>

      <input type="radio" class="btn-check" name="faqAudience" id="faqAudiencePassenger" autocomplete="off" checked>
      <label class="btn btn-outline-primary rounded-pill px-4 me-2" for="faqAudiencePassenger">Passenger</label>

      <input type="radio" class="btn-check" name="faqAudience" id="faqAudienceDriver" autocomplete="off">
      <label class="btn btn-outline-primary rounded-pill px-4" for="faqAudienceDriver">Driver</label>
    </div>

    <div class="accordion pc-faq-accordion" id="passengerFaqAccordion">
      <?php foreach ($passengerFaqs as $i => $item): ?>
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="accordion-button <?= $i === 0
              ? ''
              : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#passengerFaq<?= $i ?>" aria-expanded="<?= $i ===
0
  ? 'true'
  : 'false' ?>">
              <?= htmlspecialchars($item['q']) ?>
            </button>
          </h3>
          <div id="passengerFaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0
  ? 'show'
  : '' ?>" data-bs-parent="#passengerFaqAccordion">
            <div class="accordion-body text-muted-pc"><?= $item['a'] ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="accordion pc-faq-accordion d-none" id="driverFaqAccordion">
      <?php foreach ($driverFaqs as $i => $item): ?>
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="accordion-button <?= $i === 0
              ? ''
              : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#driverFaq<?= $i ?>" aria-expanded="<?= $i ===
0
  ? 'true'
  : 'false' ?>">
              <?= htmlspecialchars($item['q']) ?>
            </button>
          </h3>
          <div id="driverFaq<?= $i ?>" class="accordion-collapse collapse <?= $i === 0
  ? 'show'
  : '' ?>" data-bs-parent="#driverFaqAccordion">
            <div class="accordion-body text-muted-pc"><?= $item['a'] ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Video Tutorials ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Step By Step</p>
      <h2 class="mb-0">Video Guides</h2>
    </div>

    <div class="row g-3" id="riderTutorialGrid">
      <?php foreach ($riderTutorials as $video): ?>
        <div class="col-6 col-lg-3">
          <div class="pc-tutorial-card position-relative rounded-4 overflow-hidden">
            <video class="w-100 h-100 object-fit-cover" preload="metadata" muted playsinline poster="<?= $assetPath ?>assets/img/vid-covers/<?= str_replace(
  '.mp4',
  '.jpg',
  $video['file'],
) ?>">
              <source src="<?= $assetPath ?>assets/vid/<?= $video['file'] ?>" type="video/mp4">
            </video>
            <button type="button" class="pc-tutorial-play-btn text-white border-0 rounded-circle d-inline-flex align-items-center justify-content-center position-absolute top-50 start-50 translate-middle" aria-label="Play <?= htmlspecialchars(
              strip_tags($video['label']),
            ) ?> video">
              <i class="bi bi-play-fill"></i>
            </button>
            <span class="pc-tutorial-card-label position-absolute bottom-0 start-0 end-0 p-3 fw-semibold text-white"><?= $video[
              'label'
            ] ?></span>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="row g-3 d-none" id="driverTutorialGrid">
      <?php foreach ($driverTutorials as $video): ?>
        <div class="col-6 col-lg-3">
          <div class="pc-tutorial-card position-relative rounded-4 overflow-hidden">
            <video class="w-100 h-100 object-fit-cover" preload="metadata" muted playsinline poster="<?= $assetPath ?>assets/img/vid-covers/<?= str_replace(
  '.mp4',
  '.jpg',
  $video['file'],
) ?>">
              <source src="<?= $assetPath ?>assets/vid/<?= $video['file'] ?>" type="video/mp4">
            </video>
            <button type="button" class="pc-tutorial-play-btn text-white border-0 rounded-circle d-inline-flex align-items-center justify-content-center position-absolute top-50 start-50 translate-middle" aria-label="Play <?= htmlspecialchars(
              strip_tags($video['label']),
            ) ?> video">
              <i class="bi bi-play-fill"></i>
            </button>
            <span class="pc-tutorial-card-label position-absolute bottom-0 start-0 end-0 p-3 fw-semibold text-white"><?= $video[
              'label'
            ] ?></span>
          </div>
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
