@php($groups = config('site.skill_groups'))

<section class="section skills" id="skills" aria-labelledby="skills-title">
    <div class="shell">
        <x-section-head
            number="03"
            eyebrow="The arsenal"
            title="Tools with receipts."
            id="skills-title"
            lead="Grouped from repository evidence. No proficiency percentages, because a language appearing in one repository does not prove mastery."
        />

        <div class="skill-grid">
            @foreach ($groups as $group)
                <section class="skill-panel" aria-labelledby="skill-{{ $loop->index }}">
                    <span class="skill-number" aria-hidden="true">{{ $group['number'] }}</span>
                    <h3 class="skill-title" id="skill-{{ $loop->index }}">{{ $group['title'] }}</h3>
                    <p class="skill-note">{{ $group['note'] }}</p>
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
            Evidence base: repository languages, manifests, migrations, README files, and commit history reviewed in October 2026.
        </p>
    </div>
</section>
