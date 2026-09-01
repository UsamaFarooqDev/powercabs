# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

The PowerCabs (Irish taxi company) marketing website: plain PHP 8 pages served directly by Apache, Bootstrap 5
from CDN, hand-written CSS/JS. **There is no build step and no framework** — files on disk are what ships. Node
is dev tooling only (Prettier).

## Commands

```bash
# Local dev server -- MUST pass router.php, or every clean URL falls back to the homepage
php -S localhost:8000 router.php     # php is at C:\MAMP\bin\php\php8.3.1

npm install                          # once, for Prettier + @prettier/plugin-php
npx prettier --write .               # format (PHP parsed with the php plugin, phpVersion 8.1)
npx prettier --check .
php -l some-page.php                 # syntax check; there is no test suite
```

## URL routing

Pages are top-level `.php` files at the repo root, served at extension-less URLs (`/ride`, `/about-us`).

- Production: [.htaccess](.htaccess) rewrites `/foo` → `foo.php`, 301-redirects any `/foo.php` request to `/foo`,
  and normalizes `/index.php` → `/`. `ErrorDocument 404 /404.php`.
- Local: [router.php](router.php) replicates that for `php -S`. It is never used in production.
- **Always link to the clean form** (`href="<?= $assetPath ?>/ride"`), never `ride.php`, or you cause a 301 on
  every click and break PJAX.
- Adding a page means: create `page-name.php` at the root, add it to [sitemap.xml](sitemap.xml), and add nav
  entries in [includes/header.php](includes/header.php) (both the link and a matching `data-page="page-name.php"`).

## Page anatomy

Every page follows the same shape (see [ride.php](ride.php) or [contact-us.php](contact-us.php)):

```php
<?php
$pageTitle = ...; $pageDescription = ...; $assetPath = '';   // SEO vars read by header.php
require __DIR__ . '/includes/env.php';                        // only if the page mails or uses Maps
require __DIR__ . '/includes/mailer.php';
// ... POST handling block (see below) ...
require __DIR__ . '/includes/header.php';                     // emits <head>, nav, opens <main>
$heroEyebrow = ...; $heroTitleLight = ...; $heroTitleBold = ...; $heroDescription = ...; $heroBgImage = ...;
require __DIR__ . '/components/shared/inner-hero.php';        // inner pages; homepage has its own hero
require __DIR__ . '/components/<page>/<section>.php';         // one file per visual section
require __DIR__ . '/components/shared/app-download-banner.php';
require __DIR__ . '/includes/footer.php';                     // closes <main>, footer, global scripts
```

Components are `require`d, not called — they read plain variables set by the parent page and defend with
`$var ??= default` so they can also be included standalone. `components/shared/` holds cross-page pieces;
`components/<page-name>/` holds sections used by exactly one page.

[includes/header.php](includes/header.php) derives `$currentPage` from `PHP_SELF` and builds canonical URL,
OpenGraph/Twitter meta and LocalBusiness JSON-LD from `$pageTitle`/`$pageDescription`/`$ogImage`. CSS links are
cache-busted with `?v=<filemtime>`.

## Forms → SMTP email (no database)

There is no DB. Every form POSTs to its own page and emails the result. The pattern, repeated in ~12 root pages:

1. `$formStatus` (`'success'|'error'|null`), `$formError`, and an `$old` array of every field.
2. On `REQUEST_METHOD === 'POST'`: trim all fields into `$old`, validate (required + `FILTER_VALIDATE_EMAIL`),
   call `pc_send_mail($subject, $bodyText, ['name'=>..,'email'=>..], $attachments)`, clear `$old` on success.
3. The component re-renders `$old` values via `htmlspecialchars()` and prints exactly one
   `.alert-success` or `.alert-danger` block.

That alert markup is a **contract**: [assets/js/components/ajax-forms.js](assets/js/components/ajax-forms.js)
intercepts every `form[method="post"]` with an empty/anchor `action`, re-POSTs it via fetch, parses the returned
HTML, and turns `.alert-success` / `.alert-danger` text into a toast. If a form renders neither class, the user
sees a generic error. Opt a form out with `data-no-ajax`.

[includes/mailer.php](includes/mailer.php) is a hand-rolled SMTP-over-SSL client (`AUTH LOGIN`, multipart/mixed,
base64 attachments) — no PHPMailer, no Composer. It returns `['success'=>bool,'error'=>string|null]` and never
throws to the caller.

## Config / secrets

[includes/env.php](includes/env.php) parses a gitignored `.env` at the repo root and defines
`PC_SMTP_HOST`, `PC_SMTP_PORT`, `PC_SMTP_USER`, `PC_SMTP_PASS`, `PC_SMTP_FROM_NAME`, `PC_MAIL_TO`,
`PC_GOOGLE_MAPS_API_KEY`. Missing values default to empty rather than erroring, so a missing `.env` shows up as
forms silently failing to send and Maps not loading. No `.env.example` is committed despite the `.gitignore`
comment.

## Client-side architecture

Global scripts load at the end of [includes/footer.php](includes/footer.php): Bootstrap bundle, `main.js`,
`toast.js`, `ajax-forms.js`, `pjax.js`, `page-loader.js`. Page-specific scripts are `<script src>` tags at the
bottom of the page or component that needs them (e.g. `book-ride-map.js` in `book-ride-online.php`,
`ride-fare-estimate.js` in `components/ride/hero-fare-section.php`).

**PJAX is the constraint that shapes everything else.** [assets/js/components/pjax.js](assets/js/components/pjax.js)
intercepts same-origin link clicks and swaps only `<main>`'s innerHTML, then re-executes scripts inside it and
manually re-runs a fixed list of globals: `highlightActiveNavLink`, `syncFooterHeightVar`, `initHeroParallax`,
`initWhyChooseReveal`, `pcInitAjaxForms`. Consequences for any new code:

- Header, footer, nav and mega-menus live **outside** `<main>` and survive navigation — anything stateful there
  must be reset explicitly (that's why `highlightActiveNavLink` clears old `.active` classes and PJAX closes open
  dropdowns).
- Any init function that attaches a `window`/`document` listener or an `IntersectionObserver` must be
  **idempotent**: store the cleanup/observer in a module-level variable and tear down the previous run first, as
  `initHeroParallax` and `initWhyChooseReveal` in [assets/js/main.js](assets/js/main.js) do. Otherwise listeners
  stack up one per navigation.
- New globals that need re-running after a swap must be added to the call list in `navigate()`.
- The Google Maps SDK is deliberately not re-inserted once `window.google.maps` exists; map scripts self-invoke
  their init instead of relying on the `callback=` parameter, which only fires on first load.
- Opt a link out of PJAX with `data-no-pjax`.

Failures always fall back rather than dead-end: PJAX does a hard `window.location` navigation on any error, and
the page loader force-hides after 8s.

## Styling

Three stylesheets, cascade order matters: [variables.css](assets/css/variables.css) (brand tokens + Bootstrap 5.3
CSS-variable overrides like `--bs-primary`) → [base.css](assets/css/base.css) (element defaults, hidden native
scrollbar) → [components.css](assets/css/components.css) (~2.4k lines, all `pc-`-prefixed component classes).

- Prefix every custom class with `pc-`; theme via the `--pc-*` tokens rather than hard-coded hex.
- Layout is Bootstrap 5 utilities in the markup; only genuinely custom visuals get a `pc-` class.
- `--pc-navbar-h` and `--pc-footer-h` are written from JS on load/resize — use them instead of guessing the
  fixed header's height.
- Prettier config: 120 cols, 2-space indent, single quotes. Existing PHP files mix 2- and 4-space indentation;
  match the file you are editing.

## Conventions

- PHP functions and constants are `pc_` / `PC_` prefixed; JS globals are `pc`-prefixed (`pcToast`,
  `pcInitAjaxForms`).
- Escape every dynamic value with `htmlspecialchars()` on output.
- Comments in this codebase explain *why* a workaround exists (PJAX re-init, Maps single-load, router.php
  arguments). Preserve them when editing nearby code.
