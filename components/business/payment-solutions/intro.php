<section class="section-pc" id="payment-solutions">
  <div class="container">
<div class="row align-items-center justify-content-center g-5 p-5">

 <div class="col-lg-6 order-2 order-lg-1 d-flex justify-content-center align-items-center">
  <div
    style="
      width: 340px;
      max-width: 100%;
      margin: 0 auto;
      border-radius: 1.5rem;
      overflow: hidden;
    "
  >
    <img
      src="<?= $assetPath ?>assets/img/Accept-Card-Payments.jpg"
      alt="PowerCabs Payment Solutions"
      class="w-100 d-block"
      loading="lazy"
      style="
        width: 340px;
        height: 420px;
        max-width: 100%;
        object-fit: cover;
      "
    >
  </div>
</div>


  <!-- Content -->
  <div class="col-lg-6 order-1 order-lg-2">

    <div
      style="
        max-width: 560px;
        margin: 0 auto;
        padding: 10px;
      "
    >

      <h2
        class="mb-3"
        style="
          font-size: clamp(28px, 3vw, 42px);
          font-weight: 800;
          line-height: 1.15;
          color: #222;
          letter-spacing: -0.8px;
        "
      >
        Accept Payments
        <span style="color: var(--pc-orange);">
          With Confidence
        </span>
      </h2>


      <!-- Description -->
      <p
        class="text-muted-pc mb-4"
        style="
          font-size: 16px;
          line-height: 1.75;
          max-width: 520px;
        "
      >
        Make it easier for your customers to pay while keeping your
        transactions secure, fast and reliable with PowerCabs payment
        solutions.
      </p>


      <!-- Checklist Card -->
      <div
        style="
          background: #fff;
          border: 1px solid rgba(0,0,0,0.07);
          border-radius: 20px;
          padding: 22px 24px;
          box-shadow: 0 10px 30px rgba(0,0,0,0.06);
          margin-bottom: 24px;
        "
      >

        <ul
          class="list-unstyled mb-0"
          style="
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px 20px;
          "
        >

          <?php
          $paymentChecklist = [
            'PCI compliant processing',
            'Secure encrypted transactions',
            'Next day settlements',
            'Fast payouts',
            'Simple setup',
            'Ongoing local support',
            'Accept cards, Apple Pay & Google Pay',
          ];
          ?>

          <?php foreach ($paymentChecklist as $item): ?>

            <li
              class="d-flex align-items-start gap-2"
              style="
                font-size: 14px;
                line-height: 1.4;
              "
            >
              <span
                style="
                  flex: 0 0 auto;
                  width: 21px;
                  height: 21px;
                  display: inline-flex;
                  align-items: center;
                  justify-content: center;
                  border-radius: 50%;
                  background: rgba(245, 132, 31, 0.12);
                  color: var(--pc-orange);
                  margin-top: 1px;
                "
              >
                <i
                  class="bi bi-check"
                  style="font-size: 14px;"
                ></i>
              </span>

              <span class="text-muted-pc">
                <?= htmlspecialchars($item) ?>
              </span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>

      <!-- CTA -->
      <div class="d-flex flex-wrap align-items-center gap-3">

        <a
          class="btn btn-pc-primary px-4 py-2"
          href="#payment-apply-form"
          style="
            border-radius: 50px;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(245,132,31,0.20);
          "
        >
          Apply Now
          <i class="bi bi-arrow-right-short ms-2"></i>
        </a>
        <div
          class="d-flex align-items-center gap-2 text-muted-pc small"
        >
          <i
            class="bi bi-clock"
            style="color: var(--pc-orange);"
          ></i>
          <span>
            It only takes 2 minutes to apply.
          </span>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</section> 