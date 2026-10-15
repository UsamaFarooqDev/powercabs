(function () {
  var overlay = document.getElementById('pcPageLoader');
  if (!overlay) return;

  function hideLoader() {
    overlay.classList.add('pc-loader-hidden');
  }

  function showLoader() {
    overlay.classList.remove('pc-loader-hidden');
  }

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

window.setTimeout(hideLoader, 4000);

window.addEventListener('pageshow', function (event) {
    if (event.persisted) hideLoader();
  });

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

if (url.pathname === window.location.pathname && url.search === window.location.search && url.hash) return;

    showLoader();
  });

document.addEventListener('submit', function (event) {
    if (event.defaultPrevented) return;
    showLoader();
  });
})();
