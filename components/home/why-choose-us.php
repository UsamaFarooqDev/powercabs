<section id="why-choose" class="section-pc bg-white position-relative overflow-hidden">
  <svg class="pc-why-bg position-absolute w-100 h-100 z-0" viewBox="0 0 1200 700" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
    <g fill="none" stroke-linecap="round">
      <path d="M-100,120 Q400,60 1300,180" stroke="var(--pc-dark)" stroke-width="1.5" opacity="0.06"/>
      <path d="M-100,620 Q500,680 1300,560" stroke="var(--pc-orange)" stroke-width="1.5" opacity="0.08"/>
    </g>
    <g transform="translate(680,385) scale(1.05)" fill="none" stroke-linecap="round" stroke-linejoin="round" opacity="0.07">
      <path d="M66,182 C64,160 78,148 96,146 L128,142 C150,110 190,90 245,84
               C300,78 380,78 440,90 C495,101 545,128 578,158 L610,170
               C628,176 640,188 640,204 L640,208 L66,208 Z" stroke="var(--pc-dark)" stroke-width="2"/>
      <path d="M150,140 C172,112 205,96 248,90 C296,84 366,84 418,94
               C462,103 500,122 522,146 L516,150 L165,150 Z" stroke="var(--pc-orange)" stroke-width="1.6"/>
      <line x1="66" y1="205" x2="640" y2="205" stroke="var(--pc-orange)" stroke-width="2.5"/>
      <circle cx="536" cy="228" r="46" stroke="var(--pc-dark)" stroke-width="1.8"/>
      <circle cx="536" cy="228" r="26" stroke="var(--pc-orange)" stroke-width="1.4"/>
      <circle cx="192" cy="228" r="46" stroke="var(--pc-dark)" stroke-width="1.8"/>
      <circle cx="192" cy="228" r="26" stroke="var(--pc-orange)" stroke-width="1.4"/>
    </g>
  </svg>

  <?php
  $whyChooseItems = [
    ['icon' => 'bi-phone-fill', 'title' => 'Easy Booking', 'desc' => "Enter your pickup and drop-off locations, select your ride, you're all set."],
    ['icon' => 'bi-cash-coin', 'title' => 'Affordable Rates', 'desc' => 'Competitive rates for all our rides, ensuring great value for your money.'],
    ['icon' => 'bi-shield-check', 'title' => 'Safe and Reliable', 'desc' => 'All drivers are licensed and experienced; vehicles are regularly inspected.'],
    ['icon' => 'bi-clock-history', 'title' => '24/7 Service', 'desc' => "Need a ride any time of day or night? We're always here for you."],
  ];
  ?>
  <div class="container position-relative">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Why PowerCabs</p>
      <h2 class="mb-3">Built for Every Journey.</h2>
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 50ch;">Everything about PowerCabs is designed around a smoother ride &mdash; from the moment you book to the moment you arrive.</p>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4">
      <?php foreach ($whyChooseItems as $item): ?>
        <div class="col">
          <div class="pc-why-item position-relative overflow-hidden h-100 text-center bg-white rounded-4 p-4 p-lg-4" style="border: 1px solid rgba(28,20,16,.06); box-shadow: var(--pc-shadow-sm);">
            <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 60px; height: 60px; background: var(--pc-peach);">
              <i class="bi <?= $item['icon'] ?> fs-4" style="color: var(--pc-orange);" aria-hidden="true"></i>
            </div>
            <h3 class="fs-5 fw-bold mb-2 pc-why-item-title"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="text-muted-pc mb-0"><?= htmlspecialchars($item['desc']) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
