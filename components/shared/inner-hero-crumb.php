<?php
?>
<nav aria-label="breadcrumb" class="<?= $heroCrumbFirst ? 'tw-mb-4' : '' ?>">
  <ol class="tw-m-0 tw-flex tw-list-none tw-items-center tw-gap-2 tw-p-0 tw-text-[0.8125rem] tw-tracking-[0.02em]">
    <li>
      <?php  ?>
      <a class="<?= $heroCrumbLink ?> tw-inline-block tw-py-1 -tw-my-1 tw-no-underline tw-transition-colors tw-duration-200" href="<?= $assetPath ?>/">Home</a>
    </li>
    <li aria-hidden="true" class="<?= $heroCrumbSep ?>">/</li>
    <li class="tw-font-semibold <?= $heroCrumbCurrent ?>" aria-current="page"><?= htmlspecialchars($heroBreadcrumbLabel) ?></li>
  </ol>
</nav>
