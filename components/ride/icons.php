<?php
/**
 * The /ride icon set, in its own file because two components draw from it now:
 * components/ride/fare-widget.php (which moved into the hero) and
 * components/ride/hero-fare-section.php (which kept the trust bar and the
 * Quick Book modal). Both are required on the same request, so the definition
 * is guarded -- a second declaration would be a fatal, not a warning.
 */
if (!function_exists('pc_ride_hero_icon')):
function pc_ride_hero_icon(string $icon, string $cls = 'tw-h-5 tw-w-5'): void
{
  switch ($icon):
    case 'check': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M19.916 4.626a.75.75 0 01.208 1.04l-9 13.5a.75.75 0 01-1.154.114l-6-6a.75.75 0 011.06-1.06l5.353 5.353 8.493-12.74a.75.75 0 011.04-.207z" clip-rule="evenodd"/></svg>
    <?php break;
    case 'clock': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <?php break;
    case 'crosshair': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v2.25m0 13.5V21m9-9h-2.25M5.25 12H3m15.364-6.364l-1.591 1.591M7.227 16.773l-1.591 1.591m0-12.728l1.591 1.591m9.546 9.546l1.591 1.591M16.5 12a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0z"/></svg>
    <?php break;
    case 'badge': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.603 3.799A4.49 4.49 0 0112 2.25c1.357 0 2.573.6 3.397 1.549a4.49 4.49 0 013.498 1.307 4.491 4.491 0 011.307 3.497A4.49 4.49 0 0121.75 12a4.49 4.49 0 01-1.549 3.397 4.491 4.491 0 01-1.307 3.497 4.491 4.491 0 01-3.497 1.307A4.49 4.49 0 0112 21.75a4.49 4.49 0 01-3.397-1.549 4.49 4.49 0 01-3.498-1.306 4.491 4.491 0 01-1.307-3.498A4.49 4.49 0 012.25 12c0-1.357.6-2.573 1.549-3.397a4.49 4.49 0 011.307-3.497 4.49 4.49 0 013.497-1.307zm7.007 6.387a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" clip-rule="evenodd"/></svg>
    <?php break;
    /* The four below were added for the "Your Taxi. Your Choice." point list,
       which needed a distinct mark per line rather than eight identical ticks.
       Stroked at 1.5 like the rest of the set so they sit together.

       A plain PHP comment, not `?> <?php ... ?> <?php`: inside a switch, going
       out to HTML mode between two cases is a parse error, not just untidy. */
    case 'sparkle': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 3l1.9 4.6L19.5 9.5l-4.6 1.9L13 16l-1.9-4.6L6.5 9.5l4.6-1.9L13 3z"/><path d="M6 15l.9 2.1 2.1.9-2.1.9L6 21l-.9-2.1L3 18l2.1-.9L6 15z"/></svg>
    <?php break;
    case 'paw': ?>
      <?php /* Filled, not stroked: a stroked paw closes into a blob at 14px. */ ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><ellipse cx="7.4" cy="8.6" rx="2.1" ry="2.7"/><ellipse cx="12" cy="6.9" rx="2.2" ry="2.9"/><ellipse cx="16.6" cy="8.6" rx="2.1" ry="2.7"/><path d="M12 11.4c2.8 0 5.2 2.1 5.2 4.5 0 2.1-1.8 3.4-3.8 3.4-.9 0-1.3-.3-1.4-.3s-.5.3-1.4.3c-2 0-3.8-1.3-3.8-3.4 0-2.4 2.4-4.5 5.2-4.5z"/></svg>
    <?php break;
    case 'hourglass': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 3h10M7 21h10M8 3v3.2a4 4 0 001.5 3.1L12 12l-2.5 2.7A4 4 0 008 17.8V21M16 3v3.2a4 4 0 01-1.5 3.1L12 12l2.5 2.7a4 4 0 011.5 3.1V21"/></svg>
    <?php break;
    case 'compass': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M15.2 8.8l-1.9 4.5-4.5 1.9 1.9-4.5 4.5-1.9z"/></svg>
    <?php break;
    case 'search': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="6.5"/><path d="M15.8 15.8L21 21"/></svg>
    <?php break;
    case 'pin': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
    <?php break;
    case 'phone': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a1.5 1.5 0 001.5-1.5v-2.4a1.5 1.5 0 00-1.157-1.46l-3.727-.932a1.5 1.5 0 00-1.516.397l-1.03 1.03a11.25 11.25 0 01-6.464-6.464l1.03-1.03a1.5 1.5 0 00.397-1.516L6.859 3.657a1.5 1.5 0 00-1.46-1.157H3a1.5 1.5 0 00-1.5 1.5v.75z"/></svg>
    <?php break;
    case 'bag': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25l2 2 4-4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
    <?php break;
    case 'person-check': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M18 8.25l1.25 1.25L21.75 7"/></svg>
    <?php break;
    case 'suitcase': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.25 9V5.25A2.25 2.25 0 0110.5 3h3a2.25 2.25 0 012.25 2.25V9m-9 10.5h9a2.25 2.25 0 002.25-2.25V11.25A2.25 2.25 0 0015.75 9H8.25A2.25 2.25 0 006 11.25v6a2.25 2.25 0 002.25 2.25z"/></svg>
    <?php break;
    case 'send': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M3.478 2.404a.75.75 0 00-.926.941l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.404z"/></svg>
    <?php break;
  endswitch;
}
endif;
