<?php
/**
 * "We find it. You decide what happens next."
 *
 * The five steps after a successful investigation. Step 3 and 4 are the
 * point of the section: any retrieval cost is quoted and approved BEFORE
 * anything else happens, so nobody is billed a surprise delivery charge.
 */
$lostItemSteps = [
  ['title' => 'Item found', 'desc' => 'We contact you as soon as the relevant driver confirms your item has been located.'],
  ['title' => 'We check the distance', 'desc' => 'Any retrieval cost depends on where the driver is and where you want the item returned.'],
  ['title' => 'We give you the price', 'desc' => 'You are told the retrieval or delivery cost before anything further happens.'],
  ['title' => 'You decide', 'desc' => 'Approve it or decline it. Declining costs you nothing beyond the investigation fee.'],
  ['title' => 'We arrange the return', 'desc' => 'If you approve, we coordinate getting your belongings back to you.'],
];
?>
<!-- ============ Lost item: what happens if we find it ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="<?= $pcSectionHeadCenter ?>">
      <p class="<?= $pcEyebrow ?>">No surprises</p>
      <h2 class="<?= $pcH2 ?>">We find it. <span class="tw-text-power">You decide what happens next.</span></h2>
      <p class="tw-mb-0 <?= $pcLead ?>">
        If your item turns up, nothing is charged and nothing is arranged until you say so.
      </p>
    </div>

    <?php /* §16's numbered process: a rule, a number, the step. This was five
             bordered, shadowed cards each carrying a rounded numeral chip --
             three separate devices (box, chip, shadow) to say "this is step
             three of five", when the numeral and the rule above it say it on
             their own. A sequence also does not need boundaries between its
             members the way a set of options does; the order IS the grouping. */ ?>
    <div class="tw-grid tw-grid-cols-1 tw-gap-x-8 tw-gap-y-9 sm:tw-grid-cols-2 lg:tw-grid-cols-5">
      <?php foreach ($lostItemSteps as $i => $step): ?>
        <div class="<?= $pcStepItem ?>">
          <span class="<?= $pcStepNum ?>"><?= str_pad($i + 1, 2, '0', STR_PAD_LEFT) ?></span>
          <h3 class="tw-mb-1.5 tw-text-[1rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= htmlspecialchars($step['title']) ?></h3>
          <p class="<?= $pcBodySm ?> tw-mb-0"><?= htmlspecialchars($step['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
