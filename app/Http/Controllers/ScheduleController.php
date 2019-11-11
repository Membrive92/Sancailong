<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkDay;

class ScheduleController extends Controller
{
    public function edit(){
        $days = [
            'Lunes', 'Martes', 'Miercoles', 'Jueves' , 'Viernes', 'Sabado', 'Domingo'
        ];
        return view('schedule.schedule', compact('days'));
    }
    public function store(Request $request){
        //dd($request->all());
        // con el operador ternario hago la comprobacion, si existe no hago nada , sino lo dejo vacio
        // esto es por que los checkbox si no se activan, no envia la informacion en el request
        $active = $request->input('active') ?: [];
        $morning_start = $request->input('morning_start');
        $morning_end = $request->input('morning_end');
        $afternoon_start = $request->input('afternoon_start');
        $afternoon_end = $request->input('afternoon_end');

        for ($i=0; $i<7; $i++)

        WorkDay::updateOrCreate(
            [
                'day' =>$i ,
                'user_id'=> auth()->id()

            ],


            [
              // para comprobar que dias estan activos en el check box usamos este metodo
                //qye busca la variable i dentro de active sin necesidad de hacer un bucle
            'active' => in_array($i, $active),

            'morning_start' =>$morning_start[$i] ,
            'morning_end' =>$morning_end[$i] ,
            'afternoon_start' =>$afternoon_start[$i] ,
            'afternoon_end' =>$afternoon_end[$i] ,

        ]);
        return back()->with('message', ['success', __('Cambios guardados con éxito')]);
    }


}
