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
 * orange focus ring, peach hover) as the .pc-custom-select* dropdown in
 * custom-select.js, so the two feel like one consistent design system --
 * see the .pc-custom-dt* rules in components.css.
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

  // ---------------------------------------------------------------------
  // Calendar (date) picker. cfg: { segmentEl, getValue, setValue, getMin,
  // getMax, required, quickYear, yearsBack, labelText, placeholder }
  // ---------------------------------------------------------------------
  function buildDatePicker(cfg) {
    var trigger = document.createElement("button");
    trigger.type = "button";
    trigger.className = "form-control pc-custom-dt-trigger d-flex align-items-center w-100 text-start";
    trigger.setAttribute("aria-haspopup", "dialog");
    trigger.setAttribute("aria-expanded", "false");
    if (cfg.labelText) trigger.setAttribute("aria-label", cfg.labelText);
    trigger.innerHTML =
      '<i class="bi bi-calendar3 pc-custom-dt-icon flex-shrink-0" aria-hidden="true"></i>' +
      '<span class="pc-custom-dt-value overflow-hidden text-nowrap"></span>';
    cfg.segmentEl.appendChild(trigger);

    var panel = document.createElement("div");
    panel.className = "pc-custom-dt-panel position-absolute rounded-4 pc-custom-dt-panel--calendar";
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
      var html =
        '<div class="d-flex align-items-center justify-content-between mb-2">' +
        '<button type="button" class="pc-custom-dt-nav-btn d-flex align-items-center justify-content-center border-0" data-nav="prev" aria-label="Previous month"><i class="bi bi-chevron-left"></i></button>' +
        '<button type="button" class="pc-custom-dt-nav-title border-0" data-nav="title">' +
        MONTH_NAMES[viewMonth] +
        " " +
        viewYear +
        "</button>" +
        '<button type="button" class="pc-custom-dt-nav-btn d-flex align-items-center justify-content-center border-0" data-nav="next" aria-label="Next month"><i class="bi bi-chevron-right"></i></button>' +
        "</div>";

      html +=
        '<div class="pc-custom-dt-weekdays d-grid text-center text-uppercase">' +
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

      html += '<div class="pc-custom-dt-days d-grid">';
      cells.forEach(function (c) {
        var ymd = { y: c.y, m: c.m, d: c.d };
        var classes = ["pc-custom-dt-day", "d-flex", "align-items-center", "justify-content-center"];
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

      var todayDisabled = isDisabledDay(today);
      html +=
        '<div class="pc-custom-dt-toolbar d-flex align-items-center justify-content-between gap-2">' +
        '<button type="button" class="pc-custom-dt-toolbar-btn border-0 bg-transparent text-primary" data-action="today"' +
        (todayDisabled ? " disabled" : "") +
        ">Today</button>" +
        (cfg.required ? "" : '<button type="button" class="pc-custom-dt-toolbar-btn border-0 bg-transparent text-primary" data-action="clear">Clear</button>') +
        "</div>";

      panel.innerHTML = html;
    }

    function renderMonths() {
      var sel = cfg.getValue();
      var html =
        '<div class="d-flex align-items-center justify-content-between mb-2">' +
        '<button type="button" class="pc-custom-dt-nav-btn d-flex align-items-center justify-content-center border-0" data-nav="prev" aria-label="Previous year"><i class="bi bi-chevron-left"></i></button>' +
        '<button type="button" class="pc-custom-dt-nav-title border-0" data-nav="title">' +
        viewYear +
        "</button>" +
        '<button type="button" class="pc-custom-dt-nav-btn d-flex align-items-center justify-content-center border-0" data-nav="next" aria-label="Next year"><i class="bi bi-chevron-right"></i></button>' +
        "</div>";
      html += '<div class="pc-custom-dt-months">';
      MONTH_SHORT.forEach(function (name, idx) {
        var classes = ["pc-custom-dt-month-cell"];
        if (sel && sel.y === viewYear && sel.m === idx) classes.push("is-selected");
        if (today.y === viewYear && today.m === idx) classes.push("is-today");
        html += '<button type="button" class="' + classes.join(" ") + '" data-month="' + idx + '">' + name + "</button>";
      });
      html += "</div>";
      panel.innerHTML = html;
    }

    function renderYears() {
      var sel = cfg.getValue();
      var html =
        '<div class="d-flex align-items-center justify-content-between mb-2">' +
        '<button type="button" class="pc-custom-dt-nav-btn d-flex align-items-center justify-content-center border-0" data-nav="prev" aria-label="Previous years"><i class="bi bi-chevron-left"></i></button>' +
        '<button type="button" class="pc-custom-dt-nav-title border-0" data-nav="title">' +
        yearsBlockStart +
        "–" +
        (yearsBlockStart + 11) +
        "</button>" +
        '<button type="button" class="pc-custom-dt-nav-btn d-flex align-items-center justify-content-center border-0" data-nav="next" aria-label="Next years"><i class="bi bi-chevron-right"></i></button>' +
        "</div>";
      html += '<div class="pc-custom-dt-years">';
      for (var i = 0; i < 12; i++) {
        var y = yearsBlockStart + i;
        var classes = ["pc-custom-dt-year-cell"];
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
    trigger.className = "form-control pc-custom-dt-trigger d-flex align-items-center w-100 text-start";
    trigger.setAttribute("aria-haspopup", "listbox");
    trigger.setAttribute("aria-expanded", "false");
    if (cfg.labelText) trigger.setAttribute("aria-label", cfg.labelText);
    trigger.innerHTML =
      '<i class="bi bi-clock pc-custom-dt-icon flex-shrink-0" aria-hidden="true"></i>' +
      '<span class="pc-custom-dt-value overflow-hidden text-nowrap"></span>';
    cfg.segmentEl.appendChild(trigger);

    var panel = document.createElement("div");
    panel.className = "pc-custom-dt-panel position-absolute rounded-4 pc-custom-dt-panel--time";
    panel.setAttribute("role", "listbox");

    var toolbar = document.createElement("div");
    toolbar.className = "pc-custom-dt-toolbar d-flex align-items-center justify-content-between gap-2";
    toolbar.innerHTML =
      '<button type="button" class="pc-custom-dt-toolbar-btn border-0 bg-transparent text-primary" data-action="now">Now</button>' +
      (cfg.required ? "" : '<button type="button" class="pc-custom-dt-toolbar-btn border-0 bg-transparent text-primary" data-action="clear">Clear</button>');
    panel.appendChild(toolbar);

    var list = document.createElement("div");
    list.className = "pc-custom-dt-timelist overflow-y-auto";
    panel.appendChild(list);

    cfg.segmentEl.appendChild(panel);

    var valueEl = trigger.querySelector(".pc-custom-dt-value");

    function renderList() {
      var sel = cfg.getValue();
      list.innerHTML = "";
      slots.forEach(function (t) {
        var item = document.createElement("button");
        item.type = "button";
        item.className = "pc-custom-dt-time-option d-block w-100 text-start border-0";
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
    input.classList.add("pc-custom-dt-native", "position-absolute", "w-100", "h-100");
    input.setAttribute("tabindex", "-1");
    input.setAttribute("aria-hidden", "true");
    return wrapper;
  }

  function labelFor(input) {
    var labelEl = input.id ? document.querySelector('label[for="' + input.id + '"]') : null;
    return labelEl ? labelEl.textContent.trim() : "";
  }

  function enhanceStandaloneDate(input) {
    var wrapper = commonWrapperSetup(input, "pc-custom-dt position-relative pc-custom-dt--date pc-custom-dt-anchor");
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
    var wrapper = commonWrapperSetup(input, "pc-custom-dt position-relative pc-custom-dt--time pc-custom-dt-anchor");
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
    var wrapper = commonWrapperSetup(input, "pc-custom-dt position-relative pc-custom-dt--datetime");

    var split = document.createElement("div");
    split.className = "d-flex gap-2";
    wrapper.appendChild(split);

    var dateSeg = document.createElement("div");
    dateSeg.className = "pc-custom-dt-segment position-relative pc-custom-dt-anchor";
    split.appendChild(dateSeg);

    var timeSeg = document.createElement("div");
    timeSeg.className = "pc-custom-dt-segment position-relative pc-custom-dt-anchor";
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
