if (window.pcAmbCardsObserver) {
  window.pcAmbCardsObserver.disconnect();
  window.pcAmbCardsObserver = null;
}

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
