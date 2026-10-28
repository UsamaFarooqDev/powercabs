<?php
declare(strict_types=1);

require __DIR__ . '/includes/env.php';
require __DIR__ . '/includes/mailer.php';
require __DIR__ . '/includes/supabase.php';
require __DIR__ . '/includes/driver-session.php';
require __DIR__ . '/includes/driver-progress.php';
require __DIR__ . '/includes/certificate-pdf.php';
require __DIR__ . '/includes/driver-insights.php';
require __DIR__ . '/includes/driver-tracks.php';

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

function pc_tr_state(array $progress, array $track): array
{
  $missions = $track['missions'];
  $done = [];
  foreach ($missions as $m) {
    if (pc_training_mission_done($progress, $m['id'])) {
      $done[] = $m['id'];
    }
  }
  $current = pc_training_current_index($progress, $missions);
  $quals = pc_training_quals($progress);

  return [
    'track' => $track['id'],
    'completed' => $done,
    'current' => $current < count($missions) ? $missions[$current]['id'] : null,
    'count' => count($done),
    'total' => count($missions),
    'pct' => count($missions) ? (int) round((count($done) / count($missions)) * 100) : 0,
    'xp' => (int) $progress['xp'],
    'xpTotal' => $track['totalXp'],
    'badges' => array_values($progress['badges']),
    'final' => pc_track_final($progress, $track['id']),
    'finalUnlocked' => pc_training_all_missions_done($progress, $missions),
    'certified' => pc_track_passed($progress, $track),
    'certificate' => $progress['certificate'],
    'quals' => array_column($quals, 'id'),
    'mgUnlocked' => pc_track_unlocked($progress, PC_TRACK_MG),
  ];
}

[$row, $progress] = pc_training_load($driverId);
if (!$row) {
  pc_tr_fail('We could not load your driver record. Please try again.', 502);
}

// The track is whatever the client asked for, but the server decides whether it is open.
// A POST naming 'mg' before Certificate #1 exists is rejected here, not in the markup.
$trackId = (string) ($_POST['track'] ?? PC_TRACK_GENERAL);
$track = pc_track($trackId);
if (!$track) {
  pc_tr_fail('Unknown training track.', 404);
}
if (!pc_track_unlocked($progress, $trackId)) {
  pc_tr_fail('Finish your driver training and download your certificate to unlock this module.', 403);
}

if ($action === 'mission') {
  $missionId = (string) ($_POST['mission'] ?? '');
  $mission = null;
  foreach ($track['missions'] as $m) {
    if ($m['id'] === $missionId) {
      $mission = $m;
      break;
    }
  }
  if (!$mission) {
    pc_tr_fail('Unknown mission.', 404);
  }

  if (!pc_training_is_unlocked($progress, $track['missions'], $missionId)) {
    pc_tr_fail('Finish the previous mission first.', 403);
  }

  $graded = pc_training_grade($mission['quiz'], pc_tr_answers());

  $passed = $graded['score'] === $graded['total'] && $graded['criticalOk'];

  if (!$passed) {
    pc_tr_out([
      'ok' => true,
      'passed' => false,
      'graded' => $graded,
      'state' => pc_tr_state($progress, $track),
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
    'badge' => $newBadge && isset($track['badges'][$newBadge])
      ? ['id' => $newBadge] + $track['badges'][$newBadge]
      : null,
    'state' => pc_tr_state($progress, $track),
  ]);
}

if ($action === 'final') {
  if (!pc_training_all_missions_done($progress, $track['missions'])) {
    pc_tr_fail('Finish every mission before the final challenge.', 403);
  }

  $graded = pc_training_grade($track['final'], pc_tr_answers());
  $passed = $graded['pct'] >= PC_FINAL_PASS && $graded['criticalOk'];

  $prev = pc_track_final($progress, $trackId);
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
  pc_track_set_final($progress, $trackId, $keep);

  $awarded = 0;
  if ($passed && !($prev['passed'] ?? false)) {
    $awarded = PC_XP_FULL;
    foreach ($track['final'] as $q) {
      $awarded += (int) $q['pts'];
    }
    $progress['xp'] += $awarded;
    pc_training_award_badge($progress, $track['finalBadge']);
    pc_track_set_completed($progress, $trackId, time());
  }

  pc_training_save($driverId, $progress);

  pc_tr_out([
    'ok' => true,
    'passed' => $passed,
    'graded' => $graded,
    'pass' => PC_FINAL_PASS,
    'xpAwarded' => $awarded,
    'state' => pc_tr_state($progress, $track),
  ]);
}

if ($action === 'certify') {
  // The certificate is one document that grows. Passing Meet & Greet does not mint a second
  // ID -- it adds a second qualification to the same certificate, which is then re-issued.
  $quals = pc_training_quals($progress);
  if (!$quals) {
    pc_tr_fail('Training is not complete yet.', 403);
  }

  $qualKey = pc_training_qual_key($quals);
  $existing = is_array($progress['certificate'] ?? null) ? $progress['certificate'] : null;

  if (!$existing || empty($existing['id'])) {
    $completedAt = (int) ($progress['completed_at'] ?? time());
    $existing = [
      'id' => pc_training_certificate_id($driverId, $completedAt),
      'at' => $completedAt,
      'emailed_at' => null,
      'quals' => $qualKey,
    ];
    $progress['certificate'] = $existing;
    pc_training_save($driverId, $progress);
  }

  // A driver certified before Meet & Greet existed has no 'quals' recorded; treat that as the
  // general-only key so adding Meet & Greet still counts as a change worth emailing.
  $sentKey = (string) ($existing['quals'] ?? PC_TRACK_GENERAL);
  $isNewQual = $sentKey !== $qualKey;

  $name = trim((string) ($row['full_name'] ?? '')) ?: 'Driver';
  $email = trim((string) ($row['email'] ?? ''));

  $latest = $quals[count($quals) - 1];
  $latestTrack = pc_track($latest['id']);
  $latestFinal = pc_track_final($progress, $latest['id']) ?: ['score' => 0, 'total' => 0];

  $emailed = !empty($existing['emailed_at']) && !$isNewQual;
  $emailError = null;

  if (!$emailed && $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $pdf = pc_certificate_pdf([
      'name' => $name,
      'certificateId' => $existing['id'],
      'completedAt' => (int) $existing['at'],
      'score' => (int) $latestFinal['score'],
      'total' => (int) $latestFinal['total'],
      'quals' => $quals,
    ]);

    $tmp = tempnam(sys_get_temp_dir(), 'pccert_');
    file_put_contents($tmp, $pdf);

    $qualLines = '';
    foreach ($quals as $q) {
      $qualLines .= '  - ' . html_entity_decode($q['label'], ENT_QUOTES, 'UTF-8') .
        ' (' . gmdate('j F Y', (int) $q['at']) . ")\n";
    }

    try {
      $sent = pc_send_mail(
        count($quals) > 1
          ? 'Your updated PowerCabs certificate - ' . html_entity_decode($latestTrack['qualLabel'], ENT_QUOTES, 'UTF-8') . ' added'
          : 'Congratulations - Your PowerCabs Driver Training Certificate',
        "Hi {$name},\n\n" .
          "Congratulations!\n\n" .
          (count($quals) > 1
            ? "You have added a new qualification to your PowerCabs certificate.\n\n"
            : "You have successfully completed the PowerCabs Driver Training Programme.\n\n") .
          "Qualifications on your certificate:\n" . $qualLines . "\n" .
          "Your updated certificate is attached.\n\n" .
          "Certificate ID: {$existing['id']}\n" .
          'Issued: ' . gmdate('j F Y', (int) $existing['at']) . "\n\n" .
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
      $progress['certificate']['quals'] = $qualKey;
      pc_training_save($driverId, $progress);
      $emailed = true;
    } else {
      $emailError = (string) ($sent['error'] ?? 'Mail failed.');
      error_log('[driver-training] certificate email failed for ' . $driverId . ': ' . $emailError);
    }
  } elseif ($isNewQual) {
    // No usable address: still record the qualification set so the PDF and the UI agree.
    $progress['certificate']['quals'] = $qualKey;
    pc_training_save($driverId, $progress);
  }

  pc_tr_out([
    'ok' => true,
    'certificate' => [
      'id' => $existing['id'],
      'at' => (int) $existing['at'],
      'name' => $name,
      'emailed' => $emailed,
      'emailError' => $emailError,
      'quals' => array_map(static function (array $q): array {
        return ['id' => $q['id'], 'label' => $q['label'], 'at' => (int) $q['at']];
      }, $quals),
    ],
    'state' => pc_tr_state($progress, $track),
  ]);
}

pc_tr_fail('Unknown action.', 400);
