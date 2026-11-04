@extends('layouts.app')

@section('content')
    @include('partials.hero')
    @include('partials.about')
    @include('partials.projects', ['projects' => $projects])
    @include('partials.skills')
    @include('partials.activities', ['activities' => $activities])
    @include('partials.journey')
    @include('partials.contact')
@endsection
