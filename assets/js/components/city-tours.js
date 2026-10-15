function pcInitCityTours() {
  const modalEl = document.getElementById('tourModal');
  const hourlyModalEl = document.getElementById('hourlyModal');
  if (!modalEl && !hourlyModalEl) return;

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

    modalEl.addEventListener('pc.modal.show', (event) => {
const button = (event.detail && event.detail.relatedTarget) || event.relatedTarget;
      if (!button) return;

      const name = button.getAttribute('data-tour-name') || '';
      nameEl.textContent = name;
      descEl.textContent = button.getAttribute('data-tour-desc') || '';
      durationEl.textContent = button.getAttribute('data-tour-duration') || '';
      imgEl.src = button.getAttribute('data-tour-img') || '';
      imgEl.alt = name;
      destinationInput.value = name;
    });

if (window.pcCityToursFormSubmitted) {
      window.pcModal.getOrCreateInstance(modalEl).show();
    }
  }

  if (hourlyModalEl && window.pcHourlyFormSubmitted) {
    window.pcModal.getOrCreateInstance(hourlyModalEl).show();
  }
}

if (document.readyState !== 'loading') {
  pcInitCityTours();
} else {
  document.addEventListener('DOMContentLoaded', pcInitCityTours);
}
