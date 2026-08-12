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
<section class="position-relative overflow-hidden d-flex align-items-center"
  style="min-height: clamp(260px, 29vw, 340px); padding-top: calc(var(--pc-navbar-h, 110px) + 2.5rem); padding-bottom: clamp(2.5rem, 5.5vw, 4rem);">
  <img src="<?= htmlspecialchars($heroBgImage) ?>" alt="" aria-hidden="true"
    class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" loading="lazy">
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"
    style="background: rgba(8, 6, 5, .4);"></span>
  <span class="position-absolute top-0 start-0 w-100 h-100" aria-hidden="true"
    style="background: linear-gradient(110deg, rgba(232, 89, 12, .5) 0%, rgba(255, 122, 0, .38) 55%, rgba(248, 130, 32, .22) 100%);"></span>

  <!-- Decorative "rides" watermark -- purely visual, scales with viewport so it stays tasteful on mobile instead of needing to be hidden -->
  <!-- <i class="bi bi-car-front-fill position-absolute bottom-0 end-0 text-white opacity-25 pe-none" aria-hidden="true" style="font-size: clamp(3rem, 10vw, 7rem); transform: translate(10%, 15%) rotate(-8deg);"></i> -->

  <div class="container position-relative">
    <h1 class="text-white fw-bold mb-3"
      style="font-size: clamp(1.5rem, 3vw, 2.25rem); text-shadow: 0 1px 6px rgba(0, 0, 0, .2);">
      
      <?= htmlspecialchars($heroTitle) ?></h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 text-uppercase"
        style="--bs-breadcrumb-divider: '//'; --bs-breadcrumb-divider-color: #fff; letter-spacing: .04em; font-size: .85rem;">
        <li class="breadcrumb-item">
          <a class="text-white text-opacity-75 text-decoration-none" href="<?= $assetPath ?>index.php">Home</a>
        </li>

                  <li class="breadcrumb-item active fw-semibold text-white" aria-current="page">
          <?= htmlspecialchars($heroBreadcrumbLabel) ?></li>
      </ol>
    </nav>
  </div>
</section>