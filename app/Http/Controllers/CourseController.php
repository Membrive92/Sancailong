<?php

namespace App\Http\Controllers;

use App\Course;
use App\Helpers\Helper;
use App\Http\Requests\CourseRequest;
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

        ])->get();


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
    public function addReview()
    {
        Review::create([
            "user_id" => auth()->id(),
            "course_id" => request('course_id'),
            "rating" => request('rating_input'),
            "comment" => request('message')
        ]);
        return back()->with('message', ['success', __('Agradecemos tu valoracion')]);
    }

    public function create()
    {
        $course = new Course;
        $btnText = __("Enviar curso para revision");
        return view('courses.form', compact('course', 'btnText'));
    }

    // con este metedo almaceno los cursos y con merge añado variables nuevas para añadir informacion
    public function store(CourseRequest $course_request)
    {
        $picture = Helper::uploadFile('picture', 'courses');
        $course_request->merge(['picture' => $picture]);
        $course_request->merge(['teacher_id' => auth()->user()->teacher->id]);
        $course_request->merge(['status' => Course::PENDING]);
        Course::create($course_request->input());
        return back()->with('message', ['success', __('Curso enviado correctamente, recibirá un correo con cualquier información')]);
    }

    // metodo para editar el curso utilizando el slug para editar el curso concreto
    public function edit ($slug) {
        $course = Course::with(['requirements', 'goals'])->withCount(['requirements', 'goals'])
            ->whereSlug($slug)->first();
        $btnText = __("Actualizar curso");
        return view('courses.form', compact('course', 'btnText'));
    }

    // con este metodo compruebo que al modificar ya exista la imagen, la borro y la resubo con la nueva modificada
    // y en el request le paso la nueva foto , despues guardo las modificiaciones
    public function update (CourseRequest $course_request, Course $course) {
        if($course_request->hasFile('picture')) {
            \Storage::delete('courses/' . $course->picture);
            $picture = Helper::uploadFile( "picture", 'courses');
            $course_request->merge(['picture' => $picture]);
        }
        $course->fill($course_request->input())->save();
        return back()->with('message', ['success', __('Curso actualizado')]);
    }
    public function destroy (Course $course) {
        try {
            $course->delete();
            return back()->with('message', ['success', __("Curso eliminado correctamente")]);
        } catch (\Exception $exception) {
            return back()->with('message', ['danger', __("Error al eliminar el curso")]);
        }
    }


}