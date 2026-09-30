/**
 * Scroll scenes: a subject that travels across a full-bleed backdrop as the
 * section passes the viewport, with one headline pinned to the bottom.
 *
 * Generalised from the Meet & Greet flight banner, which was ~90 lines of
 * inline <script> on that one page. Two reasons it moved here:
 *
 *  1. It leaked. The inline version attached window scroll and resize
 *     listeners with no teardown, and PJAX re-executes scripts inside <main>
 *     on every navigation -- so visiting /meet-greet three times left three
 *     scroll handlers running against two detached sections. This module binds
 *     the window listeners exactly ONCE and rebuilds only its scene list.
 *  2. Two more pages needed the same behaviour, and a third copy of a
 *     rAF/IntersectionObserver loop is a third place for it to drift.
 *
 * Markup contract (see components/shared/scroll-scene.php):
 *   [data-pc-scroll-scene]          the section
 *     [data-pc-scene-subject]         travels left -> right
 *     [data-pc-scene-overlay]         optional, drifts the opposite way
 *   data-pc-scene-flip="true"       travel right -> left instead
 *
 * prefers-reduced-motion: the subject is left at its start position and no
 * loop ever starts. The scene still reads -- it is a composed picture with a
 * headline, and the movement is an enhancement (brief §25/§55).
 */
(function () {
  // PJAX re-executes every <script src> inside <main>, and each execution gets
  // a FRESH closure -- so a `var bound = false` guard in here resets on every
  // navigation and the listeners stack anyway. Measured: 1 -> 2 -> 3 -> 4
  // scroll listeners over three PJAX visits to /drive.
  //
  // The guard has to outlive the script, so it lives on window. A re-execution
  // finds the module already installed, re-scans for scenes in the new <main>,
  // and returns without redefining or rebinding anything.
  if (window.pcInitScrollScenes) {
    window.pcInitScrollScenes();
    return;
  }

  var scenes = [];
  var observer = null;
  var rafId = null;

  var EASE = 0.09;
  var OVERLAY_PARALLAX = -0.12;

  // The travel curve, as a fraction of section width against scroll progress.
  // Deliberately not linear: the subject enters quickly, cruises through the
  // middle of the section where the reader is actually looking at it, then
  // leaves. These are the values the flight banner was tuned to.
  var KEYFRAMES = [
    [0, -15],
    [0.25, 10],
    [0.5, 40],
    [0.75, 70],
    [1, 115],
  ];

  function curve(progress) {
    for (var i = 0; i < KEYFRAMES.length - 1; i++) {
      var a = KEYFRAMES[i];
      var b = KEYFRAMES[i + 1];
      if (progress >= a[0] && progress <= b[0]) {
        var t = (progress - a[0]) / (b[0] - a[0]);
        return a[1] + (b[1] - a[1]) * t;
      }
    }
    return KEYFRAMES[KEYFRAMES.length - 1][1];
  }

  function computeTarget(scene) {
    var rect = scene.el.getBoundingClientRect();
    var viewportH = window.innerHeight || document.documentElement.clientHeight;
    var progress = (viewportH - rect.top) / (rect.height + viewportH);
    progress = Math.max(0, Math.min(1, progress));

    var percent = curve(progress);
    if (scene.flip) percent = 100 - percent;
    scene.targetX = rect.width * (percent / 100);

    if (!scene.primed) {
      scene.currentX = scene.targetX;
      scene.currentOverlayX = scene.targetX * OVERLAY_PARALLAX;
      scene.primed = true;
    }
  }

  function tick() {
    rafId = null;
    var running = false;

    for (var i = 0; i < scenes.length; i++) {
      var scene = scenes[i];
      // A scene swapped out by PJAX keeps its object until the next init;
      // isConnected is what stops the loop animating a detached node.
      if (!scene.visible || !scene.el.isConnected) continue;
      running = true;

      scene.currentX += (scene.targetX - scene.currentX) * EASE;
      scene.subject.style.transform = 'translate3d(' + scene.currentX + 'px, ' + scene.anchorY + ', 0)';

      if (scene.overlay) {
        var targetOverlayX = scene.targetX * OVERLAY_PARALLAX;
        scene.currentOverlayX += (targetOverlayX - scene.currentOverlayX) * EASE;
        scene.overlay.style.transform = 'translate3d(' + scene.currentOverlayX + 'px, 0, 0)';
      }
    }

    if (running) rafId = requestAnimationFrame(tick);
  }

  function onScroll() {
    for (var i = 0; i < scenes.length; i++) {
      if (scenes[i].visible) computeTarget(scenes[i]);
    }
    if (rafId === null && scenes.some(function (s) { return s.visible; })) {
      rafId = requestAnimationFrame(tick);
    }
  }

  function initScrollScenes() {
    // Tear down the previous run before rebuilding -- PJAX calls this again
    // for every navigation.
    if (observer) {
      observer.disconnect();
      observer = null;
    }
    if (rafId !== null) {
      cancelAnimationFrame(rafId);
      rafId = null;
    }
    scenes = [];

    var nodes = document.querySelectorAll('[data-pc-scroll-scene]');
    if (!nodes.length) return;

    var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    for (var i = 0; i < nodes.length; i++) {
      var el = nodes[i];
      var subject = el.querySelector('[data-pc-scene-subject]');
      if (!subject) continue;
      scenes.push({
        el: el,
        subject: subject,
        overlay: el.querySelector('[data-pc-scene-overlay]'),
        flip: el.getAttribute('data-pc-scene-flip') === 'true',
        // The subject is vertically centred by a -50% translate in its own
        // class; the transform we write each frame replaces that whole
        // property, so the Y part has to be carried along with it.
        anchorY: el.getAttribute('data-pc-scene-anchor') || '-50%',
        targetX: 0,
        currentX: 0,
        currentOverlayX: 0,
        primed: false,
        visible: false,
      });
    }

    if (!scenes.length || reduced) return;

    observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          for (var i = 0; i < scenes.length; i++) {
            if (scenes[i].el !== entry.target) continue;
            scenes[i].visible = entry.isIntersecting;
            if (entry.isIntersecting) computeTarget(scenes[i]);
          }
        });
        if (rafId === null && scenes.some(function (s) { return s.visible; })) {
          rafId = requestAnimationFrame(tick);
        }
      },
      { threshold: 0 }
    );

    for (var j = 0; j < scenes.length; j++) observer.observe(scenes[j].el);
  }

  window.pcInitScrollScenes = initScrollScenes;

  // Bound once for the lifetime of the document. This sits OUTSIDE
  // initScrollScenes deliberately: that function runs again on every PJAX
  // navigation, and the early return above is what guarantees this block is
  // only ever reached on the script's first execution.
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollScenes);
  } else {
    initScrollScenes();
  }
})();
