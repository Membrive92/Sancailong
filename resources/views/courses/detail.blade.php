@extends('layouts.app')

@section('jumbotron')
    @include('partials.courses.jumbotron')
@endsection

@section('content')
    <div class="pl-5 pr-5 card " style="background: rgba(184,52,53,0.86)">
        <div class="row justify-content-center">
            @can('watch', $course)
            @include('partials.courses.video')
            @endcan

            @include('partials.courses.goals', ['goals' => $course->goals])
            @include('partials.courses.requirements', ['requirements' => $course->requirements])
            @include('partials.courses.description' ,['description' => $course->description])
            @include('partials.courses.form_review')
        </div>
        @include('partials.courses.reviews')
    </div>
@endsection
