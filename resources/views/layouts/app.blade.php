
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head >
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="{{asset('assets/css/argon.css?v=1.1.0')}}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    @stack('styles')
    @yield('unique_styles')
</head>
<body style="background-position: center; background-repeat: no-repeat; background-image:url('{{ asset('/images/sancailong-back.jpg')  }} ')" >
@include('partials.navigation')

@yield('jumbotron')

<div id="app">
    <main class="py-4">
        @if(session('message'))
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="alert alert-{{ session('message')[0] }}">
                        <h5 class="alert-heading">{{ __("Informacion") }}</h5>
                        <p>{{ session('message')[1] }}</p>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" ></script>
<!-- Core -->
<script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/popper/popper.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/vendor/headroom/headroom.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<!-- Argon JS -->
<script src="{{asset('assets/js/argon.js?v=1.1.0')}}"></script>
@stack('scripts')
@yield('unique_scripts')
</body>
</html>