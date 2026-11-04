<?php
$pageTitle = 'Item Collection & Delivery | PowerCabs';
$pageDescription =
  'Forgotten keys, a laptop left behind, airport excess baggage or an urgent document - PowerCabs collects eligible items and delivers them, with Garda-vetted drivers and the price confirmed before you book.';
$assetPath = '';

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
