<?php
function pc_mb(string $recipe, string $margin): string
{
  return preg_replace('/\btw-mb-[\d.]+\b/', $margin, $recipe, 1);
}

$pcContainer = 'tw-mx-auto tw-w-full tw-max-w-content tw-px-5 sm:tw-px-8 lg:tw-px-12 xl:tw-px-16';
$pcContainerNarrow = 'tw-mx-auto tw-w-full tw-max-w-[880px] tw-px-5 sm:tw-px-8 lg:tw-px-12 xl:tw-px-16';

$pcContainerProse = 'tw-mx-auto tw-w-full tw-max-w-reading tw-px-5 sm:tw-px-8 lg:tw-px-12 xl:tw-px-16';

$pcSection = 'tw-py-16 md:tw-py-24';
$pcSectionTight = 'tw-py-12 md:tw-py-16';
$pcSectionLoose = 'tw-py-20 md:tw-py-28';

$pcEyebrow = 'tw-mb-3 tw-text-[0.8125rem] tw-font-bold tw-uppercase tw-tracking-[0.08em] tw-text-power';

$pcH1 =
  'tw-mb-5 tw-text-[clamp(2.5rem,4.5vw,4.75rem)] tw-font-bold tw-leading-[1.05] tw-tracking-[-0.035em] tw-text-ink';
$pcH1Utility =
  'tw-mb-4 tw-text-[clamp(2.25rem,4vw,4rem)] tw-font-bold tw-leading-[1.08] tw-tracking-[-0.03em] tw-text-ink';

$pcH1Legal =
  'tw-mb-4 tw-text-[clamp(2rem,3.2vw,3rem)] tw-font-bold tw-leading-[1.1] tw-tracking-[-0.025em] tw-text-ink';

$pcDisplay =
  'tw-mb-5 tw-text-[clamp(3rem,6.4vw,5.5rem)] tw-font-bold tw-leading-[1.02] tw-tracking-[-0.045em] tw-text-ink';
$pcH2 =
  'tw-mb-4 tw-text-[clamp(1.875rem,3.4vw,2.75rem)] tw-font-bold tw-leading-[1.1] tw-tracking-[-0.03em] tw-text-ink';

$pcH2Display =
  'tw-mb-4 tw-text-[clamp(2.125rem,3.6vw,3rem)] tw-font-bold tw-leading-[1.08] tw-tracking-[-0.035em] tw-text-ink';
$pcH2Small = 'tw-mb-3 tw-text-[clamp(1.5rem,2.5vw,2rem)] tw-font-bold tw-leading-snug tw-tracking-tight tw-text-ink';
$pcH3 =
  'tw-mb-2.5 tw-text-[clamp(1.25rem,1.8vw,1.5rem)] tw-font-bold tw-leading-snug tw-tracking-[-0.02em] tw-text-ink';
$pcH4 = 'tw-mb-1.5 tw-text-base tw-font-semibold tw-leading-snug tw-text-ink';

$pcBody = 'tw-text-[1.0625rem] tw-leading-[1.6] tw-text-muted';
$pcLead = 'tw-mb-0 tw-text-[clamp(1.125rem,1.5vw,1.375rem)] tw-leading-[1.55] tw-text-muted';
$pcBodySm = 'tw-text-[0.9375rem] tw-leading-[1.6] tw-text-muted';

$pcMeasure = 'tw-max-w-[65ch]';
$pcMeasureTight = 'tw-max-w-[46ch]';

$pcSectionHead = 'tw-mb-10 tw-max-w-[720px]';
$pcSectionHeadCenter = 'tw-mx-auto tw-mb-12 tw-max-w-[720px] tw-text-center';

// Preflight is off: a border width utility does nothing without tw-border-solid beside it.
$pcCard =
  'tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-6 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]';

$pcCardHover =
  'tw-transition tw-duration-300 hover:tw-border-hairline hover:tw-shadow-[0_18px_40px_-12px_rgba(17,17,17,0.18)]' .
  ' motion-safe:hover:-tw-translate-y-1 motion-reduce:tw-transition-none';
$pcCardGrid = 'tw-grid tw-gap-6';

$pcCardService =
  'tw-group tw-relative tw-flex tw-h-full tw-flex-col tw-overflow-hidden tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-7 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-[transform,box-shadow] tw-duration-300 tw-ease-out hover:-tw-translate-y-1 hover:tw-shadow-[0_18px_40px_-12px_rgba(28,20,16,0.18)] motion-reduce:tw-transition-none motion-reduce:hover:tw-translate-y-0';

$pcCardStat =
  'tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-6';
$pcStatValue = 'tw-block tw-text-[clamp(1.75rem,3vw,2.5rem)] tw-font-bold tw-leading-none tw-tracking-[-0.02em] tw-text-ink';
$pcStatLabel = 'tw-mt-2 tw-block tw-text-[0.9rem] tw-leading-snug tw-text-ink/[0.55]';

$pcCardEditorial =
  'tw-group tw-relative tw-flex tw-h-full tw-flex-col tw-overflow-hidden tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-[transform,box-shadow] tw-duration-300 tw-ease-out hover:-tw-translate-y-1 hover:tw-shadow-[0_18px_40px_-12px_rgba(28,20,16,0.18)] motion-reduce:tw-transition-none motion-reduce:hover:tw-translate-y-0';
$pcCardEditorialBody = 'tw-flex tw-flex-1 tw-flex-col tw-p-6';

$pcCardPricing =
  'tw-relative tw-flex tw-h-full tw-flex-col tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-7 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]';
$pcCardPricingFeatured =
  'tw-relative tw-flex tw-h-full tw-flex-col tw-rounded-3xl tw-border tw-border-solid tw-border-transparent tw-bg-white tw-p-7 tw-ring-2 tw-ring-power/[0.35] tw-shadow-[0_18px_45px_-12px_rgba(232,89,12,0.3)]';

$pcCardPanel =
  'tw-rounded-3xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-p-[clamp(1.5rem,3vw,2.5rem)] tw-shadow-[0_24px_60px_-20px_rgba(28,20,16,0.22)]';

$pcIconChip =
  'tw-inline-flex tw-h-12 tw-w-12 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-peach tw-text-power';
$pcIconChipDark =
  'tw-inline-flex tw-h-12 tw-w-12 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-white/10 tw-text-powerlight';

$pcFeature = 'tw-flex tw-flex-col tw-gap-3';
$pcFeatureIcon = 'tw-inline-flex tw-h-10 tw-w-10 tw-items-center tw-justify-center tw-rounded-xl tw-bg-peach tw-text-power';

$pcFeatureRow = 'tw-flex tw-items-start tw-gap-4';

$pcStepGrid = 'tw-grid tw-gap-x-10 tw-gap-y-10 sm:tw-grid-cols-2 lg:tw-grid-cols-4';
$pcStepItem = 'tw-border-0 tw-border-t-2 tw-border-solid tw-border-hairline tw-pt-5';
$pcStepNum =
  'tw-mb-3 tw-block tw-text-[0.8125rem] tw-font-bold tw-tabular-nums tw-tracking-[0.12em] tw-text-power';

$pcStatRow =
  'tw-grid tw-grid-cols-2 tw-gap-x-8 tw-gap-y-10 lg:tw-grid-cols-4 lg:tw-divide-x lg:tw-divide-solid lg:tw-divide-y-0 lg:tw-divide-hairline';
$pcStatPlain = 'lg:tw-px-8 lg:first:tw-pl-0 lg:last:tw-pr-0';

$pcDivider = 'tw-border-0 tw-border-t tw-border-solid tw-border-hairline';
$pcDivideList = 'tw-divide-y tw-divide-solid tw-divide-hairline';

$pcImgWide = 'tw-relative tw-aspect-[16/9] tw-overflow-hidden tw-bg-paper';
$pcImgLandscape = 'tw-relative tw-aspect-[4/3] tw-overflow-hidden tw-bg-paper';
$pcImgSquare = 'tw-relative tw-aspect-square tw-overflow-hidden tw-bg-paper';
$pcImgPortrait = 'tw-relative tw-aspect-[3/4] tw-overflow-hidden tw-bg-paper';
$pcImgCover = 'tw-h-full tw-w-full tw-object-cover';

$pcImgZoom =
  'tw-transition-transform tw-duration-[600ms] tw-ease-out group-hover:tw-scale-[1.04] motion-reduce:tw-transition-none motion-reduce:group-hover:tw-scale-100';

$pcSurfaceWhite = 'tw-bg-white';
$pcSurfaceSoft = 'tw-bg-paper-soft';
$pcSurfacePaper = 'tw-bg-paper';
$pcSurfaceDark = 'tw-bg-ink tw-text-white';

$pcH1OnDark = str_replace('tw-text-ink', 'tw-text-white', $pcH1);
$pcH2OnDark = str_replace('tw-text-ink', 'tw-text-white', $pcH2);
$pcBodyOnDark = 'tw-text-[1.0625rem] tw-leading-[1.7] tw-text-white/[0.72]';
$pcEyebrowOnDark = str_replace('tw-text-power', 'tw-text-powerlight', $pcEyebrow);

$pcBtnBase =
  'tw-inline-flex tw-appearance-none tw-items-center tw-justify-center tw-gap-2 tw-rounded-full tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-no-underline tw-transition tw-duration-200 disabled:tw-cursor-not-allowed disabled:tw-opacity-60 motion-reduce:tw-transition-none';

$pcBtnPrimary =
  str_replace('tw-duration-200', 'tw-duration-300', $pcBtnBase) .
  ' tw-border-0 tw-bg-power tw-text-white tw-shadow-none' .
  ' hover:tw-shadow-[0_10px_24px_-6px_rgba(249,115,22,0.45)]' .
  ' motion-safe:hover:-tw-translate-y-0.5 motion-safe:active:tw-translate-y-0';

$pcBtnPrimaryOnDark = str_replace(
  'hover:tw-shadow-[0_10px_24px_-6px_rgba(249,115,22,0.45)]',
  'hover:tw-shadow-[0_10px_24px_-6px_rgba(0,0,0,0.55)]',
  $pcBtnPrimary
);
$pcBtnDark = $pcBtnBase . ' tw-border-0 tw-bg-ink tw-text-white hover:tw-bg-black';

$pcBtnSm = str_replace('tw-px-6 tw-py-2.5', 'tw-px-4 tw-py-1.5', $pcBtnBase);
$pcBtnGhost =
  $pcBtnBase .
  ' tw-border tw-border-solid tw-border-black/15 tw-bg-transparent tw-text-ink hover:tw-border-black/30 hover:tw-bg-black/[0.03]';

$pcBtnGhostOnDark =
  $pcBtnBase .
  ' tw-border tw-border-solid tw-border-white/30 tw-bg-white/[0.06] tw-text-white' .
  ' hover:tw-border-white/60 hover:tw-bg-white/[0.14]';

$pcBtnOutline = $pcBtnGhost;

$pcBtnOutlineLight =
  $pcBtnBase .
  ' tw-border tw-border-solid tw-border-white/30 tw-bg-transparent tw-text-white hover:tw-border-white/60 hover:tw-bg-white/10';

$pcBtnLink =
  'tw-group/link tw-inline-flex tw-items-center tw-gap-1.5 tw-py-2 tw-text-[0.95rem] tw-font-semibold tw-text-power tw-no-underline tw-transition-colors tw-duration-200 hover:tw-text-powerdark motion-reduce:tw-transition-none';

$pcBtnLinkIcon =
  'tw-h-4 tw-w-4 tw-shrink-0 tw-transition-transform tw-duration-200 group-hover/link:tw-translate-x-0.5 motion-reduce:tw-transition-none';

$pcInput =
  'tw-w-full tw-rounded-md tw-border tw-border-solid tw-border-[#dee2e6] tw-bg-white tw-px-3 tw-py-1.5 tw-text-base tw-leading-normal tw-text-ink placeholder:tw-text-ink/40 tw-outline-none tw-transition-colors tw-duration-200 focus:tw-border-powerlight';
$pcLabel = 'tw-mb-1.5 tw-block tw-text-sm tw-font-medium tw-text-ink';
$pcFormGrid = 'tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2';

$pcAlertOk =
  'alert-success tw-rounded-xl tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]';
$pcAlertErr =
  'alert-danger tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700';
