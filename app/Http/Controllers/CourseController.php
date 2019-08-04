<?php

namespace App\Http\Controllers;


use App\Course;
use App\Mail\NewStudentInCourse;
use App\Review;

class CourseController extends Controller
{
    public function show(Course $course)
    {
        $course->load([
            'category' => function ($query) {
                $query->select('id', 'name');
            },
            'goals' => function ($query) {
                $query->select('id', 'course_id', 'goal');
            },
            'Level' => function ($query) {
                $query->select('id', 'name');
            },

            'requirements' => function ($query) {
                $query->select('id', 'course_id', 'requirement');
            },
            'reviews.user', 'teacher'

        ])->withCount(['students', 'reviews'])->get();

        $related = $course->relatedCourses();

        return view('courses.detail', compact('course', 'related'));
    }

    // con este metodo permitimos que los usuarios puedan inscrbirse a un curso
    public function inscribe(Course $course)
    {
        $course->students()->attach(auth()->user()->student->id);

        //envia un email al profesor utilziando el controlador creado pasandole el curso y el nombre del usuario autentificado
        \Mail::to($course->teacher->user)->send(new NewStudentInCourse($course, auth()->user()->name));
        return back()->with('message', ['success', __("Inscrito correctamente al curso")]);
    }

    // con este metodo usando la relacion muestro los cursos en los que el usuario id es el mismo que el id del usuario autentificado
    public function subscribed()
    {
        $courses = Course::whereHas('students', function ($query) {
            $query->where('user_id', auth()->id());
        })->get();
        // auth()->user()->student->courses;


        return view('courses.subscribed', compact('courses'));
    }

    // con este metodo me permite añadir las valoraciones que los usuarios autentificados pueden hacer desde el formulario
    public function addReview(){
       Review::create([
          "user_id" => auth()->id(),
          "course_id" => request('course_id'),
          "rating" =>  request('rating_input'),
          "comment" => request('message')
       ]);
       return back()->with('message',['success' ,__('Agradecemos tu valoracion')]);
    }
}
