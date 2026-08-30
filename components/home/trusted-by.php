<?php
$trustedLogos = [
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
?>
<!-- ============ Section 07 -- Trust, kept minimal: a heading and a moving line of real partner logos ============ -->
<section class="tw-bg-paper tw-py-16 sm:tw-py-20 tw-overflow-hidden">
  <div class="container tw-mb-10 sm:tw-mb-12">
    <h2 class="pc-reveal tw-font-extrabold tw-tracking-tight tw-leading-[1] tw-text-[clamp(1.9rem,4.4vw,3rem)] tw-mb-0" style="color: var(--pc-dark);">
      Trusted by Dublin.
    </h2>
  </div>

  <div class="pc-reveal tw-relative tw-w-full tw-overflow-hidden [mask-image:linear-gradient(90deg,transparent,black_8%,black_92%,transparent)]">
    <div class="tw-flex tw-w-max tw-items-center tw-gap-16 tw-animate-marquee motion-reduce:tw-animate-none">
      <?php for ($rep = 0; $rep < 2; $rep++): ?>
        <div class="tw-flex tw-items-center tw-gap-16 tw-flex-shrink-0" aria-hidden="<?= $rep === 1 ? 'true' : 'false' ?>">
          <?php foreach ($trustedLogos as $logo): ?>
            <img src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>" alt="<?= $rep === 0 ? htmlspecialchars($logo['alt']) : '' ?>"
              class="tw-h-7 sm:tw-h-9 tw-w-auto tw-object-contain tw-flex-shrink-0 tw-opacity-70" loading="lazy">
          <?php endforeach; ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</section>
