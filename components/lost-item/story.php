<?php
/**
 * The scenario, told the way it actually happens. It sits after the form on
 * purpose: someone who arrived in a panic has already been given the button,
 * and this is for the reader still deciding whether it is worth EUR15.
 *
 * On paper rather than ink -- components/lost-item/any-taxi.php is already a
 * dark band, and two on one page turn the page into stripes.
 */
?>
<!-- ============ Lost item: from lost to found ============ -->
<section class="<?= $pcSurfacePaper ?> <?= $pcSection ?>">
  <div class="<?= $pcContainerNarrow ?>">
    <p class="<?= $pcEyebrow ?> tw-text-center">/ From lost to found</p>
    <h2 class="<?= $pcH2 ?> tw-text-center">
      One investigation can turn <span class="tw-text-power">&ldquo;I&rsquo;ve lost it&rdquo;</span> into
      <span class="tw-text-power">&ldquo;I&rsquo;ve got it back.&rdquo;</span>
    </h2>

    <div class="tw-mx-auto tw-mt-9 tw-max-w-[52ch] tw-space-y-5">
      <?php /* The dot classes are written out in full, never assembled -- a
               class built by interpolation ("tw-bg-power/" . $n) is invisible
               to the Tailwind scanner and would silently not exist. */
      $storyBeats = [
        ['dot' => 'tw-bg-power/40', 'line' => 'You get home after a long evening. You reach for your phone. It is gone.'],
        ['dot' => 'tw-bg-power/70', 'line' => 'You remember the taxi &mdash; but not the registration, not the driver, and not how to contact either.'],
        ['dot' => 'tw-bg-power', 'line' => 'You tell PowerCabs what you remember. We investigate, and try to identify the driver.'],
      ]; ?>
      <?php foreach ($storyBeats as $beat): ?>
        <p class="tw-mb-0 tw-flex tw-gap-4 tw-text-[1.0625rem] tw-leading-[1.75] tw-text-ink/[0.68]">
          <span class="tw-mt-2.5 tw-h-1.5 tw-w-1.5 tw-shrink-0 tw-rounded-full <?= $beat['dot'] ?>" aria-hidden="true"></span>
          <span><?= $beat['line'] ?></span>
        </p>
      <?php endforeach; ?>
    </div>

    <p class="tw-mx-auto tw-mb-0 tw-mt-9 tw-max-w-[40ch] tw-text-center tw-text-[1.35rem] tw-font-extrabold tw-leading-snug tw-tracking-tight tw-text-ink">
      That is what this service is for.
    </p>
  </div>
</section>
