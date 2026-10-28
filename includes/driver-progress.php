<?php
declare(strict_types=1);

require_once __DIR__ . '/supabase.php';

const PC_TRAINING_V = 2;

function pc_training_blank(): array
{
  return [
    'v' => PC_TRAINING_V,
    'missions' => [],
    'xp' => 0,
    'badges' => [],
    'final' => null,
    'completed_at' => null,
    'certificate' => null,

    // v2. Added, never removed: a v1 row loaded through array_replace() below simply gets an
    // empty 'tracks', which reads as "no extra track started" -- correct for every existing
    // driver. No backfill, no migration write, nothing to lose.
    'tracks' => [],
  ];
}

function pc_training_load(string $driverId): array
{
  $res = pc_sb_select('drivers', 'select=id,full_name,email,status,meta&limit=1&id=eq.' . rawurlencode($driverId));
  if (!$res['ok'] || !is_array($res['json']) || empty($res['json'][0])) {
    return [null, pc_training_blank()];
  }

  $row = $res['json'][0];
  $meta = is_array($row['meta'] ?? null) ? $row['meta'] : [];
  $training = is_array($meta['training'] ?? null) ? $meta['training'] : [];

  return [$row, array_replace(pc_training_blank(), $training)];
}

function pc_training_save(string $driverId, array $progress): bool
{
  $res = pc_sb_select('drivers', 'select=meta&limit=1&id=eq.' . rawurlencode($driverId));
  $meta = ($res['ok'] && is_array($res['json'][0]['meta'] ?? null)) ? $res['json'][0]['meta'] : [];

// Merge, never replace: meta also holds the signup ride preferences.
  $meta['training'] = $progress;

  $patch = pc_sb_request(
    'PATCH',
    'drivers?id=eq.' . rawurlencode($driverId),
    ['Prefer: return=minimal'],
    ['meta' => $meta]
  );

  if (!$patch['ok']) {
    error_log('[driver-training] progress save failed for ' . $driverId . ': ' . (string) $patch['error']);
  }
  return $patch['ok'];
}

function pc_training_grade(array $questions, array $answers): array
{
  $score = 0;
  $criticalOk = true;
  $detail = [];

  foreach ($questions as $i => $q) {
    $picked = $answers[$i] ?? null;
    $picked = is_int($picked) || (is_string($picked) && ctype_digit($picked)) ? (int) $picked : -1;
    $correct = $picked === (int) $q['answer'];

    if ($correct) {
      $score++;
    } elseif (!empty($q['critical'])) {
      $criticalOk = false;
    }

    $detail[] = [
      'correct' => $correct,
      'answer' => (int) $q['answer'],
      'explain' => (string) $q['explain'],
      'critical' => !empty($q['critical']),
    ];
  }

  $total = count($questions);
  return [
    'score' => $score,
    'total' => $total,
    'pct' => $total ? (int) round(($score / $total) * 100) : 100,
    'criticalOk' => $criticalOk,
    'detail' => $detail,
  ];
}

function pc_training_public_questions(array $questions): array
{
  return array_map(static function (array $q): array {
    return [
      'q' => $q['q'],
      'options' => $q['options'],
      'critical' => !empty($q['critical']),

      'pts' => (int) ($q['pts'] ?? 0),
    ];
  }, $questions);
}

function pc_training_mission_done(array $progress, string $missionId): bool
{
  return !empty($progress['missions'][$missionId]['done']);
}

function pc_training_is_unlocked(array $progress, array $missions, string $missionId): bool
{
  foreach ($missions as $i => $m) {
    if ($m['id'] !== $missionId) {
      continue;
    }
    if ($i === 0) {
      return true;
    }
    return pc_training_mission_done($progress, $missions[$i - 1]['id']);
  }
  return false;
}

function pc_training_current_index(array $progress, array $missions): int
{
  foreach ($missions as $i => $m) {
    if (!pc_training_mission_done($progress, $m['id'])) {
      return $i;
    }
  }
  return count($missions);
}

function pc_training_all_missions_done(array $progress, array $missions): bool
{
  foreach ($missions as $m) {
    if (!pc_training_mission_done($progress, $m['id'])) {
      return false;
    }
  }
  return true;
}

function pc_training_can_certify(array $progress, array $missions): bool
{
  if (!pc_training_all_missions_done($progress, $missions)) {
    return false;
  }
  $final = $progress['final'] ?? null;
  return is_array($final) && !empty($final['passed']) && !empty($final['criticalOk']);
}

function pc_training_certificate_id(string $driverId, int $completedAt): string
{
  $hash = strtoupper(substr(hash('sha256', $driverId . '|' . $completedAt), 0, 8));
  return 'PC-' . gmdate('Y', $completedAt) . '-' . $hash;
}

function pc_training_award_badge(array &$progress, ?string $badge): bool
{
  if (!$badge || in_array($badge, $progress['badges'], true)) {
    return false;
  }
  $progress['badges'][] = $badge;
  return true;
}
