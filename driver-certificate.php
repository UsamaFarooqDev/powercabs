<?php
declare(strict_types=1);

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/supabase.php';
require __DIR__ . '/includes/driver-session.php';
require __DIR__ . '/includes/driver-progress.php';
require __DIR__ . '/includes/certificate-pdf.php';
require __DIR__ . '/components/driver-training/missions.php';

$driver = pc_driver_current();
if (!$driver) {
  header('Location: /driver-training');
  exit();
}

[$row, $progress] = pc_training_load((string) $driver['id']);

if (!$row || !pc_training_can_certify($progress, $pcMissions) || empty($progress['certificate']['id'])) {
  http_response_code(403);
  header('Content-Type: text/plain; charset=utf-8');
  echo "Your certificate is not ready yet. Complete the training first.";
  exit();
}

$cert = $progress['certificate'];
$final = $progress['final'];

$pdf = pc_certificate_pdf([
  'name' => trim((string) ($row['full_name'] ?? '')) ?: 'Driver',
  'certificateId' => (string) $cert['id'],
  'completedAt' => (int) $cert['at'],
  'score' => (int) ($final['score'] ?? 0),
  'total' => (int) ($final['total'] ?? 0),
]);

$disposition = isset($_GET['download']) ? 'attachment' : 'inline';
$filename = 'PowerCabs-Training-Certificate-' . $cert['id'] . '.pdf';

header('Content-Type: application/pdf');
header('Content-Disposition: ' . $disposition . '; filename="' . $filename . '"');
header('Content-Length: ' . strlen($pdf));

header('Cache-Control: private, no-store');
header('X-Content-Type-Options: nosniff');
echo $pdf;
