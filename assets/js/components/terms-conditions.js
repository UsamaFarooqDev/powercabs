
function pcInitTermsConditions() {
  const radios = document.querySelectorAll('input[name="tcAudience"][data-tc-panel]');
  if (!radios.length) return;

  const panels = [];
  radios.forEach((radio) => {
    const panel = document.getElementById(radio.getAttribute("data-tc-panel"));
    if (panel) panels.push({ radio, panel });
  });
  if (!panels.length) return;

  function show(active) {
    panels.forEach(({ panel }) => {
      panel.classList.toggle("tw-hidden", panel !== active);
    });
  }

  panels.forEach(({ radio, panel }) => {
radio.addEventListener("change", () => {
      if (radio.checked) show(panel);
    });
  });

  // A shared link like /terms-conditions#b-20 points at a clause that lives inside a
  // panel which starts hidden, so the browser's own hash scroll finds nothing. Open
  // whichever panel owns the target first, then scroll to it.
  function activateFromHash() {
    const id = decodeURIComponent(window.location.hash.slice(1));
    if (!id) return false;
    const target = document.getElementById(id);
    if (!target) return false;
    const owner = panels.find(({ panel }) => panel === target || panel.contains(target));
    if (!owner) return false;

    owner.radio.checked = true;
    show(owner.panel);
    target.scrollIntoView({ block: "start" });
    return true;
  }

  if (activateFromHash()) return;

const checked = panels.find(({ radio }) => radio.checked);
  if (checked) show(checked.panel);
}

if (document.readyState !== "loading") {
  pcInitTermsConditions();
} else {
  document.addEventListener("DOMContentLoaded", pcInitTermsConditions);
}
