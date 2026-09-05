<?php
$pageTitle = 'Positive Feedback Form | PowerCabs';
$pageDescription =
  'Had a great ride with PowerCabs? Tell us about it -- your feedback helps us recognise excellent drivers and service.';
$assetPath = '';

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';

$formStatus = null;
$formError = '';
$old = ['role' => 'driver', 'name' => '', 'email' => '', 'rating' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $old['role'] = in_array($_POST['role'] ?? '', ['driver', 'passenger'], true) ? $_POST['role'] : 'driver';
  $old['name'] = trim($_POST['name'] ?? '');
  $old['email'] = trim($_POST['email'] ?? '');
  $old['rating'] = trim($_POST['rating'] ?? '');
  $old['message'] = trim($_POST['message'] ?? '');

  if ($old['name'] === '' || $old['email'] === '' || $old['rating'] === '') {
    $formStatus = 'error';
    $formError = 'Please fill in all required fields.';
  } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
    $formStatus = 'error';
    $formError = 'Please enter a valid email address.';
  } else {
    $body =
      "New positive feedback submission from the PowerCabs website.\n\n" .
      "Name: {$old['name']}\n" .
      "Email: {$old['email']}\n" .
      'Submitted as: ' .
      ucfirst($old['role']) .
      "\n" .
      'Rating: ' .
      ($old['rating'] !== '' ? $old['rating'] . ' / 5' : '-') .
      "\n\n" .
      "Feedback:\n" .
      ($old['message'] !== '' ? $old['message'] : '-') .
      "\n";

    $result = pc_send_mail('Positive feedback: ' . $old['name'], $body, [
      'name' => $old['name'],
      'email' => $old['email'],
    ]);

    if ($result['success']) {
      $formStatus = 'success';
      $old = ['role' => 'driver', 'name' => '', 'email' => '', 'rating' => '', 'message' => ''];
    } else {
      $formStatus = 'error';
      $formError = 'Sorry, something went wrong sending your feedback. Please try again or call us directly.';
    }
  }
}

require __DIR__ . '/includes/header.php';

$heroEyebrow = '/ Made Your Day?';
$heroTitleLight = 'Share A';
$heroTitleBold = 'Great Experience.';
$heroDescription =
  "Great service deserves a shout-out. Tell us what stood out and we'll make sure the right people hear about it.";
$heroBgImage = 'https://images.pexels.com/photos/5955023/pexels-photo-5955023.jpeg?auto=format&fit=crop&w=1600&q=60';
require __DIR__ . '/components/shared/inner-hero.php';
?>

<?php
// Canonical PowerCabs field styling -- mirrors book-ride-online.php exactly.
$inputClass = $pcInput;
$labelClass = $pcLabel;
$submitClass = $pcBtnPrimary;
$pillToggleClass = 'tw-inline-flex tw-cursor-pointer tw-items-center tw-rounded-full tw-border tw-border-solid tw-border-ink/20 tw-px-4 tw-py-2 tw-text-sm tw-font-semibold tw-text-ink tw-transition-colors tw-duration-200 has-[:checked]:tw-border-power has-[:checked]:tw-bg-power has-[:checked]:tw-text-white';
?>

<section class="tw-px-4 tw-py-16 sm:tw-px-6 md:tw-py-24 lg:tw-px-8">
  <div class="tw-mx-auto tw-w-full tw-max-w-[1320px]">
    <div class="tw-grid tw-grid-cols-1 tw-items-center tw-gap-12 lg:tw-grid-cols-2">
      <div>
        <h2 class="tw-mb-3 tw-text-[clamp(1.5rem,2.5vw,2rem)] tw-font-bold tw-text-ink">Great Service Deserves Recognition</h2>
        <p class="tw-mb-6 tw-text-ink/60">
          Whether it was a driver who went the extra mile or a smooth, stress-free
          booking, we want to hear about it. Positive feedback goes straight to our
          team and is shared with the driver involved.
        </p>
        <ul class="tw-m-0 tw-flex tw-list-none tw-flex-col tw-gap-4 tw-p-0">
          <li class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
            <span class="tw-text-ink/60">Rate your experience and tell us what stood out.</span>
          </li>
          <li class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"/></svg>
            <span class="tw-text-ink/60">Let us know if you're a rider or a driver -- helps us route it correctly.</span>
          </li>
          <li class="tw-flex tw-gap-3">
            <svg class="tw-h-5 tw-w-5 tw-shrink-0 tw-text-power" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.645 20.91l-.007-.003-.022-.012a15.247 15.247 0 01-.383-.218 25.18 25.18 0 01-4.244-3.17C4.688 15.36 2.25 12.174 2.25 8.25 2.25 5.322 4.714 3 7.688 3A5.5 5.5 0 0112 5.052 5.5 5.5 0 0116.313 3c2.973 0 5.437 2.322 5.437 5.25 0 3.925-2.438 7.111-4.739 9.256a25.175 25.175 0 01-4.244 3.17 15.247 15.247 0 01-.383.219l-.022.012-.007.004-.003.001a.752.752 0 01-.704 0l-.003-.001z"/></svg>
            <span class="tw-text-ink/60">Great feedback is shared with the driver and counts toward recognition.</span>
          </li>
        </ul>
      </div>

      <div>
        <div class="tw-rounded-[2rem] tw-bg-white tw-p-6 tw-shadow-[0_10px_30px_rgba(28,20,16,0.1)] md:tw-p-11">
          <form method="post" action="" class="tw-grid tw-grid-cols-1 tw-gap-4 md:tw-grid-cols-2">
            <div class="md:tw-col-span-2">
              <span class="tw-mb-2 tw-block tw-text-sm tw-font-medium tw-text-ink">I am a...</span>
              <div class="tw-flex tw-gap-2">
                <label class="<?= $pillToggleClass ?>" for="pfRoleDriver">
                  <input type="radio" class="tw-sr-only" id="pfRoleDriver" name="role" value="driver" autocomplete="off" <?= $old[
                    'role'
                  ] === 'driver'
                    ? 'checked'
                    : '' ?>>
                  Driver
                </label>
                <label class="<?= $pillToggleClass ?>" for="pfRolePassenger">
                  <input type="radio" class="tw-sr-only" id="pfRolePassenger" name="role" value="passenger" autocomplete="off" <?= $old[
                    'role'
                  ] === 'passenger'
                    ? 'checked'
                    : '' ?>>
                  Passenger
                </label>
              </div>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="pfName">Full Name</label>
              <input type="text" class="<?= $inputClass ?>" id="pfName" name="name" value="<?= htmlspecialchars(
                $old['name'],
              ) ?>" required>
            </div>
            <div>
              <label class="<?= $labelClass ?> pc-required" for="pfEmail">Email Address</label>
              <input type="email" class="<?= $inputClass ?>" id="pfEmail" name="email" value="<?= htmlspecialchars(
                $old['email'],
              ) ?>" required>
            </div>
            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?> pc-required tw-mb-3">Rate Your Experience</label>
              <!-- Pure-CSS star rating, no JS: each radio is a Tailwind `peer`
                   and every label reacts to `peer-checked:`/`peer-hover:` from
                   ANY earlier sibling -- the same trick the old
                   `.btn-check:checked + .pc-rating-star ~ .pc-rating-star`
                   selector used, just expressed with Tailwind's peer variant.
                   Stars are in reverse DOM order (5..1) and laid out with
                   flex-row-reverse so a later DOM sibling is an earlier
                   (already-passed) visual star, which is what makes "hover/
                   check star 3" also fill in stars 1-2. -->
              <div class="tw-flex tw-flex-row-reverse tw-items-center tw-justify-end tw-gap-2">
                <?php for ($i = 5; $i >= 1; $i--): ?>
                  <input
                    type="radio"
                    class="tw-peer tw-sr-only"
                    name="rating"
                    id="rating<?= $i ?>"
                    value="<?= $i ?>"
                    required
                    <?= $old['rating'] === (string) $i ? 'checked' : '' ?>
                  >
                  <label
                    for="rating<?= $i ?>"
                    class="tw-peer tw-inline-flex tw-h-9 tw-w-9 tw-cursor-pointer tw-items-center tw-justify-center tw-rounded-full tw-border tw-border-solid tw-border-[#ffc107] tw-bg-white tw-text-[#ffc107] tw-transition-colors tw-duration-200 hover:tw-bg-[#ffc107] hover:tw-text-white peer-checked:tw-bg-[#ffc107] peer-checked:tw-text-white peer-hover:tw-bg-[#ffc107] peer-hover:tw-text-white motion-reduce:tw-transition-none"
                    title="<?= $i ?> Star<?= $i > 1 ? 's' : '' ?>"
                  >
                    <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.562.562 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.562.562 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z"/></svg>
                  </label>
                <?php endfor; ?>
              </div>
              <small class="tw-mt-2 tw-block tw-text-sm tw-text-ink/60">Tap a star to rate your journey.</small>
            </div>

            <div class="md:tw-col-span-2">
              <label class="<?= $labelClass ?>" for="pfMessage">Your Message</label>
              <textarea class="<?= $inputClass ?> tw-resize-y" id="pfMessage" name="message" rows="5"><?= htmlspecialchars(
                $old['message'],
              ) ?></textarea>
            </div>
            <div class="tw-pt-2 md:tw-col-span-2">
              <button type="submit" class="<?= $submitClass ?>">
                <span>Send Feedback</span>
                <svg class="tw-h-4 tw-w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
              </button>
            </div>

            <?php if ($formStatus === 'success'): ?>
              <div class="md:tw-col-span-2"><div class="alert-success tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-[rgba(25,135,84,0.25)] tw-bg-[rgba(25,135,84,0.1)] tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-[#146c43]" role="alert">Thanks for the kind words -- we'll make sure this gets seen.</div></div>
            <?php elseif ($formStatus === 'error'): ?>
              <div class="md:tw-col-span-2"><div class="alert-danger tw-mt-3 tw-rounded-md tw-border tw-border-solid tw-border-red-200 tw-bg-red-50 tw-px-4 tw-py-3 tw-text-sm tw-font-semibold tw-text-red-700" role="alert"><?= htmlspecialchars(
                $formError,
              ) ?></div></div>
            <?php endif; ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';


?>
