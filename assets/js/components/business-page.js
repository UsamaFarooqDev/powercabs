
if (window.pcBizStepsObserver) {
  window.pcBizStepsObserver.disconnect();
  window.pcBizStepsObserver = null;
}

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
  pcInitBizStepsReveal();
}

if (document.readyState !== 'loading') {
  pcInitBizPage();
} else {
  document.addEventListener('DOMContentLoaded', pcInitBizPage);
}
