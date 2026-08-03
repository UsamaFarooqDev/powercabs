<?php
$pageTitle       = 'Sustainability & Environmental Policy | PowerCabs';
$pageDescription = "PowerCabs's commitment to eco-friendly design and digital solutions -- remote-first working, paperless operations, and 100% renewable-energy hosting.";
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$ecoAreas = [
  [
    'icon' => 'bi-house-heart-fill',
    'title' => 'Remote-First Working',
    'items' => ['Entire team and subcontractors work remotely', 'Eliminates energy-intensive office spaces', 'Reduces daily commuting emissions', 'Minimizes office waste and packaging'],
  ],
  [
    'icon' => 'bi-file-earmark-x-fill',
    'title' => 'Paperless Operations',
    'items' => ['Digital documentation by default', 'Printing only when absolutely necessary', 'Reduced paper consumption across the business'],
  ],
  [
    'icon' => 'bi-camera-video-fill',
    'title' => 'Sustainable Communication',
    'items' => ['Video conferencing and online collaboration', 'Virtual meetings preferred over travel', 'Shared Dublin office space when in-person is required', 'Hybrid or electric vehicles for necessary travel'],
  ],
  [
    'icon' => 'bi-speedometer2',
    'title' => 'Sustainable Website Development',
    'items' => ['Optimizing website performance', 'Reducing page sizes and data transfer', 'Improving efficiency to lower hosted-site impact'],
  ],
  [
    'icon' => 'bi-plug-fill',
    'title' => 'Green Hosting',
    'items' => ['Hosted through Hosting Ireland', 'Server caching and CDN integration', 'Faster performance, smaller footprint', '100% renewable energy infrastructure'],
  ],
  [
    'icon' => 'bi-arrow-repeat',
    'title' => 'Continuous Improvement',
    'items' => ['Regular review of environmental policy', 'Ongoing sustainable business practices', 'Alignment with evolving sustainability goals'],
  ],
];
?>

<!-- ============ Hero ============ -->
<section class="position-relative overflow-hidden text-white text-center" style="padding-top: calc(var(--pc-navbar-h, 110px) + 3rem); padding-bottom: clamp(6rem, 12vw, 9rem);">
  <img src="https://images.pexels.com/photos/35736786/pexels-photo-35736786.jpeg?auto=format&fit=crop&w=1600&q=60" alt="" aria-hidden="true" class="position-absolute top-0 start-0 w-100 h-100" style="object-fit: cover; z-index: 0;" loading="lazy">
  <span class="pc-eco-hero-scrim position-absolute top-0 start-0 w-100 h-100" aria-hidden="true" style="z-index: 0;"></span>
  <div class="container position-relative">
    <span class="pc-eco-badge mb-3"><i class="bi bi-leaf-fill"></i> Eco-Friendly by Design</span>
    <h1 class="mb-3 text-white" style="font-size: clamp(2.25rem, 4.5vw, 3.5rem); font-weight: 900;">Sustainability &amp; Environmental Policy</h1>
    <p class="mx-auto mb-0" style="max-width: 56ch; color: rgba(255,255,255,.88); font-size: 1.15rem;">Our Commitment to Eco-Friendly Design and Digital Solutions.</p>
  </div>
</section>

<!-- ============ Our Commitment ============ -->
<section class="section-pc pc-eco-section text-center">
  <div class="container" style="max-width: 780px;">
    <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: #2e7d32;">/ Our Commitment</p>
    <h2 class="mb-3">Exceptional Service, Lower Impact</h2>
    <p class="text-muted-pc mb-0">
      PowerCabs is committed to delivering exceptional digital services while maintaining a
      strong focus on environmental responsibility. We continually improve our environmental
      practices and promote sustainable operations throughout the business.
    </p>
  </div>
</section>

<!-- ============ How We Reduce Our Environmental Impact ============ -->
<section class="pb-5 pc-eco-section">
  <div class="container">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: #2e7d32;">/ How We Reduce Our Impact</p>
      <h2 class="mb-0">Six Ways We Keep It Green</h2>
    </div>
    <div class="row g-4">
      <?php foreach ($ecoAreas as $area): ?>
        <div class="col-md-6 col-lg-4">
          <div class="pc-eco-card h-100 p-4">
            <span class="pc-eco-icon rounded-circle d-inline-flex align-items-center justify-content-center mb-3">
              <i class="bi <?= $area['icon'] ?>"></i>
            </span>
            <h3 class="fs-5 fw-bold mb-3"><?= htmlspecialchars($area['title']) ?></h3>
            <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
              <?php foreach ($area['items'] as $item): ?>
                <li class="d-flex gap-2 small text-muted-pc">
                  <i class="bi bi-check-circle-fill mt-1 flex-shrink-0" style="color: #4caf50;"></i>
                  <span><?= htmlspecialchars($item) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ============ CTA ============ -->
<section class="text-center text-white" style="padding-block: clamp(3rem, 6vw, 4.5rem);">
  <div class="container">
    <div class="pc-eco-cta p-5">
      <h2 class="text-white mb-3">Powered by 100% Renewable Energy</h2>
      <p class="mb-0" style="max-width: 56ch; margin-inline: auto; color: rgba(255,255,255,.9);">
        From remote-first working to green hosting, sustainability is built into how PowerCabs
        operates every day &mdash; not an afterthought.
      </p>
    </div>
  </div>
</section>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
