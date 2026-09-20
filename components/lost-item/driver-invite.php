<?php
/**
 * The other half of the client's brief for this page: a lost item is often
 * someone's first contact with PowerCabs, and the driver is the person who
 * actually solves it. So the page closes the loop -- what the service says
 * about the kind of drivers we want, with a route to /drive.
 *
 * Kept to one section rather than the two in the source draft: the same CTA
 * twice on one page reads as a recruitment ad, not a help page.
 */
?>
<!-- ============ Lost item: drivers ============ -->
<section class="<?= $pcSurfaceSoft ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">

      <div class="<?= $pcImgLandscape ?> tw-rounded-[1.75rem] tw-shadow-[0_30px_70px_-28px_rgba(28,20,16,0.4)]">
        <img src="<?= $assetPath ?>assets/img/meet-and-greet.webp"
          alt="A PowerCabs driver meeting a passenger at Dublin Airport arrivals"
          class="<?= $pcImgCover ?>" loading="lazy" width="1234" height="1024">
      </div>

      <div>
        <p class="<?= $pcEyebrow ?>">/ For drivers</p>
        <h2 class="<?= $pcH2 ?>">Great drivers <span class="tw-text-power">do more than drive.</span></h2>
        <p class="tw-mb-4 <?= $pcLead ?> <?= $pcMeasureTight ?>">They help.</p>
        <p class="tw-mb-4 <?= $pcBody ?> <?= $pcMeasureTight ?>">
          When a passenger leaves a phone, wallet, laptop or bag behind, the
          driver is the one person who can put it right &mdash; and the one who
          decides whether that stranger&rsquo;s day gets worse or better.
        </p>
        <p class="tw-mb-6 <?= $pcBody ?> <?= $pcMeasureTight ?>">
          PowerCabs is building a community of professional drivers who treat
          honesty and service as the job, not an extra.
        </p>

        <div class="tw-mb-7 tw-rounded-2xl tw-border-0 tw-border-l-4 tw-border-solid tw-border-power tw-bg-white tw-px-5 tw-py-4 tw-shadow-[0_8px_20px_rgba(28,20,16,0.06)]">
          <p class="tw-mb-0 tw-text-[1.02rem] tw-font-bold tw-leading-relaxed tw-text-ink">
            Power your earnings. <span class="tw-text-ink/60 tw-font-semibold">Power your reputation. Power your community.</span>
          </p>
        </div>

        <a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath ?>/drive">
          Become a PowerCabs driver
          <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
        </a>
      </div>

    </div>
  </div>
</section>
