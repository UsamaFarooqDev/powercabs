<?php
$trustedLogos = [
  ['file' => 'Boots.svg',              'alt' => 'Boots'],
  ['file' => 'BoyleSports.svg',        'alt' => 'BoyleSports'],
  ['file' => 'Dublin-Hotel.svg',       'alt' => 'Skylon Hotel'],
  ['file' => 'ELM.svg',                'alt' => 'ELM'],
  ['file' => 'Green-Isle.svg',         'alt' => 'Green Isle'],
  ['file' => 'Griffith-College.svg',   'alt' => 'Griffith College'],
  ['file' => 'Irish_ferries_logo.svg', 'alt' => 'Irish Ferries'],
  ['file' => 'Mediahuis_logo.svg',     'alt' => 'Mediahuis'],
  ['file' => 'Penneys-logo.svg',       'alt' => 'Penneys'],
  ['file' => 'RIU.svg',                'alt' => 'RIU'],
  ['file' => 'RTE.svg',                'alt' => 'RTE'],
  ['file' => 'St-James.svg',           'alt' => "St. James's"],
  ['file' => 'St-Vincent.svg',         'alt' => "St. Vincent's"],
  ['file' => 'Westpark.svg',           'alt' => 'Westpark'],
  ['file' => 'cineworld-seeklogo.svg', 'alt' => 'Cineworld'],
  ['file' => 'tallaght-logo.svg',      'alt' => 'Tallaght'],
];
?>

<section class="bg-white">
      <div class="position-relative overflow-hidden mb-5" style="aspect-ratio: 2460 / 1128;">
      <img src="<?= $assetPath ?>assets/img/trusted-bg.svg" alt="" aria-hidden="true"
           class="w-100 h-100" style="object-fit: cover; object-position: top; display: block;" loading="lazy">

      <p class="pc-trusted-banner-text-mobile position-absolute top-50 start-50 translate-middle text-center mb-0 d-md-none">Powering Every Journey,<br>Every Driver</p>
      <p class="pc-trusted-banner-text pc-trusted-banner-text-tl position-absolute mb-0 d-none d-md-block">Powering</p>
      <p class="pc-trusted-banner-text pc-trusted-banner-text-center position-absolute start-50 translate-middle text-center mb-0 d-none d-md-block" style="top: 42%;">Every<br>Journey</p>
      <p class="pc-trusted-banner-text pc-trusted-banner-text-br position-absolute mb-0 d-none d-md-block">Every Driver</p>
    </div>

  <div class="section-pc container">
    <h2 class="mb-5">Trusted by Leading Irish Brands.</h2>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4 align-items-center justify-content-center">
      <?php foreach ($trustedLogos as $logo): ?>
        <div class="col d-flex align-items-center justify-content-center py-2">
          <img
            src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>"
            alt="<?= htmlspecialchars($logo['alt']) ?>"
            class="pc-trusted-logo"
            style="height: 34px; width: auto; max-width: 100%;"
            loading="lazy"
          >
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
