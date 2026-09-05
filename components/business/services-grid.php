<?php
$bizServiceModules = [
  ['icon' => 'people', 'title' => 'Employee Travel', 'desc' => 'Everyday commutes and inter-office journeys for your whole team.'],
  ['icon' => 'person-lines', 'title' => 'Client Travel', 'desc' => 'Impress clients and guests from the moment they arrive.'],
  ['icon' => 'mic', 'title' => 'Events &amp; Conferences', 'desc' => 'Coordinated arrivals and departures for conferences and corporate events.'],
  ['icon' => 'building', 'title' => 'Hotel Guest Travel', 'desc' => 'Reliable transfers for hotel guests, booked straight to your account.'],
  ['icon' => 'briefcase', 'title' => 'Executive Travel', 'desc' => 'Discreet, punctual rides for executives and leadership teams.'],
];

function pc_biz_service_icon(string $icon): void
{
  switch ($icon):
    case 'people': ?>
      <svg class="tw-h-[1.15rem] tw-w-[1.15rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
    <?php break;
    case 'person-lines': ?>
      <svg class="tw-h-[1.15rem] tw-w-[1.15rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
    <?php break;
    case 'mic': ?>
      <svg class="tw-h-[1.15rem] tw-w-[1.15rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 18.75a6 6 0 006-6v-1.5m-6 7.5a6 6 0 01-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 01-3-3V4.5a3 3 0 116 0v8.25a3 3 0 01-3 3z"/></svg>
    <?php break;
    case 'building': ?>
      <svg class="tw-h-[1.15rem] tw-w-[1.15rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.75 21h16.5M4.5 3h15v18h-15V3zM9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
    <?php break;
    case 'briefcase': ?>
      <svg class="tw-h-[1.15rem] tw-w-[1.15rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 14.15v4.25a2 2 0 01-2 2H5.75a2 2 0 01-2-2v-4.25m16.5 0a2 2 0 00-2-2H5.75a2 2 0 00-2 2m16.5 0v-1.75a2 2 0 00-2-2H5.75a2 2 0 00-2 2v1.75M9 12.75V9.5A2.25 2.25 0 0111.25 7.25h1.5A2.25 2.25 0 0115 9.5v3.25"/></svg>
    <?php break;
  endswitch;
}
?>
<section class="tw-bg-[linear-gradient(180deg,#f9f4ed_0%,#ffffff_100%)] tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ What We Cover</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Everything Your Business Needs</h2>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-6 lg:tw-grid-cols-2">
      <div>
        <a href="#business-booking-form" class="tw-group tw-border tw-border-solid tw-border-white/[0.08] tw-shadow-[0_2px_4px_rgba(0,0,0,0.075)] tw-transition-[transform,box-shadow,border-color] tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-relative tw-block tw-aspect-[4/3] tw-overflow-hidden tw-rounded-2xl tw-no-underline">
          <img src="<?= $assetPath ?>assets/img/meet-and-greet.png" alt="A PowerCabs Meet and Greet host welcoming a business traveller at Dublin Airport" class="tw-transition-transform tw-duration-500 tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-block tw-h-full tw-w-full tw-object-cover" loading="lazy">
          <span class="tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.8)_0%,rgba(10,7,5,0.35)_65%,rgba(10,7,5,0)_100%)] tw-backdrop-blur-[10px] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-6 tw-pt-[4.5rem]">
            <span class="tw-mb-1 tw-block tw-text-xs tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-white/70">Featured</span>
            <span class="tw-mb-1 tw-block tw-text-2xl tw-font-bold tw-text-white">Airport Transfers</span>
            <span class="tw-block tw-text-white/60">Meet &amp; Greet arrivals for executives, clients and guests -- every time.</span>
          </span>
        </a>
      </div>

      <div>
        <div class="tw-flex tw-flex-col">
          <?php foreach ($bizServiceModules as $i => $service): ?>
            <div class="tw-flex tw-items-center tw-gap-3 <?= $i === 0 ? 'tw-pb-4' : 'tw-py-4' ?> <?= $i <
              count($bizServiceModules) - 1
              ? 'tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.08]'
              : '' ?>">
              <span class="tw-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-paper tw-text-power">
                <?php pc_biz_service_icon($service['icon']); ?>
              </span>
              <span class="tw-flex-1">
                <span class="tw-block tw-font-bold tw-text-ink"><?= $service['title'] ?></span>
                <span class="tw-block tw-text-sm tw-text-ink/60"><?= $service['desc'] ?></span>
              </span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</section>
