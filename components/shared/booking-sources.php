<?php
$sourcesEyebrow ??= 'The PowerCabs network';
$sourcesHeading ??= 'Where PowerCabs bookings come from';
$sourcesText ??= 'Drivers can receive bookings generated across several parts of the PowerCabs network.';
$sourcesSurface ??= $pcSurfaceSoft;
$sourcesItems ??= [
  ['icon' => 'phone', 'label' => 'App bookings'],
  ['icon' => 'globe', 'label' => 'Website bookings'],
  ['icon' => 'briefcase', 'label' => 'Corporate bookings'],
  ['icon' => 'plane', 'label' => 'Airport transfers'],
  ['icon' => 'building', 'label' => 'Hotels &amp; hospitality'],
  ['icon' => 'headset', 'label' => 'Dispatch bookings'],
  ['icon' => 'calendar', 'label' => 'Pre-bookings'],
  ['icon' => 'paw', 'label' => 'Pet-friendly trips'],
];

if (!function_exists('pc_booking_source_icon')) {
  function pc_booking_source_icon(string $icon): void
  {
    // One shared sizing/stroke setup; only the path changes per icon.
    $s = 'tw-h-[1.15rem] tw-w-[1.15rem]';
    switch ($icon):
      case 'phone': ?>
        <svg class="<?= $s ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="6" y="2" width="12" height="20" rx="2.5"/><path d="M10.5 18.5h3"/></svg>
      <?php break;
      case 'globe': ?>
        <svg class="<?= $s ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M3.6 9h16.8M3.6 15h16.8M12 3c2.5 2.3 3.8 5.4 3.8 9S14.5 18.7 12 21C9.5 18.7 8.2 15.6 8.2 12S9.5 5.3 12 3z"/></svg>
      <?php break;
      case 'briefcase': ?>
        <svg class="<?= $s ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 14.15v4.25a2 2 0 01-2 2H5.75a2 2 0 01-2-2v-4.25m16.5 0a2 2 0 00-2-2H5.75a2 2 0 00-2 2m16.5 0v-1.75a2 2 0 00-2-2H5.75a2 2 0 00-2 2v1.75M9 12.75V9.5A2.25 2.25 0 0111.25 7.25h1.5A2.25 2.25 0 0115 9.5v3.25"/></svg>
      <?php break;
      case 'plane': ?>
        <svg class="<?= $s ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
      <?php break;
      case 'building': ?>
        <svg class="<?= $s ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.75 21h16.5M4.5 3h15v18h-15V3zM9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
      <?php break;
      case 'headset': ?>
        <svg class="<?= $s ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 13.5v-1.75a7.5 7.5 0 0115 0v1.75M4.5 13.5a1.75 1.75 0 00-1.75 1.75v1a1.75 1.75 0 001.75 1.75h.75a1 1 0 001-1v-3.5a1 1 0 00-1-1h-.75zm15 0a1.75 1.75 0 011.75 1.75v1a1.75 1.75 0 01-1.75 1.75h-.75a1 1 0 01-1-1v-3.5a1 1 0 011-1h.75zM18 18v.75a2.25 2.25 0 01-2.25 2.25h-2.25"/></svg>
      <?php break;
      case 'calendar': ?>
        <svg class="<?= $s ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6.75 3v2.25M17.25 3v2.25M3.75 18.75V7.5a2.25 2.25 0 012.25-2.25h12a2.25 2.25 0 012.25 2.25v11.25m-16.5 0A2.25 2.25 0 006 21h12a2.25 2.25 0 002.25-2.25m-16.5 0V11.25a2.25 2.25 0 012.25-2.25h12a2.25 2.25 0 012.25 2.25v7.5M9 16.5l1.5 1.5 3.5-3.5"/></svg>
      <?php break;
      case 'paw': ?>
        <?php /* Four toes and a pad, drawn filled -- a stroked paw at 18px
                 closes up into a blob. */ ?>
        <svg class="<?= $s ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><ellipse cx="7.4" cy="8.6" rx="2.1" ry="2.7"/><ellipse cx="12" cy="6.9" rx="2.2" ry="2.9"/><ellipse cx="16.6" cy="8.6" rx="2.1" ry="2.7"/><path d="M12 11.4c2.8 0 5.2 2.1 5.2 4.5 0 2.1-1.8 3.4-3.8 3.4-.9 0-1.3-.3-1.4-.3s-.5.3-1.4.3c-2 0-3.8-1.3-3.8-3.4 0-2.4 2.4-4.5 5.2-4.5z"/></svg>
      <?php break;
    endswitch;
  }
}
?>
<!-- ============ Where bookings come from ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">

    <div class="tw-mx-auto tw-mb-10 tw-max-w-[620px] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>"><?= $sourcesEyebrow ?></p>
      <h2 class="<?= pc_mb($pcH2Small, 'tw-mb-3') ?>"><?= $sourcesHeading ?></h2>
      <p class="<?= $pcBody ?> tw-mb-0"><?= $sourcesText ?></p>
    </div>

    <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-3 tw-p-0 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
      <?php foreach ($sourcesItems as $item): ?>
        <li class="tw-group tw-flex tw-items-center tw-gap-3 tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-px-4 tw-py-3.5 tw-shadow-[0_1px_2px_rgba(28,20,16,0.04)] tw-transition tw-duration-300 hover:tw--translate-y-0.5 hover:tw-border-power/25 hover:tw-shadow-[0_14px_30px_-14px_rgba(28,20,16,0.22)] motion-reduce:tw-transform-none motion-reduce:tw-transition-none">
          <span class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-peach tw-text-power tw-transition-colors tw-duration-300 group-hover:tw-bg-power group-hover:tw-text-white motion-reduce:tw-transition-none">
            <?php pc_booking_source_icon($item['icon']); ?>
          </span>
          <span class="tw-text-[0.9375rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= $item['label'] ?></span>
        </li>
      <?php endforeach; ?>
    </ul>

  </div>
</section>
<?php
// Reset, so a later include on the same page starts from the defaults again.
unset($sourcesEyebrow, $sourcesHeading, $sourcesText, $sourcesSurface, $sourcesItems);
