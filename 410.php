<?php
/**
 * 410 Gone -- served by ErrorDocument for the old WordPress URLs that were
 * permanently removed in the migration (see section 1 of .htaccess).
 *
 * The distinction from 404 matters here and is the whole reason this file
 * exists: 404 tells a crawler "this might come back, ask again later", so
 * those URLs sit in Search Console's "Not found" report being re-requested
 * for months. 410 says "permanently removed", and Google drops them
 * markedly faster. For a WordPress site that has been replaced wholesale,
 * that difference is most of the cleanup.
 *
 * Everything visual comes from 404.php -- same layout, same links out, same
 * design system recipes -- with only the status and three strings changed.
 */
$errStatus = 410;
$errEyebrow = '/ Error 410';
$errHeading = 'This page is no longer here.';
$errGhost = '410';

$pageTitle = '410 - Page Removed | PowerCabs';
$pageDescription =
  'This page was part of the previous PowerCabs website and has been permanently removed. Everything it covered now lives elsewhere on the site.';

require __DIR__ . '/404.php';
