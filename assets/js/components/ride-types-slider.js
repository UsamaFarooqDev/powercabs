(function () {
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

    var slides = Array.prototype.slice.call(track.children);
    var dots = dotsWrap ? Array.prototype.slice.call(dotsWrap.querySelectorAll('[data-ride-dot]')) : [];
    var count = slides.length;
    if (count < 2) return;

    var FOCUSABLE = 'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])';
    var supportsInert = 'inert' in HTMLElement.prototype;
    var reduceMotion = !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);

    track.classList.add('is-ready');
    if (dotsWrap) dotsWrap.classList.add('is-ready');

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

    var position = 0;
    var settleTimer = null;

    function pad(n) {
      return n < 10 ? '0' + n : String(n);
    }

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

      track.style.transition = 'none';
      track.style.transform = 'translateX(' + -p * 100 + '%)';
      void track.offsetWidth;
      track.style.transition = '';
    }

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

    var autoplay = !reduceMotion;
    var timer = null;
    var userPaused = false;
    var hovering = false;
    var focusInside = false;
    var hasObserver = 'IntersectionObserver' in window;

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
