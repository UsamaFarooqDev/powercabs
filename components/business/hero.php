<?php
/**
 * /business's own hero -- photograph, headline, and the account request in it.
 *
 * The third page to use this composition, after components/drive/hero.php and
 * components/ride/hero.php: full-bleed photograph, copy on the left, a white
 * card on the right carrying the one thing the page exists to do. Drive asks
 * for an application, Ride asks for a fare, Business asks for an account. Same
 * shape, three different people, which is what makes the site feel like one
 * site while each page still leads with its own job.
 *
 * THE THREE FORMS ARE NOT INTERCHANGEABLE and must not be merged. This one
 * posts to business.php itself and emails a business account request; /drive's
 * is an eight-step application against /driver-apply; /ride's is a fare
 * estimator against api/estimate_fare.php. They share a slot, nothing else.
 *
 * WHY NOT inner-hero.php: none of its five variants can hold a form, and a
 * sixth used by three pages would be a switch statement wearing a component's
 * name. Everything reusable is still shared -- the breadcrumb partial,
 * $pcH1OnDark / $pcEyebrowOnDark, and the same BreadcrumbList JSON-LD, so
 * /business is not the one page missing it.
 *
 * THE PHOTOGRAPH is landscape-native, which is the property to keep if it is
 * swapped: a portrait source in a full-height hero is a tight band out of the
 * middle of the picture and always reads as zoomed. It also has to be dark to
 * begin with -- an executive car interior is, which is why this frame works
 * where a bright office would not. The scrim is dark at both ends and open
 * through the middle, closing to near-solid ink from about 60% where the
 * card's left edge lands, so the card sits on clean dark rather than on the
 * busiest part of the frame. Recalculate that 60% if the grid split changes.
 */
$bizHeroImgWide =
  'https://images.pexels.com/photos/5717041/pexels-photo-5717041.jpeg?auto=compress&cs=tinysrgb&w=1920';
$bizHeroImgSmall =
  'https://images.pexels.com/photos/5717041/pexels-photo-5717041.jpeg?auto=compress&cs=tinysrgb&w=1000';

/* Same structured data inner-hero.php produces, so moving off that component
   does not silently drop /business out of the breadcrumb trail. */
$heroBreadcrumbLabel = 'Business';
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
<!-- ============ Business Hero ============ -->
<section class="tw-relative tw-flex tw-items-center tw-overflow-hidden tw-bg-ink tw-pb-[clamp(3rem,6vw,4.5rem)] tw-pt-[calc(var(--pc-navbar-h,110px)+2rem)] lg:tw-min-h-screen">
  <picture>
    <source media="(max-width: 767px)" srcset="<?= htmlspecialchars($bizHeroImgSmall) ?>">
    <img src="<?= htmlspecialchars($bizHeroImgWide) ?>" alt="" aria-hidden="true"
      class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-[38%_center] md:tw-object-[46%_center]"
      fetchpriority="high" decoding="async">
  </picture>

  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-[radial-gradient(55%_65%_at_36%_34%,rgba(255,176,94,0.12)_0%,transparent_68%),linear-gradient(90deg,rgba(10,7,5,0.9)_0%,rgba(10,7,5,0.56)_24%,rgba(10,7,5,0.28)_46%,rgba(10,7,5,0.7)_60%,rgba(10,7,5,0.94)_74%,rgba(10,7,5,0.96)_100%),linear-gradient(180deg,transparent_58%,rgba(10,7,5,0.5)_100%)]" aria-hidden="true"></span>

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

        <?php /* Three facts, not a feature list -- the hero's job is to make
                 the form worth filling in, and these are the three things a
                 buyer is actually weighing. All three are stated with detail
                 further down the page: one account and one invoice in
                 account-benefits.php, the licence number in trust-proof.php. */ ?>
        <ul class="tw-m-0 tw-mt-8 tw-flex tw-list-none tw-flex-wrap tw-gap-x-8 tw-gap-y-3 tw-p-0">
          <?php foreach (['One account for the whole team', 'One monthly invoice', 'NTA licensed, Garda-vetted'] as $point): ?>
            <li class="tw-flex tw-items-center tw-gap-2 tw-text-[0.9375rem] tw-font-semibold tw-text-white/[0.88]">
              <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
              <?= htmlspecialchars($point) ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="lg:tw-col-span-6 xl:tw-col-span-5">
        <div class="tw-mx-auto tw-w-full tw-max-w-[560px]">
          <?php require __DIR__ . '/business-account-form.php'; ?>
        </div>
      </div>

    </div>
  </div>
</section>
<?php
/* Cleared so nothing further down the page inherits this hero's variables --
   the same contract inner-hero.php keeps. */
unset($heroEyebrow, $heroTitleLight, $heroTitleBold, $heroDescription, $heroBreadcrumbLabel);
