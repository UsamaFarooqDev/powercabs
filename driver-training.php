<?php
declare(strict_types=1);

require __DIR__ . '/includes/driver-session.php';

$pcDriver = pc_driver_current();

$pageTitle = 'PowerCabs Driver Training | Become PowerCabs Ready';
$pageDescription = 'Training and app walkthrough for PowerCabs drivers. Sign in with your driver account to start your mission.';
$pageNoIndex = true; 
$assetPath = '';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/components/driver-training/icons.php';

if (!$pcDriver):
  
  ?>
  <section class="tw-flex tw-min-h-[calc(100vh-var(--pc-navbar-h,72px))] tw-items-center tw-bg-paper-soft tw-px-4 tw-pb-12 tw-pt-[calc(var(--pc-navbar-h,72px)+2rem)] sm:tw-pb-16">
    <div class="tw-mx-auto tw-w-full tw-max-w-[440px]">
      <div class="tw-rounded-3xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-7 tw-shadow-[0_24px_60px_-20px_rgba(28,20,16,0.22)] sm:tw-p-9">
        <span class="<?= $pcIconChip ?> tw-mb-5" aria-hidden="true"><?php pc_dt_icon('lock', 'tw-h-[1.35rem] tw-w-[1.35rem]'); ?></span>
        <h1 class="tw-mb-2 tw-text-[1.75rem] tw-font-bold tw-leading-tight tw-tracking-[-0.02em] tw-text-ink">Driver sign in</h1>
        <p class="<?= $pcBodySm ?> tw-mb-7">
          Training is for PowerCabs drivers. Sign in with the same email and password you use in the driver app.
        </p>

        <?php  ?>
        <form data-pc-driver-login-form data-no-ajax method="post" action="<?= $assetPath ?>/driver-auth" novalidate class="tw-m-0">
          <input type="hidden" name="action" value="login">
          <div data-pc-login-error hidden role="alert" class="tw-mb-4 tw-rounded-xl tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700"></div>

          <div class="tw-mb-4">
            <label class="<?= $pcLabel ?>" for="dtEmail">Email</label>
            <input class="<?= $pcInput ?>" type="email" id="dtEmail" name="email" autocomplete="username" inputmode="email" required placeholder="you@example.com">
          </div>

          <div class="tw-mb-6">
            <label class="<?= $pcLabel ?>" for="dtPassword">Password</label>
            <div class="tw-relative">
              <input class="<?= $pcInput ?> tw-pr-11" type="password" id="dtPassword" name="password" autocomplete="current-password" required>
              <button type="button" data-pc-password-toggle data-target="dtPassword"
                class="tw-absolute tw-right-1 tw-top-1/2 tw--translate-y-1/2 tw-inline-flex tw-h-8 tw-w-9 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-md tw-border-0 tw-bg-transparent tw-text-ink/45 tw-transition-colors hover:tw-text-ink"
                aria-label="Show password" aria-pressed="false">
                <svg data-eye-on class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.5 12S6 5.5 12 5.5 21.5 12 21.5 12 18 18.5 12 18.5 2.5 12 2.5 12z"/><circle cx="12" cy="12" r="3"/></svg>
                <svg data-eye-off hidden class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 3l18 18M10.6 10.7a2 2 0 002.8 2.8"/><path d="M6.9 6.9C4.2 8.6 2.5 12 2.5 12S6 18.5 12 18.5c1.6 0 3-.4 4.2-1M17.8 16A12.5 12.5 0 0021.5 12S18 5.5 12 5.5c-.6 0-1.2.1-1.7.2"/></svg>
              </button>
            </div>
          </div>

          <button type="submit" class="<?= $pcBtnPrimary ?> tw-w-full tw-cursor-pointer" data-pc-login-submit>
            <span data-label>Sign in</span>
          </button>
        </form>

        <p class="tw-mb-0 tw-mt-6 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-pt-5 tw-text-[0.85rem] tw-leading-relaxed tw-text-muted">
          Not driving with us yet? <a class="tw-font-semibold tw-text-power tw-no-underline hover:tw-underline" href="<?= $assetPath ?>/drive">Apply to drive</a>.
          Trouble signing in? <a class="tw-font-semibold tw-text-power tw-no-underline hover:tw-underline" href="<?= $assetPath ?>/contact-us">Contact the office</a>.
        </p>
      </div>
    </div>
  </section>
  <?php
  require __DIR__ . '/includes/footer.php';
  return;
endif;

require __DIR__ . '/includes/supabase.php';
require __DIR__ . '/includes/driver-progress.php';
require __DIR__ . '/includes/driver-insights.php';
require __DIR__ . '/components/driver-training/missions.php';

[$dtRow, $dtProgress] = pc_training_load((string) $pcDriver['id']);

$dtCtx = pc_driver_insights((string) $pcDriver['id'], is_array($dtRow) ? $dtRow : []);
$dtFacts = $dtCtx['facts'] ?? [];

$dtName = trim((string) ($dtRow['full_name'] ?? $pcDriver['name'])) ?: 'Driver';
$dtFirst = explode(' ', $dtName)[0];
$dtDoneCount = 0;
foreach ($pcMissions as $m) {
  if (pc_training_mission_done($dtProgress, $m['id'])) {
    $dtDoneCount++;
  }
}
$dtPct = $pcMissionCount ? (int) round(($dtDoneCount / $pcMissionCount) * 100) : 0;
$dtCurrentIdx = pc_training_current_index($dtProgress, $pcMissions);
$dtAllDone = pc_training_all_missions_done($dtProgress, $pcMissions);
$dtCertified = pc_training_can_certify($dtProgress, $pcMissions);
$dtXp = (int) $dtProgress['xp'];
?>

<?php  ?>
<?php  ?>
<style>
  @media (max-width: 1023.98px) {
/* The attribute is "driver-training", with no .php extension. */
    body[data-page="driver-training"] > header,
    body[data-page="driver-training"] > footer,
    body[data-page="driver-training.php"] > header,
    body[data-page="driver-training.php"] > footer {
      display: none !important;
    }
    body[data-page="driver-training"],
    body[data-page="driver-training.php"] {
      --pc-navbar-h: 0px;
    }
  }
</style>

<?php  ?>
<div class="tw-relative tw-overflow-hidden tw-bg-paper-soft tw-pb-32 lg:tw-pb-0" id="pcTrainingTop"
  data-pc-mission-root
  data-pc-current="<?= htmlspecialchars($dtCurrentIdx < $pcMissionCount ? $pcMissions[$dtCurrentIdx]['id'] : 'final') ?>">

  <div class="tw-pointer-events-none tw-absolute tw-inset-0 tw-overflow-hidden" aria-hidden="true">
    <span class="tw-absolute tw--left-24 tw--top-24 tw-h-72 tw-w-72 tw-rounded-full tw-bg-power/[0.07] tw-blur-3xl"></span>
    <span class="tw-absolute tw-right-[-6rem] tw-top-[22rem] tw-h-80 tw-w-80 tw-rounded-full tw-bg-success/[0.06] tw-blur-3xl"></span>
    <span class="tw-absolute tw-bottom-[-8rem] tw-left-1/3 tw-h-72 tw-w-72 tw-rounded-full tw-bg-power/[0.05] tw-blur-3xl"></span>

    <?php  ?>
    <span class="tw-absolute tw-left-[6%] tw-top-[14%] tw-rotate-[-12deg] tw-text-ink/[0.04]"><?php pc_dt_icon('car', 'tw-h-24 tw-w-24'); ?></span>
    <span class="tw-absolute tw-right-[8%] tw-top-[42%] tw-rotate-[14deg] tw-text-ink/[0.04]"><?php pc_dt_icon('route', 'tw-h-28 tw-w-28'); ?></span>
    <span class="tw-absolute tw-left-[12%] tw-top-[68%] tw-rotate-[8deg] tw-text-ink/[0.035]"><?php pc_dt_icon('shield', 'tw-h-32 tw-w-32'); ?></span>
    <span class="tw-absolute tw-right-[18%] tw-top-[86%] tw-rotate-[-10deg] tw-text-ink/[0.04]"><?php pc_dt_icon('award', 'tw-h-24 tw-w-24'); ?></span>
  </div>

  <div class="tw-relative">
  <div class="<?= $pcContainer ?> tw-pb-6 tw-pt-[calc(var(--pc-navbar-h,72px)+1.25rem)] lg:tw-pb-12 lg:tw-pt-[calc(var(--pc-navbar-h,72px)+2rem)]">

    <header class="tw-mb-6" id="pcTrainingProgress">
      <div class="tw-mb-4 tw-flex tw-flex-wrap tw-items-start tw-justify-between tw-gap-3">
        <div class="tw-min-w-0">
          <p class="<?= pc_mb($pcEyebrow, 'tw-mb-1.5') ?>">PowerCabs Driver Academy</p>
          <h1 class="tw-mb-1.5 tw-text-[clamp(1.6rem,4vw,2.35rem)] tw-font-bold tw-leading-[1.1] tw-tracking-[-0.03em] tw-text-ink">
            <?= $dtCertified ? 'You are PowerCabs Ready.' : 'Welcome, ' . htmlspecialchars($dtFirst) . '.' ?>
          </h1>
          <p class="<?= $pcBodySm ?> tw-mb-0 tw-max-w-[48ch]">
            Complete your training journey and become PowerCabs Ready.
          </p>
          <?php  ?>
          <?php if (!empty($dtCtx['focus'])): ?>
            <?php
            $dtFocusTitle = '';
            foreach ($pcMissions as $fm) {
              if ($fm['id'] === $dtCtx['focus']) {
                $dtFocusTitle = $fm['nav'];
                break;
              }
            }
            ?>
            <?php if ($dtFocusTitle !== ''): ?>
              <p class="tw-mb-0 tw-mt-2 tw-inline-flex tw-items-center tw-gap-1.5 tw-rounded-full tw-bg-peach tw-px-3 tw-py-1 tw-text-[0.78rem] tw-font-semibold tw-text-power">
                <?php pc_dt_icon('star', 'tw-h-3.5 tw-w-3.5'); ?>
                Worth your attention: <?= htmlspecialchars($dtFocusTitle) ?>
              </p>
            <?php endif; ?>
          <?php endif; ?>
        </div>
        <button type="button" data-pc-driver-logout
          class="tw-inline-flex tw-shrink-0 tw-cursor-pointer tw-appearance-none tw-items-center tw-gap-1.5 tw-rounded-full tw-border tw-border-solid tw-border-black/15 tw-bg-transparent tw-px-3.5 tw-py-1.5 tw-text-[0.78rem] tw-font-semibold tw-text-ink tw-transition-colors hover:tw-border-black/30 hover:tw-bg-black/[0.03]">
          <?php pc_dt_icon('signout', 'tw-h-3.5 tw-w-3.5'); ?> Sign out
        </button>
      </div>

      <?php  ?>
      <div class="tw-relative tw-overflow-hidden tw-rounded-3xl tw-bg-ink tw-p-5 tw-text-white tw-shadow-[0_18px_44px_-18px_rgba(28,20,16,0.5)] sm:tw-p-6">
        <span class="tw-pointer-events-none tw-absolute tw--right-10 tw--top-10 tw-h-44 tw-w-44 tw-rounded-full tw-bg-power/25 tw-blur-3xl" aria-hidden="true"></span>
        <span class="tw-pointer-events-none tw-absolute tw-right-4 tw-top-3 tw-text-white/[0.06]" aria-hidden="true"><?php pc_dt_icon('award', 'tw-h-28 tw-w-28'); ?></span>

        <div class="tw-relative tw-mb-4 tw-flex tw-flex-wrap tw-items-end tw-justify-between tw-gap-3">
          <div>
            <p class="tw-mb-1 tw-text-[0.68rem] tw-font-bold tw-uppercase tw-tracking-[0.16em] tw-text-white/45">Your driver journey</p>
            <p class="tw-mb-0 tw-flex tw-items-baseline tw-gap-1.5">
              <span data-pc-pct class="tw-text-[2.25rem] tw-font-extrabold tw-leading-none tw-tracking-[-0.03em] tw-text-white"><?= $dtPct ?></span>
              <span class="tw-text-[1.1rem] tw-font-bold tw-leading-none tw-text-white/50">%</span>
              <span class="tw-ml-1 tw-text-[0.8rem] tw-text-white/45">complete</span>
            </p>
          </div>

          <?php  ?>
          <span class="tw-inline-flex tw-items-center tw-gap-1.5 tw-rounded-full tw-bg-power tw-px-3 tw-py-1.5 tw-text-[0.8rem] tw-font-bold tw-text-white tw-shadow-[0_6px_18px_-6px_rgba(249,115,22,0.8)]">
            <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13 2L4.5 13.5H11l-1 8.5 8.5-11.5H12l1-8.5z"/></svg>
            <span data-pc-xp><?= $dtXp ?></span> XP
          </span>
        </div>

        <?php  ?>
        <div class="tw-relative tw-mb-2.5 tw-h-3 tw-w-full tw-overflow-hidden tw-rounded-full tw-bg-white/10"
          role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="<?= $dtPct ?>"
          aria-label="Training progress">
          <div data-pc-progress-bar
            class="tw-relative tw-h-full tw-rounded-full tw-bg-gradient-to-r tw-from-power tw-via-[#fb923c] tw-to-success tw-shadow-[0_0_14px_rgba(249,115,22,0.55)] tw-transition-[width] tw-duration-700 tw-ease-out after:tw-absolute after:tw-inset-0 after:tw-rounded-full after:tw-bg-gradient-to-b after:tw-from-white/35 after:tw-to-transparent after:tw-content-[''] motion-reduce:tw-transition-none"
            style="width: <?= $dtPct ?>%"></div>
        </div>

        <p class="tw-relative tw-mb-0 tw-text-[0.85rem] tw-text-white/55">
          <strong class="tw-font-bold tw-text-white" data-pc-done-count><?= $dtDoneCount ?></strong> of
          <strong class="tw-font-bold tw-text-white"><?= $pcMissionCount ?></strong> levels completed
        </p>

        <?php  ?>
        <?php if (!empty($dtCtx['ok']) && (int) $dtCtx['total'] > 0): ?>
          <dl class="tw-relative tw-m-0 tw-mt-4 tw-grid tw-grid-cols-3 tw-gap-2 tw-border-0 tw-border-t tw-border-solid tw-border-white/10 tw-pt-4 sm:tw-grid-cols-4">
            <?php
            $dtStats = [
              ['Jobs done', (string) $dtCtx['completed']],
              ['Prebooked', (string) $dtCtx['scheduled']],
              ['Pet jobs', (string) (int) ($dtCtx['types']['Pets Taxi'] ?? 0)],
            ];
            if ($dtCtx['avgRating'] !== null) {
              $dtStats[] = ['Your rating', number_format((float) $dtCtx['avgRating'], 1)];
            } elseif ($dtCtx['vehicle'] !== '') {
              $dtStats[] = ['Your vehicle', $dtCtx['vehicle']];
            }
            ?>
            <?php foreach ($dtStats as [$dtLabel, $dtValue]): ?>
              <div class="<?= count($dtStats) === 3 ? '' : 'last:tw-col-span-3 sm:last:tw-col-span-1' ?>">
                <dt class="tw-mb-0.5 tw-text-[0.6rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-white/40"><?= htmlspecialchars($dtLabel) ?></dt>
                <dd class="tw-m-0 tw-truncate tw-text-[1.05rem] tw-font-bold tw-leading-none tw-text-white"><?= htmlspecialchars($dtValue) ?></dd>
              </div>
            <?php endforeach; ?>
          </dl>
        <?php endif; ?>

        <?php  ?>
        <ul class="tw-relative tw-m-0 tw-mt-4 tw-flex tw-list-none tw-gap-2 tw-overflow-x-auto tw-border-0 tw-border-t tw-border-solid tw-border-white/10 tw-p-0 tw-pt-4 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:tw-hidden sm:tw-flex-wrap sm:tw-overflow-visible">
          <?php foreach ($pcBadges as $bid => $b): ?>
            <?php $earned = in_array($bid, $dtProgress['badges'], true); ?>
            <li data-pc-badge="<?= htmlspecialchars($bid) ?>"
              class="tw-inline-flex tw-shrink-0 tw-items-center tw-gap-1.5 tw-whitespace-nowrap tw-rounded-full tw-border tw-border-solid tw-px-2.5 tw-py-1 tw-text-[0.72rem] tw-font-semibold tw-transition-all tw-duration-300 <?= $earned
                ? 'tw-border-power tw-bg-power tw-text-white tw-shadow-[0_4px_14px_-4px_rgba(249,115,22,0.8)]'
                : 'tw-border-white/15 tw-bg-white/[0.04] tw-text-white/35' ?>"
              title="<?= htmlspecialchars($b['desc']) ?>">
              <?php pc_dt_icon($b['icon'], 'tw-h-3.5 tw-w-3.5'); ?>
              <?= htmlspecialchars($b['label']) ?>
              <?php  ?>
              <?php if (!$earned): ?>
                <span class="tw-sr-only">(locked)</span>
                <?php pc_dt_icon('lock', 'tw-h-3 tw-w-3 tw-opacity-60'); ?>
              <?php else: ?>
                <span class="tw-sr-only">(earned)</span>
              <?php endif; ?>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </header>

    <div class="lg:tw-grid lg:tw-grid-cols-[270px_minmax(0,1fr)] lg:tw-items-start lg:tw-gap-8">

      <?php  ?>
      <?php  ?>
      <nav class="tw-sticky tw-z-30 tw--mx-4 tw-mb-5 tw-overflow-hidden tw-bg-paper-soft tw-px-4 tw-py-2 tw-top-[var(--pc-navbar-h,72px)] lg:tw-mx-0 lg:tw-mb-0 lg:tw-overflow-visible lg:tw-rounded-2xl lg:tw-border lg:tw-border-solid lg:tw-border-hairline lg:tw-bg-white lg:tw-p-3 lg:tw-top-[calc(var(--pc-navbar-h,72px)+1.5rem)]"
        aria-label="Training path">
        <p class="tw-mb-2 tw-hidden tw-px-2 tw-text-[0.68rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] tw-text-muted lg:tw-block">Your 12 levels</p>
        <ol class="tw-m-0 tw-flex tw-list-none tw-gap-2 tw-overflow-x-auto tw-p-0 [-ms-overflow-style:none] [scrollbar-width:none] [&::-webkit-scrollbar]:tw-hidden lg:tw-max-h-[52vh] lg:tw-flex-col lg:tw-gap-0.5 lg:tw-overflow-y-auto lg:tw-overflow-x-visible">
          <?php foreach ($pcMissions as $i => $m): ?>
            <?php
            $done = pc_training_mission_done($dtProgress, $m['id']);
            $unlocked = pc_training_is_unlocked($dtProgress, $pcMissions, $m['id']);
            $state = $done ? 'done' : ($unlocked ? 'current' : 'locked');
            ?>
            <?php  ?>
            <li class="tw-shrink-0 lg:tw-shrink">
              <button type="button" data-pc-mission-link="<?= htmlspecialchars($m['id']) ?>"
                data-pc-state="<?= $state ?>" <?= $unlocked ? '' : 'disabled' ?>
                class="tw-group tw-flex tw-w-full tw-cursor-pointer tw-appearance-none tw-items-center tw-gap-2 tw-whitespace-nowrap tw-rounded-full tw-border tw-border-solid tw-bg-white tw-px-3 tw-py-2 tw-text-left tw-text-[0.8rem] tw-font-semibold tw-transition-all tw-duration-300 disabled:tw-cursor-not-allowed lg:tw-rounded-xl lg:tw-border-0 lg:tw-px-2.5 lg:tw-py-2
                  data-[pc-state=done]:tw-border-success/40 data-[pc-state=done]:tw-text-ink
                  data-[pc-state=current]:tw-border-power data-[pc-state=current]:tw-text-power
                  data-[pc-state=locked]:tw-border-hairline data-[pc-state=locked]:tw-text-ink/35
                  [&.is-active]:tw-border-power lg:[&.is-active]:tw-bg-peach">

                <span class="tw-relative tw-inline-flex tw-h-5 tw-w-5 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-text-[0.62rem] tw-font-bold tw-transition-colors tw-duration-300
                  group-data-[pc-state=done]:tw-bg-success group-data-[pc-state=done]:tw-text-white
                  group-data-[pc-state=current]:tw-bg-power group-data-[pc-state=current]:tw-text-white
                  group-data-[pc-state=locked]:tw-bg-black/[0.07] group-data-[pc-state=locked]:tw-text-ink/40" aria-hidden="true">
                  <svg class="tw-hidden tw-h-3 tw-w-3 group-data-[pc-state=done]:tw-block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
                  <span class="tw-hidden group-data-[pc-state=current]:tw-block"><?= $i + 1 ?></span>
                  <span class="tw-hidden group-data-[pc-state=locked]:tw-block"><?php pc_dt_icon('lock', 'tw-h-2.5 tw-w-2.5'); ?></span>
                </span>
                <span class="tw-truncate"><?= htmlspecialchars($m['nav']) ?></span>
                <?php  ?>
                <span class="tw-sr-only">
                  <span class="tw-hidden group-data-[pc-state=done]:tw-inline">&mdash; completed</span>
                  <span class="tw-hidden group-data-[pc-state=current]:tw-inline">&mdash; available now</span>
                  <span class="tw-hidden group-data-[pc-state=locked]:tw-inline">&mdash; locked</span>
                </span>
              </button>
            </li>
          <?php endforeach; ?>

          <li class="tw-shrink-0 lg:tw-shrink lg:tw-mt-1 lg:tw-border-0 lg:tw-border-t lg:tw-border-solid lg:tw-border-hairline lg:tw-pt-1">
            <button type="button" data-pc-mission-link="final" data-pc-state="<?= $dtAllDone ? ($dtCertified ? 'done' : 'current') : 'locked' ?>"
              <?= $dtAllDone ? '' : 'disabled' ?>
              class="tw-group tw-flex tw-w-full tw-cursor-pointer tw-appearance-none tw-items-center tw-gap-2 tw-whitespace-nowrap tw-rounded-full tw-border tw-border-solid tw-bg-white tw-px-3 tw-py-2 tw-text-left tw-text-[0.8rem] tw-font-bold tw-transition-all tw-duration-300 disabled:tw-cursor-not-allowed lg:tw-rounded-xl lg:tw-border-0 lg:tw-px-2.5 lg:tw-py-2 [&.is-active]:tw-border-power lg:[&.is-active]:tw-bg-peach
                data-[pc-state=done]:tw-border-success/40 data-[pc-state=done]:tw-text-ink
                data-[pc-state=current]:tw-border-power data-[pc-state=current]:tw-text-power
                data-[pc-state=locked]:tw-border-hairline data-[pc-state=locked]:tw-text-ink/35">
              <span class="tw-inline-flex tw-h-5 tw-w-5 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-transition-colors tw-duration-300
                group-data-[pc-state=done]:tw-bg-success group-data-[pc-state=done]:tw-text-white
                group-data-[pc-state=current]:tw-bg-power group-data-[pc-state=current]:tw-text-white
                group-data-[pc-state=locked]:tw-bg-black/[0.07] group-data-[pc-state=locked]:tw-text-ink/40" aria-hidden="true">
                <span class="tw-hidden group-data-[pc-state=locked]:tw-block"><?php pc_dt_icon('lock', 'tw-h-3 tw-w-3'); ?></span>
                <span class="tw-hidden group-data-[pc-state=current]:tw-block group-data-[pc-state=done]:tw-block"><?php pc_dt_icon('award', 'tw-h-3 tw-w-3'); ?></span>
              </span>
              <span class="tw-truncate">Final Challenge</span>
              <span class="tw-sr-only">&mdash; <?= $dtCertified ? 'passed' : ($dtAllDone ? 'available' : 'locked') ?></span>
            </button>
          </li>
        </ol>
      </nav>

      <div class="tw-min-w-0" data-pc-mission-panels>
        <?php foreach ($pcMissions as $i => $m): ?>
          <?php
          $done = pc_training_mission_done($dtProgress, $m['id']);
          $unlocked = pc_training_is_unlocked($dtProgress, $pcMissions, $m['id']);
          $isCurrent = $i === $dtCurrentIdx || ($dtAllDone && $i === 0 && false);
          ?>
          <?php  ?>
          <?php  ?>
          <section data-pc-mission="<?= htmlspecialchars($m['id']) ?>" data-pc-done="<?= $done ? '1' : '0' ?>" <?= $isCurrent ? '' : 'hidden' ?>
            class="tw-group/mission tw-overflow-hidden tw-rounded-3xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-shadow-[0_12px_32px_-18px_rgba(28,20,16,0.25)] data-[pc-done=1]:tw-border-success/30">

            <div class="tw-relative tw-overflow-hidden tw-bg-gradient-to-br tw-px-5 tw-py-5 tw-transition-colors tw-duration-500 sm:tw-px-7
              group-data-[pc-done=0]/mission:tw-from-peach group-data-[pc-done=0]/mission:tw-to-power/[0.05]
              group-data-[pc-done=1]/mission:tw-from-success/[0.14] group-data-[pc-done=1]/mission:tw-to-success/[0.04]">
              <span class="tw-pointer-events-none tw-absolute tw--right-4 tw--top-5 tw-rotate-12 tw-transition-colors tw-duration-500 group-data-[pc-done=0]/mission:tw-text-power/[0.09] group-data-[pc-done=1]/mission:tw-text-success/10" aria-hidden="true">
                <?php pc_dt_icon($m['icon'], 'tw-h-28 tw-w-28'); ?>
              </span>

              <div class="tw-relative tw-flex tw-items-start tw-gap-3.5">
                <span class="tw-inline-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-2xl tw-text-white tw-shadow-[0_6px_16px_-6px_rgba(28,20,16,0.35)] tw-transition-colors tw-duration-500 group-data-[pc-done=0]/mission:tw-bg-power group-data-[pc-done=1]/mission:tw-bg-success" aria-hidden="true">
                  <?php pc_dt_icon($m['icon']); ?>
                </span>
                <div class="tw-min-w-0 tw-flex-1">
                  <p class="tw-mb-1 tw-flex tw-flex-wrap tw-items-center tw-gap-2 tw-text-[0.68rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] tw-text-ink/45">
                    Level <?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?> of <?= $pcMissionCount ?>
                    <span class="tw-hidden tw-items-center tw-gap-1 tw-rounded-full tw-bg-success tw-px-2 tw-py-0.5 tw-text-[0.62rem] tw-tracking-normal tw-text-white group-data-[pc-done=1]/mission:tw-inline-flex">
                      <svg class="tw-h-2.5 tw-w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
                      Completed
                    </span>
                    <?php  ?>
                    <span class="tw-hidden tw-items-center tw-gap-1 tw-rounded-full tw-bg-white/80 tw-px-2 tw-py-0.5 tw-text-[0.62rem] tw-tracking-normal tw-text-power group-data-[pc-done=0]/mission:tw-inline-flex">
                      <svg class="tw-h-2.5 tw-w-2.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M13 2L4.5 13.5H11l-1 8.5 8.5-11.5H12l1-8.5z"/></svg>
                      +<?= pc_mission_points($m) ?> pts
                    </span>
                  </p>
                  <h2 class="<?= pc_mb($pcH2Small, 'tw-mb-0') ?>"><?= htmlspecialchars($m['title']) ?></h2>
                </div>
              </div>
            </div>

            <div class="tw-p-5 sm:tw-p-7">
            <div class="tw-mb-5 tw-flex tw-items-start tw-gap-3 tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-paper-soft tw-p-4">
              <span class="tw-mt-0.5 tw-shrink-0 tw-text-power" aria-hidden="true"><?php pc_dt_icon('info', 'tw-h-4 tw-w-4'); ?></span>
              <div>
                <p class="tw-mb-1 tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-power">Why this matters</p>
                <p class="<?= $pcBodySm ?> tw-mb-0"><?= $m['why'] ?></p>
              </div>
            </div>

            <?php  ?>
            <?php if (!empty($dtFacts[$m['id']])): ?>
              <div class="tw-mb-5 tw-flex tw-items-start tw-gap-3 tw-rounded-2xl tw-border tw-border-solid tw-border-power/20 tw-bg-peach tw-p-4">
                <span class="tw-mt-0.5 tw-shrink-0 tw-text-power" aria-hidden="true"><?php pc_dt_icon('user', 'tw-h-4 tw-w-4'); ?></span>
                <div>
                  <p class="tw-mb-1 tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-power">Your record</p>
                  <p class="<?= $pcBodySm ?> tw-mb-0 tw-text-ink"><?= htmlspecialchars($dtFacts[$m['id']]) ?></p>
                </div>
              </div>
            <?php endif; ?>

            <?php  ?>
            <?php if (!empty($m['reward'])): ?>
              <div class="tw-mb-6 tw-flex tw-items-start tw-gap-3.5 tw-rounded-2xl tw-border tw-border-solid tw-border-success/25 tw-bg-gradient-to-br tw-from-success/[0.12] tw-to-success/[0.03] tw-p-4">
                <span class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-success tw-text-white" aria-hidden="true">
                  <?php pc_dt_icon('euro', 'tw-h-[1.1rem] tw-w-[1.1rem]'); ?>
                </span>
                <div>
                  <p class="tw-mb-0.5 tw-text-[0.68rem] tw-font-bold tw-uppercase tw-tracking-[0.14em] tw-text-success">Your reward</p>
                  <p class="tw-mb-0 tw-text-[0.95rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= $m['reward'] ?></p>
                </div>
              </div>
            <?php endif; ?>

            <?php  ?>
            <?php if (empty($m['screens']) && !empty($m['illus'])): ?>
              <?php  ?>
              <div class="tw-relative tw-mb-6 tw-flex tw-items-center tw-justify-center tw-overflow-hidden tw-rounded-2xl tw-bg-gradient-to-br tw-from-peach tw-via-white tw-to-success/[0.07] tw-py-10" aria-hidden="true">
                <span class="tw-absolute tw--left-6 tw--top-6 tw-rotate-12 tw-text-power/[0.07]"><?php pc_dt_icon($m['illus'], 'tw-h-32 tw-w-32'); ?></span>
                <span class="tw-absolute tw--bottom-8 tw--right-4 tw--rotate-12 tw-text-ink/[0.05]"><?php pc_dt_icon($m['illus'], 'tw-h-36 tw-w-36'); ?></span>
                <span class="tw-relative tw-inline-flex tw-h-20 tw-w-20 tw-items-center tw-justify-center tw-rounded-3xl tw-bg-white tw-text-power tw-shadow-[0_12px_30px_-10px_rgba(28,20,16,0.3)]">
                  <?php pc_dt_icon($m['illus'], 'tw-h-9 tw-w-9'); ?>
                </span>
              </div>
            <?php endif; ?>

            <div class="<?= empty($m['screens']) ? 'tw-hidden' : 'tw-mb-6' ?> tw-grid tw-grid-cols-2 tw-gap-x-4 tw-gap-y-6 sm:tw-grid-cols-3 lg:tw-grid-cols-4 lg:tw-gap-x-5">
              <?php foreach ($m['screens'] as $si => $s): ?>
                <figure class="tw-m-0">
                  <?php  ?>
                  <?php  ?>
                  <?php  ?>
                  <?php $isDetail = !empty($s['detail']); ?>
                  <button type="button"
                    data-pc-zoom="<?= htmlspecialchars($assetPath . 'assets/img/training/' . $s['src']) ?>"
                    data-pc-zoom-alt="<?= htmlspecialchars($s['alt']) ?>"
                    class="tw-group tw-relative tw-mx-auto tw-block tw-w-full tw-cursor-zoom-in tw-appearance-none tw-p-0 tw-transition-transform tw-duration-300 hover:tw--translate-y-1 motion-reduce:tw-transition-none <?= $isDetail
                      ? 'tw-max-w-[150px] tw-rounded-xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-shadow-[0_10px_24px_-12px_rgba(28,20,16,0.4)] sm:tw-max-w-[190px] lg:tw-max-w-[220px]'
                      : 'tw-max-w-[132px] tw-rounded-[1.35rem] tw-border-[5px] tw-border-solid tw-border-ink tw-bg-ink tw-shadow-[0_14px_32px_-12px_rgba(28,20,16,0.5)] sm:tw-max-w-[160px] lg:tw-max-w-[188px]' ?>"
                    aria-label="View this screenshot full size">
                    <?php if (!$isDetail): ?>
                      <span class="tw-pointer-events-none tw-absolute tw-left-1/2 tw-top-0 tw-z-10 tw-h-[0.3rem] tw-w-9 tw--translate-x-1/2 tw-rounded-b-full tw-bg-ink" aria-hidden="true"></span>
                      <span class="tw-pointer-events-none tw-absolute tw-bottom-1 tw-left-1/2 tw-z-10 tw-h-[0.14rem] tw-w-10 tw--translate-x-1/2 tw-rounded-full tw-bg-white/70" aria-hidden="true"></span>
                    <?php endif; ?>
                    <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-10 tw-rounded-[0.95rem] tw-opacity-0 tw-transition-opacity tw-duration-300 group-hover:tw-opacity-100 group-focus-visible:tw-opacity-100 tw-bg-[linear-gradient(180deg,rgba(249,115,22,0)_55%,rgba(249,115,22,0.35)_100%)] motion-reduce:tw-transition-none" aria-hidden="true"></span>
                    <span class="tw-pointer-events-none tw-absolute tw-bottom-2 tw-left-1/2 tw-z-20 tw--translate-x-1/2 tw-rounded-full tw-bg-white/95 tw-px-2 tw-py-0.5 tw-text-[0.6rem] tw-font-bold tw-text-ink tw-opacity-0 tw-transition-opacity tw-duration-300 group-hover:tw-opacity-100 group-focus-visible:tw-opacity-100 motion-reduce:tw-transition-none" aria-hidden="true">Tap to zoom</span>
                    <?php  ?>
                    <img src="<?= htmlspecialchars($assetPath . 'assets/img/training/' . $s['src']) ?>"
                      alt="<?= htmlspecialchars($s['alt']) ?>"
                      width="<?= (int) ($s['w'] ?? 720) ?>" height="<?= (int) ($s['h'] ?? 1600) ?>"
                      class="tw-block tw-h-auto tw-w-full <?= $isDetail ? 'tw-rounded-[0.65rem]' : 'tw-rounded-[0.8rem]' ?>"
                      <?= $i === 0 && $si === 0 ? 'decoding="async"' : 'loading="lazy" decoding="async"' ?>>
                  </button>
                  <figcaption class="tw-mt-2.5 tw-text-[0.8rem] tw-leading-[1.5] tw-text-muted"><?= $s['caption'] ?></figcaption>
                </figure>
              <?php endforeach; ?>
            </div>

            <div class="tw-mb-6">
              <p class="tw-mb-3 tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-muted">What to do</p>
              <ol class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
                <?php foreach ($m['steps'] as $sx => $step): ?>
                  <li class="tw-flex tw-items-start tw-gap-3">
                    <span class="tw-mt-px tw-inline-flex tw-h-5 tw-w-5 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-peach tw-text-[0.65rem] tw-font-bold tw-text-power" aria-hidden="true"><?= $sx + 1 ?></span>
                    <span class="<?= $pcBodySm ?>"><?= $step ?></span>
                  </li>
                <?php endforeach; ?>
              </ol>
            </div>

            <?php  ?>
            <?php  ?>
            <?php $publicQuiz = pc_training_public_questions($m['quiz']); ?>
            <form data-pc-quiz="<?= htmlspecialchars($m['id']) ?>" data-no-ajax novalidate
              class="tw-m-0 tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-paper-soft tw-p-4 sm:tw-p-5">
              <p class="tw-mb-4 tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.12em] tw-text-power">Quick check</p>

              <?php foreach ($publicQuiz as $qi => $q): ?>
                <fieldset class="tw-m-0 tw-mb-5 tw-border-0 tw-p-0" data-pc-q="<?= $qi ?>">
                  <legend class="tw-mb-3 tw-p-0 tw-text-[0.95rem] tw-font-semibold tw-leading-snug tw-text-ink">
                    <?= $q['q'] ?>
                    <?php  ?>
                    <span class="tw-ml-1 tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-ink/[0.06] tw-px-2 tw-py-0.5 tw-align-middle tw-text-[0.6rem] tw-font-bold tw-uppercase tw-tracking-wide tw-text-ink/55"><?= (int) $q['pts'] ?> pts</span>
                    <?php if ($q['critical']): ?>
                      <span class="tw-ml-1 tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-power/10 tw-px-2 tw-py-0.5 tw-align-middle tw-text-[0.6rem] tw-font-bold tw-uppercase tw-tracking-wide tw-text-power">Safety critical</span>
                    <?php endif; ?>
                  </legend>
                  <div class="tw-flex tw-flex-col tw-gap-2">
                    <?php foreach ($q['options'] as $oi => $opt): ?>
                      <?php $rid = 'q_' . $m['id'] . '_' . $qi . '_' . $oi; ?>
                      <?php  ?>
                      <label for="<?= $rid ?>"
                        class="tw-group tw-flex tw-cursor-pointer tw-items-start tw-gap-3 tw-rounded-xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-3 tw-transition-colors tw-duration-200 hover:tw-border-power/40 has-[:checked]:tw-border-power has-[:checked]:tw-bg-peach has-[:focus-visible]:tw-outline has-[:focus-visible]:tw-outline-2 has-[:focus-visible]:tw-outline-offset-2 has-[:focus-visible]:tw-outline-power motion-reduce:tw-transition-none">
                        <input type="radio" id="<?= $rid ?>" name="q<?= $qi ?>" value="<?= $oi ?>"
                          class="tw-peer tw-mt-0.5 tw-h-4 tw-w-4 tw-shrink-0 tw-cursor-pointer tw-accent-power">
                        <span class="tw-text-[0.9rem] tw-leading-snug tw-text-ink"><?= $opt ?></span>
                      </label>
                    <?php endforeach; ?>
                  </div>
                  <p data-pc-explain hidden class="tw-mb-0 tw-mt-2.5 tw-rounded-xl tw-px-3.5 tw-py-2.5 tw-text-[0.85rem] tw-leading-relaxed"></p>
                </fieldset>
              <?php endforeach; ?>

              <div data-pc-quiz-msg hidden role="status" class="tw-mb-4 tw-rounded-xl tw-px-4 tw-py-3 tw-text-sm tw-font-semibold"></div>

              <button type="submit" class="<?= $pcBtnPrimary ?> tw-w-full tw-cursor-pointer sm:tw-w-auto">
                <span data-label><?= $done ? 'Check again' : 'Complete level' ?></span>
              </button>
            </form>
            </div>          </section>
        <?php endforeach; ?>

        <section data-pc-mission="final" <?= $dtAllDone && $dtCurrentIdx >= $pcMissionCount ? '' : 'hidden' ?>
          class="tw-rounded-3xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-5 sm:tw-p-7">
          <div class="tw-mb-5">
            <p class="<?= pc_mb($pcEyebrow, 'tw-mb-1.5') ?>">Final driver challenge</p>
            <h2 class="<?= pc_mb($pcH2Small, 'tw-mb-2') ?>">Let&rsquo;s make sure you&rsquo;re ready.</h2>
            <p class="<?= $pcBodySm ?> tw-mb-0">
              <?= count($pcFinalChallenge) ?> questions from across your training. You need <strong class="tw-text-ink"><?= PC_FINAL_PASS ?>%</strong> to pass,
              and the safety-critical questions must be right. Unlimited retries &mdash; take your time.
            </p>
          </div>

          <?php $publicFinal = pc_training_public_questions($pcFinalChallenge); ?>
          <form data-pc-quiz="final" data-no-ajax novalidate class="tw-m-0">
            <?php foreach ($publicFinal as $qi => $q): ?>
              <fieldset class="tw-m-0 tw-mb-5 tw-border-0 tw-p-0" data-pc-q="<?= $qi ?>">
                <legend class="tw-mb-3 tw-p-0 tw-text-[0.95rem] tw-font-semibold tw-leading-snug tw-text-ink">
                  <span class="tw-text-muted"><?= $qi + 1 ?>.</span> <?= $q['q'] ?>
                  <span class="tw-ml-1 tw-inline-flex tw-items-center tw-rounded-full tw-bg-ink/[0.06] tw-px-2 tw-py-0.5 tw-align-middle tw-text-[0.6rem] tw-font-bold tw-uppercase tw-tracking-wide tw-text-ink/55"><?= (int) $q['pts'] ?> pts</span>
                  <?php if ($q['critical']): ?>
                    <span class="tw-ml-1 tw-inline-flex tw-items-center tw-rounded-full tw-bg-power/10 tw-px-2 tw-py-0.5 tw-align-middle tw-text-[0.6rem] tw-font-bold tw-uppercase tw-tracking-wide tw-text-power">Safety critical</span>
                  <?php endif; ?>
                </legend>
                <div class="tw-flex tw-flex-col tw-gap-2">
                  <?php foreach ($q['options'] as $oi => $opt): ?>
                    <?php $rid = 'f_' . $qi . '_' . $oi; ?>
                    <label for="<?= $rid ?>"
                      class="tw-flex tw-cursor-pointer tw-items-start tw-gap-3 tw-rounded-xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-3 tw-transition-colors tw-duration-200 hover:tw-border-power/40 has-[:checked]:tw-border-power has-[:checked]:tw-bg-peach has-[:focus-visible]:tw-outline has-[:focus-visible]:tw-outline-2 has-[:focus-visible]:tw-outline-offset-2 has-[:focus-visible]:tw-outline-power motion-reduce:tw-transition-none">
                      <input type="radio" id="<?= $rid ?>" name="q<?= $qi ?>" value="<?= $oi ?>"
                        class="tw-mt-0.5 tw-h-4 tw-w-4 tw-shrink-0 tw-cursor-pointer tw-accent-power">
                      <span class="tw-text-[0.9rem] tw-leading-snug tw-text-ink"><?= $opt ?></span>
                    </label>
                  <?php endforeach; ?>
                </div>
                <p data-pc-explain hidden class="tw-mb-0 tw-mt-2.5 tw-rounded-xl tw-px-3.5 tw-py-2.5 tw-text-[0.85rem] tw-leading-relaxed"></p>
              </fieldset>
            <?php endforeach; ?>

            <div data-pc-quiz-msg hidden role="status" class="tw-mb-4 tw-rounded-xl tw-px-4 tw-py-3 tw-text-sm tw-font-semibold"></div>

            <button type="submit" class="<?= $pcBtnPrimary ?> tw-w-full tw-cursor-pointer sm:tw-w-auto">
              <span data-label>Submit final challenge</span>
            </button>
          </form>
        </section>

        <section data-pc-certified <?= $dtCertified ? '' : 'hidden' ?>
          class="tw-mt-4 tw-overflow-hidden tw-rounded-3xl tw-border tw-border-solid tw-border-success/25 tw-bg-success/[0.05] tw-p-6 tw-text-center sm:tw-p-9">
          <span class="tw-mx-auto tw-mb-4 tw-inline-flex tw-h-14 tw-w-14 tw-items-center tw-justify-center tw-rounded-full tw-bg-success tw-text-white" aria-hidden="true">
            <?php pc_dt_icon('award', 'tw-h-7 tw-w-7'); ?>
          </span>
          <h2 class="<?= pc_mb($pcH2Small, 'tw-mb-2') ?>">Congratulations!</h2>
          <p class="<?= $pcBodySm ?> tw-mx-auto tw-mb-5 tw-max-w-[42ch]">
            You are now <strong class="tw-text-ink">PowerCabs Ready</strong>. Your certificate has been emailed to you,
            and you can download it any time.
          </p>

          <dl class="tw-mx-auto tw-mb-6 tw-grid tw-max-w-[28rem] tw-grid-cols-2 tw-gap-3 tw-text-left">
            <div class="tw-rounded-xl tw-bg-white tw-px-3.5 tw-py-2.5">
              <dt class="tw-mb-0.5 tw-text-[0.65rem] tw-font-bold tw-uppercase tw-tracking-[0.1em] tw-text-muted">Driver</dt>
              <dd class="tw-m-0 tw-truncate tw-text-[0.9rem] tw-font-bold tw-text-ink"><?= htmlspecialchars($dtName) ?></dd>
            </div>
            <div class="tw-rounded-xl tw-bg-white tw-px-3.5 tw-py-2.5">
              <dt class="tw-mb-0.5 tw-text-[0.65rem] tw-font-bold tw-uppercase tw-tracking-[0.1em] tw-text-muted">Completed</dt>
              <dd class="tw-m-0 tw-text-[0.9rem] tw-font-bold tw-text-ink" data-pc-cert-date>
                <?= !empty($dtProgress['certificate']['at']) ? htmlspecialchars(gmdate('j M Y', (int) $dtProgress['certificate']['at'])) : '&mdash;' ?>
              </dd>
            </div>
            <div class="tw-col-span-2 tw-rounded-xl tw-bg-white tw-px-3.5 tw-py-2.5">
              <dt class="tw-mb-0.5 tw-text-[0.65rem] tw-font-bold tw-uppercase tw-tracking-[0.1em] tw-text-muted">Certificate ID</dt>
              <dd class="tw-m-0 tw-font-mono tw-text-[0.9rem] tw-font-bold tw-text-ink" data-pc-cert-id>
                <?= htmlspecialchars((string) ($dtProgress['certificate']['id'] ?? '—')) ?>
              </dd>
            </div>
          </dl>

          <div class="tw-flex tw-flex-wrap tw-justify-center tw-gap-2.5">
            <a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath ?>/driver-certificate" target="_blank" rel="noopener" data-no-pjax>View certificate</a>
            <a class="<?= $pcBtnGhost ?>" href="<?= $assetPath ?>/driver-certificate?download=1" data-no-pjax>Download certificate</a>
          </div>
          <p data-pc-cert-note class="tw-mb-0 tw-mt-4 tw-text-[0.8rem] tw-text-muted"></p>
        </section>
      </div>
    </div>
  </div>
  </div></div>

<?php  ?>
<div data-pc-celebrate hidden
  class="tw-pointer-events-none tw-fixed tw-inset-x-0 tw-top-[calc(var(--pc-navbar-h,72px)+1rem)] tw-z-[1070] tw-flex tw-justify-center tw-px-4"
  role="status" aria-live="polite">
  <div class="tw-flex tw-items-center tw-gap-3 tw-rounded-2xl tw-bg-ink tw-px-5 tw-py-3 tw-text-white tw-shadow-[0_18px_40px_-12px_rgba(0,0,0,0.5)] tw-opacity-0 tw--translate-y-2 tw-transition-[opacity,transform] tw-duration-300 [&.is-in]:tw-opacity-100 [&.is-in]:tw-translate-y-0 motion-reduce:tw-transition-none">
    <span class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-success tw-text-white" aria-hidden="true">
      <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
    </span>
    <div class="tw-text-left">
      <p class="tw-mb-0 tw-text-[0.85rem] tw-font-bold tw-leading-tight" data-pc-celebrate-title>Mission complete!</p>
      <p class="tw-mb-0 tw-text-[0.75rem] tw-leading-tight tw-text-white/65" data-pc-celebrate-sub></p>
    </div>
  </div>
</div>

<?php  ?>
<div data-pc-dt-lightbox hidden
  class="tw-fixed tw-inset-0 tw-z-[1060] tw-flex tw-items-center tw-justify-center tw-bg-ink/90 tw-p-4"
  role="dialog" aria-modal="true" aria-label="Screenshot">
  <button type="button" data-pc-dt-lightbox-close
    class="tw-absolute tw-right-4 tw-top-4 tw-inline-flex tw-h-10 tw-w-10 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border-0 tw-bg-white/15 tw-text-white tw-transition-colors hover:tw-bg-white/25"
    aria-label="Close">
    <svg class="tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M3 3l10 10M13 3L3 13"/></svg>
  </button>
  <img data-pc-dt-lightbox-img src="" alt="" class="tw-max-h-[88vh] tw-w-auto tw-max-w-full tw-rounded-2xl tw-shadow-[0_30px_70px_rgba(0,0,0,0.5)]">
</div>

<?php
require __DIR__ . '/components/driver-training/mobile-dock.php';
?>

<script src="<?= $assetPath ?>assets/js/components/driver-mission.js?v=<?= @filemtime(__DIR__ . '/assets/js/components/driver-mission.js') ?>"></script>

<?php
require __DIR__ . '/includes/footer.php';
