(function () {
  var overlay = document.getElementById('pcPageLoader');
  if (!overlay) return;

  function hideLoader() {
    overlay.classList.add('pc-loader-hidden');
  }

  function showLoader() {
    overlay.classList.remove('pc-loader-hidden');
  }

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
