<?php
/* This section used to be a standalone "Power Your Every Journey" statement.
   It now carries the "Why PowerCabs" content that previously lived in
   components/home/why-choose-us.php -- same editorial structure (a hairline
   rule with a brand marker, a muted index, title, copy), moved onto this
   section's photographic background.

   `#why-choose` and the `pc-why-item` classname move with it: they are the
   JS selector hooks initWhyChooseReveal() in main.js queries ("#why-choose
   .pc-why-item", toggling .is-visible on scroll). They must exist exactly
   once on the page, which is why index.php no longer requires
   why-choose-us.php.

   Colours are the one thing that could not carry over unchanged -- the
   original used tw-text-ink on a pale background, which is unreadable on
   this dark photo, so every value has its white counterpart here. */
$whyChooseItems = [
  ['title' => 'Easy Booking', 'desc' => "Enter your pickup and drop-off locations, select your ride, you're all set."],
  ['title' => 'Affordable Rates', 'desc' => 'Competitive rates for all our rides, ensuring great value for your money.'],
  ['title' => 'Safe and Reliable', 'desc' => 'All drivers are licensed and experienced; vehicles are regularly inspected.'],
  ['title' => '24/7 Service', 'desc' => "Need a ride any time of day or night? We're always here for you."],
];
// Approximates the original 0/80/160/240ms stagger on Tailwind's delay scale.
$revealDelays = ['tw-delay-0', 'tw-delay-75', 'tw-delay-150', 'tw-delay-200'];
?>
<!-- bg-scroll, not bg-fixed: the image now scrolls with the page like every
     other section rather than pinning behind it. -->
<!-- The photo is 1536x1024, i.e. 3:2. With bg-cover the image is cropped on
     whichever axis is proportionally longer, so a short section crops it
     vertically -- which is why only half of it was showing. min-h-[66.7vw]
     makes the section's own aspect match the image's (height = 2/3 of the
     full-bleed width), so cover has nothing left to crop. Below lg the
     section is too narrow for that to work, so it falls back to a
     content-driven height and accepts the crop.

     Content is pushed to the bottom (flex + justify-end) so the image reads
     above it. The large bottom padding is deliberate: the next section
     (download-app) pulls itself up by as much as 195px with a negative
     margin so its torn polygon edge overlaps this image -- without the
     padding that polygon would sit on top of the four columns. -->
<section id="why-choose" class="tw-relative tw-flex tw-flex-col tw-justify-end tw-overflow-hidden tw-bg-scroll tw-bg-cover tw-bg-center tw-text-white tw-pt-20 tw-pb-28 md:tw-pt-28 md:tw-pb-[15rem] lg:tw-min-h-[66.7vw] tw-bg-[url('/assets/img/welcome-section-bg.png')]">
  <span class="tw-absolute tw-inset-0 tw-bg-[linear-gradient(120deg,rgba(18,18,18,0.62)_0%,rgba(232,89,12,0.5)_55%,rgba(255,122,0,0.38)_100%)]" aria-hidden="true"></span>

  <!-- The blur sits only over the lower half, masked so it fades in rather
       than starting on a hard edge -- it quietens the busiest part of the
       photo so the four columns stay readable. Kept OUTSIDE the animated
       wrapper below: a backdrop-filter inside a transforming ancestor gets
       re-rasterised on the first frame and flashes un-blurred. -->
  <span class="tw-pointer-events-none tw-absolute tw-inset-x-0 tw-bottom-0 tw-h-[52%] tw-bg-[linear-gradient(to_top,rgba(18,18,18,0.5),transparent)] tw-backdrop-blur-[7px] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_38%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_38%)]" aria-hidden="true"></span>

  <div class="tw-relative <?= $pcContainer ?>">

    <div class="tw-mb-14 tw-max-w-[38ch] tw-animate-pc-fade-up-slow motion-reduce:tw-animate-none md:tw-mb-20">
      <h2 class="tw-mb-0 tw-text-[clamp(2rem,4.4vw,3.25rem)] tw-font-bold tw-leading-[1.12] tw-tracking-[-0.02em] tw-text-white [text-shadow:0_4px_26px_rgba(0,0,0,0.5),0_1px_4px_rgba(0,0,0,0.3)]">
        Built for every journey
      </h2>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-gap-x-10 tw-gap-y-12 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
      <?php foreach ($whyChooseItems as $index => $item): ?>
        <div class="pc-why-item tw-translate-y-6 tw-opacity-0 tw-transition-all tw-duration-500 tw-ease-out <?= $revealDelays[
          $index
        ] ?? '' ?> [&.is-visible]:tw-translate-y-0 [&.is-visible]:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-transition-none">

          <!-- The rule is the column's own top border so it starts and ends
               exactly with the column; the marker sits on it at the left. -->
          <div class="tw-relative tw-mb-6 tw-h-px tw-w-full tw-bg-white/25">
            <span class="tw-absolute tw-left-0 tw-top-1/2 tw-h-[7px] tw-w-[7px] -tw-translate-y-1/2 tw-bg-powerlight" aria-hidden="true"></span>
          </div>

          <p class="tw-mb-4 tw-text-[0.85rem] tw-font-medium tw-tabular-nums tw-tracking-[0.1em] tw-text-white/50">
            <?= sprintf('%02d', $index + 1) ?>
          </p>

          <h3 class="tw-mb-3 tw-text-[1.1875rem] tw-font-bold tw-leading-snug tw-tracking-[-0.01em] tw-text-white [text-shadow:0_2px_14px_rgba(0,0,0,0.35)]">
            <?= htmlspecialchars($item['title']) ?>
          </h3>

          <p class="tw-mb-0 tw-max-w-[34ch] tw-text-[1.0625rem] tw-leading-[1.65] tw-text-white/[0.82] [text-shadow:0_1px_10px_rgba(0,0,0,0.3)]">
            <?= htmlspecialchars($item['desc']) ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
</section>
