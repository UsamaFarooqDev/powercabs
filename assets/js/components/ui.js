/**
 * The two Bootstrap JS components the site actually used -- Collapse
 * (FAQ accordions) and Modal (City Tours booking, Ride quick-book) --
 * reimplemented in ~150 lines so Bootstrap's bundle can be dropped.
 *
 * The public surface is deliberately the same shape Bootstrap exposed, so
 * the page scripts that drive modals (city-tours.js, ride-fare-estimate.js)
 * read the same way:
 *
 *   window.pcModal.getOrCreateInstance(el).show() / .hide()
 *   window.pcModal.getInstance(el)
 *
 * and modals dispatch "pc.modal.show" / "pc.modal.shown" / "pc.modal.hidden"
 * events in place of Bootstrap's show.bs.modal / shown.bs.modal.
 *
 * Both are wired declaratively from data attributes, so markup keeps working
 * without per-page glue:
 *   [data-pc-collapse][data-pc-target="#id"]  toggles a panel
 *   [data-pc-collapse-parent="#accordionId"]  makes it exclusive within that
 *   [data-pc-collapse-media="(max-width: 767.98px)"]  only collapsible there
 *   [data-pc-modal-open="#id"] / [data-pc-modal-close]
 *
 * Panels animate on max-height, measured per open, so the markup never has
 * to declare a fixed height.
 */
(function () {
  var OPEN = "is-open";

  // ---------------------------------------------------------------- collapse
  function panelIsOpen(panel) {
    return panel.classList.contains(OPEN);
  }

  /**
   * A panel can opt into being collapsible only inside a media query --
   * data-pc-collapse-media="(max-width: 767.98px)" on the footer's four link
   * groups, which are an accordion on a phone and four plain columns from md
   * up. Outside its query the panel is left completely alone: no inline
   * max-height, no toggling.
   *
   * Doing it here rather than with a CSS override matters. primeCollapsePanels
   * writes max-height as an INLINE style, and an inline style outranks any
   * normal stylesheet rule -- so a desktop `max-h-none` utility would lose and
   * the footer's links would render as four empty headings. Only !important
   * could beat it, which is a fragile thing to hang a whole footer on.
   */
  function collapseIsActive(panel) {
    var media = panel.getAttribute("data-pc-collapse-media");
    return !media || window.matchMedia(media).matches;
  }

  function openPanel(panel) {
    panel.classList.add(OPEN);
    panel.style.maxHeight = panel.scrollHeight + "px";
    // Once the transition has run, drop the fixed height so nested content
    // (a form that grows, an image that loads late) can still expand it.
    window.setTimeout(function () {
      if (panelIsOpen(panel)) panel.style.maxHeight = "none";
    }, 320);
  }

  function closePanel(panel) {
    // From "none" the browser has nothing to animate from, so pin the
    // current height for a frame first.
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

    // Accordion behavior: opening one closes its siblings.
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
    // Outside its media query the panel is permanently open and the toggle is
    // display:none anyway -- but a keyboard or AT click could still land here.
    if (!collapseIsActive(panel)) return;
    event.preventDefault();
    togglePanel(panel, panel.getAttribute("data-pc-collapse-parent"));
  });

  /** Sets each panel's starting height so the first toggle animates. */
  function primeCollapsePanels() {
    document.querySelectorAll("[data-pc-collapse-panel]").forEach(function (panel) {
      if (!collapseIsActive(panel)) {
        // Hand the height back to the stylesheet. Clearing rather than
        // leaving a stale "0px" behind is the whole point: this also runs on
        // resize, so a panel collapsed on a phone re-opens when the window
        // grows past the breakpoint.
        panel.style.maxHeight = "";
        return;
      }
      panel.style.maxHeight = panelIsOpen(panel) ? "none" : "0px";
    });
  }

  // Re-prime across a breakpoint change. Open panels keep their "none", so a
  // phone's address bar hiding (which fires resize) never snaps one shut.
  var repriseTimer = null;
  window.addEventListener("resize", function () {
    window.clearTimeout(repriseTimer);
    repriseTimer = window.setTimeout(primeCollapsePanels, 150);
  });

  // ------------------------------------------------------------------- modal
  var openModals = [];

  function PcModal(el) {
    this.el = el;
    this.backdrop = null;
    this.lastFocus = null;
  }

  /**
   * @param {Element} [opener] The element that triggered the open, surfaced on
   *   the pc.modal.show event as `relatedTarget` (and in `detail`). Listeners
   *   need it to populate a modal from the clicked item -- city-tours.js reads
   *   the destination's name/description/duration/image off the button's data
   *   attributes. Bootstrap's Modal supplied this on show.bs.modal; when this
   *   helper replaced it the property was dropped, so that listener's
   *   `if (!button) return;` guard fired on every open and the tour modal
   *   showed empty fields and a blank image. Keep passing it.
   */
  PcModal.prototype.show = function (opener) {
    if (openModals.indexOf(this) !== -1) return;
    var self = this;
    var showEvent = new CustomEvent("pc.modal.show", {
      bubbles: true,
      detail: { relatedTarget: opener || null },
    });
    // Mirrored as a plain property so listeners can read event.relatedTarget,
    // the same shape Bootstrap used.
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

    // One frame so the transition has a starting value to animate from.
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
        // Pass the opener through -- see PcModal.prototype.show.
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

  // Keep a dialog's own scroll independent of the page behind it.
  window.pcInitUi = primeCollapsePanels;

  if (document.readyState !== "loading") {
    primeCollapsePanels();
  } else {
    document.addEventListener("DOMContentLoaded", primeCollapsePanels);
  }
})();
