
<header>
    <nav class="navbar navbar-expand-md text-center  bg-dark text-warning  navbar-laravel " >
        <div class="container ml-5" >

            <a class="navbar-brand" href="{{ url('/') }}" style="font-size: 150%"><!--<img src="/public/css/scl.jpg" alt="logo">-->
                {{ config('app.name') }}
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon text-warning"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i></span>
            </button>

            <div class="collapse navbar-collapse ml-lg-5 " style=" " id="navbarContent">
                <!-- parte izquierda de la barra de navegacion -->

                <!-- parte derecha de la barra de navegacion -->
                <ul class="bg-dark navbar-nav  navbar-brand "  >
                    @include('partials.navigations.' . \App\User::navigation())
                    <li  class=" bg-dark nav-item dropdown " >
                        <a class="bg-dark nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-globe" aria-hidden="true"></i> {{ __("Idioma") }}
                        </a>
                    <div class="dropdown-menu bg-dark text-warning ml-5 " aria-labelledby="navbarDropdownMenuLink">
                        <a class=" dropdown-item text-warning bg-dark" href="{{ route('set_language', ['es']) }}">
                            <img class="  mr-1" style="width: 15%" height="15%" src="{{ asset('/images/Spain_flags_flag_8858.ico')  }}" alt="spain_flag"> {{ __("Español") }}</a>
                        <hr class="bg-warning">
                        <a class=" dropdown-item bg-dark text-warning" href="{{ route('set_language', ['en']) }}">
                            <img class=" mr-1" style="width: 15%" height="15%" src="{{ asset('/images/En.ico')  }}" alt="spain_flag">  {{ __("Inglés") }}
                        </a>
                    </div>
                    </li>
                </ul>
                    </div>


            </div>



    </nav>

</header>
