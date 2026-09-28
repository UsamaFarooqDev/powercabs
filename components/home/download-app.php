<?php /* The app section: a CONTAINED orange panel, not a full-bleed slab.

         This was 780px of edge-to-edge orange with 120px of padding, pulled up
         under its neighbour by a negative margin and cut along the top by a
         torn clip-path polygon. Measured, it was single-handedly responsible
         for the homepage running 10.7% orange against the 5-8% a comparable
         mobility site (Bolt) keeps its brand colour to.

         Three things went:
           - the full bleed, so the orange is now an object ON the page rather
             than a band the page is interrupted by
           - the torn clip-path, which only ever existed to blend one slab into
             the next and is the kind of decorative edge that dates a page
           - the negative margin that the tear needed to hide its own seam
         The shared app banner lost the same three for the same reasons; this
         component is the homepage's own richer version (it has the phone
         mockup), which is why it did not inherit the fix.

         The copy, the badges, the mockup and its floating cards are all
         unchanged. */ ?>
<?php /* $pcSectionTight, not $pcSection: the panel carries its own padding, so
         the full section rhythm on top of it double-pads and the section came
         out TALLER than the 780px full-bleed slab it replaced. */ ?>
<section class="tw-bg-white <?= $pcSectionTight ?>">
  <div class="<?= $pcContainer ?>">
    <?php /* White, not orange.
             The section directly above this one is the dark "Two ways to work
             with PowerCabs" band, so an orange panel here put the page's two
             heaviest surfaces back to back -- dark slab, then orange slab, at
             the very end of the page. Dropping the orange leaves one dark
             moment and one bright moment on the homepage instead of two
             competing ones.

             A white panel on a white section needs something to define it, or
             it stops being a panel: a hairline and a soft shadow do that
             without adding another colour. The orange now survives only in the
             CTA and the phone mockup's own screen, which is where a brand
             colour should be doing its work. */ ?>
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-8 tw-overflow-hidden tw-bg-white tw-px-6 tw-py-9 tw-text-ink md:tw-px-12 md:tw-py-10 lg:tw-grid-cols-2">
      <div class="lg:tw-order-2">
        <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Download the PowerCabs App for Instant Access</h2>
        <p class="tw-mb-4 tw-max-w-[46ch] tw-text-[1.1rem] tw-text-ink/70">
          Booking a cab with PowerCabs is now easier than ever. Download our app today
          from the App Store or Google Play and enjoy the convenience of booking a cab
          with just a few taps.
        </p>

        <?php /* One row on a phone too, same fix as the badges on
                 download-our-app (components/download/app-cards.php). It was
                 flex-wrap and the pair came to ~328px against exactly 328px of
                 column at 360px -- so the App Store badge dropped onto its own
                 line. The widest thing in it is not the store name but the
                 eyebrow "DOWNLOAD ON THE", uppercase with tracking-wide.

                 nowrap alone would have overflowed, so the padding, gap and
                 both type sizes step down below sm and buy back ~40px. From sm
                 up nothing changes.

                 The max-[359px] step is the price of nowrap: where wrapping
                 would have dropped a badge to a second line, nowrap pushes it
                 past the column edge instead. Measured at 320px the pair came
                 to 294px against 288px of column -- 6px over. Trimming the
                 padding and gap once more below 360 gets it to 276px. The same
                 max-[...] pattern the shared banner already uses. */ ?>
        <div class="tw-mb-4 tw-flex tw-flex-nowrap tw-gap-2 sm:tw-gap-2.5">
          <a class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-lg tw-bg-ink tw-py-2.5 tw-pl-2 tw-pr-3 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black max-[359px]:tw-gap-1.5 max-[359px]:tw-pl-1.5 max-[359px]:tw-pr-2 sm:tw-gap-2.5 sm:tw-pl-2.5 sm:tw-pr-5" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
            <img class="tw-shrink-0" src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" aria-hidden="true">
            <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
              <span class="tw-whitespace-nowrap tw-text-[0.6rem] tw-uppercase tw-tracking-wide tw-text-white/75 sm:tw-text-[0.65rem]">Get it on</span>
              <span class="tw-whitespace-nowrap tw-text-[0.9rem] tw-font-bold tw-text-white sm:tw-text-base">Google Play</span>
            </span>
          </a>
          <a class="tw-inline-flex tw-items-center tw-gap-2 tw-rounded-lg tw-bg-ink tw-py-2.5 tw-pl-2.5 tw-pr-3 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black max-[359px]:tw-gap-1.5 max-[359px]:tw-pl-1.5 max-[359px]:tw-pr-2 sm:tw-gap-2.5 sm:tw-pl-3 sm:tw-pr-5" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
            <svg class="tw-h-[22px] tw-w-[22px] tw-shrink-0 tw-text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.365 1.43c0 1.14-.493 2.27-1.177 3.08-.744.88-1.99 1.56-2.987 1.56-.12 0-.24-.02-.312-.03-.014-.11-.03-.24-.03-.38 0-1.1.556-2.22 1.183-2.98.674-.82 1.888-1.44 2.882-1.48.019.083.03.163.03.24zM20.13 17.14c-.51 1.14-.75 1.65-1.42 2.65-.93 1.42-2.24 3.19-3.87 3.2-1.45.02-1.82-.94-3.79-.93-1.97.01-2.38.95-3.83.93-1.63-.02-2.87-1.61-3.8-3.03-2.6-3.96-2.87-8.6-1.27-11.08.85-1.32 2.29-2.15 3.86-2.16 1.41-.02 2.74.95 3.6.95.86 0 2.47-1.17 4.17-1 .71.03 2.7.29 3.98 2.17-.1.06-2.38 1.39-2.35 4.14.03 3.28 2.88 4.37 2.92 4.39-.03.09-.45 1.55-1.19 3.03z"/></svg>
            <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
              <span class="tw-whitespace-nowrap tw-text-[0.6rem] tw-uppercase tw-tracking-wide tw-text-white/75 sm:tw-text-[0.65rem]">Download on the</span>
              <span class="tw-whitespace-nowrap tw-text-[0.9rem] tw-font-bold tw-text-white sm:tw-text-base">App Store</span>
            </span>
          </a>
        </div>

        <p class="tw-mb-0 tw-font-bold tw-text-ink">Buckle up Ireland!</p>
      </div>

      <div class="tw-hidden lg:tw-order-1 lg:tw-block">
        <?php
        $mockupImage = 'download-app.jpeg';
        $mockupAlt = 'PowerCabs app screen showing a route from Dublin Airport to Temple Bar';
        $mockupFloat = true;
        $mockupMaxWidth = '300px';
        $mockupFloatCards = function () {
          ?>
          <!-- Live Tracking card -->
          <div class="tw-absolute tw-left-[-8%] tw-top-[26%] tw-z-[2] tw-flex tw-items-center tw-gap-2 tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-2 tw-shadow-[0_18px_40px_-12px_rgba(28,20,16,0.22)] tw-backdrop-blur-[10px] tw-animate-pc-float-fast [animation-delay:0.2s] motion-reduce:tw-animate-none">
            <div class="tw-relative tw-flex tw-h-[38px] tw-w-[38px] tw-shrink-0 tw-items-center tw-justify-center">
              <!-- <span class="tw-absolute tw-inset-0 tw-rounded-full tw-bg-power tw-animate-ping"></span> -->
              <span class="tw-relative tw-flex tw-h-[30px] tw-w-[30px] tw-items-center tw-justify-center tw-rounded-full tw-bg-power tw-text-white">
                <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M11.54 22.35a.75.75 0 00.92 0c.294-.229 7.54-5.928 7.54-12.6C20 5.246 16.418 1.5 12 1.5S4 5.246 4 9.75c0 6.672 7.246 12.371 7.54 12.6zM12 13a3.25 3.25 0 100-6.5 3.25 3.25 0 000 6.5z" clip-rule="evenodd"/></svg>
              </span>
            </div>
            <span class="tw-flex tw-flex-col tw-leading-tight">
              <strong class="tw-text-sm tw-font-bold tw-text-ink">Live Tracking</strong>
              <small class="tw-text-[0.7rem] tw-text-ink/55">Know exactly where your ride is</small>
            </span>

            <!-- Mini animated route -- a dot travels the dashed path on loop, native SVG animation, no JS -->
            <svg width="44" height="26" viewBox="0 0 44 26" class="tw-ml-auto tw-shrink-0" aria-hidden="true">
              <path id="pcMiniRoute" d="M2,22 C14,22 16,6 42,4" fill="none" stroke="#ffdcb8" stroke-width="2" stroke-dasharray="1 5" stroke-linecap="round"></path>
              <circle cx="2" cy="22" r="2.5" fill="#ffdcb8"></circle>
              <circle cx="42" cy="4" r="2.5" fill="#e8590c"></circle>
              <circle r="3" fill="#e8590c">
                <animateMotion dur="2.2s" repeatCount="indefinite">
                  <mpath href="#pcMiniRoute"></mpath>
                </animateMotion>
              </circle>
            </svg>
          </div>

          <!-- Secure Payments card -->
          <div class="tw-absolute tw-bottom-[27%] tw-right-[-10%] tw-z-[2] tw-flex tw-items-center tw-gap-2 tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-3 tw-shadow-[0_18px_40px_-12px_rgba(28,20,16,0.22)] tw-backdrop-blur-[10px] tw-animate-pc-float-fast [animation-delay:0.9s] motion-reduce:tw-animate-none">
            <div class="tw-flex tw-h-[38px] tw-w-[38px] tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[rgba(25,135,84,0.12)]">
              <svg class="tw-h-[1.05rem] tw-w-[1.05rem] tw-text-[#198754]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            </div>

            <span class="tw-flex tw-flex-col tw-leading-tight">
              <strong class="tw-text-sm tw-font-bold tw-text-ink">Secure Payments</strong>
              <span class="tw-mt-1 tw-inline-flex tw-items-center tw-gap-1">
                <svg class="tw-h-[0.6rem] tw-w-[0.6rem] tw-text-ink/50" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12 1.5a4.5 4.5 0 00-4.5 4.5v3H6a1.5 1.5 0 00-1.5 1.5v9A1.5 1.5 0 006 21h12a1.5 1.5 0 001.5-1.5v-9A1.5 1.5 0 0018 9h-1.5V6a4.5 4.5 0 00-4.5-4.5zm3 7.5V6a3 3 0 10-6 0v3h6z" clip-rule="evenodd"/></svg>
                <small class="tw-text-[0.65rem] tw-text-ink/55">
                  Secured by <span class="tw-font-semibold tw-text-[#635bff]">Stripe</span>
                </small>
              </span>
            </span>
          </div>
          <?php
        };
        require __DIR__ . '/../shared/app-mockup.php';
        ?>
      </div>
    </div>
  </div>
</section>
