<?php
/**
 * Prominent "talk to a human" band -- a phone number big enough to be the
 * loudest thing on the band, on the dark surface so it separates from the
 * white sections around it.
 *
 * PowerCabs runs three separate support lines and they are NOT
 * interchangeable, so this component deliberately takes one number rather
 * than listing them all: a driver reading /drive should not have to work out
 * which of three numbers is theirs. Each page sets its own.
 *
 * Variables, set before the require (same convention as final-cta.php):
 *
 *   $supportEyebrow   small label above the heading        (required)
 *   $supportHeading   the headline                         (required)
 *   $supportText      one supporting sentence              (required)
 *   $supportNumber    human formatting, e.g. +353 89 965 4467
 *   $supportTel       digits for the tel: href, no spaces
 *   $supportHours     availability line; defaults to 24/7
 *   $supportWhatsapp  optional wa.me URL, rendered as a second action
 *
 * NOTE ON THE NUMBERS. Irish mobiles carry nine national digits
 * (+353 8X XXX XXXX). All three lines below are nine:
 *
 *   customer  +353 89 972 8089  -> 899728089
 *   driver    +353 89 965 4467  -> 899654467
 *   business  +353 89 958 6092  -> 899586092
 *
 * Each page's WhatsApp action goes to that page's own line: /ride uses
 * wa.me/353899728089 (the customer number, also the footer's WhatsApp),
 * /drive uses wa.me/353899654467 (the driver number) and /business uses
 * wa.me/353899586092 (the business number). If any line ever changes,
 * change it on the page that sets it -- there is no copy of them in here.
 */

$supportHours = $supportHours ?? 'Lines open 24/7, every day of the year.';
$supportWhatsapp = $supportWhatsapp ?? '';

// tel: must carry digits only. Built from $supportTel rather than stripping
// $supportNumber, so the displayed formatting can change freely without any
// risk of altering what actually gets dialled.
$supportTelHref = preg_replace('/[^0-9+]/', '', $supportTel);
?>
<section class="tw-relative tw-overflow-hidden tw-bg-ink tw-text-white <?= $pcSectionTight ?>">
  <?php /* Two brand glows, the same device the Business hero and the 404 use.
           They are what stop a flat ink slab reading as a footer. */ ?>
  <span class="tw-pointer-events-none tw-absolute tw-right-[-8rem] tw-top-[-6rem] tw-h-[26rem] tw-w-[26rem] tw-rounded-full tw-bg-[radial-gradient(circle,rgba(255,122,0,0.28),transparent_70%)] tw-blur-[70px]" aria-hidden="true"></span>
  <span class="tw-pointer-events-none tw-absolute tw-bottom-[-9rem] tw-left-[-7rem] tw-h-[22rem] tw-w-[22rem] tw-rounded-full tw-bg-[radial-gradient(circle,rgba(232,89,12,0.2),transparent_70%)] tw-blur-[70px]" aria-hidden="true"></span>

  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-8 lg:tw-grid-cols-[1fr_auto] lg:tw-gap-12">

      <div>
        <p class="<?= $pcEyebrowOnDark ?>">/ <?= htmlspecialchars($supportEyebrow) ?></p>
        <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-white md:tw-text-4xl">
          <?= htmlspecialchars($supportHeading) ?>
        </h2>
        <p class="tw-mb-0 tw-max-w-[46ch] tw-text-[1.0625rem] tw-leading-[1.7] tw-text-white/[0.68]">
          <?= htmlspecialchars($supportText) ?>
        </p>
      </div>

      <?php /* The number IS the call to action, so it is the largest type in
               the band and the whole block is the tap target -- not a button
               sitting next to a number you then have to select by hand. On a
               phone this is one tap to dial.

               aria-label spells out what the link does, because "+353 89 965
               4467" read aloud on its own does not say it dials anyone. */ ?>
      <div class="tw-w-full tw-rounded-3xl tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-p-6 tw-backdrop-blur-xl sm:tw-p-7 lg:tw-w-auto lg:tw-min-w-[22rem]">
        <div class="tw-mb-4 tw-flex tw-items-center tw-gap-3">
          <span class="tw-inline-flex tw-h-11 tw-w-11 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-powerlight tw-text-white">
            <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 01-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"/></svg>
          </span>
          <span class="tw-text-[0.72rem] tw-font-semibold tw-uppercase tw-tracking-[0.14em] tw-text-white/50">
            <?= htmlspecialchars($supportEyebrow) ?>
          </span>
        </div>

        <a class="tw-group tw-block tw-no-underline"
          href="tel:<?= htmlspecialchars($supportTelHref) ?>"
          aria-label="Call <?= htmlspecialchars($supportEyebrow) ?> on <?= htmlspecialchars($supportNumber) ?>">
          <span class="tw-block tw-text-[clamp(1.6rem,4.5vw,2.25rem)] tw-font-extrabold tw-leading-none tw-tracking-[-0.02em] tw-text-white tw-transition-colors tw-duration-200 motion-reduce:tw-transition-none">
            <?= htmlspecialchars($supportNumber) ?>
          </span>
          <span class="tw-mt-2.5 tw-inline-flex tw-items-center tw-gap-1.5 tw-text-sm tw-font-semibold tw-text-powerlight">
            Tap to call
            <svg class="tw-h-3.5 tw-w-3.5 tw-shrink-0 tw-transition-transform tw-duration-200 group-hover:tw-translate-x-0.5 motion-reduce:tw-transition-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </span>
        </a>

        <?php if ($supportWhatsapp !== ''): ?>
          <a class="tw-mt-5 tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-full tw-border tw-border-solid tw-border-white/15 tw-bg-white/[0.06] tw-py-1.5 tw-pl-1.5 tw-pr-4 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-border-[#25d366]/60 hover:tw-bg-white/10 motion-reduce:tw-transition-none"
            href="<?= htmlspecialchars($supportWhatsapp) ?>" target="_blank" rel="noopener">
            <span class="tw-flex tw-h-7 tw-w-7 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[#25d366] tw-text-white">
              <svg class="tw-h-3.5 tw-w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.71 14.02c-.24.68-1.38 1.3-1.9 1.38-.49.08-1.1.11-1.77-.11-.41-.13-.94-.31-1.62-.6-2.85-1.23-4.71-4.09-4.85-4.28-.14-.19-1.16-1.54-1.16-2.94 0-1.4.73-2.09.99-2.37.26-.28.57-.35.76-.35h.55c.18 0 .41-.07.64.49.24.57.81 1.97.88 2.11.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.28.71 1.17 1.52 1.9 1.04.94 1.92 1.23 2.19 1.37.28.14.44.12.6-.07.16-.19.68-.79.86-1.06.18-.28.36-.23.6-.14.24.09 1.53.72 1.79.85.26.14.44.21.5.32.07.12.07.68-.17 1.35z"/></svg>
            </span>
            <span class="tw-text-[0.85rem] tw-font-semibold tw-text-white">Or message on WhatsApp</span>
          </a>
        <?php endif; ?>

        <p class="tw-mb-0 tw-mt-5 tw-border-0 tw-border-t tw-border-solid tw-border-white/10 tw-pt-4 tw-text-[0.85rem] tw-text-white/45">
          <?= htmlspecialchars($supportHours) ?>
        </p>
      </div>

    </div>
  </div>
</section>
<?php
/* Cleared so a later require of this component on the same page cannot
   inherit the previous one's number -- the same reason final-cta.php unsets
   its variables. */
unset($supportEyebrow, $supportHeading, $supportText, $supportNumber, $supportTel, $supportHours, $supportWhatsapp, $supportTelHref);
