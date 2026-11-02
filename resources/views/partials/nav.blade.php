@php
    $profile = config('site.profile');
    $navItems = [
        ['label' => 'About', 'href' => '#about'],
        ['label' => 'Case Files', 'href' => '#projects'],
        ['label' => 'Arsenal', 'href' => '#skills'],
        ['label' => 'Beyond Code', 'href' => '#beyond'],
        ['label' => 'Chronicle', 'href' => '#journey'],
        ['label' => 'Contact', 'href' => '#contact'],
    ];
@endphp

<header class="site-header" data-header>
    <div class="shell nav-shell">
        <a class="brand" href="#top">
            <span class="brand-mark" aria-hidden="true">BA</span>
            <span class="brand-copy">
                <span class="brand-name">{{ $profile['name'] }}</span>
                <span class="brand-sub">Case files · 2026</span>
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

        <nav id="primary-navigation" class="primary-nav" aria-label="Primary" data-nav>
            <ul class="nav-list">
                @foreach ($navItems as $item)
                    <li>
                        <a class="nav-link" href="{{ $item['href'] }}">{{ $item['label'] }}</a>
                    </li>
                @endforeach
                <li>
                    <a
                        class="nav-link nav-link--github"
                        href="{{ $profile['github'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        <x-site-icon name="github" :size="15" />
                        <span>GitHub</span>
                        <span class="sr-only">(opens in a new tab)</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header>
