<?php
$idelCare = [
  [
    'title' => 'Professional, Garda-vetted drivers',
    'desc' =>
      'Every item is handled by a professional driver who has undergone Garda vetting.',
    'icon' => '<path d="M9 12.75L11.25 15 15 9.75m-3-7.04a12 12 0 01-8.62 3.04 12 12 0 00-.38 3 12 12 0 009 11.62 12 12 0 009-11.62 12 12 0 00-.38-3A12 12 0 0112 2.71z"/>',
  ],
  [
    'title' => 'Tracking and journey visibility',
    'desc' =>
      'Book through the PowerCabs app for live tracking where supported. Delivery updates may be available on other bookings too.',
    'icon' => '<path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.14-7.5 11.25-7.5 11.25S4.5 17.64 4.5 10.5a7.5 7.5 0 1115 0z"/>',
  ],
  [
    'title' => 'Clear collection and delivery details',
    'desc' =>
      'Tell us what, where and who. We confirm the arrangements before proceeding, and confirm again on delivery.',
    'icon' => '<path d="M9 12h3.75M9 15h3.75M9 18h3.75m3-13.5H18a2.25 2.25 0 012.25 2.25v12A2.25 2.25 0 0118 21H6a2.25 2.25 0 01-2.25-2.25v-12A2.25 2.25 0 016 4.5h2.25m7.5 0v.75a.75.75 0 01-.75.75h-6a.75.75 0 01-.75-.75V4.5m7.5 0a.75.75 0 00-.75-.75h-6a.75.75 0 00-.75.75"/>',
  ],
  [
    'title' => 'Convenient booking',
    'desc' =>
      'Urgent or pre-booked, through whichever of our booking channels suits you.',
    'icon' => '<path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>',
  ],
];
?>
<section class="<?= $pcSectionLoose ?>" id="care">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-12 lg:tw-grid-cols-12 lg:tw-gap-20">

      <div class="lg:tw-col-span-5">
        <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Why PowerCabs</p>
        <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Your belongings deserve care.</h2>
        <p class="<?= $pcBody ?> tw-mb-7 <?= $pcMeasureTight ?>">
          The same drivers, dispatch team and support line that run our passenger journeys &mdash;
          pointed at the thing you need moved instead of the person.
        </p>
        <div class="tw-w-full tw-max-w-[400px]">
          <div class="<?= $pcImgLandscape ?> tw-rounded-2xl tw-shadow-[0_20px_45px_-18px_rgba(28,20,16,0.3)]">
            <img src="<?= $assetPath ?>/assets/img/item-delivery-care.webp"
              alt="A driver handing a parcel to a customer in a doorway"
              width="760" height="507" loading="lazy" decoding="async"
              class="<?= $pcImgCover ?>">
          </div>
        </div>
      </div>

      <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-5 tw-p-0 sm:tw-grid-cols-2 lg:tw-col-span-7">
        <?php foreach ($idelCare as $idelPoint): ?>
          <li class="<?= $pcCard ?> tw-bg-white">
            <span class="<?= $pcIconChip ?> tw-mb-4" aria-hidden="true">
              <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><?= $idelPoint['icon'] ?></svg>
            </span>
            <h3 class="<?= pc_mb($pcH4, 'tw-mb-2') ?>"><?= htmlspecialchars($idelPoint['title']) ?></h3>
            <p class="<?= $pcBodySm ?> tw-mb-0"><?= htmlspecialchars($idelPoint['desc']) ?></p>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>
  </div>
</section>
