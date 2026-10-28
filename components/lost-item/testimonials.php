<?php
/* Static for now, matching the reference. If these ever become database-driven, keep this array
   as the fallback: the section renders nothing at all rather than an empty shell when it is empty. */
$lostItemTestimonials = $lostItemTestimonials ?? [
  [
    'quote' => 'I left my phone in a taxi after a night out and didn&rsquo;t know which company it was. PowerCabs searched through their driver network and found it within a day. I couldn&rsquo;t believe it!',
    'name' => 'Sarah M.',
    'place' => 'Dublin',
  ],
  [
    'quote' => 'I lost my handbag on the way to the airport. I wasn&rsquo;t even sure which taxi firm I used. The team were so helpful and kept me updated. My bag was returned to me and I&rsquo;m so grateful.',
    'name' => 'James T.',
    'place' => 'Cork',
  ],
  [
    'quote' => 'I thought I&rsquo;d never see my wallet again. I didn&rsquo;t know the taxi company, but PowerCabs still managed to find the driver. The service was professional, friendly and really reassuring.',
    'name' => 'Aoife L.',
    'place' => 'Galway',
  ],
];

if ($lostItemTestimonials):
  ?>
<section class="<?= $pcSection ?>" id="testimonials">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mb-10 tw-max-w-[60ch]">
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">What Our Customers Say</h2>
      <p class="<?= $pcBody ?> tw-mb-0">
        The most meaningful measure of our service is what our customers say about their experience.
      </p>
    </div>

    <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-5 tw-p-0 md:tw-grid-cols-3">
      <?php foreach ($lostItemTestimonials as $t): ?>
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

    <div class="tw-mt-8 tw-text-center">
      <a class="<?= $pcBtnGhost ?>" href="<?= $assetPath ?>/positive-feedback-form">
        Share Your Experience
        <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
  </div>
</section>
<?php
endif;
