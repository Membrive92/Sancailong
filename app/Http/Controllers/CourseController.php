<?php

namespace App\Http\Controllers;



use App\Course;

class CourseController extends Controller
{
    public function show(Course $course){
        $course->load([
           'category' => function($query){
               $query->select('id','name');
           },
           'goals' => function($query){
               $query->select('id','course_id','goal');
           },
           'Level' => function($query){
               $query->select('id','name');
           },

           'requirements' => function($query){
               $query->select('id','course_id','requirement');
           },
           'reviews.user','teacher'

       ])->withCount(['students','reviews'])->get();

       dd($course);
    }
}
