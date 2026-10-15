<?php
if (!function_exists('pc_pets_icon')):
function pc_pets_icon(string $icon, string $cls = 'tw-h-5 tw-w-5'): void
{
  switch ($icon):
    
    case 'paw': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><ellipse cx="7.4" cy="8.6" rx="2.1" ry="2.7"/><ellipse cx="12" cy="6.9" rx="2.2" ry="2.9"/><ellipse cx="16.6" cy="8.6" rx="2.1" ry="2.7"/><path d="M12 11.4c2.8 0 5.2 2.1 5.2 4.5 0 2.1-1.8 3.4-3.8 3.4-.9 0-1.3-.3-1.4-.3s-.5.3-1.4.3c-2 0-3.8-1.3-3.8-3.4 0-2.4 2.4-4.5 5.2-4.5z"/></svg>
    <?php break;
    case 'clock': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <?php break;
    case 'phone': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h1.5a1.5 1.5 0 001.5-1.5v-2.4a1.5 1.5 0 00-1.157-1.46l-3.727-.932a1.5 1.5 0 00-1.516.397l-1.03 1.03a11.25 11.25 0 01-6.464-6.464l1.03-1.03a1.5 1.5 0 00.397-1.516L6.859 3.657a1.5 1.5 0 00-1.46-1.157H3a1.5 1.5 0 00-1.5 1.5v.75z"/></svg>
    <?php break;
    case 'devices': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="4" width="11" height="13" rx="1.8"/><path d="M3 14h11"/><rect x="16.5" y="9" width="4.5" height="11" rx="1.4"/></svg>
    <?php break;
    case 'calendar': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3.5" y="5" width="17" height="15.5" rx="2"/><path d="M3.5 10h17M8 3v4M16 3v4"/></svg>
    <?php break;
    case 'pin': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
    <?php break;
    case 'route': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="5.5" cy="5.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/><path d="M8 5.5h6.5a3.5 3.5 0 010 7h-5a3.5 3.5 0 000 7H16"/></svg>
    <?php break;
    
    case 'carrier': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3.5 8.5h17v10a1.5 1.5 0 01-1.5 1.5H5a1.5 1.5 0 01-1.5-1.5v-10z"/><path d="M9 4h6l2 4.5H7L9 4z"/><path d="M8.5 11.5v7M12 11.5v7M15.5 11.5v7"/></svg>
    <?php break;
    
    case 'lead': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M8.5 3.5v6a3.5 3.5 0 107 0v-2"/><circle cx="8.5" cy="3.5" r="1.6"/><path d="M5 14.5c2.5 1.6 5 2.4 7 2.4s4.5-.8 7-2.4M4.5 19c3 1.4 5.5 2 7.5 2s4.5-.6 7.5-2"/></svg>
    <?php break;
    
    case 'blanket': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 8.5l9-4.5 9 4.5-9 4.5-9-4.5z"/><path d="M3 12.5l9 4.5 9-4.5M3 16.5l9 4.5 9-4.5"/></svg>
    <?php break;
    case 'shield': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.96 11.96 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>
    <?php break;
    case 'sparkle': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M13 3l1.9 4.6L19.5 9.5l-4.6 1.9L13 16l-1.9-4.6L6.5 9.5l4.6-1.9L13 3z"/><path d="M6 15l.9 2.1 2.1.9-2.1.9L6 21l-.9-2.1L3 18l2.1-.9L6 15z"/></svg>
    <?php break;
    case 'euro': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 6.3A6.6 6.6 0 0012.6 4.5C9 4.5 6.4 7.8 6.4 12s2.6 7.5 6.2 7.5A6.6 6.6 0 0017 17.7M4 10.3h8.5M4 13.9h8.5"/></svg>
    <?php break;
    case 'info': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="9"/><path d="M12 11.5v5M12 7.75h.01"/></svg>
    <?php break;
    case 'whatsapp': ?>
      <svg class="<?= $cls ?>" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38c1.45.79 3.08 1.21 4.79 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm5.71 14.02c-.24.68-1.38 1.3-1.9 1.38-.49.08-1.1.11-1.77-.11-.41-.13-.94-.31-1.62-.6-2.85-1.23-4.71-4.09-4.85-4.28-.14-.19-1.16-1.54-1.16-2.94 0-1.4.73-2.09.99-2.37.26-.28.57-.35.76-.35h.55c.18 0 .41-.07.64.49.24.57.81 1.97.88 2.11.07.14.12.31.02.5-.09.19-.14.31-.28.48-.14.17-.29.37-.42.5-.14.14-.28.29-.12.57.16.28.71 1.17 1.52 1.9 1.04.94 1.92 1.23 2.19 1.37.28.14.44.12.6-.07.16-.19.68-.79.86-1.06.18-.28.36-.23.6-.14.24.09 1.53.72 1.79.85.26.14.44.21.5.32.07.12.07.68-.17 1.35z"/></svg>
    <?php break;
  endswitch;
}
endif;
