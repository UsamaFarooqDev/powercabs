document.addEventListener("DOMContentLoaded", () => {
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

  function update() {
    const rect = section.getBoundingClientRect();
    const stickyHeight = sticky.offsetHeight;
    const total = section.offsetHeight - stickyHeight;
    const scrolled = Math.min(Math.max(-rect.top, 0), total);
    const progress = total > 0 ? (scrolled / total) * (count - 1) : 0;

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

  let ticking = false;
  function onScroll() {
    if (ticking) return;
    ticking = true;
    requestAnimationFrame(() => {
      update();
      ticking = false;
    });
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("resize", onScroll);
  update();
});
