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
<?php /* No hard edges. This was a flat tw-bg-surface block, so the tint began
         and ended on two ruled lines across the page -- fine as a band, but
         this section is the page's pause and a pause should not have borders.

         Two layers, in this order (CSS paints the first one listed on top):
           1. a wide, shallow warm glow centred in the section. 75% x 50% makes
              it an ellipse that reads as a horizontal band of light rather
              than a circular blob, and at 5.5% opacity it is felt more than
              seen. It is the only orange on this section.
           2. the tint itself, fading out of white at the top and back into it
              at the bottom, so the section arrives and leaves rather than
              starting.
         The 16%/84% stops are what keep the fade gentle: closer together and
         the gradient becomes a visible edge again, which is the thing being
         removed. */ ?>
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

        <?php /* A rule and three facts rather than three cards: this section
                 is the page's quiet moment, and boxing the proof would make it
                 look like every other band.

                 The rule is a hairline that fades out to the right rather than
                 stopping dead, which matches the section's soft edges instead
                 of reintroducing the one straight line it just lost. The value
                 leads and the label sits under it -- the numbers are the point,
                 so they should be what the eye lands on first. */ ?>
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
