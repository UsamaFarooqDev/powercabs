function pcInitTermsConditions() {
  const passengerToggle = document.getElementById("tcAudiencePassenger");
  const driverToggle = document.getElementById("tcAudienceDriver");
  const passengerTerms = document.getElementById("passengerTerms");
  const driverTerms = document.getElementById("driverTerms");
  if (!passengerToggle || !driverToggle || !passengerTerms || !driverTerms) return;

  passengerToggle.addEventListener("change", () => {
    if (passengerToggle.checked) {
      driverTerms.classList.add("tw-hidden");
      passengerTerms.classList.remove("tw-hidden");
    }
  });
  driverToggle.addEventListener("change", () => {
    if (driverToggle.checked) {
      passengerTerms.classList.add("tw-hidden");
      driverTerms.classList.remove("tw-hidden");
    }
  });
}

if (document.readyState !== "loading") {
  pcInitTermsConditions();
} else {
  document.addEventListener("DOMContentLoaded", pcInitTermsConditions);
}
