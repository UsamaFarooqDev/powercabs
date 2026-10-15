
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

const checked = panels.find(({ radio }) => radio.checked);
  if (checked) show(checked.panel);
}

if (document.readyState !== "loading") {
  pcInitTermsConditions();
} else {
  document.addEventListener("DOMContentLoaded", pcInitTermsConditions);
}
