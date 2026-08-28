<section class="pc-power10 position-relative overflow-hidden">
  <div class="container position-relative">
    <div class="pc-power10-card position-relative overflow-hidden">
      <span class="pc-power10-glow position-absolute rounded-circle z-0 pc-power10-glow-1" aria-hidden="true"></span>
      <span class="pc-power10-glow position-absolute rounded-circle z-0 pc-power10-glow-2" aria-hidden="true"></span>

      <div class="row align-items-center g-4 g-lg-5">
        <!-- LEFT: promotional content -->
        <div class="col-lg-6 pc-power10-content pc-reveal">
          <span class="pc-power10-badge text-uppercase rounded-pill d-inline-flex align-items-center gap-2 mb-3">
            <span class="pc-power10-badge-dot rounded-circle flex-shrink-0" aria-hidden="true"></span>
            Limited Time Offer
          </span>

          <h2 class="pc-power10-heading mb-2">Meet <span>Power10</span></h2>
          <p class="pc-power10-subhead mb-3">Get <strong>10% OFF</strong> your next ride</p>
          <p class="pc-power10-desc mb-4">
            Ride more and save more with Power10. Enjoy an exclusive 10%
            discount on your PowerCabs rides.
          </p>

          <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
            <button type="button" class="pc-power10-code d-inline-flex align-items-center rounded-4" id="power10CopyBtn" data-code="POWER10" aria-label="Copy promo code POWER10">
              <span class="pc-power10-code-label fw-bold text-uppercase">Promo Code</span>
              <span class="pc-power10-code-value">POWER10</span>
              <i class="bi bi-copy" aria-hidden="true"></i>
            </button>
            <span class="pc-power10-copied d-inline-flex align-items-center small fw-bold" id="power10CopiedMsg" aria-live="polite">
              <i class="bi bi-check-circle-fill" aria-hidden="true"></i> Copied!
            </span>
          </div>

          <a href="<?= $assetPath ?>/book-ride-online" class="pc-power10-cta text-decoration-none rounded-pill d-inline-flex align-items-center gap-2">
            Book a Ride <i class="bi bi-chevron-right fs-8" aria-hidden="true"></i>
          </a>
        </div>

        <!-- RIGHT: promotional image -->
        <div class="col-lg-6 pc-power10-visual pc-reveal">
          <div class="pc-power10-image-wrap position-relative mx-auto">
            <span class="pc-power10-image-shape position-absolute z-0" aria-hidden="true"></span>
            <div class="pc-power10-image-frame position-relative z-1 overflow-hidden">
              <img
                src="https://img.magnific.com/free-vector/special-promo-code-get-10-percent-off_1017-53815.jpg?semt=ais_hybrid&w=740&q=80"
                alt="Power10 promotional graphic -- use promo code POWER10 to get 10% off your PowerCabs ride"
                class="pc-power10-image d-block w-100 h-100 object-fit-cover" loading="lazy" width="740" height="740">
            </div>
            <span class="pc-power10-image-tag position-absolute z-2 fw-bold rounded-pill d-inline-flex align-items-center gap-2">
              PowerCabs Exclusive
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  (function () {
    var btn = document.getElementById('power10CopyBtn');
    var msg = document.getElementById('power10CopiedMsg');
    if (!btn || !msg) return;

    var hideTimer = null;
    btn.addEventListener('click', function () {
      var code = btn.getAttribute('data-code') || 'POWER10';

      function reveal() {
        msg.classList.add('is-visible');
        clearTimeout(hideTimer);
        hideTimer = setTimeout(function () {
          msg.classList.remove('is-visible');
        }, 1800);
      }

      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(code).then(reveal, reveal);
      } else {
        reveal();
      }
    });
  })();
</script>
