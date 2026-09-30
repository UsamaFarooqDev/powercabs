<?php
$statementProof = [
  ['label' => 'NTA licensed', 'value' => 'DH12616'],
  ['label' => 'Support', 'value' => '24/7'],
  ['label' => 'Every journey', 'value' => 'Live tracked'],
];
?>
<section class="tw-bg-[radial-gradient(75%_50%_at_50%_50%,rgba(249,115,22,0.055)_0%,transparent_72%),linear-gradient(180deg,#ffffff_0%,#fbf8f4_16%,#fbf8f4_84%,#ffffff_100%)] <?= $pcSectionLoose ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-16">
      <div class="lg:tw-col-span-7">
        <p class="<?= $pcEyebrow ?>">More than a taxi</p>
        <h2 class="<?= $pcH2Display ?> tw-max-w-[18ch]">
          A better way to move around Dublin.
        </h2>
      </div>

      <div class="lg:tw-col-span-5 lg:tw-pt-2">
        <p class="<?= $pcLead ?> tw-max-w-[44ch]">
          PowerCabs is an Irish taxi company with its own app, its own drivers and
          its own support team &mdash; not a platform that treats Dublin as one
          more city on a list.
        </p>

        <dl class="tw-mt-10 tw-grid tw-grid-cols-3 tw-gap-6 tw-pt-7 [border-image:linear-gradient(90deg,rgba(231,229,226,1),rgba(231,229,226,0))_1] tw-border-0 tw-border-t tw-border-solid">
          <?php foreach ($statementProof as $item): ?>
            <div>
              <dd class="tw-mb-0 tw-text-[1.0625rem] tw-font-bold tw-leading-snug tw-text-ink"><?= htmlspecialchars($item['value']) ?></dd>
              <dt class="tw-mt-1 tw-text-[0.75rem] tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-muted"><?= htmlspecialchars($item['label']) ?></dt>
            </div>
          <?php endforeach; ?>
        </dl>
      </div>
    </div>
  </div>
</section>
