<?php
declare(strict_types=1);

// Two training tracks share one engine. Everything that was written against $pcMissions still
// works: a track is just a bundle of the same arrays, and both tracks' missions live in the SAME
// flat $progress['missions'] map, keyed by mission id. Meet & Greet ids are prefixed 'mg-', so
// nothing collides and no existing driver's stored progress needs rewriting.
//
// What IS new in storage:
//   $progress['tracks']['mg']['final']        the Meet & Greet final result
//   $progress['tracks']['mg']['completed_at'] when that track was passed
// Both default to absent, and absent reads as "not started" -- which is correct for every driver
// who completed the old single-track training.

require_once __DIR__ . '/driver-progress.php';

// At file scope, not inside pc_tracks(): a require inside a function body binds the included
// file's variables to that function's locals, so $pcMissions never reaches $GLOBALS. This file
// is always included at global scope, and it is the only place the mission files are included.
require_once __DIR__ . '/../components/driver-training/missions.php';
require_once __DIR__ . '/../components/driver-training/mg-missions.php';

const PC_TRACK_GENERAL = 'general';
const PC_TRACK_MG = 'mg';

function pc_tracks(): array
{
  static $tracks = null;
  if ($tracks !== null) {
    return $tracks;
  }

  $tracks = [
    PC_TRACK_GENERAL => [
      'id' => PC_TRACK_GENERAL,
      'label' => 'Driver Training',
      'short' => 'General',
      'tagline' => 'The core programme every PowerCabs driver completes.',
      'missions' => $GLOBALS['pcMissions'],
      'final' => $GLOBALS['pcFinalChallenge'],
      'badges' => $GLOBALS['pcBadges'],
      'finalBadge' => 'certified',
      'totalXp' => $GLOBALS['pcTotalXp'],
      'qualLabel' => 'General Driver Training',
      'qualDesc' => 'Core PowerCabs driver programme',
      'icon' => 'award',
    ],
    PC_TRACK_MG => [
      'id' => PC_TRACK_MG,
      'label' => 'Meet &amp; Greet Training',
      'short' => 'Meet &amp; Greet',
      'tagline' => 'Airport specialism: services, meeting points, delays and fares.',
      'missions' => $GLOBALS['pcMgMissions'],
      'final' => $GLOBALS['pcMgFinalChallenge'],
      'badges' => $GLOBALS['pcMgBadges'],
      'finalBadge' => 'mg-certified',
      'totalXp' => $GLOBALS['pcMgTotalXp'],
      'qualLabel' => 'Meet &amp; Greet Training',
      'qualDesc' => 'Dublin Airport meet and greet specialism',
      'icon' => 'plane',
    ],
  ];

  return $tracks;
}

function pc_track(string $id): ?array
{
  $tracks = pc_tracks();
  return $tracks[$id] ?? null;
}

/** The per-track slice of $progress. The general track keeps its original top-level keys. */
function pc_track_final(array $progress, string $trackId): ?array
{
  if ($trackId === PC_TRACK_GENERAL) {
    return is_array($progress['final'] ?? null) ? $progress['final'] : null;
  }
  $t = $progress['tracks'][$trackId] ?? null;
  return is_array($t) && is_array($t['final'] ?? null) ? $t['final'] : null;
}

function pc_track_set_final(array &$progress, string $trackId, array $final): void
{
  if ($trackId === PC_TRACK_GENERAL) {
    $progress['final'] = $final;
    return;
  }
  if (!is_array($progress['tracks'] ?? null)) {
    $progress['tracks'] = [];
  }
  if (!is_array($progress['tracks'][$trackId] ?? null)) {
    $progress['tracks'][$trackId] = [];
  }
  $progress['tracks'][$trackId]['final'] = $final;
}

function pc_track_completed_at(array $progress, string $trackId): ?int
{
  if ($trackId === PC_TRACK_GENERAL) {
    return $progress['completed_at'] ? (int) $progress['completed_at'] : null;
  }
  $at = $progress['tracks'][$trackId]['completed_at'] ?? null;
  return $at ? (int) $at : null;
}

function pc_track_set_completed(array &$progress, string $trackId, int $at): void
{
  if ($trackId === PC_TRACK_GENERAL) {
    $progress['completed_at'] = $progress['completed_at'] ?? $at;
    return;
  }
  if (!is_array($progress['tracks'] ?? null)) {
    $progress['tracks'] = [];
  }
  if (!is_array($progress['tracks'][$trackId] ?? null)) {
    $progress['tracks'][$trackId] = [];
  }
  $progress['tracks'][$trackId]['completed_at'] = $progress['tracks'][$trackId]['completed_at'] ?? $at;
}

/** Passed every mission in the track and its final challenge. */
function pc_track_passed(array $progress, array $track): bool
{
  if (!pc_training_all_missions_done($progress, $track['missions'])) {
    return false;
  }
  $final = pc_track_final($progress, $track['id']);
  return is_array($final) && !empty($final['passed']) && !empty($final['criticalOk']);
}

/**
 * Meet & Greet opens only once Certificate #1 exists -- that is, the general track is passed AND
 * the certificate has actually been issued. Passing the final alone is not enough, because the
 * brief ties the unlock to the certificate being generated.
 */
function pc_track_unlocked(array $progress, string $trackId): bool
{
  if ($trackId === PC_TRACK_GENERAL) {
    return true;
  }
  $general = pc_track(PC_TRACK_GENERAL);
  return pc_track_passed($progress, $general) && !empty($progress['certificate']['id']);
}

/**
 * The qualifications the certificate prints, newest last.
 *
 * Derived from progress on every call rather than stored, so a driver who finished the old
 * single-track programme before this existed gets their General qualification without any
 * backfill or migration write.
 */
function pc_training_quals(array $progress): array
{
  $out = [];
  foreach (pc_tracks() as $id => $track) {
    if (!pc_track_passed($progress, $track)) {
      continue;
    }
    $out[] = [
      'id' => $id,
      'label' => $track['qualLabel'],
      'desc' => $track['qualDesc'],
      'at' => pc_track_completed_at($progress, $id) ?? (int) ($progress['certificate']['at'] ?? time()),
    ];
  }
  return $out;
}

/** A stable fingerprint of the qualification set, so a new one triggers a fresh certificate email. */
function pc_training_qual_key(array $quals): string
{
  return implode('+', array_column($quals, 'id'));
}
