<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#101010">

    <title>@yield('title', 'Bisma Adhiaksa — Mobile & Web Developer')</title>
    <meta name="description" content="@yield('description', 'Portfolio of Bisma Adhiaksa, a mobile and web developer from Indonesia working with Flutter, Laravel, PHP, Dart and Java. Case files from real repositories, not stock promises.')">
    <meta name="author" content="Bisma Adhiaksa">
    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Bisma Adhiaksa — Portfolio">
    <meta property="og:title" content="@yield('og_title', 'Bisma Adhiaksa — Mobile & Web Developer')">
    <meta property="og:description" content="@yield('description', 'A dark-fantasy graphic-novel portfolio built from verified repository work: Flutter, Laravel, PHP, Dart, Java and Python.')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/og-cover.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Bisma Adhiaksa — case files from the repository.">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'Bisma Adhiaksa — Mobile & Web Developer')">
    <meta name="twitter:description" content="@yield('description', 'A dark-fantasy graphic-novel portfolio built from verified repository work.')">
    <meta name="twitter:image" content="{{ asset('images/og-cover.png') }}">
    @yield('head')

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preload" href="{{ asset('fonts/anton-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="{{ asset('fonts/lora-400-latin.woff2') }}" as="font" type="font/woff2" crossorigin>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}?v=1.4.0">

    <script>
        try {
            if (localStorage.getItem('portfolio-language') === 'id') {
                document.documentElement.lang = 'id';
            }
        } catch (error) {}
    </script>

    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@type": "Person",
      "name": "Bisma Adhiaksa",
      "jobTitle": "Mobile & Web Developer",
      "url": "{{ url('/') }}",
      "sameAs": ["https://github.com/Bisminee"],
      "address": { "@@type": "PostalAddress", "addressCountry": "ID" },
      "knowsAbout": ["Flutter", "Laravel", "PHP", "Dart", "Java", "Python"]
    }
    </script>
</head>
<body data-page="@yield('page', 'home')">
    <a class="skip-link" href="#main" data-i18n="a11y.skip">Skip to content</a>
    <div class="grain" aria-hidden="true"></div>

    @include('partials.nav')

    <main id="main">
        @yield('content')
    </main>

    @include('partials.footer')

    <script type="application/json" id="portfolio-translations">
        {!! json_encode([
            'ui' => config('translations.ui'),
            'projects' => config('translations.projects'),
            'journey' => config('translations.journey'),
            'activities' => isset($activities)
                ? $activities->mapWithKeys(fn ($activity) => [$activity->slug => $activity->translationData()])->all()
                : [],
            'meta' => config('translations.meta'),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
    </script>
    <script src="{{ asset('js/site.js') }}?v=1.4.0" defer></script>
</body>
</html>
