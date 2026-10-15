<?php
$pageTitle = 'FAQs | PowerCabs';
$pageDescription =
  'Answers to common questions for PowerCabs passengers and drivers -- booking, payments, tracking, documents, earnings and more.';
$assetPath = '';

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

$driverFaqGroups = [
  [
    'title' => 'Getting started',
    'items' => [
      [
      'q' => 'How do I become a PowerCabs driver?',
      'a' => 'Download the Driver App, complete registration, upload your documents, and wait for approval.',
      ],
      [
      'q' => 'What documents are required?',
      'a' => 'SPSV Licence, Suitability Certificate, Commercial Insurance, and valid Road Tax.',
      ],
    ],
  ],
  [
    'title' => 'Earnings and hours',
    'items' => [
      [
      'q' => 'How do I get paid?',
      'a' =>
      'Provide your IBAN during registration. Earnings are transferred weekly and can be viewed in Recent Transactions.',
      ],
      ['q' => 'Can I choose my own working hours?', 'a' => 'Yes. Drive whenever you want with complete flexibility.'],
      [
      'q' => 'Are bonuses available?',
      'a' => 'Yes. Bonuses and promotions are available based on completed trips and peak-hour driving.',
      ],
    ],
  ],
  [
    'title' => 'On the road',
    'items' => [
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
    ],
  ],
  [
    'title' => 'Account and documents',
    'items' => [
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
    ],
  ],
];

$pageFaq = $passengerFaqs;
foreach ($driverFaqGroups as $group) {
  foreach ($group['items'] as $item) {
    $pageFaq[] = $item;
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'Got Questions?';
$heroTitleLight = 'Everything You';
$heroTitleBold = 'Need to Know.';
$heroDescription =
  "Whether you're booking a ride or driving with us, find quick answers to the most common questions from passengers and drivers alike.";
$heroBgImage = 'https://images.pexels.com/photos/36507933/pexels-photo-36507933.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'FAQs';
$heroVariant = 'utility'; 
require __DIR__ . '/components/shared/inner-hero.php';
?>

<?php
$audienceToggleClass = 'tw-inline-flex tw-cursor-pointer tw-items-center tw-rounded-full tw-border tw-border-solid tw-border-ink/20 tw-px-5 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink tw-transition-colors tw-duration-200 has-[:checked]:tw-border-power has-[:checked]:tw-bg-power has-[:checked]:tw-text-white';
?>

<?php  ?>

<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[860px]">
    <div class="tw-mb-10 tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Frequently Asked Questions</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-6') ?>">Passenger &amp; Driver FAQs</h2>

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

    <div id="passengerFaqAccordion">
      <?php
      $faqListItems = $passengerFaqs;
      $faqListId = 'passengerFaq';
      $faqListParent = '#passengerFaqAccordion';
      $faqListAnswerRaw = true; 
      require __DIR__ . '/components/shared/faq-list.php';
      ?>
    </div>

    <?php  ?>
    <div class="tw-hidden tw-mt-3 tw-flex tw-flex-col tw-gap-10" id="driverFaqAccordion">
      <?php $i = 0; ?>
      <?php foreach ($driverFaqGroups as $group): ?>
        <div>
          <h3 class="tw-mb-1 tw-text-[0.78rem] tw-font-semibold tw-uppercase tw-tracking-[0.14em] tw-text-ink/45">
            <?= htmlspecialchars($group['title']) ?>
          </h3>
          <?php
          $faqListItems = $group['items'];
          $faqListId = 'driverFaq';
          $faqListParent = '#driverFaqAccordion';
          $faqListStart = $i;
          $faqListTag = 'h4';
          $faqListAnswerRaw = true;
          require __DIR__ . '/components/shared/faq-list.php';
          $i += count($group['items']);
          ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/faqs.js?v=<?= @filemtime(__DIR__ . '/assets/js/components/faqs.js') ?>"></script>

<?php
$bannerCompact = true; 
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
