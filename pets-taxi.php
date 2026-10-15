<?php
$pageTitle = 'Pet Friendly Taxi Dublin | Pets Taxi | PowerCabs';
$pageDescription =
  'Book a pet friendly taxi in Dublin with PowerCabs. Travel with your dog or cat. Book through our app, online, by phone or WhatsApp.';
$assetPath = '';

$pageService = [
  'name' => 'Pets Taxi',
  'serviceType' => 'Pet friendly taxi',
  'description' =>
    'Pet friendly taxi journeys across Dublin for dogs and cats, booked by selecting Pets Taxi so the request is matched with a driver who accepts pet bookings. Subject to suitable driver and vehicle availability.',
];

$petFaqs = [
  [
    'q' => 'Can I travel with my dog or cat?',
    'a' =>
      'Yes, subject to suitable driver and vehicle availability. Select Pets Taxi when you book. Cats should normally travel in a suitable, secure carrier.',
  ],
  [
    'q' => 'Are all PowerCabs taxis pet-friendly?',
    'a' =>
      'No. Not every driver accepts pets, so you must select Pets Taxi. That is what lets the app match your request with a driver who accepts pet bookings.',
  ],
  [
    'q' => 'Do I need to register my pet before my first journey?',
    'a' =>
      'Contact PowerCabs before your first journey to register your pet\'s details and check whether your requirements can be accommodated. Availability is not guaranteed.',
  ],
  [
    'q' => 'Can I book a pet-friendly airport transfer?',
    'a' =>
      'Yes. Request one and book in advance, and share your pet\'s details so dispatch can look for a suitable driver.',
  ],
  [
    'q' => 'Can I travel with more than one pet or a large dog?',
    'a' =>
      'It depends on vehicle and driver availability, the size and number of pets, and how many passengers are travelling. Advance coordination may be necessary, and charges can vary by booking and vehicle.',
  ],
  [
    'q' => 'What if my driver cancels?',
    'a' =>
      'Dispatch will make reasonable efforts to find a replacement, but a suitable vehicle cannot be guaranteed at short notice.',
  ],
  [
    'q' => 'Can I travel with an assistance or guide dog?',
    'a' =>
      'Assistance and guide dogs have specific protections under Irish law and are not treated as ordinary pet journeys. Contact the team and we will help with your booking.',
  ],
];
$pageFaq = $petFaqs;

require __DIR__ . '/includes/header.php';
require __DIR__ . '/components/pets-taxi/icons.php';

$petBookUrl = '/book-ride-online';
$petWhatsapp = 'https://wa.me/353899728089';
$petTelHref = 'tel:+353899728089';
$petTelLabel = '+353 89 972 8089';

ob_start(); ?>
<a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath . $petBookUrl ?>">
  <?php pc_pets_icon('paw', 'tw-h-4 tw-w-4'); ?>
  Book a Pets Taxi
</a>
<a class="<?= $pcBtnGhost ?>" href="<?= $petWhatsapp ?>" target="_blank" rel="noopener">
  <span class="tw-flex tw-h-5 tw-w-5 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[#25d366] tw-text-white">
    <?php pc_pets_icon('whatsapp', 'tw-h-3 tw-w-3'); ?>
  </span>
  Message on WhatsApp
</a>
<?php $heroActions = ob_get_clean();

$heroEyebrow = 'Pets Taxi';
$heroTitleLight = 'Pet Friendly';
$heroTitleBold = 'Taxi in Dublin';
$heroDescription =
  'Travel together with PowerCabs Pets Taxi. Whether you\'re heading to the vet, Dublin Airport, the groomer or visiting family, we\'re here to help you arrange a pet-friendly journey across Dublin.';
$heroBgImage = '/assets/img/pets-taxi-hero.webp';
$heroImageAlt = 'A PowerCabs driver holding the rear door open for a passenger and her golden retriever beside a PowerCabs taxi with its roof sign';
$heroVariant = 'split';
require __DIR__ . '/components/shared/inner-hero.php';

$petTrust = [
  [
    'icon' => 'clock',
    'title' => 'Available 24/7',
    'desc' => 'Pet journeys can be requested at any hour, subject to suitable driver and vehicle availability.',
  ],
  [
    'icon' => 'devices',
    'title' => 'Book the way that suits you',
    'desc' => 'Through the app, online, by phone or on WhatsApp. Dispatch can help arrange a suitable journey where possible.',
  ],
  [
    'icon' => 'calendar',
    'title' => 'Book ahead for the trips that matter',
    'desc' => 'Advance booking is encouraged, particularly for airport transfers and important appointments.',
  ],
];
?>

<section class="<?= $pcSectionTight ?>">
  <div class="<?= $pcContainer ?>">
    <?php  ?>
    <ul class="tw-m-0 tw-grid tw-grid-cols-1 tw-list-none tw-gap-x-10 tw-gap-y-8 tw-p-0 md:tw-grid-cols-3">
      <?php foreach ($petTrust as $t): ?>
        <li class="<?= $pcFeature ?> tw-border-0 tw-border-t-2 tw-border-solid tw-border-hairline tw-pt-5">
          <span class="<?= $pcFeatureIcon ?>" aria-hidden="true"><?php pc_pets_icon($t['icon']); ?></span>
          <p class="<?= pc_mb($pcH4, 'tw-mb-0') ?>"><?= htmlspecialchars($t['title']) ?></p>
          <p class="<?= $pcBodySm ?> tw-mb-0"><?= htmlspecialchars($t['desc']) ?></p>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</section>

<section class="<?= $pcSurfaceWhite ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-2 lg:tw-gap-16">

      <div class="tw-relative tw-mx-auto tw-w-full tw-max-w-[480px]">
        <div class="<?= $pcImgLandscape ?> tw-rounded-2xl tw-shadow-[0_20px_45px_-18px_rgba(28,20,16,0.3)]">
          <img src="<?= $assetPath ?>assets/img/pets-taxi-backseat.webp"
            alt="A golden retriever in a travel harness sitting on a protective seat cover in the back of a PowerCabs taxi"
            width="839" height="629" class="<?= $pcImgCover ?>" loading="lazy" decoding="async">
        </div>
      </div>

      <div>
        <p class="<?= $pcEyebrow ?>">Travel together</p>
        <h2 class="<?= $pcH2 ?>">Select <span class="tw-text-power">Pets Taxi</span> when you book.</h2>
        <p class="<?= $pcBody ?> tw-mb-4 tw-max-w-[52ch]">
          Not every PowerCabs driver accepts pets, so a pet journey is not an ordinary booking. Choosing
          <strong class="tw-font-semibold tw-text-ink">Pets Taxi</strong> is what lets the app match your request with
          available drivers who do &mdash; and if nothing suitable comes back, dispatch may be able to help arrange a
          journey.
        </p>

        <ul class="tw-m-0 tw-mb-6 tw-flex tw-list-none tw-flex-col tw-gap-3 tw-p-0">
          <?php foreach (
            [
              'Travelling for the first time? Contact us to register your pet\'s details and confirm whether your requirements can be accommodated.',
              'Medium and large pets, multiple pets and larger groups may need advance coordination, and charges can vary by booking and vehicle.',
              'A specific driver or vehicle cannot be guaranteed. Review the applicable fare and availability before you confirm.',
            ]
            as $point
          ): ?>
            <li class="tw-flex tw-items-start tw-gap-3">
              <span class="tw-mt-1 tw-inline-flex tw-h-4 tw-w-4 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-peach tw-text-power" aria-hidden="true">
                <svg class="tw-h-2.5 tw-w-2.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round"><path d="M4.5 12.75l6 6 9-13.5"/></svg>
              </span>
              <span class="<?= $pcBodySm ?>"><?= htmlspecialchars($point) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <?php  ?>
        <div class="tw-flex tw-items-start tw-gap-3.5 tw-rounded-2xl tw-border tw-border-solid tw-border-success/20 tw-bg-success/[0.06] tw-p-5">
          <span class="tw-mt-0.5 tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-xl tw-bg-success/10 tw-text-success" aria-hidden="true">
            <?php pc_pets_icon('info', 'tw-h-[1.15rem] tw-w-[1.15rem]'); ?>
          </span>
          <div>
            <h3 class="<?= pc_mb($pcH4, 'tw-mb-1') ?>">Assistance and guide dogs</h3>
            <p class="<?= $pcBodySm ?> tw-mb-0">
              Assistance and guide dogs have specific protections under Irish law and are not treated as ordinary pet
              journeys. Contact the team and we will help with your booking.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php
$petWhy = [
  [
    'icon' => 'devices',
    'title' => 'Book however you like',
    'desc' => 'Request a Pets Taxi through the app, online, by phone or on WhatsApp &mdash; whichever is quickest when your pet needs to be somewhere.',
  ],
  [
    'icon' => 'pin',
    'title' => 'Dublin-based support',
    'desc' => 'A local dispatch team you can actually reach, 24/7, to talk through what your journey needs before you book.',
  ],
  [
    'icon' => 'route',
    'title' => 'Built for everyday trips',
    'desc' => 'The vet, the groomer, Dublin Airport, or a weekend at family &mdash; the routine journeys you already make, with your pet along.',
  ],
  [
    'icon' => 'calendar',
    'title' => 'Reserve ahead',
    'desc' => 'Book in advance for airport transfers and appointments so dispatch has time to look for a suitable driver and vehicle.',
  ],
];
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="<?= $pcSectionHeadCenter ?>">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">Why PowerCabs</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-0') ?>">Why choose PowerCabs Pets Taxi</h2>
    </div>

    <?php  ?>
    <div class="tw-grid tw-grid-cols-1 tw-gap-4 sm:tw-grid-cols-2 lg:tw-grid-cols-4 lg:tw-gap-5">
      <?php foreach ($petWhy as $w): ?>
        <div class="tw-group <?= $pcFeature ?> tw-h-full tw-rounded-2xl tw-border tw-border-solid tw-border-hairline tw-bg-white tw-p-6 tw-shadow-[0_1px_2px_rgba(28,20,16,0.04)] tw-transition tw-duration-300 hover:tw--translate-y-0.5 hover:tw-border-power/25 hover:tw-shadow-[0_14px_30px_-14px_rgba(28,20,16,0.22)] motion-reduce:tw-transform-none motion-reduce:tw-transition-none">
          <span class="<?= $pcFeatureIcon ?> tw-transition-colors tw-duration-300 group-hover:tw-bg-power group-hover:tw-text-white motion-reduce:tw-transition-none" aria-hidden="true">
            <?php pc_pets_icon($w['icon']); ?>
          </span>
          <h3 class="<?= pc_mb($pcH4, 'tw-mb-0') ?>"><?= htmlspecialchars($w['title']) ?></h3>
          <p class="<?= $pcBodySm ?> tw-mb-0"><?= $w['desc'] ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php
$petSteps = [
  ['Enter your pickup and destination', 'Set where you are and where you and your pet are going, the same way as any other PowerCabs booking.'],
  ['Select Pets Taxi', 'This is the step that matters. It is what tells the app to look for drivers who accept pet bookings.'],
  ['Add your pet\'s details', 'Say what you are travelling with &mdash; the type, size and number of pets, and whether there is a carrier.'],
  ['Review the fare and confirm', 'Check the applicable fare and availability for your journey, then confirm the booking.'],
];
?>
<section class="<?= $pcSurfaceWhite ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="<?= $pcSectionHead ?>">
      <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?>">How to book</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Four steps, start to finish.</h2>
      <p class="<?= $pcBody ?> tw-mb-0 <?= $pcMeasure ?>">
        Booking a Pets Taxi works like any other PowerCabs journey, with one extra choice along the way.
      </p>
    </div>

    <?php  ?>
    <ol class="tw-m-0 tw-list-none tw-p-0 <?= $pcStepGrid ?>">
      <?php foreach ($petSteps as $i => [$title, $desc]): ?>
        <li class="<?= $pcStepItem ?>">
          <span class="<?= $pcStepNum ?>"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
          <h3 class="<?= pc_mb($pcH4, 'tw-mb-2') ?>"><?= htmlspecialchars($title) ?></h3>
          <p class="<?= $pcBodySm ?> tw-mb-0"><?= $desc ?></p>
        </li>
      <?php endforeach; ?>
    </ol>

    <div class="tw-mt-10">
      <a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath . $petBookUrl ?>">
        <?php pc_pets_icon('paw', 'tw-h-4 tw-w-4'); ?>
        Book a Pets Taxi
      </a>
    </div>
  </div>
</section>

<?php
$petTips = [
  ['carrier', 'Bring a suitable carrier', 'Cats should normally travel in a secure, well-ventilated carrier. It keeps them calm and keeps the car safe for everyone in it.'],
  ['lead', 'Keep a lead or harness on', 'Dogs travel best secured. A lead or travel harness means your pet stays where you put them for the whole journey.'],
  ['blanket', 'Pack a blanket or seat cover', 'A clean blanket, towel or waterproof seat cover protects the upholstery and gives your pet something familiar to settle on.'],
  ['shield', 'Stay in control throughout', 'Your pet stays your responsibility for the journey. Keeping them calm and under control is what makes the next pet booking easy too.'],
];
?>
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-10 lg:tw-grid-cols-[minmax(0,1fr)_minmax(0,1.15fr)] lg:tw-gap-16">

      <div class="tw-relative tw-mx-auto tw-w-full tw-max-w-[440px] lg:tw-order-2">
        <div class="<?= $pcImgLandscape ?> tw-rounded-2xl tw-shadow-[0_20px_45px_-18px_rgba(28,20,16,0.3)]">
          <img src="<?= $assetPath ?>assets/img/pets-taxi-carrier.webp"
            alt="A tabby cat resting in a secure pet carrier strapped onto the back seat of a taxi"
            width="620" height="465" class="<?= $pcImgCover ?>" loading="lazy" decoding="async">
        </div>
      </div>

      <div class="lg:tw-order-1">
        <p class="<?= $pcEyebrow ?>">Before you travel</p>
        <h2 class="<?= pc_mb($pcH2, 'tw-mb-8') ?>">Four things that make the trip easier.</h2>

        <ul class="tw-m-0 tw-grid tw-list-none tw-grid-cols-1 tw-gap-6 tw-p-0 sm:tw-grid-cols-2">
          <?php foreach ($petTips as [$icon, $title, $desc]): ?>
            <li class="<?= $pcFeature ?>">
              <span class="<?= $pcFeatureIcon ?>" aria-hidden="true"><?php pc_pets_icon($icon); ?></span>
              <h3 class="<?= pc_mb($pcH4, 'tw-mb-0') ?>"><?= htmlspecialchars($title) ?></h3>
              <p class="<?= $pcBodySm ?> tw-mb-0"><?= htmlspecialchars($desc) ?></p>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

    </div>
  </div>
</section>

<section class="<?= $pcSurfaceWhite ?> <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-gap-10 lg:tw-grid-cols-2 lg:tw-gap-16">

      <div>
        <p class="<?= $pcEyebrow ?>">Safety and cleanliness</p>
        <h2 class="<?= $pcH2 ?>">A clean car for the next passenger.</h2>
        <p class="<?= $pcBody ?> tw-mb-4 <?= $pcMeasure ?>">
          Drivers who take pet bookings do it because they like having animals in the car. Keeping it that way is a
          shared job: your driver brings a vehicle that is clean and ready, and a little preparation at your end keeps
          it that way for whoever rides next.
        </p>
        <p class="<?= $pcBody ?> tw-mb-0 <?= $pcMeasure ?>">
          A carrier, a lead or harness and a blanket or waterproof seat cover handle almost everything. If your pet is
          anxious in cars, or your journey is a long one, tell dispatch when you book so the right vehicle can be
          looked for.
        </p>
      </div>

      <?php  ?>
      <div class="tw-rounded-3xl tw-border tw-border-solid tw-border-hairline tw-bg-paper-soft tw-p-6 sm:tw-p-8">
        <span class="<?= $pcIconChip ?> tw-mb-4" aria-hidden="true"><?php pc_pets_icon('euro', 'tw-h-[1.35rem] tw-w-[1.35rem]'); ?></span>
        <h2 class="<?= pc_mb($pcH2Small, 'tw-mb-3') ?>">Cleaning and soiling charges</h2>
        <p class="<?= $pcBodySm ?> tw-mb-4">
          If a vehicle is soiled or damaged during a journey, a charge may apply under the applicable National
          Transport Authority rules, up to the permitted maximum of <strong class="tw-font-semibold tw-text-ink">&euro;140</strong>.
          Any charge reflects the reasonable cost of cleaning or repair for what actually happened &mdash; it is a
          regulatory ceiling, not a standard fee, and not something that applies to an ordinary pet journey.
        </p>
        <p class="<?= $pcBodySm ?> tw-mb-4">
          Where a card is held on file, charging it is subject to your customer terms, a valid payment authorisation,
          your payment provider's requirements and applicable law.
        </p>
        <p class="<?= $pcBodySm ?> tw-mb-0 tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-pt-4">
          Think a charge is wrong? <a class="tw-font-semibold tw-text-power tw-underline tw-decoration-power/40 tw-decoration-2 tw-underline-offset-4 tw-transition-colors tw-duration-200 hover:tw-decoration-power" href="<?= $assetPath ?>/contact-us">Contact PowerCabs</a>
          and we will look into it with you.
        </p>
      </div>

    </div>
  </div>
</section>

<?php
$supportEyebrow = 'Regular pet travellers';
$supportHeading = 'Travelling with your pet often? Talk to dispatch.';
$supportText =
  'If your pet travels with you regularly, get in touch and tell us about them. Having your pet\'s details on file makes future bookings quicker, and we can talk through what your journeys usually need.';
$supportNumber = $petTelLabel;
$supportTel = '+353899728089';
$supportWhatsapp = $petWhatsapp;
$supportHours = 'Available 24/7, subject to suitable driver and vehicle availability.';

$supportImage = $assetPath . 'assets/img/pets-taxi-band.webp';
require __DIR__ . '/components/shared/support-band.php';

$faqItems = $petFaqs; 
$faqEyebrow = 'Pet travel';
$faqHeading = 'Pets Taxi questions.';
$faqLayout = 'split';
$faqMoreHref = '/faqs';

require __DIR__ . '/components/shared/faq-accordion.php';
?>

<?php  ?>
<section class="tw-border-0 tw-border-t tw-border-solid tw-border-hairline tw-bg-white <?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <div class="tw-flex tw-flex-col tw-items-start tw-gap-8 lg:tw-flex-row lg:tw-items-center lg:tw-justify-between">

      <div class="tw-max-w-[46ch]">
        <p class="<?= pc_mb($pcEyebrow, 'tw-mb-2') ?> tw-inline-flex tw-items-center tw-gap-1.5">
          <?php pc_pets_icon('paw', 'tw-h-3.5 tw-w-3.5'); ?>
          Pets Taxi
        </p>
        <h2 class="<?= $pcH2 ?>">Your pet. Your journey. <span class="tw-text-power">PowerCabs.</span></h2>
        <p class="tw-mb-0 <?= $pcBody ?>">
          Book a pet-friendly taxi in Dublin, or talk to us first if you would rather check what your journey needs.
        </p>
      </div>

      <div class="tw-flex tw-flex-wrap tw-gap-3">
        <a class="<?= $pcBtnPrimary ?>" href="<?= $assetPath . $petBookUrl ?>">
          <?php pc_pets_icon('paw', 'tw-h-4 tw-w-4'); ?>
          Book a Pets Taxi
        </a>
        <a class="<?= $pcBtnGhost ?>" href="<?= $petWhatsapp ?>" target="_blank" rel="noopener">
          <span class="tw-flex tw-h-5 tw-w-5 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-[#25d366] tw-text-white" aria-hidden="true">
            <?php pc_pets_icon('whatsapp', 'tw-h-3 tw-w-3'); ?>
          </span>
          WhatsApp
        </a>
        <?php  ?>
        <a class="<?= $pcBtnGhost ?>" href="<?= $petTelHref ?>" aria-label="Call PowerCabs on <?= htmlspecialchars($petTelLabel) ?>">
          <?php pc_pets_icon('phone', 'tw-h-4 tw-w-4'); ?>
          <?= htmlspecialchars($petTelLabel) ?>
        </a>
      </div>

    </div>
  </div>
</section>

<?php
$bannerCompact = true; 
require __DIR__ . '/components/shared/app-download-banner.php';

require __DIR__ . '/includes/footer.php';
