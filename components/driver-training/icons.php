<?php
if (!function_exists('pc_dt_icon')):
function pc_dt_icon(string $icon, string $cls = 'tw-h-5 tw-w-5'): void
{
  switch ($icon):
    case 'home': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 10.5L12 3l9 7.5M5.5 9.5V20a1 1 0 001 1h11a1 1 0 001-1V9.5"/></svg>
    <?php break;
    case 'power': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3v9"/><path d="M7.4 6.4a8 8 0 109.2 0"/></svg>
    <?php break;
    case 'route': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="5.5" cy="5.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/><path d="M8 5.5h6.5a3.5 3.5 0 010 7h-5a3.5 3.5 0 000 7H16"/></svg>
    <?php break;
    case 'euro': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 6.3A6.6 6.6 0 0012.6 4.5C9 4.5 6.4 7.8 6.4 12s2.6 7.5 6.2 7.5A6.6 6.6 0 0017 17.7M4 10.3h8.5M4 13.9h8.5"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'lock': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="4.5" y="10.5" width="15" height="10.5" rx="2"/><path d="M8 10.5V7a4 4 0 118 0v3.5"/></svg>
    <?php break;
    case 'image': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3.5" y="4.5" width="17" height="15" rx="2"/><circle cx="8.75" cy="9.75" r="1.5"/><path d="M20.5 15.5l-4.5-4.5-7.5 8.5"/></svg>
    <?php break;
    case 'expand': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 3.5H3.5V9M15 3.5h5.5V9M9 20.5H3.5V15M15 20.5h5.5V15"/></svg>
    <?php break;
    case 'signout': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14 7.5V5.75A1.75 1.75 0 0012.25 4h-6.5A1.75 1.75 0 004 5.75v12.5A1.75 1.75 0 005.75 20h6.5A1.75 1.75 0 0014 18.25V16.5M9.5 12h11m0 0l-3-3m3 3l-3 3"/></svg>
    <?php break;
    
    case 'user': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="3.75"/><path d="M4.5 20.5a7.5 7.5 0 0115 0"/></svg>
    <?php break;
    case 'car': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 13.5l1.6-5a2 2 0 011.9-1.4h11a2 2 0 011.9 1.4l1.6 5"/><path d="M3 13.5h18V18a1 1 0 01-1 1h-1.5a1 1 0 01-1-1v-1h-11v1a1 1 0 01-1 1H4a1 1 0 01-1-1v-4.5z"/><path d="M6.5 16h.01M17.5 16h.01"/></svg>
    <?php break;
    case 'folder': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.5 7a1.5 1.5 0 011.5-1.5h3.8a1.5 1.5 0 011.2.6l1 1.4H19a1.5 1.5 0 011.5 1.5v9A1.5 1.5 0 0119 19.5H5A1.5 1.5 0 013.5 18V7z"/></svg>
    <?php break;
    case 'send': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 3L10.5 13.5M21 3l-6.5 18-4-8-8-4L21 3z"/></svg>
    <?php break;
    case 'sticker': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13.5 3.5H6.5a2 2 0 00-2 2v13a2 2 0 002 2h8l5-5v-8"/><path d="M14 20.5v-4a1 1 0 011-1h4.5"/><path d="M15.5 3.5l4 4"/></svg>
    <?php break;
    case 'menu': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
    <?php break;
    case 'calendar': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3.5" y="5" width="17" height="15.5" rx="2"/><path d="M3.5 10h17M8 3v4M16 3v4"/></svg>
    <?php break;
    case 'flag': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5.5 21V4M5.5 5h11l-2 3.5 2 3.5h-11"/></svg>
    <?php break;
    
    case 'phone': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="6" y="2.5" width="12" height="19" rx="2.6"/><path d="M10.5 18.5h3"/></svg>
    <?php break;
    case 'paw': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><ellipse cx="7.4" cy="8.6" rx="2.1" ry="2.7"/><ellipse cx="12" cy="6.9" rx="2.2" ry="2.9"/><ellipse cx="16.6" cy="8.6" rx="2.1" ry="2.7"/><path d="M12 11.4c2.8 0 5.2 2.1 5.2 4.5 0 2.1-1.8 3.4-3.8 3.4-.9 0-1.3-.3-1.4-.3s-.5.3-1.4.3c-2 0-3.8-1.3-3.8-3.4 0-2.4 2.4-4.5 5.2-4.5z"/></svg>
    <?php break;
    case 'briefcase': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="2.8" y="7" width="18.4" height="13" rx="2"/><path d="M8.5 7V5.2A1.7 1.7 0 0110.2 3.5h3.6A1.7 1.7 0 0115.5 5.2V7M2.8 12.5h18.4"/></svg>
    <?php break;
    case 'box': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.5 7.5L12 3.5l8.5 4v9L12 20.5l-8.5-4v-9z"/><path d="M3.5 7.5L12 11.5l8.5-4M12 11.5v9"/></svg>
    <?php break;
    case 'road': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 3L4 21M17 3l3 18M12 4v3M12 10.5v3M12 17v3"/></svg>
    <?php break;
    case 'headset': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 13v-1a8 8 0 0116 0v1"/><rect x="2.5" y="13" width="4" height="6" rx="1.6"/><rect x="17.5" y="13" width="4" height="6" rx="1.6"/><path d="M19.5 19v.8a2.2 2.2 0 01-2.2 2.2H13"/></svg>
    <?php break;
    case 'search': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="6.5"/><path d="M15.8 15.8L21 21"/></svg>
    <?php break;
    case 'users': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="9" cy="8" r="3.4"/><path d="M2.8 20a6.2 6.2 0 0112.4 0"/><path d="M16.2 5.1a3.4 3.4 0 010 6.3M17.5 14.4A6.2 6.2 0 0121.2 20"/></svg>
    <?php break;
    case 'plane': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2.5 1.5V22l4-1 4 1v-1.5L13 19v-5.5l8 2.5z"/></svg>
    <?php break;
    case 'star': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 2.5l2.9 6.3 6.6.9-4.8 4.6 1.2 6.7L12 17.8l-5.9 3.2 1.2-6.7-4.8-4.6 6.6-.9L12 2.5z"/></svg>
    <?php break;
    case 'info': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 11.5v5M12 7.75h.01"/></svg>
    <?php break;
    case 'award': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="9" r="5.5"/><path d="M8.5 13.8L7.5 21l4.5-2.3L16.5 21l-1-7.2"/></svg>
    <?php break;
  endswitch;
}
endif;
