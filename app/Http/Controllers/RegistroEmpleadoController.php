<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroEmpleado;
use App\Models\Empleado;
use Carbon\Carbon;

class RegistroEmpleadoController extends Controller
{
    public function getRegistroEmpleados($id) {
        $userId = auth()->user()->id;
        $empleado = Empleado::where('user_id', "=", $userId)->get();
        $registros = RegistroEmpleado::find($empleado->id);

        return view('dashboard', [
            "registros" => $registros,
        ]);

    }

    public function registroEntrada(Request $request){
        $validatedata = $request->validate([
            "empleadoId" => "required",
        ]);
        $empleadoID = $validatedata["empleadoId"];
        $today = Carbon::now();
        $validatedata['dia'] = $today->toDate();
        $validatedata['horaEntrada'] = $today->toTimeString();
        $validatedata['empleado_id'] = $empleadoID;

        RegistroEmpleado::create($validatedata);
        return redirect('/')->with('success', 'Registro de entrada guardado con exito');

    }

    public function registroSalida(Request $request){
        $validatedata = $request->validate([
            "empleadoId" => "required",
        ]);
        $empleadoID = $validatedata["empleadoId"];
        $today = Carbon::now();
        RegistroEmpleado::where('empleado_id', "=", $empleadoID)->
        where('dia', '=', $today->toDate())->
        update(['horaSalida' => $today->toTimeString()]);

        return redirect('/')->with('success', 'Registro de salida guardado con exito');
    }
}

