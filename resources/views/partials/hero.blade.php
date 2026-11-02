@php($profile = config('site.profile'))

<section class="hero" id="top" aria-labelledby="hero-title">
    <div class="hero-halftone" aria-hidden="true"></div>

    <div class="shell hero-grid">
        <div class="hero-copy">
            <div class="hero-meta">
                <span class="meta-rule" aria-hidden="true"></span>
                <span>Case file no. 001</span>
                <span class="meta-dot" aria-hidden="true">◆</span>
                <span>{{ $profile['location'] }}</span>
                <span class="meta-dot" aria-hidden="true">◆</span>
                <span>2026</span>
            </div>

            <h1 class="hero-title" id="hero-title">
                <span class="hero-line">Bisma</span>
                <span class="hero-line hero-line--accent">Adhiaksa</span>
            </h1>

            <div class="hero-role">
                <span class="role-box">{{ $profile['title'] }}</span>
                <span class="role-note">Flutter · Laravel · PHP · Dart</span>
            </div>

            <p class="hero-lede">{{ $profile['tagline'] }}</p>

            <div class="hero-actions">
                <a class="btn btn--primary" href="#projects">
                    Explore case files
                    <x-site-icon name="arrow-down" :size="17" />
                </a>
                <a
                    class="btn btn--ghost"
                    href="{{ $profile['github'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <x-site-icon name="github" :size="17" />
                    View GitHub
                    <span class="sr-only">(opens in a new tab)</span>
                </a>
            </div>

            <p class="hero-note">
                <span class="note-mark" aria-hidden="true">✦</span>
                {{ $profile['microcopy'] }}
            </p>
        </div>

        <figure class="hero-plate" aria-labelledby="hero-art-caption">
            <span class="plate-stamp" aria-hidden="true">
                <span>PUBLIC</span>
                <span>WORK</span>
            </span>

            <div class="plate-frame">
                <img
                    src="{{ asset($profile['portrait']) }}"
                    alt="{{ $profile['portrait_alt'] }}"
                    width="720"
                    height="900"
                    fetchpriority="high"
                >
            </div>

            <figcaption class="plate-caption" id="hero-art-caption">
                <span class="caption-label">Original illustration</span>
                <span class="caption-text">Not a photograph. Ink, halftone, and a raven.</span>
            </figcaption>
        </figure>
    </div>

    <div class="shell hero-foot">
        <a class="scroll-cue" href="#about">
            <span class="scroll-cue-line" aria-hidden="true"></span>
            Turn the page
        </a>
        <span class="hero-edition">The repository edition · Vol. I</span>
    </div>
</section>

<div class="ticker" aria-hidden="true">
    <div class="ticker-track" aria-hidden="true">
        @foreach (['Flutter', 'Laravel', 'PHP', 'Dart', 'Java', 'Python', 'Filament', 'Git'] as $technology)
            <span class="ticker-item">{{ $technology }}</span>
            <span class="ticker-sep">◆</span>
        @endforeach
        @foreach (['Flutter', 'Laravel', 'PHP', 'Dart', 'Java', 'Python', 'Filament', 'Git'] as $technology)
            <span class="ticker-item">{{ $technology }}</span>
            <span class="ticker-sep">◆</span>
        @endforeach
    </div>
</div>
