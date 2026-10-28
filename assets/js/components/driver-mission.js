
(function () {
  'use strict';

  var API = '/driver-training-api';

  function root() {
    return document.querySelector('[data-pc-mission-root]');
  }

  // Which module this page is showing. The server re-checks it on every POST -- this only
  // tells the API which track's missions to grade against.
  function track() {
    var scope = root();
    return (scope && scope.getAttribute('data-pc-track')) || 'general';
  }

function scopeLink(id) {
    var scope = root();
    return scope ? scope.querySelector('[data-pc-mission-link="' + id + '"]') : null;
  }

function showMission(id, opts) {
    var scope = root();
    if (!scope) return;

    [].forEach.call(scope.querySelectorAll('[data-pc-mission]'), function (p) {
      p.hidden = p.getAttribute('data-pc-mission') !== id;
    });
    [].forEach.call(scope.querySelectorAll('[data-pc-mission-link]'), function (b) {
      b.classList.toggle('is-active', b.getAttribute('data-pc-mission-link') === id);
    });

    var active = scope.querySelector('[data-pc-mission-link="' + id + '"]');
    if (active) {
var rail = active.closest('ol');
      if (rail && rail.scrollWidth > rail.clientWidth) {
        rail.scrollTo({ left: Math.max(0, active.offsetLeft - 24), behavior: 'smooth' });
      }
    }

if (opts && opts.scroll) {
      var panel = scope.querySelector('[data-pc-mission="' + id + '"]');
      if (panel) {
        var top = panel.getBoundingClientRect().top + window.scrollY;
        var nav = parseInt(getComputedStyle(document.documentElement).getPropertyValue('--pc-navbar-h'), 10) || 72;
        window.scrollTo({ top: top - nav - 80, behavior: 'smooth' });
      }
    }
  }

var celebrateTimer = null;

  function celebrate(title, sub) {
    var box = document.querySelector('[data-pc-celebrate]');
    if (!box) return;
    var card = box.firstElementChild;
    box.querySelector('[data-pc-celebrate-title]').textContent = title;
    box.querySelector('[data-pc-celebrate-sub]').textContent = sub || '';
    box.hidden = false;
    requestAnimationFrame(function () {
      card.classList.add('is-in');
    });
    window.clearTimeout(celebrateTimer);
    celebrateTimer = window.setTimeout(function () {
      card.classList.remove('is-in');
      window.setTimeout(function () {
        box.hidden = true;
      }, 320);
    }, 2600);
  }

function paintState(state) {
    var scope = root();
    if (!scope || !state) return;

    var bar = scope.querySelector('[data-pc-progress-bar]');
    if (bar) {
      bar.style.width = state.pct + '%';
      var track = bar.parentElement;
      if (track) track.setAttribute('aria-valuenow', String(state.pct));
    }
    var set = function (sel, val) {
      var el = scope.querySelector(sel);
      if (el) el.textContent = String(val);
    };
    set('[data-pc-done-count]', state.count);
    set('[data-pc-pct]', state.pct);
    set('[data-pc-xp]', state.xp);

[].forEach.call(scope.querySelectorAll('[data-pc-mission-link]'), function (b) {
      var id = b.getAttribute('data-pc-mission-link');
      var was = b.getAttribute('data-pc-state');

      if (id === 'final') {
        if (state.finalUnlocked) {
          b.disabled = false;
          b.setAttribute('data-pc-state', state.certified ? 'done' : 'current');
        }
        return;
      }

      if (state.completed.indexOf(id) !== -1) {
        b.setAttribute('data-pc-state', 'done');
        b.disabled = false;
      } else if (id === state.current) {
        b.setAttribute('data-pc-state', 'current');
        b.disabled = false;
      } else {
b.setAttribute('data-pc-state', 'locked');
        b.disabled = true;
      }

if (was !== b.getAttribute('data-pc-state')) {
        b.classList.add('tw-animate-pc-pop');
        window.setTimeout(function () {
          b.classList.remove('tw-animate-pc-pop');
        }, 600);
      }
    });

[].forEach.call(scope.querySelectorAll('[data-pc-mission]'), function (sec) {
      var id = sec.getAttribute('data-pc-mission');
      if (id === 'final') return;
      sec.setAttribute('data-pc-done', state.completed.indexOf(id) !== -1 ? '1' : '0');
    });

(state.badges || []).forEach(function (bid) {
      var el = scope.querySelector('[data-pc-badge="' + bid + '"]');
      if (el && el.className.indexOf('tw-bg-power') === -1) {
        el.className = el.className
          .replace('tw-border-white/15', 'tw-border-power')
          .replace('tw-bg-white/[0.04]', 'tw-bg-power')
          .replace('tw-text-white/35', 'tw-text-white');
        el.classList.add('tw-shadow-[0_4px_14px_-4px_rgba(249,115,22,0.8)]');
        var lock = el.querySelector('svg:last-of-type');
        var sr = el.querySelector('.tw-sr-only');
        if (sr && /locked/.test(sr.textContent)) sr.textContent = '(earned)';
        if (lock && el.querySelectorAll('svg').length > 1) lock.remove();
      }
    });
  }

function paintGrading(form, detail) {
    [].forEach.call(form.querySelectorAll('[data-pc-q]'), function (fs, i) {
      var d = detail[i];
      var box = fs.querySelector('[data-pc-explain]');
      if (!d || !box) return;

      if (d.correct) {
        box.className =
          'tw-mb-0 tw-mt-2.5 tw-rounded-xl tw-px-3.5 tw-py-2.5 tw-text-[0.85rem] tw-leading-relaxed ' +
          'tw-bg-success/10 tw-text-success';
        box.innerHTML = '<strong>Correct.</strong> ' + d.explain;
      } else {
        box.className =
          'tw-mb-0 tw-mt-2.5 tw-rounded-xl tw-px-3.5 tw-py-2.5 tw-text-[0.85rem] tw-leading-relaxed ' +
          'tw-bg-power/10 tw-text-ink';

        box.innerHTML = '<strong>Not quite.</strong> ' + d.explain;

        var right = fs.querySelector('input[value="' + d.answer + '"]');
        if (right && right.parentElement) {
          right.parentElement.classList.add('tw-border-success', 'tw-bg-success/[0.07]');
        }
      }
      box.hidden = false;
    });
  }

  function clearGrading(form) {
    [].forEach.call(form.querySelectorAll('[data-pc-explain]'), function (b) {
      b.hidden = true;
    });
    [].forEach.call(form.querySelectorAll('label'), function (l) {
      l.classList.remove('tw-border-success', 'tw-bg-success/[0.07]');
    });
  }

  function message(form, text, kind) {
    var box = form.querySelector('[data-pc-quiz-msg]');
    if (!box) return;
    box.className =
      'tw-mb-4 tw-rounded-xl tw-px-4 tw-py-3 tw-text-sm tw-font-semibold ' +
      (kind === 'ok' ? 'tw-bg-success/10 tw-text-success' : 'tw-bg-power/10 tw-text-ink');
    box.textContent = text;
    box.hidden = false;
  }

function collect(form) {
    var answers = {};
    [].forEach.call(form.querySelectorAll('[data-pc-q]'), function (fs, i) {
      var picked = fs.querySelector('input[type="radio"]:checked');
      if (picked) answers[i] = picked.value;
    });
    return answers;
  }

  function submitQuiz(form) {
    var id = form.getAttribute('data-pc-quiz');
    var isFinal = id === 'final';
    var answers = collect(form);
    var questions = form.querySelectorAll('[data-pc-q]').length;

    if (Object.keys(answers).length < questions) {
      message(form, 'Answer every question before continuing.', 'warn');
      return;
    }

    clearGrading(form);
    var btn = form.querySelector('button[type="submit"]');
    var label = btn && btn.querySelector('[data-label]');
    if (btn) btn.disabled = true;
    if (label && !label.dataset.idle) label.dataset.idle = label.textContent;
    if (label) label.textContent = 'Checking…';

    var body = new FormData();
    body.append('action', isFinal ? 'final' : 'mission');
    body.append('track', track());
    if (!isFinal) body.append('mission', id);
    Object.keys(answers).forEach(function (k) {
      body.append('answers[' + k + ']', answers[k]);
    });

    fetch(API, { method: 'POST', body: body, credentials: 'same-origin', headers: { Accept: 'application/json' } })
      .then(function (r) {
        return r.json().then(function (d) {
          return { ok: r.ok, d: d || {} };
        });
      })
      .then(function (res) {
        if (btn) btn.disabled = false;
        if (label && label.dataset.idle) label.textContent = label.dataset.idle;

        if (!res.ok || !res.d.ok) {
          message(form, res.d.error || 'Something went wrong. Please try again.', 'warn');
          return;
        }

        paintGrading(form, res.d.graded.detail);
        paintState(res.d.state);

        if (!res.d.passed) {
          message(
            form,
            isFinal
              ? 'Almost there — you scored ' + res.d.graded.pct + '%. Review the answers above and try again.'
              : 'Not quite. Read the answers above, then try again.',
            'warn'
          );
          if (label) label.textContent = 'Try again';

          return;
        }

        if (isFinal) {
          message(form, 'Passed with ' + res.d.graded.pct + '%. Issuing your certificate…', 'ok');
          certify();
          return;
        }

        var pts = res.d.xpAwarded ? '+' + res.d.xpAwarded + ' pts' : '';
        var next = res.d.state.current || (res.d.state.finalUnlocked ? 'final' : null);

var nextLabel = '';
        if (next) {
          var pill = scopeLink(next);
          if (pill) nextLabel = (pill.textContent || '').replace(/\s+/g, ' ').trim();
        }

        var sub = pts;
        if (res.d.badge) sub += '  ·  ' + res.d.badge.label + ' earned';
        celebrate('Level complete!', sub);

        message(
          form,
          next
            ? 'Level complete. ' + pts + (nextLabel ? ' — ' + nextLabel + ' unlocked.' : '')
            : 'Level complete. ' + pts,
          'ok'
        );
        if (label) label.textContent = 'Check again';

window.setTimeout(function () {
          if (next) showMission(next, { scroll: true });
        }, 1300);
      })
      .catch(function () {
        if (btn) btn.disabled = false;
        if (label && label.dataset.idle) label.textContent = label.dataset.idle;
        message(form, 'We could not reach the server. Check your connection and try again.', 'warn');
      });
  }

function certify() {
    var body = new FormData();
    body.append('action', 'certify');
    body.append('track', track());
    fetch(API, { method: 'POST', body: body, credentials: 'same-origin', headers: { Accept: 'application/json' } })
      .then(function (r) {
        return r.json();
      })
      .then(function (d) {
        if (!d || !d.ok) return;
        var scope = root();
        var panel = scope && scope.querySelector('[data-pc-certified]');
        if (!panel) return;

        var idEl = panel.querySelector('[data-pc-cert-id]');
        var dateEl = panel.querySelector('[data-pc-cert-date]');
        var note = panel.querySelector('[data-pc-cert-note]');
        if (idEl) idEl.textContent = d.certificate.id;
        if (dateEl) {
          dateEl.textContent = new Date(d.certificate.at * 1000).toLocaleDateString('en-IE', {
            day: 'numeric',
            month: 'short',
            year: 'numeric',
          });
        }
        if (note) {
note.textContent = d.certificate.emailed
            ? 'A copy has been emailed to you.'
            : 'We could not email your certificate just now, but you can download it above.';
        }

        panel.hidden = false;
        [].forEach.call(scope.querySelectorAll('[data-pc-mission]'), function (p) {
          p.hidden = true;
        });
        paintState(d.state);
        celebrate('PowerCabs Certified!', 'Your certificate is ready');
        panel.scrollIntoView({ behavior: 'smooth', block: 'center' });
      })
      .catch(function () {
      });
  }

function init() {
    var scope = root();
    if (!scope) return;
    var current = scope.getAttribute('data-pc-current');
    if (current) showMission(current, { scroll: false });
  }

  window.pcInitDriverMission = init;
  // Test seam: re-renders from a state object the server already sent.
  window.pcPaintState = paintState;

// Bound once on window: pjax.js re-executes this file with a fresh closure each visit.
  if (!window.__pcMissionBound) {
    window.__pcMissionBound = true;

    document.addEventListener('click', function (event) {
      var link = event.target.closest('[data-pc-mission-link]');
      if (link && !link.disabled) {
        event.preventDefault();
        showMission(link.getAttribute('data-pc-mission-link'), { scroll: true });
        return;
      }

      var zoom = event.target.closest('[data-pc-zoom]');
      if (zoom) {
        event.preventDefault();
        var lb = document.querySelector('[data-pc-dt-lightbox]');
        if (!lb) return;
        var img = lb.querySelector('[data-pc-dt-lightbox-img]');
        img.src = zoom.getAttribute('data-pc-zoom');
        img.alt = zoom.getAttribute('data-pc-zoom-alt') || '';
        lb.hidden = false;
        document.body.style.overflow = 'hidden';
        var close = lb.querySelector('[data-pc-dt-lightbox-close]');
        if (close) close.focus();
        lb.__opener = zoom;
        return;
      }

      var lb2 = document.querySelector('[data-pc-dt-lightbox]');
      if (lb2 && !lb2.hidden && (event.target.closest('[data-pc-dt-lightbox-close]') || event.target === lb2)) {
        closeLightbox();
      }
    });

    document.addEventListener('submit', function (event) {
      var form = event.target.closest('[data-pc-quiz]');
      if (!form) return;
      event.preventDefault();
      submitQuiz(form);
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') closeLightbox();
    });
  }

  function closeLightbox() {
    var lb = document.querySelector('[data-pc-dt-lightbox]');
    if (!lb || lb.hidden) return;
    lb.hidden = true;
    document.body.style.overflow = '';
    var img = lb.querySelector('[data-pc-dt-lightbox-img]');
    if (img) img.removeAttribute('src');
    if (lb.__opener && lb.__opener.focus) lb.__opener.focus();
    lb.__opener = null;
  }

  if (document.readyState !== 'loading') {
    init();
  } else {
    document.addEventListener('DOMContentLoaded', init, { once: true });
  }
})();
