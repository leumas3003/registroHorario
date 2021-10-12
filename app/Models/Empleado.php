<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellidos',
        'identificacion',
        'horasDia',
        'pin',
        'imagen',
    ];
    use HasFactory;
}
