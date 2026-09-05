<?php
/**
 * Ride page: "Why PowerCabs?" comparison -- PowerCabs vs large taxi apps vs
 * traditional phone booking, scanned side by side across a shared feature
 * list (a comparison grid, not three separate "pick one" plan cards).
 */

function pc_why_icon(string $type, string $label): string
{
  $markup = match ($type) {
    'check' => '<svg class="tw-inline-block tw-h-[1.1rem] tw-w-[1.1rem] tw-text-[#198754]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>',
    'varies-strong'
      => '<svg class="tw-inline-block tw-h-[1.1rem] tw-w-[1.1rem] tw-text-[#198754] tw-opacity-65" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="12" r="9"/></svg>',
    'varies'
      => '<svg class="tw-inline-block tw-h-[1.1rem] tw-w-[1.1rem] tw-text-ink/50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M9 12h6"/></svg>',
    default => '',
  };
  return $markup . '<span class="tw-sr-only">' . htmlspecialchars($label) . '</span>';
}

$whyComparisonRows = [
  ['label' => 'Book online', 'powercabs' => 'check', 'apps' => 'check', 'traditional' => 'check'],
  ['label' => 'Real-time tracking', 'powercabs' => 'check', 'apps' => 'check', 'traditional' => 'varies'],
  ['label' => 'Licensed drivers', 'powercabs' => 'check', 'apps' => 'check', 'traditional' => 'check'],
  ['label' => 'Irish / Dublin-based company', 'powercabs' => 'check', 'apps' => 'varies', 'traditional' => 'check'],
  [
    'label' => 'Accessible / pet / XL options',
    'powercabs' => 'check',
    'apps' => 'varies-strong',
    'traditional' => 'varies-strong',
  ],
  [
    'label' => 'Business & specialist journeys',
    'powercabs' => 'check',
    'apps' => 'varies-strong',
    'traditional' => 'varies-strong',
  ],
];

$whyLabels = ['check' => 'Included', 'varies-strong' => 'Sometimes', 'varies' => 'Varies'];
?>
<!-- ============ Why PowerCabs? ============ -->
<section class="tw-bg-paper-soft <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-12 tw-max-w-[680px] tw-text-center">
      <p class="<?= $pcEyebrow ?>">/ Why PowerCabs?</p>
      <h2 class="tw-mb-3 tw-text-[clamp(2rem,4vw,2.75rem)] tw-font-bold tw-leading-[1.15] tw-tracking-[-0.02em] tw-text-ink">
        Big-app convenience. <span class="tw-text-power">Local Irish service.</span>
      </h2>
      <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/[0.62]">
        Don't compete on claims customers can't verify. Win on trust, choice and
        the journeys where local service matters.
      </p>
    </div>

    <div class="tw-mx-auto tw-max-w-[940px]">

      <!-- Desktop/tablet. Same treatment as the Drive page's comparison: the
           PowerCabs column is lifted out of the table onto its own ringed
           panel so it reads as the answer, not as one of three equal columns.
           Four columns here rather than three, so the shares differ. -->
      <div class="tw-hidden md:tw-block">
        <div class="tw-relative tw-rounded-[20px] tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]">

          <div class="tw-pointer-events-none tw-absolute tw-bottom-0 tw-left-[40%] tw-top-0 tw-w-[20%] tw-rounded-[20px] tw-bg-white tw-shadow-[0_18px_45px_-12px_rgba(232,89,12,0.35)] tw-ring-2 tw-ring-power/[0.35]" aria-hidden="true"></div>

          <!-- Header -->
          <div class="tw-relative tw-grid tw-grid-cols-[40%_20%_20%_20%] tw-items-stretch tw-overflow-hidden tw-rounded-t-[20px] tw-bg-ink">
            <div class="tw-flex tw-items-center tw-px-6 tw-py-4">
              <span class="tw-text-[0.7rem] tw-font-semibold tw-uppercase tw-tracking-[0.14em] tw-text-white/45">What you need</span>
            </div>
            <div class="tw-flex tw-items-center tw-justify-center tw-bg-[linear-gradient(180deg,rgba(232,89,12,0.32),rgba(232,89,12,0.12))] tw-px-2 tw-py-4 tw-text-center">
              <span class="tw-text-[0.85rem] tw-font-extrabold tw-uppercase tw-tracking-[0.08em] tw-text-powerlight">PowerCabs</span>
            </div>
            <div class="tw-flex tw-items-center tw-justify-center tw-px-2 tw-py-4 tw-text-center">
              <span class="tw-text-[0.7rem] tw-font-semibold tw-uppercase tw-tracking-[0.12em] tw-text-white/45">Large Taxi Apps</span>
            </div>
            <div class="tw-flex tw-items-center tw-justify-center tw-px-2 tw-py-4 tw-text-center">
              <span class="tw-text-[0.7rem] tw-font-semibold tw-uppercase tw-tracking-[0.12em] tw-text-white/45">Traditional Booking</span>
            </div>
          </div>

          <!-- Feature rows -->
          <?php foreach ($whyComparisonRows as $i => $row): ?>
            <div class="tw-relative tw-grid tw-grid-cols-[40%_20%_20%_20%] tw-items-stretch<?= $i < count($whyComparisonRows) - 1
              ? ' tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06]'
              : '' ?>">
              <div class="tw-flex tw-items-center tw-px-6 tw-py-4">
                <span class="tw-text-[0.975rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= htmlspecialchars(
                  $row['label'],
                ) ?></span>
              </div>
              <div class="tw-flex tw-items-center tw-justify-center tw-px-2 tw-py-4 tw-text-center">
                <?= pc_why_icon($row['powercabs'], $whyLabels[$row['powercabs']]) ?>
              </div>
              <div class="tw-flex tw-items-center tw-justify-center tw-px-2 tw-py-4 tw-text-center">
                <?= pc_why_icon($row['apps'], $whyLabels[$row['apps']]) ?>
              </div>
              <div class="tw-flex tw-items-center tw-justify-center tw-px-2 tw-py-4 tw-text-center">
                <?= pc_why_icon($row['traditional'], $whyLabels[$row['traditional']]) ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Mobile: one card per feature, PowerCabs keeping its brand ring so
           the hierarchy survives the stack. -->
      <div class="tw-flex tw-flex-col tw-gap-3 md:tw-hidden">
        <?php foreach ($whyComparisonRows as $row): ?>
          <div class="tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-4 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]">
            <p class="tw-mb-3 tw-text-[0.975rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= htmlspecialchars(
              $row['label'],
            ) ?></p>
            <div class="tw-mb-2 tw-flex tw-items-center tw-justify-between tw-gap-3 tw-rounded-xl tw-bg-power/[0.06] tw-px-3 tw-py-2.5 tw-ring-1 tw-ring-power/25">
              <span class="tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.1em] tw-text-powerdark">PowerCabs</span>
              <?= pc_why_icon($row['powercabs'], $whyLabels[$row['powercabs']]) ?>
            </div>
            <div class="tw-flex tw-items-center tw-justify-between tw-gap-3 tw-px-3 tw-py-1.5">
              <span class="tw-text-[0.7rem] tw-uppercase tw-tracking-[0.1em] tw-text-ink/40">Large Taxi Apps</span>
              <?= pc_why_icon($row['apps'], $whyLabels[$row['apps']]) ?>
            </div>
            <div class="tw-flex tw-items-center tw-justify-between tw-gap-3 tw-px-3 tw-py-1.5">
              <span class="tw-text-[0.7rem] tw-uppercase tw-tracking-[0.1em] tw-text-ink/40">Traditional Booking</span>
              <?= pc_why_icon($row['traditional'], $whyLabels[$row['traditional']]) ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- Legend: the three icon states, spelled out. -->
      <div class="tw-mt-6 tw-flex tw-flex-wrap tw-items-center tw-justify-center tw-gap-x-6 tw-gap-y-2 tw-text-[0.8rem] tw-text-ink/[0.55]">
        <?php foreach ($whyLabels as $type => $label): ?>
          <span class="tw-inline-flex tw-items-center tw-gap-2">
            <?= pc_why_icon($type, $label) ?><?= htmlspecialchars($label) ?>
          </span>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>
