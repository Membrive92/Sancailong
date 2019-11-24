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
    public function  watch (User $user, Course $course){
        //con esto permito que el usuario que este inscrito al video, pueda verlo
        return $course->students->contains($user->id) || $user->role_id !== Role::STUDENT;
    }

    // Si el estudiante aun no ha hecho una valoracion , podra hacerla
    public function  review (User $user, Course $course){
        return ! $course->reviews->contains('user_id',$user->id);
    }
}
