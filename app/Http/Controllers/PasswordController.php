<?php

namespace App\Http\Controllers;

use App\Mail\CourseApproved;
use App\Mail\ForgotPassword;
use App\Mail\MessageToStudent;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    public function getEmail(){
        return view('auth.passwords.email');
    }
    public function postEmail(Request $request, $token = null){
        dd($request);
           // \Mail::to($request->user())->send(new ForgotPassword());


    }

}
