if (window.pcPtnGrowthParallaxCleanup) {
  window.pcPtnGrowthParallaxCleanup();
  window.pcPtnGrowthParallaxCleanup = null;
}
if (window.pcPtnStepsObserver) {
  window.pcPtnStepsObserver.disconnect();
  window.pcPtnStepsObserver = null;
}

/** Eased scroll parallax on the "Grow With Us" section photo. */
function pcInitPtnGrowthParallax() {
  const section = document.getElementById('pcPtnGrowth');
  const img = document.getElementById('pcPtnGrowthImg');
  if (!section || !img) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const EASE = 0.08;
  let targetShift = 0;
  let currentShift = 0;
  let rafId = null;

  const computeTarget = () => {
    const rect = section.getBoundingClientRect();
    const progress = rect.height ? -rect.top / rect.height : 0;
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
  window.pcPtnGrowthParallaxCleanup = () => {
    window.removeEventListener('scroll', onScroll);
    window.removeEventListener('resize', onScroll);
    if (rafId !== null) cancelAnimationFrame(rafId);
  };
}

/** One-shot staggered reveal for the join-process steps. */
function pcInitPtnReveal() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
  if (!('IntersectionObserver' in window)) return;

  const steps = document.querySelectorAll('.pc-ptn-step-grid .pc-ptn-step-card');
  if (!steps.length) return;

  window.pcPtnStepsObserver = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.3 },
  );
  steps.forEach((step) => window.pcPtnStepsObserver.observe(step));
}

function pcInitPtnPage() {
  pcInitPtnGrowthParallax();
  pcInitPtnReveal();
}

if (document.readyState !== 'loading') {
  pcInitPtnPage();
} else {
  document.addEventListener('DOMContentLoaded', pcInitPtnPage);
}
