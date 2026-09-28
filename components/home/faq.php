<?php
/**
 * Homepage §12 -- a short FAQ, with a route through to the full page.
 *
 * Four questions, not twenty. The brief asks for "only the highest-value
 * questions", and these four are the ones a first-time rider needs before
 * they will book: how do I get a taxi, what will it cost, how do I pay, where
 * is my driver. Everything else stays on /faqs.
 *
 * Question and answer text is copied verbatim from faqs.php so the two pages
 * cannot drift into answering the same question differently.
 *
 * The accordion itself lives in components/shared/faq-accordion.php -- this file
 * is only the homepage's choice of questions.
 */
$faqItems = [
  [
    'q' => 'How do I book a ride with PowerCabs?',
    'a' => 'Open the PowerCabs app, enter your destination, select your preferred ride type, confirm your pickup location, and tap Confirm Now.',
  ],
  [
    'q' => 'How is my fare calculated?',
    'a' => 'Fares follow NTA regulations and are calculated based on time, distance, traffic, and ride type. A detailed receipt is emailed after your trip.',
  ],
  [
    'q' => 'How do I pay for my ride?',
    'a' => 'Your saved payment method is charged automatically after the trip. Payment methods can be managed from the app.',
  ],
  [
    'q' => 'How can I track my driver?',
    'a' => 'You can track your driver in real time from the app, including their live location, vehicle details, and estimated arrival time.',
  ],
];
$faqSurface = 'tw-bg-white'; // keeps the white/tint alternation running to the close
$faqLayout = 'split';
$faqMoreHref = '/faqs';
require __DIR__ . '/../shared/faq-accordion.php';
