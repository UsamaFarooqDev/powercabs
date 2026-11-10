<?php
$idelSteps = [
  [
    'title' => 'Tell us what needs delivering.',
    'desc' => 'A description of the item, where it is, where it needs to go and when you need it there.',
  ],
  [
    'title' => 'Confirm your price and booking.',
    'desc' => 'We confirm the service, the price and availability before anything goes ahead.',
  ],
  [
    'title' => 'Your driver collects the item.',
    'desc' => 'The collection is arranged with the relevant person or premises.',
  ],
  [
    'title' => 'Your item reaches its destination.',
    'desc' => 'Delivered to the agreed recipient or location, with confirmation according to the service available.',
  ],
];
?>
<section class="<?= $pcSurfaceWhite ?> <?= $pcSectionLoose ?>" id="how-it-works">
  <div class="<?= $pcContainer ?>">

    <div data-motion="fade-up" class="<?= $pcSectionHeadCenter ?>">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">How it works</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-0') ?>">Four steps, start to finish.</h2>
    </div>

    <ol data-motion-stagger="fade-up" class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-x-8 tw-gap-y-10 tw-p-0 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
      <?php foreach ($idelSteps as $idelI => $idelStep): ?>
        <li class="tw-relative tw-pt-7">
          <?php /* The rule runs between the numbers, not past the last one. */ ?>
          <span class="tw-pointer-events-none tw-absolute tw-left-0 tw-top-0 tw-h-0.5 tw-w-full tw-bg-hairline" aria-hidden="true"></span>
          <span class="tw-pointer-events-none tw-absolute tw-left-0 tw-top-0 tw-h-0.5 tw-w-10 tw-bg-power" aria-hidden="true"></span>
          <p class="tw-mb-3 tw-text-[0.72rem] tw-font-bold tw-uppercase tw-tracking-[0.16em] tw-text-power">Step <?= $idelI + 1 ?></p>
          <h3 class="<?= pc_mb($pcH4, 'tw-mb-2') ?>"><?= htmlspecialchars($idelStep['title']) ?></h3>
          <p class="<?= $pcBodySm ?> tw-mb-0"><?= htmlspecialchars($idelStep['desc']) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>

  </div>
</section>
