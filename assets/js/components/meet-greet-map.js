/**
 * Meet & Greet Dublin address autocomplete -- attaches the shared, proven
 * Dublin-restricted Google Places Autocomplete (dublin-places-autocomplete.js,
 * the exact same bounds/config book-ride-online.php's Pickup/Drop-off
 * fields use) to this page's two dynamic address fields instead of building
 * a separate autocomplete system:
 *   - #mgDestinationAddress -- shown for the "Pickup" service type
 *     (collected from the airport, dropped off somewhere else)
 *   - #mgPickupAddress -- shown for the "Dropping Off" service type
 *     (collected somewhere else, dropped off at the airport)
 *
 * Both fields exist in the DOM the whole time -- the inline script further
 * down this page just toggles which group is visible/enabled/required
 * based on Service Type, it never adds/removes the fields themselves -- so
 * both get the Autocomplete attached once, up front, regardless of which
 * one is currently showing. pcAttachDublinAutocomplete no-ops on a second
 * call for the same input, so switching Service Type back and forth (even
 * repeatedly) never attaches a second Autocomplete instance or a second
 * set of listeners to either field.
 *
 * There's no map/marker/route/fare estimate on this page (unlike
 * book-ride-map.js) -- just two independent text fields that need to
 * resolve to a real, in-Dublin place and have their value filled
 * accordingly, so each gets its own small "was a real place actually
 * confirmed" flag (closed over per field) instead of book-ride-map.js's
 * shared pickup/dropoff `state` object.
 */
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

  // Reachable by name -- the Maps SDK's own onload callback (see this
  // page's own <script src="...maps/api/js?...callback=initMeetGreetAutocomplete">
  // tag) calls window.initMeetGreetAutocomplete() directly.
  window.initMeetGreetAutocomplete = initMeetGreetAutocomplete;

  // Same pattern as book-ride-map.js: on a fresh load the Maps SDK isn't
  // ready yet when this script runs -- its callback fires later and calls
  // window.initMeetGreetAutocomplete itself. On a repeat PJAX visit (e.g.
  // arriving here from book-ride-online.php, which already loaded the same
  // SDK + places library) the SDK is already loaded and pjax.js skips
  // re-requesting it, so that callback never fires again here -- so if it's
  // already present, this script re-running on each PJAX swap is what
  // attaches the fresh page's autocomplete instead.
  initMeetGreetAutocomplete();
})();
