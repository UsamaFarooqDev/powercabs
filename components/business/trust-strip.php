<?php

$bizTrustLogos = [
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
];
// Duplicated once so the marquee track can loop seamlessly at exactly -50%.
$bizTrustMarqueeItems = array_merge($bizTrustLogos, $bizTrustLogos);
?>
<section class="pc-biz-trust bg-white">
  <div class="container">
    <p class="text-center small fw-semibold text-uppercase mb-4" style="letter-spacing: .1em; color: var(--pc-text-muted);">
      Trusted by Businesses Across Ireland
    </p>
  </div>

  <div class="pc-marquee pc-biz-trust-marquee">
    <div class="pc-marquee-track d-flex pc-biz-trust-track">
      <?php foreach ($bizTrustMarqueeItems as $i => $logo): ?>
        <div class="pc-biz-trust-logo-item d-flex align-items-center justify-content-center flex-shrink-0" <?= $i >=
        count($bizTrustLogos)
          ? 'aria-hidden="true"'
          : '' ?>>
          <img src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>" alt="<?= htmlspecialchars(
  $logo['alt'],
) ?>" class="pc-biz-trust-logo w-auto object-fit-contain" loading="lazy">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
