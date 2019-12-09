
<li><a class="bg-dark nav-link" href="{{ route('admin.courses') }}"><i class="fa fa-table mr-1"></i>{{ __("Administrar cursos") }}</a></li>
<li class="bg-dark nav-item dropdown "  >
    <a id="navbarDropdown"
       class="bg-dark nav-link dropdown-toggle"
       href="#" role="button"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"
    >
        <i class="fa fa-user-plus" aria-hidden="true"></i> {{ auth()->user()->name }}  <span class="caret"></span>
    </a>

    <div class="dropdown-menu bg-dark text-warning" aria-labelledby="navbarDropdown">
        <a class="dropdown-item bg-dark text-warning" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-window-close-o" aria-hidden="true"></i> {{ __("Cerrar sesión") }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>

