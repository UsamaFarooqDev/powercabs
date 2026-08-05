<section class="section-pc">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6 p-2 p-md-5">
        <h2 class="mb-3">Why Businesses Choose PowerCabs</h2>
        <p class="text-muted-pc mb-4" style="max-width: 46ch; font-size: 1.1rem;">
          A corporate account built around how your business actually runs --
          one point of contact, one invoice, and drivers you can rely on every time.
        </p>
        <a class="btn btn-pc-dark px-4" href="#corporate-account-form">Open Your Corporate Account</a>
      </div>

      <div class="col-lg-6">
        <?php
        $whyBusinesses = [
          ['icon' => 'bi-person-workspace', 'title' => 'Account Management', 'desc' => 'A dedicated account manager who understands your business and travel patterns.'],
          ['icon' => 'bi-headset', 'title' => 'Dedicated Support', 'desc' => '24/7 support for your team, not just a general helpline.'],
          ['icon' => 'bi-receipt', 'title' => 'Transparent Billing', 'desc' => 'One consolidated monthly invoice, with no hidden charges.'],
          ['icon' => 'bi-shield-check', 'title' => 'Reliable Drivers', 'desc' => 'Garda-vetted, professional drivers for every corporate journey.'],
          ['icon' => 'bi-calendar-check', 'title' => 'Scheduled Rides', 'desc' => 'Book recurring or advance journeys so your team is never caught out.'],
        ];
        $totalWhyBusinesses = count($whyBusinesses);
        ?>
        <?php foreach ($whyBusinesses as $i => $item): ?>
          <?php $isLast = $i === $totalWhyBusinesses - 1; ?>
          <div class="d-flex">
            <div class="d-flex flex-column align-items-center me-3" style="width: 44px;">
              <span class="rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; border: 1px solid var(--pc-orange); color: var(--pc-orange);">
                <i class="bi <?= $item['icon'] ?>"></i>
              </span>
              <?php if (!$isLast): ?>
                <div class="flex-grow-1 border-start border-2 my-1" style="border-color: var(--pc-orange) !important; opacity: .35;"></div>
              <?php endif; ?>
            </div>
            <div class="<?= $isLast ? 'pb-0' : 'pb-4' ?> pt-1">
              <h3 class="fs-6 fw-bold mb-1"><?= htmlspecialchars($item['title']) ?></h3>
              <p class="small text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
