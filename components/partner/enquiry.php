<?php

$old ??= [
  'name' => '',
  'business_name' => '',
  'email' => '',
  'phone' => '',
  'fleet_size' => '',
  'city' => '',
  'message' => '',
];
$formStatus ??= null;
$formError ??= '';

// "For businesses" -- the reference page's audience there is brands buying
// ad campaigns, which doesn't exist as a PowerCabs product; on this page
// the equivalent B2B audience is the fleet/taxi operator business itself,
// so this section keeps the reference's dark CTA + benefits-grid + form
// layout but carries the existing partner enquiry form (same field
// ids/names as before, backend untouched).
$partnerBizBenefits = [
  ['title' => 'Fleet Management', 'desc' => 'Manage multiple vehicles and drivers under one PowerCabs account.'],
  ['title' => 'Business Growth', 'desc' => 'Plug into a growing network instead of relying on word of mouth alone.'],
  ['title' => 'Marketing Support', 'desc' => 'Get visibility across the PowerCabs platform and booking channels.'],
  ['title' => 'Driver Management', 'desc' => 'Onboard and manage your drivers through one simple system.'],
];

// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = $pcLabel;
$submitClass = $pcBtnPrimary . ' tw-w-full';
?>
<section class="tw-relative tw-scroll-mt-24 tw-overflow-hidden tw-pb-[clamp(9rem,15vw,13rem)] tw-pt-[clamp(4.5rem,9vw,7rem)] tw-text-white" id="pcPtnEnquiry">
  <img src="https://images.pexels.com/photos/29566896/pexels-photo-29566896.jpeg?auto=compress&amp;cs=tinysrgb&amp;w=1600" alt="" aria-hidden="true" class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-h-full tw-w-full tw-object-cover" loading="lazy">
  <span class="tw-pointer-events-none tw-absolute tw-inset-0 tw-z-0 tw-bg-[linear-gradient(155deg,rgba(28,16,8,0.94)_0%,rgba(28,16,8,0.86)_55%,rgba(10,7,5,0.92)_100%)]" aria-hidden="true"></span>

  <div class="tw-relative tw-z-[1] <?= $pcContainer ?>">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <p class="tw-mb-2 tw-text-sm tw-font-semibold tw-uppercase tw-tracking-[0.08em] tw-text-powerlight">/ For Businesses</p>
        <h2 class="tw-mb-3 tw-text-[clamp(2rem,3.6vw,2.9rem)] tw-font-extrabold tw-leading-[1.08] tw-tracking-[-0.04em] tw-text-white">Put Your Fleet to Work on the PowerCabs Network.</h2>
        <p class="tw-mb-8 tw-max-w-[48ch] tw-text-[1.05rem] tw-text-white/[0.78]">
          Reach more passengers across a growing booking network without
          building your own platform. Tell us about your business and our
          Partner team will explore the right setup with you.
        </p>

        <div class="tw-grid tw-grid-cols-1 tw-gap-3 sm:tw-grid-cols-2">
          <?php foreach ($partnerBizBenefits as $b): ?>
            <div class="tw-h-full tw-rounded-xl tw-border tw-border-solid tw-border-white/[0.14] tw-bg-white/[0.06] tw-p-5">
              <strong class="tw-mb-1 tw-block tw-text-base tw-text-white"><?= htmlspecialchars($b['title']) ?></strong>
              <span class="tw-block tw-text-sm tw-leading-relaxed tw-text-white/[0.68]"><?= htmlspecialchars($b['desc']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div>
        <div class="tw-rounded-2xl tw-bg-white tw-p-[clamp(1.75rem,3.4vw,2.5rem)] tw-text-ink tw-shadow-[0_24px_60px_rgba(28,20,16,0.12)]">
          <h3 class="tw-mb-2 tw-text-xl tw-font-extrabold tw-text-ink">Ready to Partner With PowerCabs?</h3>
          <p class="tw-mb-6 tw-text-ink/60">Tell us a little about your business and our Partner team will be in touch to talk through the next steps.</p>

          <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
            <div>
              <label class="<?= $labelClass ?> pc-required" for="ptName">Name</label>
              <input type="text" class="<?= $inputClass ?>" id="ptName" name="name" value="<?= htmlspecialchars(
                $old['name'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="ptPhone">Phone</label>
              <input type="tel" class="<?= $inputClass ?>" id="ptPhone" name="phone" value="<?= htmlspecialchars(
                $old['phone'],
              ) ?>" required>
            </div>
            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?> pc-required" for="ptEmail">Email Address</label>
              <input type="email" class="<?= $inputClass ?>" id="ptEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required>
            </div>
            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?> pc-required" for="ptBusinessName">Business Name</label>
              <input type="text" class="<?= $inputClass ?>" id="ptBusinessName" name="business_name" value="<?= htmlspecialchars(
                $old['business_name'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="ptFleetSize">Fleet Size <span class="tw-font-normal tw-text-ink/50">(optional)</span></label>
              <input type="number" min="1" class="<?= $inputClass ?>" id="ptFleetSize" name="fleet_size" value="<?= htmlspecialchars(
                $old['fleet_size'],
              ) ?>" placeholder="e.g. 4">
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="ptCity">City</label>
              <input type="text" class="<?= $inputClass ?>" id="ptCity" name="city" value="<?= htmlspecialchars(
                $old['city'],
              ) ?>" required>
            </div>
            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?>" for="ptMessage">Tell Us About Your Fleet <span class="tw-font-normal tw-text-ink/50">(optional)</span></label>
              <textarea class="<?= $inputClass ?> tw-resize-y" id="ptMessage" name="message" rows="3" placeholder="Vehicles, drivers, area of operation..."><?= htmlspecialchars(
                $old['message'],
              ) ?></textarea>
            </div>

            <div class="tw-pt-2 md:tw-col-span-2">
              <button type="submit" class="<?= $submitClass ?>">
                <span>Request a Partner Call Back</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="md:tw-col-span-2"><div class="alert-success tw-mb-0 tw-mt-1 tw-rounded-md tw-border tw-border-solid tw-border-green-200 tw-bg-green-50 tw-px-4 tw-py-3 tw-text-sm tw-text-green-800" role="alert">Thanks -- your enquiry has been sent. Our team will be in touch shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="md:tw-col-span-2"><div class="alert-danger tw-mb-0 tw-mt-1 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-text-red-800" role="alert"><?= htmlspecialchars(
                $formError,
              ) ?></div></div>
            <?php endif; ?>

            <p class="tw-m-0 tw-text-[1.0625rem] tw-leading-relaxed tw-leading-relaxed tw-text-ink/50 md:tw-col-span-2">
              By submitting, you're asking PowerCabs to contact you about the
              Partner Programme. Onboarding is subject to verification.
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
