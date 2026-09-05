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

/* ── Section heading block ──────────────────────────────────────────────
   eyebrow -> heading -> lead. Used with tw-mb-10 on the wrapper. */
$pcEyebrow = 'tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power';
$pcH2 = 'tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl';
$pcLead = 'tw-mb-0 tw-text-lg tw-text-ink/60';
$pcSectionHead = 'tw-mb-10 tw-max-w-[720px]'; // add tw-mx-auto tw-text-center to centre it

/* ── Cards ──────────────────────────────────────────────────────────────
   tw-border-solid is required: Preflight is off, so a border-width utility
   alone renders nothing (see includes/tailwind.php). */
$pcCard =
  'tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-6 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]';
$pcCardHover =
  'tw-transition-shadow tw-duration-300 hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.10)] motion-reduce:tw-transition-none';
$pcCardGrid = 'tw-grid tw-gap-6'; // add tw-grid-cols-* per section

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
$pcBtnDark = $pcBtnBase . ' tw-border-0 tw-bg-ink tw-text-white hover:tw-bg-black';
// Compact variant for dense rows (chips, inline actions).
$pcBtnSm = str_replace('tw-px-6 tw-py-2.5', 'tw-px-4 tw-py-1.5', $pcBtnBase);
$pcBtnGhost =
  $pcBtnBase .
  ' tw-border tw-border-solid tw-border-black/15 tw-bg-transparent tw-text-ink hover:tw-border-black/30 hover:tw-bg-black/[0.03]';

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
