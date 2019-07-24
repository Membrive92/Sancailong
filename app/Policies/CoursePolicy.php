<?php

namespace App\Policies;

use App\Role;
use App\User;
use App\Course;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
{
    use HandlesAuthorization;

        //determina si un usuario puede o no optar a un curso
    public function opt_for_course (User $user, Course $course){
    return !$user->teacher || $user->teacher->id !== $course->teacher_id;

    }

    public function subscribe (User $user){
        // comprobamos que no es admin y que no este subscrito a ningun plan
        return $user->role_id !== Role::ADMIN && !$user->subscribed('main');
    }

    public function  inscribe (User $user, Course $course){
        //comprueba dentro de la relacion que tenemos, si alguno de estos estudiantes, es el del usuario
        return ! $course->students->contains($user->student->id);
    }

}
