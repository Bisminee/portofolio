@php($journey = config('site.journey'))

<section class="section journey" id="journey" aria-labelledby="journey-title">
    <div class="shell">
        <x-section-head
            number="05"
            eyebrow="The chronicle"
            title="A public record, in order."
            id="journey-title"
            lead="Compiled from repository activity between August 2024 and October 2026. This is a development timeline, not a CV — employment and education are omitted until confirmed."
        />

        <ol class="timeline">
            @foreach ($journey as $entry)
                <li class="timeline-item">
                    <span class="timeline-dot" aria-hidden="true"></span>
                    <span class="timeline-period">{{ $entry['period'] }}</span>
                    <div class="timeline-body">
                        <h3>{{ $entry['title'] }}</h3>
                        <p>{{ $entry['body'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>
