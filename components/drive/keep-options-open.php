<?php
$familyPoints = [
  ['lead' => 'Irish company.', 'text' => 'Local people who understand the Irish taxi market.'],
  ['lead' => 'Real support.', 'text' => 'When you have a problem, reach a person.'],
  ['lead' => 'Driver benefits.', 'text' => 'Fuel, car care, card and loyalty opportunities.'],
  ['lead' => 'Your success matters.', 'text' => 'A strong driver network makes PowerCabs stronger.'],
]; ?>
<!-- ============ The PowerCabs Family / Keep Your Options Open ============ -->
<section class="tw-bg-white tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 lg:tw-grid-cols-2">

      <div class="tw-h-full tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] tw-p-6 lg:tw-p-9">
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ The PowerCabs Family</p>
        <h2 class="tw-mb-3 tw-text-[clamp(1.7rem,3vw,2.2rem)] tw-font-bold tw-leading-tight tw-text-ink">
          When you're on the road, you shouldn't feel alone.
        </h2>
        <p class="tw-mb-4 tw-text-ink/60">
          You're the person representing our company to every passenger. We
          want that relationship to go both ways.
        </p>
        <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-3 tw-p-0">
          <?php foreach ($familyPoints as $point): ?>
            <li class="tw-flex tw-items-start tw-gap-2">
              <svg class="tw-mt-0.5 tw-h-5 tw-w-5 tw-shrink-0 tw-text-[#198754]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 011.04-.207z" clip-rule="evenodd"/></svg>
              <span>
                <span class="tw-font-bold tw-text-ink"><?= htmlspecialchars($point['lead']) ?></span>
                <span class="tw-text-ink/60"> <?= htmlspecialchars($point['text']) ?></span>
              </span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div class="tw-flex tw-h-full tw-flex-col tw-justify-center tw-rounded-2xl tw-bg-powerlight tw-p-6 lg:tw-p-9">
        <p class="tw-mb-2 tw-text-sm tw-font-bold tw-uppercase tw-tracking-[0.06em] tw-text-ink">/ Keep Your Options Open</p>
        <h2 class="tw-mb-3 tw-text-[clamp(1.7rem,3vw,2.2rem)] tw-font-bold tw-leading-tight tw-text-ink">
          Don't burn your bridges.
        </h2>
        <p class="tw-mb-3 tw-text-ink/80">
          Already use FREE NOW, Uber or another platform? Where their terms
          permit it, PowerCabs can be another source of bookings or a backup
          option.
        </p>
        <p class="tw-mb-4 tw-font-bold tw-text-ink">
          We're not asking you to choose one basket. We're giving you another one.
        </p>
        <a href="#driveJoinForm" class="tw-inline-flex tw-w-fit tw-items-center tw-gap-2 tw-whitespace-nowrap tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink-soft">
          Add PowerCabs to my Driving
          <svg class="tw-hidden tw-h-3.5 tw-w-3.5 sm:tw-inline-block" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 011.06 0l6.5 6.5a.75.75 0 010 1.06l-6.5 6.5a.75.75 0 11-1.06-1.06L14.19 12 8.22 6.03a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
        </a>
      </div>

    </div>
  </div>
</section>
