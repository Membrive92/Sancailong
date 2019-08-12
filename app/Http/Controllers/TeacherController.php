<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function students(){
        // utilizo el querybuilder de laravel para hacer la consulta
     $students = Student::with('user','courses.reviews')
         ->whereHas('courses',function ($q){
           $q->where('teacher_id',auth()->user()->teacher->id)
               ->select('id','teacher_id','name')
               // con esto incluimos los registros que estan en la "papelera"
               ->withTrashed();
     })->get();
     // aqui paso la ruta de donde esta el boton que usara en la accion
     $actions = 'students.datatables.actions';

     // utilizando el datatable añado la columna de action donde mostrara el boton y uso el metodo declarado en el modelo para mostrar los cursos formateados
     return \DataTables::of($students)->addColumn('actions', $actions)->rawColumns(['actions', 'courses_formatted'])->make(true);
    }
}
