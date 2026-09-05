<?php
$old ??= ['first_name' => '', 'last_name' => '', 'email' => '', 'phone' => '', 'subject' => '', 'message' => ''];
$formStatus ??= null;
$formError ??= '';

// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = $pcLabel;
$submitClass = $pcBtnPrimary;
?>
<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <h2 class="tw-mb-3 tw-text-[clamp(1.5rem,2.5vw,2rem)] tw-font-bold tw-text-ink">We'd Love to Hear From You</h2>
        <p class="tw-mb-6 tw-text-ink/60">
          Whether it's a question about a booking, a business enquiry, or feedback on
          the app, our team reads every message and typically replies within one
          working day.
        </p>
        <div class="tw-flex tw-flex-col tw-gap-4">
          <div class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
            <span>
              <span class="tw-block tw-font-semibold tw-text-ink">Office Address</span>
              <span class="tw-block tw-text-ink/60">Kylmore Road, Inchicore, Dublin D10 K729</span>
            </span>
          </div>
          <div class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM14.25 9h.008v.008h-.008V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
            <span>
              <span class="tw-block tw-font-semibold tw-text-ink">Tax Number</span>
              <span class="tw-block tw-text-ink/60">04301619NH</span>
            </span>
          </div>
          <div class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
            <span>
              <span class="tw-block tw-font-semibold tw-text-ink">NTA License</span>
              <span class="tw-block tw-text-ink/60">DH12616</span>
            </span>
          </div>
        </div>
      </div>

      <div>
        <div class="tw-rounded-[2rem] tw-bg-white tw-p-6 tw-shadow-[0_10px_30px_rgba(28,20,16,0.1)] md:tw-p-11">
          <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-3 md:tw-grid-cols-2">
            <div>
              <label class="<?= $labelClass ?>" for="cuFirstName">First Name</label>
              <input type="text" class="<?= $inputClass ?>" id="cuFirstName" name="first_name" value="<?= htmlspecialchars($old['first_name']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cuLastName">Last Name</label>
              <input type="text" class="<?= $inputClass ?>" id="cuLastName" name="last_name" value="<?= htmlspecialchars($old['last_name']) ?>">
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="cuEmail">Email Address</label>
              <input type="email" class="<?= $inputClass ?>" id="cuEmail" name="email" value="<?= htmlspecialchars($old['email']) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?>" for="cuPhone">Phone Number</label>
              <input type="tel" class="<?= $inputClass ?>" id="cuPhone" name="phone" value="<?= htmlspecialchars($old['phone']) ?>">
            </div>
            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?>" for="cuSubject">Subject</label>
              <input type="text" class="<?= $inputClass ?>" id="cuSubject" name="subject" value="<?= htmlspecialchars($old['subject']) ?>">
            </div>
            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?> pc-required" for="cuMessage">Message</label>
              <textarea class="<?= $inputClass ?> tw-resize-y" id="cuMessage" name="message" rows="3" required><?= htmlspecialchars($old['message']) ?></textarea>
            </div>
            <div class="tw-pt-1 md:tw-col-span-2">
              <button type="submit" class="<?= $submitClass ?>">
                <span>Send Message</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="md:tw-col-span-2"><div class="alert-success tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks -- your message has been sent. We'll get back to you shortly.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="md:tw-col-span-2"><div class="alert-danger tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars($formError) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
