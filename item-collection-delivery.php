<?php
$pageTitle = 'Item Collection & Delivery | PowerCabs';
$pageDescription =
  'Forgotten keys, a laptop left behind, airport excess baggage or an urgent document - PowerCabs collects eligible items and delivers them, with Garda-vetted drivers and the price confirmed before you book.';
$assetPath = '';

// seo.php turns $pageFaq into FAQPage JSON-LD and runs from header.php, so the questions
// have to exist before that include. Plain text only: faq-list.php escapes both fields.
$idelFaqs = [
  [
    'q' => 'What types of items can you collect and deliver?',
    'a' =>
      'Luggage and oversized baggage, shopping, event and venue equipment, office files, boxes, laptops and keys, and forgotten personal belongings. We do not carry food or takeaway orders, and every booking is subject to item acceptance.',
  ],
  [
    'q' => 'Can you collect oversized baggage from Dublin Airport?',
    'a' =>
      'Yes. Tell us which terminal your bags are at, where they need to go and when you need them delivered, and we will confirm availability and the price before the booking is accepted. It is often cheaper than an airline excess-baggage charge.',
  ],
  [
    'q' => 'Do you offer shopping collection from Dublin stores?',
    'a' =>
      'Yes, where the shop authorises the collection. Give us the store, what is being collected and who it is for, and we will deliver it to your chosen address.',
  ],
  [
    'q' => 'Can you collect forgotten items from hotels and Airbnb properties?',
    'a' =>
      'Yes. We collect from hotels, serviced apartments, Airbnbs, offices and venues once the property has agreed to release the item, and deliver it to you or another authorised recipient.',
  ],
  [
    'q' => 'Do you provide office equipment and event equipment collections?',
    'a' =>
      'Yes. Files, boxes, laptops, office keys and phones move between offices, employees, clients and meeting locations, and we also collect concert, event and venue equipment from an agreed location. Business customers can ask about repeat and recurring courier arrangements.',
  ],
  [
    'q' => 'How do I arrange an item collection and delivery?',
    'a' =>
      'Book online and choose Courier / Parcel, or contact our team for a quote. Tell us what the item is, where it is, where it needs to go and when; we confirm the service and price before your driver collects it.',
  ],
];
$pageFaq = $idelFaqs;

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'Item Collection & Delivery';
$heroTitleLight = 'Forgotten something important?';
$heroTitleBold = 'We’ll bring it to you.';

$heroDescriptionHtml =
  '<span class="tw-mt-3 tw-block">No unnecessary journeys, no added stress &mdash; just a convenient way to get ' .
  'the things you need, delivered by professional, Garda-vetted drivers.</span>';

// Local rather than hotlinked: this is the page's LCP image. Source photo: Pexels 8939566.
$heroBgImage = $assetPath . '/assets/img/item-delivery-hero.webp';
$heroBgImageSmall = $assetPath . '/assets/img/item-delivery-hero-sm.webp';
// Landscape enough to carry the copy: the ink reads as a glow behind the text, not a black panel.
$heroPhotoWide = true;
$heroBreadcrumbLabel = 'Item Collection & Delivery';
$heroVariant = 'showcase';
require __DIR__ . '/components/shared/inner-hero.php';

require __DIR__ . '/components/item-delivery/what-we-move.php';
require __DIR__ . '/components/item-delivery/timing.php';
require __DIR__ . '/components/item-delivery/care.php';
require __DIR__ . '/components/item-delivery/how-it-works.php';

$faqItems = $idelFaqs;
$faqEyebrow = 'Collection and delivery';
$faqHeading = 'Frequently asked questions.';
$faqLayout = 'split';
$faqSurface = 'soft';
$faqMoreHref = '/faqs';
require __DIR__ . '/components/shared/faq-accordion.php';

$ctaTitle = 'Need something collected or delivered?';
$ctaText = 'Get it where it needs to be, without making the journey yourself.';
$ctaPrimary = ['href' => '/book-ride-online', 'label' => 'Book a Delivery'];
$ctaSecondary = ['href' => '/contact-us', 'label' => 'Business Enquiries'];
require __DIR__ . '/components/shared/final-cta.php';
?>

<?php  ?>
<section class="tw-bg-white tw-pb-10 md:tw-pb-14">
  <div class="<?= $pcContainerNarrow ?>">
    <div class="tw-flex tw-flex-col tw-gap-4 sm:tw-flex-row">
      <span class="<?= $pcIconChip ?> tw-shrink-0" aria-hidden="true">
        <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M11.25 11.25l.04-.02a.75.75 0 011.07.85l-.71 2.84a.75.75 0 001.06.85l.04-.02M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.01v.01H12V8.25z"/></svg>
      </span>
      <div>
        <p class="tw-mb-2 tw-text-[0.72rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-ink/65">Good to know</p>
        <p class="tw-mb-0 tw-text-[0.9rem] tw-leading-[1.75] tw-text-ink/60">
          PowerCabs does not offer food or takeaway delivery. Bookings are subject to driver
          availability, item acceptance and the agreed collection and delivery arrangements. For
          business enquiries, recurring courier work or specialist collections,
          <a class="tw-font-semibold tw-text-power tw-underline tw-decoration-power/40 tw-decoration-2 tw-underline-offset-4 tw-transition-colors tw-duration-200 hover:tw-decoration-power" href="<?= $assetPath ?>/contact-us">contact our team</a>.
        </p>
      </div>
    </div>
  </div>
</section>

<?php
$bannerCompact = true;
require __DIR__ . '/components/shared/app-download-banner.php';

require __DIR__ . '/includes/footer.php';
