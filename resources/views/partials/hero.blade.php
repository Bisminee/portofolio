@php
    $profile = config('site.profile');
    $tickerItems = ['Flutter', 'Laravel', 'PHP', 'Dart', 'Java', 'Python', 'Filament', 'Git'];
@endphp

<section class="hero" id="top" aria-labelledby="hero-title">
    <div class="hero-halftone" aria-hidden="true"></div>

    <div class="shell hero-grid">
        <div class="hero-copy">
            <div class="hero-meta">
                <span class="meta-rule" aria-hidden="true"></span>
                <span data-i18n="hero.case">Case file no. 001</span>
                <span class="meta-dot" aria-hidden="true">◆</span>
                <span data-i18n="hero.location">{{ $profile['location'] }}</span>
                <span class="meta-dot" aria-hidden="true">◆</span>
                <span data-i18n="hero.year">2026</span>
            </div>

            <h1 class="hero-title" id="hero-title">
                <span class="hero-line">Bisma</span>
                <span class="hero-line hero-line--accent">Adhiaksa</span>
            </h1>

            <div class="hero-role">
                <span class="role-box" data-i18n="hero.role">{{ $profile['title'] }}</span>
                <span class="role-note" data-i18n="hero.roleNote">Flutter · Laravel · PHP · Dart</span>
            </div>

            <ul class="hero-tags" aria-label="IoT, C, C++" data-i18n-aria-label="hero.tagsLabel">
                <li>IoT</li>
                <li>C</li>
                <li>C++</li>
            </ul>

            <p class="hero-lede" data-i18n="hero.lede">{{ $profile['tagline'] }}</p>

            <div class="hero-actions">
                <a class="btn btn--primary" href="#projects">
                    <span data-i18n="hero.ctaProjects">Explore case files</span>
                    <x-site-icon name="arrow-down" :size="17" />
                </a>
                <a
                    class="btn btn--ghost"
                    href="{{ $profile['github'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    <x-site-icon name="github" :size="17" />
                    <span data-i18n="hero.ctaGithub">View GitHub</span>
                    <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                </a>
            </div>

            <p class="hero-note">
                <span class="note-mark" aria-hidden="true">✦</span>
                <span data-i18n="hero.note">{{ $profile['microcopy'] }}</span>
            </p>
        </div>

        <figure class="hero-plate" aria-labelledby="hero-art-caption">
            <span class="plate-stamp" aria-hidden="true">
                <span data-i18n="hero.stampPublic">PUBLIC</span>
                <span data-i18n="hero.stampWork">WORK</span>
            </span>

            <div class="plate-frame">
                <img
                    src="{{ asset($profile['portrait']) }}"
                    alt="{{ $profile['portrait_alt'] }}"
                    data-i18n-alt="hero.artAlt"
                    width="720"
                    height="900"
                    fetchpriority="high"
                >
            </div>

            <figcaption class="plate-caption" id="hero-art-caption">
                <span class="caption-label" data-i18n="hero.artLabel">Original illustration</span>
                <span class="caption-text" data-i18n="hero.artCaption">Not a photograph. Ink, halftone, and a raven.</span>
            </figcaption>
        </figure>
    </div>

    <div class="shell hero-foot">
        <a class="scroll-cue" href="#about">
            <span class="scroll-cue-line" aria-hidden="true"></span>
            <span data-i18n="hero.turnPage">Turn the page</span>
        </a>
        <span class="hero-edition" data-i18n="hero.edition">The repository edition · Vol. I</span>
    </div>
</section>

<div class="ticker" aria-hidden="true">
    <div class="ticker-track">
        @foreach (range(1, 2) as $group)
            <div class="ticker-group">
                @foreach (range(1, 6) as $repeat)
                    @foreach ($tickerItems as $technology)
                        <span class="ticker-item">{{ $technology }}</span>
                        <span class="ticker-sep">◆</span>
                    @endforeach
                @endforeach
            </div>
        @endforeach
    </div>
</div>
