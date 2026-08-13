// Re-navigating to this page via PJAX re-runs this script -- tear down the
// previous scroll/resize listeners first so they don't pile up.
if (window.pcRidesParallaxCleanup) {
  window.pcRidesParallaxCleanup();
  window.pcRidesParallaxCleanup = null;
}

function pcInitRidesParallax() {
  const section = document.getElementById("pcRidesParallax");
  if (!section) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const sticky = document.getElementById("pcRidesSticky");
  const stack = document.getElementById("pcRideCardStack");
  const cards = Array.from(document.querySelectorAll("#pcRideCardStack .pc-ride-stack-card"));
  const dots = Array.from(document.querySelectorAll("#pcRideDots .pc-ride-dot"));
  const count = cards.length;
  if (!sticky || !stack || !count) return;

  section.classList.add("pc-rides-enhanced");

  // Raw scroll -> where the stack SHOULD be right now.
  let targetProgress = 0;
  // What's actually painted, eased toward the target each frame instead of
  // snapping straight to it -- smooths out choppy wheel/trackpad scroll
  // deltas into fluid card transitions.
  let currentProgress = 0;
  let rafId = null;
  const EASE = 0.16;

  function computeTarget() {
    const rect = section.getBoundingClientRect();
    const stickyHeight = sticky.offsetHeight;
    const total = section.offsetHeight - stickyHeight;
    const scrolled = Math.min(Math.max(-rect.top, 0), total);
    targetProgress = total > 0 ? (scrolled / total) * (count - 1) : 0;
  }

  function render(progress) {
    const activeIndex = Math.min(Math.floor(progress), count - 1);
    const localT = progress - activeIndex;
    const cardHeight = stack.offsetHeight || 1;

    cards.forEach((card, i) => {
      let y;
      if (i <= activeIndex) {
        y = 0;
      } else if (i === activeIndex + 1) {
        y = cardHeight * (1 - localT);
      } else {
        y = cardHeight;
      }
      card.style.transform = `translateY(${y}px)`;

      const isCurrent = i === activeIndex || i === activeIndex + 1;
      card.setAttribute("aria-hidden", isCurrent ? "false" : "true");
    });

    const dotIndex = localT > 0.5 ? Math.min(activeIndex + 1, count - 1) : activeIndex;
    dots.forEach((dot, i) => dot.classList.toggle("is-active", i === dotIndex));
  }

  function tick() {
    currentProgress += (targetProgress - currentProgress) * EASE;

    if (Math.abs(targetProgress - currentProgress) > 0.001) {
      render(currentProgress);
      rafId = requestAnimationFrame(tick);
    } else {
      currentProgress = targetProgress;
      render(currentProgress);
      rafId = null;
    }
  }

  function onScroll() {
    computeTarget();
    if (rafId === null) rafId = requestAnimationFrame(tick);
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onScroll);
  window.pcRidesParallaxCleanup = () => {
    window.removeEventListener("scroll", onScroll);
    window.removeEventListener("resize", onScroll);
  };

  computeTarget();
  currentProgress = targetProgress;
  render(currentProgress);
}

if (document.readyState !== "loading") {
  pcInitRidesParallax();
} else {
  document.addEventListener("DOMContentLoaded", pcInitRidesParallax);
}
