<section class="tw-scroll-mt-24 tw-py-16 md:tw-py-24" id="business-booking-form">
  <div class="<?= $pcContainer ?>">
    <?php  ?>
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
