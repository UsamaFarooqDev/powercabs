<section class="tw-relative tw-overflow-hidden tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-20 lg:tw-px-8">
  <div class="tw-relative tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-10 tw-text-center">
      <p class="tw-mx-auto tw-mb-0 tw-max-w-[56ch] tw-text-lg tw-text-ink/60">
        Built for Drivers Who Want More
      </p>
    </div>

    <div class="tw-mb-10 tw-grid tw-grid-cols-2 tw-divide-x tw-divide-y tw-divide-solid tw-divide-black/10 tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/10 tw-text-center md:tw-grid-cols-3 md:tw-divide-y-0">
      <div class="tw-px-4 tw-py-6">
        <p class="tw-mb-1 tw-text-3xl tw-font-bold tw-text-ink">Every Week</p>
        <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Weekly payment</p>
      </div>
      <div class="tw-px-4 tw-py-6">
        <p class="tw-mb-1 tw-text-3xl tw-font-bold tw-text-ink">0%</p>
        <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Surprise fare deductions</p>
      </div>
      <div class="tw-px-4 tw-py-6">
        <p class="tw-mb-1 tw-text-3xl tw-font-bold tw-text-ink">24/7</p>
        <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Real driver support line</p>
      </div>
    </div>

    <div class="tw-mb-6 tw-text-center">
      <h3 class="tw-mb-1 tw-text-2xl tw-font-bold tw-text-ink">Ride Types we cover</h3>
      <p class="tw-mb-0 tw-text-ink/60">One vehicle, eight ways to earn.</p>
    </div>

    <?php $driveRideCategories = [
      ['img' => 'Economy.png', 'label' => 'Economy'],
      ['img' => 'Economy-xl.png', 'label' => 'Economy XL'],
      ['img' => 'Limousine.png', 'label' => 'Limousine'],
      ['img' => 'wheelchair-taxi.png', 'label' => 'Wheelchair Taxi'],
      ['img' => 'pet-taxi.png', 'label' => 'Pet Friendly'],
      ['img' => 'courier.png', 'label' => 'Courier / Parcel'],
      ['img' => 'business.png', 'label' => 'Business'],
      ['img' => 'business-xl.png', 'label' => 'Business XL'],
    ]; ?>

    <!-- flex-wrap + justify-center (not a 5-col grid) so row two's 3
         leftover cards sit centered instead of stranded on the left. -->
    <div class="tw-flex tw-flex-wrap tw-justify-center tw-gap-4">
      <?php foreach ($driveRideCategories as $category): ?>
        <div class="tw-group tw-border tw-border-solid tw-border-white/[0.08] tw-shadow-[0_2px_4px_rgba(0,0,0,0.075)] tw-transition-[transform,box-shadow,border-color] tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-relative tw-block tw-aspect-square tw-w-[calc(50%-0.5rem)] tw-overflow-hidden tw-rounded-2xl md:tw-w-[calc(33.333%-0.667rem)] lg:tw-w-[calc(20%-0.8rem)]">
          <img src="<?= $assetPath ?>assets/img/rides-types/<?= $category['img'] ?>" alt="<?= htmlspecialchars(
  $category['label'],
) ?>" class="tw-transition-transform tw-duration-500 tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-block tw-h-full tw-w-full tw-object-cover" loading="lazy">
          <span class="tw-bg-[rgba(10,7,5,0.15)] tw-transition-opacity tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] group-hover:tw-opacity-30 motion-reduce:tw-transition-none tw-absolute tw-inset-0" aria-hidden="true"></span>
          <span class="tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.8)_0%,rgba(10,7,5,0.35)_65%,rgba(10,7,5,0)_100%)] tw-backdrop-blur-[10px] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-3 tw-pt-[2.5rem]">
            <span class="tw-transition-colors tw-duration-[450ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:tw-transition-none tw-block tw-text-sm tw-font-extrabold tw-text-white md:tw-text-base"><?= htmlspecialchars(
              $category['label'],
            ) ?></span>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
