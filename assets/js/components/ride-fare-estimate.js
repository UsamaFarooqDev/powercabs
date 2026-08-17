// Wrapped in an IIFE for the same reason as book-ride-map.js: a PJAX
// revisit to this page re-runs this script, and top-level `const` is
// shared across every <script> tag on the page.
(function () {
  const PC_DUBLIN_BOUNDS = { north: 53.45, south: 53.15, east: -6.05, west: -6.55 };

  // Mirrors the passenger app's ride_selection.dart multiplier table (same
  // table used by book-ride-map.js on the booking page).
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
  const PC_DAY_RATES = { base: 4.4, perKm: 1.32, perMinute: 0.2 };
  const PC_NIGHT_RATES = { base: 5.4, perKm: 1.81, perMinute: 0.3 };

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
          submitBtn.innerHTML = originalHTML;
          submitBtn.disabled = false;

          if (status !== "OK" || !result.routes.length) {
            resultBox.classList.add("d-none");
            errorBox.textContent = "Couldn't calculate a route for those locations. Please try again.";
            errorBox.classList.remove("d-none");
            return;
          }

          const leg = result.routes[0].legs[0];
          const distanceKm = leg.distance.value / 1000;
          const durationMin = leg.duration.value / 60;
          const rideType = rideTypeSelect.value;
          const fare = pcCalculateFare(distanceKm, durationMin, rideType);

          lastEstimate = { distanceKm, durationMin, fare, rideType };

          fareTypeLabelEl.textContent = `${rideType} Fare`;
          fareValueEl.textContent = `€${fare.toFixed(2)}`;
          fareDistanceEl.textContent = distanceKm.toFixed(1);
          fareDurationEl.textContent = Math.round(durationMin);
          errorBox.classList.add("d-none");
          resultBox.classList.remove("d-none");

          submitBtn.textContent = "Continue";
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
