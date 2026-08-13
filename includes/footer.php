</main>

<?php $assetPath = $assetPath ?? '';  ?>
<footer class="pc-footer-light pb-4 overflow-hidden">

  <div class="container position-relative">
    <div class="row gy-5 row-cols-2 row-cols-md-3 row-cols-lg-5">
      <div class="col">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Contact</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/contact-us">Contact Us</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/complaint-form">Complaint Form</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/positive-feedback-form">Positive Feedback Form</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/lost-item-report">Lost an Item Report</a></li>

        </ul>
      </div>

      <div class="col">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Get Started</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/download-our-app">Download App</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/wheelchair-accessible-taxis">Wheelchair Accessible Taxis</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/airport-transfers">Meet &amp; Greet</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/city-tours">City Tours</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/about-us">About Us</a></li>
        </ul>
      </div>

      <div class="col">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Business</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/corporate-services">Corporate Services</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/business-solutions">PowerCabs Business Solutions</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/partner-programme">Partner Programme</a></li>
        </ul>
      </div>

      <div class="col">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Drivers</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/ambassador-programme">Ambassador Programme</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/loyalty-program">Loyalty Program</a></li>
        </ul>
      </div>

      <div class="col">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Policies &amp; Safety</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/safety-tips-drivers">Driver Safety</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/safety-tips-riders">Rider Safety</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/sustainability">Sustainability &amp; Environment</a></li>
          <li><a class="pc-footer-link" href="<?= $assetPath ?>/faqs">FAQs</a></li>
        </ul>
      </div>

            <div class="col">
        <h6 class="fw-semibold mb-3" style="color: var(--pc-orange);">Address</h6>
        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
          <li class="d-flex align-items-start gap-2 small text-muted-pc">
            <i class="bi bi-geo-alt-fill mt-1" style="color: var(--pc-orange);"></i>
            <span>Kylmore Road, Inchicore, Dublin D10 K729</span>
          </li>
          <li class="d-flex align-items-start gap-2 small text-muted-pc">
            <i class="bi bi-receipt mt-1" style="color: var(--pc-orange);"></i>
            <span>Tax Number: 04301619NH</span>
          </li>
          <li class="d-flex align-items-start gap-2 small text-muted-pc">
            <i class="bi bi-patch-check-fill mt-1" style="color: var(--pc-orange);"></i>
            <span>NTA License: DH12616</span>
          </li>
          <li class="d-flex align-items-start gap-2 small">
            <i class="bi bi-telephone-fill mt-1" style="color: var(--pc-orange);"></i>
            <a class="pc-footer-link pc-footer-link-plain" href="tel:+353899728089">+353 89 972 8089</a>
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
        <a class="pc-footer-social" href="https://x.com/powercabsie" target="_blank" rel="noopener" aria-label="PowerCabs on X">
          <i class="bi bi-twitter-x"></i>
        </a>
        <a class="pc-footer-social" href="https://youtube.com/@powercabs" target="_blank" rel="noopener" aria-label="PowerCabs on YouTube">
          <i class="bi bi-youtube"></i>
        </a>
        <a class="pc-footer-social" href="https://vm.tiktok.com/ZSYUyT1fd/" target="_blank" rel="noopener" aria-label="PowerCabs on TikTok">
          <i class="bi bi-tiktok"></i>
        </a>
      </div>
    </div>
  </div>
</footer>

<?php require __DIR__ . '/../components/shared/scroll-indicator.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $assetPath ?>assets/js/main.js"></script>
<script src="<?= $assetPath ?>assets/js/components/toast.js"></script>
<script src="<?= $assetPath ?>assets/js/components/ajax-forms.js"></script>
<script src="<?= $assetPath ?>assets/js/components/pjax.js"></script>
<script src="<?= $assetPath ?>assets/js/components/page-loader.js"></script>
</body>
</html>
