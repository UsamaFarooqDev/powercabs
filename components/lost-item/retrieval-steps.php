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
      <p class="<?= $pcEyebrow ?>">/ No surprises</p>
      <h2 class="<?= $pcH2 ?>">We find it. <span class="tw-text-power">You decide what happens next.</span></h2>
      <p class="tw-mb-0 <?= $pcLead ?>">
        If your item turns up, nothing is charged and nothing is arranged until you say so.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 lg:tw-grid-cols-5">
      <?php foreach ($lostItemSteps as $i => $step): ?>
        <div class="tw-relative tw-h-full tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-5 tw-shadow-[0_1px_3px_rgba(28,20,16,0.05)]">
          <span class="tw-mb-3.5 tw-inline-flex tw-h-9 tw-w-9 tw-items-center tw-justify-center tw-rounded-xl tw-bg-peach tw-text-[0.95rem] tw-font-extrabold tw-text-power">
            <?= $i + 1 ?>
          </span>
          <h3 class="tw-mb-1.5 tw-text-[1.02rem] tw-font-bold tw-leading-snug tw-text-ink"><?= htmlspecialchars($step['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[0.88rem] tw-leading-relaxed tw-text-ink/65"><?= htmlspecialchars($step['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
