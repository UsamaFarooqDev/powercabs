<?php
$dockActive = $dockActive ?? 'training';

$dockItems = [
  ['id' => 'home', 'label' => 'Home', 'href' => ($assetPath ?? '') . '/', 'icon' => 'home'],
  ['id' => 'training', 'label' => 'Training', 'href' => '#pcTrainingTop', 'icon' => 'cap'],
  ['id' => 'progress', 'label' => 'Progress', 'href' => '#pcTrainingProgress', 'icon' => 'chart'],
  ['id' => 'info', 'label' => 'Help', 'href' => ($assetPath ?? '') . '/contact-us', 'icon' => 'info'],
];

function pc_dock_icon(string $k): void
{
  $c = 'tw-h-[1.3rem] tw-w-[1.3rem]';
  switch ($k):
    case 'home': ?>
      <svg class="<?= $c ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10.5L12 3l9 7.5M5.5 9.5V20a1 1 0 001 1h11a1 1 0 001-1V9.5"/></svg>
    <?php break;
    case 'cap': ?>
      <svg class="<?= $c ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 4L2.5 9 12 14l9.5-5L12 4z"/><path d="M6.5 11.3V16c0 1.4 2.5 2.6 5.5 2.6s5.5-1.2 5.5-2.6v-4.7M21.5 9v5"/></svg>
    <?php break;
    case 'chart': ?>
      <svg class="<?= $c ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/></svg>
    <?php break;
    case 'info': ?>
      <svg class="<?= $c ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 11.5v5M12 7.75h.01"/></svg>
    <?php break;
    case 'phone': ?>
      <svg class="<?= $c ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 006.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.2.4 2.4.6 3.7.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1A17 17 0 013 4c0-.6.4-1 1-1h3.5c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.7.1.4 0 .8-.2 1l-2.3 2.1z"/></svg>
    <?php break;
  endswitch;
}
?>
<div class="tw-pointer-events-none tw-fixed tw-inset-x-0 tw-bottom-0 tw-z-[1040] tw-px-3 tw-pb-[env(safe-area-inset-bottom)] lg:tw-hidden">
  <?php  ?>
  <div class="tw-pointer-events-auto tw-mx-auto tw-mb-3 tw-flex tw-max-w-[22rem] tw-items-center tw-justify-around tw-gap-1 tw-rounded-full tw-border tw-border-solid tw-border-white/60 tw-bg-white/85 tw-px-2 tw-py-1.5 tw-shadow-[0_10px_34px_-8px_rgba(28,20,16,0.35)] tw-backdrop-blur-xl">

    <nav class="tw-flex tw-flex-1 tw-items-center tw-justify-around" aria-label="Training">
      <?php foreach ($dockItems as $item): ?>
        <?php $isActive = $item['id'] === $dockActive; ?>
        <?php  ?>
        <a href="<?= htmlspecialchars($item['href']) ?>" <?= $isActive ? 'aria-current="page"' : '' ?>
          class="tw-relative tw-inline-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-2xl tw-no-underline tw-transition-all tw-duration-200 active:tw-scale-95 motion-reduce:tw-transition-none <?= $isActive
            ? 'tw--mt-2 tw-text-power'
            : 'tw-text-ink/45 hover:tw-text-ink/70' ?>">
          <?php pc_dock_icon($item['icon']); ?>
          <?php if ($isActive): ?>
            <span class="tw-absolute tw--bottom-0.5 tw-left-1/2 tw-h-1 tw-w-1 tw--translate-x-1/2 tw-rounded-full tw-bg-power" aria-hidden="true"></span>
          <?php endif; ?>
          <span class="tw-sr-only"><?= htmlspecialchars($item['label']) ?><?= $isActive ? ' (current)' : '' ?></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <?php  ?>
    <a href="tel:+353899728089" data-no-pjax
      class="tw-inline-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-2xl tw-text-ink/45 tw-no-underline tw-transition-all tw-duration-200 hover:tw-text-ink/70 active:tw-scale-95 motion-reduce:tw-transition-none"
      aria-label="Call PowerCabs on +353 89 972 8089">
      <?php pc_dock_icon('phone'); ?>
    </a>

  </div>
</div>
