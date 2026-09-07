<?php
/**
 * PowerCabs design system -- the single source of truth for the shared
 * Tailwind class recipes.
 *
 * This file holds no CSS. It holds the class STRINGS that were previously
 * copy-pasted across ~100 files, which is how the site drifted: the values
 * were right, but there was no one place that owned them, so each page
 * slowly invented its own container width and section rhythm.
 *
 * Every value below is the one that was already dominant in the markup --
 * this codifies the existing design, it does not introduce a new one:
 *   container 1320px + px-4/6/8 ... 101 uses
 *   section   py-16 md:py-24 ...... 41 uses (+27 near-identical clamps folded in)
 *   card      rounded-2xl / p-6 ... 88 / 45 uses
 *   field     the book-ride-online recipe ... 12 of 13 forms already identical
 *
 * Required from includes/header.php, so every page and component can use
 * these without importing anything. Usage: <?= $pcContainer ?>
 *
 * When a component genuinely needs to deviate, append to a recipe rather
 * than rewriting it -- "<?= $pcCard ?> lg:tw-p-8" -- so the shared part
 * stays traceable.
 */

/* ── Containers ─────────────────────────────────────────────────────────
   One horizontal rhythm for the whole site. Every major section uses
   $pcContainer so left/right alignment matches from page to page; the two
   narrower variants exist for measure-limited content, not for a different
   page width -- they keep the SAME padding scale so edges still line up. */
$pcContainer = 'tw-mx-auto tw-w-full tw-max-w-[1320px] tw-px-4 sm:tw-px-6 lg:tw-px-8';
$pcContainerNarrow = 'tw-mx-auto tw-w-full tw-max-w-[860px] tw-px-4 sm:tw-px-6 lg:tw-px-8';
$pcContainerProse = 'tw-mx-auto tw-w-full tw-max-w-[720px] tw-px-4 sm:tw-px-6 lg:tw-px-8';

/* ── Section vertical rhythm ────────────────────────────────────────────
   Three steps, not one: identical padding everywhere reads as flat. */
$pcSection = 'tw-py-16 md:tw-py-24'; // standard content section
$pcSectionTight = 'tw-py-12 md:tw-py-16'; // bands: trust strips, marquees, CTAs
$pcSectionLoose = 'tw-py-20 md:tw-py-28'; // statement sections that need air

/* ── Type scale ─────────────────────────────────────────────────────────
   Four steps, and only four. Before this existed the site had 109 section
   headings split across tw-text-2xl / -3xl / -4xl plus ~15 one-off clamps,
   which is the single biggest reason pages read as "designed separately".

   $pcH1 is the only display size -- reserve it for the one <h1> a page has.
   $pcH2 is the section heading (text-3xl -> 4xl was already dominant, so
   this codifies it rather than moving it). $pcH3 is a card/sub heading,
   $pcH4 a label-weight heading inside dense UI.

   Deviate by appending (`<?= $pcH2 ?> tw-text-white`) so the shared part
   stays greppable -- never by writing a fresh clamp. */
$pcEyebrow = 'tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power';
$pcH1 =
  'tw-mb-4 tw-text-[clamp(2.25rem,4.6vw,3.5rem)] tw-font-bold tw-leading-[1.12] tw-tracking-[-0.02em] tw-text-ink';
$pcH2 = 'tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl';
/* Two sanctioned siblings of $pcH2, added because the site genuinely uses
   three section-heading weights -- and was expressing them through 19
   different one-off clamps across 25 headings. Both values are the dominant
   member of their own cluster, not new inventions:

     display  14 headings clustered 2.75-3.25rem max  -> 3.25rem
     (standard) 6 headings clustered 2.2-2.6rem max   -> $pcH2 (2.25rem)
     small      4 headings, 3 of them already exactly this clamp

   $pcH2Display is for a statement section that carries a page on its own; it
   sits deliberately below $pcH1 so the real <h1> still wins. */
$pcH2Display =
  'tw-mb-3 tw-text-[clamp(2rem,4vw,3.25rem)] tw-font-bold tw-leading-[1.12] tw-tracking-[-0.02em] tw-text-ink';
$pcH2Small = 'tw-mb-3 tw-text-[clamp(1.5rem,2.5vw,2rem)] tw-font-bold tw-leading-snug tw-tracking-tight tw-text-ink';
$pcH3 = 'tw-mb-2 tw-text-lg tw-font-bold tw-leading-snug tw-tracking-[-0.01em] tw-text-ink';
$pcH4 = 'tw-mb-1.5 tw-text-base tw-font-semibold tw-leading-snug tw-text-ink';

/* Body copy. $pcBody is the workhorse; $pcLead is the one-paragraph intro
   that sits under a heading. Both are deliberately on the warm ink tint
   rather than a grey, so text never looks washed out against the cream. */
$pcBody = 'tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/[0.68]';
$pcLead = 'tw-mb-0 tw-text-lg tw-leading-[1.65] tw-text-ink/[0.62]';
$pcBodySm = 'tw-text-[0.95rem] tw-leading-[1.6] tw-text-ink/[0.62]';

/* Measure. Long lines are the other half of "reads unprofessional" --
   nothing body-sized should run the full 1320px. Apply to the <p>, not the
   container, so the grid around it still spans. */
$pcMeasure = 'tw-max-w-[65ch]';
$pcMeasureTight = 'tw-max-w-[46ch]';

/* Section heading block: eyebrow -> heading -> lead. */
$pcSectionHead = 'tw-mb-10 tw-max-w-[720px]'; // add tw-mx-auto tw-text-center to centre it
$pcSectionHeadCenter = 'tw-mx-auto tw-mb-12 tw-max-w-[720px] tw-text-center';

/* ── Cards ──────────────────────────────────────────────────────────────
   FIVE card types, not one generic box repeated everywhere. Each has a job;
   picking the right one is what stops a page reading as a grid of
   interchangeable tiles.

     $pcCard          the default surface -- anything that is just content
     $pcCardService   a service/offer, large, image- or icon-led, clickable
     $pcCardStat      one number plus a label; dense, no shadow
     $pcCardEditorial image-led, text over or under a photo
     $pcCardPricing   a plan or comparison column, can be "featured"
     $pcCardPanel     a form or tool panel -- the heaviest surface

   Shared vocabulary, deliberately narrow: radius is rounded-2xl everywhere
   (rounded-3xl only on the two large formats), the border is always the
   same hairline, and there are exactly three shadow depths. Do not
   introduce a fourth.

   tw-border-solid is required next to every border width: Preflight is off,
   so a width utility alone renders nothing (see includes/tailwind.php). */
$pcCard =
  'tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-6 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]';
$pcCardHover =
  'tw-transition-shadow tw-duration-300 hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.10)] motion-reduce:tw-transition-none';
$pcCardGrid = 'tw-grid tw-gap-6'; // add tw-grid-cols-* per section

// Service: the premium format. Bigger radius and padding, and a lift on
// hover -- transition is scoped to transform+shadow rather than `all`,
// because animating `all` over a card containing a backdrop-filter forces a
// re-rasterisation and flashes for one frame.
$pcCardService =
  'tw-group tw-relative tw-flex tw-h-full tw-flex-col tw-overflow-hidden tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-7 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-[transform,box-shadow] tw-duration-300 tw-ease-out hover:-tw-translate-y-1 hover:tw-shadow-[0_18px_40px_-12px_rgba(28,20,16,0.18)] motion-reduce:tw-transition-none motion-reduce:hover:tw-translate-y-0';

// Stat: no shadow at all. A wall of stat cards with shadows reads as noise;
// the hairline and the surface tint are enough to group them.
$pcCardStat =
  'tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-6';
$pcStatValue = 'tw-block tw-text-[clamp(1.75rem,3vw,2.5rem)] tw-font-bold tw-leading-none tw-tracking-[-0.02em] tw-text-ink';
$pcStatLabel = 'tw-mt-2 tw-block tw-text-[0.9rem] tw-leading-snug tw-text-ink/[0.55]';

// Editorial: the photo IS the card. No padding -- the image goes flush to
// the radius and any copy sits in its own inner block.
$pcCardEditorial =
  'tw-group tw-relative tw-flex tw-h-full tw-flex-col tw-overflow-hidden tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-[transform,box-shadow] tw-duration-300 tw-ease-out hover:-tw-translate-y-1 hover:tw-shadow-[0_18px_40px_-12px_rgba(28,20,16,0.18)] motion-reduce:tw-transition-none motion-reduce:hover:tw-translate-y-0';
$pcCardEditorialBody = 'tw-flex tw-flex-1 tw-flex-col tw-p-6';

// Pricing / comparison. The featured variant is a ring plus a warm shadow
// rather than a thicker border, so the column does not shift by 1px
// relative to its neighbours.
$pcCardPricing =
  'tw-relative tw-flex tw-h-full tw-flex-col tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-7 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]';
$pcCardPricingFeatured =
  'tw-relative tw-flex tw-h-full tw-flex-col tw-rounded-3xl tw-border tw-border-solid tw-border-transparent tw-bg-white tw-p-7 tw-ring-2 tw-ring-power/[0.35] tw-shadow-[0_18px_45px_-12px_rgba(232,89,12,0.3)]';

// Panel: forms and tools. The one place a deep shadow is correct, because
// the panel is meant to sit above the page rather than in it.
$pcCardPanel =
  'tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-[clamp(1.5rem,3vw,2.5rem)] tw-shadow-[0_24px_60px_-20px_rgba(28,20,16,0.22)]';

/* Icon chip -- the small square/round icon holder used at the top of
   service and feature cards. One size, one radius, one tint. */
$pcIconChip =
  'tw-inline-flex tw-h-12 tw-w-12 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-peach tw-text-power';
$pcIconChipDark =
  'tw-inline-flex tw-h-12 tw-w-12 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-white/10 tw-text-powerlight';

/* ── Images ─────────────────────────────────────────────────────────────
   Fixed ratios only. Random intrinsic image sizes are why grids currently
   fail to line up; the wrapper owns the ratio and the <img> just covers it.
   Always pair the wrapper class with tw-h-full tw-w-full tw-object-cover on
   the image itself. */
$pcImgWide = 'tw-relative tw-aspect-[16/9] tw-overflow-hidden tw-bg-paper'; // hero strips, editorial
$pcImgLandscape = 'tw-relative tw-aspect-[4/3] tw-overflow-hidden tw-bg-paper'; // service cards
$pcImgSquare = 'tw-relative tw-aspect-square tw-overflow-hidden tw-bg-paper'; // people, logos
$pcImgPortrait = 'tw-relative tw-aspect-[3/4] tw-overflow-hidden tw-bg-paper'; // destination cards
$pcImgCover = 'tw-h-full tw-w-full tw-object-cover';
// Paired with an editorial/service card: a slow scale on hover of the card.
$pcImgZoom =
  'tw-transition-transform tw-duration-[600ms] tw-ease-out group-hover:tw-scale-[1.04] motion-reduce:tw-transition-none motion-reduce:group-hover:tw-scale-100';

/* ── Section surfaces ───────────────────────────────────────────────────
   The rhythm knob. Alternating these is what gives a long page structure
   without every section needing its own decoration. Roughly: white is the
   default, soft/paper separate neighbouring sections, and dark is a punctuation
   mark -- at most one or two per page, never two in a row. */
$pcSurfaceWhite = 'tw-bg-white';
$pcSurfaceSoft = 'tw-bg-paper-soft';
$pcSurfacePaper = 'tw-bg-paper';
$pcSurfaceDark = 'tw-bg-ink tw-text-white';
// On a dark surface the body/heading tints above are unreadable, so these
// are the counterparts. Same sizes, inverted tints.
// The inner-page hero title. Same scale as $pcH1 -- which matters: every
// inner hero used to cap at 2.25rem while section headings below it reached
// 3.25rem, so the <h1> was the SMALLEST heading on the page. Sizing it from
// the H1 scale puts it back above $pcH2Display (3.25rem) and $pcH2 (2.25rem).
$pcH1OnDark = str_replace('tw-text-ink', 'tw-text-white', $pcH1);
$pcH2OnDark = 'tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-white md:tw-text-4xl';
$pcBodyOnDark = 'tw-text-[1.0625rem] tw-leading-[1.7] tw-text-white/[0.72]';
$pcEyebrowOnDark = 'tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-powerlight';

/* ── Buttons ────────────────────────────────────────────────────────────
   One height and one radius across the site. tw-appearance-none +
   tw-border-0 shed the native <button> chrome, again because Preflight
   is off. */
$pcBtnBase =
  'tw-inline-flex tw-appearance-none tw-items-center tw-justify-center tw-gap-2 tw-rounded-full tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-no-underline tw-transition tw-duration-200 disabled:tw-cursor-not-allowed disabled:tw-opacity-60 motion-reduce:tw-transition-none';
// The lifted orange CTA -- the site's primary action.
$pcBtnPrimary =
  $pcBtnBase .
  ' tw-border-0 tw-bg-powerlight tw-text-white tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]';
// The same CTA, for use ON a dark surface. $pcBtnPrimary's big soft orange
// glow exists to lift the button off a white page; over ink it has nothing to
// separate from and instead blooms into a visible halo around the button --
// it reads as a smudge, not a shadow. This keeps the hover lift (the actual
// affordance) and drops the glow to a tight, dark-friendly shadow.
$pcBtnPrimaryOnDark = str_replace(
  ['tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)]', 'hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]'],
  ['tw-shadow-[0_6px_18px_rgba(0,0,0,0.35)]', 'hover:tw-shadow-[0_10px_24px_rgba(0,0,0,0.45)]'],
  $pcBtnPrimary
);
$pcBtnDark = $pcBtnBase . ' tw-border-0 tw-bg-ink tw-text-white hover:tw-bg-black';
// Compact variant for dense rows (chips, inline actions).
$pcBtnSm = str_replace('tw-px-6 tw-py-2.5', 'tw-px-4 tw-py-1.5', $pcBtnBase);
$pcBtnGhost =
  $pcBtnBase .
  ' tw-border tw-border-solid tw-border-black/15 tw-bg-transparent tw-text-ink hover:tw-border-black/30 hover:tw-bg-black/[0.03]';
// $pcBtnOutline is the brief's "outline" button and $pcBtnGhost is the same
// object -- aliased rather than duplicated so both names stay in sync and a
// grep for either finds every use.
$pcBtnOutline = $pcBtnGhost;
// The outline that has to sit on a dark section or a photo.
$pcBtnOutlineLight =
  $pcBtnBase .
  ' tw-border tw-border-solid tw-border-white/30 tw-bg-transparent tw-text-white hover:tw-border-white/60 hover:tw-bg-white/10';
// Text CTA: the lowest-emphasis action. Not a button -- no height, no
// padding box -- so it can sit inline at the end of a card without
// competing with the real CTA above it.
$pcBtnLink =
  'tw-group/link tw-inline-flex tw-items-center tw-gap-1.5 tw-text-[0.95rem] tw-font-semibold tw-text-power tw-no-underline tw-transition-colors tw-duration-200 hover:tw-text-powerdark motion-reduce:tw-transition-none';
// The chevron that goes inside a $pcBtnLink; nudges on hover of the link.
$pcBtnLinkIcon =
  'tw-h-4 tw-w-4 tw-shrink-0 tw-transition-transform tw-duration-200 group-hover/link:tw-translate-x-0.5 motion-reduce:tw-transition-none';

/* ── Forms ──────────────────────────────────────────────────────────────
   The canonical PowerCabs field recipe, from book-ride-online.php. The
   enhanced Ride Type / Date / Time controls that custom-select.js and
   custom-datetime.js build reproduce $pcInput verbatim in their own CLS
   strings, so an enhanced control sits flush with a plain one: 38px tall,
   6px radius, #dee2e6 border, and on focus a border-colour swap only --
   no ring, so nothing focuses heavier than anything else.
   Change any of these three and those two JS files must change with it. */
$pcInput =
  'tw-w-full tw-rounded-md tw-border tw-border-solid tw-border-[#dee2e6] tw-bg-white tw-px-3 tw-py-1.5 tw-text-base tw-leading-normal tw-text-ink placeholder:tw-text-ink/40 tw-outline-none tw-transition-colors tw-duration-200 focus:tw-border-powerlight';
$pcLabel = 'tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink';
$pcFormGrid = 'tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2';
// .alert-success / .alert-danger are a contract ajax-forms.js parses out of
// the response -- keep those bare classnames on any new form alert.
$pcAlertOk =
  'alert-success tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]';
$pcAlertErr =
  'alert-danger tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700';
