<?php
$pageTitle       = 'Safety Tips for Drivers | PowerCabs';
$pageDescription = 'Safety guidance for PowerCabs drivers -- before, during and after every ride, plus emergency features, cashless payments and more.';
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Policies & Safety';
$heroTitleLight  = 'Safety Tips';
$heroTitleBold   = 'for Drivers.';
$heroDescription = 'Practical guidance to help you stay safe, confident and prepared on every trip -- before you set off, while you drive, and after you drop off.';
$heroBgImage     = 'https://images.pexels.com/photos/5834950/pexels-photo-5834950.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Driver Safety';
require __DIR__ . '/components/shared/inner-hero.php';

$beforeRide = [
  ['icon' => 'bi-person-vcard-fill', 'title' => 'Verify Passenger Identity',      'desc' => "Check the passenger's name and profile photo (if available) before allowing them into your vehicle."],
  ['icon' => 'bi-tools',             'title' => 'Keep Your Vehicle in Good Condition', 'desc' => 'Regularly inspect and maintain your vehicle -- brakes, tires, lights, and other essential safety components.'],
  ['icon' => 'bi-signpost-2-fill',   'title' => 'Plan Your Routes',              'desc' => 'Familiarize yourself with the area before starting, and use GPS to choose the safest and most efficient route.'],
];

$duringRide = [
  ['icon' => 'bi-speedometer2',     'title' => 'Follow Traffic Laws',   'desc' => 'Obey speed limits, traffic signals, and all road regulations.'],
  ['icon' => 'bi-phone-vibrate',    'title' => 'Minimize Distractions', 'desc' => 'Avoid using your phone while driving; use hands-free devices only when necessary.'],
  ['icon' => 'bi-lock-fill',        'title' => 'Keep Doors Locked',     'desc' => 'Lock vehicle doors while driving to prevent unauthorized access.'],
  ['icon' => 'bi-shield-check',     'title' => 'Trust Your Instincts',  'desc' => 'If a passenger makes you feel unsafe, you have the right to decline or end the ride.'],
  ['icon' => 'bi-lightbulb-fill',   'title' => 'Stay in Well-Lit Areas','desc' => 'Prefer pickups and drop-offs in busy, well-lit locations, especially at night.'],
];

$afterRide = [
  ['icon' => 'bi-phone-vibrate',  'title' => 'Stay Focused',          'desc' => 'Minimize distractions and remain focused before moving to your next trip.'],
  ['icon' => 'bi-lock-fill',      'title' => 'Keep Doors Locked',     'desc' => 'Keep your vehicle doors locked whenever appropriate.'],
  ['icon' => 'bi-shield-check',   'title' => 'Trust Your Instincts',  'desc' => 'Trust your instincts if any situation feels unsafe.'],
  ['icon' => 'bi-lightbulb-fill', 'title' => 'Well-Lit, Populated Areas', 'desc' => 'Continue choosing well-lit, populated areas when waiting for your next passenger.'],
];

$additionalTips = [
  ['icon' => 'bi-exclamation-triangle-fill', 'label' => "Learn how to use the app's emergency features"],
  ['icon' => 'bi-credit-card-2-front-fill',  'label' => 'Use cashless payments to reduce the need to carry cash'],
  ['icon' => 'bi-incognito',                 'label' => 'Avoid sharing personal information with passengers'],
  ['icon' => 'bi-battery-charging',          'label' => 'Keep your phone charged and share your working hours if possible'],
  ['icon' => 'bi-bag-heart-fill',            'label' => 'Carry a first aid kit, flashlight and fire extinguisher'],
  ['icon' => 'bi-award-fill',                'label' => 'Dress professionally and stay courteous throughout every journey'],
];
?>

<!-- ============ Before the Ride ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Before the Ride</p>
        <h2 class="mb-4">Set Yourself Up for a Safe Shift</h2>
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
      <div class="col-lg-6">
        <div class="rounded-4 overflow-hidden" style="aspect-ratio: 4/3;">
          <img src="https://images.pexels.com/photos/5834970/pexels-photo-5834970.jpeg?auto=format&fit=crop&w=1200&q=60" alt="A driver checking passenger details on their phone before a ride" class="w-100 h-100 object-fit-cover" loading="lazy">
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
      <h2 class="mb-0">Stay Alert, Stay in Control</h2>
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
  <img src="https://images.pexels.com/photos/5834921/pexels-photo-5834921.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: 0;" loading="lazy">
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true" style="background: rgba(10, 7, 5, 0.65); z-index: 0;"></span>
  <div class="container position-relative d-flex align-items-center justify-content-center" style="min-height: 280px;">
    <p class="fs-4 fw-bold text-white mb-0" style="max-width: 46ch;">Well-lit, busy pickup points keep every trip safer, day or night.</p>
  </div>
</section>

<!-- ============ After the Ride ============ -->
<section class="section-pc" style="background: var(--pc-cream);">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ After the Ride</p>
      <h2 class="mb-0">Carry the Same Care Into Your Next Trip</h2>
    </div>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-3">
      <?php foreach ($afterRide as $item): ?>
        <div class="col">
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

<!-- ============ Additional Tips ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-6 order-lg-2">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Additional Tips</p>
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
      <div class="col-lg-6 order-lg-1">
        <div class="rounded-4 overflow-hidden" style="aspect-ratio: 4/3;">
          <img src="https://images.pexels.com/photos/8681899/pexels-photo-8681899.jpeg?auto=format&fit=crop&w=1200&q=60" alt="PowerCabs 24/7 support ready to help drivers" class="w-100 h-100 object-fit-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="section-pc pt-0 text-center">
  <div class="container">
    <a class="btn btn-pc-dark px-4" href="<?= $assetPath ?>/safety-tips-riders">See Safety Tips for Riders &rarr;</a>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
