<?php
$pageTitle = 'Wheelchair Accessible Taxis in Dublin | PowerCabs';
$pageDescription =
  'Wheelchair accessible taxis in Dublin from PowerCabs -- safe, comfortable rides with trained drivers, secure wheelchair vehicles, and 24/7 availability across Ireland.';
$assetPath = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Accessibility';
$heroTitleLight = 'Wheelchair';
$heroTitleBold = 'Accessible Taxis.';
$heroDescription =
  'PowerCabs provides safe, comfortable, and fully accessible taxi services for passengers with mobility needs. The service focuses on reliability, trained drivers, and vehicles equipped to safely transport wheelchair users.';
$heroBgImage = 'https://images.pexels.com/photos/35831412/pexels-photo-35831412.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

$whyChoose = [
  ['icon' => 'shield', 'title' => 'Safety First', 'desc' => 'Every accessible vehicle and driver meets strict safety standards.'],
  ['icon' => 'clock', 'title' => 'Reliable Service', 'desc' => 'Punctual pickups you can plan appointments and travel around.'],
  ['icon' => 'phone', 'title' => 'Easy Booking', 'desc' => 'Book in seconds through the app, website, or a quick phone call.'],
  ['icon' => 'thumbsup', 'title' => 'Friendly Assistance', 'desc' => 'Drivers trained to help confidently and respectfully, every trip.'],
  ['icon' => 'people', 'title' => 'Accessible for Everyone', 'desc' => 'Inclusive transportation, wherever and whenever you need it.'],
];

function pc_wc_icon(string $icon): void
{
  $common = 'tw-mb-3 tw-h-8 tw-w-8 tw-text-power';
  switch ($icon):
    case 'shield': ?>
      <svg class="<?= $common ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
      <?php break;
    case 'clock': ?>
      <svg class="<?= $common ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6l4 2M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      <?php break;
    case 'phone': ?>
      <svg class="<?= $common ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5M9 18h6"/></svg>
      <?php break;
    case 'thumbsup': ?>
      <svg class="<?= $common ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6.633 10.5c.806 0 1.533-.4 2.031-1.038a9.72 9.72 0 013.877-2.756c.34-.135.68-.283.994-.463a2.25 2.25 0 011.115-.294h2.6c1.243 0 2.25 1.007 2.25 2.25v9.75c0 1.243-1.007 2.25-2.25 2.25h-2.6a2.25 2.25 0 01-1.115-.294 8.968 8.968 0 00-2.7-1.02 6.09 6.09 0 01-2.02-.94M6.633 10.5H4.5v9.75h2.133M6.633 10.5c-.055 0-.109.01-.163.028M6.633 20.25c.055 0 .109-.01.163-.028"/></svg>
      <?php break;
    case 'people': ?>
      <svg class="<?= $common ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
      <?php break;
  endswitch;
}
?>

<!-- ============ Overview ============ -->
<section class="<?= $pcSection ?> tw-text-center">
  <div class="<?= $pcContainerProse ?>">
    <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Overview</p>
    <h2 class="tw-mb-3 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Reliable, Dignified Travel for Every Passenger</h2>
    <p class="tw-mb-0 tw-text-xl tw-leading-[1.7] tw-text-ink/60">
      PowerCabs provides safe, comfortable, and fully accessible taxi services for passengers
      with mobility needs. The service focuses on reliability, trained drivers, and vehicles
      equipped to safely transport wheelchair users, on every kind of journey.
    </p>
  </div>
</section>

<section class="tw-relative tw-overflow-hidden tw-bg-paper <?= $pcSection ?>">
  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2">
      <div class="tw-relative tw-mx-auto tw-w-full">
        <span class="tw-pointer-events-none tw-absolute tw-bottom-[-20px] tw-right-[-20px] tw-z-0 tw-h-[150px] tw-w-[150px] tw-rounded-[2rem] tw-bg-power/[0.12] tw-blur-[2px]" aria-hidden="true"></span>
        <div class="tw-relative tw-z-[1] tw-min-h-[420px] tw-overflow-hidden tw-rounded-[2rem] tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)]">
          <img src="<?= $assetPath ?>assets/img/wheelchair-accessible.png"
            alt="PowerCabs wheelchair accessible taxi in Dublin" class="tw-absolute tw-inset-0 tw-h-full tw-w-full tw-object-cover tw-object-center" loading="lazy">
        </div>
      </div>

      <div>
        <h2 class="tw-mb-4 tw-text-3xl tw-font-bold tw-leading-[1.08] tw-tracking-tight tw-text-ink md:tw-text-4xl">
          Mobility for <span class="tw-text-power">everyone.</span>
        </h2>
        <p class="tw-mb-6 tw-max-w-[500px] tw-text-base tw-leading-[1.75] tw-text-ink/60">
          At PowerCabs, we're committed to making every journey
          comfortable, safe and accessible. Our wheelchair-accessible
          taxis are designed to provide dependable transportation
          for passengers with mobility needs.
        </p>

        <div class="tw-mb-6 tw-flex tw-flex-col tw-gap-4">
          <div class="tw-flex tw-items-start tw-gap-3">
            <span class="tw-flex tw-h-10 tw-w-10 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-power/10 tw-text-power">
              <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="4.5" r="1.5"/><path d="M12 8v4.5l3 2.5M9 12.5H6l-1.5 6.5M12 12.5l2 3.5 4 1M9 19l1.5-3"/></svg>
            </span>
            <div>
              <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink">Wheelchair Accessible</h3>
              <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Vehicles equipped to accommodate wheelchair users comfortably.</p>
            </div>
          </div>

          <div class="tw-flex tw-items-start tw-gap-3">
            <span class="tw-flex tw-h-10 tw-w-10 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-power/10 tw-text-power">
              <svg class="tw-h-5 tw-w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
            </span>
            <div>
              <h3 class="tw-mb-1 tw-text-base tw-font-bold tw-text-ink">Safe &amp; Comfortable</h3>
              <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60">Supportive journeys with accessibility and passenger comfort in mind.</p>
            </div>
          </div>
        </div>

        <a class="tw-inline-flex tw-items-center tw-rounded-full tw-bg-powerlight tw-px-6 tw-py-2.5 tw-text-sm tw-font-semibold tw-text-white tw-no-underline tw-shadow-[0_18px_40px_rgba(255,122,0,0.35)] tw-transition tw-duration-200 hover:-tw-translate-y-0.5 hover:tw-shadow-[0_22px_50px_rgba(255,122,0,0.5)]" href="<?= $assetPath ?>/book-ride-online">Book an Accessible Ride</a>
      </div>
    </div>
  </div>
</section>

<!-- ============ Why Choose PowerCabs ============ -->
<section class="tw-relative tw-overflow-hidden tw-bg-white <?= $pcSection ?>">
  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-mx-auto tw-mb-10 tw-max-w-[60ch] tw-text-center">
      <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-power">/ Why Choose PowerCabs</p>
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Accessible Travel, Done Right</h2>
    </div>

    <div class="tw-mx-auto tw-mb-4 tw-grid tw-max-w-[1320px] tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 md:tw-grid-cols-3">
      <?php foreach (array_slice($whyChoose, 0, 3) as $item): ?>
        <div class="tw-rounded-2xl tw-bg-white tw-p-6 tw-text-center tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)]">
          <?php pc_wc_icon($item['icon']); ?>
          <h3 class="tw-mb-2 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($item['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="tw-mx-auto tw-grid tw-max-w-[700px] tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2">
      <?php foreach (array_slice($whyChoose, 3, 2) as $item): ?>
        <div class="tw-rounded-2xl tw-bg-white tw-p-6 tw-text-center tw-shadow-[0_8px_20px_rgba(28,20,16,0.1)]">
          <?php pc_wc_icon($item['icon']); ?>
          <h3 class="tw-mb-2 tw-text-base tw-font-bold tw-text-ink"><?= htmlspecialchars($item['title']) ?></h3>
          <p class="tw-mb-0 tw-text-[1.0625rem] tw-leading-relaxed tw-text-ink/60"><?= htmlspecialchars($item['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
