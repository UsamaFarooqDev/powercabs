<?php
/**
 * About page: "Our Dublin Story" masonry grid.
 * Requires $assetPath from the including page.
 */
?>
<section class="section-pc">
  <div class="container">
    <div class="mb-4">
      <h2 class="pc-dublin-story-heading mb-0">Our Dublin Story</h2>
    </div>

    <div class="pc-story-masonry">
      <div class="pc-story-item-1 pc-story-card p-4" style="background: var(--pc-cream);">
        <i class="bi bi-building fs-3 mb-3 d-block" style="color: var(--pc-orange);"></i>
        <h3 class="fs-6 fw-bold mb-2">Dublin Roots</h3>
        <p class="small text-muted-pc mb-0">PowerCabs is proudly based in Inchicore, growing our fleet to serve the Greater Dublin Area with dependable, licensed drivers.</p>
      </div>

      <div class="pc-story-item-2 pc-story-card p-4 bg-white">
        <span class="pc-story-star-icon mb-3"><i class="bi bi-star-fill"></i></span>
        <h3 class="fs-6 fw-bold mb-2">Excellence as Standard</h3>
        <p class="small text-muted-pc mb-0">Trusted by riders and businesses across Dublin for safe, professional service, day and night.</p>
      </div>

      <div class="pc-story-item-3 position-relative overflow-hidden">
        <img src="<?= $assetPath ?>assets/img/service-city-tour.jpg" alt="Dublin city street" class="w-100 h-100 object-fit-cover" loading="lazy">
        <span class="position-absolute bottom-0 start-0 end-0 p-3 text-white fw-semibold" style="background: linear-gradient(to top, rgba(10,7,5,.7), transparent);">Growing with the City</span>
      </div>

      <div class="pc-story-item-5 pc-story-card-orange p-4 text-center text-white">
        <span class="d-block pc-story-orange-figure">24/7</span>
        <span class="d-block small text-uppercase" style="letter-spacing: .05em;">Available, Every Day</span>
      </div>

      <div class="pc-story-item-6 pc-story-card p-4 bg-white">
        <h3 class="fs-6 fw-bold mb-2">Tech-First Approach</h3>
        <p class="small text-muted-pc mb-3">Our booking and dispatch technology connects you with a nearby licensed driver quickly, wherever you are in Dublin.</p>
        <div class="pc-story-progress"></div>
      </div>
    </div>
  </div>
</section>
