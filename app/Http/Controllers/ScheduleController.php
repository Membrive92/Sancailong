<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WorkDay;

class ScheduleController extends Controller
{
   private $days = [
    'Lunes', 'Martes', 'Miercoles', 'Jueves' , 'Viernes', 'Sabado', 'Domingo'
    ];
    private $engdays = [
        'Monday', 'Tuesday', 'Wednesday', 'Thursday' , 'Friday', 'Saturday', 'Sunday'
    ];


    public function edit(){

            $workDays = WorkDay::where('user_id', auth()->id())->get();
         // funcion de carbon que permite darle formato a las horas
           $workDays->map(function ($workDay){
           $workDay->morning_start = (new Carbon($workDay->morning_start))->format('H:i A');
           $workDay->morning_end = (new Carbon($workDay->morning_start))->format('H:i A');
           $workDay->afternoon_start = (new Carbon($workDay->afternoon_start))->format('H:i A');
           $workDay->afternoon_end = (new Carbon($workDay->afternoon_end))->format('H:i A');

             return $workDay;
        });

           // al ser una variable global, para que la coga el compact, es necesario usarla en la funcion
         if (session('applocale') == 'en'){
             $days= $this->engdays;
         } else{
             $days= $this->days;
         }

         //dd($workDays->toArray());
        return view('schedule.schedule', compact('workDays','days'));
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

        $errors = [];
        for ($i=0; $i<7; $i++) {
            if (in_array($i,$active)){
                if (session('applocale') == 'en'){
                    if ($morning_start[$i] > $morning_end[$i]) {
                        $errors[] = __("The morning schedule is wrong for ") . $this->engdays[$i] . '.';
                    }
                    if ($afternoon_start[$i] > $afternoon_end[$i]) {
                        $errors[] = __("The afternoon schedule is wrong for ") . $this->engdays[$i] . '.';
                    }
                } else {

                    if ($morning_start[$i] > $morning_end[$i]) {
                        $errors[] = __("Las horas del turno de mañana son inválidas para el  ") . $this->days[$i] . '.';
                    }
                    if ($afternoon_start[$i] > $afternoon_end[$i]) {
                        $errors[] = __("Las horas del turno de tarde son inválidas para el  ") . $this->days[$i] . '.';
                    }
                }
            }

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
        }
         // en este caso podria haber usado los mensajes de sesion como he hecho en la app  anteriormente pero he querido ser
        // mas especifico en los errores
        if (count($errors) > 0)
        return back()->with(compact('errors'));

        $notification = __("Cambios guardados con éxito");
        return back()->with(compact('notification'));
    }


}
