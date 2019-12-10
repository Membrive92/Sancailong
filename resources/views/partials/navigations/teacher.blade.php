
<li><a class="bg-dark nav-link " href="{{route('courses.subscribed')}}"><i class="fa fa-table"></i> {{ __("Mis cursos") }}</a></li>
<li><a class="bg-dark nav-link " href="{{ route('teacher.courses') }}"><i class="fa fa-building"></i> {{ __("Cursos impartidos") }}</a></li>
<li><a class="bg-dark nav-link " href="{{ route('courses.create') }}"><i class="fa fa-edit" ></i> {{ __("Crear curso") }}</a></li>
<li><a class="bg-dark nav-link " href="{{ route('teacher.schedule') }}"><i class="fa fa-calendar" aria-hidden="true"></i> {{ __("Gestionar Horario") }}</a></li>
@include('partials.navigations.logged' )
