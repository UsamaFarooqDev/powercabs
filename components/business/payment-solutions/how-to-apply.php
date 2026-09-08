<?php
$applySteps = [
  ['n' => 1, 'title' => 'Apply Online', 'desc' => 'Fill out a quick application form.'],
  ['n' => 2, 'title' => 'Verification & Approval', 'desc' => 'Our team reviews your details.'],
  ['n' => 3, 'title' => 'Receive Your Terminal', 'desc' => 'Your card machine is shipped to you.'],
  ['n' => 4, 'title' => 'Start Taking Payments', 'desc' => 'Accept cards instantly, every ride.'],
];
?>
<section class="tw-bg-white <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <h2 class="tw-mb-8 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Apply in Four Simple Steps</h2>

    <div class="tw-grid tw-grid-cols-1 tw-items-stretch tw-gap-4 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-7">
        <div class="tw-grid tw-h-full tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2">
          <?php foreach ($applySteps as $step): ?>
            <div class="tw-h-full tw-rounded-2xl tw-bg-white tw-p-6 tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)]">
              <div class="tw-mb-3 tw-flex tw-h-[42px] tw-w-[42px] tw-items-center tw-justify-center tw-rounded-xl tw-bg-[rgba(245,132,31,0.1)] tw-text-lg tw-font-bold tw-text-power">
                <?= $step['n'] ?>
              </div>
              <h3 class="tw-mb-2 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($step['title']) ?></h3>
              <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($step['desc']) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="lg:tw-col-span-5">
        <div class="tw-flex tw-h-full tw-flex-col tw-rounded-2xl tw-bg-white tw-p-6 tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)] sm:tw-p-8">
          <div class="tw-mb-4 tw-flex tw-h-[52px] tw-w-[52px] tw-items-center tw-justify-center tw-rounded-xl tw-bg-[rgba(245,132,31,0.1)] tw-text-power">
            <svg class="tw-h-6 tw-w-6" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
          </div>
          <h3 class="tw-mb-2 tw-text-xl tw-font-bold tw-text-ink">Already a PowerCabs Driver?</h3>
          <p class="tw-mb-6 tw-text-ink/60">
            Check out the exclusive special discounts available through our
            Ambassador Programme.
          </p>

          <div class="tw-mt-auto">
            <a class="tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="<?= $assetPath ?>/ambassador-programme">
              Ambassador Programme
              <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
