<?php
declare(strict_types=1);

/**
 * Dial codes for the phone field, with a flat SVG flag for each.
 *
 * Flags are drawn inline rather than pulled from an emoji or an icon pack:
 * - Regional-indicator emoji (the usual shortcut) do NOT render as flags in Chrome or Edge on
 *   Windows -- they fall back to the two letters, so "IE" would sit where the flag should be.
 * - An icon pack would be a new dependency and a second request for the sake of 20 rectangles.
 *
 * Each SVG is drawn in a 20x14 viewBox and simplified to the shapes that read at 20px. The list
 * is curated rather than exhaustive: Ireland first, then the nationalities that actually book
 * and drive in Dublin. Add a row here and both the dropdown and the validator pick it up.
 */
function pc_phone_countries(): array
{
  $r = static fn(string $f, float $x, float $y, float $w, float $h): string =>
    sprintf('<rect x="%s" y="%s" width="%s" height="%s" fill="%s"/>', $x, $y, $w, $h, $f);

  // Three vertical bands.
  $vert = static fn(string $a, string $b, string $c): string =>
    sprintf(
      '<rect width="20" height="14" fill="%s"/><rect x="6.67" width="6.66" height="14" fill="%s"/><rect x="13.33" width="6.67" height="14" fill="%s"/>',
      $a, $b, $c
    );

  // Three horizontal bands.
  $horiz = static fn(string $a, string $b, string $c): string =>
    sprintf(
      '<rect width="20" height="14" fill="%s"/><rect y="4.67" width="20" height="4.66" fill="%s"/><rect y="9.33" width="20" height="4.67" fill="%s"/>',
      $a, $b, $c
    );

  return [
    ['iso' => 'IE', 'name' => 'Ireland', 'code' => '+353', 'svg' => $vert('#169b62', '#ffffff', '#ff883e')],
    ['iso' => 'GB', 'name' => 'United Kingdom', 'code' => '+44', 'svg' =>
      '<rect width="20" height="14" fill="#012169"/>'
      . '<path d="M0 0l20 14M20 0L0 14" stroke="#fff" stroke-width="2.8"/>'
      . '<path d="M0 0l20 14M20 0L0 14" stroke="#c8102e" stroke-width="1.6"/>'
      . '<path d="M10 0v14M0 7h20" stroke="#fff" stroke-width="4.6"/>'
      . '<path d="M10 0v14M0 7h20" stroke="#c8102e" stroke-width="2.8"/>'],
    ['iso' => 'US', 'name' => 'United States', 'code' => '+1', 'svg' =>
      '<rect width="20" height="14" fill="#fff"/>'
      . '<g fill="#b22234">' . $r('#b22234', 0, 0, 20, 1.08) . $r('#b22234', 0, 2.15, 20, 1.08)
      . $r('#b22234', 0, 4.31, 20, 1.08) . $r('#b22234', 0, 6.46, 20, 1.08)
      . $r('#b22234', 0, 8.62, 20, 1.08) . $r('#b22234', 0, 10.77, 20, 1.08)
      . $r('#b22234', 0, 12.92, 20, 1.08) . '</g>'
      . '<rect width="8.6" height="7.54" fill="#3c3b6e"/>'],
    ['iso' => 'PL', 'name' => 'Poland', 'code' => '+48', 'svg' =>
      '<rect width="20" height="14" fill="#fff"/><rect y="7" width="20" height="7" fill="#dc143c"/>'],
    ['iso' => 'RO', 'name' => 'Romania', 'code' => '+40', 'svg' => $vert('#002b7f', '#fcd116', '#ce1126')],
    ['iso' => 'LT', 'name' => 'Lithuania', 'code' => '+370', 'svg' => $horiz('#fdb913', '#006a44', '#c1272d')],
    ['iso' => 'LV', 'name' => 'Latvia', 'code' => '+371', 'svg' =>
      '<rect width="20" height="14" fill="#9e3039"/><rect y="5.6" width="20" height="2.8" fill="#fff"/>'],
    ['iso' => 'FR', 'name' => 'France', 'code' => '+33', 'svg' => $vert('#002395', '#ffffff', '#ed2939')],
    ['iso' => 'DE', 'name' => 'Germany', 'code' => '+49', 'svg' => $horiz('#000000', '#dd0000', '#ffce00')],
    ['iso' => 'ES', 'name' => 'Spain', 'code' => '+34', 'svg' =>
      '<rect width="20" height="14" fill="#c60b1e"/><rect y="3.5" width="20" height="7" fill="#ffc400"/>'],
    ['iso' => 'IT', 'name' => 'Italy', 'code' => '+39', 'svg' => $vert('#009246', '#ffffff', '#ce2b37')],
    ['iso' => 'PT', 'name' => 'Portugal', 'code' => '+351', 'svg' =>
      '<rect width="20" height="14" fill="#da291c"/><rect width="8" height="14" fill="#046a38"/>'
      . '<circle cx="8" cy="7" r="2.6" fill="#ffe900" stroke="#fff" stroke-width="0.5"/>'],
    ['iso' => 'NL', 'name' => 'Netherlands', 'code' => '+31', 'svg' => $horiz('#ae1c28', '#ffffff', '#21468b')],
    ['iso' => 'BE', 'name' => 'Belgium', 'code' => '+32', 'svg' => $vert('#000000', '#fdda24', '#ef3340')],
    ['iso' => 'SE', 'name' => 'Sweden', 'code' => '+46', 'svg' =>
      '<rect width="20" height="14" fill="#006aa7"/><rect x="5.6" width="2.6" height="14" fill="#fecc00"/>'
      . '<rect y="5.7" width="20" height="2.6" fill="#fecc00"/>'],
    ['iso' => 'IN', 'name' => 'India', 'code' => '+91', 'svg' =>
      $horiz('#ff9933', '#ffffff', '#138808')
      . '<circle cx="10" cy="7" r="1.7" fill="none" stroke="#000080" stroke-width="0.6"/>'],
    ['iso' => 'PK', 'name' => 'Pakistan', 'code' => '+92', 'svg' =>
      '<rect width="20" height="14" fill="#01411c"/><rect width="5" height="14" fill="#fff"/>'
      . '<circle cx="12.6" cy="7" r="3" fill="#fff"/><circle cx="13.8" cy="6.3" r="3" fill="#01411c"/>'],
    ['iso' => 'NG', 'name' => 'Nigeria', 'code' => '+234', 'svg' => $vert('#008751', '#ffffff', '#008751')],
    ['iso' => 'BR', 'name' => 'Brazil', 'code' => '+55', 'svg' =>
      '<rect width="20" height="14" fill="#009b3a"/>'
      . '<path d="M10 1.6L18.4 7 10 12.4 1.6 7z" fill="#fedf00"/>'
      . '<circle cx="10" cy="7" r="2.6" fill="#002776"/>'],
    ['iso' => 'AU', 'name' => 'Australia', 'code' => '+61', 'svg' =>
      '<rect width="20" height="14" fill="#00247d"/>'
      . '<path d="M0 0l10 7M10 0L0 7" stroke="#fff" stroke-width="1.6"/>'
      . '<path d="M5 0v7M0 3.5h10" stroke="#fff" stroke-width="2.4"/>'
      . '<path d="M5 0v7M0 3.5h10" stroke="#c8102e" stroke-width="1.3"/>'
      . '<circle cx="5" cy="10.8" r="1.2" fill="#fff"/><circle cx="15" cy="4" r="0.9" fill="#fff"/>'
      . '<circle cx="16.4" cy="8.4" r="0.9" fill="#fff"/><circle cx="13.4" cy="10.6" r="0.7" fill="#fff"/>'],
    ['iso' => 'CA', 'name' => 'Canada', 'code' => '+1', 'svg' =>
      '<rect width="20" height="14" fill="#fff"/><rect width="5" height="14" fill="#d80621"/>'
      . '<rect x="15" width="5" height="14" fill="#d80621"/>'
      . '<path d="M10 3.2l.9 1.9 1.9-.6-.7 1.9 1.6.5-1.8 1.3.4 1.1-1.9-.3.1 2.3h-1l.1-2.3-1.9.3.4-1.1-1.8-1.3 1.6-.5-.7-1.9 1.9.6z" fill="#d80621"/>'],
    ['iso' => 'ZA', 'name' => 'South Africa', 'code' => '+27', 'svg' =>
      '<rect width="20" height="14" fill="#002395"/><rect width="20" height="7" fill="#de3831"/>'
      . '<rect y="5.6" width="20" height="2.8" fill="#fff"/>'
      . '<path d="M0 0l7 7-7 7z" fill="#007a4d"/><path d="M0 2.4L4.6 7 0 11.6z" fill="#ffb612"/>'],
    ['iso' => 'AE', 'name' => 'United Arab Emirates', 'code' => '+971', 'svg' =>
      $horiz('#00732f', '#ffffff', '#000000') . '<rect width="5" height="14" fill="#ff0000"/>'],
    ['iso' => 'CN', 'name' => 'China', 'code' => '+86', 'svg' =>
      '<rect width="20" height="14" fill="#de2910"/>'
      . '<path d="M3.4 2l.7 2.1h2.2L4.5 5.4l.7 2.1-1.8-1.3-1.8 1.3.7-2.1-1.8-1.3h2.2z" fill="#ffde00"/>'
      . '<circle cx="7.6" cy="1.9" r="0.6" fill="#ffde00"/><circle cx="9.1" cy="3.4" r="0.6" fill="#ffde00"/>'
      . '<circle cx="9.1" cy="5.5" r="0.6" fill="#ffde00"/><circle cx="7.6" cy="7" r="0.6" fill="#ffde00"/>'],
  ];
}

/** The dial code to pre-select. */
const PC_PHONE_DEFAULT_ISO = 'IE';

/** True when $code is one of the dial codes we offer. Used to validate the posted value. */
function pc_phone_code_valid(string $code): bool
{
  foreach (pc_phone_countries() as $c) {
    if ($c['code'] === $code) {
      return true;
    }
  }
  return false;
}

/** Joins a posted dial code and number into one string for the email body. */
function pc_phone_full(string $code, string $number): string
{
  $number = trim($number);
  if ($number === '') {
    return '';
  }
  // Already international: leave whatever the user typed alone.
  if (str_starts_with($number, '+') || str_starts_with($number, '00')) {
    return $number;
  }
  $code = pc_phone_code_valid($code) ? $code : '+353';
  // A leading trunk zero is dropped when a country code is prefixed.
  return $code . ' ' . ltrim($number, '0');
}
