/*
  City Tours page: one shared modal serves every destination card. Each
  "Explore" / "Book Tour" button carries the destination's data as
  data-tour-* attributes; Bootstrap's own show.bs.modal event exposes
  the clicked button as event.relatedTarget, so the modal's content and
  the hidden "destination" form field are populated from whichever card
  was clicked -- no per-destination modal markup needed. "Book Tour"
  additionally scrolls the modal body down to the form so the booking
  fields are immediately visible.

  The booking form is a normal POST-and-reload (same pattern as every
  other form on the site), which would otherwise close the modal on
  reload. If the page rendered with a success/error state (see the
  inline pcCityToursFormSubmitted flag printed by city-tours.php), the
  modal is reopened automatically after load so the result is visible
  in context.
*/
document.addEventListener('DOMContentLoaded', () => {
  const modalEl = document.getElementById('tourModal');
  if (!modalEl) return;

  const nameEl = document.getElementById('tourModalName');
  const descEl = document.getElementById('tourModalDesc');
  const durationEl = document.getElementById('tourModalDuration');
  const imgEl = document.getElementById('tourModalImg');
  const destinationInput = document.getElementById('tourDestinationInput');
  const formSection = document.getElementById('tourBookingForm');

  modalEl.addEventListener('show.bs.modal', (event) => {
    const button = event.relatedTarget;
    if (!button) return;

    const name = button.getAttribute('data-tour-name') || '';
    nameEl.textContent = name;
    descEl.textContent = button.getAttribute('data-tour-desc') || '';
    durationEl.textContent = button.getAttribute('data-tour-duration') || '';
    imgEl.src = button.getAttribute('data-tour-img') || '';
    imgEl.alt = name;
    destinationInput.value = name;

    if (button.getAttribute('data-scroll-to-form') === 'true') {
      modalEl.addEventListener('shown.bs.modal', () => {
        formSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
      }, { once: true });
    }
  });

  if (window.pcCityToursFormSubmitted) {
    new bootstrap.Modal(modalEl).show();
  }
});
