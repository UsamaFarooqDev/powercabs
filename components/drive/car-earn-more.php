<?php

$carEarnCards = [
  [
    'step' => '01',
    'title' => 'Drive',
    'desc' => 'Every trip keeps your car on the road and earning.',
    'img' => 'assets/img/driver-earn-more.png',
  ],
  [
    'step' => '02',
    'title' => 'Advertise',
    'desc' => 'Turn your vehicle into a moving billboard seen across Dublin.',
    'img' => 'https://images.pexels.com/photos/33794255/pexels-photo-33794255.jpeg?auto=compress&cs=tinysrgb&w=1200',
  ],
  [
    'step' => '03',
    'title' => 'Earn',
    'desc' => 'Get paid extra for eligible campaigns, on top of your fares.',
    'img' => 'https://images.pexels.com/photos/6289026/pexels-photo-6289026.jpeg',
  ],
]; ?>
<!-- ============ Your Car Can Earn More ============ -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[640px] tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-bold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Your Car Can Earn More</p>
      <h2 class="tw-mb-0 tw-text-[clamp(2rem,3.6vw,2.8rem)] tw-font-bold tw-text-ink">Drive. Advertise. <span class="tw-text-power">Earn.</span></h2>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-3 lg:tw-gap-6">
      <?php foreach ($carEarnCards as $card): ?>
        <div class="tw-group tw-border tw-border-solid tw-border-white/[0.08] tw-shadow-[0_2px_4px_rgba(0,0,0,0.075)] tw-transition-[transform,box-shadow,border-color] tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-relative tw-block tw-aspect-[3/2] tw-overflow-hidden tw-rounded-2xl">
          <img src="<?= str_starts_with(
            $card['img'],
            'http',
          )
            ? htmlspecialchars($card['img'])
            : $assetPath . htmlspecialchars($card['img']) ?>" alt="<?= htmlspecialchars(
  $card['title'],
) ?>" class="tw-transition-transform tw-duration-500 tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-block tw-h-full tw-w-full tw-object-cover" loading="lazy">
          <span class="tw-bg-[rgba(10,7,5,0.15)] tw-transition-opacity tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:tw-opacity-30 motion-reduce:tw-transition-none tw-absolute tw-inset-0" aria-hidden="true"></span>

          <span class="tw-absolute tw-left-3 tw-top-3 tw-rounded-full tw-bg-power tw-px-3 tw-py-1 tw-text-[0.68rem] tw-font-semibold tw-tracking-[0.04em] tw-text-white">
            Step <?= htmlspecialchars($card['step']) ?>
          </span>

          <span class="tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.8)_0%,rgba(10,7,5,0.35)_65%,rgba(10,7,5,0)_100%)] tw-backdrop-blur-[10px] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-4 tw-pt-[4.5rem] md:tw-p-5 md:tw-pt-[4.5rem]">
            <span class="tw-mb-1 tw-block tw-text-2xl tw-font-bold tw-tracking-[-0.01em] tw-text-white"><?= htmlspecialchars(
              $card['title'],
            ) ?></span>
            <span class="tw-block tw-text-sm tw-text-white/60"><?= htmlspecialchars($card['desc']) ?></span>
          </span>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="tw-mx-auto tw-mt-10 tw-max-w-[640px] tw-text-center">
      <p class="tw-mb-4 tw-text-ink/60">
        Eligible drivers can participate in approved vehicle marketing campaigns
        and potentially earn <strong class="tw-text-ink">&euro;100+ per month</strong>,
        depending on campaign and eligibility.
      </p>
      <a href="<?= $assetPath ?>/ambassador-programme" class="tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]">
        Ask About Vehicle Campaigns
        <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 011.06 0l6.5 6.5a.75.75 0 010 1.06l-6.5 6.5a.75.75 0 11-1.06-1.06L14.19 12 8.22 6.03a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
      </a>
    </div>
  </div>
</section>
