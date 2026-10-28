<?php
/* Five reasons on the left, the results card on the right -- the same pairing as the reference.
   The figures are rendered from $lostItemResults so there is one place to change them, and the
   "updated regularly" line sits with them rather than floating as a separate claim. */
$lostItemWhy = [
  [
    'title' => 'We Start by Helping, Not by Charging',
    'desc' => 'Our free initial search gives you a chance to identify a possible taxi before deciding on further investigation.',
    'icon' => '<path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>',
  ],
  [
    'title' => 'You Don&rsquo;t Have to Be a PowerCabs Passenger',
    'desc' => 'Lost something in another taxi or through another booking service? You can still submit a report. We investigate using the information and driver data available to us.',
    'icon' => '<path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/>',
  ],
  [
    'title' => 'A Wider Driver Database',
    'desc' => 'Our available data covers approximately ' . number_format($lostItemAllDrivers) . ' drivers, with an initial search of ' . number_format($lostItemFreeDrivers) . ' drivers offered free of charge.',
    'icon' => '<ellipse cx="12" cy="5.25" rx="8.25" ry="3"/><path d="M3.75 5.25v6c0 1.657 3.694 3 8.25 3s8.25-1.343 8.25-3v-6M3.75 11.25v6c0 1.657 3.694 3 8.25 3s8.25-1.343 8.25-3v-6"/>',
  ],
  [
    'title' => 'Clear Fees. Your Decision.',
    'desc' => 'We explain the free search, the optional &euro;' . $lostItemFee . ' extended investigation and any separate retrieval costs before you commit.',
    'icon' => '<path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/>',
  ],
  [
    'title' => 'Your Belongings Matter to Us',
    'desc' => 'A lost item isn&rsquo;t always just an item. It could be a phone full of memories, a wallet with essential cards, keys you need to get home, or something with sentimental value.',
    'icon' => '<path d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z"/>',
  ],
];

$lostItemResults = [
  ['value' => '1,248+', 'label' => 'Items successfully returned', 'icon' => '<path d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"/>'],
  ['value' => '892+', 'label' => 'Lost-item reports investigated', 'icon' => '<path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>'],
  ['value' => number_format($lostItemAllDrivers) . '+', 'label' => 'Drivers in our available data network', 'icon' => '<path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/>'],
];
?>
<section class="<?= $pcSurfaceSoft ?> <?= $pcSection ?>" id="why-choose">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-14">

      <div class="lg:tw-col-span-7">
        <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Why Choose PowerCabs Lost Item Recovery?</h2>
        <p class="<?= $pcBody ?> tw-mb-8 <?= $pcMeasureTight ?>">
          We&rsquo;re not just another taxi company. We&rsquo;re a team that genuinely cares about helping
          you get your belongings back. Here&rsquo;s what makes our service different:
        </p>

        <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-5 tw-p-0">
          <?php foreach ($lostItemWhy as $why): ?>
            <li class="<?= $pcFeatureRow ?>">
              <span class="<?= $pcFeatureIcon ?> tw-shrink-0" aria-hidden="true">
                <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><?= $why['icon'] ?></svg>
              </span>
              <div class="tw-min-w-0">
                <h3 class="tw-mb-1 tw-text-[0.98rem] tw-font-bold tw-leading-snug tw-text-ink"><?= $why['title'] ?></h3>
                <p class="<?= $pcBodySm ?> tw-mb-0"><?= $why['desc'] ?></p>
              </div>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="lg:tw-col-span-5">
        <div class="tw-overflow-hidden tw-rounded-[1.75rem] tw-border tw-border-solid tw-border-hairline tw-bg-white lg:tw-sticky lg:tw-top-28">
          <div class="tw-border-0 tw-border-b tw-border-solid tw-border-hairline tw-bg-gradient-to-br tw-from-peach tw-to-white tw-px-6 tw-py-5 sm:tw-px-7">
            <p class="tw-mb-0 tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] tw-text-power">Lost item recovery</p>
          </div>

          <div class="tw-p-6 sm:tw-p-7">
            <h3 class="tw-mb-5 tw-text-[1.2rem] tw-font-bold tw-tracking-[-0.02em] tw-text-ink">Our Recovery Results</h3>
            <dl class="tw-m-0 tw-flex tw-flex-col tw-gap-5">
              <?php foreach ($lostItemResults as $r): ?>
                <div class="tw-flex tw-items-center tw-gap-4">
                  <span class="<?= $pcFeatureIcon ?> tw-shrink-0" aria-hidden="true">
                    <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><?= $r['icon'] ?></svg>
                  </span>
                  <div class="tw-min-w-0">
                    <dt class="tw-text-[1.4rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.02em] tw-text-ink"><?= $r['value'] ?></dt>
                    <dd class="tw-m-0 tw-mt-1 tw-text-[0.88rem] tw-leading-snug tw-text-ink/55"><?= $r['label'] ?></dd>
                  </div>
                </div>
              <?php endforeach; ?>
            </dl>
            <p class="tw-mb-0 tw-mt-5 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-pt-4 tw-text-[0.8rem] tw-text-ink/50">
              Figures updated regularly using verified records.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
