<section class="section-pc" id="corporate-account-form" style="scroll-margin-top: 6rem;">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);">/ What We Do</p>
        <h2 class="mb-3">Occasions We Cover</h2>
        <p class="text-muted-pc mb-4" style="max-width: 46ch;" style="font-size: 1.1rem;">
          From seminars to state visits, PowerCabs handles the transportation
          so your team can stay focused on the event itself.
        </p>
        <?php
        $whatWeDo = [
          ['icon' => 'bi-easel-fill', 'label' => 'Seminars'],
          ['icon' => 'bi-mic-fill', 'label' => 'Conferences'],
          ['icon' => 'bi-image-fill', 'label' => 'Exhibitions'],
          ['icon' => 'bi-rocket-takeoff-fill', 'label' => 'Product Launches'],
          ['icon' => 'bi-megaphone-fill', 'label' => 'PR Events'],
          ['icon' => 'bi-cup-hot-fill', 'label' => 'Corporate Hospitality'],
          ['icon' => 'bi-trophy-fill', 'label' => 'Sporting Events'],
          ['icon' => 'bi-bank2', 'label' => 'State Visits'],
          ['icon' => 'bi-shield-fill-check', 'label' => 'Professional Sports Organizations'],
        ];
        ?>
        <div class="d-flex flex-wrap gap-2">
          <?php foreach ($whatWeDo as $item): ?>
            <span class="d-inline-flex align-items-center gap-2 bg-white rounded-pill px-3 py-2" style="box-shadow: var(--pc-shadow-sm);">
              <i class="bi <?= $item['icon'] ?>" style="color: var(--pc-orange);"></i>
              <span class="small fw-medium"><?= htmlspecialchars($item['label']) ?></span>
            </span>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="bg-white rounded-5 p-4 p-md-5" style="box-shadow: var(--pc-shadow-md);">
          <h2 class="mb-2" style="font-size:1.7rem">Register for a Corporate Account</h2>
          <p class="text-muted-pc mb-4" style="font-size: 1.1rem;">Tell us a little about your business and our team will be in touch.</p>

          <form method="post" action="" class="row g-3">
            <div class="col-md-6">
              <label class="form-label" for="csName">Name</label>
              <input type="text" class="form-control" id="csName" name="name" value="<?= htmlspecialchars($old['name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="csEmail">Email</label>
              <input type="email" class="form-control" id="csEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="csBusinessName">Business Name</label>
              <input type="text" class="form-control" id="csBusinessName" name="business_name" value="<?= htmlspecialchars($old['business_name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="csEmployeeCount">Number of Employees</label>
              <input type="number" min="1" class="form-control" id="csEmployeeCount" name="employee_count" value="<?= htmlspecialchars($old['employee_count']) ?>">
            </div>
            <div class="col-md-6">
              <label class="form-label" for="csMobile">Mobile</label>
              <input type="tel" class="form-control" id="csMobile" name="mobile" value="<?= htmlspecialchars($old['mobile']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label" for="csAddress">Address</label>
              <input type="text" class="form-control" id="csAddress" name="address" value="<?= htmlspecialchars($old['address']) ?>">
            </div>

            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
                <span>Submit</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your registration has been sent. Our Business Team will be in touch shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
