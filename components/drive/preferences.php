<section class="<?= $pcSurfaceWhite ?> tw-py-16 md:tw-py-24">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[680px] tw-text-center md:tw-mb-12">
      <p class="<?= $pcEyebrow ?>">Driver Benefits</p>
      <h2 class="<?= pc_mb($pcH2Display, 'tw-mb-3') ?>">
        Spend less on the car. <span class="tw-text-power">Earn more from it.</span>
      </h2>
      <?php  ?>
      <p class="<?= $pcLead ?> tw-mx-auto tw-mb-3 tw-max-w-[52ch]">
        We are always working to bring more value to the drivers on the
        platform.
      </p>
      <p class="<?= $pcBody ?> tw-mx-auto tw-mb-0 tw-max-w-[54ch]">
        Partner rates on the costs you already carry &mdash; fuel, valeting and
        card terminals &mdash; plus valet vouchers, referrals and paid branding
        campaigns that earn you money beyond the meter.
      </p>
    </div>

    <?php
    $driverBenefits = [
      [
        'title' => 'Fuel Savings',
        'desc' => 'Reduce one of your biggest recurring costs.',
        'img' => 'https://images.pexels.com/photos/20500734/pexels-photo-20500734.jpeg?auto=format&fit=crop&w=1200&q=60',
        'frame' => 'tw-aspect-[4/5]',
      ],
      [
        'title' => 'Car Wash & Valet',
        'desc' => 'Keep your workplace professional while spending less.',
        'img' => 'https://images.pexels.com/photos/10446281/pexels-photo-10446281.jpeg?auto=format&fit=crop&w=1200&q=60',
        'frame' => 'tw-aspect-[5/4]',
      ],
      [
        'title' => 'Lower Card Costs',
        'desc' => '0.8% partner rate* versus advertised 1.69% standard rate.',
        'img' => 'https://images.pexels.com/photos/9122014/pexels-photo-9122014.jpeg?auto=format&fit=crop&w=1200&q=60',
        'frame' => 'tw-aspect-square',
      ],
      [
        'title' => 'Driver Loyalty',
        'desc' => 'Build recognition and unlock benefits.',
        'img' => 'https://images.pexels.com/photos/38472818/pexels-photo-38472818.jpeg?auto=compress&cs=tinysrgb&w=900',
        'frame' => 'tw-aspect-[5/4]',
      ],
      [
        'title' => 'Refer & Earn €50',
        'desc' => 'Grow the family and get rewarded.',
        'img' => 'https://images.pexels.com/photos/36766114/pexels-photo-36766114.jpeg?auto=compress&cs=tinysrgb&w=1200',
        'frame' => 'tw-aspect-[4/5]',
      ],
      [
        'title' => 'Vehicle Income',
        'desc' => 'Potential €100+ / month on eligible campaigns.',
        'img' => 'https://images.pexels.com/photos/7442982/pexels-photo-7442982.jpeg?auto=format&fit=crop&w=1200&q=60',
        'frame' => 'tw-aspect-[5/4]',
      ],
    ];
    ?>
    <div class="tw-columns-2 tw-gap-3 sm:tw-gap-4 lg:tw-columns-3">
      <?php foreach ($driverBenefits as $benefit): ?>
        <figure class="tw-group tw-mb-3 tw-break-inside-avoid sm:tw-mb-4">
          <div class="<?= $benefit['frame'] ?> tw-relative tw-overflow-hidden tw-rounded-xl tw-bg-paper">
            <img src="<?= htmlspecialchars($benefit['img']) ?>" alt="<?= htmlspecialchars($benefit['title']) ?>"
              class="<?= $pcImgCover ?> tw-block tw-transition-transform tw-duration-[600ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:tw-scale-[1.04] motion-reduce:tw-transition-none motion-reduce:group-hover:tw-scale-100"
              loading="lazy">
          </div>
          <figcaption class="tw-px-0.5 tw-pt-3">
            <span class="tw-block tw-text-[0.9375rem] tw-font-bold tw-leading-snug tw-text-ink sm:tw-text-base"><?= htmlspecialchars(
              $benefit['title'],
            ) ?></span>
            <span class="<?= $pcBodySm ?> tw-mt-0.5 tw-block"><?= htmlspecialchars($benefit['desc']) ?></span>
          </figcaption>
        </figure>
      <?php endforeach; ?>
    </div>

    <?php  ?>
    <div class="tw-mt-10 tw-text-center md:tw-mt-12">
      <p class="<?= $pcBodySm ?> tw-mx-auto tw-mb-2.5 tw-max-w-[46ch]">
        Perks that help you maximise your earnings while you drive with us.
      </p>
      <p class="tw-mb-0 tw-text-[1.0625rem] tw-font-bold tw-tracking-[-0.01em] tw-text-ink">
        PowerCabs &mdash; <span class="tw-text-power">Power Your Earnings.</span>
      </p>
    </div>

  </div>
</section>
