<?php
// The Power10 promo runs on a deliberate red accent, not the site orange --
// it is a limited-time campaign and is meant to read as separate from the
// brand furniture around it. Tailwind's red-600/red-700 are exactly the two
// reds this campaign used (#dc2626 / #b91c1c), so they are used directly.
//
// pc-reveal / is-visible stay as bare classnames with no CSS behind them:
// they are the scroll-reveal hook initScrollReveal() in assets/js/main.js
// queries for. The transition itself is Tailwind, on the elements below.
$p10Reveal =
  'pc-reveal tw-relative tw-z-[1] tw-translate-y-6 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[600ms] tw-ease-[cubic-bezier(0.16,1,0.3,1)] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none';
?>
<section class="tw-relative tw-overflow-hidden tw-bg-gradient-to-b tw-from-white tw-to-paper-soft tw-py-[clamp(1.5rem,4vw,3rem)]">
  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-relative tw-overflow-hidden tw-rounded-[clamp(1.5rem,3vw,2.25rem)] tw-border tw-border-solid tw-border-black/[0.06] tw-bg-white tw-p-[clamp(1.75rem,4vw,3.5rem)] tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)]">
      <span class="tw-pointer-events-none tw-absolute tw-right-[-10%] tw-top-[-18%] tw-z-0 tw-h-[26rem] tw-w-[26rem] tw-rounded-full tw-bg-[radial-gradient(circle,rgba(220,38,38,0.08)_0%,transparent_70%)]" aria-hidden="true"></span>
      <span class="tw-pointer-events-none tw-absolute tw-bottom-[-22%] tw-left-[-8%] tw-z-0 tw-h-80 tw-w-80 tw-rounded-full tw-bg-[radial-gradient(circle,#fbe4cf_0%,transparent_70%)] tw-opacity-60" aria-hidden="true"></span>

      <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-8 lg:tw-grid-cols-2 lg:tw-gap-12">
        <!-- LEFT: promotional content -->
        <div class="<?= $p10Reveal ?>">
          <span class="tw-mb-3 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-red-600/[0.08] tw-py-[0.45rem] tw-pl-3 tw-pr-[0.9rem] tw-text-[0.72rem] tw-font-extrabold tw-uppercase tw-tracking-[0.06em] tw-text-red-700">
            <span class="tw-h-[0.45rem] tw-w-[0.45rem] tw-shrink-0 tw-animate-pc-dot-pulse tw-rounded-full tw-bg-red-600 motion-reduce:tw-animate-none" aria-hidden="true"></span>
            Limited Time Offer
          </span>

          <h2 class="tw-mb-2 tw-text-[clamp(2.1rem,4vw,3rem)] tw-font-extrabold tw-leading-[1.1] tw-tracking-[-0.02em] tw-text-ink">Meet <span class="tw-text-red-600">Power10</span></h2>
          <p class="tw-mb-3 tw-text-[clamp(1.1rem,2vw,1.35rem)] tw-font-semibold tw-text-ink">Get <strong class="tw-font-extrabold tw-text-red-600">10% OFF</strong> your next ride</p>
          <p class="tw-mb-4 tw-max-w-[42ch] tw-text-[1.02rem] tw-leading-[1.7] tw-text-ink/[0.65]">
            Ride more and save more with Power10. Enjoy an exclusive 10%
            discount on your PowerCabs rides.
          </p>

          <div class="tw-mb-4 tw-flex tw-flex-wrap tw-items-center tw-gap-3">
            <!-- Dashed border is the "coupon" cue -- keep it, and note the
                 button must NOT carry tw-border-0 or it disappears. -->
            <button type="button" class="tw-inline-flex tw-cursor-pointer tw-appearance-none tw-items-center tw-gap-[0.6rem] tw-rounded-2xl tw-border-[1.5px] tw-border-dashed tw-border-red-600 tw-bg-red-600/[0.08] tw-px-[1.1rem] tw-py-[0.65rem] tw-text-red-700 tw-transition-[background-color,transform] tw-duration-[250ms] hover:tw-bg-red-600/[0.14] focus-visible:tw-bg-red-600/[0.14] active:tw-translate-y-0 motion-reduce:tw-transition-none" id="power10CopyBtn" data-code="POWER10" aria-label="Copy promo code POWER10">
              <span class="tw-hidden tw-text-[0.68rem] tw-font-bold tw-uppercase tw-tracking-[0.05em] tw-opacity-75 sm:tw-block">Promo Code</span>
              <span class="tw-text-[1.05rem] tw-font-extrabold tw-tracking-[0.06em]">POWER10</span>
              <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15.666 3.888A2.25 2.25 0 0013.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 01-.75.75H9a.75.75 0 01-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 01-2.25 2.25H6.75A2.25 2.25 0 014.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 011.927-.184"/></svg>
            </button>
            <span class="tw-pointer-events-none tw-inline-flex -tw-translate-x-1.5 tw-items-center tw-gap-[0.35rem] tw-text-sm tw-font-bold tw-text-[#198754] tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[250ms] [&.is-visible]:tw-translate-x-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-transition-none" id="power10CopiedMsg" aria-live="polite">
              <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg> Copied!
            </span>
          </div>

          <a href="<?= $assetPath ?>/book-ride-online" class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-[linear-gradient(90deg,#dc2626_0%,#b91c1c_100%)] tw-px-[1.65rem] tw-py-[0.45rem] tw-font-medium tw-text-white tw-no-underline tw-shadow-[0_14px_28px_rgba(220,38,38,0.28)] tw-transition-[transform,box-shadow,filter] tw-duration-[250ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] hover:tw-text-white hover:tw-brightness-105 hover:tw-shadow-[0_18px_36px_rgba(220,38,38,0.35)] focus-visible:tw-brightness-105 focus-visible:tw-shadow-[0_18px_36px_rgba(220,38,38,0.35)] active:-tw-translate-y-px motion-reduce:tw-transition-none">
            Book a Ride <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 011.06 0l6.5 6.5a.75.75 0 010 1.06l-6.5 6.5a.75.75 0 11-1.06-1.06L14.19 12 8.22 6.03a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
          </a>
        </div>

        <!-- RIGHT: promotional image. 0.12s behind the copy so the two halves
             reveal in sequence rather than together. -->
        <div class="<?= $p10Reveal ?> [transition-delay:0.12s]">
          <div class="tw-group tw-relative tw-mx-auto tw-max-w-[320px] lg:tw-max-w-[420px]">
            <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-rotate-[6deg] tw-scale-[0.96] tw-rounded-[clamp(1.25rem,3vw,2rem)] tw-bg-[linear-gradient(135deg,#dc2626_0%,#fbe4cf_100%)] tw-opacity-25" aria-hidden="true"></span>
            <div class="tw-relative tw-z-[1] tw-aspect-square tw-overflow-hidden tw-rounded-[clamp(1.25rem,3vw,2rem)] tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)]">
              <img
                src="https://img.magnific.com/free-vector/special-promo-code-get-10-percent-off_1017-53815.jpg?semt=ais_hybrid&w=740&q=80"
                alt="Power10 promotional graphic -- use promo code POWER10 to get 10% off your PowerCabs ride"
                class="tw-block tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 tw-ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:tw-scale-105 motion-reduce:tw-transition-none" loading="lazy" width="740" height="740">
            </div>
            <span class="tw-absolute tw-bottom-[-1rem] tw-left-4 tw-z-[2] tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-white tw-px-[0.9rem] tw-py-2 tw-text-[0.76rem] tw-font-bold tw-text-ink tw-shadow-[0_24px_48px_rgba(232,89,12,0.14)]">
              PowerCabs Exclusive
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  (function () {
    var btn = document.getElementById('power10CopyBtn');
    var msg = document.getElementById('power10CopiedMsg');
    if (!btn || !msg) return;

    var hideTimer = null;
    btn.addEventListener('click', function () {
      var code = btn.getAttribute('data-code') || 'POWER10';

      function reveal() {
        msg.classList.add('is-visible');
        clearTimeout(hideTimer);
        hideTimer = setTimeout(function () {
          msg.classList.remove('is-visible');
        }, 1800);
      }

      if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(code).then(reveal, reveal);
      } else {
        reveal();
      }
    });
  })();
</script>
