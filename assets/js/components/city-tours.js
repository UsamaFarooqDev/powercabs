function pcInitCityTours() {
  const modalEl = document.getElementById('tourModal');
  const hourlyModalEl = document.getElementById('hourlyModal');
  if (!modalEl && !hourlyModalEl) return;

  // A previous PJAX visit to this page may have already relocated a copy of
  // these modals to the end of <body> -- drop the stale ones before
  // adopting the fresh copies. Relocating to <body> (instead of leaving
  // them inside <main>) is required: at desktop widths <main> gets
  // position:relative + z-index:1 from the footer-reveal mechanism, which
  // traps any modal left inside it below Bootstrap's body-level backdrop.
  document.querySelectorAll('#tourModal, #hourlyModal').forEach((el) => {
    if (el !== modalEl && el !== hourlyModalEl) el.remove();
  });
  if (modalEl) document.body.appendChild(modalEl);
  if (hourlyModalEl) document.body.appendChild(hourlyModalEl);

  if (modalEl) {
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

  if (hourlyModalEl && window.pcHourlyFormSubmitted) {
    new bootstrap.Modal(hourlyModalEl).show();
  }
}

if (document.readyState !== 'loading') {
  pcInitCityTours();
} else {
  document.addEventListener('DOMContentLoaded', pcInitCityTours);
}
