<?php
$bizServiceModules = [
  ['icon' => 'people', 'title' => 'Employee Travel', 'desc' => 'Everyday commutes and inter-office journeys for your whole team.'],
  ['icon' => 'person-lines', 'title' => 'Client Travel', 'desc' => 'Impress clients and guests from the moment they arrive.'],
  ['icon' => 'mic', 'title' => 'Events &amp; Conferences', 'desc' => 'Coordinated arrivals and departures for conferences and corporate events.'],
  ['icon' => 'building', 'title' => 'Hotel Guest Travel', 'desc' => 'Reliable transfers for hotel guests, booked straight to your account.'],
  ['icon' => 'briefcase', 'title' => 'Executive Travel', 'desc' => 'Discreet, punctual rides for executives and leadership teams.'],
  /* Airport Transfers was a featured PHOTO CARD beside this list, and it is a
     sixth service rather than a different kind of thing -- so it is a sixth
     card. That also makes the grid 3x2 instead of five items stranded in a
     column next to a picture.
     No 'href': this section lists what a business account covers, and every
     card states it and stops. The 'href' branch in the loop below is kept
     because it costs nothing and is the mechanism if any service ever does
     need somewhere to go. */
  [
    'icon' => 'plane',
    'title' => 'Airport Transfers',
    'desc' => 'Meet &amp; Greet arrivals for executives, clients and guests.',
  ],
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
    case 'plane': ?>
      <svg class="tw-h-[1.15rem] tw-w-[1.15rem]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
    <?php break;
  endswitch;
}
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-12 tw-max-w-[680px] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">What We Cover</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Everything Your Business Needs</h2>
      <p class="<?= $pcBody ?> tw-mb-0">
        Every kind of journey your people take, booked against the one account.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-5 sm:tw-grid-cols-2 lg:tw-grid-cols-3 lg:tw-gap-6">
      <?php foreach ($bizServiceModules as $service): ?>
        <?php
        $svcLink = $service['href'] ?? '';
        $svcTag = $svcLink !== '' ? 'a' : 'div';
        $svcClass =
          'tw-group tw-flex tw-h-full tw-flex-col tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-6 tw-no-underline tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-shadow tw-duration-300 hover:tw-shadow-[0_14px_34px_-14px_rgba(28,20,16,0.2)] motion-reduce:tw-transition-none';
        ?>
        <<?= $svcTag ?> class="<?= $svcClass ?>"<?= $svcLink !== ''
          ? ' href="' . $assetPath . htmlspecialchars($svcLink) . '"'
          : '' ?>>
          <span class="<?= $pcFeatureIcon ?> tw-mb-4">
            <?php pc_biz_service_icon($service['icon']); ?>
          </span>
          <span class="tw-mb-1.5 tw-block tw-text-[1.0625rem] tw-font-bold tw-leading-snug tw-text-ink"><?= $service['title'] ?></span>
          <span class="<?= $pcBodySm ?> tw-block"><?= $service['desc'] ?></span>
        </<?= $svcTag ?>>
      <?php endforeach; ?>
    </div>
  </div>
</section>
