@extends('layouts.app')

@section('jumbotron')
    @include('partials.jumbotron', ['title' => __("Configura tu perfil"), 'icon' => 'user-circle'])
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
    <div class="pl-5 pr-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-warning bg-dark">
                        {{ __("Actualiza tus datos") }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('profile.update') }}"  enctype="multipart/form-data" novalidate>
                            @csrf
                            @method('PUT')


                            <div class="form-group row ">

                                    <img class="col-md-4 col-lg-8 offset-lg-2"  src="{{ auth()->user()->pathAttachment() }}">



                                    <div class="col-md-4 mt-4 col-lg-8 offset-lg-4 col-form-label text-md-right text-lg-left" >
                                        <input
                                            type="file"
                                            class="custom-file-input{{ $errors->has('picture') ? ' is-invalid' : ''}} "
                                            id="picture"
                                            name="picture"
                                        />

                                        <label
                                            class="  custom-file-label col-md-6" for="picture"
                                        >
                                            {{ __("Escoge una imagen para tu perfil") }}
                                        </label>
                                    </div>
                            </div>

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">
                                        {{ __("Nombre") }}
                                    </label>

                                    <div class="col-md-6">
                                        <!-- uso el operador ternario para controlar si hay algun error en el email, si lo hay añado la clase -->
                                        <input
                                            id="name"
                                            type="text"
                                            readonly
                                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            name="name"
                                            value="{{ $user->name }}"
                                            required
                                            autofocus
                                        />


                                        @if($errors->has('name'))
                                            <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __("Apellido") }}
                                </label>

                                <div class="col-md-6">
                                    <!-- uso el operador ternario para controlar si hay algun error en el email, si lo hay añado la clase -->
                                    <input
                                        id="last_name"
                                        type="text"
                                        class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                                        name="name"
                                        value="{{ $user->last_name }}"
                                        required
                                        autofocus
                                    />


                                    @if($errors->has('last_name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('last_name') }}</strong>
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
                        <div class="card-header text-warning bg-dark">
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
                        <div class="card-header text-warning bg-dark">
                            {{ __("Administrar los cursos que imparto") }}
                        </div>
                        <div class="card-body">
                            <a href="{{ route('teacher.courses') }}" class="btn btn-dark btn-block text-warning">
                                <i class="fa fa-leanpub"></i> {{ __("Administrar ahora") }}
                            </a>
                        </div>
                    </div>

                    <div class="card ">
                        <div class="card-header bg-dark text-warning">
                            {{ __("Mis estudiantes") }}
                        </div>
                        <div class="card-body offset-0 mr-4 ">
                            <table
                                    class="table table-striped table-bordered nowrap"
                                    cellspacing="0"
                                    id="students-table"
                            >


                                <thead>
                                <tr>
                                    <th>{{ __("Acciones") }}</th>
                                    <th>{{ __("ID") }}</th>
                                    <th>{{ __("Nombre") }}</th>
                                    <th>{{ __("Email") }}</th>
                                    <th>{{ __("Cursos") }}</th>

                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('partials.modal')

@endsection
@push('scripts')
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script>
        let dt;
        let modal = $("#appModal");
        $(document).ready(function() {
            dt = $("#students-table").DataTable({
                pageLength: 5,
                lengthMenu: [ 5, 10, 25, 50, 75, 100 ],
                processing: true,
                serverSide: true,
                autoWidth: true,
                scrollCollapse: true,
                ajax: '{{ route('teacher.students') }}',
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
                },
                columns: [
                    {data: 'actions'},
                    {data: 'user.id', visible: false},
                    {data: 'user.name'},
                    {data: 'user.email'},
                    {data: 'courses_formatted'}

                ]
            });
            $(document).on("click", '.btnEmail', function (e) {
                e.preventDefault();
                const id = $(this).data('id');
                modal.find('.modal-title').text('{{ __("Enviar mensaje") }}');
                modal.find('#modalAction').text('{{ __("Enviar mensaje") }}').show();
                let $form = $("<form id='studentMessage'></form>");
                $form.append(`<input type="hidden" name="user_id" value="${id}" />`);
                $form.append(`<textarea class="form-control" name="message"></textarea>`);
                modal.find('.modal-body').html($form);
                modal.modal();
            });

            $(document).on("click", "#modalAction", function (e) {
                $.ajax({
                    url: '{{ route('teacher.send_message_to_student') }}',
                    type: 'POST',
                    headers: {
                        'x-csrf-token': $("meta[name=csrf-token]").attr('content')
                    },
                    data: {
                        info: $("#studentMessage").serialize()
                    },
                    success: (res) => {
                        if(res.res) {
                            modal.find('#modalAction').hide();
                            modal.find('.modal-body').html('<div class="alert alert-success">{{ __("Mensaje enviado correctamente") }}</div>');
                        } else {
                            modal.find('.modal-body').html('<div class="alert alert-danger">{{ __("Ha ocurrido un error enviando el correo") }}</div>');
                        }
                    }
                })
            })
        })
    </script>
@endpush
