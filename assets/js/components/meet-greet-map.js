
(function () {
  function attachField(inputId, warningId) {
    var input = document.getElementById(inputId);
    if (!input) return;

    var confirmed = false;
    window.pcAttachDublinAutocomplete(input, {
      warningEl: document.getElementById(warningId),
      isConfirmed: function () {
        return confirmed;
      },
      onPlace: function () {
        confirmed = true;
      },
      onClear: function () {
        confirmed = false;
      },
    });
  }

  function initMeetGreetAutocomplete() {
    if (!window.google || !window.google.maps || !window.google.maps.places) return;
    attachField("mgDestinationAddress", "mgDestinationAddressWarning");
    attachField("mgPickupAddress", "mgPickupAddressWarning");
  }

window.initMeetGreetAutocomplete = initMeetGreetAutocomplete;

initMeetGreetAutocomplete();
})();
