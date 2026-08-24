<?php
/**
 * Ride page FAQ -- data + copy only; the accordion markup itself lives in
 * the shared components/shared/faq-accordion.php partial (also used by
 * drive.php's FAQ) so the two pages don't duplicate the implementation.
 */
$faqAccordionId = 'rideFaqAccordion';
$faqEyebrow = '/ FAQ';
$faqHeading = "Got Questions? We've Got Answers.";

$faqItems = [
  [
    'q' => 'Is PowerCabs an Irish company?',
    'a' => 'Yes. PowerCabs Ireland Limited is an Irish taxi company based in Dublin.',
  ],
  [
    'q' => 'Are PowerCabs drivers licensed?',
    'a' => 'PowerCabs works with licensed, Garda-vetted taxi professionals.',
  ],
  [
    'q' => 'Can I book an airport transfer in advance?',
    'a' => 'Yes. Airport journeys can be arranged in advance so your transport is planned before you need it.',
  ],
  [
    'q' => 'Do you offer wheelchair-accessible taxis?',
    'a' => 'Yes. PowerCabs has a fleet of wheelchair-accessible taxis available for booking.',
  ],
  [
    'q' => 'Can I travel with my pet?',
    'a' => 'Yes. Select the Pet Taxi service when booking a pet-friendly journey.',
  ],
  [
    'q' => 'Do you offer business accounts?',
    'a' =>
      'Yes. PowerCabs offers business accounts for companies and organisations that require regular taxi services.',
  ],
];

require __DIR__ . '/../shared/faq-accordion.php';
