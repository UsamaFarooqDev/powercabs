<?php
/**
 * "Corporate Fleet Portal" on /corporate-services -- centred copy over a
 * single full-width row of the five real portal screens.
 *
 * FULL BLEED, ON PURPOSE. The strip sits OUTSIDE $pcContainer and carries its
 * own gutters, so it spans the viewport rather than the 1320px content column.
 * With five tiles in one row that width is the whole design: inside the
 * container each tile is about 238px, outside it about 262px at 1440 and 347px
 * at 1920. Capped at 1800px so an ultrawide monitor does not stretch the row
 * into a letterbox.
 *
 * NOTHING IS CROPPED. Each <img> is width:100% / height:auto with no aspect
 * wrapper, so each tile is exactly as tall as the screenshot's own 1900x1030
 * proportions make it -- which is why all five are the same height without
 * anything being forced. It also rules out a hover zoom: scaling inside
 * overflow-hidden eats the edges. The lift is shadow and position only.
 *
 * AT THIS SIZE THESE ARE AN IMPRESSION, NOT A READABLE UI. That is the trade
 * a five-across row makes and it cannot be argued away -- 262px of a 1900px
 * screenshot is about a seventh scale. The alt text is written out in full so
 * the substance of each screen is still on the page, and the label under each
 * tile says what it is.
 *
 * The chrome bar is three dots and nothing else: it is what makes a small flat
 * rectangle read as software rather than as a thumbnail, and it carries no
 * title because the caption underneath already names the screen.
 *
 * The images are WebP converted from the supplied PNGs. corporate-employee and
 * corporate-book-ride are additionally trimmed 10px and 16px off the right,
 * where a dark artefact sat on the edge.
 */
$portalScreens = [
  [
    'label' => 'Secure sign-in',
    'span' => 'lg:tw-col-span-2',
    'img' => 'corporate-login.webp',
    'w' => 1918,
    'h' => 1028,
    'alt' => 'The PowerCabs Corporate Fleet Portal sign-in screen, listing real-time tracking, centralised billing, employee management, analytics and dedicated support',
  ],
  [
    'label' => 'Dashboard',
    'span' => 'lg:tw-col-span-2',
    'img' => 'corporate-home.webp',
    'w' => 1918,
    'h' => 1030,
    'alt' => 'The corporate dashboard showing total rides, active employees, total expenditure and upcoming rides, with a loyalty credit balance and a recent rides table',
  ],
  [
    'label' => 'Employees',
    'span' => 'lg:tw-col-span-2',
    'img' => 'corporate-employee.webp',
    'w' => 1895, // cropped 10px off the right: a 4px dark artefact sat on that edge
    'h' => 1027,
    'alt' => 'The employee directory listing staff by department with their ride count and expense, and controls to add, edit or remove a person',
  ],
  [
    'label' => 'Book a ride',
    'span' => 'lg:tw-col-span-2 lg:tw-col-start-2',
    'img' => 'corporate-book-ride.webp',
    'w' => 1894, // cropped 16px off the right: a 9px dark artefact sat on that edge
    'h' => 1025,
    'alt' => 'The booking screen with employee or guest passenger options, pickup and drop-off fields, eight ride types and a live map of Dublin',
  ],
  [
    'label' => 'Meet &amp; Greet',
    'span' => 'lg:tw-col-span-2',
    'img' => 'corporate-meet-greet.webp',
    'w' => 1900,
    'h' => 1028,
    'alt' => 'The airport Meet and Greet booking screen with arrival and departure options and a live booking summary panel',
  ],
];
?>
<!-- ============ Corporate Fleet Portal ============ -->
<section class="<?= $pcSurfaceSoft ?> <?= $pcSection ?>">

  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-max-w-[640px] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Corporate Fleet Portal</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Corporate Fleet Portal</h2>
      <p class="<?= $pcBody ?> tw-mb-0">
        Manage your corporate transport with ease. PowerCabs gives businesses a
        smarter way to handle rides, bookings, employees and fleet operations
        from one centralised platform.
      </p>
    </div>
  </div>

  <?php /* Deliberately a sibling of the container above, not a child: that is
           what lets the row run wider than the text. Same gutter scale as
           $pcContainer so the outer tiles still line up with the page's edge
           padding rather than touching the screen.

           1 -> 2 -> 5. No three-column stage: five items in three columns
           leaves a two-item orphan row, and below lg a fifth of the width is
           too narrow for a tile to be worth showing at all. */ ?>
  <div class="tw-mx-auto tw-mt-10 tw-max-w-[1800px] tw-px-4 sm:tw-px-6 md:tw-mt-12 lg:tw-px-8">
    <?php /* SIX columns, giving 3 + 2. Five across put each tile at 262px on a
             1440 screen, too small to be worth looking at. Every tile is
             col-span-2, so all five are the same width -- about 445px at 1440
             -- and the row of three sets the size the row of two matches,
             instead of the pair ballooning to half the width each.

             col-start-2 on the fourth tile centres the pair beneath the three.
             Without it they sit left and leave a hole at the bottom right.

             Six is the smallest number both 3 and 2 divide into, the same
             reason meet-greet.php's form grid uses it. */ ?>
    <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-4 tw-p-0 sm:tw-grid-cols-2 lg:tw-grid-cols-6 lg:tw-gap-5">
      <?php foreach ($portalScreens as $screen): ?>
        <?php /* flex column + mt-auto on the caption. The five sources are not
                 quite the same ratio (1918x1028, 1895x1027, 1894x1025 ...), so
                 uncropped tiles land 1-2px apart in height and the captions sat
                 on five slightly different baselines. Grid items already
                 stretch to the row height; pushing the caption to the bottom of
                 that box lines all five up, and the leftover pixel or two goes
                 into the gap above it where nobody can see it. Cropping to a
                 shared ratio would also fix it, and is not worth losing content
                 over. */ ?>
        <li class="tw-group tw-flex tw-h-full tw-flex-col <?= $screen['span'] ?>">
          <?php /* The ring sits outside the radius instead of a border on the
                   same box, so it traces the rounded corner cleanly over the
                   screenshot's own white edge. rounded-xl rather than 2xl:
                   a 16px radius on a 262px tile is proportionally heavier than
                   the same radius on a full-width one. */ ?>
          <div class="tw-overflow-hidden tw-rounded-xl tw-bg-white tw-shadow-[0_2px_8px_-2px_rgba(28,20,16,0.14)] tw-ring-1 tw-ring-black/[0.07] tw-transition-[transform,box-shadow] tw-duration-300 tw-ease-out group-hover:tw--translate-y-1 group-hover:tw-shadow-[0_18px_34px_-14px_rgba(28,20,16,0.32)] group-hover:tw-ring-black/[0.12] motion-reduce:tw-transition-none motion-reduce:group-hover:tw-transform-none">

            <div class="tw-flex tw-items-center tw-gap-1 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06] tw-bg-paper-soft tw-px-2.5 tw-py-1.5" aria-hidden="true">
              <span class="tw-block tw-h-1.5 tw-w-1.5 tw-rounded-full tw-bg-black/[0.13]"></span>
              <span class="tw-block tw-h-1.5 tw-w-1.5 tw-rounded-full tw-bg-black/[0.13]"></span>
              <span class="tw-block tw-h-1.5 tw-w-1.5 tw-rounded-full tw-bg-black/[0.13]"></span>
            </div>

            <?php /* h-auto and no aspect wrapper: the image sets the height, so
                     the whole screen shows. width/height are the real pixel
                     dimensions, which reserves the correct box before the file
                     lands and stops the row reflowing as each one loads. */ ?>
            <img src="<?= $assetPath ?>assets/img/<?= htmlspecialchars($screen['img']) ?>"
              alt="<?= htmlspecialchars($screen['alt']) ?>"
              width="<?= $screen['w'] ?>" height="<?= $screen['h'] ?>"
              class="tw-block tw-h-auto tw-w-full" loading="lazy" decoding="async">
          </div>
          <p class="tw-mb-0 tw-mt-auto tw-pt-2.5 tw-text-center tw-text-[0.78rem] tw-font-semibold tw-leading-snug tw-text-ink/[0.75] tw-transition-colors tw-duration-300 group-hover:tw-text-ink motion-reduce:tw-transition-none"><?= $screen['label'] ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>

</section>
