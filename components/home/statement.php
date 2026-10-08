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
        <?php /* Type written out rather than $pcBody plus an override. The
                 recipe already carries tw-text-[1.0625rem], and a second
                 font-size utility beside it is a coin toss -- which one wins is
                 decided by the order Tailwind emits them, not by the order they
                 sit in this attribute.

                 Two paragraphs, not one block. The first sentence is the claim
                 and the second is the explanation, so the claim gets the larger
                 size and near-full ink while the explanation sits back at body
                 size and muted. Same words as before; only the typography
                 changed. */ ?>
        <p class="tw-mb-4 tw-max-w-[33rem] tw-text-[1.1875rem] tw-leading-[1.65] tw-tracking-[-0.005em] tw-text-ink/[0.82]">
          PowerCabs is more than a taxi app &mdash; we&rsquo;re an
          <strong class="tw-font-semibold tw-text-ink">Irish mobility technology company</strong>
          putting the power of choice back into the hands of passengers and drivers.
        </p>
        <?php /* Both paragraphs share a rem measure, not 44ch. ch is relative
                 to the font size, so the same "44ch" resolved to 572px on the
                 19px lead and 512px here -- once the column is wide enough for
                 both to hit their cap, their right edges stopped matching. */ ?>
        <p class="tw-mb-0 tw-max-w-[33rem] tw-text-[1.0625rem] tw-leading-[1.7] tw-text-muted">
          Through seamless connectivity and smarter technology, we make every
          journey more accessible, flexible, and empowering.
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
