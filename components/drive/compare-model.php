<?php
$compareRows = [
  ['label' => 'Joining fee', 'powercabs' => '€0', 'other' => '€300'],
  ['label' => 'Monthly subscription', 'powercabs' => '€0', 'other' => '€120+'],
  ['label' => 'Commission on completed jobs', 'powercabs' => '10%', 'other' => '15-25%'],
  ['label' => 'Commission if no PowerCabs job is completed', 'powercabs' => '€0', 'other' => 'Depends on model'],
  ['label' => 'Saver fare model', 'powercabs' => 'No', 'other' => 'Up to 25% cut'],
  ['label' => 'Driver benefits', 'powercabs' => 'High', 'other' => 'Low'],
];
$rowCount = count($compareRows);
?>

<section class="<?= $pcSurfaceWhite ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-12 tw-max-w-[680px] tw-text-center">
      <p class="<?= $pcEyebrow ?>">Compare the Model</p>
      <h2 class="<?= $pcH2Display ?>">
        Look beyond the headline commission
      </h2>
    </div>

    <div class="tw-mx-auto tw-mb-12 tw-max-w-[720px] md:tw-mb-14">
      <p class="tw-mb-3 tw-text-center tw-text-[0.7rem] tw-font-semibold tw-uppercase tw-tracking-[0.14em] tw-text-muted">
        Example &mdash; one completed &euro;100 PowerCabs job
      </p>

      <div class="tw-flex tw-h-[2.9rem] tw-w-full tw-overflow-hidden tw-rounded-full tw-bg-ink/[0.06] tw-shadow-[inset_0_0_0_1px_rgba(28,20,16,0.08)] sm:tw-h-[3.45rem]"
        role="img" aria-label="On a completed €100 PowerCabs job, €90 of the fare is yours and €10 is commission.">
        <div class="tw-flex tw-w-[90%] tw-items-center tw-justify-center tw-bg-[linear-gradient(90deg,#e8590c_0%,#f97316_100%)] tw-px-3 sm:tw-justify-start sm:tw-px-8">
          <span class="tw-text-[1.15rem] tw-font-extrabold tw-tracking-[-0.02em] tw-text-white sm:tw-text-[1.625rem]">&euro;90 yours</span>
        </div>
        <div class="tw-w-[10%]" aria-hidden="true"></div>
      </div>

      <div class="tw-mt-3 tw-flex tw-items-baseline tw-justify-between tw-gap-4">
        <span class="tw-text-[0.8rem] tw-font-bold tw-uppercase tw-tracking-[0.08em] tw-text-power sm:tw-text-[0.875rem]">90% of the fare</span>
        <span class="tw-text-[0.8rem] tw-text-muted sm:tw-text-[0.875rem]">&euro;10 commission</span>
      </div>

      <p class="tw-mx-auto tw-mb-0 tw-mt-5 tw-max-w-[54ch] tw-text-center tw-text-[0.8125rem] tw-leading-relaxed tw-text-muted">
        Illustrative split of PowerCabs commission on a single completed job. It is
        not an earnings estimate and does not account for your own running costs.
      </p>
    </div>

    <div class="tw-mx-auto tw-max-w-[940px]">

      <!-- Desktop/tablet. The PowerCabs column is deliberately lifted out of
           the table: it sits on white with a brand ring and its own shadow, so
           the eye reads it as the answer rather than as one of three equal
           columns. The grid keeps all three in lockstep row by row. -->
      <div class="tw-hidden md:tw-block">
        <div class="tw-relative tw-rounded-[20px] tw-border tw-border-solid tw-border-hairline tw-bg-white tw-shadow-[0_18px_45px_-20px_rgba(28,20,16,0.28)]">

          <!-- The highlighted middle column, drawn as one continuous panel
               behind the rows rather than per-cell backgrounds -- that is what
               stops it looking like a plain striped table. -->
          <div class="tw-pointer-events-none tw-absolute tw-bottom-0 tw-left-[46%] tw-top-0 tw-w-[27%] tw-rounded-[20px] tw-bg-white tw-shadow-[0_18px_45px_-12px_rgba(232,89,12,0.35)] tw-ring-2 tw-ring-power/[0.35]" aria-hidden="true"></div>

          <!-- Header -->
          <div class="tw-relative tw-grid tw-grid-cols-[46%_27%_27%] tw-items-stretch tw-overflow-hidden tw-rounded-t-[20px] tw-bg-ink">
            <div class="tw-flex tw-items-center tw-px-6 tw-py-4">
              <span class="tw-text-[0.7rem] tw-font-semibold tw-uppercase tw-tracking-[0.14em] tw-text-white/45">Driver question</span>
            </div>
            <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-bg-[linear-gradient(180deg,rgba(232,89,12,0.32),rgba(232,89,12,0.12))] tw-px-3 tw-py-4 tw-text-center">
              <span class="tw-text-[0.9rem] tw-font-extrabold tw-uppercase tw-tracking-[0.08em] tw-text-powerlight">PowerCabs</span>
            </div>
            <div class="tw-flex tw-items-center tw-justify-center tw-px-3 tw-py-4 tw-text-center">
              <span class="tw-text-[0.7rem] tw-font-semibold tw-uppercase tw-tracking-[0.14em] tw-text-white/45">Other Models*</span>
            </div>
          </div>

          <!-- Rows -->
          <?php foreach ($compareRows as $i => $row): ?>
            <div class="tw-relative tw-grid tw-grid-cols-[46%_27%_27%] tw-items-stretch<?= $i < $rowCount - 1
              ? ' tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06]'
              : '' ?>">
              <div class="tw-flex tw-items-center tw-px-6 tw-py-4">
                <span class="tw-text-[0.975rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= htmlspecialchars(
                  $row['label'],
                ) ?></span>
              </div>
              <div class="tw-flex tw-items-center tw-justify-center tw-gap-2 tw-px-3 tw-py-4 tw-text-center">
                <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-power" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M16 8A8 8 0 110 8a8 8 0 0116 0zm-3.97-3.03a.75.75 0 00-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 10-1.06 1.06L6.97 11.03a.75.75 0 001.079-.02l3.992-4.99a.75.75 0 00-.01-1.05z"/></svg>
                <span class="tw-text-[1.05rem] tw-font-extrabold tw-tracking-[-0.01em] tw-text-ink"><?= htmlspecialchars(
                  $row['powercabs'],
                ) ?></span>
              </div>
              <div class="tw-flex tw-items-center tw-justify-center tw-px-3 tw-py-4 tw-text-center">
                <span class="tw-text-[0.95rem] tw-text-ink/[0.45]"><?= htmlspecialchars($row['other']) ?></span>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Mobile: one card per question, no horizontal scrolling. The
           PowerCabs answer keeps its brand ring so the hierarchy survives. -->
      <div class="tw-flex tw-flex-col tw-gap-3 md:tw-hidden">
        <?php foreach ($compareRows as $row): ?>
          <div class="tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-4 tw-shadow-[0_6px_18px_-10px_rgba(28,20,16,0.22)]">
            <p class="tw-mb-3 tw-text-[0.975rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= htmlspecialchars(
              $row['label'],
            ) ?></p>
            <div class="tw-mb-2 tw-flex tw-items-center tw-justify-between tw-gap-3 tw-rounded-xl tw-bg-power/[0.06] tw-px-3 tw-py-2.5 tw-ring-1 tw-ring-power/25">
              <span class="tw-flex tw-items-center tw-gap-1.5 tw-text-[0.7rem] tw-font-bold tw-uppercase tw-tracking-[0.1em] tw-text-powerdark">
                <svg class="tw-h-3.5 tw-w-3.5 tw-shrink-0" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M16 8A8 8 0 110 8a8 8 0 0116 0zm-3.97-3.03a.75.75 0 00-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 10-1.06 1.06L6.97 11.03a.75.75 0 001.079-.02l3.992-4.99a.75.75 0 00-.01-1.05z"/></svg>
                PowerCabs
              </span>
              <span class="tw-text-[1.05rem] tw-font-extrabold tw-text-ink"><?= htmlspecialchars(
                $row['powercabs'],
              ) ?></span>
            </div>
            <div class="tw-flex tw-items-center tw-justify-between tw-gap-3 tw-px-3">
              <span class="tw-text-[0.7rem] tw-uppercase tw-tracking-[0.1em] tw-text-ink/40">Other Models*</span>
              <span class="tw-text-[0.95rem] tw-text-ink/[0.45]"><?= htmlspecialchars($row['other']) ?></span>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="tw-mt-6 tw-flex tw-items-start tw-gap-3 tw-rounded-2xl tw-border tw-border-solid tw-border-power/25 tw-bg-power/[0.07] tw-p-4">
        <svg class="tw-mt-0.5 tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
        <p class="tw-mb-0 tw-text-[0.975rem] tw-font-semibold tw-leading-relaxed tw-text-ink">
          The PowerCabs advantage: no joining fee, no monthly subscription and no Saver fare
          cut &mdash; just a flat 10% on completed jobs.
        </p>
      </div>

    </div>
  </div>
</section>
