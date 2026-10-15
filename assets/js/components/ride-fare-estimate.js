(function () {
  const PC_DUBLIN_BOUNDS = { north: 53.45, south: 53.15, east: -6.05, west: -6.55 };

  
  function pcFetchFareEstimate(distanceKm, durationMin, rideType, promoCode) {
    const params = new URLSearchParams({
      distance_km: distanceKm.toFixed(2),
      duration_min: durationMin.toFixed(1),
      ride_type: rideType,
    });

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
    let lastEstimate = null;
    const directionsService = new google.maps.DirectionsService();


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
      if (lastEstimate) return;
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


          submitBtn.innerHTML = originalHTML;
          fareTypeLabelEl.textContent = `${rideType} Fare`;
          fareValueEl.textContent = "Calculating…";
          fareDistanceEl.textContent = distanceKm.toFixed(1);
          fareDurationEl.textContent = Math.round(durationMin);
          errorBox.classList.add("tw-hidden");
          resultBox.classList.remove("tw-hidden");


          pcFetchFareEstimate(distanceKm, durationMin, rideType, promoCode)
            .then((estimate) => {
              if (requestId !== estimateRequestId) return;

              const discount = Number(estimate.promo_discount) || 0;
              const promoApplied = Boolean(estimate.promo_code) && discount > 0;

              lastEstimate = {
                distanceKm,
                durationMin,
                fare: estimate.fare_eur,
                rideType,

                promoCode: promoApplied ? estimate.promo_code : "",
                promoDiscount: promoApplied ? discount : 0,
              };


              fareValueEl.textContent = `€${estimate.fare_eur.toFixed(2)}`;

              if (promoApplied) {
                promoCodeEl.textContent = estimate.promo_code;
                promoBeforeEl.textContent = `€${Number(estimate.fare_before_promo).toFixed(2)}`;
                promoDiscountEl.textContent = `−€${discount.toFixed(2)}`;
                promoRow.classList.remove("tw-hidden");
                setPromoStatus(`Promo code ${estimate.promo_code} applied.`, true);
              } else {
                promoRow.classList.add("tw-hidden");

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


  window.initRideFareMap = initRideFareMap;


  if (window.google && window.google.maps) {
    initRideFareMap();
  }
})();
