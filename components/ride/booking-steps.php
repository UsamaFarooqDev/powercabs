<?php

function pc_route_pattern_svg()
{
  ?>
  <svg class="position-absolute top-50 start-50 translate-middle pe-none" width="340" height="340" viewBox="0 0 320 320" fill="none" aria-hidden="true" style="max-width: 150%; opacity: .4;">
    <g stroke="rgba(28, 20, 16, .07)" stroke-width="4">
      <path d="M0,110 L320,90"></path>
      <path d="M0,250 L320,270"></path>
      <path d="M90,0 L110,320"></path>
      <path d="M230,0 L210,320"></path>
    </g>
    <path d="M40,270 L60,190 L150,180 L165,110 L260,90 L250,30" fill="none" stroke="var(--pc-orange)" stroke-opacity=".25" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="2 10"></path>
    <circle cx="40" cy="270" r="8" fill="#fff" stroke="var(--pc-orange)" stroke-opacity=".35" stroke-width="4"></circle>
    <circle cx="250" cy="30" r="8" fill="#fff" stroke="var(--pc-dark)" stroke-opacity=".25" stroke-width="4"></circle>
  </svg>
  <?php
}

$rideSteps = [
  [
    'n'     => '01',
    'title' => 'Enter Your Ride Details',
    'desc'  => 'Provide your pickup and drop-off locations to get started.',
    'img'   => 'enter-your-details.jpeg',
    'alt'   => 'PowerCabs app screen for entering pickup and drop-off details',
  ],
  [
    'n'     => '02',
    'title' => 'Select Ride Type',
    'desc'  => 'Choose a range of vehicles to suit your needs and budget.',
    'img'   => 'selec-ride-type.jpeg',
    'alt'   => 'PowerCabs app screen for selecting a ride type',
  ],
  [
    'n'     => '03',
    'title' => 'Find Your Driver',
    'desc'  => 'We match you with the closest available driver near you.',
    'img'   => 'findng-driver.jpeg',
    'alt'   => 'PowerCabs app screen finding a nearby driver',
  ],
  [
    'n'     => '04',
    'title' => 'Confirm Booking',
    'desc'  => 'Review & confirm your booking in a couple of taps.',
    'img'   => 'confirm-booking.jpeg',
    'alt'   => 'PowerCabs app screen confirming a ride booking',
  ],
  [
    'n'     => '05',
    'title' => 'Track Your Ride',
    'desc'  => 'Follow your driver in real time, from pickup to drop-off.',
    'img'   => 'track-ride.jpeg',
    'alt'   => 'PowerCabs app screen tracking a ride in progress',
  ],
];
?>

<style>
  .pc-book-step-tab {
    border: 1px solid rgba(28, 20, 16, .1);
    background: var(--pc-white);
    transition: border-color .25s ease, box-shadow .25s ease;
  }

  .pc-book-step-tab:hover {
    border-color: rgba(232, 89, 12, .4);
  }

  .pc-book-step-tab.is-active {
    border-color: var(--pc-orange);
    box-shadow: var(--pc-shadow-sm);
  }

  .pc-book-step-num {
    width: 40px;
    height: 40px;
    font-size: .85rem;
    border: 1px solid var(--pc-orange);
    color: var(--pc-orange);
  }

  .pc-book-step-title {
    font-size: 1.05rem;
    transition: color .25s ease;
  }

  .pc-book-step-tab.is-active .pc-book-step-title {
    color: var(--pc-orange);
  }

  .pc-book-step-desc {
    font-size: .9rem;
    margin-top: .1rem;
  }

  .pc-book-step-check {
    opacity: 0;
    font-size: 1.1rem;
    color: var(--pc-orange);
    transition: opacity .25s ease;
  }

  .pc-book-step-tab.is-active .pc-book-step-check {
    opacity: 1;
  }

  #pcBookStepScreen {
    transition: opacity .18s ease;
  }

  #pcBookStepScreen.pc-book-step-screen-fade {
    opacity: 0;
  }

  @media (prefers-reduced-motion: reduce) {
    .pc-book-step-tab,
    .pc-book-step-title,
    .pc-book-step-check,
    #pcBookStepScreen {
      transition: none;
    }
  }
</style>

<!-- ============ Book Your Ride ============ -->
<section class="section-pc position-relative overflow-hidden">
  <span class="pc-drive-blob pc-drive-blob-orange" aria-hidden="true"></span>

  <div class="container position-relative">
    <div class="text-center mb-5">
      <h2 class="mb-3">Simple Steps to Book Your Ride</h2>
      <p class="text-muted-pc mx-auto" style="max-width: 60ch; font-size:1.1rem">
        Book your ride easily through our app or website and enjoy a seamless journey
        every time. We monitor every trip you make, ensuring that you are never charged extra.
      </p>
    </div>

    <div class="row align-items-center gy-5" id="pcBookSteps">
      <div class="col-lg-5">
        <div class="d-flex flex-column gap-3" role="tablist" aria-label="Book Your Ride steps">
          <?php foreach ($rideSteps as $i => $step): ?>
            <button
              type="button"
              class="pc-book-step-tab d-flex align-items-center gap-3 text-start rounded-4 p-3<?= $i === 0 ? ' is-active' : '' ?>"
              data-image="<?= $assetPath ?>assets/img/<?= htmlspecialchars($step['img']) ?>"
              data-alt="<?= htmlspecialchars($step['alt']) ?>"
              role="tab"
              aria-selected="<?= $i === 0 ? 'true' : 'false' ?>"
            >
              <span class="pc-book-step-num flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle fw-medium"><?= htmlspecialchars($step['n']) ?></span>
              <span class="flex-grow-1">
                <span class="pc-book-step-title d-block fw-bold"><?= htmlspecialchars($step['title']) ?></span>
                <span class="pc-book-step-desc d-block text-muted-pc"><?= htmlspecialchars($step['desc']) ?></span>
              </span>
              <i class="bi bi-check-circle-fill pc-book-step-check flex-shrink-0" aria-hidden="true"></i>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-lg-7">
        <div class="position-relative d-flex justify-content-center py-3 py-lg-4">
          <?php pc_route_pattern_svg(); ?>
          <div class="position-relative z-1">
            <?php
              $mockupImage = $rideSteps[0]['img'];
              $mockupAlt   = $rideSteps[0]['alt'];
              $mockupNotch = true;
              $mockupFloat = true;
              $mockupImgId = 'pcBookStepScreen';
              require __DIR__ . '/../shared/app-mockup.php';
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/book-ride-steps.js"></script>
