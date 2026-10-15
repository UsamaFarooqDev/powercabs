
(function () {
  var OPEN = "is-open";

function panelIsOpen(panel) {
    return panel.classList.contains(OPEN);
  }

function collapseIsActive(panel) {
    var media = panel.getAttribute("data-pc-collapse-media");
    return !media || window.matchMedia(media).matches;
  }

  function openPanel(panel) {
    panel.classList.add(OPEN);
    panel.style.maxHeight = panel.scrollHeight + "px";

    window.setTimeout(function () {
      if (panelIsOpen(panel)) panel.style.maxHeight = "none";
    }, 320);
  }

  function closePanel(panel) {
panel.style.maxHeight = panel.scrollHeight + "px";
    void panel.offsetHeight;
    panel.classList.remove(OPEN);
    panel.style.maxHeight = "0px";
  }

  function setToggleState(panel, open) {
    document.querySelectorAll('[data-pc-collapse][data-pc-target="#' + panel.id + '"]').forEach(function (btn) {
      btn.setAttribute("aria-expanded", open ? "true" : "false");
    });
  }

  function togglePanel(panel, parentSelector) {
    var willOpen = !panelIsOpen(panel);

if (willOpen && parentSelector) {
      var parent = document.querySelector(parentSelector);
      if (parent) {
        parent.querySelectorAll('[data-pc-collapse-parent="' + parentSelector + '"]').forEach(function (sibling) {
          if (sibling !== panel && panelIsOpen(sibling)) {
            closePanel(sibling);
            setToggleState(sibling, false);
          }
        });
      }
    }

    if (willOpen) openPanel(panel);
    else closePanel(panel);
    setToggleState(panel, willOpen);
  }

  document.addEventListener("click", function (event) {
    var btn = event.target.closest("[data-pc-collapse]");
    if (!btn) return;
    var panel = document.querySelector(btn.getAttribute("data-pc-target") || "");
    if (!panel) return;

    if (!collapseIsActive(panel)) return;
    event.preventDefault();
    togglePanel(panel, panel.getAttribute("data-pc-collapse-parent"));
  });

function primeCollapsePanels() {
    document.querySelectorAll("[data-pc-collapse-panel]").forEach(function (panel) {
      if (!collapseIsActive(panel)) {
panel.style.maxHeight = "";
        return;
      }
      panel.style.maxHeight = panelIsOpen(panel) ? "none" : "0px";
    });
  }

var repriseTimer = null;
  window.addEventListener("resize", function () {
    window.clearTimeout(repriseTimer);
    repriseTimer = window.setTimeout(primeCollapsePanels, 150);
  });

var openModals = [];

  function PcModal(el) {
    this.el = el;
    this.backdrop = null;
    this.lastFocus = null;
  }

PcModal.prototype.show = function (opener) {
    if (openModals.indexOf(this) !== -1) return;
    var self = this;
    var showEvent = new CustomEvent("pc.modal.show", {
      bubbles: true,
      detail: { relatedTarget: opener || null },
    });

    showEvent.relatedTarget = opener || null;
    this.el.dispatchEvent(showEvent);

    this.lastFocus = document.activeElement;

    this.backdrop = document.createElement("div");
    this.backdrop.className =
      "tw-fixed tw-inset-0 tw-z-[1054] tw-bg-black/50 tw-opacity-0 tw-transition-opacity tw-duration-200";
    document.body.appendChild(this.backdrop);

    this.el.classList.remove("tw-hidden");
    this.el.setAttribute("aria-modal", "true");
    this.el.removeAttribute("aria-hidden");
    document.body.style.overflow = "hidden";

requestAnimationFrame(function () {
      self.backdrop.classList.add("tw-opacity-100");
      self.el.classList.add(OPEN);
    });

    openModals.push(this);

    var focusable = this.el.querySelector(
      "input:not([type=hidden]):not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), a[href]"
    );
    if (focusable) {
      window.setTimeout(function () {
        focusable.focus();
        self.el.dispatchEvent(new CustomEvent("pc.modal.shown", { bubbles: true }));
      }, 60);
    } else {
      this.el.dispatchEvent(new CustomEvent("pc.modal.shown", { bubbles: true }));
    }

    this.backdrop.addEventListener("click", function () {
      self.hide();
    });
  };

  PcModal.prototype.hide = function () {
    var self = this;
    var idx = openModals.indexOf(this);
    if (idx === -1) return;
    openModals.splice(idx, 1);

    this.el.classList.remove(OPEN);
    if (this.backdrop) this.backdrop.classList.remove("tw-opacity-100");

    window.setTimeout(function () {
      self.el.classList.add("tw-hidden");
      self.el.setAttribute("aria-hidden", "true");
      self.el.removeAttribute("aria-modal");
      if (self.backdrop) {
        self.backdrop.remove();
        self.backdrop = null;
      }
      if (!openModals.length) document.body.style.overflow = "";
      if (self.lastFocus && self.lastFocus.focus) self.lastFocus.focus();
      self.el.dispatchEvent(new CustomEvent("pc.modal.hidden", { bubbles: true }));
    }, 200);
  };

  var registry = new WeakMap();
  window.pcModal = {
    getOrCreateInstance: function (el) {
      if (!el) return null;
      if (!registry.has(el)) registry.set(el, new PcModal(el));
      return registry.get(el);
    },
    getInstance: function (el) {
      return el && registry.has(el) ? registry.get(el) : null;
    },
  };

  document.addEventListener("click", function (event) {
    var opener = event.target.closest("[data-pc-modal-open]");
    if (opener) {
      var target = document.querySelector(opener.getAttribute("data-pc-modal-open") || "");
      if (target) {
        event.preventDefault();

        window.pcModal.getOrCreateInstance(target).show(opener);
      }
      return;
    }

    var closer = event.target.closest("[data-pc-modal-close]");
    if (closer) {
      var modalEl = closer.closest("[data-pc-modal]");
      if (modalEl) {
        event.preventDefault();
        var inst = window.pcModal.getInstance(modalEl);
        if (inst) inst.hide();
      }
    }
  });

  document.addEventListener("keydown", function (event) {
    if (event.key !== "Escape" || !openModals.length) return;
    openModals[openModals.length - 1].hide();
  });

window.pcInitUi = primeCollapsePanels;

  if (document.readyState !== "loading") {
    primeCollapsePanels();
  } else {
    document.addEventListener("DOMContentLoaded", primeCollapsePanels);
  }
})();
