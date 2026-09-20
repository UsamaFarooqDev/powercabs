<?php
/**
 * "The problem isn't finding your item -- it's finding the driver."
 *
 * The one idea the whole service rests on, so it comes first. The image is
 * the app's own driver card (name, vehicle, registration): the exact thing a
 * passenger cannot produce after a street hail, which is what they are
 * paying us to reconstruct. It is a phone screenshot, so it sits in a narrow
 * portrait frame rather than being stretched into a landscape box.
 */
?>
<!-- ============ Lost item: it's finding the driver ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-[1.05fr_0.95fr]">
      <div>
        <p class="<?= $pcEyebrow ?>">/ We can help</p>
        <h2 class="<?= $pcH2 ?>">
          Sometimes the problem isn&rsquo;t finding your item.
          <span class="tw-text-power">It&rsquo;s finding the driver.</span>
        </h2>
        <p class="tw-mb-4 <?= $pcLead ?> <?= $pcMeasureTight ?>">
          You remember getting into a taxi. You remember getting out. You just
          do not know who was driving.
        </p>
        <p class="tw-mb-6 <?= $pcBody ?> <?= $pcMeasureTight ?>">
          Tell us what you remember and our team investigates the information
          available to us to try to identify the relevant taxi or driver &mdash;
          then makes contact on your behalf where appropriate.
        </p>
        <a class="<?= $pcBtnPrimary ?>" href="#lostItemForm">
          Tell us what happened
          <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
        </a>
      </div>

      <div class="tw-flex tw-justify-center lg:tw-justify-end">
        <div class="tw-relative tw-w-full tw-max-w-[260px]">
          <span class="tw-pointer-events-none tw-absolute tw-inset-x-6 tw-bottom-[-1.25rem] tw-h-10 tw-rounded-[50%] tw-bg-ink/15 tw-blur-2xl" aria-hidden="true"></span>
          <div class="tw-relative tw-overflow-hidden tw-rounded-[2rem] tw-border-[6px] tw-border-solid tw-border-ink tw-bg-ink tw-shadow-[0_30px_70px_-20px_rgba(28,20,16,0.45)]">
            <img src="<?= $assetPath ?>assets/img/driver-ride.jpeg"
              alt="The PowerCabs app showing an assigned driver, vehicle and registration"
              width="740" height="1600"
              class="tw-block tw-h-auto tw-w-full" loading="lazy">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
