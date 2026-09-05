<section class="tw-bg-white tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-10 tw-text-center">
      <h2 class="tw-mb-2 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">You're In Control</h2>
      <p class="tw-mx-auto tw-mb-0 tw-max-w-[56ch] tw-text-ink/60">Turn preferences on or off in the Driver App and only receive the bookings that suit you.</p>
    </div>

    <?php
    // Live (hosted) photography reused from elsewhere in the project --
    // not local assets/img files.
    $driverPreferences = [
      [
        'title' => 'Fuel Savings',
        'desc' => 'Reduce one of your biggest recurring costs.',
        'img' => 'https://images.pexels.com/photos/20500733/pexels-photo-20500733.jpeg?auto=compress&cs=tinysrgb&w=900',
      ],
      [
        'title' => 'Car Wash & Valet',
        'desc' => 'Keep your workplace professional while spending less.',
        'img' => 'https://images.pexels.com/photos/8425382/pexels-photo-8425382.jpeg?auto=format&fit=crop&w=1200&q=60',
      ],
      [
        'title' => 'Lower Card Costs',
        'desc' => '0.8% partner rate* versus advertised 1.69% standard rate.',
        'img' => 'https://images.pexels.com/photos/9122014/pexels-photo-9122014.jpeg?auto=format&fit=crop&w=1200&q=60',
      ],
      [
        'title' => 'Driver Loyalty',
        'desc' => 'Build recognition and unlock benefits.',
        'img' => 'https://images.pexels.com/photos/38472818/pexels-photo-38472818.jpeg?auto=compress&cs=tinysrgb&w=900',
      ],
      [
        'title' => 'Refer & Earn €50',
        'desc' => 'Grow the family and get rewarded.',
        'img' => 'https://images.pexels.com/photos/36712857/pexels-photo-36712857.jpeg?auto=format&fit=crop&w=1200&q=60',
      ],
      [
        'title' => 'Vehicle Income',
        'desc' => 'Potential €100+ / month on eligible campaigns.',
        'img' => 'https://images.pexels.com/photos/29566899/pexels-photo-29566899.jpeg?auto=compress&cs=tinysrgb&w=1200',
      ],
    ];
    ?>

    <!-- flex-wrap + justify-center (not a 4-col grid) so the 2 leftover
         cards in row two sit centered instead of stranded on the left. -->
    <div class="tw-flex tw-flex-wrap tw-justify-center tw-gap-4">
      <?php foreach ($driverPreferences as $pref): ?>
        <div class="tw-group tw-border tw-border-solid tw-border-white/[0.08] tw-shadow-[0_2px_4px_rgba(0,0,0,0.075)] tw-transition-[transform,box-shadow,border-color] tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-relative tw-block tw-aspect-[6/5] tw-w-[calc(50%-0.5rem)] tw-overflow-hidden tw-rounded-2xl md:tw-w-[calc(33.333%-0.667rem)] lg:tw-w-[calc(25%-0.75rem)]">
          <img src="<?= htmlspecialchars($pref['img']) ?>" alt="<?= htmlspecialchars(
            $pref['title'],
          ) ?>" class="tw-transition-transform tw-duration-500 tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-block tw-h-full tw-w-full tw-object-cover" loading="lazy">
          <span class="tw-bg-[rgba(10,7,5,0.15)] tw-transition-opacity tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:tw-opacity-30 motion-reduce:tw-transition-none tw-absolute tw-inset-0" aria-hidden="true"></span>
          <span class="tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.8)_0%,rgba(10,7,5,0.35)_65%,rgba(10,7,5,0)_100%)] tw-backdrop-blur-[10px] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-3 tw-pt-[4.5rem]">
            <span class="tw-transition-colors tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-mb-1 tw-block tw-text-sm tw-font-bold tw-text-white"><?= htmlspecialchars($pref['title']) ?></span>
            <span class="tw-block tw-text-sm tw-text-white/60"><?= htmlspecialchars($pref['desc']) ?></span>
          </span>
        </div>
      <?php endforeach; ?>
    </div>

    <p class="tw-mb-0 tw-mt-6 tw-text-center tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">
      *Rates, discounts, rewards, campaigns and eligibility are subject to current partner/programme terms.
    </p>
  </div>
</section>
