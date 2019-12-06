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
    @include('partials.jumbotron', ['title' => __('Gestiona tu horario'), 'icon' => 'calendar'])
@endsection

@section('content')
    <form action="/teacher/schedule" method="post">
        @csrf
        <div class="card shadow ">
            <div class="card-header border-0 bg-dark text-warning pt-0">
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

                    @if (session('errors'))
                        <div class="alert alert-danger" role="alert">
                            {{__("Los cambios se han guardado pero:")}}
                            <ul>
                               @foreach( session('errors') as $error )
                                   <li>{{$error}}</li>
                                   @endforeach
                            </ul>

                        </div>
                    @endif

            </div>

            <div class="table-responsive text-warning ">
                <table class="table align-items-center">
                    <thead class="thead-light " style="font-size: 25px">
                    <tr class="bg-dark " >
                        <th class="bg-dark text-warning border-0 " scope="col" >{{__("Día")}}</th>
                        <th class="bg-dark text-warning  border-0" scope="col">{{__("Activo")}}</th>
                        <th class="bg-dark text-warning  border-0" scope="col">{{__("Turno mañana")}}</th>
                        <th class="bg-dark text-warning  border-0" scope="col">{{__("Turno tarde")}}</th>
                    </tr>
                    </thead>
                    <tbody class="text-warning bg-dark">
                    @foreach ($workDays as $key => $workDay )
                        <tr>
                            <th>{{ $days[$key] }}</th>
                            <td>
                                <label class="custom-toggle text-warning">
                                    <input type="checkbox"  name="active[]" value="{{ $key }}"{{ $workDay->active ? 'checked' : '' }} >

                                    <span class="custom-toggle-slider rounded-circle "></span>
                                </label>



                            </td>
                            <td>
                                <div class="row text-warning">
                                    <div class="col text-warning">
                                        <select class="form-control text-warning bg-dark" name="morning_start[]">
                                            @for ($i=5; $i<=11; $i++)
                                                <option value="{{($i <10 ? '0' : '' ). $i }}:00"
                                                    {{ $i.':00 AM' === $workDay->morning_start ? 'selected' : '' }}>
                                                    {{ $i }}:00 AM
                                                </option>
                                                <option value="{{ ($i <10 ? '0' : '' ).$i }}:30"
                                                    {{ $i.':30 AM' === $workDay->morning_start ? 'selected' : '' }}>
                                                    {{ $i }}:30 AM
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control bg-dark text-warning" name="morning_end[]">
                                            @for ($i=5; $i<=11; $i++)
                                                <option value="{{ ($i <10 ? '0' : '' ).$i }}:00"
                                                    {{ $i.':00 AM' === $workDay->morning_end ? 'selected' : '' }}>
                                                    {{ $i }}:00 AM
                                                </option>
                                                <option value="{{ ($i <10 ? '0' : '' ).$i }}:30"
                                                    {{ $i.':30 AM' === $workDay->morning_end ? 'selected' : '' }}>
                                                    {{ $i }}:30 AM
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col text-warning">
                                        <select class="form-control bg-dark text-warning" name="afternoon_start[]">
                                            @for ($i=1; $i<=11; $i++)
                                                <option  value="{{ $i+12 }}:00"
                                                    {{ $i.':00 PM' === $workDay->afternoon_start ? 'selected' : '' }}>
                                                    {{ $i+12 }}:00 PM
                                                </option>
                                                <option value="{{ $i+12 }}:30"
                                                    {{ $i.':30 PM' === $workDay->afternoon_start ? 'selected' : '' }}>
                                                    {{ $i+12 }}:30 PM
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control bg-dark text-warning" name="afternoon_end[]">
                                            @for ($i=1; $i<=11; $i++)
                                                <option value="{{ $i+12 }}:00"
                                                    {{ $i.':00 PM' === $workDay->afternoon_end ? 'selected' : '' }}>
                                                    {{ $i+12 }}:00 PM
                                                </option>
                                                <option value=" {{ $i+12 }}:30"
                                                    {{ $i.':30 PM' === $workDay->afternoon_end ? 'selected' : '' }}>
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
    </form>
@endsection
