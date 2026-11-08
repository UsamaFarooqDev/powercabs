<?php
/* The visual answer to "what do you actually move": an asymmetric collage, then an auto-scrolling
   row of the five categories, then the two flagship services in detail.
   The six icon cards that used to sit here were saying the same things as the marquee, so they
   are gone -- their content is folded into the category descriptions below. */

// One row: the luggage feature on the left, four shorter 16:10 tiles on the right, with the
// feature spanning both rows so the two sides finish level. Explicit column and row starts
// rather than auto-placement. Every file here is used once, on this page.
$idelCollage = [
  [
    'src' => 'idel-gal-luggage.webp',
    'w' => 820, 'h' => 523,
    'alt' => 'A matched set of hard-shell suitcases packed and waiting in a living room',
    'label' => 'Bags and luggage',
    'note' => 'Airport, hotel, Airbnb and oversized',
    'cell' => 'tw-col-span-2 tw-aspect-[16/10] lg:tw-col-span-6 lg:tw-col-start-1 lg:tw-row-span-2 lg:tw-row-start-1 lg:tw-aspect-auto',
  ],
  [
    'src' => 'idel-gal-shopping.webp',
    'w' => 580, 'h' => 363,
    'alt' => 'Paper shopping bags lined up ready for collection',
    'label' => 'Shopping',
    'note' => 'Collected from Dublin stores',
    'cell' => 'tw-aspect-[16/10] lg:tw-col-span-3 lg:tw-col-start-7 lg:tw-row-start-1',
  ],
  [
    'src' => 'idel-gal-equipment.webp',
    'w' => 580, 'h' => 363,
    'alt' => 'A lit mixing console and controller at a live event',
    'label' => 'Equipment',
    'note' => 'Concert, event and venue',
    'cell' => 'tw-aspect-[16/10] lg:tw-col-span-3 lg:tw-col-start-10 lg:tw-row-start-1',
  ],
  [
    'src' => 'idel-gal-office.webp',
    'w' => 580, 'h' => 363,
    'alt' => 'A laptop, notebook and work bag laid out on a desk',
    'label' => 'Office',
    'note' => 'Files, boxes, laptops and keys',
    'cell' => 'tw-aspect-[16/10] lg:tw-col-span-3 lg:tw-col-start-7 lg:tw-row-start-2',
  ],
  [
    'src' => 'idel-gal-keys.webp',
    'w' => 580, 'h' => 363,
    'alt' => 'A set of keys left hanging in a front door',
    'label' => 'Residential',
    'note' => 'Keys and forgotten belongings',
    'cell' => 'tw-aspect-[16/10] lg:tw-col-span-3 lg:tw-col-start-10 lg:tw-row-start-2',
  ],
];

// The marquee track. Rendered twice so the -50% translate loops without a seam; the clone is
// hidden from assistive tech.
$idelCategories = [
  [
    'src' => 'idel-baggage.webp',
    'title' => 'Baggage',
    'desc' => 'Airport, hotel, Airbnb and oversized luggage collections.',
  ],
  [
    'src' => 'idel-shopping.webp',
    'title' => 'Shopping',
    'desc' => 'Shopping collections and deliveries from Dublin stores.',
  ],
  [
    'src' => 'idel-equipment.webp',
    'title' => 'Equipment',
    'desc' => 'Concert, event and venue equipment collections.',
  ],
  [
    'src' => 'idel-office.webp',
    'title' => 'Office',
    'desc' => 'Files, boxes, laptops, keys and office phones.',
  ],
  [
    'src' => 'idel-residential.webp',
    'title' => 'Residential',
    'desc' => 'Lost keys, forgotten belongings and residential collections.',
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

    <?php /* Asymmetric collage: a tall feature beside a wide tile over two squares. The grid
             collapses to a 2-up mosaic on tablets and a single column on phones. */ ?>
    <ul id="idel-collage" class="tw-m-0 tw-grid tw-list-none tw-grid-cols-2 tw-gap-4 tw-p-0 lg:tw-grid-cols-12 lg:tw-gap-5">
      <?php foreach ($idelCollage as $idelTile): ?>
        <li class="tw-group tw-relative tw-overflow-hidden tw-rounded-[1.25rem] tw-bg-paper <?= $idelTile['cell'] ?>">
          <img src="<?= $assetPath ?>/assets/img/<?= htmlspecialchars($idelTile['src']) ?>"
            alt="<?= htmlspecialchars($idelTile['alt']) ?>"
            width="<?= (int) $idelTile['w'] ?>" height="<?= (int) $idelTile['h'] ?>"
            loading="lazy" decoding="async"
            class="<?= $pcImgCover ?> tw-transition-transform tw-duration-[600ms] tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-safe:group-hover:tw-scale-[1.04] motion-reduce:tw-transition-none">
          <span class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-bottom-0 tw-h-2/5 tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.78)_0%,rgba(10,7,5,0.3)_55%,rgba(10,7,5,0)_100%)]" aria-hidden="true"></span>
          <div class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-bottom-0 tw-p-4 sm:tw-p-5">
            <p class="tw-mb-0.5 tw-text-[0.95rem] tw-font-bold tw-leading-tight tw-text-white"><?= htmlspecialchars($idelTile['label']) ?></p>
            <p class="tw-mb-0 tw-text-[0.78rem] tw-leading-snug tw-text-white/70"><?= htmlspecialchars($idelTile['note']) ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

  <?php /* Auto-scrolling category row. Same mechanism as the payment-solutions testimonials:
           the track is printed twice and translated -50%, so the loop is seamless. It pauses on
           hover, and on touch devices -- which have no hover to pause with -- the animation is
           off and the row is a native snap-scroller instead. */ ?>
  <div class="tw-group tw-mt-12 tw-overflow-hidden tw-py-1 [-webkit-mask-image:linear-gradient(90deg,transparent,#000_4%,#000_96%,transparent)] [mask-image:linear-gradient(90deg,transparent,#000_4%,#000_96%,transparent)] motion-reduce:tw-overflow-x-auto [@media(hover:none)]:tw-overflow-x-auto [@media(hover:none)]:tw-snap-x [@media(hover:none)]:[scrollbar-width:none] [@media(hover:none)]:[-ms-overflow-style:none] [&::-webkit-scrollbar]:tw-hidden lg:tw-mt-14">
    <ul class="tw-m-0 tw-flex tw-w-max tw-list-none tw-animate-pc-marquee tw-p-0 [animation-duration:44s] group-hover:[animation-play-state:paused] group-focus-within:[animation-play-state:paused] motion-reduce:tw-animate-none [@media(hover:none)]:tw-animate-none">
      <?php for ($idelPass = 0; $idelPass < 2; $idelPass++): ?>
        <?php foreach ($idelCategories as $idelCat): ?>
          <li class="tw-w-[260px] tw-shrink-0 tw-snap-start tw-px-2.5 sm:tw-w-[300px]" <?= $idelPass === 1
            ? 'aria-hidden="true"'
            : '' ?>>
            <article class="tw-h-full tw-overflow-hidden tw-rounded-[1.25rem] tw-border tw-border-solid tw-border-hairline tw-bg-white tw-transition-shadow tw-duration-300 hover:tw-shadow-[0_18px_40px_-22px_rgba(28,20,16,0.45)] motion-reduce:tw-transition-none">
              <div class="tw-aspect-[16/10] tw-overflow-hidden tw-bg-paper">
                <img src="<?= $assetPath ?>/assets/img/<?= htmlspecialchars($idelCat['src']) ?>"
                  alt="" aria-hidden="true" width="300" height="188" loading="lazy" decoding="async"
                  class="<?= $pcImgCover ?>">
              </div>
              <div class="tw-p-5">
                <h3 class="tw-mb-1 tw-text-[1rem] tw-font-bold tw-leading-tight tw-text-ink"><?= htmlspecialchars($idelCat['title']) ?></h3>
                <p class="tw-mb-0 tw-text-[0.85rem] tw-leading-snug tw-text-ink/60"><?= htmlspecialchars($idelCat['desc']) ?></p>
              </div>
            </article>
          </li>
        <?php endforeach; ?>
      <?php endfor; ?>
    </ul>
  </div>

  <div class="<?= $pcContainer ?>">

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
          Collected from hotels, Airbnbs, offices, venues and other agreed premises, and delivered
          to you or another authorised recipient.
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

  </div>
</section>
