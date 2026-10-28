<?php
declare(strict_types=1);

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/supabase.php';
require __DIR__ . '/includes/driver-session.php';
require __DIR__ . '/includes/certificate-pdf.php';
require __DIR__ . '/includes/driver-tracks.php';

$driver = pc_driver_current();
if (!$driver) {
  header('Location: /driver-training');
  exit();
}

[$row, $progress] = pc_training_load((string) $driver['id']);
$quals = $row ? pc_training_quals($progress) : [];

if (!$quals || empty($progress['certificate']['id'])) {
  http_response_code(403);
  header('Content-Type: text/plain; charset=utf-8');
  echo "Your certificate is not ready yet. Complete the training first.";
  exit();
}

$cert = $progress['certificate'];

// Score shown is the most recent qualification's final, so a Meet & Greet pass does not
// keep reprinting the general score next to two badges.
$latest = $quals[count($quals) - 1];
$final = pc_track_final($progress, $latest['id']) ?: [];

$pdf = pc_certificate_pdf([
  'name' => trim((string) ($row['full_name'] ?? '')) ?: 'Driver',
  'certificateId' => (string) $cert['id'],
  'completedAt' => (int) $cert['at'],
  'score' => (int) ($final['score'] ?? 0),
  'total' => (int) ($final['total'] ?? 0),
  'quals' => $quals,
]);

$disposition = isset($_GET['download']) ? 'attachment' : 'inline';
$filename = 'PowerCabs-Training-Certificate-' . $cert['id'] . '.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: ' . $disposition . '; filename="' . $filename . '"');
header('Content-Length: ' . strlen($pdf));

header('Cache-Control: private, no-store');
header('X-Content-Type-Options: nosniff');
echo $pdf;
