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
  'Our agreements with customers, drivers and business accounts who use PowerCabs Services - please read the version that applies to you.';
$heroBgImage = 'https://images.pexels.com/photos/7580644/pexels-photo-7580644.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Terms & Conditions';
$heroVariant = 'legal'; 
require __DIR__ . '/components/shared/inner-hero.php';

$termsAudiences = [
  ['id' => 'customerTerms', 'input' => 'tcAudienceCustomer', 'label' => 'Customer Terms'],
  ['id' => 'driverTerms', 'input' => 'tcAudienceDriver', 'label' => 'Driver Terms'],
  ['id' => 'businessTerms', 'input' => 'tcAudienceBusiness', 'label' => 'Business Terms'],
  ['id' => 'airportTerms', 'input' => 'tcAudienceAirport', 'label' => 'Airport Meet &amp; Greet'],
  ['id' => 'businessAccountTerms', 'input' => 'tcAudienceInvoice', 'label' => 'Business Invoice Payment'],
];
?>

<section class="tw-pb-3 tw-pt-16 md:tw-pt-24">
  <div class="<?= $pcContainer ?>">
    <?php /* One segmented control, scrolled rather than wrapped on narrow screens: five
             labels will not fit a phone, and a wrapped row reads as two separate groups.
             The active state is pure CSS via has-[:checked] -- the script below only
             swaps which panel is visible. */ ?>
    <div class="tw-overflow-x-auto tw-pb-1 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:tw-hidden">
      <div class="tw-mx-auto tw-flex tw-w-max tw-items-center tw-gap-1 tw-rounded-full tw-border tw-border-solid tw-border-hairline tw-bg-paper-soft tw-p-1">
        <?php foreach ($termsAudiences as $i => $audience): ?>
          <?php /* tw-relative is load-bearing: the sr-only radio inside is position:absolute, and
                   without a positioned label it resolves against a far ancestor, escapes the
                   scroller above and adds its offscreen x to the page scrollWidth (238px at 390px). */ ?>
          <label class="tw-relative tw-inline-flex tw-cursor-pointer tw-select-none tw-items-center tw-whitespace-nowrap tw-rounded-full tw-px-4 tw-py-2 tw-text-[0.875rem] tw-font-semibold tw-text-ink/[0.55] tw-transition-colors tw-duration-200 hover:tw-text-ink has-[:checked]:tw-bg-white has-[:checked]:tw-text-ink has-[:checked]:tw-shadow-[0_1px_3px_rgba(28,20,16,0.12)] has-[:focus-visible]:tw-outline has-[:focus-visible]:tw-outline-2 has-[:focus-visible]:tw-outline-offset-2 has-[:focus-visible]:tw-outline-power sm:tw-px-5" for="<?= $audience['input'] ?>">
            <input type="radio" class="tw-sr-only" name="tcAudience" id="<?= $audience['input'] ?>"
              data-tc-panel="<?= $audience['id'] ?>" autocomplete="off" <?= $i === 0 ? 'checked' : '' ?>>
            <?= $audience['label'] ?>
          </label>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<?php
$termsHidden = false;
require __DIR__ . '/components/terms/customer.php';
require __DIR__ . '/components/terms/driver.php';
require __DIR__ . '/components/terms/business.php';
require __DIR__ . '/components/terms/airport.php';
require __DIR__ . '/components/terms/business-account.php';
?>
<script src="<?= $assetPath ?>assets/js/components/terms-conditions.js?v=<?= @filemtime(__DIR__ . '/assets/js/components/terms-conditions.js') ?>"></script>

<?php
$bannerCompact = true; 
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
