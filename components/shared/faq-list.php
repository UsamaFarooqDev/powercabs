<?php
$faqListItems = $faqListItems ?? [];
if ($faqListItems) {
  $faqListStart = $faqListStart ?? 0;
  $faqListTag = $faqListTag ?? 'h3';
  $faqListParent = $faqListParent ?? '#' . $faqListId;
  $faqListAnswerRaw = $faqListAnswerRaw ?? false;
  $i = $faqListStart;
  foreach ($faqListItems as $item):
    $panelId = $faqListId . 'Item' . $i;
    ?>
    <div class="tw-border-0 tw-border-t tw-border-solid tw-border-hairline first:tw-border-t-0">
      <<?= $faqListTag ?> class="tw-m-0">
        <?php  ?>
        <?php  ?>
        <button class="tw-group tw-flex tw-w-full tw-appearance-none tw-items-center tw-justify-between tw-gap-5 tw-border-0 tw-bg-transparent tw-px-0 tw-py-5 tw-text-left tw-text-[1.0625rem] tw-font-semibold tw-leading-snug tw-text-ink"
          type="button" data-pc-collapse data-pc-target="#<?= $panelId ?>"
          aria-expanded="false" aria-controls="<?= $panelId ?>">
          <span><?= htmlspecialchars($item['q']) ?></span>
          <?php  ?>
          <span class="tw-inline-flex tw-h-8 tw-w-8 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-power/35 tw-text-power tw-transition tw-duration-200 group-hover:tw-border-power/70 group-hover:tw-bg-power/10 group-aria-expanded:tw-border-power group-aria-expanded:tw-bg-power group-aria-expanded:tw-text-white motion-reduce:tw-transition-none" aria-hidden="true">
            <svg class="tw-h-[17px] tw-w-[17px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
              <path d="M5 12h14"/>
              <path class="tw-origin-center tw-transition-opacity tw-duration-200 group-aria-expanded:tw-opacity-0 motion-reduce:tw-transition-none" d="M12 5v14"/>
            </svg>
          </span>
        </button>
      </<?= $faqListTag ?>>
      <div id="<?= $panelId ?>" class="tw-max-h-0 tw-overflow-hidden tw-transition-[max-height] tw-duration-200 tw-ease-[cubic-bezier(0.4,0,0.2,1)] [&.is-open]:tw-max-h-[80rem] motion-reduce:tw-transition-none"
        data-pc-collapse-panel data-pc-collapse-parent="<?= htmlspecialchars($faqListParent) ?>">
        <?php  ?>
        <div class="<?= $pcBody ?> tw-max-w-[68ch] tw-pb-5 tw-pr-8"><?= $faqListAnswerRaw
          ? $item['a']
          : htmlspecialchars($item['a']) ?></div>
      </div>
    </div>
    <?php
    $i++;
  endforeach;
}
$faqListItems = [];
unset($faqListStart, $faqListTag, $faqListParent, $faqListAnswerRaw);
