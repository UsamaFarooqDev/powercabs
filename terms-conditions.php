<?php
$pageTitle = 'Terms & Conditions | PowerCabs';
$pageDescription =
  "PowerCabs Ireland Limited's Terms and Conditions for customers and passengers, for SPSV drivers and operators, and for corporate and business account holders.";
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'Policies & Safety';
$heroTitleLight = 'Terms &';
$heroTitleBold = 'Conditions.';
$heroDescription =
  'Our agreements with customers, drivers and business accounts who use PowerCabs Services -- please read the version that applies to you.';
$heroBgImage = 'https://images.pexels.com/photos/7580644/pexels-photo-7580644.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Terms & Conditions';
$heroVariant = 'legal'; // §12: compact hero, straight into the useful content.
require __DIR__ . '/components/shared/inner-hero.php';

/* Three audiences, three generated panels. Each component sets its own nav,
   intro and body and then requires components/terms/panel.php, which owns the
   layout -- so the three cannot drift apart the way the hand-maintained
   passenger and driver columns did.

   Order matters: customer.php renders visible, the other two render hidden,
   and terms-conditions.js swaps them. All three stay in the DOM so every
   clause is crawlable and findable with Ctrl+F whichever tab is showing. */
$termsAudiences = [
  ['id' => 'customerTerms', 'input' => 'tcAudienceCustomer', 'label' => 'Customer Terms'],
  ['id' => 'driverTerms', 'input' => 'tcAudienceDriver', 'label' => 'Driver Terms'],
  ['id' => 'businessTerms', 'input' => 'tcAudienceBusiness', 'label' => 'Business Terms'],
];
?>

<!-- ============ Audience Toggle ============ -->
<section class="tw-pb-3 tw-pt-16 tw-text-center md:tw-pt-24">
  <div class="<?= $pcContainer ?> tw-flex tw-flex-wrap tw-justify-center tw-gap-2">
    <?php /* data-tc-panel carries the panel id, so terms-conditions.js drives
             any number of tabs instead of the two it had hard-coded by id.
             The radio stays sr-only and the label does the styling through
             has-[:checked], which is what keeps this keyboard-operable. */ ?>
    <?php foreach ($termsAudiences as $i => $audience): ?>
      <label class="tw-inline-flex tw-cursor-pointer tw-items-center tw-rounded-full tw-border tw-border-solid tw-border-ink/20 tw-px-5 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink tw-transition-colors tw-duration-200 has-[:checked]:tw-border-power has-[:checked]:tw-bg-power has-[:checked]:tw-text-white" for="<?= $audience['input'] ?>">
        <input type="radio" class="tw-sr-only" name="tcAudience" id="<?= $audience['input'] ?>"
          data-tc-panel="<?= $audience['id'] ?>" autocomplete="off" <?= $i === 0 ? 'checked' : '' ?>>
        <?= $audience['label'] ?>
      </label>
    <?php endforeach; ?>
  </div>
</section>

<?php
$termsHidden = false;
require __DIR__ . '/components/terms/customer.php';
require __DIR__ . '/components/terms/driver.php';
require __DIR__ . '/components/terms/business.php';
?>
<script src="<?= $assetPath ?>assets/js/components/terms-conditions.js?v=<?= @filemtime(__DIR__ . '/assets/js/components/terms-conditions.js') ?>"></script>

<?php
$bannerCompact = true; // restrained: a legal page should not end on an orange panel
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
