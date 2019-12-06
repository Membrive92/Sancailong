@extends('layouts.app')



@section('jumbotron')
    @include('partials.jumbotron', ['title' => __('Manejar mis suscripciones'), 'icon' => 'list-ol'])
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
    <div class="pl-5 pr-5"></div>
       <div class=" row justify-content-center pl-5 pr-5">
           <table class="table table-hover table-dark text-warning ">
               <thead>
               <tr>

                   <th scope="col">{{__("Nombre")}}</th>
                   <th scope="col">{{__("Plan")}}</th>
                   <th scope="col">{{__("ID Suscripción")}}</th>
                   <th scope="col">{{__("Cantidad")}}</th>
                   <th scope="col">{{__("Alta")}}</th>
                   <th scope="col">{{__("Finaliza en")}}</th>
                   <th scope="col">{{__("Cancelar / Reanudar")}}</th>
               </tr>
               </thead>
               <tbody>
               @forelse($subscriptions as $subscription)
                   <td>{{ $subscription->id }}</td>
                   <td>{{ $subscription->name }}</td>
                   <td>{{ $subscription->stripe_plan }}</td>
                   <td>{{ $subscription->stripe_id }}</td>
                   <td>{{ $subscription->quantity }}</td>
                   <td>{{ $subscription->created_at->format('d/m/Y') }}</td>
                   <td>{{ $subscription->ends_at ? $subscription->ends_at->format('d/m/Y') : __("Suscripción activa") }}</td>
                   <td>
                       @if($subscription->ends_at)
                           <form action="{{ route('subscriptions.resume') }}" method="POST">
                               @csrf
                               <input type="hidden" name="plan" value="{{ $subscription->name }}" />
                               <button class="btn btn-success">
                                   {{ __("Reanudar") }}
                               </button>
                           </form>
                       @else
                           <form action="{{ route('subscriptions.cancel') }}" method="POST">
                               @csrf
                               <input type="hidden" name="plan" value="{{ $subscription->name }}" />
                               <button class="btn btn-danger">
                                   {{ __("Cancelar") }}
                               </button>
                           </form>
                       @endif
                   </td>
               @empty
                   <tr>
                       <td colspan="8">{{ __("No hay ninguna suscripción disponible") }}</td>
                   </tr>
               @endforelse
               </tbody>
           </table>
       </div>
    </div>
@endsection
