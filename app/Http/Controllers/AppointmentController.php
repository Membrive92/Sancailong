<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function create(){

        $courses = Course::all();
        return view('appointments.create',compact('courses'));
    }
}
