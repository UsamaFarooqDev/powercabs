<?php
/**
 * Homepage §03 -- the core product statement.
 *
 * The one section on the page that says almost nothing and is supposed to.
 * The brief's diagnosis is that every section currently carries the same
 * visual weight, so nothing reads as important; this is the pause that makes
 * the sections around it legible. Resist adding cards, icons or a third
 * paragraph here -- the whitespace IS the content.
 *
 * Every number below is already published elsewhere on this site (the NTA
 * licence in the footer and about-us, 24/7 and live tracking on /ride and
 * /faqs). Nothing here is a new claim.
 */
$statementProof = [
  ['label' => 'NTA licensed', 'value' => 'DH12616'],
  ['label' => 'Support', 'value' => '24/7'],
  ['label' => 'Every journey', 'value' => 'Live tracked'],
];
?>
<section class="tw-bg-surface <?= $pcSectionLoose ?>">
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

        <?php /* A rule and three facts rather than three cards: this section
                 is the page's quiet moment, and boxing the proof would make it
                 look like every other band. */ ?>
        <dl class="tw-mt-8 tw-grid tw-grid-cols-3 tw-gap-4 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-pt-6">
          <?php foreach ($statementProof as $item): ?>
            <div>
              <dt class="tw-text-[0.75rem] tw-font-bold tw-uppercase tw-tracking-[0.08em] tw-text-muted"><?= htmlspecialchars($item['label']) ?></dt>
              <dd class="tw-mb-0 tw-mt-1 tw-text-[1.0625rem] tw-font-bold tw-text-ink"><?= htmlspecialchars($item['value']) ?></dd>
            </div>
          <?php endforeach; ?>
        </dl>
      </div>
    </div>
  </div>
</section>
