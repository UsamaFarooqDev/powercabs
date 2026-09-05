<?php
$pageTitle = 'Loyalty Program | PowerCabs';
$pageDescription =
  "PowerCabs's driver Loyalty Program -- earn points for completed trips and unlock Bronze, Silver and Gold rewards as you progress.";
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Drivers';
$heroTitleLight = 'Loyalty';
$heroTitleBold = 'Program.';
$heroDescription =
  'Rewarding your commitment and hard work -- PowerCabs rewards drivers for their dedication through a points-based loyalty program.';
$heroBgImage = 'https://images.pexels.com/photos/35119581/pexels-photo-35119581.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$howItWorks = [
  ['n' => 1, 'title' => 'Sign Up', 'icon' => 'person-plus'],
  ['n' => 2, 'title' => 'Complete Rides', 'icon' => 'car'],
  ['n' => 3, 'title' => 'Earn Points', 'icon' => 'star'],
  ['n' => 4, 'title' => 'Redeem Rewards', 'icon' => 'gift'],
];

$tiers = [
  [
    'name' => 'Bronze',
    'featured' => false,
    'color' => '#cd7f32',
    'items' => ['4 points per trip', '20 trips = 80 points', '10% priority', 'Pre-book advantages'],
  ],
  [
    'name' => 'Silver',
    'featured' => true,
    'color' => '#8a8f98',
    'items' => [
      '6 points per trip',
      '40 trips = 240 points',
      '9.5% priority',
      'Pre-book priority',
      'Customer support',
      '45% higher chance of priority trips',
    ],
  ],
  [
    'name' => 'Gold',
    'featured' => false,
    'color' => '#c99a2e',
    'items' => [
      '8 points per trip',
      '70 trips = 560 points',
      '9% priority',
      'High pre-book priority',
      'Priority support',
      'Social media recognition',
      'Higher-value trip opportunities',
    ],
  ],
];

$requirements = [
  ['n' => 1, 'title' => 'Enroll in the program', 'icon' => 'clipboard'],
  ['n' => 2, 'title' => 'Complete rides', 'icon' => 'car'],
  ['n' => 3, 'title' => 'Redeem incentives', 'icon' => 'gift'],
  ['n' => 4, 'title' => 'Maintain 80% ride acceptance rate', 'icon' => 'shield'],
];

/** Inline SVG icons for the timeline steps and tier medals -- kept in one
 * place since the same handful of icons are reused across both timelines. */
function pc_loyalty_icon(string $icon, string $cls = 'tw-h-6 tw-w-6'): void
{
  switch ($icon):
    case 'person-plus': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25v3m1.5-1.5h-3"/></svg>
    <?php break;
    case 'car': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
    <?php break;
    case 'star': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
    <?php break;
    case 'gift': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H4.5a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1014.625 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 109.375 7.5H12m0 0V21m-8.25-9.75h16.5a1.125 1.125 0 001.125-1.125v-2.25A1.125 1.125 0 0020.25 6.75H3.75A1.125 1.125 0 002.625 7.875v2.25A1.125 1.125 0 003.75 11.25z"/></svg>
    <?php break;
    case 'clipboard': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'award': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-6.75C9.004 14.25 8.5 14.754 8.5 15.375V18.75m8-13.5a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
    <?php break;
    case 'flag': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M3 2.25a.75.75 0 01.75.75v.54l1.838-.46a9.75 9.75 0 016.725.738l.108.054a8.25 8.25 0 005.58.652l3.109-.732a.75.75 0 01.917.81 47.784 47.784 0 00.005 10.337.75.75 0 01-.574.812l-3.114.733a9.75 9.75 0 01-6.594-.77l-.108-.054a8.25 8.25 0 00-5.69-.625l-2.202.55V21a.75.75 0 01-1.5 0V3A.75.75 0 013 2.25z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'bolt': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M14.615 1.595a.75.75 0 01.359.852L12.982 9.75h7.268a.75.75 0 01.548 1.262l-10.5 11.25a.75.75 0 01-1.272-.71l1.992-7.302H3.75a.75.75 0 01-.548-1.262l10.5-11.25a.75.75 0 01.913-.143z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'check': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 011.04-.207z" clip-rule="evenodd"/></svg>
    <?php break;
  endswitch;
}

/**
 * Splits a leading numeric/percentage token off a tier stat string for the
 * headline number (e.g. "4 points per trip" -> ["4", "points per trip"]) --
 * a display-layer split only; the underlying $tiers wording is untouched.
 */
function pc_loyalty_split_stat(string $item): array
{
  if (preg_match('/^([\d.]+%?)\s+(.*)$/', $item, $m)) {
    return [$m[1], $m[2]];
  }
  return [null, $item];
}

/**
 * Shared connected-timeline renderer -- used by both "How It Works" and
 * "Requirements" below (same markup/CSS, different icons/content) instead
 * of duplicating the layout per section.
 *
 * .pc-reveal / .is-visible are the shared scroll-reveal hook (see
 * assets/js/main.js) -- also used by the Power10 promo on ride.php, so the
 * classnames stay bare and its CSS (components.css) is untouched here.
 *
 * @param array<int,array{n:int,title:string,icon:string}> $items
 */
function pc_render_loyalty_timeline(array $items): void
{
  ?>
  <div class="tw-relative tw-flex tw-flex-col tw-gap-7 lg:tw-flex-row lg:tw-items-start lg:tw-gap-6">
    <span class="tw-absolute tw-left-7 tw-top-7 tw-bottom-7 tw-w-0.5 tw-bg-[linear-gradient(180deg,transparent_0%,#ff7a00_12%,#ff7a00_88%,transparent_100%)] tw-opacity-[0.55] lg:tw-left-[12.5%] lg:tw-right-[12.5%] lg:tw-top-7 lg:tw-bottom-auto lg:tw-h-0.5 lg:tw-w-auto lg:tw-bg-[linear-gradient(90deg,transparent_0%,#ff7a00_12%,#ff7a00_88%,transparent_100%)]" aria-hidden="true"></span>
    <?php foreach ($items as $i => $item): ?>
      <div class="pc-reveal tw-translate-y-6 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[600ms] tw-ease-[cubic-bezier(0.16,1,0.3,1)] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none tw-group tw-relative tw-z-[1] tw-flex tw-items-center tw-gap-5 lg:tw-flex-1 lg:tw-flex-col lg:tw-text-center
        <?= $i === 1 ? 'tw-delay-[80ms]' : ($i === 2 ? 'tw-delay-[160ms]' : ($i === 3 ? 'tw-delay-[240ms]' : '')) ?>">
        <span class="tw-relative tw-flex tw-h-14 tw-w-14 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[linear-gradient(135deg,#ff7a00_0%,#e8590c_100%)] tw-text-white tw-shadow-[0_10px_25px_rgba(28,20,16,0.12)] tw-transition-transform tw-duration-300 group-hover:tw-scale-110">
          <?php pc_loyalty_icon($item['icon']); ?>
          <span class="tw-absolute tw-right-[-0.3rem] tw-top-[-0.3rem] tw-flex tw-h-[1.4rem] tw-w-[1.4rem] tw-items-center tw-justify-center tw-rounded-full tw-border-2 tw-border-solid tw-border-[#fbe6d4] tw-bg-white tw-text-[0.68rem] tw-font-extrabold tw-text-power"><?= (int) $item['n'] ?></span>
        </span>
        <div class="tw-min-w-0 tw-flex-1 tw-rounded-lg tw-border tw-border-solid tw-border-black/[0.06] tw-bg-white tw-px-[1.4rem] tw-py-[1.1rem] tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-all tw-duration-300 group-hover:-tw-translate-y-1 group-hover:tw-border-power/25 group-hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.1)] lg:tw-mt-4 lg:tw-w-full">
          <h3 class="tw-mb-0 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <?php
}
?>

<div class="tw-bg-[linear-gradient(180deg,#ffffff_0%,#f9f4ed_55%,#f9f4ed_100%)]">
  <!-- ============ Introduction ============ -->
  <section class="tw-px-4 tw-pb-4 tw-pt-16 tw-text-center sm:tw-px-6 md:tw-pt-24 lg:tw-px-8">
    <div class="tw-mx-auto tw-max-w-[720px]">
      <p class="tw-mb-0 tw-text-[1.12rem] tw-leading-[1.75] tw-text-ink/60">
        PowerCabs rewards drivers for their dedication through a points-based loyalty program.
        Drivers earn points for completed trips and unlock better rewards as they progress.
      </p>
    </div>
  </section>

  <!-- ============ How It Works ============ -->
  <section class="tw-px-4 tw-pb-16 tw-pt-3 sm:tw-px-6 md:tw-pb-24 lg:tw-px-8">
    <div class="tw-mx-auto tw-max-w-[1040px]">
      <?php pc_render_loyalty_timeline($howItWorks); ?>
    </div>
  </section>
</div>

<!-- ============ Membership Levels ============ -->
<section class="tw-bg-paper tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Membership Levels</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Drive More, Earn More</h2>
    </div>
    <div class="tw-grid tw-grid-cols-1 tw-items-start tw-gap-8 md:tw-grid-cols-3 md:tw-gap-6">
      <?php foreach ($tiers as $tier):

        [$pointsValue, $pointsLabel] = pc_loyalty_split_stat($tier['items'][0] ?? '');
        $milestoneText = $tier['items'][1] ?? null;
        $priorityText = $tier['items'][2] ?? null;
        $remainingPerks = array_slice($tier['items'], 3);
        $tierColor = htmlspecialchars($tier['color']);
        ?>
        <div class="pc-reveal tw-translate-y-6 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[600ms] tw-ease-[cubic-bezier(0.16,1,0.3,1)] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none tw-group tw-relative tw-h-full tw-rounded-2xl tw-border tw-border-solid tw-bg-white tw-px-7 tw-py-8 tw-text-center tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-all tw-duration-300 hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.1)]
          <?= $tier['featured']
            ? 'tw-border-2 tw-border-power tw-shadow-[0_10px_25px_rgba(28,20,16,0.1)] -tw-translate-y-2.5 hover:-tw-translate-y-4 hover:tw-shadow-[0_20px_45px_rgba(28,20,16,0.14)]'
            : 'tw-border-black/[0.07] hover:-tw-translate-y-1' ?>">
          <?php if ($tier['featured']): ?>
            <span class="tw-absolute tw-left-1/2 tw-top-[-0.9rem] tw-inline-flex -tw-translate-x-1/2 tw-items-center tw-gap-1.5 tw-whitespace-nowrap tw-rounded-full tw-bg-[linear-gradient(90deg,#ff7a00_0%,#e8590c_100%)] tw-px-4 tw-py-1.5 tw-text-xs tw-font-extrabold tw-uppercase tw-tracking-[0.04em] tw-text-white tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]">
              <?php pc_loyalty_icon('star', 'tw-h-3 tw-w-3'); ?> Most Popular
            </span>
          <?php endif; ?>

          <span class="tw-mx-auto tw-mb-[1.1rem] tw-flex tw-h-16 tw-w-16 tw-items-center tw-justify-center tw-rounded-full tw-text-[1.75rem] tw-transition-transform tw-duration-300 group-hover:tw-rotate-[-4deg] group-hover:tw-scale-105 tw-bg-[color-mix(in_srgb,<?= $tierColor ?>_16%,white)] tw-text-[<?= $tierColor ?>] tw-shadow-[inset_0_0_0_2px_color-mix(in_srgb,<?= $tierColor ?>_35%,transparent)]">
            <?php pc_loyalty_icon('award', 'tw-h-7 tw-w-7'); ?>
          </span>
          <h3 class="tw-mb-[1.1rem] tw-text-2xl tw-font-extrabold tw-text-ink"><?= htmlspecialchars($tier['name']) ?></h3>

          <?php if ($pointsValue !== null): ?>
            <div class="tw-mb-3 tw-flex tw-items-baseline tw-justify-center tw-gap-1.5">
              <span class="tw-text-[2.4rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.02em] tw-text-[<?= $tierColor ?>]"><?= htmlspecialchars($pointsValue) ?></span>
              <span class="tw-text-sm tw-text-ink/55"><?= htmlspecialchars($pointsLabel) ?></span>
            </div>
          <?php endif; ?>

          <div class="tw-mb-5 tw-flex tw-flex-wrap tw-justify-center tw-gap-2">
            <?php if ($milestoneText): ?>
              <span class="tw-inline-flex tw-items-center tw-gap-1.5 tw-rounded-full tw-bg-paper-soft tw-px-3.5 tw-py-1.5 tw-text-xs tw-font-semibold tw-text-ink">
                <span class="tw-text-[<?= $tierColor ?>]"><?php pc_loyalty_icon('flag', 'tw-h-3.5 tw-w-3.5'); ?></span>
                <?= htmlspecialchars($milestoneText) ?>
              </span>
            <?php endif; ?>
            <?php if ($priorityText): ?>
              <span class="tw-inline-flex tw-items-center tw-gap-1.5 tw-rounded-full tw-bg-paper-soft tw-px-3.5 tw-py-1.5 tw-text-xs tw-font-semibold tw-text-ink">
                <span class="tw-text-[<?= $tierColor ?>]"><?php pc_loyalty_icon('bolt', 'tw-h-3.5 tw-w-3.5'); ?></span>
                <?= htmlspecialchars($priorityText) ?>
              </span>
            <?php endif; ?>
          </div>

          <hr class="tw-mb-5 tw-mt-0 tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.08]">

          <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0 tw-text-left">
            <?php foreach ($remainingPerks as $item): ?>
              <li class="tw-flex tw-gap-2 tw-text-sm">
                <span class="tw-mt-0.5 tw-text-[<?= $tierColor ?>]"><?php pc_loyalty_icon('check', 'tw-h-4 tw-w-4'); ?></span>
                <span class="tw-text-ink/60"><?= htmlspecialchars($item) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php
      endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Why It Works (bento) ============ -->
<section class="tw-bg-white tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Why It Works</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Loyalty That Actually Pays Off</h2>
    </div>

    <div class="tw-grid tw-grid-cols-2 tw-gap-5 [grid-auto-rows:minmax(150px,auto)] md:tw-grid-cols-4">
      <div class="pc-reveal tw-translate-y-6 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[600ms] tw-ease-[cubic-bezier(0.16,1,0.3,1)] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none tw-group tw-relative tw-col-span-2 tw-aspect-[16/10] tw-overflow-hidden tw-rounded-2xl md:tw-row-span-2 md:tw-aspect-auto">
        <img src="https://images.pexels.com/photos/31335088/pexels-photo-31335088.jpeg?auto=format&fit=crop&w=1200&q=60" alt="A happy PowerCabs driver at the wheel of her taxi at night" class="tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 group-hover:tw-scale-[1.03]" loading="lazy">
        <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-[linear-gradient(180deg,rgba(10,7,5,0.05)_0%,rgba(10,7,5,0.7)_100%)]" aria-hidden="true"></span>
        <span class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-4 md:tw-p-6">
          <span class="tw-block tw-text-lg tw-font-bold tw-text-white">Every completed ride moves you closer to your next reward.</span>
        </span>
      </div>

      <div class="pc-reveal tw-translate-y-6 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[600ms] tw-ease-[cubic-bezier(0.16,1,0.3,1)] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none tw-flex tw-flex-col tw-items-center tw-justify-center tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-5 tw-text-center tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-shadow tw-duration-300 hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.1)]">
        <span class="tw-mb-1.5 tw-text-[2.1rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.02em] tw-text-power">3</span>
        <span class="tw-text-sm tw-leading-[1.4] tw-text-ink/55">Membership tiers to climb</span>
      </div>

      <div class="pc-reveal tw-translate-y-6 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[600ms] tw-ease-[cubic-bezier(0.16,1,0.3,1)] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none tw-flex tw-flex-col tw-items-center tw-justify-center tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-5 tw-text-center tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-shadow tw-duration-300 hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.1)]">
        <span class="tw-mb-1.5 tw-text-[2.1rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.02em] tw-text-power">45%</span>
        <span class="tw-text-sm tw-leading-[1.4] tw-text-ink/55">Higher chance of priority trips at Silver+</span>
      </div>

      <div class="pc-reveal tw-translate-y-6 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[600ms] tw-ease-[cubic-bezier(0.16,1,0.3,1)] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none tw-group tw-relative tw-col-span-2 tw-aspect-[21/9] tw-overflow-hidden tw-rounded-2xl md:tw-aspect-auto">
        <img src="https://images.pexels.com/photos/36712857/pexels-photo-36712857.jpeg?auto=format&fit=crop&w=1200&q=60" alt="Two people shaking hands" class="tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 group-hover:tw-scale-[1.03]" loading="lazy">
        <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-bg-[linear-gradient(180deg,rgba(10,7,5,0.05)_0%,rgba(10,7,5,0.7)_100%)]" aria-hidden="true"></span>
        <span class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-3">
          <span class="tw-block tw-text-base tw-font-bold tw-text-white">Priority support, every step of the way.</span>
        </span>
      </div>
    </div>
  </div>
</section>

<!-- ============ Requirements ============ -->
<section class="tw-relative tw-overflow-hidden tw-bg-white tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <span class="tw-pointer-events-none tw-absolute tw-right-[-8%] tw-top-[-10%] tw-z-0 tw-h-[26rem] tw-w-[26rem] tw-rounded-full tw-bg-[radial-gradient(circle,#fbe6d4_0%,transparent_70%)] tw-opacity-60" aria-hidden="true"></span>
  <div class="tw-relative tw-z-[1] tw-mx-auto tw-w-full tw-max-w-[1040px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Requirements</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Stay Eligible, Keep Earning</h2>
    </div>
    <?php pc_render_loyalty_timeline($requirements); ?>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
