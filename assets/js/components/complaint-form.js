function pcInitComplaintForm() {
  const form = document.getElementById("complaintForm");
  if (!form) return;

  const criminalNotice = document.getElementById("criminalNotice");
  const complaintFields = document.getElementById("complaintFields");
  const minimalFields = document.getElementById("complaintMinimalFields");
  const experienceSection = document.getElementById("experienceSection");
  const submitWrapper = document.getElementById("complaintSubmitWrapper");

  function updateCategoryState() {
    const selected = form.querySelector('input[name="complaint_category"]:checked');
    if (!selected) {
      criminalNotice.classList.add("tw-hidden");
      complaintFields.classList.add("tw-hidden");
      minimalFields.classList.add("tw-hidden");
      submitWrapper.classList.add("tw-hidden");
      return;
    }

    const mode = selected.dataset.mode || "full";
    criminalNotice.classList.toggle("tw-hidden", mode !== "toast");
    complaintFields.classList.toggle("tw-hidden", mode !== "full");
    experienceSection.classList.toggle("tw-hidden", mode !== "full");
    // The short categories and the Garda ones collect no journey details, but both still ask
    // who is getting in touch.
    minimalFields.classList.toggle("tw-hidden", mode !== "minimal" && mode !== "toast");
    submitWrapper.classList.remove("tw-hidden");

    // Both of these only act on controls that are on screen, so they have to run after the
    // blocks above have been shown: the security check sits beside the submit button, which
    // appears for every category, and the short form has a phone field of its own.
    if (window.pcInitTurnstile) window.pcInitTurnstile();
    if (window.pcInitPhoneFields) window.pcInitPhoneFields();
  }

  form.querySelectorAll('input[name="complaint_category"]').forEach((el) => {
    el.addEventListener("change", updateCategoryState);
  });

  updateCategoryState();
}

if (document.readyState !== "loading") {
  pcInitComplaintForm();
} else {
  document.addEventListener("DOMContentLoaded", pcInitComplaintForm);
}
