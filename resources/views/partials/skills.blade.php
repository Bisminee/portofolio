@php($groups = config('site.skill_groups'))

<section class="section skills" id="skills" aria-labelledby="skills-title">
    <div class="shell">
        <x-section-head
            number="03"
            eyebrow="The arsenal"
            eyebrow-key="skills.eyebrow"
            title="Tools with receipts."
            title-key="skills.title"
            id="skills-title"
            lead="Grouped from repository evidence. No proficiency percentages, because a language appearing in one repository does not prove mastery."
            lead-key="skills.lead"
        />

        <div class="skill-grid">
            @foreach ($groups as $group)
                <section class="skill-panel" aria-labelledby="skill-{{ $loop->index }}">
                    <span class="skill-number" aria-hidden="true">{{ $group['number'] }}</span>
                    <h3 class="skill-title" id="skill-{{ $loop->index }}" data-i18n="skills.group.{{ $loop->index }}.title">{{ $group['title'] }}</h3>
                    <p class="skill-note" data-i18n="skills.group.{{ $loop->index }}.note">{{ $group['note'] }}</p>
                    <ul class="skill-tags">
                        @foreach ($group['skills'] as $skill)
                            <li>{{ $skill }}</li>
                        @endforeach
                    </ul>
                </section>
            @endforeach
        </div>

        <p class="skills-footnote">
            <span aria-hidden="true">◆</span>
            <span data-i18n="skills.footnote">
                Evidence base: repository languages, manifests, migrations, README files, and commit history reviewed in October 2026.
            </span>
        </p>
    </div>
</section>
