<section class="<?= $pcSurfaceSoft ?> tw-py-16 md:tw-py-24">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mb-10 tw-text-center">
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-2') ?>">You're In Control</h2>
      <p class="tw-mx-auto tw-mb-0 tw-max-w-[56ch] tw-text-ink/60">Turn preferences on or off in the Driver App and only receive the bookings that suit you.</p>
    </div>

    <?php
    // Live (hosted) photography reused from elsewhere in the project --
    // not local assets/img files.
    $driverPreferences = [
      [
        'title' => 'Fuel Savings',
        'desc' => 'Reduce one of your biggest recurring costs.',
        'img' => 'https://images.pexels.com/photos/20500734/pexels-photo-20500734.jpeg?auto=format&fit=crop&w=1200&q=60',
      ],
      [
        'title' => 'Car Wash & Valet',
        'desc' => 'Keep your workplace professional while spending less.',
        'img' => 'https://images.pexels.com/photos/10446281/pexels-photo-10446281.jpeg?auto=format&fit=crop&w=1200&q=60',
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
        'img' => 'https://images.pexels.com/photos/36766114/pexels-photo-36766114.jpeg?auto=compress&cs=tinysrgb&w=1200',
      ],
      [
        'title' => 'Vehicle Income',
        'desc' => 'Potential €100+ / month on eligible campaigns.',
        'img' => 'https://images.pexels.com/photos/7442982/pexels-photo-7442982.jpeg?auto=format&fit=crop&w=1200&q=60',
      ],
    ];
    ?>

    <!-- Three up from md, so six items are always 3+3 (and 2+2+2 on a phone).
         This was four up at lg, which left the last two centred under a row of
         four -- a deliberate fix for a ragged row, but §35 reads a short
         centred last row as accidental either way. Six divides by two and by
         three, so choosing those column counts removes the problem rather than
         centring it.

         A real grid, not flex-wrap + width calcs: with even rows there is no
         orphan left to centre, which was the only thing flex was buying. -->
    <div class="tw-grid tw-grid-cols-2 tw-gap-4 md:tw-grid-cols-3">
      <?php foreach ($driverPreferences as $pref): ?>
        <div class="tw-group tw-border tw-border-solid tw-border-hairline tw-transition-[transform,box-shadow,border-color] tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-relative tw-block tw-aspect-[6/5] tw-overflow-hidden tw-rounded-2xl">
          <img src="<?= htmlspecialchars($pref['img']) ?>" alt="<?= htmlspecialchars(
            $pref['title'],
          ) ?>" class="tw-transition-transform tw-duration-500 tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-block tw-h-full tw-w-full tw-object-cover" loading="lazy">
          <span class="tw-bg-[rgba(10,7,5,0.15)] tw-transition-opacity tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:tw-opacity-30 motion-reduce:tw-transition-none tw-absolute tw-inset-0" aria-hidden="true"></span>
          <span class="tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.62)_0%,rgba(10,7,5,0.22)_65%,rgba(10,7,5,0)_100%)] tw-backdrop-blur-[8px] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_30%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_30%)] tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-3 tw-pt-3">
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
