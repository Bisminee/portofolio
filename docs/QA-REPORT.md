# QA report — what was actually run

Date: 30 October 2026
Environment: Windows, PHP 8.3.30, Composer 2.9.5, Laravel 12.70.2, Filament 4.16.0, SQLite.

## Automated checks

### PHPUnit

Command: `php artisan test`

Result: **10 passed, 56 assertions**, 0 failures.

Coverage of:

- Home page returns 200 and shows the name, title, all major sections, Beyond Code, and the empty-panel message.
- All five seeded case files are published and their repository URLs appear.
- Beyond Code table is empty after seeding; no `.beyond-card` or `.beyond-grid` is rendered.
- A temporary Beyond Code row renders correctly (proves the future data path works) — not seeded in production.
- The Sera-Z case shows **In progress** and no longer contains the stale "not started" claim.
- Unpublished projects are hidden.
- Custom 404 page returns 404 and shows the intended copy.
- Static export writes `index.html`, `404.html`, assets, and the correct canonical URL.
- `/studio` redirects unauthenticated visitors to the login page.
- A seeded admin can open the Filament dashboard.

### Static deployment

Command:

```bash
php artisan portfolio:export --base-url=https://bisminee.github.io/portofolio/
```

Then pushed to `main`; the Pages workflow completed successfully.

Live verification:

- `https://bisminee.github.io/portofolio/` — **200**, correct title, CSS and fonts applied.
- `https://bisminee.github.io/portofolio/css/portfolio.css` — **200**, `text/css`.
- `https://bisminee.github.io/portofolio/images/og-cover.png` — **200**, `image/png`.
- `https://bisminee.github.io/portofolio/does-not-exist` — **404** with the custom page.
- Canonical URL: `https://bisminee.github.io/portofolio/`.
- Live axe audit: **0 violations**.
- Live Chrome test: **0 console errors**, **0 failed requests**, no horizontal overflow at 1440 px or 390 px.
- Mobile “Beyond Code” anchor lands at **84 px** with the menu closed.

### Code style

Command: `vendor/bin/pint --test`

Result: **passed** (`{"tool":"pint","result":"passed"}`) after one formatting pass.

### Dependency audit

Command: `composer audit`

Result: **No security vulnerability advisories found** after upgrading Filament from 4.0.0 to 4.16.0. The earlier 4.0.0 install had 12 advisories across 4 packages, including two high-severity MFA issues. Because this site does not enable Filament MFA, the practical exposure was limited, but the dependency was upgraded anyway.

### Production caches

Commands:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

Result: all caches built without errors (views compiled in ~17 s), then cleared with `php artisan optimize:clear` for local development.

## Browser checks

Tooling: headless Chrome (Puppeteer) at 1440×1000, 820×1100, and 390×844 (2× DPR).

| Check | Result |
| --- | --- |
| Console errors | 0 |
| Page errors | 0 |
| Failed network requests | 0 |
| Horizontal overflow at 1440 px | None (scrollWidth 1440) |
| Horizontal overflow at 820 px | None (scrollWidth 820) |
| Horizontal overflow at 390 px | None (scrollWidth 390) |
| All in-page anchors resolve | 6/6 |
| Desktop anchor lands below sticky nav | Section top 114 px |
| Mobile menu opens, locks scroll, updates `aria-expanded` | Pass |
| Mobile menu closes on link, unlocks scroll | Pass |
| Mobile anchor lands below header | Section top 84 px |
| External links (GitHub + release APK) | 8/8 returned HTTP 200 |
| Images loaded | 6/6 after scrolling each section |
| Beyond Code empty state | 0 rendered skill cards |
| Beyond Code no invented content | Pass (database count 0) |
| Featured case artwork when expanded | Stays 4:3 (489 px tall) beside 1,431 px of case content |

### Filament studio smoke test

Logged in as the local seeded account and checked:

- `/studio` dashboard — 200, no console errors.
- `/studio/projects` — 5 rows, team/coursework badges, featured/live indicators.
- `/studio/projects/1/edit` — all sections rendered; existing repeater items hydrated correctly.
- `/studio/beyond-skills` — empty table with “No beyond skills”.
- `/studio/beyond-skills/create` — all future fields present (name, category, description, icon, order, visibility).

No Beyond Code record was created during testing.

### Accessibility

Tool: axe-core 4.x, WCAG 2.0/2.1 A and AA rule set, run on the full desktop page.

Result: **0 violations** after fixing two findings:

1. `aria-label` on the decorative ticker container (`aria-prohibited-attr`) — replaced with `aria-hidden="true"`.
2. Accessible-name mismatch on the brand link (`label-content-name-mismatch`) — removed the redundant `aria-label`.

Additional manual checks:

- Skip-to-content link present and focusable.
- Semantic landmarks: `header`, `nav`, `main`, `section` with accessible names, `footer`.
- One `h1`; section `h2`s in order; project `h3`s.
- All illustrations have descriptive alt text that states they are not screenshots.
- Keyboard: menu toggle, links, and native `<details>` case files operable; Escape closes the mobile menu.
- `prefers-reduced-motion` disables the ticker and transitions and forces non-animated anchor scrolling.
- Focus-visible outline uses antique gold with a 3 px offset.
- Text contrast uses bone `#F0E6D2` on obsidian/charcoal and gold `#B99A63` for secondary labels; red is not used for small body text on dark backgrounds.

## Responsive review

Screenshots were captured and inspected at:

- Desktop 1440 px: hero, about, projects, skills, Beyond Code, journey, contact, an opened case file.
- Tablet 820 px: full page and Beyond Code.
- Mobile 390 px: hero, open navigation, Beyond Code, contact, full page.

Fixes made during review:

- Featured case artwork no longer stretches when the case file is expanded; it stays a 4:3 plate and becomes sticky on desktop.
- Mobile anchor navigation now unlocks body scroll before scrolling, landing the section below the header.
- Mobile navigation now occupies the full viewport below the header.
- Timeline period column widened so “2024–2025” and “Oct 2026” do not wrap.
- About drop-cap changed to a legible “M” instead of a red “I” bar.

## Not tested / not claimed

- No Docker build was executed locally (Docker is not installed in this environment). The Dockerfile is optional for self-hosting or a paid Docker host.
- No real mobile device or Safari test.
- No automated visual-regression baseline.
- No load/performance budget test beyond local asset sizes.

## Final command results

| Command | Result |
| --- | --- |
| `php artisan test` | 10 passed, 56 assertions |
| `vendor/bin/pint --test` | passed |
| `composer audit` | no advisories |
| `php artisan optimize` | config, routes, views, events, Blade icons, Filament cached |
| `php artisan portfolio:export` | 21 files, 334 KB |
| GitHub Actions Pages deploy | success |
| Live site | 200; CSS, images, custom 404 verified |
| Headless Chrome QA | 0 console errors, 0 axe violations, 0 broken links |
| SQLite state after tests | 5 projects, 0 Beyond Code entries |

