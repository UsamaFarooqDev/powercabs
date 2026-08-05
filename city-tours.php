<?php
$pageTitle       = 'City Tours | PowerCabs';
$pageDescription = "Explore Ireland's most iconic destinations with PowerCabs -- private transportation with professional local drivers to Dublin, the Cliffs of Moher, Giant's Causeway and more.";
$assetPath       = '';

require __DIR__ . '/includes/mail-config.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError  = '';
$old = ['destination' => '', 'full_name' => '', 'email' => '', 'mobile' => '', 'people_count' => '', 'tour_date' => '', 'pickup_location' => '', 'special_requests' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['destination'] === '' || $old['full_name'] === '' || $old['email'] === '' || $old['mobile'] === '' || $old['people_count'] === '' || $old['tour_date'] === '' || $old['pickup_location'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $body = "New City Tour booking request.\n\n"
              . "Destination: {$old['destination']}\n"
              . "Full Name: {$old['full_name']}\n"
              . "Email: {$old['email']}\n"
              . "Mobile Number: {$old['mobile']}\n"
              . "Number of People: {$old['people_count']}\n"
              . "Preferred Tour Date: {$old['tour_date']}\n"
              . "Pickup Location: {$old['pickup_location']}\n\n"
              . "Special Requests:\n" . ($old['special_requests'] !== '' ? $old['special_requests'] : '-') . "\n";

        $result = pc_send_mail(
            'City Tour booking: ' . $old['destination'],
            $body,
            ['name' => $old['full_name'], 'email' => $old['email']]
        );

        if ($result['success']) {
            $formStatus = 'success';
            $bookedDestination = $old['destination'];
            foreach ($old as $key => $default) {
                $old[$key] = '';
            }
        } else {
            $formStatus = 'error';
            $formError  = 'Sorry, something went wrong sending your booking. Please try again or call us directly.';
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ City Tours';
$heroTitleLight  = 'City';
$heroTitleBold   = 'Tours.';
$heroDescription = "Explore Ireland's most iconic destinations with PowerCabs. Whether you're visiting historic landmarks, breathtaking coastal scenery, charming villages, or famous attractions, enjoy comfortable private transportation with professional local drivers.";
$heroBgImage     = 'https://images.pexels.com/photos/10725916/pexels-photo-10725916.jpeg?auto=format&fit=crop&w=1200&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$destinations = [
  ['name' => 'Dublin City',       'desc' => "Explore Dublin's rich history, museums, Georgian architecture, Temple Bar, Trinity College and vibrant shopping districts.",   'duration' => 'Half-Day Tour', 'img' => 'https://images.pexels.com/photos/10725916/pexels-photo-10725916.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Cliffs of Moher',   'desc' => "Experience Ireland's spectacular Atlantic coastline with breathtaking panoramic cliff views.",                                 'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/38110027/pexels-photo-38110027.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => "Giant's Causeway",  'desc' => 'Visit the UNESCO World Heritage Site famous for its unique basalt columns.',                                                   'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/34936223/pexels-photo-34936223.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Wicklow Mountains', 'desc' => 'Discover scenic valleys, forests, lakes and Glendalough Monastery.',                                                            'duration' => 'Half-Day Tour', 'img' => 'https://images.pexels.com/photos/28430310/pexels-photo-28430310.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Kilkenny',          'desc' => "Explore Ireland's medieval city featuring Kilkenny Castle and charming streets.",                                              'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/23995753/pexels-photo-23995753.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Galway',            'desc' => 'Experience traditional Irish culture, colorful streets and lively music.',                                                     'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/33943881/pexels-photo-33943881.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Ring of Kerry',     'desc' => "One of Ireland's most famous scenic coastal drives.",                                                                          'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/37685449/pexels-photo-37685449.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Blarney Castle',    'desc' => 'Visit the legendary Blarney Stone and beautiful castle gardens.',                                                              'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/28959919/pexels-photo-28959919.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Belfast',           'desc' => "Explore Northern Ireland's capital including Titanic Belfast and historic landmarks.",                                        'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/19045507/pexels-photo-19045507.jpeg?auto=format&fit=crop&w=1200&q=60'],
  ['name' => 'Cork',              'desc' => "Discover Ireland's southern capital with markets, riverside walks and historic sites.",                                       'duration' => 'Full-Day Tour', 'img' => 'https://images.pexels.com/photos/6355033/pexels-photo-6355033.jpeg?auto=format&fit=crop&w=1200&q=60'],
];

$reopenDestinationName = $formStatus === 'success' ? ($bookedDestination ?? '') : $old['destination'];
$reopenDestination = null;
foreach ($destinations as $d) {
    if ($d['name'] === $reopenDestinationName) {
        $reopenDestination = $d;
        break;
    }
}

$whyChooseTours = ['Private transportation', 'Flexible itinerary', 'Professional local drivers', 'Door-to-door pickup', 'Comfortable vehicles', 'Family friendly', 'Group tours available', 'Full day & half day options'];

$tourBookingSteps = [
  ['n' => 1, 'title' => 'Select Destination'],
  ['n' => 2, 'title' => 'View Destination Details'],
  ['n' => 3, 'title' => 'Book Preferred Date'],
  ['n' => 4, 'title' => 'Enjoy Your Tour'],
];
?>

<?php if ($formStatus): ?>
  <script>window.pcCityToursFormSubmitted = true;</script>
<?php endif; ?>

<!-- ============ Featured Destinations ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Featured Destinations</p>
      <h2 class="mb-0">Where Would You Like to Go?</h2>
    </div>
    <div class="row g-4 row-cols-2 row-cols-lg-4">
      <?php foreach ($destinations as $d): ?>
        <div class="col">
          <div class="pc-tour-card bg-white h-100 overflow-hidden">
            <div class="pc-tour-card-img-wrap overflow-hidden position-relative">
              <img src="<?= htmlspecialchars($d['img']) ?>" alt="<?= htmlspecialchars($d['name']) ?>" class="pc-tour-card-img w-100 h-100 object-fit-cover" loading="lazy">
            </div>
            <div class="p-4">
              <h3 class="fs-5 fw-bold mb-2"><?= htmlspecialchars($d['name']) ?></h3>
              <p class="small text-muted-pc mb-3"><?= htmlspecialchars($d['desc']) ?></p>
              <div class="d-flex">
                <button type="button" class="btn btn-pc-primary btn-sm rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#tourModal" data-scroll-to-form="true"
                  data-tour-name="<?= htmlspecialchars($d['name']) ?>" data-tour-desc="<?= htmlspecialchars($d['desc']) ?>" data-tour-duration="<?= htmlspecialchars($d['duration']) ?>" data-tour-img="<?= htmlspecialchars($d['img']) ?>">
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
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Why Choose Our Tours</p>
      <h2 class="mb-0">Ireland, at Your Own Pace</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-4 g-0 border-top border-start">
        <?php foreach ($whyChooseTours as $item): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <i class="bi bi-check-circle-fill fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-0 pc-why-item-title"><?= htmlspecialchars($item) ?></h3>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ Booking Process ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Booking Process</p>
      <h2 class="mb-0">Four Steps to Your Next Day Out</h2>
    </div>
    <div class="row g-3">
      <?php foreach ($tourBookingSteps as $step): ?>
        <div class="col-md-6 col-lg-3">
          <div class="pc-story-card rounded-4 p-4 bg-white h-100 text-center">
            <span class="pc-story-star-icon mx-auto mb-3"><?= $step['n'] ?></span>
            <h3 class="fs-6 fw-bold mb-0"><?= htmlspecialchars($step['title']) ?></h3>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Shared Tour Modal (Explore + Book Tour) ============ -->
<!-- No static aria-hidden here -- Bootstrap's modal JS adds/removes it
     (along with aria-modal/role) as part of show()/hide(); a hardcoded
     aria-hidden="true" on this element races with focus being moved
     into it (both on a normal open and on the auto-reopen-after-submit
     path in city-tours.js), which is what the browser's "aria-hidden on
     an element that retains focus" warning was flagging. display:none
     (the .modal class's own default state) already keeps it out of the
     accessibility tree while closed, so nothing is lost by dropping it. -->
<div class="modal fade" id="tourModal" tabindex="-1" aria-labelledby="tourModalName">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header border-0 pb-0 pc-tour-modal-header position-sticky top-0 bg-white">
        <h2 class="modal-title fs-4 fw-bold" id="tourModalName"><?= htmlspecialchars($reopenDestination['name'] ?? 'Destination') ?></h2>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="tourModalImg" src="<?= htmlspecialchars($reopenDestination['img'] ?? '') ?>" alt="" class="pc-tour-modal-img w-100 object-fit-cover mb-3" loading="lazy">
        <p class="text-muted-pc" id="tourModalDesc"><?= htmlspecialchars($reopenDestination['desc'] ?? '') ?></p>
        <p class="small fw-semibold mb-4"><i class="bi bi-clock" style="color: var(--pc-orange);"></i> <span id="tourModalDuration"><?= htmlspecialchars($reopenDestination['duration'] ?? '') ?></span></p>

        <div id="tourBookingForm">
          <h3 class="fs-6 fw-bold mb-3">Book This Tour</h3>
          <form method="post" action="" class="row g-3">
            <input type="hidden" name="destination" id="tourDestinationInput" value="<?= htmlspecialchars($old['destination'] !== '' ? $old['destination'] : $reopenDestinationName) ?>">
            <div class="col-md-6">
              <label class="form-label" for="ctFullName">Full Name</label>
              <input type="text" class="form-control" id="ctFullName" name="full_name" value="<?= htmlspecialchars($old['full_name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctEmail">Email Address</label>
              <input type="email" class="form-control" id="ctEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctMobile">Mobile Number</label>
              <input type="tel" class="form-control" id="ctMobile" name="mobile" value="<?= htmlspecialchars($old['mobile']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctPeopleCount">Number of People</label>
              <input type="number" min="1" class="form-control" id="ctPeopleCount" name="people_count" value="<?= htmlspecialchars($old['people_count']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctTourDate">Preferred Tour Date</label>
              <input type="date" class="form-control" id="ctTourDate" name="tour_date" value="<?= htmlspecialchars($old['tour_date']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="ctPickup">Pickup Location</label>
              <input type="text" class="form-control" id="ctPickup" name="pickup_location" value="<?= htmlspecialchars($old['pickup_location']) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label" for="ctRequests">Special Requests <span class="text-muted-pc fw-normal">(optional)</span></label>
              <textarea class="form-control" id="ctRequests" name="special_requests" rows="3"><?= htmlspecialchars($old['special_requests']) ?></textarea>
            </div>
            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
                <span>Submit Booking</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your <?= htmlspecialchars($bookedDestination ?? 'tour') ?> booking request has been sent. We'll confirm shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?= $assetPath ?>assets/js/components/city-tours.js"></script>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
