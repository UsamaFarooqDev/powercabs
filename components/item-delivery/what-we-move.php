<?php
/* Two lead services get a photo and room to explain themselves; the other six are a card grid.
   Giving all eight equal weight made the section read as a list of synonyms for "courier". */
$idelCards = [
  [
    'icon' => '<path d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.03 5.91c-.56-.1-1.16.03-1.56.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.82c0-.6.24-1.17.66-1.59l6.5-6.5c.4-.4.52-1 .43-1.56A6 6 0 1121.75 8.25z"/>',
    'title' => 'Keys &amp; spare key transfers',
    'desc' =>
      'Spare keys moved between authorised family members, tenants, landlords, property managers and workplaces.',
  ],
  [
    'icon' => '<path d="M20.25 14.15v4.07a2.25 2.25 0 01-2.01 2.24c-1.4.15-2.82.23-4.24.23-1.42 0-2.84-.08-4.24-.23a2.25 2.25 0 01-2.01-2.24v-4.07m12.5 0a2.25 2.25 0 00.9-1.8V8.7a2.25 2.25 0 00-2.02-2.24 48 48 0 00-1.38-.11M20.25 14.15c-.28.21-.6.36-.96.4-1.4.16-2.82.24-4.25.24-1.43 0-2.85-.08-4.25-.23a2.26 2.26 0 01-.95-.4M3.75 14.15a2.25 2.25 0 01-.9-1.8V8.7c0-1.16.88-2.13 2.02-2.24.46-.05.92-.08 1.38-.11m12.5 0V5.25A2.25 2.25 0 0016.5 3h-9a2.25 2.25 0 00-2.25 2.25v1.1m12.5 0a49 49 0 00-12.5 0"/>',
    'title' => 'Business &amp; office couriers',
    'desc' =>
      'Documents, laptops, office keys and equipment between offices, employees, clients and meeting locations. Ask us about repeat deliveries.',
  ],
  [
    'icon' => '<path d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.008v.008H6.75V6.75zm.375 3h.008v.008h-.008V9.75zm-.375 3h.008v.008H6.75v-.008zm3.375-6h.008v.008h-.008V6.75zm0 3h.008v.008h-.008V9.75zm0 3h.008v.008h-.008v-.008zM9 21v-3.375c0-.621.504-1.125 1.125-1.125h1.5c.621 0 1.125.504 1.125 1.125V21"/>',
    'title' => 'Hotel &amp; guest lost-and-found returns',
    'desc' =>
      'Collection and return of eligible lost property for hotels, serviced apartments, gyms and event venues.',
  ],
  [
    'icon' => '<path d="M19.5 14.25v-2.63c0-1.14-.26-2.27-.75-3.29l-1.43-2.99A2.25 2.25 0 0015.3 4.05H8.7c-.87 0-1.66.5-2.03 1.29L5.25 8.33A7.65 7.65 0 004.5 11.6v2.64m15 0a2.25 2.25 0 010 4.5H4.5a2.25 2.25 0 010-4.5m15 0h-15m4.5-9h6"/>',
    'title' => 'Urgent documents &amp; small items',
    'desc' =>
      'Paperwork, chargers, glasses and other small essentials, moved point to point.',
  ],
  [
    'icon' => '<path d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.36-1.65l1.19 12A2.25 2.25 0 0118.56 21H5.44a2.25 2.25 0 01-2.24-2.4l1.19-12a2.25 2.25 0 012.24-2.1h11.74a2.25 2.25 0 012.24 2.1z"/>',
    'title' => 'Retail &amp; personal item collection',
    'desc' =>
      'An eligible purchase collected from a shop, or an item moved between two addresses, where the collection is authorised.',
  ],
  [
    'icon' => '<path d="M17.98 19.5A48.6 48.6 0 0012 19.13c-2.03 0-4.03.13-6 .37m11.98 0a2.25 2.25 0 002.02-2.24V6.74a2.25 2.25 0 00-2.02-2.24A48.5 48.5 0 0012 4.13c-2.03 0-4.03.13-6 .37A2.25 2.25 0 004 6.74v10.52c0 1.15.88 2.12 2 2.24m11.98 0v1.88m-11.98-1.88v1.88M9.75 9.75h4.5m-4.5 3h4.5"/>',
    'title' => 'Event &amp; conference recovery',
    'desc' =>
      'Equipment, bags and work badges collected from an agreed event location and delivered to the right person.',
  ],
];
?>
<section class="<?= $pcSectionLoose ?>" id="what-we-move">
  <div class="<?= $pcContainer ?>">

    <div class="<?= $pcSectionHeadCenter ?>">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">What we move</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">What can we collect and deliver?</h2>
      <p class="<?= $pcBody ?> tw-mb-0">
        Approved items, moved point to point by the same Garda-vetted drivers who take our
        passenger journeys.
      </p>
    </div>

    <?php  ?>
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-[minmax(0,1.15fr)_minmax(0,1fr)] lg:tw-gap-20">
      <div class="tw-mx-auto tw-w-full tw-max-w-[440px] lg:tw-order-2">
        <div class="<?= $pcImgLandscape ?> tw-rounded-2xl tw-shadow-[0_20px_45px_-18px_rgba(28,20,16,0.3)]">
          <img src="<?= $assetPath ?>/assets/img/item-delivery-baggage.webp"
            alt="A traveller with a suitcase watching an aircraft take off from an airport terminal"
            width="640" height="427" loading="lazy" decoding="async"
            class="<?= $pcImgCover ?>">
        </div>
      </div>

      <div class="lg:tw-order-1">
        <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Airport excess baggage</p>
        <h3 class="<?= pc_mb($pcH2Small, 'tw-mb-3') ?>">Don&rsquo;t pay for extra luggage without checking your alternatives.</h3>
        <p class="<?= $pcBody ?> tw-mb-0 <?= $pcMeasureTight ?>">
          Rather than pay the airline, tell us where your bags are, where they need to go and when.
          We confirm availability and the price before the booking is accepted.
        </p>
      </div>
    </div>

    <?php  ?>
    <div class="tw-mt-20 tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-mt-28 lg:tw-grid-cols-[minmax(0,1fr)_minmax(0,1.15fr)] lg:tw-gap-20">
      <div class="tw-mx-auto tw-w-full tw-max-w-[440px]">
        <div class="<?= $pcImgLandscape ?> tw-rounded-2xl tw-shadow-[0_20px_45px_-18px_rgba(28,20,16,0.3)]">
          <img src="<?= $assetPath ?>/assets/img/item-delivery-forgotten.webp"
            alt="A driver carrying a parcel along a city street beside parked cars"
            width="760" height="507" loading="lazy" decoding="async"
            class="<?= $pcImgCover ?>">
        </div>
      </div>

      <div>
        <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Forgotten items &amp; lost property</p>
        <h3 class="<?= pc_mb($pcH2Small, 'tw-mb-3') ?>">Left something behind? We&rsquo;ll help you get it back.</h3>
        <p class="<?= $pcBody ?> tw-mb-5 <?= $pcMeasureTight ?>">
          Collected from hotels, offices, venues and other agreed premises, and delivered to you or
          another authorised recipient.
        </p>
        <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0">
          <?php foreach ([
            'Wallets, bags, glasses and personal belongings.',
            'Laptops, chargers and work equipment.',
            'Documents, work badges and access cards.',
            'Items left behind after meetings, events or visits.',
          ] as $idelExample): ?>
            <li class="tw-flex tw-items-start tw-gap-2.5">
              <span class="tw-mt-0.5 tw-inline-flex tw-h-5 tw-w-5 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-md tw-bg-peach tw-text-power" aria-hidden="true">
                <svg class="tw-h-3 tw-w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.2" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
              </span>
              <span class="<?= $pcBodySm ?>"><?= htmlspecialchars($idelExample) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>

    <?php  ?>
    <ul class="tw-m-0 tw-mt-20 tw-grid tw-list-none tw-grid-cols-1 tw-gap-6 tw-p-0 md:tw-grid-cols-2 lg:tw-mt-28 lg:tw-grid-cols-3">
      <?php foreach ($idelCards as $idelCard): ?>
        <li class="<?= $pcCard ?> <?= $pcCardHover ?> tw-bg-white">
          <span class="<?= $pcIconChip ?> tw-mb-4" aria-hidden="true">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><?= $idelCard['icon'] ?></svg>
          </span>
          <h3 class="<?= pc_mb($pcH4, 'tw-mb-2') ?>"><?= $idelCard['title'] ?></h3>
          <p class="<?= $pcBodySm ?> tw-mb-0"><?= $idelCard['desc'] ?></p>
        </li>
      <?php endforeach; ?>
    </ul>

  </div>
</section>
