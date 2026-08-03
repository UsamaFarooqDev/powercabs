/*
  Shared site behaviors. Component-specific scripts (booking widget,
  FAQ accordion, form validation, etc.) live in assets/js/components/
  and are included per-page only where needed.
*/

document.addEventListener("DOMContentLoaded", () => {
  highlightActiveNavLink();
  initMegaMenuHover();
  initMegaMenuNestedToggle();
  syncNavbarHeightVar();
  syncFooterHeightVar();
  initHeroParallax();
});

window.addEventListener("resize", syncNavbarHeightVar);
window.addEventListener("resize", syncFooterHeightVar);
// Images loading in late (particularly the ones inside inner-hero.php)
// can grow a short page's height after DOMContentLoaded already ran --
// re-checked once everything has actually finished loading.
window.addEventListener("load", syncFooterHeightVar);

/**
 * Adds `active` + aria-current to the navbar link matching the current page.
 */
function highlightActiveNavLink() {
  const currentPath = window.location.pathname.split("/").pop() || "index.php";
  document.querySelectorAll(".navbar-nav .nav-link[data-page]").forEach((link) => {
    if (link.dataset.page === currentPath) {
      link.classList.add("active");
      link.setAttribute("aria-current", "page");
    }
  });
}

/**
 * Opens/closes the "About" mega menu on mouse hover (with a short intent
 * delay) at desktop widths, using Bootstrap's own Dropdown API so
 * aria-expanded, outside-click-to-close and Escape-to-close all keep
 * working exactly as they do for a click-triggered dropdown.
 *
 * Below the lg breakpoint we do nothing here: Bootstrap's default
 * click-to-toggle behavior (wired up by data-bs-toggle="dropdown" in the
 * markup) takes over unchanged, which is what makes it behave as a normal
 * tap-to-expand accordion item inside the collapsed hamburger nav.
 */
function initMegaMenuHover() {
  if (typeof bootstrap === "undefined" || !bootstrap.Dropdown) return;

  const OPEN_DELAY_MS = 100;
  const CLOSE_DELAY_MS = 250;
  const isDesktop = () => window.matchMedia("(min-width: 992px)").matches;

  document.querySelectorAll(".pc-mega-parent").forEach((parent) => {
    const toggleEl = parent.querySelector('[data-bs-toggle="dropdown"]');
    if (!toggleEl) return;

    const dropdown = bootstrap.Dropdown.getOrCreateInstance(toggleEl);
    let openTimer = null;
    let closeTimer = null;

    parent.addEventListener("mouseenter", () => {
      if (!isDesktop()) return;
      clearTimeout(closeTimer);
      openTimer = setTimeout(() => dropdown.show(), OPEN_DELAY_MS);
    });

    parent.addEventListener("mouseleave", () => {
      if (!isDesktop()) return;
      clearTimeout(openTimer);
      closeTimer = setTimeout(() => dropdown.hide(), CLOSE_DELAY_MS);
    });
  });
}

/**
 * Explicit tap-to-open for the "Training" / "Safety" nested flyouts
 * inside the About mega menu. CSS already opens them on :hover and on
 * :focus-within (see components.css), which covers mouse and keyboard
 * use, but a tap's focus behavior on a nested, non-form-like control is
 * inconsistent enough across mobile browsers that it can't be trusted
 * alone -- this makes it explicit and reliable everywhere by toggling a
 * plain class instead. Clicking a second parent closes the first, same
 * "only one open" behaviour Bootstrap's own dropdowns/accordions use.
 * The mega menu's own outside-click-to-close (Bootstrap's Dropdown API)
 * still applies on top of this unchanged, since it only ever looks at
 * clicks outside the whole panel, not inside it.
 */
function initMegaMenuNestedToggle() {
  const nestedGroups = document.querySelectorAll(".pc-mega-nested");
  if (!nestedGroups.length) return;

  nestedGroups.forEach((group) => {
    const toggleBtn = group.querySelector(".pc-mega-item-parent");
    if (!toggleBtn) return;

    toggleBtn.addEventListener("click", (event) => {
      event.preventDefault();
      const isOpen = group.classList.contains("pc-mega-nested-open");

      nestedGroups.forEach((other) => other.classList.remove("pc-mega-nested-open"));
      if (!isOpen) group.classList.add("pc-mega-nested-open");
    });
  });

  // Collapsing the hamburger nav (navigating away, tapping the toggler
  // again, resizing past the breakpoint) should reset any nested
  // flyout left open, so reopening the menu always starts closed.
  const mainNav = document.getElementById("mainNav");
  if (mainNav) {
    mainNav.addEventListener("hidden.bs.collapse", () => {
      nestedGroups.forEach((group) => group.classList.remove("pc-mega-nested-open"));
    });
  }
}

/**
 * Keeps --pc-navbar-h in sync with the fixed header's real rendered
 * height (the whole <header> box -- the pill's own top offset included,
 * not just the pill itself), so anything that needs to know exactly how
 * much space the floating navbar occupies stays accurate automatically
 * instead of relying on a guessed fallback: the "About" mega menu's
 * `top` offset, and every hero's own self-compensating padding-top
 * (both in components.css).
 */
function syncNavbarHeightVar() {
  const navbar = document.querySelector("header");
  if (!navbar) return;
  document.documentElement.style.setProperty("--pc-navbar-h", `${navbar.getBoundingClientRect().height}px`);
}

/**
 * Keeps --pc-footer-h in sync with the footer's real rendered height, so
 * <main>'s reserved padding-bottom (base.css, the fixed-footer "reveal"
 * effect) always matches exactly -- footer height varies a lot by
 * breakpoint (its link columns stack differently), so a static fallback
 * alone would be wrong most of the time.
 *
 * Also decides whether the reveal effect should run at all, via the
 * html.pc-footer-reveal class base.css's rules key off. The footer is
 * position: fixed and rendered at every scroll position -- that only
 * looks right because the page's own content is normally opaque and
 * tall enough to fully hide it until the user scrolls close to the
 * bottom. On a short inner page (a hero plus one or two brief sections,
 * shorter than the viewport on its own), there's nothing opaque left to
 * cover it with, and the footer bleeds into view immediately --
 * sometimes right behind the hero, with no scrolling at all.
 *
 * The reveal effect is reserved for the home page only (by design --
 * every other page just shows the footer in plain, normal flow). Even
 * on the home page it only switches on once the page's real content
 * (measured before any reveal padding is added) already fills at least
 * one full viewport, for the short-page reason above.
 */
function syncFooterHeightVar() {
  const footer = document.querySelector("footer");
  const main = document.querySelector("main");
  if (!footer || !main) return;

  document.documentElement.style.setProperty("--pc-footer-h", `${footer.getBoundingClientRect().height}px`);

  const isHome = document.body.dataset.page === "index.php";
  const currentPaddingBottom = parseFloat(getComputedStyle(main).paddingBottom) || 0;
  const naturalMainHeight = main.getBoundingClientRect().height - currentPaddingBottom;
  document.documentElement.classList.toggle("pc-footer-reveal", isHome && naturalMainHeight >= window.innerHeight);
}

/**
 * Home hero: as the hero scrolls out of view, the background canvas (map
 * lines, glow, sparks) drifts at a different rate than the rest of the
 * section (classic parallax depth cue). Owns .pc-hero-canvas's transform
 * exclusively -- the canvas itself has no CSS transform-animation of its
 * own (only its children do), so there's nothing for this to fight.
 */
function initHeroParallax() {
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
}
