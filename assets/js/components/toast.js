/**
 * Shared toast notifications. Exposes window.pcToast(message, type),
 * type is "success" | "error". Used by ajax-forms.js (and available for
 * anything else, e.g. pjax.js, that wants a lightweight status message
 * without a full-page reload).
 */
window.pcToast = function pcToast(message, type) {
  if (!message) return;

  let container = document.getElementById("pcToastContainer");
  if (!container) {
    container = document.createElement("div");
    container.id = "pcToastContainer";
    container.className = "pc-toast-container";
    container.setAttribute("aria-live", "polite");
    container.setAttribute("aria-atomic", "true");
    document.body.appendChild(container);
  }

  const toast = document.createElement("div");
  toast.className = `pc-toast pc-toast-${type === "success" ? "success" : "error"}`;
  toast.setAttribute("role", "status");

  const icon = document.createElement("i");
  icon.className = `bi ${type === "success" ? "bi-check-circle-fill" : "bi-exclamation-triangle-fill"}`;
  icon.setAttribute("aria-hidden", "true");

  const text = document.createElement("span");
  text.textContent = message;

  const closeBtn = document.createElement("button");
  closeBtn.type = "button";
  closeBtn.className = "pc-toast-close";
  closeBtn.setAttribute("aria-label", "Dismiss");
  closeBtn.innerHTML = "&times;";

  toast.append(icon, text, closeBtn);
  container.appendChild(toast);

  requestAnimationFrame(() => toast.classList.add("is-visible"));

  let dismissTimer = window.setTimeout(dismiss, 6000);

  function dismiss() {
    window.clearTimeout(dismissTimer);
    toast.classList.remove("is-visible");
    toast.addEventListener("transitionend", () => toast.remove(), { once: true });
    // Fallback in case the transition never fires (e.g. display:none ancestor).
    window.setTimeout(() => toast.remove(), 500);
  }

  closeBtn.addEventListener("click", dismiss);
};
