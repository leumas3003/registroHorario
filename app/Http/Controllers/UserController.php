<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function add() {
        return view ('formulario-empresa');
    }

    public function save(Request $request)
    {
        $validatedata = $request->validate([
            "name" => "required|string",
            "email" => "required|string",
            "descripcion" => "required",
            "anyo" => "required|numeric|min:4",
        ]);

        $validatedata['password'] = Hash::make("password");
        $validatedata['admin'] = false;
        User::create($validatedata);

        return redirect('/')->with('success', 'Empresa creada con exito');;
    }
}
