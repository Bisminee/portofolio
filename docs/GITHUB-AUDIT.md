# GitHub audit — verified inventory

A review of the public GitHub profile [@Bisminee](https://github.com/Bisminee), performed on 30 October 2026 via the GitHub REST API and raw repository files.

## Profile facts

| Field | Value |
| --- | --- |
| Login | `Bisminee` |
| Display name | Not set on the profile |
| Bio | Not set |
| Location | Not set |
| Public email | Not set |
| Website / blog | Not set |
| Twitter/X | Not set |
| Public repositories | 28 |
| Followers | 10 |
| Account created | 26 August 2024 |
| Avatar | GitHub-hosted default/avatar image (not used as a portrait) |

**Name evidence:** the public notebook file `Pembelajaran-Mesin-2026/Pertemuan1/TG1_244107020216_BISMA ADHIAKSA.ipynb` contains the name “Bisma Adhiaksa”. The portfolio uses that name. “Indonesia” is used at the owner's request; the profile itself does not publish a location. No email, employer, school, or social account is invented.

## Public repository inventory

All 28 public repositories at the time of review. “Role” is an inference from repository structure and ownership, not a claim about contribution volume.

| # | Repository | Primary language | Updated | Role / evidence | Used in portfolio |
| --- | --- | --- | --- | --- | --- |
| 1 | `244107020216-mobile-course` | Dart | 2026-10-20 | Solo coursework; 7-week Flutter progression | Case 03 |
| 2 | `PBL-Mobile-Kelompok2-Semester5` | Dart | 2026-11-02 | Team project (Kelompok 2, five contributors); v1.0.0 release; `dev` branch work in progress | Case 02 |
| 3 | `Pembelajaran-Mesin-2026` | Jupyter Notebook | 2026-10-13 | Solo coursework; 6 practical folders | Case 04 |
| 4 | `Bisma-jobsheet2` | Jupyter Notebook | 2026-08-27 | Early notebook; description “Repository Pertama” | No — too thin |
| 5 | `android_to_oled` | C++ (Flutter platform) | 2026-07-24 | Small Flutter experiment; starter README | No |
| 6 | `PWL` | PHP | 2026-06-24 | Web-programming coursework; Laravel exercise folders, vendored dependencies | No — duplicate POS learning |
| 7 | `POS_Tahu_Morojoyo` | Blade | 2026-06-09 | Team project; Laravel 12 + Filament 4 + Livewire; 30+ migrations | Case 01 |
| 8 | `PWL_POS` | PHP | 2026-03-03 | Coursework POS schema; Laravel; vendored dependencies committed | No — earlier variant |
| 9 | `POS` | PHP | 2026-03-02 | Laravel POS skeleton/schema exercise | No |
| 10 | `PWL_2024` | PHP | 2026-02-24 | Web-programming coursework | No |
| 11 | `PBO_Kuis2` | Java | 2025-12-14 | Object-oriented programming quiz | No |
| 12 | `DesainPemrogramanWeb` | HTML | 2025-11-03 | HTML/CSS/JS jobsheets | No — exercises |
| 13 | `PRAKTIKUM-ASD` | Java | 2025-06-13 | Solo data-structures lab; linked lists, stacks, queues, sorting | Case 05 |
| 14 | `Case_Method2` | Java | 2025-06-11 | Small Java case-method exercise | No |
| 15 | `GamingBgtGwehj` | — | 2025-05-08 | Empty repository | No |
| 16 | `CaseMethod1` | Java | 2025-04-20 | Small Java case-method exercise | No |
| 17 | `spaze-shooter_Bisma` | C# | 2025-03-09 | Fork, not original work | No |
| 18 | `daspro-jobsheet12` | Java | 2024-11-30 | Java fundamentals coursework | No |
| 19 | `daspro-jobsheet11` | Java | 2024-11-25 | Java fundamentals coursework | No |
| 20 | `daspro-jobsheet10` | Java | 2024-11-06 | Java fundamentals coursework | No |
| 21 | `daspro-jobsheet9` | Java | 2024-10-31 | Java fundamentals coursework | No |
| 22 | `daspro-jobsheet8` | Java | 2024-10-30 | Java fundamentals coursework | No |
| 23 | `daspro-jobsheet7` | Java | 2024-10-09 | Java fundamentals coursework | No |
| 24 | `daspro-jobsheet6` | Java | 2024-10-04 | Java fundamentals coursework | No |
| 25 | `daspro-jobsheet5` | Java | 2024-09-25 | Java fundamentals coursework | No |
| 26 | `daspro-jobsheet3` | Java | 2024-09-11 | Java fundamentals coursework | No |
| 27 | `Latihan` | Java | 2024-09-04 | Small practice repository | No |
| 28 | `Kelompok` | Java | 2024-09-04 | Small group exercise | No |

## Selection rationale

Five case files were chosen for technical depth, relevance, completeness, documentation, and evidence of implementation:

1. **POS Tahu Morojoyo** — largest application, real domain model, Filament admin, authentication, attendance middleware, Google Sheets integration. Team repository.
2. **Sera-Z** — published v1.0.0 Android release; Flutter, Riverpod, go_router, camera; contribution traceable to the `feat/app-foundation` branch and PR #4. The five-person team's `dev` branch has newer SQLite/YOLO11n work still in progress.
3. **Flutter Architecture Lab** — the clearest evidence of architectural growth: a feature-first refactor, unit tests with fake repositories, Firebase wiring, and before/after documentation.
4. **Machine Learning Practicals** — consistent, reproducible notebooks covering preprocessing, classification, and clustering.
5. **Java Data Structures Lab** — foundations implemented by hand, with lab reports and a queue-based simulation.

## Excluded and why

- `PWL`, `PWL_POS`, `POS`, `PWL_2024`, `DesainPemrogramanWeb`, and the `daspro-*` series are coursework exercises whose strongest ideas are already represented by the POS and data-structures case files.
- `Bisma-jobsheet2` is an early notebook with no README or substantial application.
- `android_to_oled` is a small, unfinished Flutter experiment with the default README.
- `PBO_Kuis2`, `Case_Method1/2`, `Latihan`, `Kelompok`, and the empty `GamingBgtGwehj` are too small to support a case study.
- `spaze-shooter_Bisma` is a fork, so it is not presented as original work.

## Repository evidence inspected

- Profile and repository metadata from the GitHub REST API.
- README files (Sera-Z, POS Tahu Morojoyo, mobile course, data structures).
- Repository trees (1,416 files in the mobile course; 407 in POS; 289 in Sera-Z; 147 in the Java lab; 41 in ML).
- Framework manifests: `composer.json` (Laravel 12, Filament 4, Livewire, Google API client), `pubspec.yaml` (Flutter, go_router, Riverpod, camera).
- Migrations and routes for POS (attendance middleware, shifts, branches, stock, transactions, Google Sheets routes).
- Commit history and release metadata for Sera-Z (v1.0.0 APK).
- Notebook contents for the ML preprocessing claims (pandas, NumPy, LabelEncoder, StandardScaler).

## Deliberate omissions and caveats

- The profile has no display name, bio, location, company, or email. Those were not fabricated.
- The organisation behind the student ID prefix is not stated publicly on the profile, so education is omitted from the site.
- Team authorship is not documented per feature. The POS and Sera-Z case files describe systems and clearly label their team context instead of claiming solo authorship.
- No repository publishes production metrics, user counts, revenue, test coverage, or benchmark scores. None are claimed.
- No private repository, environment file, token, or commit email is reproduced.
- Stars are zero across the account; popularity was not used as a quality signal.
