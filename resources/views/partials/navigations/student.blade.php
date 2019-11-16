<li><a class="nav-link" href="{{ route('profile.index') }}">{{ __("Mi perfil") }}</a></li>
<li><a class="nav-link" href="{{ route('subscription.admin') }}">{{ __("Mis suscripciones") }}</a></li>
<li><a class="nav-link" href="{{ route('invoices.manage') }}">{{ __("Mis facturas") }}</a></li>
<li><a class="nav-link" href="{{ route('courses.subscribed') }}">{{ __("Mis cursos") }}</a></li>
<li><a class="nav-link" href="{{ route('appointment.create') }}">{{ __("Reservar Cita") }}</a></li>

@include('partials.navigations.logged')