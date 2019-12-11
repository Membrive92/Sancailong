<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ProfileRequest;
use App\Rules\StrengthPassword;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // con este metodo accedemos al usuario con la relacion del usuario de red social
    public function index(){
        $user = auth()->user()->load('socialAccount');
        return view('profile.index', compact('user'));
    }
    // con este metodo validamos la contraseña con la Rule y cambiamos la contraseña

        public function update(){


            $user = auth()->user();

if ($user->picture){
    $user->password = bcrypt(request('password'));
    $user->last_name = \request('name');
    $user->save();
    return back()->with('message', ['success', __("Usuario actualizado correctamente")]);

} else {
    $this->validate(\request(),[
        'password' => ['confirmed', new StrengthPassword],
        'picture' => 'required|image|mimes:jpg,jpeg,png'
    ]);
    $user->password = bcrypt(request('password'));
    $picture =Helper::uploadFile( "picture", 'users');
    $user->picture = $picture;
    $user->last_name = \request('name');
    $user->save();
    return back()->with('message', ['success', __("Usuario actualizado correctamente")]);
}








    }
}
