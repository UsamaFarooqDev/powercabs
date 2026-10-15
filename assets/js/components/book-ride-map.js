(function () {


  
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
      preserveViewport: true,
      polylineOptions: { strokeColor: "#e8590c", strokeWeight: 5 },
    });

    const formColEl = document.getElementById("pcRideFormCol");


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
      if (fareBox) fareBox.hidden = true;
      directionsRenderer.set("directions", null);
      ["distanceKm", "durationMin", "fareEur"].forEach((k) => {
        if (hiddenFields[k]) hiddenFields[k].value = "";
      });
    }


    let estimateRequestId = 0;

    function renderEstimate(distanceKm, durationMin) {
      const rideType = rideTypeSelect?.value || "Economy";
      const requestId = ++estimateRequestId;

      if (hiddenFields.distanceKm) hiddenFields.distanceKm.value = distanceKm.toFixed(2);
      if (hiddenFields.durationMin) hiddenFields.durationMin.value = durationMin.toFixed(1);
      if (hiddenFields.fareEur) hiddenFields.fareEur.value = "";


      if (fareValueEl) fareValueEl.textContent = "Calculating…";
      if (fareDistanceEl) fareDistanceEl.textContent = distanceKm.toFixed(1);
      if (fareDurationEl) fareDurationEl.textContent = Math.round(durationMin);
      if (fareBox) fareBox.hidden = false;

      pcFetchFareEstimate(distanceKm, durationMin, rideType)
        .then((estimate) => {
          if (requestId !== estimateRequestId) return;

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


  window.initGoogleMaps = initGoogleMaps;


  if (window.google && window.google.maps) {
    initGoogleMaps();
  }
})();
