<?php
// Tailwind, compiled. Shared by includes/header.php and the standalone
// 404.php so the two can't drift apart.
//
// This used to be the Play CDN, which compiled the whole site's utilities in
// the browser on every page load. Once Bootstrap was removed Tailwind owned
// 100% of the styling -- ~1,400 distinct classes, half of them arbitrary
// values -- and the runtime cost showed as a visible lag and a flash of
// unstyled content. It is now a plain, cacheable stylesheet.
//
// The build is dev-time only; assets/css/tailwind.css is committed, so the
// host serves plain files and never runs anything. There is deliberately NO
// package.json / node_modules in this repo -- some hosts auto-detect a
// package.json and try to build on deploy, which is exactly what we don't
// want. Rebuild with a one-off npx instead (it caches outside the project):
//
//     npx tailwindcss@3.4.19 -c tailwind.config.js -i assets/css/tailwind.src.css -o assets/css/tailwind.css --minify
//
// Run that after adding or changing any tw- class, and commit the output.
// Add --watch instead of --minify to rebuild on save while working.
//
// Theme, keyframes and the safelist all live in tailwind.config.js at the
// repo root -- that file is the single source of truth, not this one.
//
// IMPORTANT: a tw- class that exists only in a string this build cannot see
// (built by PHP or JS concatenation) will silently not be generated. The
// config's `content` globs cover the JS that builds its own markup; the two
// PHP-interpolated cases are in the config's `safelist`.
$assetPath ??= '';
?>
  <?php /* Font preload -- starts the brand font downloading in parallel with
           the stylesheets instead of after base.css has been parsed. Root-
           absolute on purpose: it must resolve to exactly the URL base.css's
           url('../fonts/...') resolves to, and 404.php is served at arbitrary
           nested paths where a relative href would point somewhere else and
           download the font twice. crossorigin is required for fonts even on
           the same origin, or the preloaded copy is not reused. Only latin is
           preloaded: latin-ext is rarely needed and unicode-range fetches it
           on demand. */ ?>
  <link rel="preload" href="/assets/fonts/plus-jakarta-sans/plus-jakarta-sans-v12-latin.woff2" as="font" type="font/woff2" crossorigin>
  <?php /* Most page heroes and many section photos are Pexels URLs. Opening
           that connection now saves its DNS + TLS setup at the moment the
           hero image is actually requested. */ ?>
  <link rel="preconnect" href="https://images.pexels.com">
  <link rel="stylesheet"
    href="<?= $assetPath ?>assets/css/tailwind.css?v=<?= @filemtime(__DIR__ . '/../assets/css/tailwind.css') ?>">
