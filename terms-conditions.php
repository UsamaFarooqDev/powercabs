<?php
$pageTitle       = 'Terms & Conditions | PowerCabs';
$pageDescription = "PowerCabs Ireland Limited's Terms and Conditions for Passengers and the General Terms of Use for Drivers and Taxi Contractors.";
$assetPath       = '';

require __DIR__ . '/includes/header.php';

$heroEyebrow     = '/ Policies & Safety';
$heroTitleLight  = 'Terms &';
$heroTitleBold   = 'Conditions.';
$heroDescription = "Our agreements with Passengers and Drivers who use PowerCabs Services -- please read the version that applies to you.";
$heroBgImage     = 'https://images.pexels.com/photos/8939052/pexels-photo-8939052.jpeg?auto=format&fit=crop&w=1600&q=60';
$heroBreadcrumbLabel = 'Terms & Conditions';
require __DIR__ . '/components/inner-hero.php';

$passengerNav = [
  ['id' => 'p-offerings',    'label' => '1. PowerCabs Offerings'],
  ['id' => 'p-mobility',     'label' => '2. Mobility Services Overview'],
  ['id' => 'p-location',     'label' => '3. Utilizing Location Data'],
  ['id' => 'p-fees',         'label' => '4. Fees &amp; Cancellations'],
  ['id' => 'p-interrupt',    'label' => '5. Changes &amp; Interruptions'],
  ['id' => 'p-payment',      'label' => '6. Payment Procedures'],
  ['id' => 'p-payoptions',   'label' => '7. Payment Options &amp; Policies'],
  ['id' => 'p-subscription', 'label' => '8. Subscription Offerings'],
  ['id' => 'p-duration',     'label' => '9. Duration &amp; Discontinuation'],
  ['id' => 'p-liability',    'label' => '10. Liability &amp; IP'],
  ['id' => 'p-conduct',      'label' => '11. User Conduct'],
  ['id' => 'p-validity',     'label' => '12. Validity &amp; Jurisdiction'],
];

$driverNav = [
  ['id' => 'd-scope',      'label' => 'Scope &amp; Main Terms'],
  ['id' => 'd-services',   'label' => '1. PowerCabs Services'],
  ['id' => 'd-avail',      'label' => '2. Availability'],
  ['id' => 'd-obligations','label' => '3. General Obligations'],
  ['id' => 'd-software',   'label' => '4. Software'],
  ['id' => 'd-content',    'label' => '5. Responsibility for Content'],
  ['id' => 'd-tracking',   'label' => '6. Tracking &amp; Third-Party Info'],
  ['id' => 'd-exclusion1', 'label' => '7. Rating, Ranking &amp; Payments'],
  ['id' => 'd-termination','label' => '8. Termination'],
  ['id' => 'd-exclusion2', 'label' => '9. Exclusion from Use'],
  ['id' => 'd-liability',  'label' => '10. Liability'],
  ['id' => 'd-data',       'label' => '11. Data Protection'],
  ['id' => 'd-complaints', 'label' => '12. Complaints'],
  ['id' => 'd-final',      'label' => '13. Final Provisions'],
];
?>

<!-- ============ Audience Toggle ============ -->
<section class="pt-5 pb-3 text-center">
  <div class="container">
    <input type="radio" class="btn-check" name="tcAudience" id="tcAudiencePassenger" autocomplete="off" checked>
    <label class="btn btn-outline-primary rounded-pill px-4 me-2" for="tcAudiencePassenger">Passenger Terms</label>

    <input type="radio" class="btn-check" name="tcAudience" id="tcAudienceDriver" autocomplete="off">
    <label class="btn btn-outline-primary rounded-pill px-4" for="tcAudienceDriver">Driver Terms</label>
  </div>
</section>

<!-- ============ Passenger Terms ============ -->
<section class="section-pc pt-3" id="passengerTerms">
  <div class="container">
    <div class="row gy-5">
      <div class="col-lg-3">
        <div class="pc-tc-nav">
          <p class="small fw-semibold text-uppercase mb-3" style="letter-spacing: .06em; color: var(--pc-orange);">On This Page</p>
          <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
            <?php foreach ($passengerNav as $item): ?>
              <li><a class="pc-tc-nav-link small" href="#<?= $item['id'] ?>"><?= $item['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="col-lg-9 pc-tc-body">
        <p class="small text-muted-pc mb-4">Terms and Conditions for Passengers of PowerCabs Ireland Limited</p>

        <p>To utilize the PowerCabs Services, it&rsquo;s mandatory to agree to the Terms and Conditions while setting up your account on the App. Your initial and subsequent logins to the App serve as your consent to adhere to these Terms and Conditions. Should you choose not to accept these terms, you are ineligible to create an account or engage with the PowerCabs Services. Non-acceptance of the Terms and Conditions should be followed by discontinuing the account creation process or deleting your existing PowerCabs account. The App and its services are accessible solely under the compliance with these Terms and Conditions.</p>

        <p>When utilizing PowerCabs Services within Ireland, these Terms and Conditions are effective alongside any other agreements you have with PowerCabs. However, should there be any individual contracts made with you, those will take precedence over these Terms and Conditions and any other relevant terms that may apply.</p>

        <p>These Terms and Conditions outline the potential charges by PowerCabs for providing its services, which encompass the Cancellation Fee applicable upon the cancellation of a Trip, once accepted by an SPSV Driver. Additionally, be aware that PowerCabs use of third-party websites and applications (&ldquo;Third Party Website Services&rdquo;) may introduce supplementary terms and conditions.</p>

        <div class="pc-panel rounded-4 p-4 my-4">
          <p class="fw-semibold mb-2">Promotions &amp; Discount</p>
          <p class="small mb-2">The promo code is intended to help new passengers join. Each coupon can receive a maximum amount of 6 euros for each trip. Coupons expire on January 31, 2025 at 23:59. After this date and time, no discounts will be offered under this coupon. The coupon is limited to 20 trips per passenger. The company reserves the right to amend or cancel without prior notice.</p>
          <p class="small fw-semibold mb-0">Coupon Code: 01IRL2025PCLI</p>
        </div>

        <h2 id="p-offerings" class="fs-4 fw-bold mt-5 mb-3">1. PowerCabs Offerings</h2>
        <p><strong>1.1.</strong> POWERCABS serves as a bridge, connecting users seeking rides to destinations with authorized drivers of small public service vehicles, known as &ldquo;SPSV Drivers,&rdquo; which include taxis, hackneys, or limousines, collectively referred to as &ldquo;Transportation Services&rdquo; or &ldquo;SPSV Rides,&rdquo; through its App or its website.</p>
        <p><strong>1.2.</strong> Users are provided with POWERCABS Services either directly through the App or via Website Services.</p>
        <p><strong>1.3.</strong> To access POWERCABS Services, users must complete a registration on the App, providing personal details such as full name, email address (which will serve as the &ldquo;Username&rdquo;), and phone number, and create a secure password. This registration process, which includes agreeing to these Terms and Conditions, is a prerequisite for using POWERCABS Services. Users have the option to rectify any mistakes in their input before finalizing their registration.</p>
        <p><strong>1.4.</strong> Through the App, users can request Taxi Services from SPSV approved drivers and engage in direct communication with the driver who accepts the service request. The actual Transportation Services are rendered by the SPSV Driver, and the formal agreement for the service, referred to as a &ldquo;Trip&rdquo; (or collectively &ldquo;Trips&rdquo;), is established between the user and the SPSV Driver &mdash; or the driver&rsquo;s employer in cases where the driver is part of a larger SPSV service provider &mdash; once the driver accepts the user&rsquo;s request. POWERCABS is not accountable for the actual Transportation Services provided by the SPSV Driver, including their availability.</p>
        <p><strong>1.5.</strong> POWERCABS may impose fees for its services. POWERCABS retains the right to alter the Passenger Fee Policy, promising to notify users reasonably and appropriately before any changes are implemented.</p>
        <p><strong>1.6.</strong> The SPSV Driver will charge users for the Transportation Services rendered, including any additional fees or surcharges mandated by Irish law, collectively termed the &ldquo;SPSV Fare.&rdquo; Moreover, if users engage with Third Party Website Services, those entities may levy charges for their use, &ldquo;Third Party Charges.&rdquo; Both SPSV Fares and Third Party Charges, even when processed through the App are considered payments to the respective SPSV Driver or third party, as they have assigned their billing rights to POWERCABS. These charges are distinct from any fees POWERCABS may charge for its services.</p>
        <p><strong>1.7.</strong> POWERCABS grants users access to its App, which can be installed on web-enabled mobile devices like smartphones and tablets, referred to as &ldquo;Mobile End-Devices,&rdquo; for the use of POWERCABS Services, subject to these Terms and Conditions. Users bear sole responsibility for securing internet access to utilize POWERCABS Services, covering any related costs, and ensuring their devices meet the technical specifications and configurations necessary for the App and POWERCABS Services. POWERCABS does not guarantee the accuracy or completeness of data transmitted by its services or the timeliness of the data&rsquo;s delivery to users.</p>
        <p><strong>1.8. Business Trips:</strong> Trips can also be arranged and invoiced as business or commercial journeys under agreements between POWERCABS and its business partners, who can authorize their staff or others to have a Trip billed as a business or commercial journey under the company&rsquo;s account, referred to as &ldquo;Business Trips.&rdquo;</p>
        <p><strong>1.8.1</strong> Booking a Business Trip through the App or opting to bill a Trip as a Business Trip via a business account will result in POWERCABS collecting and forwarding data for handling and invoicing to the authorizing business partner, &ldquo;Billing Data.&rdquo; If Transportation or Mobility Services are booked as a Business Trip, relevant billing information, including usernames, email, trip timing, start and end points, and incurred fare, will be shared with the POWERCABS business partner responsible for the Business Trip. The extent of Billing Data shared depends on the data needed to settle Business Trip costs with the account holder. Users take on the risk when booking services as part of business offerings. Any Trips not covered by business services will be charged to the user&rsquo;s personal account, and all associated fees must be prepaid using the user&rsquo;s private payment method. Should a user exceed their allocated mobility budget, the business partner will not cover the payment, which will instead be processed through the user&rsquo;s private payment method. Users are fully liable for any penalties, fines, or losses incurred due to misuse of POWERCABS Services for Business Trips that contravene these Terms and Conditions or their agreement with the business partner. POWERCABS may collaborate with affiliated entities or external partners to process Billing Data. Users must be at least 18 years old to sign up for and use POWERCABS Services. Despite other terms, users can permit individuals under 18 to use POWERCABS Services through their account, taking full responsibility for such use. Users are fully accountable for all activities and fees associated with their account.</p>

        <h2 id="p-mobility" class="fs-4 fw-bold mt-5 mb-3">2. Mobility Services Overview</h2>
        <p><strong>2.1.</strong> The governing terms for Mobility Services are detailed in each Mobility Partner&rsquo;s own terms and conditions. POWERCABS&rsquo;s role is to facilitate connections between Users and Mobility Partners for Mobility Services, without being a contractual party in the agreements for these services, which are solely between the User and the Mobility Partner. POWERCABS handles invoicing and payment collection on behalf of the Mobility Partner, in line with their fee policy. Mobility Partners transfer their billing claims for Mobility Services fees to POWERCABS, authorizing POWERCABS to collect payments in its name. Despite this financial arrangement, the contractual relationship for Mobility Services remains directly between the Mobility Partner and the User. Payment for Mobility Services is typically processed through the App&rsquo;s Pay by App feature, unless alternative payment options are provided. Fees for other services from Mobility Partners are paid using the payment method chosen by the User during registration or booking.</p>
        <p><strong>2.2.</strong> Mobility Partners may request additional details or documents, like a license or ID, for booking Mobility Services. Users must supply accurate and complete information and keep it updated. POWERCABS may validate this information within the App, either directly or via a third party, although Users can choose whether to use this validation service. POWERCABS records successful validations in the User&rsquo;s account but may revalidate if necessary or if booking conditions change.</p>
        <p><strong>2.3.</strong> Users are obliged to adhere to the Mobility Partner T&amp;Cs and all relevant legal and regulatory requirements, such as holding a valid license for the Mobility Services used.</p>
        <p><strong>2.4.</strong> POWERCABS does not guarantee the continuous availability of Mobility Services.</p>
        <p><strong>2.5.</strong> POWERCABS may withhold Mobility Service requests if there&rsquo;s reasonable belief that the User won&rsquo;t comply with the terms or doesn&rsquo;t meet the required criteria set by the Mobility Partner or POWERCABS.</p>
        <p><strong>2.6.</strong> Mobility Partners bear full responsibility for the Mobility Services they provide through the App. Users recognize that POWERCABS Services may be offered under different brands or by POWERCABS affiliates, subsidiaries, or Mobility Partners. POWERCABS is not liable for any claims related to the provision or facilitation of Mobility Services.</p>

        <h2 id="p-location" class="fs-4 fw-bold mt-5 mb-3">3. Utilizing Location Data</h2>
        <p><strong>3.1.</strong> The App has the capability to pinpoint the User&rsquo;s location for the purpose of providing POWERCABS Services, known as &ldquo;Location Services.&rdquo; Users can manage how their location data is used through the privacy settings within the App, Third Party Website Services, or on their Mobile End-Device. When a User enables Location Services and requests Transportation Services through the App, POWERCABS will forward the User&rsquo;s location along with the service request to nearby SPSV approved Drivers. This process assists SPSV Drivers in deciding whether to accept the User&rsquo;s request for Transportation Services.</p>
        <p><strong>3.2.</strong> Upon the User&rsquo;s activation of Location Services and submission of a Transportation Service request via the App and following an SPSV Driver&rsquo;s acceptance of the service request, POWERCABS transmits the User&rsquo;s location, Username, and phone number to the SPSV Driver. This information facilitates the provision of Transportation Services to the User. Further particulars can be found in the Privacy Notice. The availability of POWERCABS Services, or specific features within them, may rely on accessing the User&rsquo;s location information. While Users have the autonomy to block POWERCABS&rsquo;s access to their location by disabling Location Services, doing so may restrict POWERCABS&rsquo;s ability to deliver its services. POWERCABS recommends activating Location Services to ensure full functionality of the provided services.</p>

        <h2 id="p-fees" class="fs-4 fw-bold mt-5 mb-3">4. Fees for Technology Use and Trip Cancellations</h2>
        <p><strong>4.1.</strong> After a Trip is completed, users may incur a variable Technology Fee, determined by the chosen Transportation Services. This fee is charged by POWERCABS for the use of its services and is additional to the SPSV Fare and any 3rd party charges. Factors affecting the Technology Fee may include the type of transportation, timing of the order, and market conditions. The fee will be itemized on the receipt post-trip, though a single transaction will cover the SPSV Fare, Technology Fee, and any other charges. The Technology Fee is owed to POWERCABS regardless of any Promotional Codes used, payment method, payment failures, or actions by the SPSV Driver. The agreement for the Technology Fee is exclusively between POWERCABS and the user.</p>
        <p><strong>4.2.</strong> The Technology Fee will be processed using the user&rsquo;s registered Pay by App payment methods. If the user paid the SPSV Driver in cash, POWERCABS will charge an alternative payment method. Users without a registered payment method may be restricted from the app until the fee is paid. Users agree to this payment process by accepting the Terms and Conditions. SPSV Drivers are not authorized to collect the Technology Fee. Transaction charges on card payments may be borne by the passenger.</p>
        <p><strong>4.3.</strong> Users cancelling a confirmed SPSV Ride, or if the driver cancels due to the user&rsquo;s absence at the pickup location, may be subject to a Cancellation Fee. Details on this fee can be found in POWERCABS&rsquo;s Fee Policy.</p>
        <p><strong>4.4.</strong> Cancellation Fees will be charged through the user&rsquo;s Pay by App payment methods. If the user intended to pay in cash, an alternative payment method will be charged. Users without a registered payment method may be suspended from the app until the fee is paid. Users consent to this payment method for Cancellation Fees by agreeing to the Terms and Conditions. Users disputing a Cancellation Fee must email POWERCABS within 48 hours of the charge, providing full details for review. POWERCABS may modify, eliminate, or adjust fees for its services at any time based on its discretion. Any changes will be updated in the Terms and Conditions or the fee schedule and will take effect upon publication of the revised documents.</p>

        <h2 id="p-interrupt" class="fs-4 fw-bold mt-5 mb-3">5. Changes and Service Interruptions</h2>
        <p>POWERCABS may alter its services at its discretion for reasons including but not limited to enhancement and development. It also retains the authority to halt the services, either indefinitely or for a specified duration, without prior notification. Updates regarding any such suspensions will be communicated through the POWERCABS website, the App, or other channels. Users should not expect the POWERCABS Services to be available without interruption. The services are offered strictly in their current state and subject to availability.</p>

        <h2 id="p-payment" class="fs-4 fw-bold mt-5 mb-3">6. Payment Procedures and App-Based Transactions</h2>
        <p><strong>6.1.</strong> Users recognize that engaging with POWERCABS Services may incur charges such as SPSV Fares to the SPSV Driver, Third Party Charges, or fees to POWERCABS, including the Technology Fee and Cancellation Fee.</p>
        <p><strong>6.2.</strong> For Transportation Services arranged via the App, unless specified otherwise or in the case of Cash-Free Periods, Users have the option to pay the SPSV Fare directly to the SPSV Driver in cash or through other payment methods provided by the driver upon completion of the trip. If a User opts to pay in cash, POWERCABS may process any related service fees through an alternative registered payment method.</p>
        <p><strong>6.3.</strong> POWERCABS may present Users with the choice, or requirement in certain cases, to settle SPSV Fares and other related fees via the App without cash, using available payment options like credit cards, subject to POWERCABS&rsquo;s set limits. The maximum allowable amount for such transactions will be communicated via the POWERCABS website, the App, or other suitable means. When Users opt for or are mandated to use the App for payment, the SPSV Driver assigns their payment claim to POWERCABS under a private agreement, which also covers the transfer of funds from POWERCABS to the SPSV Driver. Upon receipt of payment from the User, POWERCABS fulfils the SPSV Driver&rsquo;s claim for the provided Transportation Services.</p>
        <p><strong>6.4.</strong> POWERCABS retains the discretion to enforce Cash-Free Periods during peak demand times, requiring Users to use the App for payments, excluding cash payments to SPSV Drivers. Such decisions are based on operational needs and aim to enhance SPSV Driver availability and response times. Users will also be informed before requesting Transportation Services during a Cash-Free Period that cash will not be an accepted payment method.</p>
        <p><strong>6.5.</strong> Should a Pay by App Trip result in a negative account balance and the selected payment method fails, POWERCABS will automatically process the payment through another registered method. By agreeing to these Terms and Conditions, Users consent to this automatic payment processing. To utilize Pay by App, Users must enter at least one valid payment method within the App, such as credit card details.</p>
        <p><strong>6.6.</strong> Adding a payment method for Pay by App may require setting up additional security measures. Users acknowledge that:</p>
        <ul>
          <li>Registration of a payment method might involve further identity verification.</li>
          <li>Verification methods can vary and depend on agreements with banks or payment providers.</li>
          <li>POWERCABS may request such verifications for enhanced security.</li>
          <li>POWERCABS may share necessary payment information with payment service providers during verification.</li>
        </ul>
        <p><strong>6.7.</strong> POWERCABS may execute payment requests as soon as fees are due without additional user authentication. Users, barring certain restrictions can choose their payment method for Pay by App and are free to modify or remove payment options in the App. If all electronic payment methods are removed, Users can still pay in cash or other allowed methods, unless Pay by App is obligatory for the service. POWERCABS may occasionally conduct a nominal pre-authorization transaction for validation, with prior notice to Users.</p>

        <h2 id="p-payoptions" class="fs-4 fw-bold mt-5 mb-3">7. Payment Options and Policies</h2>
        <p>POWERCABS may execute a pre-authorization on the user&rsquo;s payment method when a new payment method is added, Pay by App is selected for booking, or at the point of payment. This holds true even if the service request or trip is cancelled. The pre-authorization may temporarily affect the available balance and appear as a hold, which will be released upon validation completion, subject to the processing time of the user&rsquo;s bank or payment provider. POWERCABS may also place a pre-authorization for the estimated SPSV Fare or other fees, which reserves the amount for actual payment without immediate debit. Users will be notified of this via email or the App after booking. Full payment receipt will result in the release of the reserved amount.</p>
        <p><strong>7.1.</strong> By using Pay by App, users agree to POWERCABS&rsquo;s pre-authorization practices as described.</p>
        <p><strong>7.2.</strong> Users paying through Pay by App are responsible for the full amount of Transportation and Mobility Services, including any Technology Fee, Cancellation Fee, and voluntary tips. Business Trips or trips under a mobility budget from a business partner will be paid by the respective business.</p>
        <p><strong>7.3.</strong> POWERCABS reserves the right to withhold certain payment methods at its discretion. POWERCABS is not liable for any fees incurred from cashless transactions, including those from credit cards etc. Users must ensure sufficient funds in their bank account for Pay by App transactions. Insufficient funds may result in additional charges, and POWERCABS may utilize alternative payment methods. Late payments may incur interest and a service fee, with POWERCABS reserving the right to recover higher costs if demonstrated. Users failing to protect their account credentials or report unauthorized use may be liable for resulting costs, except when POWERCABS has been notified and has blocked the account. POWERCABS may block a user&rsquo;s account or Pay by App functions, either permanently or temporarily, and may require new security credentials if there is suspicion of unauthorized or fraudulent use. Users will be informed of any such actions.</p>
        <p><strong>7.4.</strong> Voucher usage is subject to specific conditions:</p>
        <ul>
          <li>Vouchers can only be redeemed when using Pay by App.</li>
          <li>Each voucher is valid for one trip and one user during the specified promotion period, expiring afterward. Vouchers cannot be exchanged for cash, and no compensation is provided for technical issues preventing voucher use. First-time Pay by App users can only use a voucher once.</li>
        </ul>
        <p><strong>7.5.</strong> Should there be any unauthorized utilization of Promotional Codes, POWERCABS retains the authority to suspend the User&rsquo;s account. Similarly, if there&rsquo;s any indication of fraudulent activities, attempts at fraud, or other illegal actions concerning the use or exchange of Promotional Codes, POWERCABS may suspend or terminate the implicated User account. In such instances, POWERCABS is entitled to seek restitution from the User to recover any benefits or services obtained improperly through the User&rsquo;s account.</p>

        <h2 id="p-subscription" class="fs-4 fw-bold mt-5 mb-3">8. Subscription Offerings</h2>
        <p><strong>8.1.</strong> POWERCABS may offer time-bound credit vouchers, known as &ldquo;Subscription Service Codes,&rdquo; for purchasing in advance. These codes can be applied towards payment for trips arranged via the App, referred to as &ldquo;Subscription Services.&rdquo; The specifics, including pricing, number of codes, their value, any restrictions, and validity period, will be provided on the POWERCABS website or App and may be updated periodically. Once purchased, the value and expiration date of a Subscription Service Code are fixed and unchangeable.</p>
        <p><strong>8.2.</strong> Subscription Service Codes come with an expiration date and must be used within the designated timeframe. Users are responsible for monitoring these dates, despite POWERCABS&rsquo;s efforts to provide reminders.</p>
        <p><strong>8.3.</strong> Redemption of Subscription Service Codes is limited to SPSVs that accept Pay by App and for Mobility Services within Irish cities where these options are available.</p>
        <p><strong>8.4.</strong> Should the cost of a trip exceed the Subscription Service Code&rsquo;s value, the user is responsible for paying the difference by cash or through any alternate method available.</p>
        <p><strong>8.5.</strong> Unless otherwise specified, each Subscription Service Code is valid for one trip within its purchase period. Unused values do not carry over past the expiration date and cannot be combined with other promotions or discounts. These codes have no monetary value and cannot be transferred or sold.</p>
        <p><strong>8.6.</strong> Full payment is required to purchase a Subscription Service Code, which can be ordered through POWERCABS&rsquo;s dedicated website or the App. The subscription becomes active upon payment, and purchases must be finalized at least two days before the start of the subscription term.</p>
        <p><strong>8.7.</strong> Users have the option for automatic renewal of Subscription Services at purchase. If selected, the subscription will renew automatically at the end of each term unless cancelled at least 48 hours before the current period ends, via the website, contact form, or App.</p>
        <p><strong>8.8.</strong> Post-payment, users will receive the Subscription Service terms via email, and can view active subscriptions and their expiration within the App. Opting for a Subscription Service does not alter the legal framework of POWERCABS Services as previously defined. POWERCABS maintains the right to impose Technology and Cancellation Fees on trips paid with Subscription Services.</p>

        <h2 id="p-duration" class="fs-4 fw-bold mt-5 mb-3">9. Duration and Discontinuation</h2>
        <p>The relationship between the User and POWERCABS, governed by these Terms and Conditions begins when the User first agrees to them, such as during the App registration process, and continues throughout the User&rsquo;s engagement with POWERCABS Services. Either party is entitled to end the agreement outlined in these Terms and Conditions, including the use of the App and all related services like Pay by App, at any given time. This can be done through written notice, which includes email, or by the User removing their POWERCABS account via the App.</p>

        <h2 id="p-liability" class="fs-4 fw-bold mt-5 mb-3">10. Liability and Ownership of Creative Content</h2>
        <p><strong>10.1</strong> Subject to all sections of these Terms and Conditions limiting POWERCABS&rsquo;s liability to the User, POWERCABS&rsquo;s maximum aggregate liability under or in connection with these Terms and Conditions (including in relation to the User&rsquo;s use of the POWERCABS Services) whether in contract, tort (including negligence) or otherwise, shall in all circumstances be limited to &euro;1,000.</p>
        <p>POWERCABS shall not be liable, in contract, tort (including negligence) or for breach of statutory duty or in any other way for:</p>
        <ul>
          <li>any economic losses (including loss of revenues, profits, contracts, data, business or anticipated savings);</li>
          <li>any loss of goodwill or reputation;</li>
          <li>any special or indirect or consequential losses;</li>
          <li>losses and/or damage not caused by its breach;</li>
          <li>the actions or inactions of any Users;</li>
          <li>the actions or inactions of other drivers; or</li>
          <li>failure to provide any services or to meet any of its obligations under these Terms and Conditions where such failure is due to events beyond POWERCABS&rsquo;s control (for example a network failure) or failure of a 3rd party service provider (e.g. a payment services provider).</li>
        </ul>
        <p>The User shall be obliged to take adequate measures to mitigate damages, regularly backing up their data stored on the Mobile End-Device to reduce the potential damages in case of data loss. For the avoidance of doubt, as the POWERCABS Services do not include the actual Transportation Services and/or Mobility Services, the User must bring any claims relating to the SPSV Transportation Services and/or Mobility Services against the respective SPSV Driver and/or Mobility Partner and the User agrees that POWERCABS shall have no liability in respect of the SPSV Transportation Services and/or Mobility Services.</p>
        <p><strong>10.2</strong> All copyrights and intellectual property associated with the POWERCABS Services and the App, including its software components, are retained by POWERCABS and its licensors. Under these Terms and Conditions, POWERCABS provides the User a restricted license to download the App onto their personal device solely for accessing POWERCABS Services. Users are expressly prohibited from altering, copying, distributing, leasing, lending, sublicensing, publicly showcasing, or performing any part of the App. Additionally, users must not reverse engineer, decompile, or disassemble the App. POWERCABS and its licensors hold exclusive rights to all content within the App, such as text, images, designs, photos, audio, video, and their organization. Without explicit permission from POWERCABS, this content cannot be modified, replicated, shared, leased, loaned, sublicensed, displayed, or performed publicly. Users may only create necessary copies of this content for viewing purposes on the POWERCABS website and app. Trademarks, trade names, and titles displayed on the App are the property of their respective holders.</p>

        <h2 id="p-conduct" class="fs-4 fw-bold mt-5 mb-3">11. User Conduct and Responsibilities</h2>
        <p>Users must adhere to all relevant laws and regulations when using POWERCABS Services, ensuring they do not disrupt, overload, or harm the service, nor circumvent its intended use. Users must not, directly or indirectly, tamper with or circumvent any security measures of the service. Users are responsible for safeguarding their Username, password, and any other identification measures, keeping them confidential and not sharing them with others. Any unauthorized access to or use of the POWERCABS Services, especially the Pay by App feature, must be promptly reported to POWERCABS through the provided contact details or via the App. Users may only use third-party personal data received through POWERCABS (especially that of SPSV Drivers) for securing Transportation or Mobility Services. Disclosing this data to others without POWERCABS&rsquo;s explicit consent or legal mandate is prohibited. Users commit to providing accurate and complete personal information and maintaining its currency throughout their use of POWERCABS Services. Users authorized by POWERCABS&rsquo;s business partners to charge Trips to a business account must truthfully declare each Trip&rsquo;s nature (business or personal) to ensure proper billing. POWERCABS is not responsible for verifying the purpose of the User&rsquo;s Trips.</p>

        <h2 id="p-validity" class="fs-4 fw-bold mt-5 mb-3">12. Validity, Jurisdiction, and Consumer Rights</h2>
        <p><strong>12.1.</strong> Should any clause within these Terms and Conditions be deemed void, unenforceable, or incomplete, the remaining sections shall remain valid and enforceable. The legal relationship between the User and POWERCABS, as well as the interpretation of these Terms and Conditions, are subject to Irish law. Any disputes related to these Terms and Conditions fall under the exclusive jurisdiction of the Irish courts.</p>
        <p><strong>12.2.</strong> Regardless of these Terms and Conditions, Users&rsquo; legal rights under Irish or European consumer protection laws remain intact. Any part of these Terms and Conditions that conflicts with such Consumer Laws will be considered modified to conform with those laws.</p>
      </div>
    </div>
  </div>
</section>

<!-- ============ Driver Terms ============ -->
<section class="section-pc pt-3 d-none" id="driverTerms">
  <div class="container">
    <div class="row gy-5">
      <div class="col-lg-3">
        <div class="pc-tc-nav">
          <p class="small fw-semibold text-uppercase mb-3" style="letter-spacing: .06em; color: var(--pc-orange);">On This Page</p>
          <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
            <?php foreach ($driverNav as $item): ?>
              <li><a class="pc-tc-nav-link small" href="#<?= $item['id'] ?>"><?= $item['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>

      <div class="col-lg-9 pc-tc-body">
        <p class="small text-muted-pc mb-4">General Terms of Use &mdash; PowerCabs Ireland Limited Driver App for Taxi Drivers and Taxi Contractors of PowerCabs Ireland Limited (hereinafter: &ldquo;POWERCABS IRELAND LIMITED&rdquo;), CRO No. 764330.</p>

        <h2 id="d-scope" class="fs-4 fw-bold mt-4 mb-3">Scope and Main Terms</h2>
        <p>The use of the POWERCABS IRELAND LIMITED Driver App by drivers (referred to as &ldquo;Users&rdquo; or &ldquo;you&rdquo;), whether self-employed or employed by another individual or company (the &ldquo;Employer&rdquo;), is governed by these General Terms of Use (the &ldquo;Terms&rdquo; or this &ldquo;Agreement&rdquo;). Users must: (a) be licensed to drive a small public service vehicle (&ldquo;SPSV&rdquo;); and (b) own or rent an SPSV, be entitled to use it, and possess all required licenses that are valid at all times while using the POWERCABS IRELAND LIMITED Driver App. All transportation services provided by an SPSV (&ldquo;Transportation Services&rdquo;) must be fulfilled by licensed SPSV drivers using vehicles appropriately licensed as SPSVs, as required under Applicable Laws. By using the POWERCABS IRELAND LIMITED Driver App, the User agrees to these Terms each time they log in.</p>
        <p>POWERCABS IRELAND LIMITED may categorize different types of Transportation Services (e.g., &ldquo;Premium,&rdquo; &ldquo;Match Services,&rdquo; etc.) and distinguish between services provided to consumers and businesses, each with different terms or fees as detailed in this Agreement or the applicable price list available via the Driver App, the POWERCABS IRELAND LIMITED website, and within the app.</p>
        <div class="pc-panel rounded-4 p-4 my-4">
          <p class="fw-semibold mb-2">Note</p>
          <p class="small mb-0">Users are bound by the regulations applicable to them, particularly the NTA Taxi Regulation Acts 2013 and 2016, and all associated regulations, including the Taxi Regulation (Small Public Service Vehicle) Regulations 2015, and any other relevant local laws and regulations. Users may accept requests for Transportation Services (&ldquo;Requests&rdquo;) only as permitted under Applicable Laws.</p>
        </div>

        <h2 id="d-services" class="fs-4 fw-bold mt-5 mb-3">1. POWERCABS IRELAND LIMITED Services</h2>
        <p><strong>1.1.</strong> POWERCABS IRELAND LIMITED connects potential passengers with drivers via the Driver App, which is provided to Users for this purpose through web-enabled mobile devices.</p>
        <p><strong>1.2.</strong> Users are responsible for their own internet access, technical requirements, and ensuring their devices are up-to-date and compatible with the Driver App.</p>

        <h2 id="d-avail" class="fs-4 fw-bold mt-5 mb-3">2. Availability</h2>
        <p><strong>2.1.</strong> POWERCABS IRELAND LIMITED does not guarantee continuous or uninterrupted availability of the Driver App. The app is provided on an &lsquo;as is&rsquo; and &lsquo;as available&rsquo; basis without any warranties.</p>
        <p><strong>2.2.</strong> POWERCABS IRELAND LIMITED may temporarily discontinue services without notice and shall not be liable for any resulting damages.</p>

        <h2 id="d-obligations" class="fs-4 fw-bold mt-5 mb-3">3. General Contractual Obligations of the User</h2>
        <p><strong>3.1.</strong> Users must register with accurate information and keep it updated.</p>
        <p><strong>3.2.</strong> Users must have all necessary licenses and use an appropriately licensed SPSV.</p>
        <p><strong>3.3.</strong> Devices must be safely mounted in compliance with road safety regulations.</p>
        <p><strong>3.4.</strong> Users must update their status (&lsquo;free&rsquo; or &lsquo;engaged&rsquo;) in the Driver App to receive new Requests.</p>
        <p><strong>3.5.</strong> Users must fulfill accepted Requests unless there is a valid reason and proof.</p>
        <p><strong>3.6.</strong> Users must use the Driver App lawfully and adhere to the specified prohibitions.</p>
        <p><strong>3.7.</strong> POWERCABS IRELAND LIMITED is not responsible for the behavior of passengers or third parties.</p>
        <p><strong>3.8.</strong> Users must not engage in criminal or damaging behavior.</p>
        <p><strong>3.9.</strong> Users cannot use the POWERCABS IRELAND LIMITED logo or name without permission.</p>

        <h2 id="d-software" class="fs-4 fw-bold mt-5 mb-3">4. Software</h2>
        <p><strong>4.1.</strong> Users must not impair or modify the Driver App&rsquo;s security or intended purpose.</p>
        <p><strong>4.2.</strong> All intellectual property rights in the Driver App belong to POWERCABS IRELAND LIMITED.</p>
        <p><strong>4.3.</strong> Users are granted a limited, non-exclusive license to use the Driver App in accordance with these Terms.</p>
        <p><strong>4.4.</strong> Users must keep their account credentials secure and report unauthorized use.</p>
        <p><strong>4.5.</strong> POWERCABS IRELAND LIMITED may require updates to the Driver App.</p>

        <h2 id="d-content" class="fs-4 fw-bold mt-5 mb-3">5. Responsibility for Content</h2>
        <p><strong>5.1.</strong> The publishing party is responsible for content on the POWERCABS IRELAND LIMITED website or other media.</p>
        <p><strong>5.2.</strong> User-generated content must not be harmful, unlawful, or offensive.</p>
        <p><strong>5.3.</strong> POWERCABS IRELAND LIMITED may remove content violating these rules.</p>

        <h2 id="d-tracking" class="fs-4 fw-bold mt-5 mb-3">6. Tracking, Third-Party Information</h2>
        <p><strong>6.1.</strong> Geo-location services are required for providing intermediation services.</p>
        <p><strong>6.2.</strong> Users must not misuse personal data of passengers and must comply with data protection laws.</p>

        <h2 id="d-exclusion1" class="fs-4 fw-bold mt-5 mb-3">7. Exclusion from Use, Rating System and Ranking, Payments</h2>
        <p><strong>7.1.</strong> Users may be restricted or excluded for breaching these Terms.</p>
        <p><strong>7.2.</strong> Users agree to passenger ratings being published.</p>
        <p><strong>7.3.</strong> Requests are notified based on proximity, ratings, and driver loyalty.</p>
        <p><strong>7.4.</strong> Pre-Booking Requests are accepted on a first-come, first-served basis.</p>
        <p><strong>7.5.</strong> Users must provide receipts if requested by passengers.</p>
        <p><strong>7.6.</strong> Payments may be withheld for fraudulent activities.</p>

        <h2 id="d-termination" class="fs-4 fw-bold mt-5 mb-3">8. Termination</h2>
        <p><strong>8.1</strong> Subject to any existing agreements between POWERCABS IRELAND LIMITED and the User&rsquo;s Employer, the User can terminate these Terms at any time without providing a reason by notifying POWERCABS IRELAND LIMITED (including via email). Uninstalling the POWERCABS IRELAND LIMITED Driver App from the User&rsquo;s device is sufficient to effect this termination.</p>
        <p><strong>8.2</strong> An Event of Default (as defined below) will be considered a repudiation of this Agreement by the User, but not a termination, irrespective of whether the Event of Default is voluntary, involuntary, occurs by operation of law, or results from a court order or decree. If an Event of Default occurs, POWERCABS IRELAND LIMITED may choose, without affecting any other rights or remedies it may have under this Agreement, to take appropriate action.</p>
        <p><strong>8.3</strong> If the User does not provide any Transportation Services via POWERCABS IRELAND LIMITED for at least three (3) consecutive months, POWERCABS IRELAND LIMITED reserves the right to set the User&rsquo;s account to &ldquo;inactive.&rdquo; POWERCABS IRELAND LIMITED will inform the User of this status change, and the User will no longer be able to receive any Requests. The User can request to have their account reactivated through the Contact Form section of the Website.</p>
        <p><strong>8.5</strong> Upon termination of this Agreement for any reason, including by POWERCABS IRELAND LIMITED: (i) all rights granted to the User under these Terms will cease; (ii) the User must stop all activities authorized by these Terms, including providing Transportation Services through the POWERCABS IRELAND LIMITED Driver App; (iii) the User must immediately remove the POWERCABS IRELAND LIMITED Driver App from any device in their possession; (iv) the User must return all data, materials, and/or equipment belonging to POWERCABS IRELAND LIMITED; and (v) the User remains bound by obligations intended to survive termination, which will continue to apply after the termination of this Agreement. For details on how personal data is maintained post-termination, please refer to POWERCABS IRELAND LIMITED&rsquo;s Driver&rsquo;s Privacy Notice.</p>

        <h2 id="d-exclusion2" class="fs-4 fw-bold mt-5 mb-3">9. Exclusion from Use</h2>
        <p><strong>9.1</strong> The reliability of Users on the POWERCABS IRELAND LIMITED Platform is crucial. Therefore, POWERCABS IRELAND LIMITED may, at its sole discretion, restrict, suspend, or permanently exclude a User from using its services, either wholly or partially, for any of the following reasons: (i) a proven or suspected material breach of this Agreement; (ii) a proven or suspected breach of these Terms; (iii) failure to comply with Applicable Laws or Road Safety Laws; or (iv) failure to comply with the Fraud Policy, which in POWERCABS IRELAND LIMITED&rsquo;s opinion constitutes a repudiation of these Terms.</p>
        <p><strong>9.2</strong> If POWERCABS IRELAND LIMITED restricts or suspends its services to a User for any of the above reasons, it will provide the affected User (and, where relevant, their Employer) with a written statement (including email) explaining the reasons for the decision at the time of notification.</p>
        <p><strong>9.4</strong> If POWERCABS IRELAND LIMITED decides to terminate its services to a User for any of the above reasons, it will give the affected User (and, where relevant, their Employer) at least thirty (30) days&rsquo; written notice (including email) before the termination takes effect, along with the reasons for the decision.</p>
        <p><strong>9.5</strong> In the event of restriction, suspension, or termination, the affected User or Employer may present their case through POWERCABS IRELAND LIMITED&rsquo;s internal complaint-handling process. POWERCABS IRELAND LIMITED may amend or revoke its decision. If the decision is revoked, POWERCABS IRELAND LIMITED will reinstate the User&rsquo;s access to its services and the Driver App without undue delay and, if requested, provide access to any entitled personal or other data resulting from the use of its services prior to the action.</p>
        <p><strong>9.6</strong> The notice period does not apply if POWERCABS IRELAND LIMITED: (i) is required by law or regulation to terminate its services immediately; (ii) is entitled to terminate under applicable law; (iii) has determined through the Fraud Policy process that the User has repeatedly breached the Fraud Policy or engaged in fraudulent activities; or (iv) can demonstrate that the User has infringed these Terms on multiple occasions. In such cases, the User will be given a written statement (including email) explaining the reasons for the decision without undue delay.</p>
        <p><strong>9.7</strong> Any statement of reasons will detail the specific facts or circumstances, including any third-party notifications, that led to POWERCABS IRELAND LIMITED&rsquo;s decision and the relevant grounds.</p>
        <p><strong>9.8</strong> POWERCABS IRELAND LIMITED is not required to provide a statement of reasons if it is legally or regulatorily prohibited from doing so, or if the User has repeatedly infringed these Terms, leading to termination of all related online intermediation services.</p>

        <h2 id="d-liability" class="fs-4 fw-bold mt-5 mb-3">10. Liability</h2>
        <p><strong>10.1</strong> Nothing in these Terms shall exclude or limit either party&rsquo;s liability for death or personal injury caused by negligence, fraud or fraudulent misrepresentation, or any other matter for which it would be illegal or unlawful to exclude or limit liability.</p>
        <p><strong>10.2</strong> Subject to the above, and to the fullest extent permitted by law, POWERCABS IRELAND LIMITED is not liable for any losses (including direct, indirect, or consequential losses, loss of profit, reputation, interest, penalties, and legal costs on a full indemnity basis) incurred by the User, whether caused by tort (including negligence), breach of contract, or otherwise, even if foreseeable. This includes, but is not limited to: (i) loss of income or revenue; (ii) loss of business; (iii) loss of opportunity, goodwill, or reputation; (iv) loss of profits or contracts (actual or anticipated); (v) loss of anticipated savings; (vi) loss of, damage to, or corruption of data; (vii) waste of management or office time; or (viii) any indirect or consequential loss howsoever caused.</p>
        <p><strong>10.3</strong> If POWERCABS IRELAND LIMITED is found liable to the User for any reason, the sum payable will not exceed &euro;1,000.</p>
        <p><strong>10.4</strong> Neither party will be liable for any failure or delay in performing obligations under these Terms caused by events beyond their control.</p>
        <p><strong>10.5</strong> Both parties must mitigate any loss or damage incurred.</p>
        <p><strong>10.6</strong> The User shall indemnify POWERCABS IRELAND LIMITED against any and all losses arising from the use of the Driver App or any breach of these Terms, including third-party claims related to the provision of transportation services by the User.</p>
        <p><strong>10.7</strong> The User must immediately notify POWERCABS IRELAND LIMITED of any actual or threatened claim under clause 10.6 and provide all relevant information.</p>

        <h2 id="d-data" class="fs-4 fw-bold mt-5 mb-3">11. Data Protection</h2>
        <p>Users acknowledge and accept that personal data will be collected, processed, and used in connection with any intermediation services provided through the Driver App, in accordance with the GDPR and relevant national laws. POWERCABS IRELAND LIMITED&rsquo;s Privacy Notice applies to such processing and is available on the <a class="pc-form-link" href="<?= $assetPath ?>/privacy-policy.php">Privacy Policy</a> page.</p>

        <h2 id="d-complaints" class="fs-4 fw-bold mt-5 mb-3">12. Complaints</h2>
        <p><strong>12.1</strong> POWERCABS IRELAND LIMITED provides an electronic tool on its website for Drivers to submit complaints, which will be handled by its internal complaints team. Only complaints submitted through the prescribed method will be handled.</p>
        <p><strong>12.2</strong> Complaints will be processed and responded to swiftly and effectively, considering the importance and complexity of the issue, with the outcome communicated to the complainant.</p>

        <h2 id="d-final" class="fs-4 fw-bold mt-5 mb-3">13. Final Provisions</h2>
        <p><strong>13.1</strong> These Terms, together with referenced documents, constitute the entire agreement between the parties and supersede all prior agreements. Each party acknowledges not relying on any other agreements not explicitly stated here. Invalid or unenforceable provisions will be replaced with valid provisions that fulfill the intended purpose.</p>
        <p><strong>13.2</strong> The Irish courts have jurisdiction over disputes arising from these Terms. The parties submit to this jurisdiction.</p>
        <p><strong>13.3</strong> These Terms and related non-contractual obligations are governed by Irish law.</p>
        <p><strong>13.4</strong> The User may not assign or transfer rights or obligations under these Terms without prior written consent from POWERCABS IRELAND LIMITED. Any unauthorized attempt is void. POWERCABS IRELAND LIMITED may assign or transfer its rights without restriction. The User agrees to cooperate with any required documentation for such transfers. These Terms bind and benefit the parties and their successors and permitted assigns.</p>
        <p><strong>13.5</strong> POWERCABS IRELAND LIMITED may amend these Terms with at least fifteen (15) working days&rsquo; written notice. The User can terminate the agreement if they do not accept the amendments. Continued use of the Driver App after notification indicates acceptance. Upon termination, the User must cease using the Driver App immediately.</p>
        <p><strong>13.6</strong> The notice period does not apply if POWERCABS IRELAND LIMITED is legally obligated to amend these Terms or if immediate amendments are necessary to address imminent dangers, fraud, malware, spam, data breaches, or cybersecurity risks.</p>
        <p><strong>13.7</strong> POWERCABS IRELAND LIMITED may immediately terminate this Agreement in case of a breach of the Fraud Policy.</p>
        <p><strong>13.8</strong> Following termination, POWERCABS IRELAND LIMITED may withhold any payments arising from fraudulent activities.</p>
        <p><strong>13.9</strong> Notices or communications required under these Terms will be given in writing via email or posted on the Driver App or social media pages. The date of receipt for electronic notices is the transmission date.</p>
        <p><strong>13.10</strong> Failure to enforce any right or provision does not constitute a waiver of future enforcement. Written and signed waivers by authorized representatives are required. Exercise of remedies under these Terms does not prejudice other remedies.</p>
      </div>
    </div>
  </div>
</section>

<script src="<?= $assetPath ?>assets/js/components/terms-conditions.js"></script>

<?php
require __DIR__ . '/components/app-download-banner.php';
require __DIR__ . '/includes/footer.php';
?>
