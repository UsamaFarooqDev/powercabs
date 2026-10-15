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
  $sig = pc_cert_image('certificate-signature.jpg');

  $bandH = 112.0; 
  $footH = 46.0;  
  $c = '';

  $c .= sprintf("%s rg 0 0 %.2f %.2f re f\n", PC_CERT_PAPER, $W, $H);

  $c .= sprintf("q 0 %.2f %.2f %.2f re W n /Sh1 sh Q\n", $H - $bandH, $W, $bandH);

  $c .= pc_pdf_centre_tracked('CERTIFICATE OF DRIVER TRAINING', $H - 52, 15, true, $W, 4.2, $white);
  $c .= pc_pdf_centre_tracked('POWERCABS DRIVER ACADEMY', $H - 76, 8, false, $W, 3.0, $white);
  
  $c .= sprintf("%s RG 1.2 w 0 %.2f m %.2f %.2f l S\n", PC_CERT_ORANGE_DEEP, $H - $bandH, $W, $H - $bandH);

  $logoBottom = $H - 196;
  if ($logo) {
    $lw = 186.0;
    $lh = $lw * ($logo['h'] / $logo['w']);
    $c .= sprintf("q %.2f 0 0 %.2f %.2f %.2f cm /Im1 Do Q\n", $lw, $lh, ($W - $lw) / 2, $logoBottom);
  } else {
$c .= pc_pdf_centre_tracked('POWERCABS', $logoBottom + 18, 22, true, $W, 5.0, $ink);
  }

  $c .= pc_pdf_centre('This certifies that', $H - 226, 11.5, false, $W, $dim);
  $c .= pc_pdf_centre($name, $H - 276, 34, true, $W, $ink);

  $nameW = min($W - 220, max(280.0, pc_pdf_width(pc_pdf_text($name), 34, true) + 70));
  $c .= sprintf("%s RG 1 w %.2f %.2f m %.2f %.2f l S\n", $orange, ($W - $nameW) / 2, $H - 292, ($W + $nameW) / 2, $H - 292);

  $c .= pc_pdf_centre('has successfully completed the', $H - 318, 11.5, false, $W, $dim);
  $c .= pc_pdf_centre('PowerCabs Driver Academy Programme', $H - 341, 15, true, $W, $ink);

  $col = [$W * 0.26, $W * 0.5, $W * 0.74];
  $facts = [
    ['COMPLETION DATE', $dateStr],
    ['CERTIFICATE ID', $certId],
    ['FINAL SCORE', ((int) ($data['score'] ?? 0)) . ' / ' . ((int) ($data['total'] ?? 0))],
  ];
  foreach ([$W * 0.38, $W * 0.62] as $sep) {
    $c .= sprintf("0.82 0.80 0.78 RG 0.6 w %.2f %.2f m %.2f %.2f l S\n", $sep, 196.0, $sep, 234.0);
  }
  foreach ($facts as $i => [$label, $value]) {
    $lt = pc_pdf_text($label);
    $vt = pc_pdf_text($value);
    $c .= sprintf(
      "BT %s rg /F1 7.5 Tf 1.9 Tc 1 0 0 1 %.2f %.2f Tm (%s) Tj 0 Tc ET\n",
      $dim,
      $col[$i] - (pc_pdf_width($lt, 7.5, false) + 1.9 * (strlen($lt) - 1)) / 2,
      224.0,
      $lt
    );
    $c .= sprintf(
      "BT %s rg /F2 12.5 Tf 1 0 0 1 %.2f %.2f Tm (%s) Tj ET\n",
      $ink,
      $col[$i] - pc_pdf_width($vt, 12.5, true) / 2,
      200.0,
      $vt
    );
  }

  $sigRuleY = 118.0;
  if ($sig) {
    $sw = 112.0;
    $sh = $sw * ($sig['h'] / $sig['w']);
    $c .= sprintf("q %.2f 0 0 %.2f %.2f %.2f cm /Im2 Do Q\n", $sw, $sh, ($W - $sw) / 2, $sigRuleY + 5);
  }
  $c .= sprintf("0.72 0.70 0.68 RG 0.7 w %.2f %.2f m %.2f %.2f l S\n", $W / 2 - 105, $sigRuleY, $W / 2 + 105, $sigRuleY);
  $c .= pc_pdf_centre('Sohaib', $sigRuleY - 16, 11, true, $W, $ink);
  $c .= pc_pdf_centre('CEO & Co-Founder, PowerCabs Ireland Ltd', $sigRuleY - 29, 8.5, false, $W, $dim);

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
  if ($sig) {
    $xo[] = '/Im2 8 0 R';
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

  foreach ([7 => $logo, 8 => $sig] as $num => $img) {
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
