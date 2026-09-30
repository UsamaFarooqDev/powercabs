<!-- ============ Lost item: it's finding the driver ============ -->
<section class="<?= $pcSection ?>">
  <div class="<?= $pcContainer ?>">
    <?php /* The text column takes the space the phone frame used to hold: the
             picture is a fraction of its old size, so an even split would have
             left it stranded in the middle of an empty half. */ ?>
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="<?= $pcEyebrow ?>">We can help</p>
        <h2 class="<?= $pcH2 ?>">
          Sometimes the problem isn&rsquo;t finding your item.
          <span class="tw-text-power">It&rsquo;s finding the driver.</span>
        </h2>
        <p class="tw-mb-6 <?= $pcBody ?> <?= $pcMeasureTight ?>">
          Tell us what you remember and our team investigates the information
          available to us to try to identify the relevant taxi or driver &mdash;
          then makes contact on your behalf where appropriate.
        </p>
        <a class="<?= $pcBtnPrimary ?>" href="#lostItemForm">
          Tell us what happened
          <svg class="tw-h-4 tw-w-4 tw-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
        </a>
      </div>

      <?php /* 440px and 4:3, which is the size and frame every other one-sided
               photograph on the site uses -- the split hero, /about-us, the
               safety pages. It was 210/230px in a 2:3 portrait, which made it
               the odd one out on every page it sat beside. */ ?>
      <div class="tw-flex tw-justify-center">
        <div class="tw-relative tw-aspect-[4/3] tw-w-full tw-max-w-[440px] tw-overflow-hidden tw-rounded-2xl tw-bg-paper tw-shadow-[0_18px_40px_-20px_rgba(28,20,16,0.4)]">
          <img src="https://images.pexels.com/photos/9243179/pexels-photo-9243179.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=800"
            alt="A leather wallet left behind on the centre console of a car"
            class="<?= $pcImgCover ?>" loading="lazy">
        </div>
      </div>
    </div>
  </div>
</section>
