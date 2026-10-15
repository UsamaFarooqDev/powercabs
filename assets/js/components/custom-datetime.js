
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

var CLS = {
trigger:
      "tw-flex tw-w-full tw-appearance-none tw-items-center tw-gap-[0.55rem] tw-rounded-md tw-border " +
      "tw-border-solid tw-border-[#dee2e6] tw-bg-white tw-px-3 tw-py-1.5 tw-text-left tw-text-base " +
      "tw-leading-normal tw-text-ink tw-cursor-pointer tw-outline-none tw-transition-colors tw-duration-200 " +
      "focus-visible:tw-border-powerlight group-[.is-open]:tw-border-powerlight " +
      "group-[.is-disabled]:tw-cursor-not-allowed group-[.is-disabled]:tw-opacity-[0.65]",

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

    anchor: "tw-group tw-relative",
    segment: "tw-group tw-relative tw-min-w-0 tw-flex-1",
  };

  function pad2(n) {
    return n < 10 ? "0" + n : "" + n;
  }

function daysInMonth(y, m) {
    return new Date(y, m + 1, 0).getDate();
  }

  function firstWeekdayMonIndex(y, m) {
    var jsDay = new Date(y, m, 1).getDay();
    return (jsDay + 6) % 7;
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
        render();
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
      renderList();
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

function commonWrapperSetup(input, wrapperClass) {
    var wrapper = document.createElement("div");
    wrapper.className = wrapperClass;
    input.parentNode.insertBefore(wrapper, input);
    wrapper.appendChild(input);

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
