<?php
$bizTrustLogos = [
  ['file' => 'Boots.png', 'alt' => 'Boots', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'boylesports.png', 'alt' => 'BoyleSports', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'svuh.png', 'alt' => "St. Vincent's University Hospital", 'h' => 'tw-max-h-[46px]'],
  ['file' => 'westpark.webp', 'alt' => 'Westpark Fitness', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'RIU_Hotels.webp', 'alt' => 'RIU Hotels & Resorts', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'rte.webp', 'alt' => 'RTE', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'Mediahuis.webp', 'alt' => 'Mediahuis', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'skylon.png', 'alt' => 'Skylon Hotel', 'h' => 'tw-max-h-[64px]'],
  ['file' => 'greenisle.png', 'alt' => 'Green Isle Hotel', 'h' => 'tw-max-h-[46px]'],
  ['file' => 'elmpark.png', 'alt' => 'Elm Park', 'h' => 'tw-max-h-[66px]'],
  ['file' => 'st-james-social.jpg', 'alt' => "St. James's Hospital", 'h' => 'tw-max-h-[46px]'],
  ['file' => 'Irish_ferries.webp', 'alt' => 'Irish Ferries', 'h' => 'tw-max-h-[46px]'],
  ['file' => 'griffith-college.png', 'alt' => 'Griffith College', 'h' => 'tw-max-h-[46px]'],
  ['file' => 'pennys.png', 'alt' => 'Penneys', 'h' => 'tw-max-h-[54px]'],
  ['file' => 'Star_Cineworld.jpg', 'alt' => 'Cineworld', 'h' => 'tw-max-h-[56px]'],
];
?>
<section class="<?= $pcSurfaceWhite ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <?php  ?>
    <p class="tw-mx-auto tw-mb-12 tw-max-w-[42ch] tw-text-center tw-text-[1.0625rem] tw-font-semibold tw-text-ink">
      Businesses across Ireland already move their people with PowerCabs.
    </p>

    <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-3 tw-items-center tw-gap-x-10 tw-gap-y-12 tw-p-0 sm:tw-grid-cols-5">
      <?php foreach ($bizTrustLogos as $logo): ?>
        <li class="tw-flex tw-items-center tw-justify-center">
          <img src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>"
            alt="<?= htmlspecialchars($logo['alt']) ?>"
            class="<?= $logo['h'] ?> tw-w-auto tw-max-w-full tw-object-contain tw-opacity-[0.72] tw-transition-opacity tw-duration-300 hover:tw-opacity-100 motion-reduce:tw-transition-none"
            loading="lazy">
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
