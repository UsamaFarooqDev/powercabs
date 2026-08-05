<section class="section-pc bg-white position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="text-center mb-5">
      <h2 class="mb-0">Everything Your Business Needs</h2>
    </div>
    <div class="px-2 px-md-5">
      <div class="row row-cols-2 row-cols-md-4 g-0 border-top justify-content-center">
        <?php
        $corporateBenefits = [
          ['icon' => 'bi-receipt-cutoff', 'label' => 'Monthly Invoicing'],
          ['icon' => 'bi-briefcase-fill', 'label' => 'Executive Rides'],
          ['icon' => 'bi-airplane-fill', 'label' => 'Airport Transfers'],
          ['icon' => 'bi-person-badge-fill', 'label' => 'Meet & Greet'],
          ['icon' => 'bi-building-fill', 'label' => 'Business Account'],
          ['icon' => 'bi-bar-chart-fill', 'label' => 'Reporting'],
        ];
        ?>
        <?php foreach ($corporateBenefits as $item): ?>
          <div class="col pc-why-item position-relative border-end border-bottom text-center px-3 py-4 py-md-5">
            <i class="bi <?= $item['icon'] ?> fs-2 mb-3 d-block" style="color: var(--pc-orange);"></i>
            <h3 class="fs-6 fw-bold mb-0 pc-why-item-title"><?= htmlspecialchars($item['label']) ?></h3>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
