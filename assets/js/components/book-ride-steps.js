function pcInitBookSteps() {
  const widget = document.getElementById("pcBookSteps");
  if (!widget) return;

  const tabs = Array.from(widget.querySelectorAll(".pc-book-step-tab"));
  let screen = document.getElementById("pcBookStepScreen");
  if (!tabs.length || !screen) return;

  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  const SLIDE_MS = 420;
  const EASE = "cubic-bezier(0.22, 1, 0.36, 1)"; // the site's signature "premium" easing

  let currentIndex = tabs.findIndex((t) => t.classList.contains("is-active"));
  if (currentIndex < 0) currentIndex = 0;
  let animating = false;

  function activate(index) {
    if (index === currentIndex || animating) return;

    const tab = tabs[index];
    const nextSrc = tab.dataset.image;
    if (!nextSrc) return;

    tabs.forEach((t, i) => {
      const isActive = i === index;
      t.classList.toggle("is-active", isActive);
      t.setAttribute("aria-selected", isActive ? "true" : "false");
    });

    if (reduceMotion) {
      screen.src = nextSrc;
      screen.alt = tab.dataset.alt || "";
      currentIndex = index;
      return;
    }

    // Later step -> swipe left (new screen enters from the right).
    // Earlier step -> swipe right (new screen enters from the left).
    const direction = index > currentIndex ? 1 : -1;
    currentIndex = index;
    animating = true;

    // A real swipe needs both screens on stage at once -- clone the current
    // image, point it at the new screen, and park it just off the entering
    // edge before the outgoing one has moved at all.
    const incoming = screen.cloneNode(false);
    incoming.removeAttribute("id");
    incoming.src = nextSrc;
    incoming.alt = tab.dataset.alt || "";
    incoming.style.transition = "none";
    incoming.style.transform = `translateX(${direction * 100}%)`;
    screen.insertAdjacentElement("afterend", incoming);
    void incoming.offsetWidth; // force layout so the parked position isn't animated

    const transition = `transform ${SLIDE_MS}ms ${EASE}`;
    screen.style.transition = transition;
    screen.style.transform = `translateX(${direction * -100}%)`;
    incoming.style.transition = transition;
    incoming.style.transform = "translateX(0)";

    const outgoing = screen;
    window.setTimeout(() => {
      outgoing.remove();
      incoming.id = "pcBookStepScreen";
      incoming.style.transition = "none";
      screen = incoming;
      animating = false;
    }, SLIDE_MS);
  }

  tabs.forEach((tab, i) => {
    tab.addEventListener("click", () => activate(i));
  });
}

if (document.readyState !== "loading") {
  pcInitBookSteps();
} else {
  document.addEventListener("DOMContentLoaded", pcInitBookSteps);
}
