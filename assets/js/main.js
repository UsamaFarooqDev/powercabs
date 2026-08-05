document.addEventListener("DOMContentLoaded", () => {
  highlightActiveNavLink();
  initMegaMenuHover();
  initMegaMenuNestedToggle();
  syncNavbarHeightVar();
  syncFooterHeightVar();
  initHeroParallax();
  initHeaderScrollReveal();
  initWhyChooseReveal();
});

window.addEventListener("resize", syncNavbarHeightVar);
window.addEventListener("resize", syncFooterHeightVar);
window.addEventListener("load", syncFooterHeightVar);

function highlightActiveNavLink() {
  const currentPath = window.location.pathname.split("/").pop() || "index.php";
  document.querySelectorAll(".navbar-nav .nav-link[data-page]").forEach((link) => {
    if (link.dataset.page === currentPath) {
      link.classList.add("active");
      link.setAttribute("aria-current", "page");
    }
  });
}

/** Opens/closes the "About" mega menu on mouse hover */
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

/** Explicit tap-to-open for the "Training" / "Safety" nested flyouts */
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

  const mainNav = document.getElementById("mainNav");
  if (mainNav) {
    mainNav.addEventListener("hidden.bs.collapse", () => {
      nestedGroups.forEach((group) => group.classList.remove("pc-mega-nested-open"));
    });
  }
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

/** Home hero */
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

/* Global header scroll */
function initHeaderScrollReveal() {
  const header = document.querySelector("header.pc-header");
  if (!header) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const TOP_OFFSET = 80;
  const isMenuOpen = () =>
    header.querySelector(".pc-mega-menu.show") || document.getElementById("mainNav")?.classList.contains("show");

  let lastScrollY = window.scrollY;
  let ticking = false;

  function update() {
    const currentY = window.scrollY;
    const dockThreshold = window.innerHeight;
    const scrollingDown = currentY > lastScrollY;

    if (isMenuOpen() || currentY < TOP_OFFSET || currentY >= dockThreshold) {
      header.classList.remove("pc-header-hidden");
    } else if (scrollingDown) {
      header.classList.add("pc-header-hidden");
    } else {
      header.classList.remove("pc-header-hidden");
    }

    lastScrollY = currentY;
    ticking = false;
  }

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

/* Home page "Why Choose PowerCabs" cards */
function initWhyChooseReveal() {
  const items = document.querySelectorAll("#why-choose .pc-why-item");
  if (!items.length) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
  if (!("IntersectionObserver" in window)) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        entry.target.classList.toggle("is-visible", entry.isIntersecting);
      });
    },
    { threshold: 0.25 }
  );

  items.forEach((item) => observer.observe(item));
}
