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
$heroOnDark = $heroVariant === 'image';

$heroPad = [
  'split' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+3rem)] tw-pb-[clamp(3.5rem,6vw,5rem)]',
  'image' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+3rem)] tw-pb-[clamp(3rem,5.5vw,4.5rem)]',
  'minimal' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+2.5rem)] tw-pb-[clamp(3rem,5vw,4rem)]',
  'utility' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+1.5rem)] tw-pb-[clamp(1.75rem,3vw,2.5rem)]',
  'legal' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+1.25rem)] tw-pb-[clamp(1.5rem,2.5vw,2rem)]',
][$heroVariant] ?? 'tw-pt-[calc(var(--pc-navbar-h,110px)+2.5rem)] tw-pb-16';

$heroSurface = [
  'split' => 'tw-bg-white',
  'image' => 'tw-relative tw-flex tw-min-h-[clamp(300px,32vw,420px)] tw-items-end tw-overflow-hidden',
  'minimal' => 'tw-bg-white',
  'utility' => 'tw-bg-surface tw-border-0 tw-border-b tw-border-solid tw-border-hairline',
  'legal' => 'tw-bg-surface tw-border-0 tw-border-b tw-border-solid tw-border-hairline',
][$heroVariant] ?? 'tw-bg-white';

$heroTitleClass = [
  'split' => $pcH1 . ' tw-max-w-[15ch]',
  'image' => $pcH1OnDark . ' tw-max-w-[16ch] [text-shadow:0_1px_6px_rgba(0,0,0,0.25)]',
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

  <div class="tw-relative <?= $heroVariant === 'legal' ? $pcContainerProse : $pcContainer ?>">
    <div class="<?= $heroVariant === 'split'
      ? 'tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-16'
      : '' ?>">

      <div class="<?= $heroVariant === 'split' ? 'lg:tw-col-span-6' : '' ?>">
        <?php if ($heroCrumbFirst): ?>
          <?php require __DIR__ . '/inner-hero-crumb.php'; ?>
        <?php endif; ?>

        <?php if (!empty($heroEyebrow)): ?>
          <p class="<?= $heroEyebrowClass ?>"><?= htmlspecialchars($heroEyebrow) ?></p>
        <?php endif; ?>

        <h1 class="<?= $heroTitleClass ?>"><?= htmlspecialchars($heroTitle) ?></h1>

        <?php  ?>
        <?php if (!empty($heroDescriptionHtml)): ?>
          <p class="<?= $heroLedeClass ?>"><?= $heroDescriptionHtml ?></p>
        <?php elseif (!empty($heroDescription)): ?>
          <p class="<?= $heroLedeClass ?>"><?= htmlspecialchars($heroDescription) ?></p>
        <?php endif; ?>

        <?php if (!empty($heroActions)): ?>
          <div class="tw-mt-8 tw-flex tw-flex-wrap tw-items-center tw-gap-3"><?= $heroActions ?></div>
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
  $heroTitleLight,
  $heroTitleBold,
  $heroBreadcrumbLabel
);
