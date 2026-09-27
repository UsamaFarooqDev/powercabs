<?php
/**
 * A full-bleed scroll scene: one subject travelling across a gradient
 * backdrop, with a single message underneath it.
 *
 * This is the Meet & Greet flight banner generalised. It is the page pattern
 * the client singled out, and what makes it work is restraint -- a scene
 * carries exactly ONE sentence. It is not a section for a feature list, and
 * adding a second message to one is the quickest way to lose the effect.
 *
 *   $sceneId          required. Unique per page.
 *   $sceneGradient    required. The backdrop, as a CSS gradient value.
 *   $sceneSubject     required. HTML for the travelling element -- an <img>
 *                     with a transparent background, or inline SVG.
 *   $sceneSubjectSize optional. Width utility for the subject.
 *                     Default: clamp(260px,42vw,560px).
 *   $sceneOverlay     optional. HTML painted ABOVE the subject, drifting the
 *                     other way for depth (Meet & Greet's cloud layer).
 *   $sceneGround      optional. HTML pinned to the bottom, behind the copy --
 *                     a road, a horizon, a route line. Does not move.
 *   $sceneTitle       required.
 *   $sceneText        optional. One line.
 *   $sceneTone        optional. 'light' (default, dark text) or 'dark'.
 *   $sceneFlip        optional. true travels right -> left.
 *   $sceneSubjectPos  optional. Where the subject sits vertically, as classes.
 *                     Default 'tw-top-1/2' (centred, paired with a -50%
 *                     anchor). Use a bottom offset to stand the subject ON a
 *                     ground layer -- 'tw-bottom-[92px]' with $sceneAnchor '0'.
 *   $sceneAnchor      optional. The subject's translateY, default '-50%'. The
 *                     JS rewrites the whole transform each frame, so the Y
 *                     part has to travel with it rather than live in a class.
 *   $sceneCopyPos     optional. 'bottom' (default) or 'top'.
 *                     Put the copy at the opposite end of the scene from the
 *                     subject's travel line. The subject crosses the FULL
 *                     width, so anything sharing its vertical band will be
 *                     driven through -- the /drive car passed behind its own
 *                     headline at mid-scroll until the copy moved to the top.
 *   $sceneCopyPad     optional. Padding on the copy's own edge. Raise it to
 *                     lift the message clear of a ground layer -- the first
 *                     draft of the /drive scene set dark text directly on the
 *                     dark road strip, which was unreadable.
 *   $sceneHeight      optional. Default clamp(460px,58vw,680px).
 *
 * Height is a clamp, NOT a vh unit. The flight banner uses h-[90vh], and at a
 * 360x820 phone that is 738px of decoration before any content -- and it makes
 * the section's height depend on the browser chrome being shown or hidden.
 *
 * The motion is in assets/js/components/scroll-scene.js, which the caller
 * includes once. Under prefers-reduced-motion nothing moves and the scene
 * still reads as a composed picture with a headline.
 */
$sceneSubjectSize = $sceneSubjectSize ?? 'tw-w-[clamp(260px,42vw,560px)]';
$sceneTone = $sceneTone ?? 'light';
$sceneHeight = $sceneHeight ?? 'tw-h-[clamp(460px,58vw,680px)]';
$sceneFlip = !empty($sceneFlip);
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
  data-pc-scroll-scene<?= $sceneFlip ? ' data-pc-scene-flip="true"' : '' ?> data-pc-scene-anchor="<?= htmlspecialchars($sceneAnchor) ?>">

  <?php /* The subject sits at left:0 and is moved by translate3d from JS, so
           its start position is a transform rather than a layout property --
           nothing here triggers layout on scroll. will-change promotes it to
           its own layer so the whole band is not repainted each frame. */ ?>
  <div class="tw-pointer-events-none tw-absolute tw-left-0 <?= $sceneSubjectPos ?> tw-z-[1] <?= $sceneSubjectSize ?> tw-will-change-transform"
    style="transform:translate3d(<?= $sceneFlip ? '100%' : '-15%' ?>, <?= htmlspecialchars($sceneAnchor) ?>, 0)"
    data-pc-scene-subject>
    <?= $sceneSubject ?>
  </div>

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
/* Page globals -- a second scene further down the same page must not inherit
   this one's subject or copy. */
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
  $sceneAnchor,
  $sceneSubjectPos,
  $sceneCopyPos,
  $sceneCopyPad,
  $sceneHeight
);
