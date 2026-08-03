/**
 * "Choose Your Ride" horizontal showcase -- Apple-product-page style
 * pinned scroll: the section holds in place while the card track
 * translates horizontally, driven by GSAP ScrollTrigger's scrub so it
 * tracks the scroll/swipe gesture directly in both directions. Runs the
 * same way on desktop and mobile -- a vertical scroll or a vertical
 * touch-swipe both drive the same horizontal motion, so no separate
 * touch-handling path is needed.
 *
 * Progressive enhancement: the track is a plain horizontally-scrollable
 * flex row by default (see .pc-ride-track-viewport in components.css),
 * so the section is fully usable with zero JS, a failed CDN load, or
 * prefers-reduced-motion. Only once GSAP + ScrollTrigger are confirmed
 * loaded (and motion isn't reduced) do we clip the viewport and take
 * over the horizontal position ourselves.
 *
 * Waits for window "load" (not DOMContentLoaded) so the card images have
 * already laid out -- ScrollTrigger needs the track's real scrollWidth
 * to compute the pin/scrub distance, and --pc-navbar-h (read below) is
 * only guaranteed accurate once main.js's own DOMContentLoaded handler
 * has run.
 */
window.addEventListener("load", initRideScroll);

function initRideScroll() {
  const section = document.getElementById("pcRideShowcase");
  const viewport = document.getElementById("pcRideViewport");
  const track = document.getElementById("pcRideTrack");
  if (!section || !viewport || !track) return;

  const prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (prefersReducedMotion || typeof gsap === "undefined" || typeof ScrollTrigger === "undefined") {
    return; // native overflow-x scroll (CSS default) stays in charge
  }

  gsap.registerPlugin(ScrollTrigger);
  viewport.classList.add("pc-ride-js-active");

  const scrollDistance = () => Math.max(0, track.scrollWidth - viewport.clientWidth);
  const navbarOffset = () => {
    const raw = parseInt(getComputedStyle(document.documentElement).getPropertyValue("--pc-navbar-h"), 10);
    return (Number.isNaN(raw) ? 110 : raw) + 16;
  };

  gsap.to(track, {
    x: () => -scrollDistance(),
    ease: "none",
    scrollTrigger: {
      trigger: section,
      start: () => "top top+=" + navbarOffset(),
      end: () => "+=" + scrollDistance(),
      scrub: 0.6,
      pin: true,
      anticipatePin: 1,
      invalidateOnRefresh: true,
    },
  });
}
