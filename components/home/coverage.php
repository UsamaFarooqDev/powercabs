<?php
$coverageStops = ['Dublin Airport', 'City centre', 'Docklands', 'Dún Laoghaire', 'Swords', 'Tallaght'];

$coverageShots = [
  ['id' => '13158127', 'alt' => 'The Samuel Beckett Bridge over the River Liffey, Dublin.'],
  ['id' => '35809675', 'alt' => "O'Connell Bridge over the Liffey, with a Dublin bus crossing."],
  ['id' => '38635694', 'alt' => 'The Four Courts on the Dublin quays at sunset.'],
  ['id' => '5995605', 'alt' => "St George's Church and a Georgian street in Dublin."],
];
?>
<section class="tw-bg-white <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2 lg:tw-gap-16">

      <div>
        <p class="<?= $pcEyebrow ?>">Coverage</p>
        <h2 class="<?= $pcH2 ?> tw-max-w-[16ch]">
          From Dublin Airport to the city centre &mdash; and beyond.
        </h2>
        <p class="<?= $pcBody ?> tw-mb-7 tw-max-w-[46ch]">
          We serve the Greater Dublin Area, day and night. Book on demand when
          you need to move now, or in advance when the time matters.
        </p>

        <ul class="tw-m-0 tw-mb-8 tw-flex tw-list-none tw-flex-wrap tw-gap-2 tw-p-0">
          <?php foreach ($coverageStops as $stop): ?>
            <li class="tw-rounded-pill tw-border tw-border-solid tw-border-hairline tw-bg-white tw-px-3.5 tw-py-1.5 tw-text-[0.875rem] tw-font-medium tw-text-ink">
              <?= htmlspecialchars($stop) ?>
            </li>
          <?php endforeach; ?>
        </ul>

        <?php  ?>
        <a class="<?= $pcBtnLink ?>" href="<?= $assetPath ?>/ride">
          Check your route
          <svg class="<?= $pcBtnLinkIcon ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>

      <?php  ?>
      <div class="tw-grid tw-grid-cols-2 tw-gap-1.5 lg:tw-mx-auto lg:tw-max-w-[440px]">
        <?php foreach ($coverageShots as $shot): ?>
          <div class="tw-group tw-relative tw-aspect-[4/3] tw-overflow-hidden tw-rounded-lg tw-bg-ink/[0.04]">
            <img src="https://images.pexels.com/photos/<?= $shot['id'] ?>/pexels-photo-<?= $shot['id'] ?>.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=700"
              alt="<?= htmlspecialchars($shot['alt']) ?>"
              width="700" height="525" loading="lazy" decoding="async"
              class="<?= $pcImgCover ?> <?= $pcImgZoom ?>">
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
