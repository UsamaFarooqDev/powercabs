<section class="tw-scroll-mt-24 tw-py-16 md:tw-py-24" id="business-booking-form">
  <div class="<?= $pcContainer ?>">
    <?php /* The five-icon feature row that sat here is gone.
             It was headed "How to Book Our Business Rides" but listed Priority
             Booking, Monthly Billing, Multiple Users, Ride History and
             Corporate Support -- account features, not booking steps. Three of
             the five restated account-benefits.php almost word for word
             (Monthly Billing / Simple Billing, Ride History / Full Visibility,
             Multiple Users / One Account), and the other two have moved there,
             so nothing is lost and the argument is made once.

             What is left is what the section is for and what its id already
             says: opening an account. The heading now matches the form under
             it rather than promising a booking walkthrough that was never
             here -- the actual three-step walkthrough is how-it-works.php,
             further up the page.

             The $businessAccountBenefits array and pc_biz_process_icon() that
             fed that row have now been removed too. They were left behind for
             one pass because deleting them by pattern is what broke this file
             the first time: the first "?>" in the file was inside the icon
             switch, not at the end of the PHP header, so a match on it cut the
             file in the wrong place. Done by hand instead. */ ?>
    <div class="tw-mx-auto tw-mb-12 tw-max-w-[52rem] tw-text-center">
      <p class="<?= $pcEyebrow ?>">Business accounts</p>
      <h2 class="<?= pc_mb($pcH2, 'tw-mb-3') ?>">Open a PowerCabs Business Account</h2>
      <p class="tw-mb-0 <?= $pcBody ?> tw-mx-auto tw-max-w-[54ch]">
        It takes a few minutes. Your team travels through the same app, and every
        journey is billed to one account.
      </p>
    </div>

    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <?php
          $mockupImage = 'business-account.jpeg';
          $mockupAlt   = 'PowerCabs app screen for booking a business ride';
          $mockupNotch = true;
          require __DIR__ . '/../shared/app-mockup.php';
        ?>
      </div>

      <div>
        <?php require __DIR__ . '/business-account-form.php'; ?>
      </div>
    </div>
  </div>
</section>
