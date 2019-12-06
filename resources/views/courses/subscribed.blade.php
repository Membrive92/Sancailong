@extends('layouts.app')
@push('styles')
    <style>
        body { background-size: cover;
            background-image: url("{{ asset('/images/scl.jpg')}}");
            background-position: center;
            background-repeat: no-repeat;

        }

    </style>
@endpush
@section('jumbotron')
    @include('partials.jumbotron', ['title' => __('Cursos a los que estás suscrito'), 'icon' => 'table'])
@endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            @forelse($courses as $course)
                <div class="col-md-3">
                    @include('partials.courses.card_course')
                </div>
            @empty
                <div class="alert alert-dark bg-dark text-warning">{{ __("Todavía no estás suscrito a ningún curso") }}</div>
            @endforelse
        </div>
    </div>
@endsection
