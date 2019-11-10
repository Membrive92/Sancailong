<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    public function edit(){
        $days = [
            'Lunes', 'Martes', 'Miercoles', 'Jueves' , 'Viernes', 'Sabado', 'Domingo'
        ];
        return view('schedule.schedule', compact('days'));
    }
    public function store(Request $request){
        dd($request->all());
    }
}
