<?php
$pageTitle = 'Safety Tips for Riders | PowerCabs';
$pageDescription =
  'Safety guidance for PowerCabs riders -- before, during and after every ride, plus using the emergency button, cashless payments and more.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Policies & Safety';
$heroTitleLight = 'Safety Tips';
$heroTitleBold = 'for Riders.';
$heroDescription =
  'A few simple habits make every PowerCabs trip safer -- before you get in, while you ride, and after you arrive.';
$heroBgImage = 'https://images.pexels.com/photos/13343433/pexels-photo-13343433.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Rider Safety';
require __DIR__ . '/components/shared/inner-hero.php';

$beforeRide = [
  [
    'icon' => 'badge',
    'title' => 'Verify the Driver and Vehicle',
    'desc' =>
      "Check the driver's photo, vehicle model, and license plate against the details shown in the app before getting in.",
  ],
  [
    'icon' => 'share',
    'title' => 'Share Your Trip',
    'desc' => 'Share your live trip details with a trusted friend or family member so they can follow your journey.',
  ],
  [
    'icon' => 'bulb',
    'title' => 'Choose Safe Pickup Locations',
    'desc' => 'Select well-lit and populated pickup and drop-off locations whenever possible.',
  ],
];

$duringRide = [
  ['icon' => 'seat', 'title' => 'Sit in the Back Seat', 'desc' => 'More personal space, and you can exit from either side if needed.'],
  ['icon' => 'shield', 'title' => 'Wear Your Seatbelt', 'desc' => 'Always fasten your seatbelt, regardless of where you are sitting.'],
  [
    'icon' => 'chat',
    'title' => 'Keep Conversations General',
    'desc' => 'Avoid sharing sensitive personal information with the driver.',
  ],
  [
    'icon' => 'signpost',
    'title' => 'Follow Your Route',
    'desc' => 'Monitor your trip through the app and politely ask if the driver takes an unexpected route.',
  ],
  [
    'icon' => 'pulse',
    'title' => 'Trust Your Instincts',
    'desc' => 'If you ever feel unsafe, ask the driver to stop in a safe public location and end the ride.',
  ],
];

$afterRide = [
  ['icon' => 'star', 'title' => 'Rate Your Driver', 'desc' => 'Leave honest ratings and feedback to help maintain service quality and safety.'],
  [
    'icon' => 'flag',
    'title' => 'Report Any Issues',
    'desc' => 'Immediately report any unusual, unsafe, or uncomfortable experience through the app or customer support.',
  ],
];

$additionalTips = [
  ['icon' => 'warning', 'label' => "Learn how to use the app's emergency or panic button"],
  ['icon' => 'card', 'label' => 'Prefer cashless payments for safer, more secure transactions'],
  ['icon' => 'eye', 'label' => 'Stay aware of your surroundings before entering and after leaving the vehicle'],
  ['icon' => 'phone', 'label' => 'Avoid excessive phone use while walking to or from your pickup location'],
  ['icon' => 'telephone', 'label' => 'Keep emergency contacts easily accessible on your phone'],
];

/** Inline SVG icons shared across this page's safety-tip lists. */
function pc_safety_icon(string $icon, string $cls = 'tw-h-6 tw-w-6'): void
{
  switch ($icon):
    case 'badge': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'share': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"/></svg>
    <?php break;
    case 'bulb': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18h6m-5.25 3h4.5M12 3a6.75 6.75 0 00-4.5 11.786V17.25a.75.75 0 00.75.75h7.5a.75.75 0 00.75-.75v-2.464A6.75 6.75 0 0012 3z"/></svg>
    <?php break;
    case 'seat': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'chat': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 01-2.555-.337A5.972 5.972 0 015.41 20.97a5.969 5.969 0 01-.474-.065 4.48 4.48 0 00.978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25z"/></svg>
    <?php break;
    case 'signpost': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
    <?php break;
    case 'pulse': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/><path d="M3.75 10.5h2.25l1.5-3 3 6 1.5-3h8.25"/></svg>
    <?php break;
    case 'star': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
    <?php break;
    case 'flag': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M3 2.25a.75.75 0 01.75.75v.54l1.838-.46a9.75 9.75 0 016.725.738l.108.054a8.25 8.25 0 005.58.652l3.109-.732a.75.75 0 01.917.81 47.784 47.784 0 00.005 10.337.75.75 0 01-.574.812l-3.114.733a9.75 9.75 0 01-6.594-.77l-.108-.054a8.25 8.25 0 00-5.69-.625l-2.202.55V21a.75.75 0 01-1.5 0V3A.75.75 0 013 2.25z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'warning': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
    <?php break;
    case 'card': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
    <?php break;
    case 'eye': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
    <?php break;
    case 'phone': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3M3 4.5l18 15"/></svg>
    <?php break;
    case 'telephone': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a1.5 1.5 0 001.5-1.5v-2.4a1.5 1.5 0 00-1.157-1.46l-3.727-.932a1.5 1.5 0 00-1.516.397l-1.03 1.03a11.25 11.25 0 01-6.464-6.464l1.03-1.03a1.5 1.5 0 00.397-1.516L6.859 3.657a1.5 1.5 0 00-1.46-1.157H3a1.5 1.5 0 00-1.5 1.5v.75z"/></svg>
    <?php break;
    case 'chevron': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 011.06 0l6.5 6.5a.75.75 0 010 1.06l-6.5 6.5a.75.75 0 11-1.06-1.06L14.19 12 8.22 6.03a.75.75 0 010-1.06z" clip-rule="evenodd"/></svg>
    <?php break;
  endswitch;
}
?>

<!-- ============ Before the Ride ============ -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div class="lg:tw-order-2">
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Before the Ride</p>
        <h2 class="tw-mb-6 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Check Before You Get In</h2>
        <div class="tw-flex tw-flex-col tw-gap-6">
          <?php foreach ($beforeRide as $item): ?>
            <div class="tw-flex tw-gap-4">
              <span class="tw-shrink-0 tw-text-power"><?php pc_safety_icon($item['icon'], 'tw-h-7 tw-w-7'); ?></span>
              <div>
                <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
                <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($item['desc']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="lg:tw-order-1">
        <div class="tw-aspect-[4/3] tw-overflow-hidden tw-rounded-2xl">
          <img src="https://images.pexels.com/photos/15067166/pexels-photo-15067166.jpeg?auto=format&fit=crop&w=1200&q=60" alt="A PowerCabs taxi arriving for pickup" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ During the Ride ============ -->
<section class="tw-bg-white tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ During the Ride</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Small Habits, Safer Trips</h2>
    </div>
    <div class="tw-grid tw-grid-cols-1 tw-divide-x tw-divide-y tw-divide-solid tw-divide-black/[0.08] tw-overflow-hidden tw-rounded-2xl tw-border tw-border-solid tw-border-black/[0.08] sm:tw-grid-cols-2 lg:tw-grid-cols-5">
      <?php foreach ($duringRide as $item): ?>
        <div class="tw-flex tw-flex-col tw-items-center tw-px-3 tw-py-8 tw-text-center md:tw-py-10">
          <span class="tw-mb-3 tw-text-power"><?php pc_safety_icon($item['icon'], 'tw-h-8 tw-w-8'); ?></span>
          <h3 class="tw-mb-2 tw-text-[1.05rem] tw-leading-snug tw-font-bold tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($item['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Photo Banner ============ -->
<section class="tw-relative tw-min-h-[280px] tw-overflow-hidden tw-text-center tw-text-white">
  <img src="https://images.pexels.com/photos/7856880/pexels-photo-7856880.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="tw-absolute tw-inset-0 tw-z-0 tw-h-full tw-w-full tw-object-cover" loading="lazy">
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-bg-ink-soft/[0.65]" aria-hidden="true"></span>
  <div class="tw-relative tw-z-[1] tw-mx-auto tw-flex tw-min-h-[280px] tw-w-full tw-max-w-[1320px] tw-items-center tw-justify-center tw-px-4 sm:tw-px-6 lg:tw-px-8">
    <p class="tw-mb-0 tw-max-w-[46ch] tw-text-xl tw-font-bold tw-text-white md:tw-text-2xl">Follow your trip live in the app, from pickup to drop-off.</p>
  </div>
</section>

<!-- ============ After the Ride ============ -->
<section class="tw-bg-paper tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ After the Ride</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Help Us Keep Every Trip Safe</h2>
    </div>
    <div class="tw-mx-auto tw-grid tw-max-w-[760px] tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2">
      <?php foreach ($afterRide as $item): ?>
        <div class="tw-h-full tw-rounded-2xl tw-bg-white tw-p-6 tw-text-center tw-shadow-[0_1px_3px_rgba(28,20,16,0.06)]">
          <span class="tw-mb-3 tw-inline-block tw-text-power"><?php pc_safety_icon($item['icon'], 'tw-h-7 tw-w-7'); ?></span>
          <h3 class="tw-mb-2 tw-text-[1.05rem] tw-leading-snug tw-font-bold tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($item['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ Additional Safety Tips ============ -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Additional Safety Tips</p>
        <h2 class="tw-mb-6 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">A Few More Habits Worth Building</h2>
        <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-4 tw-p-0">
          <?php foreach ($additionalTips as $tip): ?>
            <li class="tw-flex tw-gap-3">
              <span class="tw-shrink-0 tw-text-power"><?php pc_safety_icon($tip['icon'], 'tw-h-6 tw-w-6'); ?></span>
              <span class="tw-text-ink/60"><?= htmlspecialchars($tip['label']) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div>
        <div class="tw-aspect-[4/3] tw-overflow-hidden tw-rounded-2xl">
          <img src="https://images.pexels.com/photos/31748308/pexels-photo-31748308.jpeg?auto=format&fit=crop&w=1200&q=60" alt="A passenger sitting comfortably in the back seat wearing a seatbelt" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="tw-px-4 tw-pb-16 tw-text-center sm:tw-px-6 md:tw-pb-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <a class="tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink-soft" href="<?= $assetPath ?>/safety-tips-drivers">
      See Safety Tips for Drivers
      <?php pc_safety_icon('chevron', 'tw-h-3.5 tw-w-3.5'); ?>
    </a>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
