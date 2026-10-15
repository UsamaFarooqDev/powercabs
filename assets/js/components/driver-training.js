(function () {
  'use strict';

  var HINT = 'pc_driver_hint';

  function hasHint() {
    return document.cookie.split('; ').indexOf(HINT + '=1') !== -1;
  }

  function setBusy(form, busy) {
    var btn = form.querySelector('[data-pc-login-submit]');
    if (!btn) return;
    var label = btn.querySelector('[data-label]');
    btn.disabled = busy;
    if (label) {
      if (busy) {
        if (!label.dataset.idle) label.dataset.idle = label.textContent;
        label.textContent = 'Signing in…';
      } else if (label.dataset.idle) {
        label.textContent = label.dataset.idle;
      }
    }
  }

  function showError(form, message) {
    var box = form.querySelector('[data-pc-login-error]');
    if (!box) return;
    box.textContent = message;
    box.hidden = false;
  }

  function clearError(form) {
    var box = form.querySelector('[data-pc-login-error]');
    if (box) box.hidden = true;
  }

  function submitLogin(form) {
    clearError(form);
    setBusy(form, true);

    fetch(form.getAttribute('action'), {
      method: 'POST',
      body: new FormData(form),

      credentials: 'same-origin',
      headers: { Accept: 'application/json' },
    })
      .then(function (res) {
        return res.json().then(function (data) {
          return { ok: res.ok, data: data || {} };
        });
      })
      .then(function (r) {
        if (!r.ok || !r.data.ok) {
          setBusy(form, false);
          showError(form, r.data.error || 'Sign in failed. Please try again.');
          var pw = form.querySelector('input[type="password"]');
          if (pw) {
            pw.value = '';
            pw.focus();
          }
          return;
        }

        window.location.href = r.data.redirect || '/driver-training';
      })
      .catch(function () {
        setBusy(form, false);
        showError(form, 'We could not reach the server. Check your connection and try again.');
      });
  }

  var lastZoomOpener = null;

  function lightbox() {
    return document.querySelector('[data-pc-dt-lightbox]');
  }

  function openZoom(src, alt, opener) {
    var box = lightbox();
    if (!box) return;
    var img = box.querySelector('[data-pc-dt-lightbox-img]');
    if (img) {
      img.src = src;
      img.alt = alt || '';
    }
    lastZoomOpener = opener || null;
    box.hidden = false;
    document.body.style.overflow = 'hidden';
    var close = box.querySelector('[data-pc-dt-lightbox-close]');
    if (close) close.focus();
  }

  function closeZoom() {
    var box = lightbox();
    if (!box || box.hidden) return;
    box.hidden = true;
    document.body.style.overflow = '';

    var img = box.querySelector('[data-pc-dt-lightbox-img]');
    if (img) img.removeAttribute('src');
    if (lastZoomOpener && lastZoomOpener.focus) lastZoomOpener.focus();
    lastZoomOpener = null;
  }

  function initSpy() {
    if (window.__pcDtObserver) {
      window.__pcDtObserver.disconnect();
      window.__pcDtObserver = null;
    }

    var sections = [].slice.call(document.querySelectorAll('[data-pc-dt-section]'));
    if (!sections.length) return;

    var links = {};
    [].forEach.call(document.querySelectorAll('[data-pc-dt-link]'), function (a) {
      links[a.getAttribute('data-pc-dt-link')] = a;
    });

    function activate(id) {
      Object.keys(links).forEach(function (key) {
        links[key].classList.toggle('is-active', key === id);
      });
      var active = links[id];

      if (active && active.parentElement && active.parentElement.parentElement) {
        var rail = active.parentElement.parentElement;
        if (rail.scrollWidth > rail.clientWidth) {
          var r = active.getBoundingClientRect();
          var rr = rail.getBoundingClientRect();
          if (r.left < rr.left || r.right > rr.right) {
            rail.scrollTo({ left: active.offsetLeft - 16, behavior: 'smooth' });
          }
        }
      }
    }

    activate(sections[0].getAttribute('data-pc-dt-section'));

    window.__pcDtObserver = new IntersectionObserver(
      function (entries) {
        var visible = entries
          .filter(function (e) {
            return e.isIntersecting;
          })
          .sort(function (a, b) {
            return a.boundingClientRect.top - b.boundingClientRect.top;
          });
        if (visible.length) {
          activate(visible[0].target.getAttribute('data-pc-dt-section'));
        }
      },

      { rootMargin: '-140px 0px -55% 0px', threshold: 0 }
    );
    sections.forEach(function (s) {
      window.__pcDtObserver.observe(s);
    });
  }

  function init() {
    initSpy();
  }

  window.pcInitDriverTraining = init;

  if (!window.__pcDtGlobalBound) {
    window.__pcDtGlobalBound = true;

    document.addEventListener('click', function (event) {
      var trigger = event.target.closest('[data-pc-driver-training-link]');
      if (trigger) {
        if (hasHint()) return;
        var modal = document.getElementById('pcDriverLogin');
        if (modal && window.pcModal) {
          event.preventDefault();
          window.pcModal.getOrCreateInstance(modal).show(trigger);
        }
        return;
      }

      var toggle = event.target.closest('[data-pc-password-toggle]');
      if (toggle) {
        var input = document.getElementById(toggle.getAttribute('data-target') || '');
        if (input) {
          var show = input.type === 'password';
          input.type = show ? 'text' : 'password';
          toggle.setAttribute('aria-pressed', show ? 'true' : 'false');
          toggle.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
          var on = toggle.querySelector('[data-eye-on]');
          var off = toggle.querySelector('[data-eye-off]');
          if (on) on.hidden = show;
          if (off) off.hidden = !show;
        }
        return;
      }

      var zoom = event.target.closest('[data-pc-dt-zoom]');
      if (zoom) {
        event.preventDefault();
        openZoom(zoom.getAttribute('data-pc-dt-zoom'), zoom.getAttribute('data-pc-dt-zoom-alt'), zoom);
        return;
      }

      var box = lightbox();
      if (box && !box.hidden && (event.target.closest('[data-pc-dt-lightbox-close]') || event.target === box)) {
        closeZoom();
        return;
      }

      var out = event.target.closest('[data-pc-driver-logout]');
      if (out) {
        event.preventDefault();
        out.disabled = true;
        var body = new FormData();
        body.append('action', 'logout');
        fetch('/driver-auth', { method: 'POST', body: body, credentials: 'same-origin' })
          .then(function () {
            window.location.href = '/';
          })
          .catch(function () {
            window.location.reload();
          });
      }
    });

    document.addEventListener('submit', function (event) {
      var form = event.target.closest('[data-pc-driver-login-form]');
      if (!form) return;
      event.preventDefault();
      submitLogin(form);
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') closeZoom();
    });
  }

  if (document.readyState !== 'loading') {
    init();
  } else {
    document.addEventListener('DOMContentLoaded', init, { once: true });
  }
})();
