<?php
$whyItems = [
  [
    'title' => 'Local by design',
    'body' => 'Based in Inchicore, with Dublin drivers and an Irish support team you can actually reach.',
  ],
  [
    'title' => 'Licensed and accountable',
    'body' => 'Licensed by the National Transport Authority under DH12616. Every driver is vetted before their first fare.',
  ],
  [
    'title' => 'Available around the clock',
    'body' => 'Early flights, late finishes and everything in between &mdash; the line is open at 3am as well as 3pm.',
  ],
  [
    'title' => 'Technology that helps',
    'body' => 'Our own app: book in seconds, watch your driver approach, pay the fare you were quoted.',
  ],
];
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="<?= $pcSectionHead ?>">
      <p class="<?= $pcEyebrow ?>">The power of local</p>
      <h2 class="<?= $pcH2 ?>">Ride with confidence.</h2>
    </div>

    <ul class="tw-m-0 tw-grid tw-grid-cols-1 tw-list-none tw-gap-x-12 tw-gap-y-0 tw-p-0 md:tw-grid-cols-2">
      <?php foreach ($whyItems as $i => $item): ?>
        <?php  ?>
        <li class="tw-flex tw-gap-6 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-py-8">
          <span class="tw-shrink-0 tw-text-[1.75rem] tw-font-bold tw-leading-none tw-tracking-[-0.03em] tw-text-power" aria-hidden="true">
            <?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?>
          </span>
          <div>
            <h3 class="<?= $pcH3 ?>"><?= htmlspecialchars($item['title']) ?></h3>
            <p class="<?= $pcBody ?> tw-mb-0 tw-max-w-[46ch]"><?= $item['body'] ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
