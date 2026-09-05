<?php
// "PowerCabs Partner Network" panel -- sits right after the standard
// components/shared/inner-hero.php banner (now restored above this, same
// as every other inner page) rather than replacing it. This panel is the
// client's reference-design two-column hero + floating stat strip; it just
// isn't the page's actual <hero> anymore, so it no longer emits its own
// breadcrumb JSON-LD -- inner-hero.php already does that once, above.

// Every figure here is a true, qualitative claim already established
// elsewhere on this page (benefits.php's own list, the 4-step join
// process) -- deliberately no invented partner counts, prize pools or
// coverage numbers standing in for real business data we don't have.
$ptnHeroProof = [
  ['value' => 'Weekly', 'label' => 'payments, always on time'],
  ['value' => 'Dedicated', 'label' => 'partner support team'],
  ['value' => '4 Steps', 'label' => 'from registration to trips'],
];

$ptnHeroStats = [
  ['label' => 'Grow', 'desc' => 'Increased bookings'],
  ['label' => 'Support', 'desc' => 'Dedicated partner team'],
  ['label' => 'Weekly', 'desc' => 'Guaranteed payments'],
  ['label' => 'Tech', 'desc' => 'Booking platform access'],
];
?>

<!-- ============ PowerCabs Partner Network panel ============ -->
<section class="tw-relative tw-overflow-hidden tw-bg-[linear-gradient(135deg,#f4efe8_0%,#f9f4ed_48%,#ffffff_100%)] tw-py-[clamp(3.5rem,7vw,5.5rem)]" id="pcPtnHero">
  <span class="tw-pointer-events-none tw-absolute tw-right-[-8rem] tw-top-[-8rem] tw-z-0 tw-h-[24rem] tw-w-[24rem] tw-rounded-full tw-bg-power/[0.12] tw-blur-[70px]" aria-hidden="true"></span>
  <span class="tw-pointer-events-none tw-absolute tw-bottom-[-10rem] tw-left-[-6rem] tw-z-0 tw-h-[22rem] tw-w-[22rem] tw-rounded-full tw-bg-ink/[0.06] tw-blur-[70px]" aria-hidden="true"></span>

  <div class="tw-relative tw-z-[1] <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-7">
        <span class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-power/[0.22] tw-bg-white/[0.72] tw-px-4 tw-py-2 tw-text-xs tw-font-extrabold tw-uppercase tw-tracking-[0.06em] tw-text-powerdark">
          <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 6.75a3 3 0 106 0 3 3 0 00-6 0zM3.75 17.25a3 3 0 106 0 3 3 0 00-6 0zM14.25 17.25a3 3 0 106 0 3 3 0 00-6 0zM9.75 15.106V6.75m4.5 8.356V6.75M6.75 6.75h10.5"/></svg>
          PowerCabs Partner Network
        </span>

        <h1 class="tw-mb-3 tw-mt-4 tw-max-w-[15ch] tw-text-[clamp(2.5rem,5vw,4.25rem)] tw-font-extrabold tw-leading-[1.02] tw-tracking-[-0.045em] tw-text-ink">Turn every vehicle into more bookings.</h1>

        <p class="tw-mb-6 tw-max-w-[52ch] tw-text-[1.12rem] tw-text-ink/60">
          PowerCabs welcomes taxi operators, fleet owners and independent drivers
          to join a growing network and unlock more consistent bookings,
          dedicated support and long-term business growth.
        </p>

        <div class="tw-mb-8 tw-flex tw-flex-wrap tw-gap-3">
          <a class="tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]" href="#pcPtnEnquiry">
            Become a Partner
            <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 011.06 0l6.5 6.5a.75.75 0 010 1.06l-6.5 6.5a.75.75 0 11-1.06-1.06L14.19 12 8.22 6.03a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
          </a>
          <a class="tw-inline-flex tw-items-center tw-rounded-full tw-border tw-border-solid tw-border-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-ink tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink hover:tw-text-white" href="#pcPtnCampaign">See Partner Benefits</a>
        </div>

        <div class="tw-flex tw-flex-wrap tw-gap-6 lg:tw-gap-10">
          <?php foreach ($ptnHeroProof as $p): ?>
            <div>
              <strong class="tw-block tw-text-lg tw-font-extrabold tw-tracking-[-0.02em] tw-text-ink"><?= htmlspecialchars($p['value']) ?></strong>
              <span class="tw-text-sm tw-text-ink/55"><?= htmlspecialchars($p['label']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="lg:tw-col-span-5">
        <aside class="tw-relative tw-z-[1] tw-rounded-2xl tw-border tw-border-solid tw-border-white/90 tw-bg-white/[0.82] tw-p-7 tw-shadow-[0_24px_60px_rgba(28,20,16,0.12)] tw-backdrop-blur-[6px]" aria-label="Partner programme snapshot">
          <div class="tw-flex tw-items-center tw-justify-between">
            <strong class="tw-text-[0.95rem] tw-text-ink">Partner Snapshot</strong>
            <span class="tw-inline-flex tw-items-center tw-gap-2 tw-text-xs tw-font-extrabold tw-text-powerdark">
              <span class="tw-relative tw-inline-flex tw-h-2 tw-w-2 tw-rounded-full tw-bg-power tw-shadow-[0_0_0_4px_rgba(232,89,12,0.16)]">
                <span class="tw-absolute tw-inset-0 tw-animate-ping tw-rounded-full tw-bg-power" aria-hidden="true"></span>
              </span>
              Now Onboarding
            </span>
          </div>

          <div class="tw-mt-6 tw-rounded-xl tw-bg-ink tw-p-6 tw-text-white">
            <small class="tw-block tw-text-xs tw-font-bold tw-uppercase tw-tracking-[0.08em] tw-text-white/60">Partner Payments</small>
            <strong class="tw-my-1 tw-block tw-text-4xl tw-font-extrabold tw-leading-[1.1] tw-text-powerlight">Weekly</strong>
            <span class="tw-text-sm tw-text-white/[0.78]">Reliable, on-time payouts for every partner, every week.</span>
          </div>

          <div class="tw-mt-4 tw-rounded-xl tw-border tw-border-solid tw-border-black/10 tw-bg-white tw-p-5">
            <span class="tw-inline-block tw-rounded-full tw-bg-[#fbe6d4] tw-px-3 tw-py-1 tw-text-[0.68rem] tw-font-extrabold tw-uppercase tw-tracking-[0.05em] tw-text-power">Join Process</span>
            <h3 class="tw-mb-1 tw-mt-2 tw-text-base tw-font-extrabold tw-text-ink">4-Step Onboarding</h3>
            <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Register &rarr; Verify &rarr; Approve &rarr; Start Trips</p>
            <div class="tw-mt-2.5 tw-flex tw-items-center tw-justify-between tw-border-t tw-border-dashed tw-border-black/10 tw-pt-2.5 tw-text-sm tw-font-bold tw-text-ink">
              <span>Open to operators &amp; drivers</span>
              <svg class="tw-h-4 tw-w-4 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3"/></svg>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>

  <div class="tw-relative tw-z-[1] tw-mt-10">
    <div class="<?= $pcContainer ?>">
      <div class="tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-black/[0.08] tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-shadow-[0_10px_30px_rgba(28,20,16,0.08)] md:tw-grid-cols-4 md:tw-divide-y-0">
        <?php foreach ($ptnHeroStats as $s): ?>
          <div class="tw-p-6 tw-text-center md:tw-text-left">
            <strong class="tw-block tw-text-xl tw-font-extrabold tw-tracking-[-0.02em] tw-text-power"><?= htmlspecialchars($s['label']) ?></strong>
            <span class="tw-text-sm tw-text-ink/60"><?= htmlspecialchars($s['desc']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
