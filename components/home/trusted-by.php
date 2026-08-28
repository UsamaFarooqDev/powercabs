<?php $trustedLogos = [
  ['file' => 'Boots.png', 'alt' => 'Boots'],
  ['file' => 'boylesports.png', 'alt' => 'BoyleSports'],
  ['file' => 'svuh.png', 'alt' => "St. Vincent's"],
  ['file' => 'westpark.webp', 'alt' => 'Westpark'],
  ['file' => 'RIU_Hotels.webp', 'alt' => 'RIU'],
  ['file' => 'RTÉ.webp', 'alt' => 'RTE'],
  ['file' => 'Mediahuis.webp', 'alt' => 'Mediahuis'],
  ['file' => 'skylon.png', 'alt' => 'Skylon Hotel'],
  ['file' => 'greenisle.png', 'alt' => 'Green Isle'],
  ['file' => 'elmpark.png', 'alt' => 'ELM'],
  ['file' => 'st-james-social.jpg', 'alt' => "St. James's"],
  ['file' => 'Irish_ferries.webp', 'alt' => 'Irish Ferries'],
  ['file' => 'griffith-college.png', 'alt' => 'Griffith College'],
  ['file' => 'pennys.png', 'alt' => 'Penneys'],
  ['file' => 'Star_Cineworld.jpg', 'alt' => 'Cineworld'],
  ['file' => 'Research-Office.png', 'alt' => 'Tallaght'],
]; ?> 
 
<section class="bg-white"> 
  <div class="position-relative overflow-hidden mb-5" style="aspect-ratio: 2460 / 1128;"> 
    <img 
      src="<?= $assetPath ?>assets/img/trusted-bg.svg" 
      alt="" 
      aria-hidden="true"
      class="w-100 h-100" 
      style="object-fit: cover; object-position: top; display: block;" 
      loading="lazy"
    > 
    <p class="pc-trusted-banner-text-mobile position-absolute top-50 start-50 translate-middle text-center mb-0 d-md-none">
      Powering Every Journey,<br>Every Driver
    </p> 
    <p class="pc-trusted-banner-text pc-trusted-banner-text-tl position-absolute mb-0 d-none d-md-block">
      Powering
    </p> 

    <p class="pc-trusted-banner-text pc-trusted-banner-text-center position-absolute start-50 translate-middle text-center mb-0 d-none d-md-block" style="top: 42%;">
      Every<br>Journey
    </p> 

    <p class="pc-trusted-banner-text pc-trusted-banner-text-br position-absolute mb-0 d-none d-md-block">
      Every Driver
    </p> 
  </div> 
  <div class="section-pc container"> 
    <h2 class="mb-5">
      Trusted by Leading Irish Brands.
    </h2> 
    <div class="trusted-logo-grid row row-cols-2 row-cols-sm-3 row-cols-lg-5 g-0 align-items-stretch"> 
      <?php foreach ($trustedLogos as $index => $logo): ?>

        <?php
        // Skip the 16th logo
        if ($index === 15) {
          continue;
        }

        // First 7 logos keep normal sizing
        $isSmallLogo = $index >= 7;
        ?>

        <div class="col trusted-logo-card d-flex align-items-center justify-content-center">

          <div class="w-100 h-100 d-flex align-items-center justify-content-center px-3 py-4">

            <img 
              src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>" 
              alt="<?= htmlspecialchars($logo['alt']) ?>" 
              class="<?= $isSmallLogo ? 'pc-trusted-logo-small' : 'pc-trusted-logo' ?>"
              loading="lazy"
            >
          </div>
        </div>
        
      <?php endforeach; ?>
    </div> 
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mt-5 pt-4">
      <div class="d-flex align-items-center gap-3" style="max-width: 34rem; min-width: 0;">
        <i class="bi bi-briefcase-fill flex-shrink-0" style="font-size: 1.5rem; color: var(--pc-orange);"></i>
        <p class="mb-0" style="min-width: 0;">
          <span class="d-block fw-bold" style="color: var(--pc-dark); font-size: 1.2rem;">Become a Business Client</span>
          <span class="d-block" style="font-size: 1.2rem;">Showcase your brand with us &mdash; apply in just 2 minutes.</span>
        </p>
      </div>
      <a class="btn btn-pc-primary px-3 flex-shrink-0 d-inline-flex align-items-center gap-1" href="<?= $assetPath ?>/business">
        Partner with Us <i class="bi bi-chevron-right fs-8"></i>
      </a>
    </div>
  </div>
</section>

<style>
  /* Logo cards */
  .trusted-logo-card {
    border-top: 1px solid rgba(0, 0, 0, 0.07);
    border-right: 1px solid rgba(0, 0, 0, 0.07);
    min-height: 105px;
  }

  /* Remove left border from the first card */
  .trusted-logo-card:nth-child(5n + 1) {
    border-left: 0;
  }

  /* Remove right border from the last card in desktop rows */
  .trusted-logo-card:nth-child(5n) {
    border-right: 0;
  }

  /* First row has no top border */
  .trusted-logo-card:nth-child(-n + 5) {
    border-top: 0;
  }

  /* Normal logos - first 7 */
  .pc-trusted-logo {
    height: 34px;
    width: auto;
    max-width: 100%;
    object-fit: contain;
  }

  /* Smaller logos - remaining logos */
  .pc-trusted-logo-small {
    height: 52px;
    width: auto;
    max-width: 97%;
    object-fit: contain;
  }

  /* Tablet */
  @media (max-width: 991.98px) {

    .trusted-logo-card {
      min-height: 100px;
    }

    .trusted-logo-card:nth-child(5n + 1) {
      border-left: 1px solid rgba(0, 0, 0, 0.07);
    }

    .trusted-logo-card:nth-child(3n + 1) {
      border-left: 0;
    }

    .trusted-logo-card:nth-child(5n) {
      border-right: 1px solid rgba(0, 0, 0, 0.07);
    }

    .trusted-logo-card:nth-child(3n) {
      border-right: 0;
    }

    .trusted-logo-card:nth-child(-n + 5) {
      border-top: 1px solid rgba(0, 0, 0, 0.07);
    }

    .trusted-logo-card:nth-child(-n + 3) {
      border-top: 0;
    }

    .pc-trusted-logo {
      height: 32px;
    }

    .pc-trusted-logo-small {
      height: 42px;
      max-width: 95%;
    }
  }

  /* Mobile */
  @media (max-width: 575.98px) {

    .trusted-logo-card {
      min-height: 90px;
    }

    .trusted-logo-card:nth-child(3n + 1) {
      border-left: 1px solid rgba(0, 0, 0, 0.07);
    }

    .trusted-logo-card:nth-child(2n + 1) {
      border-left: 0;
    }

    .trusted-logo-card:nth-child(3n) {
      border-right: 1px solid rgba(0, 0, 0, 0.07);
    }

    .trusted-logo-card:nth-child(2n) {
      border-right: 0;
    }

    .trusted-logo-card:nth-child(-n + 3) {
      border-top: 1px solid rgba(0, 0, 0, 0.07);
    }

    .trusted-logo-card:nth-child(-n + 2) {
      border-top: 0;
    }

    .pc-trusted-logo {
      height: 30px;
    }

    .pc-trusted-logo-small {
      height: 42px;
      max-width: 95%;
    }
  }
</style>