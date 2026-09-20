<?php
/**
 * Three promises, directly under the hero: this is the page's whole offer in
 * one line each, and the third one ("you approve any retrieval cost first")
 * is the reassurance that keeps the fee from reading as a trap.
 *
 * Reads $lostItemFee from lost-item-report.php.
 */
$lostItemTrust = [
  [
    'title' => 'Any taxi journey',
    'desc' => 'Not just PowerCabs trips',
    'icon' =>
      '<path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/>',
  ],
  [
    'title' => '&euro;' . $lostItemFee . ' investigation',
    'desc' => 'One clear, up-front fee',
    'icon' => '<path d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>',
  ],
  [
    'title' => 'Price before retrieval',
    'desc' => 'You decide before we proceed',
    'icon' => '<path d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
  ],
];
?>
<!-- ============ Lost item: trust strip ============ -->
<section class="tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06] tw-bg-white tw-py-[clamp(1.75rem,3vw,2.5rem)]">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-5 sm:tw-grid-cols-3 sm:tw-gap-4">
      <?php foreach ($lostItemTrust as $i => $item): ?>
        <?php /* The divider is a left border on the 2nd and 3rd cells, so it
                 only appears once the row is actually side by side. */ ?>
        <div class="tw-flex tw-items-center tw-gap-3.5 <?= $i > 0
          ? 'sm:tw-border-0 sm:tw-border-l sm:tw-border-solid sm:tw-border-black/[0.07] sm:tw-pl-5'
          : '' ?>">
          <span class="<?= $pcIconChip ?>">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?= $item['icon'] ?></svg>
          </span>
          <span class="tw-min-w-0">
            <span class="tw-block tw-text-[0.95rem] tw-font-bold tw-leading-snug tw-text-ink"><?= $item['title'] ?></span>
            <span class="tw-block tw-text-[0.85rem] tw-leading-snug tw-text-ink/65"><?= $item['desc'] ?></span>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
