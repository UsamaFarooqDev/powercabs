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
  function pcFetchFareEstimate(distanceKm, durationMin, rideType, promoCode) {
    const params = new URLSearchParams({
      distance_km: distanceKm.toFixed(2),
      duration_min: durationMin.toFixed(1),
      ride_type: rideType,
    });
    // The promo code is validated and priced entirely server-side -- this
    // just hands it over. Omitted when blank so the endpoint can tell "no
    // code" from "empty code" and stay silent instead of erroring.
    if (promoCode) params.set("promo_code", promoCode);
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
    const promoInput = document.getElementById("rfPromoCode");
    const promoStatus = document.getElementById("rfPromoStatus");
    const submitBtn = document.getElementById("rfSubmit");
    const locateBtn = document.getElementById("rfLocateBtn");
    const resultBox = document.getElementById("rfFareResult");
    const errorBox = document.getElementById("rfFareError");
    const fareTypeLabelEl = document.getElementById("rfFareTypeLabel");
    const fareValueEl = document.getElementById("rfFareValue");
    const fareDistanceEl = document.getElementById("rfFareDistance");
    const fareDurationEl = document.getElementById("rfFareDuration");
    const promoRow = document.getElementById("rfFarePromoRow");
    const promoCodeEl = document.getElementById("rfFarePromoCode");
    const promoBeforeEl = document.getElementById("rfFarePromoBefore");
    const promoDiscountEl = document.getElementById("rfFarePromoDiscount");
    if (!pickupInput || !dropoffInput || !rideTypeSelect || !submitBtn) return;

    const dublinBounds = new google.maps.LatLngBounds(
      { lat: PC_DUBLIN_BOUNDS.south, lng: PC_DUBLIN_BOUNDS.west },
      { lat: PC_DUBLIN_BOUNDS.north, lng: PC_DUBLIN_BOUNDS.east }
    );

    const state = { pickup: null, dropoff: null };
    let lastEstimate = null; // { distanceKm, durationMin, fare, rideType }
    const directionsService = new google.maps.DirectionsService();

    // Only the two colour classes are swapped -- everything else about the
    // line (size, spacing, leading) is fixed in the markup.
    const PROMO_OK_CLS = "tw-text-[#146c43]";
    const PROMO_ERR_CLS = "tw-text-red-600";

    function setPromoStatus(message, ok) {
      if (!promoStatus) return;
      promoStatus.classList.remove(PROMO_OK_CLS, PROMO_ERR_CLS);
      if (!message) {
        promoStatus.textContent = "";
        promoStatus.classList.add("tw-hidden");
        return;
      }
      promoStatus.textContent = message;
      promoStatus.classList.add(ok ? PROMO_OK_CLS : PROMO_ERR_CLS);
      promoStatus.classList.remove("tw-hidden");
    }

    function resetToEstimateStep() {
      lastEstimate = null;
      resultBox.classList.add("tw-hidden");
      errorBox.classList.add("tw-hidden");
      promoRow?.classList.add("tw-hidden");
      setPromoStatus("", false);
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

    // Editing the code invalidates the fare on screen (the discount is part
    // of it), so drop back to the estimate step -- but never touch
    // updateSubmitState(), since the promo is optional and must not gate
    // the button the way pickup/drop-off/ride type do.
    promoInput?.addEventListener("input", resetToEstimateStep);

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
      if (!lastEstimate || !window.pcModal) return;

      document.getElementById("rfModalPickupText").textContent = pickupInput.value;
      document.getElementById("rfModalDropoffText").textContent = dropoffInput.value;
      document.getElementById("rfModalRideTypeText").textContent = lastEstimate.rideType;
      document.getElementById("rfModalFareText").textContent = `€${lastEstimate.fare.toFixed(2)}`;

      const modalPromoRow = document.getElementById("rfModalPromoRow");
      if (lastEstimate.promoCode) {
        document.getElementById("rfModalPromoCodeText").textContent = `Promo ${lastEstimate.promoCode}`;
        document.getElementById("rfModalPromoDiscountText").textContent = `−€${lastEstimate.promoDiscount.toFixed(2)}`;
        modalPromoRow.classList.remove("tw-hidden");
      } else {
        modalPromoRow.classList.add("tw-hidden");
      }

      document.getElementById("rfModalPickup").value = pickupInput.value;
      document.getElementById("rfModalDropoff").value = dropoffInput.value;
      document.getElementById("rfModalRideType").value = lastEstimate.rideType;
      document.getElementById("rfModalDistance").value = lastEstimate.distanceKm.toFixed(2);
      document.getElementById("rfModalDuration").value = lastEstimate.durationMin.toFixed(1);
      document.getElementById("rfModalFare").value = lastEstimate.fare.toFixed(2);
      document.getElementById("rfModalPromoCode").value = lastEstimate.promoCode || "";

      const modalEl = document.getElementById("rfBookModal");
      window.pcModal.getOrCreateInstance(modalEl).show();
    }

    // ajax-forms.js dispatches this on the modal's <form> once the booking
    // email sends successfully -- close the modal and let the widget be
    // used again for a new estimate.
    const bookForm = document.getElementById("rfBookModal")?.querySelector("form");
    bookForm?.addEventListener("pc:form-success", () => {
      const modalEl = document.getElementById("rfBookModal");
      window.pcModal.getInstance(modalEl)?.hide();

      pickupInput.value = "";
      dropoffInput.value = "";
      rideTypeSelect.value = "";
      if (promoInput) promoInput.value = "";
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
            resultBox.classList.add("tw-hidden");
            errorBox.textContent = "Couldn't calculate a route for those locations. Please try again.";
            errorBox.classList.remove("tw-hidden");
            return;
          }

          const leg = result.routes[0].legs[0];
          const distanceKm = leg.distance.value / 1000;
          const durationMin = leg.duration.value / 60;
          const rideType = rideTypeSelect.value;
          const promoCode = (promoInput?.value || "").trim();
          const requestId = ++estimateRequestId;

          // A lightweight placeholder while the authoritative fare loads --
          // never a fast local guess that then flickers to the real number
          // once the server responds.
          submitBtn.innerHTML = originalHTML;
          fareTypeLabelEl.textContent = `${rideType} Fare`;
          fareValueEl.textContent = "Calculating…";
          fareDistanceEl.textContent = distanceKm.toFixed(1);
          fareDurationEl.textContent = Math.round(durationMin);
          errorBox.classList.add("tw-hidden");
          resultBox.classList.remove("tw-hidden");
          // submitBtn stays disabled until the real fare is in.

          pcFetchFareEstimate(distanceKm, durationMin, rideType, promoCode)
            .then((estimate) => {
              if (requestId !== estimateRequestId) return; // superseded by a newer request

              const discount = Number(estimate.promo_discount) || 0;
              const promoApplied = Boolean(estimate.promo_code) && discount > 0;

              lastEstimate = {
                distanceKm,
                durationMin,
                fare: estimate.fare_eur,
                rideType,
                // The canonical DB spelling, not what was typed -- so a
                // "power10" entry books, and emails, as POWER10.
                promoCode: promoApplied ? estimate.promo_code : "",
                promoDiscount: promoApplied ? discount : 0,
              };

              // fare_eur already has the discount taken off it server-side.
              fareValueEl.textContent = `€${estimate.fare_eur.toFixed(2)}`;

              if (promoApplied) {
                promoCodeEl.textContent = estimate.promo_code;
                promoBeforeEl.textContent = `€${Number(estimate.fare_before_promo).toFixed(2)}`;
                promoDiscountEl.textContent = `−€${discount.toFixed(2)}`;
                promoRow.classList.remove("tw-hidden");
                setPromoStatus(`Promo code ${estimate.promo_code} applied.`, true);
              } else {
                promoRow.classList.add("tw-hidden");
                // A rejected code is a note, not a failure: the fare above
                // is still valid and bookable, so the button carries on to
                // "Continue" either way.
                setPromoStatus(estimate.promo_error || "", false);
              }

              submitBtn.disabled = false;
              submitBtn.textContent = "Continue";
            })
            .catch(() => {
              if (requestId !== estimateRequestId) return;

              submitBtn.disabled = false;
              resultBox.classList.add("tw-hidden");
              errorBox.textContent = "Couldn't calculate a fare right now. Please try again.";
              errorBox.classList.remove("tw-hidden");
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
