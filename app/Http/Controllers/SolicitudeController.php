<?php

namespace App\Http\Controllers;

use App\Role;
use App\Teacher;
use Illuminate\Http\Request;

class SolicitudeController extends Controller
{

    // con esta funcion cambio el rol del usuario a profesor y  creo un profesor con el id del usuario
    public function teacher () {
        $user = auth()->user();
        if ( ! $user->teacher) {
            try {
                \DB::beginTransaction();
                $user->role_id = Role::TEACHER;
                Teacher::create([
                    'user_id' => $user->id
                ]);
                $success = true;
                // si falla algo durante el proceso de creacion , hago un rollback en db y capturo la excepcion
            } catch (\Exception $exception) {
                \DB::rollBack();
                $success = $exception->getMessage();
            }
                  // si se hace correctamente aplico los cambios a la base de datos  y devuelvo un mensaje al usuario
            if ($success === true) {
                \DB::commit();
                $user->save();
                auth()->logout();
                auth()->loginUsingId($user->id);
                return back()->with('message', ['success', __("Felicidades, ya eres instructor en la plataforma")]);
            }
                 // mensaje de  error mostrado al usuario
            return back()->with('message', ['danger', $success]);
        }
        return back()->with('message', ['danger', __("Ha ocurrido un error ")]);
    }
}
