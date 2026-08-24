<?php
$faqAccordionId = 'driveFaqAccordion';
$faqEyebrow = '/ FAQ';
$faqHeading = 'Driver Questions, Answered.';

$faqItems = [
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
  [
    'q' => 'Can I choose my own working hours?',
    'a' => 'Yes. Drive whenever you want with complete flexibility.',
  ],
  [
    'q' => 'What happens if a passenger cancels?',
    'a' =>
      "If you've already started driving to the pickup location, you may receive a cancellation fee depending on eligibility.",
  ],
  [
    'q' => 'Are bonuses available?',
    'a' => 'Yes. Bonuses and promotions are available based on completed trips and peak-hour driving.',
  ],
];

require __DIR__ . '/../shared/faq-accordion.php';
