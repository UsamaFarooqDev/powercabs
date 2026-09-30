<?php
/**
 * /drive's own hero -- photograph, headline, and the application form in it.
 *
 * WHY THIS IS NOT components/shared/inner-hero.php.
 * That component has five compositions and 26 pages use them; none of the five
 * can hold an eight-step form, and a sixth variant used by exactly one page is
 * how a shared component turns into a switch statement. The homepage already
 * owns its hero for the same reason. Everything else stays shared: the
 * breadcrumb markup is components/shared/inner-hero-crumb.php, the type is
 * $pcH1OnDark / $pcEyebrowOnDark, and the BreadcrumbList JSON-LD below is the
 * same shape inner-hero.php emits, so /drive is not the one page missing it.
 *
 * WHAT MOVED. The driver application used to be a full dark section two
 * screens down, behind a photograph of its own. /drive exists to get drivers
 * to apply, and it was asking them to read three sections first. The form is
 * the hero's right-hand column now and the page opens on it.
 *
 * THE PHOTOGRAPH. The previous hero image was a motorway seen from the back
 * seat: near-black silhouettes around a blown-out sky, which as a full-bleed
 * background put its brightest area exactly where the headline sits.
 *
 * THE PHOTOGRAPH IS LANDSCAPE-NATIVE, and that is the whole point of this
 * choice. The previous one was a 2:3 PORTRAIT frame forced into a 16:9 crop,
 * which is a tight band out of the middle of the picture -- the reason it read
 * as a giant out-of-focus steering wheel rather than as a scene. This frame is
 * 3:2 as shot, so in a full-height hero (roughly 1.6:1) object-cover trims
 * about 30px off the top and bottom and shows essentially the whole picture:
 * a driver at the wheel, rain on the glass, a street moving past.
 *
 * Keep that property if this image is ever swapped. A portrait source in a
 * landscape hero is always going to look zoomed, however it is cropped.
 *
 * One known imperfection, flagged rather than hidden: the car is left-hand
 * drive and Ireland is right-hand drive. At this scrim weight it is not
 * something most people will read, and the alternatives were worse -- the
 * best-lit landscape options in stock are yellow New York cabs, and the one
 * sharp taxi-cockpit frame has a Dubai meter reading AED in the middle of it.
 * Mirroring the image would fix the side and reverse the signage in the
 * street behind, so it is left as shot.
 *
 * Two sources for bytes, not for framing: the same crop at two widths, so a
 * phone does not pull a 1920px file. Composition is identical at both, with
 * object-position biased left below md so the driver stays in frame when the
 * hero is narrow and tall. It is the LCP image: fetchpriority="high", and
 * never loading="lazy".
 *
 * HEIGHT. Full viewport height from lg. Below that the content sets the
 * height: on a phone the form alone is ~520px, so a viewport floor there
 * would only add empty space under the tallest section on the page.
 */
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

        <?php if (!empty($heroDescription)): ?>
          <p class="tw-mb-0 tw-max-w-[50ch] tw-text-[1.0625rem] tw-leading-[1.65] tw-text-white/[0.82]"><?= htmlspecialchars(
            $heroDescription,
          ) ?></p>
        <?php endif; ?>

        <?php /* Kept from the application section this hero absorbed, where it
                 sat above a headline that has gone. It is the only thing on
                 the page that says "Irish" before a driver scrolls. */ ?>
        <span class="tw-mt-7 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-border tw-border-solid tw-border-white/[0.16] tw-bg-white/[0.08] tw-px-3.5 tw-py-1.5 tw-text-xs tw-font-semibold tw-text-white tw-backdrop-blur-sm">
          <span class="tw-font-bold">IE</span>
          Irish Taxi Platform &bull; Driver First
        </span>
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
unset($heroEyebrow, $heroTitleLight, $heroTitleBold, $heroDescription, $heroBreadcrumbLabel);
