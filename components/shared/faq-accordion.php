<section class="section-pc">
  <div class="container" style="max-width: 860px;">
    <div class="text-center mb-5">
      <p class="small fw-semibold text-uppercase mb-2" style="letter-spacing: .06em; color: var(--pc-orange);"><?= htmlspecialchars(
        $faqEyebrow,
      ) ?></p>
      <h2 class="mb-3"><?= htmlspecialchars($faqHeading) ?></h2>
    </div>

    <div class="accordion pc-faq-accordion" id="<?= htmlspecialchars($faqAccordionId) ?>">
      <?php foreach ($faqItems as $i => $item): ?>
        <div class="accordion-item">
          <h3 class="accordion-header">
            <button class="accordion-button<?= $i === 0 ? '' : ' collapsed' ?>" type="button" data-bs-toggle="collapse"
              data-bs-target="#<?= htmlspecialchars($faqAccordionId) ?>Item<?= $i ?>" aria-expanded="<?= $i === 0
  ? 'true'
  : 'false' ?>" aria-controls="<?= htmlspecialchars($faqAccordionId) ?>Item<?= $i ?>">
              <?= htmlspecialchars($item['q']) ?>
            </button>
          </h3>
          <div id="<?= htmlspecialchars($faqAccordionId) ?>Item<?= $i ?>" class="accordion-collapse collapse<?= $i === 0
  ? ' show'
  : '' ?>" data-bs-parent="#<?= htmlspecialchars($faqAccordionId) ?>">
            <div class="accordion-body text-muted-pc"><?= htmlspecialchars($item['a']) ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
