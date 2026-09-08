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
    // top offset tracks the live-measured navbar height so a toast never
    // slides in underneath the fixed header.
    container.className =
      "tw-fixed tw-right-4 tw-top-[calc(var(--pc-navbar-h,90px)+1rem)] tw-z-[2050] tw-flex tw-max-w-[min(360px,calc(100vw-2rem))] tw-flex-col tw-gap-[0.6rem]";
    container.setAttribute("aria-live", "polite");
    container.setAttribute("aria-atomic", "true");
    document.body.appendChild(container);
  }

  const isSuccess = type === "success";
  const accent = isSuccess ? "tw-border-l-[#198754]" : "tw-border-l-[#dc3545]";

  const toast = document.createElement("div");
  // is-visible is toggled below to drive the slide/fade, so the two
  // visible-state utilities hang off an [&.is-visible]: variant.
  toast.className =
    "tw-flex tw-items-center tw-gap-[0.6rem] tw-rounded-2xl tw-border-0 tw-border-l-4 tw-border-solid tw-bg-white tw-px-4 tw-py-[0.85rem] tw-text-sm tw-text-ink tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)] -tw-translate-y-2 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[250ms] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-transition-none " +
    accent;
  toast.setAttribute("role", "status");

  const icon = document.createElement("span");
  icon.className = "tw-shrink-0 " + (isSuccess ? "tw-text-[#198754]" : "tw-text-[#dc3545]");
  icon.innerHTML = isSuccess
    ? '<svg class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M16 8A8 8 0 110 8a8 8 0 0116 0zm-3.97-3.03a.75.75 0 00-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 10-1.06 1.06L6.97 11.03a.75.75 0 001.079-.02l3.992-4.99a.75.75 0 00-.01-1.05z"/></svg>'
    : '<svg class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8.982 1.566a1.13 1.13 0 00-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 01-1.1 0L7.1 5.995A.905.905 0 018 5zm.002 6a1 1 0 110 2 1 1 0 010-2z"/></svg>';
  icon.setAttribute("aria-hidden", "true");

  const text = document.createElement("span");
  text.className = "tw-flex-1 tw-leading-snug";
  text.textContent = message;

  const closeBtn = document.createElement("button");
  closeBtn.type = "button";
  closeBtn.className =
    "tw-shrink-0 tw-cursor-pointer tw-appearance-none tw-border-0 tw-bg-transparent tw-px-0.5 tw-text-xl tw-leading-none tw-text-ink/[0.65] hover:tw-text-ink";
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
