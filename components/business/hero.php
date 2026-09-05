<?php

if (!isset($heroBreadcrumbLabel)) {
  $heroBreadcrumbLabel = ucwords(str_replace('-', ' ', preg_replace('/\.php$/', '', $currentPage ?? 'business')));
}

$breadcrumbSiteUrl = $siteUrl ?? 'https://www.powercabs.ie/';
$breadcrumbPageUrl = $canonicalUrl ?? $breadcrumbSiteUrl . ($currentPage ?? 'business');

$breadcrumbSchema = [
  '@context' => 'https://schema.org',
  '@type' => 'BreadcrumbList',
  'itemListElement' => [
    ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => $breadcrumbSiteUrl],
    ['@type' => 'ListItem', 'position' => 2, 'name' => $heroBreadcrumbLabel, 'item' => $breadcrumbPageUrl],
  ],
];

$bizHeroChecks = [
  'One account',
  'Monthly billing',
  'Airport transfers',
  'Multiple users',
  'Journey history',
  'Business support',
];

// Both floating chips share everything but their corner and their delay, so
// the two animations don't march in lockstep.
$bizChipBase =
  'tw-absolute tw-z-[2] tw-flex tw-max-w-[78%] tw-items-center tw-gap-2 tw-rounded-xl tw-bg-white/[0.94] tw-px-[0.9rem] tw-py-[0.6rem] tw-shadow-[0_24px_48px_rgba(232,89,12,0.14)] tw-backdrop-blur-[10px] tw-animate-pc-float-fast motion-reduce:tw-animate-none';
$bizChipDot = 'tw-inline-flex tw-h-[30px] tw-w-[30px] tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full';
?>
<script type="application/ld+json"><?= json_encode(
  $breadcrumbSchema,
  JSON_HEX_TAG | JSON_HEX_AMP | JSON_UNESCAPED_SLASHES,
) ?></script>

<!-- Top padding keys off --pc-navbar-h, the live-measured header height that
     main.js keeps in sync, so the hero clears the fixed bar at any width. -->
<section class="tw-relative tw-overflow-hidden tw-bg-[radial-gradient(120%_100%_at_12%_0%,#fbe4cf_0%,#f9f4ed_45%,#ffffff_100%)] tw-pb-[clamp(3rem,6vw,5rem)] tw-pt-[calc(var(--pc-navbar-h,110px)+2rem)]">
  <div class="tw-relative <?= $pcContainer ?>">
    <nav aria-label="breadcrumb" class="tw-mb-4">
      <ol class="tw-m-0 tw-flex tw-list-none tw-items-center tw-gap-2 tw-p-0 tw-text-[0.82rem]">
        <li><a class="tw-text-ink/[0.65] tw-no-underline hover:tw-text-power" href="<?= $assetPath ?>/">Home</a></li>
        <li aria-hidden="true" class="tw-text-ink/40">//</li>
        <li class="tw-font-semibold tw-text-ink" aria-current="page"><?= htmlspecialchars($heroBreadcrumbLabel) ?></li>
      </ol>
    </nav>

    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="tw-mb-3 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-power">/ PowerCabs Business</p>

        <h1 class="tw-mb-3 tw-text-[clamp(2.1rem,4vw,3.1rem)] tw-font-bold tw-leading-[1.1] tw-tracking-[-0.01em] tw-text-ink">
          Business taxi travel,<br>made simple.
        </h1>

        <p class="tw-mb-4 tw-max-w-[44ch] tw-text-[1.15rem] tw-text-ink/[0.65]">
          Reliable taxi travel for your employees, clients and guests &mdash; with one
          business account, simple billing and complete journey visibility.
        </p>

        <div class="tw-mb-4 tw-flex tw-flex-wrap tw-items-center tw-gap-3">
          <!-- The offset ring on hover is the site's primary-button signature
               (an ::after inset by -4px), reproduced here with after: utilities. -->
          <a class="tw-relative tw-inline-flex tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-powerlight tw-bg-powerlight tw-px-6 tw-py-2.5 tw-font-medium tw-text-white tw-no-underline after:tw-pointer-events-none after:tw-absolute after:-tw-inset-1 after:tw-rounded-full after:tw-border-[1.5px] after:tw-border-solid after:tw-border-powerlight after:tw-opacity-0 after:tw-transition-opacity after:tw-duration-200 after:tw-content-[''] hover:after:tw-opacity-100 focus-visible:after:tw-opacity-100" href="#business-booking-form">Open a Free Business Account</a>
          <a class="tw-inline-flex tw-items-center tw-gap-2 tw-py-[0.4rem] tw-font-semibold tw-text-ink tw-no-underline tw-transition-opacity tw-duration-200 hover:tw-opacity-70 focus-visible:tw-opacity-70" href="tel:+35312030727">
            <span class="tw-inline-flex tw-h-9 tw-w-9 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-peach tw-text-power">
              <svg class="tw-h-[0.9rem] tw-w-[0.9rem]" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M3.654 1.328a.678.678 0 00-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.57 17.57 0 004.168 6.608 17.569 17.569 0 006.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 00-.063-1.015l-2.307-1.794a.678.678 0 00-.58-.122l-2.19.547a1.745 1.745 0 01-1.657-.459L5.482 8.062a1.745 1.745 0 01-.46-1.657l.548-2.19a.678.678 0 00-.122-.58L3.654 1.328z"/></svg>
            </span>
            Talk to Our Team
          </a>
        </div>

        <ul class="tw-m-0 tw-grid tw-grid-cols-2 tw-gap-2 tw-list-none tw-p-0">
          <?php foreach ($bizHeroChecks as $check): ?>
            <li class="tw-flex tw-items-center tw-gap-2">
              <svg class="tw-h-[0.9rem] tw-w-[0.9rem] tw-shrink-0 tw-text-power" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M16 8A8 8 0 110 8a8 8 0 0116 0zm-3.97-3.03a.75.75 0 00-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 10-1.06 1.06L6.97 11.03a.75.75 0 001.079-.02l3.992-4.99a.75.75 0 00-.01-1.05z"/></svg>
              <span class="tw-text-sm tw-font-medium tw-text-ink"><?= htmlspecialchars($check) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <div>
        <div class="tw-relative tw-mx-auto tw-aspect-square tw-max-w-[460px] tw-overflow-hidden tw-rounded-[28px] tw-shadow-[0_30px_70px_rgba(28,20,16,0.18)]">
          <img src="<?= $assetPath ?>assets/img/services-corporate.jpg" alt="Business traveller in the back seat of a PowerCabs vehicle, on the way to a meeting" class="tw-h-full tw-w-full tw-object-cover" loading="eager">

          <div class="<?= $bizChipBase ?> tw-left-[1.1rem] tw-top-[1.1rem]">
            <span class="<?= $bizChipDot ?> tw-bg-[rgba(25,135,84,0.12)]">
              <svg class="tw-h-[0.9rem] tw-w-[0.9rem] tw-text-[#198754]" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M16 8A8 8 0 110 8a8 8 0 0116 0zm-3.97-3.03a.75.75 0 00-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 10-1.06 1.06L6.97 11.03a.75.75 0 001.079-.02l3.992-4.99a.75.75 0 00-.01-1.05z"/></svg>
            </span>
            <span class="tw-flex tw-flex-col tw-leading-tight">
              <strong class="tw-text-sm">Booking Confirmed</strong>
              <small class="tw-text-[0.68rem] tw-text-ink/[0.65]">Dublin &rarr; Airport &middot; 08:45</small>
            </span>
          </div>

          <div class="<?= $bizChipBase ?> tw-bottom-[1.1rem] tw-right-[1.1rem] [animation-delay:0.9s]">
            <span class="<?= $bizChipDot ?> tw-bg-peach tw-text-power">
              <svg class="tw-h-[0.85rem] tw-w-[0.85rem]" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"><path d="M6.5 1A1.5 1.5 0 005 2.5V3H1.5A1.5 1.5 0 000 4.5v8A1.5 1.5 0 001.5 14h13a1.5 1.5 0 001.5-1.5v-8A1.5 1.5 0 0014.5 3H11v-.5A1.5 1.5 0 009.5 1h-3zm0 1h3a.5.5 0 01.5.5V3H6v-.5a.5.5 0 01.5-.5z"/></svg>
            </span>
            <span class="tw-flex tw-flex-col tw-leading-tight">
              <strong class="tw-text-sm">Business Account</strong>
              <small class="tw-text-[0.68rem] tw-text-ink/[0.65]">One invoice, every journey</small>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
