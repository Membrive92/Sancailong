@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __('Gestiona tu horario'), 'icon' => 'calendar'])
@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
    <style>
        body { background-size: cover;
            background-image: url("{{ asset('/images/scl.jpg')}}");
            background-position: center;
            background-repeat: no-repeat;

        }

    </style>

@endpush
@section('content')
    <form action="/teacher/schedule" method="post">
        @csrf
        <div class="card shadow text-warning bg-dark">
            <div class="card-header border-0 text-warning bg-dark">
                <div class="row align-items-center ">
                    <div class="col">
                        <h3 class="mb-0">{{__("Gestionar Horario")}}</h3>
                    </div>
                    <div class="col text-right">
                        <button type="submit"
                                class="btn btn-sm btn-dark text-warning">{{__("Guardar Cambios")}}</button>

                    </div>
                </div>
            </div>
            <div class="card-body">
                @if (session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{ session('notification') }}
                    </div>
                @endif

            </div>

            <div class="table-responsive bg-dark text-warning">
                <table class="table align-items-center table-flush bg-dark text-warning">
                    <thead class="thead-light ">
                    <tr style="font-size: 25px">
                        <th class="text-warning bg-dark" scope="col">{{__('Día')}}</th>
                        <th class="text-warning bg-dark" scope="col">{{__('Activo')}}</th>
                        <th class="text-warning bg-dark" scope="col">{{__('Turno mañana')}}</th>
                        <th class="text-warning bg-dark"  scope="col">{{__('Turno tarde')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($days as $key => $day )
                        <tr>
                            <th>{{ $day }}</th>
                            <td>
                                <label class="custom-toggle text-warning bg-dark">
                                    <input type="checkbox" name="active[]" value="{{ $key }}">
                                    <span class="custom-toggle-slider rounded-circle"></span>
                                </label>



                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <select class="form-control text-warning bg-dark " name="morning_start[]">
                                            @for ($i=5; $i<=11; $i++)
                                                <option value="{{ $i }}:00">
                                                    {{ $i }}:00 AM
                                                </option>
                                                <option value="{{ $i }}:30">
                                                    {{ $i }}:30 AM
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control  text-warning bg-dark" name="morning_end[]">
                                            @for ($i=5; $i<=11; $i++)
                                                <option value="{{ $i }}:00">

                                                    {{ $i }}:00 AM
                                                </option>
                                                <option value="{{ $i }}:30"
                                                >
                                                    {{ $i }}:30 AM
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col">
                                        <select class="form-control  text-warning bg-dark" name="afternoon_start[]">
                                            @for ($i=1; $i<=11; $i++)
                                                <option value="{{ $i }}:00"
                                                >
                                                    {{ $i+12 }}:00 PM
                                                </option>
                                                <option value="{{ $i }}:30"
                                                >
                                                    {{ $i+12 }}:30 PM
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control  text-warning bg-dark" name="afternoon_end[]">
                                            @for ($i=1; $i<=11; $i++)
                                                <option value="{{ $i }}:00"
                                                >
                                                    {{ $i+12 }}:00 PM
                                                </option>
                                                <option value=" {{ $i }}:30"
                                                >
                                                    {{ $i+12 }}:30 PM
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        </div>
    </form>
@endsection
