<?php
declare(strict_types=1);

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';
require __DIR__ . '/includes/supabase.php';
require __DIR__ . '/includes/driver-session.php';
require __DIR__ . '/includes/driver-progress.php';
require __DIR__ . '/includes/certificate-pdf.php';
require __DIR__ . '/includes/driver-insights.php';
require __DIR__ . '/components/driver-training/missions.php';

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');
header('X-Content-Type-Options: nosniff');

function pc_tr_out(array $p, int $status = 200): never
{
  http_response_code($status);
  echo json_encode($p);
  exit();
}

function pc_tr_fail(string $msg, int $status = 400): never
{
  pc_tr_out(['ok' => false, 'error' => $msg], $status);
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  pc_tr_fail('POST only.', 405);
}

$driver = pc_driver_current();
if (!$driver) {
  pc_tr_fail('Your session has expired. Please sign in again.', 401);
}
if (!pc_sb_ready()) {
  pc_tr_fail('Training is temporarily unavailable.', 503);
}

$driverId = (string) $driver['id'];
$action = (string) ($_POST['action'] ?? '');

function pc_tr_answers(): array
{
  $raw = $_POST['answers'] ?? [];
  if (!is_array($raw)) {
    return [];
  }
  $out = [];
  foreach ($raw as $k => $v) {
    if ((is_int($k) || ctype_digit((string) $k)) && (is_int($v) || ctype_digit((string) $v))) {
      $out[(int) $k] = (int) $v;
    }
  }
  return $out;
}

function pc_tr_state(array $progress, array $missions, int $totalXp): array
{
  $done = [];
  foreach ($missions as $m) {
    if (pc_training_mission_done($progress, $m['id'])) {
      $done[] = $m['id'];
    }
  }
  $current = pc_training_current_index($progress, $missions);

  return [
    'completed' => $done,
    'current' => $current < count($missions) ? $missions[$current]['id'] : null,
    'count' => count($done),
    'total' => count($missions),
    'pct' => count($missions) ? (int) round((count($done) / count($missions)) * 100) : 0,
    'xp' => (int) $progress['xp'],
    'xpTotal' => $totalXp,
    'badges' => array_values($progress['badges']),
    'final' => $progress['final'],
    'finalUnlocked' => pc_training_all_missions_done($progress, $missions),
    'certified' => pc_training_can_certify($progress, $missions),
    'certificate' => $progress['certificate'],
  ];
}

[$row, $progress] = pc_training_load($driverId);
if (!$row) {
  pc_tr_fail('We could not load your driver record. Please try again.', 502);
}

if ($action === 'mission') {
  $missionId = (string) ($_POST['mission'] ?? '');
  $mission = null;
  foreach ($pcMissions as $m) {
    if ($m['id'] === $missionId) {
      $mission = $m;
      break;
    }
  }
  if (!$mission) {
    pc_tr_fail('Unknown mission.', 404);
  }

  if (!pc_training_is_unlocked($progress, $pcMissions, $missionId)) {
    pc_tr_fail('Finish the previous mission first.', 403);
  }

  $graded = pc_training_grade($mission['quiz'], pc_tr_answers());

  $passed = $graded['score'] === $graded['total'] && $graded['criticalOk'];

  if (!$passed) {
    pc_tr_out([
      'ok' => true,
      'passed' => false,
      'graded' => $graded,
      'state' => pc_tr_state($progress, $pcMissions, $pcTotalXp),
    ]);
  }

  $awarded = 0;
  $newBadge = null;

  if (!pc_training_mission_done($progress, $missionId)) {
$awarded = pc_mission_points($mission);
    $progress['xp'] += $awarded;
    $progress['missions'][$missionId] = [
      'done' => time(),
      'score' => $graded['score'],
      'total' => $graded['total'],
    ];
    if (pc_training_award_badge($progress, $mission['badge'] ?? null)) {
      $newBadge = $mission['badge'];
    }
    pc_training_save($driverId, $progress);
  }

  pc_tr_out([
    'ok' => true,
    'passed' => true,
    'graded' => $graded,
    'xpAwarded' => $awarded,
    'badge' => $newBadge ? ['id' => $newBadge] + $pcBadges[$newBadge] : null,
    'state' => pc_tr_state($progress, $pcMissions, $pcTotalXp),
  ]);
}

if ($action === 'final') {
  if (!pc_training_all_missions_done($progress, $pcMissions)) {
    pc_tr_fail('Finish every mission before the final challenge.', 403);
  }

  $graded = pc_training_grade($pcFinalChallenge, pc_tr_answers());
  $passed = $graded['pct'] >= PC_FINAL_PASS && $graded['criticalOk'];

  $prev = is_array($progress['final'] ?? null) ? $progress['final'] : null;
  $attempts = (int) ($prev['attempts'] ?? 0) + 1;

  $keep = $prev;
  if (!$prev || $graded['pct'] > (int) ($prev['pct'] ?? -1) || (!$prev['passed'] && $passed)) {
    $keep = [
      'score' => $graded['score'],
      'total' => $graded['total'],
      'pct' => $graded['pct'],
      'passed' => $passed,
      'criticalOk' => $graded['criticalOk'],
      'at' => time(),
    ];
  }
  $keep['attempts'] = $attempts;
  $progress['final'] = $keep;

  $awarded = 0;
  if ($passed && !($prev['passed'] ?? false)) {
$awarded = PC_XP_FULL;
    foreach ($pcFinalChallenge as $q) {
      $awarded += (int) $q['pts'];
    }
    $progress['xp'] += $awarded;
    pc_training_award_badge($progress, 'certified');
    $progress['completed_at'] = $progress['completed_at'] ?? time();
  }

  pc_training_save($driverId, $progress);

  pc_tr_out([
    'ok' => true,
    'passed' => $passed,
    'graded' => $graded,
    'pass' => PC_FINAL_PASS,
    'xpAwarded' => $awarded,
    'state' => pc_tr_state($progress, $pcMissions, $pcTotalXp),
  ]);
}

if ($action === 'certify') {
if (!pc_training_can_certify($progress, $pcMissions)) {
    pc_tr_fail('Training is not complete yet.', 403);
  }

  $existing = is_array($progress['certificate'] ?? null) ? $progress['certificate'] : null;

  if (!$existing || empty($existing['id'])) {
    $completedAt = (int) ($progress['completed_at'] ?? time());
    $existing = [
      'id' => pc_training_certificate_id($driverId, $completedAt),
      'at' => $completedAt,
      'emailed_at' => null,
    ];
    $progress['certificate'] = $existing;
    pc_training_save($driverId, $progress);
  }

  $name = trim((string) ($row['full_name'] ?? '')) ?: 'Driver';
  $email = trim((string) ($row['email'] ?? ''));
  $final = $progress['final'];

  $emailed = !empty($existing['emailed_at']);
  $emailError = null;

  if (!$emailed && $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $pdf = pc_certificate_pdf([
      'name' => $name,
      'certificateId' => $existing['id'],
      'completedAt' => (int) $existing['at'],
      'score' => (int) $final['score'],
      'total' => (int) $final['total'],
    ]);

    $tmp = tempnam(sys_get_temp_dir(), 'pccert_');
    file_put_contents($tmp, $pdf);

    try {
$sent = pc_send_mail(
        'Congratulations — Your PowerCabs Driver Training Certificate',
        "Hi {$name},\n\n" .
          "Congratulations!\n\n" .
          "You have successfully completed the PowerCabs Driver Training Programme.\n\n" .
          "Your certificate is attached.\n\n" .
          "Certificate ID: {$existing['id']}\n" .
          'Completion Date: ' . gmdate('j F Y', (int) $existing['at']) . "\n\n" .
          "Welcome to PowerCabs.\n\n" .
          "PowerCabs Ireland Ltd\n",
        ['name' => $name, 'email' => $email],
        [[
          'tmp_path' => $tmp,
          'filename' => 'PowerCabs-Training-Certificate-' . $existing['id'] . '.pdf',
          'mime' => 'application/pdf',
        ]],
        $email
      );
    } finally {
      @unlink($tmp);
    }

    if (!empty($sent['success'])) {
      $progress['certificate']['emailed_at'] = time();
      pc_training_save($driverId, $progress);
      $emailed = true;
    } else {
$emailError = (string) ($sent['error'] ?? 'Mail failed.');
      error_log('[driver-training] certificate email failed for ' . $driverId . ': ' . $emailError);
    }
  }

  pc_tr_out([
    'ok' => true,
    'certificate' => [
      'id' => $existing['id'],
      'at' => (int) $existing['at'],
      'name' => $name,
      'emailed' => $emailed,
      'emailError' => $emailError,
    ],
    'state' => pc_tr_state($progress, $pcMissions, $pcTotalXp),
  ]);
}

pc_tr_fail('Unknown action.', 400);
