<?php
$pageTitle = 'Dublin City Tours & Private Day Trips | PowerCabs';
$pageDescription =
  "Dublin city tours and private day trips with PowerCabs -- professional local drivers to Dublin's top sights, the Cliffs of Moher, Giant's Causeway and more.";
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

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ City Tours';
$heroTitleLight = 'City';
$heroTitleBold = 'Tours.';
$heroDescription =
  "Explore Ireland's most iconic destinations with PowerCabs. Whether you're visiting historic landmarks, breathtaking coastal scenery, charming villages, or famous attractions, enjoy comfortable private transportation with professional local drivers.";
$heroBgImage = 'https://images.pexels.com/photos/15592112/pexels-photo-15592112.jpeg?auto=format&fit=crop&w=1600&q=60';
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

$whyChooseTours = [
  ['title' => 'Private transportation', 'icon' => 'car'],
  ['title' => 'Flexible itinerary', 'icon' => 'signpost'],
  ['title' => 'Professional local drivers', 'icon' => 'badge'],
  ['title' => 'Door-to-door pickup', 'icon' => 'house'],
  ['title' => 'Comfortable vehicles', 'icon' => 'stars'],
  ['title' => 'Family friendly', 'icon' => 'people'],
  ['title' => 'Group tours available', 'icon' => 'group'],
  ['title' => 'Full day & half day options', 'icon' => 'clock'],
];

// Canonical PowerCabs form field recipe (see book-ride-online.php).
$ctInputClass =
  'tw-w-full tw-rounded-md tw-border tw-border-solid tw-border-[#dee2e6] tw-bg-white tw-px-3 tw-py-1.5 tw-text-base tw-leading-normal tw-text-ink placeholder:tw-text-ink/40 tw-outline-none tw-transition-colors tw-duration-200 focus:tw-border-powerlight';
$ctLabelClass = $pcLabel;
$ctSubmitClass = $pcBtnPrimary;

function pc_ct_icon(string $icon, string $cls = 'tw-h-5 tw-w-5'): void
{
  switch ($icon):
    case 'car': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
      <?php break;
    case 'signpost': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3v18M6 3l6 3-6 3m0 6l6 3-6 3M18 3v18M18 9l-6 3 6 3"/></svg>
      <?php break;
    case 'badge': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
      <?php break;
    case 'house': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0L22.25 12M4.5 9.75V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V9.75M9 21.75V13.5a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5v8.25"/></svg>
      <?php break;
    case 'stars': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
      <?php break;
    case 'people': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
      <?php break;
    case 'group': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3.5 19.5c0-2.9 2.5-5 5.5-5s5.5 2.1 5.5 5M15 15.5c2.3.2 4 1.8 4 4"/></svg>
      <?php break;
    case 'clock': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <?php break;
  endswitch;
}
?>

<?php if ($formStatus): ?>
  <script>window.pcCityToursFormSubmitted = true;</script>
<?php endif; ?>
<?php if ($hourlyFormStatus): ?>
  <script>window.pcHourlyFormSubmitted = true;</script>
<?php endif; ?>

<!-- ============ Pay Per Hour ============ -->
<section class="tw-pb-0 tw-pt-16 md:tw-pt-24">
  <div class="<?= $pcContainer ?>">
    <div class="tw-relative tw-overflow-hidden tw-rounded-2xl tw-bg-cover tw-bg-center tw-p-6 sm:tw-p-10 tw-bg-[url('https://images.unsplash.com/photo-1603934631592-40d9f2e67702?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')]">
      <span class="tw-absolute tw-inset-0 tw-z-0 tw-bg-[linear-gradient(100deg,rgba(10,7,5,0.85)_0%,rgba(10,7,5,0.6)_55%,rgba(10,7,5,0.35)_100%)]" aria-hidden="true"></span>
      <div class="tw-relative tw-z-[1] tw-flex tw-flex-col tw-items-start tw-gap-4 lg:tw-flex-row lg:tw-items-center lg:tw-justify-between">
        <div class="lg:tw-max-w-[70%]">
          <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-powerlight">/ Pay Per Hour</p>
          <h2 class="tw-mb-2 tw-text-2xl tw-font-bold tw-text-white md:tw-text-3xl">Prefer to Explore at Your Own Pace?</h2>
          <p class="tw-mb-0 tw-max-w-[62ch] tw-text-white/85">
            Hire a PowerCabs driver by the hour instead -- no fixed itinerary, just
            you, your driver and as much time as you need around Dublin.
          </p>
        </div>
        <div>
          <!-- data-pc-modal-open: the ui.js modal helper picks this up. -->
          <button type="button" class="tw-inline-flex tw-appearance-none tw-items-center tw-whitespace-nowrap tw-rounded-full tw-border tw-border-solid tw-border-white tw-bg-transparent tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-transition-colors tw-duration-200 hover:tw-bg-white hover:tw-text-ink" data-pc-modal-open="#hourlyModal">
            Book Per Hour
          </button>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Featured Destinations ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Featured Destinations</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Where Would You Like to Go?</h2>
    </div>
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
      <?php foreach ($destinations as $d): ?>
        <div class="tw-group tw-overflow-hidden tw-rounded-[28px] tw-bg-white tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)]">
          <div class="tw-aspect-[4/3] tw-overflow-hidden">
            <img src="<?= htmlspecialchars($d['img']) ?>" alt="<?= htmlspecialchars($d['name']) ?>" class="tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 tw-ease-out group-hover:tw-scale-105 motion-reduce:tw-transition-none" loading="lazy">
          </div>
          <div class="tw-p-5">
            <h3 class="tw-mb-2 tw-text-lg tw-font-bold tw-text-ink"><?= htmlspecialchars($d['name']) ?></h3>
            <p class="tw-mb-3 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($d['desc']) ?></p>
            <!-- data-pc-modal-open: the ui.js modal helper picks this up. -->
            <button type="button" class="tw-inline-flex tw-appearance-none tw-items-center tw-rounded-full tw-border-0 tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-transition-colors tw-duration-200 hover:tw-bg-power" data-pc-modal-open="#tourModal" data-scroll-to-form="true"
              data-tour-name="<?= htmlspecialchars($d['name']) ?>" data-tour-desc="<?= htmlspecialchars($d['desc']) ?>" data-tour-duration="<?= htmlspecialchars($d['duration']) ?>" data-tour-img="<?= htmlspecialchars($d['img']) ?>">
              Book Tour
            </button>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Why Choose Our Tours ============ -->
<section class="tw-relative tw-overflow-hidden tw-bg-paper <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mb-10 tw-grid tw-grid-cols-1 tw-items-end tw-gap-6 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-7">
        <div class="tw-mb-3 tw-flex tw-items-center tw-gap-2">
          <span class="tw-inline-block tw-h-2 tw-w-2 tw-rounded-full tw-bg-power"></span>
          <span class="tw-text-sm tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-power">Why Choose Our Tours</span>
        </div>
        <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl lg:tw-text-5xl">
          Ireland, <span class="tw-font-normal">at Your Own Pace</span>
        </h2>
      </div>
      <div class="lg:tw-col-span-5">
        <p class="tw-mb-0 tw-leading-[1.7] tw-text-ink/60">
          Discover Ireland with the freedom to travel your way,
          supported by local expertise, comfort and flexibility.
        </p>
      </div>
    </div>

    <!-- Features -->
    <div class="tw-grid tw-grid-cols-2 tw-gap-3 lg:tw-grid-cols-4 lg:tw-gap-4">
      <?php foreach ($whyChooseTours as $index => $item): ?>
        <div class="tw-relative tw-min-h-[245px] tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.06] tw-bg-white tw-p-4 lg:tw-p-4">
          <div class="tw-pointer-events-none tw-absolute tw-right-0 tw-top-0 tw-translate-x-2 -tw-translate-y-1 tw-text-[5rem] tw-font-bold tw-leading-none tw-text-black/[0.035]">
            <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
          </div>
          <div class="tw-relative tw-mb-4 tw-flex tw-h-[52px] tw-w-[52px] tw-items-center tw-justify-center tw-rounded-xl tw-bg-[#fff4ec] tw-text-power">
            <?php pc_ct_icon($item['icon']); ?>
          </div>
          <h3 class="tw-relative tw-mb-3 tw-max-w-[180px] tw-text-base tw-font-bold tw-leading-[1.45] tw-text-ink">
            <?= htmlspecialchars($item['title']) ?>
          </h3>
          <div class="tw-absolute tw-bottom-0 tw-left-0 tw-h-[3px] tw-w-[42px] tw-bg-power"></div>
          <div class="tw-absolute tw-bottom-0 tw-right-0 tw-m-4 tw-text-ink/50">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7M8 7h9v9"/></svg>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Bottom statement -->
    <div class="tw-mt-10 tw-flex tw-flex-col tw-items-start tw-gap-3 tw-pt-4 lg:tw-flex-row lg:tw-items-center lg:tw-justify-between">
      <div class="tw-flex tw-items-center tw-gap-3">
        <div class="tw-h-px tw-w-[45px] tw-bg-power"></div>
        <span class="tw-text-sm tw-text-ink/60">Travel comfortably. Explore freely. Experience more.</span>
      </div>
      <span class="tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-ink">Your journey, your way</span>
    </div>
  </div>
</section>

<!-- ============ Shared Tour Modal (Explore + Book Tour) ============ -->
<!-- Driven by the modal helper in assets/js/components/ui.js
     (window.pcModal), which replaced Bootstrap's Modal. data-pc-modal marks
     the shell, data-pc-modal-close any dismiss control; the helper adds the
     backdrop, traps body scroll and closes on Escape / backdrop click. -->
<div class="tw-hidden tw-fixed tw-inset-0 tw-z-[1055] tw-overflow-y-auto tw-overscroll-contain tw-px-4 tw-py-8" id="tourModal" data-pc-modal tabindex="-1" role="dialog" aria-labelledby="tourModalName" aria-hidden="true">
  <div class="tw-mx-auto tw-flex tw-min-h-full tw-items-center tw-opacity-0 tw-translate-y-3 tw-transition-[opacity,transform] tw-duration-200 [.is-open_&]:tw-opacity-100 [.is-open_&]:tw-translate-y-0 motion-reduce:tw-transition-none tw-max-w-[800px]">
    <div class="tw-w-full tw-overflow-hidden tw-rounded-[2rem] tw-bg-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.25)]">
      <div class="tw-sticky tw-top-0 tw-z-[1] tw-flex tw-items-start tw-justify-between tw-gap-4 tw-bg-white tw-px-6 tw-pt-6">
        <h2 class="tw-mb-0 tw-text-xl tw-font-bold tw-text-ink" id="tourModalName"><?= htmlspecialchars($reopenDestination['name'] ?? 'Destination') ?></h2>
        <button type="button" class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-black/[0.05] tw-text-ink/70 tw-transition-colors hover:tw-bg-black/10 hover:tw-text-ink" data-pc-modal-close aria-label="Close"><svg class="tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 3l10 10M13 3L3 13"/></svg></button>
      </div>
      <div class="tw-px-6 tw-pb-6 tw-pt-4">
        <img id="tourModalImg" src="<?= htmlspecialchars($reopenDestination['img'] ?? '') ?>" alt="" class="tw-mb-3 tw-aspect-video tw-w-full tw-rounded-2xl tw-object-cover" loading="lazy">
        <p class="tw-text-ink/60" id="tourModalDesc"><?= htmlspecialchars($reopenDestination['desc'] ?? '') ?></p>
        <p class="tw-mb-4 tw-flex tw-items-center tw-gap-1.5 tw-text-[1.0625rem] tw-leading-relaxed tw-font-semibold tw-text-ink">
          <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
          <span id="tourModalDuration"><?= htmlspecialchars($reopenDestination['duration'] ?? '') ?></span>
        </p>

        <div id="tourBookingForm">
          <h3 class="tw-mb-3 tw-text-base tw-font-bold tw-text-ink">Book This Tour</h3>
          <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
            <input type="hidden" name="destination" id="tourDestinationInput" value="<?= htmlspecialchars($old['destination'] !== '' ? $old['destination'] : $reopenDestinationName) ?>">
            <div>
              <label class="<?= $ctLabelClass ?>" for="ctFullName">Full Name</label>
              <input type="text" class="<?= $ctInputClass ?>" id="ctFullName" name="full_name" value="<?= htmlspecialchars($old['full_name']) ?>" required>
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
              <!-- pc-custom-datetime-enhance stays as a bare functional hook, driven by custom-datetime.js. -->
              <label class="<?= $ctLabelClass ?>" for="ctTourDate">Preferred Tour Date</label>
              <input type="date" class="<?= $ctInputClass ?> pc-custom-datetime-enhance" id="ctTourDate" name="tour_date" value="<?= htmlspecialchars($old['tour_date']) ?>" required>
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

<script src="<?= $assetPath ?>assets/js/components/city-tours.js"></script>
<script src="<?= $assetPath ?>assets/js/components/custom-datetime.js?v=<?= @filemtime(
  __DIR__ . '/assets/js/components/custom-datetime.js',
) ?>"></script>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
