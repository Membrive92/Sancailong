@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __("Administrar cursos"), 'icon' => 'unlock-alt'])
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
    <div class="pl-5 pr-5 text-warning">
        <courses-list
                :labels="{{ json_encode([
                'name' => __("Nombre"),
                'status' => __("Estado"),
                'activate_deactivate' => __("Activar / Desactivar"),
                'approve' => __("Aprobar"),
                'reject' => __("Rechazar")
            ]) }}"
                route="{{ route('admin.courses_json') }}"
        >
        </courses-list>
    </div>
@endsection
