<?php
$pageTitle       = 'Safety Tips for Riders | PowerCabs';
$pageDescription = 'Safety guidance for PowerCabs riders -- before, during and after every ride, plus using the emergency button, cashless payments and more.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Policies & Safety';
$heroTitleLight  = 'Safety Tips';
$heroTitleBold   = 'for Riders.';
$heroDescription = 'A few simple habits make every PowerCabs trip safer -- before you get in, while you ride, and after you arrive.';
$heroBgImage     = 'https://images.pexels.com/photos/13343433/pexels-photo-13343433.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Rider Safety';
require __DIR__ . '/components/shared/inner-hero.php';

$beforeRide = [
  ['icon' => 'bi-patch-check-fill', 'title' => 'Verify the Driver and Vehicle', 'desc' => "Check the driver's photo, vehicle model, and license plate against the details shown in the app before getting in."],
  ['icon' => 'bi-share-fill',       'title' => 'Share Your Trip',               'desc' => 'Share your live trip details with a trusted friend or family member so they can follow your journey.'],
  ['icon' => 'bi-lightbulb-fill',   'title' => 'Choose Safe Pickup Locations',  'desc' => 'Select well-lit and populated pickup and drop-off locations whenever possible.'],
];

$duringRide = [
  ['icon' => 'bi-person-arms-up',  'title' => 'Sit in the Back Seat',       'desc' => 'More personal space, and you can exit from either side if needed.'],
  ['icon' => 'bi-shield-check',    'title' => 'Wear Your Seatbelt',         'desc' => 'Always fasten your seatbelt, regardless of where you are sitting.'],
  ['icon' => 'bi-chat-dots-fill',  'title' => 'Keep Conversations General', 'desc' => 'Avoid sharing sensitive personal information with the driver.'],
  ['icon' => 'bi-signpost-2-fill', 'title' => 'Follow Your Route',          'desc' => 'Monitor your trip through the app and politely ask if the driver takes an unexpected route.'],
  ['icon' => 'bi-heart-pulse-fill','title' => 'Trust Your Instincts',       'desc' => 'If you ever feel unsafe, ask the driver to stop in a safe public location and end the ride.'],
];

$afterRide = [
  ['icon' => 'bi-star-fill',       'title' => 'Rate Your Driver', 'desc' => 'Leave honest ratings and feedback to help maintain service quality and safety.'],
  ['icon' => 'bi-flag-fill',       'title' => 'Report Any Issues', 'desc' => 'Immediately report any unusual, unsafe, or uncomfortable experience through the app or customer support.'],
];

$additionalTips = [
  ['icon' => 'bi-exclamation-triangle-fill', 'label' => "Learn how to use the app's emergency or panic button"],
  ['icon' => 'bi-credit-card-2-front-fill',  'label' => 'Prefer cashless payments for safer, more secure transactions'],
  ['icon' => 'bi-eye-fill',                  'label' => 'Stay aware of your surroundings before entering and after leaving the vehicle'],
  ['icon' => 'bi-phone-vibrate',             'label' => 'Avoid excessive phone use while walking to or from your pickup location'],
  ['icon' => 'bi-telephone-fill',            'label' => 'Keep emergency contacts easily accessible on your phone'],
];
?>

<!-- ============ Before the Ride ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6 order-lg-2">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Before the Ride</p>
        <h2 class="mb-4">Check Before You Get In</h2>
        <div class="d-flex flex-column gap-4">
          <?php foreach ($beforeRide as $item): ?>
            <div class="d-flex gap-3">
              <i class="bi <?= $item['icon'] ?> fs-3 flex-shrink-0" style="color: var(--pc-orange);"></i>
              <div>
                <h3 class="fs-6 fw-bold mb-1"><?= htmlspecialchars($item['title']) ?></h3>
                <p class="small text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="col-lg-6 order-lg-1">
        <div class="rounded-4 overflow-hidden" style="aspect-ratio: 4/3;">
          <img src="https://images.pexels.com/photos/15067166/pexels-photo-15067166.jpeg?auto=format&fit=crop&w=1200&q=60" alt="A PowerCabs taxi arriving for pickup" class="w-100 h-100 object-fit-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ During the Ride ============ -->
<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ During the Ride</p>
      <h2 class="mb-0">Small Habits, Safer Trips</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-5 g-0 border-top border-start">
        <?php foreach ($duringRide as $item): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-2 pc-why-item-title"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="small text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ============ Photo Banner ============ -->
<section class="position-relative overflow-hidden text-center text-white" style="min-height: 280px;">
  <img src="https://images.pexels.com/photos/7856880/pexels-photo-7856880.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: 0;" loading="lazy">
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true" style="background: rgba(10, 7, 5, 0.65); z-index: 0;"></span>
  <div class="container position-relative d-flex align-items-center justify-content-center" style="min-height: 280px;">
    <p class="fs-4 fw-bold text-white mb-0" style="max-width: 46ch;">Follow your trip live in the app, from pickup to drop-off.</p>
  </div>
</section>

<!-- ============ After the Ride ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ After the Ride</p>
      <h2 class="mb-0">Help Us Keep Every Trip Safe</h2>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 g-3 justify-content-center">
      <?php foreach ($afterRide as $item): ?>
        <div class="col" style="max-width: 360px;">
          <div class="rounded-4 p-4 bg-white h-100 text-center" style="box-shadow: var(--pc-shadow-sm);">
            <i class="bi <?= $item['icon'] ?> fs-3 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-2"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="small text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Additional Safety Tips ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Additional Safety Tips</p>
        <h2 class="mb-4">A Few More Habits Worth Building</h2>
        <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
          <?php foreach ($additionalTips as $tip): ?>
            <li class="d-flex gap-3">
              <i class="bi <?= $tip['icon'] ?> fs-5 flex-shrink-0" style="color: var(--pc-orange);"></i>
              <span class="text-muted-pc"><?= htmlspecialchars($tip['label']) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="col-lg-6">
        <div class="rounded-4 overflow-hidden" style="aspect-ratio: 4/3;">
          <img src="https://images.pexels.com/photos/31748308/pexels-photo-31748308.jpeg?auto=format&fit=crop&w=1200&q=60" alt="A passenger sitting comfortably in the back seat wearing a seatbelt" class="w-100 h-100 object-fit-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="section-pc pt-0 text-center">
  <div class="container">
    <a class="btn btn-pc-dark px-4" href="<?= $assetPath ?>/safety-tips-drivers.php">See Safety Tips for Drivers &rarr;</a>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
