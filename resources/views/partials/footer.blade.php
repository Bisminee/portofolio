@php($profile = config('site.profile'))

<footer class="site-footer">
    <div class="shell footer-grid">
        <div class="footer-brand">
            <span class="footer-mono" aria-hidden="true">BA</span>
            <div>
                <p class="footer-name">{{ $profile['name'] }}</p>
                <p class="footer-role" data-i18n="footer.role">{{ $profile['title'] }} · {{ $profile['location'] }}</p>
            </div>
        </div>

        <nav class="footer-nav" aria-label="Footer" data-i18n-aria-label="footer.navLabel">
            <a href="#about" data-i18n="nav.about">About</a>
            <a href="#projects" data-i18n="nav.projects">Case files</a>
            <a href="#skills" data-i18n="nav.skills">Skills</a>
            <a href="#activities" data-i18n="nav.activities">Activities</a>
            <a href="#journey" data-i18n="nav.journey">Chronicle</a>
            <a href="#contact" data-i18n="nav.contact">Contact</a>
            <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer">
                <span data-i18n="nav.github">GitHub</span>
                <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
            </a>
        </nav>

        <div class="footer-meta">
            <p class="footer-caption" data-i18n="footer.caption">“End of case file. The ink is still wet.”</p>
            <p>© {{ now()->year }} {{ $profile['name'] }}. <span data-i18n="footer.built">Built with Laravel and Filament.</span></p>
            <p class="footer-note" data-i18n="footer.note">Case illustration artwork is original. Project screenshots are not presented where none exist.</p>
        </div>
    </div>
</footer>
