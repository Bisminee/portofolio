@php
    $profile = config('site.profile');
    $facts = config('site.facts');
@endphp

<section class="section about" id="about" aria-labelledby="about-title">
    <div class="shell">
        <x-section-head
            number="01"
            eyebrow="The origin story"
            eyebrow-key="about.eyebrow"
            title="Built in the open."
            title-key="about.title"
            id="about-title"
            lead="A developer’s record should survive a second look. This one is assembled from public repositories, commit history, and the documentation that came with them."
            lead-key="about.lead"
        />

        <div class="about-grid">
            <div class="about-copy">
                @foreach ($profile['intro'] as $index => $paragraph)
                    <p class="{{ $index === 0 ? 'about-lede' : '' }}" data-i18n="about.p{{ $index + 1 }}">{{ $paragraph }}</p>
                @endforeach

                <div class="caption-box">
                    <span class="caption-box-label" data-i18n="about.editorLabel">Editor’s note</span>
                    <p data-i18n="about.editorText">Team projects are labelled. Unfinished epics are called unfinished. Results are only claimed when the repository shows them.</p>
                </div>
            </div>

            <aside class="about-aside" aria-label="Profile facts" data-i18n-aria-label="about.factsLabel">
                <div class="field-notes">
                    <h3 class="panel-title" data-i18n="about.notes">Field notes</h3>
                    <dl class="facts">
                        @foreach ($facts as $fact)
                            <div class="fact">
                                <dt data-i18n="about.fact.{{ $loop->index }}">{{ $fact['label'] }}</dt>
                                <dd>{{ $fact['value'] }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <div class="focus-panel" aria-label="Technical focus" data-i18n-aria-label="about.focusLabel">
                    <h3 class="panel-title" data-i18n="about.focusTitle">Current focus</h3>
                    <ul class="focus-list">
                        @foreach ($profile['focus'] as $focus)
                            <li>
                                <span class="focus-label" data-i18n="about.focus.{{ $loop->index }}">{{ $focus['label'] }}</span>
                                <span class="focus-value">{{ $focus['value'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <p class="aside-note">
                    <x-site-icon name="map-pin" :size="14" />
                    <span data-i18n="about.aside">Indonesia. Education and employment details are omitted until confirmed.</span>
                </p>
            </aside>
        </div>
    </div>
</section>
