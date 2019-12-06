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
    @include('partials.jumbotron', [
        "title" => __("Cursos disponibles para realizar"),
        "icon" => "film"
    ])
@endsection

@section('content')
    <div class="pl-5 pr-5 te">
        <div class="row justify-content-center">
            @forelse($courses as $course)
                <div class="col-md-3">
                  @include('partials.courses.card_course')
                </div>

            @empty
                <div class="alert alert-dark">
                    {{ __("No hay ningún curso disponible") }}
                </div>
            @endforelse
        </div>
        <div class="row justify-content-center text-warning">
            {{ $courses->links() }}
        </div>
    </div>
@endsection
