<?php
declare(strict_types=1);

require_once __DIR__ . '/supabase.php';

const PC_INSIGHT_TTL = 1800; 

const PC_INSIGHT_TYPES = [
  'Pets Taxi' => 'pet-jobs',
  'Business' => 'business-jobs',
  'Courier / Parcel' => 'delivery-jobs',
];

function pc_driver_insights(string $driverId, array $driverRow = []): array
{
  if (isset($_SESSION['pc_driver_ctx'])
    && is_array($_SESSION['pc_driver_ctx'])
    && ($_SESSION['pc_driver_ctx']['for'] ?? '') === $driverId
    && time() - (int) ($_SESSION['pc_driver_ctx']['at'] ?? 0) < PC_INSIGHT_TTL
  ) {
    return $_SESSION['pc_driver_ctx']['ctx'];
  }

  $ctx = pc_insight_blank();

  $res = pc_sb_select(
    'rides',
    'select=ride_type,status,payment_method,is_scheduled,toll_amount,driver_rating,canceled_by' .
      '&driver_id=eq.' . rawurlencode($driverId) .
      '&order=created_at.desc&limit=400'
  );

  if ($res['ok'] && is_array($res['json'])) {
    $ctx = pc_insight_derive($res['json'], $driverRow);
  }

  $_SESSION['pc_driver_ctx'] = ['for' => $driverId, 'at' => time(), 'ctx' => $ctx];
  return $ctx;
}

function pc_insight_blank(): array
{
  return [
    'ok' => false,
    'total' => 0,
    'completed' => 0,
    'cancelled' => 0,
    'driverCancelled' => 0,
    'scheduled' => 0,
    'withToll' => 0,
    'rated' => 0,
    'avgRating' => null,
    'types' => [],
    'payments' => [],
    'vehicle' => '',
    'prefs' => [],
    'facts' => [],
    'focus' => null,
  ];
}

function pc_insight_derive(array $rides, array $driverRow): array
{
  $c = pc_insight_blank();
  
  $c['ok'] = true;
  $c['total'] = count($rides);
  $ratings = [];

  foreach ($rides as $r) {
    $status = (string) ($r['status'] ?? '');
    if ($status === 'completed') {
      $c['completed']++;
    }
    
    if ($status === 'cancelled' || $status === 'canceled') {
      $c['cancelled']++;
    }
    if (($r['canceled_by'] ?? null) === 'driver') {
      $c['driverCancelled']++;
    }
    if (!empty($r['is_scheduled'])) {
      $c['scheduled']++;
    }
    if ((float) ($r['toll_amount'] ?? 0) > 0) {
      $c['withToll']++;
    }
    if (($r['driver_rating'] ?? null) !== null && $r['driver_rating'] !== '') {
      $c['rated']++;
      $ratings[] = (float) $r['driver_rating'];
    }

    $type = trim((string) ($r['ride_type'] ?? ''));
    if ($type !== '') {
      $c['types'][$type] = ($c['types'][$type] ?? 0) + 1;
    }
    $pay = trim((string) ($r['payment_method'] ?? ''));
    if ($pay !== '') {
      $c['payments'][$pay] = ($c['payments'][$pay] ?? 0) + 1;
    }
  }

  if ($ratings) {
    $c['avgRating'] = round(array_sum($ratings) / count($ratings), 1);
  }
  arsort($c['types']);
  arsort($c['payments']);

  $make = trim((string) ($driverRow['vehicle_make'] ?? ''));
  $model = trim((string) ($driverRow['vehicle_model'] ?? ''));
  $c['vehicle'] = trim($make . ' ' . $model);

  $meta = is_array($driverRow['meta'] ?? null) ? $driverRow['meta'] : [];
  $c['prefs'] = [
    'night' => !empty($meta['night_rides']),
    'pets' => !empty($meta['pets_allowed']),
    'wheelchair' => !empty($meta['wheelchair_accessible']),
  ];

  [$c['facts'], $c['focus']] = pc_insight_facts($c);
  return $c;
}

function pc_insight_facts(array $c): array
{
  $f = [];
  $many = static function (int $n, string $one, string $more): string {
    return $n === 1 ? $one : $more;
  };

  if ($c['completed'] > 0) {
    $f['app-basics'] = sprintf(
      'You have completed %d %s so far.',
      $c['completed'],
      $many($c['completed'], 'job', 'jobs')
    );
  }

  foreach (PC_INSIGHT_TYPES as $label => $level) {
    $n = (int) ($c['types'][$label] ?? 0);
    $f[$level] = $n > 0
      ? sprintf('You have run %d %s %s.', $n, $label, $many($n, 'job', 'jobs'))
      : sprintf('You have not taken a %s job yet.', $label);
  }

  if ($c['scheduled'] > 0) {
    $f['prebook'] = sprintf(
      'You have been assigned %d prebooked %s.',
      $c['scheduled'],
      $many($c['scheduled'], 'job', 'jobs')
    );
  }
  if ($c['driverCancelled'] > 0) {
    $f['prebook'] = trim(($f['prebook'] ?? '') . sprintf(
      ' %d %s cancelled from your side.',
      $c['driverCancelled'],
      $many($c['driverCancelled'], 'was', 'were')
    ));
  }

  $f['tolls'] = $c['withToll'] > 0
    ? sprintf('%d of your jobs included a toll.', $c['withToll'])
    : 'None of your jobs so far have included a toll.';

  if ($c['rated'] > 0 && $c['avgRating'] !== null) {
    $f['customer-behaviour'] = sprintf(
      'You have been rated on %d %s, averaging %s.',
      $c['rated'],
      $many($c['rated'], 'job', 'jobs'),
      number_format((float) $c['avgRating'], 1)
    );
  }

  $cash = (int) ($c['payments']['cash'] ?? 0);
  $card = (int) ($c['payments']['card'] ?? 0) + (int) ($c['payments']['prepaid'] ?? 0);
  if ($cash + $card > 0) {
    $f['payments'] = sprintf('Your jobs so far: %d cash, %d card or prepaid.', $cash, $card);
  }

  $focus = null;
  if ($c['driverCancelled'] >= 3) {
    $focus = 'prebook';
  } elseif ($c['avgRating'] !== null && $c['avgRating'] < 4.5) {
    $focus = 'customer-behaviour';
  } elseif ((int) ($c['types']['Pets Taxi'] ?? 0) === 0) {
    $focus = 'pet-jobs';
  } elseif ((int) ($c['types']['Business'] ?? 0) === 0) {
    $focus = 'business-jobs';
  }

  return [$f, $focus];
}
