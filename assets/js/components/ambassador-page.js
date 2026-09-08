/* The Ambassador "journey" parallax section went with
   components/ambassador/journey.php -- four one-word labels (Drive ->
   Represent PowerCabs -> Earn -> Get Rewarded) over a remote hero image,
   telling a driver nothing the page had not already said. The benefit-card
   reveal below is the live half of this file. */
// Re-navigating to /ambassador-programme via PJAX re-runs this script --
// tear down any previous scroll listener/observers first.
if (window.pcAmbCardsObserver) {
  window.pcAmbCardsObserver.disconnect();
  window.pcAmbCardsObserver = null;
}

/** Eased scroll parallax on the journey section's road photo. */
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
}

function pcInitAmbPage() {
  pcInitAmbReveal();
}

if (document.readyState !== "loading") {
  pcInitAmbPage();
} else {
  document.addEventListener("DOMContentLoaded", pcInitAmbPage);
}
