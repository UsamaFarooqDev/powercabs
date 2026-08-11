<section class="section-pc overflow-hidden"
  style="background: linear-gradient(180deg, #f8f8f6 0%, #f8f8f6 80%, #ffffff 100%);">
  <div class="container">
    <div class="text-center mx-auto mb-5" style="max-width: 720px;">
      <h2 class="fw-bold mb-3" style="
          font-size: clamp(30px, 4vw, 44px);
          line-height: 1.15;
          letter-spacing: -.8px;
        ">
        Trusted by Drivers &amp; Businesses
        <span style="color: var(--pc-orange);">Across Ireland</span>
      </h2>
      <p class="text-muted-pc mb-0 mx-auto" style="
          max-width: 600px;
          font-size: 18px;
          line-height: 1.7;
        ">
        Real experiences from drivers and businesses using PowerCabs
        payment solutions every day.
      </p>
    </div>
  </div>

  <?php
  $paymentTestimonials = [
    [
      'img' => 'ali-pbs.jpg',
      'quote' => 'Fast payouts and simple to use. Great for small businesses. Love using the PowerCabs Terminal.',
      'name' => 'Ali',
      'role' => 'Retail Store, Dublin'
    ],
    [
      'img' => 'jaswinder-pbs.jpg',
      'quote' => "I've saved \u{20AC}45 in just 3 months by switching to the PowerCabs Card Terminal. Customers prefer tapping their card now, and my tips have increased too.",
      'name' => 'Jaswinder',
      'role' => 'Taxi Driver, Kildare'
    ],
    [
      'img' => 'ahmed-pbs.jpg',
      'quote' => 'Setup took minutes and the support team talked me through everything. My passengers love being able to tap and go.',
      'name' => 'Ahmed',
      'role' => 'Taxi Driver, Dublin'
    ],
    [
      'img' => 'sara-pbs.jpg',
      'quote' => 'Managing payments and stock in one place has saved me hours every week. Highly recommend for any small shop.',
      'name' => 'Sara',
      'role' => 'Shop Owner, Galway'
    ],
  ];

  $marqueeItems = array_merge(
    $paymentTestimonials,
    $paymentTestimonials
  );
  ?>


  <div class="pc-marquee">
    <div class="pc-marquee-track py-3">
      <?php foreach ($marqueeItems as $i => $t): ?>
        <div class="pc-marquee-card px-2" <?= $i >= count($paymentTestimonials) ? 'aria-hidden="true"' : '' ?>>
          <article class="card h-100 border-0 bg-white position-relative overflow-hidden" style="
              width: 360px;
              min-height: 290px;
              border-radius: 22px;
              box-shadow: 0 4px 14px rgba(20,25,35,.045);">
            <div class="position-absolute top-0 start-0 w-100" style="
                height: 2px;
                background: var(--pc-orange);
              "></div>

            <div class="card-body d-flex flex-column p-4">
              <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-1" style="color: var(--pc-orange);"
                  aria-label="5 out of 5 stars">
                  <i class="bi bi-star-fill small"></i>
                  <i class="bi bi-star-fill small"></i>
                  <i class="bi bi-star-fill small"></i>
                  <i class="bi bi-star-fill small"></i>
                  <i class="bi bi-star-fill small"></i>
                </div>
              </div>

              <div class="d-flex gap-3 mb-4">
                <div class="flex-shrink-0 d-flex align-items-center justify-content-center rounded-circle" style="
                    width: 36px;
                    height: 36px;
                    background: rgba(245,132,31,.10);
                    color: var(--pc-orange);
                  ">
                  <i class="bi bi-quote"></i>
                </div>
                <p class="mb-0" style="
                    color: #30343b;
                    font-size: 15px;
                    line-height: 1.7;
                  ">
                  <?= htmlspecialchars($t['quote']) ?>
                </p>
              </div>

              <div class="mt-auto pt-3 border-top d-flex align-items-center gap-3">
                <img src="<?= $assetPath ?>assets/img/<?= $t['img'] ?>" alt="<?= htmlspecialchars($t['name']) ?>"
                  class="rounded-circle object-fit-cover flex-shrink-0" style="
                    width: 52px;
                    height: 52px;
                    border: 3px solid rgba(245,132,31,.15);
                  " loading="lazy">

                <div class="min-w-0">
                  <div class="d-flex align-items-center gap-2">
                    <span class="fw-bold">
                      <?= htmlspecialchars($t['name']) ?>
                    </span>
                    <i class="bi bi-patch-check-fill" title="Verified customer" style="
                        color: var(--pc-orange);
                        font-size: 14px;
                      "></i>
                  </div>
                  <span class="d-block text-muted-pc small mt-1">
                    <?= htmlspecialchars($t['role']) ?>
                  </span>
                </div>
              </div>
            </div>
          </article>
        </div>

      <?php endforeach; ?>
    </div>
  </div>
</section>