/**
 * Generic AJAX submission for every "POST to self" form on the site
 * (booking, contact, complaint, feedback, lost item, ambassador/partner
 * sign-up, corporate/business account requests, payment terminal
 * application). The PHP side is untouched -- it still receives a normal
 * POST and renders the full page with a ".alert-success" or ".alert-danger"
 * message baked in, exactly as before. This just submits that POST in the
 * background instead of navigating, shows a small spinner in the submit
 * button while it's in flight, and surfaces the result as a toast instead
 * of a full reload (which was both flashing the full-page loader and
 * resetting scroll position on every submit).
 *
 * Opt a form out with data-no-ajax on the <form>.
 */
function pcInitAjaxForms() {
  document.querySelectorAll('form[method="post"]').forEach((form) => {
    if (form.dataset.ajaxBound) return;
    const action = (form.getAttribute("action") || "").trim();
    // Only forms that post back to the current page (action="" or an
    // in-page anchor) -- that's every form in the project today.
    if (action !== "" && action.charAt(0) !== "#") return;
    if (form.dataset.noAjax !== undefined) return;

    form.dataset.ajaxBound = "1";
    form.addEventListener("submit", pcHandleAjaxSubmit);
  });
}

async function pcHandleAjaxSubmit(event) {
  const form = event.target;
  event.preventDefault();

  const submitBtn = form.querySelector('button[type="submit"]');
  const restoreBtn = pcSetButtonBusy(submitBtn);

  try {
    const formData = new FormData(form);
    const response = await fetch(window.location.href, {
      method: "POST",
      body: formData,
      headers: { "X-Requested-With": "XMLHttpRequest" },
    });

    if (!response.ok) {
      window.pcToast("Something went wrong. Please try again or call us directly.", "error");
      return;
    }

    const html = await response.text();
    const doc = new DOMParser().parseFromString(html, "text/html");
    const successEl = doc.querySelector(".alert-success");
    const errorEl = doc.querySelector(".alert-danger");

    if (successEl) {
      window.pcToast(successEl.textContent.trim(), "success");
      form.reset();
      form.dispatchEvent(new CustomEvent("pc:form-success", { bubbles: true }));
    } else if (errorEl) {
      window.pcToast(errorEl.textContent.trim(), "error");
    } else {
      window.pcToast("Something went wrong. Please try again or call us directly.", "error");
    }
  } catch (err) {
    window.pcToast("Network error -- please check your connection and try again.", "error");
  } finally {
    restoreBtn();
  }
}

/**
 * Disables the button and, in place, swaps just its trailing icon (every
 * submit button on the site ends in a plain <i class="bi ..."> icon) for a
 * small borderless spinner -- the label text stays put, nothing else about
 * the button's size or styling changes. Falls back to appending a spinner
 * if a button doesn't have an icon to swap. Returns a restore function.
 */
function pcSetButtonBusy(btn) {
  if (!btn) return () => {};

  btn.disabled = true;
  const icon = btn.querySelector(":scope > i");

  const spinner = document.createElement("span");
  spinner.className = [
    ...(icon ? Array.from(icon.classList).filter((c) => c !== "bi" && !c.startsWith("bi-")) : ["ms-2"]),
    "pc-btn-icon-spinner",
    "d-inline-block",
    "rounded-circle",
    "bg-transparent",
  ].join(" ");
  spinner.setAttribute("aria-hidden", "true");

  if (icon) {
    icon.replaceWith(spinner);
  } else {
    btn.appendChild(spinner);
  }

  return () => {
    btn.disabled = false;
    if (icon) {
      spinner.replaceWith(icon);
    } else {
      spinner.remove();
    }
  };
}

if (document.readyState !== "loading") {
  pcInitAjaxForms();
} else {
  document.addEventListener("DOMContentLoaded", pcInitAjaxForms);
}
