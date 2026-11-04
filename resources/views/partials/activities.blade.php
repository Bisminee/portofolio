@php
    $typeKeys = [
        'organization' => 'activities.type.organization',
        'competition' => 'activities.type.competition',
        'community' => 'activities.type.community',
        'volunteer' => 'activities.type.volunteer',
        'workshop' => 'activities.type.workshop',
        'speaking' => 'activities.type.speaking',
    ];

    $teamKeys = [
        'team' => 'activities.team.team',
        'leadership' => 'activities.team.leadership',
        'individual' => 'activities.team.individual',
    ];

    $teamLabels = [
        'team' => 'Team',
        'leadership' => 'Team / leadership',
        'individual' => 'Individual',
    ];
@endphp

<section class="section activities" id="activities" aria-labelledby="activities-title">
    <div class="shell">
        <x-section-head
            number="04"
            eyebrow="Beyond the code"
            eyebrow-key="activities.eyebrow"
            title="Activities & Involvement"
            title-key="activities.title"
            id="activities-title"
            lead="Organizational involvement, leadership, community work, competitions, and creative practice — with documentation and honest scope."
            lead-key="activities.lead"
        />

        @if ($activities->isEmpty())
            <div class="empty-state">
                <p data-i18n="activities.empty">Activities are being verified.</p>
            </div>
        @else
            <div class="activity-grid">
                @foreach ($activities as $activity)
                    @php
                        $related = $activity->related_slug
                            ? $activities->firstWhere('slug', $activity->related_slug)
                            : null;
                    @endphp

                    <article
                        class="activity-card {{ $loop->first ? 'is-featured' : '' }}"
                        id="activity-{{ $activity->slug }}"
                        aria-labelledby="activity-title-{{ $activity->slug }}"
                    >
                        <figure class="activity-art">
                            <span class="art-badge" data-i18n="activities.documented">Activity documentation</span>
                            <img
                                src="{{ asset('images/activities/'.$activity->image_path) }}"
                                alt="{{ $activity->image_alt_en }}"
                                data-activity="{{ $activity->slug }}"
                                data-activity-alt
                                loading="{{ $loop->first ? 'eager' : 'lazy' }}"
                                decoding="async"
                            >
                            <figcaption class="art-caption" data-i18n="activities.documented">Activity documentation</figcaption>
                        </figure>

                        <div class="activity-content">
                            <div class="activity-meta">
                                <span class="activity-no">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="tag tag--activity" data-i18n="{{ $typeKeys[$activity->type] ?? 'activities.type.organization' }}">
                                    {{ ucfirst($activity->type) }}
                                </span>
                                <span class="activity-team" data-i18n="{{ $teamKeys[$activity->team_type] ?? 'activities.team.team' }}">
                                    {{ $teamLabels[$activity->team_type] ?? 'Team' }}
                                </span>
                            </div>

                            <h3 class="activity-title" id="activity-title-{{ $activity->slug }}">{{ $activity->name }}</h3>
                            <p class="activity-org">{{ $activity->organization }}</p>

                            <dl class="activity-facts">
                                <div>
                                    <dt data-i18n="activities.role">Role</dt>
                                    <dd data-activity="{{ $activity->slug }}" data-activity-text="role">{{ $activity->role_en }}</dd>
                                </div>
                                <div>
                                    <dt data-i18n="activities.period">Period</dt>
                                    <dd data-activity="{{ $activity->slug }}" data-activity-text="period">{{ $activity->period('en') }}</dd>
                                </div>
                            </dl>

                            <p class="activity-description" data-activity="{{ $activity->slug }}" data-activity-text="description">
                                {{ $activity->description_en }}
                            </p>

                            <ul class="activity-highlights">
                                @foreach (array_slice($activity->highlights_en ?? [], 0, 2) as $highlight)
                                    <li data-activity="{{ $activity->slug }}" data-activity-field="highlights" data-activity-index="{{ $loop->index }}">
                                        {{ $highlight }}
                                    </li>
                                @endforeach
                            </ul>

                            <div class="activity-actions">
                                @if ($activity->evidence_url)
                                    <a
                                        class="text-link"
                                        href="{{ $activity->evidence_url }}"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <x-site-icon name="arrow-up-right" :size="15" />
                                        <span data-i18n="activities.documentation">Documentation</span>
                                        <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                                    </a>
                                @endif

                                <details class="activity-details">
                                    <summary>
                                        <span data-i18n="activities.read">Read the full activity</span>
                                        <span class="summary-mark" aria-hidden="true">
                                            <x-site-icon name="plus" :size="16" />
                                        </span>
                                    </summary>

                                    <div class="activity-body">
                                        <div class="activity-block">
                                            <h4 data-i18n="activities.responsibilities">Responsibilities</h4>
                                            <p data-activity="{{ $activity->slug }}" data-activity-text="description">
                                                {{ $activity->description_en }}
                                            </p>
                                        </div>

                                        <div class="activity-main-preview">
                                            <img
                                                src="{{ asset('images/activities/'.$activity->image_path) }}"
                                                alt="{{ $activity->image_alt_en }}"
                                                data-activity="{{ $activity->slug }}"
                                                data-activity-alt
                                                loading="lazy"
                                                decoding="async"
                                            >
                                        </div>

                                        <div class="activity-block">
                                            <h4 data-i18n="activities.highlights">Highlights</h4>
                                            <ul class="activity-highlight-list">
                                                @foreach ($activity->highlights_en ?? [] as $highlight)
                                                    <li data-activity="{{ $activity->slug }}" data-activity-field="highlights" data-activity-index="{{ $loop->index }}">
                                                        {{ $highlight }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>

                                        @if (! empty($activity->technologies))
                                            <div class="activity-block">
                                                <h4 data-i18n="activities.technologies">Technologies</h4>
                                                <ul class="tech-tags">
                                                    @foreach ($activity->technologies as $technology)
                                                        <li>{{ $technology }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="activity-block">
                                            <h4 data-i18n="activities.details">Details</h4>
                                            <dl class="activity-detail-list">
                                                <div>
                                                    <dt data-i18n="activities.team">Participation</dt>
                                                    <dd data-i18n="{{ $teamKeys[$activity->team_type] ?? 'activities.team.team' }}">
                                                        {{ $teamLabels[$activity->team_type] ?? 'Team' }}
                                                    </dd>
                                                </div>
                                                <div>
                                                    <dt data-i18n="activities.period">Period</dt>
                                                    <dd data-activity="{{ $activity->slug }}" data-activity-text="period">{{ $activity->period('en') }}</dd>
                                                </div>
                                                <div>
                                                    <dt data-i18n="activities.category">Category</dt>
                                                    <dd data-i18n="{{ $typeKeys[$activity->type] ?? 'activities.type.organization' }}">
                                                        {{ ucfirst($activity->type) }}
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>

                                        @if (! empty($activity->gallery))
                                            <div class="activity-gallery">
                                                @foreach ($activity->gallery as $image)
                                                    <img
                                                        src="{{ asset('images/activities/'.$image) }}"
                                                        alt="{{ $activity->image_alt_en }}"
                                                        data-activity="{{ $activity->slug }}"
                                                        data-activity-alt
                                                        loading="lazy"
                                                        decoding="async"
                                                    >
                                                @endforeach
                                            </div>
                                        @endif

                                        @if ($related)
                                            <p class="activity-related">
                                                <span data-i18n="activities.related">Related activity</span>
                                                <a href="#activity-{{ $related->slug }}">{{ $related->name }}</a>
                                            </p>
                                        @endif
                                    </div>
                                </details>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>
