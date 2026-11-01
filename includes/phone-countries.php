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
 * Each SVG is drawn in a 20x14 viewBox and simplified to the shapes that read at 20px. Ireland
 * comes first, then the nationalities that actually book and drive in Dublin, then every other
 * dialling code alphabetically. There is no API call and no build step behind this: a runtime
 * fetch would put a third party in front of every form on the site, so the list lives here and
 * both the dropdown and the validator read it.
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

  $curated = [
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

  // Everything else, alphabetically and without a drawn flag -- the field falls back to a neutral
  // chip carrying the ISO code. Writing 190 more SVGs would add ~100KB to every page with a form
  // for shapes that are 20px wide; promoting a country is just a matter of adding its svg above.
  foreach ([
    ['iso' => 'AF', 'name' => 'Afghanistan', 'code' => '+93'],
    ['iso' => 'AL', 'name' => 'Albania', 'code' => '+355'],
    ['iso' => 'DZ', 'name' => 'Algeria', 'code' => '+213'],
    ['iso' => 'AS', 'name' => 'American Samoa', 'code' => '+1'],
    ['iso' => 'AD', 'name' => 'Andorra', 'code' => '+376'],
    ['iso' => 'AO', 'name' => 'Angola', 'code' => '+244'],
    ['iso' => 'AI', 'name' => 'Anguilla', 'code' => '+1'],
    ['iso' => 'AG', 'name' => 'Antigua and Barbuda', 'code' => '+1'],
    ['iso' => 'AR', 'name' => 'Argentina', 'code' => '+54'],
    ['iso' => 'AM', 'name' => 'Armenia', 'code' => '+374'],
    ['iso' => 'AW', 'name' => 'Aruba', 'code' => '+297'],
    ['iso' => 'AT', 'name' => 'Austria', 'code' => '+43'],
    ['iso' => 'AZ', 'name' => 'Azerbaijan', 'code' => '+994'],
    ['iso' => 'BS', 'name' => 'Bahamas', 'code' => '+1'],
    ['iso' => 'BH', 'name' => 'Bahrain', 'code' => '+973'],
    ['iso' => 'BD', 'name' => 'Bangladesh', 'code' => '+880'],
    ['iso' => 'BB', 'name' => 'Barbados', 'code' => '+1'],
    ['iso' => 'BY', 'name' => 'Belarus', 'code' => '+375'],
    ['iso' => 'BZ', 'name' => 'Belize', 'code' => '+501'],
    ['iso' => 'BJ', 'name' => 'Benin', 'code' => '+229'],
    ['iso' => 'BM', 'name' => 'Bermuda', 'code' => '+1'],
    ['iso' => 'BT', 'name' => 'Bhutan', 'code' => '+975'],
    ['iso' => 'BO', 'name' => 'Bolivia', 'code' => '+591'],
    ['iso' => 'BA', 'name' => 'Bosnia and Herzegovina', 'code' => '+387'],
    ['iso' => 'BW', 'name' => 'Botswana', 'code' => '+267'],
    ['iso' => 'VG', 'name' => 'British Virgin Islands', 'code' => '+1'],
    ['iso' => 'BN', 'name' => 'Brunei', 'code' => '+673'],
    ['iso' => 'BG', 'name' => 'Bulgaria', 'code' => '+359'],
    ['iso' => 'BF', 'name' => 'Burkina Faso', 'code' => '+226'],
    ['iso' => 'BI', 'name' => 'Burundi', 'code' => '+257'],
    ['iso' => 'KH', 'name' => 'Cambodia', 'code' => '+855'],
    ['iso' => 'CM', 'name' => 'Cameroon', 'code' => '+237'],
    ['iso' => 'CV', 'name' => 'Cape Verde', 'code' => '+238'],
    ['iso' => 'KY', 'name' => 'Cayman Islands', 'code' => '+1'],
    ['iso' => 'CF', 'name' => 'Central African Republic', 'code' => '+236'],
    ['iso' => 'TD', 'name' => 'Chad', 'code' => '+235'],
    ['iso' => 'CL', 'name' => 'Chile', 'code' => '+56'],
    ['iso' => 'CO', 'name' => 'Colombia', 'code' => '+57'],
    ['iso' => 'KM', 'name' => 'Comoros', 'code' => '+269'],
    ['iso' => 'CG', 'name' => 'Congo - Brazzaville', 'code' => '+242'],
    ['iso' => 'CD', 'name' => 'Congo - Kinshasa', 'code' => '+243'],
    ['iso' => 'CR', 'name' => 'Costa Rica', 'code' => '+506'],
    ['iso' => 'CI', 'name' => 'Côte d’Ivoire', 'code' => '+225'],
    ['iso' => 'HR', 'name' => 'Croatia', 'code' => '+385'],
    ['iso' => 'CU', 'name' => 'Cuba', 'code' => '+53'],
    ['iso' => 'CW', 'name' => 'Curaçao', 'code' => '+599'],
    ['iso' => 'CY', 'name' => 'Cyprus', 'code' => '+357'],
    ['iso' => 'CZ', 'name' => 'Czechia', 'code' => '+420'],
    ['iso' => 'DK', 'name' => 'Denmark', 'code' => '+45'],
    ['iso' => 'DJ', 'name' => 'Djibouti', 'code' => '+253'],
    ['iso' => 'DM', 'name' => 'Dominica', 'code' => '+1'],
    ['iso' => 'DO', 'name' => 'Dominican Republic', 'code' => '+1'],
    ['iso' => 'EC', 'name' => 'Ecuador', 'code' => '+593'],
    ['iso' => 'EG', 'name' => 'Egypt', 'code' => '+20'],
    ['iso' => 'SV', 'name' => 'El Salvador', 'code' => '+503'],
    ['iso' => 'GQ', 'name' => 'Equatorial Guinea', 'code' => '+240'],
    ['iso' => 'ER', 'name' => 'Eritrea', 'code' => '+291'],
    ['iso' => 'EE', 'name' => 'Estonia', 'code' => '+372'],
    ['iso' => 'SZ', 'name' => 'Eswatini', 'code' => '+268'],
    ['iso' => 'ET', 'name' => 'Ethiopia', 'code' => '+251'],
    ['iso' => 'FO', 'name' => 'Faroe Islands', 'code' => '+298'],
    ['iso' => 'FJ', 'name' => 'Fiji', 'code' => '+679'],
    ['iso' => 'FI', 'name' => 'Finland', 'code' => '+358'],
    ['iso' => 'GF', 'name' => 'French Guiana', 'code' => '+594'],
    ['iso' => 'PF', 'name' => 'French Polynesia', 'code' => '+689'],
    ['iso' => 'GA', 'name' => 'Gabon', 'code' => '+241'],
    ['iso' => 'GM', 'name' => 'Gambia', 'code' => '+220'],
    ['iso' => 'GE', 'name' => 'Georgia', 'code' => '+995'],
    ['iso' => 'GH', 'name' => 'Ghana', 'code' => '+233'],
    ['iso' => 'GI', 'name' => 'Gibraltar', 'code' => '+350'],
    ['iso' => 'GR', 'name' => 'Greece', 'code' => '+30'],
    ['iso' => 'GL', 'name' => 'Greenland', 'code' => '+299'],
    ['iso' => 'GD', 'name' => 'Grenada', 'code' => '+1'],
    ['iso' => 'GP', 'name' => 'Guadeloupe', 'code' => '+590'],
    ['iso' => 'GU', 'name' => 'Guam', 'code' => '+1'],
    ['iso' => 'GT', 'name' => 'Guatemala', 'code' => '+502'],
    ['iso' => 'GG', 'name' => 'Guernsey', 'code' => '+44'],
    ['iso' => 'GN', 'name' => 'Guinea', 'code' => '+224'],
    ['iso' => 'GW', 'name' => 'Guinea-Bissau', 'code' => '+245'],
    ['iso' => 'GY', 'name' => 'Guyana', 'code' => '+592'],
    ['iso' => 'HT', 'name' => 'Haiti', 'code' => '+509'],
    ['iso' => 'HN', 'name' => 'Honduras', 'code' => '+504'],
    ['iso' => 'HK', 'name' => 'Hong Kong SAR China', 'code' => '+852'],
    ['iso' => 'HU', 'name' => 'Hungary', 'code' => '+36'],
    ['iso' => 'IS', 'name' => 'Iceland', 'code' => '+354'],
    ['iso' => 'ID', 'name' => 'Indonesia', 'code' => '+62'],
    ['iso' => 'IR', 'name' => 'Iran', 'code' => '+98'],
    ['iso' => 'IQ', 'name' => 'Iraq', 'code' => '+964'],
    ['iso' => 'IM', 'name' => 'Isle of Man', 'code' => '+44'],
    ['iso' => 'IL', 'name' => 'Israel', 'code' => '+972'],
    ['iso' => 'JM', 'name' => 'Jamaica', 'code' => '+1'],
    ['iso' => 'JP', 'name' => 'Japan', 'code' => '+81'],
    ['iso' => 'JE', 'name' => 'Jersey', 'code' => '+44'],
    ['iso' => 'JO', 'name' => 'Jordan', 'code' => '+962'],
    ['iso' => 'KZ', 'name' => 'Kazakhstan', 'code' => '+7'],
    ['iso' => 'KE', 'name' => 'Kenya', 'code' => '+254'],
    ['iso' => 'KI', 'name' => 'Kiribati', 'code' => '+686'],
    ['iso' => 'KW', 'name' => 'Kuwait', 'code' => '+965'],
    ['iso' => 'KG', 'name' => 'Kyrgyzstan', 'code' => '+996'],
    ['iso' => 'LA', 'name' => 'Laos', 'code' => '+856'],
    ['iso' => 'LB', 'name' => 'Lebanon', 'code' => '+961'],
    ['iso' => 'LS', 'name' => 'Lesotho', 'code' => '+266'],
    ['iso' => 'LR', 'name' => 'Liberia', 'code' => '+231'],
    ['iso' => 'LY', 'name' => 'Libya', 'code' => '+218'],
    ['iso' => 'LI', 'name' => 'Liechtenstein', 'code' => '+423'],
    ['iso' => 'LU', 'name' => 'Luxembourg', 'code' => '+352'],
    ['iso' => 'MO', 'name' => 'Macao SAR China', 'code' => '+853'],
    ['iso' => 'MG', 'name' => 'Madagascar', 'code' => '+261'],
    ['iso' => 'MW', 'name' => 'Malawi', 'code' => '+265'],
    ['iso' => 'MY', 'name' => 'Malaysia', 'code' => '+60'],
    ['iso' => 'MV', 'name' => 'Maldives', 'code' => '+960'],
    ['iso' => 'ML', 'name' => 'Mali', 'code' => '+223'],
    ['iso' => 'MT', 'name' => 'Malta', 'code' => '+356'],
    ['iso' => 'MH', 'name' => 'Marshall Islands', 'code' => '+692'],
    ['iso' => 'MQ', 'name' => 'Martinique', 'code' => '+596'],
    ['iso' => 'MR', 'name' => 'Mauritania', 'code' => '+222'],
    ['iso' => 'MU', 'name' => 'Mauritius', 'code' => '+230'],
    ['iso' => 'MX', 'name' => 'Mexico', 'code' => '+52'],
    ['iso' => 'FM', 'name' => 'Micronesia', 'code' => '+691'],
    ['iso' => 'MD', 'name' => 'Moldova', 'code' => '+373'],
    ['iso' => 'MC', 'name' => 'Monaco', 'code' => '+377'],
    ['iso' => 'MN', 'name' => 'Mongolia', 'code' => '+976'],
    ['iso' => 'ME', 'name' => 'Montenegro', 'code' => '+382'],
    ['iso' => 'MS', 'name' => 'Montserrat', 'code' => '+1'],
    ['iso' => 'MA', 'name' => 'Morocco', 'code' => '+212'],
    ['iso' => 'MZ', 'name' => 'Mozambique', 'code' => '+258'],
    ['iso' => 'MM', 'name' => 'Myanmar', 'code' => '+95'],
    ['iso' => 'NA', 'name' => 'Namibia', 'code' => '+264'],
    ['iso' => 'NR', 'name' => 'Nauru', 'code' => '+674'],
    ['iso' => 'NP', 'name' => 'Nepal', 'code' => '+977'],
    ['iso' => 'NC', 'name' => 'New Caledonia', 'code' => '+687'],
    ['iso' => 'NZ', 'name' => 'New Zealand', 'code' => '+64'],
    ['iso' => 'NI', 'name' => 'Nicaragua', 'code' => '+505'],
    ['iso' => 'NE', 'name' => 'Niger', 'code' => '+227'],
    ['iso' => 'KP', 'name' => 'North Korea', 'code' => '+850'],
    ['iso' => 'MK', 'name' => 'North Macedonia', 'code' => '+389'],
    ['iso' => 'NO', 'name' => 'Norway', 'code' => '+47'],
    ['iso' => 'OM', 'name' => 'Oman', 'code' => '+968'],
    ['iso' => 'PW', 'name' => 'Palau', 'code' => '+680'],
    ['iso' => 'PS', 'name' => 'Palestine', 'code' => '+970'],
    ['iso' => 'PA', 'name' => 'Panama', 'code' => '+507'],
    ['iso' => 'PG', 'name' => 'Papua New Guinea', 'code' => '+675'],
    ['iso' => 'PY', 'name' => 'Paraguay', 'code' => '+595'],
    ['iso' => 'PE', 'name' => 'Peru', 'code' => '+51'],
    ['iso' => 'PH', 'name' => 'Philippines', 'code' => '+63'],
    ['iso' => 'PR', 'name' => 'Puerto Rico', 'code' => '+1'],
    ['iso' => 'QA', 'name' => 'Qatar', 'code' => '+974'],
    ['iso' => 'RE', 'name' => 'Réunion', 'code' => '+262'],
    ['iso' => 'RU', 'name' => 'Russia', 'code' => '+7'],
    ['iso' => 'RW', 'name' => 'Rwanda', 'code' => '+250'],
    ['iso' => 'WS', 'name' => 'Samoa', 'code' => '+685'],
    ['iso' => 'SM', 'name' => 'San Marino', 'code' => '+378'],
    ['iso' => 'ST', 'name' => 'São Tomé and Príncipe', 'code' => '+239'],
    ['iso' => 'SA', 'name' => 'Saudi Arabia', 'code' => '+966'],
    ['iso' => 'SN', 'name' => 'Senegal', 'code' => '+221'],
    ['iso' => 'RS', 'name' => 'Serbia', 'code' => '+381'],
    ['iso' => 'SC', 'name' => 'Seychelles', 'code' => '+248'],
    ['iso' => 'SL', 'name' => 'Sierra Leone', 'code' => '+232'],
    ['iso' => 'SG', 'name' => 'Singapore', 'code' => '+65'],
    ['iso' => 'SK', 'name' => 'Slovakia', 'code' => '+421'],
    ['iso' => 'SI', 'name' => 'Slovenia', 'code' => '+386'],
    ['iso' => 'SB', 'name' => 'Solomon Islands', 'code' => '+677'],
    ['iso' => 'SO', 'name' => 'Somalia', 'code' => '+252'],
    ['iso' => 'KR', 'name' => 'South Korea', 'code' => '+82'],
    ['iso' => 'SS', 'name' => 'South Sudan', 'code' => '+211'],
    ['iso' => 'LK', 'name' => 'Sri Lanka', 'code' => '+94'],
    ['iso' => 'KN', 'name' => 'St Kitts and Nevis', 'code' => '+1'],
    ['iso' => 'LC', 'name' => 'St Lucia', 'code' => '+1'],
    ['iso' => 'VC', 'name' => 'St Vincent and the Grenadines', 'code' => '+1'],
    ['iso' => 'SD', 'name' => 'Sudan', 'code' => '+249'],
    ['iso' => 'SR', 'name' => 'Suriname', 'code' => '+597'],
    ['iso' => 'CH', 'name' => 'Switzerland', 'code' => '+41'],
    ['iso' => 'SY', 'name' => 'Syria', 'code' => '+963'],
    ['iso' => 'TW', 'name' => 'Taiwan', 'code' => '+886'],
    ['iso' => 'TJ', 'name' => 'Tajikistan', 'code' => '+992'],
    ['iso' => 'TZ', 'name' => 'Tanzania', 'code' => '+255'],
    ['iso' => 'TH', 'name' => 'Thailand', 'code' => '+66'],
    ['iso' => 'TL', 'name' => 'Timor-Leste', 'code' => '+670'],
    ['iso' => 'TG', 'name' => 'Togo', 'code' => '+228'],
    ['iso' => 'TO', 'name' => 'Tonga', 'code' => '+676'],
    ['iso' => 'TT', 'name' => 'Trinidad and Tobago', 'code' => '+1'],
    ['iso' => 'TN', 'name' => 'Tunisia', 'code' => '+216'],
    ['iso' => 'TR', 'name' => 'Türkiye', 'code' => '+90'],
    ['iso' => 'TM', 'name' => 'Turkmenistan', 'code' => '+993'],
    ['iso' => 'TC', 'name' => 'Turks and Caicos Islands', 'code' => '+1'],
    ['iso' => 'TV', 'name' => 'Tuvalu', 'code' => '+688'],
    ['iso' => 'UG', 'name' => 'Uganda', 'code' => '+256'],
    ['iso' => 'UA', 'name' => 'Ukraine', 'code' => '+380'],
    ['iso' => 'UY', 'name' => 'Uruguay', 'code' => '+598'],
    ['iso' => 'VI', 'name' => 'US Virgin Islands', 'code' => '+1'],
    ['iso' => 'UZ', 'name' => 'Uzbekistan', 'code' => '+998'],
    ['iso' => 'VU', 'name' => 'Vanuatu', 'code' => '+678'],
    ['iso' => 'VA', 'name' => 'Vatican City', 'code' => '+39'],
    ['iso' => 'VE', 'name' => 'Venezuela', 'code' => '+58'],
    ['iso' => 'VN', 'name' => 'Vietnam', 'code' => '+84'],
    ['iso' => 'YE', 'name' => 'Yemen', 'code' => '+967'],
    ['iso' => 'ZM', 'name' => 'Zambia', 'code' => '+260'],
    ['iso' => 'ZW', 'name' => 'Zimbabwe', 'code' => '+263'],
  ] as $c) {
    $curated[] = $c + ['svg' => ''];
  }

  return $curated;
}

/**
 * The flag for one row. Countries without an inline SVG get a neutral chip with their ISO code,
 * which reads as deliberate rather than as a missing image. phone-field.js draws the same chip
 * for the rows it builds, so the trigger and the panel always agree.
 */
function pc_phone_flag_svg(array $c): string
{
  if (($c['svg'] ?? '') !== '') {
    return $c['svg'];
  }
  return '<rect width="20" height="14" rx="2" fill="#ece7e1"/>'
    . '<text x="10" y="10.3" text-anchor="middle" font-size="7.5" font-weight="700" fill="#8a807a"'
    . ' font-family="system-ui, -apple-system, Segoe UI, sans-serif">' . htmlspecialchars($c['iso']) . '</text>';
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
