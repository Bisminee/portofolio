@php
    $profile = config('site.profile');
    $navItems = [
        ['label' => 'About', 'key' => 'nav.about', 'href' => '#about'],
        ['label' => 'Case Files', 'key' => 'nav.projects', 'href' => '#projects'],
        ['label' => 'Skills', 'key' => 'nav.skills', 'href' => '#skills'],
        ['label' => 'Activities', 'key' => 'nav.activities', 'href' => '#activities'],
        ['label' => 'Chronicle', 'key' => 'nav.journey', 'href' => '#journey'],
        ['label' => 'Contact', 'key' => 'nav.contact', 'href' => '#contact'],
    ];
@endphp

<header class="site-header" data-header>
    <div class="shell nav-shell">
        <a class="brand" href="#top">
            <span class="brand-mark" aria-hidden="true">BA</span>
            <span class="brand-copy">
                <span class="brand-name">{{ $profile['name'] }}</span>
                <span class="brand-sub" data-i18n="brand.sub">Case files · 2026</span>
            </span>
        </a>

        <button
            class="nav-toggle"
            type="button"
            aria-expanded="false"
            aria-controls="primary-navigation"
            data-nav-toggle
        >
            <span class="sr-only">Open navigation</span>
            <x-site-icon name="menu" :size="22" class="nav-toggle-open" />
            <x-site-icon name="close" :size="22" class="nav-toggle-close" />
        </button>

        <nav
            id="primary-navigation"
            class="primary-nav"
            aria-label="Primary"
            data-i18n-aria-label="nav.primary"
            data-nav
        >
            <ul class="nav-list">
                @foreach ($navItems as $item)
                    <li>
                        <a class="nav-link" href="{{ $item['href'] }}" data-i18n="{{ $item['key'] }}">{{ $item['label'] }}</a>
                    </li>
                @endforeach
                <li class="nav-lang">
                    <div
                        class="lang-switch"
                        role="group"
                        aria-label="Language"
                        data-i18n-aria-label="nav.language"
                        data-lang-switch
                    >
                        <button type="button" class="lang-btn is-active" data-lang="en" aria-pressed="true" lang="en">EN</button>
                        <span class="lang-sep" aria-hidden="true">/</span>
                        <button type="button" class="lang-btn" data-lang="id" aria-pressed="false" lang="id">ID</button>
                    </div>
                </li>
                <li>
                    <a
                        class="nav-link nav-link--github"
                        href="{{ $profile['github'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <x-site-icon name="github" :size="15" />
                        <span data-i18n="nav.github">GitHub</span>
                        <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
