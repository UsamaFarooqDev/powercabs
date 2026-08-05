document.addEventListener("DOMContentLoaded", () => {
  const passengerToggle = document.getElementById("tcAudiencePassenger");
  const driverToggle = document.getElementById("tcAudienceDriver");
  const passengerTerms = document.getElementById("passengerTerms");
  const driverTerms = document.getElementById("driverTerms");
  if (!passengerToggle || !driverToggle || !passengerTerms || !driverTerms) return;

  passengerToggle.addEventListener("change", () => {
    if (passengerToggle.checked) {
      driverTerms.classList.add("d-none");
      passengerTerms.classList.remove("d-none");
    }
  });
  driverToggle.addEventListener("change", () => {
    if (driverToggle.checked) {
      passengerTerms.classList.add("d-none");
      driverTerms.classList.remove("d-none");
    }
  });
});
