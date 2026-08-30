// Wrapped in an IIFE (rather than top-level `const`/`function`) because a
// PJAX revisit to this page re-runs this script a second time -- top-level
// `const` is shared across every <script> tag on the page and throws
// "already declared" if the same name is declared twice. initGoogleMaps
// itself still needs to be reachable by name (window.initGoogleMaps), since
// the Maps SDK's own onload callback calls it that way.
(function () {
  // The Dublin bounds box itself now lives in dublin-places-autocomplete.js
  // (setupAutocomplete below calls into it) -- see that file for the actual
  // coordinates, shared with meet-greet.php's address fields.

  /**
   * The fare is never computed here -- api/estimate_fare.php runs the one
   * shared server-side pricing pipeline (lib/fare_calculator.php) against
   * the real Europe/Dublin clock and the live pricing_config table, so the
   * number shown here always matches what a booking would actually be
   * charged. A previous version of this file duplicated the app's fare math
   * locally (browser clock for day/night, a hard-coded multiplier table)
   * and drifted from the real fare -- see the "Fare mismatch between
   * passenger app and this website" fix.
   */
  function pcFetchFareEstimate(distanceKm, durationMin, rideType) {
    const params = new URLSearchParams({
      distance_km: distanceKm.toFixed(2),
      duration_min: durationMin.toFixed(1),
      ride_type: rideType,
    });
    return fetch(`/api/estimate_fare?${params.toString()}`)
      .then((res) => {
        if (!res.ok) throw new Error("Fare estimate request failed");
        return res.json();
      })
      .then((data) => {
        if (typeof data.fare_eur !== "number") throw new Error("Malformed fare estimate response");
        return data;
      });
  }

  function initGoogleMaps() {
    const mapEl = document.getElementById("pcRideMap");
    const pickupInput = document.getElementById("brPickup");
    const dropoffInput = document.getElementById("brDropoff");
    if (!mapEl || !pickupInput || !dropoffInput) return;

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

    // Bumped on every new request so a slow, now-stale fare response (e.g.
    // the user switched ride type again before it returned) can't land
    // after a newer one already has.
    let estimateRequestId = 0;

    function renderEstimate(distanceKm, durationMin) {
      const rideType = rideTypeSelect?.value || "Economy";
      const requestId = ++estimateRequestId;

      if (hiddenFields.distanceKm) hiddenFields.distanceKm.value = distanceKm.toFixed(2);
      if (hiddenFields.durationMin) hiddenFields.durationMin.value = durationMin.toFixed(1);
      if (hiddenFields.fareEur) hiddenFields.fareEur.value = "";

      // A lightweight placeholder while the authoritative fare loads --
      // never a fast local guess that then flickers to the real number once
      // the server responds.
      if (fareValueEl) fareValueEl.textContent = "Calculating…";
      if (fareDistanceEl) fareDistanceEl.textContent = distanceKm.toFixed(1);
      if (fareDurationEl) fareDurationEl.textContent = Math.round(durationMin);
      fareBox?.classList.remove("d-none");

      pcFetchFareEstimate(distanceKm, durationMin, rideType)
        .then((estimate) => {
          if (requestId !== estimateRequestId) return; // superseded by a newer request

          if (hiddenFields.fareEur) hiddenFields.fareEur.value = estimate.fare_eur.toFixed(2);
          if (fareValueEl) fareValueEl.textContent = `€${estimate.fare_eur.toFixed(2)}`;
        })
        .catch(() => {
          if (requestId !== estimateRequestId) return;
          if (fareValueEl) fareValueEl.textContent = "Unavailable";
        });
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
      const warningEl = document.getElementById(warningId);

      window.pcAttachDublinAutocomplete(input, {
        warningEl,
        isConfirmed: () => !!state[key],
        onPlace: (place, latLng) => {
          state[key] = latLng;
          placeMarker(key, latLng, markerColor);

          if (!state.pickup || !state.dropoff) {
            map.panTo(latLng);
            map.setZoom(14);
            const overlay = getFormOverlayPx();
            if (overlay > 0) map.panBy(overlay / 2, 0);
          }

          updateRoute();
        },
        onClear: () => {
          state[key] = null;
          clearMarker(key);
          resetEstimate();
        },
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
