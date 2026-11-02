@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.about')
    @include('partials.projects', ['projects' => $projects])
    @include('partials.skills')
    <x-beyond-code :skills="$beyondSkills" />
    @include('partials.journey')
    @include('partials.contact')
@endsection
