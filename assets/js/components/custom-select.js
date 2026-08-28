/**
 * Progressive-enhancement custom dropdown. Wraps every <select
 * class="pc-custom-select-enhance"> with a styled trigger button + option
 * panel, while leaving the original <select> in the DOM -- same id, name,
 * value, required and disabled behavior as before, just made invisible and
 * non-interactive (pointer-events: none, tabindex -1) so nothing else on
 * the page (backend validation, a show/hide toggle, a fare-lookup script,
 * whatever) has to know or care that the visible control is no longer a
 * native <select>.
 *
 * This is a generic, page-agnostic component -- nothing here or in the
 * .pc-custom-select* rules in components.css is specific to meet-greet.php,
 * which is just the first page using it. To reuse it on another form:
 *
 *   1. Add class="pc-custom-select-enhance" to any <select class="form-select">.
 *      Its <option>s, id, name, required/disabled attributes, and any
 *      "selected" value all carry over automatically -- no markup changes
 *      needed beyond that one class.
 *   2. Load this script on that page (see meet-greet.php's own <script
 *      src="...custom-select.js"> tag for the exact include, with the same
 *      filemtime() cache-busting convention as the rest of the site).
 *
 * That's the whole integration -- nothing to configure, no separate PHP
 * template to keep in sync with each form's own field list.
 */
if (window.pcCustomSelectCleanup) {
  window.pcCustomSelectCleanup();
  window.pcCustomSelectCleanup = null;
}

(function () {
  var teardownFns = [];

  function enhanceOne(select) {
    if (select.dataset.pcEnhanced) return;
    select.dataset.pcEnhanced = "1";

    var wrapper = document.createElement("div");
    wrapper.className = "pc-custom-select position-relative";
    select.parentNode.insertBefore(wrapper, select);
    wrapper.appendChild(select);

    select.classList.add("pc-custom-select-native", "position-absolute", "w-100", "h-100");
    select.setAttribute("tabindex", "-1");
    select.setAttribute("aria-hidden", "true");

    var labelEl = select.id ? document.querySelector('label[for="' + select.id + '"]') : null;
    var labelText = labelEl ? labelEl.textContent.trim() : "";

    var trigger = document.createElement("button");
    trigger.type = "button";
    trigger.className = "form-select pc-custom-select-trigger d-flex align-items-center justify-content-between gap-2 w-100 text-start";
    trigger.setAttribute("aria-haspopup", "listbox");
    trigger.setAttribute("aria-expanded", "false");
    if (labelText) trigger.setAttribute("aria-label", labelText);
    trigger.innerHTML =
      '<span class="pc-custom-select-value overflow-hidden text-nowrap"></span>' +
      '<i class="bi bi-chevron-down pc-custom-select-caret flex-shrink-0" aria-hidden="true"></i>';
    wrapper.appendChild(trigger);

    var panel = document.createElement("div");
    panel.className = "pc-custom-select-panel position-absolute overflow-y-auto rounded-4";
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
        item.className = "pc-custom-select-option";
        item.setAttribute("role", "option");
        item.dataset.value = opt.value;
        item.textContent = opt.textContent.trim();
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
      valueEl.textContent = opt ? opt.textContent.trim() : "";
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

    // Arrow keys move the selection directly, opening the panel first if
    // it wasn't already -- a plain <button> already activates on Enter/
    // Space via its native click behavior, so that needs no extra code.
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

    // Keeps the custom UI in sync whenever the underlying select's value or
    // disabled state changes from elsewhere -- either a pick made here, or
    // this page's own Pickup/Dropoff logic setting .value/.disabled
    // directly on the select and dispatching "change" itself.
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
