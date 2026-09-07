<?php
$pageTitle = 'About Us | PowerCabs';
$pageDescription =
  'Your trusted partner for seamless and reliable travel across Ireland -- professional drivers, modern vehicles, and 24/7 availability.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

// "Your Journey, Our Priority" is a claim any taxi company could make, and
// the old hero line ("your trusted partner for seamless and reliable travel")
// was the same sentiment again. This says something only PowerCabs can: where
// it is from, who runs it, and what it is built on -- and it sets up the three
// things the page then evidences.
$heroEyebrow = '/ About PowerCabs Ireland';
$heroTitleLight = 'Built in Dublin.';
$heroTitleBold = 'Driven by people. Powered by technology.';
$heroDescription = 'An Irish taxi company based in Inchicore, serving the Greater Dublin Area with licensed, Garda-vetted drivers.';
$heroBgImage = 'https://images.pexels.com/photos/36713443/pexels-photo-36713443.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<!-- ============ Who We Are ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2">
      <div>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Who We Are</p>
        <?php /* Was "Welcome to PowerCabs" over a paragraph listing safe,
                 comfortable and efficient travel, professional courteous
                 drivers, state-of-the-art vehicles and customer satisfaction
                 -- every one of which is a card in the grid directly below,
                 so the paragraph was a table of contents for the next
                 section. Replaced with the one thing the cards cannot say:
                 who the company actually is. */ ?>
        <h2 class="<?= $pcH2 ?>">An Irish company, not a franchise</h2>
        <p class="tw-mb-4 <?= $pcBody ?>">
          PowerCabs Ireland Limited is based in Inchicore and licensed by the
          National Transport Authority under DH12616. The drivers are local, the
          support team is in Dublin, and the dispatch technology is our own.
        </p>
        <p class="tw-mb-0 tw-text-xl tw-font-bold tw-text-ink">
          At PowerCabs, your journey is our priority.
        </p>
      </div>

      <div class="tw-overflow-hidden tw-rounded-[2rem] tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)]">
        <img src="<?= $assetPath ?>assets/img/services_rides.png" alt="A PowerCabs account manager reviewing a city route plan with a business team" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- ============ Highlights ============ -->
<?php
$aboutHighlights = [
  ['icon' => 'badge', 'title' => 'Professional Drivers', 'desc' => 'Courteous, experienced, and licensed for every journey.'],
  ['icon' => 'car', 'title' => 'Modern Vehicles', 'desc' => 'State-of-the-art, regularly inspected fleet.'],
  ['icon' => 'clock', 'title' => '24/7 Availability', 'desc' => "Day or night, we're ready when you need us."],
  ['icon' => 'tag', 'title' => 'Competitive Rates', 'desc' => 'Easy booking, transparent and fair pricing.'],
];
?>
<section class="tw-relative tw-overflow-hidden tw-bg-white <?= $pcSection ?>">
  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-black/[0.06] tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.06] md:tw-grid-cols-4 md:tw-divide-y-0">
      <?php foreach ($aboutHighlights as $item): ?>
        <div class="tw-flex tw-flex-col tw-items-center tw-px-3 tw-py-8 tw-text-center md:tw-py-10">
          <?php switch ($item['icon']):
            case 'badge': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            <?php break;
            case 'car': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
            <?php break;
            case 'clock': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?php break;
            case 'tag': ?>
              <svg class="tw-mb-3 tw-h-8 tw-w-8 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path d="M6 6h.008v.008H6V6z"/></svg>
            <?php break;
          endswitch; ?>
          <h3 class="tw-mb-2.5 tw-text-[1.1875rem] tw-font-bold tw-leading-snug tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/[0.62]"><?= htmlspecialchars($item['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/components/about/dublin-story.php'; ?>

<!-- ============ Dublin Map ============ -->
<section class="tw-pb-16 md:tw-pb-24">
  <div class="<?= $pcContainer ?>">
    <div class="tw-relative tw-overflow-hidden tw-rounded-[2rem] tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] tw-aspect-[3/4] sm:tw-aspect-[16/9] lg:tw-aspect-[21/9]">
      <iframe
        src="https://www.google.com/maps?q=53.3498,-6.2603(PowerCabs+Dublin)&z=11&output=embed"
        class="tw-h-full tw-w-full tw-border-0"
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"
        title="PowerCabs coverage across Dublin"
      ></iframe>
      <div class="tw-absolute tw-bottom-4 tw-left-1/2 tw-z-[2] tw-w-[91%] -tw-translate-x-1/2 tw-rounded-[2rem] tw-bg-white tw-p-[1.1rem] tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] sm:tw-bottom-auto sm:tw-left-6 sm:tw-top-1/2 sm:tw-w-[240px] sm:-tw-translate-y-1/2 sm:tw-translate-x-0 lg:tw-left-8 lg:tw-w-[320px] lg:tw-p-6">
        <h3 class="tw-mb-2.5 tw-text-[1.1875rem] tw-font-bold tw-leading-snug tw-text-ink">Serving Every Corner</h3>
        <p class="tw-mb-4 tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/[0.62]">
          From Dublin Airport to D&uacute;n Laoghaire, and the IFSC to Dundrum. Wherever you
          need to be in the Greater Dublin Area, we are there.
        </p>
        <a href="<?= $assetPath ?>/ride" class="<?= $pcBtnPrimary ?>">Check Coverage</a>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';

$ctaTitle = 'Ride with an Irish company.';
$ctaText = 'Licensed, Garda-vetted drivers across the Greater Dublin Area, 24/7.';
$ctaPrimary = ['href' => '/book-ride-online', 'label' => 'Book a Ride'];
$ctaSecondary = ['href' => '/contact-us', 'label' => 'Contact Us'];
require __DIR__ . '/components/shared/final-cta.php';

require __DIR__ . '/includes/footer.php';
?>
