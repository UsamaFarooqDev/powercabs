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
    <p class="pc-trusted-banner-text-mobile text-white position-absolute top-50 start-50 translate-middle text-center mb-0 d-md-none">
      Powering Every Journey,<br>Every Driver
    </p> 
    <p class="pc-trusted-banner-text text-white pc-trusted-banner-text-tl position-absolute mb-0 d-none d-md-block">
      Powering
    </p> 

    <p class="pc-trusted-banner-text text-white pc-trusted-banner-text-center position-absolute start-50 translate-middle text-center mb-0 d-none d-md-block" style="top: 42%;">
      Every<br>Journey
    </p> 

    <p class="pc-trusted-banner-text text-white pc-trusted-banner-text-br text-nowrap position-absolute mb-0 d-none d-md-block">
      Every Driver
    </p> 
  </div> 
  <div class="section-pc container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Our Partners</p>
      <h2 class="mb-3">Trusted by Leading Irish Brands.</h2>
      <p class="text-muted-pc mx-auto mb-0" style="max-width: 52ch;">From national retailers to healthcare, hospitality and media, businesses across Ireland rely on PowerCabs to move their people and guests.</p>
    </div>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 row-cols-xl-5 g-3 g-md-4">
      <?php foreach ($trustedLogos as $index => $logo): ?>

        <?php
        // Skip the 16th logo
        if ($index === 15) {
          continue;
        }
        ?>

        <div class="col">
          <div class="h-100 d-flex align-items-center justify-content-center bg-white rounded-4 p-3 p-md-4" style="min-height: 108px; border: 1px solid rgba(28,20,16,.06); box-shadow: var(--pc-shadow-sm);">
            <img
              src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>"
              alt="<?= htmlspecialchars($logo['alt']) ?>"
              style="max-height: 38px; max-width: 100%; width: auto; object-fit: contain;"
              loading="lazy"
            >
          </div>
        </div>

      <?php endforeach; ?>
    </div>

    <div class="rounded-4 p-4 p-md-5 mt-5 text-center text-white position-relative overflow-hidden" style="background: radial-gradient(120% 140% at 50% 0%, #2a1a10 0%, var(--pc-dark) 55%, var(--pc-dark-soft) 100%); box-shadow: var(--pc-shadow-lg);">
      <div class="d-inline-flex align-items-center justify-content-center rounded-circle mb-3" style="width: 64px; height: 64px; background: rgba(255,122,0,.15); border: 1px solid rgba(255,122,0,.35);">
        <i class="bi bi-megaphone-fill fs-3" style="color: var(--pc-orange-light);" aria-hidden="true"></i>
      </div>
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange-light);">/ Partner With Us</p>
      <h2 class="text-white mx-auto mb-3" style="max-width: 34ch; font-size: clamp(1.6rem, 3.2vw, 2.2rem);">Let Dublin Discover Your Business</h2>
      <p class="mx-auto mb-2" style="max-width: 56ch; color: rgba(255,255,255,.8); font-size: 1.05rem;">Partner with PowerCabs and showcase your business to our customers through our growing taxi network and digital platforms.</p>
      <p class="mx-auto mb-4" style="max-width: 56ch; color: rgba(255,255,255,.8); font-size: 1.05rem;">Join us today and turn every journey into an opportunity to reach new customers.</p>
      <div class="d-flex flex-wrap align-items-center justify-content-center gap-3">
        <a class="btn btn-pc-primary px-4 rounded-pill d-inline-flex align-items-center gap-2" href="<?= $assetPath ?>/business">
          Partner with Us <i class="bi bi-chevron-right fs-8" aria-hidden="true"></i>
        </a>
        <span class="d-inline-flex align-items-center gap-2 small" style="color: rgba(255,255,255,.7);">
          <i class="bi bi-lightning-charge-fill" style="color: var(--pc-orange-light);" aria-hidden="true"></i> Apply in 2 minutes
        </span>
      </div>
    </div>
  </div>
</section>