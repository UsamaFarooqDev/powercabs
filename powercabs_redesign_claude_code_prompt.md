# PowerCabs Website Rebrand, UX/UI Redesign & TailwindCSS Modernisation
## Research-backed Claude Code implementation brief

> **Project:** PowerCabs Ireland  
> **Website:** https://www.powercabs.ie/  
> **Primary design references:** https://www.uber.com/ie/en/ and https://www.free-now.com/ie/  
> **Stack constraint:** Keep the existing application/framework and TailwindCSS approach unless there is a strong technical reason not to.  
> **Scope:** Full visual/UX/content-hierarchy redesign across the existing 26+ page ecosystem.  
> **Goal:** Preserve PowerCabs' orange brand identity while moving the website from a generic orange/black corporate template into a premium, contemporary Irish mobility brand.

---

# 1. Executive direction

PowerCabs already has a useful information architecture and a substantial amount of business/service content. The problem is primarily **presentation, hierarchy, repetition and visual system**, not a lack of pages.

The current website communicates the right categories — rides, business, drivers, airport transfers, accessibility, city tours, payments, safety, sustainability and support — but many pages feel like they were built from the same generic page template:

- hero
- short paragraph
- cards
- another orange/black block
- app CTA
- footer

The redesign should stop treating every page as an independent marketing landing page and instead establish a **single PowerCabs design system** with several reusable page archetypes.

The desired result is:

**PowerCabs = Irish, premium, trustworthy, technology-enabled mobility — not "orange taxi website".**

The visual language should take inspiration from the information hierarchy and editorial confidence of modern Uber/FREENOW pages without copying their brand identity, wording, assets, proprietary layouts or visual designs.

---

# 2. Research observations

## 2.1 PowerCabs current site

The current PowerCabs homepage has strong raw material:

- "Your Journey. Smarter. Faster. Premium."
- Book a Ride / Become a Driver / Business Solutions
- partner logos
- service categories
- four benefit pillars
- app download
- live tracking
- secure payments
- repeated booking CTA
- business/driver/safety/contact navigation

The homepage currently contains many useful claims, but the page hierarchy is relatively flat. The content does not always create a strong distinction between:

1. the primary product,
2. the reason to trust PowerCabs,
3. the service portfolio,
4. the business offering,
5. the app experience,
6. supporting information.

The result is that many sections have similar visual weight.

### Important current-site observations

1. **The orange brand colour is doing too much work.**
   Orange should be the action/brand accent, not the background of every important section.

2. **Black/dark sections are overused.**
   Dark sections are useful for contrast, but if too much of the homepage is dark, the website begins to feel visually heavy.

3. **Typography hierarchy is too conservative.**
   The website needs a much clearer relationship between:
   - eyebrow
   - display headline
   - supporting headline
   - body copy
   - metadata
   - CTA
   - labels.

4. **The copy is often too generic.**
   Examples such as "Easy Booking", "Affordable Rates", "Safe and Reliable" are understandable but interchangeable with almost any taxi company.

5. **The site has strong trust assets but does not always present them as premium proof.**
   Partner logos, NTA licensing, driver vetting, app tracking, payments and Irish support should become a deliberate trust system.

6. **The global navigation is information-rich but crowded.**
   It needs clearer grouping and a better distinction between high-value conversion paths and secondary information.

7. **The same app CTA/footer material appears repeatedly across pages.**
   This creates visual and content repetition. A global CTA system should replace duplicated blocks.

8. **Some pages are much longer than their core message requires.**
   The redesign should use editorial composition instead of simply stacking more cards.

9. **The page system needs more visual storytelling.**
   Large photography, app UI, map imagery, route graphics, vehicle photography, people and Dublin context should carry part of the communication.

10. **The site should look like a mobility technology company with an Irish operating footprint.**
    It should not look like a local taxi company's brochure website.

---

# 3. What Uber does well — patterns to learn from

Uber's current pages demonstrate several useful patterns.

## 3.1 Immediate product action

The Uber ride page places the actual ride-request interface prominently:

- pickup
- dropoff
- date/time where applicable
- price/request action

This makes the product itself the hero rather than making users read a marketing paragraph first.

### PowerCabs adaptation

Where technically possible, the homepage should make **Book a Ride** feel like the primary product action.

Recommended structure:

```text
EYEBROW
POWERED BY LOCAL DRIVERS

H1
Your ride, without the hassle.

SUPPORTING COPY
Book a licensed PowerCabs taxi across Dublin — on demand or in advance.

[ Book a ride ] [ Download the app ]

[large booking/map/app visual]
```

If a live booking widget is not available on the website, create a premium booking entry point rather than pretending that a full Uber-style widget exists.

---

## 3.2 Large editorial typography

Uber frequently uses very large headlines followed by compact supporting text.

The important lesson is not "make everything huge."

The lesson is:

**Use large typography selectively to establish hierarchy.**

PowerCabs should have:

- very large hero H1
- medium section headlines
- compact supporting copy
- small labels/eyebrows
- short CTA labels

Example:

```text
01 / THE POWER OF LOCAL

Ride with confidence

Licensed drivers.
Live tracking.
Simple payments.
24/7 support.
```

---

## 3.3 Scenario-led storytelling

Uber often describes situations:

- running late
- airport travel
- going out
- shopping
- exploring
- needing comfort

This is more emotionally useful than simply saying "we provide reliable taxis."

PowerCabs should use a similar structure:

### Morning
**Get to work without the wait.**

### Airport
**Your flight does not wait. Neither should your taxi.**

### Business
**Keep your team moving. Leave the transport admin to us.**

### Accessibility
**Accessible journeys, designed around your needs.**

### Night
**Going home should be the easy part.**

This gives the brand a human narrative.

---

# 4. What FREENOW does well — patterns to learn from

FREENOW is particularly useful because it operates in Ireland and presents itself as a modern mobility technology company.

Its Irish pages use:

- short, confident headlines
- strong image-led sections
- clear service categories
- substantial whitespace
- repeated but strategically placed CTA patterns
- safety storytelling
- business-specific journeys
- app-centric product communication
- FAQs near the end
- distinct rider / driver / business information architecture.

The important principle:

**FREENOW does not make every section orange/red.**

The brand colour is used as an accent and the page has room to breathe.

---

# 5. The new PowerCabs visual strategy

## 5.1 Brand positioning

Do not remove orange.

Instead:

### Primary brand
PowerCabs Orange

### Supporting neutrals
- warm off-white
- white
- soft grey
- charcoal
- near-black

### Optional semantic colours
- green for sustainability / EV
- blue for informational/safety content
- red only for destructive/error states

Orange should be the **signal**, not the entire environment.

---

# 6. Recommended colour system

Do not use one orange variable everywhere.

Create semantic tokens.

```css
--pc-orange: #F97316;
--pc-orange-dark: #D85F0B;
--pc-orange-soft: #FFF4EA;

--pc-ink: #111111;
--pc-ink-soft: #252525;

--pc-white: #FFFFFF;
--pc-surface: #F7F7F5;
--pc-surface-warm: #FBF8F4;

--pc-border: #E7E5E2;
--pc-muted: #6B6B6B;

--pc-success: #17834B;
--pc-info: #2563EB;
```

These are a starting point, not a mandate. Inspect the existing logo/brand assets before finalising the exact orange.

### Colour rule

Aim approximately for:

- 55–65% white/off-white/neutral surfaces
- 20–25% photography/media
- 8–12% charcoal/dark surfaces
- 3–8% orange accent

Do not literally enforce these percentages in every viewport; use them as an overall visual balance.

---

# 7. Font recommendation

## Recommended primary typeface: Inter

Use the Inter variable font if practical.

Why:

- highly readable
- excellent UI numerals
- professional
- modern
- works for long legal/support content
- strong at large display sizes
- works naturally with TailwindCSS
- avoids making the site feel overly "startup".

Do not use an exotic display font for every heading.

### Recommended type hierarchy

```text
Display:
font-weight: 700/750
letter-spacing: -0.04em

H1:
clamp(3.25rem, 7vw, 7rem)

H2:
clamp(2.5rem, 5vw, 5rem)

H3:
clamp(1.5rem, 2.5vw, 2.25rem)

Body large:
1.125rem–1.375rem
line-height: 1.55

Body:
1rem–1.125rem
line-height: 1.6

Eyebrow:
0.75rem–0.875rem
font-weight: 700
letter-spacing: 0.08em
text-transform: uppercase
```

On mobile, do not simply scale everything down proportionally. Preserve the contrast between headline and body.

---

# 8. TailwindCSS design-token direction

Create a central design system instead of scattering arbitrary values.

Example:

```ts
theme: {
  extend: {
    colors: {
      power: {
        orange: 'var(--pc-orange)',
        'orange-dark': 'var(--pc-orange-dark)',
        'orange-soft': 'var(--pc-orange-soft)',
        ink: 'var(--pc-ink)',
        surface: 'var(--pc-surface)',
        border: 'var(--pc-border)',
        muted: 'var(--pc-muted)',
      }
    },
    maxWidth: {
      'content': '1440px',
      'reading': '760px',
    },
    borderRadius: {
      'card': '1.5rem',
      'panel': '2rem',
      'pill': '999px',
    }
  }
}
```

Do not introduce dozens of unrelated design tokens.

---

# 9. Container system

Use a consistent page width.

Recommended:

```text
mobile: 20px side padding
tablet: 32px
desktop: 48px
large desktop: 64px

max-width: approximately 1440px
```

For long-form text:

```text
max-width: 720–800px
```

For full marketing sections:

```text
max-width: 1280–1440px
```

This will immediately make the site feel more editorial and premium.

---

# 10. Navigation redesign

The current navigation exposes a lot of information at once.

Move toward:

```text
POWER CABS

Ride
Drive
Business
Company

[Book a ride]
```

Desktop dropdowns:

### Ride
- Book a ride
- Ride options
- Airport transfers
- City tours
- Accessibility
- Safety
- Download app
- FAQs

### Drive
- Drive with PowerCabs
- Driver benefits
- Ambassador programme
- Partner programme
- Loyalty
- Driver safety
- Driver resources

### Business
- Corporate travel
- Business solutions
- Payment terminals
- Meet & greet
- Partner with us
- Business FAQs

### Company
- About
- Sustainability
- Contact
- Support
- Policies

The top-level navigation should not attempt to expose every page.

---

# 11. Sticky navigation

## Yes — use a sticky header.

Recommended behaviour:

### At top
Transparent/brand-aware header where appropriate.

### After scroll
- white/off-white background
- subtle border
- backdrop blur
- compact height
- small shadow only when needed

Do not make the header enormous.

Desktop:

```text
height: 72–84px
```

Mobile:

```text
height: 64–72px
```

---

# 12. Sticky footer vs sticky CTA

## Do NOT make the entire footer sticky.

A permanent footer attached to the viewport will make a 26+ page site feel cramped and distracting.

Instead:

### Desktop
Use a normal editorial footer.

### Mobile
Use a contextual bottom action bar only where conversion is important.

For example:

```text
[ Book a ride ]       [ Call ]
```

or:

```text
[ Book a ride ]
```

This should appear on ride-focused pages, not legal pages.

Use safe-area padding for iOS.

---

# 13. Button system

Create three primary levels.

### Primary

Orange background:

```text
Book a ride
Get started
Apply now
```

### Secondary

Dark/black or outlined:

```text
Become a driver
Explore business
Learn more
```

### Tertiary

Text + arrow:

```text
Learn more →
View details →
```

Avoid making every button orange.

---

# 14. Card system

Current card-heavy layouts should become more varied.

Do not create:

```text
orange card
orange card
orange card
orange card
```

Instead use:

### Editorial cards
Large image + text.

### Feature cards
White surface + border.

### Dark feature panel
One large dark block containing multiple features.

### Numbered steps
Large number + compact explanation.

### Split panels
50/50 visual and content.

### Horizontal media cards
Useful for service categories.

---

# 15. Hover behaviour

Use hover effects, but keep them premium.

Good:

```css
transform: translateY(-2px);
transition: 180–250ms ease;
```

Image:

```css
transform: scale(1.025);
```

Card border:

```text
neutral → slightly darker/orange
```

Arrow:

```text
translateX(3px)
```

Do not use:

- aggressive 3D
- huge shadows
- bouncing
- glowing orange
- spinning icons
- excessive parallax.

The site should feel like a serious mobility platform.

---

# 16. Motion system

Use subtle motion only.

Recommended:

- 180–300ms UI transitions
- 400–700ms reveal animations
- fade + translateY 12–20px
- stagger cards by 40–70ms
- image scale 1.02–1.04 on hover

Respect:

```css
@media (prefers-reduced-motion: reduce)
```

Disable non-essential motion for reduced-motion users.

---

# 17. Image direction

The biggest visual improvement will come from photography.

Prioritise:

1. real PowerCabs vehicles
2. real drivers
3. Dublin streets
4. airport journeys
5. business passengers
6. accessible vehicles/passengers
7. app screens
8. payment terminal
9. city/tour imagery

Avoid excessive generic stock photography.

Use image compositions where the image itself carries the section.

Example:

```text
[ LARGE IMAGE ]
                 Small eyebrow
                 Large heading
                 Short paragraph
                 CTA
```

instead of:

```text
[icon]
Heading
paragraph
```

repeated 10 times.

---

# 18. Homepage redesign blueprint

The homepage should become a premium product landing page.

## Section 01 — Hero

Use a large Dublin/vehicle/app visual.

```text
POWER CABS / DUBLIN

Your journey,
made simple.

Reliable taxi journeys across Dublin, powered by local drivers and smart technology.

[ Book a ride ] [ Download app ]
```

Optional small proof line:

```text
Licensed drivers • 24/7 support • Live tracking
```

Do not put 5 paragraphs here.

---

## Section 02 — Trust strip

Instead of a giant orange block:

```text
Trusted across Ireland

[partner logos]
```

White background.

Monochrome or low-contrast logos.

---

## Section 03 — Core product statement

Large editorial statement:

```text
More than a taxi.

A better way to move around Dublin.
```

Then a short paragraph.

Use large whitespace.

---

## Section 04 — Ride scenarios

Four large editorial tiles:

```text
Everyday rides
Get there without the hassle.

Airport
Start and finish your journey smoothly.

Business
Keep your team moving.

City tours
See Dublin with a local driver.
```

Each gets a strong image.

---

## Section 05 — Product/app experience

Use a dark or warm-neutral background.

Large phone mockup.

```text
Everything you need,
right in your pocket.

Book.
Track.
Pay.
Ride.
```

Three compact feature points.

---

## Section 06 — Why PowerCabs

Instead of four generic cards:

```text
01
Local by design

02
Licensed & trusted

03
Available 24/7

04
Technology that helps
```

Use a large number and editorial layout.

---

## Section 07 — Dublin coverage

Large map/route visual.

```text
From Dublin Airport
to the city centre
and beyond.

Serving the Greater Dublin Area.
```

CTA:

```text
Check coverage →
```

---

## Section 08 — Business

Dark section.

```text
Move your business forward.

Corporate travel that is easier to book,
manage and account for.

[Explore business]
```

Use dashboard/phone/business imagery.

---

## Section 09 — Safety

Light section.

```text
Safety starts before
the journey begins.

Licensed drivers.
Driver details.
Live trip tracking.
24/7 support.
```

---

## Section 10 — Driver ecosystem

Do not mix driver recruitment into the rider narrative too early.

Use:

```text
Drive with PowerCabs

Make the city your workplace.
Work on your terms.

[Become a driver]
```

Use driver photography.

---

## Section 11 — App CTA

Orange should work well here.

But use orange as a **single strong CTA moment**, not throughout the entire page.

```text
Your next ride is only
a few taps away.

[Google Play] [App Store]
```

---

## Section 12 — FAQ

Accordion.

Keep only the highest-value questions.

Link to the full FAQ page.

---

## Section 13 — Final CTA

Minimal:

```text
Where are you going?

[Book a ride]
```

---

# 19. Homepage section rhythm

Do not use the same background twice in succession.

Recommended rhythm:

```text
Light
Light/image
White
Image
Warm neutral
Dark
White
Image
Orange
White
Dark/light footer
```

The exact order can vary.

The key is **contrast through composition**, not constant colour changes.

---

# 20. Page archetypes

Create these reusable templates.

## Template A — Product/service landing page

Used for:

- Ride
- Meet & Greet
- City Tours
- Wheelchair Accessible Taxis
- Business Solutions
- Corporate Services

Structure:

1. Hero
2. Primary benefit
3. Feature grid
4. How it works
5. Visual story
6. Trust/proof
7. FAQ
8. CTA

---

## Template B — Audience landing page

Used for:

- Drive
- Business
- Partner Programme
- Ambassador Programme
- Loyalty

Structure:

1. Audience-specific hero
2. Primary value proposition
3. Benefits
4. How it works
5. Proof/testimonials
6. CTA
7. FAQ

---

## Template C — Utility/support page

Used for:

- Contact
- Complaint
- Feedback
- Lost Item
- FAQs

Structure:

1. compact hero
2. immediate action
3. form/content
4. supporting information
5. related links

Do not use giant marketing heroes for utility pages.

---

## Template D — Legal/content page

Used for:

- Terms
- Privacy
- GDPR
- Sustainability

Structure:

1. small editorial hero
2. sticky table of contents where useful
3. reading column
4. clear section headings
5. update date
6. related policy links

---

# 21. Page-by-page redesign plan

## 21.1 Home

Goal: premium first impression + ride conversion.

Do not overload with text.

Primary CTA:
**Book a ride**

Secondary:
**Download the app**

---

## 21.2 About

Current content already has a good foundation:

- Irish company
- Dublin roots
- professional drivers
- modern vehicles
- 24/7
- technology

Redesign as a brand story.

Hero:

```text
Built in Dublin.
Driven by people.
Powered by technology.
```

Then:

- company story
- Dublin map
- operating model
- people
- technology
- trust
- final CTA.

Use photography rather than cards.

---

## 21.3 Book Ride Online

This should be treated as a product entry point, not a marketing page.

Priority:

1. booking interface
2. pickup/dropoff
3. ride options
4. help
5. fallback app CTA.

If the existing booking flow is externally hosted/protected, do not redesign the functionality without understanding the integration.

---

## 21.4 Download App

Use two clearly separated journeys:

### Passenger

```text
Book.
Track.
Pay.
Go.
```

### Driver

```text
Drive.
Accept trips.
Track earnings.
Grow.
```

Use phone mockups.

QR codes should be secondary, not the primary visual.

---

## 21.5 Corporate Services

Current content is strong but too form/card oriented.

Redesign:

Hero:

```text
Corporate travel,
without the admin.

One account. One point of contact.
Reliable journeys for your people.
```

Then:

- benefits
- business journey workflow
- airport
- executive
- recurring travel
- reporting
- billing
- registration form
- FAQ.

Use one large business visual.

---

## 21.6 Business Solutions / Payment Terminals

This page currently contains a lot of commercial detail.

Do not show all pricing and features immediately.

Create:

```text
Payment infrastructure
for drivers and local businesses.
```

Then:

- terminal comparison
- pricing
- feature matrix
- process
- proof
- application form.

Use clear product cards.

Important:
Do not invent financial claims. Preserve verified claims only.

---

## 21.7 Wheelchair Accessible Taxis

Treat accessibility as a premium service, not an "extra feature."

Hero:

```text
Accessible journeys,
without compromise.
```

Use real accessibility imagery if available.

Sections:

- vehicle/accessibility features
- booking process
- driver support
- passenger guidance
- contact
- FAQ.

Avoid pity-oriented imagery or language.

---

## 21.8 Meet & Greet

This should be a premium airport service page.

Hero:

```text
Land.
Collect your bags.
We’ll take it from there.
```

Then:

1. flight monitoring
2. pickup
3. meet & greet
4. luggage
5. airport coverage
6. booking flow
7. business use
8. FAQ.

Use large airport photography.

---

## 21.9 City Tours

Make this feel like a Dublin travel experience.

Hero:

```text
See Dublin
with someone who knows it.
```

Use large Dublin photography.

Then:

- tour styles
- landmarks
- private tours
- day trips
- local driver
- booking CTA.

---

## 21.10 Ambassador Programme

Audience-specific recruitment page.

Hero:

```text
More than a driver.
Become part of PowerCabs.
```

Then:

- programme benefits
- eligibility
- process
- rewards/perks
- application CTA.

---

## 21.11 Partner Programme

Position as B2B partnership.

Hero:

```text
Put your business
in motion.
```

Then:

- who can partner
- benefits
- network
- exposure
- process
- form.

---

## 21.12 Loyalty Programme

This should feel like a product programme.

Use:

```text
Every ride can take you further.
```

Then:

- how points/rewards work
- benefits
- eligibility
- redemption
- FAQ.

Use a progress/points visual if functionality supports it.

---

## 21.13 Driver Safety

Do not make this a generic text wall.

Use:

```text
Safety for the people
behind the wheel.
```

Then visual safety modules:

- passenger verification
- emergency support
- safe pickup
- reporting
- fatigue awareness
- vehicle standards.

---

## 21.14 Rider Safety

Hero:

```text
Feel confident
from pickup to drop-off.
```

Use safety UI examples.

Include:

- driver details
- live tracking
- support
- sharing journey
- reporting
- lost item
- emergency guidance.

---

## 21.15 Drive

This should be one of the strongest recruitment pages.

Hero:

```text
Drive your way.
Build your day.
```

Then:

- earning model
- flexibility
- passenger demand
- driver app
- onboarding
- documents
- benefits
- testimonials
- FAQ
- apply CTA.

Use real drivers.

Do not promise earnings unless the claim is verified and legally/commercially approved.

---

## 21.16 Ride

This should be the consumer product overview.

Hero:

```text
Your ride.
Your way.
```

Then:

- everyday rides
- airport
- accessibility
- scheduled/prebooked journeys
- payment
- tracking
- safety
- app.

---

## 21.17 Business

Business should become the umbrella page for corporate mobility.

Hero:

```text
Move your people.
Not your paperwork.
```

Then:

- employee travel
- guest/client travel
- airport transfers
- account management
- billing
- reporting
- support
- CTA.

---

## 21.18 Contact

Do not use a giant marketing page.

Use:

```text
How can we help?
```

Immediately show:

- phone
- WhatsApp
- email
- address
- opening/support information
- contact form
- emergency/support guidance.

---

## 21.19 Complaint

This is a sensitive utility flow.

Keep it calm.

```text
Tell us what happened.
```

Then:

- clear form
- expected response
- privacy notice
- reference number after submission.

Do not add unnecessary animation.

---

## 21.20 Positive Feedback

Make it warmer.

```text
Had a great ride?
Tell us about it.
```

Short form.

---

## 21.21 Lost Item

This is a high-intent utility page.

Hero:

```text
Left something behind?
Let's help you find it.
```

Then immediate form/action.

Show:

- trip details
- item description
- contact information
- what happens next.

---

## 21.22 FAQs

Current FAQ content is useful.

Improve by adding:

- tabs or segmented control
- Passenger
- Driver
- Business

Use accordions.

Do not display every answer expanded.

---

## 21.23 Sustainability

Current sustainability page is text-heavy.

Create:

```text
Moving Dublin forward,
with a lighter footprint.
```

Then:

- paperless operations
- website efficiency
- green hosting
- EV/hybrid strategy if verified
- operational improvements
- measurable commitments.

Only publish claims that can be substantiated.

---

## 21.24 Privacy

Do not force a marketing design onto legal content.

Use:

- narrow reading width
- strong typography
- sticky TOC desktop
- compact mobile TOC
- last updated date
- clear section anchors.

---

## 21.25 Terms

Same legal template.

Avoid giant hero photography.

---

## 21.26 GDPR / related policy pages

Use the same legal template.

---

# 22. Footer redesign

Current footer repeats too many headings.

Create a cleaner mega-footer.

Example:

```text
POWER CABS
Move better around Dublin.

[Book a ride]
[Download the app]

Ride
- Book a ride
- Ride
- Airport transfers
- City tours
- Accessibility
- Safety

Drive
- Drive with us
- Driver benefits
- Ambassador
- Partner
- Loyalty

Business
- Corporate travel
- Business solutions
- Meet & greet
- Partner with us

Company
- About
- Sustainability
- Contact
- FAQs

Legal
- Privacy
- Terms
- GDPR
```

Bottom row:

```text
© PowerCabs Ireland Limited
NTA licence...
Privacy | Terms | GDPR
```

Do not repeat "Get Started" twice.

---

# 23. Mobile design

Do not treat mobile as a smaller desktop.

Mobile priorities:

1. Book a ride
2. Call/contact
3. Download app
4. clear navigation
5. large readable typography
6. short sections
7. swipeable media only where genuinely useful.

Mobile sticky CTA can be:

```text
[ Book a ride ]
```

with safe-area bottom padding.

Do not make it cover content.

---

# 24. Accessibility

The redesign must improve accessibility.

Requirements:

- WCAG-conscious contrast
- visible focus states
- keyboard navigation
- semantic headings
- proper labels
- accessible accordions
- accessible mobile menu
- alt text
- reduced-motion support
- minimum comfortable touch targets
- do not communicate meaning by colour alone.

Orange text on white must pass contrast requirements before use.

---

# 25. SEO

Do not redesign the site by changing URLs unnecessarily.

Preserve existing URLs unless there is a clear reason to migrate.

Every page should have:

- unique title
- unique meta description
- one H1
- logical H2/H3 hierarchy
- canonical URL
- Open Graph image
- descriptive image alt text
- internal links
- relevant structured data where appropriate.

Service pages should not become generic "Taxi Dublin" keyword pages.

Keep copy natural and user-focused.

---

# 26. Content strategy

The new site needs fewer words above the fold and better words below it.

### Bad pattern

```text
We provide reliable, affordable and safe taxi services...
```

### Better pattern

```text
A licensed driver,
ready when you are.
```

Then explain the details below.

Use:

- short sentences
- strong verbs
- concrete proof
- human scenarios
- fewer buzzwords
- fewer adjectives
- more evidence.

---

# 27. Copy hierarchy rules

For each marketing section:

```text
Eyebrow
4–7 words

H2
3–8 words

Body
1–3 short sentences

CTA
2–4 words
```

Avoid paragraphs of 80–150 words in promotional sections.

Legal/support pages are the exception.

---

# 28. Visual hierarchy rules

Every section should have one dominant element.

Dominant element can be:

- headline
- photograph
- app UI
- statistic
- map
- product card
- form.

Never let:

```text
headline + image + 4 cards + logo strip + CTA
```

all have equal visual weight.

---

# 29. Metrics/statistics

If PowerCabs has verified statistics, make them visual.

Examples:

```text
24/7
Support

100+
Drivers

Dublin
Coverage

NTA
Licensed
```

Only use real current values.

Do not invent numbers.

---

# 30. Testimonials

Testimonials should not be repeated three times by the same component.

The current payment page appears to repeat testimonial content in the rendered page. Audit the implementation for duplicated carousel loops/rendering.

Use:

```text
quote
person
role
location
```

and only rotate when there are enough distinct verified testimonials.

---

# 31. Design details that will make the site feel modern

Use:

### Large radius
20–32px for major cards/panels.

### Small radius
10–14px for controls.

### Pills
Only for tags, statuses and compact navigation.

### Borders
Prefer subtle 1px borders over heavy shadows.

### Shadows
Very restrained.

### Full-bleed media
Use on major sections.

### Asymmetry
Allow images to break grids occasionally.

### Oversized numbers
For processes.

### Negative space
Increase section padding substantially.

Suggested desktop section spacing:

```text
py-24 to py-40
```

Hero:

```text
min-height: 680–820px
```

Do not make every section 800px tall.

---

# 32. Dark sections

Use dark charcoal strategically.

Recommended:

- business
- app/product
- final CTA
- occasional feature section

Do NOT use black on:

- every hero
- every card
- every footer block
- every service section.

Dark should create contrast.

---

# 33. Orange sections

Orange should be used for:

- primary CTA panels
- selected brand moments
- booking emphasis
- app CTA
- small accents

Avoid:

```text
orange hero
orange cards
orange icons
orange headings
orange footer
orange buttons
```

all on the same page.

That is the current "too orangish" problem the redesign must solve.

---

# 34. Iconography

Use one icon family.

Recommended:
Lucide icons or the existing icon system if already established.

Do not mix:

- Font Awesome
- custom SVG
- random emoji
- outline icons
- filled icons

without a reason.

Icons should support content, not become decoration everywhere.

---

# 35. Forms

Forms should feel like products.

Use:

- grouped fields
- clear labels
- helper text
- validation
- error states
- loading states
- success states
- mobile-friendly controls.

For long forms, group into steps where appropriate.

---

# 36. Booking experience

The booking experience is the highest-priority product interaction.

Audit:

- loading
- route selection
- pickup
- destination
- date/time
- ride type
- pricing
- confirmation
- mobile behaviour
- error states.

Do not visually redesign only the landing page while leaving the booking experience inconsistent.

---

# 37. Component architecture

Create reusable components rather than page-specific HTML duplication.

Suggested components:

```text
SiteHeader
DesktopNav
MobileNav
MegaMenu
PrimaryButton
SecondaryButton
TextLink
SectionEyebrow
SectionHeading
Hero
HeroMedia
TrustStrip
LogoCloud
FeatureGrid
FeatureCard
EditorialSplit
ImageTextSection
DarkFeaturePanel
OrangeCta
AppDownloadPanel
AppStoreButtons
PhoneMockup
StatsRow
Steps
NumberedSteps
ServiceCard
ServiceGrid
Testimonial
TestimonialCarousel
FaqAccordion
FaqSection
ContactCard
FormField
FormSection
StickyMobileCta
SiteFooter
LegalLayout
TableOfContents
Breadcrumbs
```

Avoid a component explosion. Create components where there is a real pattern.

---

# 38. Page data architecture

If the framework supports it, page content should be data-driven.

For example:

```ts
const servicePages = {
  airport: {
    eyebrow: 'AIRPORT TRANSFERS',
    title: 'Land. Collect your bags. We’ll take it from there.',
    ...
  }
}
```

This makes the 26+ page redesign maintainable.

---

# 39. Tailwind implementation rules

Use Tailwind utility classes for composition.

Use CSS variables for design tokens.

Avoid excessive arbitrary values such as:

```text
mt-[37px]
px-[53px]
text-[67px]
```

unless they are genuinely necessary.

Prefer systemised values.

Do not create huge global CSS overrides that fight Tailwind.

---

# 40. Responsive typography

Use fluid sizing.

Example:

```html
<h1 class="text-[clamp(3.25rem,7vw,7rem)] ...">
```

But keep readable line lengths.

Hero headline:

```text
max-width: 9–12 words
```

Body:

```text
max-width: 60–75 characters
```

---

# 41. Performance

The redesign must not make the site slower.

Priorities:

- WebP/AVIF
- responsive images
- lazy loading below the fold
- preload only critical hero media/fonts
- font-display: swap
- avoid huge video backgrounds
- avoid unnecessary animation libraries
- code split interactive components
- minimise third-party scripts
- use SVG where appropriate
- avoid shipping duplicate icon libraries.

The sustainability page itself currently emphasises performance, so the redesign should live up to that promise.

---

# 42. Animation implementation

Prefer CSS transitions and lightweight IntersectionObserver/reveal utilities.

Do not add a heavy animation dependency unless the project already uses one or the experience genuinely needs it.

Suggested animation utility:

```text
data-reveal
```

States:

```text
opacity: 0
transform: translateY(16px)
```

to:

```text
opacity: 1
transform: translateY(0)
```

Respect reduced motion.

---

# 43. SEO/content migration rule

Do not delete existing useful copy simply because it is visually dense.

Instead:

1. preserve factual meaning
2. rewrite for clarity
3. move details below the hero
4. use accordions where appropriate
5. convert repetitive paragraphs into feature blocks
6. keep important SEO context
7. preserve internal links.

---

# 44. Do not copy Uber or FREENOW literally

Use their **design principles**, not their brand assets.

Do not copy:

- exact layouts
- exact copy
- logos
- proprietary illustrations
- proprietary photographs
- distinctive branded graphics
- code
- hidden implementation details.

We are creating a PowerCabs identity influenced by modern mobility UX patterns.

---

# 45. Suggested new design language

## Brand personality

```text
Confident
Local
Modern
Human
Reliable
Premium
Straightforward
```

Avoid:

```text
Flashy
Overly playful
Corporate-cold
Generic taxi
Overly technical
Orange-heavy
```

---

# 46. Visual composition examples

## Pattern A

```text
┌───────────────────────────────────────────┐
│                                           │
│  SMALL EYEBROW                             │
│                                           │
│  Large headline                           │
│  with a strong second line.               │
│                                           │
│  Short supporting text.                   │
│                                           │
│  [Primary CTA] [Secondary CTA]            │
│                                           │
│                         LARGE IMAGE        │
│                                           │
└───────────────────────────────────────────┘
```

## Pattern B

```text
┌───────────────────┬───────────────────────┐
│                   │                       │
│  LARGE IMAGE      │  EYEBROW              │
│                   │  Heading               │
│                   │  Short copy            │
│                   │  Learn more →          │
│                   │                       │
└───────────────────┴───────────────────────┘
```

## Pattern C

```text
┌───────────────────────────────────────────┐
│ DARK                                       │
│                                           │
│ Move your business forward.               │
│                                           │
│ ┌─────────┐ ┌─────────┐ ┌─────────┐      │
│ │ 01      │ │ 02      │ │ 03      │      │
│ │ Billing │ │ Control │ │ Safety  │      │
│ └─────────┘ └─────────┘ └─────────┘      │
└───────────────────────────────────────────┘
```

---

# 47. Information architecture recommendation

Keep the existing URL ecosystem as much as possible.

Recommended top navigation:

```text
Ride
Drive
Business
Company
[Book a ride]
```

Footer carries:

```text
Support
Safety
Policies
Partner
Accessibility
Sustainability
Contact
```

This makes the site easier to understand without deleting the existing pages.

---

# 48. Migration strategy

Do not attempt a dangerous "replace everything at once" deployment.

Recommended implementation phases.

## Phase 1 — Design system

Build:

- tokens
- typography
- buttons
- cards
- header
- footer
- spacing
- motion
- forms
- responsive utilities.

## Phase 2 — Homepage

Build and test the homepage.

## Phase 3 — Core commercial pages

- Ride
- Drive
- Business
- Corporate Services
- Meet & Greet
- City Tours
- Accessibility

## Phase 4 — Programmes

- Ambassador
- Partner
- Loyalty
- Business Solutions

## Phase 5 — Trust/support

- Safety
- FAQs
- Contact
- Lost Item
- Feedback
- Complaint

## Phase 6 — Company/legal

- About
- Sustainability
- Privacy
- Terms
- GDPR

---

# 49. Claude Code operating instructions

## First: inspect before editing

Before changing files:

1. inspect the complete project structure
2. identify framework/version
3. inspect Tailwind configuration
4. inspect global CSS
5. inspect layout/root components
6. inspect header/navigation
7. inspect footer
8. inspect reusable components
9. inspect routing
10. inspect all 26+ page files
11. inspect image/font assets
12. inspect package.json
13. identify existing animation libraries
14. identify current SEO implementation
15. identify forms and API endpoints
16. identify booking integrations
17. identify analytics/third-party scripts.

Do not immediately overwrite components.

---

# 50. Claude Code must preserve functionality

The redesign is primarily visual/UX unless a functional improvement is clearly required.

Do NOT accidentally break:

- booking
- app store links
- WhatsApp
- forms
- driver applications
- corporate applications
- payment-terminal applications
- FAQ behaviour
- navigation
- legal links
- tracking
- analytics
- SEO
- structured data
- external integrations.

If a route is protected or externally hosted, keep its functionality intact.

---

# 51. Audit existing code for duplication

Look for:

- repeated footer
- repeated app CTA
- repeated button markup
- repeated card components
- repeated hero sections
- repeated page containers
- duplicated testimonials
- duplicated navigation structures.

Consolidate where safe.

---

# 52. Important current-site issue: duplicated visual/content patterns

The PowerCabs site currently repeats the app-download/footer structure across many pages.

Do not simply delete it.

Create one reusable:

```text
AppDownloadSection
```

and configure variants:

```text
light
dark
orange
compact
```

Then choose the variant per page.

This will make the site feel intentionally designed rather than duplicated.

---

# 53. Page-specific CTA hierarchy

Every page needs one primary conversion.

Examples:

| Page | Primary CTA |
|---|---|
| Home | Book a ride |
| Ride | Book a ride |
| Drive | Apply to drive |
| Business | Get started |
| Corporate | Open a corporate account |
| Meet & Greet | Book airport transfer |
| City Tours | Plan your tour |
| Accessibility | Book accessible taxi |
| Payment | Apply now |
| Download | Download app |
| Contact | Contact support |
| Lost item | Report lost item |
| Complaint | Submit complaint |
| Feedback | Leave feedback |
| FAQ | Find an answer |

Do not give five CTAs equal visual priority.

---

# 54. Footer CTA

Use a strong final CTA immediately before the footer.

For rider pages:

```text
Ready to go?

[Book a ride]
```

For driver pages:

```text
Ready to get on the road?

[Apply to drive]
```

For business pages:

```text
Ready to simplify business travel?

[Get started]
```

For support pages:

```text
Still need help?

[Contact us]
```

---

# 55. Empty space is intentional

Do not fill every empty area.

The current site needs more breathing room.

Large whitespace is one of the easiest ways to move the visual language from:

```text
generic business website
```

to:

```text
premium technology/mobility brand.
```

---

# 56. Avoid design trends that will age badly

Do not use:

- excessive glassmorphism
- neon gradients
- excessive blobs
- 3D floating icons
- giant animated cursors
- noisy grain overlays everywhere
- excessive rounded pills
- artificial dashboard screenshots
- unnecessary horizontal scrolling
- excessive black/orange contrast.

The redesign should still look credible in 3–5 years.

---

# 57. Testing checklist

Before finalising:

## Desktop

Test:
- 1440px
- 1280px
- 1024px

## Tablet

Test:
- 768px
- 834px

## Mobile

Test:
- 390px
- 375px
- 360px

Check:

- header
- menu
- hero
- typography
- cards
- forms
- buttons
- images
- app store buttons
- sticky CTA
- footer
- accordions
- tables
- legal content.

---

# 58. Visual QA checklist

For every page ask:

1. Is there one clear H1?
2. Is the primary CTA obvious?
3. Is the hero too text-heavy?
4. Is orange being overused?
5. Is black being overused?
6. Is there enough whitespace?
7. Is the content hierarchy obvious?
8. Does the page have a visual story?
9. Are cards necessary?
10. Is the CTA repeated too many times?
11. Is there enough contrast?
12. Does mobile feel intentional?
13. Does the footer feel like a footer rather than another page section?
14. Does the page feel like PowerCabs rather than a generic taxi site?

---

# 59. Final visual acceptance criteria

The redesigned site should make the following impression within the first 5 seconds:

> "This is a serious, modern Irish mobility company."

It should NOT make the impression:

> "This is an orange taxi template."

The brand orange should be immediately recognisable, but the page should remain mostly neutral and premium.

---

# 60. Final Claude Code instruction

Implement the redesign as a **cohesive design system**, not as 26 individually improvised pages.

Start by auditing the current project.

Then:

1. create the design tokens
2. update typography
3. redesign global header
4. redesign footer
5. create reusable section components
6. create reusable page archetypes
7. redesign homepage
8. redesign core rider pages
9. redesign driver pages
10. redesign business pages
11. redesign programmes
12. redesign support pages
13. redesign legal/company pages
14. preserve all existing functionality
15. verify every existing route
16. verify mobile
17. verify accessibility
18. verify SEO
19. verify performance
20. remove redundant styling/components only after confirming they are unused.

Do not stop after redesigning the homepage.

The objective is a **full visual language migration across the entire PowerCabs website**.

---

# 61. Specific design decision: should the font change?

**Yes, change it if the current font is generic or inconsistent.**

Use Inter as the primary family.

Example:

```css
font-family:
  Inter,
  ui-sans-serif,
  system-ui,
  -apple-system,
  BlinkMacSystemFont,
  "Segoe UI",
  sans-serif;
```

Use a variable font where possible.

Do not use 3–4 font families.

One excellent family with strong weights is enough.

---

# 62. Specific design decision: should the website remain orange?

**Yes, but orange should become an accent rather than the dominant background colour.**

Use orange for:

- primary buttons
- selected navigation
- key CTA panels
- active states
- small labels
- highlights
- important brand moments.

Use white/off-white for most content.

Use charcoal for a small number of high-impact sections.

Use photography to introduce colour and emotion.

---

# 63. Specific design decision: should hover effects be added?

**Yes.**

Use:

- card lift 2–4px
- image scale 1.02–1.04
- arrow movement
- subtle border transition
- button colour/contrast transition.

Keep transitions under approximately 300ms.

No gimmicky animation.

---

# 64. Specific design decision: should the footer be sticky?

**No.**

Use:

- normal footer
- sticky header
- optional mobile contextual CTA.

This gives the site a premium, unobstructed reading experience.

---

# 65. Specific design decision: should every section have a card?

**No.**

Use a mix of:

- editorial sections
- split image/text
- full-width imagery
- typography-only sections
- statistics
- cards
- maps
- app mockups
- accordions
- forms.

This is one of the most important changes.

---

# 66. Specific design decision: should every page have the same hero?

**No.**

Create 4–5 hero compositions:

### Hero A
Image right / text left.

### Hero B
Full-bleed image with text overlay.

### Hero C
Dark product hero.

### Hero D
Minimal utility hero.

### Hero E
App/product hero with phone mockup.

All should share typography and spacing so the site remains coherent.

---

# 67. Specific design decision: should content be reduced?

Not simply reduced.

**Recomposed.**

The objective is:

```text
Less text above the fold
+
Better headlines
+
Better imagery
+
More scannable detail
+
More evidence
```

Do not remove useful information just to make the website look minimal.

---

# 68. Reference principles

### PowerCabs
Use as the source of truth for:
- services
- company claims
- contact details
- business offerings
- driver offerings
- policies
- actual functionality.

### FREENOW
Study for:
- information architecture
- mobility storytelling
- service categorisation
- large typography
- image-led sections
- safety presentation
- business/driver segmentation.

### Uber
Study for:
- product-first hierarchy
- strong CTAs
- scenario-based content
- large display typography
- simple visual composition
- ride/driver/business separation.

Do not clone either site.

---

# 69. Deliverables expected from Claude Code

At the end of the implementation, provide:

## A. Design system summary

- typography
- colours
- spacing
- radii
- shadows
- buttons
- motion
- containers.

## B. Component inventory

List all reusable components created/updated.

## C. Page inventory

For every PowerCabs route:

```text
route
template
primary CTA
secondary CTA
major visual sections
status
```

## D. Technical changes

List:

- files changed
- files added
- files removed
- dependencies changed
- Tailwind changes
- routing changes.

## E. QA

Report:

- desktop tested
- tablet tested
- mobile tested
- accessibility checked
- SEO checked
- performance considerations
- broken links found
- issues remaining.

---

# 70. Final instruction to Claude Code

**Do not interpret this prompt as permission to merely recolour the existing site.**

This is a structural redesign.

The current PowerCabs website already contains the business information. Your job is to transform the presentation into a modern mobility platform.

The design target is:

```text
PowerCabs
=
Irish trust
+
modern mobility technology
+
premium editorial design
+
clear product UX
+
restrained orange branding
+
strong typography
+
excellent whitespace
+
human photography
+
simple conversion paths
```

The final site should feel:

**modern, premium, confident, Irish, trustworthy, technology-led and easy to use.**

It should retain PowerCabs' corporate credibility while adopting the stronger visual hierarchy and product storytelling found in contemporary mobility brands.

Do the redesign consistently across the full 26+ page ecosystem.

Do not stop at the homepage.

Do not break existing functionality.

Do not invent unsupported business claims.

Do not copy Uber/FREENOW branding.

Build a PowerCabs design system that can scale.

---

# Appendix A — Research notes from the live sites

## PowerCabs

The live PowerCabs homepage currently presents the main ride, driver and business paths, partner logos, service categories, four core benefits, app download and support/contact information. The current information architecture contains the right breadth, but many sections use a similar visual treatment and the global footer/app content repeats across pages.

The corporate page already has useful product-level content such as account management, dedicated support, transparent billing, reliable drivers and scheduled rides. These should be retained but visually reorganised.

The payment solutions page has useful product, pricing and application content but is information-dense and should be reorganised around product comparison and conversion.

The About page already has strong brand-positioning material around Dublin roots, NTA licensing, local drivers and technology.

## FREENOW

The Irish FREENOW ride page demonstrates a strong pattern of:
- large headline
- short supporting statement
- image
- service categories
- benefit-led editorial sections
- payment
- European coverage
- business cross-sell
- FAQ.

Its taxi page uses scenario/service blocks for taxi, XL, accessible and priority options, then moves into prebooking, payments, tracking, safety, European coverage and business travel.

Its business pages demonstrate a useful pattern of leading with a business outcome, then showing feature benefits, proof, workflow and FAQ.

Its driver page leads with the driver's outcome and then breaks the value proposition into earnings, bonuses, passenger demand and flexibility.

## Uber

Uber's ride pages demonstrate a product-first approach with prominent ride-request fields and simple task-oriented content.

Uber also uses scenario-led editorial sections to explain why people use the service, rather than describing the service only in generic feature language.

---

# Appendix B — Important implementation philosophy

When choosing between two valid design approaches, prefer the one that:

1. reduces visual noise,
2. improves hierarchy,
3. improves conversion clarity,
4. uses fewer colours,
5. uses stronger typography,
6. creates more breathing room,
7. uses imagery more intentionally,
8. reduces component duplication,
9. preserves accessibility,
10. remains easy to maintain in TailwindCSS.

**Premium does not mean more decoration.**

For PowerCabs, premium should mean:

**clarity + restraint + confidence + quality execution.**
