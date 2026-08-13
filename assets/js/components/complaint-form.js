function pcInitComplaintForm() {
  const form = document.getElementById("complaintForm");
  if (!form) return;

  const criminalNotice = document.getElementById("criminalNotice");
  const complaintFields = document.getElementById("complaintFields");
  const experienceSection = document.getElementById("experienceSection");
  const submitWrapper = document.getElementById("complaintSubmitWrapper");

  function updateCategoryState() {
    const selected = form.querySelector('input[name="complaint_category"]:checked');
    if (!selected) {
      criminalNotice.classList.add("d-none");
      complaintFields.classList.add("d-none");
      submitWrapper.classList.add("d-none");
      return;
    }

    const mode = selected.dataset.mode || "full";
    criminalNotice.classList.toggle("d-none", mode !== "toast");
    complaintFields.classList.toggle("d-none", mode !== "full");
    experienceSection.classList.toggle("d-none", mode !== "full");
    submitWrapper.classList.remove("d-none");
  }

  form.querySelectorAll('input[name="complaint_category"]').forEach((el) => {
    el.addEventListener("change", updateCategoryState);
  });

  updateCategoryState();
  // Submit-button loading state is handled generically by ajax-forms.js.
}

if (document.readyState !== "loading") {
  pcInitComplaintForm();
} else {
  document.addEventListener("DOMContentLoaded", pcInitComplaintForm);
}
