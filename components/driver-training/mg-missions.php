<?php
// The Meet & Greet track. Same shape as missions.php so driver-training.php, the API and the
// grader can run either track without branching -- only the data differs.
//
// Every figure below traces to the Airport Meet & Greet terms (components/terms/airport.php),
// the published service tiers on meet-greet.php, or the driver bonus schedule. Do not add one
// that does not.
//
// Waiting rules here are deliberately airport-specific and must NOT be replaced by the general
// 3-minute rule: free waiting is 10 minutes for Standard and Assist, 15 for First Class, and the
// no-show maximum is a separate, longer window again.

$pcMgBadges = [
  'mg-ground' => ['label' => 'Terminal Ready', 'icon' => 'flag', 'desc' => 'Knows the Dublin Airport meeting points'],
  'mg-calm' => ['label' => 'Delay Proof', 'icon' => 'calendar', 'desc' => 'Handles delays and no-shows correctly'],
  'mg-certified' => ['label' => 'Meet &amp; Greet Certified', 'icon' => 'plane', 'desc' => 'Passed the Meet &amp; Greet challenge'],
];

$pcMgMissions = [

  [
    'id' => 'mg-services',
    'title' => 'The three Meet &amp; Greet services',
    'nav' => 'Services',
    'icon' => 'plane',
    'why' =>
      'A Meet &amp; Greet is not a kerbside pickup. You park, walk into the terminal and meet the customer inside arrivals. There are three levels of it, they pay differently, and the customer has been told exactly what to expect.',
    'screens' => [],
    'illus' => 'plane',
    'reward' => 'Meet &amp; Greet bonus: &euro;3 Standard, &euro;13 Meet &amp; Assist, &euro;20 First Class &mdash; paid on top of the meter fare.',
    'steps' => [
      '<strong>Standard Meet &amp; Greet:</strong> you park, go into arrivals and meet the customer, then walk them to the vehicle. Bonus <strong>&euro;3</strong>.',
      '<strong>Meet &amp; Assist:</strong> everything in Standard, plus a personalised name board and luggage assistance from the terminal to the car. Bonus <strong>&euro;13</strong>.',
      '<strong>First Class:</strong> PowerCabs monitors the flight and coordinates your dispatch, with a name board, luggage assistance, live chat and priority dispatch support. Bonus <strong>&euro;20</strong>.',
      '<strong>The bonus is on top of the meter fare</strong> &mdash; it is not instead of it.',
      '<strong>Meet &amp; Greet bonuses are commission-free.</strong> The full bonus reaches you; commission applies only to the fare.',
      'Free waiting is <strong>10 minutes</strong> on Standard and Meet &amp; Assist and <strong>15 minutes</strong> on First Class &mdash; longer than the 3 minutes on a regular job, because the customer is still clearing the airport.',
    ],
    'quiz' => [
      [
        'q' => 'What makes a Meet &amp; Greet different from a standard airport pickup?',
        'options' => [
          'Nothing, the job is the same',
          'You park, go into the terminal and meet the customer inside arrivals',
          'It is only offered to business accounts',
          'The customer pays cash rather than card',
        ],
        'answer' => 1,
        'explain' => 'You go inside and meet the customer in arrivals rather than waiting kerbside. Budget the time for parking and the walk in.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'What is the driver bonus on a First Class Meet &amp; Greet?',
        'options' => ['&euro;3', '&euro;13', '&euro;20', 'There is no bonus'],
        'answer' => 2,
        'explain' => 'First Class pays &euro;20. Meet &amp; Assist pays &euro;13 and Standard pays &euro;3.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'How is commission applied to a Meet &amp; Greet bonus?',
        'options' => [
          'The usual 10% comes off the bonus',
          'Commission is doubled on airport work',
          'The bonus is commission-free &mdash; commission applies only to the fare',
          'The bonus replaces the fare entirely',
        ],
        'answer' => 2,
        'explain' => 'Meet &amp; Greet bonuses are commission-free. The fare is treated normally; the bonus reaches you in full.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
    ],
    'badge' => null,
  ],

  [
    'id' => 'mg-meeting-points',
    'title' => 'Dublin Airport meeting points',
    'nav' => 'Meeting points',
    'icon' => 'flag',
    'why' =>
      'Most Meet &amp; Greet complaints are not about driving. They are about two people standing in the same terminal unable to find each other. The meeting point is fixed, and so is the evidence you leave behind.',
    'screens' => [],
    'illus' => 'flag',
    'steps' => [
      '<strong>Terminal 1:</strong> the arrivals hall, <strong>beside Insomnia Coffee</strong>.',
      '<strong>Terminal 2:</strong> the arrivals hall, <strong>beside the yellow sculpture</strong>.',
      '<strong>Zone 18 is not a Meet &amp; Greet.</strong> That is the kerbside pickup area for a standard airport booking without Meet &amp; Greet &mdash; if you wait there on a Meet &amp; Greet job, the customer will never find you.',
      '<strong>Photograph the arrivals board when you take up position.</strong> The timestamp on that photo is what proves you were in the terminal, on time, if the booking is later disputed.',
      'Hold the name board where it can be read, and face the arrivals doors rather than your phone.',
      'Airport layouts and access rules change. Follow the latest instructions on the booking rather than the spot that worked last month.',
    ],
    'quiz' => [
      [
        'q' => 'Where is the Meet &amp; Greet meeting point at Terminal 2?',
        'options' => [
          'Zone 18',
          'The arrivals hall beside Insomnia Coffee',
          'The arrivals hall beside the yellow sculpture',
          'The short-term car park',
        ],
        'answer' => 2,
        'explain' => 'Terminal 2 is the arrivals hall beside the yellow sculpture. Terminal 1 is beside Insomnia Coffee.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'You are on a Meet &amp; Greet job and head for Zone 18. What is wrong?',
        'options' => [
          'Nothing, Zone 18 is correct for every airport job',
          'Zone 18 is the kerbside area for standard pickups &mdash; a Meet &amp; Greet is met inside arrivals',
          'Zone 18 is for departures only',
          'Zone 18 is correct but you must pay to enter',
        ],
        'answer' => 1,
        'explain' => 'Zone 18 serves standard airport pickups without Meet &amp; Greet. On a Meet &amp; Greet you go into the arrivals hall.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
      [
        'q' => 'What must you photograph once you are in position in arrivals?',
        'options' => [
          'The customer',
          'Your vehicle in the car park',
          'The arrivals board, so the timestamp proves you attended',
          'Nothing needs photographing',
        ],
        'answer' => 2,
        'explain' => 'Photograph the arrivals board. The timestamp is your evidence of attendance if the job is later disputed &mdash; never photograph the customer.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
    ],
    'badge' => 'mg-ground',
  ],

  [
    'id' => 'mg-delays',
    'title' => 'Flight delays, waiting and no-shows',
    'nav' => 'Delays',
    'icon' => 'calendar',
    'why' =>
      'Flights run late, bags run later, and immigration can take an hour. The waiting rules on an airport job are longer than anywhere else in your week &mdash; and the no-show clock does not work the way most drivers assume.',
    'screens' => [],
    'illus' => 'calendar',
    'steps' => [
      '<strong>First Class includes flight monitoring.</strong> PowerCabs watches the flight and adjusts your dispatch where it can.',
      '<strong>Standard and Meet &amp; Assist are not monitored automatically.</strong> If the flight moves, contact Dispatch rather than waiting it out.',
      'Free waiting runs from the confirmed pickup time: <strong>10 minutes</strong> on Standard and Meet &amp; Assist, <strong>15 minutes</strong> on First Class.',
      '<strong>Maximum wait before a no-show may be reported:</strong> 20 minutes on a Standard Meet &amp; Greet, 30 minutes on Meet &amp; Assist, <strong>45 minutes on First Class</strong>.',
      '<strong>The 45 minutes runs from the original confirmed booking time.</strong> A further flight delay does not restart it &mdash; if the booking was 11:00, the window closes at 11:45 unless PowerCabs confirms a new arrangement.',
      '<strong>Passenger not found?</strong> Call, then message, then contact Dispatch &mdash; in that order, and all three before you leave the terminal.',
      '<strong>Never report a no-show without contacting Dispatch first.</strong> They may already know the flight has landed late.',
    ],
    'quiz' => [
      [
        'q' => 'How much free waiting time is included on a First Class Meet &amp; Greet?',
        'options' => ['3 minutes', '10 minutes', '15 minutes', '45 minutes'],
        'answer' => 2,
        'explain' => 'First Class includes 15 minutes of free waiting. Standard and Meet &amp; Assist include 10. The 45 minutes is the separate no-show maximum.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'A First Class booking is confirmed for 11:00. The flight is delayed to 11:20, then delayed another 20 minutes. When does the 45-minute no-show window close?',
        'options' => [
          '12:05, because it restarts at the new arrival time',
          '11:45, because it runs from the original confirmed booking time',
          '12:25, because each delay adds 45 minutes',
          'It never closes on a First Class booking',
        ],
        'answer' => 1,
        'explain' => 'The 45 minutes runs from the original confirmed booking time of 11:00, so it closes at 11:45. A delay does not restart it unless PowerCabs confirms a revised arrangement.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'Your passenger has not appeared and the waiting window is nearly up. What is the correct order?',
        'options' => [
          'Leave and mark a no-show',
          'Call, then message, then contact Dispatch &mdash; before you leave the terminal',
          'Wait indefinitely and charge for the time',
          'Ask airport staff to page them',
        ],
        'answer' => 1,
        'explain' => 'Call, message, then Dispatch, and do all three before leaving. Dispatch may already know the flight is late.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
    ],
    'badge' => 'mg-calm',
  ],

  [
    'id' => 'mg-fare-rules',
    'title' => 'The meter, tolls and the drive home',
    'nav' => 'Fares &amp; tolls',
    'icon' => 'euro',
    'why' =>
      'The airport run is the journey most likely to produce a fare dispute: a long route, a toll decision, and a meter that is easy to start too early. All three are avoidable.',
    'screens' => [],
    'illus' => 'euro',
    'steps' => [
      '<strong>Never start the meter before the passengers are on board.</strong> Not when you arrive, not when you spot them in arrivals, not while you walk to the car.',
      'The Meet &amp; Greet bonus is separate from the meter fare and is commission-free. The fare itself is treated like any other job.',
      '<strong>M50 and Toll Tunnel must be pre-approved.</strong> Agree the route with the customer and get Dispatch approval before you drive it.',
      '<strong>Before starting the ride, make sure you are authorised.</strong>',
      'Tolls are recorded separately from the meter fare and are not part of your commission calculation.',
      'If you cannot reach Dispatch and approval is needed, take the ordinary route rather than committing the customer to a charge nobody agreed.',
      '<strong>Final reminders:</strong> arrive early, look presentable, hold the board up, photograph the arrivals board, and keep Dispatch informed the moment anything changes.',
    ],
    'quiz' => [
      [
        'q' => 'When may you start the meter on a Meet &amp; Greet?',
        'options' => [
          'When you park at the terminal',
          'When you first see the customer in arrivals',
          'Only once the passengers are on board',
          'When the free waiting time runs out',
        ],
        'answer' => 2,
        'explain' => 'Only once the passengers are on board. Starting it in the terminal or on the walk to the car overcharges the customer and will be disputed.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'The M50 would be quicker on the run into town. What do you do first?',
        'options' => [
          'Drive it and add the toll at the end',
          'Agree it with the customer and get Dispatch approval before you drive it',
          'Absorb the toll yourself',
          'Refuse the job',
        ],
        'answer' => 1,
        'explain' => 'M50 and Toll Tunnel must be pre-approved. Before starting the ride, make sure you are authorised.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'How does the Meet &amp; Greet bonus interact with the meter fare?',
        'options' => [
          'The bonus replaces the meter fare',
          'The bonus is paid on top of the fare, and is commission-free',
          'The bonus is deducted from the fare',
          'The bonus is only paid if the fare is over &euro;50',
        ],
        'answer' => 1,
        'explain' => 'The bonus is paid on top of the meter fare and carries no commission.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
    ],
    'badge' => null,
  ],
];

$pcMgFinalChallenge = [
  ['q' => 'When may you start the meter on a Meet &amp; Greet?', 'options' => ['On arrival at the terminal', 'When you see the customer', 'Only once the passengers are on board', 'At the destination'], 'answer' => 2, 'explain' => 'Only once the passengers are on board.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'Which routes must be pre-approved before you drive them?', 'options' => ['Any motorway', 'The M50 and the Toll Tunnel', 'Airport slip roads', 'None'], 'answer' => 1, 'explain' => 'M50 and Toll Tunnel must be pre-approved. Before starting the ride, make sure you are authorised.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'What must you photograph when you take up position in arrivals?', 'options' => ['The customer', 'The arrivals board', 'Your name board only', 'Nothing'], 'answer' => 1, 'explain' => 'The arrivals board. Its timestamp proves you attended.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'A First Class booking is confirmed for 11:00 and the flight is delayed twice. When does the 45-minute window close?', 'options' => ['11:45', '12:05', '12:25', 'It does not close'], 'answer' => 0, 'explain' => 'It runs from the original confirmed booking time, so 11:45.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'What is the Meet &amp; Greet bonus on a Standard job?', 'options' => ['&euro;3', '&euro;13', '&euro;20', 'Nothing'], 'answer' => 0, 'explain' => 'Standard pays &euro;3, Meet &amp; Assist &euro;13 and First Class &euro;20.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'What is the Meet &amp; Greet bonus on a Meet &amp; Assist job?', 'options' => ['&euro;3', '&euro;13', '&euro;20', '&euro;30'], 'answer' => 1, 'explain' => 'Meet &amp; Assist pays &euro;13.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'Where do you meet a Terminal 1 Meet &amp; Greet customer?', 'options' => ['Zone 18', 'Arrivals, beside Insomnia Coffee', 'Arrivals, beside the yellow sculpture', 'The multi-storey car park'], 'answer' => 1, 'explain' => 'Terminal 1 is the arrivals hall beside Insomnia Coffee.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'Where do you meet a Terminal 2 Meet &amp; Greet customer?', 'options' => ['Zone 18', 'Arrivals, beside Insomnia Coffee', 'Arrivals, beside the yellow sculpture', 'The taxi rank'], 'answer' => 2, 'explain' => 'Terminal 2 is the arrivals hall beside the yellow sculpture.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'What is Zone 18 used for?', 'options' => ['Meet &amp; Greet pickups', 'Standard airport pickups without Meet &amp; Greet', 'Departures drop-off', 'Staff parking'], 'answer' => 1, 'explain' => 'Zone 18 is the kerbside area for standard airport pickups, not for Meet &amp; Greet.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'How much free waiting is included on a Standard Meet &amp; Greet?', 'options' => ['3 minutes', '10 minutes', '15 minutes', '20 minutes'], 'answer' => 1, 'explain' => '10 minutes on Standard and Meet &amp; Assist; 15 on First Class.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'Which service includes flight monitoring by PowerCabs?', 'options' => ['Every airport job', 'Standard Meet &amp; Greet', 'First Class', 'None of them'], 'answer' => 2, 'explain' => 'First Class includes flight monitoring and coordinated dispatch.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'Your passenger has not appeared. What do you do before leaving?', 'options' => ['Nothing, just go', 'Call, message, then contact Dispatch', 'Report a no-show immediately', 'Wait another hour'], 'answer' => 1, 'explain' => 'Call, message, then Dispatch &mdash; all three before you leave the terminal.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'How is the Meet &amp; Greet bonus paid?', 'options' => ['Instead of the fare', 'On top of the fare, commission-free', 'On top of the fare, less 10% commission', 'As a monthly lump sum'], 'answer' => 1, 'explain' => 'On top of the meter fare, with no commission taken from it.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'A Meet &amp; Assist customer has not appeared. What is the no-show maximum?', 'options' => ['10 minutes', '20 minutes', '30 minutes', '45 minutes'], 'answer' => 2, 'explain' => 'Meet &amp; Assist is 30 minutes. Standard Meet &amp; Greet is 20 and First Class is 45.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'What does Meet &amp; Assist add over Standard Meet &amp; Greet?', 'options' => ['Nothing', 'A personalised name board and luggage assistance', 'Flight monitoring', 'A fixed fare'], 'answer' => 1, 'explain' => 'A personalised name board and luggage assistance from the terminal to the car.', 'critical' => false, 'pts' => PC_PTS_EASY],
];

$pcMgMissionCount = count($pcMgMissions);

$pcMgTotalXp = PC_XP_FULL;
foreach ($pcMgMissions as $m) {
  $pcMgTotalXp += pc_mission_points($m);
}
foreach ($pcMgFinalChallenge as $q) {
  $pcMgTotalXp += (int) $q['pts'];
}
