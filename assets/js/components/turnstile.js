/* Cloudflare Turnstile glue.
 *
 * Two things the stock script does not handle on this site:
 *
 * 1. PJAX replaces <main>, so widgets appear after the API script has already scanned the page.
 *    pcInitTurnstile() renders any widget that does not have one yet; pjax.js calls it by name
 *    after every swap.
 * 2. A token is single-use. ajax-forms.js re-posts a form by fetch and leaves it on screen, so
 *    after any submit -- success or failure -- the widget has to be reset or the next attempt
 *    sends a token Cloudflare has already seen ("timeout-or-duplicate").
 *
 * Loaded once from footer.php, outside <main>, so this file is never re-executed. */
(function () {
  'use strict';

  var API = 'https://challenges.cloudflare.com/turnstile/v0/api.js?render=explicit';
  var loading = false;

  function widgets(root) {
    return [].slice.call((root || document).querySelectorAll('.cf-turnstile'));
  }

  /* Render every widget that has not been rendered yet. Safe to call repeatedly. */
  function render() {
    if (!window.turnstile) return;
    widgets().forEach(function (el) {
      if (el.dataset.pcWidgetId) return;
      // Turnstile cannot size itself inside display:none, and several widgets start life in a
      // closed modal or a collapsed block. Leave those until whatever reveals them calls back.
      if (!el.offsetParent && getComputedStyle(el).position !== 'fixed') return;
      try {
        el.dataset.pcWidgetId = window.turnstile.render(el, {});
      } catch (e) {
        /* Already rendered by the implicit scan, or the element is detached. */
      }
    });
  }

  function load() {
    if (window.turnstile || loading) {
      render();
      return;
    }
    if (!widgets().length) return;

    loading = true;
    var s = document.createElement('script');
    s.src = API;
    s.async = true;
    s.defer = true;
    s.onload = function () {
      loading = false;
      render();
    };
    s.onerror = function () {
      loading = false;
      /* The server treats an unreachable Cloudflare as a pass, so the form still works. */
    };
    document.head.appendChild(s);
  }

  /* Called after a submit: give the form a fresh token for the next attempt. */
  function reset(form) {
    if (!window.turnstile) return;
    widgets(form).forEach(function (el) {
      try {
        if (el.dataset.pcWidgetId) {
          window.turnstile.reset(el.dataset.pcWidgetId);
        } else {
          window.turnstile.reset(el);
        }
      } catch (e) {
        /* Nothing to reset. */
      }
    });
  }

  window.pcInitTurnstile = load;
  window.pcResetTurnstile = reset;

  if (document.readyState !== 'loading') {
    load();
  } else {
    document.addEventListener('DOMContentLoaded', load);
  }
})();
