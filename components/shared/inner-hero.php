<?php
/**
 * The inner-page hero, in five intentional compositions.
 *
 * Before the second pass this component had exactly one look -- a photograph
 * under an 88% warm-black scrim with the title on top -- and all 26 inner
 * pages used it. Measured, every one of them rendered a 340px band with a
 * 72px <h1>, so a complaint form and a service landing page opened at
 * identical visual volume, and the photography underneath was invisible at
 * that scrim weight (§29: an image that dark is not imagery, it is a texture).
 *
 * Set $heroVariant before requiring this file:
 *
 *   'split'    text beside a framed photograph. The default for service and
 *              marketing pages. §8's Variant A.
 *   'image'    the full-bleed photograph with the title over it, kept for
 *              pages whose picture genuinely carries the message. §9.
 *   'minimal'  type and whitespace, no photograph. Company/editorial. §10.
 *   'utility'  compact: title, one line, straight into the useful content.
 *              Contact, FAQs, forms. §11.
 *   'legal'    the most restrained on the site. Privacy, terms, GDPR. §12.
 *
 * $heroCompact = true is still honoured and maps to 'utility', so the nine
 * pages that set it keep working untouched.
 *
 * Variables (all optional except the title):
 *   $heroTitleLight / $heroTitleBold  joined with a space to form the <h1>
 *   $heroEyebrow       small orange label above the title
 *   $heroDescription   the supporting line under it. NOTE: 24 pages were
 *                      already setting this and the old markup never rendered
 *                      it -- the copy existed, it was just dropped on the
 *                      floor. It is printed now, which is where §5's "short
 *                      supporting description" comes from without writing any
 *                      new marketing claims.
 *   $heroBgImage       photograph, used by 'split' and 'image'
 *   $heroImageAlt      alt text. 'split' shows the image as content, so it
 *                      needs one; 'image' keeps it decorative behind text.
 *   $heroActions       pre-rendered HTML for the CTA row (§5, §45)
 *   $heroBreadcrumbLabel  overrides the label derived from the filename
 */
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

/* COLLAGE. $heroImages = [['id' => '<pexels id>', 'alt' => '...'], ...] makes
   the 'split' variant render a 2x2 grid of photographs instead of one frame.
   It is the same treatment as components/home/coverage.php, and for the same
   reason: where one picture cannot carry the claim, four registers of the same
   subject can. Everything else about the hero is unchanged, so a page opting
   in keeps the shared breadcrumb, schema, padding and type.
   Leave it unset and nothing about this component behaves differently. */
$heroImages = $heroImages ?? [];

// 'split' needs something to split with; fall back rather than render an
// empty frame on a page that set neither a photograph nor a collage.
if ($heroVariant === 'split' && empty($heroBgImage) && empty($heroImages)) {
  $heroVariant = 'minimal';
}
$heroOnDark = $heroVariant === 'image';

/* Vertical rhythm, per §7: 120-160px above the title on desktop and 80-120
   below, dropping to 96-120 / 56-80 on a phone. The top value has to clear
   the fixed header as well, so it is measured FROM --pc-navbar-h (~110px)
   rather than guessed -- that variable is written from JS on load and resize.
   Utility and legal pages sit deliberately below the range: §11 and §12 ask
   for compact and very compact, and nobody arriving at a privacy policy
   wants 160px of air first. */
$heroPad = [
  'split' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+3rem)] tw-pb-[clamp(3.5rem,6vw,5rem)]',
  'image' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+3rem)] tw-pb-[clamp(3rem,5.5vw,4.5rem)]',
  'minimal' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+2.5rem)] tw-pb-[clamp(3rem,5vw,4rem)]',
  'utility' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+1.5rem)] tw-pb-[clamp(1.75rem,3vw,2.5rem)]',
  'legal' => 'tw-pt-[calc(var(--pc-navbar-h,110px)+1.25rem)] tw-pb-[clamp(1.5rem,2.5vw,2rem)]',
][$heroVariant] ?? 'tw-pt-[calc(var(--pc-navbar-h,110px)+2.5rem)] tw-pb-16';

/* Surfaces. Only 'image' is dark; the rest sit on the page's own light
   ground, which is most of why the refined pages read calmer -- the old
   hero put a near-black band at the top of all 26 of them. */
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

// The breadcrumb is above the title everywhere except the photographic
// variant, where the copy is bottom-aligned over the image and a crumb
// floating above the headline has nothing to sit against.
$heroCrumbFirst = $heroVariant !== 'image';
?>
<script type="application/ld+json"><?= json_encode($breadcrumbSchema, JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES) ?></script>
<!-- ============ Inner Page Hero ============ -->
<section class="<?= $heroSurface ?> <?= $heroPad ?>">
  <?php if ($heroVariant === 'image'): ?>
    <?php /* One warm-black gradient, weighted to the bottom-left where the
             copy sits and lifting to the right so the photograph survives.
             This replaced a two-layer scrim whose upper layer was a 50%
             ORANGE wash running on all 26 inner pages -- the single biggest
             reason the site read as "orange everywhere", and the reason every
             hero looked like the same picture. */ ?>
    <?php /* NOT loading="lazy". This photograph fills the top of the viewport,
             so it is the LCP element on every page using this variant
             (/about-us, /city-tours, /meet-greet) -- deferring it is deferring
             the metric itself. Measured at top=0 with heights of 467-547px, so
             there is no reading of "below the fold" that applies. Same rule the
             collage below and components/drive/hero.php already follow. */ ?>
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

        <?php if (!empty($heroDescription)): ?>
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
        <?php /* The photograph as CONTENT rather than as a background: framed,
                 at a fixed ratio, unfiltered. §29 asks for imagery that
                 communicates, and the same pictures were already on these
                 pages -- they were just underneath a scrim. */ ?>
        <div class="lg:tw-col-span-6">
          <?php if ($heroImages): ?>
            <?php /* The collage. Same recipe as the homepage coverage grid --
                     2x2, 4:3 tiles, a 6px gutter and a small radius -- so the
                     two read as one device rather than two takes on the same
                     idea. 4:3 rather than square because these are landscape
                     photographs and a square tile throws a third of each away.
                     mx-auto keeps the block centred in its half instead of
                     pinned to the right edge. */ ?>
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
            <?php /* A HEIGHT, not an aspect ratio. Ratio-sizing made the image
                     as tall as the column was wide -- 499px inside a 624px
                     column -- which pushed the whole hero to 687px and put it in
                     exactly the 700-800px territory §7 tells you not to force.
                     Sizing the frame directly caps the hero near 600px on
                     desktop and 420px on a phone, and object-cover absorbs the
                     difference in the photograph instead of in the layout. */ ?>
            <?php /* 190px on a phone, not 240. Stacked under the copy, a 240px
                     frame pushed the split hero to 690-775px on a 360x820
                     screen -- the entire first viewport, which is what §40 and
                     §45 both warn about: the reader scrolls a screen of hero
                     before learning what the page is for. The photograph is
                     supporting material on a phone, so it gives up the height. */ ?>
            <?php /* Capped and CENTRED in its half, not stretched across it.
                     Sized to the column, the frame ran 619x400 at 1440 -- a
                     photograph wider than the sentence beside it, on every
                     split hero on the site. 440px lines it up with the collage
                     block above and leaves the heading as the loudest thing in
                     the row. mx-auto rather than ml-auto so it sits in the
                     middle of its half instead of against the page edge. */ ?>
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
/* Cleared so the next page or component cannot inherit this page's hero. */
unset(
  $heroVariant,
  $heroCompact,
  $heroEyebrow,
  $heroDescription,
  $heroActions,
  $heroImages,
  $heroImageAlt,
  $heroTitleLight,
  $heroTitleBold,
  $heroBreadcrumbLabel
);
