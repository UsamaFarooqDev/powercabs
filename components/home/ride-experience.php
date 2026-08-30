<?php
$rideSteps = [
  ['n' => '01', 't' => 'Book', 'd' => 'Set your pickup and destination in seconds, right from the app or website.'],
  ['n' => '02', 't' => 'Driver Found', 'd' => 'A licensed, Garda-vetted driver nearby is matched to your trip.'],
  ['n' => '03', 't' => 'On the Way', 'd' => 'Track the car in real time as it makes its way to your pickup point.'],
  ['n' => '04', 't' => 'Arrived', 'd' => 'Step in and go. Pay cashless, by card, or however suits you.'],
];
?>
<!-- ============ Section 03 -- The Ride Experience ============ -->
<section class="tw-relative tw-bg-ink2 tw-py-20 sm:tw-py-28 tw-overflow-hidden">
  <div class="container tw-relative">
    <div class="pc-reveal tw-max-w-[48ch] tw-mb-16 sm:tw-mb-20">
      <p class="tw-inline-flex tw-items-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-text-powerlight tw-mb-4">
        <span class="tw-inline-block tw-w-6 tw-h-px tw-bg-powerlight"></span>
        The Ride Experience
      </p>
      <h2 class="tw-font-extrabold tw-text-white tw-leading-[1] tw-tracking-tight tw-text-[clamp(2.2rem,5vw,3.5rem)] tw-mb-0">
        Getting there,<br>made simple.
      </h2>
    </div>

    <div class="pc-reveal tw-relative">
      <!-- Route line spanning the four stops -- fills in left-to-right once this row scrolls into view. -->
      <div class="tw-hidden lg:tw-block tw-absolute tw-top-6 tw-left-6 tw-right-6 tw-h-px tw-bg-white/10 tw-overflow-hidden">
        <div class="tw-h-full tw-w-full tw-bg-gradient-to-r tw-from-power tw-to-powerlight tw-origin-left tw-scale-x-0 tw-transition-transform tw-duration-[1600ms] tw-ease-out [.is-visible_&]:tw-scale-x-100"></div>
      </div>

      <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-4 tw-gap-y-12 tw-gap-x-8 tw-relative">
        <?php foreach ($rideSteps as $i => $step): ?>
          <div>
            <div class="tw-w-12 tw-h-12 tw-rounded-full tw-flex tw-items-center tw-justify-center tw-bg-ink2 tw-border-2 tw-border-power tw-text-power tw-font-bold tw-text-sm tw-mb-6 tw-relative tw-z-10">
              <?= $step['n'] ?>
            </div>
            <h3 class="tw-text-white tw-font-bold tw-text-xl tw-mb-2"><?= htmlspecialchars($step['t']) ?></h3>
            <p class="tw-text-white/50 tw-text-[.92rem] tw-leading-relaxed tw-max-w-[26ch] tw-mb-0"><?= htmlspecialchars($step['d']) ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
