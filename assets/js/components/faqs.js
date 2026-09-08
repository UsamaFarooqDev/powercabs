function pcInitFaqs() {
  const passengerToggle = document.getElementById("faqAudiencePassenger");
  const driverToggle = document.getElementById("faqAudienceDriver");
  if (!passengerToggle || !driverToggle) return;

  const pairs = [
    { passenger: document.getElementById("passengerFaqAccordion"), driver: document.getElementById("driverFaqAccordion") },
    { passenger: document.getElementById("riderTutorialGrid"), driver: document.getElementById("driverTutorialGrid") },
  ].filter((pair) => pair.passenger && pair.driver);

  function swapTo(showEl, hideEl) {
    hideEl.classList.add("tw-hidden");
    showEl.classList.remove("tw-hidden");
    showEl.classList.remove("tw-animate-pc-fade-in-sm");
    // restart the animation each time it swaps in
    void showEl.offsetWidth;
    showEl.classList.add("tw-animate-pc-fade-in-sm", "motion-reduce:tw-animate-none");
  }

  passengerToggle.addEventListener("change", () => {
    if (passengerToggle.checked) pairs.forEach((pair) => swapTo(pair.passenger, pair.driver));
  });
  driverToggle.addEventListener("change", () => {
    if (driverToggle.checked) pairs.forEach((pair) => swapTo(pair.driver, pair.passenger));
  });
}

if (document.readyState !== "loading") {
  pcInitFaqs();
} else {
  document.addEventListener("DOMContentLoaded", pcInitFaqs);
}
