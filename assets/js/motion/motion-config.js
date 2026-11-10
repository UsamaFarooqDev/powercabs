/* Motion tuning. Separated from the engine so timings can be changed without touching logic.
 *
 * The easing is the curve the site already uses by hand in scroll-scene.js, the item-delivery
 * collage hover and the drive cards -- keeping one curve is most of what makes motion feel like
 * one system rather than several. */
window.pcMotionConfig = {
  /* Seconds. Long enough to read as deliberate, short enough not to be waited on. */
  duration: 0.6,
  easing: 'cubic-bezier(0.22, 1, 0.36, 1)',

  /* Travel distance before a reveal lands. Phones get less: the same 24px reads as a lurch on a
     small viewport, and shorter travel means less time with a promoted layer. */
  distance: '24px',
  distanceMobile: '14px',

  /* Seconds between siblings in a stagger. */
  stagger: 0.08,
  staggerMobile: 0.05,

  /* Start the reveal slightly before the element is fully in view, so it has finished by the
     time it is properly on screen. Negative bottom margin, not a large threshold: a tall element
     would otherwise never reach a high threshold at all. */
  threshold: 0.01,
  rootMargin: '0px 0px -8% 0px',

  /* Below this width parallax is off entirely. */
  desktop: '(min-width: 1024px)',

  /* Where the vendored GSAP build lives, relative to the site root. */
  gsap: '/assets/vendor/gsap/gsap.min.js',
  scrollTrigger: '/assets/vendor/gsap/ScrollTrigger.min.js',
};
