<?php
// Same six benefits as before, unchanged -- only the presentation changes.
// Order kept as-is; the first card becomes the visually dominant "feature"
// tile and the rest fill out an asymmetric bento grid around it. Every
// card except the feature tile now carries a real photo instead of a flat
// white background.
$benefits = [
  ['icon' => 'card', 'title' => 'Free Card Terminals', 'items' => ['Save &euro;120/year', '0.8% transaction fee', 'Accept more card payments', 'Increase earnings'], 'image' => null],
  ['icon' => 'car', 'title' => 'Exclusive Vehicle Branding', 'items' => ['Roof branding', 'Door branding', 'Rear branding', 'More passenger visibility'], 'image' => 'ambassador-program.png'],
  ['icon' => 'fuel', 'title' => 'Fuel Discounts', 'items' => ['Save &euro;200&ndash;500 annually', 'Nationwide fuel partners', 'Discount on every refill'], 'image' => 'https://images.pexels.com/photos/20500733/pexels-photo-20500733.jpeg?auto=compress&cs=tinysrgb&w=900'],
  ['icon' => 'star', 'title' => 'Extra Loyalty Points', 'items' => ['+2 points on every completed trip'], 'image' => 'https://images.pexels.com/photos/38472818/pexels-photo-38472818.jpeg?auto=compress&cs=tinysrgb&w=900'],
  ['icon' => 'bag', 'title' => 'Swag Pack', 'items' => ['Jacket or Gilet', 'PowerCabs merchandise'], 'image' => 'https://images.pexels.com/photos/6044143/pexels-photo-6044143.jpeg?auto=compress&cs=tinysrgb&w=900'],
  ['icon' => 'headset', 'title' => 'Dedicated Support', 'items' => ['Priority assistance', 'Dedicated Ambassador team'], 'image' => 'https://images.pexels.com/photos/8867630/pexels-photo-8867630.jpeg?auto=compress&cs=tinysrgb&w=900'],
];
// Bento sizing per card index -- one dominant feature, two "wide" cards,
// two standard cards. Keeps the grid asymmetric instead of six equal boxes.
$bizAmbSpans = ['feature', 'wide', 'normal', 'normal', 'wide', 'wide'];

function pc_amb_icon(string $icon, string $cls): void
{
  switch ($icon):
    case 'card': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
    <?php break;
    case 'car': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h7.5m-7.5 0h-3.375c-.621 0-1.125-.504-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.83H14.25M16.5 18.75h-2.25m0-11.25h-8.09c-.966 0-1.786.694-1.94 1.646L2.35 14.25m11.15-7.5v7.5m0-7.5h4.093c.53 0 1.023.28 1.293.735L21 14.25M2.35 14.25v3.375c0 .621.504 1.125 1.125 1.125h1.5m14.25-4.5H2.35"/></svg>
    <?php break;
    case 'fuel': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 3.75h9v16.5h-9V3.75zM4.5 9.75h9M8.25 3.75V2.25m6 5.086l2.36 2.36a1.5 1.5 0 01.44 1.061v6.128a1.5 1.5 0 003 0V9.31a3 3 0 00-.879-2.121l-2.371-2.372"/></svg>
    <?php break;
    case 'star': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
    <?php break;
    case 'bag': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25l2 2 4-4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
    <?php break;
    case 'headset': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4.5 13.5v-1.75a7.5 7.5 0 0115 0v1.75M4.5 13.5a1.75 1.75 0 00-1.75 1.75v1a1.75 1.75 0 001.75 1.75h.75a1 1 0 001-1v-3.5a1 1 0 00-1-1h-.75zm15 0a1.75 1.75 0 011.75 1.75v1a1.75 1.75 0 01-1.75 1.75h-.75a1 1 0 01-1-1v-3.5a1 1 0 011-1h.75zM18 18v.75a2.25 2.25 0 01-2.25 2.25h-2.25"/></svg>
    <?php break;
  endswitch;
}
?>
<!-- #pcAmbBenefits and .pc-amb-card stay as bare classnames -- JS selector
     hooks for ambassador-page.js's IntersectionObserver, which toggles
     .is-visible on each card as it scrolls into view (one-shot: it
     unobserves once revealed). The reveal itself is Tailwind's
     `[&.is-visible]:` arbitrary variant below, no custom CSS needed. -->
<section class="tw-relative tw-overflow-hidden tw-bg-[radial-gradient(120%_100%_at_85%_0%,#fbe6d4_0%,#f9f4ed_50%,#f4efe8_100%)] tw-py-[clamp(4rem,8vw,6.5rem)]" id="pcAmbBenefits">
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-opacity-[0.035] tw-bg-[url('data:image/svg+xml,%3Csvg_xmlns=%27http://www.w3.org/2000/svg%27%3E%3Cfilter_id=%27n%27%3E%3CfeTurbulence_type=%27fractalNoise%27_baseFrequency=%270.85%27_numOctaves=%272%27_stitchTiles=%27stitch%27/%3E%3C/filter%3E%3Crect_width=%27100%25%27_height=%27100%25%27_filter=%27url(%23n)%27/%3E%3C/svg%3E')]" aria-hidden="true"></span>
  <span class="tw-pointer-events-none tw-absolute tw-bottom-[-6rem] tw-left-[-6rem] tw-z-0 tw-h-[22rem] tw-w-[22rem] tw-rounded-full tw-bg-[radial-gradient(circle,rgba(232,89,12,0.14),transparent_70%)] tw-blur-[60px]" aria-hidden="true"></span>
  <svg class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-hidden md:tw-block" width="100%" height="100%" preserveAspectRatio="none" aria-hidden="true">
    <line x1="0" y1="18%" x2="100%" y2="18%" stroke="rgba(232,89,12,0.15)" stroke-width="1"/>
    <line x1="0" y1="82%" x2="100%" y2="82%" stroke="rgba(232,89,12,0.15)" stroke-width="1"/>
  </svg>

  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ Benefits</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Everything You Get as an Ambassador</h2>
    </div>

    <div class="tw-relative tw-z-[1] tw-grid tw-grid-cols-1 tw-gap-5 md:tw-grid-cols-2 lg:tw-grid-cols-4 lg:[grid-auto-flow:dense] lg:[grid-auto-rows:minmax(170px,auto)]">
      <?php foreach ($benefits as $i => $b): ?>
        <?php
        $span = $bizAmbSpans[$i] ?? 'normal';
        $isFeature = $span === 'feature';
        $spanClass = match ($span) {
          'feature' => 'md:tw-col-span-2 lg:tw-col-span-2 lg:tw-row-span-2',
          'wide' => 'lg:tw-col-span-2',
          default => '',
        };
        ?>
        <div class="pc-amb-card tw-relative tw-overflow-hidden tw-rounded-2xl tw-p-6 tw-opacity-0 tw-translate-y-6 tw-transition-all tw-duration-500 tw-ease-out [&.is-visible]:tw-opacity-100 [&.is-visible]:tw-translate-y-0 motion-reduce:tw-opacity-100 motion-reduce:tw-translate-y-0 motion-reduce:tw-transition-none <?= $spanClass ?>
          <?= $isFeature
            ? 'tw-flex tw-flex-col tw-justify-center tw-border-0 tw-bg-[radial-gradient(140%_120%_at_100%_0%,rgba(255,122,0,0.22)_0%,transparent_55%),linear-gradient(160deg,#1c1410_0%,#2a1a10_60%,#1c0f08_100%)] tw-text-white lg:tw-p-11'
            : 'tw-flex tw-min-h-[260px] tw-flex-col tw-justify-end tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-text-white tw-shadow-[0_8px_20px_rgba(28,20,16,0.08)] hover:tw-border-power/20' ?>">
          <?php if (!$isFeature): ?>
            <img src="<?= htmlspecialchars(str_starts_with($b['image'], 'http') ? $b['image'] : $assetPath . 'assets/img/' . $b['image']) ?>" alt="" aria-hidden="true" class="tw-absolute tw-inset-0 tw-z-0 tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 [.pc-amb-card:hover_&]:tw-scale-[1.06] motion-reduce:tw-transition-none" loading="lazy">
            <span class="tw-absolute tw-inset-0 tw-z-[1] tw-bg-[linear-gradient(180deg,rgba(10,7,5,0.35)_0%,rgba(10,7,5,0.8)_100%)]" aria-hidden="true"></span>
          <?php endif; ?>
          <div class="tw-relative tw-z-[2]">
            <span class="tw-mb-4 tw-inline-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-full <?= $isFeature ? 'tw-bg-white/[0.12] tw-text-powerlight lg:tw-h-[4.25rem] lg:tw-w-[4.25rem]' : 'tw-bg-white/[0.18] tw-text-white tw-backdrop-blur-[6px]' ?>">
              <?php pc_amb_icon($b['icon'], $isFeature ? 'tw-h-6 tw-w-6 lg:tw-h-8 lg:tw-w-8' : 'tw-h-6 tw-w-6'); ?>
            </span>
            <h3 class="tw-mb-3 tw-text-lg tw-font-bold tw-text-white <?= $isFeature
  ? 'lg:tw-mb-[1.4rem] lg:tw-text-[2.35rem] lg:tw-leading-[1.15]'
  : '' ?>"><?= htmlspecialchars($b['title']) ?></h3>
            <ul class="tw-m-0 tw-flex tw-flex-col tw-gap-2 tw-p-0 <?= $isFeature ? 'lg:tw-gap-4' : '' ?>">
              <?php foreach ($b['items'] as $item): ?>
                <li class="tw-flex tw-items-center tw-gap-2 tw-text-sm tw-text-white/[0.85] <?= $isFeature
  ? 'lg:tw-text-[1.2rem]'
  : '' ?>">
                  <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-powerlight" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M2.25 12a9.75 9.75 0 1119.5 0 9.75 9.75 0 01-19.5 0zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
                  <span><?= $item ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
