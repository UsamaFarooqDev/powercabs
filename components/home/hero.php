<?php
$heroServices = [
  ['icon' => 'clock', 'label' => 'Pay Per Hour', 'href' => '/ride'],
  ['icon' => 'briefcase', 'label' => 'Corporate', 'href' => '/corporate-services'],
  ['icon' => 'airplane', 'label' => 'Meet and Greet', 'href' => '/meet-greet'],
  ['icon' => 'card', 'label' => 'Business Solutions', 'href' => '/business-solutions'],
  ['icon' => 'compass', 'label' => 'City Tour', 'href' => '/city-tours'],
];

$heroCarShot = 'assets/img/PC-Hero.webp'; ?>
<section class="pc-hero tw-relative tw-flex tw-items-center tw-overflow-hidden tw-text-white tw-bg-[linear-gradient(165deg,#0a0807_0%,#14100c_60%,#0a0807_100%)] tw-min-h-[clamp(560px,100svh,900px)] tw-py-[clamp(7.5rem,13vw,9rem)] lg:tw-min-h-[clamp(620px,56.25vw,880px)] lg:tw-items-stretch lg:tw-pb-16">
  <div class="tw-absolute tw-inset-0 tw-overflow-hidden tw-pointer-events-none" aria-hidden="true">
    <img src="<?= $assetPath . htmlspecialchars($heroCarShot) ?>" alt="" aria-hidden="true"
      width="1672" height="941" fetchpriority="high" decoding="async"
      class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-[67%_58%] tw-brightness-[0.9] lg:tw-object-center">

    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(96deg,rgba(10,7,5,0.9)_0%,rgba(10,7,5,0.85)_45%,rgba(12,8,5,0.74)_100%)] lg:tw-bg-[linear-gradient(96deg,rgba(10,7,5,0.95)_0%,rgba(10,7,5,0.91)_30%,rgba(12,8,5,0.62)_58%,rgba(12,8,5,0.24)_100%)]"></span>
    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(105deg,transparent_45%,rgba(255,122,0,0.12)_78%,rgba(232,89,12,0.18)_100%)]"></span>
    <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(to_bottom,rgba(10,8,7,0.78)_0%,transparent_24%,transparent_62%,#0a0807_100%)]"></span>
  </div>

  <div class="tw-relative tw-z-10 <?= $pcContainer ?> lg:tw-flex lg:tw-flex-col">
    <div class="tw-pt-5 lg:tw-my-auto lg:tw-w-[56%] lg:tw-pt-0 xl:tw-w-[58%]">
      <h1 class="tw-mb-5 tw-text-[clamp(2.6rem,4.05vw,3.5rem)] tw-font-black tw-leading-[1.05] tw-tracking-[-0.02em] tw-text-white tw-animate-pc-fade-up [animation-delay:0.08s]">
        Your Journey.<br>Smarter. Faster. Premium.
      </h1>
      <p class="tw-mb-8 tw-max-w-[44ch] tw-text-[1.2rem] tw-leading-[1.6] tw-text-white/[0.7] tw-animate-pc-fade-up [animation-delay:0.16s]">
        Book reliable rides, drive with confidence, or manage corporate travel &mdash;
        all from one intelligent mobility platform.
      </p>

      <div class="tw-flex tw-flex-wrap tw-items-center tw-gap-3 tw-animate-pc-fade-up [animation-delay:0.24s]">
        <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-lg tw-bg-ink tw-py-2 tw-pl-2 tw-pr-4 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
          <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="20" height="20" aria-hidden="true">
          <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
            <span class="tw-text-[0.6rem] tw-uppercase tw-tracking-wide tw-text-white/75">Get it on</span>
            <span class="tw-text-sm tw-font-bold tw-text-white">Google Play</span>
          </span>
        </a>
        <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-lg tw-bg-ink tw-py-2 tw-pl-2.5 tw-pr-4 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
          <svg class="tw-h-5 tw-w-5 tw-text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.365 1.43c0 1.14-.493 2.27-1.177 3.08-.744.88-1.99 1.56-2.987 1.56-.12 0-.24-.02-.312-.03-.014-.11-.03-.24-.03-.38 0-1.1.556-2.22 1.183-2.98.674-.82 1.888-1.44 2.882-1.48.019.083.03.163.03.24zM20.13 17.14c-.51 1.14-.75 1.65-1.42 2.65-.93 1.42-2.24 3.19-3.87 3.2-1.45.02-1.82-.94-3.79-.93-1.97.01-2.38.95-3.83.93-1.63-.02-2.87-1.61-3.8-3.03-2.6-3.96-2.87-8.6-1.27-11.08.85-1.32 2.29-2.15 3.86-2.16 1.41-.02 2.74.95 3.6.95.86 0 2.47-1.17 4.17-1 .71.03 2.7.29 3.98 2.17-.1.06-2.38 1.39-2.35 4.14.03 3.28 2.88 4.37 2.92 4.39-.03.09-.45 1.55-1.19 3.03z"/></svg>
          <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
            <span class="tw-text-[0.6rem] tw-uppercase tw-tracking-wide tw-text-white/75">Download on the</span>
            <span class="tw-text-sm tw-font-bold tw-text-white">App Store</span>
          </span>
        </a>
      </div>
    </div>

    <div class="tw-mt-10 tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-white/10 tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-white/10 tw-bg-white/[0.06] tw-backdrop-blur-md tw-animate-pc-fade-up [animation-delay:0.32s] sm:tw-mt-12 md:tw-grid-cols-5 md:tw-divide-y-0 lg:tw-mt-10">
      <?php foreach ($heroServices as $service): ?>
        <a href="<?= $assetPath . htmlspecialchars($service['href']) ?>"
          class="tw-group tw-flex tw-flex-col tw-items-center tw-gap-2 tw-px-3 tw-py-5 tw-text-center tw-text-white tw-no-underline tw-transition-colors tw-duration-200">
          <?php switch ($service['icon']): case 'clock': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <?php break;case 'briefcase': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 14.15v4.25c0 1.09-.787 2.04-1.872 2.18-2.087.28-4.216.42-6.378.42s-4.291-.14-6.378-.42c-1.085-.14-1.872-1.09-1.872-2.18v-4.25M3.75 8.706c0-1.08.768-2.01 1.837-2.175a48.11 48.11 0 013.413-.387m7.5 0v-.894A2.25 2.25 0 0014.25 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M21 12.49c0 .65-.29 1.27-.75 1.66-.194.16-.42.29-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.43-7.577-1.22A2.016 2.016 0 013 12.49"/></svg>
            <?php break;case 'airplane': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
            <?php break;case 'card': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
            <?php break;case 'compass': ?>
              <svg class="tw-h-6 tw-w-6 tw-text-powerlight tw-transition-transform tw-duration-200 group-hover:-tw-translate-y-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M14.5 9.5l-1.5 4.5-4.5 1.5 1.5-4.5z"/></svg>
            <?php break;endswitch; ?>
          <span class="tw-text-sm tw-font-semibold tw-leading-tight"><?= htmlspecialchars($service['label']) ?></span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
