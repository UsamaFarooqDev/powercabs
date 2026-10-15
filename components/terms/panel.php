<?php
$termsHidden ??= true;
?>
<section class="tw-pb-16 tw-pt-3 md:tw-pb-24<?= $termsHidden ? ' tw-hidden' : '' ?>" id="<?= htmlspecialchars($termsPanelId) ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-12 lg:tw-grid-cols-12">

      <div class="lg:tw-col-span-3">
        <?php  ?>
        <div class="tw-sticky tw-top-[100px]">
          <p class="<?= $pcEyebrow ?>">On This Page</p>
          <ul class="tw-m-0 tw-flex tw-max-h-[calc(100vh-11rem)] tw-list-none tw-flex-col tw-gap-1 tw-overflow-y-auto tw-p-0 tw-pr-2 [scrollbar-width:thin]">
            <?php foreach ($termsNav as $item): ?>
              <li><a class="tw-block tw-border-0 tw-border-l-2 tw-border-solid tw-border-transparent tw-py-1.5 tw-pl-3 tw-text-sm tw-text-ink/[0.65] tw-transition-[color,border-color] tw-duration-200 hover:tw-border-l-power hover:tw-text-power focus-visible:tw-border-l-power focus-visible:tw-text-power" href="#<?= $item['id'] ?>"><?= $item['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="tw-max-w-[72ch] tw-leading-[1.75] [&_h2]:tw-scroll-mt-[100px] [&_h2]:tw-text-ink [&_h3]:tw-scroll-mt-[100px] [&_p]:tw-text-ink/[0.65] [&_ul]:tw-text-ink/[0.65] lg:tw-col-span-9">
        <p class="tw-mb-1 tw-text-sm tw-text-ink/50"><?= $termsIntro ?></p>
        <?php if ($termsMeta !== ''): ?>
          <p class="tw-mb-4 tw-text-sm tw-text-ink/50"><?= $termsMeta ?></p>
        <?php endif; ?>
<?= $termsBody ?>
      </div>

    </div>
  </div>
</section>
<?php
unset($termsPanelId, $termsIntro, $termsMeta, $termsNav, $termsBody, $termsHidden);
