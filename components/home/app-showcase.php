<?php
$appFeatures = [
  ['icon' => 'bi-cursor-fill', 't' => 'Book', 'd' => 'A ride in a few taps, wherever you are.'],
  ['icon' => 'bi-geo-alt-fill', 't' => 'Track', 'd' => 'Watch your driver move toward you, live.'],
  ['icon' => 'bi-credit-card-fill', 't' => 'Pay', 'd' => 'Cashless and secure, built in.'],
  ['icon' => 'bi-flag-fill', 't' => 'Arrive', 'd' => 'Step out. Rate your ride in seconds.'],
];
?>
<!-- ============ Section 04 / 10 -- The App, as the real product behind the site ============ -->
<section class="tw-relative tw-bg-ink2 tw-py-20 sm:tw-py-28 tw-overflow-hidden">
  <span class="tw-absolute tw-rounded-full tw-pointer-events-none" aria-hidden="true"
    style="right: -8rem; top: 10%; width: 30rem; height: 30rem; background: radial-gradient(circle, rgba(255,122,0,.16), transparent 70%); filter: blur(60px);"></span>

  <div class="container tw-relative">
    <div class="tw-grid lg:tw-grid-cols-2 tw-gap-14 lg:tw-gap-10 tw-items-center">

      <!-- Phone: visually dominant, floating -->
      <div class="pc-reveal tw-order-2 lg:tw-order-1 tw-flex tw-justify-center">
        <div class="tw-animate-float motion-reduce:tw-animate-none" style="filter: drop-shadow(0 40px 60px rgba(0,0,0,.5));">
          <?php
          $mockupImage = 'download-app.jpeg';
          $mockupAlt = 'PowerCabs app screen showing a route from Dublin Airport to Temple Bar';
          $mockupMaxWidth = '320px';
          require __DIR__ . '/../shared/app-mockup.php';
          ?>
        </div>
      </div>

      <!-- Copy + features + store badges -->
      <div class="pc-reveal tw-order-1 lg:tw-order-2">
        <p class="tw-inline-flex tw-items-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-text-powerlight tw-mb-4">
          <span class="tw-inline-block tw-w-6 tw-h-px tw-bg-powerlight"></span>
          The PowerCabs App
        </p>
        <h2 class="tw-font-extrabold tw-text-white tw-leading-[0.95] tw-tracking-tight tw-text-[clamp(2.4rem,6vw,4.2rem)] tw-mb-5">
          Power in<br>your pocket.
        </h2>
        <p class="tw-text-white/55 tw-text-[1.05rem] tw-max-w-[42ch] tw-mb-8">
          Booking a cab with PowerCabs is easier than ever. Download the app
          and enjoy the convenience of booking a ride with just a few taps.
        </p>

        <div class="tw-grid tw-grid-cols-2 tw-gap-x-6 tw-gap-y-6 tw-mb-9">
          <?php foreach ($appFeatures as $f): ?>
            <div class="tw-flex tw-items-start tw-gap-3">
              <span class="tw-inline-flex tw-items-center tw-justify-center tw-w-10 tw-h-10 tw-rounded-full tw-bg-white/[0.06] tw-border tw-border-white/10 tw-flex-shrink-0">
                <i class="bi <?= $f['icon'] ?> tw-text-power" aria-hidden="true"></i>
              </span>
              <span>
                <span class="tw-block tw-text-white tw-font-bold tw-text-[.95rem]"><?= $f['t'] ?></span>
                <span class="tw-block tw-text-white/45 tw-text-[.82rem] tw-leading-snug tw-max-w-[18ch]"><?= $f['d'] ?></span>
              </span>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="tw-flex tw-flex-wrap tw-gap-2">
          <a class="pc-store-badge pc-store-badge-lg d-inline-flex align-items-center text-decoration-none" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" aria-hidden="true">
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow d-block text-uppercase">Get it on</span>
              <span class="pc-store-badge-title d-block fw-bold text-white">Google Play</span>
            </span>
          </a>
          <a class="pc-store-badge pc-store-badge-lg d-inline-flex align-items-center text-decoration-none" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
            <i class="bi bi-apple text-white fs-5" aria-hidden="true"></i>
            <span class="d-flex flex-column text-start">
              <span class="pc-store-badge-eyebrow d-block text-uppercase">Download on the</span>
              <span class="pc-store-badge-title d-block fw-bold text-white">App Store</span>
            </span>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
