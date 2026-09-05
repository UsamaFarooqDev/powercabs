<?php
$pageTitle       = 'Sustainability & Environmental Policy | PowerCabs';
$pageDescription = "PowerCabs's commitment to eco-friendly design and digital solutions -- remote-first working, paperless operations, and 100% renewable-energy hosting.";
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$ecoAreas = [
  [
    'icon' => 'home',
    'title' => 'Remote-First Working',
    'items' => ['Entire team and subcontractors work remotely', 'Eliminates energy-intensive office spaces', 'Reduces daily commuting emissions', 'Minimizes office waste and packaging'],
  ],
  [
    'icon' => 'paperless',
    'title' => 'Paperless Operations',
    'items' => ['Digital documentation by default', 'Printing only when absolutely necessary', 'Reduced paper consumption across the business'],
  ],
  [
    'icon' => 'video',
    'title' => 'Sustainable Communication',
    'items' => ['Video conferencing and online collaboration', 'Virtual meetings preferred over travel', 'Shared Dublin office space when in-person is required', 'Hybrid or electric vehicles for necessary travel'],
  ],
  [
    'icon' => 'speed',
    'title' => 'Sustainable Website Development',
    'items' => ['Optimizing website performance', 'Reducing page sizes and data transfer', 'Improving efficiency to lower hosted-site impact'],
  ],
  [
    'icon' => 'plug',
    'title' => 'Green Hosting',
    'items' => ['Hosted through Hosting Ireland', 'Server caching and CDN integration', 'Faster performance, smaller footprint', '100% renewable energy infrastructure'],
  ],
  [
    'icon' => 'refresh',
    'title' => 'Continuous Improvement',
    'items' => ['Regular review of environmental policy', 'Ongoing sustainable business practices', 'Alignment with evolving sustainability goals'],
  ],
];

/** Inline SVG icons for this page's eco-initiative cards. */
function pc_eco_icon(string $icon, string $cls = 'tw-h-6 tw-w-6'): void
{
  switch ($icon):
    case 'leaf': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25v-.797a4.5 4.5 0 00-1.318-3.182L14.42 8.007a2.652 2.652 0 00-3.75 0l-.354.354a2.652 2.652 0 000 3.75l1.104 1.104M4.5 21a1.5 1.5 0 01-1.5-1.5V6a1.5 1.5 0 011.5-1.5h6.75c1.036 0 2.033.19 2.965.53A9.717 9.717 0 0119.5 6.75v3.75"/></svg>
    <?php break;
    case 'home': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 12l8.954-8.955a1.5 1.5 0 012.122 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M12 14.25a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5z"/></svg>
    <?php break;
    case 'paperless': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l3-3m0 0l-3-3m3 3h-7.5M6 20.25h12A2.25 2.25 0 0020.25 18V9.75L14.25 3.75H6a2.25 2.25 0 00-2.25 2.25v12A2.25 2.25 0 006 20.25z"/></svg>
    <?php break;
    case 'video': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15.75 10.5l4.72-4.72a.75.75 0 011.28.53v11.38a.75.75 0 01-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25h-9A2.25 2.25 0 002.25 7.5v9a2.25 2.25 0 002.25 2.25z"/></svg>
    <?php break;
    case 'speed': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21a9 9 0 100-18 9 9 0 000 18z"/><path d="M12 12l3.75-4.5M12 12a1.5 1.5 0 101.5 1.5A1.5 1.5 0 0012 12z"/></svg>
    <?php break;
    case 'plug': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13.5 21v-7.5m0 0V5.25A2.25 2.25 0 0011.25 3h-4.5A2.25 2.25 0 004.5 5.25v6M13.5 13.5h6M4.5 13.5h6m0 0v-3m3 3v-3M6.75 8.25h.008v.008H6.75V8.25zm3-2.25h.008v.008H9.75V6zm7.5 7.5h3.75a1.5 1.5 0 011.5 1.5v3a1.5 1.5 0 01-1.5 1.5H4.5A1.5 1.5 0 013 18v-3a1.5 1.5 0 011.5-1.5H6"/></svg>
    <?php break;
    case 'refresh': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/></svg>
    <?php break;
    case 'check': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 011.04-.207z" clip-rule="evenodd"/></svg>
    <?php break;
  endswitch;
}
?>

<!-- ============ Hero ============ -->
<section class="tw-relative tw-overflow-hidden tw-px-4 tw-pb-[clamp(6rem,12vw,9rem)] tw-pt-[calc(var(--pc-navbar-h,110px)+3rem)] tw-text-center tw-text-white sm:tw-px-6 lg:tw-px-8">
  <img src="https://images.pexels.com/photos/35736786/pexels-photo-35736786.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="tw-absolute tw-inset-0 tw-z-0 tw-h-full tw-w-full tw-object-cover" loading="lazy">
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-bg-[linear-gradient(120deg,rgba(15,46,24,0.88)_0%,rgba(15,46,24,0.6)_55%,rgba(15,46,24,0.35)_100%)]" aria-hidden="true"></span>
  <div class="tw-relative tw-z-[1] tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <span class="tw-mb-3 tw-inline-flex tw-items-center tw-gap-2 tw-rounded-full tw-bg-[rgba(76,175,80,0.12)] tw-px-4 tw-py-[0.4rem] tw-text-[0.85rem] tw-font-semibold tw-text-[#2e7d32]">
      <?php pc_eco_icon('leaf', 'tw-h-4 tw-w-4'); ?> Eco-Friendly by Design
    </span>
    <h1 class="tw-mb-3 tw-text-[clamp(2.25rem,4.5vw,3.5rem)] tw-font-black tw-text-white">Sustainability &amp; Environmental Policy</h1>
    <p class="tw-mx-auto tw-mb-0 tw-max-w-[56ch] tw-text-[1.15rem] tw-text-white/[0.88]">Our Commitment to Eco-Friendly Design and Digital Solutions.</p>
  </div>
</section>

<!-- ============ Our Commitment ============ -->
<section class="tw-bg-[linear-gradient(180deg,#f2faf3_0%,#ffffff_100%)] tw-px-4 tw-py-16 tw-text-center sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-max-w-[780px]">
    <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-[#2e7d32]">/ Our Commitment</p>
    <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Exceptional Service, Lower Impact</h2>
    <p class="tw-mb-0 tw-text-ink/60">
      PowerCabs is committed to delivering exceptional digital services while maintaining a
      strong focus on environmental responsibility. We continually improve our environmental
      practices and promote sustainable operations throughout the business.
    </p>
  </div>
</section>

<!-- ============ How We Reduce Our Environmental Impact ============ -->
<section class="tw-bg-[linear-gradient(180deg,#f2faf3_0%,#ffffff_100%)] tw-px-4 tw-pb-16 sm:tw-px-6 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-[#2e7d32]">/ How We Reduce Our Impact</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Six Ways We Keep It Green</h2>
    </div>
    <div class="tw-grid tw-grid-cols-1 tw-gap-6 md:tw-grid-cols-2 lg:tw-grid-cols-3">
      <?php foreach ($ecoAreas as $area): ?>
        <div class="tw-h-full tw-rounded-[28px] tw-border tw-border-solid tw-border-[rgba(76,175,80,0.18)] tw-bg-white/75 tw-p-6 tw-shadow-[0_20px_45px_rgba(46,125,50,0.1)] tw-backdrop-blur-[14px] tw-transition-[transform,box-shadow] tw-duration-[250ms] hover:-tw-translate-y-1 hover:tw-shadow-[0_28px_55px_rgba(46,125,50,0.16)] motion-reduce:tw-transform-none motion-reduce:tw-transition-none">
          <span class="tw-mb-3 tw-inline-flex tw-h-[3.25rem] tw-w-[3.25rem] tw-items-center tw-justify-center tw-rounded-full tw-bg-[rgba(76,175,80,0.14)] tw-text-[1.4rem] tw-text-[#2e7d32]">
            <?php pc_eco_icon($area['icon']); ?>
          </span>
          <h3 class="tw-mb-3 tw-text-lg tw-font-bold tw-text-ink"><?= htmlspecialchars($area['title']) ?></h3>
          <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-2 tw-p-0">
            <?php foreach ($area['items'] as $item): ?>
              <li class="tw-flex tw-gap-2 tw-text-sm tw-text-ink/60">
                <span class="tw-mt-0.5 tw-shrink-0 tw-text-[#4caf50]"><?php pc_eco_icon('check', 'tw-h-4 tw-w-4'); ?></span>
                <span><?= htmlspecialchars($item) ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="tw-px-4 tw-py-[clamp(3rem,6vw,4.5rem)] tw-text-center tw-text-white sm:tw-px-6 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-rounded-[30px] tw-bg-[linear-gradient(120deg,#2e7d32_0%,#4caf50_60%,#81c784_100%)] tw-p-10 md:tw-p-14">
      <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-text-white md:tw-text-4xl">Powered by 100% Renewable Energy</h2>
      <p class="tw-mx-auto tw-mb-0 tw-max-w-[56ch] tw-text-white/90">
        From remote-first working to green hosting, sustainability is built into how PowerCabs
        operates every day &mdash; not an afterthought.
      </p>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
