<?php
/**
 * "If it was a taxi, we'll try to help."
 *
 * The single most surprising thing about this service -- it is not limited to
 * PowerCabs journeys -- so it gets the dark band treatment the site uses for
 * statements it wants read (same device as components/shared/support-band).
 */
$lostItemJourneys = [
  ['label' => 'PowerCabs', 'sub' => 'Booked with us', 'icon' => '<path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/>'],
  ['label' => 'Another taxi company', 'sub' => 'Any operator', 'icon' => '<path d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/>'],
  ['label' => 'Another app', 'sub' => 'Booked online', 'icon' => '<path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>'],
  ['label' => 'Street hail', 'sub' => 'Flagged down', 'icon' => '<path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>'],
  ['label' => 'Not sure', 'sub' => 'Tell us anyway', 'icon' => '<path d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z"/>'],
];
?>
<!-- ============ Lost item: any taxi journey ============ -->
<section class="tw-relative tw-overflow-hidden <?= $pcSurfaceDark ?> <?= $pcSectionTight ?>">
  <?php /* The two brand glows the dark bands elsewhere on the site use. */ ?>
  <span class="tw-pointer-events-none tw-absolute tw-right-[-8rem] tw-top-[-7rem] tw-h-[26rem] tw-w-[26rem] tw-rounded-full tw-bg-[radial-gradient(circle,rgba(255,122,0,0.26),transparent_70%)] tw-blur-[70px]" aria-hidden="true"></span>
  <span class="tw-pointer-events-none tw-absolute tw-bottom-[-9rem] tw-left-[-7rem] tw-h-[22rem] tw-w-[22rem] tw-rounded-full tw-bg-[radial-gradient(circle,rgba(232,89,12,0.2),transparent_70%)] tw-blur-[70px]" aria-hidden="true"></span>

  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-9 tw-max-w-[54ch] tw-text-center">
      <p class="<?= $pcEyebrowOnDark ?>">/ You do not have to be a PowerCabs passenger</p>
      <h2 class="<?= $pcH2OnDark ?>">If it was a taxi, we&rsquo;ll try to help.</h2>
      <p class="tw-mb-0 <?= $pcBodyOnDark ?>">
        Your journey may have been booked through another platform, taken with
        another taxi company, or simply hailed on the street. You can still ask
        us to investigate.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-2 tw-gap-3 sm:tw-grid-cols-3 lg:tw-grid-cols-5">
      <?php foreach ($lostItemJourneys as $journey): ?>
        <div class="tw-flex tw-flex-col tw-items-center tw-gap-2.5 tw-rounded-2xl tw-border tw-border-solid tw-border-white/[0.12] tw-bg-white/[0.06] tw-px-3 tw-py-5 tw-text-center">
          <span class="<?= $pcIconChipDark ?>">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?= $journey['icon'] ?></svg>
          </span>
          <span class="tw-block tw-text-[0.9rem] tw-font-bold tw-leading-snug tw-text-white"><?= htmlspecialchars($journey['label']) ?></span>
          <span class="tw-block tw-text-[0.78rem] tw-leading-snug tw-text-white/50"><?= htmlspecialchars($journey['sub']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
