<?php
/* The four steps, in the order a customer meets them. Each card carries the one thing the
   customer has to decide at that stage, which is why step 3 is the only one phrased as a choice. */
$lostItemHow = [
  [
    'title' => 'Tell Us What You&rsquo;ve Lost',
    'icon' =>
      '<path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z"/>',
    'body' => [
      'Complete our short lost-item report with whatever details you remember about your journey.',
      'Don&rsquo;t remember the registration number or taxi company? That&rsquo;s okay. Give us the information you have, and we&rsquo;ll work with those details.',
    ],
  ],
  [
    'title' => 'We Search for Free',
    'icon' => '<path d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>',
    'body' => [
      'We check your report against our initial dataset of approximately ' .
        number_format($lostItemFreeDrivers) .
        ' drivers, at no charge.',
      'Our goal is to identify a possible match before asking you to pay for further investigation.',
    ],
  ],
  [
    'title' => 'No Match? You Choose Whether to Go Further',
    'icon' =>
      '<ellipse cx="12" cy="5.25" rx="8.25" ry="3"/><path d="M3.75 5.25v6c0 1.657 3.694 3 8.25 3s8.25-1.343 8.25-3v-6M3.75 11.25v6c0 1.657 3.694 3 8.25 3s8.25-1.343 8.25-3v-6"/>',
    'body' => [
      'If we don&rsquo;t find a likely match, we&rsquo;ll let you know. You can then choose an extended investigation for &euro;' .
        $lostItemFee .
        ' using our wider database of approximately ' .
        number_format($lostItemAllDrivers) .
        ' drivers.',
    ],
  ],
  [
    'title' => 'If Your Item Is Found, We&rsquo;ll Explain Your Options',
    'icon' =>
      '<path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>',
    'body' => [
      'If a driver confirms your item has been found, we&rsquo;ll contact you and explain the return options.',
      'Any retrieval or delivery charges are separate and will be explained before you agree to them.',
    ],
  ],
];
?>
<section class="<?= $pcSection ?>" id="how-it-works">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mb-10 tw-max-w-[58ch]">
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">How Our Lost Item Recovery Service Works</h2>
      <p class="<?= $pcBody ?> tw-mb-0">A simple process. A free first search. You decide what happens next.</p>
    </div>

    <ol class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-5 tw-p-0 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
      <?php foreach ($lostItemHow as $i => $step): ?>
        <li class="<?= $pcCard ?> tw-flex tw-flex-col tw-bg-white">
          <div class="tw-mb-4 tw-flex tw-items-center tw-gap-3">
            <span class="<?= $pcFeatureIcon ?>" aria-hidden="true">
              <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><?= $step['icon'] ?></svg>
            </span>
          </div>
          <h3 class="tw-mb-2.5 tw-text-[1.02rem] tw-font-bold tw-leading-snug tw-text-ink"><?= $step['title'] ?></h3>
          <?php foreach ($step['body'] as $p): ?>
            <p class="<?= $pcBodySm ?> tw-mb-0 [&+p]:tw-mt-2.5"><?= $p ?></p>
          <?php endforeach; ?>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</section>
