# QA report — what was actually run

Date: 5 November 2026
Environment: Windows, PHP 8.3.30, Composer 2.9.5, Laravel 12.70.2, Filament 4.16.0, SQLite.

## Automated checks

### PHPUnit

Command: `php artisan test`

Result: **12 passed, 78 assertions**, 0 failures.

Coverage of:

- Home page returns 200 and shows the name, title, all major sections, and five activities.
- All five seeded case files are published and their repository URLs appear.
- The activities section renders five records in the required priority order.
- Robosarema is typed as **Community**; the two PL FM roles are merged into one record using the PL FM logo as its thumbnail.
- Activity images use `object-fit: contain`, so posters and photos are no longer cropped; the logo is labelled “Organization logo”.
- Robosarema starts December 2024 and remains ongoing; the competition date is 18 September 2026; Polinema Mengajar keeps its supplied period.
- Pending and unpublished activities are hidden.
- The Sera-Z case shows **In progress** and no longer contains the stale "not started" claim.
- Unpublished projects are hidden.
- Custom 404 page returns 404 and shows the intended copy.
- Static export writes `index.html`, `404.html`, activity images, assets, and the correct canonical URL.
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
- `https://bisminee.github.io/portofolio/css/portfolio.css?v=1.3.0` — **200**, `text/css`.
- `https://bisminee.github.io/portofolio/js/site.js?v=1.3.0` — **200**.
- `https://bisminee.github.io/portofolio/images/activities/robosarema-arena.webp` — **200**, `image/webp`.
- `https://bisminee.github.io/portofolio/images/activities/keju-artisan-cheese-pull.webp` — **200**, `image/webp`.
- `https://bisminee.github.io/portofolio/does-not-exist` — **404** with the custom page.
- Canonical URL: `https://bisminee.github.io/portofolio/`.
- Live axe audit: **0 violations** in EN and ID.
- Live Chrome test: **0 console errors**, **0 failed requests**, no horizontal overflow at 1440 px or 390 px.
- Mobile “Activities” anchor lands at **83 px** with the menu closed.
- Five activity cards render in the required order; all five photos load; the Robosarema and competition cards cross-link.
- Live ID content includes `Kegiatan & Keterlibatan`, `Aktivitas`, and `Desember 2024 – Sekarang`.

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
| Horizontal overflow at 1024 px | None |
| Horizontal overflow at 820 px | None (scrollWidth 820) |
| Horizontal overflow at 390 px | None (scrollWidth 390) |
| Horizontal overflow at 320 px | None |
| All in-page anchors resolve | 6/6 |
| Desktop anchor lands below sticky nav | Section top 80 px (activities) |
| Mobile menu opens, locks scroll, updates `aria-expanded` | Pass |
| Mobile menu closes on link, unlocks scroll | Pass |
| Mobile anchor lands below header | Section top 83 px |
| External links (GitHub + release APK) | 8/8 returned HTTP 200 |
| Images loaded | 11/11 after scrolling each section (6 projects + 5 activities) |
| Activities rendered | 6/6 in the specified order |
| Activity photos and alts | Loaded; English and Indonesian alts verified; `object-fit: contain` prevents cropping |
| PL FM thumbnail | Official logo cropped from the Drive Creative Media poster; label switches to “Logo organisasi” |
| Activity evidence links | 6/6 point to the shared Drive documentation folder |
| Activity periods | Robosarema Dec 2024 – Present; competition 18 Sep 2026; Polinema Dec 2025 – Nov 2026 |
| Featured activity artwork | Stays aligned when details open; no mobile overlap |

### Filament studio smoke test

Logged in as the local seeded account and checked:

- `/studio` dashboard — 200, no console errors.
- `/studio/projects` — 5 rows, team/coursework badges, featured/live indicators.
- `/studio/projects/1/edit` — all sections rendered; existing repeater items hydrated correctly.
- `/studio/activities` — 5 rows, priority order, periods, approval and live status.
- `/studio/activities/1/edit` — identity, bilingual content, images, evidence, and related activity fields render; existing values hydrate correctly.
- Saving an activity preserves `image_path` as a string and `gallery` as an array (verified against SQLite).

The legacy `beyond_skills` resource is hidden from studio navigation; its public section was replaced by Activities & Involvement.

### Accessibility

Tool: axe-core 4.x, WCAG 2.0/2.1 A and AA rule set, run on the full desktop page.

Result: **0 violations** after fixing two findings:

1. `aria-label` on the decorative ticker container (`aria-prohibited-attr`) — replaced with `aria-hidden="true"`.
2. Accessible-name mismatch on the brand link (`label-content-name-mismatch`) — removed the redundant `aria-label`.

Additional manual checks:

- Skip-to-content link present and focusable.
- Semantic landmarks: `header`, `nav`, `main`, `section` with accessible names, `footer`.
- One `h1`; section `h2`s in order; project `h3`s.
- All illustrations have descriptive alt text that states they are not screenshots; activity photos use genuine documentation and bilingual alt text.
- Keyboard: menu toggle, links, and native `<details>` case files operable; Escape closes the mobile menu.
- `prefers-reduced-motion` disables the ticker and transitions and forces non-animated anchor scrolling.
- Focus-visible outline uses antique gold with a 3 px offset.
- Text contrast uses bone `#F0E6D2` on obsidian/charcoal and gold `#B99A63` for secondary labels; red is not used for small body text on dark backgrounds.

## Responsive review

Screenshots were captured and inspected at:

- Desktop 1440 px: hero, about, projects, skills, activities, journey, contact, an opened case file.
- Tablet 1024 px and 820 px: navigation fit, activities, timeline.
- Mobile 390 px and 320 px: hero, open navigation, language switch, activities, contact, full page.

Fixes made during review:

- Featured case artwork no longer stretches when the case file is expanded; it stays a 4:3 plate and becomes sticky on desktop.
- Mobile anchor navigation now unlocks body scroll before scrolling, landing the section below the header (84 px).
- Mobile navigation now occupies the full viewport below the header.
- Timeline dates now sit on a single centre axis; measured delta 0 px at every width.
- About drop-cap changed to a legible “M” instead of a red “I” bar.

## UI refinement pass — 4 November 2026

A second polish pass was applied to the existing Laravel/Blade build.

### Hero name shadow

- Applied the same two-layer shadow to both `.hero-line` elements.
- Computed desktop value: `rgb(159, 37, 45) 5px 5px 0px, rgba(0, 0, 0, 0.65) 10px 10px 0px`.
- Computed mobile value: `rgb(159, 37, 45) 3px 3px 0px, rgba(0, 0, 0, 0.65) 6px 6px 0px`.
- Both lines returned identical computed shadows; typography and line-height unchanged.

### Hero halftone

- Moved the pattern to the hero's upper-left origin.
- Bone-tone dots at `7px` spacing, with a radial mask that fades from opaque at the top-left through 54% to transparent at 78%.
- Pattern sits behind the hero content (`z-index` unchanged) and does not capture pointer events.
- Verified computed mask and screenshots at desktop/mobile; no text obstruction.

### EN / ID language switch

- Added a compact segmented switch to the navigation, plus a full-width variant inside the mobile menu.
- Centralized all Indonesian copy in `config/translations.php`; components use `data-i18n` keys instead of inline conditionals.
- Project prose uses `data-project-text` / `data-project-field`; timeline uses `data-journey-field`.
- Switching updates navigation, headings, hero, case files, details, skills, activities, timeline, contact, footer, 404, metadata, image alt text, and ARIA labels.
- Preference stored as `portfolio-language` in localStorage; restored on reload.
- The Indonesian page title is `Bisma Adhiaksa — Pengembang Mobile & Web`.
- No overflow at **1440, 1024, 820, 768, 390, or 320 px**.
- Persistence verified: ID survived reload; switching EN restored the original English prose.
- 404 metadata and copy switch correctly.
- axe-core: **0 violations** in both EN and ID.
- Indonesian copy was revised contextually, not word-for-word; project names, technology identifiers, and URLs remain untouched. The Sera-Z team size was corrected to **five people** in both languages.

### Timeline alignment

- Rebuilt the date rail with one CSS variable: `--rail` is `160px` desktop, `132px` tablet, `96px` mobile.
- The vertical line is placed at `calc(var(--rail) / 2)`; each date is centred in the same rail and masks the line with its own background.
- Measured date-centre vs. line-centre delta: **0 px for all seven entries at all tested widths**.
- Removed the separate offset dot; the date chip is now the marker on the centre axis.

### Role identifiers

- Added compact `IoT`, `C`, `C++` tags beneath the existing role line.
- Styled with existing gold/bone/ink tokens, mono type, and a restrained red accent on `IoT`.

### Seamless marquee

- Replaced the single track with **two identical `.ticker-group` elements**.
- Each group repeats the technology sequence six times; each has the same gap and trailing padding.
- Animation: `translate3d(0,0,0)` → `translate3d(-50%,0,0)`, `120s linear infinite`.
- Measured group widths: **4,913 px each**; track **9,825 px**.
- At `119,999ms` (the sequence boundary), group 1's right edge and group 2's left edge met with **gap 0**.
- Language switching did not restart the animation: currentTime advanced from 667 ms to 1,267 ms across the switch.
- Reduced motion: `animation-name: none`, `scroll-behavior: auto`.

### Live deployment verification (4 November 2026)

The refined build was pushed to `main` and deployed by GitHub Pages.

- Deployment workflow: **success**.
- Live HTML contains the language switch, translation payload, and CSS `?v=1.1.0`.
- EN title: `Bisma Adhiaksa — Mobile & Web Developer`; ID title: `Bisma Adhiaksa — Pengembang Mobile & Web`.
- Live EN/ID switch and localStorage persistence: pass.
- Live status badge: `Sedang dikerjakan` in ID.
- Live axe-core: **0 violations** in EN and ID.
- Live timeline date-centre delta: **0 px** for all seven entries.
- Live marquee: group widths **4,913 px**, duration **120s**, boundary gap **0**.
- Live mobile 390 px: no overflow; language switch works inside the menu.
- Live 404: HTTP **404** with the custom page, switching correctly to Indonesian.
- Console errors and failed requests: **0**.

## Not tested / not claimed

- No Docker build was executed locally (Docker is not installed in this environment). The Dockerfile is optional for self-hosting or a paid Docker host.
- No real mobile device or Safari test.
- No automated visual-regression baseline.
- Indonesian copy was authored and reviewed for consistency but should still receive a final native-speaker pass by the owner.
- No load/performance budget test beyond local asset sizes.

## Final command results

| Command | Result |
| --- | --- |
| `php artisan test` | 12 passed, 78 assertions |
| `vendor/bin/pint --test` | passed |
| `composer audit` | no advisories |
| `php artisan optimize` | config, routes, views, events, Blade icons, Filament cached |
| `php artisan portfolio:export` | static site built; translation JSON included |
| Local static-server test (`127.0.0.1:8081`) | 200; CSS/fonts loaded; EN/ID persistence and 404 pass |
| Headless Chrome QA | 0 console errors, 0 axe violations, no horizontal overflow |
| SQLite state after tests | 5 projects, 5 activities, 0 legacy Beyond Code entries |

