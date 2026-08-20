// Re-navigating to /ambassador-programme via PJAX re-runs this script --
// tear down any previous scroll listener/observers first.
if (window.pcAmbJourneyParallaxCleanup) {
  window.pcAmbJourneyParallaxCleanup();
  window.pcAmbJourneyParallaxCleanup = null;
}
if (window.pcAmbCardsObserver) {
  window.pcAmbCardsObserver.disconnect();
  window.pcAmbCardsObserver = null;
}
if (window.pcAmbStepsObserver) {
  window.pcAmbStepsObserver.disconnect();
  window.pcAmbStepsObserver = null;
}

/** Eased scroll parallax on the journey section's road photo. */
function pcInitAmbJourneyParallax() {
  const section = document.getElementById("pcAmbJourney");
  const img = document.getElementById("pcAmbJourneyImg");
  if (!section || !img) return;
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;

  const EASE = 0.08;
  let targetShift = 0;
  let currentShift = 0;
  let rafId = null;

  const computeTarget = () => {
    const rect = section.getBoundingClientRect();
    const progress = rect.height ? -rect.top / rect.height : 0;
    targetShift = Math.max(-1, Math.min(1, progress)) * 42;
  };

  const render = () => {
    img.style.transform = `scale(1.12) translateY(${currentShift}px)`;
  };

  const tick = () => {
    currentShift += (targetShift - currentShift) * EASE;
    if (Math.abs(targetShift - currentShift) > 0.05) {
      render();
      rafId = requestAnimationFrame(tick);
    } else {
      currentShift = targetShift;
      render();
      rafId = null;
    }
  };

  const onScroll = () => {
    computeTarget();
    if (rafId === null) rafId = requestAnimationFrame(tick);
  };

  computeTarget();
  currentShift = targetShift;
  render();
  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onScroll);
  window.pcAmbJourneyParallaxCleanup = () => {
    window.removeEventListener("scroll", onScroll);
    window.removeEventListener("resize", onScroll);
    if (rafId !== null) cancelAnimationFrame(rafId);
  };
}

/**
 * Staggered reveal for the benefit bento cards and the journey steps.
 * One-shot: once a card has revealed, it's unobserved instead of being
 * toggled back off when it scrolls out of view again. Toggling both ways
 * meant a card that was large enough to straddle the intersection threshold
 * would flip in and out repeatedly on small scroll deltas -- especially the
 * tall feature card -- which read as "vibrating" while scrolling.
 */
function pcInitAmbReveal() {
  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return;
  if (!("IntersectionObserver" in window)) return;

  const cards = document.querySelectorAll("#pcAmbBenefits .pc-amb-card");
  if (cards.length) {
    window.pcAmbCardsObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.2 }
    );
    cards.forEach((card) => window.pcAmbCardsObserver.observe(card));
  }

  const steps = document.querySelectorAll("#pcAmbJourney .pc-amb-journey-step");
  if (steps.length) {
    window.pcAmbStepsObserver = new IntersectionObserver(
      (entries, observer) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            entry.target.classList.add("is-visible");
            observer.unobserve(entry.target);
          }
        });
      },
      { threshold: 0.3 }
    );
    steps.forEach((step) => window.pcAmbStepsObserver.observe(step));
  }
}

function pcInitAmbPage() {
  pcInitAmbJourneyParallax();
  pcInitAmbReveal();
}

if (document.readyState !== "loading") {
  pcInitAmbPage();
} else {
  document.addEventListener("DOMContentLoaded", pcInitAmbPage);
}
