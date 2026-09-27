<?php
/**
 * Homepage §10 -- the driver ecosystem.
 *
 * Placed this late on purpose. The brief is explicit: do not mix driver
 * recruitment into the rider narrative too early. Everything above this point
 * is addressed to someone who wants a taxi; this is the one block addressed
 * to someone who wants to drive one, and it is the last thing before the app
 * CTA closes the page.
 *
 * Kept to a headline, two lines and one button -- /drive is where the
 * earnings, requirements and eight-step application live, and duplicating any
 * of that here is exactly the repetition §52 warns about.
 */
?>
<section class="tw-relative tw-overflow-hidden tw-bg-ink tw-text-white">
  <div class="tw-grid tw-grid-cols-1 lg:tw-grid-cols-2">

    <?php /* Photo first in the DOM so it is the top half on a phone, where a
             face works harder than a headline; the grid order flips it back
             on desktop. */ ?>
    <div class="tw-relative tw-min-h-[260px] lg:tw-order-2 lg:tw-min-h-[520px]">
      <img src="<?= $assetPath ?>assets/img/welcome-section-bg.webp"
        alt="A PowerCabs driver at the wheel, the app mounted on the dashboard."
        width="1536" height="825" loading="lazy" decoding="async"
        class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover">
      <?php /* Only on desktop: on a phone the photo sits above the copy, so a
               left-to-right fade would darken the wrong edge. */ ?>
      <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-hidden tw-bg-[linear-gradient(90deg,#111111_0%,rgba(17,17,17,0.55)_35%,transparent_75%)] lg:tw-block" aria-hidden="true"></span>
    </div>

    <div class="tw-flex tw-items-center lg:tw-order-1">
      <div class="tw-w-full tw-px-5 tw-py-16 sm:tw-px-8 md:tw-py-24 lg:tw-py-28 lg:tw-pl-12 lg:tw-pr-16 xl:tw-pl-16">
        <div class="tw-ml-auto tw-max-w-[520px] lg:tw-mr-0 lg:tw-max-w-[480px]">
          <p class="<?= $pcEyebrowOnDark ?>">Drive with PowerCabs</p>
          <h2 class="<?= $pcH2OnDark ?> tw-max-w-[14ch]">Make the city your workplace.</h2>
          <p class="<?= $pcBodyOnDark ?> tw-mb-8 tw-max-w-[40ch]">
            Work the hours that suit you, keep more of what you earn, and get
            support from a team in the same city.
          </p>
          <a class="<?= $pcBtnPrimaryOnDark ?>" href="<?= $assetPath ?>/drive">Become a driver</a>
        </div>
      </div>
    </div>
  </div>
</section>
