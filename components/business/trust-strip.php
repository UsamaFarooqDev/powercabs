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
<section class="tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06] tw-bg-white tw-py-[clamp(2.5rem,4vw,3.5rem)]">
  <div class="<?= $pcContainer ?>">
    <p class="tw-mb-4 tw-text-center tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.1em] tw-text-ink/60">
      Trusted by Businesses Across Ireland
    </p>
  </div>

  <!-- Infinite logo marquee: the track holds two copies of the list and
       slides exactly -50%, so the seam is invisible. Hover pauses it via
       the group on the wrapper; reduced motion stops it and lets the strip
       scroll by hand instead. 46s here vs the 36s default -- more logos. -->
  <div class="tw-group tw-overflow-hidden [-webkit-mask-image:linear-gradient(90deg,transparent,#000_6%,#000_94%,transparent)] [mask-image:linear-gradient(90deg,transparent,#000_6%,#000_94%,transparent)] motion-reduce:tw-overflow-x-auto tw-py-2">
    <div class="tw-flex tw-w-max tw-animate-pc-marquee group-hover:[animation-play-state:paused] motion-reduce:tw-animate-none [animation-duration:46s]">
      <?php foreach ($bizTrustMarqueeItems as $i => $logo): ?>
        <div class="tw-flex tw-w-[120px] tw-shrink-0 tw-items-center tw-justify-center tw-px-3.5 sm:tw-w-[150px] sm:tw-px-5" <?= $i >=
        count($bizTrustLogos)
          ? 'aria-hidden="true"'
          : '' ?>>
          <img src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>" alt="<?= htmlspecialchars(
  $logo['alt'],
) ?>" class="tw-h-7 tw-w-auto tw-max-w-full tw-object-contain sm:tw-h-[34px]" loading="lazy">
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
