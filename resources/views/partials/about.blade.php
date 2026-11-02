@php
    $profile = config('site.profile');
    $facts = config('site.facts');
@endphp

<section class="section about" id="about" aria-labelledby="about-title">
    <div class="shell">
        <x-section-head
            number="01"
            eyebrow="The origin story"
            title="Built in the open."
            id="about-title"
            lead="A developer’s record should survive a second look. This one is assembled from public repositories, commit history, and the documentation that came with them."
        />

        <div class="about-grid">
            <div class="about-copy">
                @foreach ($profile['intro'] as $index => $paragraph)
                    <p class="{{ $index === 0 ? 'about-lede' : '' }}">{{ $paragraph }}</p>
                @endforeach

                <div class="caption-box">
                    <span class="caption-box-label">Editor’s note</span>
                    <p>Team projects are labelled. Unfinished epics are called unfinished. Results are only claimed when the repository shows them.</p>
                </div>
            </div>

            <aside class="about-aside" aria-label="Profile facts">
                <div class="field-notes">
                    <h3 class="panel-title">Field notes</h3>
                    <dl class="facts">
                        @foreach ($facts as $fact)
                            <div class="fact">
                                <dt>{{ $fact['label'] }}</dt>
                                <dd>{{ $fact['value'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <div class="focus-panel" aria-label="Technical focus">
                    <h3 class="panel-title">Current focus</h3>
                    <ul class="focus-list">
                        @foreach ($profile['focus'] as $focus)
                            <li>
                                <span class="focus-label">{{ $focus['label'] }}</span>
                                <span class="focus-value">{{ $focus['value'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <p class="aside-note">
                    <x-site-icon name="map-pin" :size="14" />
                    {{ $profile['location'] }}. Education and employment details are omitted until confirmed.
                </p>
            </aside>
        </div>
    </div>
</section>
