@php($profile = config('site.profile'))

<footer class="site-footer">
    <div class="shell footer-grid">
        <div class="footer-brand">
            <span class="footer-mono" aria-hidden="true">BA</span>
            <div>
                <p class="footer-name">{{ $profile['name'] }}</p>
                <p class="footer-role">{{ $profile['title'] }} · {{ $profile['location'] }}</p>
            </div>
        </div>

        <nav class="footer-nav" aria-label="Footer">
            <a href="#about">About</a>
            <a href="#projects">Case files</a>
            <a href="#skills">Arsenal</a>
            <a href="#beyond">Beyond Code</a>
            <a href="#contact">Contact</a>
            <a href="{{ $profile['github'] }}" target="_blank" rel="noopener noreferrer">
                GitHub
                <span class="sr-only">(opens in a new tab)</span>
            </a>
        </nav>

        <div class="footer-meta">
            <p class="footer-caption">“End of case file. The ink is still wet.”</p>
            <p>© {{ now()->year }} {{ $profile['name'] }}. Built with Laravel {{ Illuminate\Foundation\Application::VERSION }} and Filament.</p>
            <p class="footer-note">Case illustration artwork is original. Project screenshots are not presented where none exist.</p>
        </div>
    </div>
</footer>
