/* PowerCabs motion engine.
 *
 * Two tiers, deliberately:
 *
 *   Tier 1  Every reveal, stagger, text and image entrance on the site. One IntersectionObserver
 *           driving CSS transitions. No library, no scroll listener, ~3KB. Runs everywhere.
 *   Tier 2  Scroll-LINKED motion only -- parallax and anything driven by scroll progress. GSAP +
 *           ScrollTrigger, fetched on demand and only when a page carries [data-motion-scroll].
 *           Twenty-four of the thirty public pages never download it.
 *
 * Loaded once from footer.php, outside <main>, so this file is never re-executed. PJAX swaps
 * <main> and calls pcInitMotion() by name; every run tears the previous one down first, which is
 * the same contract initHeroParallax and initWhyChooseReveal in main.js already follow.
 *
 * If this file fails to load, nothing is hidden: motion.css only hides [data-motion] under
 * .pc-motion-ready, and that class is set by a one-line inline script in header.php. A broken
 * request degrades to a site with no entrance animation, not a blank one. */
(function () {
  'use strict';

  /* header.php sets .pc-motion-ready before first paint and arms a 3s fuse that takes it back
     off again. Reaching this line means the engine did load, so the fuse is no longer needed --
     disarm it before it can un-hide half a page mid-reveal. */
  if (window.pcMotionFuse) {
    window.clearTimeout(window.pcMotionFuse);
    window.pcMotionFuse = null;
  }
  document.documentElement.classList.add('pc-motion-ready');

  var CFG = window.pcMotionConfig || {};
  var reduced = window.matchMedia('(prefers-reduced-motion: reduce)');
  var small = window.matchMedia('(max-width: 1023.98px)');

  /* Module-level so a re-init can tear the previous run down. A new observer per PJAX navigation
     without this would leak one observer per page view. */
  var observer = null;
  var gsapCtx = null;
  var gsapState = 'idle'; // idle | loading | ready | failed
  var gsapQueue = [];

  /* ------------------------------------------------------------------ tier 1 ------ */

  function land(el) {
    el.classList.add('pc-motion-in');

    /* Clean up after the entrance has finished -- including its stagger delay, so a late card
       is not cut off mid-travel.
       Removing data-motion is the point of this, not tidiness: while the attribute is there,
       motion.css's `transition: opacity, transform .6s` is more specific than tw-transition,
       so a card with `tw-transition tw-duration-300 hover:tw--translate-y-0.5` would hover at
       the motion curve instead of its own. The inline transition-delay from a stagger would
       delay that hover too. Dropping the attribute and the inline delay hands the element back
       to its own utilities, and its resting state is exactly what the motion ended on. */
    var delay = parseFloat(el.style.transitionDelay) || 0;
    window.setTimeout(function () {
      el.classList.add('pc-motion-done');
      el.style.transitionDelay = '';
      el.removeAttribute('data-motion');
    }, (CFG.duration || 0.6) * 1000 + delay * 1000 + 300);
  }

  function showEverything() {
    expandStaggers(false);
    var all = document.querySelectorAll('[data-motion]');
    for (var i = 0; i < all.length; i++) {
      all[i].classList.add('pc-motion-in', 'pc-motion-done');
    }
  }

  /* Children a stagger must leave alone. Each of these is an element the entrance would either
     break or never finish:
       - visually hidden: a 1px clipped box can sit on screen and still not satisfy a threshold,
         so it would stay at opacity 0 for the whole visit;
       - zero area: an empty element has an empty intersection rect, so isIntersecting is never
         true and it would never land either;
       - decorative: a glow or wash carries its own tw-opacity-*, and forcing it to opacity 1
         for the entrance then handing it back would snap its brightness. */
  function skipAsStaggerChild(el) {
    if (el.classList.contains('tw-sr-only')) return true;
    if (el.getAttribute('aria-hidden') === 'true') return true;
    if (!el.offsetWidth && !el.offsetHeight) return true;
    var pos = window.getComputedStyle(el).position;
    return pos === 'absolute' || pos === 'fixed';
  }

  /* A stagger parent hands each child its own transition-delay and marks it as a reveal. The
     children are then observed individually, so a long list still only animates the part of
     itself that is on screen -- and there are no timers and no nested loops.
     The hidden state itself comes from motion.css ([data-motion-stagger] > *), not from here:
     stamping it in JS would show the group and then hide it again on any page the browser
     painted before this ran. */
  function expandStaggers(withDelays) {
    var step = small.matches ? CFG.staggerMobile : CFG.stagger;
    var groups = document.querySelectorAll('[data-motion-stagger]');

    for (var g = 0; g < groups.length; g++) {
      var group = groups[g];
      if (group.getAttribute('data-pc-staggered') === '1') continue;
      group.setAttribute('data-pc-staggered', '1');

      var effect = group.getAttribute('data-motion-stagger') || 'fade-up';
      var own = parseFloat(group.getAttribute('data-motion-delay'));
      var gap = isNaN(own) ? step || 0.08 : own;
      var kids = group.children;

      for (var i = 0; i < kids.length; i++) {
        /* A visually-hidden child is never going to satisfy an intersection threshold -- a
           1px clipped box can sit on screen and still not count -- so it would stay at
           opacity 0 for the whole visit. Leave it out of the group entirely. */
        if (skipAsStaggerChild(kids[i])) continue;
        /* Never override an element that asked for something specific. */
        if (!kids[i].hasAttribute('data-motion')) {
          kids[i].setAttribute('data-motion', effect);
        }
        /* Cap the ramp: a 30-card grid should not make the last card wait 2.4s. */
        if (withDelays) kids[i].style.transitionDelay = Math.min(i * gap, gap * 8) + 's';
      }
    }
  }

  function initReveals() {
    if (observer) {
      observer.disconnect();
      observer = null;
    }

    if (reduced.matches || !('IntersectionObserver' in window)) {
      showEverything();
      return;
    }

    expandStaggers(true);

    observer = new IntersectionObserver(
      /* obs, not the closed-over observer: a re-init replaces that variable, and an entry
         still in flight from the old one would otherwise unobserve off the new one. */
      function (entries, obs) {
        for (var i = 0; i < entries.length; i++) {
          if (!entries[i].isIntersecting) continue;
          land(entries[i].target);
          obs.unobserve(entries[i].target);
        }
      },
      { threshold: CFG.threshold || 0.01, rootMargin: CFG.rootMargin || '0px' }
    );

    var items = document.querySelectorAll('[data-motion]:not(.pc-motion-in)');
    for (var i = 0; i < items.length; i++) {
      /* A hand-placed attribute can land on something with no box -- a conditional block that
         rendered nothing, for instance. Its intersection rect is empty, so the observer would
         never report it and it would sit hidden forever. Nothing to animate: just land it. */
      if (!items[i].offsetWidth && !items[i].offsetHeight) {
        items[i].classList.add('pc-motion-in', 'pc-motion-done');
        items[i].removeAttribute('data-motion');
        continue;
      }
      observer.observe(items[i]);
    }
  }

  /* ------------------------------------------------------------------ tier 2 ------ */

  function loadScript(src, done) {
    var s = document.createElement('script');
    s.src = src;
    s.async = false; // keep gsap before ScrollTrigger
    s.onload = function () {
      done(true);
    };
    s.onerror = function () {
      done(false);
    };
    document.head.appendChild(s);
  }

  /* Single-flight: a fast PJAX sequence must not start two downloads. */
  function withGsap(fn) {
    if (gsapState === 'ready') {
      fn();
      return;
    }
    if (gsapState === 'failed') return;

    gsapQueue.push(fn);
    if (gsapState === 'loading') return;
    gsapState = 'loading';

    loadScript(CFG.gsap, function (ok) {
      if (!ok) {
        gsapState = 'failed';
        gsapQueue.length = 0;
        return;
      }
      loadScript(CFG.scrollTrigger, function (ok2) {
        if (!ok2 || !window.gsap || !window.ScrollTrigger) {
          gsapState = 'failed';
          gsapQueue.length = 0;
          return;
        }
        window.gsap.registerPlugin(window.ScrollTrigger);
        gsapState = 'ready';
        var queued = gsapQueue.slice();
        gsapQueue.length = 0;
        for (var i = 0; i < queued.length; i++) queued[i]();
      });
    });
  }

  function buildScrollLinked(main) {
    gsapCtx = window.gsap.context(function () {
      var mm = window.gsap.matchMedia();

      /* Parallax is desktop-only by design: on a phone it costs a composited layer on the
         largest image on the page for a few pixels of travel nobody notices. */
      mm.add(CFG.desktop || '(min-width: 1024px)', function () {
        var layers = main.querySelectorAll('[data-motion-parallax]');
        for (var i = 0; i < layers.length; i++) {
          var layer = layers[i];
          /* The number is the fraction of the layer's own height it travels over the whole
             pass, split either side of centre: 0.12 runs -6% to +6%. */
          var amount = (parseFloat(layer.getAttribute('data-motion-parallax')) || 0.12) * 50;
          window.gsap.fromTo(
            layer,
            { yPercent: -amount },
            {
              yPercent: amount,
              ease: 'none',
              scrollTrigger: {
                trigger: layer.closest('[data-motion-parallax-scope]') || layer.parentElement,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
              },
            }
          );
        }
      });
    }, main);
  }

  function initScrollLinked() {
    if (gsapCtx) {
      gsapCtx.revert();
      gsapCtx = null;
    }
    if (reduced.matches) return;
    if (!document.querySelector('[data-motion-scroll]')) return; // the gate

    var main = document.querySelector('main');
    /* Nothing to drive means nothing to download. */
    if (!main || !main.querySelector('[data-motion-parallax]')) return;

    withGsap(function () {
      /* The swap may have happened again while GSAP was in flight. */
      var live = document.querySelector('main');
      if (!live || !document.querySelector('[data-motion-scroll]')) return;
      if (!live.querySelector('[data-motion-parallax]')) return;
      buildScrollLinked(live);
    });
  }

  /* ------------------------------------------------------------- lifecycle ------ */

  function init() {
    initReveals();
    initScrollLinked();
  }

  window.pcInitMotion = init;

  /* Someone turning reduced motion on mid-session should get a still page immediately. */
  if (reduced.addEventListener) {
    reduced.addEventListener('change', init);
  } else if (reduced.addListener) {
    reduced.addListener(init);
  }

  if (document.readyState !== 'loading') {
    init();
  } else {
    document.addEventListener('DOMContentLoaded', init);
  }
})();
