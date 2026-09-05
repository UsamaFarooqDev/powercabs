<!-- #pcPtnGrowth / #pcPtnGrowthImg are JS hooks for partner-page.js's scroll
     parallax (inline style.transform, untouched by this markup). -->
<section class="tw-relative tw-overflow-hidden tw-py-[clamp(6rem,12vw,9rem)] tw-text-center tw-text-white" id="pcPtnGrowth">
  <div class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-overflow-hidden" aria-hidden="true">
    <img src="https://images.pexels.com/photos/29566899/pexels-photo-29566899.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1600" alt="" class="tw-h-full tw-w-full tw-object-cover [transform:scale(1.12)] tw-will-change-transform" loading="lazy" id="pcPtnGrowthImg">
  </div>
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-bg-[linear-gradient(180deg,rgba(10,7,5,0.6)_0%,rgba(10,7,5,0.78)_100%)]" aria-hidden="true"></span>

  <div class="tw-relative tw-z-[1] <?= $pcContainer ?>">
    <p class="tw-mb-3 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-powerlight">/ Grow With Us</p>
    <h2 class="tw-mx-auto tw-mb-3 tw-max-w-[32ch] tw-text-[clamp(2rem,4.5vw,3.25rem)] tw-font-bold tw-leading-tight">
      One Network. Every Vehicle Working Harder.
    </h2>
    <p class="tw-mx-auto tw-mb-0 tw-max-w-[54ch] tw-text-[1.15rem] tw-text-white/[0.88]">
      Every partner who joins adds capacity to the whole network -- more bookings
      reach your vehicles, and more passengers get a reliable ride.
    </p>
  </div>
</section>
