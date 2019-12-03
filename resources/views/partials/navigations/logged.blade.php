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
        <a class="dropdown-item bg-dark text-warning" href="{{ route('profile.index') }}"
           >
            <i class="fa fa-user-circle"></i> {{ __("Mi perfil") }}
        </a>
        <hr class="bg-warning">
        <a class="dropdown-item bg-dark text-warning" href="{{route('subscription.admin') }}"
           >
            <i class="fa fa-list-ol"></i> {{ __("Mis suscripciones") }}
        </a>
        <hr class="bg-warning">
        <a class="dropdown-item bg-dark text-warning" href="{{route('invoices.manage') }}"
          >
            <i class="fa fa-archive" ></i>  {{ __("Mis facturas")  }}
        </a>
        <hr class="bg-warning">
        <a class="dropdown-item bg-dark text-warning" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa fa-window-close-o" aria-hidden="true"></i> {{ __("Cerrar sesión") }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
