<?php
$idelTiming = [
  [
    'label' => 'ASAP',
    'title' => 'Request a driver now',
    'desc' =>
      'For urgent items that need collecting straight away. Availability and collection times are confirmed when you book.',
    'icon' => '<path d="M3.75 13.5l10.5-11.25-3 8.25h6.75L7.5 21.75l3-8.25H3.75z"/>',
  ],
  [
    'label' => 'Today',
    'title' => 'Within a few hours',
    'desc' =>
      'Choose a collection window that suits you today, subject to availability.',
    'icon' => '<path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/>',
  ],
  [
    'label' => 'Later',
    'title' => 'Pre-book for a date and time',
    'desc' =>
      'Arrange the collection for a future date and time that works around you.',
    'icon' => '<path d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0V11.25A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5"/>',
  ],
];
?>
<section class="<?= $pcSurfaceWhite ?> <?= $pcSectionLoose ?>" id="delivery-timing">
  <div class="<?= $pcContainer ?>">

    <div data-motion="fade-up" class="<?= $pcSectionHeadCenter ?>">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Timing</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-0') ?>">Choose when you need your delivery.</h2>
    </div>

    <ol data-motion-stagger="fade-up" class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-6 tw-p-0 md:tw-grid-cols-3">
      <?php foreach ($idelTiming as $idelStep): ?>
        <li class="tw-relative tw-flex tw-flex-col tw-overflow-hidden tw-rounded-[1.5rem] tw-border tw-border-solid tw-border-hairline tw-bg-paper-soft tw-p-6 sm:tw-p-7">
          <span class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-top-0 tw-h-1 tw-bg-gradient-to-r tw-from-power tw-to-power/0" aria-hidden="true"></span>
          <div class="tw-mb-4 tw-flex tw-items-center tw-gap-3">
            <span class="<?= $pcIconChip ?> tw-shrink-0" aria-hidden="true">
              <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?= $idelStep['icon'] ?></svg>
            </span>
            <span class="tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.16em] tw-text-power"><?= htmlspecialchars($idelStep['label']) ?></span>
          </div>
          <h3 class="<?= pc_mb($pcH4, 'tw-mb-2') ?>"><?= htmlspecialchars($idelStep['title']) ?></h3>
          <p class="<?= $pcBodySm ?> tw-mb-0"><?= htmlspecialchars($idelStep['desc']) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>

  </div>
</section>
