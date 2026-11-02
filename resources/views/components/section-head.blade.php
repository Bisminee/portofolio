@props(['number', 'eyebrow', 'title', 'lead' => null, 'id' => null])

<div class="section-head">
    <div class="section-kicker">
        <span class="section-number" aria-hidden="true">{{ $number }}</span>
        <span class="section-eyebrow">{{ $eyebrow }}</span>
        <span class="section-rule" aria-hidden="true"></span>
    </div>

    <h2 class="section-title" @if ($id) id="{{ $id }}" @endif>{{ $title }}</h2>

    @if ($lead)
        <p class="section-lead">{{ $lead }}</p>
    @endif
</div>
