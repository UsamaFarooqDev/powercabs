<section class="section-pc" style="background: linear-gradient(180deg, #ffffff 0%, var(--pc-cream) 15%, var(--pc-cream) 100%);">
  <div class="container">
    <div class="text-center mb-5">
      <!-- <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ Solutions</p> -->
      <h2 class="mb-3">Let's Save Together and Grow the Business</h2>
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 60ch;">
        PowerCabs Ireland has joined New Payment Innovation, giving drivers and merchants
        access to the best, most affordable rates -- straightforward payment solutions
        tailored to your daily needs.
      </p>
    </div>

    <div class="row g-4">
      <?php
      $paymentSolutions = [
        [
          'img'      => 'Affordable-Payment-Solutions.webp',
          'title'    => 'Affordable Payment Solutions for Every Business',
          'desc'     => 'Whether you run a restaurant, cafe, or any growing business, PowerCabs & NPI give you straightforward payment processing at the lowest rates in Ireland.',
          'features' => ['Integrated delivery apps support', 'Real-time reporting & analytics', 'End-of-day transaction reports'],
        ],
        [
          'img'      => 'Accept-Card-Payments.webp',
          'title'    => 'Accept Card Payments in Your Taxi -- Fast & Easy',
          'desc'     => "PowerCabs' card terminal is perfect for taxi drivers. Accept contactless payments from passengers instantly and get your funds next day.",
          'features' => ['Next day fund settlement', 'Accept Visa, Mastercard, Apple Pay & Google Pay', 'Low 0.8% transaction rate'],
        ],
        [
          'img'      => 'Shop-Revenue.webp',
          'title'    => 'Grow Your Shop Revenue with Smarter Payments',
          'desc'     => 'Our EPOS & card terminal solution helps retail shop owners manage sales, inventory, and payments all in one place.',
          'features' => ['Integrated EPOS system', 'Contactless, Chip & PIN, Apple Pay & Google Pay', 'Dedicated local support team'],
        ],
      ];
      ?>
      <?php foreach ($paymentSolutions as $item): ?>
        <div class="col-md-4">
          <div class="rounded-4 bg-white h-100 overflow-hidden" style="box-shadow: var(--pc-shadow-sm);">
            <div style="aspect-ratio: 3 / 2;">
              <img src="<?= $assetPath ?>assets/img/<?= $item['img'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="w-100 h-100 object-fit-cover" loading="lazy">
            </div>
            <div class="p-4">
              <h3 class="fs-6 fw-bold mb-2"><?= htmlspecialchars($item['title']) ?></h3>
              <p class="text-muted-pc small mb-3"><?= htmlspecialchars($item['desc']) ?></p>
              <p class="fw-semibold small mb-2">Features:</p>
              <ul class="list-unstyled d-flex flex-column gap-1 mb-0">
                <?php foreach ($item['features'] as $feature): ?>
                  <li class="d-flex gap-2 small">
                    <i class="bi bi-check2 mt-1" style="color: var(--pc-orange);"></i>
                    <span class="text-muted-pc"><?= htmlspecialchars($feature) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
