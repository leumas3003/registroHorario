<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\RegistroEmpleado;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmpleadoController extends Controller
{
    public function getEmpleados() {
        $userId = auth()->user()->id;
        $empleados = Empleado::where('user_id', "=", $userId)->get();

        return view('dashboard', [
            "empleados" => $empleados,
        ]);

    }

    public function accesoListaEmpleados() {
        $userId = auth()->user()->id;
        //$empleados = Empleado::where('user_id', "=", $userId)->get();
        $empleados = Empleado::all();

        return view('listado-empleados', [
            "empleados" => $empleados,
            "loginOK" => false,
        ]);

    }

    public function getListaEmpleados(Request $request) {
        $pass = auth() ->user()->password;

        $validatedata = $request->validate([
            "password" => "required",
        ]);

        if(!Hash::check($validatedata["password"], $pass)) {
            return back()
                ->withInput()
                ->withErrors(['pass' => 'Password erronea']);
        }
        $userId = auth()->user()->id;
        $empleados = Empleado::where('user_id', "=", $userId)->get();

        return view('listado-empleados', [
            "empleados" => $empleados,
            "loginOK" => true,
        ]);

    }

    public function getEmpleado($id) {
        $empleado = Empleado::findOrFail($id);

        return view('empleado', [
            "empleado" => $empleado,
            "loginOK" => false,
        ]);

    }

    public function acceder(Request $request){
        $today = Carbon::now();
        $validatedata = $request->validate([
            "empleadoId" => "required",
            "userpin" => "required",
        ]);
        $empleadoID = $validatedata["empleadoId"];
        $pin = $validatedata["userpin"];
        $empleado =Empleado::findOrFail($empleadoID);

        if($empleado["pin"] == $pin){
            return view('empleado', [
                "empleadoID" => $empleadoID,
                "empleado" => $empleado,
                "registros" => RegistroEmpleado::where("empleado_id", "=", $empleado->id)->
                where('dia','<=',date('Y-m-d'))->
                where('dia','>',$today->subMonth()->toDateString())->get(),
                "registroHoy" => RegistroEmpleado::where("empleado_id", "=", $empleado->id)->
                    where('dia','=',date('Y-m-d'))->get(),

                "loginOK" => true,
            ]);
        }else{
            return back()
                ->withInput()
                ->withErrors(['userpin' => 'Pin erroneo']);
        }
    }

    public function accessChangePin($id){
        $empleado = Empleado::findOrFail($id);

        return view('pin', [
            "empleado" => $empleado,
            "loginOK" => true,
        ]);

    }


    public function changePin(Request $request){
        $validatedata = $request->validate([
            "empleadoId" => "required",
            "userpin" => "required|min:4",
            "newpin" => "required|min:4",
            "newpin2" => "required|min:4",
        ],
        [
            "userpin" => "El PIN debe tener 4 caracteres",
            "newpin" => "El nuevo PIN debe tener 4 caracteres",
            "newpin2" => "El nuevo PIN debe tener 4 caracteres",
        ]);
        if($validatedata["newpin"] != $validatedata["newpin2"]){
            return back()
                ->withInput()
                ->withErrors(['newpin2' => 'La informacion introducida para el nuevo PIN no coincide']);
        }
        $empleadoID = $validatedata["empleadoId"];
        $pin = $validatedata["userpin"];
        $empleado =Empleado::findOrFail($empleadoID);
        if($empleado["pin"] != $pin){
            return back()
                ->withInput()
                ->withErrors(['userpin' => 'Pin erroneo']);
        }
        Empleado::where('id', "=", $empleadoID)->
            update(['pin' => $validatedata["newpin"]]);

        return redirect('/')->with('success', 'PIN cambiado con exito');
    }

    public function delete(Request $request)
    {
        $empleado = Empleado::findOrFail($request["id"]);

        unlink((public_path('').$empleado->imagen));
        if($empleado->user_id == auth()->user()->id) {
            $empleado->delete();
        }
        return redirect('/');
    }

    public function add() {
        return view ('formulario-empleado');
    }

    public function save(Request $request)
    {
        $validatedata = $request->validate([
            "nombre" => "required|string",
            "apellidos" => "required|string",
            "identificacion" => "required",
            "horasDia" => "required",
            "imagen" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);
        $validatedata['user_id'] = auth()->user()->id;
        $validatedata['pin'] = 1234;
        $imagen = time() . "." . $request->imagen->extension();
        $request->file('imagen')->move(public_path('img'),$imagen);
        $validatedata['imagen'] = "/img/$imagen";
        $empleado = Empleado::create($validatedata);

        return redirect('/listado')->with('success', 'Empleado creado con exito');;
    }
}
