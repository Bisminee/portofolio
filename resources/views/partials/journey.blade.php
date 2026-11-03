@php($journey = config('site.journey'))

<section class="section journey" id="journey" aria-labelledby="journey-title">
    <div class="shell">
        <x-section-head
            number="05"
            eyebrow="The chronicle"
            eyebrow-key="journey.eyebrow"
            title="A public record, in order."
            title-key="journey.title"
            id="journey-title"
            lead="Compiled from repository activity between August 2024 and October 2026. This is a development timeline, not a CV — employment and education are omitted until confirmed."
            lead-key="journey.lead"
        />

        <ol class="timeline">
            @foreach ($journey as $entry)
                <li class="timeline-item">
                    <span class="timeline-period" data-journey-index="{{ $loop->index }}" data-journey-field="period">{{ $entry['period'] }}</span>
                    <div class="timeline-body">
                        <h3 data-journey-index="{{ $loop->index }}" data-journey-field="title">{{ $entry['title'] }}</h3>
                        <p data-journey-index="{{ $loop->index }}" data-journey-field="body">{{ $entry['body'] }}</p>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>
