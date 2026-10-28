/* Custom country-code picker for the phone field.
 *
 * The native <select> stays in the DOM and keeps the value -- it is just made invisible and
 * taken out of the tab order. Everything visible is drawn here: a trigger showing the flag and
 * dial code, and a searchable panel of countries.
 *
 * Loaded once from footer.php, but the fields live inside <main> and are replaced on every PJAX
 * swap, so all listeners are delegated off document. One set of listeners, any number of fields,
 * nothing to re-bind after a navigation. */
(function () {
  'use strict';

  var OPEN = null; // the .pc-phone currently showing its panel

  function flagsFor(wrap) {
    if (wrap._pcFlags) return wrap._pcFlags;
    var tag = wrap.querySelector('[data-pc-phone-flags]');
    try {
      wrap._pcFlags = tag ? JSON.parse(tag.textContent || '{}') : {};
    } catch (e) {
      wrap._pcFlags = {};
    }
    return wrap._pcFlags;
  }

  function flagSvg(wrap, iso) {
    var f = flagsFor(wrap)[iso];
    return f ? '<svg viewBox="0 0 20 14" class="tw-h-full tw-w-full" focusable="false">' + f + '</svg>' : '';
  }

  /* Paint the trigger from whatever the select currently holds. */
  function paint(wrap) {
    var sel = wrap.querySelector('[data-pc-phone-select]');
    var opt = sel && sel.options[sel.selectedIndex];
    if (!opt) return;

    var code = wrap.querySelector('[data-pc-phone-code]');
    if (code) code.textContent = opt.value;

    var holder = wrap.querySelector('[data-pc-phone-flag]');
    var iso = opt.getAttribute('data-iso');
    if (holder && iso) holder.innerHTML = flagSvg(wrap, iso);
  }

  function buildPanel(wrap) {
    var sel = wrap.querySelector('[data-pc-phone-select]');
    if (!sel) return null;

    var panel = document.createElement('div');
    panel.setAttribute('data-pc-phone-panel', '');
    panel.className =
      'tw-absolute tw-left-0 tw-top-[calc(100%+0.35rem)] tw-z-[60] tw-w-[min(19rem,calc(100vw-2.5rem))] ' +
      'tw-overflow-hidden tw-rounded-xl tw-border tw-border-solid tw-border-black/10 tw-bg-white ' +
      'tw-shadow-[0_18px_44px_-12px_rgba(28,20,16,0.28)]';

    var search = document.createElement('input');
    search.type = 'text';
    search.setAttribute('data-pc-phone-search', '');
    search.placeholder = 'Search country or code';
    search.autocomplete = 'off';
    search.className =
      'tw-m-0 tw-block tw-w-full tw-appearance-none tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.08] ' +
      'tw-bg-white tw-px-3 tw-py-2.5 tw-text-sm tw-text-ink tw-outline-none placeholder:tw-text-ink/40';
    panel.appendChild(search);

    var list = document.createElement('div');
    list.setAttribute('role', 'listbox');
    list.className = 'tw-max-h-[15rem] tw-overflow-y-auto tw-overscroll-contain tw-py-1 [scrollbar-width:thin]';
    panel.appendChild(list);

    [].forEach.call(sel.options, function (opt, i) {
      var row = document.createElement('button');
      row.type = 'button';
      row.setAttribute('role', 'option');
      row.setAttribute('data-i', String(i));
      row.setAttribute('data-search', ((opt.getAttribute('data-country') || '') + ' ' + opt.value).toLowerCase());
      row.className =
        'tw-flex tw-w-full tw-cursor-pointer tw-appearance-none tw-items-center tw-gap-2.5 tw-border-0 ' +
        'tw-bg-transparent tw-px-3 tw-py-2 tw-text-left tw-text-sm tw-text-ink tw-transition-colors ' +
        'tw-duration-150 hover:tw-bg-peach [&.is-active]:tw-bg-peach [&[aria-selected=true]]:tw-font-semibold';
      row.innerHTML =
        '<span class="tw-inline-flex tw-h-[0.8rem] tw-w-[1.15rem] tw-shrink-0 tw-overflow-hidden tw-rounded-[2px] tw-shadow-[0_0_0_1px_rgba(0,0,0,0.08)]" aria-hidden="true">' +
        flagSvg(wrap, opt.getAttribute('data-iso')) +
        '</span><span class="tw-min-w-0 tw-flex-1 tw-truncate">' +
        (opt.getAttribute('data-country') || '') +
        '</span><span class="tw-shrink-0 tw-text-ink/55">' +
        opt.value +
        '</span>';
      if (i === sel.selectedIndex) row.setAttribute('aria-selected', 'true');
      list.appendChild(row);
    });

    wrap.appendChild(panel);
    return panel;
  }

  function rows(panel) {
    return [].filter.call(panel.querySelectorAll('[role="option"]'), function (r) {
      return r.style.display !== 'none';
    });
  }

  function setActive(panel, row) {
    [].forEach.call(panel.querySelectorAll('[role="option"]'), function (r) {
      r.classList.remove('is-active');
    });
    if (!row) return;
    row.classList.add('is-active');
    row.scrollIntoView({ block: 'nearest' });
  }

  function close() {
    if (!OPEN) return;
    var panel = OPEN.querySelector('[data-pc-phone-panel]');
    if (panel) panel.remove();
    var trigger = OPEN.querySelector('[data-pc-phone-trigger]');
    if (trigger) trigger.setAttribute('aria-expanded', 'false');
    OPEN = null;
  }

  function open(wrap) {
    if (OPEN === wrap) {
      close();
      return;
    }
    close();

    var panel = buildPanel(wrap);
    if (!panel) return;
    OPEN = wrap;

    var trigger = wrap.querySelector('[data-pc-phone-trigger]');
    if (trigger) trigger.setAttribute('aria-expanded', 'true');

    setActive(panel, panel.querySelector('[aria-selected="true"]') || rows(panel)[0]);
    var search = panel.querySelector('[data-pc-phone-search]');
    if (search) search.focus();
  }

  function choose(wrap, index) {
    var sel = wrap.querySelector('[data-pc-phone-select]');
    if (sel) {
      sel.selectedIndex = index;
      sel.dispatchEvent(new Event('change', { bubbles: true }));
    }
    paint(wrap);
    close();
    var trigger = wrap.querySelector('[data-pc-phone-trigger]');
    if (trigger) trigger.focus();
  }

  /* ---------------------------------------------------------------- events --- */

  document.addEventListener('click', function (e) {
    var trigger = e.target.closest && e.target.closest('[data-pc-phone-trigger]');
    if (trigger) {
      e.preventDefault();
      open(trigger.closest('.pc-phone'));
      return;
    }

    var row = e.target.closest && e.target.closest('[data-pc-phone-panel] [role="option"]');
    if (row) {
      e.preventDefault();
      choose(row.closest('.pc-phone'), parseInt(row.getAttribute('data-i'), 10));
      return;
    }

    if (OPEN && !(e.target.closest && e.target.closest('.pc-phone'))) close();
  });

  document.addEventListener('input', function (e) {
    if (!e.target.matches || !e.target.matches('[data-pc-phone-search]')) return;
    var panel = e.target.closest('[data-pc-phone-panel]');
    var q = e.target.value.trim().toLowerCase();
    [].forEach.call(panel.querySelectorAll('[role="option"]'), function (r) {
      r.style.display = !q || r.getAttribute('data-search').indexOf(q) !== -1 ? '' : 'none';
    });
    setActive(panel, rows(panel)[0]);
  });

  document.addEventListener('keydown', function (e) {
    var trigger = e.target.closest && e.target.closest('[data-pc-phone-trigger]');
    if (trigger && (e.key === 'ArrowDown' || e.key === 'Enter' || e.key === ' ')) {
      e.preventDefault();
      open(trigger.closest('.pc-phone'));
      return;
    }

    if (!OPEN) return;
    var panel = OPEN.querySelector('[data-pc-phone-panel]');
    if (!panel || !panel.contains(e.target)) return;

    var list = rows(panel);
    var at = list.indexOf(panel.querySelector('.is-active'));

    if (e.key === 'Escape') {
      e.preventDefault();
      var t = OPEN.querySelector('[data-pc-phone-trigger]');
      close();
      if (t) t.focus();
    } else if (e.key === 'ArrowDown') {
      e.preventDefault();
      setActive(panel, list[Math.min(at + 1, list.length - 1)]);
    } else if (e.key === 'ArrowUp') {
      e.preventDefault();
      setActive(panel, list[Math.max(at - 1, 0)]);
    } else if (e.key === 'Enter') {
      e.preventDefault();
      var row = list[at] || list[0];
      if (row) choose(OPEN, parseInt(row.getAttribute('data-i'), 10));
    } else if (e.key === 'Tab') {
      close();
    }
  });

  /* The native select is only a fallback once this script is running. */
  function enhance() {
    [].forEach.call(document.querySelectorAll('.pc-phone'), function (wrap) {
      var sel = wrap.querySelector('[data-pc-phone-select]');
      if (sel) {
        sel.tabIndex = -1;
        sel.setAttribute('aria-hidden', 'true');
        sel.classList.add('tw-pointer-events-none');
      }
      paint(wrap);
    });
  }

  window.pcInitPhoneFields = enhance;

  if (document.readyState !== 'loading') {
    enhance();
  } else {
    document.addEventListener('DOMContentLoaded', enhance);
  }
})();
