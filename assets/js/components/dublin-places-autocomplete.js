
(function () {
  var PC_DUBLIN_BOUNDS = { north: 53.45, south: 53.15, east: -6.05, west: -6.55 };

  function pcAttachDublinAutocomplete(input, opts) {
    if (!input || input.dataset.pcAutocompleteInit) return;
    if (!window.google || !window.google.maps || !window.google.maps.places) return;
    input.dataset.pcAutocompleteInit = "1";

    opts = opts || {};
    var warningEl = opts.warningEl || null;

    var dublinBounds = new google.maps.LatLngBounds(
      { lat: PC_DUBLIN_BOUNDS.south, lng: PC_DUBLIN_BOUNDS.west },
      { lat: PC_DUBLIN_BOUNDS.north, lng: PC_DUBLIN_BOUNDS.east }
    );

    var autocomplete = new google.maps.places.Autocomplete(input, {
      fields: ["geometry", "formatted_address"],
      componentRestrictions: { country: "ie" },
      bounds: dublinBounds,
      strictBounds: true,
    });

    autocomplete.addListener("place_changed", function () {
      var place = autocomplete.getPlace();
      var loc = place.geometry && place.geometry.location;

      if (!loc || !dublinBounds.contains(loc)) {
        if (!loc) input.value = "";
        if (warningEl) warningEl.classList.remove("tw-hidden");
        if (opts.onClear) opts.onClear();
        return;
      }

      if (warningEl) warningEl.classList.add("tw-hidden");
      if (opts.onPlace) opts.onPlace(place, { lat: loc.lat(), lng: loc.lng() });
    });

    input.addEventListener("input", function () {
      if (warningEl) warningEl.classList.add("tw-hidden");
      if (opts.onClear) opts.onClear();
    });

    input.addEventListener("blur", function () {
      var confirmed = opts.isConfirmed ? opts.isConfirmed() : false;
      if (input.value.trim() !== "" && !confirmed && warningEl) {
        warningEl.classList.remove("tw-hidden");
      }
    });
  }

  window.pcAttachDublinAutocomplete = pcAttachDublinAutocomplete;
})();
