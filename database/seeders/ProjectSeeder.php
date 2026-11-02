<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        if (Project::query()->exists()) {
            $this->command?->info('Case files already exist — skipping project seed to preserve studio edits.');

            return;
        }

        foreach ($this->projects() as $index => $project) {
            Project::create(
                [...$project, 'sort_order' => $index + 1, 'published' => true],
            );
        }
    }

    /**
     * Content verified against public repositories in October 2026.
     *
     * @return array<int, array<string, mixed>>
     */
    private function projects(): array
    {
        return [
            [
                'slug' => 'pos-tahu-morojoyo',
                'case_no' => '01',
                'title' => 'POS Tahu Morojoyo',
                'subtitle' => 'A multi-branch point-of-sale and attendance system for a family food business',
                'ownership' => 'Team project',
                'year' => '2026',
                'summary' => 'A Laravel 12 point-of-sale system with a Filament admin panel, cashier shifts, face-based attendance, multi-branch stock, and a Google Sheets export path.',
                'problem' => 'A tofu food business needs more than a cash register. Sales, shift attendance, branch stock, and owner reporting have to agree with each other — and a cashier should not be able to open the till before checking in.',
                'solution' => 'A Laravel application that separates the public storefront from the operational back office. Cashiers authenticate, clock in with a face capture, and only then reach the POS. Owners manage branches, employees, menus, prices, and stock through Filament resources, while attendance is enforced in the route layer.',
                'implementation' => [
                    'Laravel 12 application with PHP 8.2, Livewire, and a Filament 4 administration panel.',
                    'Route middleware gates the POS behind a completed attendance check-in; the cashier route group also handles checkout and Google Sheets synchronisation.',
                    'Eloquent models and migrations cover branches, employees, tofu stock, menus, prices, menu composition, stock mutations, transactions, transaction items, shifts, and attendance.',
                    'Owner-facing screens enrol employee face data and export attendance recaps as CSV.',
                    'A public-facing section presents the home page, menu, about page, and contact page separately from the admin panel.',
                ],
                'tech' => ['Laravel 12', 'PHP 8.2', 'Filament 4', 'Livewire', 'Blade', 'MySQL', 'Google Sheets API'],
                'decisions' => [
                    'Used Filament resources for back-office CRUD instead of hand-building every admin screen — domain work stays in models, operations stay auditable.',
                    'Put the attendance requirement in route middleware so the business rule cannot be bypassed by navigating directly to the cashier URL.',
                    'Modelled stock as both per-piece records and mutation history, leaving an audit trail rather than a single mutable counter.',
                ],
                'challenges' => [
                    'The schema evolved through many additive migrations (roles, branch ownership, soft-active flags, shift foreign keys, face photos) — the migration history documents that iteration.',
                ],
                'results' => [
                    'The repository contains the full application, migration set, and Filament resource layer. No production metrics are published, so none are claimed here.',
                ],
                'repo_url' => 'https://github.com/Bisminee/POS_Tahu_Morojoyo',
                'demo_label' => null,
                'demo_url' => null,
                'demo_note' => null,
                'docs_url' => null,
                'art_path' => 'images/project-pos.svg',
                'art_alt' => 'Original case-file illustration: a receipt, a cash terminal, tofu cubes, and branch nodes in ink and halftone. Not an application screenshot.',
                'evidence_note' => 'Team repository. Commits and merges appear under the Bisminee account alongside other contributors; per-feature authorship is not documented, so this case file describes the system rather than claiming sole authorship.',
                'featured' => true,
            ],
            [
                'slug' => 'sera-z',
                'case_no' => '02',
                'title' => 'Sera-Z',
                'subtitle' => 'A Flutter wardrobe assistant that reads clothing from a photograph',
                'ownership' => 'Team project',
                'status' => 'In progress',
                'year' => '2026',
                'summary' => 'A two-person Flutter project: photograph a garment, identify its type and colour, then receive outfit suggestions. A v1.0.0 Android build is published, while the ML pipeline and on-device integration are still in progress on the dev branch.',
                'problem' => 'Choosing an outfit is a small decision with a lot of hidden context: what is clean, what matches, and what the item actually is. The team set out to turn a single photo into structured wardrobe data.',
                'solution' => 'A Flutter client with a feature-first structure and an on-device pipeline under active development: a clothing classifier, a dominant-colour module, and a compatibility scorer. The v1.0.0 release shipped the app foundation and camera flow; the current dev branch adds SQLite and a YOLO11n classifier export while the remaining integration work is tracked openly.',
                'implementation' => [
                    'Contributed the feat/app-foundation branch, merged through pull request #4: app shell, go_router navigation, Riverpod state, Material 3 theme, camera capture, and a refreshed widget smoke test.',
                    'The Flutter app declares go_router 17.5.0, flutter_riverpod 2.6.1, and camera 0.12.1 in pubspec.yaml.',
                    'The repository documents ten epics with explicit acceptance criteria. As of 2 November 2026, E1 is complete and E2–E10 are marked partially complete; remaining work stays on the public task board.',
                    'The dev branch includes SQLite integration and a YOLO11n classifier export (assets/models/yolo11n_cls.tflite), alongside an ML pipeline of dataset preparation, training, evaluation, and export scripts. These are work-in-progress, not presented as finished features.',
                    'The README publishes a signed APK download and installation notes for Android 7.0 and above.',
                ],
                'tech' => ['Flutter', 'Dart', 'Riverpod', 'go_router', 'camera', 'Material 3', 'SQLite', 'TFLite', 'Android'],
                'decisions' => [
                    'Kept the ML pipeline on-device in the plan (TFLite) rather than requiring a backend for every inference.',
                    'Used feature-oriented branches and pull requests instead of personal branches, with acceptance criteria written before implementation.',
                    'Documented incomplete epics as incomplete — the public task board is a status record, not a marketing page.',
                ],
                'challenges' => [
                    'The v1.0.0 APK is a foundation release. The classifier, colour extraction, compatibility scoring, on-device wiring, and QA remain in progress; this case file does not claim a finished end-to-end flow or model accuracy.',
                ],
                'results' => [
                    'v1.0.0 release published with an installable sera-z.apk.',
                    'As of 2 November 2026 the public epic tracker marks E1 complete and E2–E10 partially complete, with the remaining work still tracked in the repository.',
                ],
                'repo_url' => 'https://github.com/Bisminee/PBL-Mobile-Kelompok2-Semester5',
                'demo_label' => 'Download v1.0.0 APK',
                'demo_url' => 'https://github.com/Bisminee/PBL-Mobile-Kelompok2-Semester5/releases/latest/download/sera-z.apk',
                'demo_note' => 'Android 7.0+; sideloading required. Foundation release; ML features are still in progress.',
                'docs_url' => null,
                'art_path' => 'images/project-sera-z.svg',
                'art_alt' => 'Original case-file illustration: a phone framing a shirt, with colour swatches and a neural path in ink. Not an application screenshot.',
                'evidence_note' => 'Team project by Kelompok 2. The app-foundation contribution is visible under the Bisminee account. The dev-branch ML integration is a team effort and remains in progress; this case file does not claim it as complete or solo work.',
                'featured' => true,
            ],
            [
                'slug' => 'flutter-architecture-lab',
                'case_no' => '03',
                'title' => 'Flutter Architecture Lab',
                'subtitle' => 'Seven weeks of mobile coursework, ending in a clean-architecture refactor',
                'ownership' => 'Coursework',
                'year' => '2026',
                'summary' => 'A large Flutter learning repository: weekly exercises, a notes/announcements/settings app, a feature-first refactor, unit tests against fake repositories, and before/after documentation.',
                'problem' => 'Learning Flutter screen by screen produces screens that work but do not scale. The final week asked for a structure that could survive new features and tests.',
                'solution' => 'A week-by-week Flutter curriculum that culminates in a deliberate refactor: features grouped by domain, data sources behind repository contracts, use cases tested with fakes, and UI rebuilt against the new boundaries.',
                'implementation' => [
                    'Refactored the app into a feature-first clean architecture across notes, announcements, and settings.',
                    'Added unit tests for use cases using fake repository implementations.',
                    'Enabled the Google Services plugin and excluded Firebase configuration files from version control.',
                    'Documented the refactor with a README, an AI-challenge write-up, and before/after screenshots.',
                    'The repository also records a grep-based audit of three classic architecture violations before the refactor.',
                ],
                'tech' => ['Flutter', 'Dart', 'Firebase', 'Clean Architecture', 'Unit testing', 'Git'],
                'decisions' => [
                    'Tested use cases at the boundary rather than mocking widgets, keeping domain tests fast and independent of Flutter rendering.',
                    'Treated the refactor as documentation work too: screenshots and a violation audit make the change reviewable.',
                    'Kept secrets out of the repository by ignoring Firebase configuration files and shipping only the plugin wiring.',
                ],
                'challenges' => null,
                'results' => [
                    'Week 7 commits show the completed refactor, the test suite, and the before/after evidence in the same history.',
                ],
                'repo_url' => 'https://github.com/Bisminee/244107020216-mobile-course',
                'demo_label' => null,
                'demo_url' => null,
                'demo_note' => null,
                'docs_url' => null,
                'art_path' => 'images/project-mobile-lab.svg',
                'art_alt' => 'Original case-file illustration: a phone split into architecture layers beside a test flask and checkmarks. Not an application screenshot.',
                'evidence_note' => 'Solo coursework repository. The claims above come from the week 7 commit history and the repository README; no grades or performance results are asserted.',
                'featured' => false,
            ],
            [
                'slug' => 'machine-learning-practicals',
                'case_no' => '04',
                'title' => 'Machine Learning Practicals',
                'subtitle' => 'Notebooks on preprocessing, classification, and clustering',
                'ownership' => 'Coursework',
                'year' => '2026',
                'summary' => 'A semester of Jupyter notebooks covering exploratory analysis, feature scaling, label encoding, classification on the Titanic and Wisconsin breast-cancer datasets, and clustering on Iris and mall-customer data.',
                'problem' => 'Models are only as trustworthy as the preparation behind them. The coursework focuses on the unglamorous middle: cleaning, encoding, scaling, and reading the results honestly.',
                'solution' => 'Weekly notebooks that pair short explanations with executable Python. Each practical loads a dataset, inspects its shape and dtypes, prepares features, and applies a method appropriate to the task.',
                'implementation' => [
                    'Preprocessed the 569-row Wisconsin breast-cancer dataset with pandas, NumPy, LabelEncoder, and StandardScaler.',
                    'Worked with the Titanic dataset in multiple sessions, including a fixed and a selected feature set.',
                    'Explored clustering with the Iris and Mall Customers datasets.',
                    'Kept datasets, notebooks, and written README notes together so the work can be reproduced.',
                ],
                'tech' => ['Python', 'Jupyter', 'pandas', 'NumPy', 'scikit-learn', 'Matplotlib'],
                'decisions' => [
                    'Encoded the target before scaling numeric features, keeping the preprocessing order explicit in the notebook.',
                    'Separated columns that should and should not be used, rather than throwing every field at a model.',
                    'Stored the source CSVs alongside the notebooks for reproducibility.',
                ],
                'challenges' => null,
                'results' => [
                    'Six practical folders exist in the public repository, from fundamentals through clustering. No single benchmark score is claimed because the notebooks pursue different tasks.',
                ],
                'repo_url' => 'https://github.com/Bisminee/Pembelajaran-Mesin-2026',
                'demo_label' => null,
                'demo_url' => null,
                'demo_note' => null,
                'docs_url' => null,
                'art_path' => 'images/project-ml.svg',
                'art_alt' => 'Original case-file illustration: a scatter plot, a confusion matrix, and a notebook page in ink. Not an application screenshot.',
                'evidence_note' => 'Solo coursework repository. Notebook contents were inspected for the preprocessing steps and library usage described here.',
                'featured' => false,
            ],
            [
                'slug' => 'java-data-structures',
                'case_no' => '05',
                'title' => 'Java Data Structures Lab',
                'subtitle' => 'Linked lists, stacks, queues, and sorting built from scratch',
                'ownership' => 'Coursework',
                'year' => '2024–2025',
                'summary' => 'A Java laboratory archive implementing core data structures by hand, with lab reports and a final queue-based academic service simulation.',
                'problem' => 'Using a library collection hides the mechanics. The lab required the mechanics: nodes, pointers, resizing, and the cost of each operation.',
                'solution' => 'Implementations written directly in Java, paired with demonstration mains and PDF lab reports. The final exercise models a campus academic-service queue with separate student and service classes.',
                'implementation' => [
                    'Implemented singly and doubly linked lists with dedicated node classes and demonstration programs.',
                    'Built stack implementations, including a conversion stack and a student-task stack.',
                    'Built queue implementations and used them in an academic service simulation (SIAKAD).',
                    'Practised sorting algorithms and object-oriented class design across student, lecturer, and course models.',
                ],
                'tech' => ['Java', 'Object-oriented programming', 'Data structures', 'Algorithms'],
                'decisions' => [
                    'Kept each structure in its own class with a separate main, so behaviour can be demonstrated without a framework.',
                    'Used custom node types rather than language collections to expose pointer manipulation.',
                ],
                'challenges' => null,
                'results' => [
                    'The repository preserves the implementations and lab reports from the course, including the queue-based service simulation.',
                ],
                'repo_url' => 'https://github.com/Bisminee/PRAKTIKUM-ASD',
                'demo_label' => null,
                'demo_url' => null,
                'demo_note' => null,
                'docs_url' => null,
                'art_path' => 'images/project-asd.svg',
                'art_alt' => 'Original case-file illustration: linked-list nodes, a stack, and a queue drawn as an ink schematic. Not an application screenshot.',
                'evidence_note' => 'Solo coursework repository. File names, implementations, and lab reports were reviewed; no grades are claimed.',
                'featured' => false,
            ],
        ];
    }
}
