<?php
$pageTitle       = 'Corporate Taxi Accounts in Dublin | PowerCabs';
$pageDescription = 'Reliable, flexible, safe corporate transportation in Dublin from PowerCabs -- business travel, event transportation and ongoing corporate accounts, available 24/7.';
$assetPath       = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError  = '';
$old = ['name' => '', 'email' => '', 'business_name' => '', 'employee_count' => '', 'mobile' => '', 'address' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $key => $default) {
        $old[$key] = trim($_POST[$key] ?? '');
    }

    if ($old['name'] === '' || $old['email'] === '' || $old['business_name'] === '' || $old['mobile'] === '') {
        $formStatus = 'error';
        $formError  = 'Please fill in all required fields.';
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $formStatus = 'error';
        $formError  = 'Please enter a valid email address.';
    } else {
        $body = "New corporate account registration from the PowerCabs website.\n\n"
              . "Name: {$old['name']}\n"
              . "Email: {$old['email']}\n"
              . "Business Name: {$old['business_name']}\n"
              . "Number of Employees: " . ($old['employee_count'] !== '' ? $old['employee_count'] : '-') . "\n"
              . "Mobile: {$old['mobile']}\n"
              . "Address: " . ($old['address'] !== '' ? $old['address'] : '-') . "\n";

        $result = pc_send_mail(
            'Corporate account: ' . $old['business_name'],
            $body,
            ['name' => $old['name'], 'email' => $old['email']]
        );

        if ($result['success']) {
            $formStatus = 'success';
            foreach ($old as $key => $default) {
                $old[$key] = '';
            }
        } else {
            $formStatus = 'error';
            $formError  = 'Sorry, something went wrong sending your registration. Please try again or call us directly.';
        }
    }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Corporate Services';
$heroTitleLight  = 'Corporate Services with';
$heroTitleBold   = 'PowerCabs.';
$heroDescription = "Reliable, flexible, and safe business transportation, available 24/7 -- built around your company's schedule, not the other way around.";
$heroBgImage     = 'https://images.pexels.com/photos/8425382/pexels-photo-8425382.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';

require __DIR__ . '/components/corporate/why-businesses.php';
?>

<!-- ============ Services Overview ============ -->
<?php
$corporateServices = [
  ['img' => 'assets/img/services-corporate.jpg', 'alt' => 'Executives entering a premium PowerCabs vehicle', 'title' => 'Business Travel', 'desc' => 'Executive rides for meetings, client visits, and the daily commute.'],
  ['img' => 'assets/img/service-city-tour.jpg', 'alt' => 'Guests arriving at a conference venue', 'title' => 'Event Transportation', 'desc' => 'Coordinated arrivals and departures for conferences and corporate events.'],
  ['img' => 'assets/img/service-airport.png', 'alt' => 'A chauffeur waiting beside a luxury vehicle', 'title' => 'Ongoing Corporate Transport', 'desc' => 'Flexible multi-day and ongoing accounts, tailored to your business.'],
];
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-mb-10 tw-text-center">
      <h2 class="tw-mb-0 tw-text-3xl tw-font-bold tw-tracking-tight tw-text-ink md:tw-text-4xl">Services Overview</h2>
    </div>
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-3">
      <?php foreach ($corporateServices as $service): ?>
        <a href="#corporate-account-form" class="tw-group tw-relative tw-block tw-aspect-square tw-overflow-hidden tw-rounded-[20px] tw-border tw-border-solid tw-border-white/[0.08] tw-no-underline tw-shadow-[0_2px_4px_rgba(0,0,0,0.075)]">
          <img src="<?= $assetPath . $service['img'] ?>" alt="<?= htmlspecialchars($service['alt']) ?>" class="tw-block tw-h-full tw-w-full tw-object-cover tw-transition-transform tw-duration-500 tw-ease-out group-hover:tw-scale-105 motion-reduce:tw-transition-none" loading="lazy">
          <span class="tw-absolute tw-inset-0 tw-bg-black/[0.15] tw-transition-opacity tw-duration-500 group-hover:tw-opacity-30 motion-reduce:tw-transition-none" aria-hidden="true"></span>
          <span class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-bg-[linear-gradient(to_top,rgba(10,7,5,0.8)_0%,rgba(10,7,5,0.35)_65%,rgba(10,7,5,0)_100%)] tw-p-4 tw-pt-[4.5rem] tw-backdrop-blur-[10px] [-webkit-mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)] [mask-image:linear-gradient(to_bottom,transparent_0%,#000_40%)]">
            <span class="tw-mb-1 tw-block tw-text-xl tw-font-bold tw-text-white"><?= htmlspecialchars($service['title']) ?></span>
            <span class="tw-block tw-text-sm tw-text-white/60"><?= htmlspecialchars($service['desc']) ?></span>
          </span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require __DIR__ . '/components/corporate/account-form.php'; ?>

<!-- ============ Mission ============ -->
<section class="tw-relative tw-overflow-hidden tw-py-[clamp(4rem,8vw,6rem)] tw-text-center tw-text-white">
  <img src="<?= $assetPath ?>assets/img/trusted-bg.svg" alt="" aria-hidden="true" class="tw-absolute tw-inset-0 tw-z-0 tw-h-full tw-w-full tw-object-cover">
  <span class="tw-absolute tw-inset-0 tw-z-0 tw-bg-[rgba(10,7,5,0.72)]" aria-hidden="true"></span>
  <div class="tw-relative <?= $pcContainer ?>">
    <p class="tw-mb-3 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-powerlight">/ Our Mission</p>
    <p class="tw-mx-auto tw-mb-0 tw-max-w-[60ch] tw-text-2xl tw-text-white/85">
      To deliver consistent, memorable corporate travel experiences -- so every client,
      colleague, and guest arrives exactly as your business intends them to: on time,
      comfortable, and impressed.
    </p>
  </div>
</section>

<?php require __DIR__ . '/components/corporate/benefits.php'; ?>

<?php
// require __DIR__ . '/components/corporate/account-form.php';
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
