@extends('layouts.app')

@section('title', 'Page not found — Bisma Adhiaksa')
@section('description', 'The requested page could not be found.')
@section('page', 'error')

@section('head')
    <meta name="robots" content="noindex">
@endsection

@section('content')
    <section class="error-page" aria-labelledby="error-title">
        <div class="error-halftone" aria-hidden="true"></div>
        <div class="shell error-inner">
            <p class="hero-meta">
                <span data-i18n="error.eyebrow">Error 404</span>
                <span class="meta-dot">◆</span>
                <span data-i18n="error.missing">Missing panel</span>
            </p>
            <h1 class="error-code" aria-hidden="true">404</h1>
            <h2 class="error-title" id="error-title" data-i18n="error.heading">This page has vanished into the fog.</h2>
            <p class="error-text" data-i18n="error.text">
                The address may be wrong, or the panel was never printed. Return to the cover and continue from there.
            </p>
            <div class="hero-actions">
                <a class="btn btn--primary" href="{{ url('/') }}">
                    <span data-i18n="error.cta">Back to the cover</span>
                    <x-site-icon name="arrow-down" :size="17" />
                </a>
                <a class="btn btn--ghost" href="https://github.com/Bisminee" target="_blank" rel="noopener noreferrer">
                    <x-site-icon name="github" :size="17" />
                    <span data-i18n="nav.github">GitHub</span>
                    <span class="sr-only" data-i18n="a11y.newTab">(opens in a new tab)</span>
                </a>
            </div>
        </div>
    </section>
@endsection
