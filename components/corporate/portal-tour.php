<?php
$portalScreens = [
  [
    'label' => 'Secure sign-in',
    'title' => 'One portal for your company transport',
    'desc' => 'Administrators sign in to a portal of your own. Access is per-person, so you decide who can book and who can see the spend.',
    'img' => 'corporate-login.webp',
    'w' => 1918,
    'h' => 1028,
    'alt' => 'The PowerCabs Corporate Fleet Portal sign-in screen, listing real-time tracking, centralised billing, employee management, analytics and dedicated support',
  ],
  [
    'label' => 'Dashboard',
    'title' => 'The whole account on one screen',
    'desc' => 'Rides taken, people active on the account, what has been spent and what is still to come, above a searchable list of recent journeys.',
    'img' => 'corporate-home.webp',
    'w' => 1918,
    'h' => 1030,
    'alt' => 'The corporate dashboard showing total rides, active employees, total expenditure and upcoming rides, with a loyalty credit balance and a recent rides table',
  ],
  [
    'label' => 'Employees',
    'title' => 'Add people, set departments, see their spend',
    'desc' => 'Everyone who can travel on the account, grouped by department, with the rides and spend attributed to each of them.',
    'img' => 'corporate-employee.webp',
    'w' => 1895, 
    'h' => 1027,
    'alt' => 'The employee directory listing staff by department with their ride count and expense, and controls to add, edit or remove a person',
  ],
  [
    'label' => 'Book a ride',
    'title' => 'Book for an employee, a guest, or both',
    'desc' => 'Pick the passenger, set pickup and drop-off, and choose the vehicle. Book it now or schedule it for later.',
    'img' => 'corporate-book-ride.webp',
    'w' => 1894, 
    'h' => 1025,
    'alt' => 'The booking screen with employee or guest passenger options, pickup and drop-off fields, eight ride types and a live map of Dublin',
  ],
  [
    'label' => 'Meet &amp; Greet',
    'title' => 'Airport arrivals, handled properly',
    'desc' => 'Book a meet-and-greet for a client or an executive and watch the booking build beside you, airport to drop-off.',
    'img' => 'corporate-meet-greet.webp',
    'w' => 1900,
    'h' => 1028,
    'alt' => 'The airport Meet and Greet booking screen with arrival and departure options and a live booking summary panel',
  ],
];

$pcPortalArrow =
  'tw-absolute tw-top-1/2 tw-z-10 tw--translate-y-1/2 tw-hidden tw-h-10 tw-w-10 tw-cursor-pointer tw-appearance-none tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-text-ink tw-shadow-[0_6px_18px_-6px_rgba(28,20,16,0.3)] tw-transition tw-duration-200 hover:tw-border-power/40 hover:tw-text-power disabled:tw-cursor-default disabled:tw-opacity-35 disabled:hover:tw-border-black/[0.08] disabled:hover:tw-text-ink [.is-ready_&]:tw-inline-flex motion-reduce:tw-transition-none lg:tw-h-11 lg:tw-w-11';
?>
<section class="<?= $pcSurfaceSoft ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">

    <?php  ?>
    <div class="tw-mb-9 tw-grid tw-grid-cols-1 tw-gap-5 lg:tw-grid-cols-12 lg:tw-items-end lg:tw-gap-12">
      <div class="lg:tw-col-span-7">
        <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Corporate Fleet Portal</p>
        <h2 class="<?= pc_mb($pcH2, 'tw-mb-0') ?> tw-max-w-[20ch]">
          The portal behind every corporate account.
        </h2>
      </div>
      <div class="lg:tw-col-span-5">
        <p class="<?= $pcBody ?> tw-mb-0">
          Manage your corporate transport from one place &mdash; rides,
          bookings, employees and spend, on a single centralised platform.
        </p>
      </div>
    </div>

    <?php  ?>
    <div class="tw-mx-auto tw-max-w-[900px]" data-pc-portal-slider>

      <?php  ?>
      <div class="tw--mx-4 tw-mb-5 tw-overflow-x-auto tw-px-4 [scrollbar-width:none] [&::-webkit-scrollbar]:tw-hidden sm:tw-mx-0 sm:tw-px-0">
        <div class="tw-flex tw-w-max tw-gap-1 tw-rounded-full tw-border tw-border-solid tw-border-black/[0.07] tw-bg-white tw-p-1 tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]"
          data-pc-portal-tablist aria-label="Corporate Fleet Portal screens">
          <?php foreach ($portalScreens as $i => $screen): ?>
            <button type="button" id="pcPortalTab<?= $i ?>" data-pc-portal-tab
              class="tw-cursor-pointer tw-appearance-none tw-whitespace-nowrap tw-rounded-full tw-border-0 tw-bg-transparent tw-px-4 tw-py-2 tw-font-[inherit] tw-text-[0.8125rem] tw-font-semibold tw-text-ink/55 tw-transition tw-duration-200 hover:tw-text-ink [&.is-active]:tw-bg-power [&.is-active]:tw-text-white motion-reduce:tw-transition-none">
              <?= $screen['label'] ?>
            </button>
          <?php endforeach; ?>
        </div>
      </div>

      <?php  ?>
      <p class="tw-mb-5 tw-max-w-[76ch] tw-text-[0.95rem] tw-leading-[1.6] tw-text-muted">
        <strong class="tw-font-semibold tw-text-ink" data-pc-portal-title><?= $portalScreens[0]['title'] ?>.</strong>
        <span data-pc-portal-desc><?= $portalScreens[0]['desc'] ?></span>
      </p>

      <div class="tw-relative">
        <button type="button" class="<?= $pcPortalArrow ?> tw--left-3 lg:tw--left-5" data-pc-portal-prev aria-label="Previous screen">
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 6l-6 6 6 6"/></svg>
        </button>
        <button type="button" class="<?= $pcPortalArrow ?> tw--right-3 lg:tw--right-5" data-pc-portal-next aria-label="Next screen">
          <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 6l6 6-6 6"/></svg>
        </button>

        <div class="tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-shadow-[0_24px_55px_-25px_rgba(28,20,16,0.35)] tw-ring-1 tw-ring-black/[0.07]">

          <div class="tw-flex tw-items-center tw-gap-3 tw-border-0 tw-border-b tw-border-solid tw-border-black/[0.07] tw-bg-paper-soft tw-px-4 tw-py-2.5">
            <span class="tw-flex tw-shrink-0 tw-gap-1.5" aria-hidden="true">
              <span class="tw-block tw-h-2.5 tw-w-2.5 tw-rounded-full tw-bg-black/[0.12]"></span>
              <span class="tw-block tw-h-2.5 tw-w-2.5 tw-rounded-full tw-bg-black/[0.12]"></span>
              <span class="tw-block tw-h-2.5 tw-w-2.5 tw-rounded-full tw-bg-black/[0.12]"></span>
            </span>
            <span class="tw-mx-auto tw-flex tw-items-center tw-gap-1.5 tw-rounded-full tw-bg-white tw-px-3 tw-py-1 tw-text-[0.72rem] tw-font-medium tw-text-ink/50">
              <svg class="tw-h-3 tw-w-3 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 118 0v4"/></svg>
              PowerCabs Corporate Fleet Portal
            </span>
            <span class="tw-w-[46px] tw-shrink-0" aria-hidden="true"></span>
          </div>

          <?php  ?>
          <div class="[.is-ready_&]:tw-flex [.is-ready_&]:tw-transition-transform [.is-ready_&]:tw-duration-500 [.is-ready_&]:tw-ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:[.is-ready_&]:tw-transition-none"
            data-pc-portal-track>
            <?php foreach ($portalScreens as $i => $screen): ?>
              <div class="tw-w-full tw-shrink-0" id="pcPortalPanel<?= $i ?>" data-pc-portal-slide
                data-title="<?= htmlspecialchars(strip_tags(html_entity_decode($screen['title'], ENT_QUOTES, 'UTF-8'))) ?>"
                data-desc="<?= htmlspecialchars(strip_tags(html_entity_decode($screen['desc'], ENT_QUOTES, 'UTF-8'))) ?>">
                <img src="<?= $assetPath ?>assets/img/<?= htmlspecialchars($screen['img']) ?>"
                  alt="<?= htmlspecialchars($screen['alt']) ?>"
                  width="<?= $screen['w'] ?>" height="<?= $screen['h'] ?>"
                  class="tw-block tw-h-auto tw-w-full" <?= $i === 0
                    ? 'fetchpriority="low"'
                    : 'loading="lazy"' ?> decoding="async">
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <?php  ?>
      <div class="tw-mt-6 tw-hidden tw-items-center tw-justify-center tw-gap-2 [.is-ready_&]:tw-flex" data-pc-portal-dots>
        <?php foreach ($portalScreens as $i => $screen): ?>
          <button type="button" data-pc-portal-dot="<?= $i ?>"
            class="tw-h-2 tw-w-2 tw-cursor-pointer tw-appearance-none tw-rounded-full tw-border-0 tw-bg-ink/20 tw-p-0 tw-transition-all tw-duration-300 hover:tw-bg-ink/40 [&.is-active]:tw-w-7 [&.is-active]:tw-bg-power motion-reduce:tw-transition-none"
            aria-label="Go to <?= htmlspecialchars(html_entity_decode($screen['label'], ENT_QUOTES, 'UTF-8')) ?>"></button>
        <?php endforeach; ?>
      </div>

      <?php  ?>
      <p class="tw-sr-only" aria-live="polite" data-pc-portal-status></p>

    </div>
  </div>
</section>
<script src="<?= $assetPath ?>assets/js/components/corporate-slider.js?v=<?= @filemtime(
  __DIR__ . '/../../assets/js/components/corporate-slider.js',
) ?>"></script>
