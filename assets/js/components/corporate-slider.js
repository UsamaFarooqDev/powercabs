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

        slide.setAttribute('aria-hidden', on ? 'false' : 'true');
      });

      tabs.forEach(function (tab, t) {
        var on = t === index;
        tab.classList.toggle('is-active', on);
        tab.setAttribute('aria-selected', on ? 'true' : 'false');

        tab.setAttribute('tabindex', on ? '0' : '-1');
      });

      dots.forEach(function (dot, d) {
        var on = d === index;
        dot.classList.toggle('is-active', on);
        dot.setAttribute('aria-current', on ? 'true' : 'false');
      });

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

    root.classList.add('is-ready');
    goTo(0, false);
  }

  window.pcInitCorporateSlider = initCorporateSlider;
  initCorporateSlider();
})();
