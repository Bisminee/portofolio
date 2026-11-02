<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Public profile
    |--------------------------------------------------------------------------
    | Only verified information is published here. The GitHub profile does not
    | expose a name, bio, location, email, or website, so no email or social
    | handle is invented. Update this file when those details are confirmed.
    */
    'profile' => [
        'name' => 'Bisma Adhiaksa',
        'handle' => 'Bisminee',
        'title' => 'Mobile & Web Developer',
        'location' => 'Indonesia',
        'github' => 'https://github.com/Bisminee',
        'github_label' => 'github.com/Bisminee',
        'tagline' => 'I build working software across mobile and web: Flutter interfaces, Laravel back offices, and the data layers that keep both honest.',
        'microcopy' => 'Public repositories. Real coursework. Team projects labelled as team projects. No invented clients, metrics, or testimonials.',
        'availability' => 'Open to conversations about mobile development, web systems, and full-stack collaboration.',
        'email' => null,
        'portrait' => 'images/hero-portrait.svg',
        'portrait_alt' => 'Original ink illustration of a hooded figure beneath a gothic arch with a raven — not a photograph of the portfolio owner.',
        'intro' => [
            'My work sits on two surfaces: the phone in someone’s hand and the back office behind it. My public work pairs Flutter interfaces with Laravel systems — routing, state, schema design, admin panels, and the small business rules that keep an application trustworthy.',
            'Most of what is published here began as coursework or a team build. I treat those origins as part of the record: the repositories show the iteration, including the migrations, refactors, and unfinished epics. Where authorship or results are unclear, the case file says so.',
            'The current direction is mobile engineering with a stronger architectural spine: clean boundaries, testable use cases, and on-device intelligence that works without a server round-trip. The Flutter architecture lab is the clearest evidence of that direction so far.',
        ],
        'focus' => [
            ['label' => 'Mobile', 'value' => 'Flutter · Dart · Riverpod'],
            ['label' => 'Web systems', 'value' => 'Laravel · Livewire · Filament'],
            ['label' => 'Foundation', 'value' => 'PHP · Java · SQL · Git'],
        ],
    ],

    'facts' => [
        ['label' => 'Public repositories reviewed', 'value' => '28'],
        ['label' => 'Case files published', 'value' => '05'],
        ['label' => 'Primary stack', 'value' => 'Flutter · Laravel'],
        ['label' => 'Based in', 'value' => 'Indonesia'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Technical skills
    |--------------------------------------------------------------------------
    | Derived from repository evidence. No proficiency percentages are shown,
    | because a language appearing in one repository does not prove mastery.
    */
    'skill_groups' => [
        [
            'number' => 'I',
            'title' => 'Languages',
            'note' => 'Found in public repositories; depth varies by project.',
            'skills' => ['PHP', 'Dart', 'Java', 'Python', 'JavaScript'],
        ],
        [
            'number' => 'II',
            'title' => 'Frameworks & libraries',
            'note' => 'Used in application code, not just declared in a manifest.',
            'skills' => ['Laravel 12', 'Filament 4', 'Livewire', 'Flutter', 'Riverpod', 'go_router', 'pandas', 'scikit-learn', 'NumPy'],
        ],
        [
            'number' => 'III',
            'title' => 'Data & infrastructure',
            'note' => 'Evidence: schema design, migrations, and documented integrations.',
            'skills' => ['MySQL', 'SQLite', 'Google Sheets API', 'Firebase', 'CSV export'],
        ],
        [
            'number' => 'IV',
            'title' => 'Tools & practice',
            'note' => 'The working method visible in commit history and project docs.',
            'skills' => ['Git & GitHub', 'Composer', 'npm & Vite', 'Jupyter', 'Android Studio', 'PHPUnit', 'Feature branches & pull requests', 'Technical documentation'],
        ],
    ],

    'journey' => [
        [
            'period' => '2024',
            'title' => 'First public repositories',
            'body' => 'Java fundamentals and object-oriented coursework enter GitHub: arrays, methods, loops, and class design. The account’s public history begins in August 2024.',
        ],
        [
            'period' => '2024–2025',
            'title' => 'Data structures, by hand',
            'body' => 'Singly and doubly linked lists, stacks, queues, sorting, and a queue-based academic service simulation — implemented in Java with lab reports.',
        ],
        [
            'period' => '2025',
            'title' => 'Web foundations and Laravel',
            'body' => 'HTML, CSS, and JavaScript coursework gives way to Laravel: routing, migrations, Blade views, and a first point-of-sale schema.',
        ],
        [
            'period' => '2026',
            'title' => 'Production-shaped web systems',
            'body' => 'A multi-branch POS with Filament 4, Livewire, role-aware routes, face attendance, and Google Sheets integration. Schema evolution is visible across 30+ migrations.',
        ],
        [
            'period' => '2026',
            'title' => 'Mobile development and architecture',
            'body' => 'Flutter coursework moves from single screens to a feature-first clean-architecture refactor with unit tests, fake repositories, and before/after documentation.',
        ],
        [
            'period' => '2026',
            'title' => 'Applied machine learning',
            'body' => 'Jupyter notebooks cover preprocessing, classification, and clustering with pandas and scikit-learn — and document the steps rather than just the score.',
        ],
        [
            'period' => 'Oct 2026',
            'title' => 'Sera-Z v1.0.0',
            'body' => 'A two-person Flutter wardrobe assistant publishes its first Android release, with the app foundation complete and the model pipeline tracked publicly as work in progress.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Beyond Code
    |--------------------------------------------------------------------------
    | Entries live in the beyond_skills table and are managed in the Filament
    | studio (/studio). The table is intentionally empty in the initial seed.
    | Supported fields: name, category, description, icon, sort_order,
    | is_visible. When no visible rows exist, the section renders an
    | intentional blank-panel state instead of fabricated examples.
    */
    'beyond_code' => [
        'eyebrow' => 'Interlude',
        'title' => 'Beyond Code',
        'subtitle' => 'A dedicated space for skills beyond programming.',
        'empty_note' => 'This panel is intentionally blank.',
        'empty_hint' => 'Entries will appear here once they are added in the studio.',
    ],
];
