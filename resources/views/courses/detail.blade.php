@extends('layouts.app')

@section('jumbotron')
    @include('partials.courses.jumbotron')
@endsection
@push('styles')
    <style>
        body { background-size: cover;
            background-image: url("{{ asset('/images/scl.jpg')}}");
            background-position: center;
            background-repeat: no-repeat;

        }

    </style>
@endpush
@section('content')
    <div class="pl-5 pr-5 card ">
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
