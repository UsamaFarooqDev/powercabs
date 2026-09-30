<?php
/**
 * The client logo strip.
 *
 * Measured, this section was the TALLEST on the homepage at 1022px (13% of
 * the whole page) because it was really two sections in one: the logo wall,
 * and a dark full-width "Let Dublin Discover Your Business" panel bolted
 * underneath it.
 *
 * That panel is gone. Its CTA pointed at /business -- the same destination as
 * the "Move your business forward" band five sections further down -- so the
 * homepage asked the same audience to do the same thing twice, and did it at
 * position two, before a rider had been told what PowerCabs is. Partner
 * recruitment still has its own page, linked from both the header and the
 * footer, and the business band still carries the pitch.
 *
 * What is left is what a logo wall is for: proof, quickly, on the way past.
 * The bordered 5x3 grid went with it -- fifteen boxed cells drew sixty border
 * segments to group logos that a row already groups.
 *
 * SIZING IS PER LOGO, and it has to be. A two-bucket `big` flag (46px for the
 * square-ish artwork, 30px for the wide) sized the FILES rather than the
 * marks inside them, and four of these files carry a lot of baked-in
 * whitespace:
 *
 *   pennys.png        470x200, the wordmark is about a quarter of the height,
 *                     so a 30px cap rendered ~10px of actual letterform
 *   Star_Cineworld    1024x512 with deep padding top and bottom, same problem
 *   skylon.png        a STACKED lockup -- mark over wordmark over strapline --
 *                     so at 46px the word "SKYLON" was a third of that
 *   elmpark.png       a tall crest with "ELM PARK" beneath it, same again
 *
 * Each logo now declares its own cap, and the value is a literal class string
 * in this array rather than composed from a variable -- the Tailwind scanner
 * reads this file as text, so a composed `tw-max-h-[{$n}px]` would silently
 * not exist. Judge new values by the height of the MARK, not the file.
 */
$trustedLogos = [
  ['file' => 'Boots.png', 'alt' => 'Boots', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'boylesports.png', 'alt' => 'BoyleSports', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'svuh.png', 'alt' => "St. Vincent's University Hospital", 'h' => 'tw-max-h-[46px]'],
  ['file' => 'westpark.webp', 'alt' => 'Westpark Fitness', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'RIU_Hotels.webp', 'alt' => 'RIU Hotels & Resorts', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'rte.webp', 'alt' => 'RTE', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'Mediahuis.webp', 'alt' => 'Mediahuis', 'h' => 'tw-max-h-[30px]'],
  ['file' => 'skylon.png', 'alt' => 'Skylon Hotel', 'h' => 'tw-max-h-[64px]'],
  ['file' => 'greenisle.png', 'alt' => 'Green Isle Hotel', 'h' => 'tw-max-h-[46px]'],
  ['file' => 'elmpark.png', 'alt' => 'Elm Park', 'h' => 'tw-max-h-[66px]'],
  ['file' => 'st-james-social.jpg', 'alt' => "St. James's Hospital", 'h' => 'tw-max-h-[46px]'],
  ['file' => 'Irish_ferries.webp', 'alt' => 'Irish Ferries', 'h' => 'tw-max-h-[46px]'],
  ['file' => 'griffith-college.png', 'alt' => 'Griffith College', 'h' => 'tw-max-h-[46px]'],
  ['file' => 'pennys.png', 'alt' => 'Penneys', 'h' => 'tw-max-h-[54px]'],
  ['file' => 'Star_Cineworld.jpg', 'alt' => 'Cineworld', 'h' => 'tw-max-h-[56px]'],
];
?>
<!-- ============ Trusted by ============ -->
<?php /* $pcSection, not $pcSectionTight.
         Cutting this section from 1022px to 384px removed the right things --
         a duplicate CTA panel and a bordered logo grid -- but it also took the
         section down to the tight rhythm, and a logo wall with 64px above and
         below it reads as squeezed against its neighbours rather than calm.
         Back on the standard rhythm, with the rows given room to breathe
         too: the point of a quiet strip is the quiet, not the compression. */ ?>
<section class="tw-bg-white <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <?php /* One line, not a heading plus a two-line paragraph. The paragraph
             read "From national retailers to healthcare, hospitality and media,
             businesses across Ireland rely on PowerCabs" -- which is the
             heading again, at length. The logos below say it better than
             either. */ ?>
    <p class="tw-mb-12 tw-text-center tw-text-[0.9375rem] tw-font-semibold tw-text-muted">
      Trusted by leading Irish brands
    </p>

    <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-3 tw-items-center tw-gap-x-10 tw-gap-y-12 tw-p-0 sm:tw-grid-cols-5">
      <?php foreach ($trustedLogos as $logo): ?>
        <li class="tw-flex tw-items-center tw-justify-center">
          <img src="<?= $assetPath ?>assets/img/<?= $logo['file'] ?>"
            alt="<?= htmlspecialchars($logo['alt']) ?>"
            class="<?= $logo['h'] ?> tw-w-auto tw-max-w-full tw-object-contain tw-opacity-[0.72] tw-transition-opacity tw-duration-300 hover:tw-opacity-100 motion-reduce:tw-transition-none"
            loading="lazy">
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
