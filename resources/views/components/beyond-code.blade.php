@props(['skills'])

@php($content = config('site.beyond_code'))

<section class="section beyond" id="beyond" aria-labelledby="beyond-title">
    <div class="shell">
        <x-section-head
            number="04"
            eyebrow="{{ $content['eyebrow'] }}"
            title="{{ $content['title'] }}"
            id="beyond-title"
            lead="{{ $content['subtitle'] }}"
        />

        @if ($skills->isEmpty())
            <div class="beyond-blank">
                <span class="blank-corner blank-corner--tl" aria-hidden="true"></span>
                <span class="blank-corner blank-corner--tr" aria-hidden="true"></span>
                <span class="blank-corner blank-corner--bl" aria-hidden="true"></span>
                <span class="blank-corner blank-corner--br" aria-hidden="true"></span>

                <div class="blank-plate" aria-hidden="true">
                    <span class="blank-diamond">
                        <x-site-icon name="quill" :size="26" />
                    </span>
                </div>

                <p class="blank-note">{{ $content['empty_note'] }}</p>
                <p class="blank-hint">{{ $content['empty_hint'] }}</p>
            </div>
        @else
            <ul class="beyond-grid">
                @foreach ($skills as $skill)
                    <li class="beyond-card">
                        <span class="beyond-icon" aria-hidden="true">
                            <x-site-icon :name="$skill->icon ?: 'spark'" :size="20" />
                        </span>

                        @if ($skill->category)
                            <span class="beyond-category">{{ $skill->category }}</span>
                        @endif

                        <h3 class="beyond-name">{{ $skill->name }}</h3>

                        @if ($skill->description)
                            <p class="beyond-description">{{ $skill->description }}</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</section>
