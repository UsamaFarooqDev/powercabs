<?php
/**
 * "Corporate Fleet Portal" on /corporate-services -- a bento showcase of the
 * real portal: one hero screen, then four at half width.
 *
 * WHY NOT THE SCATTERED COLLAGE THIS REPLACED. Every screenshot here is the
 * same 1900x1030 ratio and none may be cropped, so width alone decides height.
 * Put two different widths in one row and their bottom edges cannot line up --
 * which is exactly what made the staggered version read as misalignment rather
 * than intent. A photo collage gets away with it because its pictures have
 * genuinely different shapes to interlock; identical landscape rectangles do
 * not. So the asymmetry lives BETWEEN rows (one full, then two of two), never
 * inside one, and every tile snaps to the grid.
 *
 * NOTHING IS CROPPED. Each <img> is width:100% / height:auto with no aspect
 * wrapper, so the tile is as tall as the screenshot's own proportions make it.
 * That also rules out a hover zoom -- scaling inside overflow-hidden eats the
 * edges -- so the lift is shadow and position only.
 *
 * The chrome bar is three dots and nothing else. It is what makes a flat
 * rectangle read as software rather than as a picture of software, and it
 * carries no title because the caption underneath already names the screen.
 *
 * The images are WebP converted from the supplied PNGs (1,891KB -> 435KB).
 * The PNG originals remain in assets/img/ as the source.
 */
$portalScreens = [
  [
    'label' => 'Dashboard',
    'img' => 'corporate-home.webp',
    'w' => 1918,
    'h' => 1030,
    'hero' => true,
    'alt' => 'The corporate dashboard showing total rides, active employees, total expenditure and upcoming rides, with a loyalty credit balance and a recent rides table',
  ],
  [
    'label' => 'Secure sign-in',
    'img' => 'corporate-login.webp',
    'w' => 1918,
    'h' => 1028,
    'hero' => false,
    'alt' => 'The PowerCabs Corporate Fleet Portal sign-in screen, listing real-time tracking, centralised billing, employee management, analytics and dedicated support',
  ],
  [
    'label' => 'Employees',
    'img' => 'corporate-employee.webp',
    'w' => 1895, // cropped 10px off the right: a 4px dark artefact sat on that edge
    'h' => 1027,
    'hero' => false,
    'alt' => 'The employee directory listing staff by department with their ride count and expense, and controls to add, edit or remove a person',
  ],
  [
    'label' => 'Book a ride',
    'img' => 'corporate-book-ride.webp',
    'w' => 1894, // cropped 16px off the right: a 9px dark artefact sat on that edge
    'h' => 1025,
    'hero' => false,
    'alt' => 'The booking screen with employee or guest passenger options, pickup and drop-off fields, eight ride types and a live map of Dublin',
  ],
  [
    'label' => 'Meet &amp; Greet',
    'img' => 'corporate-meet-greet.webp',
    'w' => 1900,
    'h' => 1028,
    'hero' => false,
    'alt' => 'The airport Meet and Greet booking screen with arrival and departure options and a live booking summary panel',
  ],
];
?>
<!-- ============ Corporate Fleet Portal ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">

    <div class="tw-mx-auto tw-mb-10 tw-max-w-[640px] tw-text-center md:tw-mb-12">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Corporate Fleet Portal</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Corporate Fleet Portal</h2>
      <p class="<?= $pcBody ?> tw-mb-0">
        Manage your corporate transport with ease. PowerCabs gives businesses a
        smarter way to handle rides, bookings, employees and fleet operations
        from one centralised platform.
      </p>
    </div>

    <?php /* Capped at 1080px rather than running the full 1320 container: at
             container width the hero screenshot alone stands 680px tall and
             swallows the section. One column until lg, because a half-width
             tile on a tablet is about 290px across and the UI inside it stops
             being readable -- better full width and fewer per screen. */ ?>
    <ul class="tw-m-0 tw-mx-auto tw-grid tw-max-w-[1080px] tw-list-none tw-grid-cols-1 tw-gap-5 tw-p-0 lg:tw-grid-cols-2 lg:tw-gap-6">
      <?php foreach ($portalScreens as $screen): ?>
        <li class="tw-group <?= $screen['hero'] ? 'lg:tw-col-span-2' : '' ?>">
          <?php /* The ring sits outside the radius instead of a border on the
                   same box, so it traces the rounded corner cleanly over the
                   screenshot's own white edge. The hero carries a deeper
                   shadow -- that, and its width, are the whole hierarchy. */ ?>
          <div class="tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-ring-1 tw-ring-black/[0.07] tw-transition-[transform,box-shadow] tw-duration-300 tw-ease-out group-hover:tw--translate-y-1 motion-reduce:tw-transition-none motion-reduce:group-hover:tw-transform-none <?= $screen['hero']
            ? 'tw-shadow-[0_20px_50px_-20px_rgba(28,20,16,0.28)] group-hover:tw-shadow-[0_30px_60px_-20px_rgba(28,20,16,0.38)]'
            : 'tw-shadow-[0_4px_14px_-6px_rgba(28,20,16,0.18)] group-hover:tw-shadow-[0_22px_45px_-18px_rgba(28,20,16,0.3)]' ?>">

            <div class="tw-flex tw-items-center tw-gap-1.5 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.06] tw-bg-paper-soft tw-px-4 tw-py-2.5" aria-hidden="true">
              <span class="tw-block tw-h-2 tw-w-2 tw-rounded-full tw-bg-black/[0.12]"></span>
              <span class="tw-block tw-h-2 tw-w-2 tw-rounded-full tw-bg-black/[0.12]"></span>
              <span class="tw-block tw-h-2 tw-w-2 tw-rounded-full tw-bg-black/[0.12]"></span>
            </div>

            <?php /* h-auto and no aspect wrapper: the image sets the height, so
                     the whole screen shows. width/height are the real pixel
                     dimensions, which reserves the correct box before the file
                     lands and stops the grid reflowing as each one loads. */ ?>
            <img src="<?= $assetPath ?>assets/img/<?= htmlspecialchars($screen['img']) ?>"
              alt="<?= htmlspecialchars($screen['alt']) ?>"
              width="<?= $screen['w'] ?>" height="<?= $screen['h'] ?>"
              class="tw-block tw-h-auto tw-w-full" loading="lazy" decoding="async">
          </div>
          <p class="tw-mb-0 tw-mt-3 tw-text-[0.8125rem] tw-font-semibold tw-leading-snug tw-text-ink"><?= $screen['label'] ?></p>
        </li>
      <?php endforeach; ?>
    </ul>

  </div>
</section>
