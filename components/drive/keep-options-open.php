<?php
$familyPoints = [
  ['lead' => 'Irish company.', 'text' => 'Local people who understand the Irish taxi market.'],
  ['lead' => 'Real support.', 'text' => 'When you have a problem, reach a person.'],
  ['lead' => 'Driver benefits.', 'text' => 'Fuel, car care, card and loyalty opportunities.'],
  ['lead' => 'Your success matters.', 'text' => 'A strong driver network makes PowerCabs stronger.'],
]; ?>
<!-- ============ The PowerCabs Family / Keep Your Options Open ============ -->
<section class="section-pc bg-white">
  <div class="container">
    <div class="row g-4">

      <div class="col-lg-6">
        <div class="border rounded-4 p-4 p-lg-5 h-100" style="border-color: rgba(28, 20, 16, .08) !important;">
          <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ The PowerCabs Family</p>
          <h2 class="fw-bold mb-3" style="font-size: clamp(1.7rem, 3vw, 2.2rem); line-height: 1.2;">
            When you're on the road, you shouldn't feel alone.
          </h2>
          <p class="text-muted-pc mb-4">
            You're the person representing our company to every passenger. We
            want that relationship to go both ways.
          </p>
          <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
            <?php foreach ($familyPoints as $point): ?>
              <li class="d-flex align-items-start gap-2">
                <i class="bi bi-check-lg flex-shrink-0" style="color: #198754; margin-top: .2rem;" aria-hidden="true"></i>
                <span>
                  <span class="fw-bold" style="color: var(--pc-dark);"><?= htmlspecialchars($point['lead']) ?></span>
                  <span class="text-muted-pc"><?= htmlspecialchars($point['text']) ?></span>
                </span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="rounded-4 p-4 p-lg-5 h-100 d-flex flex-column justify-content-center" style="background: var(--pc-orange-light);">
          <p class="small fw-bold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-dark);">/ Keep Your Options Open</p>
          <h2 class="fw-bold mb-3" style="font-size: clamp(1.7rem, 3vw, 2.2rem); line-height: 1.2; color: var(--pc-dark);">
            Don't burn your bridges.
          </h2>
          <p class="mb-3" style="color: rgba(28, 20, 16, .8);">
            Already use FREE NOW, Uber or another platform? Where their terms
            permit it, PowerCabs can be another source of bookings or a backup
            option.
          </p>
          <p class="fw-bold mb-4" style="color: var(--pc-dark);">
            We're not asking you to choose one basket. We're giving you another one.
          </p>
          <a href="#driveJoinForm" class="btn btn-pc-dark rounded-pill px-4 align-self-start d-inline-flex align-items-center gap-2 text-nowrap">
            Add PowerCabs to My Driving <i class="bi bi-arrow-right-short d-none d-sm-inline-block" aria-hidden="true"></i>
          </a>
        </div>
      </div>

    </div>
  </div>
</section>
