<?php
$assetPath ??= '';
?>
  <?php  ?>
  <link rel="preload" href="/assets/fonts/dm-sans/dm-sans-latin.woff2" as="font" type="font/woff2" crossorigin>
  <?php  ?>
  <link rel="preconnect" href="https://images.pexels.com">
  <link rel="stylesheet"
    href="<?= $assetPath ?>assets/css/tailwind.css?v=<?= @filemtime(__DIR__ . '/../assets/css/tailwind.css') ?>">
