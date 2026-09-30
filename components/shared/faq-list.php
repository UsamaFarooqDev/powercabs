<?php
/**
 * The FAQ question list -- markup only, no section chrome.
 *
 * Extracted because there were TWO hand-written copies of these ~20 lines:
 * one here (via faq-accordion.php) and one in faqs.php, which additionally
 * repeated it a second time for the grouped driver questions. Three copies of
 * an accordion is three places for the behaviour to drift, and it already had:
 * the shared component and faqs.php were running different question sizes.
 * Both callers now render through this file, so the plus/minus, the timing and
 * the aria wiring can only ever be changed in one place.
 *
 *   $faqListItems      required. [['q' => ..., 'a' => ...], ...]
 *   $faqListId         required. Panel ids are built from it, and it doubles
 *                      as the data-pc-collapse-parent selector that makes the
 *                      group exclusive.
 *   $faqListParent     optional. Override the parent selector when the items
 *                      are split across several lists that must still behave
 *                      as ONE accordion (faqs.php's grouped driver questions).
 *   $faqListStart      optional. First index, so a split accordion can keep
 *                      numbering continuously and not collide ids.
 *   $faqListTag        optional. Heading tag for each question, default h3.
 *                      Use h4 where the list sits under a group heading.
 *   $faqListAnswerRaw  optional. true renders answers unescaped -- faqs.php's
 *                      copy contains real <a> links. Default false.
 *
 * Presentation is a LIST, not a stack of cards (brief §23): one hairline
 * between rows, no per-item border, radius or shadow. The previous treatment
 * gave every question its own rounded bordered box, which is what made a FAQ
 * of fifteen questions read as fifteen cards.
 *
 * Every item starts CLOSED (§20). The previous default opened the first one,
 * which on faqs.php also meant the driver accordion opened a panel inside a
 * tw-hidden container -- so its max-height was measured as 0 and the answer
 * was invisible until you closed and reopened it.
 */
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
        <?php /* aria-expanded is the single source of truth for both the open
                 state and the icon: ui.js keeps it in sync, and the minus is
                 just the plus with its vertical stroke faded out via the
                 group-aria-expanded: variant. No second state class. */ ?>
        <?php /* The QUESTION stays ink in every state. It used to turn orange
                 on hover and again when open, which put the page's accent
                 colour on a whole line of text -- the orange now lives only in
                 the +/- control, where it marks the thing you actually click.
                 aria-expanded is still the single source of truth for both the
                 open state and the icon. */ ?>
        <button class="tw-group tw-flex tw-w-full tw-appearance-none tw-items-center tw-justify-between tw-gap-5 tw-border-0 tw-bg-transparent tw-px-0 tw-py-5 tw-text-left tw-text-[1.0625rem] tw-font-semibold tw-leading-snug tw-text-ink"
          type="button" data-pc-collapse data-pc-target="#<?= $panelId ?>"
          aria-expanded="false" aria-controls="<?= $panelId ?>">
          <span><?= htmlspecialchars($item['q']) ?></span>
          <?php /* Closed: an orange glyph inside a hairline orange ring.
                   Open: the ring fills and the glyph goes white, so the minus
                   reads as the pressed/active state rather than just a
                   different shape. */ ?>
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
        <?php /* NO negative top margin here, and it must not come back.
                 This carried -mt-2 to close the gap left by the button's 20px
                 bottom padding. The parent is the collapse panel, which is
                 `overflow-hidden` so its max-height can animate -- so a child
                 pulled 8px above the panel's content box had those 8px CLIPPED
                 rather than merely shifted. The visible symptom was the first
                 line of every open answer losing the top of its letterforms,
                 on every FAQ on the site.

                 The gap it was fighting is the button's own padding, which
                 stays 20px so the closed rows keep a 64px tap target. The
                 answer's bottom padding absorbed the difference instead, so the
                 open block is the same height it was. */ ?>
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
