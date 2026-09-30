<?php
/**
 * Homepage §09 -- safety, deliberately on a light background.
 *
 * The brief calls for a light section here, and it is the right call for more
 * than rhythm: safety copy set in white-on-black reads as a warning, and the
 * point of this section is reassurance. Blue is the semantic colour for
 * informational/safety content (§6), which is why the chip is --pc-info and
 * not orange.
 *
 * All four points are already on /safety-tips-riders and /faqs; this is a
 * summary with a route through to them, not a new set of promises.
 */
$safetyPoints = [
  ['title' => 'Licensed drivers', 'body' => 'NTA licensed and vetted before they take a single fare.'],
  ['title' => 'You see who is coming', 'body' => 'Driver name, photo, vehicle and plate, before they arrive.'],
  ['title' => 'Live trip tracking', 'body' => 'Follow the route as it happens, and share it with someone.'],
  ['title' => 'Support that answers', 'body' => 'A real Irish team, on the line at any hour.'],
];
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-16">

      <div class="lg:tw-col-span-5">
        <span class="tw-mb-4 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-pill tw-bg-info/[0.08] tw-px-3.5 tw-py-1.5 tw-text-[0.75rem] tw-font-bold tw-uppercase tw-tracking-[0.08em] tw-text-info">
          <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
          Safety
        </span>
        <h2 class="<?= $pcH2 ?> tw-max-w-[15ch]">Safety starts before the journey begins.</h2>
        <?php /* $pcBtnLink on the anchor, $pcBtnLinkIcon on the svg -- the same
                 pairing components/home/coverage.php documents. They were the
                 wrong way round here: the anchor carried the ICON recipe, so it
                 lost tw-text-power, the semibold weight, the inline-flex gap and
                 its padding, and rendered as plain inherited body text (tw-h-4
                 does nothing to an inline box). The svg's group-hover: also never
                 fired, because the unnamed tw-group it needed was never on the
                 anchor -- $pcBtnLink is what supplies tw-group/link. */ ?>
        <a class="<?= $pcBtnLink ?>" href="<?= $assetPath ?>/safety-tips-riders">
          Rider safety
          <svg class="<?= $pcBtnLinkIcon ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>

      <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-x-10 tw-gap-y-0 tw-p-0 sm:tw-grid-cols-2 lg:tw-col-span-7">
        <?php foreach ($safetyPoints as $point): ?>
          <li class="tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-py-6">
            <h3 class="tw-mb-1.5 tw-text-[1.0625rem] tw-font-bold tw-leading-snug tw-text-ink"><?= htmlspecialchars($point['title']) ?></h3>
            <p class="<?= $pcBodySm ?> tw-mb-0 tw-max-w-[40ch]"><?= htmlspecialchars($point['body']) ?></p>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</section>
