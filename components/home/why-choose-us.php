<?php
$whyChooseItems = [
  ['n' => '01', 't' => 'Easy to book.', 'd' => "Enter your pickup and drop-off locations, select your ride, you're all set."],
  ['n' => '02', 't' => 'Affordable by design.', 'd' => 'Competitive rates on every ride, so you always know what to expect.'],
  ['n' => '03', 't' => 'Safe to trust.', 'd' => 'All drivers are licensed and Garda-vetted; vehicles are regularly inspected.'],
  ['n' => '04', 't' => 'Around the clock.', 'd' => "Need a ride any time of day or night? We're always here for you."],
];
?>
<!-- ============ Section 06 -- Why PowerCabs, as an index rather than a card grid ============ -->
<section id="why-choose" class="tw-bg-ink tw-py-20 sm:tw-py-28">
  <div class="container">
    <p class="pc-reveal tw-inline-flex tw-items-center tw-gap-2 tw-text-[.72rem] tw-font-semibold tw-uppercase tw-tracking-[.18em] tw-text-powerlight tw-mb-10 sm:tw-mb-14">
      <span class="tw-inline-block tw-w-6 tw-h-px tw-bg-powerlight"></span>
      Why PowerCabs
    </p>

    <div class="tw-flex tw-flex-col tw-border-t tw-border-white/10">
      <?php foreach ($whyChooseItems as $item): ?>
        <div class="pc-reveal tw-group tw-grid sm:tw-grid-cols-[auto_1fr_auto] tw-gap-3 sm:tw-gap-8 tw-items-baseline tw-py-7 sm:tw-py-9 tw-border-b tw-border-white/10 tw-transition-colors">
          <span class="tw-text-power tw-font-bold tw-text-sm tw-tracking-wider"><?= $item['n'] ?></span>
          <h3 class="tw-font-extrabold tw-text-white tw-tracking-tight tw-leading-[1.05] tw-text-[clamp(1.7rem,4.6vw,3.2rem)] tw-mb-0 tw-transition-colors group-hover:tw-text-powerlight">
            <?= htmlspecialchars($item['t']) ?>
          </h3>
          <p class="tw-text-white/45 tw-text-[.95rem] tw-max-w-[34ch] tw-mb-0"><?= htmlspecialchars($item['d']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
