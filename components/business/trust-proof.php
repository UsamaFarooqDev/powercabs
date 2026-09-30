<?php
$bizTrustMarkers = [
  ['icon' => 'badge', 'label' => 'NTA License DH12616'],
  ['icon' => 'shield', 'label' => 'Garda-Vetted Drivers'],
  ['icon' => 'headset', 'label' => '24/7 Business Support'],
];

function pc_biz_trust_icon(string $icon): void
{
  switch ($icon):
    case 'badge': ?>
      <svg class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'headset': ?>
      <svg class="tw-h-[1.1rem] tw-w-[1.1rem]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 13.5v-1.75a7.5 7.5 0 0115 0v1.75M4.5 13.5a1.75 1.75 0 00-1.75 1.75v1a1.75 1.75 0 001.75 1.75h.75a1 1 0 001-1v-3.5a1 1 0 00-1-1h-.75zm15 0a1.75 1.75 0 011.75 1.75v1a1.75 1.75 0 01-1.75 1.75h-.75a1 1 0 01-1-1v-3.5a1 1 0 011-1h.75zM18 18v.75a2.25 2.25 0 01-2.25 2.25h-2.25"/></svg>
    <?php break;
  endswitch;
}
?>
<section class="<?= $pcSurfaceWhite ?> tw-py-16 md:tw-py-24">
  <div class="<?= $pcContainer ?>">
    <figure class="tw-m-0 tw-mx-auto tw-max-w-[46rem] tw-text-center">
      <?php /* aria-hidden: the mark is punctuation the <blockquote> already
               carries semantically, and read aloud it is just noise. */ ?>
      <span class="tw-mb-[-0.35em] tw-block tw-font-bold tw-leading-none tw-text-power/40 tw-text-[clamp(4rem,9vw,6rem)]" aria-hidden="true">&ldquo;</span>

      <blockquote class="tw-m-0 tw-p-0">
        <p class="tw-mb-0 tw-text-[clamp(1.375rem,3vw,2.125rem)] tw-font-semibold tw-leading-[1.35] tw-tracking-[-0.015em] tw-text-ink">
          Every PowerCabs Business account runs on the same standard we hold
          every ride to &mdash; licensed, vetted drivers, one simple account,
          and a team that actually answers the phone.
        </p>
      </blockquote>

      <figcaption class="tw-mt-7">
        <span class="tw-mx-auto tw-mb-4 tw-block tw-h-px tw-w-10 tw-bg-power" aria-hidden="true"></span>
      </figcaption>
    </figure>
  </div>
</section>
