<?php
$whyBusinesses = [
  ['icon' => 'account', 'title' => 'Account Management', 'desc' => 'A dedicated account manager who understands your business and travel patterns.'],
  ['icon' => 'support', 'title' => 'Dedicated Support', 'desc' => '24/7 support for your team, not just a general helpline.'],
  ['icon' => 'receipt', 'title' => 'Transparent Billing', 'desc' => 'One consolidated monthly invoice, with no hidden charges.'],
  ['icon' => 'shield', 'title' => 'Reliable Drivers', 'desc' => 'Garda-vetted, professional drivers for every corporate journey.'],
  ['icon' => 'calendar', 'title' => 'Scheduled Rides', 'desc' => 'Book recurring or advance journeys so your team is never caught out.'],
];
$totalWhyBusinesses = count($whyBusinesses);
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2">
      <div>
        <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Why Businesses Choose PowerCabs</h2>
        <p class="tw-mb-4 tw-max-w-[46ch] tw-text-lg tw-text-ink/60">
          A corporate account built around how your business actually runs --
          one point of contact, one invoice, and drivers you can rely on every time.
        </p>
        <a class="tw-inline-flex tw-items-center tw-rounded-full tw-bg-ink tw-px-6 tw-py-2 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="#corporate-account-form">Open Your Corporate Account</a>

        <?php /* The whole page assumes the reader is opening a business
                 account, and there was no route out of it -- someone who lands
                 here and just wants a taxi had nothing to click. This is that
                 route.

                 Deliberately a quieter surface than the button above it: paper
                 tint, hairline, and $pcBtnGhost rather than $pcBtnPrimary. The
                 corporate account is still this page's primary action, so the
                 alternative path must not outrank it -- an orange
                 $pcBtnPrimary here would have been the loudest thing in the
                 column.

                 The copy is the passenger app's own description from
                 components/download/app-cards.php, not a new claim written for
                 this box. */ ?>
        <aside class="tw-mt-6 tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-paper tw-p-5 sm:tw-p-6">
          <div class="tw-flex tw-flex-col tw-gap-4 sm:tw-flex-row sm:tw-items-start">
            <span class="<?= $pcIconChip ?>">
              <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5M9 18h6"/></svg>
            </span>

            <div class="tw-min-w-0">
              <h3 class="tw-mb-1.5 tw-text-base tw-font-bold tw-text-ink">Not booking for a business?</h3>
              <p class="tw-mb-4 tw-max-w-[52ch] tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">
                Everyday rides live in the PowerCabs app &mdash; book rides,
                track your driver live, and pay cashlessly, all in a few taps.
              </p>
              <a class="<?= $pcBtnGhost ?>" href="<?= $assetPath ?>/download-our-app">
                <svg class="tw-h-3 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Download the App
              </a>
            </div>
          </div>
        </aside>
      </div>

      <div>
        <?php foreach ($whyBusinesses as $i => $item): ?>
          <?php $isLast = $i === $totalWhyBusinesses - 1; ?>
          <div class="tw-flex">
            <div class="tw-mr-3 tw-flex tw-w-11 tw-flex-col tw-items-center">
              <span class="tw-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-power tw-text-power">
                <?php switch ($item['icon']):
                  case 'account': ?>
                    <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.25"/><path d="M5.5 20.25a6.5 6.5 0 0113 0"/></svg>
                  <?php break;
                  case 'support': ?>
                    <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 13.5v-1.75a7.5 7.5 0 0115 0v1.75M4.5 13.5a1.75 1.75 0 00-1.75 1.75v1a1.75 1.75 0 001.75 1.75h.75a1 1 0 001-1v-3.5a1 1 0 00-1-1h-.75zm15 0a1.75 1.75 0 011.75 1.75v1a1.75 1.75 0 01-1.75 1.75h-.75a1 1 0 01-1-1v-3.5a1 1 0 011-1h.75zM18 18v.75a2.25 2.25 0 01-2.25 2.25h-2.25"/></svg>
                  <?php break;
                  case 'receipt': ?>
                    <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185z"/></svg>
                  <?php break;
                  case 'shield': ?>
                    <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
                  <?php break;
                  case 'calendar': ?>
                    <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6.75 3v2.25M17.25 3v2.25M3.75 18.75V7.5a2.25 2.25 0 012.25-2.25h12a2.25 2.25 0 012.25 2.25v11.25m-16.5 0A2.25 2.25 0 006 21h12a2.25 2.25 0 002.25-2.25m-16.5 0V11.25a2.25 2.25 0 012.25-2.25h12a2.25 2.25 0 012.25 2.25v7.5M9 16.5l1.5 1.5 3.5-3.5"/></svg>
                  <?php break;
                endswitch; ?>
              </span>
              <?php if (!$isLast): ?>
                <div class="tw-my-1 tw-w-0 tw-flex-grow tw-border-0 tw-border-l-2 tw-border-solid tw-border-power/35"></div>
              <?php endif; ?>
            </div>
            <div class="tw-pt-1 <?= $isLast ? 'tw-pb-0' : 'tw-pb-4' ?>">
              <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
              <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($item['desc']) ?></p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
