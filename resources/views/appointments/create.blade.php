
@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __("Reserva tu Cita"), 'icon' => 'book'])
@endsection

@section('content')
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="mb-0">{{__("Registrar nueva cita")}}</h3>
                </div>
                <div class="col text-right">
                    <a href="{{ url('patients') }}" class="btn btn-sm btn-default">
                        Cancelar y volver
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ url('patients') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="name">{{ __('Cursos') }}</label>
                    <select name="" id="" class="form-control">
                    @foreach($courses as $course)
                        <option value="{{$course->id}}">{{$course->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="email">{{__('Profesor')}}</label>
                    <select name="" id="" class="form-control"></select>
                </div>
                <div class="form-group">
                    <label for="dni">{{__('Fecha')}}</label>
                    <input type="text" name="dni" class="form-control datepicker" value="{{ old('dni') }}">
                </div>
                <div class="form-group">
                    <label for="address">{{__('Hora de cita')}}</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono / móvil</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input type="text" name="password" class="form-control" value="{{ str_random(6) }}">
                </div>
                <button type="submit" class="btn btn-primary">
                    Guardar
                </button>
            </form>
        </div>
    </div>
@endsection