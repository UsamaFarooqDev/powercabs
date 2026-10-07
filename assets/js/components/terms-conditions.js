/**
 * The audience toggle on /terms-conditions.
 *
 * Data-driven now, not hard-coded. It used to hold two element ids and two
 * listeners, which is why adding a third audience meant editing this file as
 * well as the page. Every radio carries data-tc-panel="<panel id>", so this
 * works for however many panels the page renders.
 *
 * The panels all stay in the DOM and are toggled with tw-hidden -- the content
 * of every audience is in the page for search engines and for Ctrl+F no matter
 * which tab is showing.
 */
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
    // Listeners go on elements inside <main>, which a PJAX swap discards along
    // with everything bound to them -- so re-running this cannot stack them.
    radio.addEventListener("change", () => {
      if (radio.checked) show(panel);
    });
  });

  // Honour whichever radio is checked at load: the browser restores the
  // previous choice on a back-navigation, and without this the markup's
  // default panel would be the one left visible.
  const checked = panels.find(({ radio }) => radio.checked);
  if (checked) show(checked.panel);
}

if (document.readyState !== "loading") {
  pcInitTermsConditions();
} else {
  document.addEventListener("DOMContentLoaded", pcInitTermsConditions);
}
