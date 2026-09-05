<?php
http_response_code(404);
$pageTitle = '404 - Page Not Found | PowerCabs';
$pageDescription = "The page you're looking for doesn't exist or may have been moved.";
$assetPath = '/';

// This page stands alone -- no header.php, so no <main>, no nav, no footer
// (a 404 should not invite the user back into a broken navigation). It still
// pulls in the design system so its container and buttons are the same
// recipes every other page uses, rather than a one-off.
require __DIR__ . '/includes/design-system.php';

// Somewhere useful to go next, rather than a dead end.
$notFoundLinks = [
  ['href' => '/ride', 'label' => 'Book a Ride', 'desc' => 'Fares, ride types and quick booking'],
  ['href' => '/drive', 'label' => 'Drive with Us', 'desc' => 'Earn on your own schedule'],
  ['href' => '/business', 'label' => 'Business', 'desc' => 'Corporate accounts and billing'],
  ['href' => '/contact-us', 'label' => 'Contact Us', 'desc' => 'Talk to our support team'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta name="robots" content="noindex, follow">

  <link rel="stylesheet" href="/assets/css/reboot.css?v=<?= @filemtime(__DIR__ . '/assets/css/reboot.css') ?>">
  <link rel="stylesheet" href="/assets/css/variables.css?v=<?= @filemtime(__DIR__ . '/assets/css/variables.css') ?>">
  <link rel="stylesheet" href="/assets/css/base.css?v=<?= @filemtime(__DIR__ . '/assets/css/base.css') ?>">
  <?php require __DIR__ . '/includes/tailwind.php'; ?>
</head>
<body>

<?php require __DIR__ . '/components/shared/page-loader.php'; ?>

<section class="tw-relative tw-flex tw-min-h-screen tw-items-center tw-overflow-hidden tw-bg-paper-soft tw-py-16 md:tw-py-24">
  <!-- Two soft brand glows, the same device the Business hero uses -- enough
       warmth that the page reads as PowerCabs rather than a server error. -->
  <span class="tw-pointer-events-none tw-absolute tw-right-[-10rem] tw-top-[-6rem] tw-h-[30rem] tw-w-[30rem] tw-rounded-full tw-bg-[radial-gradient(circle,rgba(255,122,0,0.18),transparent_70%)] tw-blur-[60px]" aria-hidden="true"></span>
  <span class="tw-pointer-events-none tw-absolute tw-bottom-[-8rem] tw-left-[-8rem] tw-h-[24rem] tw-w-[24rem] tw-rounded-full tw-bg-[radial-gradient(circle,rgba(251,228,207,0.9),transparent_70%)] tw-blur-[60px]" aria-hidden="true"></span>

  <div class="tw-relative <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">

      <!-- LEFT: the message -->
      <div class="tw-order-2 lg:tw-order-1">
        <p class="<?= $pcEyebrow ?>">/ Error 404</p>

        <h1 class="tw-mb-4 tw-text-[clamp(2rem,4.5vw,3rem)] tw-font-bold tw-leading-[1.1] tw-tracking-tight tw-text-ink">
          This page took a wrong turn.
        </h1>

        <p class="tw-mb-8 tw-max-w-[46ch] tw-text-lg tw-leading-relaxed tw-text-ink/[0.65]">
          <?= htmlspecialchars($pageDescription) ?> Let's get you back on route.
        </p>

        <div class="tw-mb-10 tw-flex tw-flex-wrap tw-items-center tw-gap-3">
          <a href="/" class="<?= $pcBtnPrimary ?>">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M8.354 1.146a.5.5 0 00-.708 0l-6 6A.5.5 0 001.5 7.5v7a.5.5 0 00.5.5h4a.5.5 0 00.5-.5v-4h3v4a.5.5 0 00.5.5h4a.5.5 0 00.5-.5v-7a.5.5 0 00-.146-.354L13 4.793V2.5a.5.5 0 00-.5-.5h-1a.5.5 0 00-.5.5v.293L8.354 1.146z"/></svg>
            Back to Home
          </a>
          <a href="/book-ride-online" class="<?= $pcBtnDark ?>">
            <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 11l1.5-4.5A2 2 0 0 1 8.4 5h7.2a2 2 0 0 1 1.9 1.5L19 11m-14 0h14m-14 0a2 2 0 0 0-2 2v4h2m14-6a2 2 0 0 1 2 2v4h-2m-14 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1m10 0v1a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1v-1m-14 0h14"/></svg>
            Book Online
          </a>
        </div>

        <!-- Rather than dead-ending, offer the four places people actually
             want. Same card language as the rest of the site. -->
        <p class="tw-mb-3 tw-text-xs tw-font-semibold tw-uppercase tw-tracking-[0.06em] tw-text-ink/50">Or try one of these</p>
        <div class="tw-grid tw-grid-cols-1 tw-gap-2 sm:tw-grid-cols-2">
          <?php foreach ($notFoundLinks as $link): ?>
            <a href="<?= htmlspecialchars($link['href']) ?>"
              class="tw-group tw-flex tw-items-center tw-justify-between tw-gap-3 tw-rounded-xl tw-border tw-border-solid tw-border-black/[0.08] tw-bg-white tw-px-4 tw-py-3 tw-no-underline tw-transition tw-duration-200 hover:tw-border-power/30 hover:tw-shadow-[0_10px_25px_rgba(28,20,16,0.10)] motion-reduce:tw-transition-none">
              <span class="tw-min-w-0">
                <span class="tw-block tw-text-sm tw-font-semibold tw-text-ink group-hover:tw-text-power"><?= htmlspecialchars($link['label']) ?></span>
                <span class="tw-block tw-truncate tw-text-xs tw-text-ink/[0.55]"><?= htmlspecialchars($link['desc']) ?></span>
              </span>
              <svg class="tw-h-4 tw-w-4 tw-shrink-0 tw-text-ink/30 tw-transition-transform tw-duration-200 group-hover:tw-translate-x-0.5 group-hover:tw-text-power motion-reduce:tw-transition-none" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- RIGHT: illustration, with a ghost 404 behind it -->
      <div class="tw-order-1 lg:tw-order-2">
        <div class="tw-relative tw-mx-auto tw-max-w-[520px]">
          <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-flex tw-select-none tw-items-center tw-justify-center tw-text-[clamp(9rem,22vw,16rem)] tw-font-black tw-leading-none tw-tracking-tight tw-text-ink/[0.04]" aria-hidden="true">404</span>
          <img src="/assets/img/not-found.svg" alt="" aria-hidden="true"
            class="tw-relative tw-mx-auto tw-h-auto tw-w-full tw-max-w-[440px]">
        </div>
      </div>

    </div>
  </div>
</section>

<script src="/assets/js/components/page-loader.js"></script>
</body>
</html>
