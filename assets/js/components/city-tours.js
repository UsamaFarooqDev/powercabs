function pcInitCityTours() {
  const modalEl = document.getElementById('tourModal');
  if (!modalEl) return;

  // A previous PJAX visit to this page may have already relocated a copy of
  // this modal to the end of <body> -- drop it before adopting this one.
  document.querySelectorAll('#tourModal').forEach((el) => {
    if (el !== modalEl) el.remove();
  });
  document.body.appendChild(modalEl);

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
}

if (document.readyState !== 'loading') {
  pcInitCityTours();
} else {
  document.addEventListener('DOMContentLoaded', pcInitCityTours);
}
