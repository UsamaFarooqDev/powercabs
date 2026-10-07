<?php
$driveHeroImgWide =
  'https://images.pexels.com/photos/1405665/pexels-photo-1405665.jpeg?auto=compress&cs=tinysrgb&w=1920';
$driveHeroImgSmall =
  'https://images.pexels.com/photos/1405665/pexels-photo-1405665.jpeg?auto=compress&cs=tinysrgb&w=1000';

/* Same structured data inner-hero.php produces, so moving off that component
   does not silently drop /drive out of the breadcrumb trail. */
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

// Read by components/shared/inner-hero-crumb.php.
$heroCrumbLink = 'tw-text-white/75 hover:tw-text-white';
$heroCrumbSep = 'tw-text-white/45';
$heroCrumbCurrent = 'tw-text-white';
$heroCrumbFirst = true;
?>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES) ?></script>
<!-- ============ Drive Hero ============ -->
<section class="tw-relative tw-flex tw-items-center tw-overflow-hidden tw-bg-ink tw-pb-[clamp(3rem,6vw,4.5rem)] tw-pt-[calc(var(--pc-navbar-h,110px)+2rem)] lg:tw-min-h-screen">
  <picture>
    <source media="(max-width: 767px)" srcset="<?= htmlspecialchars($driveHeroImgSmall) ?>">
    <img src="<?= htmlspecialchars($driveHeroImgWide) ?>" alt="" aria-hidden="true"
      class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-[34%_center] md:tw-object-[62%_center]"
      fetchpriority="high" decoding="async">
  </picture>

  <?php /* Dark at BOTH ends, open through the middle -- not a one-way ramp.

           The ramp it replaced ran 0.88 on the left to 0.24 on the right, which
           put its thinnest scrim exactly where the white form card sits: the
           steering wheel ran right up to the card's edge and half of it
           disappeared behind it, so the photograph read as something partly
           hidden rather than as a picture.

           The stops now are: heavy on the left so white type holds over it,
           thinning through 26-52% where the driver and the wheel actually are,
           then closing back to near-solid ink from about 60% -- which is where
           the card's left edge lands (x=889 of 1440 at the xl 7/5 split). The
           card therefore sits on clean dark, and the whole of the photograph
           is in the open part of the frame.

           Recalculate that 60% if the grid split changes. A softer bottom fade
           stops the image cutting off hard where the section ends. */ ?>
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

        <?php /* $heroLead -- optional, and set only by /drive. One line of
                 plain address to the reader, in full white and a heavier
                 weight, before $heroDescription gives the numbers underneath
                 it. Two paragraphs rather than one long one because the first
                 is an argument and the second is the terms; run together they
                 read as a single block of small print under the headline. */ ?>
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

        <?php /* Kept from the application section this hero absorbed, where it
                 sat above a headline that has gone. It is the only thing on
                 the page that says "Irish" before a driver scrolls. */ ?>
        <!-- <span class="tw-mt-7 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-white/[0.16] tw-bg-white/[0.08] tw-px-3.5 tw-py-1.5 tw-text-xs tw-font-semibold tw-text-white tw-backdrop-blur-sm">
          <span class="tw-font-bold">IE</span>
          Irish Taxi Platform &bull; Driver First
        </span> -->
      </div>

      <div class="lg:tw-col-span-6 xl:tw-col-span-5">
        <?php require __DIR__ . '/join-family-form.php'; ?>
      </div>

    </div>
  </div>
</section>
<?php
/* Cleared so nothing further down the page inherits this hero's variables --
   the same contract inner-hero.php keeps. */
unset($heroEyebrow, $heroTitleLight, $heroTitleBold, $heroLead, $heroDescription, $heroBreadcrumbLabel);
