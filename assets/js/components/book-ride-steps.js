function pcInitBookSteps() {
  const widget = document.getElementById("pcBookSteps");
  if (!widget) return;

  const tabs = Array.from(widget.querySelectorAll(".pc-book-step-tab"));
  const screen = document.getElementById("pcBookStepScreen");
  if (!tabs.length || !screen) return;

  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  function activate(index) {
    tabs.forEach((tab, i) => {
      const isActive = i === index;
      tab.classList.toggle("is-active", isActive);
      tab.setAttribute("aria-selected", isActive ? "true" : "false");
    });

    const tab = tabs[index];
    const nextSrc = tab.dataset.image;
    if (!nextSrc || screen.getAttribute("src") === nextSrc) return;

    if (reduceMotion) {
      screen.src = nextSrc;
      screen.alt = tab.dataset.alt || "";
      return;
    }

    screen.classList.add("pc-book-step-screen-fade");
    window.setTimeout(() => {
      screen.src = nextSrc;
      screen.alt = tab.dataset.alt || "";
      screen.classList.remove("pc-book-step-screen-fade");
    }, 180);
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
