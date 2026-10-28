<?php
$heroTitle = trim(($heroTitleLight ?? '') . ' ' . ($heroTitleBold ?? ''));

if (!isset($heroBreadcrumbLabel)) {
  $heroBreadcrumbLabel = ucwords(str_replace('-', ' ', preg_replace('/\.php$/', '', $currentPage ?? '')));
}

$breadcrumbSiteUrl = $siteUrl ?? 'https://www.powercabs.ie/';
$breadcrumbPageUrl = $canonicalUrl ?? $breadcrumbSiteUrl . ($currentPage ?? '');

$breadcrumbSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $breadcrumbSiteUrl],
    ['@type' => 'ListItem', 'position' => 2, 'name' => $heroBreadcrumbLabel, 'item' => $breadcrumbPageUrl],
  ],
];

$heroCompact = $heroCompact ?? false;
$heroVariant = $heroVariant ?? ($heroCompact ? 'utility' : 'split');

$heroImages = $heroImages ?? [];

if ($heroVariant === 'split' && empty($heroBgImage) && empty($heroImages)) {
  $heroVariant = 'minimal';
}
$heroOnDark = $heroVariant === 'image' || $heroVariant === 'showcase';

$heroPad = [
  'split' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+3rem)] tw-pb-[clamp(3.5rem,6vw,5rem)]',
  'image' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+3rem)] tw-pb-[clamp(3rem,5.5vw,4.5rem)]',
  // No bottom padding below lg: the photo band is the last thing on the first screen and runs
  // flush into the section under it.
  'showcase' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+2rem)] tw-pb-0 lg:tw-pb-[clamp(3rem,6vw,4.5rem)]',
  'minimal' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+2.5rem)] tw-pb-[clamp(3rem,5vw,4rem)]',
  'utility' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+1.5rem)] tw-pb-[clamp(1.75rem,3vw,2.5rem)]',
  'legal' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+1.25rem)] tw-pb-[clamp(1.5rem,2.5vw,2rem)]',
][$heroVariant] ?? 'tw-pt-[calc(var(--pc-navbar-h,110px)+2.5rem)] tw-pb-16';

$heroSurface = [
  'split' => 'tw-bg-white',
  'image' => 'tw-relative tw-flex tw-min-h-[clamp(300px,32vw,420px)] tw-items-end tw-overflow-hidden',
  // A full screen tall like /ride and /drive, but the dark is a panel on the left behind the
  // copy rather than a wash over the whole photo. column-reverse so the copy still reads first
  // on a phone while the photo stays the last child in the DOM.
  'showcase' => 'tw-relative tw-flex tw-flex-col-reverse tw-overflow-hidden tw-bg-ink' .
    ' lg:tw-min-h-screen lg:tw-flex-row lg:tw-items-center',
  'minimal' => 'tw-bg-white',
  'utility' => 'tw-bg-surface tw-border-0 tw-border-b tw-border-solid tw-border-hairline',
  'legal' => 'tw-bg-surface tw-border-0 tw-border-b tw-border-solid tw-border-hairline',
][$heroVariant] ?? 'tw-bg-white';

$heroTitleClass = [
  'split' => $pcH1 . ' tw-max-w-[15ch]',
  'image' => $pcH1OnDark . ' tw-max-w-[16ch] [text-shadow:0_1px_6px_rgba(0,0,0,0.25)]',
  'showcase' => $pcH1OnDark . ' tw-max-w-[15ch] [text-shadow:0_1px_8px_rgba(0,0,0,0.3)]',
  'minimal' => $pcH1 . ' tw-max-w-[17ch]',
  'utility' => $pcH1Utility . ' tw-max-w-[20ch]',
  'legal' => $pcH1Legal . ' tw-max-w-[24ch]',
][$heroVariant] ?? $pcH1;

$heroLedeClass = $heroOnDark
  ? 'tw-mb-0 tw-max-w-[54ch] tw-text-[1.0625rem] tw-leading-[1.65] tw-text-white/[0.82]'
  : 'tw-mb-0 tw-max-w-[54ch] tw-text-[1.0625rem] tw-leading-[1.65] tw-text-muted';

$heroCrumbLink = $heroOnDark ? 'tw-text-white/75 hover:tw-text-white' : 'tw-text-muted hover:tw-text-power';
$heroCrumbSep = $heroOnDark ? 'tw-text-white/60' : 'tw-text-ink/30';
$heroCrumbCurrent = $heroOnDark ? 'tw-text-white' : 'tw-text-ink';
$heroEyebrowClass = $heroOnDark ? $pcEyebrowOnDark : $pcEyebrow;

$heroCrumbFirst = $heroVariant !== 'image';
?>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES) ?></script>
<section class="<?= $heroSurface ?> <?= $heroPad ?>">
  <?php if ($heroVariant === 'image'): ?>
    <?php  ?>
    <?php  ?>
    <img src="<?= htmlspecialchars($heroBgImage ?? '') ?>" alt="" aria-hidden="true"
      class="tw-absolute tw-left-0 tw-top-0 tw-h-full tw-w-full tw-object-cover"
      fetchpriority="high" decoding="async">
    <span class="tw-absolute tw-left-0 tw-top-0 tw-h-full tw-w-full tw-bg-[linear-gradient(105deg,rgba(10,7,5,0.86)_0%,rgba(10,7,5,0.68)_46%,rgba(12,8,5,0.4)_100%)]" aria-hidden="true"></span>
  <?php endif; ?>

  <?php if ($heroVariant === 'showcase'): ?>
    <?php /* Outside the container on purpose: only a direct child of the section can reach the
             viewport's right edge. The ink only runs across the photo's inner edge -- the right
             of the frame stays the photograph, unwashed. #111111 is the `ink` token. */ ?>
    <div class="tw-relative tw-mt-9 tw-h-[clamp(17rem,66vw,27rem)] lg:tw-absolute lg:tw-inset-y-0 lg:tw-right-0 lg:tw-mt-0 lg:tw-h-auto lg:tw-w-[64%] xl:tw-w-[62%]">
      <picture>
        <?php if (!empty($heroBgImageSmall)): ?>
          <source media="(max-width: 767px)" srcset="<?= htmlspecialchars($heroBgImageSmall) ?>">
        <?php endif; ?>
        <img src="<?= htmlspecialchars($heroBgImage ?? '') ?>" alt="" aria-hidden="true"
          class="tw-h-full tw-w-full tw-object-cover tw-object-[50%_42%] lg:tw-object-[50%_48%]"
          fetchpriority="high" decoding="async">
      </picture>
      <span class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-top-0 tw-h-24 tw-bg-[linear-gradient(to_bottom,#111111_0%,rgba(17,17,17,0.62)_48%,rgba(17,17,17,0)_100%)] lg:tw-hidden" aria-hidden="true"></span>
      <span class="tw-pointer-events-none tw-absolute tw-inset-y-0 tw-left-0 tw-hidden tw-w-full tw-bg-[linear-gradient(to_right,#111111_0%,rgba(17,17,17,0.92)_22%,rgba(17,17,17,0.6)_31%,rgba(17,17,17,0.22)_39%,rgba(17,17,17,0)_48%)] lg:tw-block" aria-hidden="true"></span>
    </div>
  <?php endif; ?>

  <div class="tw-relative <?= $heroVariant === 'legal' ? $pcContainerProse : $pcContainer ?>">
    <div class="<?= $heroVariant === 'split'
      ? 'tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-16'
      : '' ?>">

      <div class="<?= [
        'split' => 'lg:tw-col-span-6',
        // Stops where the ink starts to lift, so no line of type ends on the bright half.
        'showcase' => 'lg:tw-w-[55%] xl:tw-w-[51%]',
      ][$heroVariant] ?? '' ?>">
        <?php if ($heroCrumbFirst): ?>
          <?php require __DIR__ . '/inner-hero-crumb.php'; ?>
        <?php endif; ?>

        <?php if (!empty($heroEyebrow)): ?>
          <p class="<?= $heroEyebrowClass ?>"><?= htmlspecialchars($heroEyebrow) ?></p>
        <?php endif; ?>

        <?php if ($heroVariant === 'showcase' && !empty($heroTitleLight) && !empty($heroTitleBold)): ?>
          <h1 class="<?= $heroTitleClass ?>">
            <span class="tw-block"><?= htmlspecialchars($heroTitleLight) ?></span>
            <span class="tw-mt-1 tw-block tw-text-[0.74em]"><?= htmlspecialchars($heroTitleBold) ?></span>
          </h1>
        <?php else: ?>
          <h1 class="<?= $heroTitleClass ?>"><?= htmlspecialchars($heroTitle) ?></h1>
        <?php endif; ?>

        <?php  ?>
        <?php if (!empty($heroDescriptionHtml)): ?>
          <p class="<?= $heroLedeClass ?>"><?= $heroDescriptionHtml ?></p>
        <?php elseif (!empty($heroDescription)): ?>
          <p class="<?= $heroLedeClass ?>"><?= htmlspecialchars($heroDescription) ?></p>
        <?php endif; ?>

        <?php if (!empty($heroActions)): ?>
          <div class="tw-mt-8 tw-flex tw-flex-wrap tw-items-center tw-gap-3"><?= $heroActions ?></div>
        <?php endif; ?>

        <?php if (!empty($heroTrust)): ?>
          <?php /* The reassurances that belong beside the call to action rather than in a band of
                   their own further down the page. */ ?>
          <ul class="tw-m-0 tw-mt-7 tw-flex tw-list-none tw-flex-wrap tw-gap-x-6 tw-gap-y-2 tw-p-0">
            <?php foreach ($heroTrust as $heroTrustItem): ?>
              <li class="tw-inline-flex tw-items-center tw-gap-2 tw-text-[0.85rem] tw-font-medium <?= $heroOnDark
                ? 'tw-text-white/80'
                : 'tw-text-ink/60' ?>">
                <svg class="tw-h-4 tw-w-4 tw-shrink-0 <?= $heroOnDark ? 'tw-text-powerlight' : 'tw-text-power' ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><?= $heroTrustItem['icon'] ?></svg>
                <?= htmlspecialchars($heroTrustItem['label']) ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php endif; ?>

        <?php if (!$heroCrumbFirst): ?>
          <div class="tw-mt-6"><?php require __DIR__ . '/inner-hero-crumb.php'; ?></div>
        <?php endif; ?>
      </div>

      <?php if ($heroVariant === 'split'): ?>
        <?php  ?>
        <div class="lg:tw-col-span-6">
          <?php if ($heroImages): ?>
            <?php  ?>
            <div class="tw-grid tw-grid-cols-2 tw-gap-1.5 lg:tw-mx-auto lg:tw-max-w-[460px]">
              <?php foreach ($heroImages as $i => $shot): ?>
                <div class="tw-relative tw-aspect-[4/3] tw-overflow-hidden tw-rounded-lg tw-bg-ink/[0.04]">
                  <img src="https://images.pexels.com/photos/<?= htmlspecialchars(
                    $shot['id'],
                  ) ?>/pexels-photo-<?= htmlspecialchars($shot['id']) ?>.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=700"
                    alt="<?= htmlspecialchars($shot['alt'] ?? '') ?>"
                    width="700" height="525" decoding="async"
                    <?= $i === 0 ? 'fetchpriority="high"' : 'loading="lazy"' ?>
                    class="<?= $pcImgCover ?>">
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <?php  ?>
            <?php  ?>
            <?php  ?>
            <div class="tw-relative tw-mx-auto tw-h-[180px] tw-w-full tw-max-w-[440px] tw-overflow-hidden tw-rounded-2xl tw-bg-paper sm:tw-h-[clamp(230px,24vw,330px)]">
              <img src="<?= htmlspecialchars($heroBgImage) ?>"
                alt="<?= htmlspecialchars($heroImageAlt ?? '') ?>"
                class="tw-h-full tw-w-full tw-object-cover" fetchpriority="high" decoding="async">
            </div>
          <?php endif; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
</section>
<?php
unset(
  $heroVariant,
  $heroCompact,
  $heroEyebrow,
  $heroDescription,
  $heroDescriptionHtml,
  $heroActions,
  $heroImages,
  $heroImageAlt,
  $heroTrust,
  $heroBgImageSmall,
  $heroTitleLight,
  $heroTitleBold,
  $heroBreadcrumbLabel
);
