<?php
$pageTitle = 'Dublin Airport Transfers & Meet and Greet | PowerCabs';
$pageDescription =
  'Reliable Dublin Airport taxi transfers with PowerCabs -- flight tracking, a personal Meet & Greet at arrivals, luggage assistance and a smooth transfer to your destination.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Airport Service';
$heroTitleLight = 'Meet &';
$heroTitleBold = 'Greet.';
$heroDescription =
  "Start or end your journey stress-free with PowerCabs' professional airport Meet & Greet service. Whether you're arriving for business or leisure, our experienced drivers monitor your flight, greet you at arrivals, assist with your luggage, and ensure a smooth, comfortable transfer to your destination. We also accommodate last-minute airport bookings whenever possible.";
$heroBgImage = 'https://images.pexels.com/photos/36498953/pexels-photo-36498953.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Meet & Greet';
require __DIR__ . '/components/shared/inner-hero.php';

$meetGreetServices = [
  [
    'icon' => 'bi-person-badge-fill',
    'title' => 'Personal Meet & Greet',
    'desc' => 'Your driver waits inside the arrivals terminal with a personalized name board.',
  ],
  [
    'icon' => 'bi-bag-check-fill',
    'title' => 'Luggage Assistance',
    'desc' => 'Professional assistance with luggage from the terminal to the vehicle.',
  ],
  [
    'icon' => 'bi-award-fill',
    'title' => 'Executive Airport Transfers',
    'desc' => 'Premium, comfortable vehicles for business and leisure travelers.',
  ],
  [
    'icon' => 'bi-people-fill',
    'title' => 'Family Airport Transfers',
    'desc' => 'Spacious vehicles for families with children and extra luggage.',
  ],
  [
    'icon' => 'bi-briefcase-fill',
    'title' => 'Business Travel',
    'desc' => 'Reliable airport transportation for corporate clients.',
  ],
  [
    'icon' => 'bi-clock-history',
    'title' => 'Last-Minute Bookings',
    'desc' => "We've got you covered even for last-minute airport bookings.",
  ],
];

$whyChoose = [
  'Professional licensed drivers',
  'Flight monitoring',
  'Fixed transparent pricing',
  'No hidden charges',
  '24/7 availability',
  'Comfortable vehicles',
  'Online booking',
  'Safe & reliable transportation',
];

$bookingSteps = [
  ['n' => 1, 'title' => 'Enter Flight Details'],
  ['n' => 2, 'title' => 'Choose Vehicle'],
  ['n' => 3, 'title' => 'Confirm Booking'],
  ['n' => 4, 'title' => 'Driver Meets You at Arrivals'],
];
?>

<!-- ============ Meet & Greet Intro ============ -->
<section class="section-pc">
  <div class="container">
    <div class="row align-items-center g-4 g-lg-5 p-3 p-lg-5">
      <div class="col-lg-6 p-2 p-lg-5">
        <h2 class="fw-bold mb-3" style="
            font-size: clamp(2.2rem, 4vw, 3.6rem);
            line-height: 1.1;
            letter-spacing: -.04em;
          ">
          Welcome
          <span style="color: var(--pc-orange);">
            from the moment you arrive.
          </span>
        </h2>
        <p class="text-muted-pc mb-4" style="
            max-width: 540px;
            font-size: 1.05rem;
            line-height: 1.75;
          ">
          Make your journey from the airport simple and stress-free.
          With PowerCabs Meet &amp; Greet, your driver is there to welcome
          you, assist with your luggage and get you comfortably on your way.
        </p>
        <div class="d-flex flex-wrap align-items-center gap-3">
          <a class="btn btn-pc-primary btn-md px-3" href="<?= $assetPath ?>/book-ride-online">Book a Meet &amp;
            Greet</a>
          <span class="small text-muted-pc">
            <i class="bi bi-check-circle-fill me-1" style="color: var(--pc-orange);"></i>
            Reliable airport transfers
          </span>
        </div>
      </div>

      <div class="col-lg-6 p-2 p-lg-5">
        <div class="position-relative mx-auto" style="max-width: 620px;">
          <div class="position-absolute rounded-5" aria-hidden="true" style="
              width: 150px;
              height: 150px;
              right: -20px;
              bottom: -20px;
              background: var(--pc-orange);
              opacity: .12;
              filter: blur(2px);
            "></div>
          <div class="position-relative overflow-hidden rounded-5" style="
              min-height: 420px;
              box-shadow: var(--pc-shadow-lg);
            ">
            <img src="<?= $assetPath ?>assets/img/meet-and-greet.png" alt="PowerCabs Meet and Greet airport transfer"
              class="w-100 h-100" loading="lazy" style="
                position: absolute;
                inset: 0;
                object-fit: cover;
                object-position: center;
              ">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ Our Meet & Greet Services ============ -->
<section class="section-pc">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ What's
        Included</p>
      <h2 class="mb-0">Our Meet &amp; Greet Services</h2>
    </div>
    <div class="row g-4">
      <?php foreach ($meetGreetServices as $s): ?>
        <div class="col-md-6 col-lg-4">
          <div class="pc-service-card rounded-4 p-4 bg-white h-100">
            <span class="d-inline-flex align-items-center justify-content-center rounded-3 mb-3"
              style="width: 48px; height: 48px; background: var(--pc-peach); color: var(--pc-orange);">
              <i class="bi <?= $s['icon'] ?> fs-5"></i>
            </span>
            <h3 class="fs-6 fw-bold mb-2"><?= htmlspecialchars($s['title']) ?></h3>
            <p class="small text-muted-pc mb-0"><?= htmlspecialchars($s['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<style>
  .pc-service-card {
    box-shadow: var(--pc-shadow-sm);
    border: 1px solid rgba(28, 20, 16, .05);
    transition: transform .2s ease, box-shadow .2s ease;
  }

  .pc-service-card:hover {
    box-shadow: var(--pc-shadow-md);
  }

  @media (prefers-reduced-motion: reduce) {
    .pc-service-card {
      transition: none;
    }

    .pc-service-card:hover {
      transform: none;
    }
  }
</style>

<!-- ============ Flight Path Scroll Animation ============ -->
<section class="pc-flight-banner position-relative overflow-hidden" id="pcFlightBanner">
  <img src="<?= $assetPath ?>assets/img/plane.avif" alt="" aria-hidden="true" class="pc-flight-plane position-absolute"
    id="pcFlightPlane">
  <img src="<?= $assetPath ?>assets/img/clouds.avif" alt="" aria-hidden="true"
    class="pc-flight-clouds position-absolute top-0 start-0 w-100 h-100" id="pcFlightCloudsFront" loading="lazy">

  <div class="pc-flight-text position-absolute bottom-0 start-0 w-100 text-center py-3">
    <div class="container">
      <h2 class="pc-flight-title fw-bold mb-1">Meet &amp; Greet, Made Easy</h2>
      <p class="pc-flight-subtitle text-muted-pc mb-0">From arrival to destination, PowerCabs makes every journey
        simple.</p>
    </div>
  </div>
</section>

<style>
  .pc-flight-banner {
    height: 90vh;
    min-height: 560px;
    background: linear-gradient(180deg, #0c1b2e 0%, #17395c 28%, #3f7cb0 55%, #bfe2f9 78%, #ffffff 100%);
  }

  .pc-flight-plane {
    top: 50%;
    left: 0;
    width: clamp(320px, 48vw, 680px);
    transform: translate3d(-15%, -50%, 0);
    transform-origin: center;
    z-index: 0;
    pointer-events: none;
    will-change: transform;
    filter: drop-shadow(0 14px 24px rgba(0, 0, 0, .35));
  }

  .pc-flight-clouds {
    z-index: 1;
    object-fit: cover;
    pointer-events: none;
    will-change: transform;
    -webkit-mask-image: linear-gradient(180deg, #000 0%, #000 65%, transparent 92%);
    mask-image: linear-gradient(180deg, #000 0%, #000 65%, transparent 92%);
  }

  .pc-flight-text {
    z-index: 2;
    pointer-events: none;
  }

  .pc-flight-title {
    font-size: clamp(1.25rem, 2.5vw, 1.75rem);
  }

  .pc-flight-subtitle {
    font-size: .95rem;
  }

  @media (prefers-reduced-motion: reduce) {
    .pc-flight-plane {
      transform: translate3d(40%, -50%, 0) !important;
    }
  }
</style>

<script>
  (function () {
    var section = document.getElementById('pcFlightBanner');
    var plane = document.getElementById('pcFlightPlane');
    var cloudsFront = document.getElementById('pcFlightCloudsFront');
    if (!section || !plane) return;
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var keyframes = [
      [0, -15],
      [0.25, 10],
      [0.5, 40],
      [0.75, 70],
      [1, 115]
    ];

    function progressToPercent(progress) {
      for (var i = 0; i < keyframes.length - 1; i++) {
        var a = keyframes[i], b = keyframes[i + 1];
        if (progress >= a[0] && progress <= b[0]) {
          var t = (progress - a[0]) / (b[0] - a[0]);
          return a[1] + (b[1] - a[1]) * t;
        }
      }
      return keyframes[keyframes.length - 1][1];
    }

    var isVisible = false;
    var rafId = null;
    var targetPlaneX = 0;
    var currentPlaneX = 0;
    var currentCloudX = 0;
    var initialised = false;
    var EASE = 0.09;
    var CLOUD_PARALLAX_RATIO = -0.12;

    function computeTarget() {
      var rect = section.getBoundingClientRect();
      var viewportH = window.innerHeight || document.documentElement.clientHeight;
      var progress = (viewportH - rect.top) / (rect.height + viewportH);
      progress = Math.max(0, Math.min(1, progress));

      var percent = progressToPercent(progress);
      targetPlaneX = rect.width * (percent / 100);

      if (!initialised) {
        currentPlaneX = targetPlaneX;
        currentCloudX = targetPlaneX * CLOUD_PARALLAX_RATIO;
        initialised = true;
      }
    }

    function tick() {
      rafId = null;
      if (!isVisible) return;

      currentPlaneX += (targetPlaneX - currentPlaneX) * EASE;
      var targetCloudX = targetPlaneX * CLOUD_PARALLAX_RATIO;
      currentCloudX += (targetCloudX - currentCloudX) * EASE;

      plane.style.transform = 'translate3d(' + currentPlaneX + 'px, -50%, 0)';
      if (cloudsFront) {
        cloudsFront.style.transform = 'translate3d(' + currentCloudX + 'px, 0, 0)';
      }

      rafId = requestAnimationFrame(tick);
    }

    function onScroll() {
      computeTarget();
      if (isVisible && rafId === null) {
        rafId = requestAnimationFrame(tick);
      }
    }

    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        isVisible = entry.isIntersecting;
        if (isVisible) {
          computeTarget();
          if (rafId === null) rafId = requestAnimationFrame(tick);
        } else if (rafId !== null) {
          cancelAnimationFrame(rafId);
          rafId = null;
        }
      });
    }, { threshold: 0 });

    observer.observe(section);
    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
  })();
</script>

<!-- ============ Photo Banner ============ -->
<section class="position-relative overflow-hidden text-center text-white" style="min-height: 280px;">
  <img src="https://images.pexels.com/photos/36377043/pexels-photo-36377043.jpeg?auto=format&fit=crop&w=1600&q=60"
    alt="" aria-hidden="true" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: 0;"
    loading="lazy">
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"
    style="background: rgba(10, 7, 5, 0.65); z-index: 0;"></span>
  <div class="container position-relative d-flex align-items-center justify-content-center" style="min-height: 520px;">
    <h2 class="fw-bold text-white mb-0" style="max-width: 46ch; font-size: clamp(1.85rem, 5vw, 3.5rem);">From the terminal to the car,<br>
      we've got your
      bags
      covered.</h2>
  </div>
</section>

<section class="position-relative overflow-hidden py-5 py-lg-6"
  style="background: linear-gradient(180deg, var(--pc-cream) 0%, var(--pc-cream) 85%, #ffffff 100%);">
  <div class="container py-lg-4">
    <div class="text-center mx-auto mb-5" style="max-width: 720px;">
      <h2 class="fw-bold mb-3" style="
          font-size: clamp(2rem, 4vw, 3.5rem);
          line-height: 1.08;
          letter-spacing: -.045em;
          color: var(--pc-dark);
        ">
        Your journey starts
        <span style="color: var(--pc-orange);">
          the moment you land.
        </span>
      </h2>

      <p class="text-muted-pc mx-auto mb-0" style="max-width: 620px; line-height: 1.75;">
        From airport pickup to your final destination, we make every
        step feel effortless, comfortable and completely stress-free.
      </p>
    </div>

    <!-- =========================
         MAIN COMBINED CARD
    ========================== -->
    <div class="row g-0 overflow-hidden rounded-5 bg-white" style="
        border: 1px solid rgba(28,20,16,.07);
        box-shadow:
          0 30px 70px rgba(28,20,16,.08),
          0 5px 20px rgba(28,20,16,.035);
      ">

      <!-- ==================================================
           LEFT — WHY CHOOSE POWERcabs
      =================================================== -->
      <div class="col-lg-6 p-4 p-md-5 d-flex flex-column">
        <div class="d-flex align-items-start gap-3 mb-4">
          <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-4" style="
              width: 46px;
              height: 46px;
              background: var(--pc-peach);
              color: var(--pc-orange);
              box-shadow: inset 0 0 0 1px rgba(232,89,12,.08);
            ">
            <i class="bi bi-stars fs-5"></i>
          </div>

          <div>
            <div class="small fw-bold text-uppercase mb-1" style="
                letter-spacing: .14em;
                color: var(--pc-orange);
                font-size: .65rem;
              ">
              Why Choose Us
            </div>

            <h3 class="fw-bold mb-0" style="
                font-size: clamp(1.45rem, 2vw, 1.9rem);
                line-height: 1.15;
                letter-spacing: -.035em;
                color: var(--pc-dark);
              ">
              More than just
              an airport transfer.
            </h3>
          </div>
        </div>

        <p class="text-muted-pc mb-4" style="
            max-width: 470px;
            font-size: .95rem;
            line-height: 1.7;
          ">
          We take care of the details, so you can simply step out of
          the airport and enjoy a smooth, comfortable journey.
        </p>

        <div class="row g-2">
          <?php foreach ($whyChoose as $index => $item): ?>
            <div class="col-12 col-sm-6">
              <div class="position-relative rounded-4 p-3 bg-white" style="
                  min-height: 52px;
                  border: 1px solid rgba(28,20,16,.065);
                  transition: all .25s ease;
                ">
                <span class="position-absolute top-0 end-0 mt-2 me-3 fw-bold" style="
                    font-size: .6rem;
                    letter-spacing: .08em;
                    color: rgba(28,20,16,.18);
                  ">
                  <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
                </span>
                <div class="d-flex align-items-center gap-2 h-100">
                  <span class="d-inline-flex align-items-center justify-content-center
                    rounded-circle flex-shrink-0" style="
                      width: 30px;
                      height: 30px;
                      background: var(--pc-peach);
                      color: var(--pc-orange);
                    ">
                    <i class="bi bi-check2 small"></i>
                  </span>
                  <span class="fw-bold" style="
                      font-size: .82rem;
                      line-height: 1.4;
                      color: var(--pc-dark);
                      padding-right: 8px;
                    ">
                    <?= htmlspecialchars($item) ?>
                  </span>
                </div>
              </div>
            </div>

          <?php endforeach; ?>

        </div>

        <div class="d-flex align-items-center gap-3 mt-auto pt-4" style="border-top: 1px solid rgba(28,20,16,.07);">
          <div class="d-flex align-items-center justify-content-center rounded-3 flex-shrink-0" style="
              width: 40px;
              height: 40px;
              background: var(--pc-cream-soft);
              color: var(--pc-orange);
            ">
            <i class="bi bi-shield-check"></i>
          </div>

          <div>
            <div class="fw-bold" style="font-size: .78rem; color: var(--pc-dark);">
              Travel with confidence
            </div>

            <div class="text-muted-pc" style="font-size: .68rem;">
              Professional service from pickup to drop-off.
            </div>
          </div>
        </div>
      </div>


      <!-- ==================================================
           RIGHT — HOW IT WORKS
      =================================================== -->
      <div class="col-lg-6 p-4 p-md-5 d-flex flex-column" style="
          background:
            linear-gradient(
              145deg,
              #fff8f3 0%,
              var(--pc-cream-soft) 100%
            );
          border-left: 1px solid rgba(28,20,16,.06);
        ">

        <!-- Heading -->
        <div class="d-flex align-items-start gap-3 mb-4">
          <div class="d-flex align-items-center justify-content-center flex-shrink-0 rounded-4" style="
              width: 46px;
              height: 46px;
              background: var(--pc-orange);
              color: #fff;
              box-shadow: 0 8px 20px rgba(232,89,12,.20);
            ">
            <i class="bi bi-signpost-split-fill fs-5"></i>
          </div>
          <div>

            <div class="small fw-bold text-uppercase mb-1" style="
                letter-spacing: .14em;
                color: var(--pc-orange);
                font-size: .65rem;
              ">
              How It Works
            </div>

            <h3 class="fw-bold mb-0" style="
                font-size: clamp(1.45rem, 2vw, 1.9rem);
                line-height: 1.15;
                letter-spacing: -.035em;
                color: var(--pc-dark);
              ">
              Booked in four
              simple steps.
            </h3>
          </div>
        </div>


        <!-- Description -->
        <p class="text-muted-pc mb-4" style="
            max-width: 470px;
            font-size: 1.02rem;
            line-height: 1.7;
          ">
          Getting your airport transfer sorted is quick and easy.
          Book ahead and we'll take care of the rest.
        </p>


        <!-- =========================
             TIMELINE
        ========================== -->
        <div>

          <?php foreach ($bookingSteps as $index => $step): ?>

            <div class="position-relative d-flex gap-3
              <?= $index < count($bookingSteps) - 1 ? 'pb-4' : '' ?>">

              <!-- Connecting line -->
              <?php if ($index < count($bookingSteps) - 1): ?>

                <div class="position-absolute" style="
                    left: 19px;
                    top: 43px;
                    bottom: 0;
                    width: 1px;
                    background:
                      linear-gradient(
                        to bottom,
                        rgba(232,89,12,.30),
                        rgba(232,89,12,.08)
                      );
                  ">
                </div>

              <?php endif; ?>


              <!-- Step number -->
              <div class="position-relative d-flex align-items-center justify-content-center
                flex-shrink-0 rounded-4 fw-bold" style="
                  z-index: 2;
                  width: 40px;
                  height: 40px;
                  background: <?= $index === 0 ? 'var(--pc-orange)' : '#fff' ?>;
                  color: <?= $index === 0 ? '#fff' : 'var(--pc-orange)' ?>;
                  border: 1px solid rgba(232,89,12,.18);
                  font-size: .78rem;
                  box-shadow: 0 5px 15px rgba(28,20,16,.055);
                ">
                <?= $step['n'] ?>
              </div>


              <!-- Step content -->
              <div class="flex-grow-1 pt-1">

                <div class="d-flex align-items-center justify-content-between mb-1">

                  <span class="fw-bold" style="
                      font-size: .58rem;
                      letter-spacing: .13em;
                      color: #a19791;
                    ">
                    STEP
                    <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?>
                  </span>

                  <i class="bi bi-arrow-up-right" style="
                      font-size: .75rem;
                      color: rgba(28,20,16,.28);
                    ">
                  </i>

                </div>

                <h4 class="fw-bold mb-0" style="
                    font-size: .93rem;
                    line-height: 1.4;
                    color: var(--pc-dark);
                  ">
                  <?= htmlspecialchars($step['title']) ?>
                </h4>

              </div>

            </div>

          <?php endforeach; ?>

        </div>


        <!-- =========================
             BOTTOM REASSURANCE
        ========================== -->
        <div class="d-flex align-items-center gap-2 p-3 rounded-4 mt-3" style="
            background: rgba(255,255,255,.72);
            border: 1px solid rgba(28,20,16,.065);
          ">

          <div class="d-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="
              width: 30px;
              height: 30px;
              background: var(--pc-peach);
              color: var(--pc-orange);
            ">
            <i class="bi bi-check-lg small"></i>
          </div>

          <div>
            <div class="fw-bold" style="
                font-size: .84rem;
                color: var(--pc-dark);
              ">
              That's it. You're all set.
            </div>

            <div class="text-muted-pc" style="font-size: .74rem;">
              Simple booking. Reliable service. No unnecessary hassle.
            </div>
          </div>

          <div class="ms-auto d-flex align-items-center justify-content-center
            rounded-circle flex-shrink-0" style="
              width: 31px;
              height: 31px;
              background: #fff;
              color: var(--pc-orange);
              border: 1px solid rgba(232,89,12,.12);
            ">
            <i class="bi bi-arrow-right"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .pc-wc-card {
    background: var(--pc-cream-soft);
    border: 1px solid rgba(28, 20, 16, .05);
    transition: transform .2s ease, box-shadow .2s ease;
  }

  .pc-wc-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--pc-shadow-sm);
  }

  @media (prefers-reduced-motion: reduce) {
    .pc-wc-card {
      transition: none;
    }

    .pc-wc-card:hover {
      transform: none;
    }
  }
</style>

<!-- ============ Online Booking CTA ============ -->
<section class="section-pc text-center">
  <div class="container">
    <h2 class="mb-3">Ready to Book Your Airport Transfer?</h2>
    <p class="text-muted-pc mx-auto mb-4" style="max-width: 52ch;">Book online in a couple of minutes, or get in touch
      if you have a question first.</p>
    <div class="d-flex flex-wrap justify-content-center gap-3">
      <a class="btn btn-pc-primary btn-md px-5" href="<?= $assetPath ?>/book-ride-online">Book Online</a>
      <a class="btn btn-outline-dark btn-md px-5 rounded-pill" href="<?= $assetPath ?>/faqs">Have a Question? See
        FAQs</a>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
