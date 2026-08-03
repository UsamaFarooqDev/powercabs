/*
  Complaint form interactivity: shows/hides the form based on the
  selected complaint category -- read from each radio's own data-mode
  attribute (kept in sync with the server-side category lists in
  complaint-form.php, not duplicated here):
    "full"    -> show the whole form, including the experience narrative
    "minimal" -> show no fields at all, just the submit button
    "toast"   -> hide the form, show the Garda-matters notice --
                 submit button still shows (consistent with the other
                 two modes); submitting it still hits the same
                 Garda-matter rejection server-side
  The submit button (and, below it, the success/error toast) lives
  outside #complaintFields so it can show for all three modes, not just
  "full"/"minimal". SPSV and Dispatch Operator details are both shown
  together whenever the full form is visible, regardless of service
  type -- service type is still collected as a field, just no longer
  used to hide either section.
*/
document.addEventListener("DOMContentLoaded", () => {
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

  // Loading state on submit: disables the button and swaps in a spinner
  // so a second click can't fire off a duplicate submission while the
  // (full page reload) POST is in flight. Disabling happens inside the
  // submit handler, after the browser has already captured the form
  // data for this submission, so it only blocks a *second* click --
  // it doesn't cancel the one already underway.
  const submitBtn = document.getElementById("complaintSubmitBtn");
  const submitSpinner = document.getElementById("complaintSubmitSpinner");
  const submitLabel = document.getElementById("complaintSubmitLabel");
  form.addEventListener("submit", () => {
    if (!submitBtn || submitBtn.disabled) return;
    submitBtn.disabled = true;
    submitSpinner.classList.remove("d-none");
    submitLabel.textContent = "Submitting...";
  });
});
