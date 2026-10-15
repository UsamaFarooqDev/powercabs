
function pcInitAjaxForms() {
  document.querySelectorAll('form[method="post"]').forEach((form) => {
    if (form.dataset.ajaxBound) return;
    const action = (form.getAttribute("action") || "").trim();

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

function pcSetButtonBusy(btn) {
  if (!btn) return () => {};

  btn.disabled = true;
  const icon = btn.querySelector(":scope > svg, :scope > i");

const spinner = document.createElement("span");
  spinner.className = [
    icon ? "" : "tw-ml-2",
    "tw-inline-block tw-h-[0.85rem] tw-w-[0.85rem] tw-shrink-0 tw-animate-spin tw-rounded-full",
    "tw-border-2 tw-border-solid tw-border-transparent tw-border-t-current tw-bg-transparent",
    "tw-align-[-0.1em] motion-reduce:[animation-duration:1.4s]",
  ]
    .filter(Boolean)
    .join(" ");
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
