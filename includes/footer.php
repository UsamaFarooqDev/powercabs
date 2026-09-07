</main>

<!-- Decides the desktop footer-reveal BEFORE the footer is first painted.
     This is the site's largest Core Web Vitals problem and it has one cause:
     syncFooterHeightVar() in main.js adds .pc-footer-reveal on DOMContentLoaded
     and again on load, and that class flips the footer from normal flow to
     position:fixed. By then the footer has already been laid out and painted
     at the bottom of the document, so it teleports the full height of itself
     -- measured at CLS 0.52 on the homepage and 0.64 on /ride, against
     Google's 0.1 "good" threshold, with the footer accounting for 99% of it.

     Running the same test here works because this point in the document is
     after </main> (so <main> is parsed and measurable) but before the <footer>
     element exists (so it has never been laid out in flow). The condition is
     identical to the one in syncFooterHeightVar, which still runs afterwards
     and still owns resize and PJAX -- this only removes the first, visible
     flip. Inline and synchronous on purpose: a deferred script would run after
     paint and change nothing.

     For the record, the 44 content images without width/height attributes are
     NOT a meaningful contributor -- they measured 0.004 combined, because the
     design system's aspect-ratio wrappers ($pcImgLandscape and friends)
     already reserve the space. -->
<script>
  (function () {
    try {
      var main = document.querySelector('main');
      if (main && main.getBoundingClientRect().height >= window.innerHeight) {
        document.documentElement.classList.add('pc-footer-reveal');
      }
    } catch (e) {
      /* Leave it to syncFooterHeightVar; a failure here costs layout shift,
         never the footer itself. */
    }
  })();
</script>

<?php
$assetPath = $assetPath ?? '';

/* The footer runs on the dark surface -- the one place the site commits to
   ink full-bleed. It anchors the page, and it is what the desktop
   footer-reveal (base.css) scrolls <main> up off, which only reads as
   deliberate when the panel behind is clearly a different surface.

   Link markup used to be a ~400-character class attribute copy-pasted onto
   all 17 links. It is one recipe now: change the hover here and every column
   follows. */
$fLink =
  'tw-relative tw-inline-block tw-py-0.5 tw-text-[0.92rem] tw-text-white/[0.6] tw-no-underline ' .
  'tw-transition-colors tw-duration-200 hover:tw-text-white ' .
  "after:tw-absolute after:tw-bottom-0 after:tw-left-0 after:tw-h-px after:tw-w-full after:tw-origin-left " .
  "after:tw-scale-x-0 after:tw-bg-powerlight after:tw-transition-transform after:tw-duration-300 " .
  "after:tw-content-[''] hover:after:tw-scale-x-100 motion-reduce:after:tw-transition-none";
$fColTitle = 'tw-mb-4 tw-text-[0.72rem] tw-font-semibold tw-uppercase tw-tracking-[0.14em] tw-text-white/40';
$fList = 'tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2.5 tw-p-0';

/* Below md each link group is an accordion row instead of a column. Four
   columns of five links each is 21 tappable lines of footer under every page
   on a phone -- longer than most of the pages themselves, and it pushed the
   legal band and the social links so far down that nobody scrolled to them.
   Collapsed, the same four groups are four rows.

   The mechanism is ui.js's collapse helper, which already does exclusive
   accordions (data-pc-collapse-parent) -- opening one closes the other, which
   is what was asked for. data-pc-collapse-media is new: it confines all of
   that to the phone breakpoint, so from md up these are untouched <ul>s in a
   grid with no toggle and no inline height. See collapseIsActive() in ui.js
   for why that gate has to live in JS rather than in a CSS override. */
$fAccordionMedia = '(max-width: 767.98px)';
$fGroupToggle =
  'tw-group tw-flex tw-w-full tw-appearance-none tw-items-center tw-justify-between tw-gap-4 tw-border-0 ' .
  'tw-bg-transparent tw-px-0 tw-py-4 tw-text-left tw-text-[0.72rem] tw-font-semibold tw-uppercase ' .
  'tw-tracking-[0.14em] tw-text-white/70 tw-transition-colors tw-duration-200 hover:tw-text-white';
$fLegal =
  'tw-text-[0.85rem] tw-text-white/50 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-text-white';
$fSocial =
  'tw-flex tw-h-9 tw-w-9 tw-items-center tw-justify-center tw-rounded-full tw-bg-white/[0.08] tw-text-white/70 tw-transition-colors tw-duration-200 hover:tw-bg-power hover:tw-text-white';

// The four groups the nav is organised around, so footer and header agree.
$footerNav = [
  'Get Started' => [
    '/book-ride-online' => 'Book a Ride',
    '/ride' => 'Ride with Us',
    '/download-our-app' => 'Download App',
    '/city-tours' => 'City Tours',
    '/wheelchair-accessible-taxis' => 'Wheelchair Accessible Taxis',
  ],
  'Business &amp; Drivers' => [
    '/business' => 'Business Travel',
    '/corporate-services' => 'Corporate Services',
    '/business-solutions' => 'Business Solutions',
    '/drive' => 'Drive with PowerCabs',
    '/partner-programme' => 'Partner Programme',
    '/ambassador-programme' => 'Ambassador Programme',
  ],
  'Safety &amp; Policies' => [
    '/safety-tips-riders' => 'Rider Safety',
    '/safety-tips-drivers' => 'Driver Safety',
    '/sustainability' => 'Sustainability',
    '/loyalty-program' => 'Loyalty Program',
    '/faqs' => 'FAQs',
  ],
  'Contact' => [
    '/contact-us' => 'Contact Us',
    '/about-us' => 'About Us',
    '/complaint-form' => 'Make a Complaint',
    '/positive-feedback-form' => 'Leave Feedback',
    '/lost-item-report' => 'Report a Lost Item',
  ],
];
?>
<!-- tw-bg-ink-soft, one step darker than the closing CTA's tw-bg-ink above
     it. Both were tw-bg-ink, which ran the CTA and the footer together into a
     single black slab; the tonal step separates them without a divider. -->
<footer class="tw-overflow-hidden tw-bg-ink-soft tw-pb-8 tw-pt-[clamp(3.5rem,5vw,5.5rem)] tw-text-white">

  <div class="tw-relative <?= $pcContainer ?>">

    <!-- Contact column sits alongside the four link groups at xl, and above
         them below that -- five equal columns would squeeze the link labels
         to two lines each. -->
    <!-- One column right up to md, not two. The longest labels here
         ("Wheelchair Accessible Taxis", "Ambassador Programme") need roughly
         210px to sit on one line, so a two-column grid inside a 390px viewport
         gives each column ~167px and the labels ran past the footer's edge --
         clipped rather than scrolling, because this <footer> is
         overflow-hidden, which is why a scrollWidth overflow check could not
         see it. Measured: at 390px text reached pixel 389 of 390.

         The old min-[480px] two-column step is gone with the accordion: a
         collapsible row only reads as a row at full width. gap-y goes to 0
         below md for the same reason -- the rows are separated by their own
         hairline borders, not by grid spacing. -->
    <div id="pcFooterNav" class="tw-grid tw-grid-cols-1 tw-gap-x-6 tw-gap-y-0 md:tw-grid-cols-4 md:tw-gap-y-12 xl:tw-grid-cols-[1.4fr_repeat(4,1fr)]">

      <div class="tw-pb-8 md:tw-col-span-4 md:tw-pb-0 xl:tw-col-span-1">
        <?php /* The logo used to head this column. It is gone: the fixed
                 navbar carries the same mark on every page, so repeating it
                 here bought nothing and made the column start with an image
                 while the other four start with a label. The registered
                 address moved up from the legal band to take its place --
                 that is the information a visitor is actually looking for in
                 a footer's first column, and it now sits directly above the
                 WhatsApp action rather than in small print below. */ ?>
        <h2 class="<?= $fColTitle ?>">PowerCabs Ireland</h2>

        <address class="tw-mb-4 tw-not-italic tw-text-[0.92rem] tw-leading-[1.75] tw-text-white/[0.6]">
          Kylmore Road, Inchicore<br>
          Dublin D10 K729<br>
          <a class="<?= $fLegal ?> tw-text-[0.92rem]" href="tel:+35312030727">+353 12 03 0727</a><br>
          <a class="<?= $fLegal ?> tw-text-[0.92rem]" href="mailto:info@powercabs.ie">info@powercabs.ie</a>
        </address>

        <!-- Registration numbers live with the company identity, not in the
             legal strip: they belong to the same block as the registered
             address, and down there they were competing with the copyright
             for a single line. -->
        <p class="tw-mb-5 tw-text-[0.82rem] tw-leading-[1.7] tw-text-white/40">
          NTA Licence DH12616<br>
          Tax Number 04301619NH
        </p>

        <a class="tw-inline-flex tw-items-center tw-gap-2.5 tw-rounded-full tw-border tw-border-solid tw-border-white/15 tw-bg-white/[0.06] tw-py-1.5 tw-pl-1.5 tw-pr-4 tw-no-underline tw-transition-colors tw-duration-200 hover:tw-border-[#25d366]/60 hover:tw-bg-white/10" href="https://wa.me/353899728089" target="_blank" rel="noopener" aria-label="Chat with PowerCabs on WhatsApp">
          <span class="tw-flex tw-h-8 tw-w-8 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[#25d366] tw-text-white">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.71 14.02c-.24.68-1.38 1.3-1.9 1.38-.49.08-1.1.11-1.77-.11-.41-.13-.94-.31-1.62-.6-2.85-1.23-4.71-4.09-4.85-4.28-.14-.19-1.16-1.54-1.16-2.94 0-1.4.73-2.09.99-2.37.26-.28.57-.35.76-.35h.55c.18 0 .41-.07.64.49.24.57.81 1.97.88 2.11.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.28.71 1.17 1.52 1.9 1.04.94 1.92 1.23 2.19 1.37.28.14.44.12.6-.07.16-.19.68-.79.86-1.06.18-.28.36-.23.6-.14.24.09 1.53.72 1.79.85.26.14.44.21.5.32.07.12.07.68-.17 1.35z"/></svg>
          </span>
          <span class="tw-flex tw-flex-col tw-leading-tight">
            <strong class="tw-text-[0.8rem] tw-font-semibold tw-text-white">Book via WhatsApp</strong>
            <small class="tw-text-[0.72rem] tw-text-white/50">+353 89 972 8089</small>
          </span>
        </a>
      </div>

      <?php $groupIndex = 0; ?>
      <?php foreach ($footerNav as $groupTitle => $groupLinks): ?>
        <?php // Counter, not the title: the titles carry spaces and &amp;.
        $groupPanelId = 'pcFooterGroup' . ++$groupIndex; ?>
        <div class="tw-border-0 tw-border-b tw-border-solid tw-border-white/[0.08] md:tw-border-b-0">
          <!-- Two headings, one visible at a time. Both are <h2>: the group
               title has to stay a heading at every width, or the footer's
               outline loses four levels on a phone -- so the mobile one wraps
               the button rather than replacing it. A collapsed group has to be
               operable, and a bare <h2> is not. -->
          <h2 class="<?= $fColTitle ?> tw-hidden md:tw-block"><?= $groupTitle ?></h2>

          <h2 class="tw-m-0 md:tw-hidden">
            <button type="button" class="<?= $fGroupToggle ?>"
              data-pc-collapse data-pc-target="#<?= $groupPanelId ?>"
              aria-expanded="false" aria-controls="<?= $groupPanelId ?>">
              <span><?= $groupTitle ?></span>
              <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-white/40 tw-transition-transform tw-duration-300 group-aria-expanded:tw-rotate-180 group-hover:tw-text-white/70 motion-reduce:tw-transition-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 9l6 6 6-6"/></svg>
            </button>
          </h2>

          <!-- No max-h-0 in the markup: with JS off nothing should be hidden,
               so the closed state is written by primeCollapsePanels() instead.
               From md up that function clears the inline height entirely and
               overflow-visible lets the link underlines through. -->
          <div id="<?= $groupPanelId ?>" data-pc-collapse-panel
            data-pc-collapse-parent="#pcFooterNav"
            data-pc-collapse-media="<?= $fAccordionMedia ?>"
            class="tw-overflow-hidden tw-transition-[max-height] tw-duration-300 tw-ease-out md:tw-overflow-visible motion-reduce:tw-transition-none">
            <ul class="<?= $fList ?> tw-pb-5 md:tw-pb-0">
              <?php foreach ($groupLinks as $href => $label): ?>
                <li><a class="<?= $fLink ?>" href="<?= $assetPath . $href ?>"><?= $label ?></a></li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Legal band: ONE line of copyright on the left, everything else right.
         It used to carry three stacked lines (address, licence numbers,
         copyright) which made the band as tall as a content column and buried
         the address in small print. The address moved into the first column
         above; the licence and tax numbers -- which are compliance
         information, and must stay accessible -- sit inline beside the
         copyright rather than on their own rows. -->
    <!-- mt-8 below md: the accordion rows above end on their own hairline, so
         a 56px gap on top of that read as a hole in a footer whose whole point
         on a phone is now to be short. -->
    <div class="tw-mt-8 tw-h-px tw-w-full tw-bg-white/10 md:tw-mt-14"></div>

    <div class="tw-flex tw-flex-col tw-gap-5 tw-pt-6 lg:tw-flex-row lg:tw-items-center lg:tw-justify-between">

      <p class="tw-mb-0 tw-text-[0.85rem] tw-leading-relaxed tw-text-white/40">
        &copy; 2024&ndash;<?= date('Y') ?> Powercabs Ireland Limited.
      </p>

      <div class="tw-flex tw-flex-col tw-gap-5 sm:tw-flex-row sm:tw-items-center sm:tw-gap-8">
        <div class="tw-flex tw-flex-wrap tw-gap-x-5 tw-gap-y-2">
          <a class="<?= $fLegal ?>" href="<?= $assetPath ?>/privacy-policy">Privacy Policy</a>
          <a class="<?= $fLegal ?>" href="<?= $assetPath ?>/terms-conditions">Terms &amp; Conditions</a>
          <a class="<?= $fLegal ?>" href="<?= $assetPath ?>/gdpr">GDPR</a>
        </div>
        <div class="tw-flex tw-gap-2.5">
          <a class="<?= $fSocial ?>" href="https://www.facebook.com/powercabs.ie/" target="_blank" rel="noopener" aria-label="PowerCabs on Facebook">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12.06C22 6.53 17.52 2.04 12 2.04S2 6.53 2 12.06c0 5 3.66 9.13 8.44 9.88v-6.99h-2.54v-2.89h2.54V9.85c0-2.51 1.49-3.9 3.77-3.9 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.89h-2.34v6.99C18.34 21.19 22 17.06 22 12.06z"/></svg>
          </a>
          <a class="<?= $fSocial ?>" href="https://www.instagram.com/powercabs.ie/" target="_blank" rel="noopener" aria-label="PowerCabs on Instagram">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.16c3.2 0 3.58.01 4.85.07 1.17.05 1.8.25 2.23.41.56.22.96.48 1.38.9.42.42.68.82.9 1.38.16.42.36 1.06.41 2.23.06 1.27.07 1.65.07 4.85s-.01 3.58-.07 4.85c-.05 1.17-.25 1.8-.41 2.23-.22.56-.48.96-.9 1.38-.42.42-.82.68-1.38.9-.42.16-1.06.36-2.23.41-1.27.06-1.65.07-4.85.07s-3.58-.01-4.85-.07c-1.17-.05-1.8-.25-2.23-.41-.56-.22-.96-.48-1.38-.9-.42-.42-.68-.82-.9-1.38-.16-.42-.36-1.06-.41-2.23-.06-1.27-.07-1.65-.07-4.85s.01-3.58.07-4.85c.05-1.17.25-1.8.41-2.23.22-.56.48-.96.9-1.38.42-.42.82-.68 1.38-.9.42-.16 1.06-.36 2.23-.41 1.27-.06 1.65-.07 4.85-.07M12 0C8.74 0 8.33.01 7.05.07 5.78.13 4.9.33 4.14.63c-.79.31-1.46.72-2.13 1.39-.67.67-1.08 1.34-1.39 2.13-.3.76-.5 1.64-.56 2.91C.01 8.33 0 8.74 0 12s.01 3.67.07 4.95c.06 1.27.26 2.15.56 2.91.31.79.72 1.46 1.39 2.13.67.67 1.34 1.08 2.13 1.39.76.3 1.64.5 2.91.56C8.33 23.99 8.74 24 12 24s3.67-.01 4.95-.07c1.27-.06 2.15-.26 2.91-.56.79-.31 1.46-.72 2.13-1.39.67-.67 1.08-1.34 1.39-2.13.3-.76.5-1.64.56-2.91.06-1.28.07-1.69.07-4.95s-.01-3.67-.07-4.95c-.06-1.27-.26-2.15-.56-2.91-.31-.79-.72-1.46-1.39-2.13C21.32 1.15 20.65.74 19.86.43c-.76-.3-1.64-.5-2.91-.56C15.67.01 15.26 0 12 0zm0 5.84A6.16 6.16 0 105.84 12 6.16 6.16 0 0012 5.84zm0 10.16A4 4 0 1116 12a4 4 0 01-4 4zm6.41-10.4a1.44 1.44 0 11-1.44-1.44 1.44 1.44 0 011.44 1.44z"/></svg>
          </a>
          <a class="<?= $fSocial ?>" href="https://vm.tiktok.com/ZSYUyT1fd/" target="_blank" rel="noopener" aria-label="PowerCabs on TikTok">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.53.02C13.84 0 15.14.01 16.44 0c.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
          </a>
          <a class="<?= $fSocial ?>" href="https://youtube.com/@powercabs" target="_blank" rel="noopener" aria-label="PowerCabs on YouTube">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.19a3.02 3.02 0 00-2.12-2.14C19.51 3.5 12 3.5 12 3.5s-7.51 0-9.38.55A3.02 3.02 0 00.5 6.19 31.6 31.6 0 000 12a31.6 31.6 0 00.5 5.81 3.02 3.02 0 002.12 2.14C4.49 20.5 12 20.5 12 20.5s7.51 0 9.38-.55a3.02 3.02 0 002.12-2.14A31.6 31.6 0 0024 12a31.6 31.6 0 00-.5-5.81zM9.75 15.5v-7l6.5 3.5-6.5 3.5z"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<?php require __DIR__ . '/../components/shared/scroll-indicator.php'; ?>

<script src="<?= $assetPath ?>assets/js/main.js?v=<?= @filemtime(__DIR__ . '/../assets/js/main.js') ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/ui.js?v=<?= @filemtime(
  __DIR__ . '/../assets/js/components/ui.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/toast.js?v=<?= @filemtime(
  __DIR__ . '/../assets/js/components/toast.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/ajax-forms.js?v=<?= @filemtime(
  __DIR__ . '/../assets/js/components/ajax-forms.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/pjax.js?v=<?= @filemtime(
  __DIR__ . '/../assets/js/components/pjax.js',
) ?>"></script>
<script src="<?= $assetPath ?>assets/js/components/page-loader.js?v=<?= @filemtime(
  __DIR__ . '/../assets/js/components/page-loader.js',
) ?>"></script>
</body>
</html>
