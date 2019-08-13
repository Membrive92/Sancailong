@extends('layouts.app')


@section('jumbotron')
    @include('partials.jumbotron',['title' => 'Mis Cursos Creados','icon' => 'building' ])
    @endsection

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            @forelse($courses as $course)
                <div class="col-md-8 offset-2 card card-body">
                    <div class="media col-sm-12" style="height: 200px;">
                        <img
                                style="height: 200px; width: 300px;"
                                class="img-rounded"
                                src="{{ $course->pathAttachment() }}"
                                alt="{{ $course->name }}"
                        />

                        <div class="media-body pl-3" style="height: 200px">
                            <div class="">
                                <h2 class="badge-dark  text-warning text-center">
                                    {{ $course->category->name }}
                                </h2>
                                <h4>{{ __("Curso") }}: {{ $course->name }}</h4>
                                <h4>{{ __("Estudiantes") }}: {{ $course->students_count }}</h4>
                            </div>

                            <div class="stats col-12 ">
                                {{ $course->created_at->format('d/m/Y') }}
                                @include('partials.courses.rating', ['rating' => $course->custom_rating])
                            </div>

                            @include('partials.courses.teacher_action_buttons')
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-dark text-warning">
                    {{ __("No tienes ningún curso todavía") }}<br />
                    <a class="btn btn-course btn-block" href="{{ route('courses.create') }}">
                        {{ __("Crear mi primer curso!") }}
                    </a>
                </div>
            @endforelse
        </div>

        <div class="row justify-content-center">
            {{ $courses->links() }}
        </div>
    </div>
@endsection