<?php

namespace App\Http\Middleware;
// usado por laravel para manejar fechas
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //en este middleware comprobamos las variables de idioma, si existe la session coge la posicion 1 que es la e
        //equivalente a español  y establece los formatos a las fechas con Carbon y a la aplicacion
        // sino hay sesion, coge el idiona por defecto
        if (session('applocale')) {
            $configLanguage = config('languages')[session('applocale')];
            setlocale(LC_TIME, $configLanguage[1] . '.utf8');
            Carbon::setLocale(session('applocale'));
            App::setLocale(session('applocale'));
        } else {
            session()->put('applocale', config('app.fallback_locale'));
            setlocale(LC_TIME, 'es_ES.utf8');
            Carbon::setLocale(session('applocale'));
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }

}
