<?php

function pc_route_pattern_svg()
{
  ?>
  <svg class="tw-pointer-events-none tw-absolute tw-left-1/2 tw-top-1/2 tw-max-w-[150%] -tw-translate-x-1/2 -tw-translate-y-1/2 tw-opacity-40" width="340" height="340" viewBox="0 0 320 320"
    fill="none" aria-hidden="true">
    <g stroke="rgba(28, 20, 16, .07)" stroke-width="4">
      <path d="M0,110 L320,90"></path>
      <path d="M0,250 L320,270"></path>
      <path d="M90,0 L110,320"></path>
      <path d="M230,0 L210,320"></path>
    </g>
    <path d="M40,270 L60,190 L150,180 L165,110 L260,90 L250,30" fill="none" stroke="var(--pc-orange)" stroke-opacity=".25"
      stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="2 10"></path>
    <circle cx="40" cy="270" r="8" fill="#fff" stroke="var(--pc-orange)" stroke-opacity=".35" stroke-width="4"></circle>
    <circle cx="250" cy="30" r="8" fill="#fff" stroke="var(--pc-dark)" stroke-opacity=".25" stroke-width="4"></circle>
  </svg>
  <?php
}

$rideSteps = [
  [
    'n' => '01',
    'title' => 'Enter Your Ride Details',
    'desc' => 'Provide your pickup and drop-off locations to get started.',
    'img' => 'ride-details.jpeg',
    'alt' => 'PowerCabs app screen for entering pickup and drop-off details',
  ],
  [
    'n' => '02',
    'title' => 'Select Ride Type',
    'desc' => 'Choose a range of vehicles to suit your needs and budget.',
    'img' => 'ride-type.jpeg',
    'alt' => 'PowerCabs app screen for selecting a ride type',
  ],
  [
    'n' => '03',
    'title' => 'Find Your Driver',
    'desc' => 'We match you with the closest available driver near you.',
    'img' => 'finding-driver.jpeg',
    'alt' => 'PowerCabs app screen finding a nearby driver',
  ],
  [
    'n' => '04',
    'title' => 'Confirm Booking',
    'desc' => 'Review & confirm your booking in a couple of taps.',
    'img' => 'booking-confirm.jpeg',
    'alt' => 'PowerCabs app screen confirming a ride booking',
  ],
  [
    'n' => '05',
    'title' => 'Track Your Ride',
    'desc' => 'Follow your driver in real time, from pickup to drop-off.',
    'img' => 'track-ride.jpeg',
    'alt' => 'PowerCabs app screen tracking a ride in progress',
  ],
];
?>

<section class="tw-relative tw-overflow-hidden tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <span class="tw-pointer-events-none tw-absolute tw-right-[-9rem] tw-top-16 tw-h-72 tw-w-72 tw-rounded-full tw-bg-[radial-gradient(circle,rgba(251,157,69,0.3),transparent_70%)] tw-blur-[55px]" aria-hidden="true"></span>

  <div class="tw-relative tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Simple Steps to Book Your Ride</h2>
      <p class="tw-mx-auto tw-max-w-[60ch] tw-text-[1.1rem] tw-text-ink/60">
        Book your ride easily through our app or website and enjoy a seamless journey
        every time. We monitor every trip you make, ensuring that you are never charged extra.
      </p>
    </div>

    <!-- Bare functional hooks -- book-ride-steps.js queries #pcBookSteps and
         .pc-book-step-tab directly, toggles .is-active, reads data-image/
         data-alt, and clone-swipes #pcBookStepScreen. The [&_.pc-phone-screen]:
         overrides reproduce the old #pcBookSteps .pc-phone-screen CSS override
         (a fixed height + absolutely-positioned image) that the swipe
         animation depends on, without touching the shared app-mockup.php
         partial's own default sizing used elsewhere. -->
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-12 [&_.pc-phone-screen]:tw-h-[519.6px] [&_.pc-phone-screen_img]:tw-absolute [&_.pc-phone-screen_img]:tw-inset-0 [&_.pc-phone-screen_img]:tw-h-full [&_.pc-phone-screen_img]:tw-w-full" id="pcBookSteps">
      <div class="lg:tw-col-span-5">
        <div class="tw-flex tw-flex-col tw-gap-3" role="tablist" aria-label="Book Your Ride steps">
          <?php foreach ($rideSteps as $i => $step): ?>
            <button type="button"
              class="pc-book-step-tab tw-flex tw-appearance-none tw-items-center tw-gap-3 tw-rounded-2xl tw-border tw-border-solid tw-border-black/10 tw-bg-white tw-p-3 tw-text-left tw-transition-colors tw-duration-200 hover:tw-border-power/40 [&.is-active]:tw-border-power [&.is-active]:tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]<?= $i ===
              0
                ? ' is-active'
                : '' ?>"
              data-image="<?= $assetPath ?>assets/img/<?= htmlspecialchars($step['img']) ?>"
              data-alt="<?= htmlspecialchars($step['alt']) ?>" role="tab"
              aria-selected="<?= $i === 0 ? 'true' : 'false' ?>">
              <span
                class="pc-book-step-num tw-flex tw-h-10 tw-w-10 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-power tw-text-[0.85rem] tw-font-medium tw-text-power"><?= htmlspecialchars(
                  $step['n'],
                ) ?></span>
              <span class="tw-flex-1">
                <span class="pc-book-step-title tw-block tw-text-[1.05rem] tw-font-bold tw-text-ink tw-transition-colors tw-duration-200 [.is-active_&]:tw-text-power"><?= htmlspecialchars(
                  $step['title'],
                ) ?></span>
                <span class="tw-mt-0.5 tw-block tw-text-sm tw-text-ink/60"><?= htmlspecialchars($step['desc']) ?></span>
              </span>
              <svg class="tw-h-[1.1rem] tw-w-[1.1rem] tw-shrink-0 tw-text-power tw-opacity-0 tw-transition-opacity tw-duration-200 [.is-active_&]:tw-opacity-100" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="lg:tw-col-span-7">
        <div class="tw-relative tw-flex tw-justify-center tw-py-3 lg:tw-py-4">
          <?php pc_route_pattern_svg(); ?>
          <div class="tw-relative tw-z-[1]">
            <?php
            $mockupImage = $rideSteps[0]['img'];
            $mockupAlt = $rideSteps[0]['alt'];
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
