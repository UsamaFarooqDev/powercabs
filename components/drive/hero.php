<?php
$driveHeroImgWide =
  'https://images.pexels.com/photos/1405665/pexels-photo-1405665.jpeg?auto=compress&cs=tinysrgb&w=1920';
$driveHeroImgSmall =
  'https://images.pexels.com/photos/1405665/pexels-photo-1405665.jpeg?auto=compress&cs=tinysrgb&w=1000';

$heroBreadcrumbLabel = 'Drive';
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

$heroCrumbLink = 'tw-text-white/75 hover:tw-text-white';
$heroCrumbSep = 'tw-text-white/45';
$heroCrumbCurrent = 'tw-text-white';
$heroCrumbFirst = true;
?>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES) ?></script>
<section class="tw-relative tw-flex tw-items-center tw-overflow-hidden tw-bg-ink tw-pb-[clamp(3rem,6vw,4.5rem)] tw-pt-[calc(var(--pc-navbar-h,110px)+2rem)] lg:tw-min-h-screen">
  <picture>
    <source media="(max-width: 767px)" srcset="<?= htmlspecialchars($driveHeroImgSmall) ?>">
    <img src="<?= htmlspecialchars($driveHeroImgWide) ?>" alt="" aria-hidden="true"
      class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-[34%_center] md:tw-object-[62%_center]"
      fetchpriority="high" decoding="async">
  </picture>

  <?php  ?>
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-[radial-gradient(55%_65%_at_38%_32%,rgba(255,176,94,0.14)_0%,transparent_68%),linear-gradient(90deg,rgba(10,7,5,0.86)_0%,rgba(10,7,5,0.5)_24%,rgba(10,7,5,0.2)_48%,rgba(10,7,5,0.66)_60%,rgba(10,7,5,0.93)_74%,rgba(10,7,5,0.96)_100%),linear-gradient(180deg,transparent_58%,rgba(10,7,5,0.5)_100%)]" aria-hidden="true"></span>

  <div class="tw-relative tw-z-[1] tw-w-full <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-12 lg:tw-gap-12 xl:tw-gap-16">

      <div class="lg:tw-col-span-6 xl:tw-col-span-7">
        <?php require __DIR__ . '/../shared/inner-hero-crumb.php'; ?>

        <?php if (!empty($heroEyebrow)): ?>
          <p class="<?= $pcEyebrowOnDark ?>"><?= htmlspecialchars($heroEyebrow) ?></p>
        <?php endif; ?>

        <h1 class="<?= $pcH1OnDark ?> tw-max-w-[14ch] [text-shadow:0_1px_8px_rgba(0,0,0,0.3)]">
          <?= htmlspecialchars(trim(($heroTitleLight ?? '') . ' ' . ($heroTitleBold ?? ''))) ?>
        </h1>

        <?php  ?>
        <?php if (!empty($heroLead)): ?>
          <p class="tw-mb-3 tw-max-w-[46ch] tw-text-[1.1875rem] tw-font-semibold tw-leading-[1.45] tw-text-white [text-shadow:0_1px_8px_rgba(0,0,0,0.3)]"><?= htmlspecialchars(
            $heroLead,
          ) ?></p>
        <?php endif; ?>

        <?php if (!empty($heroDescription)): ?>
          <p class="tw-mb-0 tw-max-w-[50ch] tw-text-[1.0625rem] tw-leading-[1.65] tw-text-white/[0.82]"><?= htmlspecialchars(
            $heroDescription,
          ) ?></p>
        <?php endif; ?>

        <?php  ?>
      </div>

      <div class="lg:tw-col-span-6 xl:tw-col-span-5">
        <?php require __DIR__ . '/join-family-form.php'; ?>
      </div>

    </div>
  </div>
</section>
<?php
unset($heroEyebrow, $heroTitleLight, $heroTitleBold, $heroLead, $heroDescription, $heroBreadcrumbLabel);
