
if (window.pcCustomSelectCleanup) {
  window.pcCustomSelectCleanup();
  window.pcCustomSelectCleanup = null;
}

(function () {
  var teardownFns = [];

var OPTION_ICONS = {
"one-way":
      '<circle cx="5" cy="12" r="2.2" fill="currentColor"/>' +
      '<path d="M9 12h8.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>' +
      '<path d="M14.5 9l3.5 3-3.5 3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',

    "return":
      '<path d="M4.5 9h11" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>' +
      '<path d="M12.8 6l2.9 3-2.9 3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>' +
      '<path d="M19.5 15h-11" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>' +
      '<path d="M11.2 12l-2.9 3 2.9 3" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>',
  };

function renderOptionInto(el, opt) {
    el.textContent = "";
    var key = opt.getAttribute("data-icon");
    var svg = key && Object.prototype.hasOwnProperty.call(OPTION_ICONS, key) ? OPTION_ICONS[key] : null;
    if (svg) {
      var icon = document.createElement("span");
      icon.className = "tw-inline-flex tw-shrink-0 tw-items-center tw-text-current";
      icon.setAttribute("aria-hidden", "true");
      icon.innerHTML =
        '<svg class="tw-h-[1.15rem] tw-w-[1.15rem]" viewBox="0 0 24 24" fill="none" aria-hidden="true">' + svg + "</svg>";
      el.appendChild(icon);
    }
    var text = document.createElement("span");
    text.className = "tw-min-w-0 tw-overflow-hidden tw-text-ellipsis tw-whitespace-nowrap";
    text.appendChild(document.createTextNode(opt.textContent.trim()));
    el.appendChild(text);
  }

  function enhanceOne(select) {
    if (select.dataset.pcEnhanced) return;
    select.dataset.pcEnhanced = "1";

    var wrapper = document.createElement("div");
    wrapper.className = "tw-group tw-relative";
    select.parentNode.insertBefore(wrapper, select);
    wrapper.appendChild(select);

select.classList.add("tw-absolute", "tw-inset-0", "tw-h-full", "tw-w-full", "tw-opacity-0", "tw-pointer-events-none");
    select.setAttribute("tabindex", "-1");
    select.setAttribute("aria-hidden", "true");

    var labelEl = select.id ? document.querySelector('label[for="' + select.id + '"]') : null;
    var labelText = labelEl ? labelEl.textContent.trim() : "";

    var trigger = document.createElement("button");
    trigger.type = "button";
    trigger.className =
      "tw-flex tw-w-full tw-appearance-none tw-items-center tw-justify-between tw-gap-2 tw-rounded-md tw-border " +
      "tw-border-solid tw-border-[#dee2e6] tw-bg-white tw-px-3 tw-py-1.5 tw-text-left tw-text-base tw-leading-normal " +
      "tw-text-ink tw-cursor-pointer tw-outline-none tw-transition-colors tw-duration-200 " +
      "focus-visible:tw-border-powerlight group-[.is-open]:tw-border-powerlight " +
      "group-[.is-disabled]:tw-cursor-not-allowed group-[.is-disabled]:tw-opacity-[0.65]";
    trigger.setAttribute("aria-haspopup", "listbox");
    trigger.setAttribute("aria-expanded", "false");
    if (labelText) trigger.setAttribute("aria-label", labelText);
    trigger.innerHTML =

      '<span class="pc-custom-select-value tw-flex tw-min-w-0 tw-items-center tw-gap-2.5 ' +
      '[.is-placeholder_&]:tw-text-ink/[0.65]"></span>' +
      '<svg class="tw-h-3.5 tw-w-3.5 tw-shrink-0 tw-text-ink/[0.65] tw-transition-transform ' +
      'tw-duration-200 group-[.is-open]:tw-rotate-180 motion-reduce:tw-transition-none" ' +
      'viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" ' +
      'stroke-linejoin="round" aria-hidden="true"><path d="M3 6l5 5 5-5"/></svg>';
    wrapper.appendChild(trigger);

    var panel = document.createElement("div");
    panel.className =
      "tw-invisible tw-absolute tw-inset-x-0 tw-top-[calc(100%+6px)] tw-z-20 tw-max-h-60 tw-overflow-y-auto " +
      "tw-rounded-2xl tw-border tw-border-solid tw-border-black/10 tw-bg-white tw-p-1.5 " +
      "tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] tw-opacity-0 -tw-translate-y-1.5 tw-transition tw-duration-200 " +
      "tw-ease-[cubic-bezier(0.16,1,0.3,1)] group-[.is-open]:tw-visible group-[.is-open]:tw-translate-y-0 " +
      "group-[.is-open]:tw-opacity-100 motion-reduce:tw-transition-none";
    panel.setAttribute("role", "listbox");
    wrapper.appendChild(panel);

    var valueEl = trigger.querySelector(".pc-custom-select-value");

    function selectableOptions() {
      return Array.prototype.filter.call(select.options, function (opt) {
        return !opt.disabled;
      });
    }

    function buildOptions() {
      panel.innerHTML = "";
      selectableOptions().forEach(function (opt) {
        var item = document.createElement("div");
        item.className =
          "pc-custom-select-option tw-flex tw-items-center tw-gap-2.5 tw-cursor-pointer tw-rounded-[10px] tw-px-3 tw-py-[0.55rem] tw-text-[0.95rem] " +
          "tw-text-ink tw-transition-colors tw-duration-150 hover:tw-bg-[#fbe4cf] hover:tw-text-power " +
          "[&.is-selected]:tw-font-semibold [&.is-selected]:tw-text-power";
        item.setAttribute("role", "option");
        item.dataset.value = opt.value;
        renderOptionInto(item, opt);
        item.addEventListener("click", function () {
          select.value = opt.value;
          select.dispatchEvent(new Event("change", { bubbles: true }));
          closePanel();
          trigger.focus();
        });
        panel.appendChild(item);
      });
      syncFromSelect();
    }

    function syncFromSelect() {
      var opt = select.options[select.selectedIndex];
      if (opt) {
        renderOptionInto(valueEl, opt);
      } else {
        valueEl.textContent = "";
      }
      trigger.classList.toggle("is-placeholder", !opt || opt.disabled);
      Array.prototype.forEach.call(panel.children, function (item) {
        item.classList.toggle("is-selected", item.dataset.value === select.value);
      });
      trigger.disabled = select.disabled;
      wrapper.classList.toggle("is-disabled", select.disabled);
    }

    function onDocClick(event) {
      if (!wrapper.contains(event.target)) closePanel();
    }

    function onKeydown(event) {
      if (event.key === "Escape") {
        closePanel();
        trigger.focus();
      }
    }

    function openPanel() {
      if (select.disabled || wrapper.classList.contains("is-open")) return;
      wrapper.classList.add("is-open");
      trigger.setAttribute("aria-expanded", "true");
      document.addEventListener("click", onDocClick, true);
      document.addEventListener("keydown", onKeydown, true);
    }

    function closePanel() {
      wrapper.classList.remove("is-open");
      trigger.setAttribute("aria-expanded", "false");
      document.removeEventListener("click", onDocClick, true);
      document.removeEventListener("keydown", onKeydown, true);
    }

    trigger.addEventListener("click", function () {
      if (wrapper.classList.contains("is-open")) {
        closePanel();
      } else {
        openPanel();
      }
    });

trigger.addEventListener("keydown", function (event) {
      if (event.key !== "ArrowDown" && event.key !== "ArrowUp") return;
      event.preventDefault();

      if (!wrapper.classList.contains("is-open")) {
        openPanel();
        return;
      }

      var options = selectableOptions();
      if (!options.length) return;
      var currentIndex = options.findIndex(function (opt) {
        return opt.value === select.value;
      });
      var nextIndex =
        event.key === "ArrowDown" ? Math.min(currentIndex + 1, options.length - 1) : Math.max(currentIndex - 1, 0);
      if (currentIndex === -1) nextIndex = 0;

      select.value = options[nextIndex].value;
      select.dispatchEvent(new Event("change", { bubbles: true }));
    });

select.addEventListener("change", syncFromSelect);
    var observer = new MutationObserver(syncFromSelect);
    observer.observe(select, { attributes: true, attributeFilter: ["disabled"] });

    buildOptions();

    teardownFns.push(function () {
      closePanel();
      observer.disconnect();
    });
  }

  function init() {
    document.querySelectorAll("select.pc-custom-select-enhance").forEach(enhanceOne);
  }

  if (document.readyState !== "loading") {
    init();
  } else {
    document.addEventListener("DOMContentLoaded", init);
  }

  window.pcCustomSelectCleanup = function () {
    teardownFns.forEach(function (fn) {
      fn();
    });
    teardownFns = [];
  };
})();
