<?php $trustedLogos = [
  ['file' => 'Boots.png', 'alt' => 'Boots'],
  ['file' => 'boylesports.png', 'alt' => 'BoyleSports'],
  ['file' => 'svuh.png', 'alt' => "St. Vincent's"],
  ['file' => 'westpark.webp', 'alt' => 'Westpark'],
  ['file' => 'RIU_Hotels.webp', 'alt' => 'RIU'],
  ['file' => 'rte.webp', 'alt' => 'RTE'],
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

<section class="tw-bg-white tw-mt-16">
  <div class="<?= $pcContainer ?> tw-mt-16">
    <div class="tw-mx-auto tw-mb-12 tw-max-w-[62ch] tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ Our Partners</p>
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Trusted by Leading Irish Brands.</h2>
      <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/[0.62]">From national retailers to healthcare, hospitality and media, <br>businesses across Ireland rely on PowerCabs to move their people and guests.</p>
    </div>

    <div class="tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-black/[0.06] tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.06] sm:tw-grid-cols-3 lg:tw-grid-cols-5">
      <?php foreach ($trustedLogos as $index => $logo): ?>

        <?php
        // Skip the 16th logo
        if ($index === 15) {
          continue;
        }
        ?>

        <div class="tw-group tw-flex tw-min-h-[116px] tw-items-center tw-justify-center tw-bg-white tw-p-5">
          <img
            src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>"
            alt="<?= htmlspecialchars($logo['alt']) ?>"
            class="<?= $index >= 7 ? 'tw-max-h-[52px]' : 'tw-max-h-[34px]' ?> tw-w-auto tw-max-w-full tw-object-contain tw-transition-transform tw-duration-300 group-hover:tw-scale-110"
            loading="lazy"
          >
        </div>

      <?php endforeach; ?>
    </div>

    <div class="tw-relative tw-mt-12 tw-overflow-hidden tw-rounded-2xl tw-bg-[radial-gradient(120%_140%_at_50%_0%,#2a1a10_0%,#1c1410_55%,#160f0a_100%)] tw-p-8 tw-text-center tw-text-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] md:tw-p-12">
      <img src="https://images.pexels.com/photos/13158057/pexels-photo-13158057.jpeg?auto=compress&cs=tinysrgb&w=1600"
        alt="" aria-hidden="true" loading="lazy" decoding="async"
        class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-center tw-brightness-[0.85]">
      <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(180deg,rgba(12,8,5,0.9)_0%,rgba(12,8,5,0.84)_45%,rgba(12,8,5,0.92)_100%)]" aria-hidden="true"></span>
      <span class="tw-absolute tw-inset-0 tw-bg-[radial-gradient(120%_140%_at_50%_0%,rgba(255,122,0,0.14)_0%,transparent_60%)]" aria-hidden="true"></span>

      <div class="tw-relative">
      <div class="tw-mb-3 tw-inline-flex tw-h-16 tw-w-16 tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-[rgba(255,122,0,0.35)] tw-bg-[rgba(255,122,0,0.15)]">
        <svg class="tw-h-7 tw-w-7 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13.5l4.286 2.143M18 8.5l4.286-2.143M4.99 9.75h.512c1.14 0 2.243-.288 3.187-.858l1.812-1.088a5.25 5.25 0 012.575-.804h1.174c.53 0 .96.43.96.96v6.16c0 .53-.43.96-.96.96h-1.174a5.25 5.25 0 01-2.575-.804l-1.812-1.088a6.4 6.4 0 00-3.187-.858h-.512a1.5 1.5 0 01-1.5-1.5v-.42a1.5 1.5 0 011.5-1.5z"/></svg>
      </div>
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-powerlight">/ Partner With Us</p>
      <h2 class="<?= $pcH2 ?> tw-mx-auto tw-max-w-[34ch] tw-text-white">Let Dublin Discover Your Business</h2>
      <p class="tw-mx-auto tw-mb-3 tw-max-w-[56ch] tw-text-[1.0625rem] tw-leading-[1.7] tw-text-white/85">Partner with PowerCabs and showcase your business to our customers through our growing taxi network and digital platforms.</p>
      <p class="tw-mx-auto tw-mb-7 tw-max-w-[56ch] tw-text-[1.0625rem] tw-leading-[1.7] tw-text-white/85">Join us today and turn every journey into an opportunity to reach new customers.</p>
      <div class="tw-flex tw-flex-wrap tw-items-center tw-justify-center tw-gap-4">
        <a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath ?>/business">
          Partner with Us
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
        </a>
        <span class="tw-inline-flex tw-items-center tw-gap-2 tw-text-[1.0325rem] tw-text-white/75">
          <svg class="tw-h-4 tw-w-4 tw-text-powerlight" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/></svg>
          Apply in 2 minutes
        </span>
      </div>
      </div>
    </div>
  </div>
</section>
