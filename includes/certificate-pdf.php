<?php
declare(strict_types=1);

const PC_CERT_PAPER = '1 1 1';
const PC_CERT_INK = '0.105 0.105 0.105';
const PC_CERT_ORANGE = '0.976 0.451 0.086';

const PC_CERT_ORANGE_DEEP = '0.847 0.373 0.043';
const PC_CERT_WHITE = '1 1 1';

const PC_PDF_W_REG = [
  278, 278, 355, 556, 556, 889, 667, 191, 333, 333, 389, 584, 278, 333, 278, 278,
  556, 556, 556, 556, 556, 556, 556, 556, 556, 556, 278, 278, 584, 584, 584, 556,
  1015, 667, 667, 722, 722, 667, 611, 778, 722, 278, 500, 667, 556, 833, 722, 778,
  667, 778, 722, 667, 611, 722, 667, 944, 667, 667, 611, 278, 278, 278, 469, 556,
  333, 556, 556, 500, 556, 556, 278, 556, 556, 222, 222, 500, 222, 833, 556, 556,
  556, 556, 333, 500, 278, 556, 500, 722, 500, 500, 500, 334, 260, 334, 584,
];

const PC_PDF_W_BOLD = [
  278, 333, 474, 556, 556, 889, 722, 238, 333, 333, 389, 584, 278, 333, 278, 278,
  556, 556, 556, 556, 556, 556, 556, 556, 556, 556, 333, 333, 584, 584, 584, 611,
  975, 722, 722, 722, 722, 667, 611, 778, 722, 278, 556, 722, 611, 833, 722, 778,
  667, 778, 722, 667, 611, 722, 667, 944, 667, 667, 611, 333, 278, 333, 584, 556,
  333, 556, 611, 556, 611, 556, 333, 611, 611, 278, 278, 556, 278, 889, 611, 611,
  611, 611, 389, 556, 333, 611, 556, 778, 556, 556, 500, 389, 280, 389, 584,
];

function pc_pdf_text(string $s): string
{
  // Labels come from the same arrays the HTML uses, so they carry entities. A PDF has no
  // markup, so an entity here is always meant as the character it names.
  $s = html_entity_decode($s, ENT_QUOTES | ENT_HTML5, 'UTF-8');

  $out = @iconv('UTF-8', 'CP1252//TRANSLIT', $s);
  if ($out === false) {
    $out = preg_replace('/[^\x20-\x7E]/', '?', $s) ?? '';
  }
  
  return str_replace(['\\', '(', ')', "\r", "\n"], ['\\\\', '\\(', '\\)', '', ''], $out);
}

function pc_pdf_width(string $cp1252, float $size, bool $bold): float
{
  $table = $bold ? PC_PDF_W_BOLD : PC_PDF_W_REG;
  $units = 0;
  $len = strlen($cp1252);
  for ($i = 0; $i < $len; $i++) {
    $c = ord($cp1252[$i]);

    $units += ($c >= 32 && $c <= 126) ? $table[$c - 32] : ($bold ? 611 : 556);
  }
  return $units * $size / 1000;
}

function pc_pdf_centre(string $raw, float $y, float $size, bool $bold, float $pageW, string $rgb): string
{
  $t = pc_pdf_text($raw);
  $x = ($pageW - pc_pdf_width($t, $size, $bold)) / 2;
  return sprintf("BT %s rg %s %.2f Tf 1 0 0 1 %.2f %.2f Tm (%s) Tj ET\n", $rgb, $bold ? '/F2' : '/F1', $size, $x, $y, $t);
}

function pc_pdf_centre_tracked(string $raw, float $y, float $size, bool $bold, float $pageW, float $track, string $rgb): string
{
  $t = pc_pdf_text($raw);
  $w = pc_pdf_width($t, $size, $bold) + $track * max(0, strlen($t) - 1);
  $x = ($pageW - $w) / 2;
  return sprintf(
    "BT %s rg %s %.2f Tf %.2f Tc 1 0 0 1 %.2f %.2f Tm (%s) Tj 0 Tc ET\n",
    $rgb, $bold ? '/F2' : '/F1', $size, $track, $x, $y, $t
  );
}

function pc_cert_image(string $file): ?array
{
  $path = __DIR__ . '/../assets/img/' . $file;
  if (!is_readable($path)) {
    return null;
  }
  $bytes = file_get_contents($path);
  if ($bytes === false) {
    return null;
  }
  $size = @getimagesize($path);
  if (!$size || $size[2] !== IMAGETYPE_JPEG) {
    return null;
  }
  return ['bytes' => $bytes, 'w' => (int) $size[0], 'h' => (int) $size[1]];
}

/**
 * The signature mark, drawn as vector curves rather than a raster.
 *
 * It is a stylised flourish, not a name: nothing in it is legible as letters, which is
 * deliberate -- a reproducible image of a real person's handwriting on a file anyone can
 * download is worth avoiding. The authority on the certificate is the printed role line
 * under the rule, plus the certificate ID.
 *
 * Coordinates are authored in a 300 x 90 box with y running DOWN (as in the SVG the shape
 * was designed in). The `cm` below flips y and scales, so the path numbers can stay as drawn.
 */
function pc_cert_signature(float $pageW, float $ruleY): string
{
  $boxW = 300.0;
  $boxH = 90.0;
  // Deliberately finer and smaller than a felt-tip: on an official document the signature is
  // a quiet mark under a rule, not the loudest thing on the page.
  $scale = 0.46;
  $w = $boxW * $scale;

  $stroke = [
    [18.0, 64.0],
    [26, 22, 44, 4, 58, 10],
    [72, 16, 62, 40, 44, 50],
    [30, 58, 22, 50, 30, 42],
    [46, 26, 78, 40, 88, 56],
    [94, 66, 108, 66, 114, 52],
    [120, 38, 108, 30, 100, 38],
    [92, 46, 104, 60, 126, 58],
    [146, 56, 152, 30, 168, 32],
    [180, 33, 178, 52, 192, 54],
    [208, 56, 214, 30, 232, 34],
    [244, 37, 244, 54, 258, 52],
    [272, 50, 280, 40, 288, 44],
  ];

  // Top of the authoring box in PDF space; the mark then hangs down to just above the rule.
  // The +4 keeps the tail flourish clear of the rule rather than sitting on it.
  $top = $ruleY + 4 + $boxH * $scale;

  $out = sprintf("q %.3f 0 0 %.3f %.2f %.2f cm\n", $scale, -$scale, ($pageW - $w) / 2, $top);
  $out .= '0.16 0.15 0.15 RG 1 J 1 j' . "\n";

  $out .= sprintf("3.4 w %.1f %.1f m\n", $stroke[0][0], $stroke[0][1]);
  foreach (array_slice($stroke, 1) as $s) {
    $out .= sprintf("%.1f %.1f %.1f %.1f %.1f %.1f c\n", $s[0], $s[1], $s[2], $s[3], $s[4], $s[5]);
  }
  $out .= "S\n";

  // The underline flourish, drawn with a lighter pen.
  $out .= "1.8 w 250 72 m 210 86 110 86 40 72 c S\n";

  return $out . "Q\n";
}

/** A rounded rectangle as a closed path. Caller supplies the paint operator (f, S or B). */
function pc_pdf_round_rect(float $x, float $y, float $w, float $h, float $r): string
{
  $k = 0.5523 * $r;
  return sprintf(
    "%.2f %.2f m %.2f %.2f l %.2f %.2f %.2f %.2f %.2f %.2f c %.2f %.2f l "
      . "%.2f %.2f %.2f %.2f %.2f %.2f c %.2f %.2f l %.2f %.2f %.2f %.2f %.2f %.2f c "
      . "%.2f %.2f l %.2f %.2f %.2f %.2f %.2f %.2f c h\n",
    $x + $r, $y,
    $x + $w - $r, $y,
    $x + $w - $r + $k, $y, $x + $w, $y + $r - $k, $x + $w, $y + $r,
    $x + $w, $y + $h - $r,
    $x + $w, $y + $h - $r + $k, $x + $w - $r + $k, $y + $h, $x + $w - $r, $y + $h,
    $x + $r, $y + $h,
    $x + $r - $k, $y + $h, $x, $y + $h - $r + $k, $x, $y + $h - $r,
    $x, $y + $r,
    $x, $y + $r - $k, $x + $r - $k, $y, $x + $r, $y
  );
}

/** Left-aligned text run. */
function pc_pdf_at(string $raw, float $x, float $y, float $size, bool $bold, string $rgb, float $track = 0.0): string
{
  $t = pc_pdf_text($raw);
  return sprintf(
    "BT %s rg %s %.2f Tf %.2f Tc 1 0 0 1 %.2f %.2f Tm (%s) Tj 0 Tc ET\n",
    $rgb, $bold ? '/F2' : '/F1', $size, $track, $x, $y, $t
  );
}

function pc_certificate_pdf(array $data): string
{
  $W = 842.0; 
  $H = 595.0;

  $name = (string) ($data['name'] ?? 'Driver');
  $certId = (string) ($data['certificateId'] ?? '');
  $when = (int) ($data['completedAt'] ?? time());
  $dateStr = gmdate('j F Y', $when);

  $ink = PC_CERT_INK;
  $orange = PC_CERT_ORANGE;
  $white = PC_CERT_WHITE;
  $dim = '0.45 0.43 0.42'; 

  $logo = pc_cert_image('certificate-logo.jpg');

  $bandH = 112.0; 
  $footH = 46.0;  
  $c = '';

  $c .= sprintf("%s rg 0 0 %.2f %.2f re f\n", PC_CERT_PAPER, $W, $H);

  $c .= sprintf("q 0 %.2f %.2f %.2f re W n /Sh1 sh Q\n", $H - $bandH, $W, $bandH);

  $c .= pc_pdf_centre_tracked('CERTIFICATE OF DRIVER TRAINING', $H - 52, 15, true, $W, 4.2, $white);
  $c .= pc_pdf_centre_tracked('POWERCABS DRIVER ACADEMY', $H - 76, 8, false, $W, 3.0, $white);
  
  $c .= sprintf("%s RG 1.2 w 0 %.2f m %.2f %.2f l S\n", PC_CERT_ORANGE_DEEP, $H - $bandH, $W, $H - $bandH);

  // A single hairline frame around the white field, inset from the masthead and the footer.
  // One rule only: this sits on a document people print, and anything busier reads as a border clipart.
  $c .= sprintf(
    "0.88 0.86 0.84 RG 0.6 w %.2f %.2f %.2f %.2f re S\n",
    22.0, $footH + 14.0, $W - 44.0, $H - $bandH - $footH - 28.0
  );

  $logoBottom = $H - 178;
  if ($logo) {
    $lw = 150.0;
    $lh = $lw * ($logo['h'] / $logo['w']);
    $c .= sprintf("q %.2f 0 0 %.2f %.2f %.2f cm /Im1 Do Q\n", $lw, $lh, ($W - $lw) / 2, $logoBottom);
  } else {
    $c .= pc_pdf_centre_tracked('POWERCABS', $logoBottom + 14, 20, true, $W, 5.0, $ink);
  }

  $c .= pc_pdf_centre_tracked('THIS CERTIFIES THAT', $H - 206, 8, false, $W, 2.6, $dim);
  $c .= pc_pdf_centre($name, $H - 250, 32, true, $W, $ink);

  $nameW = min($W - 240, max(260.0, pc_pdf_width(pc_pdf_text($name), 32, true) + 76));
  $c .= sprintf("%s RG 1 w %.2f %.2f m %.2f %.2f l S\n", $orange, ($W - $nameW) / 2, $H - 266, ($W + $nameW) / 2, $H - 266);

  $c .= pc_pdf_centre('has successfully completed the PowerCabs Driver Academy Programme', $H - 290, 11, false, $W, $dim);

  // --- qualification chips -------------------------------------------------------------
  // One chip per track passed. With a single qualification this is a lone centred chip; with
  // two it is a pair, and the certificate reads as a record that grew rather than a reprint.
  $quals = is_array($data['quals'] ?? null) && $data['quals'] ? $data['quals'] : [[
    'label' => 'General Driver Training',
    'desc' => 'Core PowerCabs driver programme',
    'at' => $when,
  ]];

  $chipH = 46.0;
  $chipY = $H - 356;
  $chipGap = 14.0;
  $chipPadL = 12.0;
  $chipPadR = 16.0;
  $markD = 18.0;

  $measured = [];
  $totalW = 0.0;
  foreach ($quals as $q) {
    $lt = pc_pdf_text((string) $q['label']);
    $dt = pc_pdf_text(gmdate('j F Y', (int) $q['at']));
    $w = $chipPadL + $markD + 9 + max(pc_pdf_width($lt, 10.5, true), pc_pdf_width($dt, 7.5, false)) + $chipPadR;
    $measured[] = [$w, $lt, $dt];
    $totalW += $w;
  }
  $totalW += $chipGap * (count($measured) - 1);

  $x = ($W - $totalW) / 2;
  foreach ($measured as [$cw, $lt, $dt]) {
    $c .= sprintf("%s rg\n", '0.996 0.957 0.918');
    $c .= pc_pdf_round_rect($x, $chipY, $cw, $chipH, 10.0) . "f\n";
    $c .= sprintf("%s RG 0.7 w\n", $orange);
    $c .= pc_pdf_round_rect($x, $chipY, $cw, $chipH, 10.0) . "S\n";

    // Filled disc with a white tick.
    $mx = $x + $chipPadL;
    $my = $chipY + ($chipH - $markD) / 2;
    $c .= sprintf("%s rg\n", $orange);
    $c .= pc_pdf_round_rect($mx, $my, $markD, $markD, $markD / 2) . "f\n";
    $c .= sprintf(
      "1 1 1 RG 1.5 w 1 J 1 j %.2f %.2f m %.2f %.2f l %.2f %.2f l S\n",
      $mx + 4.6, $my + 9.2,
      $mx + 7.6, $my + 6.0,
      $mx + 13.4, $my + 12.4
    );

    $tx = $mx + $markD + 9;
    $c .= sprintf("BT %s rg /F2 10.5 Tf 1 0 0 1 %.2f %.2f Tm (%s) Tj ET\n", $ink, $tx, $chipY + 25.5, $lt);
    $c .= sprintf("BT %s rg /F1 7.5 Tf 1 0 0 1 %.2f %.2f Tm (%s) Tj ET\n", $dim, $tx, $chipY + 12.5, $dt);

    $x += $cw + $chipGap;
  }

  // --- issue details -------------------------------------------------------------------
  $factY = 182.0;
  $c .= sprintf("0.90 0.88 0.86 RG 0.6 w %.2f %.2f m %.2f %.2f l S\n", $W * 0.22, $factY + 36, $W * 0.78, $factY + 36);

  $col = [$W * 0.3, $W * 0.5, $W * 0.7];
  $facts = [
    ['CERTIFICATE ID', $certId],
    ['ISSUED', $dateStr],
    ['FINAL SCORE', ((int) ($data['score'] ?? 0)) . ' / ' . ((int) ($data['total'] ?? 0))],
  ];
  foreach ($facts as $i => [$label, $value]) {
    $lt = pc_pdf_text($label);
    $vt = pc_pdf_text($value);
    $c .= sprintf(
      "BT %s rg /F1 7 Tf 1.8 Tc 1 0 0 1 %.2f %.2f Tm (%s) Tj 0 Tc ET\n",
      $dim,
      $col[$i] - (pc_pdf_width($lt, 7, false) + 1.8 * (strlen($lt) - 1)) / 2,
      $factY + 20,
      $lt
    );
    $c .= sprintf(
      "BT %s rg /F2 11.5 Tf 1 0 0 1 %.2f %.2f Tm (%s) Tj ET\n",
      $ink,
      $col[$i] - pc_pdf_width($vt, 11.5, true) / 2,
      $factY,
      $vt
    );
  }

  $sigRuleY = 104.0;
  $c .= pc_cert_signature($W, $sigRuleY);
  $c .= sprintf("0.78 0.76 0.74 RG 0.6 w %.2f %.2f m %.2f %.2f l S\n", $W / 2 - 92, $sigRuleY, $W / 2 + 92, $sigRuleY);
  $c .= pc_pdf_centre('CEO & Co-Founder, PowerCabs Ireland Ltd', $sigRuleY - 15, 8.5, false, $W, $dim);

  $c .= sprintf("%s rg 0 0 %.2f %.2f re f\n", $ink, $W, $footH);
  $c .= sprintf("%s rg 0 %.2f %.2f 2 re f\n", $orange, $footH, $W);

  $plateW = 40.0;
  $plateH = 14.0;
  $tailT = pc_pdf_text('DUBLIN, IRELAND   |   NTA LICENCE DH12616');
  $tailW = pc_pdf_width($tailT, 7.5, true) + 1.8 * (strlen($tailT) - 1);
  $blockW = $plateW + 11 + $tailW;
  $plateX = ($W - $blockW) / 2;
  $plateY = ($footH - $plateH) / 2;

  $c .= sprintf("%s rg %.2f %.2f %.2f %.2f re f\n", $orange, $plateX, $plateY, $plateW, $plateH);
  $taxi = pc_pdf_text('TAXI');
  $taxiW = pc_pdf_width($taxi, 8, true) + 1.2 * 3;
  $c .= sprintf(
    "BT %s rg /F2 8 Tf 1.2 Tc 1 0 0 1 %.2f %.2f Tm (%s) Tj 0 Tc ET\n",
    $ink, $plateX + ($plateW - $taxiW) / 2, $plateY + 4.2, $taxi
  );
  $c .= sprintf(
    "BT 1 1 1 rg /F2 7.5 Tf 1.8 Tc 1 0 0 1 %.2f %.2f Tm (%s) Tj 0 Tc ET\n",
    $plateX + $plateW + 11, $plateY + 4.2, $tailT
  );

  $xo = [];
  if ($logo) {
    $xo[] = '/Im1 7 0 R';
  }
  $xobject = $xo ? '/XObject << ' . implode(' ', $xo) . ' >> ' : '';

  $shading = '/Shading << /Sh1 << /ShadingType 2 /ColorSpace /DeviceRGB ' .
    sprintf('/Coords [0 %.2f %.2f %.2f] ', $H, $W, $H - $bandH) .
    '/Function << /FunctionType 2 /Domain [0 1] /C0 [' . PC_CERT_ORANGE . '] /C1 [' .
    PC_CERT_ORANGE_DEEP . '] /N 1 >> /Extend [true true] >> >> ';

  $objects = [
    1 => '<< /Type /Catalog /Pages 2 0 R >>',
    2 => '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
    3 => "<< /Type /Page /Parent 2 0 R /MediaBox [0 0 {$W} {$H}] " .
      "/Resources << /Font << /F1 5 0 R /F2 6 0 R >> {$shading}{$xobject}>> /Contents 4 0 R >>",
    4 => '<< /Length ' . strlen($c) . " >>\nstream\n" . $c . 'endstream',
    5 => '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica /Encoding /WinAnsiEncoding >>',
    6 => '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold /Encoding /WinAnsiEncoding >>',
  ];

  foreach ([7 => $logo] as $num => $img) {
    if (!$img) {
      continue;
    }
    $objects[$num] = '<< /Type /XObject /Subtype /Image ' .
      "/Width {$img['w']} /Height {$img['h']} /ColorSpace /DeviceRGB " .
      '/BitsPerComponent 8 /Filter /DCTDecode /Length ' . strlen($img['bytes']) . " >>\nstream\n" .
      $img['bytes'] . "\nendstream";
  }
  ksort($objects);

  $pdf = "%PDF-1.4\n";
  $offsets = [];
  foreach ($objects as $num => $bodyStr) {
    $offsets[$num] = strlen($pdf);
    $pdf .= "{$num} 0 obj\n{$bodyStr}\nendobj\n";
  }

// xref is indexed BY OBJECT NUMBER: a skipped slot must be written as a free entry.
  $maxObj = max(array_keys($objects));
  $xrefAt = strlen($pdf);
  $pdf .= "xref\n0 " . ($maxObj + 1) . "\n0000000000 65535 f \n";
  for ($n = 1; $n <= $maxObj; $n++) {
    $pdf .= isset($offsets[$n])
      ? sprintf("%010d 00000 n \n", $offsets[$n])
      : "0000000000 65535 f \n";
  }
  $pdf .= "trailer\n<< /Size " . ($maxObj + 1) . " /Root 1 0 R >>\nstartxref\n{$xrefAt}\n%%EOF\n";

  return $pdf;
}
