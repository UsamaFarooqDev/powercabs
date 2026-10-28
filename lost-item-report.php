<?php
$pageTitle = 'Lost Something in a Taxi? | PowerCabs Lost Item Recovery';
$pageDescription =
  'Lost something in a taxi? PowerCabs runs a free first search of our driver data, even if you did not travel with us. Optional EUR15 extended investigation.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';
require __DIR__ . '/includes/phone-countries.php';

$lostItemFee = 15;
$lostItemFeeLink = PC_STRIPE_LOST_ITEM_LINK;

// Dataset sizes quoted across the page. Defined once so the four places that print them -- the
// hero trust strip, the steps, the pricing cards and the results panel -- can never drift apart.
$lostItemFreeDrivers = 2000;
$lostItemAllDrivers = 7000;

$formStatus = null;
$formError = '';
$old = [
  'name' => '',
  'email' => '',
  'phone' => '',
  'phone_cc' => '',
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
        "Phone: " . pc_phone_full($old['phone_cc'], $old['phone']) . "\n" .
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

// Answers describe the process and its limits. None of them promises a recovery.
$lostItemFaqs = [
  [
    'q' => 'Is the initial search really free?',
    'a' =>
      'Yes. We check your report against our initial dataset of around ' .
      number_format($lostItemFreeDrivers) .
      ' drivers at no charge. We do not ask for card details to run it, and you are under no obligation afterwards.',
  ],
  [
    'q' => 'When do I have to pay €' . $lostItemFee . '?',
    'a' =>
      'Only if the free search does not find a likely match and you then ask us to go further. The €' .
      $lostItemFee .
      ' extended investigation searches our wider data of around ' .
      number_format($lostItemAllDrivers) .
      ' drivers. Nothing is charged unless you choose it.',
  ],
  [
    'q' => 'Does the extended investigation guarantee my item will be found?',
    'a' =>
      'No. The fee pays for the work of investigating the information available to us and trying to identify the relevant taxi or driver. We cannot guarantee that your item will be located or returned, and we will tell you honestly what we find.',
  ],
  [
    'q' => 'What if I took a taxi from another company?',
    'a' =>
      'You can still submit a report. You do not have to have travelled with PowerCabs. We investigate using the journey details you give us and the driver data available to us, whichever operator or app the trip was booked through.',
  ],
  [
    'q' => 'Will I have to pay to get my item back?',
    'a' =>
      'Possibly. If your item is found, any retrieval or delivery cost is separate from the search fees and depends on where the driver is and where you want the item sent. You will be given that cost and asked to approve it before anything is arranged.',
  ],
  [
    'q' => 'What happens to my personal information?',
    'a' =>
      'The details you provide are used to investigate your report and to contact you about it. We handle them in line with our Cookies & Privacy Policy and applicable data protection law.',
  ],
];
$pageFaq = $lostItemFaqs;

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'PowerCabs Lost Item Recovery';
$heroTitleLight = 'Lost Something in a Taxi?';
$heroTitleBold = 'Let’s Try to Get It Back.';

$heroDescriptionHtml =
  '<span class="tw-block tw-text-[1.1875rem] tw-font-semibold tw-text-white [text-shadow:0_1px_8px_rgba(0,0,0,0.3)]">We&rsquo;re here to help &mdash; even if you don&rsquo;t know which taxi you took.</span>' .
  '<span class="tw-mt-3 tw-block">Losing your phone, wallet, bag or something personally important can be upsetting. ' .
  'Not knowing which driver to contact can make it even more stressful.</span>';

// Local rather than hotlinked: this is the page's LCP image, and a remote hero that fails to
// decode takes the whole first screen with it. Source photo: Pexels 18937862 (Pexels licence).
$heroBgImage = '/assets/img/lost-item-hero.webp';
$heroBgImageSmall = '/assets/img/lost-item-hero-sm.webp';
$heroBreadcrumbLabel = 'Lost Item Recovery';
$heroVariant = 'showcase';
require __DIR__ . '/components/shared/inner-hero.php';
require __DIR__ . '/components/lost-item/how-it-works.php';
require __DIR__ . '/components/lost-item/pricing.php';
require __DIR__ . '/components/lost-item/why-choose.php';
require __DIR__ . '/components/lost-item/testimonials.php';
?>

<?php
$inputClass = $pcInput;
$labelClass = $pcLabel;
$submitClass = $pcBtnPrimary;
?>
<?php  ?>
<section class="tw-scroll-mt-24 <?= $pcSection ?>" id="lostItemForm">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="<?= $pcEyebrow ?>">Don't worry if you don't know everything</p>
        <h2 class="<?= $pcH2Small ?>">Report a Lost Item</h2>
        <p class="<?= $pcBody ?> <?= $pcMeasureTight ?>">
          Fill in whatever you can remember. The first search is free, and we will come back to you
          either way.
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
            <span class="tw-text-ink/60">A clear description of the item - colour, brand, and any identifying details.</span>
          </li>
        </ul>

        <div class="tw-mt-8 tw-flex tw-flex-wrap tw-items-center tw-gap-x-4 tw-gap-y-2 tw-rounded-2xl tw-border tw-border-solid tw-border-success/25 tw-bg-success/[0.07] tw-px-5 tw-py-4">
          <span class="tw-text-[1.35rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.03em] tw-text-success">&euro;0</span>
          <span class="tw-min-w-0 tw-flex-1 tw-text-[0.92rem] tw-leading-snug tw-text-ink/70">
            for the first search. The optional &euro;<?= $lostItemFee ?> extended investigation only happens if you ask for it &mdash;
            <a class="tw-font-semibold tw-text-power tw-underline tw-underline-offset-2" href="#pricing">see both options</a>.
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
              ) ?>" required placeholder="John Murphy">
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liEmail">Email Address</label>
              <input type="email" class="<?= $inputClass ?>" id="liEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required placeholder="you@example.com">
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liPhone">Phone Number</label>
              <?php
              $phoneId = 'liPhone';
              $phoneValue = $old['phone'];
              $phoneCcValue = $old['phone_cc'];
              $phoneClass = $inputClass;
              $phoneRequired = true;
              require __DIR__ . '/components/shared/phone-field.php';
              ?>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="liTaxiNumber">Taxi Number <span class="tw-font-normal tw-text-ink/50">(if you know it)</span></label>
              <input type="text" class="<?= $inputClass ?>" id="liTaxiNumber" name="taxi_number" value="<?= htmlspecialchars(
                $old['taxi_number'],
              ) ?>" placeholder="Roof sign or plate number">
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liPickup">Pickup Location</label>
              <input type="text" class="<?= $inputClass ?>" id="liPickup" name="pickup_location" value="<?= htmlspecialchars(
                $old['pickup_location'],
              ) ?>" required placeholder="Dublin Airport, Terminal 1">
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="liDropoff">Destination Location</label>
              <input type="text" class="<?= $inputClass ?>" id="liDropoff" name="destination_location" value="<?= htmlspecialchars(
                $old['destination_location'],
              ) ?>" required placeholder="Grafton Street, Dublin 2">
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
              <textarea class="<?= $inputClass ?> tw-resize-y" id="liItem" name="item_description" rows="4" required placeholder="What it is, the colour and make, and anything that identifies it"><?= htmlspecialchars(
                $old['item_description'],
              ) ?></textarea>
            </div>
            <div class="tw-pt-2 md:tw-col-span-2">
              <button type="submit" class="<?= $submitClass ?>">
                <span>Report a Lost Item</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="md:tw-col-span-2"><div class="alert-success tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks - your report has been sent. We'll be in touch as soon as we hear back from your driver.</div></div>
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

<?php
$faqItems = $lostItemFaqs;
$faqEyebrow = 'Lost item recovery';
$faqHeading = 'Frequently asked questions.';
$faqLayout = 'split';
$faqSurface = 'white';
$faqMoreHref = '/faqs';
require __DIR__ . '/components/shared/faq-accordion.php';

require __DIR__ . '/components/lost-item/fine-print.php';
$bannerCompact = true;
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
