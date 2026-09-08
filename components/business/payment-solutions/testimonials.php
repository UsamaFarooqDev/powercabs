<?php
$paymentTestimonials = [
  ['img' => 'ali-pbs.jpg', 'quote' => 'Fast payouts and simple to use. Great for small businesses. Love using the PowerCabs Terminal.', 'name' => 'Ali', 'role' => 'Retail Store, Dublin'],
  ['img' => 'jaswinder-pbs.jpg', 'quote' => "I've saved \u{20AC}45 in just 3 months by switching to the PowerCabs Card Terminal. Customers prefer tapping their card now, and my tips have increased too.", 'name' => 'Jaswinder', 'role' => 'Taxi Driver, Kildare'],
  ['img' => 'ahmed-pbs.jpg', 'quote' => 'Setup took minutes and the support team talked me through everything. My passengers love being able to tap and go.', 'name' => 'Ahmed', 'role' => 'Taxi Driver, Dublin'],
  ['img' => 'sara-pbs.jpg', 'quote' => 'Managing payments and stock in one place has saved me hours every week. Highly recommend for any small shop.', 'name' => 'Sara', 'role' => 'Shop Owner, Galway'],
];
/* Back to an infinite marquee, at the client's request. It replaced one for a
   while -- the argument being that a 25-word quote cannot be read before it
   slides away, which a logo strip does not have to worry about. Three things
   here are what make it readable anyway, and they are the parts to leave
   alone:

   - it pauses on hover, so a quote that catches the eye can be finished;
   - 60s over a ~3,200px half is ~53px/s, matching trust-strip.php's pace
     rather than the snappier default the animation ships with;
   - prefers-reduced-motion stops it dead and turns the rail into a plain
     horizontal scroller, which is also how it behaves for anyone driving it
     by touch.

   FOUR copies of the list, not two. The animation runs 0 -> -50%, so the
   track has to be two identical halves and each half has to be at least as
   wide as the viewport or a gap opens at the right edge mid-loop. Four
   testimonials at ~400px is a 1,600px half -- fine on a laptop, visibly
   broken on a 1920px monitor. Two copies per half (8 cards, ~3,200px) clears
   every desktop width. Only the first half is exposed to assistive tech; the
   rest is aria-hidden decoration. */
$paymentTestimonialsHalf = array_merge($paymentTestimonials, $paymentTestimonials);
$paymentTestimonialsTrack = array_merge($paymentTestimonialsHalf, $paymentTestimonialsHalf);
$paymentTestimonialsRealCount = count($paymentTestimonialsHalf);
?>
<section class="tw-overflow-hidden <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[720px] tw-text-center">
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">
        Trusted by Drivers &amp; Businesses
        <span class="tw-text-power">Across Ireland</span>
      </h2>
      <p class="tw-mb-0 tw-text-lg tw-text-ink/60">
        Real experiences from drivers and businesses using PowerCabs
        payment solutions every day.
      </p>
    </div>
  </div>

  <!-- Full-bleed, deliberately outside $pcContainer: a marquee that stops at
       the container's edge reads as a broken carousel rather than a rail
       running past the page. The mask feathers both ends so cards fade out
       instead of being sliced off by the viewport.

       py-2 gives the cards' shadows somewhere to land -- without it the
       overflow-hidden above clips them flat. -->
  <div class="tw-group tw-overflow-hidden tw-py-2 [-webkit-mask-image:linear-gradient(90deg,transparent,#000_5%,#000_95%,transparent)] [mask-image:linear-gradient(90deg,transparent,#000_5%,#000_95%,transparent)] motion-reduce:tw-overflow-x-auto">
    <div class="tw-flex tw-w-max tw-animate-pc-marquee [animation-duration:60s] group-hover:[animation-play-state:paused] motion-reduce:tw-animate-none">
      <?php foreach ($paymentTestimonialsTrack as $tIndex => $t): ?>
        <div class="tw-w-[290px] tw-shrink-0 tw-px-2.5 sm:tw-w-[330px] lg:tw-w-[370px]" <?= $tIndex >=
        $paymentTestimonialsRealCount
          ? 'aria-hidden="true"'
          : '' ?>>
          <article class="tw-relative tw-flex tw-h-full tw-flex-col tw-overflow-hidden tw-rounded-[22px] tw-bg-white tw-shadow-[0_4px_14px_rgba(20,25,35,0.045)]">
            <div class="tw-absolute tw-inset-x-0 tw-top-0 tw-h-[2px] tw-bg-power"></div>

            <div class="tw-flex tw-h-full tw-flex-col tw-p-6">
              <div class="tw-mb-4 tw-flex tw-items-center tw-justify-between">
                <div class="tw-flex tw-items-center tw-gap-1 tw-text-power" aria-label="5 out of 5 stars">
                  <?php for ($starIdx = 0; $starIdx < 5; $starIdx++): ?>
                    <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                  <?php endfor; ?>
                </div>
              </div>

              <div class="tw-mb-4 tw-flex tw-gap-3">
                <div class="tw-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[rgba(245,132,31,0.1)] tw-text-power">
                  <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M7.17 6.17A5.75 5.75 0 003 11.75v5.5A1.75 1.75 0 004.75 19h3.5A1.75 1.75 0 0010 17.25v-3.5A1.75 1.75 0 008.25 12h-2c.12-1.94 1.15-3.3 2.7-4.13a.75.75 0 00-.28-1.4l-.5-.3zm10 0a5.75 5.75 0 00-4.17 5.58v5.5A1.75 1.75 0 0014.75 19h3.5A1.75 1.75 0 0020 17.25v-3.5A1.75 1.75 0 0018.25 12h-2c.12-1.94 1.15-3.3 2.7-4.13a.75.75 0 00-.28-1.4l-.5-.3z"/></svg>
                </div>
                <p class="tw-mb-0 tw-text-[15px] tw-leading-[1.7] tw-text-ink/80"><?= htmlspecialchars($t['quote']) ?></p>
              </div>

              <div class="tw-mt-auto tw-flex tw-items-center tw-gap-3 tw-border-0 tw-border-t tw-border-solid tw-border-black/[0.08] tw-pt-3">
                <img src="<?= $assetPath ?>assets/img/<?= $t['img'] ?>" alt="<?= htmlspecialchars($t['name']) ?>" class="tw-h-[52px] tw-w-[52px] tw-shrink-0 tw-rounded-full tw-border-2 tw-border-solid tw-border-[rgba(245,132,31,0.15)] tw-object-cover" loading="lazy">

                <div class="tw-min-w-0">
                  <div class="tw-flex tw-items-center tw-gap-2">
                    <span class="tw-font-bold tw-text-ink"><?= htmlspecialchars($t['name']) ?></span>
                    <svg class="tw-h-3.5 tw-w-3.5 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" title="Verified customer"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.49 4.49 0 01-1.307 3.497 4.49 4.49 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                  </div>
                  <span class="tw-mt-1 tw-block tw-text-sm tw-text-ink/60"><?= htmlspecialchars($t['role']) ?></span>
                </div>
              </div>
            </div>
          </article>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
