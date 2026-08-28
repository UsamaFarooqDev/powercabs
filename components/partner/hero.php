<?php
// "PowerCabs Partner Network" panel -- sits right after the standard
// components/shared/inner-hero.php banner (now restored above this, same
// as every other inner page) rather than replacing it. This panel is the
// client's reference-design two-column hero + floating stat strip; it just
// isn't the page's actual <hero> anymore, so it no longer emits its own
// breadcrumb JSON-LD -- inner-hero.php already does that once, above.

// Every figure here is a true, qualitative claim already established
// elsewhere on this page (benefits.php's own list, the 4-step join
// process) -- deliberately no invented partner counts, prize pools or
// coverage numbers standing in for real business data we don't have.
$ptnHeroProof = [
  ['value' => 'Weekly', 'label' => 'payments, always on time'],
  ['value' => 'Dedicated', 'label' => 'partner support team'],
  ['value' => '4 Steps', 'label' => 'from registration to trips'],
];

$ptnHeroStats = [
  ['label' => 'Grow', 'desc' => 'Increased bookings'],
  ['label' => 'Support', 'desc' => 'Dedicated partner team'],
  ['label' => 'Weekly', 'desc' => 'Guaranteed payments'],
  ['label' => 'Tech', 'desc' => 'Booking platform access'],
];
?>

<!-- ============ PowerCabs Partner Network panel ============ -->
<section class="pc-ptn-hero position-relative overflow-hidden" id="pcPtnHero">
  <span class="pc-drive-blob position-absolute rounded-circle z-0 pc-drive-blob-orange" aria-hidden="true"></span>
  <span class="pc-drive-blob position-absolute rounded-circle z-0 pc-drive-blob-dark" aria-hidden="true"></span>

  <div class="container position-relative">
    <div class="row align-items-center gy-5">
      <div class="col-lg-7">
        <span class="pc-ptn-hero-eyebrow text-uppercase rounded-pill d-inline-flex align-items-center gap-2">
          <i class="bi bi-diagram-3-fill" aria-hidden="true"></i>
          PowerCabs Partner Network
        </span>

        <h1 class="pc-ptn-hero-title mt-3 mb-3">Turn every vehicle into more bookings.</h1>

        <p class="pc-ptn-hero-sub mb-4">
          PowerCabs welcomes taxi operators, fleet owners and independent drivers
          to join a growing network and unlock more consistent bookings,
          dedicated support and long-term business growth.
        </p>

        <div class="d-flex flex-wrap gap-3 mb-5">
          <a class="btn btn-pc-primary btn-md px-4 rounded-pill" href="#pcPtnEnquiry">
            Become a Partner
            <i class="bi bi-chevron-right fs-8 ms-1" aria-hidden="true"></i>
          </a>
          <a class="btn btn-outline-dark btn-md px-4 rounded-pill" href="#pcPtnCampaign">See Partner Benefits</a>
        </div>

        <div class="d-flex flex-wrap gap-4 gap-lg-5 pc-ptn-hero-proof">
          <?php foreach ($ptnHeroProof as $p): ?>
            <div>
              <strong><?= htmlspecialchars($p['value']) ?></strong>
              <span><?= htmlspecialchars($p['label']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="col-lg-5">
        <aside class="pc-ptn-hero-card position-relative z-1" aria-label="Partner programme snapshot">
          <div class="pc-ptn-hero-card-top d-flex align-items-center justify-content-between">
            <strong>Partner Snapshot</strong>
            <span class="pc-ptn-hero-live d-inline-flex align-items-center gap-2">
              <span class="pc-ptn-hero-live-dot" aria-hidden="true"></span>
              Now Onboarding
            </span>
          </div>

          <div class="pc-ptn-hero-highlight">
            <small>Partner Payments</small>
            <strong>Weekly</strong>
            <span>Reliable, on-time payouts for every partner, every week.</span>
          </div>

          <div class="pc-ptn-hero-mini">
            <span class="pc-ptn-hero-mini-badge d-inline-block rounded-pill text-primary text-uppercase">Join Process</span>
            <h3>4-Step Onboarding</h3>
            <p class="mb-0">Register &rarr; Verify &rarr; Approve &rarr; Start Trips</p>
            <div class="pc-ptn-hero-mini-row fw-bold d-flex align-items-center justify-content-between">
              <span>Open to operators &amp; drivers</span>
              <i class="bi bi-arrow-right" aria-hidden="true"></i>
            </div>
          </div>
        </aside>
      </div>
    </div>
  </div>

  <div class="pc-ptn-stats position-relative">
    <div class="container">
      <div class="pc-ptn-stats-grid d-grid overflow-hidden">
        <?php foreach ($ptnHeroStats as $s): ?>
          <div class="pc-ptn-stat">
            <strong><?= htmlspecialchars($s['label']) ?></strong>
            <span><?= htmlspecialchars($s['desc']) ?></span>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>
