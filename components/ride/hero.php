<?php
$rideHeroImgWide =
  'https://images.pexels.com/photos/4901945/pexels-photo-4901945.jpeg?auto=compress&cs=tinysrgb&w=1920';
$rideHeroImgSmall =
  'https://images.pexels.com/photos/4901945/pexels-photo-4901945.jpeg?auto=compress&cs=tinysrgb&w=1000';

/* Same structured data inner-hero.php produces, so moving off that component
   does not silently drop /ride out of the breadcrumb trail. */
$heroBreadcrumbLabel = 'Ride';
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

// Read by components/shared/inner-hero-crumb.php.
$heroCrumbLink = 'tw-text-white/75 hover:tw-text-white';
$heroCrumbSep = 'tw-text-white/45';
$heroCrumbCurrent = 'tw-text-white';
$heroCrumbFirst = true;
?>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES) ?></script>
<!-- ============ Ride Hero ============ -->
<section class="tw-relative tw-flex tw-items-center tw-overflow-hidden tw-bg-ink tw-pb-[clamp(3rem,6vw,4.5rem)] tw-pt-[calc(var(--pc-navbar-h,110px)+2rem)] lg:tw-min-h-screen">
  <picture>
    <source media="(max-width: 767px)" srcset="<?= htmlspecialchars($rideHeroImgSmall) ?>">
    <img src="<?= htmlspecialchars($rideHeroImgWide) ?>" alt="" aria-hidden="true"
      class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-[34%_center] md:tw-object-[62%_center]"
      fetchpriority="high" decoding="async">
  </picture>

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

        <?php if (!empty($heroDescription)): ?>
          <p class="tw-mb-0 tw-max-w-[50ch] tw-text-[1.0625rem] tw-leading-[1.65] tw-text-white/[0.82]"><?= htmlspecialchars(
            $heroDescription,
          ) ?></p>
        <?php endif; ?>

        <?php /* The same chip /drive carries, in the passenger's wording. Both
                 halves of it are stated elsewhere on this page -- the trust bar
                 names PowerCabs Ireland Limited and the NTA licence number. */ ?>
        <span class="tw-mt-7 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-white/[0.16] tw-bg-white/[0.08] tw-px-3.5 tw-py-1.5 tw-text-xs tw-font-semibold tw-text-white tw-backdrop-blur-sm">
          <span class="tw-font-bold">IE</span>
          Irish Taxi Platform &bull; Dublin Based
        </span>
      </div>

      <?php /* The card is wider here than /drive's. That form is eight short
               steps of one field each; this one carries a two-stop address
               block, a promo field, a ride-type select and a result panel, and
               at 520px the address rows crowd. */ ?>
      <div class="lg:tw-col-span-6 xl:tw-col-span-5">
        <div class="tw-mx-auto tw-w-full tw-max-w-[560px]">
          <?php require __DIR__ . '/fare-widget.php'; ?>
        </div>
      </div>

    </div>
  </div>
</section>
<?php
/* Cleared so nothing further down the page inherits this hero's variables --
   the same contract inner-hero.php keeps. */
unset($heroEyebrow, $heroTitleLight, $heroTitleBold, $heroDescription, $heroBreadcrumbLabel);
