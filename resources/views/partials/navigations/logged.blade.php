<li class="bg-dark nav-item dropdown">
    <a id="navbarDropdown"
       class="bg-dark nav-link dropdown-toggle"
       href="#" role="button"
       data-toggle="dropdown"
       aria-haspopup="true"
       aria-expanded="false"
    >
        <img class="img-fluid" src="{{ auth()->user()->pathAttachment()}}" style="height: 8% ; width:8% ; border: #e5c428 2px solid; box-shadow: 0 0 0 1px #949493; margin: 0%;
        " />  {{ auth()->user()->name }} <span class="caret"></span>
    </a>

    <div class="dropdown-menu bg-dark text-warning" aria-labelledby="navbarDropdown">
        <a class="dropdown-item bg-dark text-warning" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __("Cerrar sesión") }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</li>
