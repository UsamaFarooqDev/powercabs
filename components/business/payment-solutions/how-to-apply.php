 <section class="section-pc bg-white">
  <div class="container">


<div class="row align-items-stretch g-3">
  <h2 class="mb-4">Apply in Four Simple Steps</h2>

  <div class="col-lg-7">
    <div class="row row-cols-1 row-cols-sm-2 g-3 h-100">

      <?php
      $applySteps = [
        ['n' => 1, 'title' => 'Apply Online', 'desc' => 'Fill out a quick application form.'],
        ['n' => 2, 'title' => 'Verification & Approval', 'desc' => 'Our team reviews your details.'],
        ['n' => 3, 'title' => 'Receive Your Terminal', 'desc' => 'Your card machine is shipped to you.'],
        ['n' => 4, 'title' => 'Start Taking Payments', 'desc' => 'Accept cards instantly, every ride.'],
      ];
      ?>

      <?php foreach ($applySteps as $step): ?>

        <div class="col">

          <div class="card h-100 border-0 rounded-4 shadow-sm p-4">

            <div
              class="d-flex align-items-center justify-content-center rounded-3 mb-3 fw-bold"
              style="
                width: 42px;
                height: 42px;
                background: rgba(245,132,31,.10);
                color: var(--pc-orange);
              "
            >
              <?= $step['n'] ?>
            </div>

            <h3 class="h6 fw-bold mb-2">
              <?= htmlspecialchars($step['title']) ?>
            </h3>

            <p class="text-muted-pc small mb-0 lh-base">
              <?= htmlspecialchars($step['desc']) ?>
            </p>

          </div>

        </div>

      <?php endforeach; ?>

    </div>

  </div>


  <!-- Ambassador Programme -->
  <div class="col-lg-5">

    <div class="card h-100 border-0 rounded-4 shadow-sm p-4 p-md-5">

      <div
        class="d-flex align-items-center justify-content-center rounded-3 mb-4"
        style="
          width: 52px;
          height: 52px;
          background: rgba(245,132,31,.10);
          color: var(--pc-orange);
        "
      >
        <i class="bi bi-star-fill fs-5"></i>
      </div>

      <h3 class="h4 fw-bold mb-2">
        Already a PowerCabs Driver?
      </h3>

      <p class="text-muted-pc mb-4 lh-lg">
        Check out the exclusive special discounts available through our
        Ambassador Programme.
      </p>

      <div class="mt-auto">
        <a
          class="btn btn-pc-dark px-4"
          href="<?= $assetPath ?>/ambassador-programme.php"
        >
          Ambassador Programme
          <i class="bi bi-arrow-right-short fs-6 ms-1"></i>
        </a>
      </div>

    </div>

  </div>

</div>
</div>
 </section>