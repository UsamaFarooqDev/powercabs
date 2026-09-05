document.addEventListener("DOMContentLoaded", () => {
  highlightActiveNavLink();
  initNavToggle();
  initMegaMenus();
  initMegaMenuNestedToggle();
  syncNavbarHeightVar();
  syncFooterHeightVar();
  initHeroParallax();
  initWhyChooseReveal();
  initScrollReveal();
  initScrollIndicator();
});

window.addEventListener("resize", syncNavbarHeightVar);
window.addEventListener("resize", syncFooterHeightVar);
window.addEventListener("load", syncFooterHeightVar);

function highlightActiveNavLink() {
  // URLs are served without a ".php" extension, but data-page attributes may
  // still carry one -- strip it from both sides so the comparison works
  // regardless of which form either side happens to be in.
  const stripPhp = (value) => value.replace(/\.php$/i, "");
  const currentPath = stripPhp(window.location.pathname.split("/").pop() || "") || "index";

  // The nav bar lives outside <main> and survives every PJAX swap, so any
  // "active" state left over from a previous page has to be cleared first --
  // otherwise it just accumulates, one extra "active" link per navigation.
  document.querySelectorAll(".navbar-nav .nav-link[data-page]").forEach((link) => {
    const isActive = stripPhp(link.dataset.page) === currentPath;
    link.classList.toggle("active", isActive);
    if (isActive) {
      link.setAttribute("aria-current", "page");
    } else {
      link.removeAttribute("aria-current");
    }
  });
}

/**
 * Mobile nav panel. Replaces Bootstrap's Collapse: #pcNavToggle flips
 * `is-open` on #mainNav and its own aria-expanded (which the hamburger's
 * three bars animate off, via group-aria-expanded: variants).
 */
function initNavToggle() {
  const toggle = document.getElementById("pcNavToggle");
  const panel = document.getElementById("mainNav");
  if (!toggle || !panel) return;
  if (toggle.dataset.pcBound) return;
  toggle.dataset.pcBound = "1";

  toggle.addEventListener("click", () => {
    const open = panel.classList.toggle("is-open");
    toggle.setAttribute("aria-expanded", open ? "true" : "false");
    if (!open) pcCloseAllMegaMenus();
  });
}

/** Closes every open mega menu and resets its toggle's aria-expanded. */
function pcCloseAllMegaMenus() {
  document.querySelectorAll(".pc-mega-parent").forEach((parent) => {
    const toggle = parent.querySelector("[data-pc-dropdown]");
    const panel = parent.querySelector("[data-pc-dropdown-panel]");
    if (panel) panel.classList.remove("is-open");
    if (toggle) toggle.setAttribute("aria-expanded", "false");
  });
  document.querySelectorAll(".pc-mega-nested-open").forEach((g) => g.classList.remove("pc-mega-nested-open"));
}

/** Closes the mobile panel too -- what PJAX calls before swapping pages. */
function pcCloseNav() {
  const toggle = document.getElementById("pcNavToggle");
  const panel = document.getElementById("mainNav");
  if (panel) panel.classList.remove("is-open");
  if (toggle) toggle.setAttribute("aria-expanded", "false");
  pcCloseAllMegaMenus();
}
window.pcCloseNav = pcCloseNav;

/**
 * The About/Contact mega menus. Replaces Bootstrap's Dropdown: open on
 * hover at desktop (with a short delay each way so the pointer can cross
 * the gap between the link and the panel), and on click below 992px where
 * the panel renders inline inside the mobile nav instead.
 *
 * A click inside an open panel must NOT close it -- that was Bootstrap's
 * data-bs-auto-close="outside" -- so the document listener checks
 * containment against the whole .pc-mega-parent.
 */
let pcMegaCleanup = null;
function initMegaMenus() {
  if (pcMegaCleanup) {
    pcMegaCleanup();
    pcMegaCleanup = null;
  }

  const parents = Array.from(document.querySelectorAll(".pc-mega-parent"));
  if (!parents.length) return;

  const OPEN_DELAY_MS = 100;
  const CLOSE_DELAY_MS = 250;
  const isDesktop = () => window.matchMedia("(min-width: 992px)").matches;

  function setOpen(parent, open) {
    const toggle = parent.querySelector("[data-pc-dropdown]");
    const panel = parent.querySelector("[data-pc-dropdown-panel]");
    if (!toggle || !panel) return;
    panel.classList.toggle("is-open", open);
    toggle.setAttribute("aria-expanded", open ? "true" : "false");
  }

  parents.forEach((parent) => {
    let openTimer = null;
    let closeTimer = null;

    parent.addEventListener("mouseenter", () => {
      if (!isDesktop()) return;
      clearTimeout(closeTimer);
      openTimer = setTimeout(() => setOpen(parent, true), OPEN_DELAY_MS);
    });

    parent.addEventListener("mouseleave", () => {
      if (!isDesktop()) return;
      clearTimeout(openTimer);
      closeTimer = setTimeout(() => setOpen(parent, false), CLOSE_DELAY_MS);
    });

    const toggle = parent.querySelector("[data-pc-dropdown]");
    if (toggle) {
      toggle.addEventListener("click", (event) => {
        event.preventDefault();
        const panel = parent.querySelector("[data-pc-dropdown-panel]");
        const willOpen = !(panel && panel.classList.contains("is-open"));
        parents.forEach((other) => other !== parent && setOpen(other, false));
        setOpen(parent, willOpen);
      });
    }
  });

  function onDocClick(event) {
    if (event.target.closest(".pc-mega-parent")) return;
    pcCloseAllMegaMenus();
  }
  function onKeydown(event) {
    if (event.key === "Escape") pcCloseAllMegaMenus();
  }

  document.addEventListener("click", onDocClick);
  document.addEventListener("keydown", onKeydown);
  pcMegaCleanup = () => {
    document.removeEventListener("click", onDocClick);
    document.removeEventListener("keydown", onKeydown);
  };
}

/** Explicit tap-to-open for the "Training" / "Safety" nested flyouts */
function initMegaMenuNestedToggle() {
  const nestedGroups = document.querySelectorAll(".pc-mega-nested");
  if (!nestedGroups.length) return;

  nestedGroups.forEach((group) => {
    const toggleBtn = group.querySelector(".pc-mega-item-parent");
    if (!toggleBtn || toggleBtn.dataset.pcBound) return;
    toggleBtn.dataset.pcBound = "1";

    toggleBtn.addEventListener("click", (event) => {
      event.preventDefault();
      const isOpen = group.classList.contains("pc-mega-nested-open");

      nestedGroups.forEach((other) => other.classList.remove("pc-mega-nested-open"));
      if (!isOpen) group.classList.add("pc-mega-nested-open");
    });
  });
}

/**
 * Keeps --pc-navbar-h in sync with the fixed header's real rendered */
function syncNavbarHeightVar() {
  const navbar = document.querySelector("header");
  if (!navbar) return;
  document.documentElement.style.setProperty("--pc-navbar-h", `${navbar.getBoundingClientRect().height}px`);
}

/** Keeps --pc-footer-h in sync with the footer's real rendered height */
function syncFooterHeightVar() {
  const footer = document.querySelector("footer");
  const main = document.querySelector("main");
  if (!footer || !main) return;

  document.documentElement.style.setProperty("--pc-footer-h", `${footer.getBoundingClientRect().height}px`);

  const currentPaddingBottom = parseFloat(getComputedStyle(main).paddingBottom) || 0;
  const naturalMainHeight = main.getBoundingClientRect().height - currentPaddingBottom;
  document.documentElement.classList.toggle("pc-footer-reveal", naturalMainHeight >= window.innerHeight);
}

/**
 * Home hero. PJAX navigation can call this again every time the homepage is
 * (re)loaded into <main> -- tear down the previous scroll listener first so
 * repeated visits don't stack up duplicate listeners on a detached hero.
 */
let pcHeroParallaxCleanup = null;
function initHeroParallax() {
  if (pcHeroParallaxCleanup) {
    pcHeroParallaxCleanup();
    pcHeroParallaxCleanup = null;
  }

  const hero = document.querySelector(".pc-hero");
  if (!hero) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const bg = hero.querySelector(".pc-hero-canvas");
  if (!bg) return;
  let ticking = false;

  const update = () => {
    const rect = hero.getBoundingClientRect();
    const progress = rect.height ? -rect.top / rect.height : 0;
    bg.style.transform = `translateY(${progress * 40}px)`;
    ticking = false;
  };

  const onScroll = () => {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(update);
  };

  update();
  window.addEventListener("scroll", onScroll, { passive: true });
  pcHeroParallaxCleanup = () => window.removeEventListener("scroll", onScroll);
}

/* Home page "Why Choose PowerCabs" cards -- same re-init story as the hero. */
let pcWhyChooseObserver = null;
function initWhyChooseReveal() {
  if (pcWhyChooseObserver) {
    pcWhyChooseObserver.disconnect();
    pcWhyChooseObserver = null;
  }

  const items = document.querySelectorAll("#why-choose .pc-why-item");
  if (!items.length) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
  if (!("IntersectionObserver" in window)) return;

  pcWhyChooseObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        entry.target.classList.toggle("is-visible", entry.isIntersecting);
      });
    },
    { threshold: 0.25 }
  );

  items.forEach((item) => pcWhyChooseObserver.observe(item));
}

/**
 * Generic fade/slide-up-on-scroll reveal for any element carrying
 * .pc-reveal (currently the Loyalty Program page's timeline steps and
 * membership tier cards). Unlike initWhyChooseReveal() above (which toggles
 * its cards back out of view if you scroll back up past them), this one is
 * one-shot: once an element has been revealed it stays revealed and is
 * unobserved, so scrolling back up never makes content vanish again.
 */
let pcRevealObserver = null;
function initScrollReveal() {
  if (pcRevealObserver) {
    pcRevealObserver.disconnect();
    pcRevealObserver = null;
  }

  const items = document.querySelectorAll(".pc-reveal:not(.is-visible)");
  if (!items.length) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
    document.querySelectorAll(".pc-reveal").forEach((item) => item.classList.add("is-visible"));
    return;
  }
  if (!("IntersectionObserver" in window)) {
    document.querySelectorAll(".pc-reveal").forEach((item) => item.classList.add("is-visible"));
    return;
  }

  pcRevealObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add("is-visible");
        pcRevealObserver.unobserve(entry.target);
      });
    },
    { threshold: 0.2 }
  );

  items.forEach((item) => pcRevealObserver.observe(item));
}

/**
 * Simple floating scroll-to-top button: appears after the page has
 * scrolled a bit, click scrolls back to top.
 */
function initScrollIndicator() {
  const el = document.getElementById("pcScrollIndicator");
  if (!el) return;

  const SHOW_AFTER_PX = 240;
  let ticking = false;

  function update() {
    el.classList.toggle("is-visible", window.scrollY > SHOW_AFTER_PX);
    ticking = false;
  }

  update();
  window.addEventListener(
    "scroll",
    () => {
      if (ticking) return;
      ticking = true;
      requestAnimationFrame(update);
    },
    { passive: true }
  );

  el.addEventListener("click", () => {
    const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    window.scrollTo({ top: 0, behavior: reduceMotion ? "auto" : "smooth" });
  });
}
