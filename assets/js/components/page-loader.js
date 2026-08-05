/*
  Global page loader: a full-viewport glassy overlay shown while the page
  itself is loading, and re-shown when the user navigates to another
  internal page or submits a form, so page-to-page transitions never show
  a blank/half-rendered screen in between.

  The overlay markup (components/shared/page-loader.php) is visible by
  default in the raw HTML -- no JS needed to show it on first paint --
  this script's only job is to hide it once the page is actually ready,
  and to bring it back right before an outgoing navigation/submit.
*/
(function () {
  var overlay = document.getElementById('pcPageLoader');
  if (!overlay) return;

  function hideLoader() {
    overlay.classList.add('pc-loader-hidden');
  }

  function showLoader() {
    overlay.classList.remove('pc-loader-hidden');
  }

  // Hide once the page (including images/CSS/third-party scripts) has
  // fully loaded. If 'load' already fired by the time this script runs
  // (fast cached loads), hide immediately instead of waiting forever.
  if (document.readyState === 'complete') {
    hideLoader();
  } else {
    window.addEventListener('load', hideLoader);
  }

  // Safety net: never let one hung resource keep the whole site covered.
  window.setTimeout(hideLoader, 8000);

  // Pages restored from the back/forward cache don't re-fire 'load'.
  window.addEventListener('pageshow', function (event) {
    if (event.persisted) hideLoader();
  });

  // Re-show the loader just before an outgoing same-tab, same-origin
  // navigation, so the transition into the next page feels continuous.
  document.addEventListener('click', function (event) {
    var link = event.target.closest('a[href]');
    if (!link) return;
    if (event.defaultPrevented || event.button !== 0) return;
    if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    if (link.target && link.target !== '_self') return;
    if (link.hasAttribute('download')) return;

    var href = link.getAttribute('href') || '';
    if (href === '' || href.charAt(0) === '#' || /^(mailto|tel|javascript):/i.test(href)) return;

    var url;
    try {
      url = new URL(href, window.location.href);
    } catch (e) {
      return;
    }
    if (url.origin !== window.location.origin) return;

    // Pure in-page anchor jump (same path + query, just a #hash) -- no
    // actual page load happens, so don't cover the screen for it.
    if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash) return;

    showLoader();
  });

  // Re-show on form submits (contact/complaint/feedback/booking forms
  // etc. are all normal POST-and-reload).
  document.addEventListener('submit', function (event) {
    if (event.defaultPrevented) return;
    showLoader();
  });
})();
