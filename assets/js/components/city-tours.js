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

    modalEl.addEventListener('pc.modal.show', (event) => {
      // ui.js surfaces the opener both ways; read detail first and fall back to
      // the property so this keeps working whichever shape the event carries.
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

    /* A data-scroll-to-form branch used to sit here: on pc.modal.shown it ran
       formSection.scrollIntoView({behavior:'smooth'}). It was unreachable
       while the relatedTarget bug made this whole listener bail early, so it
       had never actually run. The moment that bug was fixed it went live and
       smooth-scrolled the destination image off the top of the modal as it
       opened -- the "stuck image" and the flicker.

       It is gone rather than repaired: the modal is compact enough now that
       the form is visible without scrolling, and animating a scroll during an
       open animation fights the modal's own transition either way. */

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
