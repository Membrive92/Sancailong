@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => 'Configura tu perfil', 'icon' => 'user-circle'])
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __("Actualiza tus datos") }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Correo electrónico") }}
                                </label>

                                <div class="col-md-6">
                                    <!-- uso el operador ternario para controlar si hay algun error en el email, si lo hay añado la clase -->
                                    <input
                                            id="email"
                                            type="email"
                                            readonly
                                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            name="email"
                                            value="{{ $user->email }}"
                                            required
                                            autofocus
                                    />


                                    @if($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                        for="password"
                                        class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __("Contraseña") }}
                                </label>

                                <div class="col-md-6">
                                    <input
                                            id="password"
                                            type="password"
                                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                            name="password"
                                            required
                                    />

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label
                                        for="password-confirm"
                                        class="col-md-4 col-form-label text-md-right"
                                >
                                    {{ __("Confirma la contraseña") }}
                                </label>

                                <div class="col-md-6">
                                    <input
                                            id="password-confirm"
                                            type="password"
                                            class="form-control"
                                            name="password_confirmation"
                                            required
                                    />
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-dark text-warning">
                                        {{ __("Actualizar datos") }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @if( ! $user->teacher)
                    <div class="card">
                        <div class="card-header">
                            {{ __("Convertirme en profesor de la plataforma") }}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('solicitude.teacher') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark btn-block text-warning">
                                    <i class="fa fa-graduation-cap"></i> {{ __("Solicitar") }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            {{ __("Administrar los cursos que imparto") }}
                        </div>
                        <div class="card-body">
                            <a href="{{ route('teacher.courses') }}" class="btn btn-dark btn-block text-warning">
                                <i class="fa fa-leanpub"></i> {{ __("Administrar ahora") }}
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            {{ __("Mis estudiantes") }}
                        </div>
                        <div class="card-body">
                            <table
                                    class="table table-striped table-bordered nowrap"
                                    cellspacing="0"
                                    id="students-table"
                            >
                                <thead>
                                <tr>
                                    <th>{{ __("ID") }}</th>
                                    <th>{{ __("Nombre") }}</th>
                                    <th>{{ __("Email") }}</th>
                                    <th>{{ __("Cursos") }}</th>
                                    <th>{{ __("Acciones") }}</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>
        var dt;
        var modal = $("#appModal");
        // utilizo jquery y el plugin datatable para configurar la tabla de como quiero que se muestren los estudiantes
        $(document).ready(function() {
            dt = $("#students-table").DataTable({
                pageLength: 5,
                lengthMenu: [5, 10, 25, 50, 75, 100],
                processing: true,
                serverSide: true,
                ajax: '{{ route('teacher.students') }}',
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'user.id', visible: false},
                    {data: 'user.name'},
                    {data: 'user.email'},
                    {data: 'courses_formatted'},
                    {data: 'actions'}
                ]
            });
        });


    </script>
@endpush