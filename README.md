# Bisma Adhiaksa — Portfolio

A dark-fantasy graphic-novel portfolio built with **Laravel 12** and **Filament 4**. The public site is a single-page Blade view; the case files and the “Beyond Code” entries are managed in a private Filament studio at `/studio`.

The content is based on the public GitHub profile [github.com/Bisminee](https://github.com/Bisminee) and its repositories, reviewed in October 2026. Team projects are labelled as team projects, coursework as coursework, and no metrics or testimonials are invented.

## Stack

| Layer | Choice |
| --- | --- |
| Framework | Laravel 12 (PHP 8.2+) |
| Admin | Filament 4 at `/studio` |
| Templating | Blade components and partials |
| Styling | Hand-written CSS in `public/css/portfolio.css` |
| Behaviour | ~50 lines of vanilla JavaScript in `public/js/site.js` |
| Database | SQLite (local and free-host default) |
| Assets | Local WOFF2 fonts, original SVG illustrations, no external CDN |
| Build | No Node/npm step required |

## Local development

Requirements: PHP 8.2+ with `pdo_sqlite`, Composer 2.

```bash
composer install
cp .env.example .env          # Windows PowerShell: Copy-Item .env.example .env
php artisan key:generate
touch database/database.sqlite # Windows: New-Item database/database.sqlite
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Open <http://127.0.0.1:8000>.

### Studio account

Add these to `.env` before seeding, then run `php artisan migrate:fresh --seed`:

```dotenv
ADMIN_NAME="Bisma"
ADMIN_EMAIL=you@example.test
ADMIN_PASSWORD=a-long-local-password
```

Sign in at <http://127.0.0.1:8000/studio>. Credentials are never committed; the seeder skips account creation when `ADMIN_EMAIL` or `ADMIN_PASSWORD` is missing.

## Editing content

### Case files

Studio → **Portfolio → Case files**. Each record supports:

- Case number, title, subtitle, ownership, year, featured/published flags, order.
- Summary, problem, solution, evidence note.
- Repeater lists for implementation notes, decisions, challenges, and results.
- Technology tags, repository URL, optional demo link and note.
- Artwork path and alt text.

Published records appear immediately on the home page. The `ProjectSeeder` is idempotent: it only runs when the table is empty, so studio edits are not overwritten on redeploy.

### Beyond Code

Studio → **Portfolio → Beyond Code**. The `beyond_skills` table is **intentionally empty** in the initial seed. The public section therefore shows an intentional blank panel, not sample skills.

Supported fields:

| Field | Required | Notes |
| --- | --- | --- |
| `name` | yes | Skill name |
| `category` | no | Short grouping label |
| `description` | no | One or two sentences |
| `icon` | no | Filament select: quill, spark, book, users, mic, camera, globe, heart, trophy, palette |
| `sort_order` | yes | Ascending order |
| `is_visible` | yes | Hide without deleting |

The section is rendered by the dedicated component `resources/views/components/beyond-code.blade.php`. Once at least one visible record exists, the empty panel is replaced by a responsive card grid. No ratings, percentages, or progress bars are supported or displayed.

### Profile, skills, timeline

Static copy lives in `config/site.php`. Update the profile name, email, location, skill groups, and journey entries there. An email is deliberately `null`; add one only when it is confirmed.

## Tests and quality checks

```bash
php artisan test                  # 9 tests, 39 assertions
vendor/bin/pint --test            # code style
composer audit                    # dependency advisories
php artisan optimize              # production caches
php artisan optimize:clear
```

Feature tests cover the public page, seeded projects, the empty Beyond Code state, adding a Beyond Code entry, unpublished projects, the 404 page, studio authentication, and studio access.

Static checks and browser checks performed during the build are listed in [docs/QA-REPORT.md](docs/QA-REPORT.md).

## Project structure

```text
app/
  Filament/Resources/          Project + Beyond Skill studio resources
  Http/Controllers/HomeController.php
  Models/Project.php, BeyondSkill.php
config/site.php                Profile, skills, journey, section copy
database/seeders/              Verified case files + admin account
resources/views/
  home.blade.php               Page composition
  partials/                    Hero, about, projects, skills, journey, contact, footer
  components/                  site-icon, section-head, beyond-code
  errors/404.blade.php
public/
  css/portfolio.css            Art direction and responsive layout
  js/site.js                   Mobile navigation + active section state
  images/                      Original illustrations, OG image, favicon
  fonts/                       Self-hosted WOFF2 files
docs/                          Audit, assets, deployment, QA report
Dockerfile, render.yaml        Free Render deployment
```

## Content provenance

- **Name:** “Bisma Adhiaksa” appears in the public notebook filename `TG1_244107020216_BISMA ADHIAKSA.ipynb`. The GitHub profile itself has no display name.
- **Location:** Indonesia, as requested by the portfolio owner.
- **Email / socials:** none published; only the GitHub profile is linked.
- **Education / employment:** omitted because it is not confirmed in the public profile.
- **Project claims:** each case file cites what repository files, routes, migrations, commits, or releases actually show.

## Deployment

Primary target: **Render free web service** using the included Dockerfile and `render.yaml`. See [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md) for exact steps, environment variables, troubleshooting, and the free-tier limitations.

GitHub Pages cannot host this build because Laravel and Filament require PHP. Vercel and Netlify are not used as the primary target because PHP support there is not a first-class runtime for a Filament/SQLite application.

## Licence and assets

The code was produced for this portfolio. Illustrations in `public/images/` are original SVGs created for this project; no comic-book characters, trademarked logos, or scanned pages are included. Font files are self-hosted Google Fonts (SIL Open Font License). See [docs/ASSETS.md](docs/ASSETS.md) for the replacement checklist and licensing notes.
