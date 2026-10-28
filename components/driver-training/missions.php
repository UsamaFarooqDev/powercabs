<?php
const PC_PTS_EASY = 10;
const PC_PTS_SCENARIO = 20;
const PC_PTS_HARD = 30;

const PC_XP_LEVEL = 50;
const PC_XP_FULL = 100;

const PC_FINAL_PASS = 85;

$pcBadges = [
  'app-ready' => ['label' => 'App Ready', 'icon' => 'phone', 'desc' => 'Knows the driver app inside out'],
  'job-types' => ['label' => 'Job Specialist', 'icon' => 'star', 'desc' => 'Pet, Business and Delivery jobs'],
  'safe-hands' => ['label' => 'Safe Hands', 'icon' => 'shield', 'desc' => 'Passed the safety-critical checks'],
  'road-smart' => ['label' => 'Road Smart', 'icon' => 'route', 'desc' => 'Prebooks, tolls and airport runs'],
  'team-player' => ['label' => 'Team Player', 'icon' => 'users', 'desc' => 'Support, lost property and referrals'],
  'certified' => ['label' => 'PowerCabs Certified', 'icon' => 'award', 'desc' => 'Passed the final driver challenge'],
];

// Every figure below traces to a screenshot or the brief. Do not add one that does not.
$pcMissions = [
  
  [
    'id' => 'app-basics',
    'title' => 'The driver app, end to end',
    'nav' => 'App basics',
    'icon' => 'phone',
    'why' =>
      'Everything you do in a shift happens on four screens: the home screen, the job offer, the trip screen and the completion screen. Learn these and the rest of the training is detail.',
    'screens' => [
      ['src' => '19-home-screen-go-online.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The driver app home screen with a map, the online toggle, Find Rides and Pre-Book Rides buttons and today\'s totals', 'caption' => '<strong>Online / Offline</strong> is the green toggle. Nothing reaches you until it reads Online.'],
      ['src' => '21-finding-nearby-rides.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The Nearby Trips screen with a search radius slider from 1 to 5 km and a Finding Rides spinner', 'caption' => '<strong>Find Rides</strong> searches nearby. The slider sets your radius, 1&ndash;5 km.'],
      ['src' => '22-en-route-to-pickup.webp', 'w' => 638, 'h' => 372, 'detail' => true, 'alt' => 'The accepted-ride panel showing the fare, the pickup address, and the Navigate, Arrived and SOS Call 999 buttons', 'caption' => 'Once you accept: the fare, the pickup, then <strong>Navigate</strong> and <strong>Arrived</strong>. <strong>SOS &mdash; Call 999</strong> sits under every trip screen.'],
      ['src' => '25-ride-completed-earnings.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The Ride Completed screen showing meter fare, tolls, cash payment, 10 percent commission and the driver earnings', 'caption' => 'The breakdown: fare, tolls, payment method, <strong>commission (10%)</strong> and what you earned.'],
    ],
    'steps' => [
      '<strong>Go online:</strong> flip the toggle on the home screen. Flip it back to stop receiving work.',
      '<strong>Find and accept:</strong> tap Find Rides for live work, or Pre-Book Rides for jobs already assigned to you.',
      '<strong>Check before you commit:</strong> every offer shows pickup, destination, distance and fare.',
      '<strong>Payment type</strong> is on the trip card &mdash; Cash or Card. Business, Pet and Delivery jobs are flagged on the job itself.',
      '<strong>Can&rsquo;t find the pickup?</strong> Use the phone icon to call, or Message, before you do anything else.',
      '<strong>A problem with the trip?</strong> Menu &rarr; Support &amp; Disputes raises a ticket.',
      '<strong>Cancelling:</strong> only when you genuinely cannot do the job, and the sooner the better &mdash; your cancel rate is on the home screen.',
    ],
    'quiz' => [
      [
        'q' => 'You have opened the app but no jobs are coming through. What do you check first?',
        'options' => ['Your earnings total', 'That the toggle reads Online', 'Your cancel rate', 'The promotions panel'],
        'answer' => 1,
        'explain' => 'Nothing is offered to you until you are Online. The toggle on the home screen is the switch.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'You are at the pickup address but cannot see the customer. What do you do first?',
        'options' => [
          'Cancel the job immediately',
          'Call or message the customer from the trip screen',
          'Drive off and go back online',
          'Mark the trip complete',
        ],
        'answer' => 1,
        'explain' => 'The trip screen has Call and Message. Contact the customer first &mdash; most "missing" pickups are a wrong doorway, not a no-show.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
      [
        'q' => 'Where do you raise a problem with a trip after it has finished?',
        'options' => ['Rides History', 'Menu &rarr; Support &amp; Disputes', 'The home screen toggle', 'Profile Settings'],
        'answer' => 1,
        'explain' => 'Support &amp; Disputes is where you submit a ticket or check one you already raised.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
    ],
    'badge' => 'app-ready',
  ],

  [
    'id' => 'pet-jobs',
    'title' => 'Pet jobs',
    'nav' => 'Pet jobs',
    'icon' => 'paw',
    'why' =>
      'A Pet Job is a trip where the customer is travelling with an animal &mdash; usually a dog or a cat. Not every driver accepts them, so they only reach drivers who have opted in.',
    'screens' => [
      ['src' => '13-signup-ride-preferences.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The signup preferences screen with toggles for night rides, pets allowed and wheelchair accessible', 'caption' => '<strong>Pets allowed</strong> in your preferences is what puts you in the Pet Job pool.'],
    ],
    'illus' => 'paw',
    'reward' => 'Pet charge by size: &euro;3 small, &euro;5 medium, &euro;7 large.',
    'steps' => [
      'Turn <strong>Pets allowed</strong> on in your preferences to be offered Pet Jobs at all.',
      'Pet Jobs are flagged on the job so you know before you accept.',
      '<strong>The pet charge follows the size of the animal: &euro;3 small, &euro;5 medium, &euro;7 large.</strong>',
      'Expect a carrier for cats, and a lead or harness for dogs.',
      'A blanket or waterproof seat cover in the boot protects your upholstery and makes the next pet job easy.',
      'Assistance and guide dogs are <strong>not</strong> ordinary pet journeys &mdash; they carry specific protections under Irish law.',
    ],
    'quiz' => [
      [
        'q' => 'What is a Pet Job, and how is the pet charge worked out?',
        'options' => [
          'Any trip to a vet &mdash; no charge',
          'A trip with a customer&rsquo;s animal &mdash; the charge follows the size of the pet',
          'A delivery of pet food &mdash; a flat &euro;5',
          'A trip booked by a pet shop &mdash; no charge',
        ],
        'answer' => 1,
        'explain' => 'A Pet Job is a trip where the customer travels with their pet. The charge follows the size of the animal: &euro;3 small, &euro;5 medium, &euro;7 large.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'A customer arrives with an assistance dog. How should you treat it?',
        'options' => [
          'As an ordinary Pet Job with the pet surcharge',
          'Refuse unless they booked a Pet Job',
          'Not as an ordinary pet journey &mdash; assistance dogs have specific protections under Irish law',
          'Ask them to use a carrier',
        ],
        'answer' => 2,
        'explain' => 'Assistance and guide dogs are protected under Irish law and must not be treated as ordinary pet journeys or charged as one.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'A customer books a Pet Job with a large dog. What is the pet charge?',
        'options' => ['&euro;3', '&euro;5', '&euro;7', 'There is no charge'],
        'answer' => 2,
        'explain' => 'Large is &euro;7. Small is &euro;3 and medium is &euro;5.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
    ],
    'badge' => null,
  ],

  [
    'id' => 'business-jobs',
    'title' => 'Business jobs',
    'nav' => 'Business',
    'icon' => 'briefcase',
    'why' =>
      'Business jobs come from company accounts rather than individual passengers. They repeat, they are booked ahead, and the account is judging PowerCabs on how you handle them.',
    'screens' => [],
    'illus' => 'briefcase',
    'reward' => '&euro;5 extra on eligible Business Jobs.',
    'steps' => [
      'Business jobs are flagged on the job card before you accept.',
      'They are usually account-paid, so there is no cash to collect &mdash; check the payment type on the card.',
      'Be on time, be presentable, and keep the car clean: a company account books hundreds of trips, not one.',
      'Complete them in the app the same way as any other trip so the account is billed correctly.',
    ],
    'quiz' => [
      [
        'q' => 'Why do business customers matter more than a single fare?',
        'options' => [
          'They tip more',
          'They are account customers who book repeatedly, so one bad trip costs many',
          'They always pay cash',
          'They are shorter journeys',
        ],
        'answer' => 1,
        'explain' => 'A business account books continuously. How you handle one trip decides whether the account keeps booking.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'What extra do you receive on an eligible Business Job?',
        'options' => ['&euro;3', '&euro;5', '&euro;10', 'Nothing'],
        'answer' => 1,
        'explain' => 'Eligible Business Jobs pay &euro;5 extra.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
    ],
    'badge' => null,
  ],

  [
    'id' => 'delivery-jobs',
    'title' => 'Delivery and item collection',
    'nav' => 'Delivery',
    'icon' => 'box',
    'why' =>
      'Some jobs carry an item instead of a person &mdash; keys, documents, a laptop, a small package. The trip works the same way; what changes is that you are responsible for the item.',
    'screens' => [],
    'illus' => 'box',
    'steps' => [
      'Collect the item from the pickup and check it matches what the job describes.',
      'Keep it with you and secure for the whole journey.',
      'Hand it to the named recipient at the destination.',
      '<strong>Nobody there to receive it?</strong> Do not leave it unattended. Contact Dispatch and follow their instruction.',
      'Report any problem with a delivery through Support &amp; Disputes, or call Dispatch if it cannot wait.',
    ],
    'quiz' => [
      [
        'q' => 'You arrive with a laptop to deliver and nobody answers. What do you do?',
        'options' => [
          'Leave it at the door',
          'Give it to a neighbour',
          'Keep the item secure and contact Dispatch for instructions',
          'Take it home and deliver it tomorrow',
        ],
        'answer' => 2,
        'explain' => 'Never leave an item unattended or hand it to someone who is not the recipient. Keep it secure and let Dispatch decide.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'Which of these is a typical Delivery job?',
        'options' => [
          'A customer with luggage going to the airport',
          'A set of keys being sent across the city',
          'A passenger with a pet',
          'A pre-booked airport pickup',
        ],
        'answer' => 1,
        'explain' => 'Delivery jobs carry an item with no passenger &mdash; keys, documents, a laptop, a small package.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
    ],
    'badge' => 'job-types',
  ],

  [
    'id' => 'prebook',
    'title' => 'Prebook jobs',
    'nav' => 'Prebook',
    'icon' => 'calendar',
    'why' =>
      'A Prebook is a job assigned to you ahead of time. The customer has planned around it, which is why a late cancellation costs far more than a late cancellation on a live job.',
    'screens' => [
      ['src' => '20-scheduled-rides.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The Scheduled Rides screen with Today, Tomorrow and All Upcoming tabs, showing assigned rides with date, time, fare, addresses, distance, drive time, and Map and Accept buttons', 'caption' => '<strong>Pre-Book Rides</strong> &mdash; date, time, fare, both addresses, distance and drive time, then <strong>Accept</strong>.'],
    ],
    'steps' => [
      'Open <strong>Pre-Book Rides</strong> and switch between Today, Tomorrow and All Upcoming.',
      'Check the pickup time and the drive time before you accept &mdash; tap <strong>Map</strong> to see the route.',
      'Plan to arrive early. A Prebook is the one job where being on time is the whole product.',
      '<strong>If you cannot do it, release it as early as you possibly can</strong> so Dispatch can re-cover it.',
      'Cancelling an hour before pickup is a different thing from cancelling the day before &mdash; the later it is, the less chance anyone can cover it.',
      'Repeated or last-minute Prebook cancellations can lead to restrictions on your Prebook access under PowerCabs policy.',
    ],
    'quiz' => [
      [
        'q' => 'It is 40 minutes before a Prebook pickup and you realise you cannot make it. What is the right action?',
        'options' => [
          'Say nothing and hope the customer cancels',
          'Tell Dispatch immediately so they can try to re-cover the job',
          'Arrive late and apologise',
          'Cancel silently in the app at the pickup time',
        ],
        'answer' => 1,
        'explain' => 'Tell Dispatch the moment you know. The only thing that saves a late Prebook is the time you give someone else to cover it.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'What can repeated last-minute Prebook cancellations lead to?',
        'options' => [
          'Nothing &mdash; cancellations are not tracked',
          'A higher commission rate',
          'Restrictions on your Prebook access under PowerCabs policy',
          'An automatic fine',
        ],
        'answer' => 2,
        'explain' => 'Prebooks are assigned on trust. Repeated or last-minute cancellations can restrict your access to them.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
    ],
    'badge' => null,
  ],

  [
    'id' => 'customer-behaviour',
    'title' => 'Difficult customers and trip problems',
    'nav' => 'Safety',
    'icon' => 'shield',
    'why' =>
      'Most trips are uneventful. This level is about the few that are not &mdash; and the rule underneath all of it is that your safety comes before the fare.',
    'screens' => [
      ['src' => '24-ride-in-progress.webp', 'w' => 638, 'h' => 448, 'detail' => true, 'alt' => 'The ride-ongoing panel showing both addresses, a greyed out Complete Ride button noting it is available within 1 km of the destination, and the SOS Call 999 button', 'caption' => '<strong>SOS &mdash; Call 999</strong> is on the ride screens for the whole job. In an emergency, use it.'],
    ],
    'steps' => [
      '<strong>You may refuse or end a trip</strong> if you reasonably believe you or the vehicle are at risk.',
      'In an emergency use <strong>SOS &mdash; Call 999</strong>. Do not try to manage a dangerous situation yourself.',
      'For abusive or threatening behaviour that is not an emergency, end the trip safely and report it to Dispatch.',
      'Report every incident through Support &amp; Disputes so there is a record &mdash; a verbal account to nobody protects nothing.',
      '<strong>If a customer soils the vehicle</strong>, photograph it before you clean anything and report it to Dispatch straight away.',
      'A soiling charge may apply under the applicable National Transport Authority rules, up to the permitted maximum of &euro;140, reflecting the reasonable cost of cleaning or repair.',
      '<strong>For cash or card rides, the driver can collect soiling charges directly from the customer. It is the driver&rsquo;s responsibility to collect the soiling charges.</strong>',
      'Take the evidence and report it first, then collect. Stay calm and professional about it &mdash; if the customer refuses, do not escalate it in the car, report it to Dispatch.',
    ],
    'quiz' => [
      [
        'q' => 'A passenger becomes aggressive and you feel genuinely unsafe. What do you do?',
        'options' => [
          'Keep driving and finish the trip',
          'Stop somewhere safe, end the trip, and use SOS &mdash; Call 999 if you are in danger',
          'Argue until they calm down',
          'Drive them to a Garda station without telling them',
        ],
        'answer' => 1,
        'explain' => 'Your safety comes before the fare. Stop safely, end the trip, and use SOS &mdash; Call 999 in an emergency.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'A customer is sick in your car. What is the correct order?',
        'options' => [
          'Clean it, then forget about it',
          'Collect the charge first and photograph it afterwards',
          'Photograph it, report it to Dispatch, then collect the charge and clean',
          'Post about it and wait for a reply',
        ],
        'answer' => 2,
        'explain' => 'Evidence first, report second, then collect and clean. A soiling charge may apply under NTA rules up to &euro;140.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'On a cash or card ride, who collects the soiling charge from the customer?',
        'options' => [
          'Nobody &mdash; it is written off',
          'The driver, directly from the customer',
          'The customer pays it to the Garda',
          'It is always billed later by head office',
        ],
        'answer' => 1,
        'explain' => 'For cash or card rides the driver collects the soiling charge directly from the customer. It is the driver&rsquo;s responsibility to collect it.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
    ],
    'badge' => 'safe-hands',
  ],

  [
    'id' => 'tolls',
    'title' => 'Tolls, motorways and approvals',
    'nav' => 'Tolls',
    'icon' => 'road',
    'why' =>
      'A toll or motorway route can be the right call or an expensive surprise on the customer&rsquo;s bill. The difference is whether it was approved before you drove it.',
    'screens' => [
      ['src' => '25-ride-completed-earnings.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The ride completion screen showing a fare breakdown including a tolls line', 'caption' => 'Tolls appear as their own line in the fare breakdown.'],
    ],
    'steps' => [
      'Tolls are recorded separately from the meter fare &mdash; they are not part of your commission calculation.',
      '<strong>M50 and Toll Tunnel must be pre-approved.</strong> Get that approval from Dispatch before you drive the route, never after.',
      '<strong>Before starting the ride, make sure you are authorised.</strong>',
      'Ask the customer first if they have a route preference &mdash; many do.',
      'If you cannot reach Dispatch and approval is needed, take the ordinary route rather than committing the customer to a charge nobody agreed.',
      'Never add a toll to a job that did not use one.',
    ],
    'quiz' => [
      [
        'q' => 'A motorway route would be faster but adds a toll, and you are not sure it is approved. What do you do?',
        'options' => [
          'Take it and add the toll afterwards',
          'Check with the customer and get Dispatch approval before committing to it',
          'Take it and absorb the toll yourself',
          'Refuse the job',
        ],
        'answer' => 1,
        'explain' => 'Agree it before you drive it. An unapproved charge added after the fact is a dispute waiting to happen.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
      [
        'q' => 'Which routes must be pre-approved before you drive them?',
        'options' => [
          'Any route over 10 km',
          'The M50 and the Toll Tunnel',
          'Only airport routes',
          'None &mdash; approval is given afterwards',
        ],
        'answer' => 1,
        'explain' => 'M50 and Toll Tunnel must be pre-approved. Before starting the ride, make sure you are authorised.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
    ],
    'badge' => null,
  ],

  [
    'id' => 'support',
    'title' => 'Getting help: three channels',
    'nav' => 'Support',
    'icon' => 'headset',
    'why' =>
      'PowerCabs runs three support channels and they are not interchangeable. Picking the right one is the difference between help in two minutes and help in two days.',
    'screens' => [
      ['src' => '18-driver-menu-settings.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The driver Settings menu listing Profile Settings, Rides History, Documents and Vehicle Info, Support and Disputes, Contact Us and Earnings', 'caption' => '<strong>Support &amp; Disputes</strong> and <strong>Contact Us</strong> both live in the menu.'],
    ],
    'steps' => [
      '<strong>Phone</strong> &mdash; urgent and immediate. You are on a job, something is happening now. Driver line: <strong>+353 89 965 4467</strong>.',
      '<strong>WhatsApp</strong> &mdash; ordinary driver support. Quick questions, a photo of a problem, something that needs an answer today but not this second.',
      '<strong>Email</strong> &mdash; non-urgent matters and anything with paperwork. Documents, account records, written confirmation.',
      'For a document or vehicle detail change, email <strong>support@powercabs.ie</strong>.',
      'In a genuine emergency it is <strong>999</strong>, not Dispatch.',
    ],
    'quiz' => [
      [
        'q' => 'You are mid-trip and something urgent has gone wrong. Which channel?',
        'options' => ['Email', 'WhatsApp', 'Phone', 'Wait until the end of your shift'],
        'answer' => 2,
        'explain' => 'Phone is for urgent, immediate assistance. Email and WhatsApp are not going to reach anyone fast enough mid-trip.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'You need to send an updated insurance certificate. Which channel?',
        'options' => ['Phone', 'Email', 'SOS', 'Shout at Dispatch on the radio'],
        'answer' => 1,
        'explain' => 'Documentation goes by email &mdash; it is non-urgent and it needs a written record.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'You are being threatened by a passenger. Who do you contact?',
        'options' => ['Dispatch by WhatsApp', 'Email support', '999', 'Your referral contact'],
        'answer' => 2,
        'explain' => 'An emergency is 999, through the SOS button on the ride screen. Dispatch is not an emergency service.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
    ],
    'badge' => null,
  ],

  [
    'id' => 'lost-property',
    'title' => 'Lost property',
    'nav' => 'Lost property',
    'icon' => 'search',
    'why' =>
      'A phone left on your back seat is somebody&rsquo;s worst afternoon. Handling it well is one of the few things a driver does that a customer never forgets.',
    'screens' => [],
    'illus' => 'search',
    'reward' => '&euro;7 bonus for successfully reporting and returning eligible lost property, subject to PowerCabs terms.',
    'steps' => [
      'Check the back seat and footwells between jobs &mdash; most items are found by the next passenger, not the driver.',
      'Found something? <strong>Report it to Dispatch straight away</strong> so the customer can be matched to it.',
      'Keep the item secure in your vehicle. Do not use it, open it or go through it.',
      'Return it as Dispatch instructs &mdash; they will arrange it with the customer.',
      'Do not arrange a handover with the customer privately outside the PowerCabs process.',
      'An eligible report and return earns a <strong>&euro;7 bonus</strong>, subject to PowerCabs terms.',
    ],
    'quiz' => [
      [
        'q' => 'You find a customer&rsquo;s phone after a trip. What should you do?',
        'options' => [
          'Keep it until they call you',
          'Report it to Dispatch, keep it secure, and return it as they instruct',
          'Drop it to the nearest Garda station without telling anyone',
          'Leave it where it is',
        ],
        'answer' => 1,
        'explain' => 'Report it, secure it, return it through Dispatch. Eligible returns earn a &euro;7 bonus, subject to PowerCabs terms.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
    ],
    'badge' => null,
  ],

  [
    'id' => 'refer',
    'title' => 'Refer a friend &amp; the Ambassador Programme',
    'nav' => 'Refer',
    'icon' => 'users',
    'why' =>
      'The quickest way to earn outside the meter. Referrals pay once, the Ambassador Programme pays continuously.',
    'screens' => [
      ['src' => '01-signup-personal-info.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The signup personal info screen with a Referral Code optional field at the bottom', 'caption' => 'Your friend enters your code in the <strong>Referral Code</strong> field when they sign up. That is the whole mechanism &mdash; if they skip it, it does not count.'],
    ],
    'reward' => '&euro;50 when the driver you referred joins PowerCabs and completes 10 jobs.',
    'steps' => [
      'Give your referral code to the driver before they sign up.',
      'They enter it in the <strong>Referral Code</strong> field at step 1 of signup.',
      'The reward pays once they have joined <strong>and completed 10 jobs</strong> &mdash; not on signup alone.',
      '<strong>Ambassador Programme:</strong> for drivers who want to represent PowerCabs on the road.',
      'Ambassador benefits include free card terminals, exclusive vehicle branding, fuel discounts, extra loyalty points, a swag pack and dedicated support.',
      'Ask the office about becoming an Ambassador, or read the Ambassador Programme page on the website.',
    ],
    'quiz' => [
      [
        'q' => 'When does a &euro;50 referral reward actually pay out?',
        'options' => [
          'As soon as your friend downloads the app',
          'When they sign up',
          'When they join and complete 10 jobs',
          'After their first month',
        ],
        'answer' => 2,
        'explain' => 'Joining is not enough &mdash; the referred driver has to join and complete 10 jobs.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'Your friend signed up last week but forgot to enter your referral code. What happens?',
        'options' => [
          'It is applied automatically',
          'The code is what links the referral, so it needs to be entered at signup &mdash; contact the office',
          'You get double next time',
          'You get &euro;25 instead',
        ],
        'answer' => 1,
        'explain' => 'The Referral Code field at signup is the mechanism. If it was missed, raise it with the office rather than assuming it tracked.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
    ],
    'badge' => 'team-player',
  ],

  [
    'id' => 'waiting',
    'title' => 'Waiting time, airport and Meet &amp; Greet',
    'nav' => 'Airport',
    'icon' => 'plane',
    'why' =>
      'Three different situations that drivers routinely mix up: a regular pickup, an airport or preorder pickup, and a premium Meet &amp; Greet. The free waiting time is not the same for any of them.',
    'screens' => [
      ['src' => '23-arrived-waiting-for-passenger.webp', 'w' => 720, 'h' => 960, 'detail' => true, 'alt' => 'The You Have Arrived screen showing a 3 minute free wait badge, a countdown timer, Call and Message buttons, a warning not to start the meter until the passenger is on board, and a Passenger On Board button', 'caption' => '<strong>3 min free wait included</strong> on this ride type, with a live countdown &mdash; and the meter rule in black and white.'],
    ],
    'steps' => [
      '<strong>Regular job: 3 minutes free waiting.</strong> Tap Arrived and the countdown starts.',
      '<strong>Airport, Meet &amp; Greet and preorder jobs: 10 minutes free waiting.</strong>',
      '<strong>Premium and First Class Meet &amp; Greet: 15 minutes free waiting.</strong>',
      'The arrival screen shows the included wait for the ride type you are on &mdash; read it rather than assuming.',
      'Call and message the customer while the timer runs. Do not just sit there.',
      'If the timer expires and there is still no customer, you may be able to charge a no-show fee &mdash; follow the app and tell Dispatch.',
      '<strong>Never start the meter before the passenger is on board.</strong> The arrival screen says so explicitly.',
      '<strong>Airport jobs:</strong> flights are late, bags are slow. Contact Dispatch before treating an airport customer as a no-show.',
      '<strong>Meet &amp; Greet</strong> is different from a standard airport pickup: you park, go into the terminal and meet the customer in arrivals rather than waiting kerbside.',
      'Accept a Meet &amp; Greet the same way as any job &mdash; just budget the extra time for parking and walking in.',
    ],
    'quiz' => [
      [
        'q' => 'When may you start the meter?',
        'options' => [
          'When you arrive at the pickup',
          'When you accept the job',
          'Only once the passenger is on board',
          'When the free wait expires',
        ],
        'answer' => 2,
        'explain' => 'The arrival screen states it outright: do not start the meter until the passenger is on board. Starting early overcharges the customer and will be disputed.',
        'critical' => true,
        'pts' => PC_PTS_HARD,
      ],
      [
        'q' => 'What is the difference between a standard airport pickup and a Meet &amp; Greet?',
        'options' => [
          'Nothing, they are the same job',
          'Meet &amp; Greet means you park and meet the customer inside arrivals rather than waiting kerbside',
          'Meet &amp; Greet is only for business customers',
          'Standard pickups cost more',
        ],
        'answer' => 1,
        'explain' => 'Meet &amp; Greet means going into the terminal to meet the customer in arrivals. Budget time for parking and the walk.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
      [
        'q' => 'An airport customer has not appeared and the wait has run out. What do you do?',
        'options' => [
          'Leave immediately and mark a no-show',
          'Contact Dispatch before treating it as a no-show &mdash; flights and bags run late',
          'Start the meter and wait',
          'Call 999',
        ],
        'answer' => 1,
        'explain' => 'Airport delays are routine and outside the customer&rsquo;s control. Check with Dispatch before writing the job off.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
      [
        'q' => 'How much free waiting time is included on a regular job?',
        'options' => ['1 minute', '3 minutes', '10 minutes', '15 minutes'],
        'answer' => 1,
        'explain' => 'A regular job includes 3 minutes. Airport, Meet &amp; Greet and preorder jobs include 10, and Premium or First Class Meet &amp; Greet includes 15.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'You are on an airport pickup. How much free waiting time is included?',
        'options' => ['3 minutes', '10 minutes', '15 minutes', '30 minutes'],
        'answer' => 1,
        'explain' => 'Airport, Meet &amp; Greet and preorder jobs all include 10 minutes. Only Premium and First Class Meet &amp; Greet gets 15.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
    ],
    'badge' => 'road-smart',
  ],

  [
    'id' => 'payments',
    'title' => 'Payments and earnings',
    'nav' => 'Earnings',
    'icon' => 'euro',
    'why' =>
      'Know where your money is shown, what comes off it, how an hourly hire is priced, and what to do on the day a number looks wrong.',
    'screens' => [
      ['src' => '25-ride-completed-earnings.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The ride completion screen showing meter fare, tolls, payment method, minimum fare, commission at 10 percent and the driver earnings', 'caption' => 'Per trip: fare, tolls, payment method, <strong>commission (10%)</strong>, and <strong>Your Earnings</strong>. Minimum fare is &euro;4.50.'],
      ['src' => '18-driver-menu-settings.webp', 'w' => 720, 'h' => 1600, 'alt' => 'The driver menu showing Rides History and Earnings entries', 'caption' => '<strong>Earnings</strong> and <strong>Rides History</strong> in the menu are where the totals and the trip-by-trip breakdown live.'],
    ],
    'steps' => [
      '<strong>Earnings</strong> in the menu shows your totals and the trip breakdown; <strong>Rides History</strong> shows past trips.',
      'The home screen shows what you have taken today, trips completed and your cancel rate.',
      '<strong>Cash jobs:</strong> you take the fare in the car. <strong>Card and account jobs</strong> are paid through PowerCabs.',
      'Commission is <strong>10%</strong>, shown on every completion screen. The minimum fare is <strong>&euro;4.50</strong>.',
      'Business trips are account-paid &mdash; there is no cash to collect.',
      '<strong>Pay Per Hour</strong> jobs are priced by time rather than distance: <strong>&euro;45 per hour</strong> for a small, regular or economy car, and <strong>&euro;50 per hour</strong> for a large or XL car.',
      '<strong>A number looks wrong?</strong> Check the trip in Rides History first, then raise it through Support &amp; Disputes with the trip details.',
    ],
    'quiz' => [
      [
        'q' => 'What commission does PowerCabs take, as shown on the completion screen?',
        'options' => ['5%', '10%', '15%', '20%'],
        'answer' => 1,
        'explain' => 'Commission (10%) appears in the fare breakdown between the trip fare and your earnings.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
      [
        'q' => 'A trip you completed yesterday is missing from your earnings. What is the right first step?',
        'options' => [
          'Assume it will appear and wait a month',
          'Find the trip in Rides History, then raise it through Support &amp; Disputes with the details',
          'Re-drive the route',
          'Cancel your next job in protest',
        ],
        'answer' => 1,
        'explain' => 'Get the evidence first &mdash; the trip record &mdash; then raise it with the details. A ticket with a trip reference gets resolved; one without does not.',
        'critical' => false,
        'pts' => PC_PTS_SCENARIO,
      ],
      [
        'q' => 'A customer books Pay Per Hour and you are driving a regular saloon. What is the rate?',
        'options' => ['&euro;35 per hour', '&euro;45 per hour', '&euro;50 per hour', 'It stays on the meter'],
        'answer' => 1,
        'explain' => 'Small, regular and economy cars are &euro;45 per hour. A large or XL car is &euro;50 per hour.',
        'critical' => false,
        'pts' => PC_PTS_EASY,
      ],
    ],
    'badge' => null,
  ],
];

$pcMissionCount = count($pcMissions);
$pcMissionIds = array_column($pcMissions, 'id');

function pc_mission_points(array $mission): int
{
  $pts = PC_XP_LEVEL;
  foreach ($mission['quiz'] as $q) {
    $pts += (int) $q['pts'];
  }
  return $pts;
}

$pcFinalChallenge = [
  ['q' => 'When may you start the meter?', 'options' => ['When you arrive', 'When you accept the job', 'Only once the passenger is on board', 'At the end'], 'answer' => 2, 'explain' => 'The arrival screen is explicit: not until the passenger is on board.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'Something dangerous is happening mid-trip. What do you use?', 'options' => ['The Message button', 'SOS &mdash; Call 999', 'Complete Ride', 'Email support'], 'answer' => 1, 'explain' => 'SOS &mdash; Call 999 is on the ride screens for the whole job.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'A customer soils your vehicle. What is the correct order?', 'options' => ['Clean, then forget it', 'Collect the charge before photographing anything', 'Photograph, report to Dispatch, then collect the charge and clean', 'Refuse to move'], 'answer' => 2, 'explain' => 'Evidence, report, then collect. On a cash or card ride the driver collects the soiling charge directly from the customer.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'You have a delivery and nobody is there to receive it. What do you do?', 'options' => ['Leave it at the door', 'Give it to a neighbour', 'Keep it secure and contact Dispatch', 'Bin it'], 'answer' => 2, 'explain' => 'Never leave an item unattended or hand it to the wrong person.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'A customer travels with an assistance dog. How is it treated?', 'options' => ['As an ordinary Pet Job', 'Refuse the trip', 'Not as an ordinary pet journey &mdash; it has protections under Irish law', 'Charge double'], 'answer' => 2, 'explain' => 'Assistance and guide dogs are protected under Irish law.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'A Pet Job arrives with a medium-sized dog. What is the pet charge?', 'options' => ['&euro;3', '&euro;5', '&euro;7', 'Nothing'], 'answer' => 1, 'explain' => 'Medium is &euro;5. Small is &euro;3 and large is &euro;7.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'What extra do you receive on an eligible Business Job?', 'options' => ['&euro;3', '&euro;5', '&euro;15', 'Nothing'], 'answer' => 1, 'explain' => 'Eligible Business Jobs pay &euro;5 extra.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'What is the bonus for reporting and returning eligible lost property?', 'options' => ['&euro;3', '&euro;5', '&euro;7', 'None'], 'answer' => 2, 'explain' => '&euro;7, subject to PowerCabs terms.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'When does the &euro;50 referral reward pay out?', 'options' => ['On download', 'On signup', 'When the referred driver joins and completes 10 jobs', 'After a year'], 'answer' => 2, 'explain' => 'Joining is not enough &mdash; they must also complete 10 jobs.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'What commission is shown on the completion screen?', 'options' => ['5%', '10%', '15%', '25%'], 'answer' => 1, 'explain' => 'Commission (10%), between the trip fare and your earnings.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'What is the minimum fare shown in the app?', 'options' => ['&euro;3.50', '&euro;4.50', '&euro;6.00', 'There is none'], 'answer' => 1, 'explain' => 'The completion screen notes a minimum fare of &euro;4.50.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'How close to the destination must you be to complete a ride?', 'options' => ['100 m', '1 km', '5 km', 'Anywhere'], 'answer' => 1, 'explain' => 'Complete Ride only enables within 1 km of the destination.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'What is the maximum Find Rides search radius?', 'options' => ['2 km', '5 km', '15 km', '50 km'], 'answer' => 1, 'explain' => 'The Nearby Trips slider runs from 1 km to 5 km.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'You cannot make a Prebook, 40 minutes before pickup. What do you do?', 'options' => ['Say nothing', 'Tell Dispatch immediately so they can re-cover it', 'Turn up late', 'Cancel at the pickup time'], 'answer' => 1, 'explain' => 'The only thing that saves a late Prebook is the time you give someone else.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'Repeated last-minute Prebook cancellations can lead to what?', 'options' => ['Nothing', 'Higher commission', 'Restrictions on your Prebook access under PowerCabs policy', 'A bonus'], 'answer' => 2, 'explain' => 'Prebooks are assigned on trust and that access can be restricted.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'A motorway route adds a toll and you are unsure it is approved. What do you do?', 'options' => ['Drive it and add the toll after', 'Agree it with the customer and get Dispatch approval first', 'Absorb the cost', 'Refuse the job'], 'answer' => 1, 'explain' => 'Agree it before you drive it, never after.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'Which two routes must always be pre-approved before you drive them?', 'options' => ['Any dual carriageway', 'The M50 and the Toll Tunnel', 'Airport roads only', 'None of them'], 'answer' => 1, 'explain' => 'M50 and Toll Tunnel must be pre-approved. Before starting the ride, make sure you are authorised.', 'critical' => true, 'pts' => PC_PTS_HARD],
  ['q' => 'How much free waiting time is included on a regular job?', 'options' => ['1 minute', '3 minutes', '10 minutes', '15 minutes'], 'answer' => 1, 'explain' => 'Regular 3 minutes; airport, Meet &amp; Greet and preorder 10; Premium and First Class Meet &amp; Greet 15.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'Premium and First Class Meet &amp; Greet include how much free waiting time?', 'options' => ['3 minutes', '10 minutes', '15 minutes', '45 minutes'], 'answer' => 2, 'explain' => '15 minutes. Standard airport, Meet &amp; Greet and preorder jobs get 10, and a regular job gets 3.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'On a cash or card ride, who collects a soiling charge from the customer?', 'options' => ['Nobody', 'The driver, directly from the customer', 'The Garda', 'It is always billed later'], 'answer' => 1, 'explain' => 'For cash or card rides the driver collects it directly. It is the driver&rsquo;s responsibility to collect the soiling charge.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'What is the Pay Per Hour rate for a large or XL car?', 'options' => ['&euro;40 per hour', '&euro;45 per hour', '&euro;50 per hour', '&euro;60 per hour'], 'answer' => 2, 'explain' => '&euro;50 per hour for a large or XL car; &euro;45 for small, regular or economy.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'Urgent problem, mid-trip. Which support channel?', 'options' => ['Email', 'WhatsApp', 'Phone', 'Next shift'], 'answer' => 2, 'explain' => 'Phone is for urgent, immediate assistance.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'Sending an updated insurance certificate. Which channel?', 'options' => ['Phone', 'Email', 'SOS', 'WhatsApp voice note'], 'answer' => 1, 'explain' => 'Documentation goes by email, where there is a written record.', 'critical' => false, 'pts' => PC_PTS_EASY],
  ['q' => 'What makes a Meet &amp; Greet different from a standard airport pickup?', 'options' => ['Nothing', 'You park and meet the customer inside arrivals', 'It is business only', 'It pays less'], 'answer' => 1, 'explain' => 'You go into the terminal rather than waiting kerbside &mdash; budget the extra time.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
  ['q' => 'A completed trip is missing from your earnings. First step?', 'options' => ['Wait a month', 'Find it in Rides History, then raise it through Support &amp; Disputes with the details', 'Re-drive it', 'Stop working'], 'answer' => 1, 'explain' => 'Evidence first, then a ticket with the trip reference.', 'critical' => false, 'pts' => PC_PTS_SCENARIO],
];

$pcTotalXp = PC_XP_FULL;
foreach ($pcMissions as $m) {
  $pcTotalXp += pc_mission_points($m);
}
foreach ($pcFinalChallenge as $q) {
  $pcTotalXp += (int) $q['pts'];
}
