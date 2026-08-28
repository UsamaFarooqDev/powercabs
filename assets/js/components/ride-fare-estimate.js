// Wrapped in an IIFE for the same reason as book-ride-map.js: a PJAX
// revisit to this page re-runs this script, and top-level `const` is
// shared across every <script> tag on the page.
(function () {
  const PC_DUBLIN_BOUNDS = { north: 53.45, south: 53.15, east: -6.05, west: -6.55 };

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

  /**
   * The booking modal is authored inside <main>, but at desktop widths the
   * footer-reveal mechanism gives <main> its own `position: relative;
   * z-index: 1`, which traps the modal's stacking below Bootstrap's
   * body-level backdrop (z-index 1050) no matter what z-index the modal
   * itself has. Relocating it to a direct child of <body> escapes that
   * (same fix as the city-tours modal). A previous PJAX visit may have
   * already relocated a copy, so drop that stale one first.
   */
  function relocateModal() {
    const modalEl = document.getElementById("rfBookModal");
    if (!modalEl) return;
    document.querySelectorAll("#rfBookModal").forEach((el) => {
      if (el !== modalEl) el.remove();
    });
    document.body.appendChild(modalEl);
  }

  function initRideFareMap() {
    relocateModal();

    const pickupInput = document.getElementById("rfPickup");
    const dropoffInput = document.getElementById("rfDropoff");
    const rideTypeSelect = document.getElementById("rfRideType");
    const submitBtn = document.getElementById("rfSubmit");
    const locateBtn = document.getElementById("rfLocateBtn");
    const resultBox = document.getElementById("rfFareResult");
    const errorBox = document.getElementById("rfFareError");
    const fareTypeLabelEl = document.getElementById("rfFareTypeLabel");
    const fareValueEl = document.getElementById("rfFareValue");
    const fareDistanceEl = document.getElementById("rfFareDistance");
    const fareDurationEl = document.getElementById("rfFareDuration");
    if (!pickupInput || !dropoffInput || !rideTypeSelect || !submitBtn) return;

    const dublinBounds = new google.maps.LatLngBounds(
      { lat: PC_DUBLIN_BOUNDS.south, lng: PC_DUBLIN_BOUNDS.west },
      { lat: PC_DUBLIN_BOUNDS.north, lng: PC_DUBLIN_BOUNDS.east }
    );

    const state = { pickup: null, dropoff: null };
    let lastEstimate = null; // { distanceKm, durationMin, fare, rideType }
    const directionsService = new google.maps.DirectionsService();

    function resetToEstimateStep() {
      lastEstimate = null;
      resultBox.classList.add("d-none");
      errorBox.classList.add("d-none");
      submitBtn.textContent = "Get Fare Estimate";
    }

    function updateSubmitState() {
      if (lastEstimate) return; // button is in "Continue" mode, always enabled once reached
      submitBtn.disabled = !(state.pickup && state.dropoff && rideTypeSelect.value);
    }

    function setupAutocomplete(input, key) {
      const autocomplete = new google.maps.places.Autocomplete(input, {
        fields: ["geometry", "formatted_address"],
        componentRestrictions: { country: "ie" },
        bounds: dublinBounds,
        strictBounds: true,
      });

      autocomplete.addListener("place_changed", () => {
        const place = autocomplete.getPlace();
        const loc = place.geometry && place.geometry.location;
        state[key] = loc ? { lat: loc.lat(), lng: loc.lng() } : null;
        resetToEstimateStep();
        updateSubmitState();
      });

      input.addEventListener("input", () => {
        state[key] = null;
        resetToEstimateStep();
        updateSubmitState();
      });
    }

    setupAutocomplete(pickupInput, "pickup");
    setupAutocomplete(dropoffInput, "dropoff");

    rideTypeSelect.addEventListener("change", () => {
      resetToEstimateStep();
      updateSubmitState();
    });

    locateBtn?.addEventListener("click", () => {
      if (!navigator.geolocation) return;
      locateBtn.disabled = true;

      navigator.geolocation.getCurrentPosition(
        (pos) => {
          const loc = { lat: pos.coords.latitude, lng: pos.coords.longitude };
          new google.maps.Geocoder().geocode({ location: loc }, (results, status) => {
            locateBtn.disabled = false;
            if (status === "OK" && results[0]) {
              pickupInput.value = results[0].formatted_address;
              state.pickup = loc;
              resetToEstimateStep();
              updateSubmitState();
            }
          });
        },
        () => {
          locateBtn.disabled = false;
        }
      );
    });

    function openBookModal() {
      if (!lastEstimate || !window.bootstrap) return;

      document.getElementById("rfModalPickupText").textContent = pickupInput.value;
      document.getElementById("rfModalDropoffText").textContent = dropoffInput.value;
      document.getElementById("rfModalRideTypeText").textContent = lastEstimate.rideType;
      document.getElementById("rfModalFareText").textContent = `€${lastEstimate.fare.toFixed(2)}`;

      document.getElementById("rfModalPickup").value = pickupInput.value;
      document.getElementById("rfModalDropoff").value = dropoffInput.value;
      document.getElementById("rfModalRideType").value = lastEstimate.rideType;
      document.getElementById("rfModalDistance").value = lastEstimate.distanceKm.toFixed(2);
      document.getElementById("rfModalDuration").value = lastEstimate.durationMin.toFixed(1);
      document.getElementById("rfModalFare").value = lastEstimate.fare.toFixed(2);

      const modalEl = document.getElementById("rfBookModal");
      bootstrap.Modal.getOrCreateInstance(modalEl).show();
    }

    // ajax-forms.js dispatches this on the modal's <form> once the booking
    // email sends successfully -- close the modal and let the widget be
    // used again for a new estimate.
    const bookForm = document.getElementById("rfBookModal")?.querySelector("form");
    bookForm?.addEventListener("pc:form-success", () => {
      const modalEl = document.getElementById("rfBookModal");
      bootstrap.Modal.getInstance(modalEl)?.hide();

      pickupInput.value = "";
      dropoffInput.value = "";
      rideTypeSelect.value = "";
      state.pickup = null;
      state.dropoff = null;
      resetToEstimateStep();
      updateSubmitState();
    });

    // Bumped on every new request so a slow, now-stale fare response (e.g.
    // the user changed ride type again before it returned) can't land after
    // a newer one already has.
    let estimateRequestId = 0;

    submitBtn.addEventListener("click", () => {
      if (lastEstimate) {
        openBookModal();
        return;
      }
      if (!state.pickup || !state.dropoff || !rideTypeSelect.value) return;

      submitBtn.disabled = true;
      const originalHTML = submitBtn.innerHTML;
      submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';

      directionsService.route(
        {
          origin: state.pickup,
          destination: state.dropoff,
          travelMode: google.maps.TravelMode.DRIVING,
        },
        (result, status) => {
          if (status !== "OK" || !result.routes.length) {
            submitBtn.innerHTML = originalHTML;
            submitBtn.disabled = false;
            resultBox.classList.add("d-none");
            errorBox.textContent = "Couldn't calculate a route for those locations. Please try again.";
            errorBox.classList.remove("d-none");
            return;
          }

          const leg = result.routes[0].legs[0];
          const distanceKm = leg.distance.value / 1000;
          const durationMin = leg.duration.value / 60;
          const rideType = rideTypeSelect.value;
          const requestId = ++estimateRequestId;

          // A lightweight placeholder while the authoritative fare loads --
          // never a fast local guess that then flickers to the real number
          // once the server responds.
          submitBtn.innerHTML = originalHTML;
          fareTypeLabelEl.textContent = `${rideType} Fare`;
          fareValueEl.textContent = "Calculating…";
          fareDistanceEl.textContent = distanceKm.toFixed(1);
          fareDurationEl.textContent = Math.round(durationMin);
          errorBox.classList.add("d-none");
          resultBox.classList.remove("d-none");
          // submitBtn stays disabled until the real fare is in.

          pcFetchFareEstimate(distanceKm, durationMin, rideType)
            .then((estimate) => {
              if (requestId !== estimateRequestId) return; // superseded by a newer request

              lastEstimate = { distanceKm, durationMin, fare: estimate.fare_eur, rideType };
              fareValueEl.textContent = `€${estimate.fare_eur.toFixed(2)}`;
              submitBtn.disabled = false;
              submitBtn.textContent = "Continue";
            })
            .catch(() => {
              if (requestId !== estimateRequestId) return;

              submitBtn.disabled = false;
              resultBox.classList.add("d-none");
              errorBox.textContent = "Couldn't calculate a fare right now. Please try again.";
              errorBox.classList.remove("d-none");
            });
        }
      );
    });
  }

  // Reachable by name -- the Maps SDK's onload callback calls
  // window.initRideFareMap() directly (see the script tag's ?callback=).
  window.initRideFareMap = initRideFareMap;

  // Repeat PJAX visit: the SDK is already loaded and its callback won't
  // fire again, so self-invoke instead (mirrors book-ride-map.js).
  if (window.google && window.google.maps) {
    initRideFareMap();
  }
})();
