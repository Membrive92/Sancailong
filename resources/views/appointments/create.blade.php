
@extends('layouts.app')


@section('jumbotron')
    @include('partials.jumbotron', ['title' => __("Reserva tu Cita"), 'icon' => 'book'])
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
    <div class="card shadow">
        <div class="card-header border-0 text-warning bg-dark">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0 ">{{__("Registrar nueva cita")}}</h3>
                </div>
                <div class="col text-right">
                    <a href="" class="btn bg-dark text-warning">
                       {{__("Cancelar y volver")}}
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body text-warning bg-dark">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="" method="post" >
                @csrf
                <div class="form-group  ">
                    <label for="name">{{ __('Cursos') }}</label>
                    <select name="course_id" id="course" class="form-control">
                    @foreach($courses as $course)
                        <option  value="{{$course->id}}">{{$course->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">{{__('Profesor')}}</label>
                    <input type="text" name="teacher_id" id="teacher" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="Fecha">{{__('Fecha')}}</label>
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        <input class="form-control datepicker" placeholder="{{__("Seleccionar fecha")}}" type="text" value="">
                    </div>
                </div>

                <button type="submit" class="btn  text-warning bg-dark">
                    {{__("Guardar")}}
                </button>
            </form>
        </div>
    </div>
@endsection


