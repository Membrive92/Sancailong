<?php

namespace App\Http\Controllers;

use App\Rules\StrengthPassword;
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
        $this->validate(\request(),[
           'password' => ['confirmed', new StrengthPassword]
        ]);
        $user = auth()->user();
        $user->password = bcrypt(request('password'));
        $user->save();
        return back()->with('message', ['success', __("Usuario actualizado correctamente")]);
    }
}
