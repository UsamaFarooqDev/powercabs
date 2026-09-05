<?php
$pageTitle = 'Safety Tips for Drivers | PowerCabs';
$pageDescription =
  'Safety guidance for PowerCabs drivers -- before, during and after every ride, plus emergency features, cashless payments and more.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Policies & Safety';
$heroTitleLight = 'Safety Tips';
$heroTitleBold = 'for Drivers.';
$heroDescription =
  'Practical guidance to help you stay safe, confident and prepared on every trip -- before you set off, while you drive, and after you drop off.';
$heroBgImage = 'https://images.pexels.com/photos/5834950/pexels-photo-5834950.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Driver Safety';
require __DIR__ . '/components/shared/inner-hero.php';

$beforeRide = [
  [
    'icon' => 'id',
    'title' => 'Verify Passenger Identity',
    'desc' => "Check the passenger's name and profile photo (if available) before allowing them into your vehicle.",
  ],
  [
    'icon' => 'wrench',
    'title' => 'Keep Your Vehicle in Good Condition',
    'desc' =>
      'Regularly inspect and maintain your vehicle -- brakes, tires, lights, and other essential safety components.',
  ],
  [
    'icon' => 'signpost',
    'title' => 'Plan Your Routes',
    'desc' =>
      'Familiarize yourself with the area before starting, and use GPS to choose the safest and most efficient route.',
  ],
];

$duringRide = [
  ['icon' => 'speed', 'title' => 'Follow Traffic Laws', 'desc' => 'Obey speed limits, traffic signals, and all road regulations.'],
  [
    'icon' => 'phone',
    'title' => 'Minimize Distractions',
    'desc' => 'Avoid using your phone while driving; use hands-free devices only when necessary.',
  ],
  ['icon' => 'lock', 'title' => 'Keep Doors Locked', 'desc' => 'Lock vehicle doors while driving to prevent unauthorized access.'],
  [
    'icon' => 'shield',
    'title' => 'Trust Your Instincts',
    'desc' => 'If a passenger makes you feel unsafe, you have the right to decline or end the ride.',
  ],
  [
    'icon' => 'bulb',
    'title' => 'Stay in Well-Lit Areas',
    'desc' => 'Prefer pickups and drop-offs in busy, well-lit locations, especially at night.',
  ],
];

$afterRide = [
  ['icon' => 'phone', 'title' => 'Stay Focused', 'desc' => 'Minimize distractions and remain focused before moving to your next trip.'],
  ['icon' => 'lock', 'title' => 'Keep Doors Locked', 'desc' => 'Keep your vehicle doors locked whenever appropriate.'],
  ['icon' => 'shield', 'title' => 'Trust Your Instincts', 'desc' => 'Trust your instincts if any situation feels unsafe.'],
  [
    'icon' => 'bulb',
    'title' => 'Well-Lit, Populated Areas',
    'desc' => 'Continue choosing well-lit, populated areas when waiting for your next passenger.',
  ],
];

$additionalTips = [
  ['icon' => 'warning', 'label' => "Learn how to use the app's emergency features"],
  ['icon' => 'card', 'label' => 'Use cashless payments to reduce the need to carry cash'],
  ['icon' => 'incognito', 'label' => 'Avoid sharing personal information with passengers'],
  ['icon' => 'battery', 'label' => 'Keep your phone charged and share your working hours if possible'],
  ['icon' => 'kit', 'label' => 'Carry a first aid kit, flashlight and fire extinguisher'],
  ['icon' => 'award', 'label' => 'Dress professionally and stay courteous throughout every journey'],
];

/** Inline SVG icons shared across this page's safety-tip lists. */
function pc_safety_icon(string $icon, string $cls = 'tw-h-6 tw-w-6'): void
{
  switch ($icon):
    case 'id': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 7.5A1.5 1.5 0 014.5 6h15A1.5 1.5 0 0121 7.5v9a1.5 1.5 0 01-1.5 1.5h-15A1.5 1.5 0 013 16.5v-9zM7.5 12.75a2.25 2.25 0 100-4.5 2.25 2.25 0 000 4.5zm0 0c-1.657 0-3 .84-3 2.25v.375h6v-.375c0-1.41-1.343-2.25-3-2.25zM13.5 9.75h5.25M13.5 12.75h5.25"/></svg>
    <?php break;
    case 'wrench': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26"/></svg>
    <?php break;
    case 'signpost': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
    <?php break;
    case 'speed': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21a9 9 0 100-18 9 9 0 000 18z"/><path d="M12 12l3.75-4.5M12 12a1.5 1.5 0 101.5 1.5A1.5 1.5 0 0012 12z"/></svg>
    <?php break;
    case 'phone': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3M3 4.5l18 15"/></svg>
    <?php break;
    case 'lock': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'bulb': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 18h6m-5.25 3h4.5M12 3a6.75 6.75 0 00-4.5 11.786V17.25a.75.75 0 00.75.75h7.5a.75.75 0 00.75-.75v-2.464A6.75 6.75 0 0012 3z"/></svg>
    <?php break;
    case 'warning': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
    <?php break;
    case 'card': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z"/></svg>
    <?php break;
    case 'incognito': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.774 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.243L9.88 9.88"/></svg>
    <?php break;
    case 'battery': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 10.5h.75a.75.75 0 01.75.75v1.5a.75.75 0 01-.75.75H21m-3.75 3.75H6A2.25 2.25 0 013.75 15V9A2.25 2.25 0 016 6.75h11.25A2.25 2.25 0 0119.5 9v6a2.25 2.25 0 01-2.25 2.25zm-7.5-9L7.5 13.5h3l-1.5 3.75 4.5-5.25h-3l1.5-3.75z"/></svg>
    <?php break;
    case 'kit': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 7.5V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 7.5c1.579.05 3.14.162 4.683.337 1.084.122 1.867 1.104 1.867 2.194V18a2.25 2.25 0 01-2.25 2.25H4.5A2.25 2.25 0 012.25 18V10.03c0-1.09.783-2.072 1.867-2.194A47.926 47.926 0 018.25 7.5m7.5 0V9a.75.75 0 01-.75.75h-6a.75.75 0 01-.75-.75V7.5m8.25 6.75h-9v-1.5h9v1.5z"/></svg>
    <?php break;
    case 'award': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16.5 18.75h-9m9 0a3 3 0 013 3h-15a3 3 0 013-3m9 0v-3.375c0-.621-.504-1.125-1.125-1.125h-6.75c-.621 0-1.125.504-1.125 1.125V18.75m8-13.5a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
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
      <div>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Before the Ride</p>
        <h2 class="tw-mb-6 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Set Yourself Up for a Safe Shift</h2>
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
      <div>
        <div class="tw-aspect-[4/3] tw-overflow-hidden tw-rounded-2xl">
          <img src="https://images.pexels.com/photos/5834970/pexels-photo-5834970.jpeg?auto=format&fit=crop&w=1200&q=60" alt="A driver checking passenger details on their phone before a ride" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
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
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Stay Alert, Stay in Control</h2>
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
  <img src="https://images.pexels.com/photos/5834921/pexels-photo-5834921.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="tw-absolute tw-inset-0 tw-z-0 tw-h-full tw-w-full tw-object-cover" loading="lazy">
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-bg-ink-soft/[0.65]" aria-hidden="true"></span>
  <div class="tw-relative tw-z-[1] tw-mx-auto tw-flex tw-min-h-[280px] tw-w-full tw-max-w-[1320px] tw-items-center tw-justify-center tw-px-4 sm:tw-px-6 lg:tw-px-8">
    <p class="tw-mb-0 tw-max-w-[46ch] tw-text-xl tw-font-bold tw-text-white md:tw-text-2xl">Well-lit, busy pickup points keep every trip safer, day or night.</p>
  </div>
</section>

<!-- ============ After the Ride ============ -->
<section class="tw-bg-paper tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-mb-12 tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ After the Ride</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-text-ink md:tw-text-4xl">Carry the Same Care Into Your Next Trip</h2>
    </div>
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 lg:tw-grid-cols-4">
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

<!-- ============ Additional Tips ============ -->
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div class="lg:tw-order-2">
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Additional Tips</p>
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
      <div class="lg:tw-order-1">
        <div class="tw-aspect-[4/3] tw-overflow-hidden tw-rounded-2xl">
          <img src="https://images.pexels.com/photos/8681899/pexels-photo-8681899.jpeg?auto=format&fit=crop&w=1200&q=60" alt="PowerCabs 24/7 support ready to help drivers" class="tw-h-full tw-w-full tw-object-cover" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="tw-px-4 tw-pb-16 tw-text-center sm:tw-px-6 md:tw-pb-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <a class="tw-inline-flex tw-items-center tw-gap-1 tw-rounded-full tw-bg-ink tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-transition tw-duration-200 hover:tw-bg-ink-soft" href="<?= $assetPath ?>/safety-tips-riders">
      See Safety Tips for Riders
      <?php pc_safety_icon('chevron', 'tw-h-3.5 tw-w-3.5'); ?>
    </a>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';

?>
