<?php
$joinProcess = [
  ['n' => '01', 'title' => 'Register', 'desc' => 'Tell us about your business and vehicles.'],
  ['n' => '02', 'title' => 'Verification', 'desc' => 'Our team checks your details and documents.'],
  ['n' => '03', 'title' => 'Approval', 'desc' => "You're confirmed and onboarded to the network."],
  ['n' => '04', 'title' => 'Start Receiving Trips', 'desc' => 'Bookings start flowing straight to your fleet.'],
];
?>
<!-- .pc-ptn-step-card is a bare JS hook -- partner-page.js's IntersectionObserver
     adds .is-visible as each card scrolls into view, handled below via the
     `[&.is-visible]:` arbitrary variant. -->
<section class="tw-bg-[linear-gradient(180deg,#ffffff_0%,#f9f4ed_100%)] <?= $pcSection ?>" id="pcPtnProcess">
  <div class="<?= $pcContainer ?>">
    <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ Simple From Day One</p>
    <h2 class="tw-mb-3 tw-text-[clamp(2rem,3.6vw,3.1rem)] tw-font-extrabold tw-leading-[1.06] tw-tracking-[-0.045em] tw-text-ink">How the Partner Programme Works.</h2>
    <p class="tw-mb-10 tw-max-w-[62ch] tw-text-[1.08rem] tw-text-ink/60">
      No complicated setup. Join, get verified, get on the road and stay
      eligible for a steady stream of bookings.
    </p>

    <div class="pc-ptn-step-grid tw-grid tw-grid-cols-1 tw-gap-3 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
      <?php foreach ($joinProcess as $step): ?>
        <div class="pc-ptn-step-card tw-rounded-xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-6 tw-opacity-0 tw-translate-y-4 tw-transition-all tw-duration-500 tw-ease-out [&.is-visible]:tw-opacity-100 [&.is-visible]:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-transition-none">
          <span class="tw-mb-6 tw-inline-flex tw-h-10 tw-w-10 tw-items-center tw-justify-center tw-rounded-md tw-bg-[#fbe6d4] tw-font-extrabold tw-text-power"><?= htmlspecialchars($step['n']) ?></span>
          <h3 class="tw-mb-1 tw-text-base tw-font-extrabold tw-text-ink"><?= htmlspecialchars($step['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($step['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
