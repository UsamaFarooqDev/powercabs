/**
 * The Corporate Fleet Portal slider on /corporate-services.
 *
 * Five screenshots, one visible at a time, driven by three controls that all
 * call the same goTo(): named tabs, prev/next arrows, and dots.
 *
 * PROGRESSIVE ENHANCEMENT. The markup renders the five slides as plain stacked
 * blocks. This file adds `is-ready` to the root, which is what turns the track
 * into a flex row and reveals the arrows and dots. With JS off, or before this
 * runs, the reader gets five readable screens in a column rather than one
 * screen and four unreachable ones.
 *
 * NO AUTOPLAY, deliberately. These are detail-dense screenshots someone is
 * reading, and a carousel that moves itself while you read it is the thing
 * everybody hates about carousels. It also means no timer to tear down.
 *
 * PJAX. This is a page-specific <script src> inside <main>, so pjax.js
 * re-executes the whole file on every visit. Every listener below is attached
 * to an element INSIDE the slider, and those are destroyed when PJAX replaces
 * <main>'s innerHTML -- listeners die with their nodes, so nothing stacks up.
 * Keep it that way: a listener on window or document added here WOULD
 * accumulate one per navigation, and would need the teardown pattern
 * initHeroParallax() uses in main.js.
 */
(function () {
  function initCorporateSlider() {
    var root = document.querySelector('[data-pc-portal-slider]');
    if (!root) return;

    var track = root.querySelector('[data-pc-portal-track]');
    var slides = Array.prototype.slice.call(root.querySelectorAll('[data-pc-portal-slide]'));
    var tabs = Array.prototype.slice.call(root.querySelectorAll('[data-pc-portal-tab]'));
    var dots = Array.prototype.slice.call(root.querySelectorAll('[data-pc-portal-dot]'));
    var prev = root.querySelector('[data-pc-portal-prev]');
    var next = root.querySelector('[data-pc-portal-next]');
    var titleEl = root.querySelector('[data-pc-portal-title]');
    var descEl = root.querySelector('[data-pc-portal-desc]');
    var status = root.querySelector('[data-pc-portal-status]');

    if (!track || slides.length < 2) return;

    var tablist = root.querySelector('[data-pc-portal-tablist]');
    if (tablist) tablist.setAttribute('role', 'tablist');

    var index = 0;
    var last = slides.length - 1;

    function goTo(i, moveFocus) {
      index = Math.max(0, Math.min(i, last));
      track.style.transform = 'translateX(' + -index * 100 + '%)';

      slides.forEach(function (slide, s) {
        var on = s === index;
        // Hidden slides are still in the DOM for the no-JS stack and for
        // crawlers, but they must not be announced or tabbed into.
        slide.setAttribute('aria-hidden', on ? 'false' : 'true');
      });

      tabs.forEach(function (tab, t) {
        var on = t === index;
        tab.classList.toggle('is-active', on);
        tab.setAttribute('aria-selected', on ? 'true' : 'false');
        // Roving tabindex: Tab leaves the tablist instead of walking all five.
        tab.setAttribute('tabindex', on ? '0' : '-1');
      });

      dots.forEach(function (dot, d) {
        var on = d === index;
        dot.classList.toggle('is-active', on);
        dot.setAttribute('aria-current', on ? 'true' : 'false');
      });

      // Ends, not a loop: five screens are a sequence with a start and an end,
      // and a disabled arrow says where you are better than silently wrapping.
      if (prev) prev.disabled = index === 0;
      if (next) next.disabled = index === last;

      var slide = slides[index];
      var title = slide.getAttribute('data-title') || '';
      var desc = slide.getAttribute('data-desc') || '';
      if (titleEl) titleEl.textContent = title ? title + '.' : '';
      if (descEl) descEl.textContent = desc;
      if (status) status.textContent = title + ' — screen ' + (index + 1) + ' of ' + slides.length;

      if (moveFocus && tabs[index]) tabs[index].focus();
    }

    tabs.forEach(function (tab, i) {
      tab.setAttribute('role', 'tab');
      if (slides[i] && slides[i].id) tab.setAttribute('aria-controls', slides[i].id);
      if (slides[i]) {
        slides[i].setAttribute('role', 'tabpanel');
        if (tab.id) slides[i].setAttribute('aria-labelledby', tab.id);
      }

      tab.addEventListener('click', function () {
        goTo(i, false);
      });

      tab.addEventListener('keydown', function (e) {
        var to = null;
        if (e.key === 'ArrowRight' || e.key === 'ArrowDown') to = i === last ? 0 : i + 1;
        else if (e.key === 'ArrowLeft' || e.key === 'ArrowUp') to = i === 0 ? last : i - 1;
        else if (e.key === 'Home') to = 0;
        else if (e.key === 'End') to = last;
        if (to === null) return;
        e.preventDefault();
        goTo(to, true);
      });
    });

    dots.forEach(function (dot, i) {
      dot.addEventListener('click', function () {
        goTo(i, false);
      });
    });

    if (prev) {
      prev.addEventListener('click', function () {
        goTo(index - 1, false);
      });
    }
    if (next) {
      next.addEventListener('click', function () {
        goTo(index + 1, false);
      });
    }

    // is-ready BEFORE the first goTo: the track has to be a flex row already,
    // or the opening translateX(0) would apply to a column of stacked blocks.
    root.classList.add('is-ready');
    goTo(0, false);
  }

  // Exposed so pjax.js can call it by name if this section ever moves outside
  // <main>; today the re-executed <script src> is what re-runs it.
  window.pcInitCorporateSlider = initCorporateSlider;
  initCorporateSlider();
})();
