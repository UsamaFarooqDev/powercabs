<?php

if (!isset($heroBreadcrumbLabel)) {
  $heroBreadcrumbLabel = ucwords(str_replace('-', ' ', preg_replace('/\.php$/', '', $currentPage ?? 'business')));
}

$breadcrumbSiteUrl = $siteUrl ?? 'https://www.powercabs.ie/';
$breadcrumbPageUrl = $canonicalUrl ?? $breadcrumbSiteUrl . ($currentPage ?? 'business');

$breadcrumbSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $breadcrumbSiteUrl],
    ['@type' => 'ListItem', 'position' => 2, 'name' => $heroBreadcrumbLabel, 'item' => $breadcrumbPageUrl],
  ],
];

$bizHeroChecks = [
  'One account',
  'Monthly billing',
  'Airport transfers',
  'Multiple users',
  'Journey history',
  'Business support',
];
?>
<script type="application/ld+json"><?= json_encode(
  $breadcrumbSchema,
  JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES,
) ?></script>

<section class="pc-biz-hero position-relative overflow-hidden">
  <span class="pc-drive-blob position-absolute rounded-circle z-0 pc-drive-blob-orange" aria-hidden="true"></span>

  <div class="container position-relative">
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb mb-0" style="--bs-breadcrumb-divider: '//'; font-size: .82rem;">
        <li class="breadcrumb-item"><a class="text-decoration-none" style="color: var(--pc-text-muted);" href="<?= $assetPath ?>/">Home</a></li>
        <li class="breadcrumb-item active fw-semibold" style="color: var(--pc-dark);" aria-current="page"><?= htmlspecialchars(
          $heroBreadcrumbLabel,
        ) ?></li>
      </ol>
    </nav>

    <div class="row align-items-center gy-5">
      <div class="col-lg-6">
        <p class="small fw-semibold text-uppercase mb-3" style="letter-spacing: .08em; color: var(--pc-orange);">/ PowerCabs Business</p>

        <h1 class="mb-3" style="font-size: clamp(2.1rem, 4vw, 3.1rem); line-height: 1.1; letter-spacing: -.01em;">
          Business taxi travel,<br>made simple.
        </h1>

        <p class="mb-4" style="font-size: 1.15rem; color: var(--pc-text-muted); max-width: 44ch;">
          Reliable taxi travel for your employees, clients and guests &mdash; with one
          business account, simple billing and complete journey visibility.
        </p>

        <div class="d-flex flex-wrap align-items-center gap-3 mb-4">
          <a class="btn btn-pc-primary btn-md px-4 rounded-pill" href="#business-booking-form">Open a Free Business Account</a>
          <a class="pc-biz-hero-secondary-btn d-inline-flex align-items-center gap-2" href="tel:+35312030727">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 2.25rem; height: 2.25rem; background: var(--pc-peach); color: var(--pc-orange);">
              <i class="bi bi-telephone-fill" style="font-size: .9rem;"></i>
            </span>
            Talk to Our Team
          </a>
        </div>

        <ul class="list-unstyled row row-cols-2 g-2 mb-0">
          <?php foreach ($bizHeroChecks as $check): ?>
            <li class="col d-flex align-items-center gap-2">
              <i class="bi bi-check-circle-fill flex-shrink-0" style="color: var(--pc-orange); font-size: .9rem;"></i>
              <span class="small fw-medium" style="color: var(--pc-dark);"><?= htmlspecialchars($check) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="col-lg-6">
        <div class="pc-biz-hero-media overflow-hidden position-relative mx-auto" style="max-width: 460px;">
          <img src="<?= $assetPath ?>assets/img/services-corporate.jpg" alt="Business traveller in the back seat of a PowerCabs vehicle, on the way to a meeting" class="w-100 h-100 object-fit-cover" loading="eager">

          <div class="pc-biz-hero-chip pc-biz-hero-chip-a position-absolute z-2 d-flex align-items-center gap-2">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 30px; height: 30px; background: rgba(25,135,84,.12);">
              <i class="bi bi-check-circle-fill text-success" style="font-size: .9rem;"></i>
            </span>
            <span class="d-flex flex-column lh-sm">
              <strong class="small">Booking Confirmed</strong>
              <small class="text-muted" style="font-size: .68rem;">Dublin &rarr; Airport &middot; 08:45</small>
            </span>
          </div>

          <div class="pc-biz-hero-chip pc-biz-hero-chip-b position-absolute z-2 d-flex align-items-center gap-2">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle flex-shrink-0" style="width: 30px; height: 30px; background: var(--pc-peach); color: var(--pc-orange);">
              <i class="bi bi-briefcase-fill" style="font-size: .85rem;"></i>
            </span>
            <span class="d-flex flex-column lh-sm">
              <strong class="small">Business Account</strong>
              <small class="text-muted" style="font-size: .68rem;">One invoice, every journey</small>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
