<?php

$driveOld ??= ['name' => '', 'mobile' => '', 'email' => '', 'licence' => ''];
$driveFormStatus ??= null;
$driveFormError ??= '';
?>
<!-- ============ "You're not just a driver. You're family." ============ -->
<section class="section-pc position-relative overflow-hidden" style="background: linear-gradient(155deg, var(--pc-dark) 0%, #2a1a10 55%, var(--pc-dark-soft) 100%);">
  <div class="container">
    <div class="row align-items-center gy-5 py-5 py-lg-6">

      <!-- Left: copy -->
      <div class="col-lg-6">
        <span class="pc-mg-badge text-white d-inline-flex align-items-center gap-2 mb-4">
          <span class="fw-bold" style="font-size: .7rem;">IE</span>
          Irish Taxi Platform &bull; Driver First
        </span>

        <h2 class="fw-bold text-white mb-3" style="font-size: clamp(2.1rem, 4vw, 3.1rem); line-height: 1.14; letter-spacing: -.02em;">
          You're not just a driver,<br>
          <span style="color: var(--pc-orange-light);">You're family.</span>
        </h2>
        <p class="mb-4" style="color: rgba(255, 255, 255, .75); font-size: 1.08rem; max-width: 46ch; line-height: 1.7;">
          Your taxi. Your meter. Your choice. Earn properly, avoid platform-created
          Saver pricing, save on the costs of driving and get real local support.
        </p>
      </div>

      <!-- Right: application form -->
      <div class="col-lg-6">
        <div class="bg-white rounded-4 p-4 p-md-5 mx-auto" id="driveJoinForm" style="max-width: 480px; box-shadow: var(--pc-shadow-lg);">
          <p class="text-muted-pc mb-4">
            Add PowerCabs to your driving &mdash; you don't necessarily have to leave other platforms.
          </p>

          <form method="post" action="" class="row g-3">
            <input type="hidden" name="form_type" value="driver_join">

            <div class="col-12">
              <label class="visually-hidden" for="djName">First name</label>
              <input type="text" class="form-control rounded-3 py-2" id="djName" name="name" placeholder="First name"
                value="<?= htmlspecialchars($driveOld['name']) ?>" required>
            </div>
            <div class="col-12">
              <label class="visually-hidden" for="djMobile">Mobile</label>
              <input type="tel" class="form-control rounded-3 py-2" id="djMobile" name="mobile" placeholder="Mobile"
                value="<?= htmlspecialchars($driveOld['mobile']) ?>" required>
            </div>
            <div class="col-12">
              <label class="visually-hidden" for="djEmail">Email</label>
              <input type="email" class="form-control rounded-3 py-2" id="djEmail" name="email" placeholder="Email"
                value="<?= htmlspecialchars($driveOld['email']) ?>" required>
            </div>
            <div class="col-12">
              <label class="visually-hidden" for="djLicence">SPSV / Driver licence</label>
              <input type="text" class="form-control rounded-3 py-2" id="djLicence" name="licence" placeholder="SPSV / Driver licence"
                value="<?= htmlspecialchars($driveOld['licence']) ?>" required>
            </div>

            <div class="col-12 pt-2">
              <button type="submit" class="btn btn-pc-primary w-100 rounded-pill d-inline-flex align-items-center justify-content-center gap-2">
                <span>Start my Application</span>
                <i class="bi bi-send" aria-hidden="true"></i>
              </button>
            </div>

            <?php if ($driveFormStatus === 'success'): ?>
              <div class="col-12">
                <div class="alert alert-success mb-0 mt-2" role="alert">Thanks -- your application has been sent. Our team will be in touch shortly.</div>
              </div>
            <?php elseif ($driveFormStatus === 'error'): ?>
              <div class="col-12">
                <div class="alert alert-danger mb-0 mt-2" role="alert"><?= htmlspecialchars($driveFormError) ?></div>
              </div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
