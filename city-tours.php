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
$heroBgImage = 'https://images.pexels.com/photos/10725916/pexels-photo-10725916.jpeg?auto=format&fit=crop&w=1200&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$destinations = [
  [
    'name' => 'Dublin City',
    'desc' =>
      "Explore Dublin's rich history, museums, Georgian architecture, Temple Bar, Trinity College and vibrant shopping districts.",
    'duration' => 'Half-Day Tour',
    'img' => 'https://images.pexels.com/photos/10725916/pexels-photo-10725916.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => 'Cliffs of Moher',
    'desc' => "Experience Ireland's spectacular Atlantic coastline with breathtaking panoramic cliff views.",
    'duration' => 'Full-Day Tour',
    'img' => 'https://images.pexels.com/photos/38110027/pexels-photo-38110027.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => "Giant's Causeway",
    'desc' => 'Visit the UNESCO World Heritage Site famous for its unique basalt columns.',
    'duration' => 'Full-Day Tour',
    'img' => 'https://images.pexels.com/photos/34936223/pexels-photo-34936223.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => 'Wicklow Mountains',
    'desc' => 'Discover scenic valleys, forests, lakes and Glendalough Monastery.',
    'duration' => 'Half-Day Tour',
    'img' => 'https://images.pexels.com/photos/28430310/pexels-photo-28430310.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => 'Kilkenny',
    'desc' => "Explore Ireland's medieval city featuring Kilkenny Castle and charming streets.",
    'duration' => 'Full-Day Tour',
    'img' => 'https://images.pexels.com/photos/23995753/pexels-photo-23995753.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => 'Galway',
    'desc' => 'Experience traditional Irish culture, colorful streets and lively music.',
    'duration' => 'Full-Day Tour',
    'img' => 'https://images.pexels.com/photos/33943881/pexels-photo-33943881.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => 'Ring of Kerry',
    'desc' => "One of Ireland's most famous scenic coastal drives.",
    'duration' => 'Full-Day Tour',
    'img' => 'https://images.pexels.com/photos/37685449/pexels-photo-37685449.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => 'Blarney Castle',
    'desc' => 'Visit the legendary Blarney Stone and beautiful castle gardens.',
    'duration' => 'Full-Day Tour',
    'img' => 'https://images.pexels.com/photos/28959919/pexels-photo-28959919.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => 'Belfast',
    'desc' => "Explore Northern Ireland's capital including Titanic Belfast and historic landmarks.",
    'duration' => 'Full-Day Tour',
    'img' => 'https://images.pexels.com/photos/19045507/pexels-photo-19045507.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
  [
    'name' => 'Cork',
    'desc' => "Discover Ireland's southern capital with markets, riverside walks and historic sites.",
    'duration' => 'Full-Day Tour',
    'img' => 'https://images.pexels.com/photos/6355033/pexels-photo-6355033.jpeg?auto=format&fit=crop&w=1200&q=60',
  ],
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
  [
    'title' => 'Private transportation',
    'icon' => 'bi-car-front-fill',
  ],
  [
    'title' => 'Flexible itinerary',
    'icon' => 'bi-signpost-split-fill',
  ],
  [
    'title' => 'Professional local drivers',
    'icon' => 'bi-person-badge-fill',
  ],
  [
    'title' => 'Door-to-door pickup',
    'icon' => 'bi-house-door-fill',
  ],
  [
    'title' => 'Comfortable vehicles',
    'icon' => 'bi-stars',
  ],
  [
    'title' => 'Family friendly',
    'icon' => 'bi-people-fill',
  ],
  [
    'title' => 'Group tours available',
    'icon' => 'bi-people',
  ],
  [
    'title' => 'Full day & half day options',
    'icon' => 'bi-clock-fill',
  ],
];
?>

<?php if ($formStatus): ?>
  <script>window.pcCityToursFormSubmitted = true;</script>
<?php endif; ?>
<?php if ($hourlyFormStatus): ?>
  <script>window.pcHourlyFormSubmitted = true;</script>
<?php endif; ?>

<!-- ============ Pay Per Hour ============ -->
<section class="section-pc pb-0">
  <div class="container">
    <div class="row align-items-center gy-4 pc-hourly-band position-relative overflow-hidden rounded-4 p-4 p-md-5"
      style="background-image: url('https://images.unsplash.com/photo-1603934631592-40d9f2e67702?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
      <span class="pc-hourly-band-scrim position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"></span>
      <div class="col-lg-9 position-relative">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange-light);">/ Pay Per Hour</p>
        <h2 class="mb-2 text-white">Prefer to Explore at Your Own Pace?</h2>
        <p class="mb-0" style="max-width: 62ch; color: rgba(255,255,255,.85);">
          Hire a PowerCabs driver by the hour instead -- no fixed itinerary, just
          you, your driver and as much time as you need around Dublin.
        </p>
      </div>
      <div class="col-lg-3 text-lg-end position-relative">
        <button type="button" class="btn btn-outline-primary btn-md rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#hourlyModal">
          Book Per Hour
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ============ Featured Destinations ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Featured Destinations</p>
      <h2 class="mb-0">Where Would You Like to Go?</h2>
    </div>
    <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-lg-4">
      <?php foreach ($destinations as $d): ?>
        <div class="col">
          <div class="pc-tour-card bg-white h-100 overflow-hidden">
            <div class="pc-tour-card-img-wrap overflow-hidden position-relative">
              <img src="<?= htmlspecialchars($d['img']) ?>" alt="<?= htmlspecialchars(
  $d['name'],
) ?>" class="pc-tour-card-img w-100 h-100 object-fit-cover" loading="lazy">
            </div>
            <div class="p-4">
              <h3 class="fs-5 fw-bold mb-2"><?= htmlspecialchars($d['name']) ?></h3>
              <p class="small text-muted-pc mb-3"><?= htmlspecialchars($d['desc']) ?></p>
              <div class="d-flex">
                <button type="button" class="btn btn-pc-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#tourModal" data-scroll-to-form="true"
                  data-tour-name="<?= htmlspecialchars($d['name']) ?>" data-tour-desc="<?= htmlspecialchars(
  $d['desc'],
) ?>" data-tour-duration="<?= htmlspecialchars($d['duration']) ?>" data-tour-img="<?= htmlspecialchars($d['img']) ?>">
                  Book Tour
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Why Choose Our Tours ============ -->
<section class="section-pc position-relative overflow-hidden" style="background: linear-gradient(180deg, var(--pc-cream) 0%, var(--pc-cream) 55%, #ffffff 100%);" >
    <div class="container py-5 py-lg-6">
        <div class="row align-items-end mb-5 pb-lg-3">
            <div class="col-lg-7">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="d-inline-block rounded-circle"
                          style="width:8px;height:8px;background:var(--pc-orange);"></span>
                    <span class="small fw-bold text-uppercase"
                          style="letter-spacing:.12em;color:var(--pc-orange);">
                        Why Choose Our Tours
                    </span>
                </div>
                <h2 class="display-5 fw-bold mb-0"
                    style="letter-spacing:-.035em;">
                    Ireland, <span class="fw-normal">at Your Own Pace</span>
                </h2>
            </div>

            <div class="col-lg-4 ms-auto mt-4 mt-lg-0">
                <p class="mb-0 text-secondary lh-lg">
                    Discover Ireland with the freedom to travel your way,
                    supported by local expertise, comfort and flexibility.
                </p>
            </div>
        </div>

        <!-- Features -->
        <div class="row g-3 g-lg-4">
            <?php foreach ($whyChooseTours as $index => $item): ?>
                <div class="col-6 col-lg-3">
                    <div class="position-relative h-100 overflow-hidden rounded-4 p-4 p-lg-4"
                         style="
                            background:#fff;
                            min-height:245px;
                            border:1px solid rgba(0,0,0,.06);
                            transition:all .3s ease;
                         ">
                        <div class="position-absolute top-0 end-0 fw-bold"
                             style="
                                font-size:5rem;
                                line-height:1;
                                color:rgba(0,0,0,.035);
                                transform:translate(8px,-5px);
                             ">
                            <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-3 mb-4"
                             style="
                                width:52px;
                                height:52px;
                                background:rgba(<?php  ?>);
                                background:#fff4ec;
                                color:var(--pc-orange);
                                font-size:21px;
                             ">
                            <i class="bi <?= htmlspecialchars($item['icon']) ?>"></i>
                        </div>
                        <h3 class="fw-bold mb-3"
                            style="
                                font-size:1rem;
                                line-height:1.45;
                                max-width:180px;
                            ">
                            <?= htmlspecialchars($item['title']) ?>
                        </h3>
                        <div class="position-absolute bottom-0 start-0"
                             style="
                                width:42px;
                                height:3px;
                                background:var(--pc-orange);
                             ">
                        </div>
                        <div class="position-absolute bottom-0 end-0 m-4 text-secondary">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Bottom statement -->
        <div class="row mt-5 pt-4 align-items-center">
            <div class="col-lg-8">
                <div class="d-flex align-items-center gap-3">
                    <div style="width:45px;height:1px;background:var(--pc-orange);"></div>
                    <span class="small text-secondary">
                        Travel comfortably. Explore freely. Experience more.
                    </span>
                </div>
            </div>

            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <span class="small fw-semibold text-uppercase"
                      style="letter-spacing:.08em;">
                    Your journey, your way
                </span>
            </div>
        </div>
    </div>
</section>


<!-- ============ Shared Tour Modal (Explore + Book Tour) ============ -->
<div class="modal fade" id="tourModal" tabindex="-1" aria-labelledby="tourModalName">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header border-0 pb-0 pc-tour-modal-header position-sticky top-0 bg-white">
        <h2 class="modal-title fs-4 fw-bold" id="tourModalName"><?= htmlspecialchars(
          $reopenDestination['name'] ?? 'Destination',
        ) ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="tourModalImg" src="<?= htmlspecialchars(
          $reopenDestination['img'] ?? '',
        ) ?>" alt="" class="pc-tour-modal-img w-100 object-fit-cover mb-3" loading="lazy">
        <p class="text-muted-pc" id="tourModalDesc"><?= htmlspecialchars($reopenDestination['desc'] ?? '') ?></p>
        <p class="small fw-semibold mb-4"><i class="bi bi-clock" style="color: var(--pc-orange);"></i> <span id="tourModalDuration"><?= htmlspecialchars(
          $reopenDestination['duration'] ?? '',
        ) ?></span></p>

        <div id="tourBookingForm">
          <h3 class="fs-6 fw-bold mb-3">Book This Tour</h3>
          <form method="post" action="" class="row g-3">
            <input type="hidden" name="destination" id="tourDestinationInput" value="<?= htmlspecialchars(
              $old['destination'] !== '' ? $old['destination'] : $reopenDestinationName,
            ) ?>">
            <div class="col-md-6">
              <label class="form-label" for="ctFullName">Full Name</label>
              <input type="text" class="form-control" id="ctFullName" name="full_name" value="<?= htmlspecialchars(
                $old['full_name'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctEmail">Email Address</label>
              <input type="email" class="form-control" id="ctEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctMobile">Mobile Number</label>
              <input type="tel" class="form-control" id="ctMobile" name="mobile" value="<?= htmlspecialchars(
                $old['mobile'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctPeopleCount">Number of People</label>
              <input type="number" min="1" class="form-control" id="ctPeopleCount" name="people_count" value="<?= htmlspecialchars(
                $old['people_count'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctTourDate">Preferred Tour Date</label>
              <input type="date" class="form-control" id="ctTourDate" name="tour_date" value="<?= htmlspecialchars(
                $old['tour_date'],
              ) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctPickup">Pickup Location</label>
              <input type="text" class="form-control" id="ctPickup" name="pickup_location" value="<?= htmlspecialchars(
                $old['pickup_location'],
              ) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label" for="ctRequests">Special Requests <span class="text-muted-pc fw-normal">(optional)</span></label>
              <textarea class="form-control" id="ctRequests" name="special_requests" rows="3"><?= htmlspecialchars(
                $old['special_requests'],
              ) ?></textarea>
            </div>
            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
                <span>Submit Booking</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your <?= htmlspecialchars(
                $bookedDestination ?? 'tour',
              ) ?> booking request has been sent. We'll confirm shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars(
                $formError,
              ) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ============ Pay Per Hour Modal ============ -->
<div class="modal fade" id="hourlyModal" tabindex="-1" aria-labelledby="hourlyModalLabel">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header border-0 pb-0 pc-tour-modal-header position-sticky top-0 bg-white">
        <h2 class="modal-title fs-4 fw-bold" id="hourlyModalLabel">Pay Per Hour Booking</h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p class="text-muted-pc">
          Book a driver by the hour -- stay as long as you like at each stop, with
          no fixed itinerary.
        </p>

        <h3 class="fs-6 fw-bold mb-3">Book Your Hours</h3>
        <form method="post" action="" class="row g-3">
          <input type="hidden" name="form_type" value="pay_per_hour">
          <div class="col-md-6">
            <label class="form-label" for="phFullName">Full Name</label>
            <input type="text" class="form-control" id="phFullName" name="full_name" value="<?= htmlspecialchars(
              $hourlyOld['full_name'],
            ) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="phEmail">Email Address</label>
            <input type="email" class="form-control" id="phEmail" name="email" value="<?= htmlspecialchars(
              $hourlyOld['email'],
            ) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="phMobile">Mobile Number</label>
            <input type="tel" class="form-control" id="phMobile" name="mobile" value="<?= htmlspecialchars(
              $hourlyOld['mobile'],
            ) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="phPeopleCount">Number of People</label>
            <input type="number" min="1" class="form-control" id="phPeopleCount" name="people_count" value="<?= htmlspecialchars(
              $hourlyOld['people_count'],
            ) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="phHours">Number of Hours</label>
            <input type="number" min="1" class="form-control" id="phHours" name="hours" value="<?= htmlspecialchars(
              $hourlyOld['hours'],
            ) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="phDate">Preferred Date</label>
            <input type="date" class="form-control" id="phDate" name="tour_date" min="<?= htmlspecialchars(
              $hourlyMinDate,
            ) ?>" value="<?= htmlspecialchars($hourlyOld['tour_date']) ?>" required>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="phTime">Preferred Time</label>
            <input type="time" class="form-control" id="phTime" name="tour_time" value="<?= htmlspecialchars(
              $hourlyOld['tour_time'],
            ) ?>" required>
          </div>
          <div class="col-12">
            <label class="form-label" for="phPickup">Pickup Location</label>
            <input type="text" class="form-control" id="phPickup" name="pickup_location" value="<?= htmlspecialchars(
              $hourlyOld['pickup_location'],
            ) ?>" required>
          </div>
          <div class="col-12">
            <label class="form-label" for="phRequests">Special Requests <span class="text-muted-pc fw-normal">(optional)</span></label>
            <textarea class="form-control" id="phRequests" name="special_requests" rows="3"><?= htmlspecialchars(
              $hourlyOld['special_requests'],
            ) ?></textarea>
          </div>
          <div class="col-12 pt-2">
            <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
              <span>Submit Booking</span>
              <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
            </button>
          </div>

          <?php if ($hourlyFormStatus === 'success'): ?>
            <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your Pay Per Hour booking request has been sent. We'll confirm shortly.</div></div>
          <?php elseif ($hourlyFormStatus === 'error'): ?>
            <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars(
              $hourlyFormError,
            ) ?></div></div>
          <?php endif; ?>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="<?= $assetPath ?>assets/js/components/city-tours.js"></script>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
 ?>
