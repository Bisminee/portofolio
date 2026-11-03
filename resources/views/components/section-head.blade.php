@props([
    'number',
    'eyebrow',
    'title',
    'lead' => null,
    'id' => null,
    'eyebrowKey' => null,
    'titleKey' => null,
    'leadKey' => null,
])

<div class="section-head">
    <div class="section-kicker">
        <span class="section-number" aria-hidden="true">{{ $number }}</span>
        <span class="section-eyebrow" @if ($eyebrowKey) data-i18n="{{ $eyebrowKey }}" @endif>{{ $eyebrow }}</span>
        <span class="section-rule" aria-hidden="true"></span>
    </div>

    <h2 class="section-title" @if ($id) id="{{ $id }}" @endif @if ($titleKey) data-i18n="{{ $titleKey }}" @endif>{{ $title }}</h2>

    @if ($lead)
        <p class="section-lead" @if ($leadKey) data-i18n="{{ $leadKey }}" @endif>{{ $lead }}</p>
    @endif
</div>
