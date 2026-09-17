(function () {
  var overlay = document.getElementById('pcPageLoader');
  if (!overlay) return;

  function hideLoader() {
    overlay.classList.add('pc-loader-hidden');
  }

  function showLoader() {
    overlay.classList.remove('pc-loader-hidden');
  }

  /* WHEN TO LIFT IT. This used to wait for window 'load' -- which fires only
     after EVERY image, background image, iframe and async script has
     finished, none of which the visitor needs to start reading. Measured on
     a throttled 4G connection, the page was fully built and usable at 1.1s
     on /ride but stayed covered until 2.9s, waiting on the 460KB Google Maps
     script; the homepage waited on a 1MB background photo the same way.

     Now it lifts as soon as the page is built AND the brand font is ready,
     so the fade reveals finished typography rather than a font swap. The
     font wait is capped at FONT_WAIT_MS: on a slow connection the metric-
     matched fallback in base.css keeps the text from reflowing when the real
     font lands, so there is no reason to hold the page hostage for it.

     This script loads last in the footer, so by the time it runs the DOM
     above it is already parsed; the DOMContentLoaded branch only matters if
     it is ever moved or deferred. */
  var FONT_WAIT_MS = 700;

  function hideWhenReady() {
    var done = false;
    function go() {
      if (done) return;
      done = true;
      hideLoader();
    }
    if (document.fonts && document.fonts.ready) {
      document.fonts.ready.then(go, go);
    } else {
      go();
    }
    window.setTimeout(go, FONT_WAIT_MS);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', hideWhenReady);
  } else {
    hideWhenReady();
  }

  // Safety net: never let anything keep the whole site covered.
  window.setTimeout(hideLoader, 4000);

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
