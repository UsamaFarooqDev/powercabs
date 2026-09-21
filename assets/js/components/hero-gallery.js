/**
 * Homepage hero: the slow crossfade between the three background frames.
 *
 * Deliberately not a carousel. There are no arrows, no dots and nothing to
 * click, because these are backdrop, not content -- they sit inside the
 * aria-hidden .pc-hero-canvas, behind the scrim, with the headline on top. It
 * follows that nothing is lost by missing one, and that no pause control is
 * owed: WCAG 2.2.2 governs moving content that carries information, and a
 * 1.9s crossfade every 5s carries none.
 *
 * The markup in components/home/hero.php already marks frame 1 `is-active`, so
 * with JS off, or before this file runs, the hero shows one correctly composed
 * photograph rather than an empty black box. All this adds is the rotation.
 *
 * REDUCED MOTION. A slow crossfade plus a creeping scale is precisely what
 * prefers-reduced-motion exists to suppress, so the rotation never starts and
 * frame 1 stays put. Cutting between frames instantly every five seconds would
 * be far more distracting than the fade it replaced, so that is not the
 * fallback. The CSS agrees: both the transition and the scale hang off
 * motion-safe: variants, so nothing animates even if a frame were swapped.
 *
 * PJAX NOTE -- this is a page-specific <script src> inside <main>, so pjax.js
 * re-executes the whole file on every visit to the homepage. The interval is
 * the one thing that would NOT die with the swapped-out DOM, so it checks
 * root.isConnected on each tick and clears itself once the hero it belongs to
 * has been detached. Without that, every homepage visit would leave another
 * timer running against orphaned nodes.
 *
 * Note there is no `visibilitychange` listener: it would have to go on
 * `document`, which survives the swap, so one would stack up per navigation.
 * Reading document.hidden at tick time gets the same result and leaves nothing
 * behind. Follow that rule for anything added here.
 */
(function () {
  /* Five seconds on each frame. The crossfade itself runs 1900ms (see the
     [transition:...] utility on .pc-hero-shot in hero.php), so roughly three
     of those five seconds are a still image. */
  var ROTATE_MS = 5000;

  function initHeroGallery() {
    var root = document.querySelector('.pc-hero-canvas');
    if (!root) return;

    var shots = root.querySelectorAll('[data-pc-hero-shot]');
    if (shots.length < 2) return;

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    var index = 0;
    var timer = window.setInterval(function () {
      if (!root.isConnected) {
        window.clearInterval(timer);
        return;
      }
      // Nothing to see on a hidden tab, and advancing there would only mean
      // coming back to a frame caught mid-fade.
      if (document.hidden) return;

      shots[index].classList.remove('is-active');
      index = (index + 1) % shots.length;
      shots[index].classList.add('is-active');
    }, ROTATE_MS);
  }

  initHeroGallery();
})();
