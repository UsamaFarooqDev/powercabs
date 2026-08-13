// Wrapped in an IIFE (rather than top-level `const`/`function`) because a
// PJAX revisit to this page re-runs this script a second time -- top-level
// `const` is shared across every <script> tag on the page and throws
// "already declared" if the same name is declared twice. initGoogleMaps
// itself still needs to be reachable by name (window.initGoogleMaps), since
// the Maps SDK's own onload callback calls it that way.
(function () {
  const PC_DUBLIN_BOUNDS = { north: 53.45, south: 53.15, east: -6.05, west: -6.55 };

  // Mirrors the passenger app's ride_selection.dart multiplier table.
  const PC_RIDE_TYPE_MULTIPLIERS = {
    "Economy": 1.0,
    "Economy XL": 1.2,
    "Limousine": 2.0,
    "Wheelchair Taxi": 1.1,
    "Pets Taxi": 1.15,
    "Courier / Parcel": 0.9,
    "Business": 1.2,
    "Business XL": 1.3,
  };

  const PC_INITIAL_FARE = 3.0;
  const PC_DAY_RATES = { base: 4.40, perKm: 1.32, perMinute: 0.20 };
  const PC_NIGHT_RATES = { base: 5.40, perKm: 1.81, perMinute: 0.30 };

  function pcIsDaytime(date) {
    const hour = (date || new Date()).getHours();
    return hour >= 8 && hour < 20;
  }

  /** Fare = (3.0 + baseFare + distanceKm*ratePerKm + durationMin*ratePerMinute) * typeMultiplier */
  function pcCalculateFare(distanceKm, durationMin, rideTypeLabel) {
    const rates = pcIsDaytime() ? PC_DAY_RATES : PC_NIGHT_RATES;
    const multiplier = PC_RIDE_TYPE_MULTIPLIERS[rideTypeLabel] ?? PC_RIDE_TYPE_MULTIPLIERS["Economy"];
    const fare = (PC_INITIAL_FARE + rates.base + distanceKm * rates.perKm + durationMin * rates.perMinute) * multiplier;
    return Math.round(fare * 100) / 100;
  }

  function initGoogleMaps() {
    const mapEl = document.getElementById("pcRideMap");
    const pickupInput = document.getElementById("brPickup");
    const dropoffInput = document.getElementById("brDropoff");
    if (!mapEl || !pickupInput || !dropoffInput) return;

    const dublinBounds = new google.maps.LatLngBounds(
      { lat: PC_DUBLIN_BOUNDS.south, lng: PC_DUBLIN_BOUNDS.west },
      { lat: PC_DUBLIN_BOUNDS.north, lng: PC_DUBLIN_BOUNDS.east }
    );

    // Ireland-wide by default; manually fit to the route once both ends
    // are set (see getFormOverlayPx below) so it lands clear of the card.
    const map = new google.maps.Map(mapEl, {
      center: { lat: 53.35, lng: -7.9 },
      zoom: 7,
      disableDefaultUI: true,
      zoomControl: true,
    });

    const directionsService = new google.maps.DirectionsService();
    const directionsRenderer = new google.maps.DirectionsRenderer({
      map,
      suppressMarkers: true,
      preserveViewport: true, // we fit bounds ourselves, with room reserved for the form card
      polylineOptions: { strokeColor: "#e8590c", strokeWeight: 5 },
    });

    const formColEl = document.getElementById("pcRideFormCol");

    // The form floats over the right side of the map at lg+ (>=992px) --
    function getFormOverlayPx() {
      if (window.innerWidth < 992 || !formColEl) return 0;
      return formColEl.getBoundingClientRect().width + 24;
    }

    const markers = { pickup: null, dropoff: null };
    const state = { pickup: null, dropoff: null };

    const rideTypeSelect = document.getElementById("brRideType");
    const fareBox = document.getElementById("pcFareEstimate");
    const fareValueEl = document.getElementById("pcFareValue");
    const fareDistanceEl = document.getElementById("pcFareDistance");
    const fareDurationEl = document.getElementById("pcFareDuration");

    const hiddenFields = {
      pickupLat: document.getElementById("pcPickupLat"),
      pickupLng: document.getElementById("pcPickupLng"),
      dropoffLat: document.getElementById("pcDropoffLat"),
      dropoffLng: document.getElementById("pcDropoffLng"),
      distanceKm: document.getElementById("pcDistanceKm"),
      durationMin: document.getElementById("pcDurationMin"),
      fareEur: document.getElementById("pcFareEur"),
    };

    function placeMarker(key, position, color) {
      if (markers[key]) markers[key].setMap(null);
      markers[key] = new google.maps.Marker({
        position,
        map,
        icon: {
          path: google.maps.SymbolPath.CIRCLE,
          scale: 8,
          fillColor: color,
          fillOpacity: 1,
          strokeColor: "#fff",
          strokeWeight: 2,
        },
      });
    }

    function clearMarker(key) {
      if (markers[key]) {
        markers[key].setMap(null);
        markers[key] = null;
      }
    }

    function resetEstimate() {
      fareBox?.classList.add("d-none");
      directionsRenderer.set("directions", null);
      ["distanceKm", "durationMin", "fareEur"].forEach((k) => {
        if (hiddenFields[k]) hiddenFields[k].value = "";
      });
    }

    function renderEstimate(distanceKm, durationMin) {
      const rideType = rideTypeSelect?.value || "Economy";
      const fare = pcCalculateFare(distanceKm, durationMin, rideType);

      if (hiddenFields.distanceKm) hiddenFields.distanceKm.value = distanceKm.toFixed(2);
      if (hiddenFields.durationMin) hiddenFields.durationMin.value = durationMin.toFixed(1);
      if (hiddenFields.fareEur) hiddenFields.fareEur.value = fare.toFixed(2);

      if (fareValueEl) fareValueEl.textContent = `€${fare.toFixed(2)}`;
      if (fareDistanceEl) fareDistanceEl.textContent = distanceKm.toFixed(1);
      if (fareDurationEl) fareDurationEl.textContent = Math.round(durationMin);
      fareBox?.classList.remove("d-none");
    }

    function updateRoute() {
      if (!state.pickup || !state.dropoff) {
        resetEstimate();
        return;
      }

      if (hiddenFields.pickupLat) hiddenFields.pickupLat.value = state.pickup.lat;
      if (hiddenFields.pickupLng) hiddenFields.pickupLng.value = state.pickup.lng;
      if (hiddenFields.dropoffLat) hiddenFields.dropoffLat.value = state.dropoff.lat;
      if (hiddenFields.dropoffLng) hiddenFields.dropoffLng.value = state.dropoff.lng;

      directionsService.route(
        {
          origin: state.pickup,
          destination: state.dropoff,
          travelMode: google.maps.TravelMode.DRIVING,
          provideRouteAlternatives: true,
        },
        (result, status) => {
          if (status !== "OK" || !result.routes.length) return;

          // Pick the shortest (cheapest) of the returned alternatives.
          let shortestIndex = 0;
          result.routes.forEach((route, i) => {
            if (route.legs[0].distance.value < result.routes[shortestIndex].legs[0].distance.value) {
              shortestIndex = i;
            }
          });

          directionsRenderer.setDirections(result);
          directionsRenderer.setRouteIndex(shortestIndex);

          const chosenRoute = result.routes[shortestIndex];
          map.fitBounds(chosenRoute.bounds, {
            top: 40,
            bottom: 40,
            left: 40,
            right: getFormOverlayPx() + 40,
          });

          const leg = chosenRoute.legs[0];
          renderEstimate(leg.distance.value / 1000, leg.duration.value / 60);
        }
      );
    }

    function setupAutocomplete(input, warningId, key, markerColor) {
      const autocomplete = new google.maps.places.Autocomplete(input, {
        fields: ["geometry", "formatted_address"],
        componentRestrictions: { country: "ie" },
        bounds: dublinBounds,
        strictBounds: true,
      });

      const warningEl = document.getElementById(warningId);

      autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();
        const loc = place.geometry && place.geometry.location;

        if (!loc || !dublinBounds.contains(loc)) {
          state[key] = null;
          clearMarker(key);
          if (!loc) input.value = "";
          warningEl?.classList.remove("d-none");
          updateRoute();
          return;
        }

        warningEl?.classList.add("d-none");
        state[key] = { lat: loc.lat(), lng: loc.lng() };
        placeMarker(key, state[key], markerColor);

        if (!state.pickup || !state.dropoff) {
          map.panTo(state[key]);
          map.setZoom(14);
          const overlay = getFormOverlayPx();
          if (overlay > 0) map.panBy(overlay / 2, 0);
        }

        updateRoute();
      });

      input.addEventListener("input", () => {
        state[key] = null;
        clearMarker(key);
        warningEl?.classList.add("d-none");
        resetEstimate();
      });

      input.addEventListener("blur", () => {
        if (input.value.trim() !== "" && !state[key]) {
          warningEl?.classList.remove("d-none");
        }
      });
    }

    setupAutocomplete(pickupInput, "brPickupWarning", "pickup", "#e8590c");
    setupAutocomplete(dropoffInput, "brDropoffWarning", "dropoff", "#1c1410");

    rideTypeSelect?.addEventListener("change", () => {
      const distanceKm = parseFloat(hiddenFields.distanceKm?.value);
      const durationMin = parseFloat(hiddenFields.durationMin?.value);
      if (!isNaN(distanceKm) && !isNaN(durationMin)) {
        renderEstimate(distanceKm, durationMin);
      }
    });

    // Booking now submits over AJAX (see ajax-forms.js) instead of reloading
    // the page, so the map/markers/route need clearing by hand on success.
    pickupInput.closest("form")?.addEventListener("pc:form-success", () => {
      clearMarker("pickup");
      clearMarker("dropoff");
      state.pickup = null;
      state.dropoff = null;
      resetEstimate();
      map.setCenter({ lat: 53.35, lng: -7.9 });
      map.setZoom(7);
    });
  }

  // Reachable by name -- the Maps SDK's own onload callback (see the script
  // tag's ?callback=initGoogleMaps) calls window.initGoogleMaps() directly.
  window.initGoogleMaps = initGoogleMaps;

  // On the very first real page load, the SDK isn't ready yet when this
  // script runs -- its callback fires later and calls window.initGoogleMaps
  // itself. On a repeat PJAX visit the SDK is already loaded (pjax.js skips
  // re-requesting it, so that callback never fires again) -- so if it's
  // already present, this script re-running on each PJAX swap is what
  // initializes the fresh map/inputs instead.
  if (window.google && window.google.maps) {
    initGoogleMaps();
  }
})();
