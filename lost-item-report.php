<?php
$pageTitle = 'Lost Something in a Taxi? | PowerCabs Lost Item Recovery';
$pageDescription =
  // 154 characters. Leads with the two things that separate this page from
  // every other lost-property form: any taxi journey, and a stated fee.
  'Lost something in a taxi? PowerCabs investigates and tries to identify the driver -- even if you did not travel with us. EUR15 investigation fee.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

/* Lost item search fee. The amount is what the page SAYS; what the visitor is
   actually charged is whatever the Stripe Payment Link is configured for in
   the Stripe dashboard -- the site cannot change that. Keep the two in step.
   The link comes from .env (STRIPE_LOST_ITEM_LINK, see includes/env.php) and
   is empty when not configured, which the card below handles. */
$lostItemFee = 15;
$lostItemFeeLink = PC_STRIPE_LOST_ITEM_LINK;

$formStatus = null;
$formError = '';
$old = [
  'name' => '',
  'email' => '',
  'phone' => '',
  'taxi_number' => '',
  'pickup_location' => '',
  'destination_location' => '',
  'journey_datetime' => '',
  'item_description' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($old as $key => $default) {
    $old[$key] = trim($_POST[$key] ?? '');
  }

  /* Taxi number and the receipt are NOT required.
     The page now invites reports about any taxi journey -- another operator,
     another app, or a street hail -- and someone who hailed a cab on the
     street has neither a PowerCabs booking confirmation nor a taxi number to
     give. Demanding them would have turned this page's own promise into a
     dead end at the last field. Both are still asked for, and both still go
     into the email when supplied; the body prints "-" when they do not. */
  if (
    $old['name'] === '' ||
    $old['email'] === '' ||
    $old['phone'] === '' ||
    $old['pickup_location'] === '' ||
    $old['destination_location'] === '' ||
    $old['journey_datetime'] === '' ||
    $old['item_description'] === ''
  ) {
    $formStatus = 'error';
    $formError = 'Please fill in all required fields.';
  } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $formStatus = 'error';
    $formError = 'Please enter a valid email address.';
  } else {
    $attachments = [];
    $hasUpload = !empty($_FILES['receipt']['tmp_name']) && ($_FILES['receipt']['error'] ?? 1) === UPLOAD_ERR_OK;

    // Only an upload that was actually attempted gets validated -- but if one
    // was attempted, the type and size rules are exactly as strict as before.
    if ($hasUpload) {
      $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'application/pdf'];
      $mime = mime_content_type($_FILES['receipt']['tmp_name']);
      if (!in_array($mime, $allowedMime, true) || $_FILES['receipt']['size'] > 5 * 1024 * 1024) {
        $formStatus = 'error';
        $formError = 'Receipt upload must be a JPG, PNG, WEBP or PDF under 5MB.';
      } else {
        $attachments[] = [
          'tmp_path' => $_FILES['receipt']['tmp_name'],
          'filename' => basename($_FILES['receipt']['name']),
          'mime' => $mime,
        ];
      }
    }

    if ($formStatus !== 'error') {
      $body =
        "New lost item report from the PowerCabs website.\n\n" .
        "Name: {$old['name']}\n" .
        "Email: {$old['email']}\n" .
        "Phone: {$old['phone']}\n" .
        'Taxi Number: ' .
        ($old['taxi_number'] !== '' ? $old['taxi_number'] : '-') .
        "\n" .
        'Pickup Location: ' .
        ($old['pickup_location'] !== '' ? $old['pickup_location'] : '-') .
        "\n" .
        'Destination Location: ' .
        ($old['destination_location'] !== '' ? $old['destination_location'] : '-') .
        "\n" .
        'Date/Time of Journey: ' .
        ($old['journey_datetime'] !== '' ? $old['journey_datetime'] : '-') .
        "\n" .
        'Receipt attached: ' .
        ($attachments !== [] ? 'yes' : 'no') .
        "\n\n" .
        "Item Lost Details:\n{$old['item_description']}\n";

      $result = pc_send_mail(
        'Lost item report: ' . $old['name'],
        $body,
        ['name' => $old['name'], 'email' => $old['email']],
        $attachments,
      );

      if ($result['success']) {
        $formStatus = 'success';
        foreach ($old as $key => $default) {
          $old[$key] = '';
        }
      } else {
        $formStatus = 'error';
        $formError = 'Sorry, something went wrong sending your report. Please try again or call us directly.';
      }
    }
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ PowerCabs Lost Item Recovery';
$heroTitleLight = 'Left Something';
$heroTitleBold = 'in a Taxi?';
// Names the two things that make this page different from every other "lost
// property" form: it covers any taxi journey, and the fee is stated up front.
$heroDescription =
  'Don\'t panic -- we may be able to help you get it back, even if you didn\'t travel with PowerCabs. A EUR' .
  $lostItemFee .
  ' investigation, with any retrieval cost quoted and approved before we proceed.';
$heroBgImage = 'https://images.pexels.com/photos/12092769/pexels-photo-12092769.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

require __DIR__ . '/components/lost-item/trust-strip.php';
require __DIR__ . '/components/lost-item/finding-driver.php';
require __DIR__ . '/components/lost-item/any-taxi.php';
// The fee and what it buys come BEFORE the form: nobody should meet the price
// for the first time next to a submit button.
require __DIR__ . '/components/lost-item/investigation-fee.php';
require __DIR__ . '/components/lost-item/retrieval-steps.php';
?>

<?php
// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = $pcLabel;
$submitClass = $pcBtnPrimary;
?>
<?php /* id + scroll-mt: every "tell us what happened" button on the page
         jumps here, and the fixed header would otherwise cover the heading. */ ?>
<section class="tw-scroll-mt-24 <?= $pcSection ?>" id="lostItemForm">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="<?= $pcEyebrow ?>">/ Don't worry if you don't know everything</p>
        <h2 class="<?= $pcH2Small ?>">Tell us what you remember</h2>
        <p class="tw-mb-6 tw-text-ink/60">
          Even small details help the investigation, and nothing below is a dead
          end if you cannot answer it. Pickup and drop-off, the rough time, the
          taxi company, a registration, anything about the driver, and a clear
          description of the item all give us something to work with.
        </p>
        <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-4 tw-p-0">
          <li class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
            <span class="tw-text-ink/60">Your taxi number and journey route, if you remember them.</span>
          </li>
          <li class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span class="tw-text-ink/60">The approximate date and time of your journey.</span>
          </li>
          <li class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25l2 2 4-4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
            <span class="tw-text-ink/60">A clear description of the item -- colour, brand, and any identifying details.</span>
          </li>
        </ul>

        <?php /* The fee card itself now lives in
                 components/lost-item/investigation-fee.php, above the form --
                 this is only the reminder, so the price is never a surprise
                 at the submit button. */ ?>
        <div class="tw-mt-8 tw-flex tw-flex-wrap tw-items-center tw-gap-x-4 tw-gap-y-2 tw-rounded-2xl tw-border tw-border-solid tw-border-power/20 tw-bg-peach/45 tw-px-5 tw-py-4">
          <span class="tw-text-[1.35rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.03em] tw-text-power">&euro;<?= $lostItemFee ?></span>
          <span class="tw-min-w-0 tw-flex-1 tw-text-[0.92rem] tw-leading-snug tw-text-ink/70">
            investigation fee, paid up front.
            <a class="tw-font-semibold tw-text-power tw-underline tw-underline-offset-2" href="#investigation">See what it covers</a>.
          </span>
        </div>
      </div>

      <div>
        <div class="tw-rounded-[2rem] tw-bg-white tw-p-6 tw-shadow-[0_10px_30px_rgba(28,20,16,0.1)] md:tw-p-11">
          <form method="post" action="" enctype="multipart/form-data" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liName">Full Name</label>
              <input type="text" class="<?= $inputClass ?>" id="liName" name="name" value="<?= htmlspecialchars(
                $old['name'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liEmail">Email Address</label>
              <input type="email" class="<?= $inputClass ?>" id="liEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liPhone">Phone Number</label>
              <input type="tel" class="<?= $inputClass ?>" id="liPhone" name="phone" value="<?= htmlspecialchars(
                $old['phone'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="liTaxiNumber">Taxi Number <span class="tw-font-normal tw-text-ink/50">(if you know it)</span></label>
              <input type="text" class="<?= $inputClass ?>" id="liTaxiNumber" name="taxi_number" value="<?= htmlspecialchars(
                $old['taxi_number'],
              ) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liPickup">Pickup Location</label>
              <input type="text" class="<?= $inputClass ?>" id="liPickup" name="pickup_location" value="<?= htmlspecialchars(
                $old['pickup_location'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liDropoff">Destination Location</label>
              <input type="text" class="<?= $inputClass ?>" id="liDropoff" name="destination_location" value="<?= htmlspecialchars(
                $old['destination_location'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liDate">Date / Time</label>
              <input type="datetime-local" class="<?= $inputClass ?> pc-custom-datetime-enhance" id="liDate" name="journey_datetime" value="<?= htmlspecialchars(
                $old['journey_datetime'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="liReceipt">Receipt or booking confirmation</label>
              <input type="file" class="<?= $inputClass ?> tw-cursor-pointer tw-py-[0.3rem] file:tw-mr-3 file:tw-cursor-pointer file:tw-rounded-full file:tw-border-0 file:tw-bg-paper file:tw-px-3 file:tw-py-1.5 file:tw-text-sm file:tw-font-semibold file:tw-text-ink" id="liReceipt" name="receipt" accept=".jpg,.jpeg,.png,.webp,.pdf">
            </div>
            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?> pc-required" for="liItem">Item Lost Details</label>
              <textarea class="<?= $inputClass ?> tw-resize-y" id="liItem" name="item_description" rows="4" required><?= htmlspecialchars(
                $old['item_description'],
              ) ?></textarea>
            </div>
            <div class="tw-pt-2 md:tw-col-span-2">
              <button type="submit" class="<?= $submitClass ?>">
                <span>Submit Report</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="md:tw-col-span-2"><div class="alert-success tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your report has been sent. We'll be in touch as soon as we hear back from your driver.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="md:tw-col-span-2"><div class="alert-danger tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars(
                $formError,
              ) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/custom-datetime.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-datetime.js',
) ?>"></script>

<?php
require __DIR__ . '/components/lost-item/story.php';
require __DIR__ . '/components/lost-item/driver-invite.php';

// $ctaTitle = 'Lost something? Don\'t give up yet.';
// $ctaText = 'Tell us what you remember and our team will start looking.';
// $ctaPrimary = ['href' => '/lost-item-report#lostItemForm', 'label' => 'Report a Lost Item'];
// $ctaSecondary = ['href' => '/contact-us', 'label' => 'Talk to Support'];
// require __DIR__ . '/components/shared/final-cta.php';

// The fee terms sit after the closing CTA, the same place the client's draft
// put them: read by anyone who got as far as deciding.
require __DIR__ . '/components/lost-item/fine-print.php';
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
