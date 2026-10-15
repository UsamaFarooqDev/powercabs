<?php
$services = [
  [
    'href' => '/ride',
    'img' => 'assets/img/service-city-tour.jpg',
    'alt' => 'A driver holding open the rear door of a car for a passenger',
    'eyebrow' => 'Everyday',
    'title' => 'Everyday Rides',
    'desc' => 'Licensed, Garda-vetted drivers across Dublin, 24/7.',
  ],
  [
    'href' => '/meet-greet',
    'img' => 'assets/img/service-airport.png',
    'alt' => 'A PowerCabs driver holding a welcome board at Dublin Airport arrivals',
    'eyebrow' => 'Airport',
    'title' => 'Meet &amp; Greet',
    'desc' => 'Flight-tracked pickups and drop-offs, any time of day.',
  ],
  [
    'href' => '/corporate-services',
    'img' => 'https://images.pexels.com/photos/4606396/pexels-photo-4606396.jpeg?auto=compress&cs=tinysrgb&w=1200',
    'alt' => 'A PowerCabs account manager reviewing a city route plan with a business team',
    'eyebrow' => 'Business',
    'title' => 'Corporate Services',
    'desc' => 'Dependable travel accounts for teams and executives.',
  ],
  [

    'href' => '/city-tours',
    'img' => 'https://images.pexels.com/photos/5057600/pexels-photo-5057600.jpeg?auto=compress&cs=tinysrgb&w=1200',
    'alt' => 'A bustling Dublin street at sunset',
    'eyebrow' => 'Sightseeing',
    'title' => 'City Tours',
    'desc' => "See Dublin's best sights with a trusted local driver.",
  ],
]; ?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mb-14 tw-grid tw-grid-cols-1 tw-items-end tw-gap-8 lg:tw-mb-20 lg:tw-grid-cols-12">
      <div class="lg:tw-col-span-7">
        <p class="<?= pc_mb($pcEyebrow, 'tw-mb-5') ?>">Services We Offer</p>
        <h2 class="<?= $pcH2 ?>">Wherever you're heading</h2>
      </div>
      <div class="lg:tw-col-span-5 lg:tw-pt-10">
        <p class="tw-mb-6 tw-max-w-[46ch] tw-text-[1.0625rem] tw-leading-[1.7] tw-text-ink/[0.62]">
          From airport transfers to executive travel and city sightseeing, PowerCabs gets you there with ease. Enjoy seamless booking, dependable service, and confidence in every journey.
        </p>
        <div class="tw-flex tw-flex-wrap tw-gap-3">
          <a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath ?>/book-ride-online">Book Online</a>
          <a class="tw-inline-flex tw-items-center tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="tel:+35312030727">Call Us</a>
        </div>
      </div>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-5 sm:tw-grid-cols-2 xl:tw-grid-cols-4 xl:tw-items-start xl:tw-gap-6">
      <?php foreach ($services as $i => $service): ?>
        <?php
        
        $stagger = 'xl:tw-h-[27rem]';

        $reveal =
          'pc-reveal tw-translate-y-6 tw-opacity-0 tw-transition-[opacity,transform] tw-duration-[600ms]' .
          ' tw-ease-[cubic-bezier(0.16,1,0.3,1)] [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100' .
          ' motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none';
        $revealDelay = ['', '[transition-delay:90ms]', '[transition-delay:180ms]', '[transition-delay:270ms]'][$i] ?? ''; ?>
        <?php  ?>
        <div class="<?= $reveal ?> <?= $revealDelay ?>">
        <a href="<?= $assetPath .
          $service[
            'href'
          ] ?>" class="tw-group tw-relative tw-block tw-aspect-[4/5] xl:tw-aspect-auto tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-no-underline tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)] tw-transition-[transform,box-shadow] tw-duration-300 tw-ease-out hover:tw-shadow-[0_24px_50px_-12px_rgba(28,20,16,0.22)] motion-reduce:tw-transition-none motion-reduce:hover:tw-transform-none <?= $stagger ?>">
          <img src="<?= $assetPath . $service['img'] ?>" alt="<?= htmlspecialchars(
  $service['alt'],
) ?>" class="tw-block tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 tw-ease-out group-hover:tw-scale-105 motion-reduce:tw-transition-none" loading="lazy">
          <span class="tw-absolute tw-inset-0 tw-bg-black/[0.15] tw-transition-opacity tw-duration-500 group-hover:tw-opacity-30 motion-reduce:tw-transition-none" aria-hidden="true"></span>
          <span class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.8)_0%,rgba(10,7,5,0.35)_65%,rgba(10,7,5,0)_100%)] tw-p-4 tw-pt-[4.5rem] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)]">
            <?php  ?>
            <span class="tw-mb-1 tw-block tw-text-[1.45rem] tw-font-bold tw-leading-tight tw-text-white tw-transition-colors tw-duration-500"><?= $service[
              'title'
            ] ?></span>
            <span class="tw-mb-0 tw-block tw-text-[0.9rem] tw-leading-[1.55] tw-text-white/70"><?= htmlspecialchars($service['desc']) ?></span>
            <span class="tw-mt-0 tw-block tw-max-h-0 tw-overflow-hidden tw-opacity-0 tw-transition-all tw-duration-700 tw-ease-out group-hover:tw-mt-[0.6rem] group-hover:tw-max-h-[3.25rem] group-hover:tw-opacity-100 group-focus-visible:tw-mt-[0.6rem] group-focus-visible:tw-max-h-[3.25rem] group-focus-visible:tw-opacity-100 motion-reduce:tw-transition-none">
              <span class="tw-group/rm tw-flex tw-items-center tw-justify-start tw-gap-1 tw-py-0.5 tw-text-[0.92rem] tw-font-medium tw-leading-none tw-text-powerlight tw-underline-offset-4 tw-transition-colors tw-duration-200">
                Read More
                <svg class="tw-h-[0.9rem] tw-w-[0.9rem] tw-shrink-0 tw-transition-transform tw-duration-200 group-hover/rm:tw-translate-x-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
              </span>
            </span>
          </span>
        </a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
