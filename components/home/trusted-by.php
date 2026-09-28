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
 * `big` marks the logos whose artwork is square-ish rather than wide; they
 * need more height to read at the same optical size. It replaces an
 * `$index >= 7` test, which silently depended on the array's order.
 */
$trustedLogos = [
  ['file' => 'Boots.png', 'alt' => 'Boots'],
  ['file' => 'boylesports.png', 'alt' => 'BoyleSports'],
  ['file' => 'svuh.png', 'alt' => "St. Vincent's University Hospital", 'big' => true],
  ['file' => 'westpark.webp', 'alt' => 'Westpark Fitness'],
  ['file' => 'RIU_Hotels.webp', 'alt' => 'RIU Hotels & Resorts'],
  ['file' => 'rte.webp', 'alt' => 'RTE'],
  ['file' => 'Mediahuis.webp', 'alt' => 'Mediahuis'],
  ['file' => 'skylon.png', 'alt' => 'Skylon Hotel', 'big' => true],
  ['file' => 'greenisle.png', 'alt' => 'Green Isle Hotel', 'big' => true],
  ['file' => 'elmpark.png', 'alt' => 'Elm Park', 'big' => true],
  ['file' => 'st-james-social.jpg', 'alt' => "St. James's Hospital", 'big' => true],
  ['file' => 'Irish_ferries.webp', 'alt' => 'Irish Ferries', 'big' => true],
  ['file' => 'griffith-college.png', 'alt' => 'Griffith College', 'big' => true],
  ['file' => 'pennys.png', 'alt' => 'Penneys'],
  ['file' => 'Star_Cineworld.jpg', 'alt' => 'Cineworld'],
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
            class="<?= !empty($logo['big']) ? 'tw-max-h-[46px]' : 'tw-max-h-[30px]' ?> tw-w-auto tw-max-w-full tw-object-contain tw-opacity-[0.72] tw-transition-opacity tw-duration-300 hover:tw-opacity-100 motion-reduce:tw-transition-none"
            loading="lazy">
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>
