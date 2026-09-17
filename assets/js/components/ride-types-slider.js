/**
 * Ride page: the "A Ride for Every Need" slider.
 *
 * Progressive enhancement, not a takeover. The markup in
 * components/ride/ride-types.php renders eight slides stacked as plain blocks;
 * this file adds `.is-ready`, which is what turns the track into a flex row and
 * shows the dots and the pause button. With JS off, or before this runs, the
 * reader gets all eight ride types in a readable column instead of a broken
 * 800%-wide row.
 *
 * LOOPING. The slider wraps both ways without ever sliding backwards across all
 * eight. A copy of slide 1 is appended after slide 8, so "next" from 8 glides
 * forward onto that copy -- which looks exactly like slide 1 -- and the moment
 * the glide ends the track jumps, with its transition switched off, to the real
 * slide 1 sitting at the identical visual position. "previous" from 1 does the
 * same in reverse: jump onto the copy, glide back to 8. Without the copy, going
 * from 8 to 1 animates the track across all seven slides in between, which is
 * the rewind glitch this replaces.
 *
 * AUTOPLAY. Advances one slide every AUTOPLAY_MS and pauses whenever it would
 * get in someone's way: while a mouse is over the slider, while keyboard focus
 * is inside it, while it is scrolled out of view, and while the tab is hidden.
 * Any manual move restarts the countdown, so it never jumps straight after a
 * click. The pause button stops it outright (an auto-moving carousel needs a
 * real control for that -- WCAG 2.2.2 -- hover alone does nothing on a phone),
 * and prefers-reduced-motion switches autoplay off entirely and hides the
 * button. The polite live region is silenced while it plays, or a screen
 * reader would announce a new slide every few seconds.
 *
 * PJAX NOTE -- this is a page-specific <script src> inside <main>, so pjax.js
 * re-executes the whole file on every visit to /ride. Every event listener
 * below is attached to an element INSIDE the slider, and those are destroyed
 * when PJAX replaces <main>'s innerHTML, so listeners die with their nodes.
 * The autoplay timer and the IntersectionObserver are the two things that
 * would NOT die with the DOM: both check root.isConnected every time they run
 * and tear themselves down once the slider has been swapped out.
 *
 * Keep it that way. A listener on `window` or `document` added here WOULD stack
 * up one per navigation -- if you ever need one, follow the teardown pattern
 * initHeroParallax() uses in main.js.
 */
(function () {
  /* One slide every 3.5s: the track's own 700ms glide plus roughly 2.8s at
     rest on each slide. */
  var AUTOPLAY_MS = 3500;

  function initRideTypesSlider() {
    var root = document.querySelector('[data-ride-slider]');
    if (!root) return;

    var track = root.querySelector('[data-ride-track]');
    var dotsWrap = root.querySelector('[data-ride-dots]');
    var prev = root.querySelector('[data-ride-prev]');
    var next = root.querySelector('[data-ride-next]');
    var toggle = root.querySelector('[data-ride-toggle]');
    var current = root.querySelector('[data-ride-current]');
    var status = root.querySelector('[data-ride-status]');
    if (!track) return;

    // Read before the loop copy is appended, so these are the eight real ones.
    var slides = Array.prototype.slice.call(track.children);
    var dots = dotsWrap ? Array.prototype.slice.call(dotsWrap.querySelectorAll('[data-ride-dot]')) : [];
    var count = slides.length;
    if (count < 2) return;

    /* Anything inside a slide that a keyboard can land on. The original
       markup had none -- the slides were image + text only -- so hiding the
       off-screen ones from assistive tech was enough. The redesign put a
       "Book this ride" link in every slide, which made that insufficient:
       seven links the reader cannot see were still in the tab order, so
       tabbing past the slider sent focus off-screen seven times. Marking
       them aria-hidden AND leaving them focusable is also an outright ARIA
       violation -- aria-hidden must never contain focusable content. */
    var FOCUSABLE = 'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])';
    var supportsInert = 'inert' in HTMLElement.prototype;
    var reduceMotion = !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);

    // The class the CSS is waiting on. Until it lands the track is a plain
    // block, so this single line is the whole progressive-enhancement switch.
    track.classList.add('is-ready');
    if (dotsWrap) dotsWrap.classList.add('is-ready');

    /* The loop copy of slide 1 (see LOOPING above). It is only ever on screen
       for the length of one glide, so it is permanently hidden from assistive
       tech and the tab order -- the real slide 1 is the one that counts. Its
       images are forced eager: lazy images in a clipped overflow row do not
       load until they slide into view, which would flash an empty frame
       mid-glide. They are the same files slide 1 already loaded, so this
       costs no extra download. */
    var clone = slides[0].cloneNode(true);
    ['role', 'aria-roledescription', 'aria-label'].forEach(function (attr) {
      clone.removeAttribute(attr);
    });
    clone.setAttribute('aria-hidden', 'true');
    clone.setAttribute('data-ride-clone', '');
    clone.querySelectorAll('img').forEach(function (img) {
      img.setAttribute('loading', 'eager');
    });
    if (supportsInert) {
      clone.inert = true;
    } else {
      clone.querySelectorAll(FOCUSABLE).forEach(function (el) {
        el.setAttribute('tabindex', '-1');
      });
    }
    track.appendChild(clone);

    // 0..count-1 are the real slides; `count` is the loop copy.
    var position = 0;
    var settleTimer = null;

    function pad(n) {
      return n < 10 ? '0' + n : String(n);
    }

    /* Whether the track is actually animating. motion-reduce sets
       transition-property to none but leaves the duration in place, so both
       have to be checked -- with no transition there is no glide to wait for,
       and no transitionend will ever come. */
    function glideMs() {
      var cs = window.getComputedStyle(track);
      if (cs.transitionProperty === 'none') return 0;
      return (parseFloat(cs.transitionDuration) || 0) * 1000;
    }

    function place(p, animate) {
      position = p;
      if (animate) {
        track.style.transform = 'translateX(' + -p * 100 + '%)';
        return;
      }
      // Jump with the transition off, force a reflow so the browser commits
      // the new position, then hand the transition back for the next glide.
      track.style.transition = 'none';
      track.style.transform = 'translateX(' + -p * 100 + '%)';
      void track.offsetWidth;
      track.style.transition = '';
    }

    /* Sitting on the loop copy? Swap it for the real slide 1 without motion.
       Runs when the glide ends, and at the start of every move so a click
       made mid-glide never tries to go past the copy. */
    function settle() {
      window.clearTimeout(settleTimer);
      settleTimer = null;
      if (position === count) place(0, false);
    }

    track.addEventListener('transitionend', function (event) {
      if (event.target === track && event.propertyName === 'transform') settle();
    });

    function render() {
      var index = position % count;

      /* Off-screen slides are removed from BOTH the accessibility tree and
         the tab order. Without the first, a screen reader reads all eight
         descriptions as one run of text -- exactly the content the visual
         design just spent effort showing one at a time. Without the second,
         Tab walks into links that are scrolled out of sight.

         `inert` does both in one attribute and is what every current browser
         wants. The tabindex pass is the fallback for anything that predates
         it: the links carry no tabindex of their own, so removing the
         attribute restores their natural position in the order. */
      slides.forEach(function (slide, i) {
        var active = i === index;

        if (active) {
          slide.removeAttribute('aria-hidden');
        } else {
          slide.setAttribute('aria-hidden', 'true');
        }

        if (supportsInert) {
          slide.inert = !active;
          return;
        }

        slide.querySelectorAll(FOCUSABLE).forEach(function (el) {
          if (active) {
            el.removeAttribute('tabindex');
          } else {
            el.setAttribute('tabindex', '-1');
          }
        });
      });

      dots.forEach(function (dot, i) {
        dot.setAttribute('aria-current', i === index ? 'true' : 'false');
      });

      if (current) current.textContent = pad(index + 1);

      if (status) {
        var heading = slides[index].querySelector('h3');
        status.textContent = 'Ride type ' + (index + 1) + ' of ' + count + (heading ? ': ' + heading.textContent.trim() : '');
      }
    }

    function step(direction) {
      settle();
      var ms = glideMs();

      if (direction > 0 && position === count - 1) {
        if (ms) {
          place(count, true);
          // transitionend is the normal trigger; this is the backstop for a
          // glide that gets interrupted and never reports finishing.
          settleTimer = window.setTimeout(settle, ms + 150);
        } else {
          place(0, false);
        }
      } else if (direction < 0 && position === 0) {
        if (ms) {
          place(count, false);
          place(count - 1, true);
        } else {
          place(count - 1, false);
        }
      } else {
        place(position + direction, !!ms);
      }

      render();
    }

    function goTo(i) {
      settle();
      if (i === position) return;
      place(i, !!glideMs());
      render();
    }

    /* ---- Autoplay -------------------------------------------------------- */

    var autoplay = !reduceMotion;
    var timer = null;
    var userPaused = false;
    var hovering = false;
    var focusInside = false;
    var hasObserver = 'IntersectionObserver' in window;
    // With an observer, assume off-screen until it reports, so nothing moves
    // before anyone can see it. Without one, there is no way to know.
    var inView = !hasObserver;
    var observer = null;

    function playing() {
      return autoplay && !userPaused && !hovering && !focusInside && inView;
    }

    function teardown() {
      window.clearTimeout(timer);
      window.clearTimeout(settleTimer);
      timer = null;
      if (observer) observer.disconnect();
    }

    // (Re)starts the countdown from zero, or stops it if anything is pausing.
    function schedule() {
      window.clearTimeout(timer);
      timer = null;
      if (status) status.setAttribute('aria-live', playing() ? 'off' : 'polite');
      if (!root.isConnected) {
        teardown();
        return;
      }
      if (playing()) timer = window.setTimeout(tick, AUTOPLAY_MS);
    }

    function tick() {
      timer = null;
      if (!root.isConnected) {
        teardown();
        return;
      }
      if (!playing()) return;
      // A hidden tab keeps its place and simply tries again later.
      if (!document.hidden) step(1);
      schedule();
    }

    function syncToggle() {
      if (!toggle) return;
      toggle.classList.toggle('is-paused', userPaused);
      toggle.setAttribute(
        'aria-label',
        userPaused ? 'Play the ride types slideshow' : 'Pause the ride types slideshow'
      );
    }

    if (toggle && autoplay) {
      toggle.classList.add('is-ready');
      syncToggle();
      toggle.addEventListener('click', function () {
        userPaused = !userPaused;
        syncToggle();
        schedule();
      });
    }

    /* ---- Manual controls ------------------------------------------------- */

    if (prev) {
      prev.disabled = false;
      prev.addEventListener('click', function () {
        step(-1);
        schedule();
      });
    }
    if (next) {
      next.disabled = false;
      next.addEventListener('click', function () {
        step(1);
        schedule();
      });
    }
    dots.forEach(function (dot) {
      dot.addEventListener('click', function () {
        goTo(parseInt(dot.getAttribute('data-ride-dot'), 10) || 0);
        schedule();
      });
    });

    /* Arrow keys, scoped to the slider itself rather than the document -- see
       the PJAX note at the top. tabindex on the root makes it focusable so the
       keys have somewhere to land. */
    root.setAttribute('tabindex', '-1');
    root.addEventListener('keydown', function (event) {
      if (event.key === 'ArrowLeft') {
        event.preventDefault();
        step(-1);
        schedule();
      } else if (event.key === 'ArrowRight') {
        event.preventDefault();
        step(1);
        schedule();
      }
    });

    /* Mouse hover pauses; touch has no hover, and an emulated touch
       "mouseenter" with no matching leave would otherwise stall it for good. */
    root.addEventListener('pointerenter', function (event) {
      if (event.pointerType !== 'mouse') return;
      hovering = true;
      schedule();
    });
    root.addEventListener('pointerleave', function (event) {
      if (event.pointerType !== 'mouse') return;
      hovering = false;
      schedule();
    });

    /* Keyboard focus inside pauses -- someone tabbing to "Book this ride"
       must not have it slide away under them. Only keyboard focus: a mouse
       click on next/prev also focuses the button, and treating that as
       "stop" would make autoplay quietly die after one click. Focus on the
       pause button itself never pauses, or pressing Play could not work. */
    root.addEventListener('focusin', function (event) {
      var keyboard = true;
      try {
        keyboard = event.target.matches(':focus-visible');
      } catch (e) {}
      focusInside = keyboard && event.target !== toggle;
      schedule();
    });
    root.addEventListener('focusout', function (event) {
      if (event.relatedTarget && root.contains(event.relatedTarget)) return;
      focusInside = false;
      schedule();
    });

    if (hasObserver) {
      observer = new IntersectionObserver(
        function (entries) {
          if (!root.isConnected) {
            teardown();
            return;
          }
          inView = entries[entries.length - 1].isIntersecting;
          schedule();
        },
        { threshold: 0.35 }
      );
      observer.observe(root);
    }

    /* Touch swipe. Pointer events cover touch and mouse-drag in one path.
       The 45px threshold is deliberately above a thumb's natural wobble, and
       the horizontal-vs-vertical test stops a page scroll being read as a
       swipe -- without it the slider fires while someone is simply scrolling
       past it on a phone. */
    var startX = 0;
    var startY = 0;
    var tracking = false;

    track.addEventListener(
      'pointerdown',
      function (event) {
        if (event.pointerType === 'mouse' && event.button !== 0) return;
        tracking = true;
        startX = event.clientX;
        startY = event.clientY;
      },
      { passive: true }
    );

    track.addEventListener(
      'pointerup',
      function (event) {
        if (!tracking) return;
        tracking = false;
        var dx = event.clientX - startX;
        var dy = event.clientY - startY;
        if (Math.abs(dx) < 45 || Math.abs(dx) < Math.abs(dy)) return;
        step(dx < 0 ? 1 : -1);
        schedule();
      },
      { passive: true }
    );

    track.addEventListener('pointercancel', function () { tracking = false; }, { passive: true });

    place(0, false);
    render();
    schedule();
  }

  if (document.readyState !== 'loading') {
    initRideTypesSlider();
  } else {
    document.addEventListener('DOMContentLoaded', initRideTypesSlider);
  }
})();
