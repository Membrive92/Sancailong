<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // con esta funcion comprobamos si existe el idioma en el archivo 'languages' y lo guardaremos en la sesion de la aplicacion para cambiar 'locale' el idioma
    public function setLanguage($language){
        if(array_key_exists($language, config('languages'))){
            session()->put('applocale',$language);
        }
        return back();

    }
}
