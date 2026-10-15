<?php
$sceneSubjectSize = $sceneSubjectSize ?? 'tw-w-[clamp(260px,42vw,560px)]';
$sceneTone = $sceneTone ?? 'light';
$sceneHeight = $sceneHeight ?? 'tw-h-[clamp(460px,58vw,680px)]';
$sceneFlip = !empty($sceneFlip);

$sceneStatic = !empty($sceneStatic);
$sceneAnchor = $sceneAnchor ?? '-50%';
$sceneSubjectPos = $sceneSubjectPos ?? 'tw-top-1/2';
$sceneCopyPos = $sceneCopyPos ?? 'bottom';
$sceneCopyTop = $sceneCopyPos === 'top';
$sceneCopyPad = $sceneCopyPad ?? ($sceneCopyTop
  ? 'tw-pt-[clamp(2.25rem,5vw,3.5rem)]'
  : 'tw-pb-[clamp(1.75rem,4vw,3rem)]');
$sceneDark = $sceneTone === 'dark';
?>
<!-- ============ Scroll Scene: <?= htmlspecialchars($sceneId) ?> ============ -->
<section class="tw-relative tw-overflow-hidden <?= $sceneHeight ?>" id="<?= htmlspecialchars($sceneId) ?>"
  style="background:<?= htmlspecialchars($sceneGradient) ?>"
  <?= $sceneStatic
    ? ''
    : 'data-pc-scroll-scene' .
      ($sceneFlip ? ' data-pc-scene-flip="true"' : '') .
      ' data-pc-scene-anchor="' . htmlspecialchars($sceneAnchor) . '"' ?>>

  <?php  ?>
  <?php if (!empty($sceneSubject)): ?>
    <div class="tw-pointer-events-none tw-absolute <?= $sceneStatic ? 'tw-left-1/2' : 'tw-left-0 tw-will-change-transform' ?> <?= $sceneSubjectPos ?> tw-z-[1] <?= $sceneSubjectSize ?>"
      style="transform:translate3d(<?= $sceneStatic ? '-50%' : ($sceneFlip ? '100%' : '-15%') ?>, <?= htmlspecialchars($sceneAnchor) ?>, 0)"
      data-pc-scene-subject>
      <?= $sceneSubject ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($sceneOverlay)): ?>
    <div class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-[2] tw-will-change-transform" data-pc-scene-overlay>
      <?= $sceneOverlay ?>
    </div>
  <?php endif; ?>

  <?php if (!empty($sceneGround)): ?>
    <div class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-bottom-0 tw-z-[3]" aria-hidden="true">
      <?= $sceneGround ?>
    </div>
  <?php endif; ?>

  <div class="tw-pointer-events-none tw-absolute tw-inset-x-0 <?= $sceneCopyTop ? 'tw-top-0' : 'tw-bottom-0' ?> tw-z-[4] <?= $sceneCopyPad ?> tw-text-center">
    <div class="<?= $pcContainer ?>">
      <h2 class="<?= $sceneDark ? pc_mb($pcH2OnDark, 'tw-mb-2') : pc_mb($pcH2, 'tw-mb-2') ?>"><?= htmlspecialchars($sceneTitle) ?></h2>
      <?php if (!empty($sceneText)): ?>
        <p class="tw-mx-auto tw-mb-0 tw-max-w-[52ch] tw-text-[1.0625rem] tw-leading-[1.6] <?= $sceneDark
          ? 'tw-text-white/[0.78]'
          : 'tw-text-muted' ?>"><?= htmlspecialchars($sceneText) ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php
unset(
  $sceneId,
  $sceneGradient,
  $sceneSubject,
  $sceneSubjectSize,
  $sceneOverlay,
  $sceneGround,
  $sceneTitle,
  $sceneText,
  $sceneTone,
  $sceneFlip,
  $sceneStatic,
  $sceneAnchor,
  $sceneSubjectPos,
  $sceneCopyPos,
  $sceneCopyPad,
  $sceneHeight
);
