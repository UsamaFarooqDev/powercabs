<?php
/* PLACEHOLDER COPY -- replace with real, attributable reviews before this goes live. The quotes
   below were written to show the layout, not to report anything a customer actually said.
   Overriding $cityTourTestimonials from the page (or emptying it) is all it takes: an empty
   array renders nothing at all rather than an empty shell. */
$cityTourTestimonials = $cityTourTestimonials ?? [
  [
    'quote' =>
      'We had one day in Dublin and no idea how to fit everything in. Our driver planned the route around what we wanted to see and waited at every stop. Far easier than a coach tour.',
    'name' => 'Megan R.',
    'place' => 'Day tour, Dublin',
  ],
  [
    'quote' =>
      'Booked by the hour for my parents&rsquo; visit. Having the same car and driver all afternoon meant we could change our minds twice and nobody minded.',
    'name' => 'Cillian B.',
    'place' => 'Pay per hour, Dublin',
  ],
  [
    'quote' =>
      'Cliffs of Moher and back in a day with three kids. Clean car, child seats ready, and the driver knew exactly when to leave to beat the crowds.',
    'name' => 'Priya N.',
    'place' => 'Full day tour, Co. Clare',
  ],
];

if ($cityTourTestimonials):
  ?>
<section class="<?= $pcSection ?>" id="tour-testimonials">
  <div class="<?= $pcContainer ?>">
    <div data-motion-stagger="fade-up" class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Travellers</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">What our tour guests say</h2>
      <p class="<?= $pcBody ?> tw-mb-0">
        A private car, a local driver and a day that runs at your pace.
      </p>
    </div>

    <ul data-motion-stagger="fade-up" class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-5 tw-p-0 md:tw-grid-cols-3">
      <?php foreach ($cityTourTestimonials as $t): ?>
        <li class="<?= $pcCard ?> tw-flex tw-flex-col tw-bg-white">
          <svg class="tw-mb-4 tw-h-7 tw-w-7 tw-shrink-0 tw-text-power/30" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M9.17 6A6.5 6.5 0 003 12.5V18h6.5v-5.5H6.6c.1-1.9 1.3-3.2 3.1-3.6L9.17 6zm9 0A6.5 6.5 0 0012 12.5V18h6.5v-5.5h-2.9c.1-1.9 1.3-3.2 3.1-3.6L18.17 6z"/></svg>
          <blockquote class="tw-m-0 tw-mb-5 tw-flex-1">
            <p class="<?= $pcBodySm ?> tw-mb-0 tw-italic">&ldquo;<?= $t['quote'] ?>&rdquo;</p>
          </blockquote>
          <div class="tw-flex tw-items-center tw-gap-3 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-pt-4">
            <span class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-peach tw-text-[0.8rem] tw-font-bold tw-text-power" aria-hidden="true"><?= htmlspecialchars(mb_substr($t['name'], 0, 1)) ?></span>
            <div class="tw-min-w-0">
              <p class="tw-mb-0 tw-text-[0.9rem] tw-font-bold tw-leading-tight tw-text-ink"><?= htmlspecialchars($t['name']) ?></p>
              <p class="tw-mb-0 tw-text-[0.82rem] tw-leading-tight tw-text-ink/50"><?= htmlspecialchars($t['place']) ?></p>
            </div>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

    <div data-motion="fade-up" class="tw-mt-8 tw-text-center">
      <a class="<?= $pcBtnGhost ?>" href="<?= $assetPath ?>/positive-feedback-form">
        Share Your Experience
        <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
  </div>
</section>
<?php
endif;
