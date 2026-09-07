<?php
$pageTitle = 'Business Travel & Chauffeur Cars in Dublin | PowerCabs';
$pageDescription =
  'Reliable, discreet, and professional Business Rides and Limousine Services from PowerCabs -- built for executives, teams, and corporate travel across Dublin.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError = '';
$old = [
  'contact_name' => '',
  'business_name' => '',
  'business_email' => '',
  'phone' => '',
  'vat_number' => '',
  'employee_count' => '',
  'message' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($old as $key => $default) {
    $old[$key] = trim($_POST[$key] ?? '');
  }

  if (
    $old['contact_name'] === '' ||
    $old['business_name'] === '' ||
    $old['business_email'] === '' ||
    $old['phone'] === ''
  ) {
    $formStatus = 'error';
    $formError = 'Please fill in all required fields.';
  } elseif (!filter_var($old['business_email'], FILTER_VALIDATE_EMAIL)) {
    $formStatus = 'error';
    $formError = 'Please enter a valid email address.';
  } else {
    $body =
      "New business ride enquiry from the PowerCabs website.\n\n" .
      "Contact Name: {$old['contact_name']}\n" .
      "Business Name: {$old['business_name']}\n" .
      "Business Email: {$old['business_email']}\n" .
      "Phone Number: {$old['phone']}\n" .
      'VAT / Tax Number: ' .
      ($old['vat_number'] !== '' ? $old['vat_number'] : '-') .
      "\n" .
      'Number of Employees: ' .
      ($old['employee_count'] !== '' ? $old['employee_count'] : '-') .
      "\n\n" .
      "Additional Details:\n" .
      ($old['message'] !== '' ? $old['message'] : '-') .
      "\n";

    $result = pc_send_mail('Business account request: ' . $old['business_name'], $body, [
      'name' => $old['contact_name'],
      'email' => $old['business_email'],
    ]);

    if ($result['success']) {
      $formStatus = 'success';
      foreach ($old as $key => $default) {
        $old[$key] = '';
      }
    } else {
      $formStatus = 'error';
      $formError = 'Sorry, something went wrong sending your request. Please try again or call us directly.';
    }
  }
}

require __DIR__ . '/includes/header.php';

// The page's real promise is the admin it removes, not the upholstery --
// this line was already on the page as the how-it-works heading, which is
// the wrong place for the single sentence a B2B visitor should read first.
// how-it-works now has a heading about the steps themselves.
$heroEyebrow = '/ Business';
$heroTitleLight = 'Business travel,';
$heroTitleBold = 'without the admin headache.';
$heroDescription =
  'One account for your whole team, one monthly invoice, and full visibility of every journey booked.';
$heroBgImage = $assetPath . 'assets/img/services-corporate.jpg';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<!-- ============ Business Rides & Limousine Services (existing) ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <!-- Business_gif.gif is 1000x1000. Forcing a square source into a 4/3
             box with object-cover cropped a quarter of the frame away, top and
             bottom -- which is why the animation looked cut off. The wrapper
             now matches the source ratio so the whole frame shows. -->
        <div class="tw-aspect-square tw-overflow-hidden tw-rounded-2xl">
          <img src="<?= $assetPath ?>assets/img/Business_gif.gif" alt="PowerCabs business travel showcase"
            class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
        </div>
      </div>

      <div>
        <?php /* Was "Elevate Your Business Travel Experience" over a paragraph
                 that restated the old hero almost word for word ("reliable and
                 luxurious transportation for your business needs"). Both are
                 gone. What this block uniquely carries is the expectations
                 list and the >7-employee signpost to Corporate, so that is
                 what is left. PHP comment, not HTML: a note about removed
                 copy is for whoever edits this file, not for the visitor. */ ?>
        <h2 class="<?= $pcH2 ?>">What a business ride looks like</h2>

        <p class="tw-mb-2 tw-font-semibold tw-text-ink">With PowerCabs, you can expect:</p>
        <ul class="tw-m-0 tw-mb-4 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0">
          <?php $businessExpectations = [
            'Professional drivers',
            'Discreet and punctual chauffeurs',
            'Luxury at every step',
            'Smooth rides for working while travelling',
          ]; ?>
          <?php foreach ($businessExpectations as $item): ?>
            <li class="tw-flex tw-gap-2">
              <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
              <span class="tw-text-ink/60"><?= htmlspecialchars($item) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <div class="tw-bg-peach tw-shadow-[0_8px_20px_rgba(28,20,16,0.12)] tw-rounded-2xl tw-p-4">
          <p class="tw-mb-0">
            If your company has more than 7 employees, please visit our
            <a class="tw-text-power tw-transition-colors tw-duration-200 hover:tw-text-powerdark focus-visible:tw-text-powerdark tw-font-semibold" href="<?= $assetPath ?>/corporate-services">Corporate page</a>
            to explore our corporate travel solutions.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
/* Order is the B2B decision sequence: who else trusts you -> what an account
   gives me -> what can I book -> how do I set it up -> what does it cost ->
   sign me up.

   ireland-parallax.php was removed from here (and deleted): a full-bleed
   decorative photo whose only copy -- "NTA-licensed and Garda-vetted" --
   trust-proof.php below already states, with the licence number. The page
   was carrying three separate trust sections; it now has two that do
   different jobs (client logos, then credentials + the account promise). */
require __DIR__ . '/components/business/trust-strip.php';
require __DIR__ . '/components/business/account-benefits.php';
require __DIR__ . '/components/business/services-grid.php';
// Airport Assistance and How It Works share one soft band rather than each
// painting its own white -> paper-soft gradient. Separately, the tint faded
// down to paper-soft, then snapped back to white at the boundary -- a visible
// seam between two sections that belong together. The stops below hold the
// tint flat through the middle and fade it out at both ends, so the pair
// reads as a single block that eases in from the section above and out into
// the one below.
?>
<div class="tw-bg-[linear-gradient(180deg,#ffffff_0%,#f9f4ed_14%,#f9f4ed_86%,#ffffff_100%)]">
  <?php
  require __DIR__ . '/components/business/airport-assistance.php';
  require __DIR__ . '/components/business/how-it-works.php';
  ?>
</div>
<?php
require __DIR__ . '/components/business/plans.php';
// booking-process.php ends in the business account request form, so it sits
// last -- the form should follow the pricing, not precede it.
require __DIR__ . '/components/business/booking-process.php';
require __DIR__ . '/components/business/trust-proof.php';
require __DIR__ . '/components/shared/app-download-banner.php';

// Replaces components/business/final-cta.php, which was a page-local copy of
// the same closing block every other page now shares.
$ctaTitle = 'Open a business account.';
$ctaText = 'One account, one invoice, and a team in Dublin that answers the phone.';
$ctaPrimary = ['href' => '/business#bizAccountForm', 'label' => 'Request an Account'];
$ctaSecondary = ['href' => '/contact-us', 'label' => 'Talk to Sales'];
require __DIR__ . '/components/shared/final-cta.php';
?>

<script src="<?= $assetPath ?>assets/js/components/business-page.js"></script>

<?php require __DIR__ . '/includes/footer.php'; ?>
