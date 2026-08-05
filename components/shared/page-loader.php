<?php
/**
 * Global page loader overlay. Included right after <body> opens (see
 * includes/header.php and 404.php) so it's part of the very first HTML
 * the browser paints -- visible by default, no JS required to show it.
 * assets/js/components/page-loader.js hides it once the page is ready
 * and brings it back for outgoing internal navigation / form submits.
 */
?>
<div class="pc-loader-overlay" id="pcPageLoader" aria-hidden="true">
  <span class="pc-loader-spinner" role="status"></span>
  <span class="pc-loader-text">Loading&hellip;</span>
</div>
