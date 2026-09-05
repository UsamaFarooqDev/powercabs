/**
 * Progressive-enhancement custom date/time picker. Wraps every
 * <input class="pc-custom-datetime-enhance"> of type "date", "time" or
 * "datetime-local" with a styled trigger button + panel (a calendar grid
 * for date, a scrollable time list for time), while leaving the original
 * <input> in the DOM -- same id/name/value/required/disabled behavior as
 * before, just made invisible and non-interactive (pointer-events: none,
 * tabindex -1) so nothing else on the page (backend validation, a min-date
 * default set from PHP, whatever) has to know or care that the visible
 * control is no longer the browser's native picker.
 *
 * Shares the same visual language (trigger/panel border, shadow, radius,
 * orange focus border, peach hover) as the dropdown in custom-select.js, so
 * the two feel like one consistent design system. Both are styled entirely
 * with the Tailwind class strings collected in the CLS block below -- there
 * is no .pc-custom-dt* stylesheet any more. Open/disabled state still rides
 * on the same bare `is-open` / `is-disabled` classnames JS has always
 * toggled; each anchor (the wrapper for a standalone field, each segment
 * for a datetime-local) is a Tailwind `tw-group`, so those states reach the
 * trigger and panel through `group-[.is-open]:` / `group-[.is-disabled]:`
 * variants instead of descendant rules. The pc-custom-dt-* classnames that
 * survive (value, day, month-cell, year-cell, time-option) are
 * querySelector hooks, not styling.
 *
 * This is a generic, page-agnostic component. To reuse it on any form:
 *
 *   1. Add class="pc-custom-datetime-enhance" to any
 *      <input type="date">, <input type="time"> or
 *      <input type="datetime-local">. Its id, name, value, required,
 *      disabled and (for date/datetime-local) min/max attributes all
 *      carry over automatically -- no markup changes needed beyond that
 *      one class.
 *   2. Load this script on that page, with the same filemtime()
 *      cache-busting convention used elsewhere on the site.
 *
 * Optional per-field tuning, both read from data-* attributes so no JS
 * changes are ever needed to use them:
 *
 *   - data-dt-quick-year="1"   Opens the calendar straight into its "pick
 *     a year" view instead of the day grid -- for a field like Date of
 *     Birth, where clicking "previous month" a few hundred times to reach
 *     1990 would be painful. Combine with data-dt-years-back="N" (default
 *     30) to change how far back that initial year view centers.
 *   - A "time" input renders a scrollable list in 15-minute steps by
 *     default; add data-dt-step="30" (etc, in minutes) to change that.
 *
 * A datetime-local input is rendered as two adjacent segments (a date
 * trigger + a time trigger, each with its own panel) sharing one hidden
 * native <input> -- the two segments' picks are combined into the single
 * "YYYY-MM-DDTHH:MM" value the native control expects, written back (and
 * a "change" event dispatched) every time either side changes.
 */
if (window.pcCustomDatetimeCleanup) {
  window.pcCustomDatetimeCleanup();
  window.pcCustomDatetimeCleanup = null;
}

(function () {
  var teardownFns = [];

  var MONTH_NAMES = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December",
  ];
  var MONTH_SHORT = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  var WEEKDAY_SHORT = ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"];

  // -------------------------------------------------------------------
  // Tailwind class strings, kept in one place so the calendar and the time
  // list can't drift apart. #fbe4cf is --pc-peach and #ff7a00 is
  // --pc-orange-light; both are written literally because these strings end
  // up in arbitrary values, which can't read CSS custom properties.
  // tw-appearance-none + tw-border-0 are load-bearing on every <button>
  // here: Tailwind's Preflight is disabled site-wide (see header.php), so
  // nothing else resets the browser's default button chrome.
  // -------------------------------------------------------------------
  var CLS = {
    // Reproduces the canonical PowerCabs field recipe from
    // book-ride-online.php ($inputClass) so a picker trigger is pixel-
    // identical to the plain <input> beside it -- 38px tall, 6px radius,
    // #dee2e6 border, orange border on focus, no ring.
    trigger:
      "tw-flex tw-w-full tw-appearance-none tw-items-center tw-gap-[0.55rem] tw-rounded-md tw-border " +
      "tw-border-solid tw-border-[#dee2e6] tw-bg-white tw-px-3 tw-py-1.5 tw-text-left tw-text-base " +
      "tw-leading-normal tw-text-ink tw-cursor-pointer tw-outline-none tw-transition-colors tw-duration-200 " +
      "focus-visible:tw-border-powerlight group-[.is-open]:tw-border-powerlight " +
      "group-[.is-disabled]:tw-cursor-not-allowed group-[.is-disabled]:tw-opacity-[0.65]",
    // An <svg> with no width/height falls back to the SVG default of
    // 300x150 -- explicit sizing is not optional here the way it was
    // for the icon font this replaced.
    icon: "tw-h-4 tw-w-4 tw-shrink-0 tw-text-ink/[0.65]",
    value:
      "pc-custom-dt-value tw-overflow-hidden tw-text-ellipsis tw-whitespace-nowrap " +
      "[.is-placeholder_&]:tw-text-ink/[0.65]",
    panel:
      "tw-invisible tw-absolute tw-top-[calc(100%+6px)] tw-z-20 tw-rounded-2xl tw-border tw-border-solid " +
      "tw-border-black/10 tw-bg-white tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] tw-opacity-0 " +
      "-tw-translate-y-1.5 tw-transition tw-duration-200 tw-ease-[cubic-bezier(0.16,1,0.3,1)] " +
      "group-[.is-open]:tw-visible group-[.is-open]:tw-translate-y-0 group-[.is-open]:tw-opacity-100 " +
      "motion-reduce:tw-transition-none",
    panelCalendar: "tw-left-0 tw-w-[280px] tw-max-w-[calc(100vw-2rem)] tw-p-[0.6rem]",
    panelTime: "tw-inset-x-0 tw-min-w-[170px] tw-p-[0.35rem]",
    navRow: "tw-mb-2 tw-flex tw-items-center tw-justify-between",
    navBtn:
      "tw-flex tw-h-8 tw-w-8 tw-appearance-none tw-items-center tw-justify-center tw-rounded-[10px] tw-border-0 " +
      "tw-bg-transparent tw-text-[0.85rem] tw-text-ink tw-cursor-pointer tw-transition-colors tw-duration-150 " +
      "hover:tw-bg-[#fbe4cf] hover:tw-text-power",
    navTitle:
      "tw-appearance-none tw-rounded-[10px] tw-border-0 tw-bg-transparent tw-px-[0.6rem] tw-py-1 " +
      "tw-text-[0.95rem] tw-font-semibold tw-text-ink tw-cursor-pointer tw-transition-colors tw-duration-150 " +
      "hover:tw-bg-[#fbe4cf] hover:tw-text-power",
    weekdays:
      "tw-mb-[0.15rem] tw-grid tw-grid-cols-7 tw-text-center tw-text-[0.7rem] tw-font-semibold tw-uppercase " +
      "tw-tracking-[0.03em] tw-text-ink/[0.65]",
    daysGrid: "tw-grid tw-grid-cols-7 tw-gap-[2px]",
    // enabled:/disabled: rather than :not(.is-disabled) -- a blocked day
    // gets the real `disabled` attribute as well as the class.
    day:
      "pc-custom-dt-day tw-flex tw-aspect-square tw-appearance-none tw-items-center tw-justify-center " +
      "tw-rounded-[10px] tw-border-0 tw-bg-transparent tw-text-[0.85rem] tw-text-ink tw-cursor-pointer " +
      "tw-transition-colors tw-duration-150 enabled:hover:tw-bg-[#fbe4cf] enabled:hover:tw-text-power " +
      "disabled:tw-cursor-not-allowed disabled:tw-text-ink/[0.65] disabled:tw-opacity-[0.35] " +
      "[&.is-muted]:tw-text-ink/[0.65] [&.is-muted]:tw-opacity-50 " +
      "[&.is-today]:tw-shadow-[inset_0_0_0_1px_#ff7a00] " +
      "[&.is-selected]:tw-bg-power [&.is-selected]:tw-font-semibold [&.is-selected]:tw-text-white",
    cellGrid: "tw-grid tw-grid-cols-3 tw-gap-1",
    cell:
      "tw-appearance-none tw-rounded-[10px] tw-border-0 tw-bg-transparent tw-px-1 tw-py-[0.6rem] " +
      "tw-text-[0.85rem] tw-text-ink tw-cursor-pointer tw-transition-colors tw-duration-150 " +
      "hover:tw-bg-[#fbe4cf] hover:tw-text-power [&.is-selected]:tw-bg-power [&.is-selected]:tw-font-semibold " +
      "[&.is-selected]:tw-text-white",
    toolbarCalendar:
      "tw-mt-[0.35rem] tw-flex tw-items-center tw-justify-between tw-gap-2 tw-border-0 tw-border-t " +
      "tw-border-solid tw-border-black/[0.08] tw-pt-2",
    toolbarTime:
      "tw-mb-[0.35rem] tw-flex tw-items-center tw-justify-between tw-gap-2 tw-border-0 tw-border-b " +
      "tw-border-solid tw-border-black/[0.08] tw-pb-[0.4rem]",
    toolbarBtn:
      "tw-appearance-none tw-border-0 tw-bg-transparent tw-px-[0.4rem] tw-py-[0.2rem] tw-text-[0.8rem] " +
      "tw-font-semibold tw-text-power tw-cursor-pointer hover:tw-underline disabled:tw-cursor-not-allowed " +
      "disabled:tw-no-underline disabled:tw-opacity-40",
    timeList: "tw-max-h-[220px] tw-overflow-y-auto",
    timeOption:
      "pc-custom-dt-time-option tw-block tw-w-full tw-appearance-none tw-rounded-[10px] tw-border-0 " +
      "tw-bg-transparent tw-px-[0.65rem] tw-py-2 tw-text-left tw-text-[0.9rem] tw-text-ink tw-cursor-pointer " +
      "tw-transition-colors tw-duration-150 hover:tw-bg-[#fbe4cf] hover:tw-text-power " +
      "[&.is-selected]:tw-font-semibold [&.is-selected]:tw-text-power",
    // `tw-group` is what makes group-[.is-open]:/group-[.is-disabled]: on
    // the trigger and panel above resolve -- it goes on whichever element
    // JS toggles those classes on, i.e. the anchor.
    anchor: "tw-group tw-relative",
    segment: "tw-group tw-relative tw-min-w-0 tw-flex-1",
  };

  function pad2(n) {
    return n < 10 ? "0" + n : "" + n;
  }

  // ---------------------------------------------------------------------
  // Date helpers -- all dates are plain {y, m, d} objects (m is 0-11) so
  // comparisons never trip over timezone conversion the way epoch-ms
  // Date math can.
  // ---------------------------------------------------------------------
  function daysInMonth(y, m) {
    return new Date(y, m + 1, 0).getDate();
  }

  function firstWeekdayMonIndex(y, m) {
    var jsDay = new Date(y, m, 1).getDay(); // Sun=0..Sat=6
    return (jsDay + 6) % 7; // Mon=0..Sun=6
  }

  function todayYMD() {
    var t = new Date();
    return { y: t.getFullYear(), m: t.getMonth(), d: t.getDate() };
  }

  function parseDateValue(v) {
    if (!v || !/^\d{4}-\d{2}-\d{2}/.test(v)) return null;
    var p = v.split("-");
    return { y: +p[0], m: +p[1] - 1, d: +p[2].slice(0, 2) };
  }

  function formatDateValue(ymd) {
    return ymd.y + "-" + pad2(ymd.m + 1) + "-" + pad2(ymd.d);
  }

  function formatDateDisplay(ymd) {
    return ymd.d + " " + MONTH_SHORT[ymd.m] + " " + ymd.y;
  }

  function compareYMD(a, b) {
    if (a.y !== b.y) return a.y - b.y;
    if (a.m !== b.m) return a.m - b.m;
    return a.d - b.d;
  }

  // ---------------------------------------------------------------------
  // Time helpers -- plain {h, min} objects, always 24h internally; only
  // the display text is formatted as 12h with AM/PM.
  // ---------------------------------------------------------------------
  function parseTimeValue(v) {
    if (!v || !/^\d{2}:\d{2}/.test(v)) return null;
    var p = v.split(":");
    return { h: +p[0], min: +p[1] };
  }

  function formatTimeValue(t) {
    return pad2(t.h) + ":" + pad2(t.min);
  }

  function formatTimeDisplay(t) {
    var h12 = t.h % 12;
    if (h12 === 0) h12 = 12;
    var ampm = t.h < 12 ? "AM" : "PM";
    return h12 + ":" + pad2(t.min) + " " + ampm;
  }

  function buildTimeSlots(step) {
    var slots = [];
    for (var total = 0; total < 24 * 60; total += step) {
      slots.push({ h: Math.floor(total / 60), min: total % 60 });
    }
    return slots;
  }

  // ---------------------------------------------------------------------
  // Shared open/close behavior for a trigger + panel pair: click to
  // toggle, click outside or Escape to close, aria-expanded kept in sync.
  // Registers its own close() as a teardown so a re-init can't leak a
  // stray document-level listener from a panel left open.
  // ---------------------------------------------------------------------
  function makeOpenClose(anchorEl, trigger, panel, onOpen) {
    function onDocClick(event) {
      if (!anchorEl.contains(event.target)) close();
    }
    function onKeydown(event) {
      if (event.key === "Escape") {
        close();
        trigger.focus();
      }
    }
    function open() {
      if (trigger.disabled || anchorEl.classList.contains("is-open")) return;
      anchorEl.classList.add("is-open");
      trigger.setAttribute("aria-expanded", "true");
      document.addEventListener("click", onDocClick, true);
      document.addEventListener("keydown", onKeydown, true);
      if (onOpen) onOpen();
    }
    function close() {
      anchorEl.classList.remove("is-open");
      trigger.setAttribute("aria-expanded", "false");
      document.removeEventListener("click", onDocClick, true);
      document.removeEventListener("keydown", onKeydown, true);
    }
    trigger.addEventListener("click", function () {
      if (anchorEl.classList.contains("is-open")) {
        close();
      } else {
        open();
      }
    });
    teardownFns.push(close);
    return { open: open, close: close };
  }

  /** prev / title / next header shared by the day, month and year views. */
  function navRowHtml(title, unit) {
    return (
      '<div class="' +
      CLS.navRow +
      '">' +
      '<button type="button" class="' +
      CLS.navBtn +
      '" data-nav="prev" aria-label="Previous ' +
      unit +
      '"><svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10 3L5 8l5 5"/></svg></button>' +
      '<button type="button" class="' +
      CLS.navTitle +
      '" data-nav="title">' +
      title +
      "</button>" +
      '<button type="button" class="' +
      CLS.navBtn +
      '" data-nav="next" aria-label="Next ' +
      unit +
      '"><svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 3l5 5-5 5"/></svg></button>' +
      "</div>"
    );
  }

  /** One toolbar button ("Today" / "Now" / "Clear"). */
  function toolbarBtnHtml(action, label, disabled) {
    return (
      '<button type="button" class="' +
      CLS.toolbarBtn +
      '" data-action="' +
      action +
      '"' +
      (disabled ? " disabled" : "") +
      ">" +
      label +
      "</button>"
    );
  }

  // ---------------------------------------------------------------------
  // Calendar (date) picker. cfg: { segmentEl, getValue, setValue, getMin,
  // getMax, required, quickYear, yearsBack, labelText, placeholder }
  // ---------------------------------------------------------------------
  function buildDatePicker(cfg) {
    var trigger = document.createElement("button");
    trigger.type = "button";
    trigger.className = CLS.trigger;
    trigger.setAttribute("aria-haspopup", "dialog");
    trigger.setAttribute("aria-expanded", "false");
    if (cfg.labelText) trigger.setAttribute("aria-label", cfg.labelText);
    trigger.innerHTML =
      '<svg class="' + CLS.icon + '" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M3.5 0a.5.5 0 01.5.5V1h8V.5a.5.5 0 011 0V1h1a2 2 0 012 2v11a2 2 0 01-2 2H2a2 2 0 01-2-2V3a2 2 0 012-2h1V.5a.5.5 0 01.5-.5zM1 4v10a1 1 0 001 1h12a1 1 0 001-1V4H1z"/></svg>' + '<span class="' + CLS.value + '"></span>';
    cfg.segmentEl.appendChild(trigger);

    var panel = document.createElement("div");
    panel.className = CLS.panel + " " + CLS.panelCalendar;
    panel.setAttribute("role", "dialog");
    cfg.segmentEl.appendChild(panel);

    var valueEl = trigger.querySelector(".pc-custom-dt-value");
    var today = todayYMD();
    var view, viewYear, viewMonth, yearsBlockStart;

    function resetView() {
      var v = cfg.getValue();
      if (v) {
        view = "days";
        viewYear = v.y;
        viewMonth = v.m;
      } else if (cfg.quickYear) {
        view = "years";
        viewYear = today.y - (cfg.yearsBack || 30);
        viewMonth = today.m;
      } else {
        view = "days";
        viewYear = today.y;
        viewMonth = today.m;
      }
      yearsBlockStart = viewYear - 5;
    }

    function isDisabledDay(ymd) {
      var min = cfg.getMin && cfg.getMin();
      var max = cfg.getMax && cfg.getMax();
      if (min && compareYMD(ymd, min) < 0) return true;
      if (max && compareYMD(ymd, max) > 0) return true;
      return false;
    }

    function renderDays() {
      var sel = cfg.getValue();
      var html = navRowHtml(MONTH_NAMES[viewMonth] + " " + viewYear, "month");

      html +=
        '<div class="' +
        CLS.weekdays +
        '">' +
        WEEKDAY_SHORT.map(function (w) {
          return "<span>" + w + "</span>";
        }).join("") +
        "</div>";

      var firstIdx = firstWeekdayMonIndex(viewYear, viewMonth);
      var totalDays = daysInMonth(viewYear, viewMonth);
      var prevMonth = viewMonth === 0 ? 11 : viewMonth - 1;
      var prevMonthYear = viewMonth === 0 ? viewYear - 1 : viewYear;
      var prevMonthDays = daysInMonth(prevMonthYear, prevMonth);
      var nextMonth = viewMonth === 11 ? 0 : viewMonth + 1;
      var nextMonthYear = viewMonth === 11 ? viewYear + 1 : viewYear;

      var cells = [];
      for (var i = 0; i < firstIdx; i++) {
        cells.push({ y: prevMonthYear, m: prevMonth, d: prevMonthDays - firstIdx + 1 + i, muted: true });
      }
      for (var d = 1; d <= totalDays; d++) {
        cells.push({ y: viewYear, m: viewMonth, d: d, muted: false });
      }
      var need = 42 - cells.length;
      for (var d2 = 1; d2 <= need; d2++) {
        cells.push({ y: nextMonthYear, m: nextMonth, d: d2, muted: true });
      }

      html += '<div class="' + CLS.daysGrid + '">';
      cells.forEach(function (c) {
        var ymd = { y: c.y, m: c.m, d: c.d };
        var classes = [CLS.day];
        if (c.muted) classes.push("is-muted");
        if (compareYMD(ymd, today) === 0) classes.push("is-today");
        if (sel && compareYMD(ymd, sel) === 0) classes.push("is-selected");
        var disabled = isDisabledDay(ymd);
        if (disabled) classes.push("is-disabled");
        html +=
          '<button type="button" class="' +
          classes.join(" ") +
          '" data-y="' +
          c.y +
          '" data-m="' +
          c.m +
          '" data-d="' +
          c.d +
          '"' +
          (disabled ? " disabled aria-disabled=\"true\"" : "") +
          ">" +
          c.d +
          "</button>";
      });
      html += "</div>";

      html +=
        '<div class="' +
        CLS.toolbarCalendar +
        '">' +
        toolbarBtnHtml("today", "Today", isDisabledDay(today)) +
        (cfg.required ? "" : toolbarBtnHtml("clear", "Clear", false)) +
        "</div>";

      panel.innerHTML = html;
    }

    function renderMonths() {
      var sel = cfg.getValue();
      var html = navRowHtml(viewYear, "year");
      html += '<div class="' + CLS.cellGrid + '">';
      MONTH_SHORT.forEach(function (name, idx) {
        var classes = ["pc-custom-dt-month-cell", CLS.cell];
        if (sel && sel.y === viewYear && sel.m === idx) classes.push("is-selected");
        if (today.y === viewYear && today.m === idx) classes.push("is-today");
        html += '<button type="button" class="' + classes.join(" ") + '" data-month="' + idx + '">' + name + "</button>";
      });
      html += "</div>";
      panel.innerHTML = html;
    }

    function renderYears() {
      var sel = cfg.getValue();
      var html = navRowHtml(yearsBlockStart + "–" + (yearsBlockStart + 11), "years");
      html += '<div class="' + CLS.cellGrid + '">';
      for (var i = 0; i < 12; i++) {
        var y = yearsBlockStart + i;
        var classes = ["pc-custom-dt-year-cell", CLS.cell];
        if (sel && sel.y === y) classes.push("is-selected");
        if (today.y === y) classes.push("is-today");
        html += '<button type="button" class="' + classes.join(" ") + '" data-year="' + y + '">' + y + "</button>";
      }
      html += "</div>";
      panel.innerHTML = html;
    }

    function render() {
      if (view === "days") renderDays();
      else if (view === "months") renderMonths();
      else renderYears();
    }

    function sync() {
      var v = cfg.getValue();
      valueEl.textContent = v ? formatDateDisplay(v) : cfg.placeholder || "Select date";
      trigger.classList.toggle("is-placeholder", !v);
    }

    panel.addEventListener("click", function (event) {
      var navBtn = event.target.closest("[data-nav]");
      if (navBtn) {
        var nav = navBtn.dataset.nav;
        if (nav === "title") {
          view = view === "days" ? "months" : "years";
          if (view === "years") yearsBlockStart = viewYear - 5;
        } else {
          var dir = nav === "prev" ? -1 : 1;
          if (view === "days") {
            viewMonth += dir;
            if (viewMonth < 0) {
              viewMonth = 11;
              viewYear--;
            } else if (viewMonth > 11) {
              viewMonth = 0;
              viewYear++;
            }
          } else if (view === "months") {
            viewYear += dir;
          } else {
            yearsBlockStart += dir * 12;
          }
        }
        render();
        return;
      }

      var dayBtn = event.target.closest(".pc-custom-dt-day");
      if (dayBtn && !dayBtn.disabled) {
        cfg.setValue({ y: +dayBtn.dataset.y, m: +dayBtn.dataset.m, d: +dayBtn.dataset.d });
        render(); // so the just-picked day shows as selected during the close fade, not just after the next open
        sync();
        oc.close();
        trigger.focus();
        return;
      }

      var monthBtn = event.target.closest(".pc-custom-dt-month-cell");
      if (monthBtn) {
        viewMonth = +monthBtn.dataset.month;
        view = "days";
        render();
        return;
      }

      var yearBtn = event.target.closest(".pc-custom-dt-year-cell");
      if (yearBtn) {
        viewYear = +yearBtn.dataset.year;
        view = "months";
        render();
        return;
      }

      var actionBtn = event.target.closest("[data-action]");
      if (actionBtn && !actionBtn.disabled) {
        if (actionBtn.dataset.action === "today") {
          viewYear = today.y;
          viewMonth = today.m;
          view = "days";
          cfg.setValue({ y: today.y, m: today.m, d: today.d });
        } else {
          cfg.setValue(null);
        }
        render();
        sync();
        oc.close();
        trigger.focus();
      }
    });

    var oc = makeOpenClose(cfg.segmentEl, trigger, panel, function () {
      resetView();
      render();
    });

    resetView();
    render();
    sync();

    return { trigger: trigger, sync: sync };
  }

  // ---------------------------------------------------------------------
  // Time list picker. cfg: { segmentEl, getValue, setValue, required,
  // step, labelText, placeholder }
  // ---------------------------------------------------------------------
  function buildTimePicker(cfg) {
    var step = cfg.step || 15;
    var slots = buildTimeSlots(step);

    var trigger = document.createElement("button");
    trigger.type = "button";
    trigger.className = CLS.trigger;
    trigger.setAttribute("aria-haspopup", "listbox");
    trigger.setAttribute("aria-expanded", "false");
    if (cfg.labelText) trigger.setAttribute("aria-label", cfg.labelText);
    trigger.innerHTML =
      '<svg class="' + CLS.icon + '" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8 3.5a.5.5 0 00-1 0V9a.5.5 0 00.252.434l3.5 2a.5.5 0 00.496-.868L8 8.71V3.5z"/><path d="M8 16A8 8 0 108 0a8 8 0 000 16zm7-8A7 7 0 111 8a7 7 0 0114 0z"/></svg>' + '<span class="' + CLS.value + '"></span>';
    cfg.segmentEl.appendChild(trigger);

    var panel = document.createElement("div");
    panel.className = CLS.panel + " " + CLS.panelTime;
    panel.setAttribute("role", "listbox");

    var toolbar = document.createElement("div");
    toolbar.className = CLS.toolbarTime;
    toolbar.innerHTML =
      toolbarBtnHtml("now", "Now", false) + (cfg.required ? "" : toolbarBtnHtml("clear", "Clear", false));
    panel.appendChild(toolbar);

    var list = document.createElement("div");
    list.className = CLS.timeList;
    panel.appendChild(list);

    cfg.segmentEl.appendChild(panel);

    var valueEl = trigger.querySelector(".pc-custom-dt-value");

    function renderList() {
      var sel = cfg.getValue();
      list.innerHTML = "";
      slots.forEach(function (t) {
        var item = document.createElement("button");
        item.type = "button";
        item.className = CLS.timeOption;
        item.setAttribute("role", "option");
        item.dataset.h = t.h;
        item.dataset.min = t.min;
        item.textContent = formatTimeDisplay(t);
        if (sel && sel.h === t.h && sel.min === t.min) item.classList.add("is-selected");
        list.appendChild(item);
      });
    }

    function sync() {
      var v = cfg.getValue();
      valueEl.textContent = v ? formatTimeDisplay(v) : cfg.placeholder || "Select time";
      trigger.classList.toggle("is-placeholder", !v);
    }

    list.addEventListener("click", function (event) {
      var opt = event.target.closest(".pc-custom-dt-time-option");
      if (!opt) return;
      cfg.setValue({ h: +opt.dataset.h, min: +opt.dataset.min });
      renderList(); // so the just-picked option shows as selected during the close fade, not just after the next open
      sync();
      oc.close();
      trigger.focus();
    });

    toolbar.addEventListener("click", function (event) {
      var actionBtn = event.target.closest("[data-action]");
      if (!actionBtn) return;
      if (actionBtn.dataset.action === "now") {
        var now = new Date();
        var rounded = (Math.round((now.getHours() * 60 + now.getMinutes()) / step) * step) % (24 * 60);
        cfg.setValue({ h: Math.floor(rounded / 60), min: rounded % 60 });
      } else {
        cfg.setValue(null);
      }
      renderList();
      sync();
      oc.close();
      trigger.focus();
    });

    var oc = makeOpenClose(cfg.segmentEl, trigger, panel, function () {
      renderList();
      var sel = cfg.getValue();
      var target = sel ? list.querySelector(".pc-custom-dt-time-option.is-selected") : null;
      if (!target) {
        var now = new Date();
        var idx = Math.round((now.getHours() * 60 + now.getMinutes()) / step);
        target = list.children[Math.min(idx, list.children.length - 1)];
      }
      if (target) target.scrollIntoView({ block: "center" });
    });

    renderList();
    sync();

    return { trigger: trigger, sync: sync };
  }

  // ---------------------------------------------------------------------
  // Wiring for the three native input types.
  // ---------------------------------------------------------------------
  function commonWrapperSetup(input, wrapperClass) {
    var wrapper = document.createElement("div");
    wrapper.className = wrapperClass;
    input.parentNode.insertBefore(wrapper, input);
    wrapper.appendChild(input);
    // The native input stays in the DOM (name/value/required all still
    // submit) but is made invisible and untouchable behind the trigger.
    input.classList.add("tw-absolute", "tw-inset-0", "tw-h-full", "tw-w-full", "tw-opacity-0", "tw-pointer-events-none");
    input.setAttribute("tabindex", "-1");
    input.setAttribute("aria-hidden", "true");
    return wrapper;
  }

  function labelFor(input) {
    var labelEl = input.id ? document.querySelector('label[for="' + input.id + '"]') : null;
    return labelEl ? labelEl.textContent.trim() : "";
  }

  function enhanceStandaloneDate(input) {
    var wrapper = commonWrapperSetup(input, "pc-custom-dt " + CLS.anchor);
    var picker = buildDatePicker({
      segmentEl: wrapper,
      getValue: function () {
        return parseDateValue(input.value);
      },
      setValue: function (ymd) {
        input.value = ymd ? formatDateValue(ymd) : "";
        input.dispatchEvent(new Event("change", { bubbles: true }));
      },
      getMin: function () {
        return parseDateValue(input.getAttribute("min"));
      },
      getMax: function () {
        return parseDateValue(input.getAttribute("max"));
      },
      required: input.required,
      quickYear: input.dataset.dtQuickYear === "1",
      yearsBack: input.dataset.dtYearsBack ? +input.dataset.dtYearsBack : 30,
      labelText: labelFor(input),
      placeholder: "Select date",
    });

    picker.trigger.disabled = input.disabled;
    wrapper.classList.toggle("is-disabled", input.disabled);
    input.addEventListener("change", picker.sync);
  }

  function enhanceStandaloneTime(input) {
    var wrapper = commonWrapperSetup(input, "pc-custom-dt " + CLS.anchor);
    var picker = buildTimePicker({
      segmentEl: wrapper,
      getValue: function () {
        return parseTimeValue(input.value);
      },
      setValue: function (hm) {
        input.value = hm ? formatTimeValue(hm) : "";
        input.dispatchEvent(new Event("change", { bubbles: true }));
      },
      required: input.required,
      step: input.dataset.dtStep ? +input.dataset.dtStep : 15,
      labelText: labelFor(input),
      placeholder: "Select time",
    });

    picker.trigger.disabled = input.disabled;
    wrapper.classList.toggle("is-disabled", input.disabled);
    input.addEventListener("change", picker.sync);
  }

  function compositeMinMaxDate(input, attrName) {
    var raw = input.getAttribute(attrName);
    if (!raw) return null;
    return parseDateValue(raw.split("T")[0]);
  }

  function enhanceDatetimeLocal(input) {
    var wrapper = commonWrapperSetup(input, "pc-custom-dt tw-relative");

    var split = document.createElement("div");
    split.className = "tw-flex tw-gap-2";
    wrapper.appendChild(split);

    // Each segment is its own anchor/group here (not the wrapper), so the
    // date half can be open while the time half stays closed.
    var dateSeg = document.createElement("div");
    dateSeg.className = CLS.segment;
    split.appendChild(dateSeg);

    var timeSeg = document.createElement("div");
    timeSeg.className = CLS.segment;
    split.appendChild(timeSeg);

    var labelBase = labelFor(input);

    function parseComposite(v) {
      if (!v) return { date: null, time: null };
      var parts = v.split("T");
      return { date: parseDateValue(parts[0]), time: parseTimeValue(parts[1] || "") };
    }

    var state = parseComposite(input.value);
    // A native datetime-local input can't hold just a date or just a time --
    // .value has to be the full "YYYY-MM-DDTHH:MM" or "". So while only one
    // half of `state` is picked, commit() below writes "" to the input,
    // which would otherwise round-trip straight back through the "change"
    // listener a few lines down and reparse that "" over the in-memory
    // `state`, wiping out the half that *was* just picked before the other
    // half ever gets a chance to join it. This flag tells that listener to
    // skip reparsing for the "change" event we dispatch ourselves here,
    // while still picking up any genuinely external change to the input.
    var internalChange = false;

    function commit() {
      input.value = state.date && state.time ? formatDateValue(state.date) + "T" + formatTimeValue(state.time) : "";
      internalChange = true;
      input.dispatchEvent(new Event("change", { bubbles: true }));
      internalChange = false;
    }

    var datePicker = buildDatePicker({
      segmentEl: dateSeg,
      getValue: function () {
        return state.date;
      },
      setValue: function (ymd) {
        state.date = ymd;
        commit();
      },
      getMin: function () {
        return compositeMinMaxDate(input, "min");
      },
      getMax: function () {
        return compositeMinMaxDate(input, "max");
      },
      required: input.required,
      quickYear: input.dataset.dtQuickYear === "1",
      yearsBack: input.dataset.dtYearsBack ? +input.dataset.dtYearsBack : 30,
      labelText: labelBase ? labelBase + " – date" : "",
      placeholder: "Select date",
    });

    var timePicker = buildTimePicker({
      segmentEl: timeSeg,
      getValue: function () {
        return state.time;
      },
      setValue: function (hm) {
        state.time = hm;
        commit();
      },
      required: input.required,
      step: input.dataset.dtStep ? +input.dataset.dtStep : 15,
      labelText: labelBase ? labelBase + " – time" : "",
      placeholder: "Select time",
    });

    datePicker.trigger.disabled = input.disabled;
    timePicker.trigger.disabled = input.disabled;
    dateSeg.classList.toggle("is-disabled", input.disabled);
    timeSeg.classList.toggle("is-disabled", input.disabled);

    input.addEventListener("change", function () {
      if (internalChange) return;
      state = parseComposite(input.value);
      datePicker.sync();
      timePicker.sync();
    });
  }

  function enhanceOne(input) {
    if (input.dataset.pcEnhanced) return;
    input.dataset.pcEnhanced = "1";
    if (input.type === "date") enhanceStandaloneDate(input);
    else if (input.type === "time") enhanceStandaloneTime(input);
    else if (input.type === "datetime-local") enhanceDatetimeLocal(input);
  }

  function init() {
    document.querySelectorAll("input.pc-custom-datetime-enhance").forEach(enhanceOne);
  }

  if (document.readyState !== "loading") {
    init();
  } else {
    document.addEventListener("DOMContentLoaded", init);
  }

  window.pcCustomDatetimeCleanup = function () {
    teardownFns.forEach(function (fn) {
      fn();
    });
    teardownFns = [];
  };
})();
