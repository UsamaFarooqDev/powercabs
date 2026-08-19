</main>

<?php $assetPath = $assetPath ?? ''; ?>
<footer class="pc-footer-light pb-4 overflow-hidden">

  <div class="container position-relative">
    <div class="row gy-5">

      <div class="col-6 col-md-4 col-lg">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Get Started</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/download-our-app">Download App</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/wheelchair-accessible-taxis">Wheelchair Accessible Taxis</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/city-tours">City Tours</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/about-us">About Us</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-4 col-lg">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Business &amp; Drivers</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/corporate-services">Corporate Services</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/meet-greet">Meet &amp; Greet</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/business-solutions">PowerCabs Business Solutions</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/partner-programme">Partner Programme</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/ambassador-programme">Ambassador Programme</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/loyalty-program">Loyalty Program</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-4 col-lg">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Policies &amp; Safety</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/safety-tips-drivers">Driver Safety</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/safety-tips-riders">Rider Safety</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/sustainability">Sustainability &amp; Environment</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/faqs">FAQs</a></li>
        </ul>
      </div>

      <div class="col-6 col-md-4 col-lg">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Contact</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/contact-us">Contact Us</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/complaint-form">Complaint Form</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/positive-feedback-form">Positive Feedback Form</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/lost-item-report">Lost an Item Report</a></li>
        </ul>
      </div>

      <div class="col-12 col-lg">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Address</h6>
        <ul class="list-unstyled d-flex flex-column gap-3 mb-0">
          <li class="d-flex align-items-center gap-2 small text-muted-pc">
            <i class="bi bi-geo-alt-fill flex-shrink-0" style="color: var(--pc-orange);"></i>
            <span>Kylmore Road, Inchicore, Dublin D10 K729</span>
          </li>
          <li class="d-flex align-items-center gap-2 small text-muted-pc">
            <i class="bi bi-receipt flex-shrink-0" style="color: var(--pc-orange);"></i>
            <span>Tax Number: 04301619NH</span>
          </li>
          <li class="d-flex align-items-center gap-2 small text-muted-pc">
            <i class="bi bi-patch-check-fill flex-shrink-0" style="color: var(--pc-orange);"></i>
            <span>NTA License: DH12616</span>
          </li>
          <li class="d-flex align-items-center gap-2 small">
            <i class="bi bi-telephone-fill flex-shrink-0" style="color: var(--pc-orange);"></i>
            <a class="pc-footer-link pc-footer-link-plain" href="tel:+35312030727">+353 12 03 0727</a>
          </li>
          <li>
            <a class="pc-wa-badge d-inline-flex align-items-center gap-2" href="https://wa.me/353899728089" target="_blank" rel="noopener" aria-label="Chat with PowerCabs on WhatsApp">
              <span class="pc-wa-badge-icon d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0">
                <span class="pc-wa-badge-pulse" aria-hidden="true"></span>
                <i class="bi bi-whatsapp"></i>
              </span>
              <span class="d-flex flex-column lh-sm">
                <strong class="pc-wa-badge-title mb-1">WhatsApp Us</strong>
                <small class="pc-wa-badge-number">+353 89 972 8089</small>
              </span>
            </a>
          </li>
        </ul>
      </div>
    </div>

    <hr class="pc-footer-divider my-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
      <p class="small pc-footer-copyright mb-0">
        &copy; 2024&ndash;<?php echo date('Y'); ?> Powercabs Ireland Limited.
      </p>
      <div class="d-flex gap-4">
        <a class="pc-footer-bottom-link" href="<?= $assetPath ?>/privacy-policy">Privacy Policy</a>
        <a class="pc-footer-bottom-link" href="<?= $assetPath ?>/terms-conditions">Terms &amp; Conditions</a>
        <a class="pc-footer-bottom-link" href="<?= $assetPath ?>/gdpr">GDPR</a>
      </div>
      <div class="d-flex gap-3">
        <a class="pc-footer-social" href="https://www.facebook.com/powercabs.ie/" target="_blank" rel="noopener" aria-label="PowerCabs on Facebook">
          <i class="bi bi-facebook"></i>
        </a>
        <a class="pc-footer-social" href="https://www.instagram.com/powercabs.ie/" target="_blank" rel="noopener" aria-label="PowerCabs on Instagram">
          <i class="bi bi-instagram"></i>
        </a>
        <!-- <a class="pc-footer-social" href="https://x.com/powercabsie" target="_blank" rel="noopener" aria-label="PowerCabs on X">
          <i class="bi bi-twitter-x"></i>
        </a> -->
        <a class="pc-footer-social" href="https://vm.tiktok.com/ZSYUyT1fd/" target="_blank" rel="noopener" aria-label="PowerCabs on TikTok">
          <i class="bi bi-tiktok"></i>
        </a>
        <a class="pc-footer-social" href="https://youtube.com/@powercabs" target="_blank" rel="noopener" aria-label="PowerCabs on YouTube">
          <i class="bi bi-youtube"></i>
        </a>
      </div>
    </div>
  </div>
</footer>

<?php require __DIR__ . '/../components/shared/scroll-indicator.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $assetPath ?>assets/js/main.js?v=<?= @filemtime(__DIR__ . '/../assets/js/main.js') ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/toast.js?v=<?= @filemtime(__DIR__ . '/../assets/js/components/toast.js') ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/ajax-forms.js?v=<?= @filemtime(__DIR__ . '/../assets/js/components/ajax-forms.js') ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/pjax.js?v=<?= @filemtime(__DIR__ . '/../assets/js/components/pjax.js') ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/page-loader.js?v=<?= @filemtime(__DIR__ . '/../assets/js/components/page-loader.js') ?>"></script>
</body>
</html>
