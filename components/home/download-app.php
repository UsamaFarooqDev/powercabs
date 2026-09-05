<section class="tw-relative tw-z-[2] tw-mt-[clamp(-40px,-7vw,-60px)] tw-bg-[linear-gradient(90deg,#feab38_0%,#fb9e24_25%,#f58220_65%,#e86a00_100%)] tw-py-16 tw-text-ink [clip-path:polygon(0_3%,20%_1%,50%_3%,80%_1%,100%_4%,100%_90%,0_100%)] md:tw-mt-[clamp(-145px,-4vw,-195px)] md:tw-py-[120px] md:[clip-path:polygon(0_6%,8%_3%,16%_9%,50%_5%,56%_11%,90%_11%,96%_18%,100%_17%,100%_85%,0_100%)]">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2">
      <div class="lg:tw-order-2">
        <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Download the PowerCabs App for Instant Access</h2>
        <p class="tw-mb-4 tw-max-w-[46ch] tw-text-[1.1rem] tw-text-ink/70">
          Booking a cab with PowerCabs is now easier than ever. Download our app today
          from the App Store or Google Play and enjoy the convenience of booking a cab
          with just a few taps.
        </p>

        <div class="tw-mb-4 tw-flex tw-flex-wrap tw-gap-2.5">
          <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-lg tw-bg-ink tw-py-2.5 tw-pl-2.5 tw-pr-5 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="https://play.google.com/store/apps/details?id=powercabs.dublin.taxi.passenger" target="_blank" rel="noopener">
            <img src="<?= $assetPath ?>assets/img/playstore.png" alt="" width="22" height="22" aria-hidden="true">
            <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
              <span class="tw-text-[0.65rem] tw-uppercase tw-tracking-wide tw-text-white/75">Get it on</span>
              <span class="tw-text-base tw-font-bold tw-text-white">Google Play</span>
            </span>
          </a>
          <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-lg tw-bg-ink tw-py-2.5 tw-pl-3 tw-pr-5 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-bg-black" href="https://apps.apple.com/us/app/powercabs-dublin-taxi-app/id6648773981" target="_blank" rel="noopener">
            <svg class="tw-h-[22px] tw-w-[22px] tw-text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.365 1.43c0 1.14-.493 2.27-1.177 3.08-.744.88-1.99 1.56-2.987 1.56-.12 0-.24-.02-.312-.03-.014-.11-.03-.24-.03-.38 0-1.1.556-2.22 1.183-2.98.674-.82 1.888-1.44 2.882-1.48.019.083.03.163.03.24zM20.13 17.14c-.51 1.14-.75 1.65-1.42 2.65-.93 1.42-2.24 3.19-3.87 3.2-1.45.02-1.82-.94-3.79-.93-1.97.01-2.38.95-3.83.93-1.63-.02-2.87-1.61-3.8-3.03-2.6-3.96-2.87-8.6-1.27-11.08.85-1.32 2.29-2.15 3.86-2.16 1.41-.02 2.74.95 3.6.95.86 0 2.47-1.17 4.17-1 .71.03 2.7.29 3.98 2.17-.1.06-2.38 1.39-2.35 4.14.03 3.28 2.88 4.37 2.92 4.39-.03.09-.45 1.55-1.19 3.03z"/></svg>
            <span class="tw-flex tw-flex-col tw-items-start tw-leading-none">
              <span class="tw-text-[0.65rem] tw-uppercase tw-tracking-wide tw-text-white/75">Download on the</span>
              <span class="tw-text-base tw-font-bold tw-text-white">App Store</span>
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
          <div class="tw-absolute tw-left-[-8%] tw-top-[26%] tw-z-[2] tw-flex tw-items-center tw-gap-2 tw-rounded-2xl tw-bg-white/[0.92] tw-p-2 tw-shadow-[0_24px_48px_rgba(232,89,12,0.14)] tw-backdrop-blur-[10px] tw-animate-pc-float-fast [animation-delay:0.2s] motion-reduce:tw-animate-none">
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
          <div class="tw-absolute tw-bottom-[27%] tw-right-[-10%] tw-z-[2] tw-flex tw-items-center tw-gap-2 tw-rounded-2xl tw-bg-white/[0.92] tw-p-3 tw-shadow-[0_24px_48px_rgba(232,89,12,0.14)] tw-backdrop-blur-[10px] tw-animate-pc-float-fast [animation-delay:0.9s] motion-reduce:tw-animate-none">
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
