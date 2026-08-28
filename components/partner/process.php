<?php
$joinProcess = [
  ['n' => '01', 'title' => 'Register', 'desc' => 'Tell us about your business and vehicles.'],
  ['n' => '02', 'title' => 'Verification', 'desc' => 'Our team checks your details and documents.'],
  ['n' => '03', 'title' => 'Approval', 'desc' => "You're confirmed and onboarded to the network."],
  ['n' => '04', 'title' => 'Start Receiving Trips', 'desc' => 'Bookings start flowing straight to your fleet.'],
];
?>
<section class="pc-ptn-band-a section-pc" id="pcPtnProcess">
  <div class="container">
    <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .08em; color: var(--pc-orange);">/ Simple From Day One</p>
    <h2 class="pc-ptn-campaign-title mb-3">How the Partner Programme Works.</h2>
    <p class="text-muted-pc mb-5" style="max-width: 62ch; font-size: 1.08rem;">
      No complicated setup. Join, get verified, get on the road and stay
      eligible for a steady stream of bookings.
    </p>

    <div class="pc-ptn-step-grid d-grid gap-3">
      <?php foreach ($joinProcess as $step): ?>
        <div class="pc-ptn-step-card p-4">
          <span class="pc-ptn-step-num text-primary d-inline-flex align-items-center justify-content-center"><?= htmlspecialchars($step['n']) ?></span>
          <h3 class="mb-1"><?= htmlspecialchars($step['title']) ?></h3>
          <p class="text-muted-pc small mb-0"><?= htmlspecialchars($step['desc']) ?></p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
