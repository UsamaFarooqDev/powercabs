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
        <h2 class="tw-mb-4 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Why Businesses Choose PowerCabs</h2>
        <p class="tw-mb-6 tw-max-w-[46ch] tw-text-lg tw-text-ink/60">
          A corporate account built around how your business actually runs --
          one point of contact, one invoice, and drivers you can rely on every time.
        </p>
        <a class="tw-inline-flex tw-items-center tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="#corporate-account-form">Open Your Corporate Account</a>
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
