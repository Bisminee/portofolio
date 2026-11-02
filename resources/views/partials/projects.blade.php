@php
    $ownershipClass = [
        'Team project' => 'tag--team',
        'Coursework' => 'tag--course',
        'Personal project' => 'tag--personal',
    ];
@endphp

<section class="section projects" id="projects" aria-labelledby="projects-title">
    <div class="shell">
        <x-section-head
            number="02"
            eyebrow="Featured case files"
            title="Five files. No filler."
            id="projects-title"
            lead="Selected for technical depth, documentation, and evidence of implementation — not stars. Team work is marked as team work; coursework is marked as coursework."
        />

        @if ($projects->isEmpty())
            <div class="empty-state">
                <p>No case files are published yet. Add one in the studio.</p>
            </div>
        @else
            <div class="case-grid">
                @foreach ($projects as $project)
                    <article class="case-file {{ $loop->first ? 'is-featured' : '' }}" aria-labelledby="project-{{ $project->slug }}">
                        <figure class="case-art">
                            <span class="art-badge">
                                {{ $project->art_kind === 'screenshot' ? 'Project screenshot' : 'Illustration · not a screenshot' }}
                            </span>
                            <img
                                src="{{ asset($project->art_path) }}"
                                alt="{{ $project->art_alt }}"
                                width="800"
                                height="600"
                                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                decoding="async"
                            >
                            <figcaption class="art-caption">
                                {{ $project->art_kind === 'screenshot' ? 'Captured from the application' : 'Original case-file plate' }}
                            </figcaption>
                        </figure>

                        <div class="case-content">
                            <div class="case-meta">
                                <span class="case-no">Case {{ $project->case_no }}</span>
                                <span class="tag {{ $ownershipClass[$project->ownership] ?? '' }}">{{ $project->ownership }}</span>
                                <span class="case-year">{{ $project->year }}</span>
                            </div>

                            <h3 class="case-title" id="project-{{ $project->slug }}">{{ $project->title }}</h3>
                            <p class="case-subtitle">{{ $project->subtitle }}</p>
                            <p class="case-summary">{{ $project->summary }}</p>

                            <ul class="tech-tags" aria-label="Technologies used">
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
                                    Source
                                    <span class="sr-only">for {{ $project->title }} (opens in a new tab)</span>
                                </a>

                                @if ($project->demo_url)
                                    <a
                                        class="text-link text-link--red"
                                        href="{{ $project->demo_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <x-site-icon name="download" :size="15" />
                                        {{ $project->demo_label }}
                                        <span class="sr-only">(opens in a new tab)</span>
                                    </a>
                                @endif

                                @if ($project->demo_note)
                                    <span class="demo-note">{{ $project->demo_note }}</span>
                                @endif
                            </div>

                            <details class="case-details">
                                <summary>
                                    <span>Read the full case file</span>
                                    <span class="summary-mark" aria-hidden="true">
                                        <x-site-icon name="plus" :size="16" />
                                    </span>
                                </summary>

                                <div class="case-body">
                                    <div class="case-block">
                                        <h4>The problem</h4>
                                        <p>{{ $project->problem }}</p>
                                    </div>

                                    <div class="case-block">
                                        <h4>The solution</h4>
                                        <p>{{ $project->solution }}</p>
                                    </div>

                                    @if (! empty($project->implementation))
                                        <div class="case-block">
                                            <h4>What is in the repository</h4>
                                            <ul class="case-list">
                                                @foreach ($project->implementation as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (! empty($project->decisions))
                                        <div class="case-block">
                                            <h4>Technical decisions</h4>
                                            <ul class="case-list">
                                                @foreach ($project->decisions as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (! empty($project->challenges))
                                        <div class="case-block">
                                            <h4>Challenges</h4>
                                            <ul class="case-list">
                                                @foreach ($project->challenges as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (! empty($project->results))
                                        <div class="case-block">
                                            <h4>Verifiable results</h4>
                                            <ul class="case-list">
                                                @foreach ($project->results as $item)
                                                    <li>{{ $item }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="evidence-note">
                                        <span class="evidence-label">Evidence note</span>
                                        <p>{{ $project->evidence_note }}</p>
                                    </div>
                                </div>
                            </details>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="projects-foot">
                <p>
                    Every file links to its public repository. Repositories without a verified live deployment do not get a demo link.
                </p>
                <a
                    class="text-link"
                    href="https://github.com/Bisminee?tab=repositories"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    Browse all repositories
                    <x-site-icon name="arrow-up-right" :size="15" />
                    <span class="sr-only">(opens in a new tab)</span>
                </a>
            </div>
        @endif
    </div>
</section>
