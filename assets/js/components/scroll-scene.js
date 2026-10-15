
(function () {
if (window.pcInitScrollScenes) {
    window.pcInitScrollScenes();
    return;
  }

  var scenes = [];
  var observer = null;
  var rafId = null;

  var EASE = 0.09;
  var OVERLAY_PARALLAX = -0.12;

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

window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initScrollScenes);
  } else {
    initScrollScenes();
  }
})();
