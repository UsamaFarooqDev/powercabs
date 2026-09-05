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
?>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES) ?></script>
<!-- ============ Inner Page Hero ============ -->
<!-- Two stacked scrims over the photo: a neutral darkener for text contrast,
     then the warm brand wash on top. Top padding keys off --pc-navbar-h so
     the title always clears the fixed header. -->
<section class="tw-relative tw-flex tw-min-h-[clamp(260px,29vw,340px)] tw-items-center tw-overflow-hidden tw-pb-[clamp(2.5rem,5.5vw,4rem)] tw-pt-[calc(var(--pc-navbar-h,110px)+2.5rem)]">
  <img src="<?= htmlspecialchars($heroBgImage) ?>" alt="" aria-hidden="true"
    class="tw-absolute tw-left-0 tw-top-0 tw-h-full tw-w-full tw-object-cover" loading="lazy">
  <span class="tw-absolute tw-left-0 tw-top-0 tw-h-full tw-w-full tw-bg-[rgba(8,6,5,0.4)]" aria-hidden="true"></span>
  <span class="tw-absolute tw-left-0 tw-top-0 tw-h-full tw-w-full tw-bg-[linear-gradient(110deg,rgba(232,89,12,0.5)_0%,rgba(255,122,0,0.38)_55%,rgba(248,130,32,0.22)_100%)]" aria-hidden="true"></span>

  <!-- $containerStepped reproduces Bootstrap's .container, which this hero
       was laid out against -- see includes/header.php. -->
  <div class="tw-relative <?= $pcContainer ?>">
    <h1 class="tw-mb-3 tw-text-[clamp(1.5rem,3vw,2.25rem)] tw-font-bold tw-text-white [text-shadow:0_1px_6px_rgba(0,0,0,0.2)]">
      <?= htmlspecialchars($heroTitle) ?></h1>
    <nav aria-label="breadcrumb">
      <ol class="tw-m-0 tw-flex tw-list-none tw-items-center tw-gap-2 tw-p-0 tw-text-[0.85rem] tw-uppercase tw-tracking-[0.04em]">
        <li>
          <a class="tw-text-white/75 tw-no-underline hover:tw-text-white" href="<?= $assetPath ?>/">Home</a>
        </li>
        <li aria-hidden="true" class="tw-text-white/60">//</li>
        <li class="tw-font-semibold tw-text-white" aria-current="page"><?= htmlspecialchars($heroBreadcrumbLabel) ?></li>
      </ol>
    </nav>
  </div>
</section>
