<?php
$ambJourneySteps = [
  ['icon' => 'car', 'label' => 'Drive'],
  ['icon' => 'badge', 'label' => 'Represent PowerCabs'],
  ['icon' => 'cash', 'label' => 'Earn'],
  ['icon' => 'gift', 'label' => 'Get Rewarded'],
];

function pc_amb_journey_icon(string $icon): void
{
  switch ($icon):
    case 'car': ?>
      <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
    <?php break;
    case 'badge': ?>
      <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'cash': ?>
      <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v12m-3.75-9.75h5.25a2.25 2.25 0 010 4.5h-3a2.25 2.25 0 000 4.5h5.25M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0z"/></svg>
    <?php break;
    case 'gift': ?>
      <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H4.5a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1014.625 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 109.375 7.5H12m0 0V21m-8.25-9.75h16.5a1.125 1.125 0 001.125-1.125v-2.25A1.125 1.125 0 0020.25 6.75H3.75A1.125 1.125 0 002.625 7.875v2.25A1.125 1.125 0 003.75 11.25z"/></svg>
    <?php break;
  endswitch;
}
?>
<!-- #pcAmbJourney / #pcAmbJourneyImg / bare .pc-amb-journey-step are JS
     hooks: ambassador-page.js scroll-parallaxes the image (inline
     style.transform, untouched by this markup) and reveals each step via
     IntersectionObserver + .is-visible, handled below with
     `[&.is-visible]:` + `motion-reduce:`. -->
<section class="tw-relative tw-overflow-hidden tw-py-[clamp(6rem,12vw,9rem)] tw-text-white" id="pcAmbJourney">
  <div class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-overflow-hidden" aria-hidden="true">
    <img src="https://images.pexels.com/photos/32234671/pexels-photo-32234671.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1600" alt="" class="tw-h-full tw-w-full tw-object-cover [transform:scale(1.12)] tw-will-change-transform" loading="lazy" id="pcAmbJourneyImg">
  </div>
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-bg-[linear-gradient(180deg,rgba(10,7,5,0.6)_0%,rgba(10,7,5,0.78)_100%)]" aria-hidden="true"></span>

  <div class="tw-relative tw-z-[1] tw-mx-auto tw-w-full tw-max-w-[1320px] tw-px-4 tw-text-center sm:tw-px-6 lg:tw-px-8">
    <p class="tw-mb-3 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-powerlight">/ The Ambassador Journey</p>
    <h2 class="tw-mx-auto tw-mb-12 tw-max-w-[34ch] tw-text-[clamp(2rem,4.5vw,3.25rem)] tw-font-bold tw-leading-tight">
      Every Road You Drive Builds Something Bigger.
    </h2>

    <div class="tw-flex tw-flex-wrap tw-items-start tw-justify-center">
      <?php foreach ($ambJourneySteps as $i => $step): ?>
        <div class="pc-amb-journey-step tw-relative tw-flex tw-flex-col tw-items-center tw-px-8 tw-opacity-0 tw-translate-y-4 tw-transition-all tw-duration-500 tw-ease-out [&.is-visible]:tw-opacity-100 [&.is-visible]:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-transition-none">
          <?php if ($i > 0): ?>
            <svg class="tw-absolute tw-left-0 tw-top-[1.625rem] tw-hidden -tw-translate-x-1/2 -tw-translate-y-1/2 tw-text-white/40 md:tw-block" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/></svg>
          <?php endif; ?>
          <span class="tw-inline-flex tw-h-[3.25rem] tw-w-[3.25rem] tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-white/25 tw-bg-white/[0.12] tw-text-powerlight">
            <?php pc_amb_journey_icon($step['icon']); ?>
          </span>
          <span class="tw-mt-2 tw-block tw-font-semibold"><?= htmlspecialchars($step['label']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
