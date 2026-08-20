if (window.pcBizIrelandParallaxCleanup) {
  window.pcBizIrelandParallaxCleanup();
  window.pcBizIrelandParallaxCleanup = null;
}
if (window.pcBizStepsObserver) {
  window.pcBizStepsObserver.disconnect();
  window.pcBizStepsObserver = null;
}

function pcInitBizIrelandParallax() {
  const section = document.getElementById('pcBizIreland');
  const img = document.getElementById('pcBizIrelandImg');
  if (!section || !img) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const EASE = 0.08;
  let targetShift = 0;
  let currentShift = 0;
  let rafId = null;

  const computeTarget = () => {
    const rect = section.getBoundingClientRect();
    const progress = rect.height ? -rect.top / rect.height : 0;
    // Small, capped range -- this should read as depth, not motion.
    targetShift = Math.max(-1, Math.min(1, progress)) * 42;
  };

  const render = () => {
    img.style.transform = `scale(1.12) translateY(${currentShift}px)`;
  };

  const tick = () => {
    currentShift += (targetShift - currentShift) * EASE;

    if (Math.abs(targetShift - currentShift) > 0.05) {
      render();
      rafId = requestAnimationFrame(tick);
    } else {
      currentShift = targetShift;
      render();
      rafId = null;
    }
  };

  const onScroll = () => {
    computeTarget();
    if (rafId === null) rafId = requestAnimationFrame(tick);
  };

  computeTarget();
  currentShift = targetShift;
  render();
  window.addEventListener('scroll', onScroll, { passive: true });
  window.addEventListener('resize', onScroll);
  window.pcBizIrelandParallaxCleanup = () => {
    window.removeEventListener('scroll', onScroll);
    window.removeEventListener('resize', onScroll);
    if (rafId !== null) cancelAnimationFrame(rafId);
  };
}

/** Staggered reveal for the "How It Works" step timeline. */
function pcInitBizStepsReveal() {
  const steps = document.querySelectorAll('#pcBizHowItWorks .pc-biz-step');
  if (!steps.length) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  if (!('IntersectionObserver' in window)) return;

  window.pcBizStepsObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        entry.target.classList.toggle('is-visible', entry.isIntersecting);
      });
    },
    { threshold: 0.3 },
  );

  steps.forEach((step) => window.pcBizStepsObserver.observe(step));
}

function pcInitBizPage() {
  pcInitBizIrelandParallax();
  pcInitBizStepsReveal();
}

if (document.readyState !== 'loading') {
  pcInitBizPage();
} else {
  document.addEventListener('DOMContentLoaded', pcInitBizPage);
}
