/**
 * Lightweight PJAX: intercepts same-origin link clicks, fetches the target
 * page, and swaps only <main> instead of doing a full browser navigation --
 * no full-page reload, no full-page loader flash, header/footer/mega-menu
 * stay put.
 *
 * book-ride-online loads the Google Maps JavaScript SDK, which only wants
 * to be loaded once per page -- executeScripts() below skips re-inserting
 * that <script> tag on repeat visits (once window.google.maps exists) and
 * book-ride-map.js self-invokes its init instead of waiting on the SDK's
 * onload callback, which only fires the first time.
 */
(function () {
  function showProgress() {
    let bar = document.getElementById("pcPjaxProgress");
    if (!bar) {
      bar = document.createElement("div");
      bar.id = "pcPjaxProgress";
      bar.className = "pc-pjax-progress";
      document.body.appendChild(bar);
    }
    // Restart the animation if a previous nav's bar is still fading out.
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

  /**
   * Close the mobile nav collapse and any open mega-menu dropdown. Both are
   * outside <main> and never get torn down by a content swap, so without
   * this a dropdown clicked open before navigating (e.g. the About/Contact
   * mega menus, which use data-bs-auto-close="outside" so inside clicks
   * don't dismiss them) is left sitting open on top of the new page.
   */
  function closeOpenMenus() {
    if (!window.bootstrap) return;

    const mainNav = document.getElementById("mainNav");
    if (mainNav && mainNav.classList.contains("show") && bootstrap.Collapse) {
      bootstrap.Collapse.getOrCreateInstance(mainNav).hide();
    }

    if (bootstrap.Dropdown) {
      document.querySelectorAll('.pc-mega-parent > [data-bs-toggle="dropdown"][aria-expanded="true"]').forEach((toggle) => {
        bootstrap.Dropdown.getInstance(toggle)?.hide();
      });
    }
  }

  function executeScripts(container) {
    Array.from(container.querySelectorAll("script")).forEach((oldScript) => {
      const src = oldScript.getAttribute("src") || "";

      // The Google Maps SDK only wants to be loaded once per page -- loading
      // it again on a repeat visit to book-ride-online logs a "included
      // multiple times" warning and can double up its internal state.
      // book-ride-map.js (below) self-invokes its init when it finds the
      // SDK already present, instead of waiting on this script's onload.
      if (src.includes("maps.googleapis.com/maps/api/js") && window.google && window.google.maps) {
        oldScript.remove();
        return;
      }

      const newScript = document.createElement("script");
      for (const attr of oldScript.attributes) {
        newScript.setAttribute(attr.name, attr.value);
      }
      // Scripts that were originally synchronous/parser-ordered (no async or
      // defer attribute) keep executing that same in-order, non-async way --
      // e.g. book-ride-map.js relies on running before the (genuinely async)
      // Google Maps SDK script gets a chance to call back into it. Scripts
      // that explicitly opted into async/defer keep behaving that way.
      if (newScript.src && !oldScript.hasAttribute("async") && !oldScript.hasAttribute("defer")) {
        newScript.async = false;
      }
      newScript.textContent = oldScript.textContent;
      oldScript.replaceWith(newScript);
    });
  }

  // Tracks the current page's identity (path + query, no hash) so the
  // popstate listener below can tell a real page navigation apart from a
  // same-page hash change.
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

      // Update the URL first -- highlightActiveNavLink() reads
      // window.location, so it has to see the *new* URL, not the one we're
      // navigating away from.
      if (push) window.history.pushState({ pcPjax: true }, "", url);
      currentPageKey = window.location.pathname + window.location.search;

      if (window.highlightActiveNavLink) window.highlightActiveNavLink();
      if (window.syncFooterHeightVar) window.syncFooterHeightVar();
      if (window.initHeroParallax) window.initHeroParallax();
      if (window.initWhyChooseReveal) window.initWhyChooseReveal();
      if (window.initScrollReveal) window.initScrollReveal();
      if (window.pcInitAjaxForms) window.pcInitAjaxForms();

      window.scrollTo({ top: 0, behavior: "auto" });
    } catch (err) {
      window.location.href = url; // hard fallback -- never leave the user stuck
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

      // Same-page anchor jump (bare "#id" or a full "path#id" resolving to
      // this same page) -- scroll to it ourselves via scrollIntoView instead
      // of leaving it to the browser's native fragment navigation. Native
      // fragment navigation fires a popstate event for the jump in some
      // browsers, which raced with PJAX's own popstate handling below and
      // got its scroll stomped by navigate()'s scrollTo({top: 0}), snapping
      // the page back to the top right after it started scrolling to the
      // target. Driving the scroll ourselves with our own pushState() avoids
      // that path entirely -- pushState() never fires popstate on its own.
      if (url.hash && url.pathname === window.location.pathname && url.search === window.location.search) {
        const target = document.getElementById(decodeURIComponent(url.hash.slice(1)));
        if (!target) return; // nothing to scroll to -- let the browser try natively

        event.preventDefault();
        window.history.pushState({ pcPjax: true }, "", url.href);
        currentPageKey = url.pathname + url.search;
        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
        target.scrollIntoView({ behavior: reduceMotion ? "auto" : "smooth", block: "start" });
        return;
      }

      // Already on this exact URL -- nothing to do.
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
    // Clicking a same-page hash link (e.g. href="#business-booking-form")
    // also fires popstate in most browsers, not just real back/forward
    // navigation. Re-fetching and swapping <main> for that would be wrong
    // on its own, but it was also actively breaking the anchor jump:
    // navigate() ends with scrollTo({top: 0}), which stomped on the
    // browser's native smooth-scroll-to-anchor mid-flight, snapping the
    // page back to the top right after it started scrolling to the target.
    const newKey = window.location.pathname + window.location.search;
    if (newKey === currentPageKey) return;
    currentPageKey = newKey;
    navigate(window.location.href, { push: false });
  });

  window.history.replaceState({ pcPjax: true }, "", window.location.href);
})();
