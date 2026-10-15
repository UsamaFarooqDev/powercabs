
(function () {
  function showProgress() {
    let bar = document.getElementById("pcPjaxProgress");
    if (!bar) {
      bar = document.createElement("div");
      bar.id = "pcPjaxProgress";

      bar.className =
        "tw-fixed tw-left-0 tw-top-0 tw-z-[2100] tw-h-[3px] tw-w-0 tw-opacity-0 " +
        "tw-bg-[linear-gradient(90deg,#e8590c_0%,#ff7a00_100%)] " +
        "tw-transition-[width,opacity] tw-duration-200 " +

        "[&.is-active]:tw-w-4/5 [&.is-active]:tw-opacity-100 " +
        "[&.is-active]:[transition:width_4s_cubic-bezier(0.1,0.6,0.3,1),opacity_0.2s_ease] " +
        "[&.is-done]:tw-w-full [&.is-done]:tw-opacity-0 " +
        "[&.is-done]:[transition:width_0.2s_ease,opacity_0.3s_ease_0.1s] " +
        "motion-reduce:[transition:none]";
      document.body.appendChild(bar);
    }

    bar.classList.remove("is-active", "is-done");
    void bar.offsetWidth;
    bar.classList.add("is-active");
  }

  function hideProgress() {
    const bar = document.getElementById("pcPjaxProgress");
    if (!bar) return;
    bar.classList.add("is-done");
    window.setTimeout(() => bar.classList.remove("is-active", "is-done"), 300);
  }

  function syncMetaContent(selector, doc) {
    const fresh = doc.querySelector(selector);
    const current = document.querySelector(selector);
    if (fresh && current) current.setAttribute("content", fresh.getAttribute("content") || "");
  }

  function syncLinkHref(selector, doc) {
    const fresh = doc.querySelector(selector);
    const current = document.querySelector(selector);
    if (fresh && current) current.setAttribute("href", fresh.getAttribute("href") || "");
  }

function closeOpenMenus() {
    if (typeof window.pcCloseNav === "function") window.pcCloseNav();
  }

  function executeScripts(container) {
    Array.from(container.querySelectorAll("script")).forEach((oldScript) => {
      const src = oldScript.getAttribute("src") || "";

if (src.includes("maps.googleapis.com/maps/api/js") && window.google && window.google.maps) {
        oldScript.remove();
        return;
      }

      const newScript = document.createElement("script");
      for (const attr of oldScript.attributes) {
        newScript.setAttribute(attr.name, attr.value);
      }

      if (newScript.src && !oldScript.hasAttribute("async") && !oldScript.hasAttribute("defer")) {
        newScript.async = false;
      }
      newScript.textContent = oldScript.textContent;
      oldScript.replaceWith(newScript);
    });
  }

let currentPageKey = window.location.pathname + window.location.search;

  async function navigate(url, { push = true } = {}) {
    closeOpenMenus();
    showProgress();
    try {
      const response = await fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" } });
      if (!response.ok) throw new Error(`HTTP ${response.status}`);

      const html = await response.text();
      const doc = new DOMParser().parseFromString(html, "text/html");
      const newMain = doc.querySelector("main");
      const oldMain = document.querySelector("main");
      if (!newMain || !oldMain) throw new Error("no <main> found");

      oldMain.innerHTML = newMain.innerHTML;
      document.title = doc.title;
      document.body.dataset.page = doc.body ? doc.body.dataset.page || "" : "";

      syncMetaContent('meta[name="description"]', doc);
      syncLinkHref('link[rel="canonical"]', doc);
      syncMetaContent('meta[property="og:title"]', doc);
      syncMetaContent('meta[property="og:description"]', doc);
      syncMetaContent('meta[property="og:url"]', doc);

      executeScripts(oldMain);

if (push) window.history.pushState({ pcPjax: true }, "", url);
      currentPageKey = window.location.pathname + window.location.search;

      if (window.highlightActiveNavLink) window.highlightActiveNavLink();
      if (window.syncFooterHeightVar) window.syncFooterHeightVar();
      if (window.initHeroParallax) window.initHeroParallax();
      if (window.initWhyChooseReveal) window.initWhyChooseReveal();
      if (window.initScrollReveal) window.initScrollReveal();

      if (window.pcInitAjaxForms) window.pcInitAjaxForms();

      if (window.pcInitUi) window.pcInitUi();

      if (window.pcInitScrollScenes) window.pcInitScrollScenes();

// New globals that must survive a <main> swap get added to this list.
      if (window.pcInitDriverTraining) window.pcInitDriverTraining();

      window.scrollTo({ top: 0, behavior: "auto" });
    } catch (err) {
      window.location.href = url;
      return;
    } finally {
      hideProgress();
    }
  }

  document.addEventListener(
    "click",
    (event) => {
      if (event.defaultPrevented || event.button !== 0) return;
      if (event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;

      const link = event.target.closest("a[href]");
      if (!link) return;
      if (link.target && link.target !== "_self") return;
      if (link.hasAttribute("download")) return;
      if (link.dataset.noPjax !== undefined) return;

      const href = link.getAttribute("href") || "";
      if (href === "" || /^(mailto|tel|javascript):/i.test(href)) return;

      let url;
      try {
        url = new URL(href, window.location.href);
      } catch (e) {
        return;
      }
      if (url.origin !== window.location.origin) return;

if (url.hash && url.pathname === window.location.pathname && url.search === window.location.search) {
        const target = document.getElementById(decodeURIComponent(url.hash.slice(1)));
        if (!target) return;

        event.preventDefault();
        window.history.pushState({ pcPjax: true }, "", url.href);
        currentPageKey = url.pathname + url.search;
        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        target.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "start" });
        return;
      }

if (url.pathname === window.location.pathname && url.search === window.location.search) {
        event.preventDefault();
        return;
      }

      event.preventDefault();
      navigate(url.href);
    },
    { capture: true }
  );

  window.addEventListener("popstate", () => {
const newKey = window.location.pathname + window.location.search;
    if (newKey === currentPageKey) return;
    currentPageKey = newKey;
    navigate(window.location.href, { push: false });
  });

  window.history.replaceState({ pcPjax: true }, "", window.location.href);
})();
