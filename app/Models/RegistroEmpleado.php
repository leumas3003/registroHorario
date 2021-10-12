<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroEmpleado extends Model
{
    protected $fillable = [
        'dia',
        'empleado_id',
        'horaEntrada',
        'horaSalida',
    ];
    use HasFactory;
}
