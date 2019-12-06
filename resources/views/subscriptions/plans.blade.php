@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pricing.css') }}">

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
        'title' => __("Suscríbete ahora a uno de nuestros planes"),
        'icon' => 'globe'
    ])
@endsection

@section('content')
    <div class="container">
        <div class="pricing-table pricing-three-column row">
            <div class="plan col-sm-4 col-lg-4">
                <div class="plan-name-bronze">
                    <h2>{{ __("MENSUAL") }}</h2>
                    <span>{{ __(":price / Mes", ['price' => '€ 9,99']) }}</span>
            </div>
            <ul>
                    <li class="plan-feature">{{ __("Acceso a todos los cursos") }}</li>
                    <li class="plan-feature">
                        @include('partials.stripe.form', [
                            'product' => [
                                'name' => __('Suscripción'),
                                'description' => __('Mensual'),
                                'type' => 'monthly',
                                 'amount' => 999.99,
                                 'currency' =>'€'
                            ],
                        ])
                    </li>
                </ul>
            </div>



        </div>
    </div>
@endsection

