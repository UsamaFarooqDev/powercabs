/**
 * Shared Google Places Autocomplete setup, restricted to Dublin/Ireland --
 * this is the exact bounds box, restriction options and validation/warning
 * behavior originally built for book-ride-online.php's Pickup/Drop-off
 * fields (see book-ride-map.js, which now calls into this instead of
 * building its own Autocomplete), factored out so any other page needing a
 * Dublin-restricted address field can reuse the same proven logic instead
 * of rebuilding a separate autocomplete system. Currently used by:
 *   - book-ride-online.php (Pickup/Drop-off, via book-ride-map.js)
 *   - meet-greet.php (the dynamic Destination/Pickup Address fields, via
 *     meet-greet-map.js)
 *
 * Usage:
 *   window.pcAttachDublinAutocomplete(inputEl, {
 *     warningEl: <element to show/hide -- .classList.remove/add("d-none")
 *                 -- when the typed text isn't a confirmed, in-bounds
 *                 place>,
 *     isConfirmed: function () { return <truthy once a valid place is
 *                 set> }, // drives the same on-blur nudge book-ride-online
 *                 already has: only warn on blur if there's typed text
 *                 that was never actually confirmed as a real place.
 *     onPlace: function (place, latLng) { ... }, // called once with a
 *                 valid, in-bounds place's geometry ({lat, lng} plain
 *                 numbers, already unwrapped from the LatLng object)
 *     onClear: function () { ... }, // called whenever a previously
 *                 confirmed place is invalidated -- cleared, retyped, or
 *                 resolved outside Dublin bounds
 *   })
 *
 * Requires window.google.maps.places to already be loaded (call this only
 * from a Maps "callback=" init function, or after checking for it, same as
 * every other Maps usage on this site) -- returns without doing anything
 * otherwise, rather than throwing.
 *
 * Safe to call more than once on the same <input>: every call after the
 * first is a no-op (tracked via a data attribute on the element), so a
 * field that gets shown/hidden/re-shown -- like meet-greet.php's dynamic
 * Pickup/Destination fields toggling with Service Type -- never ends up
 * with two Autocomplete instances or two sets of listeners stacked on it.
 */
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
        if (warningEl) warningEl.classList.remove("d-none");
        if (opts.onClear) opts.onClear();
        return;
      }

      if (warningEl) warningEl.classList.add("d-none");
      if (opts.onPlace) opts.onPlace(place, { lat: loc.lat(), lng: loc.lng() });
    });

    input.addEventListener("input", function () {
      if (warningEl) warningEl.classList.add("d-none");
      if (opts.onClear) opts.onClear();
    });

    input.addEventListener("blur", function () {
      var confirmed = opts.isConfirmed ? opts.isConfirmed() : false;
      if (input.value.trim() !== "" && !confirmed && warningEl) {
        warningEl.classList.remove("d-none");
      }
    });
  }

  window.pcAttachDublinAutocomplete = pcAttachDublinAutocomplete;
})();
