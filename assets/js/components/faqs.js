document.addEventListener("DOMContentLoaded", () => {
  const passengerToggle = document.getElementById("faqAudiencePassenger");
  const driverToggle = document.getElementById("faqAudienceDriver");
  if (!passengerToggle || !driverToggle) return;

  const pairs = [
    { passenger: document.getElementById("passengerFaqAccordion"), driver: document.getElementById("driverFaqAccordion") },
    { passenger: document.getElementById("riderTutorialGrid"), driver: document.getElementById("driverTutorialGrid") },
  ].filter((pair) => pair.passenger && pair.driver);

  function swapTo(showEl, hideEl) {
    hideEl.classList.add("d-none");
    showEl.classList.remove("d-none");
    showEl.classList.remove("pc-faq-fade-in");
    // restart the animation each time it swaps in
    void showEl.offsetWidth;
    showEl.classList.add("pc-faq-fade-in");
  }

  passengerToggle.addEventListener("change", () => {
    if (passengerToggle.checked) pairs.forEach((pair) => swapTo(pair.passenger, pair.driver));
  });
  driverToggle.addEventListener("change", () => {
    if (driverToggle.checked) pairs.forEach((pair) => swapTo(pair.driver, pair.passenger));
  });
});
