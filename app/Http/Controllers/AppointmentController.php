<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(){

        $courses = Course::all();

        return view('appointments.create',compact('courses','teacher'));
    }

     public function teachers(Course $course){

      return  $course->teacher()->get('user_id');

     }

}
