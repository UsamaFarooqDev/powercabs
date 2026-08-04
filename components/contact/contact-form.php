<?php
/**
 * Contact page: office info column + contact form.
 * Requires $assetPath, $formStatus, $formError, $old from the including page.
 */
?>
<section class="section-pc">
  <div class="container">
    <div class="row gy-5 align-items-center">
      <div class="col-lg-6">
        <h2 class="mb-3" style="font-size: clamp(1.5rem, 2.5vw, 2rem);">We'd Love to Hear From You</h2>
        <p class="text-muted-pc mb-4">
          Whether it's a question about a booking, a business enquiry, or feedback on
          the app, our team reads every message and typically replies within one
          working day.
        </p>
        <div class="d-flex flex-column gap-3">
          <div class="d-flex gap-3">
            <i class="bi bi-geo-alt-fill fs-5" style="color: var(--pc-orange);"></i>
            <span>
              <span class="d-block fw-semibold">Office Address</span>
              <span class="d-block text-muted-pc">Kylmore Road, Inchicore, Dublin D10 K729</span>
            </span>
          </div>
          <div class="d-flex gap-3">
            <i class="bi bi-receipt fs-5" style="color: var(--pc-orange);"></i>
            <span>
              <span class="d-block fw-semibold">Tax Number</span>
              <span class="d-block text-muted-pc">04301619NH</span>
            </span>
          </div>
          <div class="d-flex gap-3">
            <i class="bi bi-patch-check-fill fs-5" style="color: var(--pc-orange);"></i>
            <span>
              <span class="d-block fw-semibold">NTA License</span>
              <span class="d-block text-muted-pc">DH12616</span>
            </span>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="bg-white rounded-5 p-3 p-md-5" style="box-shadow: var(--pc-shadow-md);">
          <form method="post" action="" class="row g-2">
            <div class="col-md-6">
              <label class="form-label mb-1" for="cuFirstName">First Name</label>
              <input type="text" class="form-control" id="cuFirstName" name="first_name" value="<?= htmlspecialchars($old['first_name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label mb-1" for="cuLastName">Last Name</label>
              <input type="text" class="form-control" id="cuLastName" name="last_name" value="<?= htmlspecialchars($old['last_name']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label mb-1" for="cuEmail">Email Address</label>
              <input type="email" class="form-control" id="cuEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
            </div>
            <div class="col-md-6">
              <label class="form-label mb-1" for="cuPhone">Phone Number</label>
              <input type="tel" class="form-control" id="cuPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>">
            </div>
            <div class="col-12">
              <label class="form-label mb-1" for="cuSubject">Subject</label>
              <input type="text" class="form-control" id="cuSubject" name="subject" value="<?= htmlspecialchars($old['subject']) ?>" required>
            </div>
            <div class="col-12">
              <label class="form-label mb-1" for="cuMessage">Message</label>
              <textarea class="form-control" id="cuMessage" name="message" rows="3" required><?= htmlspecialchars($old['message']) ?></textarea>
            </div>
            <div class="col-12 pt-1">
              <button type="submit" class="btn btn-pc-primary px-4 d-inline-flex align-items-center">
                <span>Send Message</span>
                <i class="bi bi-send ms-2" style="font-size: .85rem;"></i>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="col-12"><div class="alert alert-success mb-0 mt-3" role="alert">Thanks -- your message has been sent. We'll get back to you shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="col-12"><div class="alert alert-danger mb-0 mt-3" role="alert"><?= htmlspecialchars($formError) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
