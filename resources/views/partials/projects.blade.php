@php
    $ownershipClass = [
        'Team project' => 'tag--team',
        'Coursework' => 'tag--course',
        'Personal project' => 'tag--personal',
    ];

    $ownershipKeys = [
        'Team project' => 'ownership.team',
        'Coursework' => 'ownership.course',
        'Personal project' => 'ownership.personal',
    ];
@endphp

<section class="section projects" id="projects" aria-labelledby="projects-title">
    <div class="shell">
        <x-section-head
            number="02"
            eyebrow="Featured case files"
            eyebrow-key="projects.eyebrow"
            title="Five files. No filler."
            title-key="projects.title"
            id="projects-title"
            lead="Selected for technical depth, documentation, and evidence of implementation — not stars. Team work is marked as team work; coursework is marked as coursework."
            lead-key="projects.lead"
        />

        @if ($projects->isEmpty())
            <div class="empty-state">
                <p data-i18n="projects.empty">No case files are published yet. Add one in the studio.</p>
            </div>
        @else
            <div class="case-grid">
                @foreach ($projects as $project)
                    <article class="case-file {{ $loop->first ? 'is-featured' : '' }}" aria-labelledby="project-{{ $project->slug }}">
                        <figure class="case-art">
                            <span class="art-badge" data-i18n="{{ $project->art_kind === 'screenshot' ? 'projects.screenshot' : 'projects.illustration' }}">
                                {{ $project->art_kind === 'screenshot' ? 'Project screenshot' : 'Illustration · not a screenshot' }}
                            </span>
                            <img
                                src="{{ asset($project->art_path) }}"
                                alt="{{ $project->art_alt }}"
                                data-project="{{ $project->slug }}"
                                data-project-alt
                                width="800"
                                height="600"
                                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                decoding="async"
                            >
                            <figcaption class="art-caption" data-i18n="{{ $project->art_kind === 'screenshot' ? 'projects.plateScreenshot' : 'projects.plateIllustration' }}">
                                {{ $project->art_kind === 'screenshot' ? 'Captured from the application' : 'Original case-file plate' }}
                            </figcaption>
                        </figure>

                        <div class="case-content">
                            <div class="case-meta">
                                <span class="case-no"><span data-i18n="projects.case">Case</span> {{ $project->case_no }}</span>
                                <span class="tag {{ $ownershipClass[$project->ownership] ?? '' }}" data-i18n="{{ $ownershipKeys[$project->ownership] ?? '' }}">{{ $project->ownership }}</span>
                                @if ($project->status && $project->status !== 'Published')
                                    <span class="tag {{ $project->status === 'In progress' ? 'tag--progress' : 'tag--archived' }}" data-i18n="{{ $project->status === 'In progress' ? 'status.progress' : 'status.archived' }}">
                                        {{ $project->status }}
                                    </span>
                                @endif
                                <span class="case-year">{{ $project->year }}</span>
                            </div>

                            <h3 class="case-title" id="project-{{ $project->slug }}">{{ $project->title }}</h3>
                            <p class="case-subtitle" data-project="{{ $project->slug }}" data-project-text="subtitle">{{ $project->subtitle }}</p>
                            <p class="case-summary" data-project="{{ $project->slug }}" data-project-text="summary">{{ $project->summary }}</p>

                            <ul class="tech-tags" aria-label="Technologies used" data-i18n-aria-label="projects.techLabel">
                                @foreach ($project->tech ?? [] as $technology)
                                    <li>{{ $technology }}</li>
                                @endforeach
                            </ul>

                            <div class="case-actions">
                                <a
                                    class="text-link"
                                    href="{{ $project->repo_url }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                >
                                    <x-site-icon name="github" :size="15" />
                                    <span data-i18n="projects.source">Source</span>
                                    <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                                </a>

                                @if ($project->demo_url)
                                    <a
                                        class="text-link text-link--red"
                                        href="{{ $project->demo_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <x-site-icon name="download" :size="15" />
                                        <span data-project="{{ $project->slug }}" data-project-text="demo_label">{{ $project->demo_label }}</span>
                                        <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                                    </a>
                                @endif

                                @if ($project->demo_note)
                                    <span class="demo-note" data-project="{{ $project->slug }}" data-project-text="demo_note">{{ $project->demo_note }}</span>
                                @endif
                            </div>

                            <details class="case-details">
                                <summary>
                                    <span data-i18n="projects.read">Read the full case file</span>
                                    <span class="summary-mark" aria-hidden="true">
                                        <x-site-icon name="plus" :size="16" />
                                    </span>
                                </summary>

                                <div class="case-body">
                                    <div class="case-block">
                                        <h4 data-i18n="projects.problem">The problem</h4>
                                        <p data-project="{{ $project->slug }}" data-project-text="problem">{{ $project->problem }}</p>
                                    </div>

                                    <div class="case-block">
                                        <h4 data-i18n="projects.solution">The solution</h4>
                                        <p data-project="{{ $project->slug }}" data-project-text="solution">{{ $project->solution }}</p>
                                    </div>

                                    @if (! empty($project->implementation))
                                        <div class="case-block">
                                            <h4 data-i18n="projects.repoContents">What is in the repository</h4>
                                            <ul class="case-list">
                                                @foreach ($project->implementation as $item)
                                                    <li data-project="{{ $project->slug }}" data-project-field="implementation" data-project-index="{{ $loop->index }}">{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (! empty($project->decisions))
                                        <div class="case-block">
                                            <h4 data-i18n="projects.decisions">Technical decisions</h4>
                                            <ul class="case-list">
                                                @foreach ($project->decisions as $item)
                                                    <li data-project="{{ $project->slug }}" data-project-field="decisions" data-project-index="{{ $loop->index }}">{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (! empty($project->challenges))
                                        <div class="case-block">
                                            <h4 data-i18n="projects.challenges">Challenges</h4>
                                            <ul class="case-list">
                                                @foreach ($project->challenges as $item)
                                                    <li data-project="{{ $project->slug }}" data-project-field="challenges" data-project-index="{{ $loop->index }}">{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (! empty($project->results))
                                        <div class="case-block">
                                            <h4 data-i18n="projects.results">Verifiable results</h4>
                                            <ul class="case-list">
                                                @foreach ($project->results as $item)
                                                    <li data-project="{{ $project->slug }}" data-project-field="results" data-project-index="{{ $loop->index }}">{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="evidence-note">
                                        <span class="evidence-label" data-i18n="projects.evidence">Evidence note</span>
                                        <p data-project="{{ $project->slug }}" data-project-text="evidence_note">{{ $project->evidence_note }}</p>
                                    </div>
                                </div>
                            </details>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="projects-foot">
                <p data-i18n="projects.footnote">
                    Every file links to its public repository. Repositories without a verified live deployment do not get a demo link.
                </p>
                <a
                    class="text-link"
                    href="https://github.com/Bisminee?tab=repositories"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <span data-i18n="projects.browse">Browse all repositories</span>
                    <x-site-icon name="arrow-up-right" :size="15" />
                    <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                </a>
            </div>
        @endif
    </div>
</section>
