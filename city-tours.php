<?php
$pageTitle = 'Dublin City Tours & Private Day Trips | PowerCabs';
$pageDescription =
  // 147 chars. Was 156 raw / 166 rendered, past the ~160 Google will show.
  "Private Dublin city tours and Irish day trips with PowerCabs -- a local driver to the city's top sights, the Cliffs of Moher and Giant's Causeway.";
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError = '';
$old = [
  'destination' => '',
  'full_name' => '',
  'email' => '',
  'mobile' => '',
  'people_count' => '',
  'tour_date' => '',
  'pickup_location' => '',
  'special_requests' => '',
];

$hourlyFormStatus = null;
$hourlyFormError = '';
$hourlyOld = [
  'full_name' => '',
  'email' => '',
  'mobile' => '',
  'people_count' => '',
  'hours' => '',
  'tour_date' => '',
  'tour_time' => '',
  'pickup_location' => '',
  'special_requests' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['form_type'] ?? '') === 'pay_per_hour') {
  foreach ($hourlyOld as $key => $default) {
    $hourlyOld[$key] = trim($_POST[$key] ?? '');
  }

  if (
    $hourlyOld['full_name'] === '' ||
    $hourlyOld['email'] === '' ||
    $hourlyOld['mobile'] === '' ||
    $hourlyOld['people_count'] === '' ||
    $hourlyOld['hours'] === '' ||
    $hourlyOld['tour_date'] === '' ||
    $hourlyOld['tour_time'] === '' ||
    $hourlyOld['pickup_location'] === ''
  ) {
    $hourlyFormStatus = 'error';
    $hourlyFormError = 'Please fill in all required fields.';
  } elseif (!filter_var($hourlyOld['email'], FILTER_VALIDATE_EMAIL)) {
    $hourlyFormStatus = 'error';
    $hourlyFormError = 'Please enter a valid email address.';
  } else {
    $body =
      "New Pay Per Hour booking request.\n\n" .
      "Full Name: {$hourlyOld['full_name']}\n" .
      "Email: {$hourlyOld['email']}\n" .
      "Mobile Number: {$hourlyOld['mobile']}\n" .
      "Number of People: {$hourlyOld['people_count']}\n" .
      "Number of Hours: {$hourlyOld['hours']}\n" .
      "Preferred Date: {$hourlyOld['tour_date']}\n" .
      "Preferred Time: {$hourlyOld['tour_time']}\n" .
      "Pickup Location: {$hourlyOld['pickup_location']}\n\n" .
      "Special Requests:\n" .
      ($hourlyOld['special_requests'] !== '' ? $hourlyOld['special_requests'] : '-') .
      "\n";

    $result = pc_send_mail('Pay Per Hour booking: ' . $hourlyOld['full_name'], $body, [
      'name' => $hourlyOld['full_name'],
      'email' => $hourlyOld['email'],
    ]);

    if ($result['success']) {
      $hourlyFormStatus = 'success';
      foreach ($hourlyOld as $key => $default) {
        $hourlyOld[$key] = '';
      }
    } else {
      $hourlyFormStatus = 'error';
      $hourlyFormError = 'Sorry, something went wrong sending your booking. Please try again or call us directly.';
    }
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
  foreach ($old as $key => $default) {
    $old[$key] = trim($_POST[$key] ?? '');
  }

  if (
    $old['destination'] === '' ||
    $old['full_name'] === '' ||
    $old['email'] === '' ||
    $old['mobile'] === '' ||
    $old['people_count'] === '' ||
    $old['tour_date'] === '' ||
    $old['pickup_location'] === ''
  ) {
    $formStatus = 'error';
    $formError = 'Please fill in all required fields.';
  } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $formStatus = 'error';
    $formError = 'Please enter a valid email address.';
  } else {
    $body =
      "New City Tour booking request.\n\n" .
      "Destination: {$old['destination']}\n" .
      "Full Name: {$old['full_name']}\n" .
      "Email: {$old['email']}\n" .
      "Mobile Number: {$old['mobile']}\n" .
      "Number of People: {$old['people_count']}\n" .
      "Preferred Tour Date: {$old['tour_date']}\n" .
      "Pickup Location: {$old['pickup_location']}\n\n" .
      "Special Requests:\n" .
      ($old['special_requests'] !== '' ? $old['special_requests'] : '-') .
      "\n";

    $result = pc_send_mail('City Tour booking: ' . $old['destination'], $body, [
      'name' => $old['full_name'],
      'email' => $old['email'],
    ]);

    if ($result['success']) {
      $formStatus = 'success';
      $bookedDestination = $old['destination'];
      foreach ($old as $key => $default) {
        $old[$key] = '';
      }
    } else {
      $formStatus = 'error';
      $formError = 'Sorry, something went wrong sending your booking. Please try again or call us directly.';
    }
  }
}

$hourlyMinDate = date('Y-m-d');
$hourlyOld['tour_date'] = $hourlyOld['tour_date'] !== '' ? $hourlyOld['tour_date'] : $hourlyMinDate;

$nowHour = (int) date('H');
$nowSlotMinute = (int) (ceil(((int) date('i')) / 30) * 30);
if ($nowSlotMinute === 60) {
  $nowSlotMinute = 0;
  $nowHour = ($nowHour + 1) % 24;
}
$hourlyNextSlot = sprintf('%02d:%02d', $nowHour, $nowSlotMinute);
$hourlyOld['tour_time'] = $hourlyOld['tour_time'] !== '' ? $hourlyOld['tour_time'] : $hourlyNextSlot;

/* Service structured data. Assembled in includes/seo.php, which wires
   it to the Organization node and supplies the default service area,
   so the page only states what the service is. */
$pageService = [
  'name' => 'Private City Tours and Day Trips',
  'serviceType' => 'Sightseeing tour',
  'description' =>
    'Private car tours of Dublin and day trips across Ireland with a local driver, on a full-day, half-day or hourly basis.',
];

require __DIR__ . '/includes/header.php';

$heroEyebrow = 'City Tours';
$heroTitleLight = 'City';
$heroTitleBold = 'Tours.';
$heroDescription =
  "Explore Ireland's most iconic destinations with PowerCabs. Whether you're visiting historic landmarks, breathtaking coastal scenery, charming villages, or famous attractions, enjoy comfortable private transportation with professional local drivers.";
$heroBgImage = 'https://images.pexels.com/photos/15592112/pexels-photo-15592112.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroVariant = 'image';
require __DIR__ . '/components/shared/inner-hero.php';

$destinations = [
  ['name' => 'Dublin City', 'desc' => "Explore Dublin's rich history, museums, Georgian architecture, Temple Bar, Trinity College and vibrant shopping districts.", 'duration' => 'Half-Day Tour', 'img' => 'https://images.pexels.com/photos/10725916/pexels-photo-10725916.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Cliffs of Moher', 'desc' => "Experience Ireland's spectacular Atlantic coastline with breathtaking panoramic cliff views.", 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/38110027/pexels-photo-38110027.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => "Giant's Causeway", 'desc' => 'Visit the UNESCO World Heritage Site famous for its unique basalt columns.', 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/34936223/pexels-photo-34936223.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Wicklow Mountains', 'desc' => 'Discover scenic valleys, forests, lakes and Glendalough Monastery.', 'duration' => 'Half-Day Tour', 'img' => 'https://images.pexels.com/photos/28430310/pexels-photo-28430310.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Kilkenny', 'desc' => "Explore Ireland's medieval city featuring Kilkenny Castle and charming streets.", 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/23995753/pexels-photo-23995753.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Galway', 'desc' => 'Experience traditional Irish culture, colorful streets and lively music.', 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/33943881/pexels-photo-33943881.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Ring of Kerry', 'desc' => "One of Ireland's most famous scenic coastal drives.", 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/37685449/pexels-photo-37685449.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Blarney Castle', 'desc' => 'Visit the legendary Blarney Stone and beautiful castle gardens.', 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/28959919/pexels-photo-28959919.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Belfast', 'desc' => "Explore Northern Ireland's capital including Titanic Belfast and historic landmarks.", 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/19045507/pexels-photo-19045507.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Cork', 'desc' => "Discover Ireland's southern capital with markets, riverside walks and historic sites.", 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/6355033/pexels-photo-6355033.jpeg?auto=format&fit=crop&w=1200&q=60'],
];

$reopenDestinationName = $formStatus === 'success' ? $bookedDestination ?? '' : $old['destination'];
$reopenDestination = null;
foreach ($destinations as $d) {
  if ($d['name'] === $reopenDestinationName) {
    $reopenDestination = $d;
    break;
  }
}

$ctInputClass = $pcInput;
$ctLabelClass = $pcLabel;
$ctSubmitClass = $pcBtnPrimary;

?>

<?php if ($formStatus): ?>
  <script>window.pcCityToursFormSubmitted = true;</script>
<?php endif; ?>
<?php if ($hourlyFormStatus): ?>
  <script>window.pcHourlyFormSubmitted = true;</script>
<?php endif; ?>

<section class="<?= $pcSectionTight ?>">
  <div class="<?= $pcContainer ?>">
    <?php /* A Dublin street behind the panel rather than a flat ink fill --
             the Four Courts on the quays at sunset, one of the four
             photographs the homepage coverage grid uses, so the city this
             offer is set in is the same city in both places.
           *
           * It fits what the panel says: "set your own route" is about
           * choosing where in Dublin to go, so the picture is the city, not a
           * car. bg-ink stays underneath as the base, and the scrim is heavy
           * and weighted left where the heading sits -- the button on the
           * right needs the photograph to stay out of its way more than the
           * photograph needs to be seen. */ ?>
    <div class="tw-relative tw-overflow-hidden tw-rounded-[28px] tw-bg-ink tw-p-6 sm:tw-p-10">
      <img src="https://images.pexels.com/photos/38635694/pexels-photo-38635694.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1400"
        alt="" aria-hidden="true" loading="lazy" decoding="async"
        class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-center">
      <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-[linear-gradient(100deg,rgba(10,7,5,0.93)_0%,rgba(10,7,5,0.86)_48%,rgba(10,7,5,0.72)_100%)]" aria-hidden="true"></span>

      <div class="tw-relative tw-flex tw-flex-col tw-items-start tw-gap-6 lg:tw-flex-row lg:tw-items-center lg:tw-justify-between">
        <div class="lg:tw-max-w-[62%]">
          <p class="<?= $pcEyebrowOnDark ?>">Pay Per Hour</p>
          <h2 class="<?= $pcH2OnDark ?>">Rather set your own route?</h2>
          <p class="tw-mb-0 <?= $pcBodyOnDark ?> tw-max-w-[58ch]">
            Hire a PowerCabs driver by the hour instead &mdash; no fixed
            itinerary, and as long as you like at every stop.
          </p>
        </div>
        <!-- data-pc-modal-open: the ui.js modal helper picks this up. -->
        <button type="button" class="<?= $pcBtnPrimary ?> tw-shrink-0" data-pc-modal-open="#hourlyModal">
          Book Per Hour
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ============ Featured Destinations ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Featured Destinations</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-0') ?>">Where Would You Like to Go?</h2>
    </div>
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
      <?php foreach ($destinations as $i => $d): ?>
        <?php $isLead = $i < 2; ?>
        <div class="tw-group tw-flex tw-flex-col tw-overflow-hidden tw-rounded-[28px] tw-border tw-border-solid tw-border-hairline tw-bg-white <?= $isLead
          ? 'lg:tw-col-span-2'
          : '' ?>">
          <div class="<?= $isLead ? 'tw-aspect-[16/9]' : 'tw-aspect-[4/3]' ?> tw-overflow-hidden">
            <img src="<?= htmlspecialchars($d['img']) ?>" alt="<?= htmlspecialchars($d['name']) ?>" class="tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 tw-ease-out group-hover:tw-scale-105 motion-reduce:tw-transition-none" loading="<?= $i < 4
  ? 'eager'
  : 'lazy' ?>">
          </div>
          <div class="tw-flex tw-flex-1 tw-flex-col tw-p-5 <?= $isLead ? 'sm:tw-p-7' : '' ?>">
            <h3 class="tw-mb-2 tw-font-bold tw-text-ink <?= $isLead
              ? 'tw-text-2xl'
              : 'tw-text-lg' ?>"><?= htmlspecialchars($d['name']) ?></h3>
            <p class="tw-mb-3 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($d['desc']) ?></p>
            <div class="tw-mt-auto tw-pt-1">
              <!-- data-pc-modal-open: the ui.js modal helper picks this up. -->
              <button type="button" class="<?= $pcBtnLink ?> tw-cursor-pointer tw-appearance-none tw-border-0 tw-bg-transparent tw-p-0" data-pc-modal-open="#tourModal"
                data-tour-name="<?= htmlspecialchars($d['name']) ?>" data-tour-desc="<?= htmlspecialchars($d['desc']) ?>" data-tour-duration="<?= htmlspecialchars($d['duration']) ?>" data-tour-img="<?= htmlspecialchars($d['img']) ?>">
                Book Tour
                <svg class="<?= $pcBtnLinkIcon ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
              </button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Shared Tour Modal (Explore + Book Tour) ============ -->
<div class="tw-hidden tw-fixed tw-inset-0 tw-z-[1055] tw-overflow-y-auto tw-overscroll-contain tw-px-4 tw-py-8" id="tourModal" data-pc-modal tabindex="-1" role="dialog" aria-labelledby="tourModalName" aria-hidden="true">
  <div class="tw-mx-auto tw-flex tw-min-h-full tw-items-center tw-opacity-0 tw-translate-y-3 tw-transition-[opacity,transform] tw-duration-200 [.is-open_&]:tw-opacity-100 [.is-open_&]:tw-translate-y-0 motion-reduce:tw-transition-none tw-max-w-[800px]">
    <div class="tw-w-full tw-overflow-hidden tw-rounded-[2rem] tw-bg-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.25)]">
      <div class="tw-relative tw-h-40 tw-w-full tw-overflow-hidden tw-bg-ink sm:tw-h-48">
        <img id="tourModalImg" src="<?= htmlspecialchars(
          $reopenDestination['img'] ?? '',
        ) ?>" alt="" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
        <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.88)_0%,rgba(10,7,5,0.45)_45%,rgba(10,7,5,0.15)_100%)]" aria-hidden="true"></span>

        <button type="button" class="tw-absolute tw-right-4 tw-top-4 tw-inline-flex tw-h-9 tw-w-9 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-black/40 tw-text-white tw-backdrop-blur-sm tw-transition-colors hover:tw-bg-black/60" data-pc-modal-close aria-label="Close"><svg class="tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 3l10 10M13 3L3 13"/></svg></button>

        <div class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-5 sm:tw-p-6">
          <span class="tw-mb-2 tw-inline-flex tw-items-center tw-gap-1.5 tw-rounded-full tw-bg-white/[0.16] tw-px-3 tw-py-1 tw-text-[0.72rem] tw-font-semibold tw-text-white tw-backdrop-blur-sm">
            <svg class="tw-h-3.5 tw-w-3.5 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span id="tourModalDuration"><?= htmlspecialchars($reopenDestination['duration'] ?? '') ?></span>
          </span>
          <h2 class="tw-mb-0 tw-text-[1.6rem] tw-font-bold tw-leading-tight tw-text-white [text-shadow:0_2px_12px_rgba(0,0,0,0.4)]" id="tourModalName"><?= htmlspecialchars(
            $reopenDestination['name'] ?? 'Destination',
          ) ?></h2>
        </div>
      </div>

      <div class="tw-px-6 tw-pb-6 tw-pt-5">
        <p class="tw-mb-5 tw-text-[0.95rem] tw-leading-[1.6] tw-text-ink/60" id="tourModalDesc"><?= htmlspecialchars(
          $reopenDestination['desc'] ?? '',
        ) ?></p>

        <div id="tourBookingForm">
          <h3 class="tw-mb-3 tw-text-base tw-font-bold tw-text-ink">Book This Tour</h3>
          <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
            <input type="hidden" name="destination" id="tourDestinationInput" value="<?= htmlspecialchars($old['destination'] !== '' ? $old['destination'] : $reopenDestinationName) ?>">
            <div>
              <label class="<?= $ctLabelClass ?>" for="ctFullName">Full Name</label>
              <input type="text" class="<?= $ctInputClass ?>" id="ctFullName" name="full_name" value="<?= htmlspecialchars($old['full_name']) ?>" required>
            </div>
            <div>
              <!-- pc-custom-datetime-enhance stays as a bare functional hook, driven by custom-datetime.js. -->
              <label class="<?= $ctLabelClass ?>" for="ctTourDate">Preferred Tour Date</label>
              <input type="date" class="<?= $ctInputClass ?> pc-custom-datetime-enhance" id="ctTourDate" name="tour_date" value="<?= htmlspecialchars($old['tour_date']) ?>" required>
            </div>
            <div>
              <label class="<?= $ctLabelClass ?>" for="ctEmail">Email Address</label>
              <input type="email" class="<?= $ctInputClass ?>" id="ctEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
            </div>
            <div>
              <label class="<?= $ctLabelClass ?>" for="ctMobile">Mobile Number</label>
              <input type="tel" class="<?= $ctInputClass ?>" id="ctMobile" name="mobile" value="<?= htmlspecialchars($old['mobile']) ?>" required>
            </div>

            <div>
              <label class="<?= $ctLabelClass ?>" for="ctPeopleCount">Number of People</label>
              <input type="number" min="1" class="<?= $ctInputClass ?>" id="ctPeopleCount" name="people_count" value="<?= htmlspecialchars($old['people_count']) ?>" required>
            </div>
            <div>
              <label class="<?= $ctLabelClass ?>" for="ctPickup">Pickup Location</label>
              <input type="text" class="<?= $ctInputClass ?>" id="ctPickup" name="pickup_location" value="<?= htmlspecialchars($old['pickup_location']) ?>" required>
            </div>
            <div class="md:tw-col-span-2">
              <label class="<?= $ctLabelClass ?>" for="ctRequests">Special Requests <span class="tw-font-normal tw-text-ink/50">(optional)</span></label>
              <textarea class="<?= $ctInputClass ?> tw-py-2" id="ctRequests" name="special_requests" rows="3"><?= htmlspecialchars($old['special_requests']) ?></textarea>
            </div>
            <div class="md:tw-col-span-2 tw-pt-2">
              <button type="submit" class="<?= $ctSubmitClass ?>">
                <span>Submit Booking</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12L3.269 3.126A59.77 59.77 0 0121.485 12 59.77 59.77 0 013.27 20.876L6 12zm0 0h7.5"/></svg>
              </button>
            </div>

            <!-- .alert-success / .alert-danger stay as bare classnames -- the contract ajax-forms.js parses out of the returned HTML. -->
            <?php if ($formStatus === 'success'): ?>
              <div class="md:tw-col-span-2">
                <div class="alert-success tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your <?= htmlspecialchars($bookedDestination ?? 'tour') ?> booking request has been sent. We'll confirm shortly.</div>
              </div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="md:tw-col-span-2">
                <div class="alert-danger tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars($formError) ?></div>
              </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ============ Pay Per Hour Modal ============ -->
<div class="tw-hidden tw-fixed tw-inset-0 tw-z-[1055] tw-overflow-y-auto tw-overscroll-contain tw-px-4 tw-py-8" id="hourlyModal" data-pc-modal tabindex="-1" role="dialog" aria-labelledby="hourlyModalLabel" aria-hidden="true">
  <div class="tw-mx-auto tw-flex tw-min-h-full tw-items-center tw-opacity-0 tw-translate-y-3 tw-transition-[opacity,transform] tw-duration-200 [.is-open_&]:tw-opacity-100 [.is-open_&]:tw-translate-y-0 motion-reduce:tw-transition-none tw-max-w-[800px]">
    <div class="tw-w-full tw-overflow-hidden tw-rounded-[2rem] tw-bg-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.25)]">
      <div class="tw-sticky tw-top-0 tw-z-[1] tw-flex tw-items-start tw-justify-between tw-gap-4 tw-bg-white tw-px-6 tw-pt-6">
        <h2 class="tw-mb-0 tw-text-xl tw-font-bold tw-text-ink" id="hourlyModalLabel">Pay Per Hour Booking</h2>
        <button type="button" class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-black/[0.05] tw-text-ink/70 tw-transition-colors hover:tw-bg-black/10 hover:tw-text-ink" data-pc-modal-close aria-label="Close"><svg class="tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 3l10 10M13 3L3 13"/></svg></button>
      </div>
      <div class="tw-px-6 tw-pb-6 tw-pt-4">
        <p class="tw-text-ink/60">
          Book a driver by the hour -- stay as long as you like at each stop, with
          no fixed itinerary.
        </p>

        <h3 class="tw-mb-3 tw-text-base tw-font-bold tw-text-ink">Book Your Hours</h3>
        <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
          <input type="hidden" name="form_type" value="pay_per_hour">
          <div>
            <label class="<?= $ctLabelClass ?>" for="phFullName">Full Name</label>
            <input type="text" class="<?= $ctInputClass ?>" id="phFullName" name="full_name" value="<?= htmlspecialchars($hourlyOld['full_name']) ?>" required>
          </div>
          <div>
            <label class="<?= $ctLabelClass ?>" for="phEmail">Email Address</label>
            <input type="email" class="<?= $ctInputClass ?>" id="phEmail" name="email" value="<?= htmlspecialchars($hourlyOld['email']) ?>" required>
          </div>
          <div>
            <label class="<?= $ctLabelClass ?>" for="phMobile">Mobile Number</label>
            <input type="tel" class="<?= $ctInputClass ?>" id="phMobile" name="mobile" value="<?= htmlspecialchars($hourlyOld['mobile']) ?>" required>
          </div>
          <div>
            <label class="<?= $ctLabelClass ?>" for="phPeopleCount">Number of People</label>
            <input type="number" min="1" class="<?= $ctInputClass ?>" id="phPeopleCount" name="people_count" value="<?= htmlspecialchars($hourlyOld['people_count']) ?>" required>
          </div>
          <div>
            <label class="<?= $ctLabelClass ?>" for="phHours">Number of Hours</label>
            <input type="number" min="1" class="<?= $ctInputClass ?>" id="phHours" name="hours" value="<?= htmlspecialchars($hourlyOld['hours']) ?>" required>
          </div>
          <div>
            <!-- pc-custom-datetime-enhance stays as a bare functional hook, driven by custom-datetime.js. -->
            <label class="<?= $ctLabelClass ?>" for="phDate">Preferred Date</label>
            <input type="date" class="<?= $ctInputClass ?> pc-custom-datetime-enhance" id="phDate" name="tour_date" min="<?= htmlspecialchars($hourlyMinDate) ?>" value="<?= htmlspecialchars($hourlyOld['tour_date']) ?>" required>
          </div>
          <div>
            <label class="<?= $ctLabelClass ?>" for="phTime">Preferred Time</label>
            <input type="time" class="<?= $ctInputClass ?> pc-custom-datetime-enhance" id="phTime" name="tour_time" value="<?= htmlspecialchars($hourlyOld['tour_time']) ?>" required>
          </div>
          <div class="md:tw-col-span-2">
            <label class="<?= $ctLabelClass ?>" for="phPickup">Pickup Location</label>
            <input type="text" class="<?= $ctInputClass ?>" id="phPickup" name="pickup_location" value="<?= htmlspecialchars($hourlyOld['pickup_location']) ?>" required>
          </div>
          <div class="md:tw-col-span-2">
            <label class="<?= $ctLabelClass ?>" for="phRequests">Special Requests <span class="tw-font-normal tw-text-ink/50">(optional)</span></label>
            <textarea class="<?= $ctInputClass ?> tw-py-2" id="phRequests" name="special_requests" rows="3"><?= htmlspecialchars($hourlyOld['special_requests']) ?></textarea>
          </div>
          <div class="md:tw-col-span-2 tw-pt-2">
            <button type="submit" class="<?= $ctSubmitClass ?>">
              <span>Submit Booking</span>
              <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12L3.269 3.126A59.77 59.77 0 0121.485 12 59.77 59.77 0 013.27 20.876L6 12zm0 0h7.5"/></svg>
            </button>
          </div>

          <?php if ($hourlyFormStatus === 'success'): ?>
            <div class="md:tw-col-span-2">
              <div class="alert-success tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your Pay Per Hour booking request has been sent. We'll confirm shortly.</div>
            </div>
          <?php elseif ($hourlyFormStatus === 'error'): ?>
            <div class="md:tw-col-span-2">
              <div class="alert-danger tw-mt-1 tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars($hourlyFormError) ?></div>
            </div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="<?= $assetPath ?>assets/js/components/city-tours.js?v=<?= @filemtime(__DIR__ . '/assets/js/components/city-tours.js') ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-datetime.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-datetime.js',
) ?>"></script>

<?php

/* Restructured from copy already on this page -- see
   components/shared/faq-accordion.php on why answers may not be invented. */
$faqItems = [
  ['q' => 'Is the car private to my group?', 'a' => 'Yes — a private car for your group only, with door-to-door pickup.'],
  ['q' => 'Can I choose where we go?', 'a' => 'The itinerary is flexible and can run as a full or half day.'],
  ['q' => 'Who drives the tour?', 'a' => 'A professional local driver who knows the routes and the stops.'],
  ['q' => 'Are families and groups welcome?', 'a' => 'Yes — families and groups are welcome, and vehicles are sized to suit.'],
];
$faqEyebrow = 'City tours';
$faqHeading = 'Tour questions.';
$faqLayout = 'split';
$faqMoreHref = '/faqs';
$faqSurface = 'soft'; // alternates against the white section above it
require __DIR__ . '/components/shared/faq-accordion.php';
$bannerCompact = true; 
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
